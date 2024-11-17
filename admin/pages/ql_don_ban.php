<?php require 'header.php' ?>
<?php require_once "../src/db.php"; ?>
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
                            <table id="example1" class="table table-bordered table-hover" style="text-align: center;">
                                <thead>
                                    <tr>
                                        <th>Mã Hóa đơn</th>
                                        <th>Người bán</th>
                                        <th>Tổng tiền</th>
                                        <th>Ngày bán</th>
                                        <th>Phương thức thanh toán</th>
                                        <th>Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = " SELECT * FROM donban";
                                    $stt = 0;
                                    $result = mysqli_query($conn, $sql) or die("Câu lệnh truy vấn sai");
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <tr>

                                            <td> <a
                                                    href="chi_tiet_hoa_don.php?donban=<?php echo $row['ma_hd'] ?>"><?php echo $row['ma_hd']; ?></a>
                                            </td>
                                            <td><?php echo $row['nguoi_ban']; ?></td>
                                            <td><?php echo $row['tong_tien']; ?></td>
                                            <td><?php echo $row['ngay_ban']; ?></td>
                                            <td><?php echo $row['phuong_thuc_tt']; ?></td>
                                            <td><?php echo $row['trang_thai']; ?></td>

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

<?php require 'footer_ql.php' ?>