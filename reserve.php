<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.html');
    exit();
}

$host = "localhost";
$username = "root";
$password = "";
$dbname = "rentalreserve";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$phoneNumber = $_POST['phoneNumber'];
$email = $_POST['email'];
$pickupLocation = $_POST['pickupLocation'];
$pickupDate = $_POST['startDate'];
$dropoffDate = $_POST['returnDate'];

$sqlCheck = "SELECT COUNT(*) as count FROM rentalreserve 
             WHERE pickupLocation = ? 
             AND NOT (dropoffDate < ? OR pickupDate > ?)";

$stmtCheck = $conn->prepare($sqlCheck);
$stmtCheck->bind_param("sss", $pickupLocation, $pickupDate, $dropoffDate);
$stmtCheck->execute();
$result = $stmtCheck->get_result();
$row = $result->fetch_assoc();

if ($row['count'] > 0) {
    echo "<script>alert('The selected location/car is not available for your chosen dates. Please pick different dates or location!'); window.location.href = 'rent.php';</script>";
    exit();
}

$stmtCheck->close();
$stmt = $conn->prepare("INSERT INTO rentalreserve (firstName, lastName, phonenumber, email, pickupLocation, pickupDate, dropoffDate) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssissss", $firstName, $lastName, $phoneNumber, $email, $pickupLocation, $pickupDate, $dropoffDate);

if ($stmt->execute()) {
    echo "<script>alert('Reservation successful!'); window.location.href = 'home.php';</script>";
} else {
    echo "<script>alert('Error: " . $stmt->error . "'); window.location.href = 'rent.php';</script>";
}

$stmt->close();
$conn->close();
?>
