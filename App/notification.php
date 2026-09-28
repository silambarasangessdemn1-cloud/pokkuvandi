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
   <body>
      <div class="theme-switch-wrapper">
         <label class="theme-switch" for="checkbox">
            <input type="checkbox" id="checkbox" />
            <div class="slider round"></div>
            <i class="icofont-moon"></i>
         </label>
         <em>Enable Dark Mode!</em>
      </div>
      <div class="osahan-notification">
         <div class="p-3 border-bottom">
            <div class="d-flex align-items-center">
               <a class="font-weight-bold text-success text-decoration-none" href="home.php">
               <i class="icofont-rounded-left back-page"></i></a>
               <span class="font-weight-bold ml-3 h6 mb-0">Notifications</span>
               <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>
            </div>
         </div>
         <!-- osahan notification -->
        

		
		<div class="osahan-notifications bg-white" style="
    height: 112px;
">
            <div class="position-absolute ml-n3 py-5"><i class="text-success bg-success rounded-pill pl-2 p-1"></i></div>
          
  <?php
				   $checkout=mysqli_query($config,"select * from order_master where Customer_id='$session_id' and Order_status='Cart'");
               while($order_checkout=mysqli_fetch_object($checkout))
               {
				  
				  
			
				  
				  ?>
			   

		  <a href="order_address.php?ordertrack=<?php echo $order_checkout->order_customer_track_id;?>" class="text-decoration-none text-dark">
               
 		  <img src="
			   
			<?php
					 
 $pro_po=mysqli_query($config,"select Product_image from product_image_master where Product_id='".$order_checkout->Order_product."' and Product_image_status=1 LIMIT 1");
            $pro_poto=mysqli_fetch_array($pro_po);
 if(!$pro_poto)
 {
 echo  "../Photos/product/no_pro.png";
 }else{
	 
	  
	 $pg=substr($pro_poto[0],6);
				  echo  $pg;
 }
 
	   ?> "  style="width:130px; height: 88px;float: left;"    >
				 
			   
			   <div class="notifiction p-4 border-bottom" style="padding: 0.5rem!important;">
			  
                  <p class="font-weight-bold mb-1"><?php 
				  
				  
				  $product_details=mysqli_query($config,"select * from product_master where Product_id='".$order_checkout->Order_product."' and Product_Active_Status=1 ");
       
           while($det_pro=mysqli_fetch_object($product_details))
               {
		    
		    echo $det_pro->Product_Name;
			   }  
				  
				  
				  
				  ?><span style="color:orange;">! Order Wait for Checkout </span></p>
                  <p class="small text-muted">Rs.<?php echo $order_checkout->Order_type_quantity;?> </p>
                  <p class="small m-0"></p></br>
               
 
  
   
	
	  
 

			  </div></br>
			   
			
			   
			    <div class="fixed-bottom">
	  
	  
	     <a href="order_address.php?ordertrack=<?php echo $order_checkout->order_customer_track_id;?>" class="btn btn-success">Procced Checkout Now</a> 
       </div>
			   
			   
			   
			   
            </a>  <?php } ?>
         </div>
        
     

			
     
      </div>
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