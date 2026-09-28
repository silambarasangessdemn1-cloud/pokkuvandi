
<?php include('config/setup.php');?>
<?php
include('session.php');

$driver_name = $_POST['driver_name'] ?? null;
$driver_phone_no = $_POST['driver_phone_no'] ?? null;
$vehicle_no = $_POST['vehicle_no'] ?? null;
$cus_id = $_POST['cus_id'];
$status = $_POST['status'];

date_default_timezone_set('Asia/Kolkata'); 
$date = date("Y-m-d H:i:s"); // time in India

// Update based on status
if ($status == 'completed') {

 $query = "UPDATE customer_pokkuvandi_entry SET 
 driver_name = '$driver_name', 
 driver_phone_no = '$driver_phone_no', 
 reg_veh_no = '$vehicle_no', 
 driver_update_date = '$date', 
--  update_status = '1', 
 trip_status = '$status' 
 WHERE cus_pokkuvandi_entry_id = '$cus_id'";

    
} elseif ($status == 'cancelled') {
    $cancellation_reason = $_POST['cancellation_reason'];
    $cancellation_date = $_POST['cancellation_date'];

  $query = "UPDATE customer_pokkuvandi_entry SET 
    reson_for_cancel = '$cancellation_reason', 
    cancell_date = '$cancellation_date', 
    update_status = '1', 
    trip_status = '$status' 
WHERE cus_pokkuvandi_entry_id = '$cus_id'";
} else {
    echo "Invalid status";
    exit;
}

$addmaincate = mysqli_query($config, $query);

if ($addmaincate == false) {
    echo "2"; 
} else {
    echo "1";
}
?>
