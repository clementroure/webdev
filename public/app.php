<?php
  if(!isset($_COOKIE['id'])) {
    header('Location: register.php');
  }
  else{

    $host = "pga.esilv.olfsoftware.fr";
    $port = "5432";
    $dbname = "pggrp4";
    $user = "grp47oxh6hjegww";
    $password = "99yXmThpFno"; 
    $connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";
    $dbconn = pg_connect($connection_string);  

    $query = "SELECT * FROM users WHERE id = '".$_COOKIE['id']."'"; 
    $result = pg_query($dbconn, $query); 
    $row=pg_fetch_assoc($result);

    if(pg_num_rows($result) > 0){
        
		
      $username = $row['username'];
      // $bio = $row['bio'];
      $profil_picture = $row['profil_picture'];
    }else{
        
      // echo "Something Went Wrong";
    }
  }

  if(array_key_exists('logout', $_POST)) {

    if($_SERVER['SERVER_NAME'] == "localhost"){
      
      setcookie('id',"",0,"/",$_SERVER['SERVER_NAME']);
      header('Location: login.php');
    }
    else{
      unset($_COOKIE['id']); 
      setcookie('id', null, -1, '/'); 
      
      header('Location: login.php');
    }
  }

  $host = "pga.esilv.olfsoftware.fr";
  $port = "5432";
  $dbname = "pggrp4";
  $user = "grp47oxh6hjegww";
  $password = "99yXmThpFno"; 
  $connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";
  $dbconn = pg_connect($connection_string);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>App</title>
  <meta name="keywords" content="PHP,PostgreSQL,Insert,Login">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.js" integrity="sha256-2JRzNxMJiS0aHOJjG+liqsEOuBb6++9cY4dSOyiijX4=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/app.css">
  <link rel="stylesheet" href="css/navbar.css">
  <link rel="stylesheet" href="css/common.css">
  <style>
    form {padding-top: 13px; padding-left: 6px;}
    a {cursor: pointer;}
  </style>
</head>
<body>
<div class="container">

  <!-- NavBar -->
  <div class="navigation">
    <div class="logo">
      <a class="no-underline" href="#">
        Leo Crush
      </a>
    </div>
    <div class="navigation-search-container">
      <i class="fa fa-search"></i>
      <input class="search-field" type="text" placeholder="Search">
      <div class="search-container">
        <div class="search-container-box">
          <div class="search-results">

          </div>
        </div>
      </div>
    </div>
    <div class="navigation-icons">
      <a onclick="var url = window.location.toString(); window.location.href = url.replace(/\/[^\/]*$/, '/app.php');" class="navigation-link">
        <i class="far fa-compass iconActive"></i>
      </a>
      <a onclick="var url = window.location.toString(); window.location.href = url.replace(/\/[^\/]*$/, '/profile.php');" class="navigation-link">
        <i class="far fa-user-circle icon"></i>
      </a>
      <!-- <a href="https://instagram.com/mimoudix" id="signout" class="navigation-link">
        <i class="fas fa-sign-out-alt icon"></i>
      </a> -->
      <form method="post">
        <input type="submit" name="logout"
          class="button" value="Logout" 
        />
      </form>
    </div>
  </div>

  <!-- Card -->
  <div class="instagram-card">
    <div class="instagram-card-header">
      <img src="https://images.unsplash.com/photo-1513721032312-6a18a42c8763?w=152&h=152&fit=crop&crop=face" class="instagram-card-user-image"/>
      <a class="instagram-card-user-name" onclick="var url = window.location.toString(); window.location.href = url.replace(/\/[^\/]*$/, '/profile.php');" class="navigation-link"><?php echo $username;?></a>
      <div class="instagram-card-time">58 min</div>
    </div>
  
    <div class="intagram-card-image">
      <img src="https://images.unsplash.com/photo-1502630859934-b3b41d18206c?w=500&h=500&fit=crop" width="99.98%"/>
    </div>
  
    <div class="instagram-card-content">
      <p class="likes">666 Likes</p>
      <p><a class="instagram-card-content-user" onclick="var url = window.location.toString(); window.location.href = url.replace(/\/[^\/]*$/, '/profile.php');" class="navigation-link"><?php echo $username;?></a>Very cool place 😜❄️ <a class="hashtag">#webdev</a></p>
    <hr>
    </div>
  </div>
   <!-- Card -->
   <div class="instagram-card">
    <div class="instagram-card-header">
      <img src="https://images.unsplash.com/photo-1513721032312-6a18a42c8763?w=152&h=152&fit=crop&crop=face" class="instagram-card-user-image"/>
      <a class="instagram-card-user-name" onclick="var url = window.location.toString(); window.location.href = url.replace(/\/[^\/]*$/, '/profile.php');" class="navigation-link"><?php echo $username;?></a>
      <div class="instagram-card-time">58 min</div>
    </div>
  
    <div class="intagram-card-image">
      <img src="https://images.unsplash.com/photo-1497445462247-4330a224fdb1?w=500&h=500&fit=crop" width="99.98%"/>
    </div>
  
    <div class="instagram-card-content">
      <p class="likes">666 Likes</p>
      <p><a class="instagram-card-content-user" onclick="var url = window.location.toString(); window.location.href = url.replace(/\/[^\/]*$/, '/profile.php');" class="navigation-link"><?php echo $username;?></a> Very cool place 😜❄️ <a class="hashtag">#webdev</a></p>
    <hr>
    </div>
  </div>
   <!-- Card -->
   <div class="instagram-card">
    <div class="instagram-card-header">
      <img src="https://images.unsplash.com/photo-1513721032312-6a18a42c8763?w=152&h=152&fit=crop&crop=face" class="instagram-card-user-image"/>
      <a class="instagram-card-user-name" onclick="var url = window.location.toString(); window.location.href = url.replace(/\/[^\/]*$/, '/profile.php');" class="navigation-link"><?php echo $username;?></a>
      <div class="instagram-card-time">58 min</div>
    </div>
  
    <div class="intagram-card-image">
      <img src="https://images.unsplash.com/photo-1426604966848-d7adac402bff?w=500&h=500&fit=crop" width="99.98%"/>
    </div>
  
    <div class="instagram-card-content">
      <p class="likes">666 Likes</p>
      <p><a class="instagram-card-content-user" onclick="var url = window.location.toString(); window.location.href = url.replace(/\/[^\/]*$/, '/profile.php');" class="navigation-link"><?php echo $username;?></a> Very cool place 😜❄️ <a class="hashtag">#webdev</a></p>
    <hr>
    </div>
  </div>

</div>
</body>
</html>