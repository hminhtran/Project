<?php require 'header.php' ?>
<?php require_once "../src/db.php";
$bo_phan = $conn->query("SELECT * FROM bo_phan");
$ca_lam_viec = $conn->query("SELECT * FROM ca_lam_viec");
$he_so_luong = $conn->query("SELECT * FROM luong"); ?>
<?php
$manv = $_GET['Ma_nv'];
$sql = "SELECT nhan_vien.*,bo_phan.Ten,ca_lam_viec.Gio_bat_dau,ca_lam_viec.Gio_ket_thuc,luong.Luong_co_ban
        FROM nhan_vien JOIN bo_phan ON nhan_vien.ID_bophan = bo_phan.ID 
        JOIN ca_lam_viec ON ca_lam_viec.ID = nhan_vien.ID_ca_lam 
        JOIN luong ON nhan_vien.He_so_luong = luong.He_so_luong  
        where Ma_nv='$manv'";
$result = mysqli_query($conn, $sql) or die("Câu truy vấn sai!");
while ($row = mysqli_fetch_assoc($result)) {
    $ten = $row['Hoten'];
    $gt = $row['Gioitinh'];
    $ngaysinh = $row['Ngaysinh'];
    $que = $row['Quequan'];
    $sdt = $row['SDT'];
    $bophan = $row['ID_bophan'];
    $tenbophan = $row['Ten'];
    $calam = $row['ID_ca_lam'];
    $gio_lam= $row['Gio_bat_dau'] . ' đến ' . $row['Gio_ket_thuc'];
    $start = $row['Gio_bat_dau'];
    $end = $row['Gio_ket_thuc'];
    $ngaylam = $row['Ngaylamviec'];
    $luong = $row['Luong_co_ban'];
    $hsluong = $row['He_so_luong'];
    $Avatar = $row['Avatar'];
    $qr_banking = $row['qr_banking'];
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Thông tin nhân viên</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="ql_nhan_vien.php">Nhân viên</a></li>
                        <li class="breadcrumb-item active"><?php echo $ten ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Thông tin</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data">
                                <div class="row mb-2">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Mã nhân viên</label>
                                            <input type="text" name="manv" class="form-control" readonly='true'
                                                value="<?php echo $manv ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Họ và tên</label>
                                            <input type="text" name="ten" class="form-control"
                                                value="<?php echo $ten ?>">
                                        </div>
                                    </div>
                                </div>
                                <!-- aa -->
                                <div class="row mb-2">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="hinhdaidien" class="form-label">Hình đại diện</label>
                                            <div class="fileinputimg fileinputimg-new" data-provides="fileinputimg">
                                                <div class="fileinputimg-new thumbnail">
                                                    <input type="hidden" name="id" value="<?= $manv ?>">
                                                    <input id="layimg" type="hidden" value="../../img/<?= $Avatar ?>">
                                                    <img src="../../img/<?= $Avatar ?>" alt=""
                                                        style="max-width: 150px; max-height: 150px;object-fit: contain;">
                                                </div>
                                                <div>
                                                    <div class="fileinputimg-preview fileinputimg-exists thumbnail"
                                                        style="max-width: 300px; max-height: 300px;object-fit: contain;">
                                                    </div>
                                                    <label class="btn btn-success">
                                                        Đổi ảnh <br>
                                                        <input type="file" name="avaimg"
                                                            onchange="showImage(event, '.fileinputimg-img')"
                                                            style="display: none; align:center; width: 250px;">

                                                    </label>
                                                    <label class="btn btn-warning" onclick="deleteImage()">
                                                        <a href="javascript:void(0)" class="fileinputqr-exists"
                                                            data-dismiss="fileinputqr">Xóa</a>
                                                    </label>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="hinhqr" class="form-label">Hình QR ngân hàng</label>
                                            <div class="fileinputqr fileinputqr-new" data-provides="fileinputqr">
                                                <div class="fileinputqr-new thumbnail">
                                                    <input type="hidden" name="id_acc" value="<?= $manv ?>">

                                                    <input id="layqr" type="hidden"
                                                        value="../../qr_banking/<?= $qr_banking ?>">
                                                    <img src="../../qr_banking/<?= $qr_banking ?>" alt=""
                                                        style="max-width: 150px; max-height: 150px;object-fit: contain;">
                                                </div>
                                                <div>
                                                    <div class="fileinputqr-preview fileinputqr-exists thumbnail"
                                                        style="max-width: 300px; max-height: 300px;object-fit: contain;">
                                                    </div>
                                                    <label class="btn btn-success">
                                                        Chọn ảnh<input type="file" name="qrimg"
                                                            onchange="showQR(event, '.fileinputqr-img')"
                                                            style="display: none;">
                                                    </label>
                                                    <label class="btn btn-warning" onclick="deleteQR()">
                                                        <a href="javascript:void(0)" class="fileinputqr-exists"
                                                            data-dismiss="fileinputqr">Xóa</a>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- aa -->


                                <div class="row mb-2">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Giới tính</label><br>
                                            <input type="text" name="gioitinh" class="form-control" readonly='true'
                                                value="<?php echo $gt ?>">

                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Ngày sinh</label>
                                            <input type="date" name="ngay" class="form-control"
                                                value="<?php echo $ngaysinh ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Quê quán</label>
                                            <input type="text" name="que" class="form-control"
                                                value="<?php echo $que ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>SĐT</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="sdt" required
                                                    data-inputmask="'mask': ['999-999-9999 [x99999]', '+099 99 99 9999[9]-9999']"
                                                    data-mask value="0<?php echo $sdt ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Bộ phận</label>
                                            <select name="bophan" id="bophan" value="<?php echo $bophan ?>"
                                                class="form-control">
                                                <option value="<?php echo $bophan ?>"><?php echo $tenbophan ?>
                                                </option>
                                                <?php while ($row = $bo_phan->fetch_assoc()): ?>
                                                    <option value="<?php echo $row['ID'] ?>">
                                                        <?php echo $row['Ten'] ?></option>
                                                <?php endwhile ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Ca làm việc</label>
                                            <select name="calam" id="calam" class="form-control" value="<?php echo $calam ?>" >
                                            <option value="<?php echo $calam ?>"><?php echo $gio_lam?>
                                                </option>
                                                <?php while ($row = $ca_lam_viec->fetch_assoc()): ?>
                                                    <option value="<?php echo $row['ID'] ?>">
                                                        <?php echo $row['Gio_bat_dau'] . ' đến ' . $row['Gio_ket_thuc'] ?>
                                                    </option>
                                                <?php endwhile ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Lương</label>
                                            <div class="input-group mb-3">
                                                <input name='luong' class="form-control" readonly
                                                    value="<?php echo number_format($luong) ?>">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">Vnđ</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Ngày làm việc</label>
                                            <input type="date" name="ngay_lam" value="<?php echo $ngaylam ?>"
                                                class="form-control datetimepicker-input" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-10">
                                        <a href="xoa_nv.php?x=<?php echo $manv ?>" class="text-danger">Xoá nhân viên</a>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="submit" name="btn" class="btn btn-primary" value = "Cập nhật">
                                    </div>
                                </div>
                                <?php
                                if (isset($_POST['btn'])) {
                                    $ten = $_POST['ten'];
                                    $gt = $_POST['gioitinh'];
                                    $ngaysinh = $_POST['ngay'];
                                    $que = $_POST['que'];
                                    $sdt = $_POST['sdt'];
                                    $bophan = $_POST['bophan'];
                                    $ca_lam = $_POST['calam'];
                                    $ngaylam = $_POST['ngay_lam'];
                                    $luong = "";

                                    if ($bophan == 1) {
                                        $luong = 1;
                                    } elseif ($bophan == 3) {
                                        if ($calam == 1 or $calam == 2) {
                                            $luong = 2;
                                        } else {
                                            $luong = 4;
                                        }
                                    } else {
                                        if ($calam == 1 or $calam == 2) {
                                            $luong = 3;
                                        } else {
                                            $luong = 4;
                                        }
                                    }

                                    if (!empty($_FILES['avaimg']['tmp_name']) && !empty($_FILES['qrimg']['tmp_name'])) // đổi cả 2 
                                    {
                                        $qrimg_name = $_FILES['qrimg']['name'];
                                        $qrimg_size = $_FILES['qrimg']['size'];
                                        $qrimg_tmp = $_FILES['qrimg']['tmp_name'];
                                        $qrimg_ext = pathinfo($qrimg_name, PATHINFO_EXTENSION);
                                        list($width, $height) = getimagesize($qrimg_tmp);
                                        $avaimg_name = $_FILES['avaimg']['name'];
                                        $avaimg_size = $_FILES['avaimg']['size'];
                                        $avaimg_tmp = $_FILES['avaimg']['tmp_name'];
                                        $imgava_ext = pathinfo($avaimg_name, PATHINFO_EXTENSION);
                                        $nameavt = time()."_".$avaimg_name;
                                        $nameqr = $ma."_".$qrimg_name;
                                        list($width, $height) = getimagesize($avaimg_tmp);
                                        if (($imgava_ext == "jpg" || $imgava_ext == 'jpeg' || $imgava_ext == "png") && ($qrimg_ext == "jpg" || $qrimg_ext == 'jpeg' || $qrimg_ext == "png")) {
                                            if (($avaimg_size <= 2e+6 && $width < 2701 && $height < 2701) && ($qrimg_ext == "jpg" || $qrimg_ext == 'jpeg' || $qrimg_ext == "png")) {
                                                $select_query = "SELECT * FROM `nhan_vien` WHERE id=$manv";
                                                $result = mysqli_query($conn, $select_query);
                                                $pre_imgava = $Avatar;
                                                $pre_imgqr = $qr_banking;
                                                unlink("../../qr_banking/" . $pre_imgqr);
                                                unlink("../../img/" . $pre_imgava);
                                                $query = "UPDATE nhan_vien SET Hoten='$ten',Avatar ='$nameavt',Ngaysinh='$ngaysinh',Quequan='$que',SDT='$sdt',ID_bophan='$bophan',
                                            ID_ca_lam='$ca_lam',He_so_luong='$luong',qr_banking = '$nameqr',Ngaylamviec='$ngaylam' WHERE Ma_nv='$manv'";
                                            $result_query = mysqli_query($conn, $query);
                                                if ($result_query == true  && move_uploaded_file($avaimg_tmp, "../../img/" . $nameavt) && move_uploaded_file($qrimg_tmp, "../../qr_banking/" . $nameqr)) {
                                                    echo'<script>
                                                    alert("Thay đổi thành công");
                                                    window.location.href = "chi_tiet_nv.php?Ma_nv='.$manv.'";
                                                    </script>';	
                                                }
                                                else 
                                                    {
                                                        echo'<script>
                                                        alert("Thất bại");
                                                        </script>';	
                                                    }
                                        


                                            }
                                        }

                                    }
                                    else if (!empty($_FILES['avaimg']['tmp_name']) && empty($_FILES['qrimg']['tmp_name'])) //update avatar
                                    {
                                    
                                        $avaimg_name = $_FILES['avaimg']['name'];
                                        $avaimg_size = $_FILES['avaimg']['size'];
                                        $avaimg_tmp = $_FILES['avaimg']['tmp_name'];
                                        $imgava_ext = pathinfo($avaimg_name, PATHINFO_EXTENSION);
                                        $nameavt = time()."_".$avaimg_name;
                                       
                                        list($width, $height) = getimagesize($avaimg_tmp);
                                    
                                        if ($imgava_ext == "jpg" || $imgava_ext == 'jpeg' || $imgava_ext == "png") {
                                            if ($avaimg_size <= 2e+6 && $width < 2701 && $height < 2701) {
                                                $select_query = "SELECT * FROM `nhan_vien` WHERE id=$manv";
                                                $result = mysqli_query($conn, $select_query);
                                                $pre_img = $Avatar;
                                                unlink("../../img/" . $pre_img);
                                                $query = "UPDATE nhan_vien SET Hoten='$ten',Avatar ='$nameavt',Ngaysinh='$ngaysinh',Quequan='$que',SDT='$sdt',ID_bophan='$bophan',
                                                ID_ca_lam='$ca_lam',He_so_luong='$luong',Ngaylamviec='$ngaylam' WHERE Ma_nv='$manv'";
                                                $result_query = mysqli_query($conn, $query);
                                                if($result_query == true  && move_uploaded_file($avaimg_tmp, "../../img/" . $nameavt) ) {
                                                    echo'<script>
                                                    alert("Thay đổi thành công");
                                                    window.location.href = "chi_tiet_nv.php?Ma_nv='.$manv.'";
                                                    </script>';	
                                                    echo $query; 
                                                }
                                                else 
                                                    {
                                                        echo'<script>
                                                        alert("Thất bại");
                                                        </script>';	
                                                    }
                                    
                                   
                                    }
                                }
                                }
                                else if (empty($_FILES['avaimg']['tmp_name']) && !empty($_FILES['qrimg']['tmp_name'])) //update qr
                                {
                                    $qrimg_name = $_FILES['qrimg']['name'];
                                    $qrimg_size = $_FILES['qrimg']['size'];
                                    $qrimg_tmp = $_FILES['qrimg']['tmp_name'];
                                    $qrimg_ext = pathinfo($qrimg_name, PATHINFO_EXTENSION);
                                    list($width, $height) = getimagesize($qrimg_tmp);
                                    $nameqr = $ma."_".$qrimg_name;
                                
                                    if ($qrimg_ext == "jpg" || $qrimg_ext == 'jpeg' || $qrimg_ext == "png") {
                                        if ($qrimg_size <= 2e+6 && $width < 2701 && $height < 2701) {
                                            $select_query = "SELECT * FROM `nhan_vien` WHERE id=$manv";
                                            $result = mysqli_query($conn, $select_query);
                                            $pre_img = $qr_banking;
                                            unlink("../../qr_banking/" . $pre_img);
                                            $query = "UPDATE nhan_vien SET Hoten='$ten',Ngaysinh='$ngaysinh',Quequan='$que',SDT='$sdt',ID_bophan='$bophan',
                                            ID_ca_lam='$ca_lam',He_so_luong='$luong',qr_banking ='$nameqr',Ngaylamviec='$ngaylam' WHERE Ma_nv='$manv'";
                                            $result_query = mysqli_query($conn, $query);
                                            if($result_query == true  && move_uploaded_file($qrimg_tmp, "../../qr_banking/" . $nameqr) ) {
                                               echo'<script>
                                                alert("Thay đổi thành công");
                                                window.location.href = "chi_tiet_nv.php?Ma_nv='.$manv.'";
                                                </script>';	
                                                echo $query; 
                                            }
                                            else 
                                                {
                                                    echo $query;
                                                }
                                

                                    } 
                                    }
                                } 
                                
                                else if (empty($_FILES['avaimg']['tmp_name']) && empty($_FILES['qrimg']['tmp_name']))//không update ảnh 
                                {	
                                    $sql = "UPDATE nhan_vien SET Hoten='$ten',Ngaysinh='$ngaysinh',Quequan='$que',SDT='$sdt',ID_bophan='$bophan',ID_ca_lam='$ca_lam',He_so_luong='$luong',Ngaylamviec='$ngaylam' WHERE Ma_nv='$manv'";
                                    $result = mysqli_query($conn, $sql) or die("câu lệnh truy vấn sai");
                                    if ($result == true) {
                                      
                                        echo'<script>
                                        alert("Thay đổi thành công");
                                        window.location.href = "chi_tiet_nv.php?Ma_nv='.$manv.'";
                                        </script>';	
                                    }
                                    else{
                                        echo'<script>
                                        alert("Thất bại");
                                        </script>';	
                                 
                                
                                }
                            }
                        }       
                               

                                
                               
                                ?>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Thưởng</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Nhân viên</th>
                                        <th>Số tiền</th>
                                        <th>Ngày thực hiện</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $year = date('Y');
                                    $month = date('m');
                                    $sql = " select * from thuong_phat where Ma_nv = '$manv' and Loai_hinh = 'Thưởng' and MONTH(Ngay_thuc_hien) = '$month' and YEAR(Ngay_thuc_hien) ='$year'";
                                    $result = mysqli_query($conn, $sql) or die("Câu lệnh truy vấn sai");
                                    $thuong = 0;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $ten; ?></td>
                                            <td><?php echo number_format($row['So_tien']); ?><i> đồng</i></td>
                                            <td><?php echo $row['Ngay_thuc_hien']; ?></td>
                                        </tr>
                                        <?php
                                        $thuong = $row['So_tien'];
                                        if ($thuong == null) {
                                            $thuong = 0;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Phạt</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Nhân viên</th>
                                        <th>Số tiền</th>
                                        <th>Ngày</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = " select * from thuong_phat where Ma_nv = '$manv' and Loai_hinh = 'Phạt' and MONTH(Ngay_thuc_hien) = '$month' and YEAR(Ngay_thuc_hien) ='$year'";
                                    $result = mysqli_query($conn, $sql) or die("Câu lệnh truy vấn sai");
                                    $phat = 0;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $ten; ?></td>
                                            <td><?php echo number_format($row['So_tien']); ?><i> đồng</i></td>
                                            <td><?php echo $row['Ngay_thuc_hien']; ?></td>
                                        </tr>
                                        <?php $phat = $row['So_tien'];
                                        if ($phat == null) {
                                            $phat = 0;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Ứng lương</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Nhân viên</th>
                                        <th>Số tiền</th>
                                        <th>Ngày thực hiện</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "select * from ung_luong where Ma_nv = '$manv'and MONTH(Ngay_ung) = '$month' and YEAR(Ngay_ung) ='$year'";
                                    $result = mysqli_query($conn, $sql) or die("Câu lệnh truy vấn sai");
                                    global $ung;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $ten; ?></td>
                                            <td><?php echo number_format($row['So_tien']); ?><i> đồng</i></td>
                                            <td><?php echo $row['Ngay_ung']; ?></td>
                                        </tr>
                                        <?php $ung = $row['So_tien'];
                                        if ($ung == null) {
                                            $ung = 0;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Số ngày đi làm</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Nhân viên</th>
                                        <th>Số ngày</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "select * from cham_cong where Ma_nv = '$manv' and Tinh_trang = 'Đi làm' and MONTH(Ngay) = '$month' and YEAR(Ngay) ='$year'";
                                    $result = mysqli_query($conn, $sql) or die("Câu lệnh truy vấn sai");
                                    if ($result) {
                                        $days = mysqli_num_rows($result);
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $ten; ?></td>
                                        <td><?php echo $days; ?></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
    var currentImage = '';
    var currentQR = '';
    function showImage(event) {
        var input = event.target;
        var reader = new FileReader();

        // Đọc file
        reader.onload = function () {
            var dataURL = reader.result;
            var preview = document.querySelector('.fileinputimg-new img');

            // Cập nhật hình ảnh mới
            preview.src = dataURL;

            // Lưu tên của hình ảnh hiện tại vào biến toàn cục
            currentImage = input.files[0].name;
        };

        // Đọc file dưới dạng URL
        reader.readAsDataURL(input.files[0]);
    }
    function showQR(event) {
        var input = event.target;
        var reader = new FileReader();

        // Đọc file
        reader.onload = function () {
            var dataURL = reader.result;
            var preview = document.querySelector('.fileinputqr-new img');

            // Cập nhật hình ảnh mới
            preview.src = dataURL;

            // Lưu tên của hình ảnh hiện tại vào biến toàn cục
            currentQR = input.files[0].name;
        };

        // Đọc file dưới dạng URL
        reader.readAsDataURL(input.files[0]);

    }
    function deleteImage() {
        // Đặt lại giá trị của input file thành rỗng
        var input = document.querySelector('input[type="file"]');
        input.value = '';

        // Cập nhật hình ảnh hiển thị về hình ảnh mặc định hoặc ảnh cũ
        var defaultImageUrl = document.getElementById('layimg').value;
        var preview = document.querySelector('.fileinputimg-new img');
        preview.src = defaultImageUrl;

        // Kiểm tra nếu có hình ảnh mới được tải lên, gán tên của hình ảnh mới vào biến toàn cục
        if (currentImage) {
            document.getElementById('new_image_name').value = currentImage;
        } else {
            // Nếu không có hình ảnh mới, gán tên của hình ảnh cũ cho trường ẩn new_image_name
            document.getElementById('new_image_name').value = '';
        }
    }
    function deleteQR() {
        // Đặt lại giá trị của input file thành rỗng
        var input = document.querySelector('input[type="file"]');
        input.value = '';

        // Cập nhật hình ảnh hiển thị về hình ảnh mặc định hoặc ảnh cũ
        var defaultQR = document.getElementById('layqr').value;
        var preview = document.querySelector('.fileinputqr-new img');
        preview.src = defaultQR;

        // Kiểm tra nếu có hình ảnh mới được tải lên, gán tên của hình ảnh mới vào biến toàn cục
        if (currentQR) {
            document.getElementById('new_qr_name').value = currentQR;
        } else {
            // Nếu không có hình ảnh mới, gán tên của hình ảnh cũ cho trường ẩn new_image_name
            document.getElementById('new_qr_name').value = '';
        }
    }

</script>

<?php require 'footer.php' ?>