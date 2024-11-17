<?php
include("../src/db.php");
$masp = $_GET['x'];
$sql = "delete from sanpham where Ma_sp='$masp'";
$result = mysqli_query($conn, $sql) or die("$sql");
if ($result == true) {
    header("Location:ql_san_pham.php");
}
?>