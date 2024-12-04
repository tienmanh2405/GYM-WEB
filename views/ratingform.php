<?php
session_start(); // Bắt đầu session, cần thiết để sử dụng $_SESSION
if (!isset($_SESSION['user'])) {
    header('Location: ./index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Đánh Giá Dịch Vụ</title>
    <style>
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
    </style>
</head>

<body>
    <div class="rating-form">
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
    </div>
</body>

</html>