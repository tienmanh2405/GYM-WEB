<?php
//session_start();

require_once __DIR__ . '/../controllers/AuthController.php';
$authController = new AuthController(); // Tạo đối tượng từ lớp AuthController

$userId = $authController->checkLoginStatus(); // Gọi phương thức checkLoginStatus
if ($userId) {
    // Lấy thông tin user từ AuthController
    $user = $authController->getUser($userId);
} else {
    echo "<script>alert('Hãy đăng nhập');</script>";
    header('Location: ./login-signup.php'); // Chuyển hướng về trang đăng nhập
    exit();
}
?>
<!DOCTYPE html>
<html lang="zxx">
<?php
    require_once __DIR__ . '/../includes/head.php';
?>
<link rel="stylesheet" href="../asset/css/style2.css">
<head>
<!-- 
<?php 
    require_once __DIR__ . '../../controllers/AuthController.php';
    if (!isset($_SESSION['user'])) {
        header('Location: ./index.php');
        exit();
    } else {
        $authController = new AuthController();
        $user = $authController->getUser($_SESSION['user']);
    }
?>  -->
</head>

<body>
    <!-- Header Section Begin -->
    <?php
    require_once __DIR__ . '/../includes/header.php';
    ?>
    <!-- Header Section End -->

    <div class="container">
    <!-- Sidebar begin -->
    <?php
    require_once __DIR__ . '/../includes/sidebar.php';
    ?>
    <!-- Sidebar ènd -->
    <div class="content">
        <div class="profile-container">
        <h1>Thông Tin Tài khoản</h1>
        <form action="../update-profile" method="post" id="update-profile-form">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" value="<?php echo $user['email'] ?>" class="form-control" id="email">
            </div>
            <div class="form-group">
                <label for="fullname">Họ tên</label>
                <input type="text" name="name" value="<?php echo $user['hoTen'] ?>" class="form-control" id="fullname">
            </div>
            <div class="form-group">
                <label for="phone">Số điện thoại</label>
                <input type="text" name="phone" value="<?php echo $user['sdt'] ?>" class="form-control" id="phone">
            </div>
            <button type="submit">CẬP NHẬT</button>
        </form>
        </div>
        <div class="change-password-container">
            <form action="../change/post" method="post" id="change-password-form">
            </form>
        </div>
    </div>
</div>
</div>

    <!-- Footer Section Begin -->
    <!-- Footer Section End -->

</body>

</html>
