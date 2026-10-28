<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/php_errors.log');
date_default_timezone_set("Asia/Kolkata");

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
$check_created_at = mysqli_query($config, "SHOW COLUMNS FROM `create_post` LIKE 'created_at'");
if(mysqli_num_rows($check_created_at) == 0) {
    mysqli_query($config, "ALTER TABLE `create_post` ADD COLUMN `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP AFTER `post_addon`");
    mysqli_query($config, "UPDATE `create_post` SET `created_at` = CAST(`post_addon` AS DATETIME)");
}

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
$limitClause = "";
if ($length > 0) {
    $limitClause = "LIMIT $start, $length";
} elseif ($length == -1) {
    $limitClause = ""; // Return all records
} else {
    $limitClause = "LIMIT $start, 10";
}

$dataQuery = "SELECT create_post.*
     FROM create_post
     $where
     ORDER BY create_post.post_id DESC
     $limitClause";

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

// Pre-load reference maps for fast lookups
$stateMap = array();
$stateQuery = mysqli_query($config, "SELECT state_id, name FROM dir_state_master");
if ($stateQuery) {
    while ($sData = mysqli_fetch_assoc($stateQuery)) {
        $stateMap[$sData['state_id']] = $sData['name'];
    }
    mysqli_free_result($stateQuery);
}

$cityMap = array();
$cityQuery = mysqli_query($config, "SELECT dir_city_id, dir_city_name FROM dir_city_master");
if ($cityQuery) {
    while ($cData = mysqli_fetch_assoc($cityQuery)) {
        $cityMap[$cData['dir_city_id']] = $cData['dir_city_name'];
    }
    mysqli_free_result($cityQuery);
}

$areaMap = array();
$areaQuery = mysqli_query($config, "SELECT dir_area_id, dir_area_name FROM dir_area_master");
if ($areaQuery) {
    while ($aData = mysqli_fetch_assoc($areaQuery)) {
        $areaMap[$aData['dir_area_id']] = $aData['dir_area_name'];
    }
    mysqli_free_result($areaQuery);
}

// Pre-load online transactions mapped by Order_id
$onlineTransMap = array();
$onlinePaymentQuery = mysqli_query($config, "SELECT Order_id, transactionId, Paid_Amout, Paid_on FROM online_payment_transcation WHERE (Paid_Amout > 0 OR Order_Paid_Status = 'success') ORDER BY IFNULL(Paid_on, '1970-01-01') ASC, Online_order_id ASC");
if ($onlinePaymentQuery) {
    while ($tRow = mysqli_fetch_assoc($onlinePaymentQuery)) {
        $onlineTransMap[$tRow['Order_id']] = $tRow;
    }
    mysqli_free_result($onlinePaymentQuery);
}

// Prepare response data
$data = array();
$rowNum = ($length == -1) ? 1 : ($start + 1);

