<?php include('config/setup.php')?>
<?php include('session.php');?>

<style>
.text-red {
  color: red;
}
.blink-hard {
  animation: blinker 1s step-end infinite;
  color: red;
  font-weight: 700;
}

.badge-danger1{

   color: #f1f1f6;
   background-color:rgb(0 26 255 / 51%);
}
@keyframes blinker {
  50% {
    opacity: 0;
  }
}
.blink-hard {
  animation: blinker 1s linear infinite;
}

@keyframes blinker {
  50% { opacity: 0; }
}

   </style>


 <div class="border-bottom p-3" style="background-color: #199b37 !important;">

            <div class="title d-flex align-items-center">
            <a style="margin-top: 0%;
    padding-right: 3%;" class="back" href="Directory.php">

               </a>
               <a href="Directory.php" class="text-decoration-none text-dark d-flex align-items-center">

                  <img class="osahan-logo mr-2" style="background: white;" src=" <?php 

               

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

               

               ?>

               ">
               <?php
$about=mysqli_query($config,"select * from dir_share_script");

$del=mysqli_fetch_object($about);

?>         

<meta name="twitter:card" content="summary" />

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

<meta name="twitter:site" content="https://callinfo.in/bdirectory/fullsite/App/Directory.php" />

<meta name="twitter:creator" content="callinfo" />

<meta property="og:image" content="https://callinfo.in/bdirectory/fullsite/<?php  echo  $new_str = str_replace('../','', $ms);

 ?>" />			

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">


<meta property="og:title" content="<?php echo $del->title;

   ?>"/> 

    <meta name="author" content="<?php  

     echo $del->title;

       ?>">

             <meta property="og:url" content="https://callinfo.in/bdirectory/fullsite/App/Directory.php" />



<meta property="og:type" content="website" />

<meta property="og:description" content="<?php echo $del->title;  ?>"/>

 <meta name="description" content="<?php echo $del->title;  ?>">
                  <h6 class="m-0"><?php 

               

               $leename=mysqli_query($config,"select Name,Name_status from lee_master");

               while($lee=mysqli_fetch_array($leename))

               {

                    $namestatus=$lee[1];

   if($namestatus == 1)

   {

      //  echo  $lee[0];
      echo 'Pokkuvandi ';

   }else{

       echo "Need Name";
   }

               }
               ?> </h6>
               </a>
               

               
               <div class="ml-auto d-flex align-items-center">
               <?php
// Logged-in customer ID
 // or your session/customer ID variable
 
// Only fetch pending count if user is logged in
$pending_count = 0;
if ($session_id) {
    $driver_note_sql = "
        SELECT COUNT(DISTINCT o.id) as pending_count
        FROM orders o
        INNER JOIN create_post cp 
            ON o.from_city = cp.area_id 
            AND o.Add_sub_category = cp.subcategory_id
        WHERE o.status != 'completed'
          AND o.created_at >= DATE_SUB(NOW(), INTERVAL 2 DAY)
          AND cp.customer_id = '$prof_id'
    ";

    $driver_noteresult = mysqli_query($config, $driver_note_sql);
    if ($driver_noteresult) {
        $driver_noterow = mysqli_fetch_assoc($driver_noteresult);
        $pending_count = $driver_noterow['pending_count'];
    }
}

