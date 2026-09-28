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
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      

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
      <div class="osahan-help">
         <div class="p-3 border-bottom">
            <div class="d-flex align-items-center">
               <a class="font-weight-bold text-success text-decoration-none" href="Directory.php">
               <i class="icofont-rounded-left back-page"></i></a>
               <h6 class="font-weight-bold m-0 ml-3">Help & Support</h6>
               <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>
            </div>
         </div>
      </div>
      <div>
	  <?php
				 
				 $terms=mysqli_query($config,"select * from lee_master");
				 
				 while($tc=mysqli_fetch_object($terms))
				 { ?>
         <style>
            .help_support {
                padding: 40px 15px 80px 15px;
                background-color: #f8f9fa;
                min-height: calc(100vh - 120px);
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            }
            .corporate-header {
                text-align: center;
                margin-bottom: 35px;
            }
            .corporate-header h2 {
                color: #2c3e50;
                font-weight: 700;
                font-size: 28px;
                margin-bottom: 10px;
            }
            .corporate-header p {
                color: #6c757d;
                font-size: 15px;
            }
            .professional-card {
                background: #ffffff;
                border: 1px solid #e9ecef;
                border-radius: 8px;
                padding: 30px;
                margin-bottom: 25px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.04);
            }
            .contact-list {
                display: flex;
                flex-direction: column;
                gap: 25px;
            }
            .contact-item {
                display: flex;
                align-items: flex-start;
            }
            .contact-icon {
                width: 45px;
                height: 45px;
                min-width: 45px;
                background-color: #e8eff9;
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #0d6efd;
                font-size: 18px;
                margin-right: 20px;
            }
            .contact-text h6 {
                font-size: 12px;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                color: #6c757d;
                margin-bottom: 4px;
                font-weight: 600;
            }
            .contact-text p {
                font-size: 15px;
                color: #212529;
                margin: 0;
                font-weight: 500;
                line-height: 1.5;
            }
            
            hr.divider {
                border-top: 1px solid #e9ecef;
                margin: 40px 0;
            }

            .social-section {
                text-align: center;
            }
            .social-title {
                font-size: 18px;
                font-weight: 600;
                color: #2c3e50;
                margin-bottom: 20px;
            }
            .social-icons-wrapper {
                display: flex;
                justify-content: center;
                gap: 15px;
                margin-bottom: 30px;
            }
            .social-btn {
                width: 42px;
                height: 42px;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 8px;
                font-size: 20px;
                transition: all 0.2s ease;
                text-decoration: none !important;
                box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            }
            .social-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 8px rgba(0,0,0,0.15);
            }
            .social-btn.tw { background: #1DA1F2; color: #fff !important; }
            .social-btn.fb { background: #316FF6; color: #fff !important; }
            .social-btn.yt { background: #CD201F; color: #fff !important; }
            .social-btn.ig { background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fd5949 45%, #d6249f 60%, #285AEB 90%); color: #fff !important; }
            
            .about-btn {
                display: inline-flex;
                align-items: center;
                padding: 10px 24px;
                background-color: #0d6efd;
                color: #ffffff !important;
                border-radius: 6px;
                font-weight: 500;
                font-size: 15px;
                text-decoration: none;
                transition: background-color 0.2s ease;
                margin-bottom: 35px;
                border: none;
            }
            .about-btn:hover {
                background-color: #0b5ed7;
            }
            .about-btn img {
                width: 18px;
                margin-right: 8px;
                filter: brightness(0) invert(1);
            }
            
            .footer-copyright {
                font-size: 13px;
                color: #adb5bd;
                margin-top: 20px;
            }
         </style>

         <div class="help_support">
             <div class="container">
                 
                 <div class="corporate-header">
                     <h2>Contact Us</h2>
                     <p>We're here to help and answer any questions you might have.</p>
                 </div>

                 <!-- Contact Info Card -->
                 <div class="professional-card">
                     <div class="contact-list">
                         
                         <div class="contact-item">
                             <div class="contact-icon"><i class="fa-solid fa-building"></i></div>
                             <div class="contact-text">
                                 <h6>Corporate Office</h6>
                                 <p><?php echo $tc->Location; ?> <?php echo $tc->Address; ?></p>
                             </div>
                         </div>
                         
                         <div class="contact-item">
                             <div class="contact-icon"><i class="fa-solid fa-phone"></i></div>
                             <div class="contact-text">
                                 <h6>Customer Support</h6>
                                 <p><?php echo $tc->Contact_Number; ?></p>
                             </div>
                         </div>
                         
                         <div class="contact-item">
                             <div class="contact-icon"><i class="fa-solid fa-headset"></i></div>
                             <div class="contact-text">
                                 <h6>Complaints & Issues</h6>
                                 <p><?php echo $tc->Tel_No; ?></p>
                             </div>
                         </div>
                         
                         <div class="contact-item">
                             <div class="contact-icon"><i class="fa-solid fa-envelope"></i></div>
                             <div class="contact-text">
                                 <h6>Email Address</h6>
                                 <p><?php echo $tc->Email_id; ?></p>
                             </div>
                         </div>
                         
                     </div>
                 </div>

                 <hr class="divider">

                 <!-- Social & About Section -->
                 <div class="social-section">
                     
                     <a href="about.php" class="about-btn">
                        <img src="information.png" alt="Info"> About Our Company
                     </a>

                     <h4 class="social-title">Follow Us Online</h4>
                     
                     <?php 
                        $sql = "SELECT * FROM `lee_master`";
                        $sdate = mysqli_query($config, $sql);
                        $data = mysqli_fetch_object($sdate);                      
                     ?>
                     
                     <div class="social-icons-wrapper">
                         <a class="social-btn tw" target="_blank" href="<?php echo $data->Twitter_link; ?>" title="Twitter">
                             <i class="fa-brands fa-twitter"></i>
                         </a>
                         <a class="social-btn fb" target="_blank" href="<?php echo $data->Facebook_link; ?>" title="Facebook">
                             <i class="fa-brands fa-facebook-f"></i>
                         </a>
                         <a class="social-btn yt" target="_blank" href="<?php echo $data->Youtube_link; ?>" title="YouTube">
                             <i class="fa-brands fa-youtube"></i>
                         </a>
                         <a class="social-btn ig" target="_blank" href="<?php echo $data->Instagram_link; ?>" title="Instagram">
                             <i class="fa-brands fa-instagram"></i>
                         </a>
                     </div>
                     
                     <p class="footer-copyright">
                        <?php
                            $terms_cms = mysqli_query($config, "SELECT copy_right FROM cms");
                            while ($tc_cms = mysqli_fetch_array($terms_cms)) {
                                // Automatically update any 20xx year to the current year
                                $copyright_text = $tc_cms[0];
                                $updated_copyright = preg_replace('/\b20\d{2}\b/', date('Y'), $copyright_text);
                                
                                // If the text doesn't contain a year, prepend the current year automatically
                                if ($updated_copyright === $copyright_text && !preg_match('/\b20\d{2}\b/', $copyright_text)) {
                                    echo "&copy; " . date('Y') . " " . $copyright_text;
                                } else {
                                    echo $updated_copyright;
                                }
                            }
                        ?>
                     </p>
                 </div>

             </div>
         </div>
		 <?php } ?>
      </div>
      <!-- Footer -->
     <div class="osahan-menu-fotter fixed-bottom bg-white text-center border-top">
         <div class="row m-0">
            <a href="home.php" class="text-dark small col font-weight-bold text-decoration-none p-2 ">
               <p class="h5 m-0"><i class="icofont-grocery"></i></p>
               Shop
            </a>
            <a href="cart.php" class="text-muted col small text-decoration-none p-2 selected" >
               <p class="h5 m-0"><i class="text-success  icofont-cart"></i></p>
               Cart
            </a>
            <a href="complete_order.php" class="text-muted col small text-decoration-none p-2">
               <p class="h5 m-0"><i class="icofont-bag"></i></p>
               My Order
            </a>
            <a href="signin_check.php" class="text-muted small col text-decoration-none p-2">
               <p class="h5 m-0"><i class="icofont-user"></i></p>
               Account
            </a>
  
         </div>
    
      </div>
      <?php include('footermenu.php');?>
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