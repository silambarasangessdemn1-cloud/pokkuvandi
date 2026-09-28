  <?php include('config/setup.php');?>
 <?php include('session.php');?>
 
 <?php
 if($_GET['delid']==4004)
 {
	 
	   
	   
	$adcart=mysqli_query($config,"select * from order_checkout where order_customer_track_id='".$_GET['cid']."' and Customer_id='$session_id' ");
$ac=mysqli_fetch_object($adcart);
	
	{
		if($ac->wallet_status =='Applied' && $ac->Wallet_Amount != 0 )
		{
		    
		    
		    	if( $ac->Wallet_Amount < 0 )
			{
			 $a=$ac->Wallet_Amount;
			 
			 	$upwal=mysqli_query($config,"update customer_master set Customer_Wallet= Customer_Wallet - '$a' where Customer_Id='$session_id'");
       
 $updel=mysqli_query($config,"update order_master set Wallet_Amount = 0 where Customer_Id='$session_id' and order_customer_track_id='".$_GET['cid']."' ");
      
    
			 
			 
			}else{
				
		$a=$ac->Wallet_Amount;
			 
			 	$upwal=mysqli_query($config,"update customer_master set Customer_Wallet=Customer_Wallet +'$a' where Customer_Id='$session_id'");
       
  $updel=mysqli_query($config,"update order_master set Wallet_Amount = 0 where Customer_Id='$session_id' and order_customer_track_id='".$_GET['cid']."' ");
      
    	
			
			
			
			} 
		    
		    
	  
      
      
      
		}
 
	}
	
	
	
	
	   
	   $delivery_add=mysqli_query($config," delete from order_master where  Customer_id='$session_id' and Order_id='".$_GET['delpro']."' ");
	   
  header('location:cart.php');  
 }
 
 
 
 
 
 ?>
 