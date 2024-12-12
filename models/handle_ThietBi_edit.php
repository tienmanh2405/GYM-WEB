<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../models/ThietBiModel.php';
    $thietBiModel = new Equipment();

    // Lấy dữ liệu từ POST
    $idThietBi = intval($_POST['idThietBi']);
    $tenThietBi = trim($_POST['tenThietBi']);
    $ngayMua = $_POST['ngayMua'];
    $trangThai = $_POST['trangthai'];

    // Kiểm tra dữ liệu đầu vào
    // Thiết lập múi giờ
    date_default_timezone_set('Asia/Ho_Chi_Minh'); // Đặt múi giờ Việt Nam
    if (empty($ngayMua)) {
        echo json_encode(['success' => false, 'message' => 'Ngày mua không được để trống.']);
        exit;
    }
    $currentDate = date('Y-m-d');

// So sánh ngày mua với ngày hiện tại
if (strtotime($ngayMua) > strtotime($currentDate)) {
    echo json_encode(['success' => false, 'message' => 'Ngày mua thiết bị phải bé hơn hoặc bằng ngày hiện tại.']);
    exit;
}

    $validTrangThai = ['Đang sử dụng', 'Hỏng', 'Bảo trì', 'Không sử dụng'];
    if (!in_array($trangThai, $validTrangThai)) {
        echo json_encode(['success' => false, 'message' => 'Trạng thái không hợp lệ.']);
        exit;
    }

//     // Thiết lập múi giờ
// date_default_timezone_set('Asia/Ho_Chi_Minh'); // Đặt múi giờ Việt Nam

// Kiểm tra và xử lý hình ảnh
$hinhAnh = null;
if (isset($_FILES['hinhAnh']) && $_FILES['hinhAnh']['error'] === UPLOAD_ERR_OK) {
    // Lấy thông tin tệp
    $filename = pathinfo($_FILES['hinhAnh']['name'], PATHINFO_FILENAME);
    $extension = pathinfo($_FILES['hinhAnh']['name'], PATHINFO_EXTENSION);

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
    if (move_uploaded_file($_FILES['hinhAnh']['tmp_name'], $target_file)) {
        $hinhAnh = $uploadPath; // Lưu tên file để lưu vào cơ sở dữ liệu
    } else {
        echo json_encode(['success' => false, 'message' => 'Tải lên hình ảnh thất bại.']);
        exit;
    }
} else if (isset($_FILES['hinhAnh']) && $_FILES['hinhAnh']['error'] !== UPLOAD_ERR_NO_FILE) {
    echo json_encode(['success' => false, 'message' => 'Lỗi upload hình ảnh.']);
    exit;
}

    // Thực hiện sửa thông tin thiết bị
    $result = $thietBiModel->editThietBi( $tenThietBi, $ngayMua, $trangThai, $hinhAnh, $idThietBi);

    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Cập nhật thiết bị thành công!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Cập nhật thiết bị thất bại.']);
    }
}
?>
