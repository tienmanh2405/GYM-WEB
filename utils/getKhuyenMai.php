<?php
require_once "../config/database.php";
require_once "../models/GoiTapModel.php";

if (isset($_GET['maGoiTap'])) {
    $maGoiTap = intval($_GET['maGoiTap']);
    $GoiTapModel = new GoiTapModel();
    $khuyenMaiList = $GoiTapModel->getKhuyenMaiByGoiTap($maGoiTap);
    echo json_encode($khuyenMaiList);
} else {
    echo json_encode([]);
}
?>
