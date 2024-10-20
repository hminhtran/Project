<?php require 'header.php' ?>
<?php require_once "../src/db.php";
$bo_phan = $conn->query("SELECT * FROM bo_phan"); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Bộ phận</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                        <li class="breadcrumb-item active">Bộ phận</li>
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
                            <!-- <h3 class="card-title">Bộ phận</h3> -->
                            <button onclick="window.location.href='add_bo_phan.php'" class="btn btn-outline-success">Thêm mới</button>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example" class="table table-bordered table-hover " style="text-align: center;">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Bộ phận</th>
                                        <th>Lương theo giờ</th>
                                        <th>Số lượng nhân viên</th>
                                        <th>Xoá bộ phận</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    ?>
                                    <?php
                                    $sql = " select * from bo_phan";
                                    $s=0;
                                    $result = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $manv = $row['ID'];
                                        require_once "../src/function.php";
                                        $nv = $conn->query("SELECT * FROM nhan_vien WHERE ID_bophan = $manv");
                                        $soluongnv = $nv->num_rows;
                                    ?>
                                        <tr>
                                            <td><?php echo $s+=1; ?></td>
                                            <td><a href="add_nv_bp.php?x=<?php echo $row['Ten'] ?>"><?php echo $row['Ten']; ?></a> </td>
                                            <td><?php echo number_format($row['Luong_theo_gio']) . ' Vnđ'; ?></td>
                                            <td><?php echo $soluongnv; ?></td>
                                            <td><button class="btn btn-danger" onclick="window.location.href='xoa_bo_phan.php?x=<?php echo $row['ID'] ?>'"><i class="fas fa-trash"></i></button></td>
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