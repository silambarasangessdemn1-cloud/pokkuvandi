<?php
include('../../config/setup.php');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Only POST method allowed']);
    exit;
}

$notification_id = isset($_POST['notification_id']) ? intval($_POST['notification_id']) : 0;
$admin_read = isset($_POST['admin_read']) ? intval($_POST['admin_read']) : 0;

if ($notification_id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid notification ID']);
    exit;
}

try {
    // Update admin_read status
    $notification_id_escaped = mysqli_real_escape_string($config, $notification_id);
    $admin_read_escaped = mysqli_real_escape_string($config, $admin_read);
    
    $sql = "UPDATE comman_notification_messages 
            SET admin_read = '$admin_read_escaped' 
            WHERE notification_id = '$notification_id_escaped'";
    
    $result = mysqli_query($config, $sql);
    
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Admin read status updated successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update admin read status: ' . mysqli_error($config)]);
    }
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>

