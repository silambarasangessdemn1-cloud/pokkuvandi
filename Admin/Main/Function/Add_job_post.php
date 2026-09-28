<?php include('../../config/setup.php');?>
<?php

   

if(isset($_POST['post_add']))
{
  $package_days=$_POST['days'];
 $current_Date=date('Y-m-d');

 $futureDate = date("Y-m-d", strtotime($current_Date . " +$package_days days")); 



//  echo $tr="insert into job_search_post(customer_name,customer_id,customer_phone_no,job_category_id,job_name,experiences,qualification,company_name,district_id,city_id,area_id,salary_range,contact_no,email_id,post_date,last_date,address,remarks,amount,licence_no,vehicle_type)
//  values('".$_POST['Add_driver_name']."','".$_POST['customerid']."','".$_POST['Add_phone_no']."','".$_POST['Add_job_cate']."','".$_POST['job_name']."','".$_POST['experiences']."','".$_POST['qualification']."','".$_POST['company_name']."','".$_POST['Add_city']."','".$_POST['Add_area']."','".$_POST['Add_sub_area']."','".$_POST['salary_range']."','".$_POST['contact_no']."','".$_POST['email_id']."','$current_Date','".$_POST['last_date']."','".$_POST['address']."','".$_POST['Add_remarks']."','".$_POST['amount']."','".$_POST['licence_no']."','".$_POST['vehicle_type']."')";
//  die;
        $addmaincate=mysqli_query($config,"insert into job_search_post(customer_name,customer_id,customer_phone_no,job_category_id,job_name,experiences,qualification,company_name,district_id,city_id,area_id,salary_range,contact_no,email_id,post_date,last_date,address,remarks,amount,licence_no,vehicle_type,days,exp_date,job_location)
        values('".$_POST['Add_driver_name']."','".$_POST['customerid']."','".$_POST['Add_phone_no']."','".$_POST['Add_job_cate']."','".$_POST['job_name']."','".$_POST['experiences']."','".$_POST['qualification']."','".$_POST['company_name']."','".$_POST['Add_city']."','".$_POST['Add_area']."','".$_POST['Add_sub_area']."','".$_POST['salary_range']."','".$_POST['contact_no']."','".$_POST['email_id']."','$current_Date','".$_POST['last_date']."','".$_POST['address']."','".$_POST['Add_remarks']."','".$_POST['amount']."','".$_POST['licence_no']."','".$_POST['vehicle_type']."','".$_POST['days']."','$futureDate','".$_POST['job_location']."')");	
        echo "<script>window.location.href='../job_search_list.php?msg=505';</script>";
      // }
   
  }
  


?>




