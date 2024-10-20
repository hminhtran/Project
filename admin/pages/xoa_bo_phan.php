<?php
include("../src/db.php");
$id=$_GET['x'];

$sql="delete from bo_phan where ID='$id'";
$ketqua=mysqli_query($conn, $sql) or die("Câu truy vấn sai!");
if($ketqua==true)
{
     header("Location:ql_bo_phan.php");
}
?>