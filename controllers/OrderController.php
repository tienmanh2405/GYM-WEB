<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/OrderModel.php';


class OrderController
{
    private $order;
    private $db;
    public function __construct()
    {
        $this->db = new Database();
        $this->order = new OrderModel();
    }
    public function add($userID, $goiTapId)
    {
        $order = $this->order->add($userID, $goiTapId);
        return $order;
    }
    public function getGoiTapUser($id)
    {
        $order = $this->order->getOrderUser($id);
        return $order;
    }

    public function giaHanGoiTap($id,$soThang){
        $order = $this ->order ->giaHan($id,$soThang);
        return $order;
    }
}
