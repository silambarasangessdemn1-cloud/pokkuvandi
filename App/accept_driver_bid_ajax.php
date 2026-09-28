<?php
include('config/setup.php');

$order_id = $_POST['order_id'];
$driver_id = $_POST['driver_id'];
$bid_amount = $_POST['bid_amount'];

// 1. Set driver in orders table
mysqli_query($config, "UPDATE orders SET driver_id = '$driver_id', status = 'accepted' WHERE id = '$order_id'");


// 2. Set accepted bid
mysqli_query($config, "UPDATE order_driver_bids SET customer_status = 'accepted' WHERE order_id = '$order_id' AND driver_id = '$driver_id'");

// 3. Cancel other bids
mysqli_query($config, "UPDATE order_driver_bids SET customer_status = 'cancelled' WHERE order_id = '$order_id' AND driver_id != '$driver_id'");

echo 'success';
?>
