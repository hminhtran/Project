<?php
require_once "../src/db.php";

$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

if ($keyword) {
    $query = $conn->prepare("
      SELECT 
    sanpham.TenSP, 
    sp_theo_lo.ma_theo_lo, 
    sanpham.GiaBan
FROM 
   sp_theo_lo
JOIN 
     sanpham 
ON 
  sanpham.Ma_sp = sp_theo_lo.ma_sp 
WHERE 
    sanpham.Ma_sp LIKE ? OR sanpham.TenSP LIKE ?
LIMIT 5;
");

    if (!$query) {
        die('Lỗi truy vấn: ' . $conn->error); // Kiểm tra lỗi truy vấn
    }

    $likeKeyword = '%' . $keyword . '%';
    $query->bind_param("ss", $likeKeyword, $likeKeyword);
    $query->execute();

    $result = $query->get_result();
    $products = [];

    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    echo json_encode($products);
}
?>