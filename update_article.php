<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT");
header("Content-Type: application/json");

class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "article_db";
    private $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die(json_encode(["success" => false, "message" => "Database connection failed"]));
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function close() {
        $this->conn->close();
    }
}

class Article {
    private $conn;
    private $table_name = "articles";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function update($id, $title, $description) {
        if (!empty($id) && !empty($title) && !empty($description)) {
            $stmt = $this->conn->prepare("UPDATE " . $this->table_name . " SET article_title=?, description=? WHERE id=?");
            $stmt->bind_param("ssi", $title, $description, $id);

            if ($stmt->execute()) {
                return json_encode(["success" => true, "message" => "Article updated successfully"]);
            } else {
                return json_encode(["success" => false, "message" => "Failed to update article"]);
            }

            $stmt->close();
        } else {
            return json_encode(["success" => false, "message" => "All fields are required"]);
        }
    }
}

$database = new Database();
$db = $database->getConnection();
$article = new Article($db);

$data = json_decode(file_get_contents("php://input"), true);

echo $article->update($data["id"], $data["articleTitle"], $data["description"]);

$database->close();
?>
