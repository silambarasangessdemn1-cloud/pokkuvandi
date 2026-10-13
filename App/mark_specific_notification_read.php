<?php
include('config/setup.php');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Only POST method allowed']);
    exit;
}

$notification_id = isset($_POST['notification_id']) ? (int)$_POST['notification_id'] : 0;
$notification_ids = isset($_POST['notification_ids']) ? $_POST['notification_ids'] : '';
$customer_id = isset($_POST['customer_id']) ? mysqli_real_escape_string($config, $_POST['customer_id']) : '';
$customer_phone = isset($_POST['customer_phone']) ? mysqli_real_escape_string($config, $_POST['customer_phone']) : '';

$idList = array();
if ($notification_id > 0) {
    $idList[] = $notification_id;
}
if (!empty($notification_ids)) {
    if (is_array($notification_ids)) {
        foreach ($notification_ids as $id) {
            if ((int)$id > 0) $idList[] = (int)$id;
        }
    } else {
        $parts = explode(',', $notification_ids);
        foreach ($parts as $p) {
            if ((int)trim($p) > 0) $idList[] = (int)trim($p);
        }
    }
}

if (empty($idList) || empty($customer_id)) {
    echo json_encode(['success' => false, 'message' => 'Missing required parameters']);
    exit;
}

try {
    $idsStr = implode(',', array_unique($idList));
    $phoneCond = !empty($customer_phone) ? "OR customer_phone = '$customer_phone'" : "";

    // Mark specific notification(s) as read for this customer
    $sql = "UPDATE comman_notification_messages 
            SET is_read = 1 
            WHERE notification_id IN ($idsStr) 
            AND (message_type = 'common' OR (message_type = 'particular' AND (customer_id = '$customer_id' $phoneCond)))";
    
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
