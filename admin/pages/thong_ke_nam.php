<?php require 'header.php' ?>
<?php require_once "../src/db.php"; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thống kê theo năm</h1>
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
                        <button onclick="window.location.href='thong_ke.php'" class="btn btn-info">Xem theo tháng</button>
                            <div class="card-tools">
                                <form method="get" action="" style="display: flex;">
                                    <p style="margin: auto;padding-right: 10px;"> Năm</p>
                                    <select name="year" class="form-control" style="width: 100px;">
                                        <option value="2024">2024</option>
                                        <option value="2023">2023</option>
                                    </select>
                                    <input type="submit" name="search" value="Tìm kiếm" class="btn-primary" />
                                </form>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example" class="table table-bordered table-hover" style="text-align: center;">
                                <thead>
                                    <tr>
                                        <th>Mã nhân viên</th>
                                        <th>Họ tên</th>
                                        <th>Số ngày đi làm </th>
                                        <th>Số giờ đã làm</th>
                                        <!--<th>Toàn bộ số ngày đã đi làm</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $year = date('Y');
                                    if (isset($_GET['search'])) {
                                        $year = intval($_GET['year']);
                                    }
                                    echo "<h5>Năm $year</h5>";
                                    $sql = "SELECT nhan_vien.* FROM nhan_vien";
                                    $result = mysqli_query($conn, $sql) or die("Câu truy vấn sai!");
                                    if ($result) {
                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $manv = $row['Ma_nv'];
                                                $calam = $row['ID_ca_lam'];
                                                $time = '';
                                                if ($calam == 1 or $calam == 2) {
                                                    $time = 8;
                                                } else {
                                                    $time = 4;
                                                }
                                                require_once "../src/function.php";
                                                //Số day đi làm trong năm
                                                $day2 = $conn->query("SELECT * FROM cham_cong where Ma_nv = '$manv'and YEAR(Ngay) ='$year'");
                                                $day2s = $day2->num_rows;
                                                //Tổng 
                                                $tong = $conn->query("SELECT * FROM cham_cong where Ma_nv = '$manv'");
                                                $tongg = $tong->num_rows;
                                    ?>
                                                <tr>
                                                    <td><?php echo $row['Ma_nv']; ?></td>
                                                    <td><?php echo $row['Hoten']; ?></td>
                                                    <td><?php echo $day2s ?></td>
                                                    <td><?php echo $time * $day2s . ' giờ' ?></td>
                                                    <!-- <td><?php echo $tongg ?></td> -->
                                                </tr>
                                            <?php }
                                            mysqli_free_result($result);
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="10" style="text-align: center;">Không có dữ liệu trong bảng</td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "ERROR: Không thể thực thi câu lệnh $sql. ";
                                    }
                                    // Đóng kết nối
                                    mysqli_close($conn);
                                    ?>
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