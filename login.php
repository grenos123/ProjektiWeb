<?php
session_start();

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

    public function login($email, $password) {
        $stmt = $this->db->prepare("SELECT * FROM registrationfinal WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                setcookie("username", $user['username'], time() + (30 * 24 * 60 * 60), "/", "", true, true);
                setcookie("user_role", $user['role'], time() + (30 * 24 * 60 * 60), "/", "", true, true);
                
                
                header('Location: main.php');
                exit();
            } else {
                echo "<script>alert('Invalid email or password'); window.location.href='login.html';</script>";
            }
        } else {
            echo "<script>alert('Invalid email or password'); window.location.href='login.html';</script>";
        }

        $stmt->close();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new Database('localhost', 'root', '', 'registrationfinal');
    $user = new User($db);
    $user->login($_POST['email'], $_POST['password']);
    $db->close();
}
?>
