<?php 
include('../config/setup.php');

// Get the start and length from DataTable
$start = $_POST['start'];
$length = $_POST['length'];

// Get the search query from the DataTable request
$search_value = isset($_POST['search']['value']) ? $_POST['search']['value'] : '';

// Get the current date
$current_Date = date('Y-m-d');

$response = array(
    "draw" => $_POST['draw'],
    "recordsTotal" => 0,
    "recordsFiltered" => 0,
    "data" => array()
);

// Query to get the total number of records matching the conditions and the search query
$total_records_query = "SELECT COUNT(*) AS total FROM `create_post` WHERE status = '1' AND `expiry_date` >= DATE_SUB(CURDATE(), INTERVAL 10 DAY)";

// Add search condition if there's a search value
if (!empty($search_value)) {
    $total_records_query .= " AND (driver_name LIKE '%$search_value%' OR phone_no LIKE '%$search_value%' OR vehicle_name LIKE '%$search_value%')";
}

$total_records_result = $config->query($total_records_query);
$total_records = $total_records_result->fetch_assoc()['total'];

// Set total records and filtered records
$response['recordsTotal'] = $total_records;
$response['recordsFiltered'] = $total_records;

// Query to fetch records with pagination and search query
$or__ = "SELECT * FROM `create_post` WHERE status = '1' AND `expiry_date` >= DATE_SUB(CURDATE(), INTERVAL 10 DAY)";

// Add search condition to the main query
if (!empty($search_value)) {
    $or__ .= " AND (driver_name LIKE '%$search_value%' OR phone_no LIKE '%$search_value%' OR vehicle_name LIKE '%$search_value%')";
}

$or__ .= " ORDER BY post_id DESC LIMIT $start, $length";
$maincate__ = mysqli_query($config, $or__);
$serial_number = $start + 1; // Start from the current page's first item

// Loop through the results
while ($mac__ = mysqli_fetch_object($maincate__)) {
    $post_addon_ = $mac__->post_addon;
    $post_addon = date("d-m-Y", strtotime($post_addon_));

    $exp_date = $mac__->expiry_date;
    $exp_date___ = date("d-m-Y", strtotime($exp_date));

    $post_id = $mac__->post_id;

    // Query to fetch specific post details
    $or = "SELECT * FROM `create_post` WHERE post_id = '$post_id' AND `expiry_date` >= DATE_SUB(CURDATE(), INTERVAL 10 DAY) AND delete_id = '0' AND status = '1'";
    $maincate3 = mysqli_query($config, $or);

    if (mysqli_num_rows($maincate3) > 0) {
        $mac3 = mysqli_fetch_object($maincate3);

        // Prepare data
        $data = array(
            "s_no" => $serial_number++, // Increment serial number
            "driver_name" => $mac3->driver_name,
            "phone_no" => $mac3->phone_no,
            "category_name" => getCategoryName($mac3->category_id, $config),
            "subcategory_name" => getSubCategoryName($mac3->subcategory_id, $config),
            "vehicle_type" => getVehicleType($mac3->vehicle_type_id, $config),
            "vehicle_name" => $mac3->vehicle_name,
            "vehicle_no" => $mac3->vehicle_no,
            "rc_name" => $mac3->Add_RC_owner_name,
            "tonnage" => $mac3->tonnage ? $mac3->tonnage : '',
            "seating_capacity" => $mac3->seating_capacity ? $mac3->seating_capacity : '',
            "facilities" => $mac3->facilities ? $mac3->facilities : '',
            "specifications" => $mac3->space ? $mac3->space : '',
            "location" => $mac3->Add_location ? $mac3->Add_location : '',
            "insurance_expiry" => $mac3->Add_insurance_exp_date ? $mac3->Add_insurance_exp_date : '',
            "stand_name" => $mac3->stand_name ? $mac3->stand_name : '',
            "shop_name" => $mac3->shop_name ? $mac3->shop_name : '',
            "shop_address" => $mac3->shop_address ? $mac3->shop_address : '',
            "work_nature" => $mac3->work_nature ? $mac3->work_nature : '',
            "loader_from_date" => $mac3->loader_from_date,
            "loader_to_date" => $mac3->loader_to_date,
            "loader_from_place" => $mac3->loader_from_place,
            "loader_to_place" => $mac3->loader_to_place,
            "vehicle_photo" => '<img src="../../photos/vehicle/' . $mac3->vehicle_photo . '" style="height: 131px !important; width: 150px !important; margin: auto;">',
            "whatsapp_no" => $mac3->whatsapp_no,
            "city" => getCityName($mac3->city_id, $config),
            "area" => getAreaName($mac3->area_id, $config),
            "sub_area" => getSubAreaName($mac3->sub_area_id, $config),
            "create_on" => date('d-m-Y', strtotime($mac3->create_on)),
            "expiry_date" => date('d-m-Y', strtotime($mac3->expiry_date)),
            "referred_by_phone_no" => $mac3->reffered_by_phone_no,
            "referred_by_name" => $mac3->reffered_by_name,
            "package_name" => getPackageName($mac3->package_id, $config),
            "package_valid_days" => $mac3->package_days,
            "coupon_type" => $mac3->coupon_type ? $mac3->coupon_type : '',
            "coupon_name" => $mac3->discount_name ? $mac3->discount_name : '',
            "discount_amount" => $mac3->discount_amount ? $mac3->discount_amount : '',
            "payment_type" => $mac3->payment_type == '0' ? '' : ($mac3->payment_type == '2' ? 'Bank Payment' : 'Cash Payment'),
            "amount" => $mac3->net_amount ? $mac3->net_amount : $mac3->package_amount,
            "action" => '<a href="ad_post_renewal.php?pid=' . $mac3->post_id . '" class="btn btn-primary">Renewal</a>'
        );

        // Add to response data
        $response['data'][] = $data;
    }
}

