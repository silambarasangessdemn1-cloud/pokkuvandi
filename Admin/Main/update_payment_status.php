<?php
// Database connection
include('../config/setup.php'); // Make sure $config is your mysqli connection
date_default_timezone_set("Asia/Kolkata");

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Only POST method allowed']);
    exit;
}

$postId = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
$action = isset($_POST['action']) ? $_POST['action'] : null;

if ($postId <= 0 || !$action) {
    echo json_encode(['success' => false, 'message' => 'Missing required parameters']);
    exit;
}

try {
    // Fetch post details to get package_days
    $post_query = mysqli_query($config, "SELECT * FROM create_post WHERE post_id = '$postId' LIMIT 1");
    if (mysqli_num_rows($post_query) == 0) {
        echo json_encode(['success' => false, 'message' => 'Post not found']);
        exit;
    }
    
    $post_data = mysqli_fetch_assoc($post_query);
    $package_days = $post_data['package_days'];
    
    if ($action === 'confirm_payment') {
        // ✅ Confirm Payment (Bank Payment with reference number)
        $reference_number = isset($_POST['reference_number']) ? mysqli_real_escape_string($config, trim($_POST['reference_number'])) : '';
        
        // ✅ Get payment date (current date - package starts from payment date)
        $payment_date = date('Y-m-d');
        
        // 🗓 Calculate expiry_date from payment date (not registration date)
        $new_expiry_date = date('Y-m-d', strtotime("$payment_date +$package_days days"));
        
        // Check if this is a renewal
        $existing_expiry = $post_data['expiry_date'];
        $is_renewal = (!empty($existing_expiry) && $payment_date < $existing_expiry) ? 1 : 0;
        
        // Update post status and expiry_date from payment date
        $update_sql = "UPDATE create_post SET 
                        status = '1',
                        expiry_date = '$new_expiry_date',
                        renewal_post = '$is_renewal',
                        payment_confirmed_at = NOW()";
        
        if (!empty($reference_number)) {
            $update_sql .= ", ref_no = '$reference_number'";
        }
        
        $update_sql .= " WHERE post_id = '$postId'";
        
        $result = mysqli_query($config, $update_sql);
        
        if ($result) {
            // If renewal, add to renewal_list
            if ($is_renewal) {
                $package_amount = $post_data['package_amount'];
                $net_amount = $post_data['net_amount'] ? $post_data['net_amount'] : $package_amount;
                $customer_id = $post_data['customer_id'];
                
                mysqli_query($config, "
                    INSERT INTO renewal_list (
                        post_id, re_package_id, re_package_amount,
                        re_package_days, re_expiry_date, re_net_amount,
                        re_coupon_type, re_discount_amount, re_discount_name,
                        re_date, re_customer_id
                    ) VALUES (
                        '$postId', '{$post_data['package_id']}', '$package_amount',
                        '$package_days', '$new_expiry_date', '$net_amount',
                        '{$post_data['coupon_type']}', '{$post_data['discount_amount']}', '{$post_data['discount_name']}',
                        '$payment_date', '$customer_id'
                    )
                ");
            }
            
            echo json_encode(['success' => true, 'message' => 'Payment confirmed successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to confirm payment: ' . mysqli_error($config)]);
        }

    } elseif ($action === 'update_utr') {
        // ✅ Update UTR Number and Date (QR Code Payment)
        $utrNumber = isset($_POST['utr_number']) ? mysqli_real_escape_string($config, trim($_POST['utr_number'])) : '';
        $utrDate   = isset($_POST['utr_date']) ? mysqli_real_escape_string($config, trim($_POST['utr_date'])) : date('Y-m-d');

        if (empty($utrNumber) || empty($utrDate)) {
            echo json_encode(['success' => false, 'message' => 'UTR number and date are required']);
            exit;
        }

        // ✅ Get payment date (from UTR date or current date)
        $payment_date = !empty($utrDate) ? $utrDate : date('Y-m-d');
        
        // 🗓 Calculate expiry_date from payment date (not registration date)
        $new_expiry_date = date('Y-m-d', strtotime("$payment_date +$package_days days"));
        
        // Check if this is a renewal
        $existing_expiry = $post_data['expiry_date'];
        $is_renewal = (!empty($existing_expiry) && $payment_date < $existing_expiry) ? 1 : 0;
        
        // Update post with UTR, status, and expiry_date from payment date
        $update_sql = "UPDATE create_post SET 
                        utr_number = '$utrNumber',
                        utr_date = '$utrDate',
                        status = '1',
                        expiry_date = '$new_expiry_date',
                        renewal_post = '$is_renewal',
                        show_again_payment = 0
                      WHERE post_id = '$postId'";
        
        $result = mysqli_query($config, $update_sql);
        
        if ($result) {
            // If renewal, add to renewal_list
            if ($is_renewal) {
                $package_amount = $post_data['package_amount'];
                $net_amount = $post_data['net_amount'] ? $post_data['net_amount'] : $package_amount;
                $customer_id = $post_data['customer_id'];
                
                mysqli_query($config, "
                    INSERT INTO renewal_list (
                        post_id, re_package_id, re_package_amount,
                        re_package_days, re_expiry_date, re_net_amount,
                        re_coupon_type, re_discount_amount, re_discount_name,
                        re_date, re_customer_id
                    ) VALUES (
                        '$postId', '{$post_data['package_id']}', '$package_amount',
                        '$package_days', '$new_expiry_date', '$net_amount',
                        '{$post_data['coupon_type']}', '{$post_data['discount_amount']}', '{$post_data['discount_name']}',
                        '$payment_date', '$customer_id'
                    )
                ");
            }
            
            echo json_encode(['success' => true, 'message' => 'UTR details updated successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update UTR details: ' . mysqli_error($config)]);
        }

    } elseif ($action === 'show_again_payment') {
        // ✅ Show payment again
        $sql = "UPDATE create_post 
                SET show_again_payment = 1 
                WHERE post_id = '$postId'";
        $result = mysqli_query($config, $sql);

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Payment option will be shown again to customer']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update payment status']);
        }

    } elseif ($action === 'clear_utr') {
        // ✅ Clear UTR Number and Date (set to NULL) and reset expiry_date
        $sql = "UPDATE create_post 
                SET utr_number = NULL, 
                    utr_date = NULL,
                    status = '0',
                    expiry_date = NULL,
                    payment_confirmed_at = NULL,
                    show_again_payment = 0
                WHERE post_id = '$postId'";
        $result = mysqli_query($config, $sql);

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'UTR Number and Date cleared successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to clear UTR details: ' . mysqli_error($config)]);
        }

    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
    }

} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
