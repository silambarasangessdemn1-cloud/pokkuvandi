<?php 
include('../config/setup.php');

$where = " WHERE 1=1 "; // Default condition

// Collect GET parameters from the list page for search and filter
$vehicle_no = isset($_REQUEST['vehicle_no']) ? $_REQUEST['vehicle_no'] : '';
$state = isset($_REQUEST['state']) ? $_REQUEST['state'] : '';
$district = isset($_REQUEST['district']) ? $_REQUEST['district'] : '';
$city = isset($_REQUEST['Add_area']) ? $_REQUEST['Add_area'] : '';
$date_filter = isset($_REQUEST['date_filter']) ? $_REQUEST['date_filter'] : '';
$search_value = isset($_REQUEST['search_input']) ? $_REQUEST['search_input'] : '';

if (!empty($search_value)) {
    $search_value = mysqli_real_escape_string($config, $search_value);
    $where .= " AND (create_post.driver_name LIKE '%$search_value%' 
                      OR create_post.vehicle_no LIKE '%$search_value%'
                      OR create_post.phone_no LIKE '%$search_value%'
                      OR create_post.whatsapp_no LIKE '%$search_value%')";
}

// Apply Filters
if (!empty($vehicle_no)) {
    $where .= " AND create_post.vehicle_no LIKE '%$vehicle_no%' ";
}
if (!empty($state) && $state != '0') {
    $where .= " AND create_post.state_id = '$state' ";
}
if (!empty($district) && $district != '0') {
    $where .= " AND create_post.city_id = '$district' ";
}
if (!empty($city) && $city != '0') {
    $where .= " AND create_post.area_id = '$city' ";
}
if (!empty($date_filter)) {
    $where .= " AND call_click_count.click_date = '$date_filter' ";
}

// Query for export
$query = "SELECT DISTINCT create_post.*, call_click_count.district, call_click_count.city, 
          call_click_count.click_date, call_click_count.phone_number
          FROM call_click_count 
          INNER JOIN create_post ON create_post.post_id = call_click_count.post_id
          $where
          GROUP BY create_post.post_id
          ORDER BY call_click_count.call_count_id DESC";

// Execute Query
$Recent_customer = mysqli_query($config, $query);

// Fetch data for export
$export_data = [];
$i = 1;
while ($recent_cust = mysqli_fetch_object($Recent_customer)) {
    // Fetch related city, area, and sub-area info
    $city_id = $recent_cust->city_id;
    $area_id = $recent_cust->area_id;
    $sub_area_id = $recent_cust->sub_area_id;

    $cus_state = mysqli_query($config, "SELECT * FROM dir_state_master WHERE state_id='$recent_cust->state_id'");
    $cus_state__ = mysqli_fetch_object($cus_state);

    $maincate3_ = mysqli_query($config, "SELECT * FROM dir_city_master WHERE dir_city_id ='$city_id'");
    $mac3_ = mysqli_fetch_object($maincate3_);

    $orarea3_ = mysqli_query($config, "SELECT * FROM dir_area_master WHERE dir_area_id ='$area_id'");
    $area3__ = mysqli_fetch_object($orarea3_);

    $orsub__ = mysqli_query($config, "SELECT * FROM sub_area_master WHERE sub_area_id ='$sub_area_id'");
    $orsub3__ = mysqli_fetch_object($orsub__);

    // Prepare data for export
    $data_arr = array(
        'S No' => $i,
        'Driver Name' => $recent_cust->driver_name,
        'Transport Name' => $recent_cust->vehicle_name,
        'Vehicle No ' => $recent_cust->vehicle_no,
        'Vehicle Photo' => $recent_cust->phone_no,
        'Phone No' => $recent_cust->phone_no,
        'Whatsapp No' => $recent_cust->whatsapp_no,
        'District' => $mac3_->dir_city_name,
        'City' => $area3__->dir_area_name,
        'Area' => $orsub3__->sub_area_name,
        'Customer Phone No' => $recent_cust->phone_number,
        'Date & Time' => $recent_cust->click_date,
        'Total Count' => 1,
    );

    array_push($export_data, $data_arr);
    $i++;
}

// Handle the case if no data was found
if ($i == 1) {
    $data_arr = array('Area_Name' => '');
    array_push($export_data, $data_arr);
}

// Export data to Excel file
if ($export_data) {
    function filterData(&$str) {
        $str = preg_replace("/\t/", "\\t", $str);
        $str = preg_replace("/\r?\n/", "\\n", $str);
        if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
    }

    $fileName = "count_report.xls";
    header("Content-Disposition: attachment; filename=\"$fileName\"");
    header("Content-Type: application/vnd.ms-excel");

    $flag = false;
    foreach ($export_data as $row) {
        if (!$flag) {
            echo implode("\t", array_keys($row)) . "\n";
            $flag = true;
        }
        array_walk($row, 'filterData');
        echo implode("\t", array_values($row)) . "\n";
    }
    exit;
}
?>
