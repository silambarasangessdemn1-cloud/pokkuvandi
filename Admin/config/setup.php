<?php
// Prevent fatal mysqli exceptions on failed queries in PHP 8.1+
if (function_exists('mysqli_report')) {
    mysqli_report(MYSQLI_REPORT_OFF);
}

 $config=mysqli_connect('localhost','mywebsite','Pokkuvandi@123_','pokkuvandi');
 mysqli_set_charset($config, 'utf8mb4');
 // Check connection
 if (mysqli_connect_errno()) {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
 } else {
   mysqli_query($config, "SET SESSION sql_mode = ''");

   // Auto-create signup_messages table if not exists
   mysqli_query($config, "CREATE TABLE IF NOT EXISTS `signup_messages` (
     `id` int NOT NULL AUTO_INCREMENT,
     `title` varchar(255) NOT NULL DEFAULT 'Sign Up Message',
     `content` text NOT NULL,
     `status` int NOT NULL DEFAULT '1',
     `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
     PRIMARY KEY (`id`)
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

   // Auto-add driver_contanct column to cms table if not exists
   $chk_col = mysqli_query($config, "SHOW COLUMNS FROM `cms` LIKE 'driver_contanct'");
   if ($chk_col && mysqli_num_rows($chk_col) == 0) {
       mysqli_query($config, "ALTER TABLE `cms` ADD COLUMN `driver_contanct` LONGTEXT NULL");
   }
 }

error_reporting(0);
ini_set('display_errors', 0);

 
 ?>