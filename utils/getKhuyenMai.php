<?php
require_once "../config/database.php";
require_once "../models/GoitapModel.php";

if (isset($_GET['maGoiTap'])) {
    $maGoiTap = intval($_GET['maGoiTap']);
    $goiTapModel = new GoitapModel();
    $khuyenMaiList = $goiTapModel->getKhuyenMaiByGoiTap($maGoiTap);
    echo json_encode($khuyenMaiList);
} else {
    echo json_encode([]);
}
?>
