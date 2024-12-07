
<?php
require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/OrderController.php';
require_once __DIR__ . '/controllers/HoaDonController.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$authController = new AuthController();
$orderController = new OrderController();
$hoaDonController = new hoaDonController();
if (isset($_SESSION['user'])) {
    $id = $_SESSION['user'];
}
$request = strtok($_SERVER['REQUEST_URI'], '?');
$request = strtok($request, '?');
$script_name = $_SERVER['SCRIPT_NAME'];
$base_path = dirname($script_name);
$request = str_replace($base_path, '', $request);

if ($request === '' || $request === '/') {
    $request = '/';
}

switch ($request) {
    case '/':
        header('Location: ' . BASE_URL . 'views/index.php');
        break;

    case '/register/post':
        $authController->register();
        break;

    case '/verify/post':
        $authController->verifyOTP();
        break;

    case '/login/post':
        $authController->login();
        break;

    case '/profile':
        // Handle profile logic
        break;

    case '/update-profile':
        $authController->updateProfile($id);
        break;

    case '/views/logout.php':
        session_destroy();
        header('Location: ' . BASE_URL . 'views/index.php');
        break;

    case '/change/post':
        $authController->updatePassword($id);
        break;

    case '/ratingform/post':
        $authController->review($id);
        break;

    case '/reset/post':
        $authController->resetPass();
        break;

    case '/verifynewpass/post':
        $authController->newPassVerifyOTP();
        break;

    case '/newpass/post':
        $authController->newPassword();
        break;

    // case '/add-order':

    //     $orderID = isset($_GET['id']) ? intval($_GET['id']) : 0;
    //     if ($orderID > 0) {
    //         $id = $_SESSION['user'] ?? 0;
    //         if ($id > 0) {
    //             $result = $orderController->add($id, $orderID);
    //             $idGoiDangKy = $result['id'];
    //             $hoaDonController->add($idGoiDangKy);
    //             header('Location: ' . BASE_URL . 'views/trackpack.php');
    //         } else {
    //             echo "<script>alert('Vui lòng đăng nhập trước khi đặt hàng!');</script>";
    //         }
    //     }



        // case '/vnpay_php/vnpay_return.php':
        //     $orderID = isset($_GET['id']) ? intval($_GET['id']) : 0;
        //     echo "<script>alert('thanh toan thanh cong');</script>";
        //     break;


    default:
        include 'views/index.php';
        break;
}
