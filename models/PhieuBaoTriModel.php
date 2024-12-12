<?php
require_once BASE_PATH . '/config/database.php';

class PhieuBaoTriModel
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function getAllThietBi()
    {
        $query = "SELECT maThietBi FROM thietbi";
        $result = $this->db->query($query);
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function getNextMaBaoTri()
    {
        $query = "SELECT COALESCE(MAX(maBaoTri), 0) + 1 AS nextMaBaoTri FROM phieubaotri";
        $result = $this->db->query($query);
        return $result ? $result->fetch_assoc()['nextMaBaoTri'] : 1;
    }

    public function getAllUsers()
    {
        $query = "SELECT userID FROM nvbaotri";
        $result = $this->db->query($query);
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function insertPhieuBaoTri($data)
    {
        $query = "INSERT INTO phieubaotri (maBaoTri, maThietBi, userID, ngayBaoTri, trangThai) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("iiiss", $data['maBaoTri'], $data['maThietBi'], $data['userID'], $data['ngayBaoTri'], $data['trangThai']);
        return $stmt->execute();
    }
}
?>