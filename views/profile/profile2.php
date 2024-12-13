<?php
session_start();
// $authController = new AuthController();
if (!isset($_SESSION['user_entry'])) {
    echo "<script>window.location.href='login.php';</script>"; // Redirect to login if user is not logged in
    exit();
}

// Lấy thông tin người dùng từ session hoặc cơ sở dữ liệu
$user = $_SESSION['user_entry']; // Giả sử bạn đã lấy thông tin người dùng vào session
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin cá nhân</title>
    <!-- Kết nối với CSS của Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- <link href="../asset/image/favicon.ico" rel="icon"> -->

    <!-- Google Web Fonts -->
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com"> -->
    <!-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> -->
    <!-- <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">  -->
    
    <!-- Icon Font Stylesheet -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet"> -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet"> -->

    <!-- Libraries Stylesheet -->
    <!-- <link href="asset/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet"> -->
    <!-- <link href="asset/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" /> -->

    <!-- Customized Bootstrap Stylesheet -->
    <!-- <link href="asset/css/bootstrap.min.css" rel="stylesheet"> -->

    <!-- Template Stylesheet -->
    <!-- <link href="asset/css/style.css" rel="stylesheet"> -->
    <style>
        
        .avatar {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .btn-submit {
            width: 100%;
        }
    </style>
</head>
<body>
    <?php require_once 'c:\xampp\htdocs\GYM-WEB\views\profile\layout\header.php'; ?>
    <?php require_once 'c:\xampp\htdocs\GYM-WEB\views\profile\layout\sidebar.php'; ?>


    <div class="container form-container">
        <h2 class="text-center">Chỉnh sửa thông tin cá nhân 123</h2>
        <form action="/GYM-WEB/controllers/AuthController.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="hoTen">Họ và Tên</label>
                <input type="text" class="form-control" id="hoTen" name="hoTen" value="<?= htmlspecialchars($user['hoTen']); ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']); ?>" required>
            </div>

            <div class="form-group">
                <label for="sdt">Số điện thoại</label>
                <input type="text" class="form-control" id="sdt" name="sdt" value="<?= htmlspecialchars($user['sdt']); ?>" required>
            </div>

            <div class="form-group">
                <label for="ngaySinh">Ngày Sinh</label>
                <input type="date" class="form-control" id="ngaySinh" name="ngaySinh" value="<?= htmlspecialchars($user['ngaySinh']); ?>" required>
            </div>


            <div class="form-group">
                <label for="avatar">Ảnh đại diện</label>
                <div>
                    <!-- Hiển thị ảnh đại diện nếu có, nếu không thì dùng ảnh mặc định -->
                    <!-- <img src="
                     <?php  
                    //  BASE_URL . 'asset/img/avatar/' . ($user['hinhAnh'] ? $user['vaiTro'] . '/' . $user['hinhAnh'] : 'account.png'); 
                    ?>
                    " alt="Avatar" class="avatar"> -->
                </div>
                <input type="file" class="form-control-file" id="avatar" name="avatar">

                
            </div>
            <button type="submit" class="btn btn-primary btn-submit">Cập nhật thông tin</button>

            
        </form>
    </div>

    <!-- Kết nối với JavaScript của Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
