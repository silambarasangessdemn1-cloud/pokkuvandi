<?php
if (file_exists(__DIR__ . '/../../config/setup.php')) {
    include(__DIR__ . '/../../config/setup.php');
} else {
    include('../../config/setup.php');
}

header('Content-Type: application/json; charset=UTF-8');

@set_time_limit(300);
@ini_set('memory_limit', '256M');

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

// Collect phones that need customer_id lookup
$phones_to_lookup = [];
foreach ($drivers as $drv) {
    $cid = isset($drv['customer_id']) ? (int)$drv['customer_id'] : 0;
    $phone = isset($drv['phone_no']) ? trim($drv['phone_no']) : '';
    if ($cid <= 0 && !empty($phone)) {
        $phones_to_lookup[] = mysqli_real_escape_string($config, $phone);
    }
}

$phone_customer_map = [];
if (!empty($phones_to_lookup)) {
    $chunks = array_chunk(array_unique($phones_to_lookup), 500);
    foreach ($chunks as $chunk) {
        $phone_in = "'" . implode("','", $chunk) . "'";
        $lookup_q = mysqli_query($config, "SELECT Customer_Id, Customer_Phone_No FROM customer_master WHERE Customer_Phone_No IN ($phone_in)");
        if ($lookup_q) {
            while ($lrow = mysqli_fetch_assoc($lookup_q)) {
                $phone_customer_map[$lrow['Customer_Phone_No']] = (int)$lrow['Customer_Id'];
            }
            mysqli_free_result($lookup_q);
        }
    }
}

$processed_customers = [];
$rows_to_insert = [];

foreach ($drivers as $drv) {
    $customer_id = isset($drv['customer_id']) ? (int)$drv['customer_id'] : 0;
    $phone = isset($drv['phone_no']) ? trim($drv['phone_no']) : '';
    $driver_name = isset($drv['driver_name']) ? trim($drv['driver_name']) : '';

    // If customer_id is 0 or missing, check preloaded map
    if ($customer_id <= 0 && !empty($phone) && isset($phone_customer_map[$phone])) {
        $customer_id = $phone_customer_map[$phone];
    }

    // Deduplicate by customer_id if valid, or by phone
    $unique_key = ($customer_id > 0) ? "id_" . $customer_id : "phone_" . $phone;
    if (isset($processed_customers[$unique_key])) {
        continue;
    }
    $processed_customers[$unique_key] = true;

    $safe_name = mysqli_real_escape_string($config, $driver_name);
    $safe_phone = mysqli_real_escape_string($config, $phone);
    $cust_id_sql = ($customer_id > 0) ? "'$customer_id'" : "NULL";

    $rows_to_insert[] = "('particular', '$message_escaped', $cust_id_sql, '$safe_name', '$safe_phone', 1, 0, 1, NOW())";
}

$sent_count = 0;
if (!empty($rows_to_insert)) {
    $batch_chunks = array_chunk($rows_to_insert, 200);
    foreach ($batch_chunks as $bchunk) {
        $sql = "INSERT INTO comman_notification_messages 
                (message_type, message_text, customer_id, customer_name, customer_phone, status, is_read, admin_read, created_at)
                VALUES " . implode(',', $bchunk);
        if (mysqli_query($config, $sql)) {
            $sent_count += mysqli_affected_rows($config);
        } else {
            error_log("Error batch inserting messages: " . mysqli_error($config));
        }
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
