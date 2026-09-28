<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 0); // Don't display errors to users, log them instead
ini_set('log_errors', 1);

include('config/setup.php');
date_default_timezone_set("Asia/Calcutta");
require('razorpay-php/Razorpay.php'); // Include Razorpay SDK

use Razorpay\Api\Api;

// Razorpay API credentials
$keyId = 'rzp_live_qMFkGa6UVcPEWO';      // Replace with your Razorpay key
$keySecret = 'oHEqONglRxiwzrbeNnxByUxh';       // Replace with your Razorpay secret

$api = new Api($keyId, $keySecret);

// Log for debugging
file_put_contents("razorpay_debug_log.txt", 
    "===== GET =====\n" . json_encode($_GET, JSON_PRETTY_PRINT) . "\n\n", 
FILE_APPEND);

// Function to log errors
function logError($message, $config = null) {
    $errorMsg = date('Y-m-d H:i:s') . " - ERROR: " . $message;
    if ($config) {
        $errorMsg .= " | MySQL Error: " . mysqli_error($config);
    }
    $errorMsg .= "\n";
    file_put_contents("razorpay_debug_log.txt", $errorMsg, FILE_APPEND);
    error_log($errorMsg);
}


if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    if (isset($_GET['razorpay_payment_id'])) {
        $razorpay_payment_id = $_GET['razorpay_payment_id'];
    } else {
        $razorpay_payment_id = '';
    }
    if (isset($_GET['razorpay_order_id'])) {
        $razorpay_order_id = $_GET['razorpay_order_id'];
    } else {
        $razorpay_order_id = '';
    }
    if (isset($_GET['razorpay_signature'])) {
        $razorpay_signature = $_GET['razorpay_signature'];
    } else {
        $razorpay_signature = '';
    }
    if (isset($_GET['post_id'])) {
        $post_id = $_GET['post_id'];
    } else {
        $post_id = '';
    }

    // Signature verification
    $attributes = [
        'razorpay_order_id' => $razorpay_order_id,
        'razorpay_payment_id' => $razorpay_payment_id,
        'razorpay_signature' => $razorpay_signature
    ];
   
    try {
        $api->utility->verifyPaymentSignature($attributes); // Will throw error if invalid
        
        // ✅ Verify payment status directly from Razorpay API (fallback verification)
        try {
            $payment = $api->payment->fetch($razorpay_payment_id);
            if (isset($payment['status'])) {
                $payment_status = $payment['status'];
            } else {
                $payment_status = '';
            }
            
            // Log payment verification
            file_put_contents("razorpay_debug_log.txt", 
                "✅ Payment verified from API: $razorpay_payment_id, Status: $payment_status\n", 
                FILE_APPEND);
            
            // If payment is not captured, redirect to failed page
            if ($payment_status !== 'captured' && $payment_status !== 'authorized') {
                file_put_contents("razorpay_debug_log.txt", 
                    "❌ Payment not captured: $razorpay_payment_id, Status: $payment_status\n", 
                    FILE_APPEND);
                header("Location: paymentfailed.php");
                exit;
            }
        } catch (Exception $e) {
            // If API verification fails, log but continue with signature verification
            file_put_contents("razorpay_debug_log.txt", 
                "⚠️ API verification failed, continuing with signature: " . $e->getMessage() . "\n", 
                FILE_APPEND);
        }

        // ✅ Fetch post details
        $post = mysqli_query($config, "SELECT * FROM create_post WHERE post_id = '$post_id' LIMIT 1");
        if (mysqli_num_rows($post) == 0) {
            header("Location: paymentfailed.php");
            exit;
        }

        $post_data = mysqli_fetch_assoc($post);
        $package_amount = $post_data['package_amount'];
        $net_amount = $post_data['net_amount'];
        if ($net_amount != '') {
            $amount = $net_amount;
        } else {
            $amount = $package_amount;
        }

        $customer_id = $post_data['customer_id'];
        $driver_name = $post_data['driver_name'];
        $payment_date = date('Y-m-d'); // Payment date (current date)
        $merchantTransactionId = $razorpay_order_id;
        
        // Start transaction for data consistency
        mysqli_begin_transaction($config);
       
        try {
            $exists = mysqli_query($config, "SELECT Online_order_id FROM online_payment_transcation WHERE transactionId = '$razorpay_payment_id'");
           
            if (mysqli_num_rows($exists) == 0) {
                // 🔁 Save Transaction with payment date
                $insert_result = mysqli_query($config, "
                    INSERT INTO online_payment_transcation (
                        merchantUserId, merchantTransactionId, Order_Paid_Status,
                        Order_id, Customer_id, Customer_Name, Paid_on,
                        Payment_Gateway, Paid_Amout, transactionId
                    )
                    VALUES (
                        '', '$merchantTransactionId', 'success',
                        '$post_id', '$customer_id', '$driver_name', '$payment_date',
                        'Razorpay', '$amount', '$razorpay_payment_id'
                    )
                ");
               
                if (!$insert_result) {
                    throw new Exception("Failed to insert transaction: " . mysqli_error($config));
                }
                 
                file_put_contents("razorpay_debug_log.txt", 
                    "✅ Transaction inserted: $razorpay_payment_id for post_id: $post_id\n", 
                    FILE_APPEND);
            } else {
                file_put_contents("razorpay_debug_log.txt", 
                    "ℹ️ Transaction already exists: $razorpay_payment_id\n", 
                    FILE_APPEND);
            }
            // ✅ Get payment date (current date - package starts from payment date)
            if (isset($post_data['package_days'])) {
                $package_days = $post_data['package_days'];
            } else {
                $package_days = 0;
            }
            
            // Validate package_days
            if (empty($package_days) || !is_numeric($package_days) || $package_days <= 0) {
                logError("Invalid package_days: $package_days for post_id: $post_id", $config);
                $package_days = 365; // Default to 1 year if invalid
            }
            
            // 🗓 Calculate expiry_date from payment date (not registration date)
            $new_expiry_date = date('Y-m-d', strtotime("$payment_date +$package_days days"));
            
            // Validate calculated expiry date
            if ($new_expiry_date == '1970-01-01' || empty($new_expiry_date)) {
                logError("Invalid expiry_date calculated: $new_expiry_date for post_id: $post_id, package_days: $package_days", $config);
                $new_expiry_date = date('Y-m-d', strtotime("$payment_date +365 days")); // Default to 1 year
            }
            
            // Check if this is a renewal (existing post with expiry date)
            $existing_expiry = $post_data['expiry_date'];
            $is_renewal = 0;
            if (!empty($existing_expiry) && $payment_date < $existing_expiry) {
                $is_renewal = 1;
            }
            
            // ✅ Set payment confirmed timestamp
            $payment_confirmed_at = date('Y-m-d H:i:s');
            
            // ✅ Escape all variables for SQL safety
            $post_id_escaped = mysqli_real_escape_string($config, $post_id);
            $payment_confirmed_at_escaped = mysqli_real_escape_string($config, $payment_confirmed_at);
            $new_expiry_date_escaped = mysqli_real_escape_string($config, $new_expiry_date);
            $is_renewal_escaped = mysqli_real_escape_string($config, $is_renewal);
            
            // ✅ Validate variables before UPDATE
            if (empty($post_id_escaped)) {
                throw new Exception("Post ID is empty");
            }
            if (empty($new_expiry_date_escaped) || $new_expiry_date_escaped == '1970-01-01') {
                logError("Invalid expiry date calculated: $new_expiry_date for post_id: $post_id", $config);
                // Use a default expiry date if calculation failed
                $new_expiry_date_escaped = date('Y-m-d', strtotime('+365 days'));
            }
            
            // ✅ Log before UPDATE
            file_put_contents("razorpay_debug_log.txt", 
                "🔄 Attempting UPDATE: post_id=$post_id_escaped, status=1, payment_type=0, payment_confirmed_at=$payment_confirmed_at_escaped, expiry_date=$new_expiry_date_escaped, renewal_post=$is_renewal_escaped\n", 
                FILE_APPEND);
         
            // ✅ CRITICAL: Update post status, payment_type, payment_confirmed_at and expiry_date
            // This MUST happen to mark vehicle registration as completed
            $update_query = "UPDATE create_post SET
                status = '1',
                payment_type = '0',
                payment_confirmed_at = '$payment_confirmed_at_escaped',
                expiry_date = '$new_expiry_date_escaped',
                renewal_post = '$is_renewal_escaped'
                WHERE post_id = '$post_id_escaped'";
            
            // Log the actual query
            file_put_contents("razorpay_debug_log.txt", 
                "📝 UPDATE Query: $update_query\n", 
                FILE_APPEND);
            
            $update_result = mysqli_query($config, $update_query);
            
            if (!$update_result) {
                $mysql_error = mysqli_error($config);
                $mysql_errno = mysqli_errno($config);
                logError("UPDATE query failed for post_id: $post_id_escaped | Error: $mysql_error | Errno: $mysql_errno", $config);
                throw new Exception("Failed to update post: $mysql_error (Error Code: $mysql_errno)");
            }
            
            $affected_rows = mysqli_affected_rows($config);
            file_put_contents("razorpay_debug_log.txt", 
                "✅ Post updated successfully: post_id=$post_id_escaped, status=1, payment_type=0, payment_confirmed_at=$payment_confirmed_at_escaped, expiry_date=$new_expiry_date_escaped, affected_rows=$affected_rows\n", 
                FILE_APPEND);
                
            // If it's a renewal, add to renewal_list
            if ($is_renewal) {
                // Escape variables for SQL safety
                $post_id_escaped_renewal = mysqli_real_escape_string($config, $post_id);
                $payment_date_escaped = mysqli_real_escape_string($config, $payment_date);
                
                // Check if renewal_list table exists
                $table_check = mysqli_query($config, "SHOW TABLES LIKE 'renewal_list'");
                if (mysqli_num_rows($table_check) == 0) {
                    logError("renewal_list table does not exist in database", $config);
                    file_put_contents("razorpay_debug_log.txt", 
                        "⚠️ renewal_list table not found - skipping renewal insert\n", 
                        FILE_APPEND);
                } else {
                    // Table exists, proceed with renewal check
                    $renewal_check = mysqli_query($config, "
                        SELECT id FROM renewal_list 
                        WHERE post_id = '$post_id_escaped_renewal' AND re_date = '$payment_date_escaped'
                        LIMIT 1
                    ");
                
                    // Check if query succeeded before using mysqli_num_rows
                    if ($renewal_check === false) {
                        $mysql_error = mysqli_error($config);
                        $mysql_errno = mysqli_errno($config);
                        logError("Renewal check query failed for post_id: $post_id_escaped_renewal | Error: $mysql_error | Errno: $mysql_errno", $config);
                        // Continue execution even if renewal check fails
                    } elseif (mysqli_num_rows($renewal_check) == 0) {
                        // Escape all variables for INSERT query
                        $renewal_post_id = mysqli_real_escape_string($config, $post_data['post_id']);
                        if (isset($post_data['package_id'])) {
                            $renewal_package_id = mysqli_real_escape_string($config, $post_data['package_id']);
                        } else {
                            $renewal_package_id = '';
                        }
                        $renewal_package_amount = mysqli_real_escape_string($config, $package_amount);
                        $renewal_package_days = mysqli_real_escape_string($config, $package_days);
                        $renewal_expiry_date = mysqli_real_escape_string($config, $new_expiry_date);
                        $renewal_net_amount = mysqli_real_escape_string($config, $net_amount);
                        if (isset($post_data['coupon_type'])) {
                            $renewal_coupon_type = mysqli_real_escape_string($config, $post_data['coupon_type']);
                        } else {
                            $renewal_coupon_type = '';
                        }
                        if (isset($post_data['discount_amount'])) {
                            $renewal_discount_amount = mysqli_real_escape_string($config, $post_data['discount_amount']);
                        } else {
                            $renewal_discount_amount = '';
                        }
                        if (isset($post_data['discount_name'])) {
                            $renewal_discount_name = mysqli_real_escape_string($config, $post_data['discount_name']);
                        } else {
                            $renewal_discount_name = '';
                        }
                        $renewal_payment_date = mysqli_real_escape_string($config, $payment_date);
                        $renewal_customer_id = mysqli_real_escape_string($config, $customer_id);
                        
                        $renewal_insert_query = "
                            INSERT INTO renewal_list (
                                post_id, re_package_id, re_package_amount,
                                re_package_days, re_expiry_date, re_net_amount,
                                re_coupon_type, re_discount_amount, re_discount_name,
                                re_date, re_customer_id
                            ) VALUES (
                                '$renewal_post_id', '$renewal_package_id', '$renewal_package_amount',
                                '$renewal_package_days', '$renewal_expiry_date', '$renewal_net_amount',
                                '$renewal_coupon_type', '$renewal_discount_amount', '$renewal_discount_name',
                                '$renewal_payment_date', '$renewal_customer_id'
                            )
                        ";
                        
                        file_put_contents("razorpay_debug_log.txt", 
                            "🔄 Attempting renewal INSERT for post_id: $renewal_post_id\n", 
                            FILE_APPEND);
                        
                        $renewal_result = mysqli_query($config, $renewal_insert_query);
                        
                        if (!$renewal_result) {
                            $mysql_error = mysqli_error($config);
                            $mysql_errno = mysqli_errno($config);
                            logError("Failed to insert renewal for post_id: $renewal_post_id | Error: $mysql_error | Errno: $mysql_errno", $config);
                            // Don't throw exception - log error but continue (renewal is optional)
                            file_put_contents("razorpay_debug_log.txt", 
                                "⚠️ Renewal insert failed but continuing: $mysql_error\n", 
                                FILE_APPEND);
                        } else {
                            file_put_contents("razorpay_debug_log.txt", 
                                "✅ Renewal inserted successfully for post_id: $renewal_post_id\n", 
                                FILE_APPEND);
                        }
                    } else {
                        file_put_contents("razorpay_debug_log.txt", 
                            "ℹ️ Renewal already exists for post_id: $post_id_escaped_renewal on date: $payment_date_escaped\n", 
                            FILE_APPEND);
                    }
                }
            }
            
            // Commit transaction
            mysqli_commit($config);
            file_put_contents("razorpay_debug_log.txt", 
                "✅ Transaction committed successfully for payment: $razorpay_payment_id\n", 
                FILE_APPEND);
            
        } catch (Exception $e) {
            // Rollback transaction on error
            mysqli_rollback($config);
            $error_message = $e->getMessage();
            $error_trace = $e->getTraceAsString();
            logError("Transaction rolled back: $error_message", $config);
            file_put_contents("razorpay_debug_log.txt", 
                "❌ Transaction rolled back: $error_message\n" .
                "Stack Trace:\n$error_trace\n\n", 
                FILE_APPEND);
            header("Location: paymentfailed.php");
            exit;
        } catch (Error $e) {
            // Catch PHP 7+ errors (fatal errors, etc.)
            mysqli_rollback($config);
            $error_message = $e->getMessage();
            $error_trace = $e->getTraceAsString();
            logError("PHP Error caught: $error_message", $config);
            file_put_contents("razorpay_debug_log.txt", 
                "❌ PHP Error: $error_message\n" .
                "Stack Trace:\n$error_trace\n\n", 
                FILE_APPEND);
            header("Location: paymentfailed.php");
            exit;
        }
        
        // 🎉 Redirect to success page
        header("Location: successful.php?session_id=$customer_id");
        exit;

    } catch (\Razorpay\Api\Errors\SignatureVerificationError $e) {
       // Log error
       $error_msg = $e->getMessage();
       logError("Signature verification error: $error_msg", $config);
       file_put_contents("razorpay_debug_log.txt", 
       "❌ Signature error: $error_msg\n", 
       FILE_APPEND);
        header("Location: create_post.php");
        exit;
    } catch (Exception $e) {
        // Catch any other exceptions
        $error_msg = $e->getMessage();
        logError("General exception: $error_msg", $config);
        file_put_contents("razorpay_debug_log.txt", 
            "❌ General exception: $error_msg\n" . $e->getTraceAsString() . "\n", 
            FILE_APPEND);
        header("Location: paymentfailed.php");
        exit;
    } catch (Error $e) {
        // Catch PHP 7+ fatal errors
        $error_msg = $e->getMessage();
        logError("PHP Fatal Error: $error_msg", $config);
        file_put_contents("razorpay_debug_log.txt", 
            "❌ PHP Fatal Error: $error_msg\n" . $e->getTraceAsString() . "\n", 
            FILE_APPEND);
        header("Location: paymentfailed.php");
        exit;
    }
} else {
    file_put_contents("razorpay_debug_log.txt", "===== POST =====\n" . json_encode($_POST, JSON_PRETTY_PRINT) . "\n\n", FILE_APPEND);

    header("Location: create_post.php");
    exit;
}
?>
