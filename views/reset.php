<?php
// views/reset_password.php
?>
<!DOCTYPE html>
<html>

<head>
    <title>Reset Password</title>
</head>

<body>
    <form method="POST" action="../reset/post">
        <label>Nhập email:</label>
        <input type="email" name="email" placeholder="Nhập email" required>
        <button type="submit">Reset Password</button>
    </form>

    <!-- <form method="POST" action="../reset/post">
        <input type="password" name="new_password" placeholder="New Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <button type="submit">Reset Password</button>
    </form> -->
</body>

</html>