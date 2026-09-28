<?php include('../../config/setup.php');?>
<?php

if (!isset($_POST['post_add'])) {
    exit;
}

mysqli_report(MYSQLI_REPORT_OFF);

if (!function_exists('add_post_val')) {
    function add_post_val($key)
    {
        return isset($_POST[$key]) ? trim((string)$_POST[$key]) : '';
    }
}

if (!function_exists('add_sql_str')) {
    function add_sql_str($config, $value)
    {
        return "'".mysqli_real_escape_string($config, (string)$value)."'";
    }
}

if (!function_exists('add_sql_int')) {
    function add_sql_int($value, $default = 0)
    {
        $value = trim((string)$value);
        if ($value === '' || !is_numeric($value)) {
            return (string)intval($default);
        }
        return (string)intval($value);
    }
}

if (!function_exists('add_parse_date')) {
    function add_parse_date($value)
    {
        $value = trim((string)$value);
        if ($value === '' || $value === '0000-00-00' || strpos($value, '0000-00-00') === 0) {
            return '';
        }
        $ts = strtotime($value);
        if ($ts === false) {
            return '';
        }
        $out = date('Y-m-d', $ts);
        if (($out === '1970-01-01' || $out === '1969-12-31') && strpos($value, '1970') === false) {
            return '';
        }
        return $out;
    }
}

if (!function_exists('add_sql_date')) {
    function add_sql_date($value, $fallback = '')
    {
        $parsed = add_parse_date($value);
        if ($parsed !== '') {
            return "'".$parsed."'";
        }
        if ($fallback !== '') {
            return "'".$fallback."'";
        }
        return 'NULL';
    }
}

$addcatephoto = '';
if (!empty($_FILES['Add_vehicle_photo']['name']) && !empty($_FILES['Add_vehicle_photo']['tmp_name'])) {
    $addcatephoto = basename($_FILES['Add_vehicle_photo']['name']);
    $photoDir = dirname(__DIR__, 3) . DIRECTORY_SEPARATOR . 'photos' . DIRECTORY_SEPARATOR . 'vehicle';
    if (!is_dir($photoDir)) {
        mkdir($photoDir, 0775, true);
    }
    move_uploaded_file($_FILES['Add_vehicle_photo']['tmp_name'], $photoDir . DIRECTORY_SEPARATOR . $addcatephoto);
}

$current_Date = date('Y-m-d');
$customer_id = add_sql_int(add_post_val('customerid'), 0);
$subcategory_id = add_sql_int(add_post_val('Add_sub_category'), 0);
$area_id = add_sql_int(add_post_val('Add_area'), 0);

if ($customer_id === '0') {
    $sql = "SELECT * FROM create_post WHERE customer_id='0' ORDER BY create_on DESC";
} else {
    $sql = "SELECT * FROM create_post WHERE subcategory_id=$subcategory_id AND area_id=$area_id AND customer_id=$customer_id ORDER BY create_on DESC";
}
$sdate = mysqli_query($config, $sql);
$data = ($sdate) ? mysqli_fetch_object($sdate) : null;

if ($data) {
    echo "<script>window.location.href='../create_post.php?msgerror=error';</script>";
    exit;
}

$package_days = add_sql_int(add_post_val('Add_days'), 0);
$payment_type = add_post_val('payment_type');
$final_expiry_date = $current_Date;
if ($package_days !== '0') {
    $final_expiry_date = date('Y-m-d', strtotime($current_Date.' +'.intval($package_days).' days'));
}

$payment_type_sql = 'NULL';
if ($payment_type !== '' && is_numeric($payment_type)) {
    $payment_type_sql = add_sql_int($payment_type, 0);
}

