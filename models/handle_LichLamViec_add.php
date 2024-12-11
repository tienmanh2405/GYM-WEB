<?php
// require_once "../config/database.php";

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     $ngayLamViec = $_POST['ngayLamViec'];
//     $caLamViec = $_POST['caLamViec'];
//     $userIDs = $_POST['userID'];  // Mảng chứa các userID được chọn

//     $database = new Database();
//     $conn = $database->connect();

//     // Dùng prepared statements để bảo mật
//     $stmt = $conn->prepare("INSERT INTO lichlamViec (caLamViec, ngayLamViec, userID) VALUES (?, ?, ?)");

//     // Lặp qua các userID và chèn vào cơ sở dữ liệu
//     foreach ($userIDs as $userID) {
//         $stmt->bind_param("ssi", $caLamViec, $ngayLamViec, $userID);
//         if (!$stmt->execute()) {
//             echo "Lỗi khi thêm dữ liệu: " . $stmt->error;
//         }
//     }

//     $stmt->close();
//     $conn->close();

//     echo "Thêm lịch làm việc thành công!";
//     // Chuyển hướng trở lại hoặc hiển thị thông báo
//     header("Location: /GYM-WEB/public/Admin/lichLamViec");
// }
?>

<?php
require_once "../config/database.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ngayLamViec = $_POST['ngayLamViec'];
    $caLamViec = $_POST['caLamViec'];
    $userIDs = $_POST['userID'];  // Mảng chứa các userID được chọn

    $database = new Database();
    $conn = $database->connect();

    // Kiểm tra kết nối cơ sở dữ liệu
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Tính ngày bắt đầu và kết thúc của tuần hiện tại
    $currentDate = new DateTime($ngayLamViec);
    $startOfWeek = clone $currentDate;
    $startOfWeek->modify('monday this week');
    $endOfWeek = clone $startOfWeek;
    $endOfWeek->modify('sunday this week');

    // Tính ngày bắt đầu và kết thúc của tuần kế tiếp
    $startOfNextWeek = clone $startOfWeek;
    $startOfNextWeek->modify('+1 week');
    $endOfNextWeek = clone $endOfWeek;
    $endOfNextWeek->modify('+1 week');

    // Dùng prepared statements để bảo mật
    $stmt = $conn->prepare("INSERT INTO lichlamViec (caLamViec, ngayLamViec, userID) VALUES (?, ?, ?)");

    // Kiểm tra nếu statement được chuẩn bị thành công
    if ($stmt === false) {
        die("Lỗi chuẩn bị câu lệnh: " . $conn->error);
    }

    // Lặp qua các userID và chèn vào cơ sở dữ liệu
    foreach ($userIDs as $userID) {
        // Chèn lịch cho tuần hiện tại
        $stmt->bind_param("ssi", $caLamViec, $ngayLamViec, $userID);
        if (!$stmt->execute()) {
            echo "Lỗi khi thêm dữ liệu cho tuần hiện tại: " . $stmt->error;
        }

        // Chèn lịch cho tuần kế tiếp (các ngày trong tuần)
        $currentDate = clone $startOfNextWeek;
        while ($currentDate <= $endOfNextWeek) {
            $ngayLamViecNextWeek = $currentDate->format('Y-m-d');
            $stmt->bind_param("ssi", $caLamViec, $ngayLamViecNextWeek, $userID);
            if (!$stmt->execute()) {
                echo "Lỗi khi thêm dữ liệu cho tuần kế tiếp (ngày " . $ngayLamViecNextWeek . "): " . $stmt->error;
            }
            $currentDate->modify('+1 day');
        }
    }

    $stmt->close();
    $conn->close();

    echo "Thêm lịch làm việc thành công!";
    header("Location: /GYM-WEB/public/Admin/lichLamViec");
}
?>

