<?php
  if(!isset($_COOKIE['id'])) {
    header('Location: register.php');
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
</head>
<body>
<div class="container">
  <h2>App</h2>
  <p>You are connected.</p>
</div>
</body>
</html>