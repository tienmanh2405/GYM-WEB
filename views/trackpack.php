<?php
// session_start();
require_once __DIR__ . '/../includes/head.php';
require_once __DIR__ . '../../controllers/AuthController.php';
require_once __DIR__ . '../../controllers/OrderController.php';
$orderController = new OrderController();
$order = $orderController->getGoiTapUser($_SESSION['user']);

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <?php
    // Kiểm tra phiên đăng nhập
    if (!isset($_SESSION['user'])) {
        header('Location: ./index.php');
        exit();
    }
    ?>
    <link rel="stylesheet" href="../asset/css/style3.css">
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
            <h1>Theo dõi gói tập</h1>
    <?php if (!empty($order)) { ?>
        <?php foreach ($order as $item) { ?>
            <div class="order">
                <div class="order-header" onclick="toggleDetails('orderId<?php echo $item['idDangKy']; ?>')">
                    <span>Mã gói: <?php echo $item['idDangKy']; ?></span>
                    <span>Ngày mua gói: <?php echo $item['ngaymua']; ?></span>
                    <span>Ngày hết hạn: <?php echo $item['ngayhethan']; ?></span>
                    <?php
                    $remainingDays = (strtotime($item['ngayhethan']) - strtotime(date('Y-m-d'))) / 86400;
                    ?>
                    <span style="<?php echo $remainingDays < 2 ? 'color: red;' : ''; ?>">
                        <?php echo $remainingDays > 0 ? "Còn $remainingDays ngày sử dụng" : "Gói đã hết hạn"; ?>
                    </span>
                    <span class="icon">+</span>
                </div>
                        <div class="order-details" id="orderId<?php echo $item['idDangKy']; ?>" style="display: none;">
                        <table style="border-collapse: collapse; width: 100%; margin: 20px 0; font-family: Arial, sans-serif;">
                                <thead>
                                    <tr style="background-color: #f2f2f2; border: 1px solid #ddd;">
                                        <th style="padding: 10px; border: 1px solid #ddd;">Hình ảnh</th>
                                        <th style="padding: 10px; border: 1px solid #ddd;">Tên gói</th>
                                        <th style="padding: 10px; border: 1px solid #ddd;">Giá</th>
                                        <th style="padding: 10px; border: 1px solid #ddd;">Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="text-align: center; border: 1px solid #ddd;">
                                        <td style="padding: 10px; border: 1px solid #ddd;">
                                            <img src="weight.jpg" alt="hình cô gái tập tạ" style="width: 100px; height: auto; border-radius: 8px;">
                                        </td>
                                        <td style="padding: 10px; border: 1px solid #ddd;"><?php echo $item['tenGoiTap']; ?></td>
                                        <td style="padding: 10px; border: 1px solid #ddd;"><?php echo number_format($item['gia'], 0, ',', '.'); ?> đ</td>
                                        <td style="padding: 10px; border: 1px solid #ddd;">
                                            <?php echo $remainingDays > 0 ? "<span style='color: green;'>Đang hoạt động</span>" : "<span style='color: red;'>Hết hạn</span>"; ?>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr style="border: 1px solid #ddd;">
                                        <td colspan="4" style="text-align: center; padding: 10px; background-color: #f9f9f9; border: 1px solid #ddd;">
                                            <a href="./payment.php?id=<?php echo $item['maGoiTap'] ?>&id_order=<?php echo $item['idDangKy']; ?>" 
                                            style="color: #fff; background-color: tomato; padding: 8px 12px; text-decoration: none; border-radius: 4px;">
                                            Gia hạn gói
                                            </a>
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