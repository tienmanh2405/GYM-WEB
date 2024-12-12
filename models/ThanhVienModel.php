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
    public function getMembersByUserID($userID) {
        $query = "SELECT * FROM nguoidung WHERE vaiTro = 'ThanhVien' AND userID = ?";
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            die("Chuẩn bị câu truy vấn thất bại: " . $this->conn->error);
        }
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        if (!$result) {
            die("Thực thi câu truy vấn thất bại: " . $stmt->error);
        }
        return $result->fetch_assoc();
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
    public function addThanhVien($hoTen, $email, $sdt, $ngaySinh, $matKhau) {
        // Kiểm tra nếu giá trị $hoTen và các tham số quan trọng khác rỗng
        if (empty($hoTen) || empty($email) || empty($sdt) || empty($ngaySinh) || empty($matKhau)) {
            return false; // Nếu có tham số rỗng, trả về false
        }
    
        $hashedPassword = password_hash($matKhau, PASSWORD_BCRYPT); // Mã hóa mật khẩu
    
        $query = "INSERT INTO nguoidung (hoTen, email, sdt, ngaySinh, matKhau, vaiTro) 
                  VALUES (?, ?, ?, ?, ?, 'ThanhVien')";
    
        $stmt = $this->conn->prepare($query);
    
        // Kiểm tra nếu prepare() thành công
        if (!$stmt) {
            return false; // Trả về false nếu chuẩn bị câu lệnh thất bại
        }
    
        // Sử dụng bind_param và truyền đúng số lượng tham số
        $stmt->bind_param("sssss", $hoTen, $email, $sdt, $ngaySinh, $hashedPassword);
    
        // Thực thi câu lệnh
        if ($stmt->execute()) {
            return true; // Thêm thành công
        } else {
            return false; // Thêm thất bại, có thể thêm $stmt->error để lấy thông báo chi tiết
        }
    }
    public function addMemberGoiDangKy($userID, $maGoiTap, $thoiGian, $trangThai) {
        // Kiểm tra nếu các tham số đầu vào bị rỗng
        if (empty($userID) || empty($maGoiTap) || empty($thoiGian) || empty($trangThai)) {
            return false; // Trả về false nếu thiếu thông tin
        }
    
        // Lấy ngày hiện tại
        $ngayMua = date("Y-m-d");
    
        // Tính toán ngày hết hạn dựa trên thời gian của gói tập (giả sử $thoiGian là số tháng)
        $ngayHetHan = date('Y-m-d', strtotime("+$thoiGian months", strtotime($ngayMua)));
    
        // Chuẩn bị câu truy vấn để chèn dữ liệu vào bảng goidangky
        $query = "INSERT INTO goidangky (userID, maGoiTap, ngayHetHan, trangThai, ngayMua) 
                  VALUES (?, ?, ?, ?, ?)";
    
        $stmt = $this->conn->prepare($query);
    
        // Kiểm tra nếu chuẩn bị statement thất bại
        if (!$stmt) {
            // In ra lỗi và trả về false nếu không thể chuẩn bị câu truy vấn
            error_log("Lỗi chuẩn bị câu lệnh: " . $this->conn->error);
            return false;
        }
    
        $stmt->bind_param("issss", $userID, $maGoiTap, $ngayHetHan, $trangThai, $ngayMua);
    
        if ($stmt->execute()) {
            // Trả về ID của bản ghi vừa chèn
            return $this->conn->insert_id;
        } else {
            // In ra lỗi và trả về false nếu thực thi thất bại
            error_log("Lỗi thực thi câu lệnh: " . $stmt->error);
            return false;
        }
    }
    function hasActivePackage($userId) {
        // Chuẩn bị câu lệnh SQL để kiểm tra gói hoạt động
        $query = "SELECT COUNT(*) AS total FROM goidangky WHERE userID = ? AND trangThai = 'Đang hoạt động'";
        $stmt = $this->conn->prepare($query);
        if ($stmt) {
            // Liên kết tham số
            $stmt->bind_param('i', $userId);
            $stmt->execute();
            
            // Lấy kết quả
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                return $row['total'] > 0; // Kiểm tra nếu số lượng > 0
            }
        }
        
        return false; // Mặc định trả về false nếu không có kết quả
    }
}
?>
