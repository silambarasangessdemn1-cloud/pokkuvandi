<?php

include('config/setup.php');
require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$keySecret = 'oHEqONglRxiwzrbeNnxByUxh';

$webhookBody = file_get_contents('php://input');
if (isset($_SERVER['HTTP_X_RAZORPAY_SIGNATURE'])) {
    $webhookSignature = $_SERVER['HTTP_X_RAZORPAY_SIGNATURE'];
} else {
    $webhookSignature = '';
}
file_put_contents("razorpay_webhook_log.txt", "===== Webhook Received =====\n" . $webhookBody . "\nSignature: $webhookSignature\n\n", FILE_APPEND);

// ✅ First decode
$data = json_decode($webhookBody, true);
if (isset($data['event'])) {
    $event = $data['event'];
} else {
    $event = '';
}
if (isset($data['payload']['payment']['entity'])) {
    $entity = $data['payload']['payment']['entity'];
} else {
    $entity = array();
}

if (isset($entity['id'])) {
    $payment_id = $entity['id'];
} else {
    $payment_id = '';
}
if (isset($entity['order_id'])) {
    $order_id = $entity['order_id'];
} else {
    $order_id = '';
}
if (isset($entity['status'])) {
    $status = $entity['status'];
} else {
    $status = '';
}


// ✅ Now continue with database logic
$res = mysqli_query($config, "SELECT * FROM create_post WHERE razorpay_order_id = '$order_id' LIMIT 1");
if (mysqli_num_rows($res) == 0) {
    file_put_contents("razorpay_webhook_log.txt", "❌ No post found for order_id: $order_id\n", FILE_APPEND);
    http_response_code(200);
    exit;
}

$post = mysqli_fetch_assoc($res);
$post_id = $post['post_id'];
$customer_id = $post['customer_id'];
$driver_name = $post['driver_name'];
$package_amount = $post['package_amount'];
$net_amount = $post['net_amount'];
if (!empty($net_amount)) {
    $amount = $net_amount;
} else {
    $amount = $package_amount;
}

