<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $conn = new mysqli('localhost', 'root', '', 'registrationfinal');

        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        } else {
           
            $stmt = $conn->prepare("INSERT INTO registrationfinal (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $password); 

            if ($stmt->execute()) {
                echo "<script>alert('Registration successful!');</script>";
            }else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
            $conn->close();
        }
    }
?>
