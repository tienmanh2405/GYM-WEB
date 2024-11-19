<?php
require_once "../config/database.php";

class Employees {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }
    //Đếm số lượng nhân viên hiện tại
    public function getCurrentEmployees() {
        $sql = "SELECT COUNT(*) as count FROM nguoidung WHERE vaiTro = 'NVQuay' or vaiTro = 'NVBaoTri'";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['count'];
    }
    // hàm lấy danh sách thành viên
    public function getEmployees($page, $limit) {
        $offset = ($page - 1) * $limit;
        $query = "SELECT * FROM nguoidung WHERE vaiTro = 'NVQuay' or vaiTro = 'NVBaoTri' LIMIT $limit OFFSET $offset";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC); 
    }
    // public function getGoiDangKyByUserID($userID) {
    //     // Truy vấn lấy thông tin gói đăng ký của thành viên theo userID
    //     $query = "SELECT idDangKy, userID, maGoiTap, ngayHetHan, trangThai, ngayMua 
    //               FROM goidangky 
    //               WHERE userID = ?";
    
    //     // Chuẩn bị câu truy vấn
    //     $stmt = $this->conn->prepare($query);
        
    //     // Liên kết tham số (trong trường hợp userID là chuỗi hoặc số)
    //     $stmt->bind_param("i", $userID);  // "i" là kiểu dữ liệu của userID (int)
    
    //     // Thực thi câu truy vấn
    //     $stmt->execute();
    
    //     // Lấy kết quả truy vấn
    //     $result = $stmt->get_result();
    
    //     // Trả về tất cả các kết quả dưới dạng mảng
    //     return $result->fetch_all(MYSQLI_ASSOC);
    // }
    
}
?>
