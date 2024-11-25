<?php
require_once "../config/database.php";

class Equipment {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }
    //Đếm số lượng thiết bị hiện tại
    public function getCurrentEquipment() {
        $sql = "SELECT COUNT(*) as count FROM thietbi ";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['count'];
    }
    // hàm lấy danh sách thiết bị
    public function getEquipment($page, $limit) {
        $offset = ($page - 1) * $limit;
        $query = "SELECT * FROM thietbi LIMIT $limit OFFSET $offset";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC); 
    }

    public function addThietBi($tenThietBi, $ngayMua, $trangThai, $hinhAnh) {
        // Kiểm tra nếu giá trị $tenThietBi và các tham số quan trọng khác rỗng
        if (empty($tenThietBi) || empty($ngayMua) || empty($trangThai) || empty($hinhAnh)) {
            return false; // Nếu có tham số rỗng, trả về false
        }

        // Câu truy vấn thêm thiết bị
        $query = "INSERT INTO thietbi (tenThietBi, ngayMua, trangthai, hinhAnh) VALUES (?,?,?,?)";

        $stmt = $this->conn->prepare($query);

        // Kiểm tra nếu prepare() thành công
        if (!$stmt) {
            return false; // Trả về false nếu chuẩn bị câu lệnh thất bại
        }

        // Sử dụng bind_param và truyền đúng số lượng tham số
        $stmt->bind_param("ssss", $tenThietBi, $ngayMua, $trangThai, $hinhAnh);

        // Thực thi câu lệnh
        if ($stmt->execute()) {
            return true; // Thêm thành công
        } else {
            return false; // Thêm thất bại, có thể thêm $stmt->error để lấy thông báo chi tiết
        }
    }

// Xóa thiết bị
public function deleteThietBi($idThietBi) {
    // Kiểm tra nếu giá trị $idThietBi rỗng
    if (empty($idThietBi)) {
        return false; // Nếu $idThietBi rỗng, trả về false
    }
    
    // Câu truy vấn xóa thiết bị
    $query = "DELETE FROM thietbi WHERE maThietBi = ?";
    
    $stmt = $this->conn->prepare($query);
    
    // Kiểm tra nếu prepare() thành công
    if (!$stmt) {
        return false; // Trả về false nếu chuẩn bị câu lệnh thất bại
    }
    
    // Sử dụng bind_param và truyền đúng số lượng tham số
    $stmt->bind_param("i", $idThietBi);
    
    // Thực thi câu lệnh
    if ($stmt->execute()) {
        return true; // Xóa thành công
    } else {
        return false; // Xóa thất bại, có thể thêm $stmt->error để lấy thông báo chi tiết
    }
}

    // public function getGoiDangKyByUserID($userID) {
    //     // Truy vấn lấy thông tin gói đăng ký của thiết bị theo userID
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
