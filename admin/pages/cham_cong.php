<?php require 'header.php' ?>
<?php require_once "../src/db.php";
$bo_phan = $conn->query("SELECT * FROM bo_phan");
$ca_lam_viec = $conn->query("SELECT * FROM ca_lam_viec"); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý chấm công</h1>
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
                            <h3 class="card-title">Quản lý chấm công</h3>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover" style="text-align: center;">
                                <thead>
                                    <tr>
                                        <th>Mã NV</th>
                                        <th>Hình đại diện</th>
                                        <th>Họ tên</th>
                                        <th>Bộ phận</th>
                                        <th>Ca làm việc</th>
                                        <th>Hoạt động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
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
                                            <td>
                                                <form method="POST" style="display: inline;">
                                                    <input type="hidden" name="Ma_nv" value="<?php echo $row['Ma_nv']; ?>">
                                                    <input type="hidden" name="vao_ca"
                                                        value="<?php echo $row['Gio_bat_dau']; ?>">
                                                    <button type="submit" name="nut" class="btn btn-primary">Chấm
                                                        công</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <?php
                    if (isset($_POST['nut'])) {
                        $manv = isset($_GET['Ma_nv']);

                        if ($manv) {
                            $sql = "SELECT * FROM cham_cong WHERE Ma_nv = '$manv' AND Ngay = CURDATE()";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                echo "<script>alert('Nhân viên đã chấm công hôm nay')</script>";
                            } else {
                                $sql = "INSERT INTO cham_cong(Ma_nv, Ngay, Tinh_trang) VALUES ('$manv', CURDATE(), 'Đi làm'";
                                $result = mysqli_query($conn, $sql);
                                if ($result > 0) {
                                    echo "<script>alert('Chấm công thành công')</script>";
                                    echo "<script>window.location.href = 'cham_cong.php'</script>";
                                } else {
                                    echo $sql;
                                    echo "<script>window.location.href = 'cham_cong.php'</script>";
                                }
                            }
                        }
                    }
                    ?>
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