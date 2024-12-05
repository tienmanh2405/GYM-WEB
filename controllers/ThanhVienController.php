<?php 
require_once __DIR__ . '/../models/ThanhVienModel.php';
class ThanhVienController{
    private $member;
    private $db;

    public function __construct()
    {
        $this->db = new Database();  
        $this->connection = $this->db->connect();  // Gọi phương thức connect() để kết nối với cơ sở dữ liệu
        $this->member = new Member($this->db);
    }

    public function insert($id){
        $member = $this->member->insert($id);
    }
}

?>