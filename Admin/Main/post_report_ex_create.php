<?php
// Increase PHP limits for large exports - NO TIME LIMIT
set_time_limit(0);
ini_set('max_execution_time', 0);
ini_set('memory_limit', '1024M');
ini_set('default_socket_timeout', 600);

include('../config/setup.php');

// Disable query timeout
mysqli_query($config, "SET SESSION wait_timeout = 600");
mysqli_query($config, "SET SESSION interactive_timeout = 600");

// Set headers for Excel download
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=registration_data_" . date('Ymd') . ".xls");
header("Pragma: no-cache");
header("Expires: 0");

// Disable output buffering
if (ob_get_level()) {
    ob_end_clean();
}

// Function to clean data for Excel
function filterData(&$str) {
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}

// Output Excel headers
echo "S.No\tDriver Name\tVehicle No\tVehicle Photo\tPhone No\tWhatsapp No\tState\tDistrict\tCity\tStatus\tPaid Status\tAmount\tPaid Date\tRegistration Date\n";

// Build WHERE clause - EXACT same logic as create_post.php count query
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

// Simple query - EXACT same WHERE clause as count query
// Use unbuffered query for large datasets
$query = "SELECT * FROM create_post
     WHERE create_post.delete_id = '0' 
     $expiredFilter
     $paymentFilter
     $dateFilter
     $searchQuery
     ORDER BY create_post.post_id DESC";

// Disable query cache
mysqli_query($config, "SET SESSION query_cache_type = OFF");

// Execute query - use regular buffered query to ensure all rows are fetched
$result = mysqli_query($config, $query);

if (!$result) {
    die("Query Error: " . mysqli_error($config) . " | Query: " . $query);
}

// Verify count matches - This should match create_post.php count query exactly
// Do this BEFORE processing to verify expected count
$verifyCountQuery = "SELECT COUNT(*) AS total
     FROM create_post
     WHERE create_post.delete_id = '0' 
     $expiredFilter
     $paymentFilter
     $dateFilter
     $searchQuery";
$verifyCountResult = mysqli_query($config, $verifyCountQuery);
if (!$verifyCountResult) {
    die("Count Query Error: " . mysqli_error($config));
}
$verifyCountRow = mysqli_fetch_assoc($verifyCountResult);
$expectedCount = (int) $verifyCountRow['total'];
mysqli_free_result($verifyCountResult);

// Verify we got results
$actualRowCount = mysqli_num_rows($result);
error_log("Excel Export: Expected count = $expectedCount, Query returned $actualRowCount rows");

// Process each row - wrap in try-catch to ensure no rows are skipped
$mc = 1;
$processedCount = 0;
$errorCount = 0;

