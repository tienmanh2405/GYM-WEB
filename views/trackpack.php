<!DOCTYPE html>
<html lang="vi">
<head>
    <?php
    require_once __DIR__ . '/../includes/head.php';
    require_once __DIR__ . '../../controllers/AuthController.php';

    // Kiểm tra phiên đăng nhập
    if (!isset($_SESSION['user'])) {
        header('Location: ./index.php');
        exit();
    }
    ?>
    <link rel="stylesheet" href="../asset/css/style2.css">
    <title>Theo Dõi Gói Tập</title>
</head>

<body>
    <!-- Header Section -->
    <?php require_once __DIR__ . '/../includes/header.php'; ?>
    <!-- Header End -->

    <div class="body-main">
        <div class="container">
            <!-- <div class="row"> -->
                <!-- Sidebar -->
                    <?php require_once __DIR__ . '/../includes/sidebar.php'; ?>
                <!-- Sidebar End -->

                <!-- Content -->
                    <div class="content">
                        
                        <h1>Theo Dõi Gói Tập</h1>

                        <div class="order">
                            <div class="order-header" onclick="toggleDetails('order1')">
                                <span>Mã gói: bảng gói đk (maGoiTap)</span>
                                <span>Ngày mua gói: .........</span>
                                <span>Ngày hết hạn: .........</span>
                                <span>Còn n ngày để sử dụng gói</span>
                            </div>
                            <div class="order-details" id="order1" style="display: none;">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Hình ảnh</th>
                                            <th>Tên gói</th>
                                            <th>Giá</th>
                                            <th>Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><img src="weight.jpg" alt="Hình cô gái tập tạ"></td>
                                            <td>Gói tập 1 tháng</td>
                                            <td>660.620 đ</td>
                                            <td>Đang hoạt động / Hết hạn</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" class="text-center">
                                                <button class="primary-button">Gia hạn ngay</button>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <!-- Thêm các gói tập khác tại đây -->
                    </div>
                </div>
                <!-- Content End -->
            </div>
        <!-- </div> -->
    </div>

    <script>
        function toggleDetails(orderId) {
            const details = document.getElementById(orderId);
            details.style.display = details.style.display === "block" ? "none" : "block";
        }
    </script>
</body>
</html>