// Return data in JSON format
echo json_encode($response);

// Helper functions for fetching related data
// ...

// Return data in JSON format

// Helper functions for fetching related data

function getCategoryName($categoryId, $config) {
    $result = mysqli_query($config, "SELECT * FROM main_category WHERE Main_Category_id = '$categoryId'");
    $row = mysqli_fetch_object($result);
    return $row ? $row->Main_Category_Name : '';
   echo  $row->category_name;
    exit;
}

function getSubCategoryName($subcategoryId, $config) {
    $result = mysqli_query($config, "SELECT * FROM sub_category WHERE Sub_Category_id = '$subcategoryId'");
    $row = mysqli_fetch_object($result);
    return $row ? $row->Sub_Category_Name : '';
}

function getVehicleType($vehicleTypeId, $config) {
    $result = mysqli_query($config, "SELECT * FROM vehicle_type WHERE Vehicle_type_id = '$vehicleTypeId'");
    $row = mysqli_fetch_object($result);
    return $row ? $row->Vehicle_type_name : '';
}

function getCityName($cityId, $config) {
    $result = mysqli_query($config, "SELECT * FROM dir_city_master WHERE dir_city_id = '$cityId'");
    $row = mysqli_fetch_object($result);
    return $row ? $row->dir_city_name : '';
}

function getAreaName($areaId, $config) {
    $result = mysqli_query($config, "SELECT * FROM dir_area_master WHERE dir_area_id = '$areaId'");
    $row = mysqli_fetch_object($result);
    return $row ? $row->dir_area_name : '';
}

function getSubAreaName($subAreaId, $config) {
    $result = mysqli_query($config, "SELECT * FROM sub_area_master WHERE sub_area_id = '$subAreaId'");
    $row = mysqli_fetch_object($result);
    return $row ? $row->sub_area_name : '';
}

function getPackageName($packageId, $config) {
    $result = mysqli_query($config, "SELECT * FROM category_package WHERE package_id = '$packageId'");
    $row = mysqli_fetch_object($result);
    return $row ? $row->package_title : '';
}
?>
