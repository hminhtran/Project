<?php
require_once "../src/db.php";
session_start(); // Khởi động phiên làm việc để sử dụng $_SESSION

// Nhận dữ liệu từ AJAX
$data = json_decode(file_get_contents('php://input'), true);

// Kiểm tra xem dữ liệu có hợp lệ không
if (isset($data['products']) && isset($data['paymentMethod']) && isset($data['total']) && isset($data['orderId'])) {
    // Lấy thông tin đơn hàng
    $paymentMethod = $data['paymentMethod'];
    $total = $data['total'];
    $orderId = $data['orderId'];

    // Kiểm tra thông tin người bán từ session
    if (isset($_SESSION['Ma_nv'])) {
        $ma_nv = $_SESSION['Ma_nv'];
        $ho_ten = $_SESSION['Ho_ten'];
        $nguoi_ban = $ma_nv . "-" . $ho_ten;
    } else {
        echo json_encode(['success' => false, 'message' => 'Không tìm thấy thông tin người nhận hàng.']);
        exit; // Ngừng thực thi nếu không tìm thấy thông tin người dùng
    }

    // Bắt đầu giao dịch SQL
    $conn->begin_transaction();

    try {
        // Tạo câu lệnh SQL để thêm đơn hàng vào bảng donban
        $sql = "INSERT INTO donban (ma_hd, nguoi_ban, ngay_ban, tong_tien, phuong_thuc_tt, trang_thai) 
                VALUES ('$orderId', '$nguoi_ban', NOW(), '$total', '$paymentMethod', 'Thành công')";

        // Thực thi câu lệnh SQL
        if ($conn->query($sql) === TRUE) {
            // Cập nhật chi tiết đơn hàng vào bảng chitietdonban
            foreach ($data['products'] as $product) {
                $ma_sp = $product['ma_theo_lo'];
                $quantity = $product['quantity'];
                $ten_sp = $product['TenSP'];

                $price = $product['GiaBan'];  // Giả sử bạn đã gửi giá sản phẩm từ phía client

                // Tính tổng tiền cho sản phẩm
                $totalProduct = $quantity * $price;

                // Thêm thông tin chi tiết sản phẩm vào bảng chitietdonban

                $detailSql = "INSERT INTO chitietdonban (`ma_hd`, `ma_sp`, `ten_sp`, `so_luong`, `don_gia`, `tong_tien`, `status`, `updated_at`) 
                              VALUES ('$orderId', '$ma_sp','$ten_sp', '$quantity', '$price', '$totalProduct', 'Đã thanh toán',NOW())";
                if ($conn->query($detailSql) !== TRUE) {
                    throw new Exception('Không thể thêm chi tiết đơn hàng cho sản phẩm: ' . $ma_sp);
                }

                // Cập nhật số lượng sản phẩm trong bảng sp_theo_lo
                $updateSql = "UPDATE sp_theo_lo SET so_luong = so_luong - $quantity WHERE ma_theo_lo = '$ma_sp'";

                if ($conn->query($updateSql) !== TRUE) {
                    throw new Exception('Cập nhật số lượng sản phẩm không thành công cho sản phẩm: ' . $ma_sp);
                }
            }

            // Nếu mọi thao tác thành công, commit giao dịch

            $conn->commit();
            echo json_encode(['success' => true, 'message' => 'Thanh toán thành công!']);

        } else {
            throw new Exception('Không thể thêm đơn hàng vào bảng donban.');
        }

    } catch (Exception $e) {
        // Nếu có lỗi, rollback giao dịch
        $conn->rollback();
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }

} else {
    echo json_encode(['success' => false, 'message' => 'Dữ liệu không hợp lệ.']);
}

$conn->close();
?>