<?php
include("../src/db.php");
$id=$_GET['x'];
$sql="delete from nghi_viec where ID='$id'";
$results=mysqli_query($conn, $sql) or die("Câu truy vấn sai!");
if($results==true)
{
     header("Location:ql_nghi_viec.php");
}
?>