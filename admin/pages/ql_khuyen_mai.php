<?php require 'header.php'; ?>
<?php require_once "../src/db.php"; ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Danh sách khuyến mãi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <!-- Breadcrumb nếu cần -->
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
                            <h3 class="card-title">Thông tin các khuyến mãi</h3>
                            <div class="card-tools">
                                <button onclick="window.location.href='add_km.php'" class="btn btn-success">Thêm khuyến
                                    mãi</button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover" style="text-align: center;">
                                <thead>
                                    <tr>
                                        <th>Tên khuyến mãi</th>
                                        <th>Loại khuyến mãi</th>
                                        <th>Sản phẩm áp dụng</th>
                                        <th>Cần mua số lượng</th>
                                        <th>Số tiền giảm</th>
                                        <th>Thời gian áp dụng</th>
                                        <th>Trạng thái</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $sql = "
SELECT 
    ctkm.ten_khuyen_mai AS ten_khuyen_mai,
    km.loai_khuyen_mai AS loai_khuyen_mai,
    GROUP_CONCAT(DISTINCT sp.TenSP SEPARATOR ', ') AS san_pham_ap_dung,
    ctkm.so_luong_yeu_cau AS so_luong_yeu_cau,
    NULL AS don_hang_tren,
    CASE 
        WHEN ctkm.gia_tri_giam IS NOT NULL THEN CONCAT(FORMAT(ctkm.gia_tri_giam, 0), ' VND')
        WHEN ctkm.phan_tram_giam IS NOT NULL THEN CONCAT(FORMAT(ctkm.phan_tram_giam, 0), ' %')
        ELSE 'Không áp dụng'
    END AS so_tien_giam,
    CONCAT(DATE_FORMAT(ctkm.ngay_bat_dau, '%d/%m/%Y'), ' - ', DATE_FORMAT(ctkm.ngay_ket_thuc, '%d/%m/%Y')) AS thoi_gian_ap_dung,
    CASE 
        WHEN CURDATE() BETWEEN ctkm.ngay_bat_dau AND ctkm.ngay_ket_thuc THEN 'Hoạt động'
        ELSE 'Không hoạt động'
    END AS trang_thai
FROM 
    chitietkhuyenmai ctkm
INNER JOIN 
    khuyenmai km 
    ON ctkm.ma_khuyen_mai = km.ma_khuyen_mai
LEFT JOIN 
    sanphamkhuyenmai spkm 
    ON ctkm.ma_chi_tiet = spkm.ma_chi_tiet
LEFT JOIN 
    sanpham sp 
    ON spkm.ma_san_pham = sp.Ma_sp
GROUP BY 
    ctkm.ma_chi_tiet
ORDER BY 
    ctkm.ngay_bat_dau DESC;
;
";
                                    $result = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>{$row['ten_khuyen_mai']}</td>";
                                        echo "<td>{$row['loai_khuyen_mai']}</td>";
                                        echo "<td>{$row['san_pham_ap_dung']}</td>";
                                        echo "<td>{$row['so_luong_yeu_cau']}</td>";
                                        echo "<td>{$row['so_tien_giam']}</td>";
                                        echo "<td>{$row['thoi_gian_ap_dung']}</td>";
                                        echo "<td>{$row['trang_thai']}</td>";
                                        echo "</tr>";
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function confirmDelete(id) {
                    if (confirm("Bạn có chắc chắn muốn xóa khuyến mãi này?")) {
                        window.location.href = 'xoa_km.php?x=' + id;
                    }
                }
            </script>
        </div>
    </section>
</div>

<?php require 'footer_ql.php'; ?>