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
    <title>MainPage</title>
    <link rel="stylesheet" href="main.css">

</head>
<body>
    <div class ="navbar">
        <a href="home.php"><b>Swift Rentals</b></a>
        <a href="home.php">Home</a>
        <a href="main.php" class="current-page">Rentals</a>
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
    <div class ="main">
        <div class="car-box">
            <img src="images/Screenshot_1.png">
            <h3>Volkswagen Golf 7</h3>
            <hr>
            <p>Engine: 1.6 TDI BlueMotion</p>
            <p>Transmission: DSG 7-Speed</p>
            <p>Reliable & Fuel-efficeint hatchback - Perfect for city driving and long trips.</p>
            <a href="rent.php"><button class ="purchase-btn">Rent!</button></a>
        </div>
        <div class="car-box">
            <img src="images/Screenshot_2.png">
            <h3>Audi A4</h3>
            <hr>
            <p>Engine: 2.0 TDI Quattro</p>
            <p>Transmission: 6-Speed Manual</p>
            <p>Luxurious sedan offering a perfect blend of sportiness & performance - With just the right price!</p>
            <a href="rent.php"><button class ="purchase-btn">Rent!</button></a>
        </div>
        <div class="car-box">
            <img src="images/Screenshot_3.png">
            <h3>Audi A6</h3>
            <hr>
            <p>Engine: 3.0 TDI</p>
            <p>Transmission: DSG 7-Speed</p>
            <p>Premium sedan with a spacious interior and advanced technology - Elegance & Comfort</p>
            <a href="rent.php"><button class ="purchase-btn">Rent!</button></a>
        </div>
        <div class="car-box">
            <img src="images/Screenshot_4.png">
            <h3>Mercedes-Benz C-Class</h3>
            <hr>
            <p>Engine: 2.2 CDI</p>
            <p>Transmission: 6-Speed Manual</p>
            <p>Classy and compact executive car with a refined driving experience.</p>
            <a href="rent.php"><button class ="purchase-btn">Rent!</button></a>
        </div>
        <div class="car-box">
            <img src="images/Screenshot_5.png">
            <h3>Volkswagen Passat B6</h3>
            <hr>
            <p>Engine: 1.9 TDI</p>
            <p>Transmission: DSG 6-Speed</p>
            <p>Midsized sedan with excellent fuel economy & realiabailty thanks to its legendary - 1.9 TDI engine</p>
            <a href="rent.php"><button class ="purchase-btn">Rent!</button></a>
        </div>
        <div class="car-box">
            <img src="images/Screenshot_6.png">
            <h3>Hyundai Sonata</h3>
            <hr>
            <p>Engine: 1.6</p>
            <p>Transmittion: 5-Speed Manual</p>
            <p>Stylish & Affordable with many advanced safety features - Ideal for commutes or road trips</p>
            <a href="rent.php"><button class ="purchase-btn">Rent!</button></a>
        </div>
        <div class="car-box">
            <img src="images/Screenshot_7.png">
            <h3>Jeep Grand Cherokee</h3>
            <hr>
            <p>Engine: 2.0 Diesel</p>
            <p>Transmittion: 5-Speed Manual</p>
            <p>Perfect balance of luxury, comfort and off-road readiness - Style & capability</p>
            <a href="rent.php"><button class ="purchase-btn">Rent!</button></a>
        </div>
        <div class="car-box">
            <img src="images/Screenshot_8.png">
            <h3>Audi Q3 Facelift</h3>
            <hr>
            <p>Engine: 2.0 TDI Quattro</p>
            <p>Transmittion: 7-Speed DCT S-tronic</p>
            <p>Compact SUV with advanced AWD System with good fuel economy - All-terrain capability</p>
            <a href="rent.php"><button class ="purchase-btn">Rent!</button></a>
        </div>
        <div class="car-box">
            <img src="images/Screenshot_9.png">
            <h3>BMW 320d Facelift</h3>
            <hr>
            <p>Engine: N47 2.0</p>
            <p>Transmittion: 7-Speed Manual</p>
            <p>Refined sporty sedan with cutting-edge features - Dynamic driving with luxury and efficiency. </p>
            <a href="rent.php"><button class ="purchase-btn">Rent!</button></a>
        </div>
        <div class="car-box">
            <img src="images/Screenshot_10.png">
            <h3>Ford Kuga</h3>
            <hr>
            <p>Engine: 2.0 TDI</p>
            <p>Transmittion: 6-Speed Manual</p>
            <p>Combination of practicality and sleek design - Smooth, efficient and comfortable driving. </p>
            <a href="rent.php"><button class ="purchase-btn">Rent!</button></a>
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