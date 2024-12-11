<?php
require_once "../config/database.php";

class LichLamViec {
    private $conn;

    // Constructor để khởi tạo kết nối
    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getWorkingSchedule($nextWeek = false) {
        $currentDate = new DateTime();
        if ($nextWeek) {
            $currentDate->modify('+1 week'); // Chuyển sang tuần kế tiếp
        }
        $startOfWeek = clone $currentDate;
        $endOfWeek = clone $currentDate;
    
        $startOfWeek->modify('monday this week');
        $endOfWeek->modify('sunday this week');
    
        $startDate = $startOfWeek->format('Y-m-d');
        $endDate = $endOfWeek->format('Y-m-d');
        // Debug xem ngày tháng có đúng không
    
        $sql = "
            SELECT lv.ngayLamViec, lv.caLamViec, u.userID, u.hoTen 
            FROM lichlamViec lv
            JOIN nguoidung u ON lv.userID = u.userID
            WHERE lv.ngayLamViec BETWEEN '{$startDate}' AND '{$endDate}'
            ORDER BY lv.ngayLamViec, lv.caLamViec";
        
        $result = $this->conn->query($sql);
    
        if (!$result) {
            die("Lỗi khi truy vấn cơ sở dữ liệu: " . $this->conn->error);
        }
    
        $workingSchedule = [];
        while ($row = $result->fetch_assoc()) {
            $day = $row['ngayLamViec'];
            $shift = $row['caLamViec'];
            $user = "{$row['hoTen']} - {$row['userID']}";
            $workingSchedule[$day][$shift][] = $user;
        }
    
        return $workingSchedule;
    }  
}
?>
