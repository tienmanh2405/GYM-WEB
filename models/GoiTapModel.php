<?php
require_once "../config/database.php";

class GoitapModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getGoitap() {
        // Truy vấn để lấy tất cả các gói tập
        $query = "SELECT * FROM goitap";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    // Hàm lấy tất cả các gói tập
    public function getAllGoitap($page, $limit) {
        $offset = ($page - 1) * $limit;
        $query = "SELECT * FROM goitap LIMIT $limit OFFSET $offset";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    // hàm số gói tập hiện tại
    public function getCurrentGoiTap() {
        $sql = "SELECT COUNT(*) as count FROM goitap";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['count'];
    }
    // Hàm lấy gói tập theo maGoiTap
    public function getGoitapById($maGoiTap) {
        $query = "SELECT maGoiTap, tenGoiTap, thoiHan, gia, moTa, anhGoiTap FROM goitap WHERE maGoiTap = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $maGoiTap);
        $stmt->execute();
        $result = $stmt->get_result();  // Lấy kết quả từ câu lệnh đã thực thi
        return $result;
    }    
    //
    public function getKhuyenMaiByGoiTap($maGoiTap) {
        $query = "
            SELECT km.maKhuyenMai, km.giamGia, km.moTa 
            FROM khuyenmai km
            INNER JOIN khuyenmai_goitap kmgt ON km.maKhuyenMai = kmgt.maKhuyenMai
            WHERE kmgt.maGoiTap = ? AND km.ngayBatDau <= NOW() AND km.ngayKetThuc >= NOW()
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $maGoiTap);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }    
    public function updatePackageStatus($idDangKy, $trangThai) {
        // Câu lệnh SQL
        $query = "UPDATE goidangky SET trangThai = ? WHERE idDangKy = ?";
    
        // Chuẩn bị câu lệnh
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            return ['success' => false, 'message' => 'Lỗi chuẩn bị truy vấn: ' . $this->conn->error];
        }
    
        // Gắn tham số
        $stmt->bind_param("si", $trangThai, $idDangKy);
    
        // Thực thi truy vấn
        return $result = $stmt->execute();
    }
    
}
?>
