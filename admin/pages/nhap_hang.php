<?php require 'header.php' ?>
<?php
require '../../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use Endroid\QrCode\QrCode;

require_once "../src/db.php";
$ncc = $conn->query("SELECT * FROM nhacungcap");

// Mảng để lưu trữ thông báo
$messages = [];

// Biến cờ để kiểm tra tính hợp lệ của dữ liệu
$isAllSuccess = true;

// Kiểm tra nếu có file được tải lên
if (isset($_FILES["excel_file"]["name"]) && $_FILES["excel_file"]["name"]) {
    $fileName = $_FILES["excel_file"]["tmp_name"];
    $fileType = $_FILES["excel_file"]["type"];
    $fileExtension = pathinfo($_FILES["excel_file"]["name"], PATHINFO_EXTENSION);

    // Kiểm tra kiểu file
    if (!in_array($fileExtension, ['xls', 'xlsx'])) {
        $messages[] = "File tải lên không phải là file Excel. Vui lòng kiểm tra lại!";
        $isAllSuccess = false;
    } elseif (!in_array($fileType, ['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])) {
        $messages[] = "File tải lên không phải là file Excel. Vui lòng kiểm tra lại!";
        $isAllSuccess = false;
    } else {
        // Nếu file hợp lệ, tiếp tục xử lý
        $spreadsheet = IOFactory::load($fileName);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();

        $rowNumber = 0;
        $nha_cung_cap = $_POST['ncc'];
        if (isset($_SESSION['Ma_nv'])) {
            $ma_nv = $_SESSION['Ma_nv'];
            $ho_ten = $_SESSION['Ho_ten'];
            $nguoi_nhan = $ma_nv . "-" . $ho_ten;
        } else {
            $messages[] = "Không tìm thấy thông tin người nhận hàng.";
            $isAllSuccess = false;
        }
        $currentDateTime = new DateTime();
        $formattedTime = $currentDateTime->format('dmHi');

        foreach ($rows as $row) {
            if ($rowNumber === 0) {
                $rowNumber++;
                continue;
            }
            $ma_sp = isset($row[0]) ? $row[0] : null;
            $so_luong = isset($row[1]) ? $row[1] : null;
            $ngay_nhap_raw = isset($row[2]) ? $row[2] : null;
            $hsd = isset($row[3]) ? $row[3] : null;

            if (!$ma_sp || !$so_luong || !$ngay_nhap_raw) {
                $isAllSuccess = false;
                break;
            }

            $ngay_san_xuat = \DateTime::createFromFormat('d/m/Y', $ngay_nhap_raw);
            if ($ngay_san_xuat === false) {
                $isAllSuccess = false;
                break;
            }
            $hsd = \DateTime::createFromFormat('d/m/Y', $hsd);
            if ($hsd === false) {
                $isAllSuccess = false;
                break;
            }
            $rowNumber++;
        }

        if (!$isAllSuccess) {
            $messages[] = "Dữ liệu trong file Excel không hợp lệ. Vui lòng kiểm tra lại!";
        } else {
            $rowNumber = 0;

            foreach ($rows as $row) {
                if ($rowNumber === 0) {
                    $rowNumber++;
                    continue;
                }

                $ma_sp = isset($row[0]) ? $row[0] : null;
                $so_luong = isset($row[1]) ? $row[1] : null;
                $ngay_nhap_raw = isset($row[2]) ? $row[2] : null;
                $ngay_san_xuat = \DateTime::createFromFormat('d/m/Y', $ngay_nhap_raw);
                if ($hsd instanceof DateTime) {
                    $hsd = $hsd->format('d/m/Y'); // Chuyển đối tượng DateTime thành chuỗi theo định dạng ngày tháng năm
                }
                $hsd = \DateTime::createFromFormat('d/m/Y', $hsd);

                if ($ngay_san_xuat === false) {
                    $messages[] = "Ngày sản xuất không hợp lệ cho sản phẩm $ma_sp. Vui lòng kiểm tra lại!";
                    continue;
                }
                if ($hsd === false) {
                    $messages[] = "Hạn sử dụng không hợp lệ cho sản phẩm $ma_sp. Vui lòng kiểm tra lại!";
                    continue;
                }
                $formatted_ngay_sx = $ngay_san_xuat->format('Y-m-d');
                $formatted_hsd = $hsd->format('Y-m-d');

                $ma_theo_lo = $ma_sp . $ngay_san_xuat->format('dm');

                // Kiểm tra và cập nhật bảng lo_nhap
                $sql_check = "SELECT so_luong FROM lo_nhap WHERE ma_sp = '$ma_sp' AND ngay_san_xuat = '$formatted_ngay_sx' AND han_su_dung = '$formatted_hsd' AND nha_cung_cap = '$nha_cung_cap'";
                $result = $conn->query($sql_check);

                if ($result === false) {
                    $messages[] = "Lỗi truy vấn: " . $conn->error;
                    $isAllSuccess = false;
                } elseif ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $new_quantity = $row['so_luong'] + $so_luong;
                    $sql_update = "UPDATE lo_nhap SET so_luong = '$new_quantity' WHERE ma_sp = '$ma_sp' AND nguoi_nhan= '$nguoi_nhan' AND han_su_dung = '$formatted_hsd' AND ngay_san_xuat = '$formatted_ngay_sx' AND nha_cung_cap = '$nha_cung_cap'";
                    if ($conn->query($sql_update) === TRUE) {
                    } else {
                        $messages[] = "Lỗi: " . $sql_update . "<br>" . $conn->error;
                        $isAllSuccess = false;
                    }
                } else {
                    $sql_insert = "INSERT INTO lo_nhap (ma_sp, ma_theo_lo, so_luong, ngay_san_xuat,han_su_dung,ngay_nhap, nha_cung_cap,ma_don,nguoi_nhan) 
                                   VALUES ('$ma_sp', '$ma_theo_lo', '$so_luong', '$formatted_ngay_sx','$formatted_hsd',NOW(), '$nha_cung_cap', '$formattedTime','$nguoi_nhan')";
                    if ($conn->query($sql_insert) === TRUE) {
                    } else {
                        echo $sql_insert . "<br>" . $conn->error;
                        $isAllSuccess = false;
                    }
                }

                // Cập nhật bảng sp_theo_lo
                $sql_check_sp_lo = "SELECT so_luong FROM sp_theo_lo WHERE ma_sp = '$ma_sp' AND ma_theo_lo = '$ma_theo_lo'";
                $result_sp_lo = $conn->query($sql_check_sp_lo);

                if ($result_sp_lo === false) {
                    $messages[] = "Lỗi truy vấn sp_theo_lo: " . $conn->error;
                    $isAllSuccess = false;
                } elseif ($result_sp_lo->num_rows > 0) {
                    // Cập nhật số lượng trong bảng sp_theo_lo
                    $row_sp_lo = $result_sp_lo->fetch_assoc();
                    $new_quantity_sp_lo = $row_sp_lo['so_luong'] + $so_luong;
                    $sql_update_sp_lo = "UPDATE sp_theo_lo 
                    SET so_luong = '$new_quantity_sp_lo', ngay_san_xuat = '$formatted_ngay_sx', han_su_dung = '$formatted_hsd', ngay_nhap = NOW()
                    WHERE ma_sp = '$ma_sp' AND ma_theo_lo = '$ma_theo_lo'";

                    if ($conn->query($sql_update_sp_lo) === TRUE) {
                    } else {
                        $messages[] = "Lỗi: " . $sql_update_sp_lo . "<br>" . $conn->error;
                        $isAllSuccess = false;
                    }
                } else {
                    // Thêm mới vào bảng sp_theo_lo
                    $sql_insert_sp_lo = "INSERT INTO sp_theo_lo (ma_sp, ma_theo_lo, so_luong, ngay_san_xuat, han_su_dung, ngay_nhap) 
                    VALUES ('$ma_sp', '$ma_theo_lo', '$so_luong', '$formatted_ngay_sx', '$formatted_hsd', NOW())";
                    if ($conn->query($sql_insert_sp_lo) === TRUE) {
                    } else {
                        $messages[] = "Lỗi: " . $sql_insert_sp_lo . "<br>" . $conn->error;
                        $isAllSuccess = false;
                    }
                }

                // Cập nhật tổng số lượng sản phẩm trong bảng san_pham
                $sql_total_check = "SELECT so_luong FROM sanpham WHERE ma_sp = '$ma_sp'";
                $result_total = $conn->query($sql_total_check);

                if ($result_total === false) {
                    $messages[] = "Lỗi truy vấn tổng số lượng sản phẩm: " . $conn->error;
                    $isAllSuccess = false;
                } elseif ($result_total->num_rows > 0) {
                    $row_total = $result_total->fetch_assoc();
                    $new_total_quantity = $row_total['so_luong'] + $so_luong;
                    $sql_update_total = "UPDATE sanpham SET so_luong = '$new_total_quantity' WHERE ma_sp = '$ma_sp'";
                    if ($conn->query($sql_update_total) === TRUE) {
                    } else {
                        $messages[] = "Lỗi: " . $sql_update_total . "<br>" . $conn->error;
                        $isAllSuccess = false;
                    }
                } else {
                    $messages[] = "Không tìm thấy sản phẩm $ma_sp!";
                }
            }
        }
        if ($isAllSuccess) {
            $sql_don_nhap = "INSERT INTO don_nhap (ma_don,nha_cung_cap, nguoi_nhan, ngay_nhap) VALUES ('$formattedTime','$nha_cung_cap', '$nguoi_nhan', NOW())";
            if ($conn->query($sql_don_nhap) === TRUE) {
                $messages[] = "Thêm đơn nhập thành công!";
            } else {
                $messages[] = "Lỗi thêm đơn nhập: " . $conn->error;
            }

            $pdfFilePath = "../../don_nhap/" . $formattedTime . ".pdf";
            $pdfWriter = new \PhpOffice\PhpSpreadsheet\Writer\Pdf\Mpdf($spreadsheet); // Hoặc sử dụng Dompdf nếu thích
            try {
                $pdfWriter->save($pdfFilePath);
                $messages[] = "File PDF đã được lưu thành công tại: $pdfFilePath";
            } catch (Exception $e) {
                $messages[] = "Lỗi khi lưu file PDF: " . $e->getMessage();
            }
        }
    }
}




?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Nhập hàng</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Nhập hàng</a></li>
                        <li class="breadcrumb-item active">Thêm</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Nhập hàng</h3>
                </div>
                <form method="post" enctype="multipart/form-data" action="">
                    <!-- Để action trống để gửi đến chính trang -->
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nhà cung cấp</label>
                                    <select name="ncc" id="ncc" required class="form-control">
                                        <?php while ($row = $ncc->fetch_assoc()): ?>
                                            <option value="<?php echo $row['TenNCC'] ?>"><?php echo $row['TenNCC'] ?>
                                            </option>
                                        <?php endwhile ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>File nhập hàng</label>
                                    <input type="file" name="excel_file" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="btn" class="btn btn-primary">Thêm</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<!-- Thêm phần thông báo ở đây -->
<script>
    const messages = <?php echo json_encode($messages); ?>;
    messages.forEach(function (message) {
        alert(message);
    });
</script>

<?php require 'footer.php' ?>