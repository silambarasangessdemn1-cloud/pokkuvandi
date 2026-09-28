<?php 
include('../config/setup.php');

$from_date = $_GET['from_date'];
$to_date = $_GET['to_date'];
$main_category = $_GET['main_cate_Name'];
$district = $_GET['district'];
$city = $_GET['city'];
$area = $_GET['area'];
$state = $_GET['state']; // Added state filter
date_default_timezone_set("Asia/Kolkata"); // Set timezone to Indian Standard Time (IST)
$current_date = date("Y-m-d"); // Get current date in IST

// Base query
$query = "SELECT * FROM create_post WHERE expiry_date < '$current_date'"; // Ensure only expired posts are shown

// Apply filters  

// Apply date range filter
if (!empty($from_date) && !empty($to_date)) {
  $query .= " AND expiry_date BETWEEN '$from_date' AND '$to_date'";
} else {
  // Show only expired data when no date is selected
  $query .= " AND expiry_date < '$current_date'";
}
if ($main_category != '' && $main_category != '0') {
    $query .= " AND category_id = '$main_category'";
}
if ($district != '' && $district != '0') {
    $query .= " AND city_id = '$district'";
}
if ($city != ''&& $city != '0') {
    $query .= " AND area_id = '$city'";
}

if ($state != '' && $state != 0) { // Applying state filter
    $query .= " AND state_id = '$state'";
}
if (!empty($_GET['search_input'])) {
    $search_value = mysqli_real_escape_string($config, $_GET['search_input']);
    $query .= " AND (create_post.driver_name LIKE '%$search_value%' 
                      OR create_post.vehicle_no LIKE '%$search_value%'
                      OR create_post.phone_no LIKE '%$search_value%'
                      OR create_post.whatsapp_no LIKE '%$search_value%')";
}
$query .= " ORDER BY post_id DESC"; // Ordering the result

// Run the query with the filters applied
$Recent_customer = mysqli_query($config, $query);

// Check if the query was successful
if ($Recent_customer === false) {
    die('Error executing query: ' . mysqli_error($config));
}

// Process export logic
$fileName = "Post_report.csv";
header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=$fileName");
$output = fopen("php://output", "w");

// Add CSV headers
// Assuming you've already initialized $config and $output
fputcsv($output, [
    'S No', 'Customer', 'Phone No', 'Category', 'Sub category', 
    'City', 'State', 'Area', 'Vehicle Name', 'Vehicle RC No', 'RC Name', 'Tonnage', 
    'Seating', 'Facilities', 'Specification', 'Active Location', 'Insurance Expiry', 
    'Stand Name', 'Shop Name', 'Shop Address', 'Work Nature', 'Whatsapp No', 
    'State', 'District', 'City', 'Created On', 'Expiry Date', 
    'Referred By Mobile No', 'Referred By Name', 'Package Name', 
    'Package Valid Days', 'Coupon Type', 'Coupon Name', 'Discount Amount', 'Amount'
]);

