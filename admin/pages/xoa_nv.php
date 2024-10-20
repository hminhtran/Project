<?php
include("../src/db.php");
$manv=$_GET['x'];
$sql="delete from nhan_vien where Ma_nv='$manv'";
$result=mysqli_query($conn, $sql)or die("$sql");
if($result==true)
{
     header("Location:ql_nhan_vien.php");
}
?>