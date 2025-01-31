<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT");
header("Content-Type: application/json");

$conn = new mysqli("localhost", "root", "", "article_db");

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Database connection failed"]));
}

$data = json_decode(file_get_contents("php://input"), true);

if (!empty($data["id"]) && !empty($data["articleTitle"]) && !empty($data["description"])) {
    $stmt = $conn->prepare("UPDATE articles SET article_title=?, description=? WHERE id=?");
    $stmt->bind_param("ssi", $data["articleTitle"], $data["description"], $data["id"]);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Article updated successfully"]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to update article"]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "All fields are required"]);
}

$connection->close();
?>
