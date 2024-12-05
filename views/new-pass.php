<!DOCTYPE html>
<html>

<head>
    <title>Reset Password</title>
</head>

<body>
    <!-- Form for setting a new password -->
    <form method="POST" action="../newpass/post">
        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="new_password" placeholder="New Password" 
               pattern="(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}" 
               title="Password must be at least 8 characters long and include letters and numbers" 
               required>
        
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
        
        <button type="submit">Cập nhật mật khẩu</button>
    </form>
</body>

</html>
