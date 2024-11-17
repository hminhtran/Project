<?php
// update_inventory.php
header('Content-Type: application/json');
$pdo = new PDO('mysql:host=localhost;dbname=your_database', 'username', 'password');

// Nhận dữ liệu từ request
$data = json_decode(file_get_contents('php://input'), true);

foreach ($data as $item) {
    $productCode = $item['code'];
    $quantity = $item['quantity'];

    // Cập nhật số lượng sản phẩm
    $stmt = $pdo->prepare("UPDATE sanpham SET quantity = quantity - :quantity WHERE Ma_sp = :code");
    $stmt->execute(['quantity' => $quantity, 'code' => $productCode]);
}

echo json_encode(['status' => 'success']);
?>