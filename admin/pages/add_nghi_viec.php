
<?php require 'header.php' ?>
<?php require_once "../src/db.php";
$nhan_vien = $conn->query("SELECT * FROM nhan_vien"); ?>
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
                                    <select name="manv" required class="form-control">
                                        <option selected>------Chọn Nhân Viên-----</option>
                                        <?php while ($row = $nhan_vien->fetch_assoc()) : ?>
                                            <option value="<?php echo $row['Ma_nv'] ?>"><?php echo $row['Hoten'] ?></option>
                                        <?php endwhile ?>
                                    </select>
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
                        $kq = " select * from nghi_viec where Ma_nv='$ma'";
                        $kq_con = mysqli_query($conn, $kq);
                        $dem = mysqli_num_rows($kq_con);
                        if ($dem > 0) {
                            echo "Tồn Tại";
                            exit();
                        } else {
                            $sql = "INSERT INTO nghi_viec VALUES('','$ma','$ngay','$denngay','$lido')";
                            $result = mysqli_query($conn, $sql);
                            if ($result == true) {
                                echo "Thêm Thành Công !Hãy vào <a href='ql_nghi_viec.php'>Danh sách</a> để xem lại";
                            }
                        }
                    }
                    ?>
                </form>
            </div>
    </section>
</div>

<?php require 'footer.php' ?>