<?php
include('config/setup.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo '0';
    exit;
}

$customer_id = isset($_POST['customer_id']) ? $_POST['customer_id'] : '';

if (empty($customer_id)) {
    echo '0';
    exit;
}

try {
    // Count unread notifications for the customer
    $sql = "
        SELECT COUNT(*) as count 
        FROM comman_notification_messages
        WHERE status = 1
          AND (
            (message_type = 'common' AND (is_read IS NULL OR is_read = 0))
            OR (message_type = 'particular' AND customer_id = '$customer_id' AND (is_read IS NULL OR is_read = 0))
          )
    ";
    
    $result = mysqli_query($config, $sql);
    $row = mysqli_fetch_assoc($result);
    
    echo $row['count'];
    
} catch (Exception $e) {
    echo '0';
}
?>