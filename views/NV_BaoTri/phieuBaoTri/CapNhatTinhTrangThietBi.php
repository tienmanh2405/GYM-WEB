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
    <link href="asset/image/favicon.ico" rel="icon">

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
</head>
<body>
<?php require_once('../views/NV_BaoTri/layout/header.php'); ?>
<?php require_once('../views/NV_BaoTri/layout/sidebar.php'); ?>
<?php require_once('../views/NV_BaoTri/layout/spinner.php'); ?>

<div class="container">
    <h2>Cập Nhật Phiếu Bảo Trì</h2>
    <form action="" method="POST">
        <div class="form-group">
            <label for="maBaoTri">Mã Bảo Trì</label>
            <input type="text" class="form-control" id="maBaoTri" name="maBaoTri" value="<?php echo $nextMaBaoTri; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="maThietBi">Mã Thiết Bị</label>
            <select class="form-control" id="maThietBi" name="maThietBi" required>
                <?php foreach ($thietBiList as $thietBi): ?>
                    <option value="<?php echo $thietBi['maThietBi']; ?>"><?php echo $thietBi['maThietBi']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="userID">Mã Nhân Viên</label>
            <select class="form-control" id="userID" name="userID" required>
                <?php foreach ($userList as $user): ?>
                    <option value="<?php echo $user['userID']; ?>"><?php echo $user['userID']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="ngayBaoTri">Ngày Bảo Trì</label>
            <input type="date" class="form-control" id="ngayBaoTri" name="ngayBaoTri" required>
        </div>
        <div class="form-group">
            <label for="trangThai">Trạng Thái</label>
            <select class="form-control" id="trangThai" name="trangThai" required>
                <option value="Đã hoàn thành">Đã hoàn thành</option>
                <option value="Đang thực hiện">Đang thực hiện</option>
                <option value="Chưa thực hiện">Chưa thực hiện</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Xác Nhận</button>
    </form>

    <?php
    // Display error message if any
    if (isset($error)) {
        echo "<div class='alert alert-danger mt-3'>$error</div>";
    }
    ?>
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