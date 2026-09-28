 <?php include('config/setup.php');?>

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

      <div class="osahan-account">

         <div class="p-3 border-bottom">

            <div class="d-flex align-items-center">

               <h5 class="font-weight-bold m-0">My Account</h5>

               <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>

            </div>

         </div>

         <div class="p-4 profile text-center border-bottom">

            <img src="<?php 

               

                $inro_logo=mysqli_query($config,"select Logo_Path,logo_status from lee_master");

                 while($logo=mysqli_fetch_array($inro_logo))

               {

                    $logstatus=$logo[1];

   if($logstatus == 1)

   {

     $ms=substr($logo[0],6);

				  echo  $ms;

   }else{

       echo "../photos/logo/no_logo.png";

   

   }

   

               }

               

               ?>" style="    width: 100px;

    height: 90px;" class="img-fluid rounded-pill">

            <h6 class="font-weight-bold m-0 mt-2"><?php echo $session__username;?></h6>

            <p class="small text-muted"><?php echo $session__mail; ?></p>

            <a href="edit_profile.php" class="btn btn-success btn-sm"><i class="icofont-pencil-alt-5"></i> Edit Profile</a>

         </div>

         <div class="account-sections">

            <ul class="list-group">

             

               <!-- <a href="my_address.php" class="text-decoration-none text-dark">

                  <li class="border-bottom bg-white d-flex align-items-center p-3">

                     <i class="icofont-address-book osahan-icofont bg-dark"></i>My Address

                     <span class="badge badge-success p-1 badge-pill ml-auto"><i class="icofont-simple-right"></i></span>

                  </li>

               </a> -->
               <?php 
               $sql="SELECT * FROM `biding_vender` where cust_id='$session_id'";
                $main_cate4=mysqli_query($config,$sql);
               $data=mysqli_fetch_object($main_cate4);
               if($data->vender_id)
               {?>
                      <a href="Business_Enquiry.php" class="text-decoration-none text-dark">

<li class="border-bottom bg-white d-flex align-items-center p-3">

   <i  class="fa fa-font-awesome osahan-icofont bg-danger"></i>Professional 

   <span class="badge badge-success p-1 badge-pill ml-auto"><i class="icofont-simple-right"></i></span>

</li>

</a>
               <?php 
               }else{?>
             <?php }?>

               <a href="terms_and_conditions.php" class="text-decoration-none text-dark">

                  <li class="border-bottom bg-white d-flex align-items-center p-3">

                     <i class="icofont-info-circle osahan-icofont bg-primary"></i>Terms and Condition

                     <span class="badge badge-success p-1 badge-pill ml-auto"><i class="icofont-simple-right"></i></span>

                  </li>

               </a>  <a href="privacy.php" class="text-decoration-none text-dark">

                  <li class="border-bottom bg-white d-flex align-items-center p-3">

                     <i class="icofont-info-circle osahan-icofont bg-primary"></i> Privacy Policy

                     <span class="badge badge-success p-1 badge-pill ml-auto"><i class="icofont-simple-right"></i></span>

                  </li>

               </a>

               <a href="rf.php" class="text-decoration-none text-dark">

                  <li class="border-bottom bg-white d-flex align-items-center p-3">

                     <i class="icofont-info-circle osahan-icofont bg-primary"></i> Refund Policy

                     <span class="badge badge-success p-1 badge-pill ml-auto"><i class="icofont-simple-right"></i></span>

                  </li>

               </a>

               <!-- <a href="delivery_policy.php" class="text-decoration-none text-dark">

                  <li class="border-bottom bg-white d-flex align-items-center p-3">

                     <i class="icofont-truck osahan-icofont bg-danger"></i> Delivery & Policy

                     <span class="badge badge-success p-1 badge-pill ml-auto"><i class="icofont-simple-right"></i></span>

                  </li>

               </a> -->

               <a href="help_support.php" class="text-decoration-none text-dark">

                  <li class="border-bottom bg-white d-flex align-items-center p-3">

                     <i class="icofont-phone osahan-icofont bg-warning"></i>Help & Support

                     <span class="badge badge-success p-1 badge-pill ml-auto"><i class="icofont-simple-right"></i></span>

                  </li>

               </a>

			     <a href="about.php" class="text-decoration-none text-dark">

                  <li class="border-bottom bg-white d-flex align-items-center p-3">

                     <i class="icofont-user osahan-icofont bg-success"></i>About us

                     <span class="badge badge-success p-1 badge-pill ml-auto"><i class="icofont-simple-right"></i></span>

                  </li>

               </a>

			   

			   

               <a href="logout.php" class="text-decoration-none text-dark">

                  <li class="border-bottom bg-white d-flex  align-items-center p-3">

                     <i class="icofont-lock osahan-icofont bg-danger"></i> Logout

                  </li>

               </a>

            </ul>

         </div>

      </div>

      <!-- Footer -->

      

	  <?php include('footermenu.php');?>

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