// Check activation popup for create_post - show popup once when post status becomes active
$show_activation_popup = false;
$activation_post_id = null;
if ($session_id) {
    // First check if column exists, if not create it
    $check_column = "SHOW COLUMNS FROM create_post LIKE 'activation_popup_shown'";
    $column_result = mysqli_query($config, $check_column);
    if (mysqli_num_rows($column_result) == 0) {
        // Column doesn't exist, add it
        $alter_table = "ALTER TABLE create_post ADD COLUMN activation_popup_shown TINYINT(1) DEFAULT 0";
        mysqli_query($config, $alter_table);
    }
    
    // Check if user has any posts with status = 1 (active) AND activation_popup_shown = 1 (popup ready to show)
    $activation_check_sql = "SELECT post_id, status, activation_popup_shown 
                            FROM create_post 
                            WHERE customer_id = '$session_id' 
                            AND status = 1 
                            AND activation_popup_shown = 1
                            ORDER BY post_id DESC 
                            LIMIT 1";
    $activation_result = mysqli_query($config, $activation_check_sql);
    if ($activation_result && mysqli_num_rows($activation_result) > 0) {
        $activation_data = mysqli_fetch_assoc($activation_result);
        $show_activation_popup = true;
        $activation_post_id = $activation_data['post_id'];
    }
}
?>
<div class="d-flex align-items-center">
    <!-- Pending Orders Notification -->
    <?php if ($session_id) { // Only show for logged-in users ?>
    <a href="driver_noti_page.php" class="text-decoration-none bg-white p-2 rounded shadow-sm d-flex align-items-center mr-2">
        <i class="text-dark icofont-notification"></i>
        <span class="badge badge-danger1 p-1 ml-1 small">
            <?= $pending_count ?>
        </span>
    </a>
    <?php } ?>

    <!-- Call Notifications -->
    <?php if ($session_id) { // Only show for logged-in users ?>
    <a href="call_noti_page.php" class="text-decoration-none bg-white p-2 rounded shadow-sm d-flex align-items-center">
        <i class="text-dark icofont-notification"></i>
        <span class="badge badge-danger p-1 ml-1 small">
            <?php 
            $sqln_="SELECT COUNT(call_count_id) as count_id  
                    FROM create_post 
                    INNER JOIN call_click_count 
                    ON call_click_count.post_id = create_post.post_id 
                    WHERE create_post.customer_id='$session_id' 
                      AND call_click_count.status_read='0'";
            $mainmcate__ = mysqli_query($config, $sqln_);
            $mainmcate_ = mysqli_fetch_object($mainmcate__);
            echo $mainmcate_->count_id;
            ?>
        </span>
    </a>
    <?php } // End of if ($session_id) for Call Notifications ?>

  
    <?php
// Fetch only unread notifications for the logged-in customer
$notif_sql = "
    SELECT * FROM comman_notification_messages
    WHERE status = 1
      AND (
        (message_type = 'common' AND (is_read IS NULL OR is_read = 0))
        OR (message_type = 'particular' AND customer_id = '$session_id' AND (is_read IS NULL OR is_read = 0))
      )
    ORDER BY notification_id DESC
";
$notif_result = mysqli_query($config, $notif_sql);
$notif_count = mysqli_num_rows($notif_result);
?>

