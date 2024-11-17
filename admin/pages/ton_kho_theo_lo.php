<?php require 'header.php'; ?>
<?php require_once "../src/db.php"; ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý tồn kho</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <!-- Breadcrumbs nếu cần -->
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Sản phẩm trong kho</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover" style="text-align: center;">
                                <thead>
                                    <tr>
                                        <th>Mã sản phẩm</th>
                                        <th>Mã theo lô</th>
                                        <th>Tên Sản Phẩm</th>
                                        <th>Hình ảnh </th>
                                        <th>Số lượng</th>
                                        <th>Ngày sản xuất</th>
                                        <th>Hạn sử dụng</th>
                                        <th>Ngày nhập</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Kiểm tra xem có truyền biến Ma_sp không
                                    if (isset($_GET['Ma_sp']) && !empty($_GET['Ma_sp'])) {
                                        $ma_sp = $_GET['Ma_sp'];

                                        // Truy vấn để lấy dữ liệu từ bảng sp_theo_lo theo ma_sp
                                        $sql = "SELECT sp_theo_lo.*, sanpham.TenSP, sanpham.img_sanpham
                                                FROM sp_theo_lo
                                                JOIN sanpham ON sp_theo_lo.ma_sp = sanpham.Ma_sp
                                                WHERE sp_theo_lo.ma_sp = '$ma_sp';";
                                    } else {
                                        // Truy vấn để lấy tất cả dữ liệu từ bảng sp_theo_lo
                                        $sql = "SELECT sp_theo_lo.*, sanpham.TenSP, sanpham.img_sanpham
                                                FROM sp_theo_lo
                                                JOIN sanpham ON sp_theo_lo.ma_sp = sanpham.Ma_sp;";
                                    }

                                    $result = mysqli_query($conn, $sql) or die("Câu lệnh truy vấn sai");
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['ma_sp']; ?></td>
                                            <td><?php echo $row['ma_theo_lo']; ?></td>
                                            <td><?php echo $row['TenSP']; ?></td>
                                            <td><img src="../../img_sp/<?php echo $row['img_sanpham']; ?>" alt="Avatar"
                                                    style="width: 100px; height: 100px;"></td>
                                            <td><?php echo $row['so_luong']; ?></td>
                                            <td><?php echo $row['ngay_san_xuat']; ?></td>
                                            <td><?php echo $row['han_su_dung']; ?></td>
                                            <td><?php echo $row['ngay_nhap']; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php require 'footer_ql.php'; ?>