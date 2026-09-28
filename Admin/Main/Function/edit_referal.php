<?php include('../../config/setup.php');?>
<?php
 if(isset($_POST['referal_edit']))
 { 
$editon=date('Y-m-d');
$update_referal=mysqli_query($config,"update referal_master set Referal_Code='".$_POST['referaltitle']."',Referal_Price_Percentage='".$_POST['referal_price']."',Referal_valid_upto='".$_POST['referal_valid_upto']."',Referal_Terms_and_condition='".$_POST['Edit_referal_tc']."',Referal_active_status='".$_POST['referal_product_status']."' where Referal_id='".$_POST['offer_ref_id']."'");
 if($update_referal==false)
{
echo "<script>window.location.href='../referal_master.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../referal_master.php?msg=100';</script>";	 

	
}

 }

?>
 