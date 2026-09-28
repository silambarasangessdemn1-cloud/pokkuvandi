
<?php include('config/setup.php');?>
<?php include('session.php');?>	
<?php




date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)

//  print_r($_POST);
// die;
// print_r($_POST['code']);
// die;



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
 $_SESSION['exp_date']=$_GET['exp_date'];
 $_SESSION['days']=$_GET['days'];

 
 $_SESSION['job_location']=$_GET['job_location'];
  
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
   $exp_date = $_SESSION['exp_date'];
   $days = $_SESSION['days'];
   $vehicle_type = $_SESSION['vehicle_type'];

   $licence_no = $_SESSION['licence_no'];


   
   $job_location=$_SESSION['job_location'];
    $merchantTransactionId = $_SESSION['merchantTransactionId'];
    $merchantUserId = $_SESSION['merchantUserId'];


  if($session_post_id !='')
  {
    $current_Date=date('Y-m-d');


    $post_=mysqli_query($config,"select * from create_post where post_id='$session_post_id'");
   $post__=mysqli_fetch_object($post_);
   $expiry_date = $post__->expiry_date;

      
   
if($current_Date >= $expiry_date )
{
 
  $addmaincate=mysqli_query($config,"update create_post set driver_name='$session_driver',create_on='$current_Date',package_id='$session_package_id',package_amount='$session_package_amount',package_days='$session_package_days',expiry_date='$session_expiry_date',renewal_post='1',net_amount='$session_net_amount',coupon_type='$coupon_type',discount_amount='$less_amount',discount_name='$coupon_code' where post_id='$session_post_id' ");	


  // echo $query="insert into renewal_list(post_id,re_package_id,re_package_amount,re_package_days,re_expiry_date,re_net_amount,re_coupon_type,re_discount_amount,re_discount_name,re_date,re_customer_id)
  // values('$session_post_id','$session_package_id','$session_package_amount','$session_package_days','$session_expiry_date',' $session_net_amount','$coupon_type','$less_amount','$coupon_code','$current_Date','$session_customer_id')";
  // die;
  
  $addmaincate=mysqli_query($config,"insert into renewal_list(post_id,re_package_id,re_package_amount,re_package_days,re_expiry_date,re_net_amount,re_coupon_type,re_discount_amount,re_discount_name,re_date,re_customer_id)
  values('$session_post_id','$session_package_id','$session_package_amount','$session_package_days','$session_expiry_date',' $session_net_amount','$coupon_type','$less_amount','$coupon_code','$current_Date','$session_customer_id')");	



  if($session_package_amount !='')
    {
      $sql =mysqli_query($config,"INSERT INTO `online_payment_transcation` (`merchantUserId` , `merchantTransactionId`,`Order_Paid_Status`, `Order_id`, `Customer_id`, `Customer_Name`, `Paid_on`,`Payment_Gateway`,`Paid_Amout`) VALUES ('$merchantUserId','$merchantTransactionId','success', '$lastInsertID','$session_customer_id','$session_driver','$session_create_on','Phonepay','$session_package_amount')"); 
    }
    else
    {
      $sql =mysqli_query($config,"INSERT INTO `online_payment_transcation` (`merchantUserId` , `merchantTransactionId`,`Order_Paid_Status`, `Order_id`, `Customer_id`, `Customer_Name`, `Paid_on`,`Payment_Gateway`,`Paid_Amout`) VALUES ('$merchantUserId','$merchantTransactionId','success', '$lastInsertID','$session_customer_id','$session_driver','$session_create_on','Phonepay','$session_net_amount')"); 
    
    }


}
else
{

  
  $addmaincate=mysqli_query($config,"update create_post set driver_name='$session_driver',create_on='$current_Date',package_id='$session_package_id',package_amount='$session_package_amount',package_days='$session_package_days',expiry_date='$session_expiry_date',renewal_post='1',net_amount='$session_net_amount',coupon_type='$coupon_type',discount_amount='$less_amount',discount_name='$coupon_code'	where post_id='$session_post_id' ");	
  

  // echo $query="insert into renewal_list(post_id,re_package_id,re_package_amount,re_package_days,re_expiry_date,re_net_amount,re_coupon_type,re_discount_amount,re_discount_name,re_date,re_customer_id)
  // values('$session_post_id','$session_package_id','$session_package_amount','$session_package_days','$session_expiry_date',' $session_net_amount','$coupon_type','$less_amount','$coupon_code','$current_Date','$session_customer_id')";
  // die;
  $addmaincate=mysqli_query($config,"insert into renewal_list(post_id,re_package_id,re_package_amount,re_package_days,re_expiry_date,re_net_amount,re_coupon_type,re_discount_amount,re_discount_name,re_date,re_customer_id)
  values('$session_post_id','$session_package_id','$session_package_amount','$session_package_days','$session_expiry_date',' $session_net_amount','$coupon_type','$less_amount','$coupon_code','$current_Date','$session_customer_id')");	

  if($session_package_amount !='')
    {
      $sql =mysqli_query($config,"INSERT INTO `online_payment_transcation` (`merchantUserId` , `merchantTransactionId`,`Order_Paid_Status`, `Order_id`, `Customer_id`, `Customer_Name`, `Paid_on`,`Payment_Gateway`,`Paid_Amout`) VALUES ('$merchantUserId','$merchantTransactionId','success', '$lastInsertID','$session_customer_id','$session_driver','$session_create_on','Phonepay','$session_package_amount')"); 
    }
    else
    {
      $sql =mysqli_query($config,"INSERT INTO `online_payment_transcation` (`merchantUserId` , `merchantTransactionId`,`Order_Paid_Status`, `Order_id`, `Customer_id`, `Customer_Name`, `Paid_on`,`Payment_Gateway`,`Paid_Amout`) VALUES ('$merchantUserId','$merchantTransactionId','success', '$lastInsertID','$session_customer_id','$session_driver','$session_create_on','Phonepay','$session_net_amount')"); 
    
    }
    

}
   
      

header("location:successful.php?session_id=$customerid");
    
  }
  else
  {

//  echo "insert into job_search_post(customer_name,customer_id,customer_phone_no,job_category_id,job_name,experiences,qualification,company_name,district_id,city_id,area_id,salary_range,contact_no,email_id,post_date,last_date,address,remarks,amount,job_location,days,exp_date)
//     values('$customer_name','$customerid','$custmer_phone_no','$Add_job_cate','$job_name','$experiences','$qualification','$company_name','$Add_city','$Add_area','$Add_sub_area','$salary_range','$contact_no','$email_id','$post_addon','$last_date','$address','$Add_remarks','$amount','$job_location','$days','$exp_date')";
//     die;

    $addmaincate=mysqli_query($config,"insert into job_search_post(customer_name,customer_id,customer_phone_no,job_category_id,job_name,experiences,qualification,company_name,state_id,district_id,city_id,salary_range,contact_no,email_id,post_date,last_date,address,remarks,amount,job_location,days,exp_date,vehicle_type,licence_no)
    values('$customer_name','$customerid','$custmer_phone_no','$Add_job_cate','$job_name','$experiences','$qualification','$company_name',$state,'$Add_city','$Add_area','$salary_range','$contact_no','$email_id','$post_addon','$last_date','$address','$Add_remarks','$amount','$job_location','$days','$exp_date','$vehicle_type','$licence_no')");	
    $lastInsertID = mysqli_insert_id($config);

    
      // $sql =mysqli_query($config,"INSERT INTO `online_payment_transcation` (`merchantUserId` , `merchantTransactionId`,`Order_Paid_Status`, `Order_id`, `Customer_id`, `Customer_Name`, `Paid_on`,`Payment_Gateway`,`Paid_Amout`) VALUES ('$merchantUserId','$merchantTransactionId','success', '$lastInsertID','$session_customer_id','$session_driver','$session_create_on','Phonepay','$amount')"); 
   
  

  }
    
 header("location:successful.php?session_id=$customerid");

die();
?>