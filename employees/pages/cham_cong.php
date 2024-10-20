 <?php
include("../src/db.php");
$manv = $_POST['Ma_nv'];
$today = date("Y/m/d");
$sql = " select * from cham_cong where Ngay='$today' and Ma_nv = '$manv'";
$kq_con = mysqli_query($conn, $sql);
$dem = mysqli_num_rows($kq_con);
$shift1 = array("id" => 1, "start" => "06:30:00", "end" => "14:30:00"); // Ca làm việc 1
$shift2 = array("id" => 2, "start" => "14:30:00", "end" => "22:30:00"); // Ca làm việc 2

// Thời gian hiện tại
$current = $_POST['timein'];
// Kiểm tra nếu thời gian hiện tại nằm trong một trong các ca làm việc
$current_time = DateTime::createFromFormat('H:i:s', $current);

$sql_nhan_vien = "SELECT ID_ca_lam FROM nhan_vien WHERE Ma_nv = '$manv'";
$result_nhan_vien = mysqli_query($conn, $sql_nhan_vien);
$row_nhan_vien = mysqli_fetch_assoc($result_nhan_vien);

if ($row_nhan_vien) {
    $ca_lam_nv = $row_nhan_vien['ID_ca_lam'];
    $shift_id = null;

    if ($ca_lam_nv == 1) {
        $start_time1 = DateTime::createFromFormat('H:i:s', $shift1['start']);
        $end_time1 = DateTime::createFromFormat('H:i:s', $shift1['end']);
        if ($current_time >= $start_time1 && $current_time <= $end_time1) {
            $shift_id = $shift1['id'];
        }
    } 
    elseif ($ca_lam_nv == 2) 
    {
        $start_time2 = DateTime::createFromFormat('H:i:s', $shift2['start']);
        $end_time2 = DateTime::createFromFormat('H:i:s', $shift2['end']);
        if ($current_time >= $start_time2 && $current_time <= $end_time2) {
            $shift_id = $shift2['id'];
        }
    }

    if ($shift_id) {
        // Nếu nhân viên đã chấm công hôm nay
        if ($dem > 0) 
        {
            echo "<script> alert('Đã chấm công hôm nay');</script>";
            echo "<script> window.location = 'add_cham_cong.php';</script>";
        } 
        else 
            {
                $start = $_POST['vao_ca'];// Giá trị start
                $timein = $_POST['timein']; // Giá trị timein
                $start_time = DateTime::createFromFormat('H:i:s', $start);
                $timein_time = DateTime::createFromFormat('H:i:s', $timein);
                $start_time->add(new DateInterval('PT15M'));
                if ($timein_time > $start_time) {
                    // Chạy code A
                
                    $sqlcham_cong =  "INSERT INTO cham_cong VALUES(ID_cham_cong,'$manv','$today','$timein','Đi làm')";
                    $sqlphat = "INSERT INTO thuong_phat VALUES(ID_thuong_phat,'$manv','Phạt',50000,'Đi trễ hơn 15 phút','$today')";
                    $resultphat = mysqli_query($conn,$sqlcham_cong);
                    $resultchamcong = mysqli_query($conn,$sqlphat);
                    if ($resultphat == true && $resultchamcong == true)
                    {
                        
                        echo "<script> alert('Đã chấm công thành công');</script>";
                        echo "<script> window.location = 'add_cham_cong.php';</script>";
                    }
                    else
                    {
                        echo $sqlcham_cong;
                        echo $sqlphat;
                    }
                } else {
                    $sqlcham_cong =  "INSERT INTO cham_cong VALUES(ID_cham_cong,'$manv','$today','$timein','Đi làm')";
                    $resultchamcong = mysqli_query($conn,$sqlcham_cong);
                    if ($resultchamcong == true )
                    {
                        echo "<script> alert('Đã chấm công thành công');</script>";
                        echo "<script> window.location = 'add_cham_cong.php';</script>";
                    }
                    else
                    {
                        echo $sqlcham_cong;
                        echo $sqlphat;
                    }
            }
        }
    } 
    else 
    {
        echo "<script> alert('Bạn không trong ca làm việc này');</script>";
        echo "<script> window.location = 'add_cham_cong.php';</script>";
    }
} 
else {
    echo "Không tìm thấy nhân viên với mã số này.";
}
 ?>
