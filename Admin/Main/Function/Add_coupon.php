<?php include('../../config/setup.php');?>
<?php

if(isset($_POST['category_add']))
{
date_default_timezone_set('Asia/Kolkata'); 
$maincate=date('Y-m-d');
$exp_date=$_POST['expiry_date'];

// echo $query="insert into coupon(coupon_name,amount,time_of_use,expiry_date,customer_id,status,create_on)
// values('".$_POST['Add_customer']."','".$_POST['Add_coupen_name']."','".$_POST['Add_amount']."','".$_POST['time_of_use']."','$exp_date','".$_POST['Add_status']."','$maincate')";
// die;
$addmaincate=mysqli_query($config,"insert into coupon(coupon_name,amount,time_of_use,expiry_date,customer_id,status,create_on,coupon_type)
                                 values('".$_POST['Add_coupen_name']."','".$_POST['Add_amount']."','".$_POST['time_of_use']."','$exp_date','".$_POST['Add_customer']."','".$_POST['Add_status']."','$maincate','".$_POST['coupon_type']."')");	
if($addmaincate==false)
{
 	
 	 echo "<script>window.location.href='../coupon_master.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../coupon_master.php?msg=505';</script>";	 

	
}	


}
?>




