<?php 
include('../config/setup.php');

// Set headers to force download as an Excel file
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=filtered_data.xls");
header("Pragma: no-cache");
header("Expires: 0");

// Retrieve filter parameters from URL
$where = " WHERE 1 "; 

if (!empty($_GET['from_date']) && !empty($_GET['to_date'])) {
    $from_date = $_GET['from_date'];
    $to_date = $_GET['to_date'];
    $where .= " AND create_on BETWEEN '$from_date' AND '$to_date' ";
}
if (!empty($_GET['main_cate_Name']) && $_GET['main_cate_Name'] != '0') {
    $main_category = $_GET['main_cate_Name'];
    $where .= " AND category_id = '$main_category' ";
}
if (!empty($_GET['district']) && $_GET['district'] != '0') {
    $district = $_GET['district'];
    $where .= " AND city_id = '$district' ";
}
if (!empty($_GET['Add_area']) && $_GET['Add_area'] != '0') {
    $city = $_GET['Add_area'];
    $where .= " AND area_id = '$city' ";
}
if (!empty($_GET['state']) && $_GET['state'] != '0') {
    $state = $_GET['state'];
    $where .= " AND state_id = '$state' ";
}
if (!empty($_GET['search_input'])) {
    $search_value = mysqli_real_escape_string($config, $_GET['search_input']);
    $where .= " AND (create_post.driver_name LIKE '%$search_value%' 
                      OR create_post.vehicle_no LIKE '%$search_value%'
                      OR create_post.phone_no LIKE '%$search_value%'
                      OR create_post.whatsapp_no LIKE '%$search_value%')";
}
// Fetch data
$query = "SELECT * FROM create_post $where";
$result = mysqli_query($config, $query);

