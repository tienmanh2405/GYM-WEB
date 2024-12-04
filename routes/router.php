<?php

class Router {
    protected $routes = [];

    public function __construct() {
        $this->loadRoutes();
    }

    private function loadRoutes() {
        $this->routes = [
            '' => ['controller' => 'HomeController_NV', 'action' => 'dashboard'],   
            'NV_Quay/thanhVien' => ['controller' => 'HomeController_NV', 'action' => 'thanhVien'],     
            'NV_Quay/thanhVien/chiTietThanhVien' => ['controller' => 'HomeController_NV', 'action' => 'chiTietThanhVien'],     
        
             // Routes mới cho chức năng đăng ký
            // 'register' => ['controller' => 'AuthController', 'action' => 'showRegisterForm'],
            'register-process' => ['controller' => 'AuthController', 'action' => 'register'],
            // 'verify-email' => ['controller' => 'AuthController', 'action' => 'verifyEmail'],
            'verify-email' => ['controller' => 'AuthController', 'action' => 'verifyOTP']
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