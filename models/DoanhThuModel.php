<?php
require_once "../config/database.php";

class Revenue {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getTodayRevenue() {
        $sql = "SELECT SUM(soTien) AS total_revenue FROM hoadon WHERE DATE(ngayThanhToan) = CURDATE()";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['total_revenue'] ?? 0;
    }
}
?>
