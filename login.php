<?php
  session_start(); 

  if (isset($_SESSION['user_id'])){  
     header("Location: /php_login ");      
  }

  require 'database.php';

  if (!empty($_POST['email']) && !empty($_POST['password'])){
      $email = $_POST['email'];
      $sql = "SELECT id, email, password FROM users WHERE email = '$email'";
      $result = mysqli_query($conn, $sql);
      $row_cnt= mysqli_num_rows($result);

      if ( $row_cnt > 0){   
        $row = mysqli_fetch_array($result);
        $email = $row["email"]; 
        $password = $row["password"];
        $message = "";
      
        if (password_verify($_POST["password"], $password)){ 
            $_SESSION["user_id"] = $row["id"];
            header("Location: /php_login "); 
        }else {
            $message = "Disculpe sus credenciales son incorrectas";
            }
    }else{
    $message = "No existe el usuario registrado";
    }
  } else{
    $message = "Ingrese algun dato por favor";
  } 
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php require 'partials/header.php' ?>  
    <h1>Login</h1>
    <span> <a href="signup.php">SignUp</a></span>

    <?php if (!empty($message)): ?> 
        <p><?= $message ?></p>    
    <?php endif ?>
    
    <form action="login.php" method="POST">
        <input type="text" name="email" placeholder="Ingrese email">
        <input type="password" name="password" placeholder="Ingrese password">
        <input type="submit" value="Send">
    </form>    
</body>
</html>

