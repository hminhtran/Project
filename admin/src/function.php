<?php require_once 'db.php';

function bophan()
{
  global $conn;
  $result = $conn->query("SELECT * FROM bo_phan");
  return $result->fetch_all(MYSQLI_ASSOC);
}
function calamviec()
{
  global $conn;
  $result = $conn->query("SELECT * FROM ca_lam_viec");
  return $result->fetch_all(MYSQLI_ASSOC);
}
function nhanvien()
{
  global $conn;
  $result = $conn->query("SELECT * FROM nhan_vien");
  return $result->fetch_all(MYSQLI_ASSOC);
  
}
function luong()
{
  global $conn;
  $result = $conn->query("SELECT * FROM luong");
  return $result->fetch_all(MYSQLI_ASSOC);
}
function nghiviec()
{
  global $conn;
  $result = $conn->query("SELECT * FROM nghi_viec");
  return $result->fetch_all(MYSQLI_ASSOC);
}
function search()
{
  //Kết nối cơ sở dữ liệu
  $conn = mysqli_connect("localhost", "root", "", "quanlychamcong"); 
  //Truy vấn dữ liệu
  if (isset($_GET['search']) && !empty($_GET['search'])) 
  {
    $key = $_GET['search'];
    $sql = "SELECT * FROM nhan_vien WHERE Ma_nv LIKE '%key%' OR Hoten  LIKE '%key%' OR Gioitinh  LIKE '%key%' OR Quequan  LIKE '%key%' OR ID_bophan  LIKE '%key%' OR ID_ca_lam  LIKE '%key%' OR He_so_luong  LIKE '%key%'";
  }
  else{{
    $sql = "SELECT * FROM nhan_vien";
  }
$result = mysqli_query($conn,$sql);
}
}
