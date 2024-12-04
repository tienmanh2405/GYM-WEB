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
        $sql = "SELECT COUNT(*) as count FROM nguoidung WHERE vaiTro = 'NVQuay' or vaiTro = 'NVBaoTri' or vaiTro = 'NVHuongDanVien'";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['count'];
    }
    // hàm lấy danh sách thành viên
    public function getEmployees($page, $limit) {
        $offset = ($page - 1) * $limit;
        $query = "SELECT * FROM nguoidung WHERE vaiTro = 'NVQuay' or vaiTro = 'NVBaoTri' or vaiTro = 'NVHuongDanVien' LIMIT $limit OFFSET $offset";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC); 
    }

    public function addNhanVien($hoTen, $email, $sdt, $ngaySinh, $vaiTro, $matKhau) {
        // Kiểm tra nếu giá trị $hoTen và các tham số quan trọng khác rỗng
        if (empty($hoTen) || empty($email) || empty($sdt) || empty($ngaySinh) || empty($vaiTro) || empty($matKhau)) {
            return false; // Nếu có tham số rỗng, trả về false
        }

        $hashedPassword = password_hash($matKhau, PASSWORD_BCRYPT); // Mã hóa mật khẩu

        // Câu truy vấn thêm nhân viên
        $query = "INSERT INTO nguoidung (hoTen, email, sdt, ngaySinh, vaiTro, matKhau) VALUES (?,?,?,?,?,?)";

        $stmt = $this->conn->prepare($query);

        // Kiểm tra nếu prepare() thành công
        if (!$stmt) {
            return false; // Trả về false nếu chuẩn bị câu lệnh thất bại
        }

        // Sử dụng bind_param và truyền đúng số lượng tham số
        $stmt->bind_param("ssssss", $hoTen, $email, $sdt, $ngaySinh, $vaiTro, $hashedPassword);

        // Thực thi câu lệnh
        if ($stmt->execute()) {
            return true; // Thêm thành công
        } else {
            return false; // Thêm thất bại, có thể thêm $stmt->error để lấy thông báo chi tiết
        }
    }

    // edit nhân viên
    public function editNhanVien($hoTen, $email, $sdt, $ngaySinh, $vaiTro, $idNhanVien) {
        // Câu truy vấn cập nhật thông tin nhân viên
        $query = "UPDATE nguoidung SET hoTen = ?, email = ?, sdt = ?, ngaySinh = ?, vaiTro = ? WHERE userID = ?";
        
        $stmt = $this->conn->prepare($query);
        
        // Kiểm tra nếu prepare() thành công
        if (!$stmt) {
            return false; // Trả về false nếu chuẩn bị câu lệnh thất bại
        }
        
        // Sử dụng bind_param và truyền đúng số lượng tham số
        $stmt->bind_param("sssssi", $hoTen, $email, $sdt, $ngaySinh, $vaiTro, $idNhanVien);
        
        // Thực thi câu lệnh
        if ($stmt->execute()) {
            return true; // Cập nhật thành công
        } else {
            return false; // Cập nhật thất bại
        }
    }
    

    // Xóa nhân viên
    public function deleteNhanVien($idNhanVien) {
        // Kiểm tra nếu giá trị $idNhanVien rỗng
        if (empty($idNhanVien)) {
            return false; // Nếu idNhanVien rỗng, trả về false
        }
        
        // Câu truy vấn xóa nhân viên
        $query = "DELETE FROM nguoidung WHERE userID = ?";
        
        $stmt = $this->conn->prepare($query);
        
        // Kiểm tra nếu prepare() thành công
        if (!$stmt) {
            return false; // Trả về false nếu chuẩn bị câu lệnh thất bại
        }
        
        // Sử dụng bind_param và truyền đúng số lượng tham số
        $stmt->bind_param("i", $idNhanVien);
        
        // Thực thi câu lệnh
        if ($stmt->execute()) {
            return true; // Xóa thành công
        } else {
            return false; // Xóa thất bại, có thể thêm $stmt->error để lấy thông báo chi tiết
        }
    }

    public function getNhanVienById($idNhanVien) {
        $idNhanVien = $_GET['userID'];
        $query = "SELECT * FROM nguoidung WHERE userID = $idNhanVien";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $idNhanVien);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    
}
?>
