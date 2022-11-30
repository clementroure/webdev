<?php
    if(isset($_COOKIE['id'])) {
        header('Location: app.php');
    }
    else{
        header('Location: register.php');
    }
?>