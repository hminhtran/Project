<?php require 'header.php'; ?>
<?php require_once "../src/db.php"; ?>

<div class="content-wrapper" style="min-height: 353px;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Thêm khuyến mãi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Khuyến mãi</a></li>
                        <li class="breadcrumb-item active">Thêm</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Thông tin khuyến mãi</h3>
                </div>
                <form method="post">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tên khuyến mãi</label>
                                    <input type="text" name='ten_khuyen_mai' required class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Loại khuyến mãi</label>
                                    <select name="loai_khuyen_mai" class="form-control" required>
                                        <option value="">Chọn loại khuyến mãi</option>
                                        <option value="Buy X Get Y">Buy X Get Y</option>
                                        <option value="Buy X Sale">Buy X Sale</option>
                                        <option value="Discount">Discount</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Ngày bắt đầu</label>
                                    <input type="date" name="ngay_bat_dau" required class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Ngày kết thúc</label>
                                    <input type="date" name="ngay_ket_thuc" required class="form-control">
                                </div>
                            </div>
                        </div>

                        <div id="dynamic_form"></div>

                        <button type="submit" name="btn" class="btn btn-primary">Thêm khuyến mãi</button>
                    </div>
                </form>

                <?php
                if (isset($_POST['btn'])) {
                    $ten_khuyen_mai = $_POST['ten_khuyen_mai'];
                    $loai_khuyen_mai = $_POST['loai_khuyen_mai'];
                    $ngay_bat_dau = $_POST['ngay_bat_dau'];
                    $ngay_ket_thuc = $_POST['ngay_ket_thuc'];

                    // Lấy ID khuyến mãi từ dropdown
                    $khuyen_mai = $_POST['loai_khuyen_mai'];
                    switch ($khuyen_mai) {
                        case 'Buy X Get Y':
                            $id_khuyen_mai = 1;
                            break;
                        case 'Buy X Sale':
                            $id_khuyen_mai = 3;
                            break;
                        case 'Discount':
                            $id_khuyen_mai = 5;
                            break;

                    }

                    // Lưu vào bảng chitietkhuyenmai
                    $so_luong_mua = $_POST['so_luong_mua'];
                    $san_pham_dieu_kien = $_POST['san_pham_dieu_kien'];
                    $gia_tri_sale = $_POST['gia_tri_sale'] ?? 0;  // Trường giảm giá trong Buy X Sale
                    $phan_tram_sale = $_POST['phan_tram_sale'] ?? 0; // Trường giảm giá theo % (cho Discount)
                
                    // Cập nhật bảng chitietkhuyenmai
                    $sql_chitiet = "INSERT INTO chitietkhuyenmai (
                        ten_khuyen_mai, 
                        ma_khuyen_mai, 
                        so_luong_yeu_cau, 
                         gia_tri_giam,
                        phan_tram_giam,
                        ngay_bat_dau, 
                        ngay_ket_thuc
                       
                    ) VALUES (
                        '$ten_khuyen_mai', 
                        '$id_khuyen_mai', 
                        '$so_luong_mua', 
                         '$gia_tri_sale',
                        '$phan_tram_sale',
                        '$ngay_bat_dau', 
                        '$ngay_ket_thuc'
                    )";

                    $result_chitiet = mysqli_query($conn, $sql_chitiet);

                    if (!$result_chitiet) {
                        echo "Lỗi khi thêm chi tiết khuyến mãi!";
                        exit;
                    }

                    // Lấy ID của chi tiết khuyến mãi vừa thêm
                    $ma_chi_tiet = mysqli_insert_id($conn);

                    // Lưu thông tin sản phẩm điều kiện vào bảng sanphamkhuyenmai
                    mysqli_query($conn, "INSERT INTO sanphamkhuyenmai (ma_chi_tiet, ma_san_pham) VALUES ('$ma_chi_tiet', '$san_pham_dieu_kien')");

                    echo "Thêm khuyến mãi thành công!";
                }
                ?>
            </div>
        </div>
    </section>
</div>

<?php require 'footer.php'; ?>

<script>
    document.querySelector("select[name='loai_khuyen_mai']").addEventListener("change", function () {
        const loai_khuyen_mai = this.value;
        let html = '';

        if (loai_khuyen_mai === 'Buy X Get Y' || loai_khuyen_mai === 'Buy X Sale') {
            html = `
                <label>Sản phẩm điều kiện (Mua X)</label>
                <input type="text" name="san_pham_dieu_kien" class="form-control" required>
                <label>Số lượng cần mua (X)</label>
                <input type="number" name="so_luong_mua" class="form-control" min="1" required>
                ${loai_khuyen_mai === 'Buy X Sale' ?
                    `<label>Giảm giá bao nhiêu (Tiền)</label>
                     <input type="number" name="gia_tri_sale" class="form-control" required>` : ''}
            `;
        } else if (loai_khuyen_mai === 'Discount') {
            html = `
                <label>Sản phẩm điều kiện</label>
                <input type="text" name="san_pham_dieu_kien" class="form-control" required>
                <label>Giảm giá (%)</label>
                <input type="number" name="phan_tram_sale" class="form-control" min="1" max="100" required>
            `;
        }

        document.getElementById('dynamic_form').innerHTML = html;
    });
</script>