<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.html');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rezervimi i Makinës</title>
    <link rel="stylesheet" href="rent.css">
    <script>
        function submitForm(event) {
            event.preventDefault();
            const name = document.getElementById("firstName").value;
            const lastname = document.getElementById("lastName").value;
            const phoneNumber = document.getElementById("phoneNumber").value;
            const email = document.getElementById("email").value;
            
            if(name && lastname && phoneNumber && email){
                event.target.submit();
            }else{
                alert("Please fill in all required fields.");
            }
            
           
        }
    </script>
    
</head>
<body>
    <div class="navbar">
        <a href="home.php"><b>Swift Rentals</b></a>
        <a href="home.php">Home</a>
        <a href="main.php" class="current-page">Rentals</a>
        <a href="aboutus.php">About Us</a>
        <a href="contactus.php">Contact Us</a>
        <a href="news.php">News</a>
        <?php
        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
            echo '<a href="Dashboard.php">Admin Dashboard</a>';
        }
        ?>
        <a href="logout.php">Logout</a>
    </div>
    <div class="reservation-container">
        <h2>Reserve your Rental</h2>
        <form class="reservation-form" method="POST" action="reserve.php" onsubmit="submitForm(event)">
            <div class="form-group">
                <label for="firstName">First Name</label>
                <input type="text" id="firstName" name="firstName" placeholder="Your first name..." required>
            </div>
            <div class="form-group">
                <label for="lastName">Last Name</label>
                <input type="text" id="lastName" name="lastName" placeholder="Your last name..." required>
            </div>
            <div class="form-group">
                <label for="phoneNumber">Phone Number</label>
                <input type="tel" id="phoneNumber" name="phoneNumber" placeholder="Your Phone Number..." required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Your email..." required>
            </div>
            <div class="form-group">
                <label for="pickupLocation">Pickup Location</label>
                <select id="pickupLocation" name="pickupLocation" required>
                    <option value="">↓ Choose Location </option>
                    <option value="prishtine-a">Prishtinë A</option>
                    <option value="prishtine-b">Prishtinë B</option>
                    <option value="lipjan">Lipjan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="startDate">Pickup Date</label>
                <input type="date" id="startDate" name="startDate" required>
            </div>
            <div class="form-group">
                <label for="returnDate">Dropoff Date</label>
                <input type="date" id="returnDate" name="returnDate" required>
                <p> * -10% less if your rental is purchased for <b>3</b> or <b>more</b> days. </p>
            </div>
            <button type="submit" class="btn">Reserve</button>
        </form>
    </div>
    <div class="under">
        <h2>Swift Rentals</h2>
        <p>Your go-to rental stop in ALL of Kosovo</p>
        <br>
        <p>Serving you with the best car rentals, reliable customer service, and unbeatable prices.</p>
        <br>
        <p>Contact us:</p>
        <p>Email: support@rentacar02.com</p>
        <p>Phone: +383 38 541 400</p>
        <br>
        <p>Follow us on social media:</p>
        <p>
            <a href="https://www.facebook.com/ubthighereducationinstitution" target="_blank">Facebook</a> | 
            <a href="https://www.instagram.com/ubt_official" target="_blank">Instagram</a> |
            <a href="https://x.com/UBTEducation" target="_blank">Twitter</a>
        </p>
        <br>
        <p>Terms & Conditions | Privacy Policy</p>
        <br>
        <a href="home.php">Home</a>
        <br>
        <a href="aboutus.php">About Us</a>
    </div>
</body>
</html>
