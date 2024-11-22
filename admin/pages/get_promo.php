<?php
// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quanlychamcong";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Câu SQL truy vấn khuyến mãi
$sql = "SELECT 
            spk.ma_san_pham, 
            spk.ma_chi_tiet, 
            km.loai_khuyen_mai, 
            ct.ten_khuyen_mai, 
            ct.so_luong_yeu_cau, 
            ct.gia_tri_giam, 
            ct.phan_tram_giam, 
            ct.ngay_bat_dau, 
            ct.ngay_ket_thuc
        FROM 
            sanphamkhuyenmai spk
        JOIN 
            chitietkhuyenmai ct ON spk.ma_chi_tiet = ct.ma_chi_tiet
        JOIN 
            khuyenmai km ON ct.ma_khuyen_mai = km.ma_khuyen_mai
        WHERE 
            NOW() BETWEEN ct.ngay_bat_dau AND ct.ngay_ket_thuc";

$result = $conn->query($sql);

// Lưu kết quả vào một mảng
$promotions = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $promotion = [
            "productId" => $row["ma_san_pham"],
            "promotionType" => $row["loai_khuyen_mai"],
            "promotionName" => $row["ten_khuyen_mai"],
            "criteria" => [
                "quantityRequired" => $row["so_luong_yeu_cau"]
            ],
            "discountValue" => $row["gia_tri_giam"],
            "discountPercent" => $row["phan_tram_giam"],
        ];
        $promotions[] = $promotion;
    }
}

// Đóng kết nối
$conn->close();

// Trả về kết quả dưới dạng JSON
header('Content-Type: application/json');
echo json_encode($promotions);
