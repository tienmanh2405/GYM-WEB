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

    public function index()
    {
        $khuyenMais = $this->khuyenMaiModel->getAllKhuyenMai();
        $maGoiTapList = $this->khuyenMaiModel->getAllMaGoiTap();
        require_once BASE_PATH . '/views/NV_BaoTri/quanlykhuyenmai/QuanLyKhuyenMai.php';
    }
    
    public function create()
    {
        $maGoiTapList = $this->khuyenMaiModel->getAllMaGoiTap(); // Lấy danh sách mã gói tập
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $maKhuyenMai = $_POST['maKhuyenMai'];
            $giamGia = $_POST['giamGia'];
            $ngayBatDau = $_POST['ngayBatDau'];
            $ngayKetThuc = $_POST['ngayKetThuc'];
            $moTa = $_POST['moTa'];
            $maGoiTap = $_POST['maGoiTap']; 

            // Gọi model để thêm khuyến mãi vào cơ sở dữ liệu
            $this->khuyenMaiModel->addKhuyenMai($maKhuyenMai, $giamGia, $ngayBatDau, $ngayKetThuc, $moTa);
            $this->khuyenMaiModel->addKhuyenMaiGoiTap($maKhuyenMai, $maGoiTap); // Thêm vào bảng khuyenmai_goitap

            // Chuyển hướng về trang danh sách khuyến mãi
            header('Location: ' . BASE_URL . 'NV_BaoTri/quanlykhuyenmai');
            exit();
        }
        require_once BASE_PATH . '/views/NV_BaoTri/quanlykhuyenmai/QuanLyKhuyenMai.php'; // Đảm bảo gọi view ở đây
    }

    public function update()
{
    $maGoiTapList = $this->khuyenMaiModel->getAllMaGoiTap(); // Lấy danh sách mã gói tập
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $maKhuyenMai = $_POST['maKhuyenMai'];
        $giamGia = $_POST['giamGia'];
        $ngayBatDau = $_POST['ngayBatDau'];
        $ngayKetThuc = $_POST['ngayKetThuc'];
        $moTa = $_POST['moTa'];
        
        // Cập nhật khuyến mãi trong cơ sở dữ liệu
        $this->khuyenMaiModel->updateKhuyenMai($maKhuyenMai, $giamGia, $ngayBatDau, $ngayKetThuc, $moTa);

        // Chuyển hướng về trang danh sách khuyến mãi
        header('Location: ' . BASE_URL . 'NV_BaoTri/quanlykhuyenmai');
        exit();
    }
    require_once BASE_PATH . '/views/NV_BaoTri/quanlykhuyenmai/QuanLyKhuyenMai.php'; // Đảm bảo gọi view ở đây
}

public function delete($maKhuyenMai)
{
    if ($this->khuyenMaiModel->deleteKhuyenMai($maKhuyenMai)) {
        // Xóa thành công
        header('Location: ' . BASE_URL . 'NV_BaoTri/quanlykhuyenmai?message=delete_success');
    } else {
        // Xóa không thành công
        header('Location: ' . BASE_URL . 'NV_BaoTri/quanlykhuyenmai?message=delete_failed');
    }
    exit();
}
}
?>