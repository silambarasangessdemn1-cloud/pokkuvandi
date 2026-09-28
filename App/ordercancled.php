<?php include('config/setup.php')?>
<?php include('session.php');?>

<?php

 
$cartadd=date('Y-m-d');
$check_add=mysqli_query($config,"update order_master set Order_status='Canceled_by_Customer',Delivery_status='Canceled' where order_customer_track_id='".$_GET['cancleorderid']."' and Customer_id='$session_id' ");
	
	$prqu=mysqli_query($config,"select Order_product,Ordered_quantity  from order_master where order_customer_track_id='".$_GET['cancleorderid']."' and Customer_id='$session_id' ");	

$adcart=mysqli_query($config,"select * from order_checkout where order_customer_track_id='".$_GET['cancleorderid']."' and Customer_id='$session_id' ");
	while($ac=mysqli_fetch_object($adcart))
	
	{
		if($ac->wallet_status =='Applied')
		{
		$upwal=mysqli_query($config,"update customer_master set Customer_Wallet=Customer_Wallet  + '".$ac->Wallet_Amount."' where Customer_Id='$session_id'");
 
 
		}
 








while($qual= mysqli_fetch_array($prqu))
{
	
	$upqu=mysqli_query($config,"update product_master set Product_Avalible_Stocks = Product_Avalible_Stocks +'".$qual[1]."' where Product_id='".$qual[0]."'  ");
	 
	
}	
 
 header('location:status_onprocess.php?ordertrack='.$_GET['cancleorderid']);
	
	
 
}


?>