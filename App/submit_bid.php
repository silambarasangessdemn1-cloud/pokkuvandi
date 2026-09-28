<?php
include('config/setup.php');
include('session.php');
session_start();
$driver_id = $prof_id;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = $_POST['order_id'];
    $bid_amount = $_POST['bid_amount'];
    $datetime = $_POST['vehicle_required_datetime'];
    $vehicle_type = $_POST['vehicle_type'];
    
    date_default_timezone_set('Asia/Kolkata');
    $current_time = date("Y-m-d H:i:s"); 
    
    if (!$driver_id || !$order_id || !$bid_amount) {
        echo "Invalid data.";
        exit;
    }

    $order_id = intval($order_id);
    $bid_amount = floatval($bid_amount);

    $sql = "INSERT INTO order_driver_bids  (order_id, driver_id, bid_amount, bid_status,vehicle_type,bid_time) 
            VALUES ('$order_id', '$driver_id', '$bid_amount', 'selected','$vehicle_type','$current_time')";

    if (mysqli_query($config, $sql)) {
        echo "Bid submitted successfully.";
    } else {
        echo "Error: " . mysqli_error($config);
    }
}
?>
