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
    <title>Aboutus</title>
    <link rel="stylesheet" href="aboutus.css">
    <script>
        function showMap(location) {
            const maps = document.querySelectorAll('iframe');
            maps.forEach(map => {
                map.style.display = 'none';
            });

            const mapsh = document.getElementById(location);
            if (mapsh) {
                mapsh.style.display = 'block';
            }
        }
        function validateContactForm(event) {
        event.preventDefault(); 
        
        const name = document.getElementById("name").value.trim();
        const email = document.getElementById("email").value.trim();
        const message = document.getElementById("message").value.trim();
        
        if (name === "") {
            alert("Please enter your name");
            return;
    }
    if (email === "" || !validateEmail(email)) {
        alert("Please enter a valid email address");
        return;
    }
    
    if (message === "") {
        alert("Please enter your message");
        return;
    }
    
    alert("Form submitted successfully");
    document.getElementById("contactForm").reset(); 
}

function validateEmail(email) {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailPattern.test(email);
}

    </script>
</head>
<body>
    <div class="navbar">
        <a href="home.php"><b>Swift Rentals</b></a>
        <a href="home.php">Home</a>
        <a href="main.php">Rentals</a>
        <a href="aboutus.php" class="current-page">About Us</a>
        <a href="contactus.php">Contact Us</a>
        <a href="news.php">News</a>
        <?php
        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
            echo '<a href="Dashboard.php">Admin Dashboard</a>';
        }
        ?>
        <a href="logout.php">Logout</a>
    </div>
    <div class="about">
        <h2>Welcome to SwiftRentals2</h2>
        <p>We specialize in offering a diverse <a href="main.php">fleet</a> of vehicles, suiting any occasion, from your compact hatchbacks for daily commutes to luxurious sedans to meet your needs.</p>
        <p>Whether you're traveling for business or simply just wanting a temporary ride, we are here to ensure that your journey is smooth, all with affordable pricings!</p>
        <b>You can find us in the following locations: </b>
        <div class="map-container">
            <div class="location-select">
                <label><input type="radio" name="location" value="prishtina-d" onclick="showMap('prishtina-d')"> Prishtina (D)</label> <p></p>
                <label><input type="radio" name="location" value="prishtina-a" onclick="showMap('prishtina-a')"> Prishtina (A)</label> <p></p>
                <label><input type="radio" name="location" value="lipjan" onclick="showMap('lipjan')"> Lipjan (Campus)</label> <p></p>
            </div>
            <div id="map">
                <iframe id="prishtina-d" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1874.718654111617!2d21.144992665998267!3d42.65254126114078!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x13549f3f9c98dcad%3A0x34f016cddf4a9928!2sDukagjini%20Center!5e0!3m2!1sen!2s!4v1733335032915!5m2!1sen!2s" loading="lazy"></iframe>
                <iframe id="prishtina-a" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4851.914294780618!2d21.147371088330967!3d42.64625804121849!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x13549e8d5d607f25%3A0xa31dd05b21bd09de!2sUBT%20College!5e0!3m2!1sen!2s!4v1733335172006!5m2!1sen!2s" loading="lazy"></iframe>
                <iframe id="lipjan" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8049.005006711277!2d21.131362003245332!3d42.556935558751114!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x13549d2cc6e13dd5%3A0xf9155209d4ad0657!2sInnovation%20Campus%20-%20UBT!5e0!3m2!1sen!2s!4v1733335400246!5m2!1sen!2s" loading="lazy"></iframe>
            </div>
    </div>
    <p></p>
    <div class="faq">
        <p>Frequently Asked Questions(<b>FAQ</b>):</p>
        <hr class="faq-line">
        <b>Q: </b><em>What documents do i need to rent a car?</em>
        <p><b>A: </b>A credit card for the security deposit, a <b>valid drivers license </b>(foregin licenses are also permitted)</p>
        <b>Q: </b><em>Can i modify or cancel my reservation?</em>
        <p></p><b>A: </b>Yes, <b>24 hours prior </b>to the purchase, a client can modify/cancel his reservation</p>
        <b>Q: </b><em>Are there any age restrictions when renting?</em>
        <p></p><b>A: </b>If a client is below the age of 18, the use of our rentals is not permitted, client must also have a license of 
        <b>MINIMUM</b> of 7 months.</p>
        <b>Q: </b><em>Are there any hidden fees?</em>
        <p><b>A: </b>All fees are displayed upfront, with the exception of <b>damage occured</b> during the rental period.</p>
            


    </div>
    <div class ="blog">
        <h4>Top Places to visit in Kosovo</h4>
        <p>Explore the hidden gems of Kosovo with our cars. Discover why it's the best way to get around M.....</p> 
        <a href="https://funkytours.com/must-visit-while-in-kosovo/">Read More</a>
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