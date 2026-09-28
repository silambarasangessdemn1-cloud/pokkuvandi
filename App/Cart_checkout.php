<?php include('config/setup.php')?>
<?php include('session.php');?>

<?php

if(isset($_POST['add_to_cart']))
{
$oid=count($_POST['order_id']);
 
 $ranum=rand(10,10000); 

 date_default_timezone_set('Asia/Kolkata');
	
 $dat=date('d');	
 $tim=date('h');
$track_id= $session_id.$dat.$tim.$ranum;
 for($aa=0;$aa<$oid;$aa++) {
 
	
$cartadd=date('Y-m-d');

	$tax_amount = (($_POST['total'][$aa] * $_POST['order_pro_tax'][$aa] )/100);
		$total_tx= $tax_amount * $_POST['qty'][$aa];
 $nn="update order_master set Ordered_quantity='".$_POST['qty'][$aa]."',Order_Price='".$_POST['total'][$aa] * $_POST['qty'][$aa]."',order_customer_track_id='$track_id',Order_status='Cart',Order_delivery_date='$cartadd',Product_tax='".$_POST['order_pro_tax'][$aa]."',Product_tax_amount='$tax_amount',Product_total_tax_amount='$total_tx' where Order_id='".$_POST['order_id'][$aa]."' and Customer_id='$session_id' ";
$check_add=mysqli_query($config,$nn);
	
	
 }  
  header('location:order_address.php?ordertrack='.$track_id);
	
	
}



?>