<?php
require_once BASE_PATH . '/config/config.php';
require_once BASE_PATH . '/models/KhuyenMaiModel.php';

class HomeController_KhuyenMai
{
    private $khuyenMaiModel;

    public function __construct()
    {
        $this->khuyenMaiModel = new KhuyenMaiModel();
    }

    // Hiển thị danh sách tất cả khuyến mãi
    public function index()
    {
        $khuyenMais = $this->khuyenMaiModel->getAllKhuyenMai();
        $maGoiTapList = $this->khuyenMaiModel->getAllMaGoiTap();
        require_once BASE_PATH . '/views/NV_BaoTri/quanlykhuyenmai/QuanLyKhuyenMai.php';
    }
    
    // Tạo khuyến mãi mới
    public function create()
    {
        $maGoiTapList = $this->khuyenMaiModel->getAllMaGoiTap(); 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $maKhuyenMai = $_POST['maKhuyenMai'];
            $giamGia = $_POST['giamGia'];
            $ngayBatDau = $_POST['ngayBatDau'];
            $ngayKetThuc = $_POST['ngayKetThuc'];
            $moTa = $_POST['moTa'];
            $maGoiTap = $_POST['maGoiTap']; 
            $this->khuyenMaiModel->addKhuyenMai($maKhuyenMai, $giamGia, $ngayBatDau, $ngayKetThuc, $moTa);
            $this->khuyenMaiModel->addKhuyenMaiGoiTap($maKhuyenMai, $maGoiTap); 
            header('Location: ' . BASE_URL . 'NV_BaoTri/quanlykhuyenmai');
            exit();
        }
        require_once BASE_PATH . '/views/NV_BaoTri/quanlykhuyenmai/QuanLyKhuyenMai.php'; 
    }

    // Cập nhật thông tin khuyến mãi
    public function update()
    {
        $maGoiTapList = $this->khuyenMaiModel->getAllMaGoiTap(); 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $maKhuyenMai = $_POST['maKhuyenMai'];
            $giamGia = $_POST['giamGia'];
            $ngayBatDau = $_POST['ngayBatDau'];
            $ngayKetThuc = $_POST['ngayKetThuc'];
            $moTa = $_POST['moTa'];
            $this->khuyenMaiModel->updateKhuyenMai($maKhuyenMai, $giamGia, $ngayBatDau, $ngayKetThuc, $moTa);
            header('Location: ' . BASE_URL . 'NV_BaoTri/quanlykhuyenmai');
            exit();
        }
        require_once BASE_PATH . '/views/NV_BaoTri/quanlykhuyenmai/QuanLyKhuyenMai.php'; // Đảm bảo gọi view ở đây
    }

    // Xóa khuyến mãi theo mã
    public function delete($maKhuyenMai)
    {
        if ($this->khuyenMaiModel->deleteKhuyenMai($maKhuyenMai)) {
            header('Location: ' . BASE_URL . 'NV_BaoTri/quanlykhuyenmai?message=delete_success');
        } else {
            header('Location: ' . BASE_URL . 'NV_BaoTri/quanlykhuyenmai?message=delete_failed');
        }
        exit();
    }
}
?>