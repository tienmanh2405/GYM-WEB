<?php
session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/UserModel.php';

require_once __DIR__  . '/../libs/PHPMailer-master/src/PHPMailer.php';
require_once __DIR__  .  '/../libs/PHPMailer-master/src/SMTP.php';
require_once __DIR__  .  '/../libs/PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class AuthController
{
    private $user;
    private $db;

    public function __construct()
    {
        $this->db = new Database();
        $this->connection = $this->db->connect(); 
        $this->user = new UserModel($this->db);
    }
// Hàm gửi OTP bằng PHPMAILER
    private function sendOTP($email)
    {
        $otp = rand(100000, 999999);
        $_SESSION['otp'] = $otp;
        $_SESSION['email'] = $email;
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'unidsalt@gmail.com';
            $mail->Password = 'qhbv qwei zrst uomk';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('unidsalt@gmail.com', 'Gym Center');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Body = "Your OTP is: " . $_SESSION['otp'];

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    // Hàm đăng ký người dùng
    public function register()
    {


        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $dob = $_POST['dob'];
        $password = $_POST['pass'];

        // Kiểm tra nếu email đã tồn tại
        if ($this->user->checkEmailExists($email)) {
            echo "Email already exists!";
            return;
        }

        // Gửi OTP xác thực qua email
        if ($this->sendOTP($email)) {
            $_SESSION['temp_user'] = [
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'dob' => $dob,
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ];
            header('Location: ' . BASE_URL . 'views/verify.php');
        } else {
            echo "Failed to send OTP!";
        }
    }

    // public function login()
    // {
    //     $email = $_POST["email"];
    //     $password = $_POST["password"];
    //     $user = $this->user->login($email, $password);
    //     print_r($user);
    //     echo  $user['user']['id'];
    //     if ($user['success'] == true) {
    //         $_SESSION['user'] = $user['user']['id']; // Lấy ID từ thông tin user
    //         header('Location: ' . BASE_URL . 'views/index.php');
    //         exit();
    //     } else {
    //         header('Location: ' . BASE_URL . 'views/login-signup.php');
    //         exit();
    //     }
    // }

    // Hàm đăng nhập
        public function login()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $rememberMe = isset($_POST['rememberme']);

        $result = $this->user->login($email, $password);

        
        if ($result['success']) {
            $_SESSION['user'] = $result['user']['id'];
            if ($rememberMe) {
                setcookie('user_id', $result['user']['id'], time() + (86400 * 30), "/"); // Lưu cookie 30 ngày
            }
            header('Location: ' . BASE_URL . 'views/index.php');
            exit();
        } else {
            echo "<script>alert('" . $result['message'] . "');</script>";
            echo "<script>window.location.href = '" . BASE_URL . "views/login-signup.php';</script>";
            exit();
        }
    }
    //Hàm kiểm tra phiên đăng nhập
    function checkLoginStatus(){
    if (isset($_SESSION['user'])) {
        return $_SESSION['user'];
    }
    if (isset($_COOKIE['user_id'])) {
        $_SESSION['user'] = $_COOKIE['user_id'];
        return $_COOKIE['user_id'];
    }
    return false;
}

    // Hàm xác thực OTP
    public function verifyOTP()
    {
        $otp = $_POST['otp'];
        if ($otp == $_SESSION['otp']) {
            $user = $_SESSION['temp_user'];
            $userResult = $this->user->register($user['name'], $user['email'], $user['phone'], $user['dob'], $user['password']);
            print_r($userResult);
            if ($userResult['success'] == true) {
                unset($_SESSION['otp']);
                unset($_SESSION['temp_user']);
                $this->user->verifyEmail($userResult['token']);
                echo $userResult['token'];
                 header('Location: ' . BASE_URL . 'views/login-signup.php');
            }
        } else {
            echo "Invalid OTP!";
        }
    }
    public function getUser($id)
    {
        $user = $this->user->getUser($id);
        return $user;
    }


    public function updatePassword($id)
    {
        $confirmPassword = $_POST['confirm-password'];
        $currentPassword = $_POST['current-password'];
        $user = $this->user->getUser($id); 

        // Kiểm tra mật khẩu cũ
        if (!password_verify($currentPassword, $user['matKhau'])) {
            echo "<script>alert('Mật khẩu cũ không chính xác');</script>";
            echo "<script>window.history.back();</script>"; // Quay lại trang trước
            return;
        }

        // Kiểm tra mật khẩu mới khác mật khẩu cũ
        if (password_verify($confirmPassword, $user['matKhau'])) {
            echo "<script>alert('Mật khẩu mới phải khác mật khẩu cũ');</script>";
            echo "<script>window.history.back();</script>";
            return;
        }

        // Cập nhật mật khẩu vào cơ sở dữ liệu
        $this->user->update($confirmPassword, $id);

        // Hiển thị thông báo thành công
        echo "<script>
        alert('Cập nhật mật khẩu thành công');
        window.location.href = '" . BASE_URL . "views/change-pass.php';
        </script>";
        exit;
    }

    public function review($id)
    {
        $content = $_POST['content'];
        $point = $_POST['rating'];
        $user = $this->user->review($content, $point, $id);
        echo "<script>
        alert('Cảm ơn bạn đã quánh giá!');
        window.location.href = '" . BASE_URL . "views/ratingform.php';
        </script>";
    }

    public function resetPass()
    {

        $email = $_POST["email"];
        $user = $this->user->checkEmailExists($email);
        if ($user) {
            $this->sendOTP($email);
            echo "<script>
            window.location.href = '" . BASE_URL . "views/verify-new-pass.php';
        </script>";
        } else {
            echo "<script>
            alert('Email không tồn tại');
        </script>";
            exit;
        }
    }

    public function newPassVerifyOTP()
    {
        $otp = $_POST['otp'];
        if ($otp == $_SESSION['otp']) {
            unset($_SESSION['otp']);
            echo "<script>
            window.location.href = '" . BASE_URL . "views/new-pass.php';
        </script>";
            exit;
        } else {
            echo "<script>
            alert('OTP không hợp lệ');
        </script>";
            exit;
        }
    }

    public function newPassword()
    {
        $email = $_SESSION['email'];
        $password = $_POST['confirm_password'];
        $user = $this->user->newPass($password, $email);
        echo "<script>
            window.location.href = '" . BASE_URL . "views/login-signup.php';
        </script>";
    }

    public function updateProfile($id) {
        $email = $_POST['email'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $user = $this->user->updateProfile($email, $name, $phone, $id);
        echo "<script>
         alert('Cập nhật thành công !');
            window.location.href = '" . BASE_URL . "views/profile.php';
        </script>";
    }
}
