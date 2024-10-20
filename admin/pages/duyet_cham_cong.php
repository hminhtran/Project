<?php require 'header.php' ?>
<?php require_once "../src/db.php";
$manv = $_SESSION['Ma_nv'];
$hoten = $_SESSION['Ho_ten'] ?>
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
                        <button onclick="window.location.href='ql_cham_cong.php'" class="btn btn-outline-success">Quay về</button>
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
                               
                                        <th>Đã gửi lúc</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    
                                   
                                    $result = mysqli_query($conn, "SELECT * from yeu_cau_cham_cong
                                                    
                                     ") or die("Câu lệnh truy vấn sai");
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <tr>
                                            <form id="approvalForm" method="post" action="xu_ly_cham_cong.php">
                                            <input type="hidden" name="id_yeu_cau" value="<?php echo $row['id_yeu_cau']; ?>">
                                            <input type="hidden" name="manv" value="<?php echo $row['Ma_nv']; ?>">
                                            <input type="hidden" name="ngay" value="<?php echo $row['ngay']; ?>">
                                            <input type="hidden" name="gio_gui" value="<?php echo $row['gio_gui']; ?>">
                                            <input type="hidden" name="calam" value="<?php echo $row['ca_lam']; ?>">
                                            <td><?php echo $row['Ma_nv']; ?></td>
                                            <td><?php echo $row['ngay']; ?></td>
                                            <td><?php echo $row['ca_lam']; ?></td>
                                            <td><?php echo $row['li_do']; ?></td>
                                            <td><?php echo $row['gio_gui']; ?></td>
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
<?php require 'footer_ql.php' ?>