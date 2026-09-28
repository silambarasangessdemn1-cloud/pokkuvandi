<?php


include('config/setup.php');
include('session.php');

session_start();
   $_SESSION["$session_id"] = "";
    header('location:index.php?successfully Logout');
      session_destroy();
     session_unset();
 
	
	 
 

?>
