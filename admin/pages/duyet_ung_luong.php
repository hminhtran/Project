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
                    <h1>Quản lý ứng lương</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Quản lý ứng lương</li>
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
                        <button onclick="window.location.href='ql_ung_luong.php'" class="btn btn-outline-success">Quay về</button>
                            <!-- <h3 class="card-title">DataTable with minimal features & hover style</h3> -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Nhân viên</th>
                                        <th>Ngày</th>
                                        <th>Số tiền</th>
                                        <th>Lí do</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $result = mysqli_query($conn, "SELECT yeu_cau_ung_luong.*,nhan_vien.Hoten AS ten_nhan_vien 
                                    FROM yeu_cau_ung_luong JOIN nhan_vien ON yeu_cau_ung_luong.ma_nv = nhan_vien.Ma_nv
                                                    ") or die("Câu lệnh truy vấn sai");
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <tr>
                                        <form id="approvalForm" method="post" action="xu_ly_ung_luong.php">
                                            <input type="hidden" name="manv" value="<?php echo $row['ma_nv']; ?>">
                                            <input type="hidden" name="so_tien" value="<?php echo $row['so_tien']; ?>">
                                            <input type="hidden" name="ngay" value="<?php echo $row['ngay']; ?>">
                                            <input type="hidden" name="id_ung" value="<?php echo $row['id_ung']; ?>">
                                                <td><?php echo $row['ma_nv'] ."- " .$row['ten_nhan_vien']; ?></td>
                                                <td><?php echo $row['ngay']; ?></td>
                                                <td><?php echo $row['so_tien']; ?></td>
                                                <td><?php echo $row['li_do']; ?></td>
                                                <td><?php echo $row['trang_thai']; ?></td>
                                                <td>
                                                <?php
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
    <script>
    function confirmAction(action) {
        let message;
        let url;

        if (action === 'approve') {
            message = "Bạn có chắc chắn muốn duyệt?";
            url = 'xu_ly_cham_cong.php?action=approve' ;
        } else if (action === 'reject') {
            message = "Bạn có chắc chắn muốn từ chối?";
            url = 'xu_ly_cham_cong.php?action=reject';
        }

        if (confirm(message)) {
            // Xác nhận hành động và điều hướng tới URL tương ứng
            window.location.href = url;
        } else {
            // Hủy bỏ hành động
        }
    }
</script>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php require 'footer_ql.php' ?>