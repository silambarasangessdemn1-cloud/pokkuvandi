<?php
include('config/setup.php');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Only POST method allowed']);
    exit;
}

$notification_id = isset($_POST['notification_id']) ? (int)$_POST['notification_id'] : 0;
$reply_message = isset($_POST['reply_message']) ? trim($_POST['reply_message']) : '';
$customer_id = isset($_POST['customer_id']) ? $_POST['customer_id'] : '';

if ($notification_id <= 0 || empty($reply_message) || empty($customer_id)) {
    echo json_encode(['success' => false, 'message' => 'Missing required parameters']);
    exit;
}

try {
    // Set timezone to Indian Standard Time (IST)
    date_default_timezone_set('Asia/Kolkata');
    
    // Get current Indian time
    $indian_current_time = date('Y-m-d H:i:s');
    
    // Escape the reply message to prevent SQL injection
    $reply_message_escaped = mysqli_real_escape_string($config, $reply_message);
    $customer_id_escaped = mysqli_real_escape_string($config, $customer_id);
    
    // Insert reply into database with Indian current time
    $sql = "INSERT INTO notification_replies (notification_id, customer_id, reply_message, created_at) 
            VALUES ('$notification_id', '$customer_id_escaped', '$reply_message_escaped', '$indian_current_time')";
    
    $result = mysqli_query($config, $sql);
    
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Reply sent successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to send reply: ' . mysqli_error($config)]);
    }
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
