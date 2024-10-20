<?php require 'header.php';
require_once "../src/function.php";
$nv = $conn->query("SELECT * FROM nhan_vien");
$soluongnv = $nv->num_rows;
$today = date("d/m/Y");
$thuong = $conn->query("SELECT * FROM `nhan_luong`");
$tong_doanh_thu = 0;
$doanh_thu_thang = 0;
$days = 0;
while ($row = $thuong->fetch_assoc()) {
  $days += $row['So_ngay_lam'];
  if ($row['Tinh_trang'] == 'Đã thanh toán') {
    $tong_doanh_thu += $row['Tong'];

    if (date('m', strtotime($row['Thoi_gian'])) == date('m')) {
      $doanh_thu_thang += $row['Tong'];
    }
  }
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Trang chủ</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right"><b>
              <?php
              echo $today;
              ?> <span id="timer"></span></b>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-primary">
            <div class="inner">
              <h3><?php echo number_format($tong_doanh_thu, 0) . ' đ' ?></h3>
              <p>Tổng chi</p>

            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="thong_ke_luong.php" class="small-box-footer">Chi tiết<i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?php echo number_format($doanh_thu_thang) . ' đ' ?></h3>
              <p>THÁNG <?php echo date('m/Y') ?> </p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="thong_ke.php" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3> <?php
                    echo $soluongnv;
                    ?></h3>
              <p>NHÂN VIÊN</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="ql_nhan_vien.php" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?php echo ($days) ?></h3>
              <p>SỐ NGÀY LÀM VIỆC NHÂN VIÊN</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="thong_ke.php" class="small-box-footer">Chi tiết<i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">

      </div>
  </section>
  <!-- /.content -->

</div>
<!-- /.content-wrapper -->
<script type="text/javascript" src="../Public/admin/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="../Public/admin/plugins/chart.js/Chart.min.js"></script>
<script>
  $(document).ready(function() {
    showGraph();
  });

  function showGraph() {

    $.post("data.php",
      function(data) {
        console.log(data);
        var formStatusVar = [];
        var total = [];

        for (var i in data) {
          formStatusVar.push(data[i].Tong);
          total.push(data[i].Tong);
        }

        var options = {
          legend: {
            display: false
          },
          scales: {
            xAxes: [{
              display: true
            }],
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
          }
        };

        var myChart = {
          labels: formStatusVar,
          datasets: [{
            label: 'Tổng số',
            backgroundColor: '#17cbd1',
            borderColor: '#46d5f1',
            hoverBackgroundColor: '#0ec2b6',
            hoverBorderColor: '#42f5ef',
            data: total
          }]
        };

        var bar = $("#graph");
        var barGraph = new Chart(bar, {
          type: 'bar',
          data: myChart,
          options: options
        });
      });
  }
</script>
<?php require 'footer.php' ?>