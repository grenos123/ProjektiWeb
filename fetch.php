<?php
include 'config.php';
$result = $conn->query("SELECT * FROM veturat");
$veturat = [];
while ($row = $result->fetch_assoc()) {
    $veturat[] = $row;
}
echo json_encode($veturat);
?>
