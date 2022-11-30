<?php

if(isset($_COOKIE['id'])) {
  header('Location: app.php');
}

$host = "pga.esilv.olfsoftware.fr";
$port = "5432";
$dbname = "pggrp4";
$user = "grp47oxh6hjegww";
$password = "99yXmThpFno"; 
$connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";
$dbconn = pg_connect($connection_string);

if(isset($_POST['name'])&&!empty($_POST['name'])&&isset($_POST['email'])&&!empty($_POST['email'])&&isset($_POST['pwd'])&&!empty($_POST['pwd'])){
    
    $myuuid = guidv4();
    $query = "insert into public.users(id,username,email,password)values('$myuuid','".$_POST['name']."','".$_POST['email']."','".md5($_POST['pwd'])."')"; // encrypted md5 hash password
    $ret = pg_query($dbconn, $query);
    if($ret){
        
        echo "Data saved Successfully";
        $cookie_name = "id";
        $cookie_value = $myuuid;
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day validity
        header('Location: app.php');
    }else{
        
        echo "Soething Went Wrong";
    }
}

// generate random id
function guidv4($data = null) {
  // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
  $data = $data ?? random_bytes(16);
  assert(strlen($data) == 16);

  // Set version to 0100
  $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
  // Set bits 6-7 to 10
  $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

  // Output the 36 character UUID.
  return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Register</title>
  <meta name="keywords" content="PHP,PostgreSQL,Insert,Login">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    a {cursor: pointer;}
    form {margin-bottom: 10px;}
  </style>
</head>
<body>
<div class="container">
  <h2>Register Here </h2>
  <form method="post">
  
    <div class="form-group">
      <label for="name">Username:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" requuired>
    </div>
    
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
    </div>
    
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
    </div>
     
    <input type="submit" name="submit" class="btn btn-primary" value="Register">
  </form>

  <div>
     <a onclick="var url = window.location.toString(); window.location.href = url.replace(/\/[^\/]*$/, '/login.php');">Login</a>
  </div>
</div>
</body>
</html>