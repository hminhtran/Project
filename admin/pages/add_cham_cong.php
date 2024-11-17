<?php
$manv = isset($_GET['Ma_nv']);

if ($manv) {
    $sql = "SELECT * FROM cham_cong WHERE Ma_nv = '$manv' AND Ngay = CURDATE()";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Nhân viên đã chấm công hôm nay')</script>";
    } else {
        $sql = "INSERT INTO cham_cong(Ma_nv, Ngay, Tinh_trang) VALUES ('$manv', CURDATE(), 'Đi làm'";
        $result = mysqli_query($conn, $sql);
        if ($result > 0) {
            echo "<script>alert('Chấm công thành công')</script>";
            echo "<script>window.location.href = 'cham_cong.php'</script>";
        } else {
            echo "<script>alert('Chấm công thất bại')</script>";
            echo "<script>window.location.href = 'cham_cong.php'</script>";
        }
    }
}
?>