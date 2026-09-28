<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../config/setup.php');

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid ID']);
    exit;
}

/**
 * Step 1️⃣: Fetch main order data
 */
$query = "
SELECT 
    o.*, 
    c.dir_city_name AS from_district_name, 
    c2.dir_city_name AS to_district_name,
    a1.dir_area_name AS from_area_name,
    a2.dir_area_name AS to_area_name,
    s1.name AS from_state_name,
    s2.name AS to_state_name
FROM orders o
LEFT JOIN dir_city_master c ON o.from_district = c.dir_city_id
LEFT JOIN dir_city_master c2 ON o.to_district = c2.dir_city_id
LEFT JOIN dir_area_master a1 ON o.from_city = a1.dir_area_id
LEFT JOIN dir_area_master a2 ON o.to_city = a2.dir_area_id
LEFT JOIN dir_state_master s1 ON o.from_state = s1.state_id
LEFT JOIN dir_state_master s2 ON o.to_state = s2.state_id
WHERE o.id = $id
LIMIT 1
";

$result = mysqli_query($config, $query);
if (!$result) {
    echo json_encode(['status' => 'error', 'message' => mysqli_error($config)]);
    exit;
}

if (mysqli_num_rows($result) == 0) {
    echo json_encode(['status' => 'error', 'message' => 'Trip not found']);
    exit;
}

$order = mysqli_fetch_assoc($result);

/**
 * Step 2️⃣: Fetch driver info
 */
$driver_name = $driver_phone = '-';
if (!empty($order['driver_id'])) {
    $driver_sql = "SELECT driver_name, phone_no FROM create_post WHERE customer_id = '{$order['driver_id']}' LIMIT 1";
    $driver_res = mysqli_query($config, $driver_sql);
    if ($driver_res && mysqli_num_rows($driver_res) > 0) {
        $driver = mysqli_fetch_assoc($driver_res);
        $driver_name = $driver['driver_name'];
        $driver_phone = $driver['phone_no'];
    }
}

/**
 * 🔹 Step 3.1: Fetch quote amount from order_driver_bids
 */
$quote_amount = '';
$quote_sql = "
    SELECT bid_amount 
    FROM order_driver_bids 
    WHERE order_id = $id 
    ORDER BY id DESC 
    LIMIT 1
";
$quote_res = mysqli_query($config, $quote_sql);
if ($quote_res && mysqli_num_rows($quote_res) > 0) {
    $quote_row = mysqli_fetch_assoc($quote_res);
    $quote_amount = $quote_row['bid_amount'];
}

/**
 * Step 3️⃣: Fetch payment/trip details
 */
$payment_sql = "SELECT * FROM trip_payments WHERE order_id = $id LIMIT 1";
$payment_res = mysqli_query($config, $payment_sql);
$payment = ($payment_res && mysqli_num_rows($payment_res) > 0) ? mysqli_fetch_assoc($payment_res) : [];

$payment_status = $payment['status'] ?? 'Unpaid';

/**
 * Step 4️⃣: Calculate Net KM properly
 */
$starting_km = floatval($order['start_km'] ?? 0);
$ending_km   = floatval($order['ending_km'] ?? 0);
$net_km      = ($starting_km > 0 && $ending_km > 0) ? ($ending_km - $starting_km) : '';

/**
 * Step 5️⃣: Prepare data for JSON (✅ Added order_id)
 */
$data = [
    'order_id'        => $order['id'], // ✅ Added Order ID here
    'customer_name'   => $order['name'],
    'from_location'   => trim($order['loader_from_place'] . ', ' . ($order['from_area_name'] ?? '') . ', ' . ($order['from_district_name'] ?? ''), ', '),
    'to_location'     => $order['drop_place'] ?: $order['loader_to_place'],
    'total_km'        => $order['total_km'] ?? '',
    'goods'           => $order['product_details'] ?? '',
    'body_type'       => $order['vehicle_body_type'] ?? '',
    'weight'          => $order['total_weight'] ?? '',
    'trip_type'       => $order['trip_type'] ?? '',
    'vehicle_required'=> $order['vehicle_required_datetime'] ?? '',
    'driver_name'     => $driver_name,
    'driver_phone'    => $driver_phone,
    'quote'           => $quote_amount, // ✅ fetched from order_driver_bids
    'status'          => (!empty($order['ending_km']) ? 'Completed' : (!empty($order['start_km']) ? 'Ongoing' : 'Pending')),
    'start_time'      => $order['start_time'] ?? '',
    'starting_km'     => $order['start_km'] ?? '',
    'end_time'        => $order['end_time'] ?? '',
    'ending_km'       => $order['ending_km'] ?? '',
    'net_km'          => $net_km,
    'travel_hours'    => $order['travel_hrs'] ?? '',
    'trip_amount'     => $order['trip_amount'] ?? '',
    'driver_bata'     => $order['driver_bata'] ?? '',
    'toll'            => $order['toll_charge'] ?? '',
    'unloading'       => $order['unloading_charge'] ?? '',
    'waiting'         => $order['waiting_charge'] ?? '',
    'total_amount'    => $order['total_amount'] ?? '',
    'discount'        => $payment['discount'] ?? '',
    'net_amount'      => $payment['net_amount'] ?? '',
    'cash_received'   => $payment['cash_received'] ?? '',
    'bank_received'   => $payment['bank_received'] ?? '',
    'total_received'  => $payment['total_received'] ?? '',
    'payment_status'  => ucfirst($payment_status)
];

/**
 * Step 6️⃣: Return JSON response
 */
echo json_encode(['status' => 'success', 'data' => $data]);
exit;
?>
