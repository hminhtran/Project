<?php require 'header.php' ?>
<?php require_once "../src/db.php";
$dvt = $conn->query("SELECT * FROM donvitinh"); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Đơn vị tính</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Đơn vị tính</li>
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
                            <button onclick="window.location.href='add_dvt.php'" class="btn btn-outline-success">Thêm
                                mới</button>
                            <!-- <h3 class="card-title">DataTable with minimal features & hover style</h3> -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên đơn vị</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM donvitinh";
                                    $result = mysqli_query($conn, $sql);
                                    $s = 0;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $s += 1; ?></td>
                                            <td><?php echo $row['DonVi']; ?></td>

                                            <td>
                                                <button class="btn btn-danger"
                                                    onclick="confirmDelete('<?php echo $row['Id']; ?>')">Xóa</button>

                                            </td>
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
    <script>
        function confirmDelete(id) {
            if (confirm("Bạn có chắc chắn muốn xóa? ")) {
                window.location.href = 'xoa_dvt.php?x=' + id;
            } else {
                // Hủy bỏ xóa
            }
        }
    </script>
</div>
<!-- /.content-wrapper -->
<?php require 'footer.php' ?>