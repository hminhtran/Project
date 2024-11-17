<?php require 'header.php' ?>
<?php require_once "../src/db.php";
$loai = $conn->query("SELECT * FROM loai_sp");
$nccap = $conn->query("SELECT * FROM nhacungcap");
$dvtinh = $conn->query("SELECT * FROM donvitinh");
?>
<?php
$masp = $_GET['Ma_sp'];
$sql = "
SELECT 
    sanpham.Ma_sp, 
    sanpham.TenSP, 
    sanpham.GiaMua, 
    sanpham.GiaBan, 
    sanpham.img_sanpham, 
    nhacungcap.TenNCC AS supplier_name, 
    nhacungcap.Id AS supplier_id, 
    loai_sp.id_loai AS type_id, 
    loai_sp.ten_loai AS type_name, 
    donvitinh.Id AS unit_id, 
    donvitinh.DonVi AS unit_name
FROM sanpham
JOIN nhacungcap ON sanpham.IdNCC = nhacungcap.Id
JOIN loai_sp ON sanpham.id_loai = loai_sp.id_loai
JOIN donvitinh ON sanpham.IdDVT = donvitinh.Id
WHERE sanpham.Ma_sp = '$masp'";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Lỗi khi thực thi câu lệnh SQL: " . mysqli_error($conn));
}

