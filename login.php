<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $conn = new mysqli('localhost', 'root', '', 'registrationfinal');

    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("SELECT * FROM registrationfinal WHERE email = ? AND password = ?");
        $stmt->bind_param("ss", $email, $password);

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<script>alert('Login successful!');</script>";
        } else {
            echo "<script>alert('Invalid email or password.');';</script>";
        }

        $stmt->close();
        $conn->close();
    }
}
?>
