<?php
include('config/setup.php');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Only POST method allowed']);
    exit;
}

$notification_id = isset($_POST['notification_id']) ? (int)$_POST['notification_id'] : 0;
$customer_id = isset($_POST['customer_id']) ? $_POST['customer_id'] : '';

if ($notification_id <= 0 || empty($customer_id)) {
    echo json_encode(['success' => false, 'message' => 'Missing required parameters']);
    exit;
}

try {
    // Mark specific notification as read for this customer
    $sql = "UPDATE comman_notification_messages 
            SET is_read = 1 
            WHERE notification_id = '$notification_id' 
            AND (message_type = 'common' OR (message_type = 'particular' AND customer_id = '$customer_id'))";
    
    $result = mysqli_query($config, $sql);
    
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Notification marked as read']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to mark as read: ' . mysqli_error($config)]);
    }
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
