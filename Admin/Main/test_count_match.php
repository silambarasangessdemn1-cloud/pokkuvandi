<?php
// Test file to compare count queries
include('../config/setup.php');

// Get filter parameters
$expiredFilter = isset($_GET['expired']) && $_GET['expired'] == 1 ? "AND create_post.expiry_date < NOW()" : "";

$paymentFilter = "";
if(isset($_GET['payment_status']) && !empty($_GET['payment_status'])) {
    $paymentStatus = mysqli_real_escape_string($config, $_GET['payment_status']);
    if($paymentStatus == 'pending') {
        $paymentFilter = "AND (
            (create_post.status = 0 
             AND (create_post.payment_type IS NULL OR create_post.payment_type = '')
             AND (create_post.utr_number IS NULL OR create_post.utr_number = '')
             AND NOT EXISTS (SELECT 1 FROM online_payment_transcation WHERE Order_id = create_post.post_id AND Paid_Amout > 0))
            OR (create_post.net_amount > 0 
             AND (create_post.payment_type IS NULL OR create_post.payment_type = '')
             AND create_post.status = 0)
        )";
    } elseif($paymentStatus == 'completed') {
        $paymentFilter = "AND (
            (create_post.payment_type = '0' AND (EXISTS (SELECT 1 FROM online_payment_transcation WHERE Order_id = create_post.post_id AND Paid_Amout > 0) OR create_post.payment_confirmed_at IS NOT NULL))
            OR EXISTS (SELECT 1 FROM online_payment_transcation WHERE Order_id = create_post.post_id AND Paid_Amout > 0)
            OR (create_post.utr_number IS NOT NULL AND create_post.utr_number != '' AND create_post.status = 1)
            OR create_post.payment_type IN ('1', '2')
        )";
    } elseif($paymentStatus == 'free') {
        $paymentFilter = "AND (create_post.package_amount = 0 OR create_post.package_amount IS NULL OR create_post.net_amount = 0 OR create_post.net_amount IS NULL)";
    }
}

$dateFilter = "";
$dateFilterType = isset($_GET['date_filter_type']) ? mysqli_real_escape_string($config, $_GET['date_filter_type']) : '';
if (!empty($dateFilterType) && $dateFilterType != 'all') {
    if ($dateFilterType == 'single' && isset($_GET['single_date']) && !empty($_GET['single_date'])) {
        $singleDate = mysqli_real_escape_string($config, $_GET['single_date']);
        $dateFilter = "AND DATE(create_post.post_addon) = '$singleDate'";
    } elseif ($dateFilterType == 'range' && isset($_GET['date_from']) && !empty($_GET['date_from']) && isset($_GET['date_to']) && !empty($_GET['date_to'])) {
        $dateFrom = mysqli_real_escape_string($config, $_GET['date_from']);
        $dateTo = mysqli_real_escape_string($config, $_GET['date_to']);
        $dateFilter = "AND DATE(create_post.post_addon) BETWEEN '$dateFrom' AND '$dateTo'";
    }
}

$searchTerm = isset($_GET['search']) ? mysqli_real_escape_string($config, $_GET['search']) : '';
$searchQuery = "";
if (!empty($searchTerm)) {
    $searchQuery = "AND (
        create_post.driver_name LIKE '%$searchTerm%' 
        OR create_post.vehicle_no LIKE '%$searchTerm%' 
        OR create_post.phone_no LIKE '%$searchTerm%' 
        OR create_post.whatsapp_no LIKE '%$searchTerm%' 
        OR EXISTS (SELECT 1 FROM dir_city_master WHERE dir_city_id = create_post.city_id AND dir_city_name LIKE '%$searchTerm%')
        OR EXISTS (SELECT 1 FROM dir_state_master WHERE state_id = create_post.state_id AND name LIKE '%$searchTerm%')
        OR EXISTS (SELECT 1 FROM dir_area_master WHERE dir_area_id = create_post.area_id AND dir_area_name LIKE '%$searchTerm%')
    )";
}

// Query 1: Count query (from create_post.php)
$countQuery = "SELECT COUNT(*) AS total
     FROM create_post
     WHERE create_post.delete_id = '0' 
     $expiredFilter
     $paymentFilter
     $dateFilter
     $searchQuery";

// Query 2: Export query count (from post_report_ex_create.php)
$where = "WHERE create_post.delete_id = '0'";
$where .= $expiredFilter;
$where .= $paymentFilter;
$where .= $dateFilter;
$where .= $searchQuery;

$exportQuery = "SELECT * FROM create_post $where ORDER BY create_post.post_id DESC";
$exportCountQuery = "SELECT COUNT(*) AS total FROM create_post $where";

// Execute both queries
$countResult = mysqli_query($config, $countQuery);
$countRow = mysqli_fetch_assoc($countResult);
$countTotal = (int) $countRow['total'];

$exportCountResult = mysqli_query($config, $exportCountQuery);
$exportCountRow = mysqli_fetch_assoc($exportCountResult);
$exportCountTotal = (int) $exportCountRow['total'];

// Count actual rows from export query
$exportResult = mysqli_query($config, $exportQuery);
$actualExportCount = mysqli_num_rows($exportResult);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Count Match Test</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        .box { background: #f5f5f5; padding: 15px; margin: 10px 0; border: 1px solid #ddd; }
        .match { background: #d4edda; border-color: #c3e6cb; }
        .mismatch { background: #f8d7da; border-color: #f5c6cb; }
        pre { background: white; padding: 10px; overflow-x: auto; }
    </style>
</head>
<body>
    <h1>Count Match Test</h1>
    
    <div class="box">
        <h3>Count Query (from create_post.php):</h3>
        <pre><?php echo htmlspecialchars($countQuery); ?></pre>
        <strong>Result: <?php echo $countTotal; ?> records</strong>
    </div>
    
    <div class="box">
        <h3>Export Count Query (from post_report_ex_create.php):</h3>
        <pre><?php echo htmlspecialchars($exportCountQuery); ?></pre>
        <strong>Result: <?php echo $exportCountTotal; ?> records</strong>
    </div>
    
    <div class="box">
        <h3>Actual Export Query Row Count:</h3>
        <pre><?php echo htmlspecialchars($exportQuery); ?></pre>
        <strong>Result: <?php echo $actualExportCount; ?> rows</strong>
    </div>
    
    <div class="box <?php echo ($countTotal == $exportCountTotal && $exportCountTotal == $actualExportCount) ? 'match' : 'mismatch'; ?>">
        <h3>Comparison:</h3>
        <p><strong>Count Query:</strong> <?php echo $countTotal; ?></p>
        <p><strong>Export Count Query:</strong> <?php echo $exportCountTotal; ?></p>
        <p><strong>Actual Export Rows:</strong> <?php echo $actualExportCount; ?></p>
        <?php if ($countTotal == $exportCountTotal && $exportCountTotal == $actualExportCount): ?>
            <p style="color: green;"><strong>✓ ALL MATCH!</strong></p>
        <?php else: ?>
            <p style="color: red;"><strong>✗ MISMATCH DETECTED!</strong></p>
            <p>Difference: <?php echo abs($countTotal - $exportCountTotal); ?> records</p>
        <?php endif; ?>
    </div>
    
    <hr>
    <h2>Raw Queries (for copy/paste to phpMyAdmin):</h2>
    <div class="box">
        <h3>Count Query:</h3>
        <pre><?php echo $countQuery; ?></pre>
    </div>
    <div class="box">
        <h3>Export Count Query:</h3>
        <pre><?php echo $exportCountQuery; ?></pre>
    </div>
</body>
</html>

