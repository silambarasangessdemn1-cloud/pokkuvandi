<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/php_errors.log');

// Set error handler to catch all errors
function customErrorHandler($errno, $errstr, $errfile, $errline) {
    $errorMsg = "Error [$errno]: $errstr in $errfile on line $errline";
    error_log($errorMsg);
    return false; // Let PHP handle it normally
}
set_error_handler("customErrorHandler");

// Catch fatal errors
register_shutdown_function(function() {
    $error = error_get_last();
    if ($error !== NULL && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
        header('Content-Type: application/json');
        echo json_encode([
            "draw" => 1,
            "recordsTotal" => 0,
            "recordsFiltered" => 0,
            "data" => [],
            "error" => "FATAL ERROR: " . $error['message'],
            "file" => $error['file'],
            "line" => $error['line'],
            "type" => $error['type']
        ]);
        exit;
    }
});

// DataTables Server-Side Processing for create_post.php
try {
    include('../config/setup.php');
} catch (Exception $e) {
    header('Content-Type: application/json');
    echo json_encode([
        "draw" => 1,
        "recordsTotal" => 0,
        "recordsFiltered" => 0,
        "data" => [],
        "error" => "Include error: " . $e->getMessage(),
        "trace" => $e->getTraceAsString()
    ]);
    exit;
}

// Check if database connection exists
if (!isset($config) || !$config) {
    header('Content-Type: application/json');
    echo json_encode([
        "draw" => 1,
        "recordsTotal" => 0,
        "recordsFiltered" => 0,
        "data" => [],
        "error" => "Database connection not established. Please check config/setup.php"
    ]);
    exit;
}

