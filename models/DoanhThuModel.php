<?php
require_once "../config/database.php";

class Revenue {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getRevenueDetails() {
        $sql = "SELECT 
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
                ORDER BY h.ngayThanhToan DESC";
    
        // Chuẩn bị truy vấn
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
    
        $result = $stmt->get_result(); // Lấy kết quả của truy vấn
        $data = [];
    
        while ($row = $result->fetch_assoc()) {
            $data[] = $row; // Thêm từng dòng vào mảng
        }
    
        return $data; // Trả về tất cả kết quả
    }
    
    
    

    public function getTodayRevenue() {
        $sql = "SELECT SUM(soTien) AS total_revenue FROM hoadon WHERE DATE(ngayThanhToan) = CURDATE()";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['total_revenue'] ?? 0;
    }
    public function getMonthlyRevenue($month) {
        $sql = "SELECT SUM(soTien) AS total_revenue FROM hoadon WHERE MONTH(ngayThanhToan) = $month";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['total_revenue']?? 0;
    }
    public function getYearlyRevenue($year) {
        $sql = "SELECT SUM(soTien) AS total_revenue FROM hoadon WHERE YEAR(ngayThanhToan) = $year";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['total_revenue']?? 0;
    }
}
?>
