<?php require 'header.php' ?>
<?php require_once "../src/db.php";
$manv = $_SESSION['Ma_nv'];?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Yêu cầu chấm công</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Yêu cầu chấm công</li>
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
                                        <th>Ngày</th>
                                        <th>Ca làm</th>
                                        <th>Lí do</th>
                                        <th>Trạng thái</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                   
                                   
                                    $result = mysqli_query($conn, "SELECT * from yeu_cau_cham_cong
                                                    where yeu_cau_cham_cong.Ma_nv = '$manv'
                                     ") or die("Câu lệnh truy vấn sai");
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <tr>

                                            <td><?php echo $row['Ma_nv']; ?></td>
                                            <td><?php echo $row['ngay']; ?></td>
                                            <td><?php echo $row['ca_lam']; ?></td>
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
    <script>
    function confirmDelete(id_yeu_cau) {
        if (confirm("Bạn có chắc chắn muốn xóa? ")) {
            window.location.href = 'xoa_cham_cong.php?x=' + id_yeu_cau;
        } else {
            // Hủy bỏ xóa
        }
    }
</script>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php require 'footer.php' ?>