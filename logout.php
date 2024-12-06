<?php
session_start();

// Hủy session
session_destroy();

// Xóa cookie 'user_id' nếu có
if (isset($_COOKIE['user_id'])) {
    setcookie('user_id', '', time() - 3600, '/');  // Xóa cookie bằng cách thiết lập thời gian hết hạn là trong quá khứ
}
exit();
?>