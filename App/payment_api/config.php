 <?php include('../config/setup.php');?>

<?php

 $paygate=mysqli_query($config,"select * from payment_setting where Payment_Option='Payment_Option1' ");
            while($pg=mysqli_fetch_object($paygate))
            {
$keyId = $pg->Payment__id;
$keySecret = $pg->Payment_Key;
			}
$displayCurrency = 'INR';

//These should be commented out in production
// This is for error reporting
// Add it to config.php to report any errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

 