<?php
include('../config/setup.php'); // Database connection

// Set the filename for download
$fileName = "Expired_Post_Report.xls";
header("Content-Disposition: attachment; filename=\"$fileName\"");
header("Content-Type: application/vnd.ms-excel");

// Fetch only expired posts (where expiry_date < current date)
date_default_timezone_set("Asia/Kolkata"); // Set timezone to Indian Standard Time (IST)
$current_date = date("Y-m-d"); // Get current date in IST
$searchTerm = isset($_GET['search']) ? mysqli_real_escape_string($config, $_GET['search']) : '';
$searchQuery = ""; 

if (!empty($searchTerm)) {
    $searchQuery = "AND (
        create_post.driver_name LIKE '%$searchTerm%' 
        OR create_post.vehicle_no LIKE '%$searchTerm%' 
        OR create_post.phone_no LIKE '%$searchTerm%' 
        OR create_post.whatsapp_no LIKE '%$searchTerm%' 
        OR dir_city_master.dir_city_name LIKE '%$searchTerm%' 
        OR dir_state_master.name LIKE '%$searchTerm%' 
        OR dir_area_master.dir_area_name LIKE '%$searchTerm%'
    )";
}

// Modify query to include necessary JOINs
 $query = "SELECT create_post.*, 
                 dir_city_master.dir_city_name, 
                 dir_state_master.name AS state_name, 
                 dir_area_master.dir_area_name 
          FROM create_post
          LEFT JOIN dir_city_master ON create_post.city_id = dir_city_master.dir_city_id
          LEFT JOIN dir_state_master ON create_post.state_id = dir_state_master.state_id
          LEFT JOIN dir_area_master ON create_post.area_id = dir_area_master.dir_area_id
          WHERE expiry_date < '$current_date' 
          AND delete_id = '0' 
          $searchQuery 
          ORDER BY post_id DESC";

$result = mysqli_query($config, $query);

// Initialize output array
$export_data = [];

// Add column headers
$export_data[] = [
    'S No', 'Customer', 'Phone No', 'Category', 'Sub Category', 'Vehicle Type', 'Vehicle Name',
    'Vehicle RC No', 'RC Name', 'Tonage', 'Seating', 'Facilities', 'Specification',
    'Active Location', 'Insurance Expiry', 'Stand Name', 'Shop Name', 'Shop Address', 'Work Nature',
    'Loader from Date', 'Loader to Date', 'Loader from Place', 'Loader to Place', 'WhatsApp No',
    'State', 'District', 'City', 'Create On', 'Expiry Date', 'Referred By Mobile No',
    'Referred By Name', 'Package Name', 'Package Valid Days', 'Coupon Type', 'Coupon Name',
    'Discount Amount', 'Amount'
];

// Loop through expired posts
$i = 1;
while ($row = mysqli_fetch_object($result)) {
    $export_data[] = [
        $i,
        $row->driver_name,
        $row->phone_no,
        getCategory($row->category_id, $config),
        getSubCategory($row->subcategory_id, $config),
        getVehicleType($row->vehicle_type_id, $config),
        $row->vehicle_name,
        $row->vehicle_no,
        $row->Add_RC_owner_name,
        $row->tonnage,
        $row->seating_capacity,
        $row->facilities,
        $row->space,
        $row->Add_location,
        formatDate($row->Add_insurance_exp_date),
        $row->stand_name,
        $row->shop_name,
        $row->shop_address,
        $row->work_nature,
        formatDate($row->loader_from_date),
        formatDate($row->loader_to_date),
        $row->loader_from_place,
        $row->loader_to_place,
        $row->whatsapp_no,
        $row->state_name,  // Fetch state from JOIN
        $row->dir_city_name,  // Fetch city from JOIN
        $row->dir_area_name,  // Fetch area from JOIN
        formatDate($row->create_on),
        formatDate($row->expiry_date),
        $row->reffered_by_phone_no,
        $row->reffered_by_name,
        getPackageName($row->package_id, $config),
        $row->package_days,
        $row->coupon_type,
        $row->discount_name,
        $row->discount_amount,
        $row->package_amount
    ];
    $i++;
}

// Function to fetch category name
function getCategory($id, $config) {
    $res = mysqli_query($config, "SELECT Main_Category_Name FROM main_category WHERE Main_Category_id='$id'");
    return mysqli_fetch_object($res)->Main_Category_Name ?? 'N/A';
}

// Function to fetch subcategory name
function getSubCategory($id, $config) {
    $res = mysqli_query($config, "SELECT Sub_Category_Name FROM sub_category WHERE Sub_Category_id='$id'");
    return mysqli_fetch_object($res)->Sub_Category_Name ?? 'N/A';
}

// Function to fetch vehicle type name
function getVehicleType($id, $config) {
    $res = mysqli_query($config, "SELECT Vehicle_type_name FROM vehicle_type WHERE Vehicle_type_id='$id'");
    return mysqli_fetch_object($res)->Vehicle_type_name ?? 'N/A';
}

// Function to fetch package name
function getPackageName($id, $config) {
    $res = mysqli_query($config, "SELECT package_title FROM category_package WHERE package_id='$id'");
    return mysqli_fetch_object($res)->package_title ?? 'N/A';
}

// Function to format dates
function formatDate($date) {
    return $date ? date('d-m-Y', strtotime($date)) : 'N/A';
}

// Output data as Excel
foreach ($export_data as $row) {
    echo implode("\t", $row) . "\n";
}
exit;
?>
