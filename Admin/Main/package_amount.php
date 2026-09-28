<?php include('../config/setup.php');

$id = isset($_POST['id']) ? $_POST['id'] : '';
$post_id = isset($_POST['post_id']) ? $_POST['post_id'] : '';

?>
<?php 

// Get package details
$shop_master_ = mysqli_query($config, "select * from category_package where package_id ='$id' and status=1");
$package_data = null;
if(mysqli_num_rows($shop_master_) > 0) {
   $package_data = mysqli_fetch_object($shop_master_);
}

if($package_data) {
   $package_valid = $package_data->package_valid;
   $package_amount = $package_data->package_amount;
   
   date_default_timezone_set('Asia/Kolkata'); 
   $Date = date("Y-m-d");
   $exp_date = date("Y-m-d", strtotime($Date . " +$package_valid days")); 
   
   // Get current post data if post_id is provided
   $current_post_data = null;
   if(!empty($post_id)) {
       $post_query = mysqli_query($config, "select * from create_post where post_id='$post_id'");
       if(mysqli_num_rows($post_query) > 0) {
           $current_post_data = mysqli_fetch_object($post_query);
           // Use existing package start date if available, otherwise use current date
           $payment_query = mysqli_query($config, "SELECT Paid_on FROM online_payment_transcation WHERE Order_id = '$post_id' LIMIT 1");
           if (mysqli_num_rows($payment_query) > 0) {
               $payment_data = mysqli_fetch_assoc($payment_query);
               if(!empty($payment_data['Paid_on'])) {
                   $Date = date('Y-m-d', strtotime($payment_data['Paid_on']));
               }
           } elseif (!empty($current_post_data->utr_date)) {
               $Date = date('Y-m-d', strtotime($current_post_data->utr_date));
           } elseif (!empty($current_post_data->expiry_date) && !empty($current_post_data->package_days)) {
               // Calculate from expiry_date - package_days
               $Date = date('Y-m-d', strtotime($current_post_data->expiry_date . ' -' . $current_post_data->package_days . ' days'));
           }
           $exp_date = date("Y-m-d", strtotime($Date . " +$package_valid days"));
       }
   }
   
   // Build JSON response for use on the same page (no HTML returned)
   // Discount fields
   $discount_name_val = '';
   $discount_amount_val = '';
   if($current_post_data) {
       $discount_name_val = $current_post_data->discount_name ?? '';
       $discount_amount_val = $current_post_data->discount_amount ?? '';
   }
   // Net amount
   $net_amount = $package_amount;
   if(!empty($discount_amount_val)) {
       $net_amount = $package_amount - floatval($discount_amount_val);
   }
   // Payment-related fields
   $paid_status_val = '';
   $paid_on_val = '';
   $utr_number_val = '';
   $utr_date_val = '';
   $ref_no_val = '';
   if($current_post_data) {
       $paid_status_val = $current_post_data->payment_type ?? '';
       $payment_query = mysqli_query($config, "SELECT Paid_on FROM online_payment_transcation WHERE Order_id = '$post_id' LIMIT 1");
       if (mysqli_num_rows($payment_query) > 0) {
           $payment_data = mysqli_fetch_assoc($payment_query);
           $paid_on_val = !empty($payment_data['Paid_on']) ? $payment_data['Paid_on'] : '';
       }
       if(empty($paid_on_val) && !empty($current_post_data->utr_date)) {
           $paid_on_val = $current_post_data->utr_date;
       }
       $utr_number_val = $current_post_data->utr_number ?? '';
       $utr_date_val = $current_post_data->utr_date ?? '';
       $ref_no_val = $current_post_data->ref_no ?? '';
   }

   $response = [
       'package_start_date' => $Date,
       'expiry_date'        => $exp_date,
       'package_amount'     => $package_amount,
       'package_days'       => $package_valid,
       'discount_name'      => $discount_name_val,
       'discount_amount'    => $discount_amount_val,
       'net_amount'         => $net_amount,
       'paid_status'        => $paid_status_val,
       'paid_on'            => $paid_on_val,
       'utr_number'         => $utr_number_val,
       'utr_date'           => $utr_date_val,
       'ref_no'             => $ref_no_val,
   ];

   header('Content-Type: application/json');
   echo json_encode($response);
} else {
   header('Content-Type: application/json', true, 404);
   echo json_encode(['error' => 'Package not found']);
}




?>
