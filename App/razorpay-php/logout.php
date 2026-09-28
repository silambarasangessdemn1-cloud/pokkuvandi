<?php include('config/setup.php'); 

include('session.php'); 



?>

 <?php

session_start();

unset($session__custom_id);

unset($session__custom_name);

unset($session__password);

unset($session__phone);

session_unset();

session_destroy();

unset($_COOKIE['$session__custom_id']);

unset($_COOKIE['$session__custom_name']);

unset($_COOKIE['$session__password']);

unset($_COOKIE['member_password']);

 
session_destroy();
// header("location:https://callinfo.in/App/signin.php");
echo '<script> window.location.href = "Directory.php"; </script>';

exit();

    session_start();



 



?>















 

 