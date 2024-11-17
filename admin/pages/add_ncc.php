<?php require 'header.php' ?>
<?php require_once "../src/db.php";
$bo_phan = $conn->query("SELECT * FROM bo_phan"); ?>
<div class="content-wrapper" style="min-height: 353px;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Nhà cung cấp</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Nhà cung cấp</a></li>
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
                    <h3 class="card-title">Quản lý Nhà cung cấp</h3>
                </div>
                <form method="post">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tên Nhà Cung Cấp</label>
                                    <input type="text" name='ten' required class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Địa chỉ</label>
                                    <input type="text" name='diachi' required class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Số điện thoại</label>
                                    <input type="number" name='phone' required class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name='email' required class="form-control">
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="btn" class="btn btn-primary">Thêm</button>
                    </div>
                </form>
                <?php
                if (isset($_POST['btn'])) {
                    $ten = $_POST['ten'];
                    $phone = $_POST['phone'];
                    $email = $_POST['email'];
                    $diachi = $_POST['diachi'];
                    $sql = " select * from nhacungcap where TenNCC = '$ten'";
                    $result = mysqli_query($conn, $sql);
                    $dem = mysqli_num_rows($result);
                    if ($dem > 0) {
                        echo "Tồn tại";
                        exit();
                    } else {
                        $sql = "INSERT INTO nhacungcap (`Id`, `TenNCC`, `DienThoai`, `Email`, `DiaChi`) VALUES(NULL,'$ten','$phone','$email','$diachi')";
                        $result = mysqli_query($conn, $sql);
                        if ($result == true) {
                            echo "<a href='ql_ncc.php'>Danh sách</a>";
                        }
                    }
                }
                ?>
            </div>
    </section>
</div>
<?php require 'footer.php' ?>