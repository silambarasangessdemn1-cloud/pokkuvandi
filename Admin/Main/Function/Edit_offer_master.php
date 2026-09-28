<?php include('../../config/setup.php');?>
<?php
 if(isset($_POST['offer_edit']))
 { 
$editon=date('Y-m-d');
$discounted_price = $_POST['ofproduct_price'] - ($_POST['ofproduct_price'] * $_POST['offer_product_percent'] / 100);		

$update_offer=mysqli_query($config,"update offer_master set Offer_Title='".$_POST['offertitle']."',offer_price='$discounted_price',Offer_upto='".$_POST['offer_valid_upto']."',Offer_percent='".$_POST['offer_product_percent']."',Offer_Status='".$_POST['offer_product_status']."',offer_add_on='$editon',Product_price='".$_POST['ofproduct_price']."' where Offer_id='".$_POST['offer_pro_id']."'");
 if($update_offer==false)
{
echo "<script>window.location.href='../offer_Master.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../offer_Master.php?msg=100';</script>";	 

	
}

 }

?>
 