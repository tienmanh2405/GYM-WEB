<?php


define('BASE_URL', 'http://localhost/GYM-WEB/'); // thay đổi đường dẫn cho phù hợp với máy cá nhân 

class Database
{
    private $servername = "localhost:3306";
    private $username = "root";
    private $password = "";
    private $dbname = "gym";
    public $conn; // Biến kết nối

    public function connect()
    {
        // Tạo kết nối
        $this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);

        // Kiểm tra kết nối
        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        return $this->conn; // Trả về đối tượng kết nối nếu thành công
    }
}

$db = new Database();
$conn = $db->connect();

// if ($conn) {
//     echo "Kết nối thành công!";
// } else {
//     echo "Kết nối thất bại!";
// }