<!-- Notification Bell for Common/Particular Messages -->
<?php if ($notif_count > 0) { ?>
    <a href="#" class="text-decoration-none bg-white p-2 rounded shadow-sm d-flex align-items-center ml-2"
       data-toggle="modal" data-target="#commonMsgModal">
        <i class="text-danger icofont-bell blink-hard"></i>
        <span class="badge badge-danger p-1 ml-1 small"><?= $notif_count ?></span>
    </a>
<?php } ?>
<!-- Modal for Common/Particular Notifications -->
<div class="modal fade" id="commonMsgModal" tabindex="-1" role="dialog" aria-labelledby="commonMsgModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="commonMsgModalLabel">📢 Notifications</h5>
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <?php
        if ($notif_count > 0) {
            // Reset the result pointer to loop through again
            mysqli_data_seek($notif_result, 0);
            while ($notif = mysqli_fetch_object($notif_result)) {
                $msg_type = ucfirst($notif->message_type);
                $msg_text = htmlspecialchars($notif->message_text, ENT_QUOTES, 'UTF-8');
                $cus_name = $notif->customer_name ? $notif->customer_name : 'All Customers';
        ?>
                <div class="border rounded p-3 mb-2 shadow-sm bg-light" id="notification_<?= $notif->notification_id; ?>">
                    <p class="m-0">
                        <strong class="text-success"><?= $msg_type; ?></strong><br>
                        <span style="font-size:16px; font-family:'Latha', sans-serif;">
                            <?= nl2br($msg_text); ?>
                        </span><br>
                        <small class="text-muted">To: <?= $cus_name; ?></small>
                    </p>
                    
                    <?php if ($notif->message_type == 'particular') { ?>
                        <!-- Reply option for individual messages -->
                        <div class="mt-2">
                            <button class="btn btn-sm btn-primary" onclick="showReplyForm(<?= $notif->notification_id; ?>)">
                                <i class="fas fa-reply"></i> Reply
                            </button>
                        </div>
                        
                        <!-- Reply form (hidden by default) -->
                        <div id="replyForm_<?= $notif->notification_id; ?>" style="display: none;" class="mt-3">
                            <form onsubmit="submitReply(event, <?= $notif->notification_id; ?>)">
                                <div class="form-group">
                                    <label>Your Reply:</label>
                                    <textarea class="form-control" id="replyText_<?= $notif->notification_id; ?>" rows="3" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-success btn-sm">Send Reply</button>
                                <button type="button" class="btn btn-secondary btn-sm" onclick="hideReplyForm(<?= $notif->notification_id; ?>)">Cancel</button>
                            </form>
                        </div>
                    <?php } ?>
                </div>
        <?php
            }
        } else {
            echo '<p class="text-center text-muted">No notifications at the moment.</p>';
        }
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</div>





                  <!---post exp date--->

               <!-- <a href="Business_Enquiry.php" class="text-decoration-none bg-white p-1 rounded shadow-sm d-flex align-items-center">
                  <i class="text-dark icofont-notification"></i>
                  <span class="badge badge-danger p-1 ml-1 small">
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
                  <span><?php echo $delkk->total?></span>/ <span style=""><?php echo  $delb->total ?></span>
				  
				  
				  
				  <?php }?>
				  
				  
				  </span>
                  </a> -->

      
               </div>

               <a class="toggle ml-3" href="#"><i class="icofont-navigation-menu"></i></a>

            </div>
            
            <?php
            // Show common notification message only for logged-in users
            if ($session_id) {
                // Fetch common notification messages for logged-in users
                $common_msg_query = "SELECT * FROM comman_notification_messages 
                                     WHERE message_type = 'common' 
                                     AND (is_read IS NULL OR is_read = 0)
                                     ORDER BY notification_id DESC 
                                     LIMIT 1";
                $common_msg_result = mysqli_query($config, $common_msg_query);
                
                if ($common_msg_result && mysqli_num_rows($common_msg_result) > 0) {
                    $common_msg = mysqli_fetch_object($common_msg_result);
                    $common_msg_text = htmlspecialchars($common_msg->message_text, ENT_QUOTES, 'UTF-8');
                    ?>
                    <div class="alert alert-info alert-dismissible fade show mt-2 mb-2" role="alert" style="font-size: 0.9rem; margin-top: 15px !important;">
                        <strong>📢 Notice:</strong> <?php echo $common_msg_text; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="markCommonNotificationRead(<?php echo $common_msg->notification_id; ?>)">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php
                }
            }
            ?>
            
            <?php
