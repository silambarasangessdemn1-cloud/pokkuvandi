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
	
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script src="js/jquery-3.3.1.min.js"></script>
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
               <h5 class="font-weight-bold m-0 ml-3">online Payment Confirmation</h5>
               <a class="  btn-sm ml-auto" href="#">  </a>
               <a class="toggle ml-3" href="#"><i class="icofont-navigation-menu"></i></a>
            </div>
         </div>
        
		  
		    <div class="modal-body">
                  <form name='razorpayform' action="payment_api/pay.php" id="checkoutform" method="GET">
         <div class="form-row">
		 
                          <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
						<input type="hidden" name="razorpay_signature"  id="razorpay_signature" >
                        <div class="col-md-12 form-group"><label class="form-label">Billing Name</label><input  type="text" class="form-control" name="customername" id="customername"  readonly    value="<?php echo $_GET['customername']; ?>"></div>
                        <div class="col-md-12 form-group"><label class="form-label">Billing Mail id</label><input  type="text" class="form-control" name="customermail" id="customermail"  readonly value="<?php echo $_GET['customermail']; ?>"></div>
                        <div class="col-md-12 form-group"><label class="form-label">Billing Mobile No</label><input  type="text" class="form-control" name="customerphone" id="customerphone" readonly value="<?php echo $_GET['customerphone']; ?>"></div>
                        <div class="col-md-12 form-group"><label class="form-label">Billing Address</label><input  type="text" class="form-control" name="customeraddress" id="customeraddress" readonly value="<?php echo $_GET['customeraddress']; ?>"></div>
                        <div class="col-md-12 form-group"><label class="form-label">Billing Address</label><input  type="text" class="form-control" name="deliveryprice" id="deliveryprice" readonly value="<?php echo $_GET['deliveryprice']; ?>"></div>

                        <div class="col-md-12 form-group"><label class="form-label">Order Id</label><input type="text" class="form-control" name="trackorder" id="trackorder" readonly value="<?php echo $_GET['trackorder']; ?>"></div>
                        <div class="col-md-12 form-group"><label class="form-label">Paid Amount</label><input  type="text" class="form-control" name="gtotal" id="gtotal"readonly value="<?php echo $_GET['gtotal']; ?>">
                        <div class="col-md-12 form-group"><label class="form-label">Paid Amount</label><input  type="text" class="form-control" name="sessionid" id="sessionid"readonly value="<?php echo $session_id; ?>">
                        
						  <div class="mb-0 col-md-12 form-group">

			  
            

						  
                     <button id="rzp-button1" >Edit My Address</button>
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

 

<script>
// Checkout details as a json
var options = <?php echo $json?>;

/**
 * The entire list of Checkout fields is available at
 * https://docs.razorpay.com/docs/checkout-form#checkout-fields
 */
options.handler = function (response){
    document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
    document.getElementById('razorpay_signature').value = response.razorpay_signature;
    document.razorpayform.submit();
};

// Boolean whether to show image inside a white frame. (default: true)
options.theme.image_padding = false;

options.modal = {
    ondismiss: function() {
        console.log("This code runs when the popup is closed");
		 window.location.href="../home.php";
    },
    // Boolean indicating whether pressing escape key 
    // should close the checkout form. (default: true)
    escape: true,
    // Boolean indicating whether clicking translucent blank
    // space outside checkout form should close the form. (default: false)
    backdropclose: false
};

var rzp = new Razorpay(options);

document.getElementById('rzp-button1').onclick = function(e){
    rzp.open();
    e.preventDefault();
}
</script>

















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