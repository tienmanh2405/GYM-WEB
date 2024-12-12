<?php

class Router {
    protected $routes = [];

    public function __construct() {
        $this->loadRoutes();
    }

    // Định nghĩa các route
    private function loadRoutes() {
        $this->routes = [
            'Admin/home' => ['controller' => 'HomeController_Admin', 'action' => 'admin_dash'],   
            'Admin/nhanVien' => ['controller' => 'HomeController_Admin', 'action' => 'nhanVien'],     
            'Admin/thietBi' => ['controller' => 'HomeController_Admin', 'action' => 'thietBi'],     
            'Admin/goiTap' => ['controller' => 'HomeController_Admin', 'action' => 'goiTap'],
            'Admin/baoCaoDoanhThu' => ['controller' => 'HomeController_Admin', 'action' =>'baoCaoDoanhThu'],
            'Admin/baoCaoThanhVien' => ['controller' => 'HomeController_Admin', 'action' => 'baoCaoThanhVien'],
            'Admin/baoCaoThietBi' => ['controller' => 'HomeController_Admin', 'action' => 'baoCaoThietBi'],
            'Admin/lichLamViec' => ['controller' => 'HomeController_Admin', 'action' => 'quanLyLichLamViec'],  
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