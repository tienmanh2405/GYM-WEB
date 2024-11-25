<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //dữ liệu và kiểm tra dữ liệu của Thêm nhân viên
    require_once '../models/GoiTapModel.php';
    $goiTapModel = new GoiTapModel();
    $tenGoiTap = trim($_POST['tenGoiTap']);
    $thoiHan = $_POST['thoiHan'];
    $gia = $_POST['gia'];
    $moTa = trim($_POST['moTa']);

    
    

    // Kiểm tra dữ liệu
    if (empty($tenGoiTap) || empty($thoiHan) || empty($gia) || empty($moTa)) {
        echo json_encode(['success' => false, 'message' => 'Thông tin gói tập không được để trống.']);
        exit;
    }
    

    // Thêm gói tập
    $resultGoiTap = $goiTapModel->addGoiTap($tenGoiTap, $thoiHan, $gia, $moTa);

    if ($resultGoiTap) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Thêm gói tập thất bại.']);
    }

}
?>