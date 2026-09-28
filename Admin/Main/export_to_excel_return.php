<?php
// Include database connection
include('../config/setup.php');

// Set headers for Excel file download
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=driver_data.csv');

$output = fopen('php://output', 'w');

// Write column headers (without 'S.No')
fputcsv($output, [
    'Driver Name', 'Vehicle Name', 'Vehicle No', 'Phone No', 'WhatsApp No',
    'From Date & Time', 'To Date & Time', 'From Place', 'To Place', 'Space',
    'Remarks', 'From District', 'From State', 'To District', 'To State', 'Trip Type',
    'City', 'Area', 'Status', 'Added On'
]);

// Build search query
$search_query = '';
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = mysqli_real_escape_string($config, $_GET['search']);
    $search_query = "AND (create_post.driver_name LIKE '%$search%' 
    OR create_post.vehicle_no LIKE '%$search%' 
    OR create_post.phone_no LIKE '%$search%')";
}

// Fetch Data
$query = "SELECT create_post.*, driver_pokkuvandi_entry.*, 
                 dir_city_master.dir_city_name AS from_district, 
                 dir_state_master.name AS from_state,
                 city_to.dir_city_name AS to_district,
                 state_to.name AS to_state,
                 dir_area_master.dir_area_name AS area_name
          FROM create_post
          INNER JOIN driver_pokkuvandi_entry ON create_post.post_id = driver_pokkuvandi_entry.post_id
          LEFT JOIN dir_city_master ON create_post.city_id = dir_city_master.dir_city_id
          LEFT JOIN dir_area_master ON create_post.area_id = dir_area_master.dir_area_id
          LEFT JOIN dir_state_master ON create_post.state_id = dir_state_master.state_id
          LEFT JOIN dir_city_master AS city_to ON driver_pokkuvandi_entry.to_district = city_to.dir_city_id
          LEFT JOIN dir_state_master AS state_to ON driver_pokkuvandi_entry.to_state = state_to.state_id
          WHERE create_post.delete_id = '0' $search_query
          ORDER BY driver_pokkuvandi_entry.driver_pokkuvandi_entry_id DESC";

$result = mysqli_query($config, $query);

// Initialize row count
$row_count = 1;

// Fetch data and output each row
while ($row = mysqli_fetch_assoc($result)) {
    $from_date_time = date('d-m-Y h:i A', strtotime($row['loader_from_date'] . ' ' . $row['loader_from_time']));
    $to_date_time = date('d-m-Y h:i A', strtotime($row['loader_to_date'] . ' ' . $row['loader_to_time']));
    $status = ($row['status'] == 1) ? 'Active' : 'Inactive';
    $trip_type = ($row['state_status'] == 1) ? 'Within State Trip' : 'Other State Trip';
    $added_on = date('d-m-Y', strtotime($row['post_addon']));

    // Add S.No as the first value in the row data
    fputcsv($output, [
        $row_count++, $row['driver_name'], $row['vehicle_name'], $row['vehicle_no'], $row['phone_no'], 
        $row['whatsapp_no'], $from_date_time, $to_date_time, $row['loader_from_place'], $row['loader_to_place'], 
        $row['loader_space'], $row['loader_remarks'], $row['from_district'], $row['from_state'], 
        $row['to_district'], $row['to_state'], $trip_type, $row['dir_city_name'], 
        $row['area_name'], $status, $added_on
    ]);
}

// Close output stream
fclose($output);
exit;
?>
