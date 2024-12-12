<?php
require_once BASE_PATH . '/models/DoanhThuModel.php';
require_once BASE_PATH . '/models/ThanhVienModel.php';
require_once BASE_PATH . '/models/NhanVienModel.php';
require_once BASE_PATH . '/models/ThietBiModel.php';
require_once BASE_PATH . '/models/GoiTapModel.php';
require_once BASE_PATH . '/models/BaoCaoThanhVienModel.php';
require_once BASE_PATH . '/models/BaoCaoThietBiModel.php';
require_once BASE_PATH . '/models/QuanLyLichLamViecModel.php';


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
    $members = $goiTapModel->getGoiTapAdmin($page, $limit);
    $totalPages = ceil($currentGoiTap / $limit);
    $data = [
        'currentGoiTap' => $currentGoiTap,
        'members' => $members,
        'totalPages' => $totalPages,
        'currentPage' => $page,
    ];
    $this->render('Admin/goiTap/QuanLyGoiTap',$data);
}


// public function baoCaoDoanhThu() {
//     $baoCaoDoanhThuModel = new Revenue();
//     $currentDoanhThu = $baoCaoDoanhThuModel->getCurrentDoanhThu();
//     $limit = 100;
//     $page = isset($_GET['page']) ? $_GET['page'] : 1;
//     $doanhThu = $baoCaoDoanhThuModel->getRevenueDetails($page, $limit);
//     // $doanhThu = $baoCaoDoanhThuModel->getRevenueDetails($page, $limit);
//     $totalPages = ceil($currentDoanhThu / $limit);
//     $year = isset($_GET['year']) ? $_GET['year'] : date('Y');  // Get the selected year from the query string, or use the current year if not provided
//     $data = [
//         'currentDoanhThu' => $currentDoanhThu,
//         'doanhThu' => $doanhThu,
//         'totalPages' => $totalPages,
//         'currentPage' => $page,
//         'year' => $year, //
//     ];
//     $this->render('Admin/baoCaoDoanhThu/doanhThu_dash', $data);
// }
public function baoCaoDoanhThu() {
    $baoCaoDoanhThuModel = new Revenue();

    // Lấy danh sách các năm từ model
    $years = $baoCaoDoanhThuModel->getAvailableYears();

    // Tổng số năm (số trang)
    $totalPages = count($years);

    // Lấy trang hiện tại từ tham số GET
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;

    // Đảm bảo trang hiện tại nằm trong khoảng hợp lệ
    $page = max(1, min($page, $totalPages));

    // Xác định năm của trang hiện tại
    $currentYear = $years[$page - 1]['year'];

    // Lấy dữ liệu doanh thu của năm hiện tại
    $doanhThu = $baoCaoDoanhThuModel->getRevenueDetailsByYear($currentYear);

    // Truyền dữ liệu sang view
    $data = [
        'doanhThu' => $doanhThu,
        'totalPages' => $totalPages,
        'currentPage' => $page,
        'currentYear' => $currentYear,
    ];
    $this->render('Admin/baoCaoDoanhThu/doanhThu_dash', $data);
}


public function baoCaoThanhVien() {
    $memberModel = new BaoCaoThanhVienModel();
    $currentMembers = $memberModel->getCurrentMembers();
    $limit = 8;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $members = $memberModel->getMembers($page, $limit);
    $totalPages = ceil($currentMembers / $limit);

    // Thêm thông tin về thời gian tập gần nhất
    foreach ($members as &$member) {
        $member['thoiGianTapGanNhat'] = $memberModel->getLastWorkoutTime($member['userID']);
        $member['goiTapThuongMua'] = $memberModel->getMostFrequentGoiByUserID($member['userID']);

    }

    $data = [
        'currentMembers' => $currentMembers,
       'members' => $members,
        'totalPages' => $totalPages,
        'currentPage' => $page,
    ];
    $this->render('Admin/BaoCaoThanhVien/baoCaoThanhVien_dash',$data);
    
}

public function baoCaoThietBi(){
    $equipmentModel = new BaoCaoThietBiModel();
    $currentEquipment = $equipmentModel->getCurrentEquipment();
    $limit = 8;
    $page = isset($_GET['page'])? $_GET['page'] : 1;
    $members = $equipmentModel->getEquipment($page, $limit);
    $totalPages = ceil($currentEquipment / $limit);

    foreach ($members as &$member) {
        $member['trangThaiBaoTri'] = $equipmentModel->getEquipmentStatus($member['maThietBi']);
        $member['soLanBaoTri'] = $equipmentModel->getEquipmentMaintenanceCount($member['maThietBi']);
        $member['ngayBaoTriGanNhat'] = $equipmentModel->getLatestMaintenanceDate($member['maThietBi']);

    }
    $data = [
        'currentEquipment' => $currentEquipment,
        'members' => $members,
        'totalPages' => $totalPages,
        'currentPage' => $page,
    ];
    $this->render('Admin/baoCaoThietBi/baoCaoThietBi_dash',$data);
}

//danh sách lịch làm việc
public function quanLyLichLamViec() {
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
    $this->render('Admin/lichLamViec/QuanLyLichLamViec', $data);
} 

//Truyen bien vao view
    protected function render($view, $data = []) {
        extract($data); // Truyền biến vào view
        require_once BASE_PATH . "/views/$view.php";
    }
}
?>