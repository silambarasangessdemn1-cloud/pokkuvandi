<?php
include('config/setup.php');
date_default_timezone_set("Asia/Calcutta");

if ($_POST['code'] == 'PAYMENT_SUCCESS') {

    // Sanitize
    $post_id = $_GET['Add_postid'];
    $transactionId = $_POST['transactionId'];
    $merchantTransactionId = $_GET['merchantTransactionId'];

    // Get post and customer info from DB
    $post = mysqli_query($config, "SELECT * FROM create_post WHERE post_id = '$post_id' LIMIT 1");
    if (mysqli_num_rows($post) == 0) {
        header("Location: paymentfailed.php");
        exit;
    }

    $post_data = mysqli_fetch_assoc($post);

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

} else {
    header('Location: paymentfailed.php');
    exit;
}
?>
