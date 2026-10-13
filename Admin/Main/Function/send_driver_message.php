<?php
include('../../config/setup.php');

header('Content-Type: application/json; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Only POST method is allowed']);
    exit;
}

$message = isset($_POST['message']) ? trim($_POST['message']) : '';
$driversRaw = isset($_POST['drivers']) ? $_POST['drivers'] : '';

if (empty($message)) {
    echo json_encode(['success' => false, 'message' => 'Message text cannot be empty']);
    exit;
}

$drivers = json_decode($driversRaw, true);
if (!is_array($drivers) || count($drivers) === 0) {
    echo json_encode(['success' => false, 'message' => 'Please select at least one driver']);
    exit;
}

// Auto-create comman_notification_messages table if not exists
$check_table = mysqli_query($config, "SHOW TABLES LIKE 'comman_notification_messages'");
if (mysqli_num_rows($check_table) == 0) {
    $create_sql = "CREATE TABLE `comman_notification_messages` (
      `notification_id` int NOT NULL AUTO_INCREMENT,
      `message_type` enum('common','particular') COLLATE utf8mb4_unicode_ci NOT NULL,
      `message_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
      `customer_id` int DEFAULT NULL,
      `customer_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
      `customer_phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
      `status` tinyint(1) DEFAULT '1' COMMENT '1=Active, 0=Inactive',
      `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
      `is_read` tinyint(1) DEFAULT '0',
      `admin_read` tinyint(1) DEFAULT '0',
      PRIMARY KEY (`notification_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
    mysqli_query($config, $create_sql);
}

$message_escaped = mysqli_real_escape_string($config, $message);
$sent_count = 0;
$processed_customers = array();

foreach ($drivers as $drv) {
    $customer_id = isset($drv['customer_id']) ? (int)$drv['customer_id'] : 0;
    $driver_name = isset($drv['driver_name']) ? mysqli_real_escape_string($config, trim($drv['driver_name'])) : '';
    $phone = isset($drv['phone_no']) ? mysqli_real_escape_string($config, trim($drv['phone_no'])) : '';

    // If customer_id is 0 or missing, try to lookup in customer_master by phone number
    if ($customer_id <= 0 && !empty($phone)) {
        $lookup_q = mysqli_query($config, "SELECT Customer_Id FROM customer_master WHERE Customer_Phone_No = '$phone' LIMIT 1");
        if ($lookup_q && mysqli_num_rows($lookup_q) > 0) {
            $lookup_row = mysqli_fetch_assoc($lookup_q);
            $customer_id = (int)$lookup_row['Customer_Id'];
        }
    }

    // Deduplicate by customer_id if valid, or by phone
    $unique_key = ($customer_id > 0) ? "id_" . $customer_id : "phone_" . $phone;
    if (isset($processed_customers[$unique_key])) {
        continue;
    }
    $processed_customers[$unique_key] = true;

    $cust_id_sql = ($customer_id > 0) ? "'$customer_id'" : "NULL";

    $sql = "INSERT INTO comman_notification_messages 
            (message_type, message_text, customer_id, customer_name, customer_phone, status, is_read, admin_read, created_at)
            VALUES 
            ('particular', '$message_escaped', $cust_id_sql, '$driver_name', '$phone', 1, 0, 1, NOW())";

    if (mysqli_query($config, $sql)) {
        $sent_count++;
    }
}

if ($sent_count > 0) {
    echo json_encode([
        'success' => true,
        'message' => "Message sent successfully to {$sent_count} selected driver(s)!",
        'sent_count' => $sent_count
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Failed to send message: ' . mysqli_error($config)
    ]);
}
?>
