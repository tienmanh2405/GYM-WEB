<?php
class HoaDonModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function createInvoice($idDangKy, $maGoiTap, $soTien, $phuongThucThanhToan, $maKhuyenMai, $ngayThanhToan) {
        $ngayTao = date("Y-m-d");
        // Thêm hóa đơn vào cơ sở dữ liệu
        $sql = "INSERT INTO hoadon (idDangKy, phuongThucThanhToan, soTien, maKhuyenMai, ngayThanhToan ,ngayTao)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("isisss", $idDangKy, $phuongThucThanhToan, $soTien, $maKhuyenMai, $ngayThanhToan, $ngayTao);
        if ($stmt->execute()) {
            // Trả về hóa đơn vừa được tạo
            $hoaDonId = $stmt->insert_id;
            return ['maHoaDon' => $hoaDonId, 'idDangKy' => $idDangKy, 'soTien' => $soTien, 'phuongThucThanhToan' => $phuongThucThanhToan];
        } else {
            return false;
        }
    }
    public function updateInvoiceStatus($maHoaDon, $idDangKy, $ngayThanhToan, $trangThai) {
        // Câu lệnh SQL
        $query = "UPDATE hoadon SET ngayThanhToan = ?, trangThai = ? WHERE maHoaDon = ? AND idDangKy = ?";
        
        // Chuẩn bị câu lệnh
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            return ['success' => false, 'message' => 'Lỗi chuẩn bị truy vấn: ' . $this->conn->error];
        }
    
        // Gắn tham số
        $stmt->bind_param("ssii", $ngayThanhToan, $trangThai, $maHoaDon, $idDangKy);
    
        // Thực thi truy vấn
        return $result = $stmt->execute();
        
    }
}
?>
