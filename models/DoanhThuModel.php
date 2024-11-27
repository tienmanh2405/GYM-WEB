<?php
require_once "../config/database.php";

class Revenue {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getCurrentDoanhThu() {
        $query = "SELECT COUNT(*) as count FROM hoadon ";
        $result = $this->conn->query($query);
        $row = $result->fetch_assoc();
        return $row['count'];
    }
    
    public function getRevenueDetails($page, $limit) {
        $offset = ($page - 1) * $limit;
        $query = "SELECT 
                h.ngayThanhToan, 
                n.hoTen AS tenKhachHang, 
                g.tenGoiTap, 
                g.gia AS donGia, 
                h.soTien AS tongTien
            FROM hoadon h 
            INNER JOIN goidangky gd ON h.idDangKy = gd.idDangKy
            INNER JOIN nguoidung n ON gd.userID = n.userID
            INNER JOIN goitap g ON gd.maGoiTap = g.maGoiTap
            WHERE h.ngayThanhToan IS NOT NULL
            ORDER BY h.ngayThanhToan DESC
            LIMIT $limit OFFSET $offset";
    
        // Chuẩn bị truy vấn
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC); 
    }

//
public function getAvailableYears() {
    $query = "SELECT DISTINCT YEAR(ngayThanhToan) AS year FROM hoadon ORDER BY year DESC";
    $result = $this->conn->query($query);
    return $result->fetch_all(MYSQLI_ASSOC);
}
    public function getRevenueDetailsByYear($year) {
        $query = "SELECT 
                    h.ngayThanhToan, 
                    n.hoTen AS tenKhachHang, 
                    g.tenGoiTap, 
                    g.gia AS donGia, 
                    h.soTien AS tongTien
                FROM hoadon h 
                INNER JOIN goidangky gd ON h.idDangKy = gd.idDangKy
                INNER JOIN nguoidung n ON gd.userID = n.userID
                INNER JOIN goitap g ON gd.maGoiTap = g.maGoiTap
                WHERE YEAR(h.ngayThanhToan) = ?
                ORDER BY h.ngayThanhToan DESC";
    
        // Chuẩn bị truy vấn
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $year);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTodayRevenue() {
        $query = "SELECT SUM(soTien) AS total_revenue FROM hoadon WHERE DATE(ngayThanhToan) = CURDATE()";
        $result = $this->conn->query($query);
        $row = $result->fetch_assoc();
        return $row['total_revenue'] ?? 0;
    }
}
?>
