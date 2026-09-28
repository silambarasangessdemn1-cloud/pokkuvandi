<?php
include('config/setup.php'); // your DB config

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['customer_id'])) {
    $cid = $_POST['customer_id'];

    $delete = mysqli_query($config, "DELETE FROM create_post WHERE customer_id = '$cid' AND status = 0");

    if ($delete) {
        echo "Previous entry deleted successfully.";
    } else {
        echo "Error deleting entry.";
    }
} else {
    echo "Invalid request.";
}
?>
