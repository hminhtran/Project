<?php
require 'header.php';
require_once "../src/db.php";
require '..//../vendor/autoload.php'; // Gọi thư viện PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;


if ($_FILES["excel_file"]["name"]) {
    $fileName = $_FILES["excel_file"]["tmp_name"];

    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($fileName);
    $worksheet = $spreadsheet->getActiveSheet();
    $rows = $worksheet->toArray();

    $rowNumber = 0;


    foreach ($rows as $row) {
        if ($rowNumber === 0) {
            $rowNumber++;
            continue;
        }
        $ma_sp = isset($row[0]) ? $row[0] : null;
        $so_luong = isset($row[1]) ? $row[1] : null;
        $ngay_nhap_raw = isset($row[2]) ? $row[2] : null;

        if (!$ma_sp || !$so_luong || !$ngay_nhap_raw) {
            echo "Dữ liệu không đầy đủ cho một dòng trong file Excel.<br>";
            continue;
        }
        $ngay_nhap = \DateTime::createFromFormat('l, F j, Y', $ngay_nhap_raw);

        if ($ngay_nhap !== false) {
            $formatted_ngay_nhap = $ngay_nhap->format('Y-m-d');
        } else {
            echo "Định dạng ngày không hợp lệ cho sản phẩm $ma_sp.<br>";
            continue;
        }
        $ma_theo_lo = $ma_sp . $ngay_nhap->format('dm');
        $nha_cung_cap = $_POST['nha_cung_cap'];
        if (isset($_SESSION['Ma_nv'])) {
            // Lấy giá trị từ session
            $ma_nv = $_SESSION['Ma_nv'];
            $ho_ten = $_SESSION['Ho_ten'];

            // Tạo chuỗi kết hợp
            $nguoi_nhan = $ma_nv . "-" . $ho_ten;
        } else {
            echo "Không tìm thấy thông tin người nhận hàng.<br>";
            continue;
        }

        $sql_check = "SELECT so_luong FROM lo_nhap WHERE ma_sp = '$ma_sp' AND ngay_nhap = '$formatted_ngay_nhap' AND nha_cung_cap = '$nha_cung_cap'";
        $result = $conn->query($sql_check);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $new_quantity = $row['so_luong'] + $so_luong;
            $sql_update = "UPDATE lo_nhap SET so_luong = '$new_quantity' WHERE ma_sp = '$ma_sp' AND nguoi_nhan= '$nguoi_nhan' AND ngay_nhap = '$formatted_ngay_nhap' AND nha_cung_cap = '$nha_cung_cap'";
            if ($conn->query($sql_update) === TRUE) {
                echo "Cập nhật số lượng sản phẩm $ma_sp thành công!<br>";
                echo $nguoi_nhan;

            } else {
                echo "Lỗi: " . $sql_update . "<br>" . $conn->error;
            }
        } else {
            $sql_insert = "INSERT INTO lo_nhap (ma_sp, ma_theo_lo, so_luong, ngay_nhap, nha_cung_cap, nguoi_nhan) 
                           VALUES ('$ma_sp', '$ma_theo_lo', '$so_luong', '$formatted_ngay_nhap', '$nha_cung_cap', '$nguoi_nhan')";
            if ($conn->query($sql_insert) === TRUE) {
                echo "Sản phẩm $ma_sp được thêm thành công với mã theo lô $ma_theo_lo!<br>";
            } else {
                echo "Lỗi: " . $sql_insert . "<br>" . $conn->error;
            }
        }
        $rowNumber++;
    }

    $conn->close();
}
?>