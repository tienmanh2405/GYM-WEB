<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thanh Toán</title>
  <style>
  /* Reset CSS */
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
    font-family: Arial, sans-serif;
    background: #f9f9f9;
    color: #333;
  }

  .header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #fff;
    padding: 15px 30px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  .logo {
    font-size: 24px;
    font-weight: bold;
    color: #e63946;
  }

  .navbar ul {
    list-style: none;
    display: flex;
  }

  .navbar ul li {
    margin: 0 15px;
  }

  .navbar ul li a {
    text-decoration: none;
    color: #333;
    font-size: 16px;
  }

  .payment-container {
    max-width: 800px;
    margin: 30px auto;
    padding: 20px;
    background: #fff;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
  }

  .payment-content {
    display: flex;
    justify-content: space-between;
    gap: 20px;
  }

  .package-details {
    flex: 1;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 8px;
    background: #f9f9f9;
  }

  .package-details h2 {
    font-size: 20px;
    color: #333;
    margin-bottom: 10px;
    text-align: center;
  }
  .package-details img {
    width: 350px;
    height: 250px;
    padding: 10px;
  }

  .package-details p {
    font-weight: bold;
    margin-bottom: 5px;
    color: #555;
  }

  .payment-form {
    flex: 1;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 8px;
  }

  .payment-form form {
    display: flex;
    flex-direction: column;
  }

  .payment-form label {
    font-size: 14px;
    margin-bottom: 5px;
  }

  .payment-form input,
  .payment-form select {
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
  }

  .btn-payment {
    background: #e63946;
    color: #fff;
    padding: 10px;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
  }

  .btn-payment:hover {
    background: #c6283e;
  }
</style>

  <link rel="stylesheet" href="style.css">
  <?php
  session_start();

  
  if (!isset($_SESSION['user'])) {
    header('Location: ./index.php');
    exit();
  }
  require_once __DIR__ . '../../controllers/GoiTapController.php';
  require_once __DIR__ . '/../controllers/AuthController.php';
  require_once __DIR__ . '../../controllers/KhuyenMaiController.php';
  require_once __DIR__ . '/../includes/head.php';

  $id = $_GET['id'];
  if(isset($_GET['id_order'])){
    $idOrder = $_GET['id_order'];
    $_SESSION['id_order'] = $idOrder;
  }
  $goiTapController = new GoiTapController();
  $authController = new AuthController();
  $khuyenMaiController = new KhuyenMaiController();

  $user = $authController->getUser($_SESSION['user']);
  $data = $goiTapController->getGoiTapID($id);
  ?>

</head>


<body>
    <!-- Header Section Begin -->
    <?php
    require_once __DIR__ . '/../includes/header.php';
    ?>
    <!-- Header Section End -->

  <main class="payment-container">
    <h1 style="font-size: 30px;">Thanh Toán Gói Tập</h1>
    <div class="payment-content">
      <!-- Chi tiết gói tập -->
      <div class="package-details">
        <img src="../asset/img/gallery/<?php echo $data['anh']; ?>" />
        <h2><span id="package-name"><?php echo $data['tenGoiTap'] ?></span></h2>
        <p>Giá: </p><span id="package-price"><?php echo $data['gia'] ?></span> vnđ
        <p>Mô tả:</p> <span id="package-description"><?php echo $data['moTa'] ?></span>
        <p>Thời Gian Tập Luyện:</p><?php 
              if ($data['thoiHan'] <= 11) {
                  echo $data['thoiHan'] . " Tháng";
              } else {
                  echo $data['thoiHan'] . " Năm";
              }
          ?>

        

      </div>

      <!-- Form Thanh Toán -->
      <div class="payment-form">
        <form action="./vnpay_php/vnpay_pay.php" method="post">
          <label for="name">Họ và tên</label>
          <input type="text" id="name" name="name" value="<?php echo $user['hoTen'] ?>" placeholder="Nhập họ và tên" required>

          <label for="email">Email</label>
          <input type="email" id="email" value="<?php echo $user['email'] ?>" name="email" placeholder="Nhập email" required>

          <label for="payment-method">Phương thức thanh toán</label>
          <!-- <select id="payment-method" name="payment-method" required>
            <option value="bank-transfer">Chuyển khoản ngân hàng</option>
          </select> -->
          <input value="Chuyển khoản ngân hàng"  required>

          <label for="code">Mã khuyến mãi</label>
          <?php
          $maKM = null;
          if ($data['thoiHan'] >= 12) {
            $maKM = 1;
          }
          if ($data['thoiHan'] >= 24) {
            $maKM = 2;
          }
          if ($data['thoiHan'] >= 36) {
            $maKM = 3;
          }
          $km = $khuyenMaiController->getKM($maKM);
          ?>
          <input type="text" id="code" name="code" value="<?php echo $maKM; ?>" placeholder="Nhập mã khuyến mãi nếu có">
          <?php
          if ($km) { ?>
            <input type="hidden" name="gia" value="<?php echo htmlspecialchars($data['gia'] - ($data['gia'] * $km['giamGia'])); ?>">
          <?php } else { ?>
            <input type="hidden" name="gia" value="<?php echo htmlspecialchars($data['gia']); ?>">
          <?php } ?>
          <input type="hidden" name="thoi_han" value="<?php echo $data['thoiHan'];?>">
          <input type="hidden" name="idGoiTap" value="<?php echo htmlspecialchars($data['maGoiTap']); ?>">
          <input type="hidden" name="ma_km" value="<?php echo $maKM; ?>">
          <input type="hidden" name="so_tien" value="<?php echo htmlspecialchars($data['gia'] - ($data['gia'] * $km['giamGia'])); ?>">
          <button type="submit" class="btn-payment">Thanh Toán</button>
        </form>
      </div>
    </div>
  </main>
</body>

</html>