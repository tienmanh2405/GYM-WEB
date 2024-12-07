<?php



class GoiTapModel
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


    public function getAllGoiTap($thoiHan) {
        if ($thoiHan == 11) {
            $stmt = $this->conn->prepare("SELECT * FROM goitap WHERE thoiHan <= ?");
            $stmt->bind_param("i", $thoiHan);
        } elseif ($thoiHan == 12) {
            $stmt = $this->conn->prepare("SELECT * FROM goitap WHERE thoiHan >= ?");
            $stmt->bind_param("i", $thoiHan);
        } elseif ($thoiHan == 0) { 
            $stmt = $this->conn->prepare("SELECT * FROM goitap");
        } else {
            $stmt = $this->conn->prepare("SELECT * FROM goitap WHERE thoiHan = ?");
            $stmt->bind_param("i", $thoiHan);
        }
        
      
        $stmt->execute();
        $result = $stmt->get_result();
        
       
        $goiTap = [];
        while ($row = $result->fetch_assoc()) {
            $goiTap[] = $row;
        }
        
        return $goiTap;
    }

    public function getGoiTapIDModel($id) {
        $stmt = $this->conn->prepare("SELECT * FROM goitap WHERE maGoiTap = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $goiTap = $result->fetch_assoc();
        return $goiTap;
    }
       
       
    
}
