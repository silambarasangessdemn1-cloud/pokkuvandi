<?php include('config/setup.php')?>
<?php include('session.php');?>

<?php

if(isset($_POST['order_pay_checkout']))
{
 
 
$cartadd=date('Y-m-d');
$check_add=mysqli_query($config,"update order_master set Payment_Mode='".$_POST['Payment_type']."',Payment_Option='".$_POST['pay_option']."' where order_customer_track_id='".$_POST['check_order_address_id']."' and Customer_id='$session_id' ");
	




	$adcart=mysqli_query($config,"select * from order_checkout where order_customer_track_id='".$_GET['cid']."' and Customer_id='$session_id' ");
$ac=mysqli_fetch_object($adcart);	
	{
	
	 $payment_fianl=$ac->Payment_Mode;
if($payment_fianl =='COD'){
	
		if($ac->wallet_status =='Applied' && $ac->Wallet_Amount != 0 )
		{
		    
		    
		    	if( $ac->Wallet_Amount < 0 )
			{
			 $a=$ac->Wallet_Amount;
			 
			 	$upwal=mysqli_query($config,"update customer_master set Customer_Wallet= Customer_Wallet - '$a' where Customer_Id='$session_id'");
       
 $updel=mysqli_query($config,"update order_master set Wallet_Amount = 0 where Customer_Id='$session_id' and order_customer_track_id='".$_POST['check_order_address_id']."' ");
      
    
			 
			 
			}else{
				
		$a=$ac->Wallet_Amount;
			 
			 	$upwal=mysqli_query($config,"update customer_master set Customer_Wallet= Customer_Wallet +'$a' where Customer_Id='$session_id'");
       
  $updel=mysqli_query($config,"update order_master set Wallet_Amount = 0 where Customer_Id='$session_id' and order_customer_track_id='".$_POST['check_order_address_id']."' ");
      
    	
			
			
			
			} 
		    
		    
	  
      
      
      
		}
 


}




	}
	 









	
 
 header('location:checkout.php?ordertrack='.$_POST['check_order_address_id']);
	
	
}



?>