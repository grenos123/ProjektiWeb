<?php

header("Access-Control-Allow-Origin: *");  
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type"); 

error_reporting(E_ALL);
ini_set('display_errors', 1);

class Database {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $dbname = "article_db";
    private $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die(json_encode([]));
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}

class Article {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAll() {
        $sql = "SELECT * FROM articles ORDER BY created_at DESC";
        $result = $this->conn->query($sql);
        $articles = [];

        while ($row = $result->fetch_assoc()) {
            $articles[] = $row;
        }

        return json_encode($articles);
    }
}

$database = new Database();
$conn = $database->getConnection();
$article = new Article($conn);
echo $article->getAll();

$conn->close();
?>
