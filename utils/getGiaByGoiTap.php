<?php
require_once "../config/database.php";
require_once "../models/GoiTapModel.php";

if (isset($_GET['maGoiTap'])) {
    $maGoiTap = intval($_GET['maGoiTap']);
    $GoiTapModel = new GoiTapModel();
    $giaGoiTap = $GoiTapModel->getGiaByGoiTap($maGoiTap);
    
    if ($giaGoiTap) {
        echo json_encode(['gia' => $giaGoiTap]);
    } else {
        echo json_encode(['gia' => null]);  // Trả về null nếu không có giá
    }
} else {
    echo json_encode(['gia' => null]);  // Trả về null nếu không có maGoiTap
}
?>
