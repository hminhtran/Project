<?php
session_start();
if (!isset($_SESSION['Ma_nv']) || $_SESSION['ID_bophan'] != 1) {
    // Hủy bỏ phiên làm việc
    session_unset();
    session_destroy();
    // Chuyển hướng đến trang đăng nhập
    header("Location: ../../index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Quản lý chấm công | Coffee</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="32x32" href="../Public/admin/dist/img/LogoCF.png" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../Public/admin/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../Public/admin/plugins/fontawesome-free-6.2.0-web/css/all.min.css ">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet"
        href="../Public/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../Public/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="../Public/admin/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../Public/admin/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../Public/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../Public/admin/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../Public/admin/plugins/summernote/summernote-bs4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- DataTables -->
    <link rel="stylesheet" href="../Public/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../Public/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../Public/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../Public/admin/dist/css/adminlte.min.css">
    <script>
        // Hàm khởi tạo đồng hồ
        function startTime() {
            // Lấy Object ngày hiện tại
            var today = new Date();

            // Giờ, phút, giây hiện tại
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();

            // Chuyển đổi sang dạng 01, 02, 03
            m = checkTime(m);
            s = checkTime(s);

            // Ghi ra trình duyệt
            document.getElementById('timer').innerHTML = h + ":" + m + ":" + s;

            // Dùng hàm setTimeout để thiết lập gọi lại 0.5 giây / lần
            var t = setTimeout(function () {
                startTime();
            }, 500);
        }

        // Hàm này có tác dụng chuyển những số bé hơn 10 thành dạng 01, 02, 03, ...
        function checkTime(i) {
            if (i < 10) {
                i = "0" + i;
            }
            return i;
        }
    </script>
</head>

<body class="hold-transition sidebar-mini layout-fixed" onload="startTime()">
    <div class="wrapper">
        <!-- Preloader -->
        <!-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="../Public/admin/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div> -->
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="home.php" class="nav-link">Home</a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#"
                        role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="" class="brand-link" style="background-color: black;">
                <img src="../Public/admin/dist/img/LogoCF.png" alt="" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">Tiện lợi Store</span> <br>
            </a>

            <!-- Sidebar -->
            <div class="sidebar" style="background-color: black;">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../Public/admin/dist/img/admin.png" class="img-circle elevation-2" alt="">
                    </div>
                    <div class="info">
                        <a href="chi_tiet_nv.php?Ma_nv=<?php echo strtoupper(str_replace(' ', '', $_SESSION['Ma_nv'])); ?>"
                            class="d-block"><?php if (isset($_SESSION['Ma_nv'])) {
                                echo ($_SESSION['Ma_nv']) . "- " . ($_SESSION['Ho_ten']);
                            } ?></a>
                        <span class="brand-text font-weight-light" style="color: white;">Quản trị viên</span>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                        <li class="nav-item has-treeview">
                            <a href="home.php" class="nav-link active">
                                <i class="fa-solid fa-house"></i>
                                <p>Trang chủ</p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa-solid fa-folder"></i>
                                <p>
                                    Quản lý nhân viên
                                    <i class="fas fa-angle-left right"></i>
                                    <span class="badge badge-info right">4</span>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="ql_nhan_vien.php" class="nav-link">
                                        <i class="nav-icon far fa-user"></i>
                                        <p>Nhân viên</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="cham_cong.php" class="nav-link">
                                        <i class="nav-icon far fa-user"></i>
                                        <p>Chấm công nhân viên</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="ql_bo_phan.php" class="nav-link">
                                        <i class="nav-icon fa-solid fa-users"></i>
                                        <p>Bộ phận</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="ql_ca_lam.php" class="nav-link">
                                        <i class="nav-icon fa-regular fa-clock"></i>
                                        <p>Ca làm việc</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="ql_luong.php" class="nav-link">
                                        <i class="nav-icon fa-solid fa-file"></i>
                                        <p>Hệ số lương</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa-solid fa-folder"></i>
                                <p>
                                    Quản lý cửa hàng
                                    <i class="fas fa-angle-left right"></i>
                                    <span class="badge badge-info right">4</span>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="checkout.php" class="nav-link">
                                        <i class="nav-icon fa-solid fa-users"></i>
                                        <p>Thanh toán</p>
                                    </a>
                                <li class="nav-item">
                                    <a href="ql_kho.php" class="nav-link">
                                        <i class="nav-icon far fa-user"></i>
                                        <p>Quản lý kho</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="ql_ke.php" class="nav-link">
                                        <i class="nav-icon fa-solid fa-file"></i>
                                        <p>Quản lý kệ</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="ql_sanpham.php" class="nav-link">
                                        <i class="nav-icon fa-solid fa-users"></i>
                                        <p>Sản phẩm</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="ql_loaisp.php" class="nav-link">
                                        <i class="nav-icon fa-solid fa-users"></i>
                                        <p>Loại Sản phẩm</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="ql_dvt.php" class="nav-link">
                                        <i class="nav-icon fa-regular fa-clock"></i>
                                        <p>Đơn vị tính</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="ql_ncc.php" class="nav-link">
                                        <i class="nav-icon fa-solid fa-file"></i>
                                        <p>Nhà cung cấp</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="don_nhap.php" class="nav-link">
                                        <i class="nav-icon fa-solid fa-file"></i>
                                        <p>Đơn nhập hàng</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="ql_don_ban.php" class="nav-link">
                                        <i class="nav-icon fa-solid fa-file"></i>
                                        <p>Đơn bán</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>Chức năng<i class="fas fa-angle-left right"></i>
                                    <span class="badge badge-danger right">5</span>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="doi_mk.php" class="nav-link">
                                        <i class="nav-icon fa-solid fa-comments"></i>
                                        <p>Đổi mật khẩu</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="ql_thuong_phat.php" class="nav-link">
                                        <i class="nav-icon fa-solid fa-comments"></i>
                                        <p>Thưởng/Phạt</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="ql_ung_luong.php" class="nav-link">
                                        <i class="nav-icon far fa-calendar-check"></i>
                                        <p>Ứng lương</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="ql_cham_cong.php" class="nav-link">
                                        <i class="nav-icon fas fa-pen"></i>
                                        <p>Chấm công</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="ql_nghi_viec.php" class="nav-link">
                                        <i class="nav-icon fas fa-pen"></i>
                                        <p>Nghỉ phép</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="ql_tinh_luong.php" class="nav-link">
                                        <i class="nav-icon far fa-calendar"></i>
                                        <p>Tính lương</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="ql_bang_luong.php" class="nav-link">
                                        <i class="nav-icon far fa-calendar"></i>
                                        <p>Lịch sử trả lương</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa-solid fa-chart-simple"></i>
                                <p>
                                    Thống kê
                                    <i class="fas fa-angle-left right"></i>
                                    <span class="badge badge-warning right">3</span>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="thong_ke.php" class="nav-link">
                                        <i class="nav-icon far fa-calendar"></i>
                                        <p>Số ngày làm</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="thong_ke_thuong_phat.php" class="nav-link">
                                        <i class="nav-icon far fa-calendar"></i>
                                        <p>Thưởng / Phạt</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="thong_ke_luong.php" class="nav-link">
                                        <i class="nav-icon far fa-calendar"></i>
                                        <p>Lương</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="../pages/dang_xuat.php" class="nav-link">
                                <i class="nav-icon fa-sharp fa-solid fa-right-from-bracket"></i>
                                <p>Đăng xuất</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>