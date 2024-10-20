<?php
include("../src/db.php");
$id=$_GET['x'];
$sql="delete from ung_luong where ID='$id'";
$ketqua=mysqli_query($conn, $sql) or die("Câu truy vấn sai!");
if($ketqua==true)
{
     header("Location:ql_ung_luong.php");
}
?>