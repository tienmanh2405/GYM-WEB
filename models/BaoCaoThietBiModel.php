<?php
require_once "../config/database.php";

class BaoCaoThietBiModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }
    //Đếm số lượng thiết bị hiện tại
    public function getCurrentEquipment() {
        $sql = "SELECT COUNT(*) as count FROM thietbi ";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['count'];
    }
    // hàm lấy danh sách thiết bị
    public function getEquipment($page, $limit) {
        $offset = ($page - 1) * $limit;
        $query = "SELECT * FROM thietbi LIMIT $limit OFFSET $offset";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC); 
    }

    //Hàm lấy trạng thái bảo trì
    public function getEquipmentStatus($idThietBi) {
        $query = "SELECT trangthai as trangThaiBaoTri FROM phieubaotri WHERE maThietBi =?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $idThietBi);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['trangThaiBaoTri'] ?? 'Chưa bảo trì lần nào';
    }

    //Hàm tính số lần bảo trì của thiết bị
    public function getEquipmentMaintenanceCount($idThietBi) {
        $query = "SELECT COUNT(*) as count FROM phieubaotri WHERE maThietBi =?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $idThietBi);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['count'];
    }

    //Hàm tính ngày bảo trì gần nhất
    public function getLatestMaintenanceDate($idThietBi) {
        $query = "SELECT MAX(ngayBaoTri) as latestDate FROM phieubaotri WHERE maThietBi =?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $idThietBi);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['latestDate'];
    }
    
}
?>
