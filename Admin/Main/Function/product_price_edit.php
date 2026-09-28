<?php include('../../config/setup.php');?>
<?php
 if(isset($_POST['product_price_edit']))
 { 
 $offer_per = (100 * ($_POST['Edit_pro_price'] - $_POST['Edit_shell_pro_price']) / $_POST['Edit_pro_price'] );

$editon=date('Y-m-d');
$update_pro_price=mysqli_query($config,"update product_price_master set Product_id='".$_POST['Edit_pro_name']."',Product_type='".$_POST['Edit_pro_type']."',Product_Type_number='".$_POST['Edit_product_number']."', Product_price='".$_POST['Edit_pro_price']."',Product_status='".$_POST['productprice_status']."',Shelling_price='".$_POST['Edit_shell_pro_price']."',Offer_Percent='$offer_per' where Product_price_id='".$_POST['productprice_id']."'");


 $pt = $_POST['Edit_product_number'].$_POST['Edit_pro_type'];
 
$pro_sel = mysqli_query($config," select * from offer_master where offer_Product_id='".$_POST['Edit_pro_id']."' and offer_quality='$pt'");
		$ps=mysqli_fetch_object($pro_sel);
		
$discounted_price = $_POST['Edit_shell_pro_price'] - ($_POST['Edit_shell_pro_price'] * $ps->Offer_percent / 100);		
		
		


$update_pro_offer = mysqli_query($config,"update offer_master set Product_price='".$_POST['Edit_shell_pro_price']."',offer_price='$discounted_price' where Offer_id='".$ps->Offer_id."'");


if($update_pro_price==false)
{
echo "<script>window.location.href='../Product_price_Master.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../Product_price_Master.php?msg=100';</script>";	 

	
}



 }

?>
 