
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


//  $customerid;

 $_SESSION['customerid']=$_GET['customerid'];

 $_SESSION['custmer_phone_no']=$_GET['custmer_phone_no'];

$_SESSION['Add_job_cate']=$_GET['Add_job_cate'];
 $_SESSION['job_name']=$_GET['job_name'];
$_SESSION['experiences']=$_GET['experiences'];
$_SESSION['qualification']=$_GET['qualification'];
$_SESSION['company_name']=$_GET['company_name'];
$_SESSION['post_addon']=$_GET['post_addon'];
$_SESSION['Add_city']=$_GET['Add_city'];
$_SESSION['Add_area']=$_GET['Add_area'];
$_SESSION['state']=$_GET['state'];

$_SESSION['salary_range']=$_GET['salary_range'];
$_SESSION['contact_no']=$_GET['contact_no'];
$_SESSION['email_id']=$_GET['email_id'];
$_SESSION['last_date']=$_GET['last_date'];
$_SESSION['address']=$_GET['address'];
$_SESSION['customer_name']=$_GET['customer_name'];
$_SESSION['Add_remarks']=$_GET['Add_remarks'];

$_SESSION['amount']=$_GET['amount'];
$_SESSION['days']=$_GET['days'];

$_SESSION['vehicle_type']=$_GET['vehicle_type'];

$_SESSION['licence_no']=$_GET['licence_no'];


 
  
  $customerid=$_SESSION['customerid'];
  $custmer_phone_no=$_SESSION['custmer_phone_no'];
  $Add_job_cate=$_SESSION['Add_job_cate'];
  $job_name=$_SESSION['job_name'];
  $experiences=$_SESSION['experiences'];
  $qualification=$_SESSION['qualification'];
  $company_name=$_SESSION['company_name'];
   $Add_city=$_SESSION['Add_city'];
  $Add_area=$_SESSION['Add_area'];
  $state=$_SESSION['state'];

  $salary_range=$_SESSION['salary_range'];
  $post_addon=$_SESSION['post_addon'];
  $contact_no= $_SESSION['contact_no'];
  $email_id=$_SESSION['email_id'];
  $last_date=$_SESSION['last_date'];
  $address=$_SESSION['address'];
  $customer_name=$_SESSION['customer_name'];
  $Add_remarks=$_SESSION['Add_remarks'];
  $amount=$_SESSION['amount'];
  $days=$_SESSION['days'];


  $vehicle_type=$_SESSION['vehicle_type'];

   $licence_no=$_SESSION['licence_no'];




  $current_Date=date('Y-m-d');
 $exp_date = date("Y-m-d", strtotime($current_Date . " +$days days")); 




  $job_location=$_SESSION['job_location'];

 
  $randomString_a = generateRandomString($length);
  $randomString_b = generateRandomString($length);


  $session_vehicle_photo=$_SESSION['addcatephoto'];
if($_GET['amount']==0)
{
	echo "<script>window.location.href='https://pokkuvandi.com/App/paymentsuccess_job_amount.php?merchantTransactionId=$randomString_a&merchantTransactionId=$randomString_a&customerid=$customerid&custmer_phone_no=$custmer_phone_no&Add_job_cate=$Add_job_cate&job_name=$job_name&experiences=$experiences&qualification=$qualification&company_name=$company_name&Add_city=$Add_city&Add_area=$Add_area&state=$state&salary_range=$salary_range&post_addon=$post_addon&contact_no=$contact_no&email_id=$email_id&last_date=$last_date&address=$address&customer_name=$customer_name&Add_remarks=$Add_remarks&amount=$amount&job_location=$job_location&exp_date=$exp_date&vehicle_type=$vehicle_type&licence_no=$licence_no';</script>";	 
}
else
{
  $yy="https://pokkuvandi.com/App/paymentsuccess_job.php?merchantTransactionId=$randomString_a&merchantTransactionId=$randomString_a&customerid=$customerid&custmer_phone_no=$custmer_phone_no&Add_job_cate=$Add_job_cate&job_name=$job_name&experiences=$experiences&qualification=$qualification&company_name=$company_name&Add_city=$Add_city&Add_area=$Add_area&state=$state&salary_range=$salary_range&post_addon=$post_addon&contact_no=$contact_no&email_id=$email_id&last_date=$last_date&address=$address&customer_name=$customer_name&Add_remarks=$Add_remarks&amount=$amount&job_location=$job_location&exp_date=$exp_date&vehicle_type=$vehicle_type&licence_no=$licence_no";

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