if ($session_id) {

    $current_Date = date('Y-m-d');
    $expired_count = 0;
    $pending_payment_count = 0;
    $renewal_reminder_count = 0;

    // Check for pending payment posts (submitted but not paid)
    $pending_payment_query = "SELECT * FROM `create_post` 
                              WHERE customer_id = '$session_id' 
                              AND status = 0 
                              AND delete_approval_status != 1 
                              AND (utr_number IS NULL OR utr_number = '')";
    $pending_payment_result = mysqli_query($config, $pending_payment_query);
    $pending_payment_count = mysqli_num_rows($pending_payment_result);

    // Fetch all active posts by the current session's customer
    $post_query = "SELECT * FROM `create_post` WHERE status = '1' AND delete_id = '0' AND customer_id = '$session_id'";
    $post_result = mysqli_query($config, $post_query);

    // Loop through posts to check expiry and renewal reminder
    while ($post = mysqli_fetch_object($post_result)) {
        $exp_date = $post->expiry_date;
        $package_days = 10;

        // Calculate 10 days before expiry date
        $exp_reminder_date = date("Y-m-d", strtotime($exp_date . " -$package_days days"));

        // Check if this post is expired
        if ($current_Date >= $exp_date) {
            $expired_count++;
        }
        // Check if post is expiring within 10 days (renewal reminder)
        elseif ($current_Date >= $exp_reminder_date && $current_Date < $exp_date) {
            $renewal_reminder_count++;
        }
    }

    // Display buttons in a flex container for better mobile layout
    // Payment Pending - show for all users
    if ($pending_payment_count > 0) {
        ?>
        <div class="d-flex flex-column flex-sm-row ml-auto" style="max-width: 100%; gap: 10px;">
            <a href="create_post.php" class="text-decoration-none bg-white rounded shadow-sm d-flex align-items-center justify-content-center" style="padding: 3px 6px; max-width: 45%; flex: 0 0 auto;">
                <span class="badge small blink-hard text-danger m-0" style="font-weight: 600; font-size: 0.65rem; white-space: nowrap;">
                    💳 Payment Pending (<?php echo $pending_payment_count; ?>)
                </span>
            </a>
        </div>
        <?php
    }
    
    // Expired, Renewal Reminder - show only for driver type users
    if ($expired_count > 0 || $renewal_reminder_count > 0) {
        ?>
        <div id="driver-only-buttons-container" class="d-flex flex-column flex-sm-row ml-auto mt-2" style="max-width: 100%; gap: 10px; display: none !important;">
            <?php if ($renewal_reminder_count > 0) { ?>
                <a href="exp_post.php" class="text-decoration-none bg-white rounded shadow-sm d-flex align-items-center justify-content-center" style="padding: 3px 6px; max-width: 45%; flex: 0 0 auto;">
                    <span class="badge small blink-hard text-warning m-0" style="font-weight: 600; font-size: 0.65rem; white-space: nowrap; color: #ff9800 !important;">
                        ⏰ Renewal Reminder (<?php echo $renewal_reminder_count; ?>)
                    </span>
                </a>
            <?php } ?>
            
            <?php if ($expired_count > 0) { ?>
                <a href="exp_post.php" class="text-decoration-none bg-white rounded shadow-sm d-flex align-items-center justify-content-center" style="padding: 3px 6px; max-width: 45%; flex: 0 0 auto;">
                    <span class="badge small blink-hard text-danger m-0" style="font-size: 0.65rem; white-space: nowrap;">
                        🚫 Expired (<?php echo $expired_count; ?>)
                    </span>
                </a>
            <?php } ?>
        </div>
        <?php
    }
    
    // Show Driver Dashboard button always when user is driver
    // Show "New Online Order's" button only when there are new orders and user is driver
    if ($session_id) {
        ?>
        <div id="driver-buttons-container" class="d-flex flex-column flex-sm-row ml-auto mt-2" style="max-width: 100%; gap: 10px; display: none !important;">
            <!-- New Online Order's button - only shows when there are new orders -->
            <div id="new-orders-button-container" style="display: none;">
                <a href="driver_noti_page.php" class="text-decoration-none bg-white rounded shadow-sm d-flex align-items-center justify-content-center" style="padding: 6px 10px; flex: 0 0 auto;">
                    <span class="badge small blink-hard text-success m-0" style="font-weight: 600; font-size: 0.7rem; white-space: nowrap;">
                        🆕 New Online Order's (<?php echo $pending_count; ?>)
                    </span>
                </a>
            </div>
            
            <!-- Driver Dashboard button - always shows for drivers -->
            <a href="driver_summary.php" class="text-decoration-none bg-white rounded shadow-sm d-flex align-items-center justify-content-center" style="padding: 4px 6px;
    width: 48%;
">
                <span class="badge small blink-hard text-primary m-0" style="font-weight: 600; font-size: 0.7rem; white-space: nowrap;">
                    📊 Driver Dashboard
                </span>
            </a>
        </div>
        <?php
    }
}
?>
               <!-- <div class="input-group mt-3 rounded shadow-sm overflow-hidden bg-white">

                 

                  <input style='margin-left: 7%;' id='catesearch1'  type="text" class="shadow-none border-0 form-control pl-0" placeholder="Search for Category.." aria-label="" aria-describedby="basic-addon1">

                  <div class="input-group-prepend">

                     <button id='catesearch' class="border-0 btn btn-outline-secondary text-success bg-white"><i class="icofont-search"></i></button>

                  </div>

               </div>

               <div id='search'>

                -->

                  <!-- </div> -->
                 
                  <!-- <div  class="input-group mt-3 rounded shadow-sm overflow-hidden bg-white">
                  <div class="input-group-prepend">
          <span class="input-group-text" data-toggle="modal" data-target="#exampleModalcity"  id="city_name"><?php echo $_SESSION["city_name"]; ?><i class="fa fa-angle-down"></i></span>
        </div>
        <div class="input-group-prepend">

                     <button class="border-0 btn btn-outline-secondary text-success bg-white"><i class="icofont-search"></i></button>

                  </div>
                  <a href="dir_search.php">
                  <input style="background-color: white;" list="heroes" type="text" id="catesearch1" class="shadow-none border-0 form-control pl-0 " placeholder="Choose  Category.." aria-label="" aria-describedby="basic-addon1">
