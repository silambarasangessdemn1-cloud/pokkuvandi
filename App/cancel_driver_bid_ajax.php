<?php
include('config/setup.php');

$order_id = $_POST['order_id'];
$driver_id = $_POST['driver_id'];

// Cancel only this bid
mysqli_query($config, "UPDATE order_driver_bids SET customer_status = 'cancelled' WHERE order_id = '$order_id' AND driver_id = '$driver_id'");

echo 'success';
?>
