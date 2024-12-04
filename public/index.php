<?php
// Bật các lỗi khi phát triển
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Định nghĩa BASE_PATH
define('BASE_PATH', dirname(__DIR__));

// Gọi các thành phần cốt lõi
require_once BASE_PATH . '/routes/router.php';
// require_once '../config/config.php';
require_once BASE_PATH . '/config/config.php'; 
// Khởi tạo Router và xử lý yêu cầu
$router = new Router();
$router->handleRequest();
