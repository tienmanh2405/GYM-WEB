<?php

class Router {
    protected $routes = [];

    public function __construct() {
        $this->loadRoutes();
    }

    // Định nghĩa các route
    private function loadRoutes() {
        $this->routes = [
            '' => ['controller' => 'HomeController_Admin', 'action' => 'admin_dash'],   
            'Admin/nhanVien' => ['controller' => 'HomeController_Admin', 'action' => 'nhanVien'],     
            'Admin/thietBi' => ['controller' => 'HomeController_Admin', 'action' => 'thietBi'],     
            'Admin/goiTap' => ['controller' => 'HomeController_Admin', 'action' => 'goiTap'],
            'Admin/baoCaoDoanhThu' => ['controller' => 'HomeController_Admin', 'action' =>'baoCaoDoanhThu'],
            // 'Admin/nhanVien/themNhanVien' => ['controller' => 'HomeController_Admin', 'action' => 'themNhanVien'],
            // 'Admin/themThietBi' => ['controller' => 'HomeController_Admin', 'action' => 'themThietBi'],
            // 'Admin/themGoiTap' => ['controller' => 'HomeController_Admin', 'action' => 'themGoiTap'],
            // 'Admin/xoaNhanVien' => ['controller' => 'HomeController_Admin', 'action' => 'xoaNhanVien'],    
            // 'NV_Quay/thanhVien/chiTietThanhVien' => ['controller' => 'HomeController_NV', 'action' => 'chiTietThanhVien'],     
        ];
    }

    // Xử lý yêu cầu
    public function handleRequest() {
        $basePath = '/GYM-WEB/public';
        $path = str_replace($basePath, '', $_SERVER['REQUEST_URI']);
        $path = trim($path, '/');
        $path = parse_url($path, PHP_URL_PATH);
        if (array_key_exists($path, $this->routes)) {
            $controllerName = $this->routes[$path]['controller'];
            $actionName = $this->routes[$path]['action'];
            $this->dispatch($controllerName, $actionName);
        } else {
            $this->dispatch('ErrorController', 'notFound'); // Trang lỗi 404
        }
    }

    // Triển khai controller/action
    private function dispatch($controllerName, $actionName) {
        require_once BASE_PATH . "/controllers/$controllerName.php";
        $controller = new $controllerName();
        if (method_exists($controller, $actionName)) {
            $controller->$actionName();
        } else {
            echo "Action $actionName không tồn tại.";
        }
    }
}
?>