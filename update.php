<?php
include 'config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $emri = $_POST["name"];
    $marka = $_POST["brand"];
    $cmimi= $_POST["price"];
    $viti= $_POST["year"];
    $sql = "UPDATE veturat SET emri='$emri', marka='$marka' , cmimi='$cmimi' , viti='$viti' WHERE id=$id";
    if ($conn->query($sql)) {
        echo "Success";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
