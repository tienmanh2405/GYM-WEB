<?php
require_once "../config/database.php";

class Member {
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
    // hàm tính check-in hôm nay
    public function getTodayCheckIns() {
        $sql = "SELECT COUNT(*) as count FROM lichsuhoatdong WHERE DATE(thoiGianVao) = CURDATE()";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['count'];
    }
    //hàm tính thành viên đăng kí mới hôm nay
    public function getNewRegistrations() {
        $sql = "SELECT COUNT(*) as count FROM thanhvien WHERE DATE(ngayDangKy) = CURDATE()";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['count'];
    }
    // hàm lấy danh sách thành viên
    public function getMembers($page, $limit) {
        $offset = ($page - 1) * $limit;
        $query = "SELECT * FROM nguoidung WHERE vaiTro = 'ThanhVien' LIMIT $limit OFFSET $offset";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC); 
    }
    public function getGoiDangKyByUserID($userID) {
        // Truy vấn lấy thông tin gói đăng ký của thành viên theo userID
        $query = "SELECT idDangKy, userID, maGoiTap, ngayHetHan, trangThai, ngayMua 
                  FROM goidangky 
                  WHERE userID = ?";
    
        // Chuẩn bị câu truy vấn
        $stmt = $this->conn->prepare($query);
        
        // Liên kết tham số (trong trường hợp userID là chuỗi hoặc số)
        $stmt->bind_param("i", $userID);  // "i" là kiểu dữ liệu của userID (int)
    
        // Thực thi câu truy vấn
        $stmt->execute();
    
        // Lấy kết quả truy vấn
        $result = $stmt->get_result();
    
        // Trả về tất cả các kết quả dưới dạng mảng
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insert($id) {
        $stmt = $this->conn->prepare('INSERT INTO thanhvien (userID, ngayDangKy) VALUES (?, NOW())'); // Sử dụng NOW() để lấy thời gian thực
        $stmt->bind_param('i', $id); // Chỉ truyền userID
        if ($stmt->execute()) {
            return true; 
        } else {
            throw new Exception("Lỗi: " . $stmt->error); // Ném lỗi nếu có vấn đề
        }
    }
}
?>
