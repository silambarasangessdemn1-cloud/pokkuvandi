<?php
include('config/setup.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $orderId = $_POST['order_id'];
    $extendTime = (int) $_POST['extend_time'];

    if ($orderId && $extendTime > 0) {
        $query = "UPDATE orders SET extend_time = extend_time + $extendTime WHERE id = '$orderId'";
        if (mysqli_query($config, $query)) {
            echo "⏱ Time extended by $extendTime minutes.";
        } else {
            echo "❌ Failed to extend time.";
        }
    } else {
        echo "Invalid data.";
    }
}
?>
