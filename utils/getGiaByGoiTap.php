<?php
require_once "../config/database.php";
require_once "../models/GoitapModel.php";

if (isset($_GET['maGoiTap'])) {
    $maGoiTap = intval($_GET['maGoiTap']);
    $goiTapModel = new GoitapModel();
    $giaGoiTap = $goiTapModel->getGiaByGoiTap($maGoiTap);
    
    if ($giaGoiTap) {
        echo json_encode(['gia' => $giaGoiTap]);
    } else {
        echo json_encode(['gia' => null]);  // Trả về null nếu không có giá
    }
} else {
    echo json_encode(['gia' => null]);  // Trả về null nếu không có maGoiTap
}
?>
