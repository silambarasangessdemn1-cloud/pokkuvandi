<?php
include('../config/setup.php'); // Database connection

// Set the filename for download
$fileName = "Post_Report.xls";




// Set headers for Excel download
header("Content-Disposition: attachment; filename=\"$fileName\"");
header("Content-Type: application/vnd.ms-excel");

// Fetch only expired posts (where expiry_date < current date)
date_default_timezone_set("Asia/Kolkata"); // Set timezone to Indian Standard Time (IST)
$current_date = date("Y-m-d"); // Get current date in IST

$query = "SELECT create_post.*, 
online_payment_transcation.transactionId AS paid_transaction_id,
            online_payment_transcation.Paid_Amout AS paid_amount

FROM create_post 
LEFT JOIN online_payment_transcation 
ON create_post.customer_id = online_payment_transcation.Customer_id 
WHERE create_post.delete_id = '0' 
ORDER BY create_post.post_id DESC";
      
          $result = mysqli_query($config, $query);

// Initialize output array
$export_data = [];

// Add column headers
$export_data[] = [
    'S No', 'Customer', 'Phone No', 'Category', 'Sub Category', 'Vehicle Type', 'Vehicle Name',
    'Vehicle RC No', 'RC Name', 'Tonage', 'Seating', 'Facilities', 'Specification',
    'Active Location', 'Insurance Expiry', 'Stand Name', 'Shop Name', 'Shop Address', 'Work Nature',
    'WhatsApp No',
    'State', 'District', 'City', 'Create On', 'Expiry Date', 'Referred By Mobile No',
    'Referred By Name','paymentStatus','amount'
];

// Loop through expired posts
$i = 1;
while ($row = mysqli_fetch_object($result)) {
    if (!empty($row->paid_amount)) {
        $paymentStatus = "Paid (Transaction ID: " . $row->paid_transaction_id . ")";
        $amount = "₹" . $row->paid_amount;
    } elseif ($row->payment_type == '1') {
        $paymentStatus = "Admin Cash";
        $amount = "₹" . $row->package_amount;
    } elseif ($row->payment_type == '2') {
        $paymentStatus = "Admin Cash + Transaction (Ref No: " . $row->ref_no . ")";
        $amount = "₹" . $row->package_amount;
    } else {
        $paymentStatus = "Not Paid";
        $amount = "-";
    }
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
      
        $row->whatsapp_no,
        getState($row->state_id, $config),
        getCity($row->city_id, $config),
        getArea($row->area_id, $config),
        formatDate($row->create_on),
        formatDate($row->expiry_date),
        $row->reffered_by_phone_no,
        $row->reffered_by_name,
        $paymentStatus,
        $amount
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

// Function to fetch state name
function getState($id, $config) {
    $res = mysqli_query($config, "SELECT name FROM dir_state_master WHERE state_id='$id'");
    return mysqli_fetch_object($res)->name ?? 'N/A';
}

// Function to fetch city name
function getCity($id, $config) {
    $res = mysqli_query($config, "SELECT dir_city_name FROM dir_city_master WHERE dir_city_id='$id'");
    return mysqli_fetch_object($res)->dir_city_name ?? 'N/A';
}

// Function to fetch area name
function getArea($id, $config) {
    $res = mysqli_query($config, "SELECT dir_area_name FROM dir_area_master WHERE dir_area_id='$id'");
    return mysqli_fetch_object($res)->dir_area_name ?? 'N/A';
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
