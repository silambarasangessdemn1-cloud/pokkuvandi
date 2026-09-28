
<?php
session_start();
function generateRandomString($length) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $randomString = '';
  
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
  
    return $randomString;
  }
  $length = 10;
  // $driid=$_GET['driid'];
// 


$customername = $_GET['session__username'];
$customerid = $_GET['session_id'];
$contactno = $_GET['session__phone'];
$Add_amount =  $_SESSION['Add_amount'];
$net_amount=$_SESSION['net_amount']; 
if($net_amount =='')
{
    $amount=$Add_amount;
}
else
{
    $amount=$net_amount;
}


 $customerid;

 $_SESSION['Add_postid']=$_GET['Add_postid'];

 $_SESSION['Add_driver_name']=$_GET['Add_driver_name'];

$_SESSION['Add_vehicle_no']=$_GET['Add_vehicle_no'];
 $_SESSION['addcatephoto']=$_GET['addcatephoto'];
$_SESSION['addcatephoto']=$_GET['addcatephoto'];
$_SESSION['Add_phone_no']=$_GET['Add_phone_no'];
$_SESSION['Add_whatsapp_no']=$_GET['Add_whatsapp_no'];
$_SESSION['Add_address']=$_GET['Add_address'];
$_SESSION['Add_city']=$_GET['Add_city'];
$_SESSION['Add_area']=$_GET['Add_area'];
$_SESSION['Add_status']=$_GET['Add_status'];
$_SESSION['post_addon']=$_GET['post_addon'];
$_SESSION['Add_vehicle_name']=$_GET['Add_vehicle_name'];
$_SESSION['Add_main_cate']=$_GET['Add_main_cate'];
$_SESSION['Add_sub_category']=$_GET['Add_sub_category'];
$_SESSION['Add_meta_keyword']=$_GET['Add_meta_keyword'];
$_SESSION['create_on']=$_GET['create_on'];
$_SESSION['Add_load_detail']=$_GET['Add_load_detail'];
$_SESSION['Add_location']=$_GET['Add_location'];
$_SESSION['Add_Registration_date']=$_GET['Add_Registration_date'];
$_SESSION['Add_RC_owner_name']=$_GET['Add_RC_owner_name'];
$_SESSION['Add_insurance_exp_date']=$_GET['Add_insurance_exp_date'];
$_SESSION['FC_date']=$_GET['FC_date'];
$_SESSION['Add_remarks']=$_GET['Add_remarks'];
$_SESSION['Add_package']=$_GET['Add_package'];
$_SESSION['Add_amount']=$_GET['Add_amount'];
$_SESSION['Add_days']=$_GET['Add_days'];
$session_id;
$_SESSION['futureDate']=$_GET['futureDate'];
$_SESSION['day_duty']=$_GET['day_duty'];
$_SESSION['night_duty']=$_GET['night_duty'];
$_SESSION['vehicle_type_id']=$_GET['vehicle_type_id'];
$_SESSION['seating_capacity']=$_GET['seating_capacity'];
$_SESSION['facilities']=$_GET['facilities'];
$_SESSION['space']=$_GET['space'];
$_SESSION['size']=$_GET['size'];
$_SESSION['tonnage']=$_GET['tonnage'];
$_SESSION['shop_name']=$_GET['shop_name'];
$_SESSION['work_nature']=$_GET['work_nature'];
$_SESSION['shop_address']=$_GET['shop_address'];
$_SESSION['stand_name']=$_GET['stand_name'];
$_SESSION['net_amount']=$_GET['net_amount'];
$_SESSION['Add_sub_area']=$_GET['Add_sub_area'];
$_SESSION['reffered_by_phone_no']=$_GET['reffered_by_phone_no']; 
$_SESSION['reffered_by_name']=$_GET['reffered_by_name'];

