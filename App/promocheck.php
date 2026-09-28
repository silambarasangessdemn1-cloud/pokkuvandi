<?php include('config/setup.php')?>
<?php include('session.php');?>

<?php

if(isset($_POST['promo_verify']))
{
$oid=trim($_POST['promo_code']);

$promo_check =mysqli_query($config,"select * from promo_code_master where Promo_code='".$oid."' and  Promo_code_valid_upto >='".date('Y-m-d')."' and Promo_code_Active_Status=1");
$promo_date_check=mysqli_num_rows($promo_check);
if($promo_date_check == 0)
{
	
header('location:checkout.php?ordertrack='.$_POST['orderid']."&Promoexpired=404");	
	
	
}else { 

	$promo__after_check = mysqli_query($config,"select * from promo_code_master where Promo_code='".$oid."'");
$promo_aft_check=mysqli_fetch_object($promo__after_check);
	
	$product_promo = $promo_aft_check->Product_id;
	
	$promo__product_check = mysqli_query($config,"select * from order_master where Order_product='".$product_promo."' and order_customer_track_id='".$_POST['orderid']."' and Customer_id='$session_id'");
      $product_offer_check=mysqli_fetch_object($promo__product_check);
		
	$info	= mysqli_num_rows($promo__product_check);	
	
	
	if($info != 0)
	{
	$productprice=$product_offer_check->Order_Price;
		 $offer_percent = $promo_aft_check->Offer_Percent;
		 $offer_promocode = $promo_aft_check->Promo_code;
		 
		$discounted_price = ($productprice *  $offer_percent / 100);
		
         $check_promo=mysqli_query($config,"update order_master set  Discount_Offer_prce='$discounted_price',Promo_code='$offer_promocode',Promo_code_status='Applied_for_Product',Promo_code_offer_Percent='$offer_percent',Promocode_status='ProApplied' where  Customer_id='$session_id' and Order_product='".$product_promo."' and order_customer_track_id='".$_POST['orderid']."' and Order_status='Cart'");

header('location:checkout.php?ordertrack='.$_POST['orderid']."&Promoapplied=505");
}else if($info == 0 && $promo_aft_check == 0){
		
		
	   $promo__common_check = mysqli_query($config,"select * from order_checkout where order_customer_track_id='".$_POST['orderid']."' and Customer_id='$session_id'");
      $common_offer_check=mysqli_fetch_object($promo__common_check);
		
		 $commonprice=$common_offer_check->Grand_total;
		 $common_offer_percent = $promo_aft_check->Offer_Percent;
		 $common_offer_promocode = $promo_aft_check->Promo_code;
		 
		$common_discounted_price = ($commonprice *  $common_offer_percent / 100);
		
         $Common_check_promo=mysqli_query($config,"update order_master set Discount_Offer_prce='$common_discounted_price',Promo_code='$common_offer_promocode',Promo_code_status='Common_Promocode_Applied',Promo_code_offer_Percent='$common_offer_percent',Promocode_status='Applied' where  Customer_id='$session_id' and order_customer_track_id='".$_POST['orderid']."' and Order_status='Cart'");

 header('location:checkout.php?ordertrack='.$_POST['orderid']."&Promoapplied=505");	

		
	}else{
    
header('location:checkout.php?ordertrack='.$_POST['orderid']."&Promoexpired=404");
  
    
}

	
}

}	









 
	
	
 


?>