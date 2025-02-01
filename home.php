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
    <title>HomePage</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <div class="navbar">
        <a href="home.php"><b>Swift Rentals</b></a>
        <a href="home.php" class="current-page">Home</a>
        <a href="main.php">Rentals</a>
        <a href="aboutus.php">About Us</a>
        <a href="contactus.php">Contact Us</a>
        <a href="news.php" >News</a>
        <?php
        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
            echo '<a href="Dashboard.php">Admin Dashboard</a>';
        }
        ?>
        <a href="logout.php">Logout</a>
    </div>

    <div class="hero">
        <p>Your go-to car rental stop in ALL of Kosovo.</p>
        <button><a href="main.php">Check Out Our Fleet</a></button>
    </div>

    <div class="why-choose-us">
        <h3>Why Choose Us?</h3>
        <div class="why-box">
            <div class="feature">
                <h4>Well Maintained Cars</h4>
                <p>Our cars are regularly inspected and serviced.</p>
            </div>
            <div class="feature">
                <h4>Affordable Prices</h4>
                <p>Competitive rates that fit any budget, with no hidden fees.</p>
            </div>
            <div class="feature">
                <h4>Wide Selection</h4>
                <p>Choose from a variety of vehicles.</p>
            </div>
            <div class="feature">
                <h4>24/7 Support</h4>
                <p>Around the clock team available at any time.</p>
            </div>
            <div class="feature">
                <h4>Easy Booking</h4>
                <p>A hassle-free online booking system for your convenience.</p>
            </div>
        </div>
    </div>
    <div class="reviews">
        <h3>What Our Customers Say</h3>
        <div class="review-box">

            <p><strong>John D.</strong>: "Great service and affordable rates. Highly recommend!!" ⭐⭐⭐⭐⭐</p>
            <p><strong>Pero C.</strong>: "Clean cars and very helpful staff. Would definetely rent again!" ⭐⭐⭐⭐</p>
            <p><strong>Ilir K.</strong>: "Quick n' easy process, love the flexibility!" ⭐⭐⭐⭐⭐</p>
            
        </div>
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
