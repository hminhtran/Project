<!-- <?php require 'header.php' ?>
<?php require_once "../src/db.php";
$bo_phan = $conn->query("SELECT * FROM bo_phan");
$ca_lam_viec = $conn->query("SELECT * FROM ca_lam_viec"); ?> -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kho hàng</h1>
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
                            <h3 class="card-title">Thông tin tồn kho</h3>
                            <div class="card-tools">
                                <!-- <button onclick="window.location.href='add_nv.php'" class="btn btn-success">Thêm nhân
                                    viên</button> -->
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover" style="text-align: center;">
                                <thead>
                                    <tr>
                                        <th>Mã SP</th>
                                        <th>Tên Sản Phẩm</th>
                                        <th>Mô tả</th>
                                        <th>Số lượng</th>
                                        <th>Hạn sử dụng</th>
                                        <!-- <th>Hoạt động</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- <?php
                                    $sql = " SELECT nhan_vien.*,bo_phan.Ten,ca_lam_viec.Gio_bat_dau,ca_lam_viec.Gio_ket_thuc 
                                             FROM nhan_vien 
                                            JOIN bo_phan ON nhan_vien.ID_bophan = bo_phan.ID 
                                            JOIN ca_lam_viec ON nhan_vien.ID_ca_lam = ca_lam_viec.ID;";
                                    $stt = 0;
                                    $result = mysqli_query($conn, $sql) or die("Câu lệnh truy vấn sai");
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['Ma_nv']; ?></td>
                                            <td><img src="../../img/<?php echo $row['Avatar']; ?>" alt="Avatar"
                                                    style="width: 100px; height: 100px;"></td>
                                            <td><?php echo $row['Hoten']; ?></td>
                                            <td><?php echo $row['Ten']; ?></td>
                                            <td><?php echo $row['Gio_bat_dau'] . ' đến ' . $row['Gio_ket_thuc'] ?></td>
                                            <td><button class="btn btn-primary"
                                                    onclick="window.location.href='chi_tiet_nv.php?Ma_nv=<?php echo $row['Ma_nv'] ?>'"><i
                                                        class="fa fa-eye"></i></button>
                                                <button class="btn btn-danger"
                                                    onclick="confirmDelete('<?php echo $row['Ma_nv']; ?>')">Xóa</button>
                                            </td>
                                        </tr>
                                    <?php } ?> -->
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