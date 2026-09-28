<?php
session_start();
 include('config/setup.php');
function generateRandomString($length) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

$length = 10;
$post_id = $_GET['post_id'] ?? '';

if (!$post_id) {
    die("Invalid Post ID.");
}




// Fetch amount from database using $post_id
$sql = "SELECT package_amount,net_amount FROM create_post WHERE post_id = '$post_id' LIMIT 1";
$result = mysqli_query($config, $sql);
if (!$result || mysqli_num_rows($result) == 0) {
    die("Post not found or amount missing.");
}
$row = mysqli_fetch_assoc($result);

$package_amount = $row['package_amount']; 
$net_amount = $row['net_amount']; 
if($net_amount != ''){
  $amount = $net_amount;
}else{

  $amount = $package_amount;
}
//$amount = 1;
$randomString_a = generateRandomString($length);
$randomString_b = generateRandomString($length);
mysqli_query($config, "UPDATE create_post SET payment_transaction_id = '$randomString_a' WHERE post_id = '$post_id'");

$merchantKey = '347c50cc-130b-4f6c-addf-f62bf840a13d';
$merchantId = 'M1IB4F213MJY';

$redirectUrl = "https://pokkuvandi.com/App/paymentsuccess.php?merchantTransactionId=$randomString_a&Add_postid=$post_id";

$data = array(
    "merchantId" => $merchantId,
    "merchantTransactionId" => $randomString_a,
    "merchantUserId" => $randomString_b,
    "amount" => $amount * 100, // in paise
    "redirectUrl" => $redirectUrl,
    "redirectMode" => "POST",
    "callbackUrl" => "https://pokkuvandi.com/App/phonepe_callback.php",
    "mobileNumber" => "9363022675",
    "paymentInstrument" => array(
        "type" => "PAY_PAGE"
    )
);

$payloadMain = base64_encode(json_encode($data));
$payload = $payloadMain . "/pg/v1/pay" . $merchantKey;
$Checksum = hash('sha256', $payload) . '###1';

$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.phonepe.com/apis/hermes/pg/v1/pay",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode(['request' => $payloadMain]),
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json",
        "X-VERIFY: $Checksum",
        "accept: application/json"
    ]
]);

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
    header('Location: https://pokkuvandi.com/App/paymentfailed.php');
    exit;
} else {
    $responseData = json_decode($response, true);
    $url = $responseData['data']['instrumentResponse']['redirectInfo']['url'];
    header("Location: $url");
    exit;
}
?>
