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
               <a class="font-weight-bold text-success text-decoration-none" href="wallet_payout.php">
               <i class="icofont-rounded-left back-page"></i></a>
               <span class="font-weight-bold ml-3 h6 mb-0">Wallet Payout Request</span>
               <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>
            </div>
         </div>
         <!-- status complete -->
          	<?php 
	$adcart=mysqli_query($config,"select * from payout_request where payout_customer_id='$session_id' and payout_request_id='".$_GET['pauid']."' ");
	while($ac=mysqli_fetch_object($adcart))
	
	{
		 
 
       	
		
		?>
       <div class="p-3 status-order border-bottom bg-white">
	     <h6 class="font-weight-bold">Payout Request on</h6>
            <p class="small m-0"><i class="icofont-ui-calendar"></i> <?php date_default_timezone_set('Asia/Kolkata');
echo  $ac->payout_request_on ;?></p>
         </div>
         <div class="p-3 border-bottom bg-white">
            <h6 class="font-weight-bold">Payout Status</h6>
         
	 
		 
		   <h6 >Payout Mode : <?php echo $ac->payout_setting; ?></h6>
		   
		   
		   <h6 >Payout Status : <?php 

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
													
													
													?></h6>
		   
      
 
		</div>   <div class="p-3 border-bottom bg-white">
            <h6 class="font-weight-bold">Payout Amount</h6>
         
	 
		 
		   <h6 >Request Amount :Rs. <?php echo $ac->payout_request_amount; ?></h6>
		   
      
 
		</div> <div class="p-3 border-bottom bg-white">
            <h6 class="font-weight-bold">Payout Attachment</h6>
         
	 <img src="<?php 

  $cate_image=$ac->payout_attachment;;
                  $pb=substr($cate_image,3);
				  echo  $pb;

					 ?>" class="img-fluid mx-auto rounded" alt="Responsive image">
		 
		
		   
      
 
		</div>
		
		
		
		
 


		<!-- Destination -->
         
      </div>
    <?php } ?>
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