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

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-check-circle fa-3x text-success"></i>
                <div class="ms-3">
                    <p class="mb-2">Đang sử dụng</p>
                    <h6 class="mb-0"><?php echo $deviceCounts['Đang sử dụng']; ?></h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-times-circle fa-3x text-danger"></i>
                <div class="ms-3">
                    <p class="mb-2">Hỏng</p>
                    <h6 class="mb-0"><?php echo $deviceCounts['Hỏng']; ?></h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-tools fa-3x text-warning"></i>
                <div class="ms-3">
                    <p class="mb-2">Bảo trì</p>
                    <h6 class="mb-0"><?php echo $deviceCounts['Bảo trì']; ?></h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-ban fa-3x text-danger"></i>
                <div class="ms-3">
                    <p class="mb-2">Không sử dụng</p>
                    <h6 class="mb-0"><?php echo $deviceCounts['Không sử dụng']; ?></h6>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12">
            <div class="bg-secondary text-center rounded p-4">
                <h6 class="mb-0">Danh Sách Thiết Bị</h6>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Mã Thiết Bị</th>
                            <th>Tên Thiết Bị</th>
                            <th>Ngày Mua</th>
                            <th>Trạng Thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($data)): ?>
                            <?php foreach ($data as $device): ?>
                                <tr>
                                    <td><?php echo $device['maThietBi']; ?></td>
                                    <td><?php echo $device['tenThietBi']; ?></td>
                                    <td><?php echo $device['ngayMua']; ?></td>
                                    <td><?php echo $device['trangthai']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4">Không có thiết bị nào.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
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
<!-- Template Javascript -->
<script src="asset/js/main.js"></script>
</body>
</html>