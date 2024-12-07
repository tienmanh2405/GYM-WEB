<?php



class OrderModel
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
        if (!$this->conn) {
            die("Không thể kết nối tới cơ sở dữ liệu.");
        }
    }


    public function getAllOrder()
    {


        $stmt = $this->conn->prepare("select *form hoadon");

        $stmt->execute();
        $result = $stmt->get_result();


        $goiTap = [];
        while ($row = $result->fetch_assoc()) {
            $goiTap[] = $row;
        }

        return $goiTap;
    }

    public function add($userID, $goiTap)
    {
        $stmt = $this->conn->prepare("SELECT thoiHan FROM goitap WHERE maGoiTap = ?");
        $stmt->bind_param("s", $goiTap); // Truyền tham số vào truy vấn
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if (!$row) {
            return "Gói tập không tồn tại!";
        }
        $thoiHan = $row['thoiHan'];
        $time_now = date('Y-m-d H:i:s');

        $ngayHetHan = date('Y-m-d H:i:s', strtotime("+$thoiHan months", strtotime($time_now)));

        $stmt = $this->conn->prepare("INSERT INTO goidangky (userID, maGoiTap, ngayHetHan, trangThai, ngayMua) VALUES (?, ?, ?, ?, ?)");
        $trangThai = 1;
        $stmt->bind_param("issis", $userID, $goiTap, $ngayHetHan, $trangThai, $time_now);

        if ($stmt->execute()) {
            $lastInsertedId = $this->conn->insert_id;
            return [
                "message" => "Thêm gói đăng ký thành công!",
                "id" => $lastInsertedId
            ];
        } else {
            return "Lỗi khi thêm gói đăng ký: " . $stmt->error;
        }
    }
   

    public function getOrderUser($id) {
        try {
            // Chuẩn bị câu truy vấn
            $stmt = $this->conn->prepare("
                SELECT 
                    goitap.tenGoiTap,
                    goitap.gia,
                    goitap.maGoiTap,
                    goidangky.trangthai,
                    goidangky.idDangKy,
                    goidangky.ngaymua,
                    goidangky.ngayhethan
                FROM 
                    goidangky
                INNER JOIN 
                    goitap ON goidangky.maGoiTap = goitap.maGoiTap
                WHERE 
                    goidangky.userID = ?
            ");
    
            // Kiểm tra nếu câu lệnh chuẩn bị không thành công
            if (!$stmt) {
                throw new Exception("Lỗi chuẩn bị truy vấn: " . $this->conn->error);
            }
    
            // Liên kết tham số
            $stmt->bind_param("i", $id);
    
            // Thực thi câu truy vấn
            $stmt->execute();
    
            // Lấy kết quả truy vấn
            $result = $stmt->get_result();
    
            // Khởi tạo mảng để lưu dữ liệu
            $orders = [];
            while ($row = $result->fetch_assoc()) {
                $orders[] = $row;
            }
    
            // Đóng câu lệnh
            $stmt->close();
    
            // Trả về danh sách đơn hàng
            return $orders;
        } catch (Exception $e) {
            echo "Đã xảy ra lỗi: " . $e->getMessage();
            return [];
        }
    }

    public function giaHan($id, $soThangGiaHan)
    {
      
        $stmt = $this->conn->prepare("SELECT ngayHetHan FROM goidangky WHERE idDangKy = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if (!$row) {
            return "Gói đăng ký không tồn tại!";
        }
        $ngayHetHanHienTai = $row['ngayHetHan'];
        $newNgayHetHan = date('Y-m-d H:i:s', strtotime("+$soThangGiaHan months", strtotime($ngayHetHanHienTai)));
    
     
        $stmt = $this->conn->prepare("UPDATE goidangky SET ngayHetHan = ? WHERE idDangKy = ?");
        $stmt->bind_param("si", $newNgayHetHan, $id);
    
        if ($stmt->execute()) {
            return "Gia hạn gói đăng ký thành công! Thời gian hết hạn mới là: " . $newNgayHetHan;
        } else {
            return "Lỗi khi gia hạn gói đăng ký: " . $stmt->error;
        }
    }

   
    
}
