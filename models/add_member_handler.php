<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../models/ThanhVienModel.php';
    $thanhVienModel = new Member();

    $hoTen = trim($_POST['hoTen']);
    $email = trim($_POST['email']);
    $sdt = trim($_POST['sdt']);
    $ngaySinh = $_POST['ngaySinh'];
    $matKhau = trim($_POST['matKhau']);

    // Kiểm tra dữ liệu
    if (empty($hoTen)) {
        echo json_encode(['success' => false, 'message' => 'Họ tên không được để trống.']);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Email không hợp lệ.']);
        exit;
    }

    if (!preg_match('/^\d{10}$/', $sdt)) {
        echo json_encode(['success' => false, 'message' => 'Số điện thoại phải bao gồm 10 chữ số.']);
        exit;
    }

    if (empty($ngaySinh)) {
        echo json_encode(['success' => false, 'message' => 'Ngày sinh không được để trống.']);
        exit;
    }

    if (strlen($matKhau) < 6) {
        echo json_encode(['success' => false, 'message' => 'Mật khẩu phải có ít nhất 6 ký tự.']);
        exit;
    }

    // Thêm thành viên
    $result = $thanhVienModel->addThanhVien($hoTen, $email, $sdt, $ngaySinh, $matKhau);

    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Thêm thành viên thất bại.']);
    }
}
?>
