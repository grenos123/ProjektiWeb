<?php

header("Access-Control-Allow-Origin: *");  
header("Access-Control-Allow-Methods: POST, OPTIONS");  
header("Access-Control-Allow-Headers: Content-Type"); 
header("Content-Type: application/json");

error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data["articleTitle"], $data["description"], $data["authorName"], $data["authorEmail"])) {
        $title = $connection->real_escape_string($data["articleTitle"]);
        $description = $connection->real_escape_string($data["description"]);
        $authorName = $connection->real_escape_string($data["authorName"]);
        $authorEmail = $connection->real_escape_string($data["authorEmail"]);

        $sql = "INSERT INTO articles (article_title, description, author_name, author_email) 
                VALUES ('$title', '$description', '$authorName', '$authorEmail')";

        if ($connection->query($sql) === TRUE) {
            echo json_encode(["message" => "Article added successfully!"]);
        } else {
            echo json_encode(["error" => "Error inserting article: " . $conn->error]);
        }
    } else {
        echo json_encode(["error" => "Invalid input data!"]);
    }
} else {
    echo json_encode(["error" => "Invalid request method! Use POST."]);
}


$connection->close();

?>