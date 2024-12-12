<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //dữ liệu và kiểm tra dữ liệu của Thêm nhân viên
    require_once '../models/GoiTapModel.php';
    $goiTapModel = new GoiTapModel();
    $tenGoiTap = trim($_POST['tenGoiTap']);
    $thoiHan = $_POST['thoiHan'];
    $gia = $_POST['gia'];
    $moTa = trim($_POST['moTa']);
    $anhGoiTap = $_FILES['anhGoiTap'];


    // Kiểm tra dữ liệu
    if (empty($tenGoiTap) || empty($thoiHan) || empty($gia) || empty($moTa)) {
        echo json_encode(['success' => false, 'message' => 'Thông tin gói tập không được để trống.']);
        exit;
    }
    // Kiểm tra thời hạn phải là số nguyên dương và không được là số lẻ
if (!is_numeric($thoiHan) || $thoiHan <= 0) {
    echo json_encode(['success' => false, 'message' => 'Thời hạn phải là số nguyên dương']);
    exit;
}
if (!preg_match('/^\d+$/', $thoiHan)) {
    echo json_encode(['success' => false, 'message' => 'Thời hạn phải là số và không có ký tự đặc biệt']);
    exit;
}
//kiểm tra giá tiền
if (!preg_match('/^\d+$/', $gia) || $gia <= 0) {
    echo json_encode(['success' => false, 'message' => 'Giá tiền chỉ được chứa số và phải là số dương.']);
    exit;
}
    // Thiết lập múi giờ
date_default_timezone_set('Asia/Ho_Chi_Minh'); // Đặt múi giờ Việt Nam
    // Kiểm tra tệp hình ảnh
    if ($anhGoiTap['error'] > 0) {
        echo json_encode(['success' => false, 'message' => 'Lỗi upload hình ảnh.']);
        exit;
    }
    $filename = pathinfo($anhGoiTap['name'], PATHINFO_FILENAME);
    $extension = pathinfo($anhGoiTap['name'], PATHINFO_EXTENSION);
    $allowedExtensions = array('jpg', 'jpeg', 'png');
    if (!in_array(strtolower($extension), $allowedExtensions)) {
        echo json_encode(['success' => false, 'message' => 'Chỉ cho phép upload hình ảnh có đuôi.jpg,.jpeg,.png.']);
        exit;
    }
    $uploadPath = date('Ymd_His') . '_' . $filename . '.' . $extension; //năm tháng ngày_giờ phút giây.tênfile 
    $target_dir = "../asset/image/";
    $target_file = $target_dir . $uploadPath;
    move_uploaded_file($anhGoiTap['tmp_name'], $target_file);

    // Thêm gói tập
    $resultGoiTap = $goiTapModel->addGoiTap($tenGoiTap, $thoiHan, $gia, $moTa, $uploadPath);

    if ($resultGoiTap) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Thêm gói tập thất bại.']);
    }

}
?>