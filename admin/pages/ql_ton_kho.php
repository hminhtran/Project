<?php require 'header.php' ?>
<?php require_once "../src/db.php";
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sản Phẩm</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

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
                                        <th>Hình ảnh</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Loại sản phẩm</th>
                                        <th>Đơn vị tính</th>
                                        <th>Số lượng tồn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($_GET['id_ke']) && !empty($_GET['id_ke'])) {
                                        $ma_ke = $_GET['id_ke'];

                                        // Truy vấn để lấy dữ liệu từ bảng sp_theo_lo theo ma_sp
                                        $sql = " SELECT sanpham.*,nhacungcap.TenNCC,loai_sp.ten_loai,donvitinh.DonVi 
                                        FROM sanpham
                                       JOIN nhacungcap ON sanpham.IdNCC = nhacungcap.Id 
                                       JOIN loai_sp ON sanpham.id_loai = loai_sp.id_loai
                                       JOIN donvitinh ON sanpham.IdDVT = donvitinh.Id
                                       WHERE loai_sp.id_ke =  $ma_ke ;
                                       ;";
                                    } else {
                                        $sql = " SELECT sanpham.*,nhacungcap.TenNCC,loai_sp.ten_loai,donvitinh.DonVi 
                                        FROM sanpham
                                       JOIN nhacungcap ON sanpham.IdNCC = nhacungcap.Id 
                                       JOIN loai_sp ON sanpham.id_loai = loai_sp.id_loai
                                       JOIN donvitinh ON sanpham.IdDVT = donvitinh.Id
                                       ;";
                                    }

                                    $result = mysqli_query($conn, $sql) or die("Câu lệnh truy vấn sai");
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['Ma_sp']; ?></td>
                                            <td><img src="../../img_sp/<?php echo $row['img_sanpham']; ?>" alt="Avatar"
                                                    style="width: 100px; height: 100px;"></td>
                                            <td>
                                                <a href="ton_kho_theo_lo.php?Ma_sp=<?php echo $row['Ma_sp'] ?>">
                                                    <?php echo $row['TenSP']; ?>
                                                </a>
                                            </td>

                                            <td><?php echo $row['ten_loai']; ?></td>
                                            <td><?php echo $row['DonVi']; ?></td>
                                            <td><?php echo $row['so_luong']; ?></td>

                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
            <script>
                function confirmDelete(id) {
                    if (confirm("Bạn có chắc chắn muốn xóa? ")) {
                        window.location.href = 'xoa_nv.php?x=' + id;
                    } else {
                        // Hủy bỏ xóa
                    }
                }
            </script>
        </div>

    </section>

</div>

<?php require 'footer_ql.php' ?>