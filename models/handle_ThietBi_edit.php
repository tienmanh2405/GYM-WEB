<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../models/ThietBiModel.php';
    $thietBiModel = new Equipment();

    // Lấy dữ liệu từ POST
    $idThietBi = intval($_POST['idThietBi']);
    $tenThietBi = trim($_POST['tenThietBi']);
    $ngayMua = $_POST['ngayMua'];
    $trangThai = $_POST['trangThai'];
    $hinhAnh = trim($_POST['hinhAnh']);

    // Kiểm tra dữ liệu đầu vào
    if (empty($tenThietBi)) {
        echo json_encode(['success' => false, 'message' => 'Tên thiết bị không được để trống.']);
        exit;
    }

    if (empty($ngayMua)) {
        echo json_encode(['success' => false, 'message' => 'Ngày mua không được để trống.']);
        exit;
    }

    $validTrangThai = ['Đang sử dụng', 'Hỏng', 'Bảo trì', 'Không sử dụng'];
    if (!in_array($trangThai, $validTrangThai)) {
        echo json_encode(['success' => false, 'message' => 'Trạng thái không hợp lệ.']);
        exit;
    }

    if (empty($hinhAnh)) {
        echo json_encode(['success' => false, 'message' => 'Hình ảnh không được để trống.']);
        exit;
    }

    // Thực hiện sửa thông tin thiết bị
    $result = $thietBiModel->editThietBi($idThietBi, $tenThietBi, $ngayMua, $trangThai, $hinhAnh);

    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Cập nhật thiết bị thành công!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Cập nhật thiết bị thất bại.']);
    }
}
?>
