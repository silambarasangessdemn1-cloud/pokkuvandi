<?php // Database connection
// Database connection
include('../config/setup.php'); 


// Set headers for Excel download
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=customer_data.xls");
header("Pragma: no-cache");
header("Expires: 0");
// Initialize search query
$search_query = '';

// Check if a search parameter is provided
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = mysqli_real_escape_string($config, $_GET['search']);
    $search_query = "WHERE Customer_Name LIKE '%$search%' 
                     OR Customer_Phone_No LIKE '%$search%' 
                   ";
}

// Fetch all matching records (no LIMIT restriction)
 $query = "SELECT * FROM customer_pokkuvandi_entry $search_query ORDER BY cus_pokkuvandi_entry_id DESC";

$main_cate = mysqli_query($config, $query);

// Start the Excel table
echo "<table border='1'>";
echo "<tr>
        <th>S.No</th>
        <th>Customer Name</th>
        <th>Customer Phone No</th>
        <th>Vehicle Required Date</th>
        <th>Vehicle Type</th>
        <th>State</th>
        <th>From State</th>
        <th>To State</th>
        <th>From District</th>
        <th>Load Pick Up Place</th>
        <th>To District</th>
        <th>Load Delivery Place</th>
        <th>Required Vehicle Type</th>
        <th>Load Details</th>
        <th>Create On</th>
        <th>Trip Status</th>
        <th>Driver Name</th>
     <th>Driver Phone No</th>
     <th>Driver Vehicle Reg No</th>
 <th>Reason for Cancellation</th>
 <th>Cancelld Date</th>

      </tr>";

$mc = 1;
while ($macate = mysqli_fetch_object($main_cate)) {

    // Fetch state and district details
    $main_cate_from = mysqli_query($config, "SELECT * FROM dir_city_master WHERE dir_city_id='$macate->from_district'");
    $addsubcate_from = mysqli_fetch_object($main_cate_from);

    $main_cate_to = mysqli_query($config, "SELECT * FROM dir_city_master WHERE dir_city_id='$macate->to_district'");
    $addsubcate_to = mysqli_fetch_object($main_cate_to);

    $main_state_from = mysqli_query($config, "SELECT * FROM dir_state_master WHERE state_id='$macate->from_state_id'");
    $state_from = mysqli_fetch_object($main_state_from);

    $main_to_from = mysqli_query($config, "SELECT * FROM dir_state_master WHERE state_id='$macate->to_state_id'");
    $to_state_from = mysqli_fetch_object($main_to_from);

    // Convert dates
    $from_date_time = date('Y-m-d H:i', strtotime("$macate->loader_from_date $macate->loader_from_time"));
    $to_date_time = date('Y-m-d H:i', strtotime("$macate->from_date $macate->loader_to_time"));

    $_date = $macate->post_date;
    $post_date = date('d-m-Y', strtotime("$_date"));

    // Determine trip status
    $trip_status_display = "Pending";
    if ($macate->trip_status == 'completed') {
        $trip_status_display = "Completed";
    } elseif ($macate->trip_status == 'cancelled') {
        $trip_status_display = "Cancelled";
    }

    // Output each row in table format
    echo "<tr>
            <td>$mc</td>
            <td>$macate->Customer_Name</td>
            <td>$macate->Customer_Phone_No</td>
            <td>$to_date_time</td>
            <td>" . ($macate->vehicle_type_cpe == 'goods' ? 'Goods' : 'Passenger') . "</td>
            <td>" . ($macate->state == 1 ? 'Within State Trip' : 'Other State Trip') . "</td>
            <td>$state_from->name</td>
            <td>$to_state_from->name</td>
            <td>$addsubcate_from->dir_city_name</td>
            <td>$macate->place</td>
            <td>$addsubcate_to->dir_city_name</td>
            <td>$macate->to_place</td>
            <td>$macate->vehicle_type</td>
            <td>$macate->general_remarks</td>
            <td>$post_date</td>
            <td>$trip_status_display</td>
            <td>$macate->driver_name</td>
             <td>$macate->driver_phone_no</td>
            <td>$macate->reg_veh_no</td>
                        <td>$macate->reson_for_cancel</td>
                        <td>$macate->cancell_date</td>


          </tr>";

    $mc++;
}

echo "</table>";

exit;
