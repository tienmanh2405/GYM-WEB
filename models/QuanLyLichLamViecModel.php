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
    SELECT lv.ngayLamViec, lv.caLamViec, u.userID, u.hoTen 
    FROM lichlamViec lv
    JOIN nguoidung u ON lv.userID = u.userID
    WHERE lv.ngayLamViec BETWEEN ? AND ?
    ORDER BY lv.ngayLamViec, lv.caLamViec
";
$stmt = $this->conn->prepare($sql);
$stmt->bind_param('ss', $startDate, $endDate);
$stmt->execute();
$result = $stmt->get_result();
        
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
            $user = "{$row['hoTen']} - {$row['userID']}";

            // Gắn dữ liệu vào từng ca làm việc
            $workingSchedule[$day][$shift][] = $user;
        }
        
        // Trả về mảng dữ liệu lịch làm việc
        return $workingSchedule;
    }

    public function isUserExist($userID) {
        $sql = "SELECT userID FROM nguoidung WHERE userID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0; // Trả về true nếu tồn tại, ngược lại false
    }

    public function getEmployeeList() {
        $sql = "SELECT userID, hoTen, vaiTro FROM nguoidung where vaiTro= 'NVQuay' Or vaiTro='HuongDanVien' or vaiTro='NVBaoTri'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $employees = [];
        while ($row = $result->fetch_assoc()) {
            $employees[] = $row;
        }
        return $employees;
    }
    
    
    public function addEmployeeToSchedule($date, $shift, $userID) {
        // Kiểm tra nếu userID tồn tại trong bảng nguoidung
        if (!$this->isUserExist($userID)) {
            return ['success' => false, 'error' => 'User ID không tồn tại.'];
        }
    
        $sql = "INSERT INTO lichlamviec (ngayLamViec, caLamViec, userID) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sss', $date, $shift, $userID);
    
        if ($stmt->execute()) {
            return ['success' => true];
        } else {
            return ['success' => false, 'error' => $this->conn->error];
        }
    }
    
}
?>
