<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../models/GoiTapModel.php'; 
    $goiTapModel = new GoiTapModel();

    $idGoiTap = intval($_POST['idGoiTap']);
    $tenGoiTap = trim($_POST['tenGoiTap']);
    $thoiHan = trim($_POST['thoiHan']);
    $gia = trim($_POST['gia']);
    $moTa = trim($_POST['moTa']);
    
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

// Kiểm tra và xử lý hình ảnh
$anhGoiTap = null;
if (isset($_FILES['anhGoiTap']) && $_FILES['anhGoiTap']['error'] === UPLOAD_ERR_OK) {
    // Lấy thông tin tệp
    $filename = pathinfo($_FILES['anhGoiTap']['name'], PATHINFO_FILENAME);
    $extension = pathinfo($_FILES['anhGoiTap']['name'], PATHINFO_EXTENSION);

    // Các loại tệp được phép
    $allowedExtensions = array('jpg', 'jpeg', 'png');
    if (!in_array(strtolower($extension), $allowedExtensions)) {
        echo json_encode(['success' => false, 'message' => 'Chỉ cho phép upload hình ảnh có đuôi .jpg, .jpeg, .png.']);
        exit;
    }

    // Tạo tên file duy nhất với định dạng: năm_tháng_ngày_giờ_phút_giây_tênfile.giảimảidạng
    $uploadPath = date('Ymd_His') . '_' . $filename . '.' . $extension;
    $target_dir = "../asset/image/"; // Thư mục lưu trữ ảnh
    $target_file = $target_dir . $uploadPath;

    // Di chuyển file tải lên
    if (move_uploaded_file($_FILES['anhGoiTap']['tmp_name'], $target_file)) {
        $anhGoiTap = $uploadPath; // Lưu tên file để lưu vào cơ sở dữ liệu
    } else {
        echo json_encode(['success' => false, 'message' => 'Tải lên hình ảnh thất bại.']);
        exit;
    }
} else if (isset($_FILES['anhGoiTap']) && $_FILES['anhGoiTap']['error'] !== UPLOAD_ERR_NO_FILE) {
    echo json_encode(['success' => false, 'message' => 'Lỗi upload hình ảnh.']);
    exit;
}

    // Thực hiện cập nhật gói tập
    $result = $goiTapModel->editGoiTap($tenGoiTap, $thoiHan, $gia, $moTa, $anhGoiTap, $idGoiTap);

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
