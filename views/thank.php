<?php
session_start();
require_once __DIR__ . '/../controllers/HoaDonController.php';
require_once __DIR__ . '/../controllers/OrderController.php';
require_once __DIR__ ."/../views/vnpay_php/config.php";

$hoaDonController = new hoaDonController();
$orderController = new OrderController();

// Kiểm tra xem các tham số có tồn tại trong $_GET không
$vnp_TxnRef = isset($_GET['vnp_TxnRef']) ? $_GET['vnp_TxnRef'] : null;
$vnp_Amount = isset($_GET['vnp_Amount']) ? $_GET['vnp_Amount'] / 100 : null;
$vnp_OrderInfo = isset($_GET['vnp_OrderInfo']) ? $_GET['vnp_OrderInfo'] : null;
$vnp_ResponseCode = isset($_GET['vnp_ResponseCode']) ? $_GET['vnp_ResponseCode'] : null;

$id = isset($_SESSION['id']) ? $_SESSION['id'] : null;
$maKM = isset($_SESSION['maKM']) ? $_SESSION['maKM'] : null;
$idOrder = isset($_SESSION['id_order']) ? $_SESSION['id_order'] : null;

if ($idOrder) {
    // Gia hạn gói tập nếu có id_order
    $orderController->giaHanGoiTap($idOrder, $_SESSION['thoi_han']);
    unset($_SESSION['id_order']);
    echo "<script>alert('Gói tập của bạn đã được gia hạn thành công!'); window.location.href = '" . BASE_URL . "views/trackpack.php';</script>";
    exit();
} elseif ($vnp_ResponseCode === '00') {
    // Xử lý nếu thanh toán thành công
    $hoaDonController->add($id, $vnp_Amount, $maKM);
    unset($_SESSION['id']);
    unset($_SESSION['maKM']);
    echo "<script>alert('Thanh toán thành công!'); window.location.href = '" . BASE_URL . "views/trackpack.php';</script>";
    exit();
} else {
    // Nếu thanh toán thất bại
    echo "<script>alert('Thanh toán thất bại. Vui lòng thử lại.'); window.location.href = '" . BASE_URL . "views/payment.php';</script>";
    exit();
}
?>
