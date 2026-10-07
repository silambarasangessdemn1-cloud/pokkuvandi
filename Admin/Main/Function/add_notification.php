<?php
include('../../config/setup.php');

if(isset($_POST['add_notification'])) {
    $type = mysqli_real_escape_string($config, $_POST['message_type']);
    $message = mysqli_real_escape_string($config, $_POST['message_text']);
    $status = mysqli_real_escape_string($config, $_POST['status']);

    $customer_id = !empty($_POST['customerid']) ? "'" . mysqli_real_escape_string($config, $_POST['customerid']) . "'" : "NULL";
    $customer_name = !empty($_POST['customer_name']) ? "'" . mysqli_real_escape_string($config, $_POST['customer_name']) . "'" : "NULL";
    $customer_phone = !empty($_POST['customer_phone']) ? "'" . mysqli_real_escape_string($config, $_POST['customer_phone']) . "'" : "NULL";

    $query = "INSERT INTO comman_notification_messages (message_type, message_text, customer_id, customer_name, customer_phone, status) 
              VALUES ('$type', '$message', $customer_id, $customer_name, $customer_phone, '$status')";
              
    if(mysqli_query($config, $query)){
        echo "<script>alert('Notification Added Successfully'); window.location='../comman_notification_messages.php';</script>";
    } else {
        echo "<script>alert('Error adding notification'); window.history.back();</script>";
    }
}
?>
