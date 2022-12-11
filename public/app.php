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

    $query = "SELECT * FROM webdev.users WHERE id = '".$_COOKIE['id']."'"; 
    $result = pg_query($dbconn, $query); 
    $row=pg_fetch_assoc($result);

    if(pg_num_rows($result) > 0){
        
		
      $username = $row['username'];
      // $bio = $row['bio'];
      $profil_picture = $row['profil_picture'];
    }else{
        
      // echo "Something Went Wrong";
    }

    $query2 = "SELECT * FROM webdev.cards"; 
    $result2 = pg_query($dbconn, $query); 
   
    
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

  if(isset($_POST['text'])&&!empty($_POST['text'])){
    
    $myuuid = guidv4();
    $date = date('d-m-y h:i:s');

    $query2 = "INSERT into webdev.cards (text, user_id, username, id, date, likes, image) VALUES ('".$_POST['text']."', '".$_COOKIE['id']."', '$username', '$myuuid', '$date', '0' , '')  "; 
    pg_query($dbconn, $query2); 
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

  <!-- NavBar -->
  <div class="navigation">
    <div class="logo">
      <a class="no-underline" onclick="var url = window.location.toString(); window.location.href = url.replace(/\/[^\/]*$/, '/app.php');">
        Leo Crush
      </a>
    </div>
    <div class="navigation-search-container" style="margin-left: 70px;">
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
      <a onclick="var url = window.location.toString(); window.location.href = url.replace(/\/[^\/]*$/, '/dm.php?id=144&convId=145&fbclid=IwAR2r5gtlCDY-EEcazyf843qMalXi5w5UK0QGEk0Vc6c32vf0_6H610FLgkY');" class="navigation-link">
        <i class="far fa-envelope icon"></i>
      </a>
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

  <!-- <fa-icon class="fas fa-plus floatingBtn" style="fill: #2980B9;height: 2em;width: 2em; position:"></fa-icon> -->

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

  <form method="post" >
      <div style="text-align: center; display: block;  margin-left: auto; margin-right: auto;">
        <input style="text-align: center; display: block;  margin-left: auto; margin-right: auto; margin-bottom:5px;" id="file-input" type="file"  accept="image/*" onchange=""/>

        <textarea name="text" id="text" maxlength="50" style="width: 250px; border: 0.1; border-radius: 5px; background-color: #fafafa;" placeholder="Add a text.."></textarea>
        <input style="margin-bottom: 40px; height: 20px;" type="submit" name="submit" class="btn btn-primary" value="Add">
      </div>
    </form>

</div>
</body>
</html>