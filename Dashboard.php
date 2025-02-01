<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: login.html');
    exit();
}
if ($_SESSION['user_role'] !== 'admin') {
    die("<h1>Access Denied</h1><p>Only admins are allowed to access this page</p>");
    header('Location: login.html');
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="main.css">
    <style>
    body{
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
        background-color: whitesmoke;
    }
    .navbar{
        display:flex;
        align-items: center;
        justify-content: space-around;
        background-color: black;
        color: white;
        padding: 10px;
    }
    .navbar b{
        color: seagreen;
        font-size: 19px;
        text-decoration: underline overline;
    }
    .navbar a{
        color:white;
        text-decoration: none;
        padding: 5px;
    }
    .navbar p{
        color: red;
    }
    .navbar em{
        color: seagreen;
    }
    .main{
        display: flex;
        flex-wrap: wrap;
        padding: 20px;
        justify-content: center;
    }
    .others{
        display: flex;
        flex-wrap: wrap;
        padding: 20px;
        justify-content: center;
        box-shadow: 1px 1px 1px 1px grey;
        margin: 10px;
    }
    .others p{
        font-size: 18px;
        margin-bottom: 10px;
    }
    .others a{
        text-decoration: none;
        padding: 10px;
        background-color: black;
        color: white;
        border-radius: 5px;
        margin: 10px;
    }


 
</style>
</head>
<body>
    <div class ="navbar">
        <a href="home.php"><b>Swift Rentals</b></a>
        <p>ADMIN DASHBOARD</p>
        <a>Welcome, <em><?php echo $_SESSION['username']; ?></em></a>
    </div>
    <div class="others">
        <p>Assign User Roles - </p>
        <a href="assign.php">Assign Role</a>
    </div>
    <div class="others">
        <p>Feedback from Contact Us - </p>
        <a href="feedback.php">Feedback</a>
    </div>
  

  
    
</body>
</html>