<?php
include("../src/db.php");
$manv=$_POST['manv'];
$pre_pass = md5($_POST['oldpass']);
$new_pass = md5($_POST['newpass']);
$sql = "SELECT  * from nhan_vien  where Ma_nv='$manv'";
$result = mysqli_query($conn, $sql) or die("$sql");
while ($row = mysqli_fetch_assoc($result)) {
    $old_pass = $row['password'];
}
if ($old_pass != $pre_pass) 
{
    echo'<script>
    alert("Sai mật khẩu cũ");
    window.location.href = "doi_mk.php";
    </script>';
}
else if ($new_pass == $pre_pass)
{
    echo'<script>
    alert("Mật khẩu mới và mật khẩu cũ trùng nhau, hãy nhập lại");
    window.location.href = "doi_mk.php";
    </script>';
}
else
{
    $sqlchange = "UPDATE nhan_vien SET `password`='$new_pass' WHERE Ma_nv='$manv'";
    $result = mysqli_query($con, $sqlchange) or die("câu lệnh truy vấn sai");
    if ($result == true) {
      
        echo '<script>
        alert("Thay đổi thành công"); 
        window.location.href = "doi_mk.php";
        </script> ';
    }
    else
        {
            echo'<script>
            alert("Thay đổi thất bại");
            window.location.href = "doi_mk.php";
            </script>';
        }
}
?>
