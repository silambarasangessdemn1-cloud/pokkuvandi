<?php include('config/setup.php')?>
<?php include('session.php');?>

<?php

  
 
$finaladd = date('Y-m-d');
$check_add=mysqli_query($config,"update order_master set Payment_Mode='COD',Order_on='$finaladd',Order_status='Completed',Delivery_status='On_Progress',Grand_total='".$_GET['gtotal']."' where order_customer_track_id='".$_GET['trackorder']."' and Customer_id='$session_id' ");
	
$prqu=mysqli_query($config,"select Order_product,Ordered_quantity  from order_master where order_customer_track_id='".$_GET['trackorder']."' and Customer_id='$session_id' ");	

while($qual= mysqli_fetch_array($prqu))
{
	
	$upqu=mysqli_query($config,"update product_master set Product_Avalible_Stocks = Product_Avalible_Stocks -'".$qual[1]."' where Product_id='".$qual[0]."'  ");
	
	$admin_mail=mysqli_query($config,"select Email_id,Name from lee_master ");	
$adminma = mysqli_fetch_array($admin_mail);
	
	        $to = $session__mail;
                $subject = "Online Shopping Order Update";
                $txt = "
				This e-mail is confidential. It may also be legally privileged. If you are not the addressee, you may not copy, forward, disclose or use any part of it. Internet communications cannot be guaranteed to be timely, secure, error or virus-free.The sender does not accept liability for any errors or omissions. We maintain strict security standards and procedures to prevent unauthorised access to information. " 
				
				
				
				.$adminma[1]. "Your Order Update Order id" .$_GET['trackorder']. " View Your Order Status https://". $_SERVER['SERVER_NAME']."/App/invoice/invoice.php?orderid=".$_GET['trackorder'];
                $headers = "From:".$adminma[0] . "\r\n" .
                "CC:".$adminma[0];
                mail($to,$subject,$txt,$headers);
	
	
	
	
	
	
	
	
	
	header('location:successful.php?ordertrack='.$_GET['trackorder']);
	
}	
	
	
	

	
	
 



?>