<?php
require_once "../config/database.php";

class LichSuHoatDong {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Phương thức lấy trạng thái check-in của người dùng
    public function getCheckinStatusByUserID($userID) {
        $sql = "SELECT * FROM lichsuhoatdong WHERE userID = ? AND trangthai = 'checkin' AND thoiGianRa IS NULL";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $userID); // "i" là kiểu dữ liệu integer
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();  // Trả về bản ghi check-in nếu có
    }

    // Phương thức tạo bản ghi check-in mới
    public function createCheckinRecord($userID, $thoiGianVao) {
        $sql = "INSERT INTO lichsuhoatdong (userID, thoiGianVao, trangthai) VALUES (?, ?, 'checkin')";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("is", $userID, $thoiGianVao);  // "i" cho integer, "s" cho string (thời gian)
        return $stmt->execute();  // Trả về true nếu thành công, false nếu có lỗi
    }

    // Phương thức cập nhật thời gian ra và trạng thái checkout
    public function updateCheckoutRecord($userID, $thoiGianRa) {
        $sql = "UPDATE lichsuhoatdong SET thoiGianRa = ?, trangthai = 'checkout' WHERE userID = ? AND trangthai = 'checkin' AND thoiGianRa IS NULL";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $thoiGianRa, $userID);  // "s" cho string (thời gian)
        return $stmt->execute();  // Trả về true nếu thành công, false nếu có lỗi
    }
}
?>
