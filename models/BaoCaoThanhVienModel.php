<?php
require_once "../config/database.php";

class BaoCaoThanhVienModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }
    // hàm thành viên hiện tại
    public function getCurrentMembers() {
        $sql = "SELECT COUNT(*) as count FROM nguoidung WHERE vaiTro = 'ThanhVien'";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['count'];
    }
    // hàm lấy danh sách thành viên
    public function getMembers($page, $limit) {
        // Assuming you have a "role" column in your "thanhvien" table
        $offset = ($page - 1) * $limit;
        $query = "SELECT * FROM nguoidung WHERE vaiTro = 'ThanhVien' ORDER BY userID DESC LIMIT $offset, $limit";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    

    // hàm lấy thời gian lần cuối check-in của thành viên 
    public function getLastWorkoutTime($userID) {
        $query = "SELECT MAX(thoiGianVao) as lastWorkout FROM lichsuhoatdong WHERE userID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['lastWorkout'] ?? null;
    }

    //hàm lấy tên gói đăng ký được thành viên mua thường xuyên nhất
    public function getMostFrequentGoiByUserID($userID) {
        $query = "
            SELECT g.tenGoiTap AS tenGoi, COUNT(*) AS count 
            FROM goidangky gd
            JOIN goitap g ON gd.maGoiTap = g.maGoiTap
            WHERE gd.userID = ?
            GROUP BY g.tenGoiTap
            ORDER BY count DESC
            LIMIT 1
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['tenGoi'] ?? 'Chưa có'; // Trả về 'N/A' nếu không có gói nào
    }
    
}
?>
