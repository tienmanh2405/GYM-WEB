<?php
require_once "../config/database.php";

class GoiTapModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }
    //Đếm số lượng gói tập hiện tại
    public function getCurrentGoiTap() {
        $sql = "SELECT COUNT(*) as count FROM goitap ";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['count'];
    }
    // hàm lấy danh sách gói tập
    public function getGoiTap($page, $limit) {
        $offset = ($page - 1) * $limit;
        $query = "SELECT * FROM goitap LIMIT $limit OFFSET $offset";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC); 
    }

    public function addGoiTap($tenGoiTap, $thoiHan, $gia, $moTa, $anhGoiTap) {
        // Kiểm tra nếu giá trị các tham số quan trọng khác rỗng
        if (empty($tenGoiTap) || empty($thoiHan) || empty($gia) || empty($moTa) || empty($anhGoiTap)) {
            return false;
        }
        
        // Câu truy vấn thêm gói tập
        $query = "INSERT INTO goitap (tenGoiTap, thoiHan, gia, moTa, anhGoiTap) VALUES (?,?,?,?,?)";

        $stmt = $this->conn->prepare($query);

        // Kiểm tra nếu prepare() thành công
        if (!$stmt) {
            return false; // Trả về false nếu chuẩn bị câu lệnh thất bại
        }

        // Sử dụng bind_param và truyền đúng số lượng tham số
        $stmt->bind_param("sssss", $tenGoiTap, $thoiHan, $gia, $moTa, $anhGoiTap);

        // Thực thi câu lệnh
        if ($stmt->execute()) {
            return true; // Thêm thành công
        } else {
            return false; // Thêm thất bại, có thể thêm $stmt->error để lấy thông báo chi tiết
        }
    }


    // edit gói tập
    public function editGoiTap($tenGoiTap, $thoiHan, $gia, $moTa, $anhGoiTap, $idGoiTap) {
        if ($anhGoiTap) {
            $query = "UPDATE goitap SET tenGoiTap = ?, thoiHan = ?, gia = ?, moTa = ?, anhGoiTap = ? WHERE maGoiTap = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("sssssi", $tenGoiTap, $thoiHan, $gia, $moTa, $anhGoiTap, $idGoiTap);
        } else {
            $query = "UPDATE goitap SET tenGoiTap = ?, thoiHan = ?, gia = ?, moTa = ? WHERE maGoiTap = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("ssssi", $tenGoiTap, $thoiHan, $gia, $moTa, $idGoiTap);
        }
    
        return $stmt->execute();
    }

    public function deleteGoiTap($idGoiTap) {
        // Kiểm tra nếu giá trị $idGoiTap rỗng
        if (empty($idGoiTap)) {
            return false; // Nếu idGoiTap rỗng, trả về false
        }
        
        // Câu truy vấn xóa gói tập
        $query = "DELETE FROM goitap WHERE maGoiTap = ?";
        
        $stmt = $this->conn->prepare($query);
        
        // Kiểm tra nếu prepare() thành công
        if (!$stmt) {
            return false; // Trả về false nếu chuẩn bị câu lệnh thất bại
        }
        
        // Sử dụng bind_param và truyền đúng số lượng tham số
        $stmt->bind_param("i", $idGoiTap);
        
        // Thực thi câu lệnh
        if ($stmt->execute()) {
            return true; // Xóa thành công
        } else {
            return false; // Xóa thất bại, có thể thêm $stmt->error để lấy thông báo chi tiết
        }
    }

    
//thêm gói tập Tên Gói Tập	Thời Hạn (Tháng)	Giá (VND)	Mô Tả
    // public function addGoiTap($tenGoiTap, $thoiHan, $gia, $moTa) {
    //     $sql = "INSERT INTO goitap (tenGoiTap, thoiHan, gia, moTa) VALUES (?,?,?,?)";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->bind_param("ssss", $tenGoiTap, $thoiHan, $gia, $moTa);
    //     $stmt->execute();
    //     return $this->conn->insert_id;
    // }

    // public function getGoiDangKyByUserID($userID) {
    //     // Truy vấn lấy thông tin gói đăng ký của gói tập theo userID
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
