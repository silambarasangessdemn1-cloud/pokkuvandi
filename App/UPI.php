 <?php include('config/setup.php');?>
 <?php include('session.php');?>
 
 <?php
 if(isset($_POST['upi_pay']))
 {
	 $payout_date=date("Y-m-d");
	 $delivery_add=mysqli_query($config,"insert into payout_request(payout_customer_id,payout_customer_name,payout_setting,pauout_upi_setting,payout_upi_holder_name,payout_upi_id,payout_request_amount,payout_customer_mobile,payout_customer_email,payout_request_on,payout_status)
	values('$session_id','$session__username','UPI','".$_POST['Edit_upi_option']."','".$_POST['payout_upi_holder_name']."','".$_POST['payout_upi_id']."','$session__wallet','$session__phone','$session__mail','$payout_date','Payout_Request')       ");
	 
	 
	 
	 $upi_cust=mysqli_query($config,"update customer_master set Customer_Wallet = Customer_Wallet - '$session__wallet'   where  Customer_Id='$session_id'");
	 
	 
	 
	 
 header('location:wallet_payout.php');
 
 
 
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
               <a class="font-weight-bold text-success text-decoration-none" href="payout_request.php">
               <i class="icofont-rounded-left back-page"></i></a>
               <h5 class="font-weight-bold m-0 ml-3">UPI Payout</h5>
               <a class="  btn-sm ml-auto" href="#">  </a>
               <a class="toggle ml-3" href="#"><i class="icofont-navigation-menu"></i></a>
            </div>
         </div>
        <div class="modal-body">
                  <form action="UPI.php " method="post">
                     
							
							
							
							<div class="form-row" id="hidden_div" >
                         
						 
							
					
                        
						
						<div class="col-md-12 form-group"><label class="form-label">Select UPI Payout Option</label>
 						<select class="form-control" name="Edit_upi_option"  required>
						 
						<option value="GPAY" selected>GPAY</option>
						<option value="Phonepay">Phonepay</option>
						<option value="Other_UPI">UPI</option>
						 
					 
						</select>
						
						
						
						
						</div>
						
						<div class="col-md-12 form-group"><label class="form-label">UPI Holder Name</label>
						
						
						<input placeholder="Enter UPI Holder Name" type="text" class="form-control" name="payout_upi_holder_name"   required  ></div>
						
						<div class="col-md-12 form-group"><label class="form-label">UPI ID</label>
						
						
						<input placeholder="Enter UPI ID like xxxxxxxxxx@upi " type="text" class="form-control" name="payout_upi_id"       required ></div>
						
							</div>
						
						
						
						</br></br></br>
						  <div class="mb-0 col-md-12 form-group">     
                     <button type="submit" class="btn btn-success btn-lg btn-block" name="upi_pay">Send Payout Request</button>
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