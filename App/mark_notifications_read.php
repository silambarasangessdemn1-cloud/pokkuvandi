<?php
include('config/setup.php');
$customer_id = $_POST['customer_id'];
mysqli_query($config, "
    UPDATE comman_notification_messages
    SET is_read = 1
    WHERE status = 1 AND (message_type='common' OR (message_type='particular' AND customer_id='$customer_id'))
");
?>
