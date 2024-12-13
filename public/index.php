
<?php
session_start();
// Bật các lỗi khi phát triển
error_reporting(E_ALL);
ini_set('display_errors', 1);

define('BASE_PATH', realpath(dirname(__FILE__) . '/../')); 

require_once BASE_PATH . '/routes/router.php'; 

$router = new Router();
$router->handleRequest(); // Xử lý yêu cầu
?>