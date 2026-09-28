<?php include('config/setup.php')?>
<?php include('session.php');?>

<?php

if(isset($_POST['wallet_verify']))
{
 
  $oid=$_POST['totalamount'] ;
  $tt=$_POST['promopri'];
 $oid= $oid-$tt;

		 
		 echo  $discounted_price = $oid - $session__wallet;
 
	if($discounted_price != 0 )
	{
		
		if($discounted_price < 0 ) 
		{
	  





	$check_promo=mysqli_query($config,"update order_master set  Wallet_Amount='$oid',wallet_status='Applied' where  Customer_id='$session_id' and order_customer_track_id='".$_POST['orderid']."' and Order_status='Cart'");
	 
	  $custom_wallet = $session__wallet -  $oid;
	
	if($custom_wallet < 0)
	 {
 
 $wallet_update = mysqli_query($config,"update customer_master set Customer_Wallet='0' where Customer_Id='$session_id'  ");
	
	}else if($custom_wallet > 0 ){
		
		 
	
	$wallet_update = mysqli_query($config,"update customer_master set Customer_Wallet='$custom_wallet' where Customer_Id='$session_id'  ");
	 
		 
	 }
header('location:checkout.php?ordertrack='.$_POST['orderid']."&wallapplied=505");
	
	 
	 
	 
	 
	 
		}else{
      $dis_wallet =$discounted_price -  $oid;
    
    if( $dis_wallet < 0)
    {
        $a = -$dis_wallet;
      $rr="update order_master set   Wallet_Amount='$a',wallet_status='Applied' where  Customer_id='$session_id' and order_customer_track_id='".$_POST['orderid']."' and Order_status='Cart'";   

	 $check_promo=mysqli_query($config,$rr);
		
    }else{
        
        	$check_promo=mysqli_query($config,"update order_master set   Wallet_Amount='$dis_wallet',wallet_status='Applied' where  Customer_id='$session_id' and order_customer_track_id='".$_POST['orderid']."' and Order_status='Cart'");

    }	
		
		
		
		
		
		 $custom_wallet = $session__wallet -  $oid;
	
	if($custom_wallet < 0)
	 {
 
 $wallet_update = mysqli_query($config,"update customer_master set Customer_Wallet='0' where Customer_Id='$session_id'  ");
	
	}else if($custom_wallet > 0 ){
		
		 
	
	$wallet_update = mysqli_query($config,"update customer_master set Customer_Wallet='$custom_wallet' where Customer_Id='$session_id'  ");
	 
		 
	 }
	header('location:checkout.php?ordertrack='.$_POST['orderid']."&wallapplied=505");
	
	 
	 

		
		
		
		
		
		}

    

	
	} else if($discounted_price == 0 ){
		$dis = $oid - $discounted_price;
		$check_promo=mysqli_query($config,"update order_master set  Order_Price='$discounted_price',Discount_Offer_prce='$oid',wallet_status='Applied' where  Customer_id='$session_id' and order_customer_track_id='".$_POST['orderid']."' and Order_status='Cart'");
	 
	 
	$custom_wallet = $discounted_price  - $session__wallet;

if($custom_wallet < 0)
{

	$wallet_update = mysqli_query($config,"update customer_master set Customer_Wallet='0' where Customer_Id='$session_id'  ");
}
		

	header('location:checkout.php?ordertrack='.$_POST['orderid']."&wallapplied=505");
		
	}
  
	 } 
	 
	 
	 
	 
        
 


	









 
	
	
 


?>