<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE");
header("Content-Type: application/json");

$conn = new mysqli("localhost", "root", "", "article_db");

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Database connection failed"]));
}

$id = $_GET["id"] ?? null;

if ($id) {
    $stmt = $conn->prepare("DELETE FROM articles WHERE id=?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Article deleted successfully"]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to delete article"]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid article ID"]);
}

$conn->close();
?>