</div> -->
</a>
               
                  <div style='display:none;' class="alert alert-success" role="alert">
                <b>  Thank you for getting in touch! </b>

We appreciate you contacting us callinfo . One of our colleagues will get back in touch with you soon!Have a great day!
</div>

         </div>



         <style>

            .sresults{

               background: white;

            }

            .sresults li{

               border-bottom: 1px solid gainsboro;
padding-top: 2%;
            }

            .sresults {

               list-style: none;

              

               

            }
            .fixed-bottom-padding .theme-switch-wrapper {
    bottom: 70px;
    display: none;
}
            .force-hide {
    display: none !important;
}
            </style>


<?php ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
  <script>
    $(document).ready(function() {
      // Disable zooming on mobile devices
      $('meta[name=viewport]').attr('content', 'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no');
      
      // Check user type and show/hide driver-related buttons
      function checkUserTypeAndShowButtons() {
        var userType = localStorage.getItem('user_type');
        var pendingCount = <?php echo $pending_count; ?>;
        
        console.log('User Type:', userType);
        console.log('Pending Count:', pendingCount);
        
        // Hide all driver-related buttons by default (for customer or undefined)
        if (userType !== 'driver') {
          $('#driver-only-buttons-container').hide().addClass('force-hide');
          $('#driver-buttons-container').hide().addClass('force-hide');
          $('#new-orders-button-container').hide().addClass('force-hide');
          return; // Exit early if not driver
        }
        
        // Remove force-hide class if user is driver
        $('#driver-only-buttons-container').removeClass('force-hide');
        $('#driver-buttons-container').removeClass('force-hide');
        $('#new-orders-button-container').removeClass('force-hide');
        
        // Only show buttons if user is driver
        if (userType === 'driver') {
          // Show expired and renewal reminder buttons
          if ($('#driver-only-buttons-container').length) {
            $('#driver-only-buttons-container').show();
          }
          
          // Show driver dashboard container
          if ($('#driver-buttons-container').length) {
            $('#driver-buttons-container').show();
          }
          
          // Show New Online Order's button only if there are new orders
          if (pendingCount > 0 && $('#new-orders-button-container').length) {
            $('#new-orders-button-container').show();
          }
        }
      }
      
      // Check immediately on page load
      checkUserTypeAndShowButtons();
      
      // Also check after a short delay to ensure localStorage is available
      setTimeout(function() {
        checkUserTypeAndShowButtons();
      }, 100);
      
      // Check again after DOM is fully loaded
      $(window).on('load', function() {
        checkUserTypeAndShowButtons();
      });
    });

  </script>
  <script>
$(document).ready(function () {
    // When the notification modal is shown
    $('#commonMsgModal').on('shown.bs.modal', function () {
        console.log("Modal opened — marking notifications as read...");

        $.ajax({
            url: "mark_notifications_read.php",
            type: "POST",
            data: { customer_id: "<?= $session_id ?>" },
            success: function (response) {
                console.log("✅ Notifications marked as read");
                // Update the notification count in the header
                updateNotificationCount();
            },
            error: function (xhr, status, error) {
                console.error("❌ Error calling mark_notifications_read.php:", error);
            }
        });
    });
    
    // When modal is closed, refresh the page to update notification count
    $('#commonMsgModal').on('hidden.bs.modal', function () {
        location.reload();
    });
});

