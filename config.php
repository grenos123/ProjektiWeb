<?php
$conn = new mysqli("localhost", "root", "", "crud_db");
if ($conn->connect_error) {
    die("Lidhja dështoi: " . $conn->connect_error);
}
?>