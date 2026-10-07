<?php

 $config=mysqli_connect('localhost','mywebsite','Pokkuvandi@123_','pokkuvandi');
 mysqli_set_charset($config, 'utf8mb4');
 // Check connection
 if (mysqli_connect_errno()) {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
 }

error_reporting(0);
ini_set('display_errors', 0);

 
 ?>