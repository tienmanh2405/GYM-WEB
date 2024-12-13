<?php
// Xác định tuần dựa trên lựa chọn
$nextWeek = isset($_GET['week']) && $_GET['week'] === 'next';
// Lấy lịch làm việc
$lichLamViecModel = new LichLamViec();
$lichLamViec = $lichLamViecModel->getWorkingSchedule($nextWeek);
// Các thông tin cố định
$daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
$shifts = ['Ca sáng', 'Ca chiều'];
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
        table {
        border-collapse: collapse;
        width: 100%;
        color: #333;
        font-family: Arial, sans-serif;
        font-size: 14px;
        text-align: left;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        margin: auto;
        margin-top: 50px;
        margin-bottom: 50px;
        background-color: #fff;
        }
        table th {
            background-color: #ff9800;
            color: blaclk;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: 1px solid #ccc;
        } 
        th, td{
            text-align: center; /* Căn giữa nội dung trong các ô */
            vertical-align: middle;
        }
        table tr, td{
            border: 1px solid #ccc;
        }  
        /* Định dạng cho các tên người dùng */
    .span-user {
        display: inline-block; /* Để áp dụng height */
        height: 50px; /* Đặt chiều cao */
        width: 150px;
        background-color: black; /* Màu nền nhẹ */
        padding: 5px 10px; /* Khoảng cách xung quanh mỗi tên */
        margin-bottom: 5px; /* Khoảng cách giữa các tên */
        border-radius: 5px; /* Bo góc cho các ô tên */
        font-size: 14px; /* Kích thước chữ */
        color: #fff; /* Màu chữ tối */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Thêm hiệu ứng đổ bóng */
        transition: background-color 0.3s ease; /* Hiệu ứng khi hover */
    }

    </style>
</head>
<body>
    <?php require_once('../views/NV_Quay/layout/header.php'); ?>
    <?php require_once('../views/NV_Quay/layout/sidebar.php'); ?>
    <?php require_once('../views/NV_Quay/layout/spinner.php'); ?>
    
    <div class="container-fluid pt-4 px-4">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-xl-10"> 
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Lịch làm việc</h6>
                    <form method="GET" action="" id="week-selector-form">
                        <select name="week" class="form-select" onchange="document.getElementById('week-selector-form').submit()">
                            <option value="current" <?= (!isset($_GET['week']) || $_GET['week'] === 'current') ? 'selected' : '' ?>>Tuần này</option>
                            <option value="next" <?= (isset($_GET['week']) && $_GET['week'] === 'next') ? 'selected' : '' ?>>Tuần sau</option>
                        </select>
                    </form>
                </div>

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Ca làm việc</th>
                            <?php foreach ($daysOfWeek as $day): ?>
                                <th><?= $day ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($shifts as $shift): ?>
                            <tr>
                                <td><strong><?= $shift ?></strong></td>
                                <?php foreach ($daysOfWeek as $day): ?>
                                    <td style="height: 250px; vertical-align: middle;">
                                        <?php 
                                            // Kiểm tra nếu tuần này hoặc tuần sau được chọn
                                            if (isset($_GET['week']) && $_GET['week'] === 'next') {
                                                // Nếu là tuần sau
                                                $date = date('Y-m-d', strtotime($day . ' next week'));
                                            } else {
                                                // Nếu là tuần này
                                                $date = date('Y-m-d', strtotime($day . ' this week'));
                                            }
                                        
                                            if (!empty($lichLamViec[$date][$shift])) {
                                                foreach ($lichLamViec[$date][$shift] as $user) {
                                                    echo "<span height='50px' class='span-user'>$user</span><br>";
                                                }
                                            } else {
                                                echo "Không có";
                                            }
                                        ?>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
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
