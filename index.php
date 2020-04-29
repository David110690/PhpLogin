<?php
session_start();

require 'database.php';

if (isset($_SESSION['user_id'])){  
    $id = $_SESSION['user_id'];
    $sql = "SELECT id, email, password FROM users WHERE id = '$id' ";
    $result = mysqli_query($conn, $sql); 
    $row_cnt= mysqli_num_rows($result); 
    $row = mysqli_fetch_array($result); 
    $user = null; 

    if ($row_cnt > 0){
        $user = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to your Appt</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php require 'partials/header.php' ?> 
    <?php if (!empty($user)):    ?> 
    <br>Welcome. <?= $user["email"] ?>  
    <br> Tu estas logeado
    <a href="logout.php">Logout</a>
    <?php else: ?>  
    <h1> Please Login or SignUp</h1>
    <a href="login.php">Login</a> /
    <a href="signup.php">Signup</a>
    <?php endif ?>
</body>
</html>