$columns = array(
    'driver_name' => add_sql_str($config, add_post_val('Add_driver_name')),
    'vehicle_no' => add_sql_str($config, add_post_val('Add_vehicle_no')),
    'vehicle_photo' => add_sql_str($config, $addcatephoto),
    'phone_no' => add_sql_str($config, add_post_val('Add_phone_no')),
    'whatsapp_no' => add_sql_str($config, add_post_val('Add_whatsapp_no')),
    'address' => add_sql_str($config, add_post_val('Add_address')),
    'state_id' => add_sql_int(add_post_val('Add_state'), 24),
    'city_id' => add_sql_int(add_post_val('Add_city'), 0),
    'area_id' => $area_id,
    'status' => add_sql_int(add_post_val('Add_status'), 0),
    'post_addon' => add_sql_str($config, $current_Date),
    'vehicle_name' => add_sql_str($config, add_post_val('Add_vehicle_name')),
    'category_id' => add_sql_int(add_post_val('Add_main_cate'), 0),
    'subcategory_id' => $subcategory_id,
    'meta_keyword' => add_sql_str($config, add_post_val('Add_meta_keyword')),
    'create_on' => add_sql_str($config, $current_Date),
    'Add_load_detail' => add_sql_str($config, add_post_val('Add_load_detail')),
    'Add_location' => add_sql_str($config, add_post_val('Add_location')),
    'Add_Registration_date' => add_sql_date(add_post_val('Add_Registration_date'), $current_Date),
    'Add_RC_owner_name' => add_sql_str($config, add_post_val('Add_RC_owner_name')),
    'Add_insurance_exp_date' => add_sql_date(add_post_val('Add_insurance_exp_date'), $current_Date),
    'FC_date' => add_sql_date(add_post_val('FC_date'), $current_Date),
    'remarks' => add_sql_str($config, add_post_val('Add_remarks')),
    'package_id' => add_sql_int(add_post_val('Add_package'), 0),
    'package_amount' => add_sql_str($config, add_post_val('Add_amount')),
    'package_days' => add_sql_str($config, $package_days),
    'customer_id' => $customer_id,
    'expiry_date' => add_sql_str($config, $final_expiry_date),
    'day_duty' => add_sql_int(add_post_val('day_duty'), 0),
    'night_duty' => add_sql_int(add_post_val('night_duty'), 0),
    'vehicle_type_id' => add_sql_int(add_post_val('vehicle_type_id'), 0),
    'seating_capacity' => add_sql_str($config, add_post_val('seating_capacity')),
    'facilities' => add_sql_str($config, add_post_val('facilities')),
    'space' => add_sql_str($config, add_post_val('space')),
    'size' => add_sql_str($config, add_post_val('size')),
    'tonnage' => add_sql_str($config, add_post_val('tonnage')),
    'shop_name' => add_sql_str($config, add_post_val('shop_name')),
    'work_nature' => add_sql_str($config, add_post_val('work_nature')),
    'shop_address' => add_sql_str($config, add_post_val('shop_address')),
    'net_amount' => add_sql_str($config, str_replace(',', '', add_post_val('net_amount'))),
    'stand_name' => add_sql_str($config, add_post_val('stand_name')),
    'sub_area_id' => add_sql_int(add_post_val('Add_sub_area'), 0),
    'reffered_by_phone_no' => add_sql_str($config, substr(add_post_val('reffered_by_phone_no'), 0, 12)),
    'reffered_by_name' => add_sql_str($config, add_post_val('reffered_by_name')),
    'payment_type' => $payment_type_sql,
    'discount_amount' => add_sql_str($config, add_post_val('less_amount')),
    'discount_name' => add_sql_str($config, add_post_val('coupon_code')),
    'coupon_type' => add_sql_int(add_post_val('coupon_type'), 0),
    'ref_no' => add_sql_str($config, add_post_val('reference_number')),
    'other_vehicle_type' => add_sql_str($config, add_post_val('other_vehicle_type')),
    'vehicle_body_type' => add_sql_str($config, add_post_val('vehicle_body_type')),
    'disable_status' => '0',
    'loader_status' => '0',
    'loader_from_date_' => add_sql_str($config, $current_Date),
    'loader_to_date_' => add_sql_str($config, $current_Date),
    'loader_from_place_' => add_sql_str($config, ''),
    'loader_to_place_' => add_sql_str($config, ''),
    'loader_from_time_' => add_sql_str($config, ''),
    'loader_to_time_' => add_sql_str($config, ''),
    'loader_space_' => add_sql_str($config, ''),
    'loader_remarks_' => add_sql_str($config, ''),
    'renewal_post' => '0',
    'delete_id' => '0',
    'delete_remarks' => add_sql_str($config, ''),
    'delete_approval_status' => '0',
    'delete_reason' => add_sql_str($config, ''),
    'state_status' => add_sql_str($config, ''),
);

$col_sql = implode(', ', array_keys($columns));
$val_sql = implode(', ', array_values($columns));
$insert_sql = "INSERT INTO create_post ($col_sql) VALUES ($val_sql)";

$mysql_error = '';
try {
    $addmaincate = mysqli_query($config, $insert_sql);
    if ($addmaincate == false) {
        $mysql_error = mysqli_error($config);
    }
} catch (Throwable $e) {
    $addmaincate = false;
    $mysql_error = $e->getMessage();
}

if ($addmaincate == false) {
    header('Content-Type: text/html; charset=utf-8');
    echo "<h3>MySQL Error</h3>";
    echo "<pre>".htmlspecialchars($mysql_error !== '' ? $mysql_error : mysqli_error($config))."</pre>";
    echo "<h4>SQL</h4>";
    echo "<pre>".htmlspecialchars($insert_sql)."</pre>";
    echo "<p><a href='../create_post.php?erro=0'>Back to list</a></p>";
    exit;
}

$lastInsertId = mysqli_insert_id($config);

if ($lastInsertId && isset($_POST['sub_cate_filter']) && is_array($_POST['sub_cate_filter'])) {
    $filters = array_filter($_POST['sub_cate_filter']);
    foreach ($filters as $filter_id) {
        $filter_id = add_sql_int($filter_id, 0);
        if ($filter_id === '0') {
            continue;
        }
        mysqli_query($config, "INSERT INTO add_filter (filter_id, post_id, category_id, subcategory_id)
            VALUES ('$filter_id', '$lastInsertId', ".add_sql_int(add_post_val('Add_main_cate'), 0).", $subcategory_id)");
    }
}

echo "<script>window.location.href='../create_post.php?msg=505';</script>";

?>
