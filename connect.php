<?php
class Database {
    private $conn;

    public function __construct($host, $user, $password, $dbname) {
        $this->conn = new mysqli($host, $user, $password, $dbname);
        if ($this->conn->connect_error) {
            die('Connection failed: ' . $this->conn->connect_error);
        }
    }

    public function prepare($query) {
        return $this->conn->prepare($query);
    }

    public function close() {
        $this->conn->close();
    }
}



class User {


    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function register($username, $email, $password) {
        $stmt = $this->db->prepare("INSERT INTO registrationfinal (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);

        if ($stmt->execute()) {
            
            echo "<script>alert('Registration successful!'); window.location.href='login.html';</script>";


        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new Database('localhost', 'root', '', 'registrationfinal');
    $user = new User($db);
    $user->register($_POST['username'], $_POST['email'], $_POST['password']);
    $db->close();
}
?>