while ($row = mysqli_fetch_assoc($dataResult)) {
    $stateName = (!empty($row['state_id']) && isset($stateMap[$row['state_id']])) ? $stateMap[$row['state_id']] : '';
    $cityName = (!empty($row['city_id']) && isset($cityMap[$row['city_id']])) ? $cityMap[$row['city_id']] : '';
    $areaName = (!empty($row['area_id']) && isset($areaMap[$row['area_id']])) ? $areaMap[$row['area_id']] : '';

    // Payment transaction details
    $paidTransactionID = '';
    $paidAmount = 0;
    $onlinePaidOn = '';
    if (isset($onlineTransMap[$row['post_id']])) {
        $onlinePaymentData = $onlineTransMap[$row['post_id']];
        $paidTransactionID = !empty($onlinePaymentData['transactionId']) ? trim($onlinePaymentData['transactionId']) : '';
        $paidAmount = !empty($onlinePaymentData['Paid_Amout']) ? floatval(str_replace(',', '', $onlinePaymentData['Paid_Amout'])) : 0;
        $onlinePaidOn = !empty($onlinePaymentData['Paid_on']) ? trim($onlinePaymentData['Paid_on']) : '';
    }

    // Payment Status Logic
    $paymentType = $row['payment_type'];
    $refNo = !empty($row['ref_no']) ? trim($row['ref_no']) : '';
    $packageAmount = $row['package_amount'];
    $netAmount = $row['net_amount'];
    $utrNumber = !empty($row['utr_number']) ? trim($row['utr_number']) : '';
    $utrDate = !empty($row['utr_date']) ? trim($row['utr_date']) : '';
    $status = $row['status'];
    $paymentConfirmedAt_db = !empty($row['payment_confirmed_at']) ? trim($row['payment_confirmed_at']) : '';
    
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

    // Check if user paid online:
    // A post is paid online if:
    // 1. Not a free registration, AND
    // 2. Either a successful transaction exists in online_payment_transcation ($paidAmount > 0 OR Order_Paid_Status = 'success' OR transactionId present)
    //    OR post is Active (status=1) with payment_type='0' (Online)
    $hasOnlineTransaction = ($paidAmount > 0) || (!empty($paidTransactionID)) || (!empty($onlinePaidOn) && ($paymentType === '0' || $paymentType === 0));
    $isOnlinePaid = (!$isFreeRegistration) && (
        $hasOnlineTransaction ||
        ($status == 1 && ($paymentType === '0' || $paymentType === 0) && (!empty($paymentConfirmedAt_db) || !empty($row['razorpay_order_id']) || (!empty($refNo) && stripos($refNo, 'pay_') === 0)))
    );

    // Determine Confirmed On date and time:
    // - If user paid through online payment: show that online payment time/date
    // - Or else (manual payment, e.g. Admin Cash, Admin Bank, Scan QR / UTR): use manual payment confirmation time/date
    $paymentConfirmedDate = '-';
    if ($isFreeRegistration) {
        $paymentConfirmedDate = '-';
    } elseif ($isOnlinePaid) {
        // ONLINE PAYMENT:
        // Priority 1: Check online_payment_transcation.Paid_on
        $onlineTs = (!empty($onlinePaidOn) && $onlinePaidOn !== '0000-00-00' && $onlinePaidOn !== '0000-00-00 00:00:00') ? strtotime($onlinePaidOn) : false;
        $onlineHasTime = false;
        if ($onlineTs !== false && $onlineTs > 0) {
            $oTime = date('H:i:s', $onlineTs);
            if ($oTime !== '00:00:00' && $oTime !== '05:30:00') {
                $onlineHasTime = true;
            }
        }

        // Priority 2: Check create_post.payment_confirmed_at (recorded by Razorpay webhook on payment success)
        $dbTs = (!empty($paymentConfirmedAt_db) && $paymentConfirmedAt_db !== '0000-00-00 00:00:00') ? strtotime($paymentConfirmedAt_db) : false;
        $dbHasTime = false;
        if ($dbTs !== false && $dbTs > 0) {
            $dTime = date('H:i:s', $dbTs);
            if ($dTime !== '00:00:00' && $dTime !== '05:30:00') {
                $dbHasTime = true;
            }
        }

        if ($onlineHasTime) {
            // Online transaction table has exact timestamp
            $paymentConfirmedDate = date('d-M-Y h:i A', $onlineTs);
        } elseif ($dbHasTime) {
            // Webhook recorded exact timestamp in payment_confirmed_at
            $paymentConfirmedDate = date('d-M-Y h:i A', $dbTs);
        } elseif ($onlineTs !== false && $onlineTs > 0) {
            // Date-only from online transaction table
            $paymentConfirmedDate = date('d-M-Y', $onlineTs);
        } elseif ($dbTs !== false && $dbTs > 0) {
            // Date-only from payment_confirmed_at
            $paymentConfirmedDate = date('d-M-Y', $dbTs);
        }
    } else {
        // MANUAL / NON-ONLINE PAYMENT:
        // Use the manual confirmation time (set when admin clicks 'Confirm Payment' or updates payment status)
        $dbTs = (!empty($paymentConfirmedAt_db) && $paymentConfirmedAt_db !== '0000-00-00 00:00:00') ? strtotime($paymentConfirmedAt_db) : false;
        if ($dbTs !== false && $dbTs > 0) {
            $dbTime = date('H:i:s', $dbTs);
            if ($dbTime !== '00:00:00' && $dbTime !== '05:30:00') {
                $paymentConfirmedDate = date('d-M-Y h:i A', $dbTs);
            } else {
                $paymentConfirmedDate = date('d-M-Y', $dbTs);
            }
        } elseif (!empty($utrDate) && $utrDate !== '0000-00-00' && $status == 1) {
            $uTs = strtotime($utrDate);
            if ($uTs !== false && $uTs > 0) {
                $paymentConfirmedDate = date('d-M-Y', $uTs);
            }
        } elseif ($status == 1 && ($paymentType === '1' || $paymentType === '2' || $paymentType === 1 || $paymentType === 2)) {
            // Active Admin Cash / Admin Bank fallback
            $activeDate = (!empty($row['created_at']) && $row['created_at'] !== '0000-00-00 00:00:00') ? $row['created_at'] : (!empty($row['post_addon']) ? $row['post_addon'] : '');
            if (!empty($activeDate)) {
                $aTs = strtotime($activeDate);
                if ($aTs !== false && $aTs > 0) {
                    $aTime = date('H:i:s', $aTs);
                    if ($aTime !== '00:00:00' && $aTime !== '05:30:00') {
                        $paymentConfirmedDate = date('d-M-Y h:i A', $aTs);
                    } else {
                        $paymentConfirmedDate = date('d-M-Y', $aTs);
                    }
                }
            }
        }
    }
    
    // Determine payment status display (matching create_post.php logic)
    if ($isFreeRegistration) {
        $paymentStatus = "Free Registration<br><span class='badge bg-info mt-2'>Free</span>";
    } elseif ($isOnlinePaid) {
        $txText = !empty($paidTransactionID) ? " (Transaction ID: $paidTransactionID)" : "";
        $paymentStatus = "Online Payment$txText<br><span class='badge bg-success mt-2'>Paid</span>";
        if ($paymentConfirmedDate !== '-') {
            $paymentStatus .= "<br><small>Confirmed on: $paymentConfirmedDate</small>";
        }
    } elseif ($paymentType == '1') {
        if ($status == 1) {
            $paymentStatus = "Admin Cash<br><span class='badge bg-success mt-2'>Paid</span>";
            if ($paymentConfirmedDate !== '-') {
                $paymentStatus .= "<br><small>Confirmed on: $paymentConfirmedDate</small>";
            }
        } else {
            $paymentStatus = "Admin Cash<br><span class='badge bg-warning mt-2'>Pending</span>";
            $paymentConfirmedDate = '-';
        }
    } elseif ($paymentType == '2') {
        $refText = !empty($refNo) ? " (Ref No: $refNo)" : "";
        if ($status == 1) {
            $paymentStatus = "Admin Bank + Transaction$refText<br><span class='badge bg-success mt-2'>Paid</span>";
            if ($paymentConfirmedDate !== '-') {
                $paymentStatus .= "<br><small>Confirmed on: $paymentConfirmedDate</small>";
            }
        } else {
            $paymentStatus = "Admin Bank$refText<br><span class='badge bg-warning mt-2'>Pending</span>";
            $paymentConfirmedDate = '-';
        }
    } elseif (!empty($utrNumber) || $paymentType == '3') {
        $uDateFormatted = (!empty($utrDate) && $utrDate !== '0000-00-00') ? date('d-M-Y', strtotime($utrDate)) : (!empty($utrDate) ? $utrDate : '-');
        if ($status == 1) {
            $paymentStatus = "UTR No: $utrNumber<br>UTR Date: $uDateFormatted<br><span class='badge bg-success mt-2'>Payment Confirmed</span>";
            if ($paymentConfirmedDate !== '-') {
                $paymentStatus .= "<br><small>Confirmed on: $paymentConfirmedDate</small>";
            }
        } else {
            $paymentStatus = "UTR No: $utrNumber<br>UTR Date: $uDateFormatted<br><button class='btn btn-success btn-sm mt-2' onclick='updatePaymentStatus(" . $row['post_id'] . ")'>Confirm Payment</button>";
            $paymentStatus .= "<br><button class='btn btn-warning btn-sm mt-1' onclick='updateUTRNumber(" . $row['post_id'] . ", \"" . $utrNumber . "\", \"" . $utrDate . "\")'>Update UTR</button>";
            $paymentStatus .= "<br><button class='btn btn-danger btn-sm mt-1' onclick='clearUTRNumber(" . $row['post_id'] . ")'>Clear UTR</button>";
            $paymentConfirmedDate = '-';
        }
    } else {
        $paymentStatus = "Payment Pending<br><span class='badge bg-warning mt-2'>Pending</span>";
        $paymentConfirmedDate = '-';
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
    if (!empty($row['created_at']) && $row['created_at'] !== '0000-00-00 00:00:00') {
        $c_time = date('H:i:s', strtotime($row['created_at']));
        $c_format = ($c_time === '00:00:00' || $c_time === '05:30:00') ? 'd-m-Y' : 'd-m-Y h:i A';
        $createDate = date($c_format, strtotime($row['created_at']));
    } elseif (!empty($row['post_addon'])) {
        $createDate = date('d-m-Y', strtotime($row['post_addon']));
    } else {
        $createDate = '';
    }
    
    // Vehicle photo
    $vehiclePhoto = '<img src="../../photos/vehicle/' . $row['vehicle_photo'] . '" style="width: 128px; height: 129px;">';
    
    // Action buttons
    $safeDriverName = htmlspecialchars($row['driver_name'] ?? '', ENT_QUOTES, 'UTF-8');
    $safePhone = htmlspecialchars($row['phone_no'] ?? '', ENT_QUOTES, 'UTF-8');
    $safeVehicleNo = htmlspecialchars($row['vehicle_no'] ?? '', ENT_QUOTES, 'UTF-8');
    $customerId = (int)($row['customer_id'] ?? 0);

    $actionButtons = '<a href="edit_create_post.php?pid=' . $row['post_id'] . '" class="btn btn-primary" title="Edit"><i class="fas fa-pencil-alt"></i></a> ';
    $actionButtons .= '<a style="color:white" data-toggle="modal" data-target="#exampleModaldelete" onclick="deletepost(' . $row['post_id'] . ')" class="btn btn-danger" title="Delete"><i class="fas fa-trash"></i></a> ';
    $actionButtons .= '<button type="button" class="btn btn-warning" title="Send Message to this Driver" onclick="openSingleDriverMessage(' . $customerId . ', \'' . addslashes($safeDriverName) . '\', \'' . addslashes($safePhone) . '\', \'' . addslashes($safeVehicleNo) . '\', ' . $row['post_id'] . ')"><i class="fas fa-comment-dots"></i></button>';
    
    // Checkbox column with S.No
    $sNoHtml = '<div class="d-flex align-items-center justify-content-center">';
    $sNoHtml .= '<input type="checkbox" class="driver-checkbox mr-2" value="' . $customerId . '" data-customer-id="' . $customerId . '" data-driver-name="' . $safeDriverName . '" data-phone="' . $safePhone . '" data-vehicle-no="' . $safeVehicleNo . '" data-post-id="' . $row['post_id'] . '" style="width: 17px; height: 17px; cursor: pointer;">';
    $sNoHtml .= '<span>' . $rowNum . '</span>';
    $sNoHtml .= '</div>';

    $data[] = array(
        $sNoHtml,
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
        $paymentConfirmedDate,
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

