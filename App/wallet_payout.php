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
      <div class="osahan-order">
      <div class="p-3 border-bottom bg-white">

<div class="d-flex align-items-center">

    <a class="font-weight-bold text-success text-decoration-none" href="wallet.php">

<i class="icofont-rounded-left back-page"></i></a>

    <h6 class="font-weight-bold m-0 ml-3">My Wallet  </h6>

    <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>

</div>

</div>

         <div class="d-flex" style="    padding-left: 33px;">
                      <p class="text-muted m-0">Total Earning </p>&nbsp;  <b>Rs. <?php echo $session__wallet;?> </b></p>
			
			 
			  	<?php 
	$payoutin=mysqli_query($config,"select * from payout_setting where Payout_setting=1");
	while($pin=mysqli_fetch_object($payoutin))
	
	{
		if($session__wallet >= $pin->payout_set  )
		{
		?>
 
       <a href="payout_request.php" style="margin-left: 145px;" class="btn btn-success">Withdraw Now</a>	
		
	<?php }else{ 	?> 
 
		<label style="margin-left: 145px;" class="btn btn-danger">Withdraw Limit is <?php echo $pin->payout_set?> </label>	 
			 
			 
	<?php }} ?>	 
			 
			 
			 
					
                         
                     </div>
		 	<?php 
	$adcart=mysqli_query($config,"select * from payout_request where payout_customer_id='$session_id' ");
	while($ac=mysqli_fetch_object($adcart))
	
	{
		 
 
       	
		
		?>
 
		 
		 
		 
		 <div class="order-body p-3">
            <div class="pb-3">
               <a href="#" class="text-decoration-none text-dark">
                  <div class="p-3 rounded shadow-sm bg-white">
                     <div class="d-flex align-items-center mb-3">
					 
			
                        <p class="text-white py-1 px-2 rounded small m-0">
						
						<?php 

													$enablestatus=$ac->payout_status;
													
													if($enablestatus== 1)
													{ ?>
												<label class="btn btn-success">Transferred </label>
<?php														
													}else if($enablestatus== -1){
														?>
														<label class="btn btn-danger">Rejected</label>
														<?php
													}else{
														?>
														<label class="btn btn-warning">Pending</label>
														<?php
													}
													
													
													?>
						
						
						
						</p> <a href="payout_detail.php?pauid=<?php echo $ac->payout_request_id;?>">View Detail</a>
                       
						
				 
						
						
						
						
                        <p class="text-muted ml-auto small m-0"><i class="icofont-clock-time"></i>   <?php 
						
						$dt=  $ac->payout_request_on;   
echo $newDate = date("d-m-Y", strtotime($dt));
						
						
						?></p>
                     </div>
                     <div class="d-flex">
                        <p class="text-muted m-0">Payout id<br>
                           <span class="text-dark font-weight-bold">#<?php echo $ac->payout_request_id; ?></span>
                        </p> 
						
						<p class="text-muted m-0 ml-auto">Payout by<br>
                           <span class="text-dark font-weight-bold"><?php echo $ac->payout_setting; ?></span>
                        </p>
                        
						 
						   
						   
                        </p>
                        <p class="text-muted m-0 ml-auto">Request Amount<br>
                           <span class="text-dark font-weight-bold">Rs.<?php echo $ac->payout_request_amount; ?></span>
                        </p> 
					 
                     </div>
                  </div>
               </a>
            </div>
         </div>
		 
	<?php } ?> 
		
		 
		 
      </div>
      <!-- Footer -->
      <div class="osahan-menu-fotter fixed-bottom bg-white text-center border-top">
         <div class="row m-0">
            <a href="home.php" class="text-dark small col text-decoration-none p-2 selected">
               <p class="h5 m-0"><i class="icofont-grocery"></i></p>
               Shop
            </a>
            <a href="cart.php" class="text-muted col small text-decoration-none p-2">
               <p class="h5 m-0"><i class="icofont-cart"></i></p>
               Cart
            </a>
            <a href="complete_order.php" class="text-muted font-weight-bold col small text-decoration-none p-2 ">
               <p class="h5 m-0"><i class=" icofont-bag"></i></p>
               My Order
            </a>
            <a href="my_account.php" class="text-muted small col text-decoration-none p-2">
               <p class="h5 m-0"><i class="icofont-user"></i></p>
               Account
            </a>
         </div>
      </div>
      <?php  include('menu.php');?> 
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