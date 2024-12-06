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
<style>
    .avatar{
         height : 200px;
         width : 300px;
         object-fit: cover;
    }
    </style>
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
        <form action="../update-profile" method="post" id="update-profile-form" enctype="multipart/form-data" onsubmit="return validateForm(event)">

        <div class="form-group">
            <label for="avatar">Ảnh đại diện</label>
            <img src="../asset/img/avatar/<?php echo $user['vaiTro'] . "/" . $user['hinhAnh']; ?>" alt="Avatar" class="avatar">

            <label for="change-avatar">Đổi ảnh đại diện</label>
            <input type="file" name="avatar" id="avatar">
            <span id="avatarError" style="color: red; display: none;">Vui lòng chọn ảnh có định dạng hợp lệ (jpg, jpeg, png).</span>
            </div>

            <!-- <div class = "form-group">
                <label for = "avatar"></label>
                <img src="../asset/img/avatar/<?php echo $user['vaiTro'] . "/" . $user['hinhAnh']; ?>" alt="Avatar" class="avatar">
            </div> -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" value="<?php echo $user['email'] ?>" class="form-control" required id="email">
                <span id="emailError" style="color: red; display: none;">Vui lòng nhập một địa chỉ email hợp lệ.</span>
            </div>
            <div class="form-group">
                <label for="fullname">Họ tên</label>
                <input type="text" name="name" value="<?php echo $user['hoTen'] ?>" class="form-control" id="fullname">
                <span id="fullnameError" style="color: red; display: none;">Vui lòng nhập Họ và Tên không bao gồm ký tự đặc biệt. </span>
            </div>
            <div class="form-group">
                <label for="phone">Số điện thoại</label>
                <input type="text" name="phone"  value="<?php echo $user['sdt'] ?>" class="form-control" id="phone">
                <span id="phoneError" style="color: red; display: none;">Vui lòng nhập số điện thoại hợp lệ. Bao gồm 10 số và bắt đầu bằng 0. </span>
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
<script>
    function validateForm(event) {
    // Lấy giá trị của các trường nhập liệu
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;
    const fullname = document.getElementById('fullname').value;

    // Lấy các phần tử để hiển thị thông báo lỗi
    const emailError = document.getElementById('emailError');
    const phoneError = document.getElementById('phoneError');
    const fullnameError = document.getElementById('fullnameError');
    
    // Định nghĩa các biểu thức chính quy
    const emailRegex = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/;
    const phoneRegex = /^(0[3-9]{1}[0-9]{8})$/;
    const nameRegex = /^[\p{L}\s]+$/u;


    // Kiểm tra email
    if (!emailRegex.test(email)) {
        emailError.style.display = "block";
        event.preventDefault();  // Ngừng hành động gửi form
        return false;
    } else {
        emailError.style.display = "none";
    }

    // Kiểm tra số điện thoại
    if (!phoneRegex.test(phone)) {
        phoneError.style.display = "block";
        event.preventDefault();
        return false;
    } else {
        phoneError.style.display = "none";
    }

    // Kiểm tra họ tên
    if (!nameRegex.test(fullname)) {
        fullnameError.style.display = "block";
        event.preventDefault();
        return false;
    } else {
        fullnameError.style.display = "none";
    }

    return true;  // Nếu tất cả đều hợp lệ, cho phép gửi form
}

</script>

</body>

</html>