// Function to show reply form
function showReplyForm(notificationId) {
    $('#replyForm_' + notificationId).show();
}

// Function to hide reply form
function hideReplyForm(notificationId) {
    $('#replyForm_' + notificationId).hide();
    $('#replyText_' + notificationId).val('');
}

// Function to submit reply
function submitReply(event, notificationId) {
    event.preventDefault();
    
    var replyText = $('#replyText_' + notificationId).val();
    if (!replyText.trim()) {
        Swal.fire({
            icon: 'warning',
            title: 'Warning!',
            text: 'Please enter a reply message',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
        return;
    }
    
    // Show loading state
    Swal.fire({
        title: 'Sending...',
        text: 'Please wait while we send your reply',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    
    $.ajax({
        url: "submit_notification_reply.php",
        type: "POST",
        data: {
            notification_id: notificationId,
            reply_message: replyText,
            customer_id: "<?= $session_id ?>"
        },
        success: function (response) {
            try {
                var result = typeof response === 'string' ? JSON.parse(response) : response;
                
                if (result && result.success !== false) {
                    // Hide the reply form
                    hideReplyForm(notificationId);
                    
                    // Hide the notification with animation
                    $('#notification_' + notificationId).fadeOut(500, function() {
                        $(this).remove();
                        
                        // Check if there are any more notifications
                        var remainingNotifications = $('.modal-body .border.rounded.p-3').length;
                        if (remainingNotifications === 0) {
                            $('.modal-body').html('<p class="text-center text-muted">No notifications at the moment.</p>');
                        }
                    });
                    
                    // Mark this notification as read after reply
                    markNotificationAsRead(notificationId);
                    
                    // Show success SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Your reply has been sent successfully!',
                        confirmButtonColor: '#28a745',
                        confirmButtonText: 'OK',
                        timer: 2000,
                        timerProgressBar: true
                    }).then(() => {
                        // Update notification count
                        updateNotificationCount();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: result.message || 'Failed to send reply. Please try again.',
                        confirmButtonColor: '#dc3545',
                        confirmButtonText: 'OK'
                    });
                }
            } catch (e) {
                // If response is not JSON, treat as success
                if (response.trim() === '1' || response.trim() === 'success') {
                    hideReplyForm(notificationId);
                    $('#notification_' + notificationId).fadeOut(500, function() {
                        $(this).remove();
                        var remainingNotifications = $('.modal-body .border.rounded.p-3').length;
                        if (remainingNotifications === 0) {
                            $('.modal-body').html('<p class="text-center text-muted">No notifications at the moment.</p>');
                        }
                    });
                    markNotificationAsRead(notificationId);
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Your reply has been sent successfully!',
                        confirmButtonColor: '#28a745',
                        confirmButtonText: 'OK',
                        timer: 2000,
                        timerProgressBar: true
                    }).then(() => {
                        updateNotificationCount();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Failed to send reply. Please try again.',
                        confirmButtonColor: '#dc3545',
                        confirmButtonText: 'OK'
                    });
                }
            }
        },
        error: function (xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'An error occurred while sending your reply. Please try again.',
                confirmButtonColor: '#dc3545',
                confirmButtonText: 'OK'
            });
            console.error('Error:', error);
        }
    });
}

// Function to mark common notification as read when user closes the alert
function markCommonNotificationRead(notificationId) {
    $.ajax({
        url: "mark_specific_notification_read.php",
        type: "POST",
        data: {
            notification_id: notificationId,
            customer_id: "<?= $session_id ?>"
        },
        success: function(response) {
            console.log("Common notification marked as read");
            // Hide the alert with fade animation
            $('.alert-info').fadeOut(300, function() {
                $(this).remove();
            });
        },
        error: function(error) {
            console.error("Error marking common notification as read:", error);
        }
    });
}

