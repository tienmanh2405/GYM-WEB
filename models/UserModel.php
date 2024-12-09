<?php

class UserModel
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect(); // Kết nối cơ sở dữ liệu

        // Kiểm tra xem kết nối có thành công không
        if (!$this->conn) {
            die("Không thể kết nối tới cơ sở dữ liệu.");
        }
    }

    public function checkEmailExists($email)
    {
        // Kiểm tra kết nối trước khi sử dụng
        if (!$this->conn) {
            die("Không thể kết nối tới cơ sở dữ liệu.");
        }

        $email = mysqli_real_escape_string($this->conn, $email);
        $query = "SELECT * FROM nguoidung WHERE email = '$email'";
        $result = mysqli_query($this->conn, $query);
        return mysqli_num_rows($result) > 0;
    }

    public function register($name, $email, $phone, $dob, $password)
    {
        if (!$this->conn) {
            die("Không thể kết nối tới cơ sở dữ liệu.");
        }

        $name = mysqli_real_escape_string($this->conn, $name);
        $email = mysqli_real_escape_string($this->conn, $email);
        $phone = mysqli_real_escape_string($this->conn, $phone);
        $dob = mysqli_real_escape_string($this->conn, $dob);


        $token = bin2hex(random_bytes(16));

        $query = $this->conn->prepare("INSERT INTO nguoidung (hoTen, sdt, ngaySinh, email, matKhau, token, trangThai, vaiTro) 
        VALUES (?, ?, ?, ?, ?, ?, 0, 'ThanhVien')");
        $query->bind_param('ssssss', $name, $phone, $dob, $email, $password, $token);
        $query->execute();
        
        return [
            'success' => true,
            'token' => $token
        ];
    }



    public function login($email, $password)
    {
        if (!$this->conn) {
            die("Không thể kết nối tới cơ sở dữ liệu.");
        }
    
        // Escape input để tránh SQL Injection
        $email = mysqli_real_escape_string($this->conn, $email);
        $query = "SELECT * FROM nguoidung WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($this->conn, $query);
    
        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            // Kiểm tra mật khẩu
            if (password_verify($password, $user['matKhau'])) {
                // Kiểm tra trạng thái tài khoản
                // if ($user['trangThai'] == 0) {
                //     return [
                //         'success' => false,
                //         'message' => 'Tài khoản chưa được kích hoạt. Vui lòng kiểm tra email của bạn để kích hoạt tài khoản.'
                //     ];
                // }
                return [
                    'success' => true,
                    'message' => 'Đăng nhập thành công.',
                    'user' => [
                        'id' => $user['userID'],
                        'name' => $user['hoTen'],
                        'email' => $user['email'],
                        'phone' => $user['sdt'],
                        'dob' => $user['ngaySinh'],
                    ],
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Thông tin đăng nhập không hợp lệ.'
                ];
            }
        } else {
            return [
                'success' => false,
                'message' => 'Thông tin đăng nhập không hợp lệ.'
            ];
        }
    }    

    // public function login($email, $password)
    // {
    //     if (!$this->conn) {
    //         die("Không thể kết nối tới cơ sở dữ liệu.");
    //     }

    //     // Escape input để tránh SQL Injection
    //     $email = mysqli_real_escape_string($this->conn, $email);

    //     // Truy vấn để tìm người dùng theo email
    //     $query = "SELECT * FROM nguoidung WHERE email = '$email' LIMIT 1";
    //     $result = mysqli_query($this->conn, $query);

    //     if ($result && mysqli_num_rows($result) > 0) {
    //         $user = mysqli_fetch_assoc($result);

    //         // Kiểm tra mật khẩu
    //         if (password_verify($password, $user['matKhau'])) {
    //             // Nếu mật khẩu đúng, kiểm tra trạng thái
    //             if ($user['trangThai'] == 0) {
    //                 return [
    //                     'success' => false,
    //                     'message' => 'Tài khoản chưa được kích hoạt. Vui lòng kiểm tra email của bạn để kích hoạt tài khoản.'
    //                 ];
    //             }
    //             return [
    //                 'success' => true,
    //                 'message' => 'Đăng nhập thành công.',
    //                 'user' => [
    //                     'id' => $user['userID'],
    //                     'name' => $user['hoTen'],
    //                     'email' => $user['email'],
    //                     'phone' => $user['sdt'],
    //                     'dob' => $user['ngaySinh'],
    //                 ],
    //             ];
    //         } else {
    //             return [
    //                 'success' => false,
    //                 'message' => 'Mật khẩu không đúng.'
    //             ];
    //         }
    //     } else {
    //         return [
    //             'success' => false,
    //             'message' => 'Email không tồn tại trong hệ thống.'
    //         ];
    //     }
    // }


    public function verifyEmail($token)
    {

        if (!$this->conn) {
            die("Không thể kết nối tới cơ sở dữ liệu.");
        }
        $stmt = $this->conn->prepare("UPDATE nguoidung SET trangThai = 1 WHERE token = ?");
        if (!$stmt) {
            return [
                'success' => false,
                'error' => "Prepare failed: " . $this->conn->error
            ];
        }
        $stmt->bind_param('s', $token);
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                return [
                    'success' => true,
                    'message' => "Email verified successfully."
                ];
            } else {
                return [
                    'success' => false,
                    'message' => "Token not found or already verified."
                ];
            }
        } else {
            return [
                'success' => false,
                'error' => "Execution failed: " . $stmt->error
            ];
        }
    }


    public function getUser($id)
    {
        $query = "SELECT * FROM nguoidung WHERE userID = $id";
        $result = mysqli_query($this->conn, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        }
        return null;
    }

    public function update($password, $id)
    {
        $stmt = $this->conn->prepare("UPDATE nguoidung SET matKhau = ? WHERE userID = ?");
        if (!$stmt) {
            die("Lỗi chuẩn bị truy vấn: " . $this->conn->error);
        }
        $password = password_hash($password, PASSWORD_DEFAULT);

        $stmt->bind_param("si", $password, $id);
        if ($stmt->execute()) {
            echo "Cập nhật thành công!";
        } else {
            echo "Lỗi cập nhật: " . $stmt->error;
        }
        $stmt->close();
    }
    public function newPass($password, $email)
    {
        $stmt = $this->conn->prepare("UPDATE nguoidung SET matKhau = ? WHERE email = ?");
        if (!$stmt) {
            die("Lỗi chuẩn bị truy vấn: " . $this->conn->error);
        }
        $password = password_hash($password, PASSWORD_DEFAULT);

        $stmt->bind_param("ss", $password, $email);
        if ($stmt->execute()) {
            echo "Cập nhật thành công!";
        } else {
            echo "Lỗi cập nhật: " . $stmt->error;
        }
        $stmt->close();
    }


    public function review($content, $point, $id)
    {
        // Kiểm tra userID có tồn tại không
        $checkUserStmt = $this->conn->prepare("SELECT COUNT(*) FROM nguoidung WHERE userID = ?");
        $checkUserStmt->bind_param("i", $id);
        $checkUserStmt->execute();
        $checkUserStmt->bind_result($userExists);
        $checkUserStmt->fetch();
        $checkUserStmt->close();

        if (!$userExists) {
            throw new Exception("User ID không tồn tại");
        }
        $stmt = $this->conn->prepare("INSERT INTO phieudanhgia (noiDung, diemDanhGia, trangThai, userID) VALUES (?, ?, ?, ?)");
        $trangThai = 0;
        $stmt->bind_param("ssii", $content, $point, $trangThai, $id);

        if ($stmt->execute()) {
            return true;
        } else {
            throw new Exception("Không thể thêm đánh giá: " . $stmt->error);
        }
    }


    public function updateProfile($email, $name, $phone, $id)
    {

        $stmt = $this->conn->prepare("UPDATE nguoidung SET email = ?, hoTen = ?, sdt = ? WHERE userID = ?");
        $stmt->bind_param("sssi", $email, $name, $phone, $id);
        if ($stmt->execute()) {
            return true;
        } else {
            throw new Exception("Lỗi: " . $stmt->error);
        }
    }
    public function updateAvatar($newFileName, $id) {
        // Cập nhật đường dẫn ảnh vào cơ sở dữ liệu

        $sql = "UPDATE nguoidung SET hinhAnh = ? WHERE userID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $newFileName, $id);
        if($stmt->execute()){
            return true;
        }else {
            throw new Exception("Lỗi: " . $stmt->error);
        }
    }
}
