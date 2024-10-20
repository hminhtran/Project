<?php require 'header.php' ?>
<?php require_once "../src/db.php";
?>
<?php
$manv = ($_SESSION['Ma_nv']);
$tennv = ($_SESSION['Ho_ten']);
$ca_lam_viec = $conn->query("SELECT * FROM ca_lam_viec");
?>
<?php require_once "../src/db.php";

$nhan_vien = $conn->query("SELECT * FROM nhan_vien"); ?>
<div class="content-wrapper" style="min-height: 353px;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Chấm công</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Chấm công</a></li>
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
                    <h3 class="card-title">Quản lý chấm công</h3>
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
                                    <label>Ngày</label>
                                    <input type="date" name='ngay' required class="form-control" value="">
                                </div>
                            </div>
                        </div>
                        <input name="timein" type="hidden" class="form-control" id="timeInput" value="" aria-describedby="textHelp" readonly>
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <div class="form-group">
                                <label>Ca làm việc</label>
                                    <select name="calam" id="calam" required class="form-control">
                                        <?php while ($row = $ca_lam_viec->fetch_assoc()) : ?>
                                            <option value="<?php echo $row['ID'] ?>"><?php echo $row['Gio_bat_dau'] . ' đến ' . $row['Gio_ket_thuc'] ?></option>
                                        <?php endwhile ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Lí do</label>
                                    <input type="text" name='li_do' required class="form-control">
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="btn" class="btn btn-primary">Gửi</button>
                    </div>
                    <?php
                    if (isset($_POST['btn'])) {
                        $ma = $_POST['manv'];
                        $ngay = $_POST['ngay'];
                        $ca = $_POST['calam'];
                        $lido = $_POST['li_do'];
                        $gio_gui = $_POST['timein'];
                        $kq = " select * from yeu_cau_cham_cong where ngay='$ngay' and Ma_nv = '$ma'";
                        $kq_con = mysqli_query($conn, $kq);
                        $dem = mysqli_num_rows($kq_con);
                        if ($dem > 0) {
                            echo "<script> alert('Đã yêu cầu ngày này rồi');</script>";
                            echo "<script> window.location = 'add_cham_cong2.php';</script>";
                            exit();
                        } else {
                            $sql = "INSERT INTO yeu_cau_cham_cong VALUES(id_yeu_cau,'$ma','$ngay','$ca','$gio_gui','$lido','Chờ duyệt')";
                            $result = mysqli_query($conn, $sql);
                            if ($result == true) {
                                echo "<script> alert('Đã gửi yêu cầu thành công');</script>";
                                echo "<script> window.location = 'add_cham_cong2.php';</script>";
                            }
                        }
                    }
                    ?>
                </form>

            </div>
    </section>
    <script>
    window.onload = function() {
        // Lấy thời gian hiện tại
        var now = new Date();
        // Định dạng thời gian thành chuỗi giờ, phút và giây
        var formattedTime = ('0' + now.getHours()).slice(-2) + ':' +
                            ('0' + now.getMinutes()).slice(-2) + ':' +
                            ('0' + now.getSeconds()).slice(-2);

        // Gán giá trị cho thuộc tính value của thẻ input
        document.getElementById('timeInput').value = formattedTime;
    };
</script>
</div>

<?php require 'footer.php' ?>