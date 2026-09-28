<?php
include('../../config/setup.php');

if(isset($_POST['update_notification'])) {
    $id = $_POST['notification_id'];
    $type = $_POST['message_type'];
    $msg = mysqli_real_escape_string($config, $_POST['message_text']);
    $status = $_POST['status'];
    $cname = $_POST['customer_name'] ?? NULL;
    $cphone = $_POST['customer_phone'] ?? NULL;

    $sql = "UPDATE comman_notification_messages 
            SET message_type='$type', message_text='$msg', customer_name='$cname', customer_phone='$cphone', status='$status' 
            WHERE notification_id='$id'";

    if(mysqli_query($config, $sql)){
        echo "<script>alert('Notification Updated Successfully');window.location='../comman_notification_messages.php';</script>";
    } else {
        echo "<script>alert('Error updating notification');window.history.back();</script>";
    }
}
?>
