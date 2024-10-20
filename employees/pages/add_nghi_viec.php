
<?php require 'header.php' ?>
<?php require_once "../src/db.php";
?>
<?php
$manv = ($_SESSION['Ma_nv']);
$tennv = ($_SESSION['Ho_ten']);
?>
<div class="content-wrapper" style="min-height: 353px;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Nghỉ việc</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Nghỉ việc</a></li>
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
                    <h3 class="card-title">Quản lý nghỉ việc</h3>
                </div>
                <form method="post">
                    <div class="card-body">
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
                                    <label>Lí do</label>
                                    <input type="text" name='lido' class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Ngày nghỉ</label>
                                    <input type="date" name="ngaynghi" required class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Đến</label>
                                    <input type="date" name="denngay" required class="form-control">
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="btn" class="btn btn-primary">Thêm</button>
                    </div>
                    <?php
                    if (isset($_POST['btn'])) {
                        $ma = $_POST['manv'];
                        $ngay = $_POST['ngaynghi'];
                        $denngay = $_POST['denngay'];
                        $lido = $_POST['lido'];
                            $sql = "INSERT INTO nghi_viec VALUES('','$ma','$ngay','$denngay','$lido','Chờ duyệt')";
                            $result = mysqli_query($conn, $sql);
                            if ($result == true) {
                                echo "<script> alert('Đã gửi yêu cầu thành công');</script>";
                                echo "<script> window.location = 'ql_cham_cong.php';</script>";
                            }
                        }
                    
                    ?>
                </form>
            </div>
    </section>
</div>

<?php require 'footer.php' ?>