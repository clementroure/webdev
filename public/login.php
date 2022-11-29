<?php
$host = "pga.esilv.olfsoftware.fr";
$port = "5432";
$dbname = "pggrp4";
$user = "grp47oxh6hjegww";
$password = "99yXmThpFno"; 
$connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";
$dbconn = pg_connect($connection_string);

if(isset($_POST['email'])&&!empty($_POST['email'])&&isset($_POST['password'])&&!empty($_POST['password'])){
    
    $password_md5 = md5($_POST['password']);  
    $query = "SELECT * FROM users WHERE email = '".$_POST['email']."' AND password = '$password_md5'"; 
    $result = pg_query($dbconn, $query); 
    $row=pg_fetch_assoc($result);
    
    if(pg_num_rows($result) > 0){
        
      echo "Login Successfully !";
      $cookie_name = "id";
      $cookie_value = $row['id'];
      setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day validity
      header('Location: app.php');
    }else{
        
      echo "Soething Went Wrong";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <meta name="keywords" content="PHP,PostgreSQL,Insert,Login">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/login.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
  <h2>Login Here </h2>
  <form method="post">
  
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
    </div>
    
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
    </div>
     
    <input type="submit" name="submit" class="btn btn-primary" value="Submit">
  </form>

  <div>
    <a onclick="var url = window.location.toString(); window.location.href = url.replace(/\/[^\/]*$/, '/register.php');">Register</a>
  </div>
</div>
</body>
</html>