<?php
require_once __DIR__ . '/../controllers/GoiTapController.php'; // Fixed path
$goiTapController = new GoiTapController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the billing cycle from POST data
    $billingCycle = $_POST['billingCycle'] ?? 'Not specified';
    
    // Sanitize the input
    $billingCycle = htmlspecialchars($billingCycle);
    
    // Determine which data to fetch
    if ($billingCycle === 'Mỗi Tháng') {
        $data = $goiTapController->getAllGoiTap(11); // For monthly plans
    } elseif ($billingCycle === 'Mỗi Năm') {
        $data = $goiTapController->getAllGoiTap(12); // For yearly plans
    } else {
        $data = ['error' => 'Invalid billing cycle'];
    }
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}


?>
