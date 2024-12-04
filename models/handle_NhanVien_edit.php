<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../models/NhanVienModel.php';
    $nhanVienModel = new Employees();

    // Lấy dữ liệu từ POST
    $idNhanVien = intval($_POST['idNhanVien']);
    $hoTen = trim($_POST['hoTen']);
    $email = trim($_POST['email']);
    $sdt = trim($_POST['sdt']);
    $ngaySinh = $_POST['ngaySinh'];
    $vaiTro = $_POST['vaiTro'];

    // Kiểm tra dữ liệu đầu vào
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

    if (empty($vaiTro)) {
        echo json_encode(['success' => false, 'message' => 'Vai trò không hợp lệ.']);
        exit;
    }

    // Thực hiện sửa nhân viên
    $result = $nhanVienModel->editNhanVien($hoTen, $email, $sdt, $ngaySinh, $vaiTro, $idNhanVien);

    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Cập nhật thành công!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Cập nhật thất bại.']);
    }
}
?>
