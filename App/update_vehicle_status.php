<?php
include('config/setup.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id = intval($_POST['post_id']);
    $status = intval($_POST['status']);

    $query = "UPDATE create_post SET online_status = '$status' WHERE post_id = '$post_id'";
    if (mysqli_query($config, $query)) {
        echo "success";
    } else {
        echo "error";
    }
}
?>
