<?php
require_once "../config/database.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ngayLamViec = $_POST['ngayLamViec'];
    $caLamViec = $_POST['caLamViec'];
    $userIDs = $_POST['userID'];  // Mảng chứa các userID được chọn

    $database = new Database();
    $conn = $database->connect();

    // Dùng prepared statements để bảo mật
    $stmt = $conn->prepare("INSERT INTO lichlamViec (caLamViec, ngayLamViec, userID) VALUES (?, ?, ?)");

    // Lặp qua các userID và chèn vào cơ sở dữ liệu
    foreach ($userIDs as $userID) {
        $stmt->bind_param("ssi", $caLamViec, $ngayLamViec, $userID);
        if (!$stmt->execute()) {
            echo "Lỗi khi thêm dữ liệu: " . $stmt->error;
        }
    }

    $stmt->close();
    $conn->close();

    echo "Thêm lịch làm việc thành công!";
    // Chuyển hướng trở lại hoặc hiển thị thông báo
    header("Location: /GYM-WEB/public/Admin/lichLamViec");
}
?>

