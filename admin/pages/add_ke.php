<?php require 'header.php' ?>
<?php require_once "../src/db.php";
$ke = $conn->query("SELECT * FROM ke_hang"); ?>
<div class="content-wrapper" style="min-height: 353px;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Kệ hàng</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Kệ hàng</a></li>
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
                    <h3 class="card-title">Kệ hàng</h3>
                </div>
                <form method="post">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tên kệ</label>
                                    <input type="text" name='ten' required class="form-control">
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="btn" class="btn btn-primary">Thêm</button>
                    </div>
                </form>
                <?php
                if (isset($_POST['btn'])) {
                    $ten = $_POST['ten'];
                    $sql = " select * from ke_hang where ten_ke = '$ten'";
                    $result = mysqli_query($conn, $sql);
                    $dem = mysqli_num_rows($result);
                    if ($dem > 0) {
                        echo "Tồn tại";
                        exit();
                    } else {
                        $sql = "INSERT INTO ke_hang VALUES(NULL,'$ten',1)";
                        $result = mysqli_query($conn, $sql);
                        if ($result == true) {
                            echo "Thêm thành công, hãy xem <a href='ql_ke.php'>Danh sách</a>";
                        }
                    }
                }
                ?>
            </div>
    </section>
</div>
<?php require 'footer.php' ?>