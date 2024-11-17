<?php require 'header.php'; ?>
<?php require_once "../src/db.php";
$donban = $_GET['donban']; ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Đơn bán hàng</h1>
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
                            <h3 class="card-title">Đơn bán hàng</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover" style="text-align: center;">
                                <thead>
                                    <tr>
                                        <th>Mã Hóa đơn</th>
                                        <th>Mã sản phẩm</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái</th>
                                        <th>Hoạt động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM chitietdonban WHERE ma_hd = '$donban'";
                                    $stt = 0;
                                    $result = mysqli_query($conn, $sql) or die("Câu lệnh truy vấn sai");
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['ma_hd']; ?></td>
                                            <td><?php echo $row['ma_sp']; ?></td>
                                            <td><?php echo $row['ten_sp']; ?></td>
                                            <td><?php echo $row['so_luong']; ?></td>
                                            <td><?php echo $row['tong_tien']; ?></td>
                                            <td><?php echo $row['status']; ?></td>
                                            <form method="POST">
                                                <input type="hidden" name="ma_hd" value="<?php echo $row['ma_hd']; ?>">
                                                <input type="hidden" name="ma_sp" value="<?php echo $row['ma_sp']; ?>">
                                                <input type="hidden" name="ten_sp" value="<?php echo $row['ten_sp']; ?>">
                                                <input type="hidden" name="so_luong"
                                                    value="<?php echo $row['so_luong']; ?>">
                                                <input type="hidden" name="tong_tien"
                                                    value="<?php echo $row['tong_tien']; ?>">
                                                <input type="hidden" name="status" value="<?php echo $row['status']; ?>">

                                                <td>
                                                    <button class="btn btn-danger" name="nut">Trả hàng</button>
                                                </td>
                                            </form>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                function confirmDelete(id) {
                    if (confirm("Bạn có chắc chắn muốn xóa? ")) {
                        window.location.href = 'xoa_nv.php?x=' + id;
                    } else {
                    }
                }
            </script>
        </div>
    </section>
</div>

<?php
// Kiểm tra khi nút "Trả hàng" được nhấn
if (isset($_POST['nut'])) {
    $masp = mysqli_real_escape_string($conn, $_POST['ma_sp']);
    $so_luong = mysqli_real_escape_string($conn, $_POST['so_luong']);
    $tong_tien = mysqli_real_escape_string($conn, $_POST['tong_tien']);
    $donban = mysqli_real_escape_string($conn, $_POST['ma_hd']);

    // Cập nhật lại số lượng sản phẩm trong bảng sp_theo_lo
    $sql = "UPDATE sp_theo_lo SET so_luong = so_luong + $so_luong WHERE ma_theo_lo = '$masp'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Cập nhật trạng thái "Đã trả hàng" trong bảng chitietdonban
        $sql1 = "UPDATE chitietdonban SET status = 'Đã trả hàng', tong_tien = tong_tien - $tong_tien WHERE ma_sp = '$masp'";
        $result1 = mysqli_query($conn, $sql1);

        // Cập nhật tổng tiền trong bảng donban
        $sql2 = "UPDATE donban SET tong_tien = tong_tien - $tong_tien WHERE ma_hd = '$donban'";
        $result2 = mysqli_query($conn, $sql2);

        // Kiểm tra kết quả
        if ($result1 && $result2) {
            echo "<script> alert('Trả hàng thành công');</script>";
            echo "<script> window.location = 'chi_tiet_hoa_don.php?donban=$donban';</script>";

        } else {
            echo "<script> alert('Trả hàng thất bại');</script>";
            echo "<script> window.location = 'chi_tiet_hoa_don.php?donban=$donban';</script>";

        }
    } else {
        echo "<script> alert('Trả hàng thất bại');</script>";
        echo "<script> window.location = 'chi_tiet_hoa_don.php';</script>";
    }
}
?>
<?php require 'footer_ql.php'; ?>