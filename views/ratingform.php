<!--  -->
<?php
require_once __DIR__ . '/../controllers/AuthController.php';
$authController = new AuthController(); 

$userId = $authController->checkLoginStatus(); 
if ($userId) {
    // Lấy thông tin user từ AuthController
    $user = $authController->getUser($userId);
} else {
    echo "<script>alert('Hãy đăng nhập');</script>";
    header('Location: ./login-signup.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Đánh Giá Dịch Vụ</title>
    <?php
    require_once __DIR__ . '/../includes/head.php';
    ?>
<link rel="stylesheet" href="../asset/css/style2.css">
<head>
</head>
    <!-- <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .rating-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        .rating-form h2 {
            margin-top: 0;
            margin-bottom: 15px;
            font-size: 24px;
            color: #333;
        }

        .rating-form textarea {
            width: 100%;
            height: 100px;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            resize: vertical;
        }

        .rating-form label {
            font-size: 16px;
            margin-bottom: 5px;
            display: block;
        }

        .rating-form select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .rating-form button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .rating-form button:hover {
            background-color: #45a049;
        }
    </style> -->
</head>

<body>
    <!-- Header Section Begin -->
    <?php
    require_once __DIR__ . '/../includes/header.php';
    ?>
    <!-- Header End -->
    <!-- <div class="rating-form">
        <h2>Đánh Giá Dịch Vụ</h2>
        <form action="../ratingform/post" method="post">
            <label for="content">Nội dung đánh giá:</label>
            <textarea id="content" name="content" placeholder="Nhập nội dung đánh giá của bạn..."></textarea>
            <label for="rating">Điểm đánh giá:</label>
            <select id="rating" name="rating">
                <option value="5">5 - Rất tốt</option>
                <option value="4">4 - Tốt</option>
                <option value="3">3 - Trung bình</option>
                <option value="2">2 - Kém</option>
                <option value="1">1 - Rất kém</option>
            </select>

            <button type="submit">Gửi Đánh Giá</button>
        </form>
    </div> -->
    <div class="container">
        <!-- Sidebar begin -->
        <?php
        require_once __DIR__ . '/../includes/sidebar.php';
        ?>
        <!-- Sidebar ènd -->
        <div class="content">
                <h1>Đánh Giá Dịch Vụ</h1>
                    <form action="../ratingform/post" method="post" onsubmit="return validateForm()">
                        <div class="form-group">
                            <label for="content">Nội dung đánh giá</label>
                            <textarea id="content" name="content" class="form-control" placeholder="Nhập nội dung đánh giá của bạn..." required></textarea>
                            <!-- <input type="text" name="rating-content" class="form-control" id="rating-content" required> -->
                        </div>
                        <div class="form-group">
                        <label for="rating">Điểm đánh giá:</label>
                            <select id="rating" name="rating" class="form-control" required>
                                <option value="5">5 - Rất tốt</option>
                                <option value="4">4 - Tốt</option>
                                <option value="3">3 - Trung bình</option>
                                <option value="2">2 - Kém</option>
                                <option value="1">1 - Rất kém</option>
                            </select>
</div>
                        <button type="submit">Ô KÊ</button>
                        <?php
                        if (isset($_SESSION['error'])) {
                            echo "<p style='color: red;'>" . $_SESSION['error'] . "</p>";
                            unset($_SESSION['error']);
                        }
                        ?>
                    </form>
         </div>
            

        </div>
</body>

</html>