<?php

class Router {
    protected $routes = [];

    public function __construct() {
        $this->loadRoutes();
    }

    // Định nghĩa các route
    private function loadRoutes() {
        $this->routes = [
<<<<<<< HEAD
            '' => ['controller' => 'HomeController_Admin', 'action' => 'dashboard'],         
=======
            '' => ['controller' => 'HomeController_NV', 'action' => 'dashboard'],   
            'NV_Quay/thanhVien' => ['controller' => 'HomeController_NV', 'action' => 'thanhVien'],     
            'NV_Quay/thanhVien/chiTietThanhVien' => ['controller' => 'HomeController_NV', 'action' => 'chiTietThanhVien'],     
>>>>>>> a06eb8b9e6899cfde9d7aa4a345b6bb5daddfd97
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