<?php
require_once 'LichSuHoatDongModel.php';

header('Content-Type: application/json');

// Đọc dữ liệu JSON từ yêu cầu
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['action']) || !isset($data['userID'])) {
    echo json_encode(['success' => false, 'message' => 'Dữ liệu không hợp lệ.']);
    exit;
}

$action = $data['action'];
$userID = $data['userID'];
$model = new LichSuHoatDong(); // Khởi tạo đối tượng model
date_default_timezone_set('Asia/Ho_Chi_Minh');

if ($action === 'checkin') {
    $thoiGianVao = date('Y-m-d H:i:s');
    if ($model->createCheckinRecord($userID, $thoiGianVao)) {
        echo json_encode(['success' => true, 'message' => 'Check-in thành công!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Không thể check-in.']);
    }
} elseif ($action === 'checkout') {
    $thoiGianRa = date('Y-m-d H:i:s');
    if ($model->updateCheckoutRecord($userID, $thoiGianRa)) {
        echo json_encode(['success' => true, 'message' => 'Check-out thành công!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Không thể check-out.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Hành động không hợp lệ.']);
}
