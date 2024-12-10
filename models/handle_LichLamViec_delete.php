<?php
// require_once "../config/database.php";

// if (isset($_GET['user']) && isset($_GET['date']) && isset($_GET['shift'])) {
//     $user = $_GET['user'];
//     $date = $_GET['date'];
//     $shift = $_GET['shift'];

//     $database = new Database();
//     $conn = $database->connect();

//     $sql = "DELETE FROM lichlamViec WHERE userID = ? AND ngayLamViec = ? AND caLamViec = ?";
//     $stmt = $conn->prepare($sql);
//     $stmt->bind_param("sss", $user, $date, $shift);

//     if ($stmt->execute()) {
//         header("Location: /GYM-WEB/public/Admin/lichLamViec"); // Chuyển hướng về trang danh sách sau khi xóa
//     } else {
//         echo "Error deleting record: " . $stmt->error;
//     }

//     $stmt->close();
//     $conn->close();
// }



?>
<?php
require_once "../config/database.php";

if (isset($_GET['maLich'])) {
    $maLich = $_GET['maLich'];

    $database = new Database();
    $conn = $database->connect();

    // Xóa theo maLich
    $sql = "DELETE FROM lichlamViec WHERE maLich = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $maLich);

    if ($stmt->execute()) {
        header("Location: /GYM-WEB/public/Admin/lichLamViec"); // Chuyển hướng về trang danh sách sau khi xóa
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
