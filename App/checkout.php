<?php include('config/setup.php')?>
<?php include('session.php');?>	

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
          <link rel="icon" type="image/png" href="<?php 
            
            $inro_logo=mysqli_query($config,"select Logo_Path,logo_status from lee_master");
            while($logo=mysqli_fetch_array($inro_logo))
            {
                 $logstatus=$logo[1];
if($logstatus == 1)
{
	
	 $ms=substr($logo[0],3);
				  echo  $ms;
	
     
}else{
    echo "../../photos/logo/no_logo.png";

}

            }
            
            ?>">
      <title><?php 
            
            $leename=mysqli_query($config,"select Name,Name_status from lee_master");
            while($lee=mysqli_fetch_array($leename))
            {
                 $namestatus=$lee[1];
if($namestatus == 1)
{
    echo  $lee[0];
}else{
    echo "Need Name";

}

            }
            
            ?></title>
      <!-- Slick Slider -->
      <link rel="stylesheet" type="text/css" href="vendor/slick/slick.min.css"/>
      <link rel="stylesheet" type="text/css" href="vendor/slick/slick-theme.min.css"/>
      <!-- Icofont Icon-->
      <link href="vendor/icons/icofont.min.css" rel="stylesheet" type="text/css">
      <!-- Bootstrap core CSS -->
      <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <!-- Custom styles for this template -->
      <link href="css/style.css" rel="stylesheet">
      <!-- Sidebar CSS -->
      <link href="vendor/sidebar/demo.css" rel="stylesheet">
   </head>
   <body class="fixed-bottom-padding">
      
      <div class="osahan-checkout">
         <div class="p-3 border-bottom">
            <div class="d-flex align-items-center">
               <a class="font-weight-bold text-success text-decoration-none" href="order_payment.php?ordertrack=<?php echo $_GET['ordertrack'];?>">
               <i class="icofont-rounded-left back-page"></i></a>
               <h6 class="font-weight-bold m-0 ml-3">Checkout</h6>
               <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>
            </div>
         </div>
      </div>
	  
	  
	 
	  
      <div class="address p-3 bg-white">
         <h6 class="m-0 text-dark d-flex align-items-center">Address <span class="small ml-auto"><a href="order_address.php?ordertrack=<?php echo $_GET['ordertrack']?>" class="font-weight-bold text-decoration-none text-success"><i class="icofont-location-arrow"></i> Change</a></span></h6>
      </div>
	  
	  
	     <?php
	  $gg="select * from order_checkout where  order_customer_track_id='".$_GET['ordertrack']."' and Customer_id='$session_id' group by order_customer_track_id ";
		   $FinalCheckout = mysqli_query($config,$gg);
           while($Final=mysqli_fetch_object($FinalCheckout))
            {
		  
		 
		  
		  ?> 
	  
	  
      <div class="p-3">
	  	<?php
$check_oaaderr=mysqli_query($config,"select * from customer_addresss_master where Address_id='". $Final->Customer__address_type."' and  Customet_id ='$session_id' ");
            $check_final=mysqli_fetch_object($check_oaaderr);
   		?>
	     <div class="d-flex align-items-center">
            <p class="mb-2 font-weight-bold"><?php echo  $check_final->Address_type; ?></p>
          
		  <?php
						  $add_check=$check_final->Address_default;
						   if($add_check == 1){?>
		  <p class="mb-2 badge badge-success ml-auto">Default</p>
                          
	<?php	  }?>
	 
		  
		  
		  
		  
         </div>
         <p class="small text-muted m-0"><b>Area    :</b> &nbsp;&nbsp;&nbsp; 
		 
		 
		 	
						<?php   
			
 
			
			$edit_del_name_=mysqli_query($config,"select * from city_master where CIty_Status=1 and City_id='".$check_final->Delivery_Area."'");
											while($edit_del=mysqli_fetch_object($edit_del_name_))
											{
			
			
		 echo $edit_del->City_Name;
			
			
			
			
											}
			
			
			?>	
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 </p>
         <p class="small text-muted m-0"><b>Address :</b>&nbsp;&nbsp;<?php echo  $check_final->Complete_Address; ?></p>
         <p class="small text-muted m-0"><b>Landmark:</b>&nbsp;&nbsp;<?php echo  $check_final->Delivery_Landmark; ?></p>
      </div>
	  
	  
	  
	  <?php 
	  
	  $pm=$Final->Payment_Mode;
			
			if($pm =="ONLINE_PAYMENT")
			{
	  
	  ?>
	  
	  
      <div class="address p-3 bg-white">
	    
         <h6 class="m-0 text-dark">My Wallet  :   <b> Rs.
	<?php echo  $used = $session__wallet ; 
	
	if($used > 0)
	{
	?> </br> </br> <form method="post" action="walletcheck.php">
	<input type="checkbox" name="wallet_amount" value="<?php echo $used; ?>" id="myCheck" onclick="myFunction()"> <b> &nbsp;Use My Wallet</b>
    <input type="hidden" class="form-control" name="orderid"  value="<?php echo $Final->order_customer_track_id; ?>">
  <input type="hidden" class="form-control" name="totalamount"  value=" <?php echo $Final->Grand_total;?>">
  <input type="hidden" class="form-control" name="promopri"  value="<?php echo $Final->Discount_Offer_prce;?>">
 
	  </br> </br>          <input type="submit"  class="btn btn-warning btn-block" value="Check Wallet" name="wallet_verify"/>
</form>
	<?php }else{ echo "0.00"; }?>
	 </b> 
	  </h6>     
</br>
 
 
	   
      </div>
	  </br>
	  
	  <?php } ?>
	  
	  
	  
	  
	  <div class="address p-3 bg-white">
         <h6 class="m-0 text-dark">Payment Option</h6>
      </div>
	  
      <div class="p-3">
         <a href="order_payment.php?ordertrack=<?php echo $_GET['ordertrack']?>" class="text-success text-decoration-none w-100">
            <div class="d-flex align-items-center">
             <?php
			$pm=$Final->Payment_Mode;
			
			if($pm =="ONLINE_PAYMENT")
			{
			
			 ?>
			 <i class="icofont-credit-card"></i> <span class="ml-3">Online Payment</span>  
           
			<?php }else if($pm =="COD"){ ?>
			
					 <i class="icofont-credit-card"></i> <span class="ml-3">Cash on Delivery</span>  
	
			
			<?php }else{ ?>
			
			 <i class="icofont-credit-card"></i> <span class="ml-3">Online Payment</span>  
								 <i class="icofont-credit-card"></i> <span class="ml-3">Cash on Delivery</span>  

			
			<?php } ?>

		   </div>
         </a>
      </div>
	   <div class="address p-3 bg-white">
         <h6 class="text-dark m-0">Promo Code  <?php
		 
	 
		 if($_GET['Promoexpired'] == 404)
		 {?>
			 <span style="color:red;">( Promocode Mis-Matched )</span>
			 
	<?php	 }else  if($_GET['Promoapplied'] == 505)
	{  ?>
	 <span style="color:green;">( Promocode Applied  Success )</span>
	<?php }
		 
		 ?>            </h6>
      </div>
      <div>
	  
	  <?php if($Final->Promocode_status =='Applied' || $Final->Promocode_status =='ProApplied' )
	  {?>
	  
	  
	
	  
	  <?php } else{?>
	    <?php	 if($_GET['Promoapplied'] == 505)
	{  ?>
         	<?php }else{?> <div class="accordion" id="accordionExample">
            <div class="d-flex align-items-center" id="headingThree">
               <a class="p-3 d-flex align-items-center text-decoration-none text-success w-100" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
               <i class="icofont-badge mr-3"></i> Add Promo Code
               <i class="icofont-rounded-down ml-auto"></i>
               </a>
            </div>
            <div id="collapseThree" class="collapse p-3 border-top" aria-labelledby="headingThree" data-parent="#accordionExample">
               <form method="post" action="promocheck.php">
                  <div class="col-12 m-0 pr-1">
                     <input type="text" class="form-control" name="promo_code"  placeholder="Enter Promo Code"  required>
                     <input type="hidden" class="form-control" name="orderid"  value="<?php echo $Final->order_customer_track_id; ?>">
                
				</div></br>
                  <div class="col-8 ">
				
				 
      
                 <input type="submit"  class="btn btn-success " value="Check Promocode" name="promo_verify"/>

<a href="promos.php?ordertrack=<?php echo $_GET['ordertrack'];?>" class="btn btn-warning">Get Promocode</a>
                  </div>
               </form>
            </div>
         </div>
		 	<?php }} ?>
			
			
			
			
			
			
			
      </div>
	  
     
       
         <div class="address p-3 bg-white">
         <h6 class="text-dark m-0">Total</h6>
      </div>
      <div class="p-3">
         <div class="clearfix">
            <p class="mb-1 text-muted">Total Item<span class="float-right text-dark"><?php echo $Final->Total_item; ?></span></p>
            <p class="mb-1 text-muted">Total Quantity<span class="float-right text-dark"><?php echo $Final->Quantity; ?></span></p>
			 <p class="mb-1 text-muted">Tax<span class="float-right text-dark"   > Rs. <?php echo  round($Final->Product_total_tax_amount);?> </p>
          
<?php   
			
			$promocheck =$Final->Promocode_status;
			if(($Final->Promocode_status == 'Applied'  || $Final->Promocode_status == 'ProApplied') &&  $Final->wallet_status == 'Applied'){ ?>
			
			
					
		  <p class="mb-1 text-muted">Sub Total<span class="float-right text-dark"   > Rs. <?php echo  round($Final->SubTotal - $Final->Product_total_tax_amount); ?>
    
	<p class="mb-1 text-muted">  Discount<span class="float-right text-dark"   > Rs.- 
			<?php  echo round($Final->Discount_Offer_prce);?> </p>
			
   
			 
<?php 			}
			else if($promocheck == 'Applied')
			{ ?>

		  <p class="mb-1 text-muted">Sub Total<span class="float-right text-dark"   > Rs. <?php echo round( $Final->SubTotal - $Final->Product_total_tax_amount);?>
    
		   <p class="mb-1 text-muted"> Discount<span class="float-right text-dark"   > Rs.
			<?php  echo round( $Final->Discount_Offer_prce);?></p>
            
		<?php   
			}else if($promocheck == 'ProApplied')
			{ ?>
		
		
		  <p class="mb-1 text-muted">Sub Total<span class="float-right text-dark"   > Rs. <?php echo  round($Final->SubTotal - $Final->Product_total_tax_amount);?>
    
	<p class="mb-1 text-muted">  Discount<span class="float-right text-dark"   > Rs.- 
			<?php  echo round($Final->Discount_Offer_prce);?> </p>
	
	<?php   
			}else if($Final->wallet_status == 'Applied')
			{ ?>
		
		
		  <p class="mb-1 text-muted">Sub Total<span class="float-right text-dark"   > Rs. <?php echo round($Final->SubTotal -  $Final->Product_total_tax_amount);?></p>
		
          
            <p class="mb-1 text-muted"> <span class="float-right text-dark"   > <?php   
			
			
				
			round($Final->SubTotal);	
	
			} else{ ?>
		
			  <p class="mb-1 text-muted">Sub Total<span class="float-right text-dark"   > Rs. <?php echo  round($Final->SubTotal - $Final->Product_total_tax_amount);?>
           <?php } ?>  
			 <p class="mb-1 text-muted">Delivery Fee<span class="text-info ml-1"><i class="icofont-info-circle"></i></span><span class="float-right text-dark"  >
			 <?php echo "Rs." .round($Final->Delivery_charge);	 ?>	 </span></p>
           
		  <?php  
		  
		  $payment_fianl=$Final->Payment_Mode;
if($payment_fianl !='COD')
{
		  
		   if($Final->wallet_status == 'Applied')
			{ ?>
			
			<?php   	if(($Final->Promocode_status == 'Applied'  || $Final->Promocode_status == 'ProApplied') &&  $Final->wallet_status == 'Applied'){            ?>
			
			
		
	<p class="mb-1 text-muted"> Total<span class="float-right text-dark"   > Rs. <?php  echo round($Final->Grand_total - $Final->Discount_Offer_prce);?>
		   
		   
		   
		   
		   
		     <p class="mb-1 text-muted">  Wallet Amount<span class="float-right text-dark"   >  
		<?php 	if( $Final->Wallet_Amount < 0 )
			{
			 echo "Rs.".round( $Final->Wallet_Amount);
			}else{
				
			echo "Rs.-".round( $Final->Wallet_Amount);	
			} ?> </p>
		
	
	
	
	
	<?php }else{?>		
	
	
	
	
	<p class="mb-1 text-muted"> Total<span class="float-right text-dark"   > Rs. <?php  echo round($Final->Grand_total);?>
		   
		   
		   
		   
		   
		     <p class="mb-1 text-muted">  Wallet Amount<span class="float-right text-dark"   >  
		<?php 	if( $Final->Wallet_Amount < 0 )
			{
			 echo "Rs.".round( $Final->Wallet_Amount);
			}else{
				
			echo "Rs.-".round( $Final->Wallet_Amount);	
			} ?> </p>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		<?php }}}?>
		
		   <!-- <p class="mb-1 text-success">Total Discount<span class="float-right text-success">$1884</span></p>-->
            <hr>
            <h6 class="font-weight-bold mb-0">TO PAY  <span class="float-right" > Rs.<?php  
			
		$promocheck =$Final->Promocode_status;
		
		if(($Final->Promocode_status == 'Applied'  || $Final->Promocode_status == 'ProApplied') &&  $Final->wallet_status == 'Applied'){
			    
				 $ptotal=  $Final->Grand_total - $Final->Delivery_charge - $Final->Discount_Offer_prce;
			    
			  			$payment_fianl=$Final->Payment_Mode;
if($payment_fianl !='COD')
{
			if( $Final->Wallet_Amount <= 0 )
			{
			 echo round($fg=$Final->Grand_total + $Final->Wallet_Amount,2);
			}else{
				
			echo round($fg=$Final->Grand_total - $Final->Wallet_Amount - $Final->Discount_Offer_prce);	
			}
	  } }	
		else 	if($Final->Promocode_status == 'Applied')
			{ 	
			
				$fg= $ptotal=  $Final->Grand_total- $Final->Delivery_charge - $Final->Discount_Offer_prce;
			
			if( $ptotal <= 0)
			{ ?>
			
			<span style="color:red;"><strike>	<?php	echo  round($Final->Grand_total - $Final->Discount_Offer_prce); ?> </strike></span>
	
			
		
		
		<?php	}else{
			    
			    	echo  round($fg=$Final->Grand_total - $Final->Discount_Offer_prce);
			    
			    
			}	
			}else if($Final->Promocode_status == 'ProApplied')
			{ 	
			
				$fg= $ptotal=  $Final->Grand_total- $Final->Delivery_charge - $Final->Discount_Offer_prce;
			
			if( $ptotal <= 0)
			{ ?>
			
			<span style="color:red;"><strike>	<?php	echo  round($Final->Grand_total - $Final->Discount_Offer_prce); ?> </strike></span>
	
			
		
		
		<?php	}else{
			    
			    	echo  round($fg=$Final->Grand_total- $Final->Discount_Offer_prce);
			    
			    
			}
			
			
			
			
			
			
			}	else if($Final->wallet_status == 'Applied')
			{
			$payment_fianl=$Final->Payment_Mode;
if($payment_fianl !='COD')
{
			if( $Final->Wallet_Amount <= 0 )
			{
			 echo round($fg=$Final->Grand_total + $Final->Wallet_Amount);
			}else{
				
			echo round($fg=$Final->Grand_total - $Final->Wallet_Amount);	
			}
			
}else{
    
    	echo round($fg=$Final->Grand_total);
    
}	
			
			}else{
				
			echo round($fg=$Final->Grand_total);
			
			}
			
			
			
			
			?></span></h6>
         </div>
		 <br>
		 <?php 
$main_cate=mysqli_query($config,"select * from minu_order where minu_order_status='1'");
$macate=mysqli_fetch_object($main_cate);
$adv_amount=($fg/100)*$macate->minu_order_pre;
		 ?>
		 <?php if($macate->minu_order_price >= $fg){ ?>

			
		 <div class="alert alert-danger" role="alert">
		 Minimum Order Value <b>Rs.<?php echo round($macate->minu_order_price); ?></b>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
	$(document).ready(function(){	
		$('#rzp-button1').removeAttr('href');
				$('#rzp-button1').Attr('disabled','disabled');
			});
			</script>
<?php }else{
	if($payment_fianl != 'ONLINE_PAYMENT')
	{?>
	<div class="alert alert-success" role="alert">
	Advanced Payments &nbsp;<b><?php echo $macate->minu_order_pre; ?>%</b>
</div>
<?php } }?>
      </div>
	  
	   <div class="p-3">
<p class="m-0 small text-muted">You can check your order detail here</p>
         
		
<?php 
	$adcart=mysqli_query($config,"select * from order_master where Customer_id='$session_id' and order_customer_track_id='".$_GET['ordertrack']."' ");
	while($ac=mysqli_fetch_object($adcart))
	
	{
		 
	$cartpro=mysqli_query($config,"select * from product_master where Product_id='". $ac->Order_product."' ");
            $cp=mysqli_fetch_object($cartpro);
       	
		
		?>
</br>
<div class="d-flex align-items-center mb-2">
               <h6 class="font-weight-bold mb-1"><?php echo $cp->Product_Name;?> - <?php echo $ac->Order_type_quantity;?> * <?php echo $ac->Ordered_quantity;?></h6>
               <h6 class="font-weight-bold ml-auto mb-1" style="margin-right: 26px;">Rs. <?php echo round( $ac->Order_product_price * $ac->Ordered_quantity)?></h6>
            </div>

	<?php } ?>


 
 <p class="m-0 small text-muted">Thank you for order.</p>

</div>



	  
	  
	  
	  
      <!-- continue -->
    
<input type="hidden" name="final_order" value="" >

<?php $promocheck =$Final->Promocode_status;
			
			if(($promocheck == 'Applied'  || $promocheck == 'ProApplied'))
			{ 	
			
			  $gtotal=  $Final->Grand_total -$Final->Delivery_charge - $Final->Discount_Offer_prce;
			
		
		
		
		
			}else{
					if( $Final->Wallet_Amount < 0 )
			{
			 $gtotal=  $Final->Grand_total - $Final->Wallet_Amount;
			}else{
				
		   $gtotal=  $Final->Grand_total - $Final->Wallet_Amount;
			}
			
		
		
		
		
		
			}
			


if($gtotal > 0)


{



$payment_fianl=$Final->Payment_Mode;
if($payment_fianl =='COD')
{
?>


	<div class="fixed-bottom">
	<?php 
$main_cate=mysqli_query($config,"select * from minu_order where minu_order_status='1'");

$paygate=mysqli_query($config,"select * from payment_setting where Payment_status='1' and online='1' ");
$pg=mysqli_fetch_object($paygate);


if($pg->Gateway_name == 'Instamojo'){


if(mysqli_num_rows($main_cate) > 0){


if($macate->minu_order_pre != 0 ){ ?>
<a target='_parent' type='button' href="cashon_pay.php?trackorder=<?php echo $Final->order_customer_track_id; ?>&advance_pay=<?php 
echo round($adv_amount);
  

		 ?>&gtotal=<?php $promocheck =$Final->Promocode_status;
			
		 if(($promocheck == 'Applied'  || $promocheck == 'ProApplied'))
		 { 	
		 
		 echo  round($Final->Grand_total - $Final->Discount_Offer_prce - $Final->Delivery_charge);
		 
		 }else if($Final->wallet_status == 'Applied'){
			 
			 if( $Final->Wallet_Amount < 0 )
		 {
		 echo  round($Final->Grand_total + $Final->Wallet_Amount);
		 }else{
			 
	   echo  round($Final->Grand_total) ;
		 }
			 
		 }	else{
			 
		 echo round($Final->Grand_total);
		 
		 }


	  ?>&sessionid=<?php echo $session_id; ?>&customername=<?php echo $session__username; ?>&customermail=<?php echo $session__mail; ?>&customerphone=<?php echo $session__phone; ?>&customeraddress=<?php echo  $edit_del->City_Name;?><?php echo  $check_final->Complete_Address;?>" class="btn btn-success btn-block <?php if($macate->minu_order_price >= $fg){ echo 'disabled';}?>" id="rzp-button1">Advance Pay Rs. <?php echo round($adv_amount);  ?> </a>
		<?php }else{?>

			<a  type='button' href="cashon_pay_free.php?trackorder=<?php echo $Final->order_customer_track_id; ?>&advance_pay=<?php 
echo round($adv_amount);
  

		 ?>&gtotal=<?php $promocheck =$Final->Promocode_status;
			
		 if(($promocheck == 'Applied'  || $promocheck == 'ProApplied'))
		 { 	
		 
		 echo  round($Final->Grand_total - $Final->Discount_Offer_prce - $Final->Delivery_charge);
		 
		 }else if($Final->wallet_status == 'Applied' ){
			 
			 if( $Final->Wallet_Amount < 0 )
		 {
		 echo  round($Final->Grand_total + $Final->Wallet_Amount);
		 }else{
			 
	     $Final->Grand_total - $Final->Wallet_Amount;
		 }
			 
		 }	else{
			 
		 echo round($Final->Grand_total);
		 
		 }


	  ?>&sessionid=<?php echo $session_id; ?>&customername=<?php echo $session__username; ?>&customermail=<?php echo $session__mail; ?>&customerphone=<?php echo $session__phone; ?>&customeraddress=<?php echo  $edit_del->City_Name;?><?php echo  $check_final->Complete_Address;?>" class="btn btn-success btn-block <?php if($macate->minu_order_price >= $fg){ echo 'disabled';}?>" id="rzp-button1">Cash on Delivery </a>

		<?php }
}
		?>


		 <?php }else{?>




			<?php 
$main_cate=mysqli_query($config,"select * from minu_order where minu_order_status='1'");

$paygate=mysqli_query($config,"select * from payment_setting where Payment_status='1' and online='1' ");
$pg=mysqli_fetch_object($paygate);


if($pg->Gateway_name == 'Razorpay'){


if(mysqli_num_rows($main_cate) > 0){


if($macate->minu_order_pre != 0 ){ ?>
<a  type='button' href="payment_api/cashon_pay.php?trackorder=<?php echo $Final->order_customer_track_id; ?>&advance_pay=<?php 
echo round($adv_amount);
  

		 ?>&gtotal=<?php $promocheck =$Final->Promocode_status;
			
		 if(($promocheck == 'Applied'  || $promocheck == 'ProApplied'))
		 { 	
		 
		 echo  round($Final->Grand_total - $Final->Discount_Offer_prce - $Final->Delivery_charge);
		 
		 }else if($Final->wallet_status == 'Applied'){
			 
			 if( $Final->Wallet_Amount < 0 )
		 {
		 echo  round($Final->Grand_total + $Final->Wallet_Amount);
		 }else{
			 
	   echo  round($Final->Grand_total - $Final->Wallet_Amount);
		 }
			 
		 }	else{
			 
		 echo round($Final->Grand_total);
		 
		 }


	  ?>&sessionid=<?php echo $session_id; ?>&customername=<?php echo $session__username; ?>&customermail=<?php echo $session__mail; ?>&customerphone=<?php echo $session__phone; ?>&customeraddress=<?php echo  $edit_del->City_Name;?><?php echo  $check_final->Complete_Address;?>" class="btn btn-success btn-block <?php if($macate->minu_order_price >= $fg){ echo 'disabled';}?>" id="rzp-button1">Advance_Pay Rs. <?php echo $adv_amount;  ?> </a>
		<?php }else{?>

			<a  type='button' href="cashon_pay_free.php?trackorder=<?php echo $Final->order_customer_track_id; ?>&advance_pay=<?php 
echo round($adv_amount);
  

		 ?>&gtotal=<?php $promocheck =$Final->Promocode_status;
			
		 if(($promocheck == 'Applied'  || $promocheck == 'ProApplied'))
		 { 	
		 
		 echo  round($Final->Grand_total - $Final->Discount_Offer_prce - $Final->Delivery_charge);
		 
		 }else if($Final->wallet_status == 'Applied'){
			 
			 if( $Final->Wallet_Amount < 0 )
		 {
		 echo  round($Final->Grand_total + $Final->Wallet_Amount);
		 }else{
			 
	   echo  round($Final->Grand_total );
		 }
			 
		 }	else{
			 
		 echo round($Final->Grand_total);
		 
		 }


	  ?>&sessionid=<?php echo $session_id; ?>&customername=<?php echo $session__username; ?>&customermail=<?php echo $session__mail; ?>&customerphone=<?php echo $session__phone; ?>&customeraddress=<?php echo  $edit_del->City_Name;?><?php echo  $check_final->Complete_Address;?>" class="btn btn-success btn-block <?php if($macate->minu_order_price >= $fg){ echo 'disabled';}?>" id="rzp-button1">Cash on Delivery </a>

		<?php }
}
}
		?>


		
      

<?php }?>
      </div>
	  

			<?php }else if($payment_fianl =='ONLINE_PAYMENT'){
				 
				
				if($Final->Payment_Option == 'Payment_Option1')
				
				{
				
				?>


	<div class="fixed-bottom">
	
	
	
      <a href="payment_api/pay.php?trackorder=<?php echo $Final->order_customer_track_id; ?>&advance_pay=<?php echo '0'
  

		 ?>&gtotal=<?php $promocheck =$Final->Promocode_status;
			
			if(($promocheck == 'Applied'  || $promocheck == 'ProApplied'))
			{ 	
			
			echo  round($Final->Grand_total - $Final->Discount_Offer_prce - $Final->Delivery_charge  - $Final->Wallet_Amount);
			
			}else if($Final->wallet_status == 'Applied'){
			    
			    if( $Final->Wallet_Amount < 0 )
			{
			echo  round($Final->Grand_total + $Final->Wallet_Amount);
			}else{
				
		  echo  round($Final->Grand_total - $Final->Wallet_Amount);
			}
			    
			}	else{
				
			echo  round($Final->Grand_total);
			
			}
  


		 ?>&sessionid=<?php echo $session_id; ?>&customername=<?php echo $session__username; ?>&customermail=<?php echo $session__mail; ?>&customerphone=<?php echo $session__phone; ?>&customeraddress=<?php echo  $edit_del->City_Name;?><?php echo  $check_final->Complete_Address;?>" class="btn btn-success btn-block" id="rzp-button1">Pay and Complete Order </a>
      </div>
	  
				<?php }else if($Final->Payment_Option == 'Payment_Option2'){?>
	  
			
			
			<div class="fixed-bottom">
	
	
	
         <a target='_parent' href="Instamojo_pay.php?trackorder=<?php echo $Final->order_customer_track_id; ?>&gtotal=<?php $promocheck =$Final->Promocode_status;
			
			if(($promocheck == 'Applied'  || $promocheck == 'ProApplied'))
			{ 	
			
			echo  round(($Final->Grand_total - $Final->Discount_Offer_prce - $Final->Wallet_Amount)) ;
			
			}else if($Final->wallet_status == 'Applied'){
			    
			    if( $Final->Wallet_Amount < 0 )
			{
			echo  round($Final->Grand_total + $Final->Wallet_Amount);
			}else{
				
		  echo  round($Final->Grand_total - $Final->Wallet_Amount);
			}
			    
			}	else{
				
			echo round($Final->Grand_total);
			
			}
  

		 ?>&sessionid=<?php echo $session_id; ?>&customername=<?php echo $session__username; ?>&customermail=<?php echo $session__mail; ?>&customerphone=<?php echo $session__phone; ?>&customeraddress=<?php echo  $edit_del->City_Name;?><?php echo  $check_final->Complete_Address;?>" class="btn btn-success btn-block" id="rzp-button1">Pay and Complete Order</a>
      </div>
			
	<?php }else{ ?>

			<div class="fixed-bottom">
         <a href="Final_pay_order.php?trackorder=<?php echo $Final->order_customer_track_id; ?>&gtotal=<?php $promocheck =$Final->Promocode_status;
			
			if(($promocheck == 'Applied'  || $promocheck == 'ProApplied'))
			{ 	
			
			echo    round($Final->Grand_total - $Final->Discount_Offer_prce - $Final->Delivery_charge);
			
			}else{
				
			echo  round($Final->Grand_total);
			
			}
			
			?>" class="btn btn-success btn-block">Pay On Delivery </a>
      </div>





		<?php }} }else{ ?>


	  
	  
	  
	<div class="fixed-bottom">
         <a href="Final_pay_order_wallet.php?trackorder=<?php echo $Final->order_customer_track_id; ?>&gtotal=<?php $promocheck =$Final->Promocode_status;
			
			if(($promocheck == 'Applied'  || $promocheck == 'ProApplied'))
			{ 	
			
			echo    round($Final->Grand_total);
			
			}else{
				
			echo  round($Final->Grand_total);
			
			}
			
			?>>" class="btn btn-success btn-block">Place Order</a>
      </div>
	  
	  
<?php }} ?>	  
	  
	  
      <?php include('menu.php')?> 

 <script>
 
 function myFunction() {
   
  var checkBox = document.getElementById("myCheck");
 
  var text = document.getElementById("1");

  
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
    text.style.display = "none";
  }
}
 
 
 
 </script>

	  
      <!-- Bootstrap core JavaScript -->
      <script src="vendor/jquery/jquery.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <!-- slick Slider JS-->
      <script type="text/javascript" src="vendor/slick/slick.min.js"></script>
      <!-- Sidebar JS-->
      <script type="text/javascript" src="vendor/sidebar/hc-offcanvas-nav.js"></script>
      <!-- Custom scripts for all pages-->
      <script src="js/osahan.js"></script>
   </body>
</html>

<style>
	.disabled{
		pointer-events: none;
    cursor: default;
	}
</style>