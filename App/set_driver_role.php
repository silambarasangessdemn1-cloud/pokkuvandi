<?php
include('config/setup.php');
include('session.php');

if (!empty($prof_id) && isset($_POST['role']) && $_POST['role'] === 'driver') {
    mysqli_query($config, "UPDATE customer_master SET customer_type = 'driver' WHERE Customer_Id = '$prof_id'");
    echo json_encode(['status' => 'success']);
    exit;
}
echo json_encode(['status' => 'ignored']);