// Function to mark specific notification as read
function markNotificationAsRead(notificationId) {
    $.ajax({
        url: "mark_specific_notification_read.php",
        type: "POST",
        data: {
            notification_id: notificationId,
            customer_id: "<?= $session_id ?>"
        },
        success: function (response) {
            console.log("Notification marked as read");
            // Notification hiding is already handled in submitReply function
        },
        error: function(xhr, status, error) {
            console.error("Error marking notification as read:", error);
        }
    });
}

// Function to update notification count
function updateNotificationCount() {
    $.ajax({
        url: "get_notification_count.php",
        type: "POST",
        data: { customer_id: "<?= $session_id ?>" },
        success: function (response) {
            var count = parseInt(response);
            $('.badge-danger').text(count);
            if (count === 0) {
                $('.badge-danger').parent().hide();
            }
        }
    });
}

// Function to play notification sound - Enhanced version with multiple methods
function playNotificationSound() {
    // Method 1: Try to use HTML5 Audio with notification sound file (if available)
    // Optional: If you have a notification sound file, uncomment and set the path
    /*
    try {
        var audio = new Audio('sounds/notification.mp3'); // Change path to your sound file
        audio.volume = 0.7;
        audio.play().catch(function(err) {
            // If audio file fails, continue to Web Audio API method
        });
    } catch (e) {
        // Continue to Web Audio API method
    }
    */
    
    // Method 2: Use Web Audio API to create a pleasant notification sound pattern
    try {
        var audioContext = new (window.AudioContext || window.webkitAudioContext)();
        
        // Create a notification sound pattern (like a phone notification)
        // Play 3 beeps: high, medium, high
        var frequencies = [800, 600, 800];
        var durations = [0.15, 0.15, 0.2];
        var delays = [0, 0.2, 0.4];
        
        frequencies.forEach(function(freq, index) {
            setTimeout(function() {
                try {
                    var oscillator = audioContext.createOscillator();
                    var gainNode = audioContext.createGain();
                    
                    oscillator.connect(gainNode);
                    gainNode.connect(audioContext.destination);
                    
                    // Set sound properties
                    oscillator.frequency.value = freq;
                    oscillator.type = 'sine';
                    
                    var now = audioContext.currentTime;
                    gainNode.gain.setValueAtTime(0, now);
                    gainNode.gain.linearRampToValueAtTime(0.5, now + 0.05); // Fade in
                    gainNode.gain.linearRampToValueAtTime(0.5, now + durations[index] - 0.05);
                    gainNode.gain.linearRampToValueAtTime(0, now + durations[index]); // Fade out
                    
                    oscillator.start(now);
                    oscillator.stop(now + durations[index]);
                } catch (e) {
                    console.log("Error playing sound beep:", e);
                }
            }, delays[index] * 1000);
        });
        
    } catch (e) {
        // Method 3: Fallback - Simple beep using AudioContext
        try {
            var ctx = new (window.AudioContext || window.webkitAudioContext)();
            var osc = ctx.createOscillator();
            var gain = ctx.createGain();
            
            osc.connect(gain);
            gain.connect(ctx.destination);
            
            osc.frequency.value = 800;
            osc.type = 'sine';
            
            var now = ctx.currentTime;
            gain.gain.setValueAtTime(0.4, now);
            gain.gain.exponentialRampToValueAtTime(0.01, now + 0.3);
            
            osc.start(now);
            osc.stop(now + 0.3);
        } catch (err) {
            console.log("All audio methods failed:", err);
        }
    }
}

