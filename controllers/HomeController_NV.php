<?php
require_once BASE_PATH . '/models/DoanhThuModel.php';
require_once BASE_PATH . '/models/ThanhVienModel.php';
require_once BASE_PATH . '/models/GoiTapModel.php';
require_once BASE_PATH . '/models/LichLamViecModel.php';

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
    public function DSGoiTap() {
        $goitapModel = new GoitapModel();
        $currentGoiTap = $goitapModel->getCurrentGoiTap();
        $limit = 6;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $goitap_list = $goitapModel->getAllGoitap($page, $limit);
        $totalPages = ceil($currentGoiTap / $limit);
        $data = [
            'goitap_list' => $goitap_list,
            'totalPages' => $totalPages,
            'currentPage' => $page,
            'currentGoiTap' => $currentGoiTap,
        ]; 
        $this->render('NV_Quay/goitap/DSGoiTap', $data);
        
    }
    public function DSLichLamViec() {
        // Khởi tạo lớp LichLamViec để lấy lịch làm việc
        $lichLamViecModel = new LichLamViec();
        
        // Lấy lịch làm việc theo tuần
        $lichLamViec = $lichLamViecModel->getWorkingSchedule();

        // Các ngày trong tuần
        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    
        // Các ca làm việc trong ngày
        $shifts = ['Ca sáng', 'Ca chiều'];
    
        // Gửi dữ liệu lịch làm việc vào view
        $data = [
            'lichLamViec' => $lichLamViec,
            'daysOfWeek' => $daysOfWeek,
            'shifts' => $shifts,
        ];
    
        // Render view cho danh sách lịch làm việc
        $this->render('NV_Quay/lichlamviec/DSLichLamViec', $data);
    } 
        
    protected function render($view, $data = []) {
        extract($data); // Truyền biến vào view
        require_once BASE_PATH . "/views/$view.php";
    }
}
?>