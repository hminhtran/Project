<?php require 'header.php' ?>
<?php require_once "../src/db.php";
$manv = $_SESSION['Ma_nv'];
$ca_lam_viec = $conn->query("SELECT * FROM ca_lam_viec"); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý nghỉ phép</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Quản lý nghỉ phép</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                 
                            <!-- <h3 class="card-title">DataTable with minimal features & hover style</h3> -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Nhân viên</th>
                                        <th>Ngày nghỉ</th>
                                        <th>Đến</th>
                                        <th>Lí do</th>
                                        <th>Trạng thái</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    
                                    $sql = " select * from nghi_viec";
                                    $result = mysqli_query($conn, "SELECT nghi_viec.*,nhan_vien.Hoten AS ten_nhan_vien
                                     FROM nghi_viec JOIN nhan_vien ON nghi_viec.Ma_nv = nhan_vien.Ma_nv
                                                    where nghi_viec.Ma_nv = '$manv'
                                     ") or die("Câu lệnh truy vấn sai");
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['ten_nhan_vien']; ?></td>
                                            <td><?php echo $row['ngay_nghi']; ?></td>
                                            <td><?php echo $row['den_ngay']; ?></td>
                                            <td><?php echo $row['li_do']; ?></td>
                                            <td><?php echo $row['trang_thai']; ?></td>
                                            
                                            
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<script>
    function confirmDelete(id) {
        if (confirm("Bạn có chắc chắn muốn xóa? ")) {
            window.location.href = 'xoa_cham_cong.php?x=' + id;
        } else {
            // Hủy bỏ xóa
        }
    }
</script>
<!-- /.content-wrapper -->
<?php require 'footer.php' ?>