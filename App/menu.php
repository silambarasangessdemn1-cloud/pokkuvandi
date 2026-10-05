<?php include('config/setup.php');?>
<?php include('session.php');

?>

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

<nav id="main-nav">
    <ul class="second-nav">
        <?php 

		 if($session_id != NULL)

		 {
			 ?>
        <li><i class="icofont-user-suited mr-2"></i><span style="color:#03bb2c;"> <?php echo $session__username?></span>
        </li>
      

        <li >
            <a href="#" id="driverMenu" style="display: none;"> <i class="icofont-ui-user mr-2"></i> Driver</a>
            <ul>
            <?php 
            // Get counts for driver
            if(isset($session_id)) {
                // Total quotes sent
                $driver_totalQuery = "SELECT COUNT(DISTINCT order_id) as total FROM order_driver_bids WHERE driver_id = '$prof_id'";
                $driver_totalResult = mysqli_query($config, $driver_totalQuery);
                $driver_total = mysqli_fetch_assoc($driver_totalResult)['total'];
                
                // Accepted orders
                $driver_acceptedQuery = "SELECT COUNT(*) as total FROM order_driver_bids WHERE driver_id = '$prof_id' AND customer_status = 'accepted'";
                $driver_acceptedResult = mysqli_query($config, $driver_acceptedQuery);
                $driver_accepted = mysqli_fetch_assoc($driver_acceptedResult)['total'];
                
                // Ongoing orders
                $driver_ongoingQuery = "SELECT COUNT(DISTINCT odb.order_id) as total FROM order_driver_bids odb INNER JOIN orders o ON odb.order_id = o.id WHERE odb.driver_id = '$prof_id' AND odb.customer_status = 'accepted' AND o.status NOT IN ('completed', 'ended', 'cancelled')";
                $driver_ongoingResult = mysqli_query($config, $driver_ongoingQuery);
                $driver_ongoing = mysqli_fetch_assoc($driver_ongoingResult)['total'];
                
                // Completed orders
                $driver_completedQuery = "SELECT COUNT(DISTINCT odb.order_id) as total FROM order_driver_bids odb INNER JOIN orders o ON odb.order_id = o.id WHERE odb.driver_id = '$prof_id' AND odb.customer_status = 'accepted' AND o.status = 'completed'";
                $driver_completedResult = mysqli_query($config, $driver_completedQuery);
                $driver_completed = mysqli_fetch_assoc($driver_completedResult)['total'];
            }
            ?>
            <li><a href="driver_summary.php"><i class="icofont-chart-line mr-2"></i>Summary <span class="badge badge-primary"><?= $driver_total ?$driver_total : 0 ?></span></a></li>
              <li><a href="create_post.php"><i class="icofont-star mr-2"></i>Create New Registration </a></li>
        <li><a href="createpost_list.php"><i class="icofont-star mr-2"></i>Registered Vehicles / Service List </a></li>
        <li><a href="pokkuvandi_driver_entry.php"><i class="icofont-login mr-2"></i> Driver Return Trip Entry</a></li>
        <li><a href="pokkuvandi_entry_view.php"><i class="icofont-star mr-2"></i> Driver Return Trip List</a></li>
        <li><a href="delete_post.php"><i class="icofont-star mr-2"></i>Deleted List </a></li>
        <!-- <li><a href="exp_list.php"><i class="icofont-star mr-2"></i>Expiry List </a></li> -->
        <li><a href="exp_post.php"><i class="icofont-star mr-2"></i>Renewal Payment </a></li>

        <li><a href="renewal_list.php"><i class="icofont-star mr-2"></i>Renewal List </a></li>
        <li><a href="driver_pokku_entry_list_view.php?driver=driver"><i class="icofont-login mr-2"></i>Customer Vehicle Required List</a></li>
        <li>
            <a href="#"><i class="icofont-ui-user mr-2"></i> Acting Driver</a>
            <ul>
            <li><a href="job_post_list.php"><i class="icofont-login mr-2"></i>Acting Driver Entry List</a></li>
        <li><a href="job_search_post.php"><i class="icofont-login mr-2"></i>Acting Driver Registration</a></li>

                <!-- <li><a href="my_address.php">My Address</a></li> -->
            </ul>
        </li>
        <li>
            <a href="#"><i class="icofont-ui-user mr-2"></i> Customer Order List</a>
            <ul>
            <li><a href="driver_order_view.php"><i class="icofont-login mr-2"></i>Notification Order List</a></li>

            <li><a href="driver_order_view.php?type=ongoing"><i class="icofont-login mr-2"></i>Order Ongoing List <span class="badge badge-warning"><?= $driver_ongoing ?$driver_ongoing: 0 ?></span></a></li>
            <li><a href="driver_order_view.php?type=ended"><i class="icofont-login mr-2"></i>Order Payment Pending List</a></li>

<li><a href="driver_order_view.php?type=cancel"><i class="icofont-login mr-2"></i>Order Cancelled List</a></li>
<li><a href="driver_order_view.php?type=expired"><i class="icofont-login mr-2"></i>Order Expiry List</a></li>

<li><a href="driver_order_history.php"><i class="icofont-login mr-2"></i>Completed Orders History <span class="badge badge-success"><?= $driver_completed ?  $driver_completed: 0 ?></span></a></li>

                <!-- <li><a href="my_address.php">My Address</a></li> -->
            </ul>


        </li>
       


        
                <!-- <li><a href="my_address.php">My Address</a></li> -->
            </ul>
        </li>
      

      
        <li>
            <a href="#" id="customerMenu" style="display: none;"><i class="icofont-ui-user mr-2"></i> Customer</a>
            <ul>
        <?php 
        // Get counts for customer
        if(isset($session_id)) {
            // Total orders
            $cust_totalQuery = "SELECT COUNT(*) as total FROM orders WHERE cust_id = '$session_id'";
            $cust_totalResult = mysqli_query($config, $cust_totalQuery);
            $cust_total = mysqli_fetch_assoc($cust_totalResult)['total'];
            
            // Ongoing orders
            $cust_ongoingQuery = "SELECT COUNT(*) as total FROM orders WHERE cust_id = '$session_id' AND status NOT IN ('cancelled', 'completed', 'ended')";
            $cust_ongoingResult = mysqli_query($config, $cust_ongoingQuery);
            $cust_ongoing = mysqli_fetch_assoc($cust_ongoingResult)['total'];
            
            // Completed orders
            $cust_completedQuery = "SELECT COUNT(*) as total FROM orders WHERE cust_id = '$session_id' AND status = 'completed'";
            $cust_completedResult = mysqli_query($config, $cust_completedQuery);
            $cust_completed = mysqli_fetch_assoc($cust_completedResult)['total'];
        }
                     $sqln_="SELECT *  FROM `create_post` where create_post.customer_id='$session_id'  ";
                     $mainmcate__=mysqli_query($config,$sqln_); 
                     $rows = mysqli_num_rows($mainmcate__);
                  
                   ?>
        <li><a href="customer_summary.php"><i class="icofont-chart-line mr-2"></i>Summary <span class="badge badge-primary"><?= $cust_total ? $cust_total: 0 ?></span></a></li>
                <!-- <//?php if($rows < 0) {?> -->
        <li><a href="customer_pokkuvadi_entry.php"><i class="icofont-login mr-2"></i> Customer Vehicle Required Entry</a></li>    
           <!-- <//?php } ?> -->
        <!-- <li><a href="customer_pokku_entry_list_view.php"><i class="icofont-login mr-2"></i>Pokkuvandi Customer Entry List</a></li> -->
      <!-- <li><a href="state_type_choose_cus.php"><i class="icofont-login mr-2"></i>Customer Vehicle Required List</a></li> -->
            <li><a href="customer_pokku_entry_list_view.php"><i class="icofont-login mr-2"></i>Customer Vehicle Required List</a></li>

            <li>
            <a href="#" onclick="showServiceNotAvailable(event)"><i class="icofont-ui-user mr-2"></i> Vehicle Booking</a>
            <ul>
            <li><a href="#" onclick="showServiceNotAvailable(event)"><i class="icofont-login mr-2"></i> Vehicle  Booking Form</a></li>

            <li><a href="view_order.php?type=ongoing"><i class="icofont-login mr-2"></i>Order Ongoing List <span class="badge badge-warning"><?= $cust_ongoing ? $cust_ongoing: 0 ?></span></a></li>
<li><a href="view_order.php?type=cancel"><i class="icofont-login mr-2"></i>Order Cancelled List</a></li>
<li><a href="view_order.php?type=expired"><i class="icofont-login mr-2"></i>Order Expired List</a></li>

            <li><a href="order_history.php"><i class="icofont-login mr-2"></i>Completed Order History <span class="badge badge-success"><?= $cust_completed ? $cust_completed: 0 ?></span></a></li>

                <!-- <li><a href="my_address.php">My Address</a></li> -->
            </ul>
        </li>
    </ul>
      </li>

      <script>
    const userType = localStorage.getItem('user_type');
  

    if (userType === 'customer') {
        document.getElementById('customerMenu').style.display = 'block';
    } else if (userType === 'driver') {
        document.getElementById('driverMenu').style.display = 'block';
    }
</script>

<li>
  <a href="Directory.php?scroll=bottom"><i class="icofont-login mr-2"></i>Vehicle Search</a>
</li>


     

               <?php 
               $sqln="SELECT * FROM `dir_vender` where cust_id='$session_id'";
                $mainmcate4=mysqli_query($config,$sqln);
               $mainmcate=mysqli_fetch_object($mainmcate4);
               if($mainmcate->dir_vender_id)
               {
                  $nn="SELECT count(dir_com_id) as total FROM `dir_com_enq` INNER JOIN dir_com_vender_enq ON dir_com_vender_enq.com_enq_id=dir_com_enq.dir_com_id where com_vid='$mainmcate->dir_vender_id' and stat='0' and view_enq_re='0' order by (dir_com_id) DESC ";            
         $abountm=mysqli_query($config,$nn);
         $delkk=mysqli_fetch_object($abountm);
                         
         
                     $delm=mysqli_fetch_object($abount);
                     $n2b="SELECT count(dir_bu_id) as total FROM `dir_bussness` where vid='$mainmcate->dir_vender_id' and e_status='0' and enq_view='0' order by (dir_bu_id) DESC ";            
                     $aboutb=mysqli_query($config,$n2b);
                     
                                     
                     
                        $delb=mysqli_fetch_object($aboutb);                    
                     
                     ?>
        <!-- <li><a href="bussness_membership.php"><i class="icofont-star mr-2"></i>Directory Details </a></li>
        <li><a href="bussness_Downline.php"><i class="icofont-star mr-2"></i>Directory Downline </a></li>
        <li><a href="Business_Enquiry.php"><i class="icofont-star mr-2"></i>Directory Enquiry <span style="    font-size: 13px;
    color: red;
    margin-left: 14%;
    font-weight: 500;"><span><?php echo $delkk->total?></span>/ <span
                        style=""><?php echo  $delb->total ?></span></span></a></li> -->
        <?php }?>
        <!-- <li><a href="ven_notification.php"><i class="icofont-star mr-2"></i>Notifications (Support) </a></li> -->
      
        <?php }else{ ?>
        <li><a href="signin.php"><i class="icofont-login mr-2"></i>Signin</a></li>
       
        <hr>
        
        <li><a href="signup.php"><i class="icofont-edit mr-2"></i>Create New User Account</a></li>
        <?php }  ?>
        <li><a href="demo_video_list.php"><i class="icofont-login mr-2"></i>Demo Videos List</a></li>
        <li><a href="offers_view.php"><i class="icofont-login mr-2"></i>Offers</a></li>

        <li>
            <a href="#"><i class="icofont-page mr-2"></i> Privacy Policy</a>
            <ul>
                <li><a href="terms_and_conditions.php">Terms & Conditions</a></li>
                <li><a href="privacy.php">Privacy Policy</a></li>
                <!-- <li> <a href="delivery_policy.php">Delivery Policy</a></li>-->
                <li> <a href="rf.php">Refund Policy</a></li> 
            </ul>
        </li>


     
        <?php 



		 



		 if($session_id != NULL)



		 {



			 



			 ?>

<li>
            <a href="#"><i class="icofont-ui-user mr-2"></i> My Account</a>
            <ul>
                <li> <a href="my_account.php">My Account</a></li>
                <li><a href="edit_profile.php">Edit Profile</a></li>
                <li><a href="change_password.php">Change Password</a></li>
                <!-- <li><a href="my_address.php">My Address</a></li> -->
            </ul>
        </li>

        <li><a href="logout.php"><i class="icofont-power off mr-2"></i>Logout</a></li>
        <?php } ?>
    </ul>
    <ul class="bottom-nav">
        <li class="email">
            <a class="text-success" href="home.php">
                <p class="h5 m-0"><i class="icofont-home text-success"></i></p>
                Home
            </a>
        </li>
       
        <li class="ko-fi">
            <a href="help_support.php">
                <p class="h5 m-0"><i class="icofont-headphone"></i></p>
                Help
            </a>
        </li>
    </ul>
