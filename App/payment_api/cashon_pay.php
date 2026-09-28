  
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
$trackid = $_GET['trackorder'];
$_SESSION['tid'] = $trackid;

 
 
$price = $_GET['gtotal'];
$_SESSION['price'] = $price;
$customername =$_GET['customername'];
$customerid = $_GET['sessionid'];

$_SESSION['Customname']=$_GET['customername'];
$advance_pay=$_SESSION['advance_pay']=$_GET['advance_pay'];
$_SESSION['cuid']=$customerid;

$email = $_GET['customermail'];
$_SESSION['email'] = $email;
$contactno = $_GET['customerphone'];
$orderData = [
    'receipt'         => 3456,
    'amount'          => $advance_pay * 100, // 2000 rupees in paise
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

    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}

$data = [
    "key"               => $keyId,
    "amount"            => $amount,
    "name"              => "Online Shopping",
    "description"       => "onlineShoping",
    "image"             => "leefoodies.jpg",
    "prefill"           => [
    "name"              => $customername,
    "email"             => $email,
    "contact"           => $contactno,
    ],
    "notes"             => [
   
    "merchant_order_id" => $trackid ,
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

require("manual_cash.php");
?>


