<?php require 'header.php' ?>
<?php require_once "../src/db.php";
?>
<?php
$manv = ($_SESSION['Ma_nv']);
?>
<div class="content-wrapper" style="min-height: 353px;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Ứng lương</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Ứng lương</a></li>
                        <li class="breadcrumb-item active">Thêm</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Đổi mật khẩu</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="xu_ly_mk.php">
                    <input type="hidden" name="manv" id="manv" value="<?= $manv?>">
                    <div class="row mb-2">
                    <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nhân viên</label>
                                   <input type="hidden" name="manv" id="manv" value="<?= $manv?>">
                                   <input type="text"  required class="form-control" readonly='true' value="<?= $manv?>">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                    <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Mật khẩu cũ</label>
                                   <input type="password"  name="oldpass" required class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                    <div class="col-sm-6">
                                <div class="form-group">
                                <label for="user_password">Mật khẩu mới <span class="requite">*</span> </label>
                                    <input type="password" id="pass" name="newpass" required class="form-control" onchange="checkPasswordsMatch()">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                    <div class="col-sm-6">
                                <div class="form-group">
                                <label for="user_password">Nhập lại mật khẩu <span class="requite">*</span> </label>
                                <input type="password" id="pass2" name="repass" required class="form-control" onchange="checkPasswordsMatch()">
                                <div id="passwordMatchMessage" style="display: none; color: red;"></div>
                                </div>
                            </div>
                        </div>
                        
                        <button class="btn btn-success" type="submit" ><i><span>Đổi mật khẩu</span></i></button>
                    </form>
                </div>
            </div>
            <?php
            if (isset($_POST['btn'])) {
                $ma = $_POST['manv'];
                $sotien = $_POST['sotien'];
                $ngay = $_POST['ngay_thuc_hien'];
                $kq = " select * from ung_luong where Ma_nv='$ma'";
                $kq_con = mysqli_query($conn, $kq);
                $sql = "INSERT INTO ung_luong VALUES(ID,'$ma','$sotien','$ngay')";
                $result = mysqli_query($conn, $sql);
                if ($result == true) {
                    echo "Thêm Thành Công !Hãy vào <a href='ql_ung_luong.php'>Danh sách </a> để xem lại";
                }
            }
            ?>
    </section>
</div>
<script>
    function checkPasswordsMatch() {
        var password = document.getElementById("pass").value;
        var pass2 = document.getElementById("pass2").value.trim();
        var passwordMatchMessage = document.getElementById("passwordMatchMessage");

        if (pass2 != "") {
            if (password !== pass2) {
                passwordMatchMessage.innerHTML = "Mật khẩu không trùng khớp!";
                passwordMatchMessage.style.color = 'red';
                passwordMatchMessage.style.display = "block"; // Hiển thị thông báo
            } else {
                passwordMatchMessage.innerHTML = "Mật khẩu trùng khớp!";
                passwordMatchMessage.style.color = '#66FF00';
                passwordMatchMessage.style.display = "block"; // Ẩn thông báo
            }
        } else {
            passwordMatchMessage.innerHTML = "Vui lòng nhập lại mật khẩu!!";
            passwordMatchMessage.style.color = 'red';
            passwordMatchMessage.style.display = "block"; // Hiển thị thông báo
        }

    }
</script>
<?php require 'footer.php' ?>