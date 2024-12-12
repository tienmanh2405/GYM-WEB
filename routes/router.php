<?php

class Router {
    protected $routes = [];

    public function __construct() {
        $this->loadRoutes();
    }

    // Định nghĩa các route
    private function loadRoutes() {
        $this->routes = [
            ''=> ['controller' => 'ControllerLogin', 'action' => 'login'], 
            'NV_Quay/dash' => ['controller' => 'HomeController_NV', 'action' => 'dashboard'],   
            'NV_Quay/thanhVien' => ['controller' => 'HomeController_NV', 'action' => 'thanhVien'],     
            'NV_Quay/thanhVien/chiTietThanhVien' => ['controller' => 'HomeController_NV', 'action' => 'chiTietThanhVien'], 
            'NV_Quay/goitap' => ['controller' => 'HomeController_NV','action' => 'DSGoiTap'],    
            'NV_Quay/lichlamviec' => ['controller' => 'HomeController_NV','action' => 'DSLichLamViec'],    
            'Admin/home' => ['controller' => 'HomeController_Admin', 'action' => 'admin_dash'],   
            'Admin/nhanVien' => ['controller' => 'HomeController_Admin', 'action' => 'nhanVien'],     
            'Admin/thietBi' => ['controller' => 'HomeController_Admin', 'action' => 'thietBi'],     
            'Admin/goiTap' => ['controller' => 'HomeController_Admin', 'action' => 'goiTap'],
            'Admin/baoCaoDoanhThu' => ['controller' => 'HomeController_Admin', 'action' =>'baoCaoDoanhThu'],
            'Admin/baoCaoThanhVien' => ['controller' => 'HomeController_Admin', 'action' => 'baoCaoThanhVien'],
            'Admin/baoCaoThietBi' => ['controller' => 'HomeController_Admin', 'action' => 'baoCaoThietBi'],
            'Admin/lichLamViec' => ['controller' => 'HomeController_Admin', 'action' => 'quanLyLichLamViec'],  
            'NV_BaoTri/index' => ['controller' => 'HomeController_ThietBi', 'action' => 'index'],
            'NV_BaoTri/thietBi' => ['controller' => 'HomeController_ThietBi', 'action' => 'showDevices'],
            'NV_BaoTri/phieuBaoTri' => ['controller' => 'HomeController_ThietBi', 'action' => 'showPhieuBaoTri'], 
            'NV_BaoTri/quanlykhuyenmai' => ['controller' => 'HomeController_KhuyenMai', 'action' => 'index'],
            'NV_BaoTri/quanlykhuyenmai/update' => ['controller' => 'HomeController_KhuyenMai', 'action' => 'update'],
            'NV_BaoTri/quanlykhuyenmai/create' => ['controller' => 'HomeController_KhuyenMai', 'action' => 'create'],
            'NV_BaoTri/quanlykhuyenmai/delete/{maKhuyenMai}' => ['controller' => 'HomeController_KhuyenMai', 'action' => 'delete'], // Route cho xóa
        ];
    }

    // Xử lý yêu cầu
    public function handleRequest() {
        $basePath = '/GYM-WEB/public';
        $path = str_replace($basePath, '', $_SERVER['REQUEST_URI']);
        $path = trim($path, '/');
        $path = parse_url($path, PHP_URL_PATH);
        
        // Kiểm tra nếu có tham số cho xóa
        if ($this->isDeleteRequest($path, $matches)) {
            $this->dispatch('HomeController_KhuyenMai', 'delete', $matches[1]);
        } elseif (array_key_exists($path, $this->routes)) {
            $this->dispatch($this->routes[$path]['controller'], $this->routes[$path]['action']);
        } else {
            $this->dispatch('ErrorController', 'notFound'); // Trang lỗi 404
        }
    }

    // Kiểm tra xem yêu cầu có phải là yêu cầu xóa không
    private function isDeleteRequest($path, &$matches) {
        return preg_match('/^NV_BaoTri\/quanlykhuyenmai\/delete\/(\w+)$/', $path, $matches); // Sử dụng \w+ để hỗ trợ cả chuỗi và số
    }

    // Triển khai controller/action
    private function dispatch($controllerName, $actionName, $param = null) {
        require_once BASE_PATH . "/controllers/$controllerName.php";
        $controller = new $controllerName();
        if (method_exists($controller, $actionName)) {
            if ($param) {
                $controller->$actionName($param);
            } else {
                $controller->$actionName();
            }
        } else {
            echo "Action $actionName không tồn tại.";
        }
    }
}
?>