while ($row = mysqli_fetch_assoc($result)) {
    $masp = $row['Ma_sp'];
    $tensp = $row['TenSP'];
    $loaisp = $row['type_name']; // Đã alias thành 'type_name'
    $id_loai = $row['type_id']; // Đã alias thành 'type_id'
    $id_dvt = $row['unit_id']; // Đã alias thành 'unit_id'
    $id_ncc = $row['supplier_id']; // Đã alias thành 'supplier_id'
    $dvt = $row['unit_name']; // Đã alias thành 'unit_name'
    $ncc = $row['supplier_name']; // Đã alias thành 'supplier_name'
    $dongianhap = $row['GiaMua'];
    $dongiaban = $row['GiaBan'];
    $hinh = $row['img_sanpham'];
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Thông tin sản phẩm</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Sản phẩm</a></li>
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
                                            <label>Mã sản phẩm</label>
                                            <input type="text" name="masp" class="form-control" readonly='true' required
                                                value="<?php echo $masp ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Tên sản phẩm</label>
                                            <input type="text" name="ten" class="form-control" required
                                                value="<?php echo $tensp ?>">
                                        </div>
                                    </div>
                                </div>
                                <!-- aa -->
                                <div class="row mb-2">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="product-image" class="form-label">Hình sản phẩm</label>
                                            <div class="fileinputimg" data-provides="fileinputimg">
                                                <!-- Hiển thị hình ảnh hiện tại -->
                                                <div class="fileinputimg-new thumbnail">
                                                    <img id="current-image" src="../../img_sp/<?= $hinh ?>"
                                                        alt="Hình sản phẩm"
                                                        style="max-width: 150px; max-height: 150px; object-fit: contain;">
                                                </div>
                                                <!-- Chọn ảnh mới -->
                                                <div>
                                                    <div class="fileinputimg-preview fileinputimg-exists thumbnail"
                                                        style="max-width: 300px; max-height: 300px; object-fit: contain;">
                                                    </div>
                                                    <label class="btn btn-success">
                                                        Đổi ảnh
                                                        <input type="file" id="file-input" name="avaimg" required
                                                            onchange="handleImageChange(event)" style="display: none;">
                                                    </label>
                                                    <button type="button" class="btn btn-warning"
                                                        onclick="resetImage()">
                                                        Xóa
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Nhà cung cấp</label>
                                            <select name="ncc" id="ncc" value="<?php echo $loaisp ?>"
                                                class="form-control">
                                                <option value="<?php echo $id_ncc ?>"><?php echo $ncc ?>
                                                </option>
                                                <?php while ($row = $nccap->fetch_assoc()): ?>
                                                    <option value="<?php echo $row['Id'] ?>">
                                                        <?php echo $row['TenNCC'] ?>
                                                    </option>
                                                <?php endwhile ?>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <!-- aa -->


                                <div class="row mb-2">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Loại sản phẩm</label><br>
                                            <select name="loai" id="loai" value="<?php echo $loaisp ?>"
                                                class="form-control">
                                                <option value="<?php echo $id_loai ?>"><?php echo $loaisp ?>
                                                </option>
                                                <?php while ($row = $loai->fetch_assoc()): ?>
                                                    <option value="<?php echo $row['id_loai'] ?>">
                                                        <?php echo $row['ten_loai'] ?>
                                                    </option>
                                                <?php endwhile ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Đơn vị tính</label>
                                            <select name="dvt" id="dvt" value="<?php echo $dvt ?>" class="form-control">
                                                <option value="<?php echo $id_dvt ?>"><?php echo $dvt ?>
                                                </option>
                                                <?php while ($row = $dvtinh->fetch_assoc()): ?>
                                                    <option value="<?php echo $row['Id'] ?>">
                                                        <?php echo $row['DonVi'] ?>
                                                    </option>
                                                <?php endwhile ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Đơn giá mua</label>
                                            <input type="number" name="gm" class="form-control" required
                                                value="<?php echo $dongianhap ?> VNĐ">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Đơn giá bán</label>
                                            <input type="number" name="gb" class="form-control" required
                                                value="<?php echo $dongiaban ?> VNĐ">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-2">

                                    <div class="col-sm-2">
                                        <input type="submit" name="btn" class="btn btn-primary" value="Cập nhật">
                                    </div>
                                </div>
                                <?php
                                if (isset($_POST['btn'])) {
                                    $ten = mysqli_real_escape_string($conn, $_POST['ten']);
                                    $ncc = mysqli_real_escape_string($conn, $_POST['ncc']);
                                    $loai = mysqli_real_escape_string($conn, $_POST['loai']);
                                    $dvt = mysqli_real_escape_string($conn, $_POST['dvt']);
                                    $gm = mysqli_real_escape_string($conn, $_POST['gm']);
                                    $gb = mysqli_real_escape_string($conn, $_POST['gb']);
                                    $nameavt = '';

                                    // Xử lý file avatar
                                    if (!empty($_FILES['avaimg']['tmp_name'])) {
                                        $avaimg_name = $_FILES['avaimg']['name'];
                                        $avaimg_size = $_FILES['avaimg']['size'];
                                        $avaimg_tmp = $_FILES['avaimg']['tmp_name'];
                                        $imgava_ext = pathinfo($avaimg_name, PATHINFO_EXTENSION);
                                        $nameavt = time() . "_" . $avaimg_name;

                                        // Kiểm tra loại file và kích thước
                                        if (($imgava_ext == "jpg" || $imgava_ext == "jpeg" || $imgava_ext == "png") && $avaimg_size <= 2e+6) {
                                            // Di chuyển ảnh
                                            if (!move_uploaded_file($avaimg_tmp, "../../img_sp/" . $nameavt)) {
                                                echo '<script>alert("Lỗi upload ảnh!");</script>';
                                                return;
                                            }
                                        } else {
                                            echo '<script>alert("Ảnh không hợp lệ! Vui lòng chọn ảnh JPG, JPEG, hoặc PNG dưới 2MB.");</script>';
                                            return;
                                        }
                                    }

                                    // Thực hiện cập nhật cơ sở dữ liệu
                                    $query = "UPDATE sanpham SET 
                                            TenSP = '$ten', 
                                            IdNCC = '$ncc', 
                                            id_loai = '$loai', 
                                            IdDVT = '$dvt', 
                                            GiaMua = '$gm', 
                                            GiaBan = '$gb'";

                                    // Nếu có ảnh mới, thêm vào câu truy vấn
                                    if ($nameavt !== '') {
                                        $query .= ", img_sanpham = '$nameavt'";
                                    }

                                    $query .= " WHERE Ma_sp = '$masp'";

                                    if (mysqli_query($conn, $query)) {
                                        echo '<script>
                                        alert("Cập nhật sản phẩm thành công!");
                                        window.location.href = "chi_tiet_sp.php?Ma_sp=' . $masp . '";
                                    </script>';
                                    } else {
                                        echo '<script>alert("Lỗi khi cập nhật sản phẩm: ' . mysqli_error($conn) . '");</script>';
                                    }
                                }
                                ?>
                            </form>
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
    let currentImage = '<?= $hinh ?>'; // Lưu hình ảnh hiện tại

    /**
     * Hiển thị hình ảnh mới khi người dùng chọn file
     */
    function handleImageChange(event) {
        const input = event.target;
        if (!input.files || !input.files[0]) return; // Kiểm tra file hợp lệ

        const reader = new FileReader();
        reader.onload = function () {
            const preview = document.getElementById('current-image');
            preview.src = reader.result; // Cập nhật src với hình ảnh mới
            currentImage = input.files[0].name; // Cập nhật tên file
        };
        reader.readAsDataURL(input.files[0]); // Đọc file
    }

    /**
     * Đặt lại hình ảnh về hình ảnh ban đầu
     */
    function resetImage() {
        const fileInput = document.getElementById('file-input');
        fileInput.value = ''; // Xóa file đã chọn
        const preview = document.getElementById('current-image');
        preview.src = '../../img_sp/<?= $hinh ?>'; // Đặt lại src
        currentImage = '<?= $hinh ?>'; // Đặt lại tên hình ảnh ban đầu
    }
</script>
<?php require 'footer.php' ?>