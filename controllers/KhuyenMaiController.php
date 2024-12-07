<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/KhuyenMaiModel.php';


class KhuyenMaiController
{
    private $km;
    private $db;
    public function __construct()
    {
        $this->db = new Database();
        $this->km = new KhuyenMaiModel();
    }
       public function getKM($id)
    {
        $data = $this->km->getID($id);
        return $data;
    }
}
