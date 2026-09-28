<?php include('config/setup.php');?>
<?php
 include('session.php');
 $session_id;
 $session__username;
 $session__mail;
 $session__phone;

if(isset($_POST['post_add']))
{

      $current_Date=date('Y-m-d');

   
       $_SESSION['customerid']=$_POST['customerid']; 
       

       $_SESSION['days']=$_POST['days']; 


       
      $_SESSION['custmer_phone_no']=$_POST['custmer_phone_no'];      
      $_SESSION['customer_name']=$_POST['customer_name'];   
      
      $_SESSION['Add_job_cate']=$_POST['Add_job_cate']; 
      $_SESSION['job_name']=$_POST['job_name']; 
      $_SESSION['experiences']=$_POST['experiences'];
      $_SESSION['qualification']=$_POST['qualification'];
      $_SESSION['company_name']=$_POST['company_name'];      
      $_SESSION['post_addon']=$current_Date;
       $_SESSION['state']=$_POST['state'];      
    $_SESSION['Add_city']=$_POST['dis_city'];      
  $_SESSION['Add_area']=$_POST['Add_area'];  

      $_SESSION['salary_range']=$_POST['salary_range'];
      $_SESSION['contact_no']=$_POST['contact_no'];
      $_SESSION['email_id']=$_POST['email_id'];
      $_SESSION['last_date']=$_POST['last_date'];
      $_SESSION['address']=$_POST['address'];
      $_SESSION['Add_remarks']=$_POST['Add_remarks'];
      $_SESSION['amount']=$_POST['amount'];
      $_SESSION['job_location']=$_POST['job_location'];

      $_SESSION['vehicle_type']=$_POST['vehicle_type'];

      $_SESSION['licence_no']=$_POST['licence_no'];


      $customerid = $_SESSION['customerid']; 
       
       
      $custmer_phone_no = $_SESSION['custmer_phone_no'];      
      $customer_name = $_SESSION['customer_name'];   
      
      $days = $_SESSION['days']; 


     $Add_job_cate = $_SESSION['Add_job_cate']; 
      $job_name = $_SESSION['job_name']; 
     $experiences = $_SESSION['experiences'];
      $qualification = $_SESSION['qualification'];
      $company_name = $_SESSION['company_name'];      
      $post_addon = $_SESSION['post_addon'];
   $Add_city = $_SESSION['Add_city'];      
      $Add_area = $_SESSION['Add_area'];  
      $state = $_SESSION['state'];
      $salary_range = $_SESSION['salary_range'];
      $contact_no = $_SESSION['contact_no'];
      $email_id = $_SESSION['email_id'];
      $last_date = $_SESSION['last_date'];
      $address = $_SESSION['address'];
      $Add_remarks = $_SESSION['Add_remarks'];
      $amount = $_SESSION['amount'];
      $job_location = $_SESSION['job_location'];
      $vehicle_type = $_SESSION['vehicle_type'];
      $licence_no = $_SESSION['licence_no'];


      // echo "<script>window.location.href='payment_api/pay.php?session_id=$session_id&session__phone=$session__phone&session__username=$session__username';</script>";
    
// echo "<script>window.location.href='payment_api/pay.php?session_id=$session_id&session__phone=$session__phone&session__username=$session__username&Add_postid=$Add_postid';</script>";
$redirect_url = "phonepay_job.php?vehicle_type=" . urlencode($vehicle_type) .
                "&job_locatio=" . urlencode($job_location) .
                "&amount=" . urlencode($amount) .
                "&customerid=" . urlencode($customerid) .
                "&customer_name=" . urlencode($customer_name) .
                "&custmer_phone_no=" . urlencode($custmer_phone_no) .
                "&Add_job_cate=" . urlencode($Add_job_cate) .
                "&job_name=" . urlencode($job_name) .
                "&experiences=" . urlencode($experiences) .
                "&qualification=" . urlencode($qualification) .
                "&company_name=" . urlencode($company_name) .
                "&post_addon=" . urlencode($post_addon) .
                "&Add_city=" . urlencode($Add_city) .
                "&state=" . urlencode($state) .
                "&Add_area=" . urlencode($Add_area) .
                "&salary_range=" . urlencode($salary_range) .
                "&contact_no=" . urlencode($contact_no) .
                "&email_id=" . urlencode($email_id) .
                "&last_date=" . urlencode($last_date) .
                "&address=" . urlencode($address) .
                "&Add_remarks=" . urlencode($Add_remarks) .
                "&days=" . urlencode($days) .
                "&licence_no=" . urlencode($licence_no);

// JavaScript redirect
echo "<script>window.location.href='$redirect_url';</script>";


}
    else
    {
      echo "<script>window.location.href='create_post_messgae.php?msgerror=error';</script>";
    }    

  



//    if($addmaincate==false)
// {
 	
//  	 echo "<script>window.location.href='../create_post.php?erro=0';</script>".mysqli_error();	 
// }
// else{
	
// 	echo "<script>window.location.href='../create_post.php?msg=505';</script>";	 

	
// }	





?>




