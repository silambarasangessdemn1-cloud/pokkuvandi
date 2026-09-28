 <?php include('config/setup.php');?>
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
	  <form  method="post" action="check_out_address.php"  >
	  
	  <input type="hidden" name="check_order_track_id" value="<?php echo $_GET['ordertrack'];?>">
      <div class="osahan-order_address">
         <div class="p-3 border-bottom">
            <div class="d-flex align-items-center">
               <a class="font-weight-bold text-success text-decoration-none" href="cart.php">
               <i class="icofont-rounded-left back-page"></i></a>
               <h5 class="font-weight-bold m-0 ml-3">Select Address</h5>
  			    <a class="btn btn-outline-success btn-sm ml-auto" href="Add_Address.php">Add</a>
               <a class="toggle ml-3" href="#"><i class="icofont-navigation-menu"></i></a>
            </div>
         </div>
       
	    <?php
		   
		   $custom_address=mysqli_query($config,"select * from customer_addresss_master where Customet_id='$session_id' ");
            
		 
			while($custom_add=mysqli_fetch_object($custom_address))
            {
		  
		  
		  
		  ?>
	   <div class="p-3">
            <div class="custom-control custom-radio px-0 mb-3 position-relative border-custom-radio">
            

 <?php
						  $add_check=$custom_add->Address_default;
						   if($add_check == 1){?>
			<input type="radio" id="customRadioInline1" name="customRadioInline1" value="<?php echo $custom_add->Address_id; ?>" class="custom-control-input" checked required>   
                          
	<?php	  }else{ ?>
	
				<input type="radio" id="customRadioInline1" name="customRadioInline1" value="<?php echo $custom_add->Address_id; ?>" class="custom-control-input" required>   

	
	
	<?php }?>
	
  <label class="custom-control-label w-100" for="customRadioInline1">
                  <div>
                     <div class="p-3 bg-white rounded shadow-sm w-100">
                        <div class="d-flex align-items-center mb-2">
                           <p class="mb-0 h6"><?php echo $custom_add->Address_type; ?></p>
                       <?php
						  $add_def=$custom_add->Address_default;
						   if($add_def == 1)
						   {
						   ?>
                           <p class="mb-0 badge badge-success ml-auto">Default</p>
			<?php } ?>
                        </div>
                        <p class="small text-muted m-0"> 
						
						<?php   
			
 
			
			$edit_del_name_=mysqli_query($config,"select * from city_master where CIty_Status=1 and City_id='".$custom_add->Delivery_Area."'");
											while($edit_del=mysqli_fetch_object($edit_del_name_))
											{
			
			
		 echo $edit_del->City_Name;
			
			
			
			
											}
			
			
			?>	
						
						
						
						
						
						</p>
                        <p class="small text-muted m-0"><?php echo $custom_add->Complete_Address; ?></</p>
                        <p class="small text-muted m-0"><?php echo $custom_add->Delivery_Landmark; ?></</p>
                     					 <div class="d-flex align-items-center mb-2">	
											<a href="edit_address.php?editadd=<?php echo $custom_add->Address_id; ?>"  class="mb-0 h6 badge badge-success ml-auto"><i class="icofont-edit"></i> Edit</a> 
</div>
					 </div>
                  </div>
               </label>
            </div>
				
         </div>
		 
		 
			<?php } ?>
		 
		 
      </div>
      <!-- continue -->
      <div class="fixed-bottom">
	  
	  
	  <input type="submit" value="Continue to Pay " class="btn btn-success btn-block " name="pay_to_checkout">
       </div>
      <!-- Modal -->
    </form>
      </div>
    
<?php include('menu.php')?>


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