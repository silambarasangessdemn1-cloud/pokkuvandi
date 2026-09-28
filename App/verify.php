<?php include('../config/setup.php')?>
<?php include('../session.php');?>	



<?php

require('config.php');
session_start();
 

require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;

$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true)
{
    $razorpay_order_id = $_SESSION['razorpay_order_id'];
    $razorpay_payment_id = $_POST['razorpay_payment_id'];
 
    $tid = $_SESSION['tid'];
	$dp=$_SESSION['dprice'];
	$cn=$_SESSION['Customname'];
	$cid=$_SESSION['cuid'];
  date_default_timezone_set('Asia/Kolkata');
 $paidon= date('d-m-Y H:i: a ');
 $cartadd= date('Y-m-d');
    $sql =mysqli_query($config,"INSERT INTO `Online_Payment_Transcation` (`R_Order_id`, `Payment_id`, `Order_Paid_Status`, `Order_id`, `Customer_id`, `Customer_Name`, `Paid_on`) VALUES ('$razorpay_order_id', '$razorpay_payment_id', 'success', '$tid','$cid','$cn',' $paidon')");
	$check_add=mysqli_query($config,"update order_master set Payment_Mode='ONLINE_PAYMENT',Order_delivery_date='$cartadd',Order_status='Completed',Delivery_status='On_Progress',Grand_total='".$_SESSION['price']."',Delivery_charge='".$dp."' where order_customer_track_id='$tid' and Customer_id='$cid' ");

    if($sql){
        echo "payment details inserted to db";
		
		header('location:../successful.php?ordertrack='.$tid);
		
    }

    $html = "<p>Your payment was successful</p>
             <p>Payment ID: {$_POST['razorpay_payment_id']}</p>";
header('location:../successful.php?ordertrack='.$tid);
    
}
else
{
	$tid = $_SESSION['tid'];
	$dp=$_SESSION['dprice'];
	$cn=$_SESSION['Customname'];
	$cid=$_SESSION['cuid'];
  date_default_timezone_set('Asia/Kolkata');
 $paidon= date('d-m-Y H:i: a ');
 $cartadd= date('d-m-Y ');
			 $sql = mysqli_query($config,"INSERT INTO `Online_Payment_Transcation` (`Order_Paid_Status`, `Order_id`, `Customer_id`, `Customer_Name`, `Paid_on`) VALUES ( 'Failed', '$tid','$cid','$cn',' $paidon')");

	

			 
}

echo $html;