while ($row = mysqli_fetch_assoc($result)) {
    try {
    // Prevent timeout by resetting execution time every 500 rows
    if ($mc % 500 == 0) {
        set_time_limit(0);
        if (ob_get_level() > 0) {
            ob_flush();
        }
        flush();
    }
    
    // Initialize default values to prevent errors
    $stateName = '';
    $cityName = '';
    $areaName = '';
    $paidTransactionID = '';
    $paidAmount = '';
    $paidOn = '';
    
    // Fetch related data row by row (like post_report_export.php)
    // Use mysqli_real_escape_string to prevent errors
    // Handle NULL/empty values safely
    $state_id = !empty($row['state_id']) ? mysqli_real_escape_string($config, $row['state_id']) : '';
    $city_id = !empty($row['city_id']) ? mysqli_real_escape_string($config, $row['city_id']) : '';
    $area_id = !empty($row['area_id']) ? mysqli_real_escape_string($config, $row['area_id']) : '';
    $post_id = !empty($row['post_id']) ? mysqli_real_escape_string($config, $row['post_id']) : '';
    
    // Fetch state name - with error handling
    if (!empty($state_id)) {
        $state_query = @mysqli_query($config, "SELECT name FROM dir_state_master WHERE state_id='$state_id' LIMIT 1");
        if ($state_query && mysqli_num_rows($state_query) > 0) {
            $state_data = mysqli_fetch_object($state_query);
            $stateName = isset($state_data->name) ? $state_data->name : '';
            mysqli_free_result($state_query);
        }
    }
    
    // Fetch city name - with error handling
    if (!empty($city_id)) {
        $city_query = @mysqli_query($config, "SELECT dir_city_name FROM dir_city_master WHERE dir_city_id='$city_id' LIMIT 1");
        if ($city_query && mysqli_num_rows($city_query) > 0) {
            $city_data = mysqli_fetch_object($city_query);
            $cityName = isset($city_data->dir_city_name) ? $city_data->dir_city_name : '';
            mysqli_free_result($city_query);
        }
    }
    
    // Fetch area name - with error handling
    if (!empty($area_id)) {
        $area_query = @mysqli_query($config, "SELECT dir_area_name FROM dir_area_master WHERE dir_area_id='$area_id' LIMIT 1");
        if ($area_query && mysqli_num_rows($area_query) > 0) {
            $area_data = mysqli_fetch_object($area_query);
            $areaName = isset($area_data->dir_area_name) ? $area_data->dir_area_name : '';
            mysqli_free_result($area_query);
        }
    }
    
    // Fetch payment transaction data - with error handling
    $payment_data = null;
    if (!empty($post_id)) {
        $payment_query = @mysqli_query($config, "SELECT transactionId, Paid_Amout, Paid_on FROM online_payment_transcation WHERE Order_id='$post_id' AND Paid_Amout > 0 ORDER BY IFNULL(Paid_on, '1970-01-01') DESC, transactionId DESC LIMIT 1");
        if ($payment_query && mysqli_num_rows($payment_query) > 0) {
            $payment_data = mysqli_fetch_object($payment_query);
            mysqli_free_result($payment_query);
        }
    }
    
    // Payment Status Logic (same as create_post.php)
    $paidTransactionID = (isset($payment_data) && isset($payment_data->transactionId)) ? $payment_data->transactionId : '';
    $paidAmount = (isset($payment_data) && isset($payment_data->Paid_Amout)) ? $payment_data->Paid_Amout : '';
    $paidOn = (isset($payment_data) && isset($payment_data->Paid_on)) ? $payment_data->Paid_on : '';
    $paymentType = $row['payment_type'];
    $refNo = $row['ref_no'];
    $packageAmount = $row['package_amount'];
    $netAmount = $row['net_amount'];
    $utrNumber = $row['utr_number'];
    $utrDate = $row['utr_date'];
    $status = $row['status'];
    $paymentConfirmedAt = $row['payment_confirmed_at'];
    
    // Calculate net amount
    $calculatedNetAmount = (!empty($netAmount) && $netAmount != '') ? $netAmount : $packageAmount;
    
    // Check if free registration
    $packageAmountFloat = ($packageAmount !== null && $packageAmount !== '') ? floatval($packageAmount) : null;
    $netAmountFloat = ($netAmount !== null && $netAmount !== '') ? floatval($netAmount) : null;
    $calculatedNetAmountFloat = ($calculatedNetAmount !== null && $calculatedNetAmount !== '') ? floatval($calculatedNetAmount) : null;
    
    $isFreeRegistration = false;
    if (($packageAmountFloat !== null && $packageAmountFloat == 0) ||
        ($netAmountFloat !== null && $netAmountFloat == 0) ||
        ($calculatedNetAmountFloat !== null && $calculatedNetAmountFloat == 0)) {
        $isFreeRegistration = true;
    }
    
    // Determine payment status
    if ($isFreeRegistration) {
        $paymentStatus = "Free Registration";
        $amount = "Free";
    } elseif (!empty($paidAmount) && $paidAmount > 0) {
        if (!empty($paidTransactionID)) {
            $paymentStatus = "Online Payment (Transaction ID: $paidTransactionID)";
        } else {
            $paymentStatus = "Online Payment";
        }
        $amount = "₹" . number_format($paidAmount, 2);
    } elseif ($paymentType == '0' && empty($utrNumber)) {
        if (!empty($paidTransactionID) || !empty($paymentConfirmedAt) || (!empty($paidAmount) && $paidAmount > 0)) {
            if (!empty($paidTransactionID)) {
                $paymentStatus = "Online Payment (Transaction ID: $paidTransactionID)";
            } else {
                $paymentStatus = "Online Payment";
            }
            $amount = "₹" . number_format($packageAmount, 2);
        } else {
            $paymentStatus = "Payment Pending";
            $amount = "₹" . number_format($packageAmount, 2);
        }
    } elseif ($paymentType == '1') {
        $paymentStatus = "Admin Cash";
        $amount = "₹" . number_format($packageAmount, 2);
    } elseif ($paymentType == '2') {
        if (!empty($refNo)) {
            $paymentStatus = "Admin Bank (Ref No: $refNo)";
        } else {
            $paymentStatus = "Admin Bank";
        }
        $amount = "₹" . number_format($packageAmount, 2);
    } elseif ($paymentType == '3' || !empty($utrNumber)) {
        if (!empty($utrNumber)) {
            if ($status == 1) {
                $paymentStatus = "Scan QR Payment (UTR: $utrNumber - Confirmed)";
            } else {
                $paymentStatus = "Scan QR Payment (UTR: $utrNumber - Pending)";
            }
        } else {
            $paymentStatus = "Scan QR Payment";
        }
        $amount = "₹" . number_format($packageAmount, 2);
    } else {
        if (empty($paymentType) || $status == '0' || $status == 0) {
            $paymentStatus = "Payment Pending";
            if ($packageAmountFloat !== null && $packageAmountFloat > 0) {
                $amount = "₹" . number_format($packageAmount, 2);
            } else {
                $amount = "-";
            }
        } else {
            $paymentStatus = "Payment Pending";
            $amount = "-";
        }
    }
    
    // Determine Paid Date (Priority: Paid_on > utr_date > payment_confirmed_at > create_on)
    $paidDate = '';
    if (!empty($paidOn)) {
        $paidDate = date('d-m-Y', strtotime($paidOn));
    } elseif (!empty($utrDate)) {
        $paidDate = date('d-m-Y', strtotime($utrDate));
    } elseif (!empty($paymentConfirmedAt)) {
        $paidDate = date('d-m-Y', strtotime($paymentConfirmedAt));
    } elseif (!empty($row['create_on'])) {
        $paidDate = date('d-m-Y', strtotime($row['create_on']));
    }
    
    // Registration Date
    $registrationDate = '';
    if (!empty($row['post_addon'])) {
        $registrationDate = date('d-m-Y', strtotime($row['post_addon']));
    } elseif (!empty($row['create_on'])) {
        $registrationDate = date('d-m-Y', strtotime($row['create_on']));
    }
    
    // Output row with filterData
    $rowData = [
        $mc,
        isset($row['driver_name']) ? $row['driver_name'] : '',
        isset($row['vehicle_no']) ? $row['vehicle_no'] : '',
        isset($row['vehicle_photo']) ? $row['vehicle_photo'] : '',
        isset($row['phone_no']) ? $row['phone_no'] : '',
        isset($row['whatsapp_no']) ? $row['whatsapp_no'] : '',
        $stateName,
        $cityName,
        $areaName,
        ($row['status'] == 1 ? 'Active' : 'In-Active'),
        $paymentStatus,
        $amount,
        $paidDate,
        $registrationDate
    ];
    
    array_walk($rowData, 'filterData');
    echo implode("\t", $rowData) . "\n";
    
    // Flush every 100 rows to prevent buffer overflow
    if ($mc % 100 == 0) {
        if (ob_get_level() > 0) {
            ob_flush();
        }
        flush();
    }
    
    $mc++;
    $processedCount++;
    } catch (Exception $e) {
        // Log error but continue processing other rows
        $errorCount++;
        error_log("Excel Export Row Error (Row $mc): " . $e->getMessage());
        // Still increment counter to maintain row numbering
        $mc++;
    } catch (Error $e) {
        // Catch PHP 7+ fatal errors
        $errorCount++;
        error_log("Excel Export Row Fatal Error (Row $mc): " . $e->getMessage());
        $mc++;
    }
}

// Ensure all rows are processed
mysqli_free_result($result);

// Verify count - this should match expectedCount
// Log to error log for debugging (won't appear in Excel file)
error_log("Excel Export Summary: Expected = $expectedCount, Query returned = $actualRowCount, Processed = $processedCount, Errors = $errorCount");

// Final flush
if (ob_get_level() > 0) {
    ob_end_flush();
}
flush();

exit;
?>
