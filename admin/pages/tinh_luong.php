<?php
include("../src/db.php");
$manv = $_GET['Manv'];
$hs = $_GET['Hs'];
$tong = $_GET['Tong'];
$days = $_GET['Day'];


//Thưởng
$sql2 = " SELECT sum(`So_tien`) FROM `thuong_phat` WHERE Ma_nv = '$manv' and Loai_hinh = 'Thưởng';";
$result2 = mysqli_query($conn, $sql2) or die("Câu truy vấn sai!");
$thuong = mysqli_fetch_array($result2);
//Phạt
$sql3 = " SELECT sum(`So_tien`) FROM `thuong_phat` WHERE Ma_nv = '$manv' and Loai_hinh = 'Phạt';";
$result3 = mysqli_query($conn, $sql3) or die("Câu truy vấn sai!");
$phat = mysqli_fetch_array($result3);
//Ứng
$sql4 = " SELECT sum(`So_tien`) FROM `ung_luong` WHERE Ma_nv = '$manv';";
$result4 = mysqli_query($conn, $sql4) or die("Câu truy vấn sai!");
$ung = mysqli_fetch_array($result4);
$today = date("Y/m/d");
$thang = date('m');

$sql = " SELECT * FROM nhan_luong where  Ma_nv ='$manv' and MONTH(Thoi_gian) = '$thang' ";
$result = mysqli_query($conn, $sql);
$dem = mysqli_num_rows($result);
if ($dem > 0) {
    echo "<script> alert('Đã tính lương tháng này');</script>";
    echo "<script> window.location = 'ql_tinh_luong.php';</script>";
    exit();
} else {
    $sql = "INSERT INTO nhan_luong values(ID,'$manv','$hs','$days','$thuong[0]','$phat[0]','$ung[0]','$tong',' $today','Chưa thanh toán')";
    $result = mysqli_query($conn, $sql) or die("câu lệnh truy vấn sai");
    if ($result == true) {
        echo "<script> alert('Tính lương thành công, vào Lịch sử lương để xem ');</script>";
        echo "<script> window.location = 'ql_tinh_luong.php';</script>";
    }
}                        


