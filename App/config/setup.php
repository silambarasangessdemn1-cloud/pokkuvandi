<?php

$config=mysqli_connect('localhost','mywebsite','Pokkuvandi@123_','pokkuvandi');
 // Check connection
 if (mysqli_connect_errno()) {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
 } else {
   mysqli_query($config, "SET SESSION sql_mode = ''");
 }

error_reporting(E_ALL);
ini_set('display_errors', 1);

 
 ?>