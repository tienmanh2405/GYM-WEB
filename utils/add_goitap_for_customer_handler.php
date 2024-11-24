<?php
header('Content-Type: application/json; charset=utf-8');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once '../models/ThanhVienModel.php';
    require_once '../models/GoiTapModel.php';
    require_once '../models/HoaDonModel.php';
    // Lấy dữ liệu từ form
    $userID = $_POST['userID'];
    $customerName = $_POST['customerName'];
    $customerEmail = $_POST['customerEmail'];
    $customerPhone = $_POST['customerPhone'];
    $maGoiTap = $_POST['maGoiTap'];
    $maKhuyenMai = $_POST['maKhuyenMai'];
    $phuongThucThanhToan = $_POST['phuongThucThanhToan'];
    $giaSauKhuyenMai = $_POST['giaSauKhuyenMai'];
    // Kiểm tra gói tập có tồn tại không
    $goitap = new GoitapModel();
    $result  = $goitap->getGoitapById($maGoiTap);
    if ($result->num_rows > 0) {
        // lấy thoiGian cua GOI tap
        $row = $result->fetch_assoc();
        
        // Kiểm tra xem key 'thoiGian' có tồn tại trong $row không
        if (isset($row['thoiHan'])) {
            $thoiGian = $row['thoiHan'];
            $tenGoiTap = $row['tenGoiTap'];
        } else {
            echo "Không có thông tin về 'thoiGian' trong cơ sở dữ liệu.";
            // Xử lý lỗi nếu 'thoiGian' không tồn tại
        }
        // Thêm gói tập cho khách hàng
        $thanhvien = new Member();
        // Kiểm tra nếu insert thành công
        if ($userID) {
            $trangThai = "Đang chờ thanh toán"; 
            $idDangKy = $thanhvien->addMemberGoiDangKy($userID, $maGoiTap, $thoiGian, $trangThai);

            if ($idDangKy) {
            // Nếu thêm thành công, tạo hóa đơn
            $hoaDonModel = new HoaDonModel();
            $ngayThanhToan = null;

            // Tạo hóa đơn
            $hoaDon = $hoaDonModel->createInvoice($idDangKy, $maGoiTap, $giaSauKhuyenMai, $phuongThucThanhToan, $maKhuyenMai, $ngayThanhToan);

            // Trả về kết quả cho người dùng
            if ($hoaDon) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Gói tập đã được thêm thành công.',
                    'idDangKy' => $idDangKy,
                    'invoice' => $hoaDon, 
                    'tenGoiTap' => $tenGoiTap
                ]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Không thể tạo hóa đơn.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Không thể thêm gói tập.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Gói tập không tồn tại.']);
    }
}
}
?>