$_SESSION['less_amount']=$_GET['less_amount'];
$_SESSION['coupon_code']=$_GET['coupon_code'];
$_SESSION['coupon_type']=$_GET['coupon_type'];




 
  
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
  $session_sub_area = $_SESSION['Add_sub_area']; 
  $reffered_by_phone_no = $_SESSION['reffered_by_phone_no']; 
  $reffered_by_name = $_SESSION['reffered_by_name']; 

  $less_amount = $_SESSION['less_amount'];
  $coupon_code = $_SESSION['coupon_code'];
  $coupon_type = $_SESSION['coupon_type'];
  $randomString_a = generateRandomString($length);
  $randomString_b = generateRandomString($length);


  $session_vehicle_photo=$_SESSION['addcatephoto'];


  if($_GET['amount'] == 0 )
  {
    // $yy="https://pokkuvandi.com/App/paymentsuccess.php?merchantTransactionId=$randomString_a&merchantTransactionId=$randomString_a&Add_postid=$session_post_id&Add_driver_name=$session_driver&Add_vehicle_no=$session_vehicle_no&addcatephoto=$session_vehicle_photo&Add_phone_no=$session_phone_no&Add_whatsapp_no=$session_whatsapp_no&Add_address=$session_address&Add_city=$session_city_id&Add_area=$session_area_id&Add_status=$session_status&post_addon=$session_post_addon&Add_vehicle_name=$session_vehicle_name&Add_main_cate=$session_category_id&Add_sub_category=$session_subcategory_id&Add_meta_keyword=$session_meta_keyword&create_on=$session_create_on&Add_load_detail=$session_Add_load_detail&Add_location=$session_Add_location&Add_Registration_date=$session_Add_Registration_date&Add_RC_owner_name=$session_Add_RC_owner_name&Add_insurance_exp_date=$FC_date&Add_remarks=$session_remarks&Add_package=$session_package_id&Add_amount=$session_package_amount&Add_days=$session_package_days&session_id=$customerid&futureDate=$session_expiry_date&day_duty=$session_day_duty&night_duty=$session_night_duty&vehicle_type_id=$session_vehicle_type_id&seating_capacity=$session_facilities&space=$session_space&size=$session_size&tonnage=$session_tonnage&shop_name=$session_shop_name&work_nature=$session_work_nature&shop_address=$session_shop_address&stand_name=$session_stand_name&net_amount=$session_net_amount&Add_sub_area=$session_sub_area&reffered_by_phone_no=$reffered_by_phone_no&reffered_by_name=$reffered_by_name&less_amount=$less_amount&coupon_code=$coupon_code&coupon_type=$coupon_type";

    echo "<script>window.location.href='paymentsuccess_job_amount.php?merchantTransactionId=$randomString_a&merchantTransactionId=$randomString_a&Add_postid=$session_post_id&Add_driver_name=$session_driver&Add_vehicle_no=$session_vehicle_no&addcatephoto=$session_vehicle_photo&Add_phone_no=$session_phone_no&Add_whatsapp_no=$session_whatsapp_no&Add_address=$session_address&Add_city=$session_city_id&Add_area=$session_area_id&Add_status=$session_status&post_addon=$session_post_addon&Add_vehicle_name=$session_vehicle_name&Add_main_cate=$session_category_id&Add_sub_category=$session_subcategory_id&Add_meta_keyword=$session_meta_keyword&create_on=$session_create_on&Add_load_detail=$session_Add_load_detail&Add_location=$session_Add_location&Add_Registration_date=$session_Add_Registration_date&Add_RC_owner_name=$session_Add_RC_owner_name&Add_insurance_exp_date=$FC_date&Add_remarks=$session_remarks&Add_package=$session_package_id&Add_amount=$session_package_amount&Add_days=$session_package_days&session_id=$customerid&futureDate=$session_expiry_date&day_duty=$session_day_duty&night_duty=$session_night_duty&vehicle_type_id=$session_vehicle_type_id&seating_capacity=$session_facilities&space=$session_space&size=$session_size&tonnage=$session_tonnage&shop_name=$session_shop_name&work_nature=$session_work_nature&shop_address=$session_shop_address&stand_name=$session_stand_name&net_amount=$session_net_amount&Add_sub_area=$session_sub_area&reffered_by_phone_no=$reffered_by_phone_no&reffered_by_name=$reffered_by_name&less_amount=$less_amount&coupon_code=$coupon_code&coupon_type=$coupon_type';</script>";


  }
  else
  {
    $yy="https://pokkuvandi.com/App/paymentsuccess.php?merchantTransactionId=$randomString_a&merchantTransactionId=$randomString_a&Add_postid=$session_post_id&Add_driver_name=$session_driver&Add_vehicle_no=$session_vehicle_no&addcatephoto=$session_vehicle_photo&Add_phone_no=$session_phone_no&Add_whatsapp_no=$session_whatsapp_no&Add_address=$session_address&Add_city=$session_city_id&Add_area=$session_area_id&Add_status=$session_status&post_addon=$session_post_addon&Add_vehicle_name=$session_vehicle_name&Add_main_cate=$session_category_id&Add_sub_category=$session_subcategory_id&Add_meta_keyword=$session_meta_keyword&create_on=$session_create_on&Add_load_detail=$session_Add_load_detail&Add_location=$session_Add_location&Add_Registration_date=$session_Add_Registration_date&Add_RC_owner_name=$session_Add_RC_owner_name&Add_insurance_exp_date=$FC_date&Add_remarks=$session_remarks&Add_package=$session_package_id&Add_amount=$session_package_amount&Add_days=$session_package_days&session_id=$customerid&futureDate=$session_expiry_date&day_duty=$session_day_duty&night_duty=$session_night_duty&vehicle_type_id=$session_vehicle_type_id&seating_capacity=$session_facilities&space=$session_space&size=$session_size&tonnage=$session_tonnage&shop_name=$session_shop_name&work_nature=$session_work_nature&shop_address=$session_shop_address&stand_name=$session_stand_name&net_amount=$session_net_amount&Add_sub_area=$session_sub_area&reffered_by_phone_no=$reffered_by_phone_no&reffered_by_name=$reffered_by_name&less_amount=$less_amount&coupon_code=$coupon_code&coupon_type=$coupon_type";

  }



  // $merchantKey = '3be177ca-ecf3-4392-b783-f1bbf7790eb7';
  $merchantKey = '347c50cc-130b-4f6c-addf-f62bf840a13d';

  $data = array(
      "merchantId" => "M1IB4F213MJY",
      "merchantTransactionId" => $randomString_a,
      "merchantUserId" =>$randomString_b,
      "amount" => $amount*100,
      "redirectUrl" => $yy,
      "redirectMode" => "POST",
      "callbackUrl" => "https://pokkuvandi.com/App/intro.php",
      "mobileNumber" => "9363022675",
      "paymentInstrument" => array(
          "type" => "PAY_PAGE"
      )
  );
  $payloadMain = base64_encode(json_encode($data));

  $payload = $payloadMain."/pg/v1/pay".$merchantKey;
  $Checksum = hash('sha256', $payload);
  $Checksum = $Checksum.'###1';


//X-VERIFY  -	SHA256(base64 encoded payload + "/pg/v1/pay" + salt key) + ### + salt index

  $curl = curl_init();
  curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.phonepe.com/apis/hermes/pg/v1/pay",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode([
      'request' => $payloadMain
    ]),
    CURLOPT_HTTPHEADER => [
      "Content-Type: application/json",
      "X-VERIFY: ".$Checksum,
      "accept: application/json"
    ],
  ]);

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
      //   echo "cURL Error #:" . $err;
      header('Location: https://pokkuvandi.com/App/paymentfailed.php');
  } else {

 $responseData = json_decode($response, true);

    $url = $responseData['data']['instrumentResponse']['redirectInfo']['url'];
    header('Location: '.$url);
  }

