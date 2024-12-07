<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/HoaDonModel.php';


class HoaDonController
{
    private $hd;
    private $db;
    public function __construct()
    {
        $this->db = new Database();
        $this->hd = new HoaDonModel();
    }
    public function add($idDangKy,$soTien,$maKhuyenMai)
    {
        $phuongThucThanhToan = 'Thẻ tín dụng';
        $data = $this->hd->addHoaDon($idDangKy, $phuongThucThanhToan, $soTien, $maKhuyenMai);
       
        if (!$data) {
            return "Không thể thêm hóa đơn. Vui lòng thử lại.";
        }
        echo '<script>alert("Đặt hàng thành công!"); window.history.back();</script>';
    
        return $data;
    }
    
}