if (in_array($event, ['payment.authorized', 'payment.captured', 'order.paid'])) {

    // Start transaction for data consistency
    mysqli_begin_transaction($config);
    
    try {
        // ✅ Set payment confirmed timestamp
        $payment_confirmed_at = date('Y-m-d H:i:s');
        
        // ✅ CRITICAL: Update post status, payment_type and payment_confirmed_at
        // This MUST happen to mark vehicle registration as completed
        $update = mysqli_query($config, "
            UPDATE create_post SET 
                status = '1',
                payment_type = '0',
                payment_confirmed_at = '$payment_confirmed_at'
            WHERE post_id = '$post_id'
        ");
        if (!$update) {
            throw new Exception("Post update error: " . mysqli_error($config));
        }
        file_put_contents("razorpay_webhook_log.txt", "✅ Post updated: post_id=$post_id, status=1, payment_type=0, payment_confirmed_at=$payment_confirmed_at\n", FILE_APPEND);

        // ✅ Check if transaction already exists
        $exists = mysqli_query($config, "SELECT Online_order_id FROM online_payment_transcation WHERE transactionId = '$payment_id'");
      
        if (mysqli_num_rows($exists) == 0) {
            // Get payment date (current date)
            $payment_date = date('Y-m-d');
            
            // ✅ Insert transaction record
            $insert = mysqli_query($config, "
                INSERT INTO online_payment_transcation (
                    merchantUserId, merchantTransactionId, Order_Paid_Status,
                    Order_id, Customer_id, Customer_Name, Paid_on,
                    Payment_Gateway, Paid_Amout, transactionId
                ) VALUES (
                    '', '$order_id', 'success',
                    '$post_id', '$customer_id', '$driver_name', '$payment_date',
                    'Razorpay', '$amount', '$payment_id'
                )
            ");
            if (!$insert) {
                throw new Exception("Transaction insert error: " . mysqli_error($config));
            }
            file_put_contents("razorpay_webhook_log.txt", "✅ Transaction inserted: payment_id=$payment_id, post_id=$post_id\n", FILE_APPEND);
        } else {
            file_put_contents("razorpay_webhook_log.txt", "ℹ️ Transaction already exists: payment_id=$payment_id\n", FILE_APPEND);
        }
        
        // ✅ Update expiry date if needed
        $package_days = 0;
        if (isset($post['package_days']) && !empty($post['package_days'])) {
            $package_days = $post['package_days'];
        }
        if ($package_days > 0) {
            $payment_date = date('Y-m-d');
            $new_expiry_date = date('Y-m-d', strtotime("$payment_date +$package_days days"));
            
            // Update expiry date
            $expiry_update = mysqli_query($config, "
                UPDATE create_post SET 
                    expiry_date = '$new_expiry_date'
                WHERE post_id = '$post_id'
            ");
            
            if (!$expiry_update) {
                throw new Exception("Expiry date update error: " . mysqli_error($config));
            }
            file_put_contents("razorpay_webhook_log.txt", "✅ Expiry date updated: post_id=$post_id, expiry_date=$new_expiry_date\n", FILE_APPEND);
        }
        
        // Commit transaction
        mysqli_commit($config);
        file_put_contents("razorpay_webhook_log.txt", "✅ Webhook transaction committed successfully\n", FILE_APPEND);
        
    } catch (Exception $e) {
        // Rollback on error
        mysqli_rollback($config);
        file_put_contents("razorpay_webhook_log.txt", "❌ Webhook transaction rolled back: " . $e->getMessage() . "\n", FILE_APPEND);
    }

        // ✅ Handle renewal if expiry date has passed
        date_default_timezone_set("Asia/Kolkata"); 
        $today = date('Y-m-d');
        if (isset($post['expiry_date'])) {
            $existing_expiry = $post['expiry_date'];
        } else {
            $existing_expiry = '';
        }

        // Proceed only if expiry date is passed or empty
        if (empty($existing_expiry) || $today >= $existing_expiry) {
            $package_days = 0;
            if (isset($post['package_days']) && !empty($post['package_days'])) {
                $package_days = $post['package_days'];
            }
            
            if ($package_days > 0) {
                // ✅ Calculate new expiry date from payment date
                $new_expiry_date = date('Y-m-d', strtotime("$today +$package_days days"));
                file_put_contents("razorpay_webhook_log.txt", "✅ Renewal: new expiry date = $new_expiry_date\n", FILE_APPEND);

                // ✅ Update expiry in create_post
                $expiry_update = mysqli_query($config, "
                    UPDATE create_post SET 
                        expiry_date = '$new_expiry_date',
                        renewal_post = '1'
                    WHERE post_id = '$post_id'
                ");
                
                if (!$expiry_update) {
                    file_put_contents("razorpay_webhook_log.txt", "❌ Expiry update error: " . mysqli_error($config) . "\n", FILE_APPEND);
                }

                // ✅ Check if already inserted today
                $check = mysqli_query($config, "
                    SELECT id FROM renewal_list 
                    WHERE post_id = '$post_id' AND re_date = '$today'
                    LIMIT 1
                ");

                if (mysqli_num_rows($check) == 0) {
                    // Insert into renewal_list only if not already inserted
                    $renewal_insert = mysqli_query($config, "
                        INSERT INTO renewal_list (
                            post_id, re_package_id, re_package_amount,
                            re_package_days, re_expiry_date, re_net_amount,
                            re_coupon_type, re_discount_amount, re_discount_name,
                            re_date, re_customer_id
                        ) VALUES (
                            '$post_id', '{$post['package_id']}', '$package_amount',
                            '{$post['package_days']}', '$new_expiry_date', '$net_amount',
                            '{$post['coupon_type']}', '{$post['discount_amount']}', '{$post['discount_name']}',
                            '$today', '$customer_id'
                        )
                    ");
                    
                    if (!$renewal_insert) {
                        file_put_contents("razorpay_webhook_log.txt", "❌ Renewal list insert error: " . mysqli_error($config) . "\n", FILE_APPEND);
                    } else {
                        file_put_contents("razorpay_webhook_log.txt", "✅ Renewal list inserted for post_id=$post_id\n", FILE_APPEND);
                    }
                } else {
                    file_put_contents("razorpay_webhook_log.txt", "ℹ️ Skipped renewal_list insert: already exists for today ($today)\n", FILE_APPEND);
                }
            }
        }

}else{
    file_put_contents("razorpay_webhook_log.txt", "SELECT * FROM create_post WHERE razorpay_order_id = '$order_id' LIMIT 1  not commed " . "\n", FILE_APPEND);

}

http_response_code(200);
echo "Webhook processed";
