<?php require 'table.html' ?>
<?php require 'header.php' ?>
<?php require_once "../src/db.php";
$nhan_vien = $conn->query("SELECT * FROM nhan_vien"); ?>
<div class="content-wrapper" style="min-height: 353px;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Thêm Hệ Số Lương</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Lương</a></li>
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
                    <h3 class="card-title">Thêm HS Lương</h3>
                </div>
                <form method="post">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Hệ số</label>
                                    <input type="number" name='heso' required class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Lương</label>
                                    <div class="input-group mb-3">
                                        <input type="number" name='luong' required class="form-control">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Vnđ</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="btn" class="btn btn-primary">Thêm</button>
                    </div>
                    <?php
                    if (isset($_POST['btn'])) {
                        $hs = $_POST['heso'];
                        $luong = $_POST['luong'];
                        $sql = " select * from luong where He_so_luong='$hs'";
                        $result = mysqli_query($conn, $sql);
                        $dem = mysqli_num_rows($result);
                        if ($dem > 0) {
                            echo "Tồn Tại";
                            exit();
                        } else {
                            $sql = "INSERT INTO luong VALUES('$hs','$luong')";
                            $result = mysqli_query($conn, $sql);
                            if ($result == true) {
                                echo "Thêm Thành Công !Hãy vào <a href='ql_luong.php'>Danh sách</a> để xem lại";
                            }
                        }
                    }
                    ?>
                </form>

            </div>
    </section>
</div>

<?php require 'footer.php' ?>