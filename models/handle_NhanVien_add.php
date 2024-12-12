<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //dữ liệu và kiểm tra dữ liệu của Thêm nhân viên
    require_once '../models/NhanVienModel.php';
    $nhanVienModel = new Employees();

    $hoTen = trim($_POST['hoTen']);
    $email = trim($_POST['email']);
    $sdt = trim($_POST['sdt']);
    $ngaySinh = $_POST['ngaySinh'];
    $vaiTro = $_POST['vaiTro'];
    $matKhau = trim($_POST['matKhau']);

    // Kiểm tra họ tên
    if (empty($hoTen) || !preg_match('/^[a-zA-Z\s]+$/u', $hoTen)) {
        echo json_encode(['success' => false, 'message' => 'Họ tên không hợp lệ.']);
        exit;
    }

    // Kiểm tra email
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Email không hợp lệ.']);
        exit;
    }

    // Kiểm tra email trùng
    if ($nhanVienModel->checkEmailExists($email)) {
        echo json_encode(['success' => false, 'message' => 'Email đã tồn tại.']);
        exit;
    }

    // Kiểm tra số điện thoại
    if (empty($sdt) || !preg_match('/^\d{10}$/', $sdt)) {
        echo json_encode(['success' => false, 'message' => 'Số điện thoại phải bao gồm 10 chữ số.']);
        exit;
    }

    // Kiểm tra số điện thoại trùng
    if ($nhanVienModel->checkPhoneExists($sdt)) {
        echo json_encode(['success' => false, 'message' => 'Số điện thoại đã tồn tại.']);
        exit;
    }

    // Kiểm tra ngày sinh
    if (empty($ngaySinh) || strtotime($ngaySinh) > time()) {
        echo json_encode(['success' => false, 'message' => 'Ngày sinh không hợp lệ.']);
        exit;
    }

    // Kiểm tra vai trò
    if (empty($vaiTro)) {
        echo json_encode(['success' => false, 'message' => 'Vai trò không hợp lệ.']);
        exit;
    }

    // Kiểm tra mật khẩu
    if (empty($matKhau) || strlen($matKhau) < 6) {
        echo json_encode(['success' => false, 'message' => 'Mật khẩu phải có ít nhất 6 ký tự.']);
        exit;
    }


    // Thêm nhân viên
    $resultNhanVien = $nhanVienModel->addNhanVien($hoTen, $email, $sdt, $ngaySinh, $vaiTro, $matKhau);
    if ($resultNhanVien) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Thêm nhân viên thất bại.']);
   }

}



?>



