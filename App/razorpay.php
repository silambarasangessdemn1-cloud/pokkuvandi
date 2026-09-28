<?php
session_start();
include('config/setup.php');

require('razorpay-php-master/Razorpay.php');
use Razorpay\Api\Api;

function generateRandomString($length = 10) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
} else {
    $post_id = '';
}
if (!$post_id) {
    die("Invalid Post ID.");
}

$sql = "SELECT package_amount, net_amount FROM create_post WHERE post_id = '$post_id' LIMIT 1";
$result = mysqli_query($config, $sql);
if (!$result || mysqli_num_rows($result) == 0) {
    die("Post not found or amount missing.");
}

$row = mysqli_fetch_assoc($result);
$package_amount = $row['package_amount'];
$net_amount = $row['net_amount'];
if ($net_amount !== '') {
    $amount = $net_amount;
} else {
    $amount = $package_amount;
}
// $amount = 1;
$order_amount = $amount * 100; // in paisa

$transaction_id = generateRandomString(10);

// Razorpay credentials
$razorpay_api_key = 'rzp_live_qMFkGa6UVcPEWO'; // replace with your test/live key
$razorpay_api_secret = 'oHEqONglRxiwzrbeNnxByUxh'; // replace with your test/live secret

try {
    $api = new Api($razorpay_api_key, $razorpay_api_secret);

    $order = $api->order->create([
        'receipt' => $transaction_id,
        'amount' => $order_amount,
        'currency' => 'INR',
        'payment_capture' => 1
    ]);

} catch (Exception $e) {
    die("Razorpay Error: " . $e->getMessage());
}

$order_id = $order['id'];
$_SESSION['razorpay_order_id'] = $order_id;
mysqli_query($config, "UPDATE create_post SET razorpay_order_id = '$order_id' WHERE post_id = '$post_id'");

// Redirect to Razorpay Checkout
?>
<!DOCTYPE html>
<html>
<head>
    <title>Redirecting to Razorpay...</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body>
<script>
    var options = {
        "key": "<?php echo $razorpay_api_key; ?>",
        "amount": "<?php echo $order_amount; ?>",
        "currency": "INR",
        "name": "Pokkuvandi",
        "description": "Package Payment",
        "order_id": "<?php echo $order_id; ?>",
        "handler": function (response){
            // Store payment details in case redirect fails
            try {
                // Redirect to your server-side success handler
                var redirectUrl = "rppaymentsuccess.php?razorpay_payment_id=" + response.razorpay_payment_id +
                                   "&razorpay_order_id=" + response.razorpay_order_id +
                                   "&razorpay_signature=" + response.razorpay_signature +
                                   "&post_id=<?php echo $post_id; ?>";
                
                // Store in sessionStorage as backup
                sessionStorage.setItem('razorpay_payment_id', response.razorpay_payment_id);
                sessionStorage.setItem('razorpay_order_id', response.razorpay_order_id);
                sessionStorage.setItem('razorpay_signature', response.razorpay_signature);
                sessionStorage.setItem('post_id', '<?php echo $post_id; ?>');
                
                // Redirect with timeout fallback
                window.location.href = redirectUrl;
                
                // Fallback: if redirect doesn't happen within 5 seconds, try again
                setTimeout(function() {
                    if (document.visibilityState === 'visible') {
                        window.location.href = redirectUrl;
                    }
                }, 5000);
            } catch (e) {
                console.error('Payment handler error:', e);
                // Fallback redirect
                window.location.href = "rppaymentsuccess.php?razorpay_payment_id=" + response.razorpay_payment_id +
                                       "&razorpay_order_id=" + response.razorpay_order_id +
                                       "&razorpay_signature=" + response.razorpay_signature +
                                       "&post_id=<?php echo $post_id; ?>";
            }
        },
        "modal": {
            "ondismiss": function(){
                // If user closes the payment modal, redirect back
                window.location.href = "create_post.php";
            }
        },
        "prefill": {
            "name": "<?php 
                if (isset($_SESSION['name'])) {
                    echo $_SESSION['name'];
                } else {
                    echo 'Customer';
                }
            ?>",
            "email": "<?php 
                if (isset($_SESSION['email'])) {
                    echo $_SESSION['email'];
                } else {
                    echo '';
                }
            ?>",
            "contact": "<?php 
                if (isset($_SESSION['mobile'])) {
                    echo $_SESSION['mobile'];
                } else {
                    echo '';
                }
            ?>"
        },
        method: {
        upi: true
    },
    upi: {
        flow: 'intent'  // ✅ This enables UPI App opening (like GPay)
    },
    theme: {
        color: "#3399cc"
    },
    };
    var rzp1 = new Razorpay(options);
    rzp1.open();
</script>
</body>
</html>
