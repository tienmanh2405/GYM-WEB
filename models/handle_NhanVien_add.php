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

    // Kiểm tra dữ liệu Thêm nhân viên
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

    if (strlen($matKhau) < 6) {
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

   //Xóa nhân viên
    if (isset($_POST['deleteUserID'])) {
        $deleteUserID = $_POST['deleteUserID'];
        $resultXoaNhanVien = $nhanVienModel->deleteNhanVien($deleteUserID);
        
        if ($resultXoaNhanVien) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Xóa nhân viên thất bại.']);
        }
    }
}



?>



