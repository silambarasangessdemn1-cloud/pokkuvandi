<?php include('config/setup.php');?>
<?php
 include('session.php');
 $session_id;
 $session__username;
 $session__mail;
 $session__phone;

if(isset($_POST['post_add']))
{

  if(isset($_POST['Add_main_cate']) == '') { 
    // echo 'Please select a Category.'; 
  } 

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


    $create_on = $data->create_on; 
    $package_days = $data->package_days;    
   $futureDate = date("Y-m-d", strtotime($create_on . " +$package_days days")); 

   
  if($data!=''){
   
    
    if($futureDate < $current_Date){

     
      if($_POST['Add_amount'] == '0')
    {

      $_SESSION['Add_postid']=$_POST['Add_postid']; 
       
       
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
      $_SESSION['day_duty']=$_POST['day_duty'];
      $_SESSION['night_duty']=$_POST['night_duty'];

      $_SESSION['vehicle_type_id']=$_POST['vehicle_type_id'];
      $_SESSION['seating_capacity']=$_POST['seating_capacity'];
      $_SESSION['facilities']=$_POST['facilities'];
      $_SESSION['space']=$_POST['space'];
      $_SESSION['size']=$_POST['size'];
      $_SESSION['tonnage']=$_POST['tonnage'];
      $_SESSION['shop_name']=$_POST['shop_name'];
      $_SESSION['work_nature']=$_POST['work_nature'];
      $_SESSION['shop_address']=$_POST['shop_address'];
      $_SESSION['stand_name']=$_POST['stand_name'];
      $_SESSION['net_amount']=$_POST['net_amount']; 
      $_SESSION['Add_sub_area']=$_POST['Add_sub_area']; 

      $_SESSION['reffered_by_phone_no']=$_POST['reffered_by_phone_no']; 
      $_SESSION['reffered_by_name']=$_POST['reffered_by_name']; 
      

      $_SESSION['less_amount']= $_POST['less_amount'];
      $_SESSION['coupon_code']= $_POST['coupon_code'];
      $_SESSION['coupon_type']= $_POST['coupon_type'];

      $Add_postid = $_SESSION['Add_postid'];       
      $Add_driver_name = $_SESSION['Add_driver_name'];      
      $Add_vehicle_no=$_SESSION['Add_vehicle_no'];   
      $addcatephoto=$_SESSION['addcatephoto'];   
      $Add_phone_no=$_SESSION['Add_phone_no']; 
      $Add_whatsapp_no=$_SESSION['Add_whatsapp_no']; 
      $Add_address=$_SESSION['Add_address'];
      $Add_city=$_SESSION['Add_city'];
      $Add_area=$_SESSION['Add_area'];
      $Add_status=$_SESSION['Add_status'];
      $post_addon=$_SESSION['post_addon'];
      $Add_vehicle_name =$_SESSION['Add_vehicle_name'];
      $Add_main_cate = $_SESSION['Add_main_cate'];
      $Add_sub_category =$_SESSION['Add_sub_category'];
      $Add_meta_keyword = $_SESSION['Add_meta_keyword'];
      $create_on =$_SESSION['create_on'];
      $Add_load_detail =$_SESSION['Add_load_detail'];
      $Add_location = $_SESSION['Add_location'];
      $Add_Registration_date = $_SESSION['Add_Registration_date'];
      $Add_RC_owner_name = $_SESSION['Add_RC_owner_name'];
      $Add_insurance_exp_date = $_SESSION['Add_insurance_exp_date'];
      $FC_date = $_SESSION['FC_date'];
      $Add_remarks = $_SESSION['Add_remarks'];
      $Add_package = $_SESSION['Add_package'];
      $Add_amount=$_SESSION['Add_amount'];
      $Add_days = $_SESSION['Add_days'];
      $session_id;
      $futureDate = $_SESSION['futureDate'];
      $day_duty = $_SESSION['day_duty'];
      $night_duty = $_SESSION['night_duty'];

      $vehicle_type_id = $_SESSION['vehicle_type_id'];
      $seating_capacity = $_SESSION['seating_capacity'];
      $facilities = $_SESSION['facilities'];
      $space = $_SESSION['space'];
      $size = $_SESSION['size'];
      $tonnage = $_SESSION['tonnage'];
      $shop_name = $_SESSION['shop_name'];
      $work_nature = $_SESSION['work_nature'];
      $shop_address = $_SESSION['shop_address'];
      $stand_name = $_SESSION['stand_name'];
      $net_amount = $_SESSION['net_amount']; 
      $Add_sub_area = $_SESSION['Add_sub_area']; 

      $reffered_by_phone_no = $_SESSION['reffered_by_phone_no']; 
      $reffered_by_name = $_SESSION['reffered_by_name']; 
      

      $less_amount = $_SESSION['less_amount'];
      $coupon_code = $_SESSION['coupon_code'];
      $coupon_type = $_SESSION['coupon_type'];

      $addmaincate=mysqli_query($config,"insert into create_post(driver_name,vehicle_no,vehicle_photo,phone_no,whatsapp_no,address,city_id,area_id,status,post_addon,vehicle_name,category_id,subcategory_id,meta_keyword,create_on,Add_load_detail,Add_location,Add_Registration_date,Add_RC_owner_name,Add_insurance_exp_date,FC_date,remarks,package_id,package_amount,package_days,customer_id,expiry_date,day_duty,night_duty,vehicle_type_id,seating_capacity,facilities,space,size,tonnage,shop_name,work_nature,shop_address,stand_name,sub_area_id,reffered_by_phone_no,reffered_by_name,discount_amount,discount_name,coupon_type)
      values('".$_POST['Add_driver_name']."','".$_POST['Add_vehicle_no']."','$addcatephoto','".$_POST['Add_phone_no']."','".$_POST['Add_whatsapp_no']."','".$_POST['Add_address']."','".$_POST['Add_city']."','".$_POST['Add_area']."','".$_POST['Add_status']."','$current_Date','".$_POST['Add_vehicle_name']."','".$_POST['Add_main_cate']."','".$_POST['Add_sub_category']."','".$_POST['Add_meta_keyword']."','$current_Date','".$_POST['Add_load_detail']."','".$_POST['Add_location']."','".$_POST['Add_Registration_date']."','".$_POST['Add_RC_owner_name']."','".$_POST['Add_insurance_exp_date']."','".$_POST['FC_date']."','".$_POST['Add_remarks']."','".$_POST['Add_package']."','".$_POST['Add_amount']."','".$_POST['Add_days']."','$session_id','$futureDate','".$_POST['day_duty']."','".$_POST['night_duty']."','".$_POST['vehicle_type_id']."','".$_POST['seating_capacity']."','".$_POST['facilities']."','".$_POST['space']."','".$_POST['size']."','".$_POST['tonnage']."','".$_POST['shop_name']."','".$_POST['work_nature']."','".$_POST['shop_address']."','".$_POST['stand_name']."','".$_POST['Add_sub_area']."','".$_POST['reffered_by_phone_no']."','".$_POST['reffered_by_name']."','".$_POST['less_amount']."','".$_POST['coupon_code']."','".$_POST['coupon_type']."')");	
      echo "<script>window.location.href='create_post_messgae.php?msg=505';</script>";      
    }
    else
    {
       $_SESSION['Add_postid']=$_POST['Add_postid']; 
       
       
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
      $_SESSION['day_duty']=$_POST['day_duty'];
      $_SESSION['night_duty']=$_POST['night_duty'];

      $_SESSION['vehicle_type_id']=$_POST['vehicle_type_id'];
      $_SESSION['seating_capacity']=$_POST['seating_capacity'];
      $_SESSION['facilities']=$_POST['facilities'];
      $_SESSION['space']=$_POST['space'];
      $_SESSION['size']=$_POST['size'];
      $_SESSION['tonnage']=$_POST['tonnage'];
      $_SESSION['shop_name']=$_POST['shop_name'];
      $_SESSION['work_nature']=$_POST['work_nature'];
      $_SESSION['shop_address']=$_POST['shop_address'];
      $_SESSION['stand_name']=$_POST['stand_name'];
      $_SESSION['net_amount']=$_POST['net_amount']; 
      $_SESSION['Add_sub_area']=$_POST['Add_sub_area']; 

      $_SESSION['reffered_by_phone_no']=$_POST['reffered_by_phone_no']; 
      $_SESSION['reffered_by_name']=$_POST['reffered_by_name']; 
      

      $_SESSION['less_amount']= $_POST['less_amount'];
      $_SESSION['coupon_code']= $_POST['coupon_code'];
      $_SESSION['coupon_type']= $_POST['coupon_type'];

      $Add_postid = $_SESSION['Add_postid'];       
      $Add_driver_name = $_SESSION['Add_driver_name'];      
      $Add_vehicle_no=$_SESSION['Add_vehicle_no'];   
      $addcatephoto=$_SESSION['addcatephoto'];   
      $Add_phone_no=$_SESSION['Add_phone_no']; 
      $Add_whatsapp_no=$_SESSION['Add_whatsapp_no']; 
      $Add_address=$_SESSION['Add_address'];
      $Add_city=$_SESSION['Add_city'];
      $Add_area=$_SESSION['Add_area'];
      $Add_status=$_SESSION['Add_status'];
      $post_addon=$_SESSION['post_addon'];
      $Add_vehicle_name =$_SESSION['Add_vehicle_name'];
      $Add_main_cate = $_SESSION['Add_main_cate'];
      $Add_sub_category =$_SESSION['Add_sub_category'];
      $Add_meta_keyword = $_SESSION['Add_meta_keyword'];
      $create_on =$_SESSION['create_on'];
      $Add_load_detail =$_SESSION['Add_load_detail'];
      $Add_location = $_SESSION['Add_location'];
      $Add_Registration_date = $_SESSION['Add_Registration_date'];
      $Add_RC_owner_name = $_SESSION['Add_RC_owner_name'];
      $Add_insurance_exp_date = $_SESSION['Add_insurance_exp_date'];
      $FC_date = $_SESSION['FC_date'];
      $Add_remarks = $_SESSION['Add_remarks'];
      $Add_package = $_SESSION['Add_package'];
      $Add_amount=$_SESSION['Add_amount'];
      $Add_days = $_SESSION['Add_days'];
      $session_id;
      $futureDate = $_SESSION['futureDate'];
      $day_duty = $_SESSION['day_duty'];
      $night_duty = $_SESSION['night_duty'];

      $vehicle_type_id = $_SESSION['vehicle_type_id'];
      $seating_capacity = $_SESSION['seating_capacity'];
      $facilities = $_SESSION['facilities'];
      $space = $_SESSION['space'];
      $size = $_SESSION['size'];
      $tonnage = $_SESSION['tonnage'];
      $shop_name = $_SESSION['shop_name'];
      $work_nature = $_SESSION['work_nature'];
      $shop_address = $_SESSION['shop_address'];
      $stand_name = $_SESSION['stand_name'];
      $net_amount = $_SESSION['net_amount']; 
      $Add_sub_area = $_SESSION['Add_sub_area']; 

      $reffered_by_phone_no = $_SESSION['reffered_by_phone_no']; 
      $reffered_by_name = $_SESSION['reffered_by_name']; 
      

      $less_amount = $_SESSION['less_amount'];
      $coupon_code = $_SESSION['coupon_code'];
      $coupon_type = $_SESSION['coupon_type'];

      // echo "<script>window.location.href='payment_api/pay.php?session_id=$session_id&session__phone=$session__phone&session__username=$session__username';</script>";
    
// echo "<script>window.location.href='payment_api/pay.php?session_id=$session_id&session__phone=$session__phone&session__username=$session__username&Add_postid=$Add_postid';</script>";
    
      echo "<script>window.location.href='phonepay.php?session_id=$session_id&session__phone=$session__phone&session__username=$session__username&Add_postid=$Add_postid&Add_driver_name=$Add_driver_name&Add_vehicle_no=$Add_vehicle_no&addcatephoto=$addcatephoto&Add_phone_no=$Add_phone_no&Add_whatsapp_no=$Add_whatsapp_no&Add_address=$Add_address&Add_city=$Add_city&Add_area=$Add_area&Add_status=$Add_status&post_addon=$post_addon&Add_vehicle_name=$Add_vehicle_name&Add_main_cate=$Add_main_cate&Add_sub_category=$Add_sub_category&Add_meta_keyword=$Add_meta_keyword&create_on=$create_on&Add_load_detail=$Add_load_detail&Add_location=$Add_location&Add_Registration_date=$Add_Registration_date&Add_RC_owner_name=$Add_RC_owner_name&Add_insurance_exp_date=$Add_insurance_exp_date&FC_date=$FC_date&Add_remarks=$Add_remarks&Add_package=$Add_package&Add_amount=$Add_amount&Add_days=$Add_days&futureDate=$futureDate&day_duty=$day_duty&night_duty=$night_duty&vehicle_type_id=$vehicle_type_id&seating_capacity=$seating_capacity&facilities=$facilities&space=$space&size=$size&tonnage=$tonnage&shop_name=$shop_name&work_nature=$work_nature&shop_address=$shop_address&stand_name=$stand_name&net_amount=$net_amount&Add_sub_area=$Add_sub_area&reffered_by_phone_no=$reffered_by_phone_no&reffered_by_name=$reffered_by_name&less_amount=$less_amount&coupon_code=$coupon_code&coupon_type=$coupon_type';</script>";
    


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

      $_SESSION['Add_postid']=$_POST['Add_postid']; 
       
       
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
      $_SESSION['day_duty']=$_POST['day_duty'];
      $_SESSION['night_duty']=$_POST['night_duty'];

      $_SESSION['vehicle_type_id']=$_POST['vehicle_type_id'];
      $_SESSION['seating_capacity']=$_POST['seating_capacity'];
      $_SESSION['facilities']=$_POST['facilities'];
      $_SESSION['space']=$_POST['space'];
      $_SESSION['size']=$_POST['size'];
      $_SESSION['tonnage']=$_POST['tonnage'];
      $_SESSION['shop_name']=$_POST['shop_name'];
      $_SESSION['work_nature']=$_POST['work_nature'];
      $_SESSION['shop_address']=$_POST['shop_address'];
      $_SESSION['stand_name']=$_POST['stand_name'];
      $_SESSION['net_amount']=$_POST['net_amount']; 
      $_SESSION['Add_sub_area']=$_POST['Add_sub_area']; 

      $_SESSION['reffered_by_phone_no']=$_POST['reffered_by_phone_no']; 
      $_SESSION['reffered_by_name']=$_POST['reffered_by_name']; 
      

      $_SESSION['less_amount']= $_POST['less_amount'];
      $_SESSION['coupon_code']= $_POST['coupon_code'];
      $_SESSION['coupon_type']= $_POST['coupon_type'];

      $Add_postid = $_SESSION['Add_postid'];       
      $Add_driver_name = $_SESSION['Add_driver_name'];      
      $Add_vehicle_no=$_SESSION['Add_vehicle_no'];   
      $addcatephoto=$_SESSION['addcatephoto'];   
      $Add_phone_no=$_SESSION['Add_phone_no']; 
      $Add_whatsapp_no=$_SESSION['Add_whatsapp_no']; 
      $Add_address=$_SESSION['Add_address'];
      $Add_city=$_SESSION['Add_city'];
      $Add_area=$_SESSION['Add_area'];
      $Add_status=$_SESSION['Add_status'];
      $post_addon=$_SESSION['post_addon'];
      $Add_vehicle_name =$_SESSION['Add_vehicle_name'];
      $Add_main_cate = $_SESSION['Add_main_cate'];
      $Add_sub_category =$_SESSION['Add_sub_category'];
      $Add_meta_keyword = $_SESSION['Add_meta_keyword'];
      $create_on =$_SESSION['create_on'];
      $Add_load_detail =$_SESSION['Add_load_detail'];
      $Add_location = $_SESSION['Add_location'];
      $Add_Registration_date = $_SESSION['Add_Registration_date'];
      $Add_RC_owner_name = $_SESSION['Add_RC_owner_name'];
      $Add_insurance_exp_date = $_SESSION['Add_insurance_exp_date'];
      $FC_date = $_SESSION['FC_date'];
      $Add_remarks = $_SESSION['Add_remarks'];
      $Add_package = $_SESSION['Add_package'];
      $Add_amount=$_SESSION['Add_amount'];
      $Add_days = $_SESSION['Add_days'];
      $session_id;
      $futureDate = $_SESSION['futureDate'];
      $day_duty = $_SESSION['day_duty'];
      $night_duty = $_SESSION['night_duty'];

      $vehicle_type_id = $_SESSION['vehicle_type_id'];
      $seating_capacity = $_SESSION['seating_capacity'];
      $facilities = $_SESSION['facilities'];
      $space = $_SESSION['space'];
      $size = $_SESSION['size'];
      $tonnage = $_SESSION['tonnage'];
      $shop_name = $_SESSION['shop_name'];
      $work_nature = $_SESSION['work_nature'];
      $shop_address = $_SESSION['shop_address'];
      $stand_name = $_SESSION['stand_name'];
      $net_amount = $_SESSION['net_amount']; 
      $Add_sub_area = $_SESSION['Add_sub_area']; 

      $reffered_by_phone_no = $_SESSION['reffered_by_phone_no']; 
      $reffered_by_name = $_SESSION['reffered_by_name']; 
      

      $less_amount = $_SESSION['less_amount'];
      $coupon_code = $_SESSION['coupon_code'];
      $coupon_type = $_SESSION['coupon_type'];

      

      $package_days = $_POST['Add_days'];    
      $futureDate = date("Y-m-d", strtotime($current_Date . " +$package_days days"));    
      
      // echo $query="insert into create_post(driver_name,vehicle_no,vehicle_photo,phone_no,whatsapp_no,address,city_id,area_id,status,post_addon,vehicle_name,category_id,subcategory_id,meta_keyword,create_on,Add_load_detail,Add_location,Add_Registration_date,Add_RC_owner_name,Add_insurance_exp_date,FC_date,remarks,package_id,package_amount,package_days,customer_id,expiry_date,day_duty,night_duty,vehicle_type_id,seating_capacity,facilities,space,size,tonnage,shop_name,work_nature,shop_address,stand_name)
      // values('".$_POST['Add_driver_name']."','".$_POST['Add_vehicle_no']."','$addcatephoto','".$_POST['Add_phone_no']."','".$_POST['Add_whatsapp_no']."','".$_POST['Add_address']."','".$_POST['Add_city']."','".$_POST['Add_area']."','".$_POST['Add_status']."','$current_Date','".$_POST['Add_vehicle_name']."','".$_POST['Add_main_cate']."','".$_POST['Add_sub_category']."','".$_POST['Add_meta_keyword']."','$current_Date','".$_POST['Add_load_detail']."','".$_POST['Add_location']."','".$_POST['Add_Registration_date']."','".$_POST['Add_RC_owner_name']."','".$_POST['Add_insurance_exp_date']."','".$_POST['FC_date']."','".$_POST['Add_remarks']."','".$_POST['Add_package']."','".$_POST['Add_amount']."','".$_POST['Add_days']."','$session_id','$futureDate','".$_POST['day_duty']."','".$_POST['night_duty']."','".$_POST['vehicle_type_id']."','".$_POST['seating_capacity']."','".$_POST['facilities']."','".$_POST['space']."','".$_POST['size']."','".$_POST['tonnage']."','".$_POST['shop_name']."','".$_POST['work_nature']."','".$_POST['shop_address']."','".$_POST['stand_name']."')";
      // die;
      $addmaincate=mysqli_query($config,"insert into create_post(driver_name,vehicle_no,vehicle_photo,phone_no,whatsapp_no,address,city_id,area_id,status,post_addon,vehicle_name,category_id,subcategory_id,meta_keyword,create_on,Add_load_detail,Add_location,Add_Registration_date,Add_RC_owner_name,Add_insurance_exp_date,FC_date,remarks,package_id,package_amount,package_days,customer_id,expiry_date,day_duty,night_duty,vehicle_type_id,seating_capacity,facilities,space,size,tonnage,shop_name,work_nature,shop_address,stand_name,sub_area_id,reffered_by_phone_no,reffered_by_name,discount_amount,discount_name,coupon_type)
        values('".$_POST['Add_driver_name']."','".$_POST['Add_vehicle_no']."','$addcatephoto','".$_POST['Add_phone_no']."','".$_POST['Add_whatsapp_no']."','".$_POST['Add_address']."','".$_POST['Add_city']."','".$_POST['Add_area']."','".$_POST['Add_status']."','$current_Date','".$_POST['Add_vehicle_name']."','".$_POST['Add_main_cate']."','".$_POST['Add_sub_category']."','".$_POST['Add_meta_keyword']."','$current_Date','".$_POST['Add_load_detail']."','".$_POST['Add_location']."','".$_POST['Add_Registration_date']."','".$_POST['Add_RC_owner_name']."','".$_POST['Add_insurance_exp_date']."','".$_POST['FC_date']."','".$_POST['Add_remarks']."','".$_POST['Add_package']."','".$_POST['Add_amount']."','".$_POST['Add_days']."','$session_id','$futureDate','".$_POST['day_duty']."','".$_POST['night_duty']."','".$_POST['vehicle_type_id']."','".$_POST['seating_capacity']."','".$_POST['facilities']."','".$_POST['space']."','".$_POST['size']."','".$_POST['tonnage']."','".$_POST['shop_name']."','".$_POST['work_nature']."','".$_POST['shop_address']."','".$_POST['stand_name']."','".$_POST['Add_sub_area']."','".$_POST['reffered_by_phone_no']."','".$_POST['reffered_by_name']."','".$_POST['less_amount']."','".$_POST['coupon_code']."','".$_POST['coupon_type']."')");	
        echo "<script>window.location.href='create_post_messgae.php?msg=505';</script>";
    
    }
    else
    {

      $package_days = $_POST['Add_days'];    
      $futureDate = date("Y-m-d", strtotime($current_Date . " +$package_days days")); 
   
      $_SESSION['Add_postid']=$_POST['Add_postid']; 
      $_SESSION['Add_sub_area']=$_POST['Add_sub_area']; 
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
      $_SESSION['day_duty']=$_POST['day_duty'];
      $_SESSION['night_duty']=$_POST['night_duty'];
      $session_id;
      $_SESSION['futureDate']=$futureDate;

      $_SESSION['vehicle_type_id']=$_POST['vehicle_type_id'];
      $_SESSION['seating_capacity']=$_POST['seating_capacity'];
      $_SESSION['facilities']=$_POST['facilities'];
      $_SESSION['space']=$_POST['space'];
      $_SESSION['size']=$_POST['size'];
      $_SESSION['tonnage']=$_POST['tonnage'];
      $_SESSION['shop_name']=$_POST['shop_name'];
      $_SESSION['work_nature']=$_POST['work_nature'];
      $_SESSION['shop_address']=$_POST['shop_address'];
      $_SESSION['stand_name']=$_POST['stand_name'];
      $_SESSION['net_amount']=$_POST['net_amount']; 

      $_SESSION['reffered_by_phone_no']=$_POST['reffered_by_phone_no']; 
      $_SESSION['reffered_by_name']=$_POST['reffered_by_name']; 
            $_SESSION['less_amount']= $_POST['less_amount'];
      $_SESSION['coupon_code']= $_POST['coupon_code'];
      $_SESSION['coupon_type']= $_POST['coupon_type'];

      $Add_postid = $_SESSION['Add_postid'];       
      $Add_driver_name = $_SESSION['Add_driver_name'];      
      $Add_vehicle_no=$_SESSION['Add_vehicle_no'];   
      $addcatephoto=$_SESSION['addcatephoto'];   
      $Add_phone_no=$_SESSION['Add_phone_no']; 
      $Add_whatsapp_no=$_SESSION['Add_whatsapp_no']; 
      $Add_address=$_SESSION['Add_address'];
      $Add_city=$_SESSION['Add_city'];
      $Add_area=$_SESSION['Add_area'];
      $Add_status=$_SESSION['Add_status'];
      $post_addon=$_SESSION['post_addon'];
      $Add_vehicle_name =$_SESSION['Add_vehicle_name'];
      $Add_main_cate = $_SESSION['Add_main_cate'];
      $Add_sub_category =$_SESSION['Add_sub_category'];
      $Add_meta_keyword = $_SESSION['Add_meta_keyword'];
      $create_on =$_SESSION['create_on'];
      $Add_load_detail =$_SESSION['Add_load_detail'];
      $Add_location = $_SESSION['Add_location'];
      $Add_Registration_date = $_SESSION['Add_Registration_date'];
      $Add_RC_owner_name = $_SESSION['Add_RC_owner_name'];
      $Add_insurance_exp_date = $_SESSION['Add_insurance_exp_date'];
      $FC_date = $_SESSION['FC_date'];
      $Add_remarks = $_SESSION['Add_remarks'];
      $Add_package = $_SESSION['Add_package'];
      $Add_amount=$_SESSION['Add_amount'];
      $Add_days = $_SESSION['Add_days'];
      $session_id;
      $futureDate = $_SESSION['futureDate'];
      $day_duty = $_SESSION['day_duty'];
      $night_duty = $_SESSION['night_duty'];

      $vehicle_type_id = $_SESSION['vehicle_type_id'];
      $seating_capacity = $_SESSION['seating_capacity'];
      $facilities = $_SESSION['facilities'];
      $space = $_SESSION['space'];
      $size = $_SESSION['size'];
      $tonnage = $_SESSION['tonnage'];
      $shop_name = $_SESSION['shop_name'];
      $work_nature = $_SESSION['work_nature'];
      $shop_address = $_SESSION['shop_address'];
      $stand_name = $_SESSION['stand_name'];
      $net_amount = $_SESSION['net_amount']; 
      $Add_sub_area = $_SESSION['Add_sub_area']; 

      $reffered_by_phone_no = $_SESSION['reffered_by_phone_no']; 
      $reffered_by_name = $_SESSION['reffered_by_name']; 
      

      $less_amount = $_SESSION['less_amount'];
      $coupon_code = $_SESSION['coupon_code'];
      $coupon_type = $_SESSION['coupon_type'];

      
      // echo "<script>window.location.href='payment_api/pay.php?session_id=$session_id&session__phone=$session__phone&session__username=$session__username';</script>";
      // echo "<script>window.location.href='phonepay.php?session_id=$session_id&session__phone=$session__phone&session__username=$session__username';</script>";
           
      // echo "<script>window.location.href='phonepay.php?session_id=$session_id&session__phone=$session__phone&session__username=$session__username&Add_postid=$Add_postid';</script>";
           

      echo "<script>window.location.href='phonepay.php?session_id=$session_id&session__phone=$session__phone&session__username=$session__username&Add_postid=$Add_postid&Add_driver_name=$Add_driver_name&Add_vehicle_no=$Add_vehicle_no&addcatephoto=$addcatephoto&Add_phone_no=$Add_phone_no&Add_whatsapp_no=$Add_whatsapp_no&Add_address=$Add_address&Add_city=$Add_city&Add_area=$Add_area&Add_status=$Add_status&post_addon=$post_addon&Add_vehicle_name=$Add_vehicle_name&Add_main_cate=$Add_main_cate&Add_sub_category=$Add_sub_category&Add_meta_keyword=$Add_meta_keyword&create_on=$create_on&Add_load_detail=$Add_load_detail&Add_location=$Add_location&Add_Registration_date=$Add_Registration_date&Add_RC_owner_name=$Add_RC_owner_name&Add_insurance_exp_date=$Add_insurance_exp_date&FC_date=$FC_date&Add_remarks=$Add_remarks&Add_package=$Add_package&Add_amount=$Add_amount&Add_days=$Add_days&futureDate=$futureDate&day_duty=$day_duty&night_duty=$night_duty&vehicle_type_id=$vehicle_type_id&seating_capacity=$seating_capacity&facilities=$facilities&space=$space&size=$size&tonnage=$tonnage&shop_name=$shop_name&work_nature=$work_nature&shop_address=$shop_address&stand_name=$stand_name&net_amount=$net_amount&Add_sub_area=$Add_sub_area&reffered_by_phone_no=$reffered_by_phone_no&reffered_by_name=$reffered_by_name&less_amount=$less_amount&coupon_code=$coupon_code&coupon_type=$coupon_type';</script>";
    
      
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




