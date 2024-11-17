<?php
include("../src/db.php");
$id = $_GET['x'];
$sql = "delete from ke_hang where id='$id'";
$result = mysqli_query($conn, $sql) or die("$sql");
if ($result == true) {
    header("Location:ql_ke.php");
}
?>