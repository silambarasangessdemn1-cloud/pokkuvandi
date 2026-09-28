<?php
include('config/setup.php');
date_default_timezone_set("Asia/Calcutta");
// Get the post_id and other info


$raw = file_get_contents("php://input");
// Decode base64 JSON inside 'response'
$outer = json_decode($raw, true);
$decoded = base64_decode($outer['response']);
$data = json_decode($decoded, true); // This is the final usable array

// Optional: Log the decoded data too
file_put_contents("callback_log.txt", date("Y-m-d H:i:s") . " [Decoded]\n" . $decoded . "\n\n", FILE_APPEND);


// Check if the structure is valid
if (isset($data['code']) && $data['code'] === 'PAYMENT_SUCCESS' && isset($data['data'])) {
    $merchantTransactionId = $data['data']['merchantTransactionId'];
    $transactionId = $data['data']['transactionId'];
    $amount = $data['data']['amount'] / 100; // convert from paise to rupees
} else {
    http_response_code(400);
    echo json_encode(['status' => 'invalid payload']);
    exit;
}

$get_post = mysqli_query($config, "SELECT * FROM create_post WHERE payment_transaction_id = '$merchantTransactionId' LIMIT 1");
if (mysqli_num_rows($get_post) == 0) {
    http_response_code(404);
    echo json_encode(['status' => 'order not found']);
    exit;
}

$post_data = mysqli_fetch_assoc($get_post);
$post_id = $post_data['post_id'];
// Now you can update DB, insert into transaction, etc.

    // Get post and customer info from DB
     $post = mysqli_query($config, "SELECT * FROM create_post WHERE post_id = '$post_id' LIMIT 1");
    if (mysqli_num_rows($post) == 0) {
        header("Location: paymentfailed.php");
        exit;
    }

    $post_data = mysqli_fetch_assoc($post);
    mysqli_query($config, "
    UPDATE create_post SET
        
        status = '1'
    WHERE post_id = '$post_id'
");
    // Extract necessary values
    $package_amount = $post_data['package_amount'];
    $net_amount = $post_data['net_amount'];
    $customer_id = $post_data['customer_id'];
    $driver_name = $post_data['driver_name'];
    $create_on = $post_data['create_on'];

    $amount = ($net_amount != '') ? $net_amount : $package_amount;

    // Save transaction
    $insertTransaction = mysqli_query($config, "
        INSERT INTO online_payment_transcation (
            merchantUserId, merchantTransactionId, Order_Paid_Status,
            Order_id, Customer_id, Customer_Name, Paid_on,
            Payment_Gateway, Paid_Amout, transactionId
        )
        VALUES (
            '', '$merchantTransactionId', 'success',
            '$post_id', '$customer_id', '$driver_name', '$create_on',
            'Phonepay', '$amount', '$transactionId'
        )
    ");
    mysqli_query($config, "
    UPDATE create_post SET
        
        status = '1'
    WHERE post_id = '$post_id'
");
    // If expired, extend & add to renewal
    $today = date('Y-m-d');
    $expiry_date = $post_data['expiry_date'];
    $package_days = $post_data['package_days'];

    if ($today >= $expiry_date) {
        $new_expiry_date = date('Y-m-d', strtotime("+$package_days days"));

        // Update create_post expiry
        mysqli_query($config, "
            UPDATE create_post SET
                expiry_date = '$new_expiry_date',
                renewal_post = '1'
                
            WHERE post_id = '$post_id'
        ");

        // Add to renewal_list
        mysqli_query($config, "
            INSERT INTO renewal_list (
                post_id, re_package_id, re_package_amount,
                re_package_days, re_expiry_date, re_net_amount,
                re_coupon_type, re_discount_amount, re_discount_name,
                re_date, re_customer_id
            ) VALUES (
                '{$post_data['post_id']}', '{$post_data['package_id']}', '$package_amount',
                '$package_days', '$new_expiry_date', '$net_amount',
                '{$post_data['coupon_type']}', '{$post_data['discount_amount']}', '{$post_data['discount_name']}',
                '$today', '$customer_id'
            )
        ");
    }

    // Redirect to success
    header("Location: successful.php?session_id=$customer_id");
    exit;


?>
