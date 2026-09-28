<?php include('config/setup.php');?>

 <?php include('session.php');
 $mid=$_REQUEST['mid'];
$session__phone; 

 $sqln_="SELECT *  FROM `create_post` inner join call_click_count on call_click_count.post_id = create_post.post_id where create_post.customer_id='$session_id' ";
$mainmcate__=mysqli_query($config,$sqln_);
while($mainmcate_=mysqli_fetch_object($mainmcate__))
{
 $post_id= $mainmcate_->post_id;
 $addmaincate=mysqli_query($config,"update call_click_count set status_read='1' where post_id='".$post_id."'");
    

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
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
     
            <script src="
      https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js
      "></script>
      <link href="
      https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css
      " rel="stylesheet">

   </head>
   

   <body>
   <style>
.owl-prev {
    position: absolute;
    top: 48%;
    color: blue !important;
    display: none;
}
.owl-next {
    position: absolute;
    left: 96%;
    color: blue !important;    
    top: 49%;
    display: none;
}
.heading_webkit
{
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
     overflow: hidden;
}


.switch {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 18px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
    position: absolute;
    content: "";
    height: 10px;
    width: 18px;
    left: 8px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
.post_text
{
  background: #e9ecef;
}
</style>
<?php include('Directory_topmenu.php');?>
   
        <div class="mt-3 mb-3" >
            <!-- <center> 
                <a href="create_post.php" class="btn btn-success">
                    <i class="fas fa-plus"></i>   Create Post
                </a>
            </center> -->
        </div>

       
        <div class="osahan-body">
    <div class="row p-2">
        <?php
        // Fetch filtered orders
          $query = "
        SELECT o.id, o.vehicle_required_datetime, o.trip_type, o.requiredvehicle_type, o.created_at,
               o.vehicle_body_type, o.total_amount, o.Add_sub_category,o.loader_from_place,o.drop_place,o.loader_to_place,o.status,
               a1.dir_area_name AS from_area_name, 
           a2.dir_area_name AS to_area_name,
            d1.dir_city_name AS from_district_name, 
       d2.dir_city_name AS to_district_name,
           sc.Sub_Category_Name,
            s1.name AS from_state_name,
       s2.name AS to_state_name
    FROM orders o

   LEFT JOIN dir_city_master d1 ON o.from_district = d1.dir_city_id
LEFT JOIN dir_city_master d2 ON o.to_district = d2.dir_city_id
LEFT JOIN dir_area_master a1 ON o.from_city = a1.dir_area_id
LEFT JOIN dir_area_master a2 ON o.to_city = a2.dir_area_id
LEFT JOIN dir_state_master s1 ON o.from_state = s1.state_id
LEFT JOIN dir_state_master s2 ON o.to_state = s2.state_id
        LEFT JOIN sub_category sc ON o.Add_sub_category = sc.Sub_Category_id
        LEFT JOIN create_post cp 
          ON o.from_city = cp.area_id or o.from_district = cp.city_id
          AND o.Add_sub_category = cp.subcategory_id
        WHERE o.status != 'completed'
          AND cp.customer_id = '$prof_id'
          AND o.created_at >= DATE_SUB(NOW(), INTERVAL 2 DAY)
        ORDER BY o.created_at DESC
        LIMIT 10
    ";
    

        $result = mysqli_query($config, $query);
        $currentTimestamp = time();
        date_default_timezone_set('Asia/Kolkata'); // Add this at the top of your PHP file

        while ($row = mysqli_fetch_assoc($result)) {
            $orderID = $row['id'];
            $orderDateTime = strtotime($row['created_at']);
            $formattedDate = date("d-m-Y h:i A", $orderDateTime);
            $countdownId = "countdown_" . $orderID;
        
            // Extend time (DB or cookie)
            $extendMinutes = isset($row['extend_time']) ? (int)$row['extend_time'] : 0;
            $cookieKey = "extend_minutes_" . $orderID;
            if (isset($_COOKIE[$cookieKey])) {
                $extendMinutes += (int)$_COOKIE[$cookieKey];
            }
        
            // Final expiration: min(30min + extended, 6hr max)
            $maxExpireTimestamp = $orderDateTime + (6 * 60 * 60);
            $calculatedExpire = $orderDateTime + (30 + $extendMinutes) * 60;
            $expireTimestamp = min($calculatedExpire, $maxExpireTimestamp);
        ?>
            <div class="col-12 col-sm-12 col-md-12 mb-3 p-2 border rounded bg-light">
    <h6 style="color:blue;font-weight: 700;" class="heading_webkit">
        🚚 Order number - <?= $orderID ?>
    </h6>
    <p style="font-weight: 600;">📅 Date - <?= $formattedDate ?> </p>
    <p style="font-weight: 600;">🧭 Trip Type - <?= $row['trip_type'] ?></p>
    <p style="font-weight: 600;">🚘 Vehicle - <?= $row['requiredvehicle_type'] ?>(
        <?= ($row['vehicle_body_type'] === 'Open') ? 'Open Body' : 'Closed Body' ?>)</p>
    <p style="font-weight: 600;">📍 Route - From : <?= $row['from_district_name'] ?> (<?= $row['from_area_name'] ?>,
    <?= $row['loader_from_place'] ?>) To : <?= $row['to_district_name'] ?>
                  
                  (<?= !empty($row['to_area_name']) ? ' ' . $row['to_area_name'] : '' ?>,<?= !empty($row['drop_place']) ? $row['drop_place'] : $row['loader_to_place'] ?>
                  )</p>

    <!-- Countdown -->
    <div id="<?= $countdownId ?>" class="mb-2 text-danger font-weight-bold"></div>

    <?php
    $status = strtolower(trim($row['status']));
    $orderID = $row['id'];

    // Check if the current driver has the accepted bid
    $checkQuery = "SELECT 1 FROM order_driver_bids 
                   WHERE order_id = '$orderID' 
                   AND driver_id = '$prof_id' 
                   AND customer_status = 'accepted' 
                   LIMIT 1";
    $checkResult = mysqli_query($config, $checkQuery);
    $driverHasBid = mysqli_num_rows($checkResult) > 0;

    // Check if any driver was accepted (including others)
    $otherDriverQuery = "SELECT 1 FROM order_driver_bids 
                         WHERE order_id = '$orderID' 
                         AND customer_status = 'accepted' 
                         LIMIT 1";
    $otherResult = mysqli_query($config, $otherDriverQuery);
    $someDriverBooked = mysqli_num_rows($otherResult) > 0;

    $driverQuoteSent = mysqli_num_rows(mysqli_query($config, "
        SELECT 1 FROM order_driver_bids 
        WHERE order_id = '$orderID' 
          AND driver_id = '$prof_id' 
          AND customer_status = 'pending'
        LIMIT 1
    ")) > 0;

    // Determine URL parameters based on status
    if ($status === 'cancelled' || $status === 'driver cancelled' || $status === 'canceled') {
        $viewUrl = "driver_order_view.php?type=cancel&order_id=$orderID";
    } elseif ($status === 'ended') {
        $viewUrl = "driver_order_view.php?type=ended&order_id=$orderID";
    } else {
        $viewUrl = "driver_order_view.php?order_id=$orderID";
    }
    ?>

    <!-- Status Display -->
    <div class="mb-2">
        <?php if ($driverHasBid && $status === 'accepted'): ?>
            <span class="badge badge-info" style="font-size: 14px; padding: 6px 12px;">✅ Accepted</span>
        <?php elseif ($driverHasBid && $status === 'started'): ?>
            <span class="badge badge-primary" style="font-size: 14px; padding: 6px 12px;">🚗 Trip Started</span>
        <?php elseif ($driverHasBid && $status === 'ended'): ?>
            <span class="badge badge-secondary" style="font-size: 14px; padding: 6px 12px;">🏁 Trip Ended</span>
        <?php elseif ($driverQuoteSent && !$driverHasBid): ?>
            <span class="badge badge-warning" style="font-size: 14px; padding: 6px 12px;">📋 Quote Sent to Customer</span>
        <?php elseif ($someDriverBooked && !$driverHasBid): ?>
            <span class="badge badge-danger" style="font-size: 14px; padding: 6px 12px;">❌ Customer booked to another Driver</span>
        <?php elseif ($status === 'cancelled' || $status === 'canceled' || $status === 'driver cancelled'): ?>
            <span class="badge badge-danger" style="font-size: 14px; padding: 6px 12px;">❌ Order Cancelled</span>
        <?php elseif ($status === 'pending'): ?>
            <span class="badge badge-warning" style="font-size: 14px; padding: 6px 12px;">⏳ Pending</span>
        <?php else: ?>
            <span class="badge badge-secondary" style="font-size: 14px; padding: 6px 12px;"><?= ucfirst($status) ?></span>
        <?php endif; ?>
    </div>

    <a href="<?= $viewUrl ?>" class="btn btn-sm btn-outline-primary mb-2">
        🔍 View Order
    </a>


    <!-- Expired Badge -->
    <div id="expired_<?= $orderID ?>" style="display:none;" class="badge badge-danger mb-2">⏰ Expired</div>
    <hr>
</div>

<script>
(function () {
    const countdownEl = document.getElementById("<?= $countdownId ?>");
    const expiredEl = document.getElementById("expired_<?= $orderID ?>");
    const expireTime = <?= $expireTimestamp ?> * 1000;

    function updateCountdown() {
        const now = Date.now();
        const timeLeft = expireTime - now;

        if (timeLeft > 0) {
            const minutes = Math.floor(timeLeft / (1000 * 60));
            const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
            countdownEl.innerHTML = `⏳ Expires in: ${minutes}m ${seconds < 10 ? '0' : ''}${seconds}s`;
        } else {
            countdownEl.innerHTML = '';
            expiredEl.style.display = 'inline-block';
            clearInterval(timer);
        }
    }

    updateCountdown();
    const timer = setInterval(updateCountdown, 1000);
})();
</script>

        <?php } ?>
                         
       
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


        <?php
                    $pro_page = '3';
                include('footermenu.php');?>
                <?php include('menu.php');?> 

     <?php include('menu.php');?> <!-- Bootstrap core JavaScript -->

      <script src="vendor/jquery/jquery.min.js"></script>

      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

      <!-- slick Slider JS-->

      <script type="text/javascript" src="vendor/slick/slick.min.js"></script>

      <!-- Sidebar JS-->

      <script type="text/javascript" src="vendor/sidebar/hc-offcanvas-nav.js"></script>

      <!-- Custom scripts for all pages-->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
      
      <script src="js/osahan.js"></script>
      <script>
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        autoplay: true,
        nav: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });
    $(".owl-prev").html('<i class="fa fa-chevron-left"></i>');
     $(".owl-next").html('<i class="fa fa-chevron-right"></i>');

    </script>
    





<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>


<script>


  $("#main_city").change(function(){
    $('#exampleModalcity').modal('toggle');
  var city=$("#main_city").val();
  var city_name=$("#main_city :selected").text();
  $.ajax({
        type: "POST",
        url: "se_city.php",
        data: {city:city,city_name:city_name}, 
        success: function(data)
        {
         $('#city_name').html( city_name);
        }
    });

});
$("#enq_city").change(function(){
   
  var city=$("#enq_city").val();

  $.ajax({
        type: "POST",
        url: "dir_enq_city.php",
        data: {city:city}, 
        success: function(data)
        {
         $('#enq_earea').html(data);
        }
    });

});

$( document ).ready(function() {

var id=$('#set_city').val();
if(id == 0){
//   $('#exampleModalcity').modal('show'); 
}else{

}
});



function openedit(id){
                    var id;
                   //alert(id);
             
                    $.ajax({
                        type: "POST",
                        url:'post_edit_field.php',
                        data: {id:id}, // serializes the form's elements.
                        success: function(data)
                        {	
                           //alert(data);		
                        $('#postform').html(data);
                        
                        }		
                        	
                    });	
                    

                }

                

                function deletepost(id){
                    var id;
                  // alert(id);
             
                    $.ajax({
                        type: "POST",
                        url:'delete_popup.php',
                        data: {id:id}, // serializes the form's elements.
                        success: function(data)
                        {	
                            //alert(data);		
                        $('#deletepopup').html(data);
                        
                        }		
                        	
                    });	
                    

                }




               




            function openPopup(id){
                    var id;
                   //alert(id);
             
                    $.ajax({
                        type: "POST",
                        url:'city_update.php',
                        data: {id:id}, // serializes the form's elements.
                        success: function(data)
                        {	
                           // alert(data);		
                        $('#citypopup').html(data);
                        
                        }		
                        	
                    });	
                    

                }

                function diablePopup(id){
                    var id;
                   //alert(id);
             
                    $.ajax({
                        type: "POST",
                        url:'disable_update.php',
                        data: {id:id}, // serializes the form's elements.
                        success: function(data)
                        {	
                           // alert(data);		
                        $('#diablepopup').html(data);
                        
                        }		
                        	
                    });	
                    

                }


                function loader(id)
                {
                  var id;
                  $.ajax({
                        type: "POST",
                        url:'loader_popup.php',
                        data: {id:id}, // serializes the form's elements.
                        success: function(data)
                        {	
                           //alert(data);		
                           $('#loaderupdate').html(data);
                        }			
                    });	

                }
                function loaderpopup(id){
                  var id;
                   //alert(id);
                   var loader_from_date = $('#loader_from_date').val();
                   var loader_to_date = $('#loader_to_date').val();
                   var loader_from_place = $('#loader_from_place').val();
                   var loader_to_place = $('#loader_to_place').val();
                   var loader_space = $('#loader_space').val();
                   var loader_remarks = $('#loader_remarks').val();
                   var post_id = $('#post_id').val()
                    $.ajax({
                        type: "POST",
                        url:'loader_popup_insert.php',
                        data: {id:id,loader_from_date:loader_from_date,loader_to_date:loader_to_date,loader_from_place:loader_from_place,loader_to_place:loader_to_place,post_id:post_id,loader_space:loader_space,loader_remarks:loader_remarks}, // serializes the form's elements.
                        success: function(data)
                        {	
                           //alert(data);		
                          //console.log(data);
                           if(data == 1)
                            {
                                    
                                  // $(".alertload").attr("style", "display: block;padding:20px;");
                                  // $(".alertload").delay(1000).fadeOut(500);
                                
                                  // $('.msgload').html("Loader Updated ");   
                                  
                                  Swal.fire({
                                  position: 'center',
                                  icon: 'success',
                                  title: 'Loader Details Updated',
                                  showConfirmButton: false,
                                  timer: 1500
                                  })


                                  setTimeout(function() {
                                    $('#exampleModalloader').modal('hide');
                                    }, 1000);
                                    setTimeout(() => { 
                                            location.reload();
                                    }, 2000);

                            }
                        }			
                    });	
                }



              
                function sub_area(id){
                //alert();
                var id =id;
                var kmid =$('#kmid').val();
            
            $.ajax({
                type: "POST",
                url: "sub_area_post.php",
                data:{id:id,kmid:kmid}, 
                success: function(data)
                {
                  //alert(data);
                $('#subarea1').html(data);

                console.log(data);
                }
            });
            }
</script>


   </body>

</html>
