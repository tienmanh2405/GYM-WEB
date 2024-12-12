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
$database = new Database();
$conn = $database->connect();

// Lấy dữ liệu từ form
$tuan = $_POST['tuan'];
$ngayLamViec = $_POST['ngayLamViec'];
$userIDs = $_POST['userID'];
$caLamViec = $_POST['caLamViec'];

// Kiểm tra nếu đã có dữ liệu lịch làm việc cho ngày, ca và nhân viên này
foreach ($userIDs as $userID) {
    $query = "SELECT * FROM lichlamviec WHERE ngayLamViec = ? AND caLamViec = ? AND userID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $ngayLamViec, $caLamViec, $userID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Nếu đã tồn tại, trả về thông báo
        echo "<script>alert('Nhân viên ID $userID đã có lịch làm việc vào ngày $ngayLamViec, ca $caLamViec.');</script>";
        echo "<script>window.history.back();</script>";
        exit;
    }
}

// Nếu không có trùng lặp, tiếp tục thêm lịch làm việc
foreach ($userIDs as $userID) {
    $insertQuery = "INSERT INTO lichlamviec (ngayLamViec, caLamViec, userID) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("sss", $ngayLamViec, $caLamViec, $userID);
    $stmt->execute();
}

// Redirect hoặc thông báo thành công
echo "<script>alert('Thêm lịch làm việc thành công.');</script>";
echo "<script>window.location.href = '/GYM-WEB/public/Admin/lichLamViec';</script>";
?>


