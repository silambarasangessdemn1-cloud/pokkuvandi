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
         <div class="order-menu">
            <h5 class="font-weight-bold p-3 d-flex align-items-center">My Order <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a></h5>
            <div class="row m-0 text-center">
                <div class="col pb-2  border-bottom">
                  <a href="progress_order.php" class="text-muted  text-decoration-none">On Progress</a>
               </div>
			   <div class="col pb-2 border-bottom">
                  <a href="complete_order.php" class="text-muted text-decoration-none">Completed</a>
               </div>
              
               <div class="col pb-2 border-success border-bottom">
                  <a href="canceled_order.php" class="text-success font-weight-bold text-decoration-none">Canceled</a>
               </div>
            </div>
         </div>
         
		 	<?php 
	$adcart=mysqli_query($config,"select * from order_checkout where Customer_id='$session_id' and Delivery_status='Canceled' order by Order_on DESC");
	while($ac=mysqli_fetch_object($adcart))
	
	{
		 
 
       	
		
		?>
 
		 
		 
		 
		 <div class="order-body p-3">
            <div class="pb-3">
               <a href="status_onprocess.php?ordertrack=<?php echo $ac->order_customer_track_id ?>" class="text-decoration-none text-dark">
                  <div class="p-3 rounded shadow-sm bg-white">
                     <div class="d-flex align-items-center mb-3">
				 
			
                        <p class="bg-danger text-white py-1 px-2 rounded small m-0">Canceled</p>
						
				 
						
						
						
						
                        <p class="text-muted ml-auto small m-0"><i class="icofont-clock-time"></i> <?php date_default_timezone_set('Asia/Kolkata');
$dt=  $ac->Order_on ;    
echo $newDate = date("d-m-Y", strtotime($dt));?></p>
                     </div>
                     <div class="d-flex">
                        <p class="text-muted m-0">Transaction. ID<br>
                           <span class="text-dark font-weight-bold">#<?php echo $ac->order_customer_track_id; ?></span>
                        </p>
                        <p class="text-muted m-0 ml-auto">Delivered to<br>
						
							<?php
$check_oaaderr=mysqli_query($config,"select * from customer_addresss_master where Address_id='". $ac->Customer__address_type."' and  Customet_id ='$session_id' ");
            $check_final=mysqli_fetch_object($check_oaaderr);
   		?>
						
                           <span class="text-dark font-weight-bold"><?php echo $check_final->Address_type; ?></span>
						   
						   
						   
						   
                        </p>
                        <p class="text-muted m-0 ml-auto">Total Payment<br>
                           <span class="text-dark font-weight-bold">Rs.<?php echo $ac->Grand_total; ?></span>
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
            <a href="home.php" class="text-dark small col text-decoration-none p-2">
               <p class="h5 m-0"><i class="icofont-grocery"></i></p>
               Shop
            </a>
            <a href="cart.php" class="text-muted col small text-decoration-none p-2">
               <p class="h5 m-0"><i class="icofont-cart"></i></p>
               Cart
            </a>
            <a href="complete_order.php" class="text-muted font-weight-bold col small text-decoration-none p-2 selected">
               <p class="h5 m-0"><i class="text-success icofont-bag"></i></p>
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