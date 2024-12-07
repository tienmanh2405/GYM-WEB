<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
date_default_timezone_set('Asia/Ho_Chi_Minh');

/**
 * 
 *
 * @author CTT VNPAY
 */
require_once("./config.php");

$vnp_TxnRef = rand(1, 10000);
$vnp_Amount = $_POST['amount'];
$vnp_Locale = $_POST['language'];
$vnp_BankCode = $_POST['bankCode'];
$vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

$id = $_POST['id'];
$gia = $_POST['gia'];
$maKM = $_POST['maKM'];

$_SESSION['id'] = $id;
$_SESSION['maKM'] = $maKM;
$_SESSION['gia'] = $gia;

$inputData = array(
    "vnp_Version" => "2.1.0",
    "vnp_TmnCode" => $vnp_TmnCode,
    "vnp_Amount" => $vnp_Amount * 100,
    "vnp_Command" => "pay",
    "vnp_CreateDate" => date('YmdHis'),
    "vnp_CurrCode" => "VND",
    "vnp_IpAddr" => $vnp_IpAddr,
    "vnp_Locale" => $vnp_Locale,
    "vnp_OrderInfo" => "Thanh toan GD: " . $vnp_TxnRef,
    "vnp_OrderType" => "other",
    "vnp_ReturnUrl" => $vnp_Returnurl,
    "vnp_TxnRef" => $vnp_TxnRef,
    "vnp_ExpireDate" => $expire,
);

// Optionally add BankCode
if (isset($vnp_BankCode) && $vnp_BankCode != "") {
    $inputData['vnp_BankCode'] = $vnp_BankCode;
}

// Sort the data
ksort($inputData);

// Build the query string
$query = "";
$i = 0;
$hashdata = "";
foreach ($inputData as $key => $value) {
    if ($i == 1) {
        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
    } else {
        $hashdata .= urlencode($key) . "=" . urlencode($value);
        $i = 1;
    }
    $query .= urlencode($key) . "=" . urlencode($value) . '&';
}

$vnp_Url = $vnp_Url . "?" . $query;
if (isset($vnp_HashSecret)) {
    // Generate secure hash
    $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
    $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
}

// Redirect to VNPAY
header('Location: ' . $vnp_Url);
die();
