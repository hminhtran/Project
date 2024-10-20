<?php
require '../vendor/autoload.php';
use Endroid\QrCode\QrCode;
$qrname = "../../qrcode/cham_cong.png";
                        $qrCode = new QrCode("https://minhngoccoffe.000webhostapp.com/employees/pages/add_cham_cong.php");
                        $qrCode->writeFile($qrname);
                   
?>