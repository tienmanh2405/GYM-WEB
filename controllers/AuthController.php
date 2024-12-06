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
        $newPassword = $_POST['new-password'];
        $confirmPassword = $_POST['confirm-password'];
        $currentPassword = $_POST['current-password'];

        $user = $this->user->getUser($id); 

        // Kiểm tra mật khẩu cũ
        if (!password_verify($currentPassword, $user['matKhau'])) {
            $_SESSION['error'] = "Mật khẩu cũ không chính xác"; //dùng session để lưu lỗi
            header('Location: ' . BASE_URL . 'views/change-pass.php');
            exit;
            // echo "<script>alert('Mật khẩu cũ không chính xác');</script>";
            // echo "<script>window.history.back();</script>"; // Quay lại trang trước
            // return;
        }

        // Kiểm tra mật khẩu mới khác mật khẩu cũ
        if (password_verify($confirmPassword, $user['matKhau'])) {
            $_SESSION['error'] = "Mật khẩu mới phải khác mật khẩu cũ";
            header('Location: ' . BASE_URL . 'views/change-pass.php');
            exit;
            // echo "<script>alert('Mật khẩu mới phải khác mật khẩu cũ');</script>";
            // echo "<script>window.history.back();</script>";
            // return;
        }
        // mã hóa mật khẩu mới, này không cần vì mật khẩu mới đã được mã hóa trong 1 hàm nào đó mà tao không biết =]
        // $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        
        // Cập nhật mật khẩu vào cơ sở dữ liệu
        $this->user->update($newPassword, $id);

        // Hiển thị thông báo thành công
        echo "<script>
        alert('Cập nhật mật khẩu thành công');
        window.location.href = '" . BASE_URL . "views/profile.php';
    </script>";
        exit;
    }

    public function review($id)
    {
        $content = $_POST['content'];
        $point = $_POST['rating'];
        $user = $this->user->review($content, $point, $id);
        echo "<script>
        alert('Đánh gía thành công');
        window.location.href = '" . BASE_URL . "views/profile.php';
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
        // cập nhật thôgn tin
        $email = $_POST['email'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $user = $this->user->getUser($id);

        // cập nhật ảnh
        // Xử lý upload ảnh đại diện
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
            // Đặt thư mục lưu ảnh
            $uploadDir = 'asset/img/avatar/'.$user['vaiTro'].'/';
            
            // $uploadDir = '../asset/img/avatar/';
            $fileName = $_FILES['avatar']['name'];
            $fileTmp = $_FILES['avatar']['tmp_name'];
            $fileType = $_FILES['avatar']['type'];
            $fileSize = $_FILES['avatar']['size'];
            
            // Kiểm tra loại file (chỉ cho phép jpg, jpeg, png)
            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!in_array($fileType, $allowedTypes)) {
                echo "
                <script>alert('Ảnh chỉ có thể là JPG, JPEG, hoặc PNG.');
                window.location.href = '" . BASE_URL . "views/profile.php';
                </script>";
                exit();
            }
            
            
            // Kiểm tra kích thước file (ví dụ tối đa 5MB)
            if ($fileSize > 5 * 1024 * 1024) {
                echo "<script>alert('Kích thước ảnh không được vượt quá 5MB.');
                window.location.href = '" . BASE_URL . "views/profile.php';
                </script>";
                exit();
            }
            
            // Tạo tên file mới để tránh trùng lặp
            $newFileName = $user['email'] . uniqid('avatar_') . '.' . pathinfo($fileName, PATHINFO_EXTENSION);
            $uploadPath = $uploadDir . $newFileName;

            // Di chuyển file tới thư mục lưu trữ
            if (move_uploaded_file($fileTmp, $uploadPath)==true) {
                $this->user->updateAvatar($newFileName, $id);
            } else {
                echo "<script>alert('Đã có lỗi xảy ra trong việc tải ảnh lên.');</script>";
                header('Location: views/profile.php');
                
                exit();
            }
        }
        $user = $this->user->updateProfile($email, $name, $phone, $id);
        echo "<script>
         alert('Cập nhật thông tin 1234 thành công !');
            window.location.href = '" . BASE_URL . "views/profile.php';
        </script>";

        // xử lý ảnh đại diện
        // Xử lý upload ảnh đại diện
        

    }
}
