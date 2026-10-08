<?php 
// Include files first
include('config/setup.php');
include('session.php');

// Disable MySQL strict mode for this script so empty dates don't crash in production
mysqli_query($config, "SET sql_mode = ''");

// Initialize session variables (set in session.php, but ensure they exist)
if(!isset($session_id)) $session_id = '';
if(!isset($session__username)) $session__username = '';
if(!isset($session__mail)) $session__mail = '';
if(!isset($session__phone)) $session__phone = '';

// Set JSON header AFTER includes to prevent 500 errors
header('Content-Type: application/json');

// ✅ ALTER query to add vehicle_body_type column if it doesn't exist
$check_column = mysqli_query($config, "SHOW COLUMNS FROM `create_post` LIKE 'vehicle_body_type'");
if(mysqli_num_rows($check_column) == 0) {
    $alter_query = "ALTER TABLE `create_post` 
                    ADD COLUMN `vehicle_body_type` VARCHAR(50) NULL DEFAULT NULL 
                    AFTER `other_vehicle_type`";
    mysqli_query($config, $alter_query);
}

// ✅ ALTER query to allow NULL in expiry_date if it's currently NOT NULL
$check_expiry = mysqli_query($config, "SHOW COLUMNS FROM `create_post` LIKE 'expiry_date'");
$expiry_data = mysqli_fetch_object($check_expiry);
if ($expiry_data && strtoupper($expiry_data->Null) == 'NO') {
    mysqli_query($config, "ALTER TABLE `create_post` MODIFY COLUMN `expiry_date` DATE NULL DEFAULT NULL");
}

