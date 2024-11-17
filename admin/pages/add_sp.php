<?php require 'header.php' ?>
<?php
require '../vendor/autoload.php';
use Endroid\QrCode\QrCode;
?>
<?php require_once "../src/db.php";

$ncc = $conn->query("SELECT * FROM nhacungcap");
$loai = $conn->query("SELECT * FROM loai_sp");
$donvi = $conn->query("SELECT * FROM donvitinh"); ?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Tạo Sản Phẩm Mới</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Sản phẩm</a></li>
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
                    <h3 class="card-title">Thêm sản phẩm</h3>

                </div>
                <form method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Mã sản phẩm</label>
                                    <input type="text" name="masp" class="form-control" placeholder="Mã sản phẩm"
                                        required>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tên Sản Phẩm</label>
                                    <input type="text" name="tensp" class="form-control" placeholder="Tên sản phẩm">
                                </div>

                            </div>

                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Hình ảnh</label>
                                    <input name="imgsp" type="file" class="form-control" aria-describedby="textHelp">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nhà cung cấp</label>
                                    <select name="ncc" id="ncc" required class="form-control">
                                        <?php while ($row = $ncc->fetch_assoc()): ?>
                                            <option value="<?php echo $row['Id'] ?>"><?php echo $row['TenNCC'] ?>
                                            </option>
                                        <?php endwhile ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Loại sản phẩm</label>
                                    <select name="dvt" id="dvt" required class="form-control">
                                        <?php while ($row = $donvi->fetch_assoc()): ?>
                                            <option value="<?php echo $row['Id'] ?>"><?php echo $row['DonVi'] ?>
                                            </option>
                                        <?php endwhile ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Đơn vị tính</label>
                                    <select name="loai" id="loai" required class="form-control">
                                        <?php while ($row = $loai->fetch_assoc()): ?>
                                            <option value="<?php echo $row['id_loai'] ?>"><?php echo $row['ten_loai'] ?>
                                            </option>
                                        <?php endwhile ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <div class=" form-group">
                                    <label>Giá mua</label>
                                    <input type="text" name="giamua" required class="form-control"
                                        placeholder="Giá Mua">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class=" form-group">
                                    <label>Giá bán</label>
                                    <input type="text" name="giaban" required class="form-control"
                                        placeholder="Giá Bán">
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="btn" class="btn btn-primary">Thêm</button>


                    </div>
            </div>
        </div>


        <?php
        if (isset($_POST['btn'])) {
            $ma = $_POST['masp'];
            $tensp = $_POST['tensp'];
            $ncc = $_POST['ncc'];
            $dvt = $_POST['dvt'];
            $loai = $_POST['loai'];
            $giamua = $_POST['giamua'];
            $giaban = $_POST['giaban'];

            $typeimg = $_FILES['imgsp']['type'];
            $nameimg = $_FILES['imgsp']['name'];
            $tmp_nameimg = $_FILES['imgsp']['tmp_name'];
            // $typeqr = $_FILES['qr_banking']['type'];
            // $nameqr = $_FILES['qr_banking']['name'];
            // $tmp_nameqr = $_FILES['qr_banking']['tmp_name'];
            // $qrname = "../../qrcode/" . $ma . ".png";
            // $qrCode = new QrCode("https://minhngoccoffe.000webhostapp.com/employees/pages/add_cham_cong.php");
            // $qrCode->writeFile($qrname);
            // $qr = $ma . ".png";
        

            // Câu SQL lấy danh sách
            $sql = " select * from sanpham where Ma_sp='$ma'";
            $result = mysqli_query($conn, $sql);
            $dem = mysqli_num_rows($result);
            if ($dem > 0) {
                echo "Mã Sản Phẩm Đã Tồn Tại";
                exit();
            } else {
                // if (($typeavt == 'image/jpeg' || $typeavt == 'image/png') && ($typeqr == 'image/jpeg' || $typeqr == 'image/png')) {
                if (($typeimg == 'image/jpeg' || $typeimg == 'image/png')) {
                    $nameimg = time() . "_" . $nameimg;
                    // $nameqr = $ma . "_" . $nameqr;
                    if (
                        move_uploaded_file($tmp_nameimg, "../../img_sp/" . $nameimg)
                        // && move_uploaded_file($tmp_nameqr, "../../qr_banking/" . $nameqr)
                    ) {
                        $sql = "INSERT INTO sanpham VALUES(NULL,'$ma','$tensp','$dvt','$ncc','$giamua','$giaban',0,'$nameimg','$loai')";
                        $result = mysqli_query($conn, $sql);
                        if ($result == true) {
                            echo "Thêm Thành Công";
                        } else {
                            echo $sql;
                            echo "Không thêm được";
                        }
                    } else {
                        echo "Không upload ảnh được";
                    }

                } else {
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