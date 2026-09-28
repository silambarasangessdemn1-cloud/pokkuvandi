<?php
include('../config/setup.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sub_category_id = intval($_POST['sub_category_id']);
    $live_mode = intval($_POST['live_mode']);

    // Update live_mode column in sub_category table
    $update = mysqli_query($config, "UPDATE sub_category SET live_mode='$live_mode' WHERE Sub_Category_id='$sub_category_id'");

    if ($update) {
        echo 'success';
    } else {
        echo 'fail';
    }
}
?>