$i = 1;
while ($recent_cust = mysqli_fetch_assoc($Recent_customer)) {
    // Fetch related category data
    $category_name = $recent_cust['category_id'];
    $subcategory_name = $recent_cust['subcategory_id'];
    $Recent_customer_ = mysqli_query($config, "SELECT * FROM main_category WHERE Main_Category_id='$category_name' ORDER BY Main_Category_id DESC");
    $recent_cust__ = mysqli_fetch_object($Recent_customer_);

    // Fetch related subcategory data
    $customer_ = mysqli_query($config, "SELECT * FROM sub_category WHERE Sub_Category_id='$subcategory_name' ORDER BY Sub_Category_id DESC");
    $cust__ = mysqli_fetch_object($customer_);

    // Fetch customer details using phone number
    $cus_ = mysqli_query($config, "SELECT * FROM customer_master WHERE Customer_Phone_No='$recent_cust[phone_no]'");
    $cust___ = mysqli_fetch_object($cus_);

    // Fetch city, area, state, and sub-area data
    $cus_city = mysqli_query($config, "SELECT * FROM dir_city_master WHERE dir_city_id='$recent_cust[city_id]'");
    $cus_city__ = mysqli_fetch_object($cus_city);

    $cus_area = mysqli_query($config, "SELECT * FROM dir_area_master WHERE dir_area_id='$recent_cust[area_id]'");
    $cus_area__ = mysqli_fetch_object($cus_area);

    $cus_state = mysqli_query($config, "SELECT * FROM dir_state_master WHERE state_id='$recent_cust[state_id]'");
    $cus_state__ = mysqli_fetch_object($cus_state);

    $cus_sub = mysqli_query($config, "SELECT * FROM sub_area_master WHERE sub_area_id='$recent_cust[sub_area_id]'");
    $cus_sub__ = mysqli_fetch_object($cus_sub);

    // Fetch package name
    $cus_package_name = mysqli_query($config, "SELECT * FROM category_package WHERE package_id='$recent_cust[package_id]'");
    $cust_package_name_ = mysqli_fetch_object($cus_package_name);

    // Fetch vehicle type
    $cus_vehicle_type = mysqli_query($config, "SELECT * FROM vehicle_type WHERE Vehicle_type_id='$recent_cust[vehicle_type_id]'");
    $cus_vehicle_type__ = mysqli_fetch_object($cus_vehicle_type);

    // Fetch the driver's name if available, else 'N/A'
    $driver_name = $recent_cust['driver_name'] ?? 'N/A';

    // Export the data row to CSV
    fputcsv($output, [
        $i,
        $driver_name,
        $recent_cust['phone_no'] ?? 'N/A',
        $recent_cust__->Main_Category_Name ?? 'N/A',
        $cust__->Sub_Category_Name ?? 'N/A',
        $cus_city__->dir_city_name ?? 'N/A',
        $cus_state__->name ?? 'N/A',
        $cus_area__->dir_area_name ?? 'N/A',
        $recent_cust['vehicle_name'] ?? 'N/A',
        $recent_cust['vehicle_no'] ?? 'N/A',
        $recent_cust['Add_RC_owner_name'] ?? 'N/A',
        $recent_cust['tonnage'] ?? 'N/A',
        $recent_cust['seating_capacity'] ?? 'N/A',
        $recent_cust['facilities'] ?? 'N/A',
        $recent_cust['space'] ?? 'N/A',
        $recent_cust['Add_location'] ?? 'N/A',
        isset($recent_cust['Add_insurance_exp_date']) ? date('d-m-Y', strtotime($recent_cust['Add_insurance_exp_date'])) : 'N/A',
        $recent_cust['stand_name'] ?? 'N/A',
        $recent_cust['shop_name'] ?? 'N/A',
        $recent_cust['shop_address'] ?? 'N/A',
        $recent_cust['work_nature'] ?? 'N/A',
        $recent_cust['whatsapp_no'] ?? 'N/A',
        $cus_state__->state_name ?? 'N/A',
        $cus_city__->city_name ?? 'N/A',
        $cus_area__->area_name ?? 'N/A',
        isset($recent_cust['create_on']) ? date('d-m-Y', strtotime($recent_cust['create_on'])) : 'N/A',
        isset($recent_cust['expiry_date']) ? date('d-m-Y', strtotime($recent_cust['expiry_date'])) : 'N/A',
        $recent_cust['reffered_by_phone_no'] ?? 'N/A',
        $recent_cust['reffered_by_name'] ?? 'N/A',
        $cust_package_name_->package_name ?? 'N/A',
        $recent_cust['package_days'] ?? 'N/A',
        $recent_cust['coupon_type'] ?? 'N/A',
        $recent_cust['discount_name'] ?? 'N/A',
        $recent_cust['discount_amount'] ?? 'N/A',
        $recent_cust['package_amount'] ?? 'N/A',
    ]);

    $i++;
}

fclose($output);
exit();
?>