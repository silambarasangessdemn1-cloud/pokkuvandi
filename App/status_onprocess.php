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
      <div class="theme-switch-wrapper">
         <label class="theme-switch" for="checkbox">
            <input type="checkbox" id="checkbox" />
            <div class="slider round"></div>
            <i class="icofont-moon"></i>
         </label>
         <em>Enable Dark Mode!</em>
      </div>
      <div class="osahan-status">
         <div class="p-3 border-bottom">
            <div class="d-flex align-items-center">
               <a class="font-weight-bold text-success text-decoration-none" href="progress_order.php">
               <i class="icofont-rounded-left back-page"></i></a>
               <span class="font-weight-bold ml-3 h6 mb-0">ID #<?php echo $_GET['ordertrack']; ?></span>
               <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>
            </div>
         </div>
         <!-- status complete -->
         
         <div class="p-3 border-bottom">
            <h6 class="font-weight-bold">Order Status</h6>
            <div class="tracking-wrap">
   <?php  
	 
	 $customer_order_status=mysqli_query($config,"select * from order_checkout where order_customer_track_id='".$_GET['ordertrack']."' and Customer_id='$session_id'");
	 while($cos = mysqli_fetch_object( $customer_order_status))
	 {
		 
		?>
		
		
	
		
		
		
		
		
		
		
		
		
		
<?php		$orderstat = $cos->Delivery_status;
		 
		
		
		
		
		
		
		
		
		
		
		
		
		if($cos->Order_status =='Canceled_by_Customer' )

		{ ?>







 <div class="my-1 step">
                  <span class="icon text-danger"><i class="icofont-close-circled"></i></span>
           
		   
				 <span class="text small">order Cancled</span>
               
		

		</div>
		



<?php		}else{
		if($orderstat =="On_Progress")
		 {
	 ?>            
		   <div class="my-1 step active">
                  
             
				 <span class="icon text-success"><i class="icofont-check-circled"></i></span>
				 <span class="text small">Preparing order</span>
            
		


		</div>
               <!-- step.// -->
               <div class="my-1 step active">
                  <span class="icon text-danger"><i class="icofont-close-circled"></i></span>
            
			
				 <span class="text small">Ready to collect</span>
       


	   
			</div>
               <!-- step.// -->
               <div class="my-1 step">
                  <span class="icon text-danger"><i class="icofont-close-circled"></i></span>
           

		   
			   <span class="text small">On the way </span>
        


		
			</div>
               <!-- step.// -->
               <div class="my-1 step">
                  <span class="icon text-danger"><i class="icofont-close-circled"></i></span>
           
		   
				 <span class="text small">Delivered Order</span>
               
		

		</div>
		 <?php }else if($orderstat =="Ready_To_Collect"){?>
		 
		 <div class="my-1 step active">
                  
             
				 <span class="icon text-success"><i class="icofont-check-circled"></i></span>
				 <span class="text small">Preparing order</span>
            
		


		</div>
               <!-- step.// -->
               <div class="my-1 step ">
                  <span class="icon text-success"><i class="icofont-check-circled"></i></span>
            
			
				 <span class="text small">Ready to collect</span>
       


	   
			</div>
               <!-- step.// -->
               <div class="my-1 step">
                  <span class="icon text-danger"><i class="icofont-close-circled"></i></span>
           

		   
			   <span class="text small">On the way </span>
        


		
			</div>
               <!-- step.// -->
               <div class="my-1 step">
                  <span class="icon text-danger"><i class="icofont-close-circled"></i></span>
           
		   
				 <span class="text small">Delivered Order</span>
               
		

		</div>
		 
		 
		 
		  <?php }else if($orderstat =="On_the_way"){?>
		 
		 <div class="my-1 step active">
                  
             
				 <span class="icon text-success"><i class="icofont-check-circled"></i></span>
				 <span class="text small">Preparing order</span>
            
		


		</div>
               <!-- step.// -->
               <div class="my-1 step ">
                  <span class="icon text-success"><i class="icofont-check-circled"></i></span>
            
			
				 <span class="text small">Ready to collect</span>
       


	   
			</div>
               <!-- step.// -->
               <div class="my-1 step">
                  <span class="icon text-success"><i class="icofont-check-circled"></i></span>
           

		   
			   <span class="text small">On the way </span>
        


		
			</div>
               <!-- step.// -->
               <div class="my-1 step">
                  <span class="icon text-danger"><i class="icofont-close-circled"></i></span>
           
		   
				 <span class="text small">Delivered Order</span>
               
		

		</div>
		 
		 
		 
	  <?php }else if($orderstat =="Completed"){?>
		 
		 <div class="my-1 step active">
                  
             
				 <span class="icon text-success"><i class="icofont-check-circled"></i></span>
				 <span class="text small">Preparing order</span>
            
		


		</div>
               <!-- step.// -->
               <div class="my-1 step ">
                  <span class="icon text-success"><i class="icofont-check-circled"></i></span>
            
			
				 <span class="text small">Ready to collect</span>
       


	   
			</div>
               <!-- step.// -->
               <div class="my-1 step">
                  <span class="icon text-success"><i class="icofont-check-circled"></i></span>
           

		   
			   <span class="text small">On the way </span>
        


		
			</div>
               <!-- step.// -->
               <div class="my-1 step">
                  <span class="icon text-success"><i class="icofont-check-circled"></i></span>
           
		   
				 <span class="text small">Delivered Order</span>
               
		

		</div>
		
		
		
		  
		
		
		
		
		
		
<?php }}?>
		 
		
            </div>
         </div>
       <div class="p-3 status-order border-bottom bg-white">
	     <h6 class="font-weight-bold">Order On</h6>
            <p class="small m-0"><i class="icofont-ui-calendar"></i> <?php date_default_timezone_set('Asia/Kolkata');
echo  $cos->Order_on ;?></p>
         </div>
         <div class="p-3 border-bottom bg-white">
            <h6 class="font-weight-bold">Payment Status</h6>
         
	 
		 
		   <h6 >Paid Mode : <?php echo $cos->Payment_Mode; ?></h6>
		   <h6 >Paid Status : <?php 

		  $paist= $cos->Paid_status; 
		   if(is_NULL($paist))
		   {
			   echo "Not Paid";
		   }else{
			   
			    $a=$paist;
				if($a==1)
				{
					echo "Paid";
				}else{
					
					echo  $a;
				}
				
				
				
		   }
		   
		   
		   ?></h6>
      
      
                           <?php
                                            
                                            if($cos->wallet_status == 'Applied' && $cos->Payment_Mode !='COD')
                                            {
                                            
                                            
                                            ?>    <p class="text-muted m-0 ml-auto">Wallet Used<br>
                           <span class="text-dark font-weight-bold">Rs.<?php echo $cos->Wallet_Amount; ?></span>
                        </p>




<?php } ?>
      
      
      
                           <?php
                                            
                                            if($cos->Promocode_status == 'Applied')
                                            {
                                            
                                            
                                            ?>    <p class="text-muted m-0 ml-auto">Promocode Used<br>
                           <span class="text-dark font-weight-bold">Rs.<?php echo $cos->Discount_Offer_prce; ?></span>
                        </p>




<?php } ?>
      
      
      
      
      
 
		</div>
		
		
		
		  <!-- Destination -->
		
		<div class="p-3 border-bottom bg-white">
            <h6 class="font-weight-bold">Destination</h6>
         
	<?php
$check_oaaderr=mysqli_query($config,"select * from customer_addresss_master where Address_id='". $cos->Customer__address_type."' and  Customet_id ='$session_id' ");
            $check_final=mysqli_fetch_object($check_oaaderr);
   		?>
		 
		  <p class="m-0 small"><?php   
			
 
			
			$edit_del_name_=mysqli_query($config,"select * from city_master where CIty_Status=1 and City_id='".$check_final->Delivery_Area."'");
											while($edit_del=mysqli_fetch_object($edit_del_name_))
											{
			
			
		 echo $edit_del->City_Name;
			
			
			
			
											}
			
			
			?>	, <?php echo  $check_final->Complete_Address; ?>, <?php echo  $check_final->Delivery_Landmark; ?></p>
     
 
		</div>
       
         <!-- total price -->
        
 


		<!-- Destination -->
         <div class="p-3 border-bottom bg-white">
            <div class="d-flex align-items-center mb-2">
               <h6 class="font-weight-bold mb-1">Total Cost</h6>
               <h6 class="font-weight-bold ml-auto mb-1">Rs. <?php echo  $cos->Grand_total?></h6>
            </div>
               <p class="m-0 small text-muted"><b>Delivery Charge include Rs.<?php echo  $cos->Delivery_charge?></b>.</p>
		 <?php }?>

       <?php 
	$adcart=mysqli_query($config,"select * from order_master where Customer_id='$session_id' and order_customer_track_id='".$_GET['ordertrack']."' ");
	while($ac=mysqli_fetch_object($adcart))
	
	{
      $advance_pay=$ac->advance_pay;
		 
	$cartpro=mysqli_query($config,"select * from product_master where Product_id='". $ac->Order_product."' ");
            $cp=mysqli_fetch_object($cartpro);
       	
		
		?>
      <?php if($advance_pay != 0){?>
         <p class="m-0 small text-muted"><b>Advance Amount include Rs.<?php echo $advance_pay ?></b>.</p>

         <?php }?>
		
		   <p class="m-0 small text-muted">You can check your order detail here</p>
         
		

</br>
<div class="d-flex align-items-center mb-2">
               <h6 class="font-weight-bold mb-1"><?php echo $cp->Product_Name;?> - <?php echo $ac->Order_type_quantity;?> * <?php echo $ac->Ordered_quantity;?> (<?php echo $ac->order_product_type; ?>)</h6>
               <h6 class="font-weight-bold ml-auto mb-1">Rs. <?php echo  $ac->Order_Price?></h6>
            </div>

	<?php } ?>


 
 <p class="m-0 small text-muted">Thank you for order.</p>


<?php
	if($orderstat =="On_Progress")

		{  
	?>
	<div class="fixed-bottom">
	
	<?php
	if($cos->Order_status =='Canceled_by_Customer' )

		{  
	?>
			<a href="#" class="btn btn-warning btn-block">Order Already Cancled</a>

		<?php }else{?> 
		<!-- <a href="ordercancled.php?cancleorderid=<?php echo $_GET['ordertrack']; ?>" class="btn btn-danger btn-block">Cancel This Order</a> -->
    
		<?php } ?>

	</div>
	  
		
		<?php }else	if($orderstat =="Completed"){
 ?>

<div class="fixed-bottom">
	 	 

		 
		<a href="review.php?revieworderid=<?php echo $_GET['ordertrack']; ?>" class="btn btn-primary btn-block">Review this Order</a>
    
		 

	</div>

		<?php } ?>  
	  
	  
	  
	 





		</div>
      </div>
    
      <?php include('menu.php') ?> 
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