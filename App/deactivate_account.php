 <?php include('config/setup.php');?>
 <?php include('session.php');?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <link rel="icon" type="image/png" href="img/logo.svg">
      <title>Leefoodies</title>
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
      <div class="osahan-help">
         <div class="p-3 border-bottom">
            <div class="d-flex align-items-center">
               <a class="font-weight-bold text-success text-decoration-none" href="edit_profile.php">
               <i class="icofont-rounded-left back-page"></i></a>
               <h6 class="font-weight-bold m-0 ml-3">Deactivate Account</h6>
               <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>
            </div>
         </div>
      </div>
      <div id="edit_profile">
         <div class="p-3 bg-white">
            <form>
               <div class="form-group">
                  <div class="email">
                     <span class="small font-weight-bold">Email</span>
                     <p class="email"><?php echo $session__mail;?></p>
                  </div>
                  <div class="number">
                     <span class="small font-weight-bold">Number</span>
                     <p class="number"><?php echo $session__phone;?></p>
                  </div>
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" placeholder="Enter Password" class="form-control" id="exampleInputPassword1">
               </div>
               <div class="text-center">
                  <button type="button" class="btn btn-success btn-block btn-lg" data-toggle="modal" data-target="#exampleModal">CONFIRM DEACTIVATE</button>
               </div>
            </form>
         </div>
         <div class="border-top">
            <div class="terms p-3 small">
               <span class="font-weight-bold">When you deactivate the account</span>
               <ul class="list-unstyled text-muted">
                  <li>We will miss you.</li>
                  <li>You won't be able to access your Wish list.</li>
                  <li>You will not get updates about the latest offers & discounts.</li>
                  <li>You will have to fill your details while checking out over and over again.</li>
                  <li>You won't be able to check your past orders.</li>
               </ul>
               <span class="font-weight-bold pt-2">How do I reactivate my Grocery account?</span>
               <ul class="list-unstyled text-muted">
                  <li>Coming back is easy.</li>
                  <li>Simply contact us to re-activate your account. Your account data will be fully restored - default settings will be applied and you will be subscribed to receive promotional emails from Grocery.</li>
                  <li>Grocery retains your account data for you to conveniently start off from where you left, if you decide to reactivate your account.</li>
               </ul>
            </div>
         </div>
      </div>
      </div>
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Deactivate Account</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body text-center p-4 d-flex align-items-center">
                  <div>
                     <p class="small text-muted mb-2">Enter the 4-digit code we sent to you</p>
                     <h5 class="mb-3 font-weight-bold">8767895678</h5>
                     <form action="signup.html">
                        <div class="row my-5 px-5">
                           <div class="col px-2">
                              <input type="text" placeholder="0" class="form-control opt form-control-lg text-center">
                           </div>
                           <div class="col px-2">
                              <input type="text" placeholder="0" class="form-control opt form-control-lg text-center">
                           </div>
                           <div class="col px-2">
                              <input type="text" placeholder="0" class="form-control opt form-control-lg text-center">
                           </div>
                           <div class="col px-2">
                              <input type="text" placeholder="0" class="form-control opt form-control-lg text-center">
                           </div>
                        </div>
                        <p class="mb-2"><a href="#" class="text-decoration-none text-success">Resend Code</a></p>
                        <p class="small m-0"><a href="#" class="text-decoration-none text-dark">Call me instead</a></p>
                     </form>
                  </div>
               </div>
               <div class="modal-footer p-0 border-0">
                  <div class="col-6 m-0 p-0">                 
                     <button type="button" class="btn border-top btn-lg btn-block" data-dismiss="modal">Close</button>
                  </div>
                  <div class="col-6 m-0 p-0">     
                     <button type="button" class="btn btn-success btn-lg btn-block">Deactivate</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <nav id="main-nav">
         <ul class="second-nav">
            <li><a href="index.html"><i class="icofont-smart-phone mr-2"></i> Splash</a></li>
            <li>
               <a href="#"><i class="icofont-login mr-2"></i> Authentication</a>
               <ul>
                  <li> <a href="account-setup.html">Account Setup</a></li>
                  <li><a href="signin.html">Sign in</a></li>
                  <li><a href="signup.html">Sign up</a></li>
                  <li><a href="verification.html">Verification</a></li>
               </ul>
            </li>
            <li><a href="get_started.html"><i class="icofont-check-circled mr-2"></i> Get Started</a></li>
            <li><a href="landing.html"><i class="icofont-paper-plane mr-2"></i> Landing</a></li>
            <li><a href="home.html"><i class="icofont-ui-home mr-2"></i> Homepage</a></li>
            <li><a href="notification.html"><i class="icofont-notification mr-2"></i> Notification</a></li>
            <li><a href="search.html"><i class="icofont-search-1 mr-2"></i> Search</a></li>
            <li><a href="listing.html"><i class="icofont-list mr-2"></i> Listing</a></li>
            <li><a href="picks_today.html"><i class="icofont-flash mr-2"></i> Trending</a></li>
            <li><a href="recommend.html"><i class="icofont-like mr-2"></i> Recommend</a></li>
            <li><a href="fresh_vegan.html"><i class="icofont-badge mr-2"></i> Most Popular</a></li>
            <li><a href="product_details.html"><i class="icofont-search-document mr-2"></i> Product Details</a></li>
            <li><a href="cart.html"><i class="icofont-cart mr-2"></i> Cart</a></li>
            <li><a href="order_address.html"><i class="icofont-location-pin mr-2"></i> Order Address</a></li>
            <li><a href="delivery_time.html"><i class="icofont-ui-calendar mr-2"></i> Delivery Time</a></li>
            <li><a href="order_payment.html"><i class="icofont-money mr-2"></i> Order Payment</a></li>
            <li><a href="checkout.html"><i class="icofont-checked mr-2"></i> Checkout</a></li>
            <li><a href="successful.html"><i class="icofont-gift mr-2"></i> Successful</a></li>
            <li>
               <a href="#"><i class="icofont-sub-listing mr-2"></i> My Order</a>
               <ul>
                  <li><a href="complete_order.html">Complete Order</a></li>
                  <li><a href="status_complete.html">Status Complete</a></li>
                  <li><a href="progress_order.html">Progress Order</a></li>
                  <li><a href="status_onprocess.html">Status on Process</a></li>
                  <li><a href="canceled_order.html">Canceled Order</a></li>
                  <li><a href="status_canceled.html">Status Canceled</a></li>
                  <li><a href="review.html">Review</a></li>
               </ul>
            </li>
            <li>
               <a href="#"><i class="icofont-ui-user mr-2"></i> My Account</a>
               <ul>
                  <li> <a href="my_account.html">My Account</a></li>
                  <li><a href="edit_profile.html">Edit Profile</a></li>
                  <li><a href="change_password.html">Change Password</a></li>
                  <li><a href="deactivate_account.html">Deactivate Account</a></li>
                  <li><a href="my_address.html">My Address</a></li>
               </ul>
            </li>
            <li>
               <a href="#"><i class="icofont-page mr-2"></i> Pages</a>
               <ul>
                  <li> <a href="promos.html">Promos</a></li>
                  <li><a href="promo_details.html">Promo Details</a></li>
                  <li><a href="terms_conditions.html">Terms & Conditions</a></li>
                  <li><a href="privacy.html">Privacy</a></li>
                  <li><a href="terms&conditions.html">Conditions</a></li>
                  <li> <a href="help_support.html">Help Support</a></li>
                  <li>  <a href="help_ticket.html">Help Ticket</a></li>
                  <li>  <a href="refund_payment.html">Refund Payment</a></li>
                  <li>  <a href="faq.html">FAQ</a></li>
               </ul>
            </li>
            <li>
               <a href="#"><i class="icofont-link mr-2"></i> Navigation Link Example</a>
               <ul>
                  <li>
                     <a href="#">Link Example 1</a>
                     <ul>
                        <li>
                           <a href="#">Link Example 1.1</a>
                           <ul>
                              <li><a href="#">Link</a></li>
                              <li><a href="#">Link</a></li>
                              <li><a href="#">Link</a></li>
                              <li><a href="#">Link</a></li>
                              <li><a href="#">Link</a></li>
                           </ul>
                        </li>
                        <li>
                           <a href="#">Link Example 1.2</a>
                           <ul>
                              <li><a href="#">Link</a></li>
                              <li><a href="#">Link</a></li>
                              <li><a href="#">Link</a></li>
                              <li><a href="#">Link</a></li>
                           </ul>
                        </li>
                     </ul>
                  </li>
                  <li><a href="#">Link Example 2</a></li>
                  <li><a href="#">Link Example 3</a></li>
                  <li><a href="#">Link Example 4</a></li>
                  <li data-nav-custom-content>
                     <div class="custom-message">
                        You can add any custom content to your navigation items. This text is just an example.
                     </div>
                  </li>
               </ul>
            </li>
         </ul>
         <ul class="bottom-nav">
            <li class="email">
               <a class="text-success" href="home.html">
                  <p class="h5 m-0"><i class="icofont-home text-success"></i></p>
                  Home
               </a>
            </li>
            <li class="github">
               <a href="cart.html">
                  <p class="h5 m-0"><i class="icofont-cart"></i></p>
                  CART
               </a>
            </li>
            <li class="ko-fi">
               <a href="help_ticket.html">
                  <p class="h5 m-0"><i class="icofont-headphone"></i></p>
                  Help
               </a>
            </li>
         </ul>
      </nav>
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