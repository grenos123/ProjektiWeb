<?php
include 'config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emri = $_POST["name"];
    $marka = $_POST["brand"];
    $sql = "INSERT INTO veturat (emri, cmimi ,viti) VALUES ('$emri', '$marka')";
    if ($conn->query($sql)) {
        echo "Sukses";
    } else {
        echo "Gabim: " . $conn->error;
    }
}
?>
