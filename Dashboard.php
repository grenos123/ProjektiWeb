<?php
session_start();
if ($_SESSION['user_role'] !== 'admin') {
    header('Location: login.html');
    exit();
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

 
</style>
</head>
<body>
    <div class ="navbar">
        <a href="home.php"><b>Swift Rentals</b></a>
        <p>ADMIN DASHBOARD</p>
        <a>Welcome, <em><?php echo $_SESSION['username']; ?></em></a>
    </div>

  
    
</body>
</html>