</nav>
<style>
.theme-switch-wrapper {

    display: none !important;
}
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      // Disable zooming on mobile devices
      $('meta[name=viewport]').attr('content', 'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no');
    });
  </script>

<!-- Service Not Available Modal -->
<div class="modal fade" id="menuServiceNotAvailableModal" tabindex="-1" role="dialog" aria-labelledby="menuServiceNotAvailableModalLabel" aria-hidden="true" style="z-index: 10000; background: rgba(0,0,0,0.5);">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="border-radius: 15px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
      <div class="modal-header" style="background-color: #f8d7da; color: #721c24; border-bottom: none; border-radius: 15px 15px 0 0;">
        <h5 class="modal-title" id="menuServiceNotAvailableModalLabel">⚠️ Service Not Available</h5>
      </div>
      <div class="modal-body text-center" style="padding: 30px;">
        <p style="font-size: 1.1rem; color: #555;">This service is currently not available.</p>
        <p style="margin-bottom: 0;">You will be redirected to the <strong>Customer Vehicle Requirement Entry</strong> page shortly.</p>
      </div>
      <div class="modal-footer justify-content-center" style="border-top: none;">
        <a href="customer_pokkuvadi_entry.php" class="btn btn-danger" style="border-radius: 8px; padding: 10px 25px;">Proceed Now</a>
      </div>
    </div>
  </div>
</div>

<script>
function showServiceNotAvailable(e) {
    if(e) e.preventDefault();
    if (window.jQuery && window.jQuery.fn.modal) {
        jQuery('#menuServiceNotAvailableModal').modal('show');
        setTimeout(function() {
            window.location.href = 'customer_pokkuvadi_entry.php';
        }, 3000);
    } else {
        alert("This service is currently not available. You will be redirected.");
        window.location.href = 'customer_pokkuvadi_entry.php';
    }
}
</script>