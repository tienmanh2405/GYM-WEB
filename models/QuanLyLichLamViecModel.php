<?php
require_once "../config/database.php";

class LichLamViec {
    private $conn;

    // Constructor để khởi tạo kết nối
    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Function để lấy lịch làm việc theo tuần
    public function getWorkingSchedule() {
        // Tính toán ngày bắt đầu và kết thúc của tuần hiện tại
        $currentDate = new DateTime();  // Ngày hiện tại
        $startOfWeek = clone $currentDate;  // Sao chép đối tượng ngày hiện tại
        $endOfWeek = clone $currentDate;  // Sao chép đối tượng ngày hiện tại

        // Tính ngày bắt đầu của tuần (Thứ 2)
        $startOfWeek->modify('monday this week');

        // Tính ngày kết thúc của tuần (Chủ Nhật)
        $endOfWeek->modify('sunday this week');

        // Định dạng ngày theo định dạng 'Y-m-d' để dùng trong SQL
        $startDate = $startOfWeek->format('Y-m-d');
        $endDate = $endOfWeek->format('Y-m-d');

        // Câu lệnh SQL truy vấn lịch làm việc
        $sql = "
    SELECT lv.maLich, lv.ngayLamViec, lv.caLamViec, u.userID, u.hoTen, u.vaiTro
    FROM lichlamViec lv
    JOIN nguoidung u ON lv.userID = u.userID
    WHERE lv.ngayLamViec BETWEEN '{$startDate}' AND '{$endDate}'
    ORDER BY lv.ngayLamViec, lv.caLamViec";
        
        // Thực thi truy vấn
        $result = $this->conn->query($sql);
        
        // Kiểm tra nếu có lỗi khi truy vấn
        if (!$result) {
            die("Lỗi khi truy vấn cơ sở dữ liệu: " . $this->conn->error);
        }

        // Tạo mảng để lưu dữ liệu lịch làm việc
        $workingSchedule = [];
        
        // Lặp qua kết quả và sắp xếp vào mảng
        while ($row = $result->fetch_assoc()) {
            $day = $row['ngayLamViec'];
            $shift = $row['caLamViec'];
            $user = "{$row['hoTen']} - {$row['vaiTro']}";
            $maLich = $row['maLich'];  // Lấy mã lịch từ kết quả


            // Gắn dữ liệu vào từng ca làm việc
            $workingSchedule[$day][$shift][] = [
                'user' => $user,
                'maLich' => $maLich  // Thêm maLich vào dữ liệu
            ];
            
        }
        
        // Trả về mảng dữ liệu lịch làm việc
        return $workingSchedule;
    }
}
?>
