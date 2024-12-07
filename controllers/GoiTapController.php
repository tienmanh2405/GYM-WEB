<?php 

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/GoiTapModel.php';


class GoiTapController {
    private $goiTap;
    private $db;
    public function __construct()
    {
        $this->db = new Database();
        $this->goiTap = new GoiTapModel();
    }
    public function getAllGoiTap($thoiHan) {
        $goiTap = $this->goiTap->getAllGoiTap($thoiHan);
        return $goiTap;
    }

    public function getGoiTapID($id) {
        $goiTap = $this->goiTap->getGoiTapIDModel($id);
        return $goiTap;
    }

    


}