<?php
include('../config/setup.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Common POST fields
    $order_id = $_POST['order_id'] ?? null; // Only for update
    $cust_id = $_POST['cust_id'];
    $name = $_POST['Add_driver_name'];
    $phone = $_POST['Add_phone_no'];
    $main_cat = $_POST['Add_main_cate'];
    $sub_cat = $_POST['Add_sub_category'];
    $from_state = $_POST['from_state'];
    $to_state = $_POST['to_state'] ?? '';
    $requiredvehicle_type = $_POST['requiredvehicle_type'] ?? '';
    $from_city = $_POST['from_city'];
    $to_city = $_POST['to_city'];
    $from_district = $_POST['from_district'];
    $loader_from = $_POST['loader_from_place'];
    $to_district = $_POST['to_district'];
    $location = $_POST['location_name'] ?? '';
    $drop_place = $_POST['drop_place'] ?? '';
    $loader_to = $_POST['loader_to_place'] ?? '';
    $total_km = $_POST['total_km'];
    $n_ofperson = $_POST['n_ofperson'] ?? '';
    $total_weight = $_POST['total_weight'] ?? '';
    $product_details = $_POST['product_details'] ?? '';
    $vehicle_body = $_POST['vehicle_body_type'];
    $add_number = $_POST['additinoal_number'] ?? '';
    $trip_type = $_POST['trip_type'];
    $datetime = $_POST['vehicle_required_datetime'];
       


    date_default_timezone_set('Asia/Kolkata');
    $current_time = date("Y-m-d H:i:s");

    if ($order_id) {
        // 🛠 UPDATE existing order
 $sql = "UPDATE orders SET
            cust_id = '$cust_id',
            name = '$name',
            customer_phone = '$phone',
            Add_main_cate = '$main_cat',
            Add_sub_category = '$sub_cat',
            from_state = '$from_state',
            from_district = '$from_district',
            loader_from_place = '$loader_from',
            to_state = '$to_state',
            to_district = '$to_district',
            location_name = '$location',
            drop_place = '$drop_place',
            loader_to_place = '$loader_to',
            total_km = '$total_km',
            n_ofperson = '$n_ofperson',
            total_weight = '$total_weight',
            product_details = '$product_details',
            vehicle_body_type = '$vehicle_body',
            additinoal_number = '$add_number',
            requiredvehicle_type = '$requiredvehicle_type',
            from_city = '$from_city',
            to_city = '$to_city',
            vehicle_required_datetime = '$datetime',
            trip_type = '$trip_type'
    
        WHERE id = '$order_id'";
    } 

   
    if (mysqli_query($config, $sql)) {
        echo $order_id ? "Order updated successfully" : "Order placed successfully";
    } 
}
?>
