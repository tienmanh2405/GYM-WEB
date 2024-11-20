<?php
require_once BASE_PATH . '/models/DoanhThuModel.php';
require_once BASE_PATH . '/models/ThanhVienModel.php';
require_once BASE_PATH . '/models/NhanVienModel.php';
require_once BASE_PATH . '/models/ThietBiModel.php';
require_once BASE_PATH . '/models/GoiTapModel.php';

class HomeController_Admin {
    public function admin_dash() {
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
        $this->render('Admin/home/admin_dash',$data);
    }
    // public function nhanVien() {
    //     $employeesModel = new Employees();
    //     $employees = $employeesModel->getEmployees();
    //     $limit = 8;
    //     $page = isset($_GET['page']) ? $_GET['page'] : 1;s
    //     $members = $memberModel->getMembers($page, $limit);
    //     $totalPages = ceil($currentMembers / $limit);
        // $data = [
    //         'currentMembers' => $currentMembers,
    //         'members' => $members,
    //         'totalPages' => $totalPages,
    //         'currentPage' => $page,
    //     ];
        // $this->render('Admin/nhanVien/QuanLyNhanVien',$data);
    //     $this->render('Admin/nhanVien/QuanLyNhanVien');
    // }
    // public function chiTietThanhVien() {
    //     $this->render('NV_Quay/thanhVien/chiTietThanhVien');
    // }
    public function nhanVien() {
        $employeesModel = new Employees();
        $currentEmployees = $employeesModel->getCurrentEmployees();
        $limit = 8;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $members = $employeesModel->getEmployees($page, $limit);
        $totalPages = ceil($currentEmployees / $limit);
        $data = [
            'currentEmployees' => $currentEmployees,
            'members' => $members,
            'totalPages' => $totalPages,
            'currentPage' => $page,
        ];
        $this->render('Admin/nhanVien/QuanLyNhanVien',$data);
    }

public function thietBi(){
    $equipmentModel = new Equipment();
    $currentEquipment = $equipmentModel->getCurrentEquipment();
    $limit = 8;
    $page = isset($_GET['page'])? $_GET['page'] : 1;
    $members = $equipmentModel->getEquipment($page, $limit);
    $totalPages = ceil($currentEquipment / $limit);
    $data = [
        'currentEquipment' => $currentEquipment,
        'members' => $members,
        'totalPages' => $totalPages,
        'currentPage' => $page,
    ];
    $this->render('Admin/thietBi/QuanLyThietBi',$data);
}

public function goiTap(){
    $goiTapModel = new GoiTapModel();
    $currentGoiTap = $goiTapModel->getCurrentGoiTap();
    $limit = 8;
    $page = isset($_GET['page'])? $_GET['page'] : 1;
    $members = $goiTapModel->getGoiTap($page, $limit);
    $totalPages = ceil($currentGoiTap / $limit);
    $data = [
        'currentGoiTap' => $currentGoiTap,
        'members' => $members,
        'totalPages' => $totalPages,
        'currentPage' => $page,
    ];
    $this->render('Admin/goiTap/QuanLyGoiTap',$data);
}

public function themNhanVien(){
    $this->render('Admin/nhanVien/ThemNhanVien');
}

    protected function render($view, $data = []) {
        extract($data); // Truyền biến vào view
        require_once BASE_PATH . "/views/$view.php";
    }
}
?>