<?php
// Kết nối đến cơ sở dữ liệu
$mysqli = new mysqli("localhost", "root", "", "quanlychamcong");

// Kiểm tra kết nối
if ($mysqli->connect_error) {
    die("Kết nối thất bại: " . $mysqli->connect_error);
}

// Lấy mã sản phẩm từ yêu cầu POST
$ma_sp = isset($_GET['ma_sp']) ? $_GET['ma_sp'] : '';

if ($ma_sp) {
    // Chuẩn bị câu lệnh SQL
    $stmt = $mysqli->prepare("SELECT 
    stl.ma_theo_lo,
    stl.ma_sp, 
    sp.TenSP, 
    sp.GiaBan
FROM 
    sp_theo_lo stl
JOIN 
    sanpham sp ON stl.ma_sp = sp.ma_sp 
WHERE 
    stl.ma_theo_lo = ?");

    // Kiểm tra lỗi khi chuẩn bị câu lệnh
    if (!$stmt) {
        die("Lỗi chuẩn bị câu lệnh: " . $mysqli->error);
    }

    // Ràng buộc tham số
    $stmt->bind_param("s", $ma_sp); // "s" cho biết rằng tham số là kiểu string

    // Thực thi câu lệnh
    $stmt->execute();

    // Lấy kết quả
    $result = $stmt->get_result();

    // Kiểm tra nếu có sản phẩm được tìm thấy
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Trả về thông tin sản phẩm dưới dạng JSON
        echo json_encode($row);
    } else {
        echo json_encode(['error' => 'Không tìm thấy sản phẩm.']);
    }

    // Đóng câu lệnh
    $stmt->close();
} else {
    echo json_encode(['error' => 'Mã sản phẩm không hợp lệ.']);
}

// Đóng kết nối
$mysqli->close();
?>