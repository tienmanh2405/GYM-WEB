<?php
session_unset();
require_once BASE_PATH . '/config/database.php';
require_once BASE_PATH . '/config/config.php';

$conn = (new Database)->connect();
if (isset($_POST['login'])) {
    $email    = $_POST['username'];
    $password = $_POST['password'];

    $query  = "SELECT * FROM nguoidung WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($conn, $query);
    $user   = mysqli_fetch_assoc($result);

    if ($user) {
        // Lưu thông tin vào session và cookie
        $_SESSION['user']       = $user['userID'];
        $_SESSION['user_entry'] = $user;
        echo $_SESSION['user_entry'];
        setcookie('user_id', $user['userID'], time() + (86400 * 30), "/"); // Lưu cookie 30 ngày

        // Điều hướng dựa trên vai trò của người dùng
        if ($user['vaiTro'] === 'Admin') {
            header('Location: ./Admin/home');
        } elseif ($user['vaiTro'] === 'NVQuay') {
            header('Location: ./NV_Quay/dash');
        } elseif ($user['vaiTro'] === 'NVBaoTri') {
            header('Location: ./NV_BaoTri/dash');
        } else {
            echo "<script>alert('Vai trò không hợp lệ');</script>";
            echo "<script>window.location.href = '" . BASE_PATH . "views/login-signup.php';</script>";
        }
        exit();
    } else {
        echo "<script>alert('Tài khoản hoặc mật khẩu không đúng');</script>";
        echo "<script>window.location.href = '" . BASE_PATH . "views/login-signup.php';</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Login</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #000;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #111;
            border: 2px solid #e60000;
            border-radius: 8px;
            padding: 20px;
            width: 100%;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(255, 0, 0, 0.5);
            box-sizing: border-box; /* Thêm dòng này */
        }

        .login-container h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #e60000;
        }

        .login-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #333;
            border-radius: 5px;
            background-color: #222;
            color: #fff;
            box-sizing: border-box; /* Thêm dòng này */
        }

        .login-container button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            background-color: #e60000;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        .login-container button:hover {
            background-color: #ff1a1a;
        }

        .login-container a {
            display: block;
            margin-top: 15px;
            color: #e60000;
            text-decoration: none;
        }

        .login-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>


<body>
    <div class="login-container">
        <h1>Gym Login</h1>
        <form action="./" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
        </form>
        <!-- <a href="#">Forgot Password?</a>
        <a href="#">Sign Up</a> -->
    </div>
</body>

</html>