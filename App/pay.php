<?php

require('config.php');
require('razorpay-php/Razorpay.php');
session_start();

// Create the Razorpay Order

use Razorpay\Api\Api;

$api = new Api($keyId, $keySecret);

//
// We create an razorpay order using orders api
// Docs: https://docs.razorpay.com/docs/orders
//
// $trackid = $_GET['trackorder'];
// $_SESSION['tid'] = $trackid;
// $_SESSION['dprice'] = $_GET['deliveryprice'];
 
 
// $price = $_GET['gtotal'];
// $_SESSION['price'] = $price;
$customername = $_GET['session__username'];
$customerid = $_GET['session_id'];

$_SESSION['Customname']=$customername ;
$_SESSION['cuid']=$customerid;

$email = $_SESSION['session__mail'];
$_SESSION['session__mail'] = $email;
$contactno = $_GET['session__phone'];
$amount = $_GET['amount'];
$orderData = [
    'receipt'         => 3456,
    'amount'          => $amount, // 2000 rupees in paise
    'currency'        => 'INR',
    'payment_capture' => 1 // auto capture
];

$razorpayOrder = $api->order->create($orderData);

$razorpayOrderId = $razorpayOrder['id'];

$_SESSION['razorpay_order_id'] = $razorpayOrderId;

$displayAmount = $amount = $orderData['amount'];

if ($displayCurrency !== 'INR')
{
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);

    $displayAmount =  $amount ;
}

$data = [
    "key"               => $keyId,
    "amount"            => $amount,
    "name"              => "Vehicle directory",
    "description"       => "onlineShoping",
    "image"             => "leefoodies.jpg",
    "prefill"           => [
    "name"              => $customername,
    "email"             => $email,
    "contact"           => $contactno,
    ],
    "notes"             => [
   
    //"merchant_order_id" => $trackid ,
    ],
    "theme"             => [
    "color"             => "#F37254"
    ],
    "order_id"          => $razorpayOrderId,
];

if ($displayCurrency !== 'INR')
{
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}

$json = json_encode($data);
 
?>
 
             
            
    
		
		 
		 
		 
		 

 

















	  <!-- Bootstrap core JavaScript -->
      <script src="vendor/jquery/jquery.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <!-- slick Slider JS-->
      <script type="text/javascript" src="vendor/slick/slick.min.js"></script>
      <!-- Sidebar JS-->
      <script type="text/javascript" src="vendor/sidebar/hc-offcanvas-nav.js"></script>
      <!-- Custom scripts for all pages-->
      <script src="js/osahan.js"></script>
   </body>
</html> 


