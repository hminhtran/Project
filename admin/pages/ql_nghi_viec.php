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
                    <h1>Nghỉ việc</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Nghỉ việc</li>
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
                            <button onclick="window.location.href='add_nghi_viec.php'" class="btn btn-outline-success">Thêm mới</button>
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
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                  
                                    $sql = " select * from nghi_viec";
                                    $result = mysqli_query($conn, "SELECT nghi_viec.*,nhan_vien.Hoten AS ten_nhan_vien
                                    FROM nghi_viec JOIN nhan_vien ON nghi_viec.Ma_nv = nhan_vien.Ma_nv
                                                   ") or die("Câu lệnh truy vấn sai");
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <tr>
                                        <form id="approvalForm" method="post" action="xu_ly_nghi_viec.php">
                                            <input type="hidden" name ="id" value="<?php echo $row['id']; ?>">
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['ngay_nghi']; ?></td>
                                            <td><?php echo $row['den_ngay']; ?></td>
                                            <td><?php echo $row['li_do']; ?></td>
                                            <td><?php echo $row['trang_thai']; ?></td>
                                        <td><?php
                                            if($row['trang_thai'] == "Chờ duyệt")
                                                { 
                                                echo '<button type="submit" class="btn btn-success" name="approve">Duyệt</button>';
                                                echo '<button type="submit" class="btn btn-danger" name="reject">Từ chối</button>';
                                                }
                                                else
                                                {
                                                    echo 'Đã xử lý';
                                                }
                                                ?>
                                                </td>
                                                </form>
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