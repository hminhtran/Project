<?php require 'header.php' ?>
<?php require_once "../src/db.php";
$bo_phan = $conn->query("SELECT * FROM bo_phan");
$ca_lam_viec = $conn->query("SELECT * FROM ca_lam_viec"); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ca làm</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Ca làm</li>
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
                            <button onclick="window.location.href='add_ca_lam.php'" class="btn btn-outline-success">Thêm mới</button>
                            <!-- <h3 class="card-title">DataTable with minimal features & hover style</h3> -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Giờ bắt đầu</th>
                                        <th>Giờ kết thúc</th>
                                        <th>Thời gian</th>
                                        <th>Hoạt động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    
                                    $sql = " select * from ca_lam_viec";
                                    $result = mysqli_query($conn, $sql);
                                    $s = 0;
                                    // $result = mysqli_query($conn, "SELECT nhan_vien.*,bo_phan.tenbophan AS Ten FROM nhan_vien JOIN bo_phan ON nhan_vien.ID_bophan = bo_phan.ID;") or die("Câu lệnh truy vấn sai");
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        
                                    ?>
                                        <tr>
                                            <td><?php echo $s += 1; ?></td>
                                            <td><?php echo $row['Gio_bat_dau']; ?></td>
                                            <td><?php echo $row['Gio_ket_thuc']; ?></td>
                                            <td><?php echo (strtotime($row['Gio_ket_thuc']) - strtotime($row['Gio_bat_dau'])) / 3600 .' hours'; ?></td>
                                            <td><button class="btn btn-danger" onclick="window.location.href='xoa_ca_lam.php?x=<?php echo $row['ID'] ?>'"><i class="fas fa-trash"></i></button></td>
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
<!-- /.content-wrapper -->
<?php require 'footer.php' ?>