<?php
// Bắt đầu phiên làm việc
session_start();

// Xóa tất cả session variables (nếu có)
session_unset();

// Hủy session (nếu cần)
session_destroy();

// Chuyển hướng người dùng đến trang đăng nhập
header("Location: ../public");
exit();
?>
