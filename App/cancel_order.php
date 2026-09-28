<?php
include('config/setup.php');

date_default_timezone_set('Asia/Kolkata'); // Set timezone to IST
$cancel_date = date('Y-m-d H:i:s'); // Format: 2025-07-09 14:23:55

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = $_POST['order_id'];
    $reason = mysqli_real_escape_string($config, $_POST['cancel_reason']);

    $update = "UPDATE orders 
               SET status = 'cancelled', 
                   cancel_reason = '$reason', 
                   cancel_date = '$cancel_date' 
               WHERE id = '$order_id'";

    if (mysqli_query($config, $update)) {
        echo "Cancelled";
    } else {
        echo "Error";
    }
}
?>

