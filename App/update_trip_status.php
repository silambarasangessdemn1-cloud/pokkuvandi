<?php
include('config/setup.php');

$order_id = $_POST['order_id'];
$action = $_POST['action'];
$trip_date = $_POST['trip_date'];
$trip_time = $_POST['trip_time'];
$remarks = $_POST['starting_km'];
$endingKm = $_POST['ending_km']; // For end trip, this is ending km
$driverBata = $_POST['driver_bata'];
$toll = $_POST['toll_charge'];
$unloading = $_POST['unloading_charge'];
$waiting = $_POST['waiting_charge'];
$other = $_POST['other_charge'];
$totalAmount = $_POST['total_amount'];
$trip_amount = $_POST['trip_amount'];
$other_description = $_POST['other_description'];
$travel_hrs = $_POST['travel_hrs'];

// Combine date and time
$datetime = $trip_date . ' ' . $trip_time;

if ($action === 'start') {
    $sql = "UPDATE orders SET 
                status = 'started', 
                start_time = '$datetime', 

                start_km = '$remarks' 
            WHERE id = '$order_id'";
} elseif ($action === 'end') {
    $sql = "UPDATE orders SET 
                status = 'ended',
                end_time = '$datetime',
                ending_km = '$endingKm',
                driver_bata = '$driverBata',
                toll_charge = '$toll',
                unloading_charge = '$unloading',
                waiting_charge = '$waiting',
                other_charge = '$other',
                                other_description = '$other_description',
                                             travel_hrs = '$travel_hrs',
  trip_amount = '$trip_amount',
                total_amount = '$totalAmount'
            WHERE id = '$order_id'";
}

if (mysqli_query($config, $sql)) {
    echo 'success';
} else {
    echo 'error: ' . mysqli_error($config); // To help with debugging
}
