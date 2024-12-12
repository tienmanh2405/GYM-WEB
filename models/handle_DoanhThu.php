<?php
require_once '../models/DoanhThuModel.php';

header("Content-Type: application/json");

$revenueModel = new Revenue();
$data = $revenueModel->getLastThreeMonthsRevenue();

echo json_encode($data);
?>