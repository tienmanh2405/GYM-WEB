<?php



class KhuyenMaiModel
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

    public function getID($id){
        $stmt = $this ->conn -> prepare('select * from khuyenmai where khuyenmai.maKhuyenMai = ?');
        $stmt -> bind_param('i',$id);
        $stmt -> execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        return $data;
    }






    
       
    
}
