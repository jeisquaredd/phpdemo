<?php 
    session_start();
    $_SESSION['username'] = '';
    $_SESSION['account_type'] = '';
    $_SESSION['user_id'] =  '';
    $_SESSION['profilepicture'] =  '';
    session_unset();
    header('location:login.php');
