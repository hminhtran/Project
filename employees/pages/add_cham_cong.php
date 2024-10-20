<?php require 'header.php' ?>
<?php require_once "../src/db.php";
$bo_phan = $conn->query("SELECT * FROM bo_phan");
$ca_lam_viec = $conn->query("SELECT * FROM ca_lam_viec");
$he_so_luong = $conn->query("SELECT * FROM luong");  ?>
<?php
$manv = ($_SESSION['Ma_nv']);
$sql = "SELECT nhan_vien.*,bo_phan.Ten,ca_lam_viec.Gio_bat_dau,ca_lam_viec.Gio_ket_thuc,luong.Luong_co_ban
        FROM nhan_vien JOIN bo_phan ON nhan_vien.ID_bophan = bo_phan.ID 
        JOIN ca_lam_viec ON ca_lam_viec.ID = nhan_vien.ID_ca_lam 
        JOIN luong ON nhan_vien.He_so_luong = luong.He_so_luong  
        where Ma_nv='$manv'";
$result = mysqli_query($conn, $sql) or die("Câu truy vấn sai!");
while ($row = mysqli_fetch_assoc($result)) {
    $ten = $row['Hoten'];
    $bophan = $row['ID_bophan'];
    $tenbophan = $row['Ten'];
    $calam = $row['ID_ca_lam'];
    $gio_lam= $row['Gio_bat_dau'] . ' đến ' . $row['Gio_ket_thuc'];
    $start = $row['Gio_bat_dau'];
    $end = $row['Gio_ket_thuc'];
    $Avatar = $row['Avatar'];
}
$trangthai= '';
?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Chấm Công</title>
  
 
</head>

<body class="hold-transition sidebar-mini layout-fixed" onload="startTime()">
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="#" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="../../img/<?= $Avatar?>" width="180" alt="">
                </a>
                <p class="text-center">Chấm công</p>


                <form method="POST" action="cham_cong.php">
                      <div class="mb-3">
                      <label for="user" >Mã nhân viên</label>
                      <input name="Ma_nv" type="text" class="form-control" value="<?php echo $manv ?>"  aria-describedby="textHelp" readonly>
                  </div>
                     <div class="mb-3">
                    <label for="date" >Ngày</label>
                    <input name="date" type="text" class="form-control" value="<?php echo date('l, \n\g\à\y d \t\h\á\n\g m'); ?>" aria-describedby="textHelp" readonly>
                  </div>
                  <div class="mb-3">
                  <label for="timeInput">Thời gian hiện tại:</label>
        <input name="timein" type="text" class="form-control" id="timeInput" value="" aria-describedby="textHelp" readonly>
                  </div>
                  <div class="mb-3">
                    <label for="date" >Ca làm</label>
                    <input type="hidden" name="vao_ca" value="<?php echo $start ;?>">
                    <input  type="text" class="form-control" value="  <?php echo $start . ' đến ' . $end ?>" aria-describedby="textHelp" readonly>
                  </div>
                  <div class="mb-3">
                    <label for="date" >Bộ phận</label>
                    <input  type="text" class="form-control" value="<?php echo $tenbophan ?>" aria-describedby="textHelp" readonly>
                  </div>
                  <div class="mb-3">
                  <p class="wrap-btn">
                                   <input type="submit" value="Chấm Công" name="attend" class="btn btn-success">
                                   <a href="add_cham_cong2.php" class="btn btn-warning">Gửi yêu cầu chấm công</a>  
                              
                                </p>
                                <p class="wrap-btn">
                                <a href="home.php" class="btn btn-danger">Quay về trang chủ</a>  
                              </p>
                  </div>

               
                  </form>
                  <?php
  
    
?> 
  <script>
    window.onload = function() {
        // Lấy thời gian hiện tại
        var now = new Date();
        // Định dạng thời gian thành chuỗi giờ, phút và giây
        var formattedTime = ('0' + now.getHours()).slice(-2) + ':' +
                            ('0' + now.getMinutes()).slice(-2) + ':' +
                            ('0' + now.getSeconds()).slice(-2);

        // Gán giá trị cho thuộc tính value của thẻ input
        document.getElementById('timeInput').value = formattedTime;
    };
</script>
<?php require 'footer.php' ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>