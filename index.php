
<?php
require_once __DIR__ . '/controllers/AuthController.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$authController = new AuthController();
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

    // case '/logout/post':
    //     session_start();
    //     session_destroy();
    //     header('Location: ' . BASE_URL . 'views/index.php');
    //     exit(); 
    //     break;

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

    default:
        // For all other requests, if no match is found, redirect to index.php
        include 'views/index.php';
        break;
}
