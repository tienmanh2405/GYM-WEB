<?php
require_once BASE_PATH . '/config/config.php';
require_once BASE_PATH . '/models/ThietBiModel.php';
require_once BASE_PATH . '/models/PhieuBaoTriModel.php';

class HomeController_ThietBi {
    private $thietBiModel;
    private $phieuBaoTriModel;

    public function __construct() {
        $this->thietBiModel = new ThietBiModel();
        $this->phieuBaoTriModel = new PhieuBaoTriModel();
    }

    // Hiển thị trang dashboard chính
    public function index() {
        require_once(BASE_PATH . '/views/NV_BaoTri/home/dashboard.php');
    }

    // Hiển thị danh sách thiết bị và thống kê số lượng thiết bị theo trạng thái
    public function showDevices() {
        $data = $this->thietBiModel->getAllDevices();
        $deviceCounts = $this->thietBiModel->getDeviceCountByStatus();
        require_once(BASE_PATH . '/views/NV_BaoTri/thietBi/QuanLyThietBi.php');
    }

    // Hiển thị và xử lý thông tin phiếu bảo trì
    public function showPhieuBaoTri() {
        $nextMaBaoTri = $this->phieuBaoTriModel->getNextMaBaoTri();
        $thietBiList = $this->phieuBaoTriModel->getAllThietBi();
        $userList = $this->phieuBaoTriModel->getAllUsers();

        // Xử lý khi nhận dữ liệu từ form
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'maBaoTri' => $nextMaBaoTri,
                'maThietBi' => $_POST['maThietBi'],
                'userID' => $_POST['userID'],
                'ngayBaoTri' => $_POST['ngayBaoTri'],
                'trangThai' => $_POST['trangThai'],
            ];
            $this->phieuBaoTriModel->insertPhieuBaoTri($data);
            header("Location: " . BASE_URL . "NV_BaoTri/phieuBaoTri");
            exit;
        }

        require_once(BASE_PATH . '/views/NV_BaoTri/phieuBaoTri/CapNhatTinhTrangThietBi.php');
    }
}
?>