<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
 
        <title>chat DM</title>
        <meta name="description" content="chatbox" />
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/common.css">
        <link rel="stylesheet" href="css/dm.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.js" integrity="sha256-2JRzNxMJiS0aHOJjG+liqsEOuBb6++9cY4dSOyiijX4=" crossorigin="anonymous"></script>
    </head>
    <body>
    <style>
      header {padding-top: 50px;}
      form {padding-top: 13px; padding-left: 6px;}
      a {cursor: pointer;}
    </style>
    <?php
    // connect to postgresql
    $user = "grp47oxh6hjegww"; 
    $password = "99yXmThpFno";
    $host = "esilv.olfsoftware.fr";
    $port = "5432";
    $dbname = "pggrp4";

    $connect = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$password");

    if(!$connect){
	    echo "Unable to connect to the database.";
    } 

    if(!isset($_GET['id'])) // vérifie si id est dans l'url du client est dans l'url
    {
        header('location:menu.php');
    }
    else {
        $user_id = $_GET['id']; 
        if(isset($_GET['convId'])){ // check si conversation id est dans l'url
	        $convId = $_GET['convId'];
        }
        else{
	        header('location:dm_menu.php?id='.$user_id);
        }

    ?>

<!-- NavBar -->
<div class="navigation">
    <div class="logo">
      <a class="no-underline" onclick="var url = window.location.toString(); window.location.href = url.replace(/\/[^\/]*$/, '/app.php');" class="navigation-link">
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
    <a onclick="var url = window.location.toString(); window.location.href = url.replace(/\/[^\/]*$/, '/dm.php?id=144&convId=145');" class="navigation-link">
        <i class="far fa-envelope iconActive"></i>
      </a>
      <a onclick="var url = window.location.toString(); window.location.href = url.replace(/\/[^\/]*$/, '/app.php');" class="navigation-link">
        <i class="far fa-compass icon"></i>
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

        <div id="wrapper" style="margin-top: 100px;">
            <div id="menu">
                <p class="welcome">Heureux de vous revoir, <b><?php echo $user_id; ?></b></p>
                <p><a id="retour_dm_menu" href="app.php">Retour</a></p>
            </div>
 
            <div id="chatbox" style="text-align: start;">
            <?php
            
            // récupération des anciens messages si ils existent dans $result
            
            $query = "SELECT * FROM webdev.messages WHERE convo_id = '".$convId."'";
            //$query = "SELECT * FROM users WHERE email = '".$_POST['email']."' AND password = '$password_md5'";

            $oldMessages = pg_query($connect, $query); 

            //$sender="";
	        while ($row = pg_fetch_row($oldMessages)) {
                $date = $row[5];
                if($row[2] == $user_id){
                    $sender = "Vous";
                }
                else{
                    $query = "SELECT user_0, user_1 FROM webdev.conversations WHERE id = '".$convId."'";
                    $people = pg_query($connect, $query);
                    $people = pg_fetch_row($people);
                    if($people[0] == $user_id){
                        $sender = $people[1];
                    }
                    else{
                        $sender = $people[0];
                    }
                    $query = "SELECT username FROM webdev.users WHERE id = '".$sender."'";
                    $sender = pg_query($connect, $query);
                    $sender = pg_fetch_row($sender);
                    $sender = $sender[0];
                }
		        echo "$date |  $sender :  $row[3]";
		        echo "<br />\n";
            }
            
            ?>
            
            </div>
 
            <form method="post">
                <input name="usermsg" type="text" id="usermsg" />
                <p><input type="submit" value="Envoyer"></p>
            </form>
        </div>
    </body>

    <?php
    }
    // add message to db
    if(isset($_POST['usermsg'])){
        $text = $_POST['usermsg'];
        $text_message = "<div class='msgln'><span class='chat-time'>".date("g:i A")."</span> <b class='user-name'>".'pseudo'."</b> ".stripslashes(htmlspecialchars($text))."<br></div>";
        // connect to postgres
        $user = "grp47oxh6hjegww"; 
        $password = "99yXmThpFno";
        $host = "esilv.olfsoftware.fr";
        $port = "5432";
        $dbname = "pggrp4";
        $connect = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$password");
        if(!$connect){
            echo "Unable to connect to the database.";
        }
        $id = $_GET['id'];
        
        $time = time();
        $date = date("Y-m-d H:i:s", $time);
    

        $query = "INSERT INTO webdev.messages VALUES ('$time', '$convId', '$id', '$text', null, '$date')";
        $newMessages = pg_query($connect, $query);
        if (!$newMessages) {
            echo "Une erreur s'est produite.\n";
            exit;
        }
        else{
            header('location:dm.php?id='.$id.'&convId='.$convId);
        }
    }

    ?>
</html>