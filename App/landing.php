
<?php include('config/setup.php')?>
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
   <body class="fixed-bottom-padding p-0">
      <div class="theme-switch-wrapper">
         <label class="theme-switch" for="checkbox">
            <input type="checkbox" id="checkbox" />
            <div class="slider round"></div>
            <i class="icofont-moon"></i>
         </label>
         <em>Enable Dark Mode!</em>
      </div>
      <!-- landing page -->
      <div class="landing-page bg-white">
         <a class="position-absolute btn-sm btn btn-outline-success m-4 zindex" href="signin.php">Skip <i class="icofont-bubble-right"></i></a>         <!-- slider -->
         <div class="osahan-slider m-0">
              <?php 
            
            $inro_logo=mysqli_query($config,"select * from  landing_page");
            while($logo=mysqli_fetch_object($inro_logo))
            {?>
			
			<div class="osahan-slider-item text-center">
               <div class="d-flex align-items-center justify-content-center vh-100 flex-column">
                  <i class="<?php echo $logo->Landing_icon;?> display-1 text-success"></i>
                  <h4 class="my-4 text-dark"><?php echo $logo->Landing_Bold;?></h4>
                  <p class="text-center text-muted mb-5 px-4"><?php echo $logo->Landing_text;?></p>
               </div>
            </div>
            
			
			<?php } ?>	
			
			
			
         </div>
      </div>
      <!-- footer fixed -->
      <div class="osahan-fotter fixed-bottom">
         <a href="signin.php" class="btn btn-success btn-lg fixed-bottom">Get Started</a>
      </div>
     
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