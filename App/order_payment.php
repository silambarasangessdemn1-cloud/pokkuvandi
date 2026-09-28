<?php include('config/setup.php')?>
<?php include('session.php');
 
	?>

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
      <div class="osahan-payment">
         <div class="p-3 border-bottom">
            <div class="d-flex align-items-center">
               <a class="font-weight-bold text-success text-decoration-none" href="order_address.php?ordertrack=<?php echo $_GET['ordertrack'];?>">
               <i class="icofont-rounded-left back-page"></i></a>
               <h6 class="font-weight-bold m-0 ml-3">Select Your Payment Option</h6>
               <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>
            </div>
         </div>
		 
		 
		 
		 <form action="order_payment_option.php" method="post">
		 	  <input type="hidden" name="check_order_address_id" value="<?php echo $_GET['ordertrack'];?>">

         <div class="payment p-3">
            <div class="accordion" id="accordionExample">
               
			   <?php
				   $paysetting=mysqli_query($config,"select * from payment_setting where  Payment_status=1   ");
               while($pay_checkout=mysqli_fetch_object($paysetting))
               {
				 $ps= $pay_checkout->Payment_Mode;
				  if($ps == "ONLINE_PAY")
			
			{ 
				  ?>
			   
			   <input type="hidden" name="pay_option" value="<?php echo $pay_checkout->Payment_Option;?>">

			   <div class="osahan-card rounded shadow-sm bg-white mb-3">
                  <div class="osahan-card-header" id="headingOne">
                     <h2 class="mb-0">
                        <button class="d-flex p-3 align-items-center border-0 btn btn-outline-success bg-white text-decoration-none text-success w-100" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <i class="icofont-credit-card mr-3"></i>online Payment
                       <input type="radio" name="Payment_type"  class=" ml-auto" value="ONLINE_PAYMENT" required>
                        </button>
                     </h2>
                  </div>
                 
               </div>
               
			<?php }else if($ps == "COD"){?>
			   
			   
			   
			   
               <div class="osahan-card rounded shadow-sm bg-white mb-3">
                  <div class="osahan-card-header" id="headingThree">
                     <h2 class="mb-0">
                        <button class="d-flex p-3 align-items-center btn text-decoration-none text-success w-100" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <i class="icofont-dollar mr-3"></i> Cash on Delivery
                       		     <input type="radio" name="Payment_type"  class=" ml-auto" value="COD" required>
                        </button>
                     </h2>
                  </div>
                   <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                     <div class="border-top">
                        <div class="card-body">
                           <b>Cash</b><br>
                                 <p class="small text-muted m-0">Please keep exact change handy to help us serve you better</p>
				 
                        </div>
                     </div>
                  </div>
				    </div>
			   
			<?php }} ?>
			   
			   
			   
			   
            </div>
         </div>
		  <div class="fixed-bottom">
		  <input type="submit" name="order_pay_checkout" class="btn btn-success btn-block" value="Continue to checkout" >
         
      </div>
		 </form>
		 
		 
		 
      </div>
      <!-- continue -->
     
      <!-- Modal -->
      
      <?php include('menu.php');?>
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