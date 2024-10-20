<?php
include ("../src/db.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $manv = $_POST['manv'];
        $ngay = $_POST['ngay'];
        $id_yeu_cau = $_POST['id_yeu_cau'];
        $ca= $_POST['calam'];
        if ($ca = 1)
        {
            $start = "06:30:00";
        }
        else
        {
            $start = "14:30:00";
        }
    // Kiểm tra xem nút "Duyệt" hoặc "Từ chối" đã được nhấn
    if (isset($_POST['approve'])) {
        $timein = $_POST['gio_gui']; // Giá trị timein
        $start_time = DateTime::createFromFormat('H:i:s', $start);
        $timein_time = DateTime::createFromFormat('H:i:s', $timein);
        $start_time->add(new DateInterval('PT15M'));
        if ($timein_time > $start_time) {
            // Chạy code A
        
            $sqlcham_cong =  "INSERT INTO cham_cong VALUES(ID_cham_cong,'$manv','$ngay','$timein','Đi làm')";
            $sqlphat = "INSERT INTO thuong_phat VALUES(ID_thuong_phat,'$manv','Phạt',50000,'Đi trễ hơn 15 phút','$ngay')";
            $sqltt = "UPDATE yeu_cau_cham_cong set trang_thai = 'Đã chấm công giúp' where id_yeu_cau = '$id_yeu_cau'";
            $resultphat = mysqli_query($conn,$sqlcham_cong);
            $resultchamcong = mysqli_query($conn,$sqlphat);
            $resultt = mysqli_query($conn,$sqltt);
            if ($resultphat == true && $resultchamcong == true && $resultt == true) 
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
            
            $sqlcham_cong =  "INSERT INTO cham_cong VALUES(ID_cham_cong,'$manv','$ngay','$timein','Đi làm')";
            $sqltt = "UPDATE yeu_cau_cham_cong set trang_thai = 'Đã chấm công giúp' where id_yeu_cau = '$id_yeu_cau'";
            $resultchamcong = mysqli_query($conn,$sqlcham_cong);
            $resultt = mysqli_query($conn,$sqltt);
            if ($resultchamcong == true && $resultt == true)
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
    elseif (isset($_POST['reject'])) {
        $sqltt = "UPDATE yeu_cau_cham_cong set trang_thai = 'Từ chối' where id_yeu_cau = '$id_yeu_cau'";
        $resultt = mysqli_query($conn, $sqltt);
        if ($resultt == true)
        {
            echo "<script> alert('Đã từ chối');</script>";
            echo "<script> window.location = 'duyet_cham_cong.php';</script>";
        }
        else
        {
            echo $sqltt;
     
    }
    // Sau khi xử lý, bạn có thể chuyển hướng hoặc hiển thị thông báo
    }
}
?>