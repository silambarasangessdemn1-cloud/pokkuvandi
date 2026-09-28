<?php include('../../config/setup.php');?>
<?php
 if(isset($_POST['coupon_edit']))
 { 
$editon=date('Y-m-d');
// echo $query="update coupon set coupon_name='".$_POST['Add_coupen_name']."',amount='".$_POST['Add_amount']."',time_of_use='".$_POST['time_of_use']."',expiry_date='".$_POST['expiry_date']."',customer_id='".$_POST['Add_customer']."',status='".$_POST['status']."',create_on='$editon' where coupon_id='".$_POST['coupon_id']."'";
// die;
$update_main_cate=mysqli_query($config,"update coupon set coupon_name='".$_POST['Add_coupen_name']."',amount='".$_POST['Add_amount']."',time_of_use='".$_POST['time_of_use']."',expiry_date='".$_POST['expiry_date']."',status='".$_POST['status']."',create_on='$editon' where coupon_id='".$_POST['coupon_id']."'");
 if($update_main_cate==false)
{
echo mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../coupon_master.php?msg=100';</script>";	 

	
}

 }

?>