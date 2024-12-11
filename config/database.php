<?php
class Database {
    private $servername = "localhost:3306";
    private $username = "root"; 
    private $password = "";
    private $dbname = "gym";
    public $conn; // Biến kết nối

    public function connect() {
        // Tạo kết nối
        $this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);

        // Kiểm tra kết nối
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        return $this->conn; // Trả về đối tượng kết nối
    }
}

?>

