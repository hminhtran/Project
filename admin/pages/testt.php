<?php $ch = curl_init('http://localhost/website/admin/pages/get_promo.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);

if ($response === false) {
    die("Lỗi cURL: " . curl_error($ch));
}

curl_close($ch);

$json_data = json_decode($response, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    die("JSON lỗi: " . json_last_error_msg());
}

echo "<pre>";
print_r($json_data);
echo "</pre>";