// Check for pending orders and show SweetAlert (only once per order count)
$(document).ready(function() {
    <?php if ($session_id && $pending_count > 0) { ?>
    var pendingCount = <?= $pending_count ?>;
    var storageKey = 'pending_order_alert_' + pendingCount + '_<?= $session_id ?>';
    var lastShownCount = localStorage.getItem('last_pending_count_<?= $session_id ?>');
    
    // Only show alert if:
    // 1. There are pending orders
    // 2. This specific count hasn't been shown before
    // 3. The count has changed (new orders)
    if (pendingCount > 0 && localStorage.getItem(storageKey) !== 'shown' && lastShownCount !== String(pendingCount)) {
        // Play notification sound immediately
        playNotificationSound();
        
        // Play sound again after a short delay to ensure it's heard
        setTimeout(function() {
            playNotificationSound();
        }, 600);
        
        // Show SweetAlert
        Swal.fire({
            title: 'New Pending Orders!',
            html: '<div style="font-size: 18px;">You have <strong style="color: #dc3545;">' + pendingCount + '</strong> pending order(s) waiting for your attention.</div>',
            icon: 'warning',
            iconColor: '#ffc107',
            confirmButtonText: 'View Orders',
            confirmButtonColor: '#199b37',
            showCancelButton: true,
            cancelButtonText: 'Close',
            cancelButtonColor: '#6c757d',
            allowOutsideClick: false,
            allowEscapeKey: true,
            timer: 10000, // Auto close after 10 seconds
            timerProgressBar: true,
            didOpen: () => {
                // Play sound when alert is fully opened
                setTimeout(function() {
                    playNotificationSound();
                }, 200);
            }
        }).then((result) => {
            // Mark this count as shown
            localStorage.setItem(storageKey, 'shown');
            localStorage.setItem('last_pending_count_<?= $session_id ?>', String(pendingCount));
            
            if (result.isConfirmed) {
                // Redirect to driver notification page
                window.location.href = 'driver_noti_page.php';
            } else {
                // Just close the alert, don't redirect
                // The alert won't show again for this order count
            }
        });
    }
    <?php } ?>
});

// Show activation popup for driver users when post status becomes active (only once)
<?php if ($show_activation_popup && $activation_post_id) { ?>
$(document).ready(function() {
    var userType = localStorage.getItem('user_type');
    
    // Only show for driver type users
    if (userType === 'driver') {
        // Check if popup has been shown in localStorage for this post
        var activationPopupShown = localStorage.getItem('activation_popup_shown_post_<?= $activation_post_id ?>');
        
        if (!activationPopupShown) {
            // Show modern activation popup
            Swal.fire({
                title: '🎉 Post Activated!',
                html: '<div style="font-size: 16px; padding: 10px;">' +
                      '<p style="margin-bottom: 15px;">Congratulations! Your vehicle registration has been activated successfully.</p>' +
                      '<p style="margin-bottom: 20px; color: #28a745; font-weight: 600;">Your post is now live and visible to customers!</p>' +
                      '<a href="createpost_list.php" style="display: inline-block; margin-top: 10px; padding: 10px 20px; background-color: #199b37; color: white; text-decoration: none; border-radius: 5px; font-weight: 600;">View Active List →</a>' +
                      '</div>',
                icon: 'success',
                iconColor: '#199b37',
                confirmButtonText: 'Got it!',
                confirmButtonColor: '#199b37',
                allowOutsideClick: false,
                allowEscapeKey: true,
                showCloseButton: true,
                customClass: {
                    popup: 'animated-popup',
                    title: 'swal-title-custom',
                    htmlContainer: 'swal-html-custom'
                }
            }).then((result) => {
                // Mark popup as shown in database and localStorage
                $.ajax({
                    url: 'mark_post_activation_popup_shown.php',
                    type: 'POST',
                    data: {
                        post_id: '<?= $activation_post_id ?>'
                    },
                    success: function(response) {
                        console.log('Activation popup marked as shown');
                        // Mark in localStorage
                        localStorage.setItem('activation_popup_shown_post_<?= $activation_post_id ?>', '1');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error marking activation popup:', error);
                        // Still mark in localStorage as fallback
                        localStorage.setItem('activation_popup_shown_post_<?= $activation_post_id ?>', '1');
                    }
                });
            });
        }
    }
});
<?php } ?>
</script>

<style>
.animated-popup {
    animation: slideInDown 0.5s ease-out;
}

@keyframes slideInDown {
    from {
        transform: translateY(-50px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.swal-title-custom {
    font-size: 24px !important;
    color: #199b37 !important;
}

.swal-html-custom {
    text-align: center !important;
}
</style>
