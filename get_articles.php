<?php

header("Access-Control-Allow-Origin: *");  
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type"); 

error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db.php';

$sql = "SELECT * FROM articles ORDER BY created_at DESC";
$result = $connection->query($sql);

$articles = [];

while ($row = $result->fetch_assoc()) {
    $articles[] = $row;
}

echo json_encode($articles);
?>
