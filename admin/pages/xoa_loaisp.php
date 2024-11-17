<?php
include("../src/db.php");
$id_loai = $_GET['x'];
$sql = "delete from loai_sp where id_loai='$id_loai'";
$result = mysqli_query($conn, $sql) or die("$sql");
if ($result == true) {
    header("Location:ql_loaisp.php");
}
?>