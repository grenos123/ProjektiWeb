<?php

header("Access-Control-Allow-Origin: *");  
header("Access-Control-Allow-Methods: POST, OPTIONS");  
header("Access-Control-Allow-Headers: Content-Type"); 
header("Content-Type: application/json");

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
            die(json_encode(["error" => "Database connection failed: " . $this->conn->connect_error]));
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}

class Article {
    private $conn;
    private $title;
    private $description;
    private $authorName;
    private $authorEmail;

    public function __construct($conn, $title, $description, $authorName, $authorEmail) {
        $this->conn = $conn;
        $this->title = $this->conn->real_escape_string($title);
        $this->description = $this->conn->real_escape_string($description);
        $this->authorName = $this->conn->real_escape_string($authorName);
        $this->authorEmail = $this->conn->real_escape_string($authorEmail);
    }

    public function save() {
        $sql = "INSERT INTO articles (article_title, description, author_name, author_email) 
                VALUES ('$this->title', '$this->description', '$this->authorName', '$this->authorEmail')";

        if ($this->conn->query($sql) === TRUE) {
            return json_encode(["message" => "Article added successfully!"]);
        } else {
            return json_encode(["error" => "Error inserting article: " . $this->conn->error]);
        }
    }
}

$database = new Database();
$conn = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data["articleTitle"], $data["description"], $data["authorName"], $data["authorEmail"])) {
        $article = new Article($conn, $data["articleTitle"], $data["description"], $data["authorName"], $data["authorEmail"]);
        echo $article->save();
    } else {
        echo json_encode(["error" => "Invalid input data!"]);
    }
} else {
    echo json_encode(["error" => "Invalid request method! Use POST."]);
}

$conn->close();

?>