// Wrap entire execution in try-catch
try {
// Debug: Log that script started
error_log("create_post_ssp.php: Script started at " . date('Y-m-d H:i:s'));

// DataTables server-side processing parameters
$draw = isset($_GET['draw']) ? intval($_GET['draw']) : 1;
$start = isset($_GET['start']) ? intval($_GET['start']) : 0;
$length = isset($_GET['length']) ? intval($_GET['length']) : 10;

// Get search value - prioritize form search parameter over DataTables search
$searchValue = '';
// First check if search is a string (from form submission)
if (isset($_GET['search']) && is_string($_GET['search']) && !empty(trim($_GET['search']))) {
    $searchValue = mysqli_real_escape_string($config, trim($_GET['search']));
}
// If no form search, check DataTables search format
elseif (isset($_GET['search']['value']) && !empty(trim($_GET['search']['value']))) {
    $searchValue = mysqli_real_escape_string($config, trim($_GET['search']['value']));
}

// Get filter parameters from URL
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

// Build search query if search value exists
$searchQuery = "";
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

// Build WHERE clause - ensure proper spacing
$where = "WHERE create_post.delete_id = '0'";
if (!empty($expiredFilter)) {
    $where .= " " . trim($expiredFilter);
}
if (!empty($paymentFilter)) {
    $where .= " " . trim($paymentFilter);
}
if (!empty($dateFilter)) {
    $where .= " " . trim($dateFilter);
}
if (!empty($searchQuery)) {
    $where .= " " . trim($searchQuery);
}

// Count total records (matching filters)
$countQuery = "SELECT COUNT(*) AS total
     FROM create_post
     $where";
$countResult = mysqli_query($config, $countQuery);
if (!$countResult) {
    header('Content-Type: application/json');
    echo json_encode([
        "draw" => intval($draw),
        "recordsTotal" => 0,
        "recordsFiltered" => 0,
        "data" => [],
        "error" => "Count query error: " . mysqli_error($config) . " | Query: " . $countQuery
    ]);
    exit;
}
$countRow = mysqli_fetch_assoc($countResult);
$totalRecords = isset($countRow['total']) ? $countRow['total'] : 0;
mysqli_free_result($countResult);

// Fetch data with pagination - simplified query without JOINs to avoid GROUP BY issues
$dataQuery = "SELECT create_post.*
     FROM create_post
     $where
     ORDER BY create_post.post_id DESC
     LIMIT $start, $length";

$dataResult = mysqli_query($config, $dataQuery);

if (!$dataResult) {
    // Return error response with detailed information
    header('Content-Type: application/json');
    echo json_encode([
        "draw" => intval($draw),
        "recordsTotal" => 0,
        "recordsFiltered" => 0,
        "data" => [],
        "error" => "Database query error: " . mysqli_error($config),
        "query" => $dataQuery,
        "where_clause" => $where,
        "php_error" => error_get_last()
    ]);
    exit;
}

// Prepare response data
$data = array();
$rowNum = $start + 1;

while ($row = mysqli_fetch_assoc($dataResult)) {
    // Fetch related data for each row (similar to post_report_export.php approach)
    $stateName = '';
    if (!empty($row['state_id'])) {
        $stateQuery = mysqli_query($config, "SELECT name FROM dir_state_master WHERE state_id = '{$row['state_id']}' LIMIT 1");
        if ($stateQuery && mysqli_num_rows($stateQuery) > 0) {
            $stateData = mysqli_fetch_assoc($stateQuery);
            $stateName = $stateData['name'];
            mysqli_free_result($stateQuery);
        }
    }

    $cityName = '';
    if (!empty($row['city_id'])) {
        $cityQuery = mysqli_query($config, "SELECT dir_city_name FROM dir_city_master WHERE dir_city_id = '{$row['city_id']}' LIMIT 1");
        if ($cityQuery && mysqli_num_rows($cityQuery) > 0) {
            $cityData = mysqli_fetch_assoc($cityQuery);
            $cityName = $cityData['dir_city_name'];
            mysqli_free_result($cityQuery);
        }
    }

    $areaName = '';
    if (!empty($row['area_id'])) {
        $areaQuery = mysqli_query($config, "SELECT dir_area_name FROM dir_area_master WHERE dir_area_id = '{$row['area_id']}' LIMIT 1");
        if ($areaQuery && mysqli_num_rows($areaQuery) > 0) {
            $areaData = mysqli_fetch_assoc($areaQuery);
            $areaName = $areaData['dir_area_name'];
            mysqli_free_result($areaQuery);
        }
    }

    // Payment transaction details
    $paidTransactionID = '';
    $paidAmount = 0;
    $paymentConfirmedAt = '';
    $onlinePaymentQuery = mysqli_query($config, "SELECT transactionId, Paid_Amout, Paid_on FROM online_payment_transcation WHERE Order_id = '{$row['post_id']}' AND Paid_Amout > 0 LIMIT 1");
    if ($onlinePaymentQuery && mysqli_num_rows($onlinePaymentQuery) > 0) {
        $onlinePaymentData = mysqli_fetch_assoc($onlinePaymentQuery);
        $paidTransactionID = $onlinePaymentData['transactionId'];
        $paidAmount = $onlinePaymentData['Paid_Amout'];
        $paymentConfirmedAt = $onlinePaymentData['Paid_on'];
        mysqli_free_result($onlinePaymentQuery);
    }

    // Payment Status Logic (same as create_post.php)
    $paymentType = $row['payment_type'];
    $refNo = $row['ref_no'];
    $packageAmount = $row['package_amount'];
    $netAmount = $row['net_amount'];
    $utrNumber = $row['utr_number'];
    $utrDate = $row['utr_date'];
    $status = $row['status'];
    $paymentConfirmedAt_db = $row['payment_confirmed_at'];
    
    // Calculate Net Amount if discount applied
    $discountAmount = $row['discount_amount'];
    $discountName = $row['discount_name'];
    if (!empty($discountAmount)) {
        $calculatedNetAmount = $packageAmount - $discountAmount;
    } else {
        $calculatedNetAmount = $packageAmount;
    }
    
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
    
    // Determine payment status (matching create_post.php logic)
    if ($isFreeRegistration) {
        $paymentStatus = "Free Registration<br><span class='badge bg-info mt-2'>Free</span>";
    } elseif (!empty($paidAmount) && $paidAmount > 0) {
        $paymentStatus = "Online Payment (Transaction ID: $paidTransactionID)<br><span class='badge bg-success mt-2'>Paid</span>";
    } elseif ($paymentType == '0' && empty($utrNumber)) {
        if (!empty($paidTransactionID) || !empty($paymentConfirmedAt_db) || (!empty($paidAmount) && $paidAmount > 0)) {
            if (!empty($paidTransactionID)) {
                $paymentStatus = "Online Payment (Transaction ID: $paidTransactionID)";
            } else {
                $paymentStatus = "Online Payment";
            }
            $paymentStatus .= "<br><span class='badge bg-success mt-2'>Paid</span>";
            if (!empty($paymentConfirmedAt_db)) {
                $paymentStatus .= "<br><small>Confirmed on: " . date('d-M-Y h:i A', strtotime($paymentConfirmedAt_db)) . "</small>";
            }
        } else {
            $paymentStatus = "Payment Pending<br><span class='badge bg-warning mt-2'>Pending</span>";
        }
    } elseif ($paymentType == '1') {
        $paymentStatus = "Admin Cash<br><span class='badge bg-success mt-2'>Paid</span>";
    } elseif ($paymentType == '2') {
        $paymentStatus = "Admin Bank + Transaction (Ref No: $refNo)<br><span class='badge bg-success mt-2'>Paid</span>";
    } elseif (!empty($utrNumber)) {
        if ($status == 1) {
            $paymentStatus = "UTR No: $utrNumber<br>UTR Date: $utrDate<br><span class='badge bg-success mt-2'>Payment Confirmed</span>";
            if (!empty($paymentConfirmedAt_db)) {
                $paymentStatus .= "<br><small>Confirmed on: " . date('d-M-Y h:i A', strtotime($paymentConfirmedAt_db)) . "</small>";
            }
        } else {
            $paymentStatus = "UTR No: $utrNumber<br>UTR Date: $utrDate<br><button class='btn btn-success btn-sm mt-2' onclick='updatePaymentStatus(" . $row['post_id'] . ")'>Confirm Payment</button>";
            $paymentStatus .= "<br><button class='btn btn-warning btn-sm mt-1' onclick='updateUTRNumber(" . $row['post_id'] . ", \"" . $utrNumber . "\", \"" . $utrDate . "\")'>Update UTR</button>";
            $paymentStatus .= "<br><button class='btn btn-danger btn-sm mt-1' onclick='clearUTRNumber(" . $row['post_id'] . ")'>Clear UTR</button>";
        }
    } else {
        if (empty($paymentType) || $status == '0' || $status == 0) {
            $paymentStatus = "Payment Pending<br><span class='badge bg-warning mt-2'>Pending</span>";
        } else {
            $paymentStatus = "Payment Pending";
        }
    }
    
    // Amount display
    if ($isFreeRegistration) {
        $amount = "<span class='badge bg-info'>Free</span>";
    } elseif (!empty($discountAmount)) {
        $amount = "₹" . number_format($calculatedNetAmount, 2) . " <br><small>(₹$packageAmount - ₹$discountAmount, Coupon: $discountName)</small>";
    } elseif (!empty($packageAmount) && floatval($packageAmount) > 0) {
        $amount = "₹" . number_format($packageAmount, 2);
    } else {
        $amount = "-";
    }
    
    // Status
    $statusText = ($row['status'] == 1) ? '<label class="btn btn-success">Active</label>' : '<label class="btn btn-danger">In-Active</label>';
    
    // Date
    $createDate = !empty($row['post_addon']) ? date('d-m-Y', strtotime($row['post_addon'])) : '';
    
    // Vehicle photo
    $vehiclePhoto = '<img src="../../photos/vehicle/' . $row['vehicle_photo'] . '" style="width: 128px; height: 129px;">';
    
    // Action buttons
    $actionButtons = '<a href="edit_create_post.php?pid=' . $row['post_id'] . '" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a> ';
    $actionButtons .= '<a style="color:white" data-toggle="modal" data-target="#exampleModaldelete" onclick="deletepost(' . $row['post_id'] . ')" class="btn btn-danger"><i class="fas fa-trash"></i></a>';
    
    $data[] = array(
        $rowNum,
        $row['driver_name'],
        $row['vehicle_no'],
        $vehiclePhoto,
        $row['phone_no'],
        $row['whatsapp_no'],
        $stateName,
        $cityName,
        $areaName,
        $statusText,
        $paymentStatus,
        $amount,
        $createDate,
        $actionButtons
    );
    
    $rowNum++;
}

// Prepare JSON response
$response = array(
    "draw" => intval($draw),
    "recordsTotal" => intval($totalRecords),
    "recordsFiltered" => intval($totalRecords),
    "data" => $data
);

header('Content-Type: application/json');
$jsonOutput = json_encode($response);
if ($jsonOutput === false) {
    // JSON encoding failed - return error
    echo json_encode([
        "draw" => intval($draw),
        "recordsTotal" => 0,
        "recordsFiltered" => 0,
        "data" => [],
        "error" => "JSON encoding error: " . json_last_error_msg(),
        "json_error_code" => json_last_error()
    ]);
} else {
    echo $jsonOutput;
}

} catch (Exception $e) {
    // Catch any exception and return detailed error
    header('Content-Type: application/json');
    echo json_encode([
        "draw" => isset($draw) ? intval($draw) : 1,
        "recordsTotal" => 0,
        "recordsFiltered" => 0,
        "data" => [],
        "error" => "EXCEPTION: " . $e->getMessage(),
        "file" => $e->getFile(),
        "line" => $e->getLine(),
        "trace" => $e->getTraceAsString()
    ]);
    exit;
} catch (Error $e) {
    // Catch PHP 7+ errors (fatal errors, type errors, etc.)
    header('Content-Type: application/json');
    echo json_encode([
        "draw" => isset($draw) ? intval($draw) : 1,
        "recordsTotal" => 0,
        "recordsFiltered" => 0,
        "data" => [],
        "error" => "FATAL ERROR: " . $e->getMessage(),
        "file" => $e->getFile(),
        "line" => $e->getLine(),
        "trace" => $e->getTraceAsString()
    ]);
    exit;
}
?>

