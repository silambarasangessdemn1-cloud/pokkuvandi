 <?php include('config/setup.php');?>
 <?php include('session.php');?>
 
 <?php
 if(isset($_POST['delivery_address']))
 {
	 $delivery_add=mysqli_query($config,"insert into customer_addresss_master(Customet_id,Delivery_Area,Complete_Address,Delivery_Landmark,Address_type,Address_default)
	                                 values('$session_id','".$_POST['address_delivery_area']."','".$_POST['address_complete_address']."','".$_POST['address_delivery_landmark']."','".$_POST['address_type']."','".$_POST['Edit_address_default']."')       ");
	 
	  $delivery_location=mysqli_query($config,"update customer_master set Customer_Area='".$_POST['address_delivery_area']."' where Customer_Id='$session_id' ");
	 
	 
	 
	 
 header('location:my_address.php');
 
 
 
 }
 
 
 
 
 
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
      <div class="osahan-my_address">
         <div class="p-3 border-bottom">
            <div class="d-flex align-items-center">
               <a class="font-weight-bold text-success text-decoration-none" href="my_address.php">
               <i class="icofont-rounded-left back-page"></i></a>
               <h5 class="font-weight-bold m-0 ml-3">Add your Address</h5>
               <a class="  btn-sm ml-auto" href="#">  </a>
               <a class="toggle ml-3" href="#"><i class="icofont-navigation-menu"></i></a>
            </div>
         </div>
        <div class="modal-body">
                  <form action="Add_Address.php " method="post">
                     <div class="form-row">
                        <div class="col-md-12 form-group">
                           <label class="form-label">Delivery Area</label>
                           <div class="input-group">
                               
						<select  class="form-control" name="address_delivery_area">
			<?php
			
			$pro_name_=mysqli_query($config,"select * from city_master where CIty_Status=1");
											while($add_pro=mysqli_fetch_object($pro_name_))
											{
			
			
			?>
			
			<option value="<?php echo $add_pro->City_id;?>"><?php echo $add_pro->City_Name;?></option>
			
			
			
			
											<?php } ?>
			
			</select>	  
							  
							  
							  
							  <div class="input-group-append"><button id="button-addon2" type="button" class="btn btn-outline-secondary"><i class="icofont-pin"></i></button></div>
                           </div>
                        </div>
                        <div class="col-md-12 form-group"><label class="form-label">Complete Address</label>
						
						
						<input placeholder="Complete Address e.g. house number, street name, landmark" type="text" class="form-control" name="address_complete_address"></div>
                        <div class="col-md-12 form-group"><label class="form-label">Delivery Instructions</label><input placeholder="Delivery Instructions e.g. Opposite Gold Souk Mall" type="text" class="form-control" name="address_delivery_landmark"></div>
                        <div class="col-md-12 form-group"><label class="form-label">Address Type</label>
 						<select class="form-control" name="address_type" >
						
						<option value="Home">Home</option>
						<option value="Work">Work</option>
						<option value="Others">Others</option>
						
						
						
						
						</select>
						<div class="col-md-12 form-group"><label class="form-label">set default Address</label>
 						<select class="form-control" name="Edit_address_default" >
						 
						<option value="1" selected>set default</option>
						<option value="0">Not Default</option>
						 
					 
						</select>
						
						
						
						
						</div>
						
						
						
						</div>
                        
						</br></br></br>
						  <div class="mb-0 col-md-12 form-group">     
                     <button type="submit" class="btn btn-success btn-lg btn-block" name="delivery_address">Add Address</button>
                  </div>
						
						
						
						
                     </div>
                  </form>
               </div>
		 
		 
		 
		 
		 
      </div>
      <!-- Footer -->
    <?php include('footermenu.php');?>
      <!-- Modal -->
     
     
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