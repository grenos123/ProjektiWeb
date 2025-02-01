<?php
session_start();

class Database {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $dbname = "article_db";
    private $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die(json_encode(["success" => false, "message" => "Database connection failed"]));
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        $this->conn->close();
    }
}

class Article {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllArticles() {
        $sql = "SELECT * FROM articles ORDER BY created_at DESC";
        $result = $this->conn->query($sql);
        $articles = [];
        while ($row = $result->fetch_assoc()) {
            $articles[] = $row;
        }
        return json_encode($articles);
    }

    public function addArticle($title, $description, $authorName, $authorEmail) {
        $stmt = $this->conn->prepare("INSERT INTO articles (article_title, description, author_name, author_email) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $title, $description, $authorName, $authorEmail);
        if ($stmt->execute()) {
            return json_encode(["success" => true, "message" => "Article added successfully"]);
        }
        return json_encode(["success" => false, "message" => "Error inserting article"]);
    }

    public function updateArticle($id, $title, $description) {
        $stmt = $this->conn->prepare("UPDATE articles SET article_title=?, description=? WHERE id=?");
        $stmt->bind_param("ssi", $title, $description, $id);
        if ($stmt->execute()) {
            return json_encode(["success" => true, "message" => "Article updated successfully"]);
        }
        return json_encode(["success" => false, "message" => "Failed to update article"]);
    }

    public function deleteArticle($id) {
        $stmt = $this->conn->prepare("DELETE FROM articles WHERE id=?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            return json_encode(["success" => true, "message" => "Article deleted successfully"]);
        }
        return json_encode(["success" => false, "message" => "Failed to delete article"]);
    }
}

$db = new Database();
$article = new Article($db->getConnection());

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo $article->getAllArticles();
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    echo $article->addArticle($data['articleTitle'], $data['description'], $data['authorName'], $data['authorEmail']);
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents("php://input"), true);
    echo $article->updateArticle($data['id'], $data['articleTitle'], $data['description']);
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = $_GET['id'] ?? null;
    if ($id) {
        echo $article->deleteArticle($id);
    } else {
        echo json_encode(["success" => false, "message" => "Invalid article ID"]);
    }
}

$db->closeConnection();
?>
