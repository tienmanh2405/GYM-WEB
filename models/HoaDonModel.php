<?php



class HoaDonModel
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

    public function addHoaDon($idDangKy, $phuongThucThanhToan, $soTien, $maKhuyenMai)
    {
        try {
            if ($maKhuyenMai == null) {
                $stmt = $this->conn->prepare('
                    INSERT INTO hoadon(idDangKy, ngayTao, phuongThucThanhToan, soTien, maKhuyenMai, ngayThanhToan) 
                    VALUES (?, NOW(), ?, ?, NULL, NOW())
                ');
                $stmt->bind_param("isd", $idDangKy, $phuongThucThanhToan, $soTien);
            }
             else {
                $stmt = $this->conn->prepare('
                INSERT INTO hoadon(idDangKy, ngayTao, phuongThucThanhToan, soTien, maKhuyenMai, ngayThanhToan) 
                VALUES (?, NOW(), ?, ?, ?, NOW())
                ');
                $stmt->bind_param("isdi", $idDangKy, $phuongThucThanhToan, $soTien, $maKhuyenMai);
            }
            if ($stmt->execute()) {
                echo "Hóa đơn đã được thêm thành công!";
            } else {
                throw new Exception("Lỗi thực thi truy vấn: " . $stmt->error);
            }


            $stmt->close();
        } catch (Exception $e) {
            echo "Đã xảy ra lỗi: " . $e->getMessage();
        }
    }
}
