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
    <title>ContactUs</title>
    <link rel="stylesheet" href="contactus.css">

</head>
<body>
    <div class="navbar">
        <a href="home.php"><b>Swift Rentals</b></a>
        <a href="home.php">Home</a>
        <a href="main.php">Rentals</a>
        <a href="aboutus.php">About Us</a>
        <a href="contactus.php" class="current-page">Contact Us</a>
        <a href="news.php">News</a>
        <?php
        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
            echo '<a href="Dashboard.php">Admin Dashboard</a>';
        }
        ?>
        <a href="logout.php">Logout</a>
    </div>
    <style>
        body {
          font-family: Arial, sans-serif;
          margin: 0;
          padding: 0;
          background-color: #f8f9fa;
        }
        .contact-container {
          max-width: 800px;
          margin: 50px auto;
          padding: 20px;
          background-color: #fff;
          border-radius: 10px;
          box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .contact-header {
          text-align: center;
          margin-bottom: 20px;
        }
        .contact-header h1 {
          font-size: 2rem;
          margin: 0;
          color: #333;
        }
        .contact-header p {
          color: #555;
          font-size: 1rem;
        }
        .contact-info {
          display: flex;
          flex-direction: column;
          gap: 15px;
          margin-bottom: 30px;
        }
        .contact-info div {
          display: flex;
          align-items: center;
          gap: 10px;
          font-size: 1rem;
          color: #444;
        }
        .contact-info div i {
          font-size: 1.2rem;
          color: #d8d0ce;
        }
        .contact-form h2 {
          margin-bottom: 15px;
          color: #333;
          font-size: 1.5rem;
        }
        .contact-form form {
          display: flex;
          flex-direction: column;
          gap: 15px;
        }
        .contact-form input, .contact-form textarea, .contact-form button {
          width: 100%;
          padding: 10px;
          font-size: 1rem;
          border: 1px solid #ddd;
          border-radius: 5px;
        }
        .contact-form textarea {
          resize: none;
          height: 100px;
        }
        .contact-form button {
          background-color: #b3a3a1;
          color: #fff;
          border: none;
          cursor: pointer;
          font-size: 1rem;
          transition: background-color 0.3s;
        }
        .contact-form button:hover {
          background-color: #b7aeac;
        }
      </style>
    </head>
    <body>
      <div class="contact-container">
        <div class="contact-header">
          <h1>Contact Us</h1>
          <p>Get in touch with us for any inquiries or assistance.</p>
        </div>
    
      
        <div class="contact-info">
          <div>
            <i class="fas fa-map-marker-alt"></i>
            <span>Rruga Kryesore, Nr. 123, Mitrovica, Kosovë</span>
          </div>
          <div>
            <i class="fas fa-phone"></i>
            <span>+383 45 123 456</span>
          </div>
          <div>
            <i class="fas fa-envelope"></i>
            <span>info@rentacar02.com</span>
          </div>
          <div>
            <i class="fas fa-clock"></i>
            <span>Monday - Saturday: 09:00 - 20:00</span>
          </div>
        </div>
    
        <div class="contact-form">
          <h2>Send Us a Message</h2>
          <form action="contact.php" method="POST">
            <input type="text" name="name" placeholder="Your Full Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <input type="text" name="phone" placeholder="Your Phone Number (Optional)">
            <textarea name="message" placeholder="Your Message" required></textarea>
            <button type="submit">Submit</button>
          </form>
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
</body>
</html>