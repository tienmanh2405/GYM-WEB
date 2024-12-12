<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../models/ThietBiModel.php';
    $thietBiModel = new Equipment();
    $tenThietBi = trim($_POST['tenThietBi']);
    $ngayMua = $_POST['ngayMua'];
    $trangThai = $_POST['trangthai'];
    $hinhAnh = $_FILES['hinhAnh'];

    // Kiểm tra dữ liệu
    // Kiểm tra ký tự đặc biệt trong tên thiết bị
if (!preg_match('/^[a-zA-Z0-9\s]+$/u', $tenThietBi)) {
    echo json_encode(['success' => false, 'message' => 'Tên thiết bị không được chứa ký tự đặc biệt.']);
    exit;
}
    // Thiết lập múi giờ
date_default_timezone_set('Asia/Ho_Chi_Minh'); // Đặt múi giờ Việt Nam

// Kiểm tra nếu $ngayMua không tồn tại hoặc rỗng
if (!isset($ngayMua) || empty($ngayMua)) {
    echo json_encode(['success' => false, 'message' => 'Vui lòng nhập ngày mua thiết bị.']);
    exit;
}

// Lấy ngày hiện tại (chỉ bao gồm Y-m-d)
$currentDate = date('Y-m-d');

// So sánh ngày mua với ngày hiện tại
if (strtotime($ngayMua) > strtotime($currentDate)) {
    echo json_encode(['success' => false, 'message' => 'Ngày mua thiết bị phải bé hơn hoặc bằng ngày hiện tại.']);
    exit;
}
    if ($trangThai == "") {
        echo json_encode(['success' => false, 'message' => 'Trạng thái thiết bị không hợp lệ.']);
        exit;
    }
    // Kiểm tra tệp hình ảnh
    if ($hinhAnh['error'] > 0) {
        echo json_encode(['success' => false, 'message' => 'Lỗi upload hình ảnh.']);
        exit;
    }
    $filename = pathinfo($hinhAnh['name'], PATHINFO_FILENAME);
    $extension = pathinfo($hinhAnh['name'], PATHINFO_EXTENSION);
    $allowedExtensions = array('jpg', 'jpeg', 'png');
    if (!in_array(strtolower($extension), $allowedExtensions)) {
        echo json_encode(['success' => false, 'message' => 'Chỉ cho phép upload hình ảnh có đuôi.jpg,.jpeg,.png.']);
        exit;
    }
    $uploadPath = date('Ymd_His') . '_' . $filename . '.' . $extension; //năm tháng ngày_giờ phút giây.tênfile 
    $target_dir = "../asset/image/";
    $target_file = $target_dir . $uploadPath;
    move_uploaded_file($hinhAnh['tmp_name'], $target_file);

    //thêm thiết bị
    $resultThietBi = $thietBiModel->addThietBi($tenThietBi, $ngayMua, $trangThai, $uploadPath);
    if ($resultThietBi) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Thêm thiết bị thất bại.']);
    }
}
?>