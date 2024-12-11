<?php
require_once BASE_PATH . '/config/database.php';

class KhuyenMaiModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
        $this->db->connect();
    }

    // Lấy tất cả khuyến mãi
    public function getAllKhuyenMai()
    {
        $query = "SELECT maKhuyenMai, giamGia, ngayBatDau, ngayKetThuc, moTa FROM khuyenmai";
        $result = $this->db->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllMaGoiTap()
    {
        $query = "SELECT maGoiTap FROM goitap"; // Câu lệnh SQL để lấy danh sách mã gói tập
        $result = $this->db->conn->query($query);
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    // Thêm khuyến mãi
    public function addKhuyenMai($maKhuyenMai, $giamGia, $ngayBatDau, $ngayKetThuc, $moTa)
    {
        $query = "INSERT INTO khuyenmai (maKhuyenMai, giamGia, ngayBatDau, ngayKetThuc, moTa) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->conn->prepare($query);
        $stmt->bind_param("issss", $maKhuyenMai, $giamGia, $ngayBatDau, $ngayKetThuc, $moTa);
        return $stmt->execute();
    }

    // Thêm khuyến mãi
    public function addKhuyenMaiGoiTap($maKhuyenMai, $maGoiTap)
    {
        $query = "INSERT INTO khuyenmai_goitap (maKhuyenMai, maGoiTap) VALUES (?, ?)";
        $stmt = $this->db->conn->prepare($query);
        $stmt->bind_param("is", $maKhuyenMai, $maGoiTap);
        return $stmt->execute();
    }

    // Sửa khuyến mãi
    public function updateKhuyenMai($maKhuyenMai, $giamGia, $ngayBatDau, $ngayKetThuc)
    {
        $query = "UPDATE khuyenmai SET giamGia = ?, ngayBatDau = ?, ngayKetThuc = ? WHERE maKhuyenMai = ?";
        $stmt = $this->db->conn->prepare($query);
        $stmt->bind_param("issi", $giamGia, $ngayBatDau, $ngayKetThuc, $maKhuyenMai);
        return $stmt->execute();
    }

    // Xóa khuyến mãi
    public function deleteKhuyenMai($maKhuyenMai)
{
    // Bắt đầu giao dịch
    $this->db->conn->begin_transaction();

    // Xóa dữ liệu từ bảng khuyenmai_goitap
    $query1 = "DELETE FROM khuyenmai_goitap WHERE maKhuyenMai = ?";
    $stmt1 = $this->db->conn->prepare($query1);
    $stmt1->bind_param("i", $maKhuyenMai);
    $stmt1->execute();

    // Xóa dữ liệu từ bảng khuyenmai
    $query2 = "DELETE FROM khuyenmai WHERE maKhuyenMai = ?";
    $stmt2 = $this->db->conn->prepare($query2);
    $stmt2->bind_param("i", $maKhuyenMai);
    $stmt2->execute();

    // Cam kết giao dịch
    $this->db->conn->commit();

    return true; // Trả về true nếu xóa thành công
}
}
?>