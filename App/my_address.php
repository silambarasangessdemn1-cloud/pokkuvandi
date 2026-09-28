 <?php include('config/setup.php');?>
 <?php include('session.php');?>
 
 <?php
 if(isset($_POST['delivery_address']))
 {
	 $delivery_add=mysqli_query($config,"insert into customer_addresss_master(Customet_id,Delivery_Area,Complete_Address,Delivery_Landmark,Address_type,Address_default)
	                                 values('$session_id','".$_POST['address_delivery_area']."','".$_POST['address_complete_address']."','".$_POST['address_delivery_landmark']."','".$_POST['address_type']."','".$_POST['Edit_address_default']."')       ");
 
 
 
 
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
               <a class="font-weight-bold text-success text-decoration-none" href="my_account.php">
               <i class="icofont-rounded-left back-page"></i></a>
               <h5 class="font-weight-bold m-0 ml-3">My Address</h5>
               <button type="button" class="btn btn-outline-success btn-sm ml-auto" data-toggle="modal" data-target="#exampleModal">Add New Address</button>
               <a class="toggle ml-3" href="#"><i class="icofont-navigation-menu"></i></a>
            </div>
         </div>
        
		 <?php
		  $myaddid=1;
		   $custom_address=mysqli_query($config,"select * from customer_addresss_master where Customet_id='$session_id' ");
            while($custom_add=mysqli_fetch_object($custom_address))
            {
		  
		  
		  
		  ?>
		<div class="p-3">
            <div class="custom-control custom-radio px-0 mb-3 position-relative border-custom-radio">
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
                        <p class="small text-muted m-0"><?php echo $custom_add->Complete_Address; ?></p>
                        <p class="small text-muted m-0"><?php echo $custom_add->Delivery_Landmark; ?></p>
                        <p class="pt-2 m-0 text-right">
						 <a href="edit_address.php?editadd=<?php echo $custom_add->Address_id; ?>"  class="btn btn-success"><i class="icofont-edit"></i> Edit</a> 
                           <span class="small ml-3"><a href="del_address.php?deladd=<?php echo $custom_add->Address_id; ?>&delid=2000" onclick="return confirm('Are you confirm to delete this Address?');"  class="text-decoration-none text-danger"><i class="icofont-trash"></i> Delete</a></span>
                        </p>
                     </div>
                  </div>
               </label>
            </div>
           
         </div>
		  
    
			<?php $myaddid++;} ?>
		 
		 
		 
		 
		 
      </div>
      <!-- Footer -->
    <?php include('footermenu.php');?>
      <!-- Modal -->
     
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Delivery Address</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <form action="my_address.php " method="post">
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
						
						
						
						
						</div><div class="col-md-12 form-group"><label class="form-label">set default Address</label>
 						<select class="form-control" name="Edit_address_default" >
						 
						<option value="1" selected>set default</option>
						<option value="0">Not Default</option>
						 
					 
						</select>
						
						
						
						
						</div>
                        
						</br></br></br>
						  <div class="mb-0 col-md-12 form-group">     
                     <button type="submit" class="btn btn-success btn-lg btn-block" name="delivery_address">Add Address</button>
                  </div>
						
						
						
						
                     </div>
                  </form>
               </div>
               <div class="modal-footer p-0 border-0">
                  <div class="col-6 m-0 p-0">                 
                     <button type="button" class="btn border-top btn-lg btn-block" data-dismiss="modal">Close</button>
                  </div>
                
               </div>
            </div>
         </div>
      </div>
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