if(isset($_POST['post_add']))
{
  // ✅ FIRST: Check vehicle number BEFORE anything else
  // This must be the very first check and exit immediately if duplicate
  if (isset($_POST['Add_vehicle_no']) && !empty(trim($_POST['Add_vehicle_no']))) {
    $vehicle_no = trim($_POST['Add_vehicle_no']);
    $vehicle_no = mysqli_real_escape_string($config, $vehicle_no);
    
    $checkQuery = "SELECT * FROM create_post WHERE vehicle_no = '$vehicle_no' AND delete_id = '0' LIMIT 1";
    $result = mysqli_query($config, $checkQuery);
    
    if ($result && mysqli_num_rows($result) > 0) {
      // Exit immediately with error - no further processing
      echo json_encode(array('status' => 'error', 'message' => "This vehicle number is already registered: $vehicle_no"));
      exit();
    }
  }
  
  // ✅ Only proceed if vehicle number check passes
// $timezone = new DateTimeZone("Asia/Kolkata" );
// $date = new DateTime();
// $date->setTimezone($timezone );
// $today2=$date->format('s');	
$addcatephoto=$_FILES['Add_vehicle_photo']['name'];
$addphoto="../photos/vehicle/".$addcatephoto;
move_uploaded_file($_FILES["Add_vehicle_photo"]["tmp_name"],$addphoto);


 $current_Date=date('Y-m-d');

    $sql="SELECT * FROM `create_post` where subcategory_id = '".$_POST['Add_sub_category']."'  && area_id='".$_POST['Add_area']."' && customer_id ='$session_id' Order by create_on DESC "; 
    
 
   $sdate= mysqli_query($config, $sql);
	 $data = mysqli_fetch_object($sdate);
	 $total_user = mysqli_num_rows($sdate);


   // Check if both $create_on and $package_days have values
if (!empty($data->create_on) && !empty($data->package_days)) {
  $create_on = $data->create_on;
  $package_days = $data->package_days;
  // ✅ Calculate futureDate from package_days for comparison, but will be updated when payment is confirmed
  // Calculate expiry date from current date + package days for the condition check
  if (!empty($package_days) && is_numeric($package_days) && $package_days > 0) {
    $futureDate = date('Y-m-d', strtotime("+$package_days days"));
  } else {
    // If package_days is invalid, use a default (e.g., 1 year from now) or current date
    $futureDate = date('Y-m-d', strtotime("+365 days")); // Default to 1 year
  }
} else {
  // Set the value from $_POST['Add_postid'] if either $create_on or $package_days is empty
  // ✅ Calculate futureDate from package_days in POST data for comparison
  $package_days_from_post = isset($_POST['Add_days']) ? $_POST['Add_days'] : 0;
  if (!empty($package_days_from_post) && is_numeric($package_days_from_post) && $package_days_from_post > 0) {
    $futureDate = date('Y-m-d', strtotime("+$package_days_from_post days"));
  } else {
    // If package_days is invalid, use a default (e.g., 1 year from now)
    $futureDate = date('Y-m-d', strtotime("+365 days")); // Default to 1 year
  }
}


   

  if($data!=''){
   
   
    if($current_Date < $futureDate ){

     
      if($_POST['total_net_amount'] == '0')
    {
      // Simple validation checks using $_POST directly
      if(empty($_POST['Add_city']))
      {
        echo json_encode(array('status' => 'error', 'message' => 'Select District'));
        exit();
      }
      else if(empty($_POST['Add_area']))
      {
        echo json_encode(array('status' => 'error', 'message' => 'Select City'));
        exit();
      }
      else if(empty($_POST['Add_package']))
      {
        echo json_encode(array('status' => 'error', 'message' => 'Select Package'));
        exit();
      }
      else
      {
      // ✅ For app side: expiry_date will be set from payment date when payment is successful
      // Set expiry_date to NULL initially - it will be set when payment is confirmed (QR/Online)
      // Note: $futureDate is calculated for condition check (if($current_Date < $futureDate)), but we store NULL in database
      $final_expiry_date = NULL; // Always store NULL in database - will be set when payment is confirmed
      
      // Handle NULL value properly for SQL INSERT
      $expiry_date_sql = ($final_expiry_date === NULL || $final_expiry_date === '' || $final_expiry_date === '0000-00-00') ? 'NULL' : "'$final_expiry_date'";
      
      $vehicle_body_type = isset($_POST['vehicle_body_type']) ? mysqli_real_escape_string($config, $_POST['vehicle_body_type']) : '';
      $addmaincate=mysqli_query($config,"insert into create_post(driver_name,vehicle_no,vehicle_photo,phone_no,whatsapp_no,address,city_id,area_id,status,post_addon,vehicle_name,category_id,subcategory_id,meta_keyword,create_on,Add_load_detail,Add_location,Add_Registration_date,Add_RC_owner_name,Add_insurance_exp_date,FC_date,remarks,package_id,package_amount,package_days,customer_id,expiry_date,day_duty,night_duty,vehicle_type_id,seating_capacity,facilities,space,size,tonnage,shop_name,work_nature,shop_address,stand_name,sub_area_id,reffered_by_phone_no,reffered_by_name,discount_amount,discount_name,coupon_type,state_id,other_vehicle_type,vehicle_body_type,net_amount)            

      values('".$_POST['Add_driver_name']."','".$_POST['Add_vehicle_no']."','$addcatephoto','".$_POST['Add_phone_no']."','".$_POST['Add_whatsapp_no']."','".$_POST['Add_address']."','".$_POST['Add_city']."','".$_POST['Add_area']."','".$_POST['Add_status']."','$current_Date','".$_POST['Add_vehicle_name']."','".$_POST['Add_main_cate']."','".$_POST['Add_sub_category']."','".$_POST['Add_meta_keyword']."','$current_Date','".$_POST['Add_load_detail']."','".$_POST['Add_location']."','".$_POST['Add_Registration_date']."','".$_POST['Add_RC_owner_name']."','".$_POST['Add_insurance_exp_date']."','".$_POST['FC_date']."','".$_POST['Add_remarks']."','".$_POST['Add_package']."','".$_POST['Add_amount']."','".$_POST['Add_days']."','$session_id',$expiry_date_sql,'".$_POST['day_duty']."','".$_POST['night_duty']."','".$_POST['vehicle_type_id']."','".$_POST['seating_capacity']."','".$_POST['facilities']."','".$_POST['space']."','".$_POST['size']."','".$_POST['tonnage']."','".$_POST['shop_name']."','".$_POST['work_nature']."','".$_POST['shop_address']."','".$_POST['stand_name']."','".$_POST['Add_sub_area']."','".$_POST['reffered_by_phone_no']."','".$_POST['reffered_by_name']."','".$_POST['less_amount']."','".$_POST['coupon_code']."','".$_POST['coupon_type']."','".$_POST['state']."','".$_POST['other_vehicle_type']."','$vehicle_body_type','".$_POST['net_amount']."')");	
      
      if($addmaincate) {
        echo json_encode(array('status' => 'info', 'message' => 'Please wait... Payment Option Will be open below...'));
        exit();
      } else {
        echo json_encode(array('status' => 'error', 'message' => 'Failed to create post. Error: ' . mysqli_error($config)));
        exit();
      }    
      }  
    }
    else
    {
      // ✅ Allow NULL $futureDate - it will be set when payment is confirmed
      // Simple validation checks using $_POST directly
      if(empty($_POST['Add_city']))
      {
        echo json_encode(array('status' => 'error', 'message' => 'Select District'));
        exit();
      }
      else if(empty($_POST['Add_area']))
      {
        echo json_encode(array('status' => 'error', 'message' => 'Select City'));
        exit();
      }
      else if(empty($_POST['Add_package']))
      {
        echo json_encode(array('status' => 'error', 'message' => 'Select Package'));
        exit();
      }
          else
          {
        //  new commend for phone pay
    //  echo "<script>window.location.href='phonepay.php?session_id=$session_id&session__phone=$session__phone&session__username=$session__username&Add_postid=$Add_postid&Add_driver_name=$Add_driver_name&Add_vehicle_no=$Add_vehicle_no&addcatephoto=$addcatephoto&Add_phone_no=$Add_phone_no&Add_whatsapp_no=$Add_whatsapp_no&Add_address=$Add_address&Add_city=$Add_city&Add_area=$Add_area&Add_status=$Add_status&post_addon=$post_addon&Add_vehicle_name=$Add_vehicle_name&Add_main_cate=$Add_main_cate&Add_sub_category=$Add_sub_category&Add_meta_keyword=$Add_meta_keyword&create_on=$create_on&Add_load_detail=$Add_load_detail&Add_location=$Add_location&Add_Registration_date=$Add_Registration_date&Add_RC_owner_name=$Add_RC_owner_name&Add_insurance_exp_date=$Add_insurance_exp_date&FC_date=$FC_date&Add_remarks=$Add_remarks&Add_package=$Add_package&Add_amount=$Add_amount&Add_days=$Add_days&futureDate=$futureDate&day_duty=$day_duty&night_duty=$night_duty&vehicle_type_id=$vehicle_type_id&seating_capacity=$seating_capacity&facilities=$facilities&space=$space&size=$size&tonnage=$tonnage&shop_name=$shop_name&work_nature=$work_nature&shop_address=$shop_address&stand_name=$stand_name&net_amount=$net_amount&Add_sub_area=$Add_sub_area&reffered_by_phone_no=$reffered_by_phone_no&reffered_by_name=$reffered_by_name&less_amount=$less_amount&coupon_code=$coupon_code&coupon_type=$coupon_type&state=$state&other_vehicle_typ=$other_vehicle_type';</script>";
  
    $_POST['Add_status'] = 0;
    // Handle NULL value properly for SQL INSERT
    $expiry_date_sql = ($futureDate === NULL || $futureDate === '' || $futureDate === '0000-00-00') ? 'NULL' : "'$futureDate'";
    
    $vehicle_body_type = isset($_POST['vehicle_body_type']) ? mysqli_real_escape_string($config, $_POST['vehicle_body_type']) : '';
    $addmaincate=mysqli_query($config,"insert into create_post(driver_name,vehicle_no,vehicle_photo,phone_no,whatsapp_no,address,city_id,area_id,status,post_addon,vehicle_name,category_id,subcategory_id,meta_keyword,create_on,Add_load_detail,Add_location,Add_Registration_date,Add_RC_owner_name,Add_insurance_exp_date,FC_date,remarks,package_id,package_amount,package_days,customer_id,expiry_date,day_duty,night_duty,vehicle_type_id,seating_capacity,facilities,space,size,tonnage,shop_name,work_nature,shop_address,stand_name,sub_area_id,reffered_by_phone_no,reffered_by_name,discount_amount,discount_name,coupon_type,state_id,other_vehicle_type,vehicle_body_type,net_amount)            

    values('".$_POST['Add_driver_name']."','".$_POST['Add_vehicle_no']."','$addcatephoto','".$_POST['Add_phone_no']."','".$_POST['Add_whatsapp_no']."','".$_POST['Add_address']."','".$_POST['Add_city']."','".$_POST['Add_area']."','".$_POST['Add_status']."','$current_Date','".$_POST['Add_vehicle_name']."','".$_POST['Add_main_cate']."','".$_POST['Add_sub_category']."','".$_POST['Add_meta_keyword']."','$current_Date','".$_POST['Add_load_detail']."','".$_POST['Add_location']."','".$_POST['Add_Registration_date']."','".$_POST['Add_RC_owner_name']."','".$_POST['Add_insurance_exp_date']."','".$_POST['FC_date']."','".$_POST['Add_remarks']."','".$_POST['Add_package']."','".$_POST['Add_amount']."','".$_POST['Add_days']."','$session_id',$expiry_date_sql,'".$_POST['day_duty']."','".$_POST['night_duty']."','".$_POST['vehicle_type_id']."','".$_POST['seating_capacity']."','".$_POST['facilities']."','".$_POST['space']."','".$_POST['size']."','".$_POST['tonnage']."','".$_POST['shop_name']."','".$_POST['work_nature']."','".$_POST['shop_address']."','".$_POST['stand_name']."','".$_POST['Add_sub_area']."','".$_POST['reffered_by_phone_no']."','".$_POST['reffered_by_name']."','".$_POST['less_amount']."','".$_POST['coupon_code']."','".$_POST['coupon_type']."','".$_POST['state']."','".$_POST['other_vehicle_type']."','$vehicle_body_type','".$_POST['total_net_amount']."')");	
    
    if($addmaincate) {
      echo json_encode(array('status' => 'info', 'message' => 'Please wait... Payment Option Will be open below...'));
      exit();
    } else {
      echo json_encode(array('status' => 'error', 'message' => 'Failed to create post. Error: ' . mysqli_error($config)));
      exit();
    }    
  
  }


    }
    
    }
    else
    {
     
      echo "<script>window.location.href='create_post_messgae.php?msgerror=error';</script>";
    }    
  }
  else{

    if($_POST['total_net_amount'] == '0')
    {
      // Simple validation checks using $_POST directly
      if(empty($_POST['Add_city']))
      {
        echo json_encode(array('status' => 'error', 'message' => 'Select District'));
        exit();
      }
      else if(empty($_POST['Add_area']))
      {
        echo json_encode(array('status' => 'error', 'message' => 'Select City'));
        exit();
      }
      else if(empty($_POST['Add_package']))
      {
        echo json_encode(array('status' => 'error', 'message' => 'Select Package'));
        exit();
      }
      else
      {
      // ✅ For app side: expiry_date will be set from payment date when payment is successful
      // Set expiry_date to NULL initially - it will be set when payment is confirmed (QR/Online)
      $final_expiry_date = $futureDate; // NULL by default
      
      // Handle NULL value properly for SQL INSERT
      $expiry_date_sql = ($final_expiry_date === NULL || $final_expiry_date === '' || $final_expiry_date === '0000-00-00') ? 'NULL' : "'$final_expiry_date'";

      $vehicle_body_type = isset($_POST['vehicle_body_type']) ? mysqli_real_escape_string($config, $_POST['vehicle_body_type']) : '';
      $addmaincate=mysqli_query($config,"insert into create_post(driver_name,vehicle_no,vehicle_photo,phone_no,whatsapp_no,address,city_id,area_id,status,post_addon,vehicle_name,category_id,subcategory_id,meta_keyword,create_on,Add_load_detail,Add_location,Add_Registration_date,Add_RC_owner_name,Add_insurance_exp_date,FC_date,remarks,package_id,package_amount,package_days,customer_id,expiry_date,day_duty,night_duty,vehicle_type_id,seating_capacity,facilities,space,size,tonnage,shop_name,work_nature,shop_address,stand_name,sub_area_id,reffered_by_phone_no,reffered_by_name,discount_amount,discount_name,coupon_type,state_id,other_vehicle_type,vehicle_body_type,net_amount)
        values('".$_POST['Add_driver_name']."','".$_POST['Add_vehicle_no']."','$addcatephoto','".$_POST['Add_phone_no']."','".$_POST['Add_whatsapp_no']."','".$_POST['Add_address']."','".$_POST['Add_city']."','".$_POST['Add_area']."','".$_POST['Add_status']."','$current_Date','".$_POST['Add_vehicle_name']."','".$_POST['Add_main_cate']."','".$_POST['Add_sub_category']."','".$_POST['Add_meta_keyword']."','$current_Date','".$_POST['Add_load_detail']."','".$_POST['Add_location']."','".$_POST['Add_Registration_date']."','".$_POST['Add_RC_owner_name']."','".$_POST['Add_insurance_exp_date']."','".$_POST['FC_date']."','".$_POST['Add_remarks']."','".$_POST['Add_package']."','".$_POST['Add_amount']."','".$_POST['Add_days']."','$session_id',$expiry_date_sql,'".$_POST['day_duty']."','".$_POST['night_duty']."','".$_POST['vehicle_type_id']."','".$_POST['seating_capacity']."','".$_POST['facilities']."','".$_POST['space']."','".$_POST['size']."','".$_POST['tonnage']."','".$_POST['shop_name']."','".$_POST['work_nature']."','".$_POST['shop_address']."','".$_POST['stand_name']."','".$_POST['Add_sub_area']."','".$_POST['reffered_by_phone_no']."','".$_POST['reffered_by_name']."','".$_POST['less_amount']."','".$_POST['coupon_code']."','".$_POST['coupon_type']."','".$_POST['state']."','".$_POST['other_vehicle_type']."','$vehicle_body_type','".$_POST['net_amount']."')");	
        
        if($addmaincate) {
          echo json_encode(array('status' => 'info', 'message' => 'Please wait... Payment Option Will be open below...'));
          exit();
        } else {
          echo json_encode(array('status' => 'error', 'message' => 'Failed to create post. Error: ' . mysqli_error($config)));
          exit();
        }
      }
    
    }
    else
    {
      // Simple validation checks using $_POST directly
      if(empty($_POST['Add_city']))
      {
        echo json_encode(array('status' => 'error', 'message' => 'Select District'));
        exit();
      }
      else if(empty($_POST['Add_area']))
      {
        echo json_encode(array('status' => 'error', 'message' => 'Select City'));
        exit();
      }
      else if(empty($_POST['Add_package']))
      {
        echo json_encode(array('status' => 'error', 'message' => 'Select Package'));
        exit();
      }
      else
      {
      //  new commend for the phone pay
       // echo "<script>window.location.href='phonepay.php?session_id=$session_id&session__phone=$session__phone&session__username=$session__username&Add_postid=$Add_postid&Add_driver_name=$Add_driver_name&Add_vehicle_no=$Add_vehicle_no&addcatephoto=$addcatephoto&Add_phone_no=$Add_phone_no&Add_whatsapp_no=$Add_whatsapp_no&Add_address=$Add_address&Add_city=$Add_city&Add_area=$Add_area&Add_status=$Add_status&post_addon=$post_addon&Add_vehicle_name=$Add_vehicle_name&Add_main_cate=$Add_main_cate&Add_sub_category=$Add_sub_category&Add_meta_keyword=$Add_meta_keyword&create_on=$create_on&Add_load_detail=$Add_load_detail&Add_location=$Add_location&Add_Registration_date=$Add_Registration_date&Add_RC_owner_name=$Add_RC_owner_name&Add_insurance_exp_date=$Add_insurance_exp_date&FC_date=$FC_date&Add_remarks=$Add_remarks&Add_package=$Add_package&Add_amount=$Add_amount&Add_days=$Add_days&futureDate=$futureDate&day_duty=$day_duty&night_duty=$night_duty&vehicle_type_id=$vehicle_type_id&seating_capacity=$seating_capacity&facilities=$facilities&space=$space&size=$size&tonnage=$tonnage&shop_name=$shop_name&work_nature=$work_nature&shop_address=$shop_address&stand_name=$stand_name&net_amount=$net_amount&Add_sub_area=$Add_sub_area&reffered_by_phone_no=$reffered_by_phone_no&reffered_by_name=$reffered_by_name&less_amount=$less_amount&coupon_code=$coupon_code&coupon_type=$coupon_type&state=$state&other_vehicle_typ=$other_vehicle_type';</script>";
       $package_days = $_POST['Add_days']; // e.g., 365
        // Calculate futureDate only if package_days is valid, otherwise set to NULL
        if (!empty($package_days) && is_numeric($package_days) && $package_days > 0) {
          $futureDate = date('Y-m-d', strtotime("+$package_days days")); // ✅ YYYY-MM-DD
        } else {
          $futureDate = NULL; // Set to NULL if package_days is invalid
        }
       
       $_POST['Add_status'] = 0;
       
       // Handle NULL value properly for SQL INSERT
       $expiry_date_sql = ($futureDate === NULL || $futureDate === '' || $futureDate === '0000-00-00') ? 'NULL' : "'$futureDate'";
       
      //  echo "insert into create_post(driver_name,vehicle_no,vehicle_photo,phone_no,whatsapp_no,address,city_id,area_id,status,post_addon,vehicle_name,category_id,subcategory_id,meta_keyword,create_on,Add_load_detail,Add_location,Add_Registration_date,Add_RC_owner_name,Add_insurance_exp_date,FC_date,remarks,package_id,package_amount,package_days,customer_id,expiry_date,day_duty,night_duty,vehicle_type_id,seating_capacity,facilities,space,size,tonnage,shop_name,work_nature,shop_address,stand_name,sub_area_id,reffered_by_phone_no,reffered_by_name,discount_amount,discount_name,coupon_type,state_id,other_vehicle_type,net_amount)            

      //  values('".$_POST['Add_driver_name']."','".$_POST['Add_vehicle_no']."','$addcatephoto','".$_POST['Add_phone_no']."','".$_POST['Add_whatsapp_no']."','".$_POST['Add_address']."','".$_POST['Add_city']."','".$_POST['Add_area']."','".$_POST['Add_status']."','$current_Date','".$_POST['Add_vehicle_name']."','".$_POST['Add_main_cate']."','".$_POST['Add_sub_category']."','".$_POST['Add_meta_keyword']."','$current_Date','".$_POST['Add_load_detail']."','".$_POST['Add_location']."','".$_POST['Add_Registration_date']."','".$_POST['Add_RC_owner_name']."','".$_POST['Add_insurance_exp_date']."','".$_POST['FC_date']."','".$_POST['Add_remarks']."','".$_POST['Add_package']."','".$_POST['Add_amount']."','".$_POST['Add_days']."','$session_id','$futureDate','".$_POST['day_duty']."','".$_POST['night_duty']."','".$_POST['vehicle_type_id']."','".$_POST['seating_capacity']."','".$_POST['facilities']."','".$_POST['space']."','".$_POST['size']."','".$_POST['tonnage']."','".$_POST['shop_name']."','".$_POST['work_nature']."','".$_POST['shop_address']."','".$_POST['stand_name']."','".$_POST['Add_sub_area']."','".$_POST['reffered_by_phone_no']."','".$_POST['reffered_by_name']."','".$_POST['less_amount']."','".$_POST['coupon_code']."','".$_POST['coupon_type']."','".$_POST['state']."','".$_POST['other_vehicle_type']."','".$_POST['net_amount']."')";
      // exit;
       $vehicle_body_type = isset($_POST['vehicle_body_type']) ? mysqli_real_escape_string($config, $_POST['vehicle_body_type']) : '';
       
       $add_registration_date_sql = empty($_POST['Add_Registration_date']) ? "''" : "'" . mysqli_real_escape_string($config, $_POST['Add_Registration_date']) . "'";
       $add_insurance_exp_date_sql = empty($_POST['Add_insurance_exp_date']) ? "''" : "'" . mysqli_real_escape_string($config, $_POST['Add_insurance_exp_date']) . "'";
       $fc_date_sql = empty($_POST['FC_date']) ? "''" : "'" . mysqli_real_escape_string($config, $_POST['FC_date']) . "'";

       $addmaincate=mysqli_query($config,"insert into create_post(driver_name,vehicle_no,vehicle_photo,phone_no,whatsapp_no,address,city_id,area_id,status,post_addon,vehicle_name,category_id,subcategory_id,meta_keyword,create_on,Add_load_detail,Add_location,Add_Registration_date,Add_RC_owner_name,Add_insurance_exp_date,FC_date,remarks,package_id,package_amount,package_days,customer_id,expiry_date,day_duty,night_duty,vehicle_type_id,seating_capacity,facilities,space,size,tonnage,shop_name,work_nature,shop_address,stand_name,sub_area_id,reffered_by_phone_no,reffered_by_name,discount_amount,discount_name,coupon_type,state_id,other_vehicle_type,vehicle_body_type,net_amount)            

       values('".$_POST['Add_driver_name']."','".$_POST['Add_vehicle_no']."','$addcatephoto','".$_POST['Add_phone_no']."','".$_POST['Add_whatsapp_no']."','".$_POST['Add_address']."','".$_POST['Add_city']."','".$_POST['Add_area']."','".$_POST['Add_status']."','$current_Date','".$_POST['Add_vehicle_name']."','".$_POST['Add_main_cate']."','".$_POST['Add_sub_category']."','".$_POST['Add_meta_keyword']."','$current_Date','".$_POST['Add_load_detail']."','".$_POST['Add_location']."',$add_registration_date_sql,'".$_POST['Add_RC_owner_name']."',$add_insurance_exp_date_sql,$fc_date_sql,'".$_POST['Add_remarks']."','".$_POST['Add_package']."','".$_POST['Add_amount']."','".$_POST['Add_days']."','$session_id',$expiry_date_sql,'".$_POST['day_duty']."','".$_POST['night_duty']."','".$_POST['vehicle_type_id']."','".$_POST['seating_capacity']."','".$_POST['facilities']."','".$_POST['space']."','".$_POST['size']."','".$_POST['tonnage']."','".$_POST['shop_name']."','".$_POST['work_nature']."','".$_POST['shop_address']."','".$_POST['stand_name']."','".$_POST['Add_sub_area']."','".$_POST['reffered_by_phone_no']."','".$_POST['reffered_by_name']."','".$_POST['less_amount']."','".$_POST['coupon_code']."','".$_POST['coupon_type']."','".$_POST['state']."','".$_POST['other_vehicle_type']."','$vehicle_body_type','".$_POST['total_net_amount']."')");	
       
       if($addmaincate) {
         echo json_encode(array('status' => 'info', 'message' => 'Please wait... Payment Option Will be open below...'));
         exit();
       } else {
         echo json_encode(array('status' => 'error', 'message' => 'Failed to create post. Error: ' . mysqli_error($config)));
         exit();
       }    
     
      }

    
      
    }
      

  }


    $lastInsertId = mysqli_insert_id($config);


  $sub_cate_filter= array_filter($_POST['sub_cate_filter']);

  foreach($sub_cate_filter as $data)
    {
    //   echo $data;
      
         $sql = "INSERT INTO add_filter (filter_id,post_id,category_id,subcategory_id)
    
        VALUES ('$data','$lastInsertId','".$_POST['Add_main_cate']."','".$_POST['Add_sub_category']."')";
    
    
    
    mysqli_query($config,$sql);
    
    }  




//    if($addmaincate==false)
// {
 	
//  	 echo "<script>window.location.href='../create_post.php?erro=0';</script>".mysqli_error();	 
// }
// else{
	
// 	echo "<script>window.location.href='../create_post.php?msg=505';</script>";	 

	
// }	



}




?>




