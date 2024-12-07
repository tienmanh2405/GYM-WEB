<?php
session_start();
require_once __DIR__ . '../../controllers/OrderController.php';
$orderController = new OrderController();
$order = $orderController->getGoiTapUser($_SESSION['user']);

?>
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
<body>
    <!-- Header Section -->
    <?php require_once __DIR__ . '/../includes/header.php'; ?>
    <!-- Header End -->

    <div class="container">
        <!-- Sidebar -->
         <?php require_once __DIR__ . '/../includes/sidebar.php'; ?>
        <!-- Sidebar End -->

        <main class="content">
            <h2>Theo dõi gói tập</h2>
            <?php if (!empty($order)) { ?>
                <?php foreach ($order as $item) { ?>
                    <div class="order">
                        <div class="order-header" onclick="toggleDetails('order<?php echo $item['idDangKy']; ?>')">
                            <span>Mã gói: <?php echo $item['idDangKy']; ?></span>
                            <span>Ngày mua gói: <?php echo $item['ngaymua']; ?></span>
                            <span style="">Ngày hết hạn: <?php echo $item['ngayhethan']; ?></span>
                            <?php
                            $remainingDays = (strtotime($item['ngayhethan']) - strtotime(date('Y-m-d'))) / 86400;
                            ?>
                            <span style="<?php echo $remainingDays < 40 ? 'color: red;' : ''; ?>">
                                <?php echo $remainingDays > 0 ? "Còn $remainingDays ngày để sử dụng gói" : "Gói đã hết hạn"; ?>
                            </span>

                        </div>
                        <div class="order-details" id="order<?php echo $item['idDangKy']; ?>" style="display: none;">
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
                                        <td><img src="weight.jpg" alt="hình cô gái tập tạ"></td>
                                        <td><?php echo $item['tenGoiTap']; ?></td>
                                        <td><?php echo number_format($item['gia'], 0, ',', '.'); ?> đ</td>
                                        <td><?php echo $remainingDays > 0 ? "Đang hoạt động" : "Hết hạn"; ?></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4" style="text-align: center;">
                                            <a href="./payment.php?id=<?php echo $item['maGoiTap'] ?>&id_order=<?php echo $item['idDangKy']; ?>">Gia hạn ngay</a>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <p>Bạn chưa đăng ký gói tập nào.</p><a style="color: red;" href="./index.php#price">Mua ngay</a>

            <?php } ?>
        </main>
    </div>
    <script>
        function toggleDetails(orderId) {
            const details = document.getElementById(orderId);
            if (details.style.display === "none" || !details.style.display) {
                details.style.display = "block";
            } else {
                details.style.display = "none";
            }
        }
    </script>
</body>


</html>