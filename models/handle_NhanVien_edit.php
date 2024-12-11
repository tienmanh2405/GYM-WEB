<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../models/NhanVienModel.php';
    $nhanVienModel = new Employees();

    // Lấy dữ liệu từ POST
    $idNhanVien = isset($_POST['idNhanVien']) ? intval($_POST['idNhanVien']) : null;

    // $idNhanVien = intval($_POST['idNhanVien']);
    $hoTen = trim($_POST['hoTen']);
    $email = trim($_POST['email']);
    $sdt = trim($_POST['sdt']);
    $ngaySinh = $_POST['ngaySinh'];
    $vaiTro = $_POST['vaiTro'];
    //Lấy thông tin của nhân viên cũ
    $oldEmployee = $nhanVienModel->getNhanVienById($idNhanVien);

  // Kiểm tra họ tên hợp lệ
  if (!preg_match('/^[a-zA-Z\s]+$/u', $hoTen)) {
    echo json_encode(['success' => false, 'message' => 'Họ tên không được chứa ký tự đặc biệt và chữ số.']);
    exit;
}
//Kiểm tra email hợp lệ hay không
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Email không hợp lệ!']);
    exit;
}
//Kiểm tra email trùng
if ($nhanVienModel->checkEmailExists($email, $idNhanVien)) {
    echo json_encode(['success' => false, 'message' => 'Email đã tồn tại!']);
    exit;
}

if ($nhanVienModel->checkPhoneExists($sdt, $idNhanVien)) {
    echo json_encode(['success' => false, 'message' => 'Số điện thoại đã tồn tại!']);
    exit;
}
//Kiểm tra sdt hợp lệ
if (!preg_match('/^\d{10}$/', $sdt)) {
    echo json_encode(['success' => false, 'message' => 'Số điện thoại phải bao gồm 10 chữ số.']);
    exit;
}
//Kiểm tra ngày sinh
if (strtotime($ngaySinh) > time()) {
    echo json_encode(['success' => false, 'message' => 'Ngày sinh không được lớn hơn ngày hiện tại.']);
    exit;
}
//Kiểm tra vai trò
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
