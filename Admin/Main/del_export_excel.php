<?php
// Database connection
include('../config/setup.php');

// Retrieve all filter parameters
$search = $_GET['search'] ?? '';
$vehicle_no = $_GET['vehicle_no'] ?? '';
$state = $_GET['state'] ?? '0';
$district = $_GET['district'] ?? '0';
$city = $_GET['Add_area'] ?? '';

// Base query with delete conditions
$where = "WHERE delete_id = '1' AND delete_approval_status = '1'";

// Apply filters if provided
if (!empty($vehicle_no)) {
    $where .= " AND create_post.vehicle_no = '$vehicle_no' ";
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
if (!empty($search)) {
    $where .= " AND (Driver_Name LIKE '%$search%' OR phone_no LIKE '%$search%' OR category_id LIKE '%$search%')";
}

// Fetch data for Excel export
$sql = "SELECT 
            create_post.*, 
            customer_master.Customer_Name,
            main_category.Main_Category_Name,
            sub_category.Sub_Category_Name,
            dir_state_master.name AS state_name,
            dir_city_master.dir_city_name AS city_name,
            dir_area_master.dir_area_name AS area_name,

            category_package.package_title
        FROM create_post
        LEFT JOIN customer_master ON create_post.phone_no = customer_master.Customer_Phone_No
        LEFT JOIN main_category ON create_post.category_id = main_category.Main_Category_id
        LEFT JOIN sub_category ON create_post.subcategory_id = sub_category.Sub_Category_id
        LEFT JOIN dir_state_master ON create_post.state_id = dir_state_master.state_id
        LEFT JOIN dir_city_master ON create_post.city_id = dir_city_master.dir_city_id
        LEFT JOIN dir_area_master ON create_post.area_id = dir_area_master.dir_area_id
        LEFT JOIN category_package ON create_post.package_id = category_package.package_id

        $where
        ORDER BY create_post.post_id DESC";

$result = mysqli_query($config, $sql); // Use $conn instead of $config if needed

// Generate Excel file
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=filtered_data.xls");

// Print column headers
echo "S.No\tDriver Name\tPhone No\tAddress\tCategory\tSub Category\tVehicle No\tVehicle Name\tState\tCity\tArea\tReason For Delete\tPackage Name\tPackage Expiry\tPackage Amount\tCreate on\tBank Reference No\tPayment Type\tTransport Name\tDelete Date\n";

// Output data
$mc = 1;
while ($row = mysqli_fetch_assoc($result)) {
    $expiry_date = date("d-m-Y", strtotime($row['expiry_date']));
    $online_payment_transcation = mysqli_query($config, "SELECT * FROM online_payment_transcation WHERE Customer_id = '{$row['customer_id']}' ORDER BY Customer_id DESC");
$online_payment_transcation_mc = mysqli_fetch_object($online_payment_transcation);

if ($online_payment_transcation_mc && $online_payment_transcation_mc->transactionId) {
    $online_payment_transcation = $online_payment_transcation_mc->transactionId;
} else {
    $online_payment_transcation = $row['ref_no'];
}

 if($row['payment_type']  == '0')  { 
    $payment_type = "";
 }
      else if($row['payment_type']  == '2')  { 
        $payment_type=  "Bank Payment";
      }
        else { 
           $payment_type ="Cash Payment";
         }
    echo "$mc\t{$row['Customer_Name']}\t{$row['phone_no']}\t{$row['Address']}\t{$row['Main_Category_Name']}\t{$row['Sub_Category_Name']}\t{$row['vehicle_no']}\t{$row['vehicle_name']}\t{$row['state_name']}\t{$row['city_name']}\t{$row['area_name']}\t{$row['delete_remarks']}\t{$row['package_title']}\t{$expiry_date}\t{$row['package_amount']}\t{$row['create_on']}\t{$online_payment_transcation}\t{$payment_type}\t{$row['vehicle_name']}\t{$row['delete_date']}\n";
    
    $mc++;
}

exit;
?>
