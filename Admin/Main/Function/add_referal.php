<?php include('../../config/setup.php');?>
<?php

if(isset($_POST['referal_product_add']))
{
 
$maincate=date('Y-m-d');
$pro_sel=mysqli_query($config," select * from product_master where Product_id='".$_POST['Add_referal_pro_name']."'");
		$ps=mysqli_fetch_object($pro_sel);
$addprotype=mysqli_query($config,"insert into referal_master(Referal_Main_Category,Referal_sub_category,Referal_Product,Referal_Code,Referal_Price_Percentage,Referal_valid_upto,Referal_Terms_and_condition,Referal_active_status,Referal_code_addon,Referal_bg_color)
                                 values('".$ps->Main_Category."','".$ps->Sub_Categoryid."','".$_POST['Add_referal_pro_name']."','".$_POST['Add_referal_title']."','".$_POST['Add_referal_amount']."','".$_POST['Add_referal_valid_upto']."','".$_POST['Add_referal_tc']."','".$_POST['Add_referal_status']."','$maincate','".$_POST['Add_referal_bground']."')");	
if($addprotype==false)
{
 	
 	 echo "<script>window.location.href='../referal_master.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../referal_master.php?msg=505';</script>";	 

	
}	







}
?>
