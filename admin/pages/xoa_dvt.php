<?php
include("../src/db.php");
$id = $_GET['x'];
$sql = "delete from donvitinh where Id='$id'";
$result = mysqli_query($conn, $sql) or die("$sql");
if ($result == true) {
    header("Location:ql_dvt.php");
}
?>