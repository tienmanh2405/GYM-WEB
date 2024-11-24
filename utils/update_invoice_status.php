<?php
    header('Content-Type: application/json; charset=utf-8');
    $data = json_decode(file_get_contents('php://input'), true);
    $maHoaDon = $data['maHoaDon'];
    $ngayThanhToan = $data['ngayThanhToan'];
    $trangThai = $data['trangThai'];
    $idDangKy = $data['idDangKy'];
    
    // Cập nhật trạng thái hóa đơn và ngày thanh toán
    require_once "../models/HoaDonModel.php";
    require_once "../config/database.php";
    $hoaDonModel = new HoaDonModel();
    $hoaDon = $hoaDonModel->updateInvoiceStatus($maHoaDon, $idDangKy, $ngayThanhToan, $trangThai);
    
    if ($hoaDon) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Không thể cập nhật hóa đơn']);
    }
?>