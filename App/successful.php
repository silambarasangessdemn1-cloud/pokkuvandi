<?php include('config/setup.php')?>
<?php include('session.php');

unset($_SESSION['Add_postid']);
unset($_SESSION['Add_driver_name']);
unset($_SESSION['Add_vehicle_no']);
unset($_SESSION['addcatephoto']);
unset($_SESSION['addcatephoto']);
unset($_SESSION['Add_phone_no']);
unset($_SESSION['Add_whatsapp_no']);
unset($_SESSION['Add_address']);
unset($_SESSION['Add_city']);
unset($_SESSION['Add_area']);
unset($_SESSION['Add_status']);
unset($_SESSION['post_addon']);
unset($_SESSION['Add_vehicle_name']);
unset($_SESSION['Add_main_cate']);
unset($_SESSION['Add_sub_category']);
unset($_SESSION['Add_meta_keyword']);
unset($_SESSION['create_on']);
unset($_SESSION['Add_load_detail']);
unset($_SESSION['Add_location']);
unset($_SESSION['Add_Registration_date']);
unset($_SESSION['Add_RC_owner_name']);
unset($_SESSION['Add_insurance_exp_date']);
unset($_SESSION['FC_date']);
unset($_SESSION['Add_remarks']);
unset($_SESSION['Add_package']);
unset($_SESSION['Add_amount']);
unset($_SESSION['Add_days']);
unset($_SESSION['futureDate']);
unset($_SESSION['day_duty']);
unset($_SESSION['night_duty']);
unset($_SESSION['vehicle_type_id']);
unset($_SESSION['seating_capacity']);
unset($_SESSION['facilities']);
unset($_SESSION['space']);
unset($_SESSION['size']);
unset($_SESSION['tonnage']);
unset($_SESSION['shop_name']);
unset($_SESSION['work_nature']);
unset($_SESSION['shop_address']);
unset($_SESSION['stand_name']);
unset($_SESSION['net_amount']);
unset($_SESSION['Add_sub_area']);
unset($_SESSION['reffered_by_phone_no']); 
unset($_SESSION['reffered_by_name']);

unset($_SESSION['less_amount']);
unset($_SESSION['coupon_code']);
unset($_SESSION['coupon_type']);

 unset($_SESSION['merchantTransactionId']);
 unset($_SESSION['merchantUserId']);





ob_start();
session_start();


$session_id_get =  $_GET['session_id'];

// echo $query="select * from customer_master where  Customer_Id='$session_id_get'";
$session=mysqli_query($config,"select * from customer_master where  Customer_Id='$session_id_get' ");

$s1=mysqli_fetch_array($session);

 $session_id__=$s1['Customer_Id'];

 $_SESSION['member_id']= $session_id__;
 $session_id = $_SESSION['member_id'];

$session__username=$s1['Customer_Name'];

$session__mail=$s1['Customer_Mail_id'];

$session__phone=$s1['Customer_Phone_No'];

$session__password=$s1['Customer_Password'];

$session__wallet=$s1['Customer_Wallet'];


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
      <!-- <div class="theme-switch-wrapper">
         <label class="theme-switch" for="checkbox">
            <input type="checkbox" id="checkbox" />
            <div class="slider round"></div>
            <i class="icofont-moon"></i>
         </label>
         <em>Enable Dark Mode!</em>
      </div> -->
      <div class="osahan-success bg-success vh-100">
         <div class="p-5 text-center">
            <i class="icofont-check-circled display-1 text-warning"></i>
            <h1 class="text-white font-weight-bold">Your Registration successfully completed 🎉</h1>
            <!-- <p class="text-white">Check your order status in <a href="complete_order.php" class="font-weight-bold text-decoration-none text-white">My Order</a> about next steps information.</p> -->
         </div>
      </div>
      <!-- continue -->
      <div class="fixed-bottom fixed-bottom-auto bg-white rounded p-3 m-3 text-center">
         <!-- <h6 class="font-weight-bold mb-2">Preparing your order</h6>
         <p class="small text-muted">Your order will be prepared and will come soon</p> -->
         <a href="createpost_list.php" class="btn rounded btn-warning btn-lg btn-block">View Registered Vehicles</a>
      </div>
      
      <!-- Auto redirect after showing success message -->
      <script>
      setTimeout(function() {
          window.location.href = 'createpost_list.php';
      }, 5000); // Redirect after 5 seconds
      </script>
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