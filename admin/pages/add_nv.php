<?php require 'header.php' ?>
<?php
require '../vendor/autoload.php';
use Endroid\QrCode\QrCode;
?>
<?php require_once "../src/db.php";

$bo_phan = $conn->query("SELECT * FROM bo_phan");
$ca_lam_viec = $conn->query("SELECT * FROM ca_lam_viec");
$luong = $conn->query("SELECT * FROM luong"); ?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Thêm nhân viên</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Nhân viên</a></li>
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
                    <h3 class="card-title">Thêm nhân viên</h3>

                </div>
              <form method="post" enctype="multipart/form-data">>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Mã nhân viên(Tên đăng nhập)</label>
                                    <input type="text" name="manv" class="form-control" placeholder="Mã nhân viên" required value="NV">
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Mật khẩu</label>
                                    <input type="password" name="txtpass" class="form-control" placeholder="Mật khẩu" >
                                </div>
                         
                            </div>
                            
                        </div>
                        <div class="row mb-2">
                        <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tên nhân viên</label>
                                    <input type="text" name="ten" class="form-control" required placeholder="Tên nhân viên">
                                </div>
                                </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Giới tính</label><br>
                                    <input type="radio" name="gioitinh" value="Nam" checked="checked">
                                    <label>Nam</label>
                                    <input type="radio" name="gioitinh" value="Nữ">
                                    <label>Nữ</label>
                               
                            </div>
                           
                            </div>
                        </div>
                        <div class="row mb-2">
                        <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Ngày sinh</label>
                                    <input type="date" name="ngay" required class="form-control">
                                </div>
                                </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Quê quán</label>
                                    <input type="text" name="que" required class="form-control" placeholder="Quê quán">
                                </div>
                            </div>
                           
                        </div>
                        <div class="row mb-2">
                        <div class="col-sm-6">
                                <div class="form-group">
                                    <label>SĐT</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="sdt" required>
                                    </div>
                                </div>
                            </div>
                           
                       
                        <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Bộ phận</label>
                                    <select name="bophan" id="bophan" required class="form-control">
                                        <?php while ($row = $bo_phan->fetch_assoc()) : ?>
                                            <option value="<?php echo $row['ID'] ?>"><?php echo $row['Ten'] ?></option>
                                        <?php endwhile ?>
                                    </select>
                                </div>
                            </div>
                            </div>
                            
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
                                    <label>Ngày làm việc</label>
                                    <input type="date" name="ngay_lam" required class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                        <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Ảnh đại diện</label>
                                    <input name="avatar" type="file" class="form-control"  aria-describedby="textHelp">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                     <div class="form-group">
                                    <label>Ảnh QR ngân hàng</label>
                                    <input name="qr_banking" type="file" class="form-control"  aria-describedby="textHelp">
                                      </div>
                            </div>
                        </div>
                        <button type="submit" name="btn" class="btn btn-primary">Thêm</button>
                        
                       
                    </div>
                    </div>
                    </div>
                                       
                    
                    <?php
                    if (isset($_POST['btn'])) {
                        $ma = $_POST['manv'];
                        $pass = md5($_POST['txtpass']);
                        $ten = $_POST['ten'];
                        $gt = $_POST['gioitinh'];
                        $ngay = $_POST['ngay'];
                        $qq = $_POST['que'];
                        $sdt = $_POST['sdt'];
                        $bophan = $_POST['bophan'];
                        $calam = $_POST['calam'];
                        $ngaylam = $_POST['ngay_lam'];
                        $qrname = "../../qrcode/".$ma.".png";
                        $qrCode = new QrCode("https://minhngoccoffe.000webhostapp.com/employees/pages/add_cham_cong.php");
                        $qrCode->writeFile($qrname);
                        $qr = $ma . ".png";
                        $typeavt = $_FILES['avatar']['type'];
                        $nameavt = $_FILES['avatar']['name'];
                        $tmp_nameavt = $_FILES['avatar']['tmp_name'];
                        $typeqr = $_FILES['qr_banking']['type'];
                        $nameqr = $_FILES['qr_banking']['name'];
                        $tmp_nameqr = $_FILES['qr_banking']['tmp_name'];
                        $luong = "";
                        if ($bophan == 2) {
                            $luong = 1;
                           
                        } elseif ($bophan == 3) {
                                $luong = 2;
                           
                        } elseif ($bophan == 4){
                                $luong = 3;
                           
                        }
                        // Câu SQL lấy danh sách
                        $sql = " select * from nhan_vien where Ma_nv='$ma'";
                        // Thực thi câu truy vấn và gán vào $result
                        $result = mysqli_query($conn, $sql);
                        // Kiểm tra số lượng record trả về có lơn hơn 0
                        // Nếu lớn hơn tức là có kết quả, ngược lại sẽ không có kết quả
                        $dem = mysqli_num_rows($result);
                        if ($dem > 0) {
                            echo "Mã Nhân Viên Đã Tồn Tại";
                            exit();
                        } 
                        else {
                            if (($typeavt == 'image/jpeg' || $typeavt == 'image/png') && ($typeqr == 'image/jpeg' || $typeqr == 'image/png')) 
                                {	
                                $nameavt = time()."_".$nameavt;
                                $nameqr = $ma."_".$nameqr;
                                if(move_uploaded_file($tmp_nameavt,"../../img/".$nameavt) && move_uploaded_file($tmp_nameqr,"../../qr_banking/".$nameqr) )
                                {
                                $sql = "INSERT INTO nhan_vien VALUES('$ma','$pass','$nameavt','$ten','$gt','$ngay','$qq','$sdt','$bophan','$calam','$luong','$qr','$nameqr','$ngaylam')";
                                    $result = mysqli_query($conn, $sql);
                                if ($result == true) {
                                echo "Thêm Thành Công !Hãy vào <a href='ql_nhan_vien.php'>Danh sách nhân viên </a> để xem lại";
                                }
                                else
                                {
                                    echo "Không thêm được";
                                }
                            }
                            else
                            {
                                echo"Không upload ảnh được";
                            }
                        
                        }
                        else
                        {
                            echo "Không đúng định dạng ảnh";
                        }
                    }
                }
                
                    ?>
                </form>

            </div>
    </section>
</div>

<?php require 'footer.php' ?>