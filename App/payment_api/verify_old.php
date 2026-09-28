<?php include('../config/setup.php')?>
<?php include('../session.php');?>	
<?php

require('config.php');
//session_start();
 

require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;

$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true)
{


    
    $session_post_id=$_SESSION['Add_postid'];
    $session_driver=$_SESSION['Add_driver_name'];
    $session_vehicle_no=$_SESSION['Add_vehicle_no'];
     $_SESSION['addcatephoto'];
    $session_vehicle_photo=$_SESSION['addcatephoto'];
    $session_phone_no=$_SESSION['Add_phone_no'];
    $session_whatsapp_no=$_SESSION['Add_whatsapp_no'];
    $session_address=$_SESSION['Add_address'];
    $session_city_id=$_SESSION['Add_city'];
    $session_area_id=$_SESSION['Add_area'];
    $session_status=$_SESSION['Add_status'];
    $session_post_addon=$_SESSION['post_addon'];
    $session_vehicle_name=$_SESSION['Add_vehicle_name'];
    $session_category_id= $_SESSION['Add_main_cate'];
    $session_subcategory_id=$_SESSION['Add_sub_category'];
    $session_meta_keyword=$_SESSION['Add_meta_keyword'];
    $session_create_on=$_SESSION['create_on'];
    $session_Add_load_detail=$_SESSION['Add_load_detail'];
    $session_Add_location=$_SESSION['Add_location'];
    $session_Add_Registration_date=$_SESSION['Add_Registration_date'];
    $session_Add_RC_owner_name=$_SESSION['Add_RC_owner_name'];
    $session_Add_insurance_exp_date=$_SESSION['Add_insurance_exp_date'];
    $session_FC_date=$_SESSION['FC_date'];
    $session_remarks=$_SESSION['Add_remarks'];
    $session_package_id=$_SESSION['Add_package'];
    $session_package_amount=$_SESSION['Add_amount'];
    $session_package_days=$_SESSION['Add_days'];
    $session_customer_id=$session_id;
    $session_expiry_date=$_SESSION['futureDate'];
    $session_day_duty=$_SESSION['day_duty'];
    $session_night_duty=$_SESSION['night_duty'];
    $session_vehicle_type_id=$_SESSION['vehicle_type_id'];
    $session_seating_capacity=$_SESSION['seating_capacity'];
    $session_facilities=$_SESSION['facilities'];
    $session_space=$_SESSION['space'];
    $session_size=$_SESSION['size'];
    $session_tonnage=$_SESSION['tonnage'];
    $session_shop_name=$_SESSION['shop_name'];
    $session_work_nature=$_SESSION['work_nature'];
    $session_shop_address=$_SESSION['shop_address'];
    $session_stand_name=$_SESSION['stand_name'];
    $session_net_amount=$_SESSION['net_amount'];
  if($session_post_id !='')
  {
    $current_Date=date('Y-m-d');
    $addmaincate=mysqli_query($config,"update create_post set driver_name='$session_driver',vehicle_no='$session_vehicle_no',address='$session_address',post_addon='$current_Date',vehicle_name='$session_vehicle_name',create_on='$current_Date',package_id='$session_package_id',package_amount='$session_package_amount',package_days='$session_package_days',expiry_date='$session_expiry_date'	where post_id='$session_post_id' ");	
    
  }
  else
  {
  //  echo  $query="insert into create_post(driver_name,vehicle_no,vehicle_photo,phone_no,whatsapp_no,address,city_id,area_id,status,post_addon,vehicle_name,category_id,subcategory_id,meta_keyword,create_on,Add_load_detail,Add_location,Add_Registration_date,Add_RC_owner_name,Add_insurance_exp_date,FC_date,remarks,package_id,package_amount,package_days,customer_id,expiry_date,day_duty,night_duty,vehicle_type_id,seating_capacity,facilities,space,size,tonnage,shop_name,work_nature,shop_address	)
  //   values('$session_driver','$session_vehicle_no','$session_vehicle_photo','$session_phone_no','$session_whatsapp_no','$session_address','$session_city_id','$session_area_id','$session_status','$session_post_addon','$session_vehicle_name','$session_category_id','$session_subcategory_id','$session_meta_keyword','$session_create_on','$session_Add_load_detail','$session_Add_location','$session_Add_Registration_date','$session_Add_RC_owner_name','$session_Add_insurance_exp_date','$session_FC_date','$session_remarks','$session_package_id','$session_package_amount','$session_package_days','$session_customer_id','$session_expiry_date','$session_day_duty','$session_night_duty','$session_vehicle_type_id','$session_seating_capacity','$session_facilities','$session_space','$session_size','$session_tonnage','$session_shop_name','$session_work_nature','$session_shop_address')";
  //   die;
  if($session_net_amount!='')
  {
    
    $main_cate=mysqli_query($config,"select * from coupon where customer_id='$session_customer_id'");
   $addsubcate=mysqli_fetch_object($main_cate);
   $time_of_use=$addsubcate->time_of_use;
   $total=$time_of_use - 1;
 
    $addmaincate_coupon=mysqli_query($config,"update coupon set time_of_use='$total' where customer_id='$session_customer_id' ");	
  }

    $addmaincate=mysqli_query($config,"insert into create_post(driver_name,vehicle_no,vehicle_photo,phone_no,whatsapp_no,address,city_id,area_id,status,post_addon,vehicle_name,category_id,subcategory_id,meta_keyword,create_on,Add_load_detail,Add_location,Add_Registration_date,Add_RC_owner_name,Add_insurance_exp_date,FC_date,remarks,package_id,package_amount,package_days,customer_id,expiry_date,day_duty,night_duty,vehicle_type_id,seating_capacity,facilities,space,size,tonnage,shop_name,work_nature,shop_address,net_amount)
    values('$session_driver','$session_vehicle_no','$session_vehicle_photo','$session_phone_no','$session_whatsapp_no','$session_address','$session_city_id','$session_area_id','$session_status','$session_post_addon','$session_vehicle_name','$session_category_id','$session_subcategory_id','$session_meta_keyword','$session_create_on','$session_Add_load_detail','$session_Add_location','$session_Add_Registration_date','$session_Add_RC_owner_name','$session_Add_insurance_exp_date','$session_FC_date','$session_remarks','$session_package_id','$session_package_amount','$session_package_days','$session_customer_id','$session_expiry_date','$session_day_duty','$session_night_duty','$session_vehicle_type_id','$session_seating_capacity','$session_facilities','$session_space','$session_size','$session_tonnage','$session_shop_name','$session_work_nature','$session_shop_address','$session_net_amount')");	
    
  }
    
 header('location:../successful.php');
    
}
else
{  


    $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
           
}

// echo $html;
