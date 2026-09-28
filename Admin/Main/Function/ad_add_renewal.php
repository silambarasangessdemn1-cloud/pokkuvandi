<?php include('../../config/setup.php');?>
<?php
 include('session.php');
 $session_id;
 $session__username;
 $session__mail;
 $session__phone;

if(isset($_POST['post_renewal']))
{


$addcatephoto=$_FILES['Add_vehicle_photo']['name'];
$addphoto="../photos/vehicle/".$addcatephoto;
move_uploaded_file($_FILES["Add_vehicle_photo"]["tmp_name"],$addphoto);


 $current_Date=date('Y-m-d');

   $sql="SELECT * FROM `create_post` where post_id ='".$_POST['id']."' Order by create_on DESC "; 
    
 
   $sdate= mysqli_query($config, $sql);
	 $data = mysqli_fetch_object($sdate);
	 $total_user = mysqli_num_rows($sdate);


    $create_on = $data->create_on; 
    $package_days = $data->package_days;    
   $futureDate = date("Y-m-d", strtotime($create_on . " +$package_days days")); 
   $customer_id= $data->customer_id;
 
      $package_days = $_POST['Add_days'];    
      $futureDate = date("Y-m-d", strtotime($current_Date . " +$package_days days")); 
   

   
// echo $_QUERY="update create_post set create_on='$current_Date',package_id='".$_POST['Add_package']."',package_amount='".$_POST['Add_amount']."',package_days='".$_POST['Add_days']."',expiry_date='$futureDate',renewal_post='1',net_amount='".$_POST['net_amount']."',coupon_type='".$_POST['coupon_type']."',discount_amount='".$_POST['less_amount']."',discount_name='".$_POST['coupon_code']."'	where post_id='". $_POST['id']."' ";
// echo $query="insert into renewal_list(post_id,re_package_id,re_package_amount,re_package_days,re_expiry_date,re_net_amount,re_coupon_type,re_discount_amount,re_discount_name,re_date,re_customer_id)
// values('".$_POST['id']."','".$_POST['Add_package']."','".$_POST['Add_amount']."','".$_POST['Add_days']."','$futureDate','".$_POST['net_amount']."','".$_POST['coupon_type']."','".$_POST['less_amount']."','".$_POST['coupon_code']."','$current_Date','$customer_id'";
// die;
        $addmaincate=mysqli_query($config,"update create_post set create_on='$current_Date',package_id='".$_POST['Add_package']."',package_amount='".$_POST['Add_amount']."',package_days='".$_POST['Add_days']."',expiry_date='$futureDate',renewal_post='1',net_amount='".$_POST['net_amount']."',coupon_type='".$_POST['coupon_type']."',discount_amount='".$_POST['less_amount']."',discount_name='".$_POST['coupon_code']."',payment_type='".$_POST['payment_type']."',ref_no='".$_POST['ref_no']."'	where post_id='". $_POST['id']."' ");	


        $addmaincate=mysqli_query($config,"insert into renewal_list(post_id,re_package_id,re_package_amount,re_package_days,re_expiry_date,re_net_amount,re_coupon_type,re_discount_amount,re_discount_name,re_date,re_customer_id)
        values('".$_POST['id']."','".$_POST['Add_package']."','".$_POST['Add_amount']."','".$_POST['Add_days']."','$futureDate','".$_POST['net_amount']."','".$_POST['coupon_type']."','".$_POST['less_amount']."','".$_POST['coupon_code']."','$current_Date','$customer_id')");	
    
        

        echo "<script>window.location.href='../expired_list.php';</script>";

}
  




?>




