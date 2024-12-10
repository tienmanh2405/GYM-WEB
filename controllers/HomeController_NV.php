<?php
require_once BASE_PATH . '/models/DoanhThuModel.php';
require_once BASE_PATH . '/models/ThanhVienModel.php';

class HomeController_NV {
    public function dashboard() {
        // Logic hiển thị Dashboard
        $revenueModel = new Revenue();
        $todayRevenue = $revenueModel->getTodayRevenue();

        $memberModel = new Member();
        $currentMembers = $memberModel->getCurrentMembers();
        $todayCheckIns = $memberModel->getTodayCheckIns();
        $newRegistrations = $memberModel->getNewRegistrations();
        
        $limit = 5;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $members = $memberModel->getMembers($page, $limit);
        $totalPages = ceil($currentMembers / $limit);
        // Truyền dữ liệu sang view
        $data = [
            'todayRevenue' => $todayRevenue,
            'currentMembers' => $currentMembers,
            'todayCheckIns' => $todayCheckIns,
            'newRegistrations' => $newRegistrations,
            'members' => $members,
            'totalPages' => $totalPages,
            'currentPage' => $page,
        ];
        $this->render('NV_Quay/home/dashboard',$data);
    }
    public function thanhVien() {
        $memberModel = new Member();
        $currentMembers = $memberModel->getCurrentMembers();
        $limit = 8;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $members = $memberModel->getMembers($page, $limit);
        $totalPages = ceil($currentMembers / $limit);
        $data = [
            'currentMembers' => $currentMembers,
            'members' => $members,
            'totalPages' => $totalPages,
            'currentPage' => $page,
        ];
        $this->render('NV_Quay/thanhVien/QuanLyThanhVien',$data);
    }
    public function chiTietThanhVien() {
        $this->render('NV_Quay/thanhVien/chiTietThanhVien');
    }
    protected function render($view, $data = []) {
        extract($data); // Truyền biến vào view
        require_once BASE_PATH . "/views/$view.php";
    }
}
?>