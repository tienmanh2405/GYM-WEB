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
    <meta charset="utf-8">
    <title>DarkPan - Bootstrap 5 Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <base href="/GYM-WEB/">
    <!-- Favicon -->
    <link href="../asset/image/favicon.ico" rel="icon">
    <!-- Kết nối với CSS của Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="asset/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="asset/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="asset/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="asset/css/style.css" rel="stylesheet">
    
    <!-- Custom Styles for Table Borders -->
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
            background-color:rgb(49, 33, 33);
        }
        .btn-submit {
            width: 100%;
        }
    </style>
</head>
<body>
    <?php require_once 'c:\xampp\htdocs\GYM-WEB\views\profile\layout\header.php';?>
    <?php require_once 'c:\xampp\htdocs\GYM-WEB\views\profile\layout\sidebar.php';?>
    <div class="container form-container">
        <h2 class="text-center">Chỉnh sửa thông tin cá nhân</h2>
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
                    <img src="asset/image/avatar/<?php
                        if($user['hinhAnh'] == ''){
                            echo "account.png";
                        }
                        else{
                            echo $user['hinhAnh']; 
                        }
                        
                    ?>" alt="<?php echo $user['hinhAnh'] ?>" class="avatar">

                </div>
                <input type="file" class="form-control-file" id="avatar" name="avatar">
                <!-- Change Password Section -->
                <hr>
                <h3 class="text-center">Đổi mật khẩu</h3>
                <div class="form-group">
                    <label for="current-password">Mật khẩu</label>
                    <input type="password" class="form-control" id="current-password" name="matKhau" required>
                </div>

                <!-- <div class="form-group">
                    <label for="new-password">Mật khẩu mới</label>
                    <input type="password" class="form-control" id="new-password" name="password" >
                </div> -->


                
            </div>
            <button type="submit" class="btn btn-primary btn-submit">Cập nhật thông tin</button>

            
        </form>
    </div>
    
<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="asset/lib/chart/chart.min.js"></script>
    <script src="asset/lib/easing/easing.min.js"></script>
    <script src="asset/lib/waypoints/waypoints.min.js"></script>
    <script src="asset/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="asset/lib/tempusdominus/js/moment.min.js"></script>
    <script src="asset/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="asset/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
</body>
<!-- Template Javascript -->
<script src="asset/js/main.js"></script>

</html>