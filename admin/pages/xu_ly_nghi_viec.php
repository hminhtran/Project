<?php
include ("../src/db.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
       $id = $_POST['id'];
    // Kiểm tra xem nút "Duyệt" hoặc "Từ chối" đã được nhấn
    if (isset($_POST['approve'])) {
    $sqltt = "UPDATE nghi_viec set trang_thai = 'Đã duyệt' where id = '$id'";
    $result = mysqli_query($conn, $sqltt);
    if ($result == true) 
    {
        echo "<script> alert('Đã phê duyệt');</script>";
        echo "<script> window.location = 'ql_nghi_viec.php';</script>";
        
    } 
    else
    {
        echo $sqltt;
    }
}
    elseif (isset($_POST['reject'])) {
        $sqltt = "UPDATE nghi_viec set trang_thai = 'Từ chối' where id = '$id'";
        $result = mysqli_query($conn, $sqltt);
        if ($result == true) 
        {
            echo "<script> alert('Đã từ chối');</script>";
            echo "<script> window.location = 'ql_nghi_viec.php';</script>";
            
        } 
        else
        {
            echo $sqltt;
        }
    }
    // Sau khi xử lý, bạn có thể chuyển hướng hoặc hiển thị thông báo

}
?>