$export_data = [];
$i = 1;
if (isset($_GET['view_all'])) {
    // Get all records without pagination
    $total_records_query = mysqli_query($config, "SELECT COUNT(*) AS total FROM create_post $where");
    $total_records = mysqli_fetch_assoc($total_records_query)['total'];
    $total_pages = 1; // Only one page for "View All" without pagination

    // Fetch all records without LIMIT
    $result = mysqli_query($config, "SELECT * FROM create_post $where");
}
while ($recent_cust = mysqli_fetch_object($result)) {
    // Fetch related data
    $recent_cust__ = mysqli_fetch_object(mysqli_query($config, "SELECT Main_Category_Name FROM main_category WHERE Main_Category_id='$recent_cust->category_id'"));
    $cust__ = mysqli_fetch_object(mysqli_query($config, "SELECT Sub_Category_Name FROM sub_category WHERE Sub_Category_id='$recent_cust->subcategory_id'"));
    $cus_city__ = mysqli_fetch_object(mysqli_query($config, "SELECT dir_city_name FROM dir_city_master WHERE dir_city_id='$recent_cust->city_id'"));
    $cus_state__ = mysqli_fetch_object(mysqli_query($config, "SELECT name FROM dir_state_master WHERE state_id='$recent_cust->state_id'"));
    $cus_area__ = mysqli_fetch_object(mysqli_query($config, "SELECT dir_area_name FROM dir_area_master WHERE dir_area_id='$recent_cust->area_id'"));
    $cust_package_name_ = mysqli_fetch_object(mysqli_query($config, "SELECT package_title FROM category_package WHERE package_id='$recent_cust->package_id'"));
    $cus_vehicle_type__ = mysqli_fetch_object(mysqli_query($config, "SELECT Vehicle_type_name FROM vehicle_type WHERE Vehicle_type_id='$recent_cust->vehicle_type_id'"));
    $online_payment_transcation=mysqli_query($config,"select * from online_payment_transcation where Customer_id='$recent_cust->customer_id' ");
    $online_payment_transcation_1=mysqli_fetch_object($online_payment_transcation);
    
    $paidTransactionID = $online_payment_transcation_1->transactionId;
    $paidAmount = $macate->Paid_Amout;
    $paymentType = $recent_cust->payment_type; // 1 = Admin Cash, 2 = Admin Cash + Transaction
    $refNo = $recent_cust->ref_no; // Transaction number
    $packageAmount = $recent_cust->package_amount; // Amount for package

    // Determine Payment Status
    if (!empty($paidAmount)) {
        $paymentStatus = "Paid (Transaction ID: $paidTransactionID)";
        $amount = "₹$paidAmount";
    } elseif ($paymentType == '1') {
        $paymentStatus = "Admin Cash";
        $amount = "₹$packageAmount";
    } elseif ($paymentType == '2') {
        $paymentStatus = "Admin Cash + Transaction (Ref No: $refNo)";
        $amount = "₹$packageAmount";
    } 
    elseif($paymentType == '0' && $packageAmount== '0'){
        $paymentStatus = "Free";
        $amount = "₹$packageAmount";
    }
    
    elseif($paymentType == '0' && $packageAmount!= '0'){
        $paymentStatus = "Paid (Transaction ID: $paidTransactionID)";
        $amount = "₹$packageAmount";
    }else {
        $paymentStatus = "Not Paid";
        $amount = "-";
    }
    // Convert date values
    $Add_insurance_exp_date = strtotime($recent_cust->Add_insurance_exp_date);
    $loader_from_date = strtotime($recent_cust->loader_from_date);
    $loader_to_date = strtotime($recent_cust->loader_to_date);
    $create_on = strtotime($recent_cust->create_on);
    $expiry_date = strtotime($recent_cust->expiry_date);

    // Prepare row data
    $data_arr = [
        'S No' => $i,
        'Customer' => $recent_cust->driver_name,
        'Phone No' => $recent_cust->phone_no,
        'Category' => $recent_cust__->Main_Category_Name ?? '',
        'Sub category' => $cust__->Sub_Category_Name ?? '',
        'Vehicle Type' => $cus_vehicle_type__->Vehicle_type_name ?? '',
        'Vehicle Name' => $recent_cust->vehicle_name,
        'Vehicle RC No' => $recent_cust->vehicle_no,
        'RC Name' => $recent_cust->Add_RC_owner_name,
        'Tonage' => $recent_cust->tonnage,
        'Seating' => $recent_cust->seating_capacity,
        'Facilities' => $recent_cust->facilities,
        'Specification' => $recent_cust->space,
        'Active Location' => $recent_cust->Add_location,
        'Insurance Expiry' => date('d-m-Y', $Add_insurance_exp_date),
        'Stand Name' => $recent_cust->stand_name,
        'Shop Name' => $recent_cust->shop_name,
        'Shop Address' => $recent_cust->shop_address,
        'Work Nature' => $recent_cust->work_nature,
       
        'Whatsapp No' => $recent_cust->whatsapp_no,
        'State' => $cus_state__->name ?? '',
        'District' => $cus_city__->dir_city_name ?? '',
        'City' => $cus_area__->dir_area_name ?? '',
        'Create On' => date('d-m-Y', $create_on),
        'Expiry Date' => date('d-m-Y', $expiry_date),
        'Referred By Mobile No' => $recent_cust->reffered_by_phone_no,
        'Referred By Name' => $recent_cust->reffered_by_name,
        'Package Name' => $cust_package_name_->package_title ?? '',
        'Package Valid Days' => $recent_cust->package_days,
        'Coupon Type' => $recent_cust->coupon_type,
        'Coupon Name' => $recent_cust->discount_name,
        'Discount Amount' => $recent_cust->discount_amount,
        'Payment Type' => $paymentStatus,
        
        'Amount' => $recent_cust->package_amount,
    ];

    array_push($export_data, $data_arr);
    $i++;
}

// Function to clean and format data
function filterData(&$str) {
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}

// Output Excel data
if (!empty($export_data)) {
    // Print column names
    echo implode("\t", array_keys($export_data[0])) . "\n";

    // Print rows
    foreach ($export_data as $row) {
        array_walk($row, 'filterData');
        echo implode("\t", array_values($row)) . "\n";
    }
}
exit;
?>
