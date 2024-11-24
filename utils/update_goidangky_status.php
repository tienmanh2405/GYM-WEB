<?php
    header('Content-Type: application/json; charset=utf-8');
    require_once '../models/GoiTapModel.php';
    $goitap = new GoitapModel();

    $data = json_decode(file_get_contents('php://input'), true);
    $idDangKy = $data['idDangKy'];
    $trangThai = $data['trangThai'];

    $result  = $goitap->updatePackageStatus($idDangKy, $trangThai);

    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Không thể cập nhật trạng thái gói']);
    }

?>