<?php
include('config/setup.php');
date_default_timezone_set('Asia/Kolkata');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cust_id = $_POST['cust_id'];
    $name = $_POST['name'];
    $phone = $_POST['customer_phone'];
    $main_cat = $_POST['Add_main_cate'];
    $sub_cat = $_POST['Add_sub_category'];
   
    $from_state = $_POST['from_state'];
    $to_state = $_POST['to_state']?? '';
    $requiredvehicle_type = $_POST['requiredvehicle_type']?? '';
    $from_city = $_POST['from_city'];
    $to_city = $_POST['to_city'];

    
    
    $from_district = $_POST['from_district'];
    $loader_from = $_POST['loader_from_place'];
    $to_district = $_POST['to_district'];
    $location = $_POST['location_name'];
    $drop_place = $_POST['drop_place'];
    $loader_to = $_POST['loader_to_place'];
    $total_km = $_POST['total_km'];
    $n_ofperson = $_POST['n_ofperson'];
    $total_weight = $_POST['total_weight'];
    $product_details = $_POST['product_details'];
    $vehicle_body = $_POST['vehicle_body_type'];
    $add_number = $_POST['additinoal_number'];
    $trip_type = $_POST['trip_type'];
    
   
    $datetime = $_POST['vehicle_required_datetime'];
   

    // Get current Indian time
   $current_time = date("Y-m-d H:i:s"); // Format: YYYY-MM-DD HH:MM:SS


    $sql = "INSERT INTO orders (
        cust_id, name, customer_phone, Add_main_cate, Add_sub_category,
         from_state, from_district, loader_from_place,
        to_district, location_name, drop_place, loader_to_place,
        total_km, n_ofperson, total_weight, product_details,
        vehicle_body_type, additinoal_number,
         to_state,requiredvehicle_type,from_city,to_city,vehicle_required_datetime,trip_type,created_at
    ) VALUES (
        '$cust_id', '$name', '$phone', '$main_cat', '$sub_cat',
         '$from_state', '$from_district', '$loader_from',
        '$to_district', '$location', '$drop_place', '$loader_to',
        '$total_km', '$n_ofperson', '$total_weight', '$product_details',
        '$vehicle_body', '$add_number', 
         '$to_state','$requiredvehicle_type','$from_city','$to_city','$datetime','$trip_type','$current_time'
    )";

    if (mysqli_query($config, $sql)) {
        $message = "Order placed successfully";
        echo $message; // For alert
    } else {
        echo "Error: " . mysqli_error($config);
    }
}
?>
