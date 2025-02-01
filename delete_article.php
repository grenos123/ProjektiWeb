<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE");
header("Content-Type: application/json");

class Database {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $dbname = "article_db";
    private $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die(json_encode(["success" => false, "message" => "Database connection failed: " . $this->conn->connect_error]));
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}

class Article {
    private $conn;
    private $id;

    public function __construct($conn, $id) {
        $this->conn = $conn;
        $this->id = $id;
    }

    public function delete() {
        if (empty($this->id)) {
            return json_encode(["success" => false, "message" => "Invalid article ID"]);
        }

        $stmt = $this->conn->prepare("DELETE FROM articles WHERE id=?");
        $stmt->bind_param("i", $this->id);

        if ($stmt->execute()) {
            return json_encode(["success" => true, "message" => "Article deleted successfully"]);
        } else {
            return json_encode(["success" => false, "message" => "Failed to delete article"]);
        }

        $stmt->close();
    }
}

$database = new Database();
$conn = $database->getConnection();

$id = $_GET["id"] ?? null;

$article = new Article($conn, $id);
echo $article->delete();

$conn->close();
?>
