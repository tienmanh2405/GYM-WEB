<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../models/GoiTapModel.php'; // Đảm bảo gọi đúng file model
    $goiTapModel = new GoiTapModel();

    // Lấy dữ liệu từ POST
    $idGoiTap = intval($_POST['idGoiTap']);
    $tenGoiTap = trim($_POST['tenGoiTap']);
    $thoiHan = trim($_POST['thoiHan']);
    $gia = trim($_POST['gia']);
    $moTa = trim($_POST['moTa']); // Bổ sung trim() để loại bỏ khoảng trắng

    // Kiểm tra dữ liệu đầu vào
    if (empty($idGoiTap) || empty($tenGoiTap) || empty($thoiHan) || empty($gia) || empty($moTa)) {
        echo json_encode([
            'success' => false,
            'message' => 'Thông tin gói tập không được để trống.'
        ]);
        exit;
    }

    // Thực hiện sửa gói tập
    $result = $goiTapModel->editGoiTap($tenGoiTap, $thoiHan, $gia, $moTa, $idGoiTap);

    if ($result) {
        echo json_encode([
            'success' => true,
            'message' => 'Cập nhật gói tập thành công!'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Cập nhật gói tập thất bại.'
        ]);
    }
}
?>
