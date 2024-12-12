<?php

require_once BASE_PATH . '/models/DoanhThuModel.php';
require_once BASE_PATH . '/models/ThanhVienModel.php';
require_once BASE_PATH . '/models/GoiTapModel.php';
require_once BASE_PATH . '/models/LichLamViecModel.php';
class ControllerLogin
{
    public function login()
    {
        $this->render('login');
    }

    protected function render($view, $data = [])
    {
        extract($data); // Truyền biến vào view
        require_once BASE_PATH . "/views/$view.php";
    }
}
?>