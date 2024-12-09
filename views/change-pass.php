<?php
require_once __DIR__ . '/../controllers/AuthController.php';
$authController = new AuthController(); 

$userId = $authController->checkLoginStatus(); 
if ($userId) {
    // Lấy thông tin user từ AuthController
    $user = $authController->getUser($userId);
} else {
    echo "<script>alert('Hãy đăng nhập');</script>";
    header('Location: ./login-signup.php');
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
</head>

<body>
    <!-- Header Section Begin -->
    <?php
    require_once __DIR__ . '/../includes/header.php';
    ?>
    <!-- Header End -->

    <!-- Body Section -->
    <div class="body-main">
        
        <div class="container">
        <!-- Sidebar begin -->
        <?php
        require_once __DIR__ . '/../includes/sidebar.php';
        ?>
        <!-- Sidebar ènd -->
        <div class="content">
                <h1>Đổi Mật Khẩu</h1>
                    <form action="../change/post" method="post" id="change-password-form" onsubmit="return validateForm()">
                        <div class="form-group">
                            <label for="current-password">Mật khẩu hiện tại</label>
                            <input type="password" name="current-password" class="form-control" id="current-password" required>
                        </div>
                        <div class="form-group">
                            <label for="new-password">Mật khẩu mới</label>
                            <input type="password" name="new-password" class="form-control" id="new-password" required>
                            <span id="passwordError" style="color: red; display: none;">Mật khẩu mới phải chứa ít nhất 8 ký tự, bao gồm cả chữ và số.</span>
                        </div>
                        <div class="form-group">
                            <label for="confirm-password">Xác nhận mật khẩu mới</label>
                            <input type="password" name="confirm-password" class="form-control" id="confirm-password" required>
                            <span id="confirmPasswordError" style="color: red; display: none;">Mật khẩu mới và xác nhận mật khẩu không khớp.</span>
                        </div>
                        <button type="submit">Ô KÊ</button>
                        <?php
                        if (isset($_SESSION['error'])) {
                            echo "<p style='color: red;'>" . $_SESSION['error'] . "</p>";
                            unset($_SESSION['error']);
                        }
                        ?>
                    </form>
         </div>
            

        </div>
<script>
    // dùng js để validate form, không dùng alert 
    function validateForm() {
        const newPassword = document.getElementById("new-password").value;
        const confirmPassword = document.getElementById("confirm-password").value;
        const passwordError = document.getElementById("passwordError");
        const confirmPasswordError = document.getElementById("confirmPasswordError");

        const passwordRegex = /^(?=.*[a-zA-Z])(?=.*\d)[A-Za-z\d]{8,}$/;

        if (!passwordRegex.test(newPassword)) {
            passwordError.style.display = "block";
            event.preventDefault(); 
            return false;
        } else {
            if(newPassword !== confirmPassword){
                confirmPasswordError.style.display = "block";
                event.preventDefault();
                return false;
            }
            else {
                passwordError.style.display = "none"; 
                confirmPasswordError.style.display = "none";
                return true;
            }
        }
    }
</script>
    </div>
    <!-- Body Section End -->

    <!-- Footer Section -->
    <?php
    // require_once 'html/footer.php';
    ?>
    <!-- Footer Section End -->

    <!-- Js Plugins -->

</body>

</html>