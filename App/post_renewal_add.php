<?php include('config/setup.php');?>
<?php
 include('session.php');
 $session_id;
 $session__username;
 $session__mail;
 $session__phone;

if(isset($_POST['post_add']))
{
  

  
// $timezone = new DateTimeZone("Asia/Kolkata" );
// $date = new DateTime();
// $date->setTimezone($timezone );
// $today2=$date->format('s');	
$addcatephoto=$_FILES['Add_vehicle_photo']['name'];
$addphoto="../photos/vehicle/".$addcatephoto;
move_uploaded_file($_FILES["Add_vehicle_photo"]["tmp_name"],$addphoto);


 $current_Date=date('Y-m-d');

  $sql="SELECT * FROM `create_post` where subcategory_id = ".$_POST['Add_sub_category']."  && area_id=".$_POST['Add_area']." && customer_id ='$session_id' Order by create_on DESC "; 
    
 
   $sdate= mysqli_query($config, $sql);
	 $data = mysqli_fetch_object($sdate);
	 $total_user = mysqli_num_rows($sdate);


    $create_on = $data->create_on; 
    $package_days = $data->package_days;    
   $futureDate = date("Y-m-d", strtotime($create_on . " +$package_days days")); 

   
  if($data!=''){
   
    
    if($futureDate < $current_Date){

     
      if($_POST['Add_amount'] == '0')
    {
      $addmaincate=mysqli_query($config,"insert into create_post(driver_name,vehicle_no,vehicle_photo,phone_no,whatsapp_no,address,city_id,area_id,status,post_addon,vehicle_name,category_id,subcategory_id,meta_keyword,create_on,Add_load_detail,Add_location,Add_Registration_date,Add_RC_owner_name,Add_insurance_exp_date,FC_date,remarks,package_id,package_amount,package_days,customer_id,expiry_date	)
      values('".$_POST['Add_driver_name']."','".$_POST['Add_vehicle_no']."','$addcatephoto','".$_POST['Add_phone_no']."','".$_POST['Add_whatsapp_no']."','".$_POST['Add_address']."','".$_POST['Add_city']."','".$_POST['Add_area']."','".$_POST['Add_status']."','$current_Date','".$_POST['Add_vehicle_name']."','".$_POST['Add_main_cate']."','".$_POST['Add_sub_category']."','".$_POST['Add_meta_keyword']."','$current_Date','".$_POST['Add_load_detail']."','".$_POST['Add_location']."','".$_POST['Add_Registration_date']."','".$_POST['Add_RC_owner_name']."','".$_POST['Add_insurance_exp_date']."','".$_POST['FC_date']."','".$_POST['Add_remarks']."','".$_POST['Add_package']."','".$_POST['Add_amount']."','".$_POST['Add_days']."','$session_id','$futureDate')");	
      echo "<script>window.location.href='create_post_messgae.php?msg=505';</script>";      
    }
    else
    {

      $_SESSION['Add_driver_name']=$_POST['Add_driver_name'];      
      $_SESSION['Add_vehicle_no']=$_POST['Add_vehicle_no'];   
      $_SESSION['addcatephoto']=$addcatephoto;   
      $_SESSION['Add_phone_no']=$_POST['Add_phone_no']; 
      $_SESSION['Add_whatsapp_no']=$_POST['Add_whatsapp_no']; 
      $_SESSION['Add_address']=$_POST['Add_address'];
      $_SESSION['Add_city']=$_POST['Add_city'];
      $_SESSION['Add_area']=$_POST['Add_area'];
      $_SESSION['Add_status']=$_POST['Add_status'];
      $_SESSION['post_addon']=$current_Date;
      $_SESSION['Add_vehicle_name']=$_POST['Add_vehicle_name'];
      $_SESSION['Add_main_cate']=$_POST['Add_main_cate'];
      $_SESSION['Add_sub_category']=$_POST['Add_sub_category'];
      $_SESSION['Add_meta_keyword']=$_POST['Add_meta_keyword'];
      $_SESSION['create_on']=$current_Date;
      $_SESSION['Add_load_detail']=$_POST['Add_load_detail'];
      $_SESSION['Add_location']=$_POST['Add_location'];
      $_SESSION['Add_Registration_date']=$_POST['Add_Registration_date'];
      $_SESSION['Add_RC_owner_name']=$_POST['Add_RC_owner_name'];
      $_SESSION['Add_insurance_exp_date']=$_POST['Add_insurance_exp_date'];
      $_SESSION['FC_date']=$_POST['FC_date'];
      $_SESSION['Add_remarks']=$_POST['Add_remarks'];
      $_SESSION['Add_package']=$_POST['Add_package'];
      $_SESSION['Add_amount']=$_POST['Add_amount'];
      $_SESSION['Add_days']=$_POST['Add_days'];
      $session_id;
      $_SESSION['futureDate']=$futureDate;
      
      echo "<script>window.location.href='payment_api/pay.php?session_id=$session_id&session__phone=$session__phone&session__username=$session__username&amount=".$_POST['Add_amount']."';</script>";
    
    }
    
    }
    else
    {
      echo "<script>window.location.href='create_post_messgae.php?msgerror=error';</script>";
    }    
  }
  else{

    if($_POST['Add_amount'] == '0')
    {
      $package_days = $_POST['Add_days'];    
      $futureDate = date("Y-m-d", strtotime($current_Date . " +$package_days days"));       
      $addmaincate=mysqli_query($config,"insert into create_post(driver_name,vehicle_no,vehicle_photo,phone_no,whatsapp_no,address,city_id,area_id,status,post_addon,vehicle_name,category_id,subcategory_id,meta_keyword,create_on,Add_load_detail,Add_location,Add_Registration_date,Add_RC_owner_name,Add_insurance_exp_date,FC_date,remarks,package_id,package_amount,package_days,customer_id,expiry_date	)
        values('".$_POST['Add_driver_name']."','".$_POST['Add_vehicle_no']."','$addcatephoto','".$_POST['Add_phone_no']."','".$_POST['Add_whatsapp_no']."','".$_POST['Add_address']."','".$_POST['Add_city']."','".$_POST['Add_area']."','".$_POST['Add_status']."','$current_Date','".$_POST['Add_vehicle_name']."','".$_POST['Add_main_cate']."','".$_POST['Add_sub_category']."','".$_POST['Add_meta_keyword']."','$current_Date','".$_POST['Add_load_detail']."','".$_POST['Add_location']."','".$_POST['Add_Registration_date']."','".$_POST['Add_RC_owner_name']."','".$_POST['Add_insurance_exp_date']."','".$_POST['FC_date']."','".$_POST['Add_remarks']."','".$_POST['Add_package']."','".$_POST['Add_amount']."','".$_POST['Add_days']."','$session_id','$futureDate')");	
        echo "<script>window.location.href='create_post_messgae.php?msg=505';</script>";
    
    }
    else
    {

      $package_days = $_POST['Add_days'];    
      $futureDate = date("Y-m-d", strtotime($current_Date . " +$package_days days")); 
      
      $_SESSION['Add_driver_name']=$_POST['Add_driver_name'];      
      $_SESSION['Add_vehicle_no']=$_POST['Add_vehicle_no'];   
      $_SESSION['addcatephoto']=$addcatephoto;    
      $_SESSION['Add_phone_no']=$_POST['Add_phone_no']; 
      $_SESSION['Add_whatsapp_no']=$_POST['Add_whatsapp_no']; 
      $_SESSION['Add_address']=$_POST['Add_address'];
      $_SESSION['Add_city']=$_POST['Add_city'];
      $_SESSION['Add_area']=$_POST['Add_area'];
      $_SESSION['Add_status']=$_POST['Add_status'];
      $_SESSION['post_addon']=$current_Date;
      $_SESSION['Add_vehicle_name']=$_POST['Add_vehicle_name'];
      $_SESSION['Add_main_cate']=$_POST['Add_main_cate'];
      $_SESSION['Add_sub_category']=$_POST['Add_sub_category'];
      $_SESSION['Add_meta_keyword']=$_POST['Add_meta_keyword'];
      $_SESSION['create_on']=$current_Date;
      $_SESSION['Add_load_detail']=$_POST['Add_load_detail'];
      $_SESSION['Add_location']=$_POST['Add_location'];
      $_SESSION['Add_Registration_date']=$_POST['Add_Registration_date'];
      $_SESSION['Add_RC_owner_name']=$_POST['Add_RC_owner_name'];
      $_SESSION['Add_insurance_exp_date']=$_POST['Add_insurance_exp_date'];
      $_SESSION['FC_date']=$_POST['FC_date'];
      $_SESSION['Add_remarks']=$_POST['Add_remarks'];
      $_SESSION['Add_package']=$_POST['Add_package'];
      $_SESSION['Add_amount']=$_POST['Add_amount'];
      $_SESSION['Add_days']=$_POST['Add_days'];
      $session_id;
      $_SESSION['futureDate']=$futureDate;

      echo "<script>window.location.href='payment_api/pay.php?session_id=$session_id&session__phone=$session__phone&session__username=$session__username&amount=".$_POST['Add_amount']."';</script>";
      
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




