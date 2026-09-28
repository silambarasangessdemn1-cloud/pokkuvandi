<?php include('../../config/setup.php');?>
<?php

   

if(isset($_POST['post_add']))
{
 $current_Date=date('Y-m-d');

//  echo $tr="update job_search_post set customer_name='".$_POST['Add_driver_name']."' ,customer_id='".$_POST['customerid']."',customer_phone_no='".$_POST['Add_phone_no']."',job_category_id='".$_POST['Add_job_cate']."',job_name='".$_POST['job_name']."',experiences='".$_POST['experiences']."',qualification='".$_POST['qualification']."',company_name='".$_POST['company_name']."',district_id='".$_POST['Add_city']."',city_id='".$_POST['Add_area']."',area_id='".$_POST['Add_sub_area']."',salary_range='".$_POST['salary_range']."',contact_no='".$_POST['contact_no']."',email_id='".$_POST['email_id']."',post_date='$current_Date',address='".$_POST['address']."',remarks='".$_POST['Add_remarks']."',amount='".$_POST['amount']."',licence_no='".$_POST['licence_no']."',vehicle_type='".$_POST['vehicle_type']."' where job_search_id = '".$_POST['job_search_id']."'";
//  die;
        $addmaincate=mysqli_query($config,"update job_search_post set customer_name='".$_POST['Add_driver_name']."' ,customer_id='".$_POST['customerid']."',customer_phone_no='".$_POST['Add_phone_no']."',job_category_id='".$_POST['Add_job_cate']."',job_name='".$_POST['job_name']."',experiences='".$_POST['experiences']."',qualification='".$_POST['qualification']."',company_name='".$_POST['company_name']."',district_id='".$_POST['Add_city']."',city_id='".$_POST['Add_area']."',area_id='".$_POST['Add_sub_area']."',salary_range='".$_POST['salary_range']."',contact_no='".$_POST['contact_no']."',email_id='".$_POST['email_id']."',post_date='$current_Date',address='".$_POST['address']."',amount='".$_POST['amount']."',licence_no='".$_POST['licence_no']."',vehicle_type='".$_POST['vehicle_type']."',remarks='".$_POST['PreviousAdd_remarks']."',last_date='".$_POST['last_date']."' where job_search_id = '".$_POST['job_search_id']."'");	
        echo "<script>window.location.href='../job_search_list.php?msg=505';</script>";
 
   
  }
  


?>




