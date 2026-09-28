<?php include('config/setup.php')?>
<?php include('session.php');?>

<?php

if(isset($_POST['pay_to_checkout']))
{
 
 
$cartadd=date('Y-m-d');

 $custom_address=mysqli_query($config,"select * from customer_addresss_master where Customet_id='$session_id' and Address_id='".$_POST['customRadioInline1']."' ");
$custom_add=mysqli_fetch_object($custom_address);
        
		;
$delivery_prive=mysqli_query($config,"select * from delivery_price_master where delivery_location='".$custom_add->Delivery_Area."' and Delivery_status=1 ");

$delivery_pp=mysqli_fetch_object($delivery_prive);
 
$delivery_order=mysqli_query($config,"select sum(SubTotal) as SubTotal from order_checkout where order_customer_track_id='".$_POST['check_order_track_id']."' and Customer_id='$session_id'");

$delivery_ordep=mysqli_fetch_object($delivery_order);
 
$gt = $delivery_ordep->SubTotal + $delivery_pp->devlivery_price;
$check_add=mysqli_query($config,"update order_master set Customer__address_type='".$_POST['customRadioInline1']."',Grand_total ='$gt', Delivery_charge='".$delivery_pp->devlivery_price."' where order_customer_track_id='".$_POST['check_order_track_id']."' and Customer_id='$session_id' ");
	
	
//$order_sel=mysqli_query($config," select * from order_master where order_customer_track_id='".$_POST['check_order_track_id']."'");
//$rs=mysqli_fetch_object($ref_sel);	
//	if($rs->Referral_code != '')
//	{
//	$ref_sel=mysqli_query($config," select * from referal_master where Referal_Code='".$rs->Referral_code."'");
	//	$rs=mysqli_fetch_object($ref_sel);
	//	$refundon=date('Y-m-d');
//	$refund=mysqli_query($config,"insert into wallet_master(wallet_Customer_id,Wallet_amount,Wallet_status,Wallet_Active_Status,Wallet_Add_on,Unic_wallet,Referal_customer_id) values('".$_GET['ref_product_client']."','".$rs->Referal_Price_Percentage."','Referal Earning','1','$refundon','".$_GET['ref_product_client'].$rs->Referal_Price_Percentage.'Referal Earning'.$_GET['ref_product_code'].$session_id."','$session_id') ");
	//}	
 
 header('location:order_payment.php?ordertrack='.$_POST['check_order_track_id']);
	
	
}



?>