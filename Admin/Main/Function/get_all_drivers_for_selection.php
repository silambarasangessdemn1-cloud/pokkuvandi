<?php
if (file_exists(__DIR__ . '/../../config/setup.php')) {
    include(__DIR__ . '/../../config/setup.php');
} else {
    include('../../config/setup.php');
}

header('Content-Type: application/json; charset=UTF-8');

if (!isset($config) || !$config) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit;
}

// Expired filter
$expiredFilter = isset($_REQUEST['expired']) && $_REQUEST['expired'] == 1 ? "AND create_post.expiry_date < NOW()" : "";

// Payment filter
$paymentFilter = "";
if (isset($_REQUEST['payment_status']) && !empty($_REQUEST['payment_status'])) {
    $paymentStatus = mysqli_real_escape_string($config, $_REQUEST['payment_status']);
    if ($paymentStatus == 'pending') {
        $paymentFilter = "AND (
            (create_post.status = 0 
             AND (create_post.payment_type IS NULL OR create_post.payment_type = '')
             AND (create_post.utr_number IS NULL OR create_post.utr_number = '')
             AND NOT EXISTS (SELECT 1 FROM online_payment_transcation WHERE Order_id = create_post.post_id AND Paid_Amout > 0))
            OR (create_post.net_amount > 0 
             AND (create_post.payment_type IS NULL OR create_post.payment_type = '')
             AND create_post.status = 0)
        )";
    } elseif ($paymentStatus == 'completed') {
        $paymentFilter = "AND (
            (create_post.payment_type = '0' AND (EXISTS (SELECT 1 FROM online_payment_transcation WHERE Order_id = create_post.post_id AND Paid_Amout > 0) OR create_post.payment_confirmed_at IS NOT NULL))
            OR EXISTS (SELECT 1 FROM online_payment_transcation WHERE Order_id = create_post.post_id AND Paid_Amout > 0)
            OR (create_post.utr_number IS NOT NULL AND create_post.utr_number != '' AND create_post.status = 1)
            OR create_post.payment_type IN ('1', '2')
        )";
    } elseif ($paymentStatus == 'free') {
        $paymentFilter = "AND (create_post.package_amount = 0 OR create_post.package_amount IS NULL OR create_post.net_amount = 0 OR create_post.net_amount IS NULL)";
    }
}

// Date filter
$dateFilter = "";
$dateFilterType = isset($_REQUEST['date_filter_type']) ? mysqli_real_escape_string($config, $_REQUEST['date_filter_type']) : '';
if (!empty($dateFilterType) && $dateFilterType != 'all') {
    if ($dateFilterType == 'single' && isset($_REQUEST['single_date']) && !empty($_REQUEST['single_date'])) {
        $singleDate = mysqli_real_escape_string($config, $_REQUEST['single_date']);
        $dateFilter = "AND DATE(create_post.post_addon) = '$singleDate'";
    } elseif ($dateFilterType == 'range' && isset($_REQUEST['date_from']) && !empty($_REQUEST['date_from']) && isset($_REQUEST['date_to']) && !empty($_REQUEST['date_to'])) {
        $dateFrom = mysqli_real_escape_string($config, $_REQUEST['date_from']);
        $dateTo = mysqli_real_escape_string($config, $_REQUEST['date_to']);
        $dateFilter = "AND DATE(create_post.post_addon) BETWEEN '$dateFrom' AND '$dateTo'";
    }
}

// Search filter
$searchQuery = "";
$searchValue = isset($_REQUEST['search']) ? mysqli_real_escape_string($config, trim($_REQUEST['search'])) : '';
if (!empty($searchValue)) {
    $searchQuery = "AND (
        create_post.driver_name LIKE '%$searchValue%' 
        OR create_post.vehicle_no LIKE '%$searchValue%' 
        OR create_post.phone_no LIKE '%$searchValue%' 
        OR create_post.whatsapp_no LIKE '%$searchValue%' 
        OR EXISTS (SELECT 1 FROM dir_city_master WHERE dir_city_id = create_post.city_id AND dir_city_name LIKE '%$searchValue%')
        OR EXISTS (SELECT 1 FROM dir_state_master WHERE state_id = create_post.state_id AND name LIKE '%$searchValue%')
        OR EXISTS (SELECT 1 FROM dir_area_master WHERE dir_area_id = create_post.area_id AND dir_area_name LIKE '%$searchValue%')
    )";
}

$where = "WHERE create_post.delete_id = '0'";
if (!empty($expiredFilter)) $where .= " " . trim($expiredFilter);
if (!empty($paymentFilter)) $where .= " " . trim($paymentFilter);
if (!empty($dateFilter)) $where .= " " . trim($dateFilter);
if (!empty($searchQuery)) $where .= " " . trim($searchQuery);

$sql = "SELECT post_id, customer_id, driver_name, phone_no, vehicle_no 
        FROM create_post 
        $where 
        ORDER BY post_id DESC";

$result = mysqli_query($config, $sql);
if (!$result) {
    echo json_encode([
        'success' => false,
        'message' => 'Query error: ' . mysqli_error($config)
    ]);
    exit;
}

$drivers = [];
while ($row = mysqli_fetch_assoc($result)) {
    $drivers[] = [
        'post_id' => (int)$row['post_id'],
        'customer_id' => (int)$row['customer_id'],
        'driver_name' => $row['driver_name'] ? $row['driver_name'] : '',
        'phone_no' => $row['phone_no'] ? $row['phone_no'] : '',
        'vehicle_no' => $row['vehicle_no'] ? $row['vehicle_no'] : ''
    ];
}

mysqli_free_result($result);

echo json_encode([
    'success' => true,
    'count' => count($drivers),
    'drivers' => $drivers
]);
