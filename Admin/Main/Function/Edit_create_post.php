<?php include('../../config/setup.php');?>
<?php

if (!isset($_POST['post_edit'])) {
    exit;
}

mysqli_report(MYSQLI_REPORT_OFF);

if (!function_exists('edit_post_val')) {
    function edit_post_val($key)
    {
        return isset($_POST[$key]) ? trim((string)$_POST[$key]) : '';
    }
}

if (!function_exists('edit_sql_str')) {
    function edit_sql_str($config, $value)
    {
        return "'".mysqli_real_escape_string($config, (string)$value)."'";
    }
}

if (!function_exists('edit_sql_int')) {
    function edit_sql_int($value, $default = 0)
    {
        $value = trim((string)$value);
        if ($value === '' || !is_numeric($value)) {
            return (string)intval($default);
        }
        return (string)intval($value);
    }
}

if (!function_exists('edit_parse_date')) {
    function edit_parse_date($value)
    {
        $value = trim((string)$value);
        if ($value === '' || $value === '0000-00-00' || strpos($value, '0000-00-00') === 0) {
            return '';
        }
        if (preg_match('/^(\d{1,2})[.\-\/](\d{1,2})[.\-\/](\d{4})$/', $value, $m)) {
            if ((int)$m[1] > 12) {
                $value = $m[3].'-'.str_pad($m[2], 2, '0', STR_PAD_LEFT).'-'.str_pad($m[1], 2, '0', STR_PAD_LEFT);
            } else {
                $ts = strtotime($value);
                if ($ts !== false) {
                    $out = date('Y-m-d', $ts);
                    if ($out !== '1970-01-01' && $out !== '1969-12-31') {
                        return $out;
                    }
                }
            }
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

if (!function_exists('edit_has_column')) {
    function edit_has_column($config, $column)
    {
        static $cache = array();
        if (array_key_exists($column, $cache)) {
            return $cache[$column];
        }
        $safe = mysqli_real_escape_string($config, $column);
        $result = mysqli_query($config, "SHOW COLUMNS FROM create_post LIKE '$safe'");
        $cache[$column] = ($result && mysqli_num_rows($result) > 0);
        return $cache[$column];
    }
}

$addcatephoto = '';
if (!empty($_FILES['Edit_vehicle_photo']['name']) && !empty($_FILES['Edit_vehicle_photo']['tmp_name'])) {
    $addcatephoto = basename($_FILES['Edit_vehicle_photo']['name']);
    $photoDir = dirname(__DIR__, 3) . DIRECTORY_SEPARATOR . 'photos' . DIRECTORY_SEPARATOR . 'vehicle';
    if (!is_dir($photoDir)) {
        mkdir($photoDir, 0775, true);
    }
    move_uploaded_file($_FILES['Edit_vehicle_photo']['tmp_name'], $photoDir . DIRECTORY_SEPARATOR . $addcatephoto);
}

$expired = edit_post_val('expired');
$package_days = edit_sql_int(edit_post_val('Add_days'), 0);
$paid_status = edit_post_val('paid_status');
$paid_on = edit_parse_date(edit_post_val('paid_on'));
$package_start_date = edit_parse_date(edit_post_val('package_start_date'));
$utr_date = edit_parse_date(edit_post_val('utr_date'));
$post_id = mysqli_real_escape_string($config, edit_post_val('id'));

if (!edit_has_column($config, 'activation_popup_shown')) {
    mysqli_query($config, "ALTER TABLE create_post ADD COLUMN activation_popup_shown TINYINT(1) DEFAULT 0");
}

$current_status = '0';
$current_post_addon = '';
$current_popup_shown = 0;
$select_cols = "status, post_addon";
if (edit_has_column($config, 'activation_popup_shown')) {
    $select_cols .= ", activation_popup_shown";
}
$current_status_query = mysqli_query($config, "SELECT $select_cols FROM create_post WHERE post_id='$post_id' LIMIT 1");
if ($current_status_query) {
    $current_status_data = mysqli_fetch_assoc($current_status_query);
    if (is_array($current_status_data)) {
        $current_status = isset($current_status_data['status']) ? $current_status_data['status'] : '0';
        $current_post_addon = isset($current_status_data['post_addon']) ? $current_status_data['post_addon'] : '';
        $current_popup_shown = isset($current_status_data['activation_popup_shown']) ? intval($current_status_data['activation_popup_shown']) : 0;
    }
}

$auto_status = edit_post_val('Add_status') !== '' ? edit_sql_int(edit_post_val('Add_status'), 0) : '0';
$payment_type_value = 'NULL';
$payment_confirmed_sql = 'NULL';

if ($paid_status == 'pending' || $paid_status == 'free') {
    if ($paid_status == 'pending') {
        $auto_status = '0';
    }
    $payment_type_value = 'NULL';
    $payment_confirmed_sql = 'NULL';
} elseif ($paid_status == '0' || $paid_status == '1' || $paid_status == '2' || $paid_status == '3') {
    $auto_status = '1';
    $payment_type_value = edit_sql_int($paid_status, 0);
    $payment_confirmed_sql = ($paid_on !== '') ? "'$paid_on'" : 'NOW()';
} elseif ($paid_status !== '' && is_numeric($paid_status)) {
    $payment_type_value = edit_sql_int($paid_status, 0);
    $payment_confirmed_sql = 'NULL';
}

$final_package_start_date = $package_start_date;
if ($final_package_start_date === '') {
    if ($current_status == '0' && $auto_status == '1') {
        $final_package_start_date = date('Y-m-d');
    } else {
        $existing_addon = edit_parse_date($current_post_addon);
        if ($existing_addon !== '') {
            $final_package_start_date = $existing_addon;
        } elseif ($paid_on !== '') {
            $final_package_start_date = $paid_on;
        } elseif ($utr_date !== '') {
            $final_package_start_date = $utr_date;
        } else {
            $final_package_start_date = date('Y-m-d');
        }
    }
}

$expiry_date_from_form = edit_parse_date(edit_post_val('Add_date'));
if ($expiry_date_from_form !== '') {
    $futureDate = $expiry_date_from_form;
} else {
    $futureDate = date('Y-m-d', strtotime($final_package_start_date.' +'.intval($package_days).' days'));
    $futureDate = edit_parse_date($futureDate);
    if ($futureDate === '') {
        $futureDate = $final_package_start_date;
    }
}

$set = array();
if ($addcatephoto !== '') {
    $set[] = "vehicle_photo=".edit_sql_str($config, $addcatephoto);
}

$set[] = "driver_name=".edit_sql_str($config, edit_post_val('Add_driver_name'));
$set[] = "vehicle_no=".edit_sql_str($config, edit_post_val('Add_vehicle_no'));
$set[] = "phone_no=".edit_sql_str($config, edit_post_val('Add_phone_no'));
$set[] = "whatsapp_no=".edit_sql_str($config, edit_post_val('Add_whatsapp_no'));
$set[] = "address=".edit_sql_str($config, edit_post_val('Add_address'));
$set[] = "city_id=".edit_sql_int(edit_post_val('Add_city'), 0);
$set[] = "area_id=".edit_sql_int(edit_post_val('Add_area'), 0);
$set[] = "status=".edit_sql_int($auto_status, 0);
$set[] = "vehicle_name=".edit_sql_str($config, edit_post_val('Add_vehicle_name'));
$set[] = "category_id=".edit_sql_int(edit_post_val('Add_main_cate'), 0);
$set[] = "subcategory_id=".edit_sql_int(edit_post_val('Add_sub_category'), 0);
$set[] = "meta_keyword=".edit_sql_str($config, edit_post_val('Add_meta_keyword'));
$set[] = "Add_load_detail=".edit_sql_str($config, edit_post_val('Add_load_detail'));
$set[] = "Add_location=".edit_sql_str($config, edit_post_val('Add_location'));
$set[] = "Add_RC_owner_name=".edit_sql_str($config, edit_post_val('Add_RC_owner_name'));
$set[] = "remarks=".edit_sql_str($config, edit_post_val('Add_remarks'));
$set[] = "package_id=".edit_sql_int(edit_post_val('Add_package'), 0);
$set[] = "package_amount=".edit_sql_str($config, edit_post_val('Add_amount'));
$set[] = "package_days=".edit_sql_str($config, $package_days);
$set[] = "customer_id=".edit_sql_int(edit_post_val('customerid'), 0);
$set[] = "expiry_date=".edit_sql_str($config, $futureDate);
$set[] = "post_addon=".edit_sql_str($config, $final_package_start_date);
$set[] = "day_duty=".edit_sql_int(edit_post_val('day_duty'), 0);
$set[] = "night_duty=".edit_sql_int(edit_post_val('night_duty'), 0);
$set[] = "vehicle_type_id=".edit_sql_int(edit_post_val('vehicle_type_id'), 0);
$set[] = "seating_capacity=".edit_sql_str($config, edit_post_val('seating_capacity'));
$set[] = "facilities=".edit_sql_str($config, edit_post_val('facilities'));
$set[] = "space=".edit_sql_str($config, edit_post_val('space'));
$set[] = "size=".edit_sql_str($config, edit_post_val('size'));
$set[] = "tonnage=".edit_sql_str($config, edit_post_val('tonnage'));
$set[] = "shop_name=".edit_sql_str($config, edit_post_val('shop_name'));
$set[] = "work_nature=".edit_sql_str($config, edit_post_val('work_nature'));
$set[] = "shop_address=".edit_sql_str($config, edit_post_val('shop_address'));
$set[] = "net_amount=".edit_sql_str($config, str_replace(',', '', edit_post_val('net_amount')));
$set[] = "stand_name=".edit_sql_str($config, edit_post_val('stand_name'));
$set[] = "sub_area_id=".edit_sql_int(edit_post_val('Add_sub_area'), 0);
$set[] = "reffered_by_phone_no=".edit_sql_str($config, substr(edit_post_val('reffered_by_phone_no'), 0, 12));
$set[] = "reffered_by_name=".edit_sql_str($config, edit_post_val('reffered_by_name'));
$set[] = "state_id=".edit_sql_int(edit_post_val('Add_state'), 24);
$set[] = "payment_type=".$payment_type_value;
$set[] = "ref_no=".edit_sql_str($config, edit_post_val('ref_no'));
$set[] = "other_vehicle_type=".edit_sql_str($config, edit_post_val('other_vehicle_type'));
$set[] = "vehicle_body_type=".edit_sql_str($config, edit_post_val('vehicle_body_type'));
$set[] = "utr_number=".edit_sql_str($config, edit_post_val('utr_number'));

$reg_date = edit_parse_date(edit_post_val('Add_Registration_date'));
if ($reg_date !== '') {
    $set[] = "Add_Registration_date=".edit_sql_str($config, $reg_date);
}
$ins_date = edit_parse_date(edit_post_val('Add_insurance_exp_date'));
if ($ins_date !== '') {
    $set[] = "Add_insurance_exp_date=".edit_sql_str($config, $ins_date);
}
$fc_date = edit_parse_date(edit_post_val('FC_date'));
if ($fc_date !== '') {
    $set[] = "FC_date=".edit_sql_str($config, $fc_date);
}

if (edit_has_column($config, 'utr_date')) {
    $set[] = "utr_date=".($utr_date !== '' ? edit_sql_str($config, $utr_date) : 'NULL');
}
if (edit_has_column($config, 'payment_confirmed_at')) {
    $set[] = "payment_confirmed_at=".$payment_confirmed_sql;
}
if (edit_has_column($config, 'activation_popup_shown')) {
    $popup_val = (intval($auto_status) == 1 && $current_popup_shown == 0) ? 1 : $current_popup_shown;
    $set[] = "activation_popup_shown=".intval($popup_val);
}

$update_sql = "UPDATE create_post SET ".implode(', ', $set)." WHERE post_id='$post_id'";
$mysql_error = '';
try {
    $addmaincate = mysqli_query($config, $update_sql);
    if ($addmaincate == false) {
        $mysql_error = mysqli_error($config);
    }
} catch (Throwable $e) {
    $addmaincate = false;
    $mysql_error = $e->getMessage();
}

if (!empty($paid_on)) {
    $paid_on_formatted = $paid_on;
    $check_trans = mysqli_query($config, "SELECT * FROM online_payment_transcation WHERE Order_id='$post_id' LIMIT 1");
    if ($check_trans && mysqli_num_rows($check_trans) > 0) {
        $update_trans = mysqli_query($config, "
            UPDATE online_payment_transcation
            SET Paid_on = ".edit_sql_str($config, $paid_on_formatted)."
            WHERE Order_id='$post_id'
        ");
        if (!$update_trans) {
            error_log("Failed to update online_payment_transcation Paid_on: ".mysqli_error($config));
        }
    } elseif ($paid_status == '0') {
        $post_query = mysqli_query($config, "SELECT customer_id, driver_name, package_amount, net_amount FROM create_post WHERE post_id='$post_id' LIMIT 1");
        if ($post_query && mysqli_num_rows($post_query) > 0) {
            $post_data = mysqli_fetch_assoc($post_query);
            $customer_id = mysqli_real_escape_string($config, (string)($post_data['customer_id'] ?? ''));
            $driver_name = mysqli_real_escape_string($config, (string)($post_data['driver_name'] ?? ''));
            $amount = !empty($post_data['net_amount']) ? $post_data['net_amount'] : ($post_data['package_amount'] ?? '');
            $amount = mysqli_real_escape_string($config, str_replace(',', '', (string)$amount));
            $ref_no = mysqli_real_escape_string($config, edit_post_val('ref_no'));

            $insert_trans = mysqli_query($config, "
                INSERT INTO online_payment_transcation (
                    merchantUserId, merchantTransactionId, Order_Paid_Status,
                    Order_id, Customer_id, Customer_Name, Paid_on,
                    Payment_Gateway, Paid_Amout, transactionId
                ) VALUES (
                    '', '', 'success',
                    '$post_id', '$customer_id', '$driver_name', ".edit_sql_str($config, $paid_on_formatted).",
                    'Razorpay', '$amount', '$ref_no'
                )
            ");
            if (!$insert_trans) {
                error_log("Failed to insert online_payment_transcation: ".mysqli_error($config));
            }
        }
    }
}

if ($addmaincate == false) {
    header('Content-Type: text/html; charset=utf-8');
    echo "<h3>MySQL Error</h3>";
    echo "<pre>".htmlspecialchars($mysql_error !== '' ? $mysql_error : mysqli_error($config))."</pre>";
    echo "<h4>SQL</h4>";
    echo "<pre>".htmlspecialchars($update_sql)."</pre>";
    echo "<p><a href='../create_post.php?erro=0'>Back to list</a></p>";
    exit;
} else {
    if ($expired == 1) {
        echo "<script>window.location.href='../expired_list.php?expired=1&msg=505';</script>";
    } else {
        echo "<script>window.location.href='../create_post.php?msg=505';</script>";
    }
}

?>
