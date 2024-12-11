<?php
require_once BASE_PATH . '/config/database.php';

class ThietBiModel {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect(); 
    }

    public function getAllDevices() {
        $query = "SELECT * FROM thietbi"; 
        $result = mysqli_query($this->db, $query);
        $devices = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $devices[] = $row;
        }

        return $devices;
    }

    public function getDeviceCountByStatus() {
        $statuses = ['Đang sử dụng', 'Hỏng', 'Bảo trì', 'Không sử dụng'];
        $counts = [];
    
        foreach ($statuses as $status) {
            $query = "SELECT COUNT(*) as count FROM thietbi WHERE trangthai = '$status'";
            $result = mysqli_query($this->db, $query);
            $row = mysqli_fetch_assoc($result);
            $counts[$status] = $row['count'];
        }
    
        return $counts;
    }
}
?>