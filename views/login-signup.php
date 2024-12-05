<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Double Slider Login / Registration Form</title>
  <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
  <link rel="stylesheet" href="../asset/css/login.css">
</head>

<body>
  <div class="container" id="container">

    <div class="form-container register-container">
      <form id="registerForm" action="../register/post" method="POST" autocomplete="off">
        <h1>ĐĂNG KÝ</h1>
        <input type="text" name="name" placeholder="Họ Tên" id="name" required>
        <input type="text" name="phone" placeholder="Số Điện Thoại" required>
        <input type="date" name="dob" min="1999-01-01" max="2009-12-31" required />
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="pass" id="password" placeholder="Mật Khẩu" required>
        <span id="passwordError" style="color: red; display: none;">Mật khẩu phải chứa ít nhất 8 ký tự, bao gồm cả chữ và số.</span>
        <button type="submit">Đăng Ký</button>
      </form>
    </div>

    <div class="form-container login-container">
      <form action="../login/post" method="POST" autocomplete="off">
        <h1>ĐĂNG NHẶP</h1>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Mật Khẩu" required>
        <div class="content">
          <div class="checkbox">
            <input type="checkbox" name="rememberme" id="checkbox">
            <label for='rememberme'>Nhớ login</label>
          </div>
          <div class="pass-link">
            <a href="reset.php">Forget mật khẩu?</a>
          </div>
        </div>
        <button type="submit">Đăng Nhặp</button>
      </form>
    </div>

    <div class="overlay-container">
      <div class="overlay">
        <div class="overlay-panel overlay-left">
          <h1 class="title">Xin Trào</h1>
          <p>Nếu bạn có tài khoản rùi thì bấm ở đây để đăng nhặp nhé.</p>
          <button class="ghost" id="login">Đăng Nhặp
            <i class="lni lni-arrow-left login"></i>
          </button>
        </div>
        <div class="overlay-panel overlay-right">
          <h1 class="title">Bạn là<br>người mới?</h1>
          <p>Chưa có tài khoản thì<br>qua đây liền cho mẹ.</p>
          <button class="ghost" id="register">Đăng Ký
            <i class="lni lni-arrow-right register"></i>
          </button>
        </div>
      </div>
    </div>

  </div>

  <script src="../asset/js/login.js"></script>

  <script>
    document.getElementById("registerForm").addEventListener("submit", function(event) {
      const password = document.getElementById("password").value;
      const passwordError = document.getElementById("passwordError");
      const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/; 

      if (!passwordRegex.test(password)) {
        passwordError.style.display = "block";
        event.preventDefault(); 
      } else {
        passwordError.style.display = "none"; 
      }
    });
  </script>

</body>

</html>
