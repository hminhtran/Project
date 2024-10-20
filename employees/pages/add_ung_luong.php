
<?php require 'header.php' ?>
<?php
$manv = ($_SESSION['Ma_nv']);
$tennv = ($_SESSION['Ho_ten']);
?>
<?php require_once "../src/db.php";
$bo_phan = $conn->query("SELECT * FROM bo_phan");
$ca_lam_viec = $conn->query("SELECT * FROM ca_lam_viec");
$nhan_vien = $conn->query("SELECT * FROM nhan_vien");  ?>
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
                    <h3 class="card-title">Thêm Ứng lương</h3>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <div class="form-group">
                                <label>Nhân viên</label>
                                    <input type="hidden" name="manv" id="manv" value="<?= $manv?>">
                                   <input type="text"  required class="form-control" readonly='true' value="<?= $manv?>- <?= $tennv?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Số tiền</label>
                                    <div class="input-group mb-3">
                                        <input type="number" name='sotien' required class="form-control">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Vnđ</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                                 <div class="form-group">
                                    <label>Lí do</label>
                                    <div class="input-group mb-3">
                                        <input type="text" name='li_do' required class="form-control">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Vnđ</span>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <button type="submit" name="btn" class="btn btn-primary">Thêm</button>
                    </form>
                </div>
            </div>
            <?php
            if (isset($_POST['btn'])) {
                $ma = $_POST['manv'];
                $sotien = $_POST['sotien'];
                $ngay = date("Y-m-d"); // Lấy ngày hôm nay dưới định dạng 'YYYY-MM-DD'
                $lido = $_POST['li_do'];
                $query = "SELECT * FROM ung_luong WHERE Ma_nv='$ma' AND MONTH(Ngay_ung) = MONTH('$ngay') AND YEAR(Ngay_ung) = YEAR('$ngay')";
                $result = mysqli_query($conn, $query);             
                if (mysqli_num_rows($result) > 0) {
                    echo "<script> alert('Tháng này đã ứng rồi');</script>";
                    echo "<script> window.location = 'ql_ung_luong.php';</script>";
                } else {
                    $sql = "INSERT INTO yeu_cau_ung_luong VALUES('','$ma','$ngay','$sotien','$lido','Chờ duyệt')";
                    $result = mysqli_query($conn, $sql);
                    if ($result == true) {
                        echo "<script> alert('Đã gửi yêu cầu thành công');</script>";
                        echo "<script> window.location = 'ql_ung_luong.php';</script>";
                    }
                    else
                    {
                        echo $sql;
                    }
                }   
             
            }
            ?>
    </section>
</div>
<?php require 'footer.php' ?>