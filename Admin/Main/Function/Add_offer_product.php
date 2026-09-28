<?php include('../../config/setup.php');?>
<?php

if(isset($_POST['offer_product_add']))
{
 
$maincate=date('Y-m-d');
$pro_sel=mysqli_query($config," select * from product_master where Product_id='".$_POST['Add_offer_pro_name']."'");
		$ps=mysqli_fetch_object($pro_sel);
		
$discounted_price = $_POST['Add_product_price'] - ($_POST['Add_product_price'] * $_POST['Add_offer_percent'] / 100);		
		
		
		
$addprotype=mysqli_query($config,"insert into offer_master(Offer_main_category,Offer_Sub_category,offer_Product_id,Offer_Title,Offer_percent,offer_price,Offer_upto,Offer_Status,offer_quality,offer_add_on,Product_price)
                                 values('".$ps->Main_Category."','".$ps->Sub_Categoryid."','".$_POST['Add_offer_pro_name']."','".$_POST['Add_offer_title']."','".$_POST['Add_offer_percent']."','$discounted_price','".$_POST['Add_offer_valid_upto']."','".$_POST['Add_offer_status']."','".$_POST['product_quantity']."','$maincate','".$_POST['Add_product_price']."')");	
if($addprotype==false)
{
 	
 	 echo "<script>window.location.href='../offer_Master.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../offer_Master.php?msg=505';</script>";	 

	
}	







}
?>
