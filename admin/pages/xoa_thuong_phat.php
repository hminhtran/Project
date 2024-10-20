<?php
include("../src/db.php");
$id=$_GET['x'];
$sql="delete from thuong_phat where ID_thuong_phat='$id'";
$ketqua=mysqli_query($conn, $sql) or die("Câu truy vấn sai!");
if($ketqua==true)
{
     header("Location:ql_thuong_phat.php");
}
?>