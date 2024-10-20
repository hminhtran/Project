<?php
include ("../src/db.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $manv = $_POST['manv'];
        $sotien = $_POST['so_tien'];
        $ngay = $_POST['ngay'];
        $id_ung = $_POST['id_ung'];
    // Kiểm tra xem nút "Duyệt" hoặc "Từ chối" đã được nhấn
    if (isset($_POST['approve'])) {
        // Xử lý duyệt
        
    $sql = "INSERT into ung_luong Values ('','$manv','$sotien','$ngay')";
    $sqltt = "UPDATE yeu_cau_ung_luong set trang_thai = 'Đã duyệt' where id_ung = '$id_ung'";
    $result = mysqli_query($conn, $sql);
    $resultt = mysqli_query($conn, $sqltt);
    if ($result == true && $resultt == true) 
    {
        echo "<script> alert('Đã phê duyệt');</script>";
        echo "<script> window.location = 'duyet_ung_luong.php';</script>";
        
    } 
    else
    {
        echo $sql;
        echo $sqltt;
    }
}
    elseif (isset($_POST['reject'])) {
        $sqltt = "UPDATE yeu_cau_ung_luong set trang_thai = 'Từ chối' where id_ung = '$id_ung'";
        $resultt = mysqli_query($conn, $sqltt);
        if ($resultt == true)
        {
            echo "<script> alert('Đã từ chối');</script>";
            echo "<script> window.location = 'duyet_ung_luong.php';</script>";
        }
        else
        {
            echo $sqltt;
        }
    }
    // Sau khi xử lý, bạn có thể chuyển hướng hoặc hiển thị thông báo

}
?>