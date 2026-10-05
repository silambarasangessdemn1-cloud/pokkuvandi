<?php include('config/setup.php');

include('session.php');

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

   
<style>
  @-webkit-keyframes ticker {
  0% {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
    visibility: visible;
  }
  100% {
    -webkit-transform: translate3d(-100%, 0, 0);
    transform: translate3d(-100%, 0, 0);
  }
}
@keyframes ticker {
  0% {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
    visibility: visible;
  }
  100% {
    -webkit-transform: translate3d(-100%, 0, 0);
    transform: translate3d(-100%, 0, 0);
  }
}
.ticker-wrap {
  /* position: fixed; */
  top: 0;
  width: 100%;
  overflow: hidden;
  height: 3rem;
  background-color: rgb(25 155 55);;
  padding-left: 100%;
  margin-bottom: 1px;
}

/* .ticker {
  display: inline-block;
  height: 3rem;
  line-height: 3rem;
  white-space: nowrap;
  padding-right: 100%;
  -webkit-animation-iteration-count: infinite;
  animation-iteration-count: infinite;
  -webkit-animation-timing-function: linear;
  animation-timing-function: linear;
  -webkit-animation-name: ticker;
  animation-name: ticker;
  -webkit-animation-duration: 10s;
  animation-duration: 10s;
} */

.ticker {
    display: inline-block;
    height: 3rem;
    line-height: 3rem;
    white-space: nowrap;
    padding-right: 100%;
    -webkit-animation-iteration-count: infinite;
    animation-iteration-count: infinite;
    -webkit-animation-timing-function: linear;
    animation-timing-function: linear;
    -webkit-animation-name: ticker;
    animation-name: ticker;
}


.ticker_item {
  display: inline-block;
  padding: 0 2rem;
  font-size: 20px;
  color: white;
}




.ticker-wraps {
  /* position: fixed; */
  top: 0;
  width: 100%;
  overflow: hidden;
  height: 3rem;
  background-color: rgb(25 155 55);;
  padding-left: 100%;
  margin-bottom: 1px;
}

.tickers {
    display: inline-block;
    height: 3rem;
    line-height: 3rem;
    white-space: nowrap;
    padding-right: 100%;
    -webkit-animation-iteration-count: infinite;
    animation-iteration-count: infinite;
    -webkit-animation-timing-function: linear;
    animation-timing-function: linear;
    -webkit-animation-name: ticker;
    animation-name: ticker;
}


.ticker_items {
  display: inline-block;
  padding: 0 2rem;
  font-size: 20px;
  color: white;
}


  </style>



   <body class="fixed-bottom-padding">

      <div class="theme-switch-wrapper">

         <label class="theme-switch" for="checkbox">

            <input type="checkbox" id="checkbox" />

            <div class="slider round"></div>

            <i class="icofont-moon"></i>

         </label>

         <em>Enable Dark Mode!</em>

      </div>

      <!-- home page -->
<?php $pro_page=2; ?>
      <div class="osahan">

        <?php include('Directory_topmenu.php');?>

         <!-- body -->

<?php if($session_id !='') { ?>

<?php 
date_default_timezone_set('Asia/Kolkata');

$current_Date = date('Y-m-d');

// check if user has an active post
$main_cate_post = mysqli_query($config, "
    SELECT * 
    FROM create_post 
    WHERE customer_id = '$session_id' 
      AND expiry_date >= '$current_Date'
");
$macate_post = mysqli_fetch_object($main_cate_post);

if ($macate_post) {
?>
    <div class="ticker-wrap">
      <div class="ticker">
        <a style="font-size: 18px; color:white">Pokkuvandi Requirements :</a>
        <?php  
        // only fetch valid trips (date filtering inside SQL)
        $main_cate3_cuss = mysqli_query($config, "
            SELECT * 
            FROM customer_pokkuvandi_entry 
            WHERE update_status = '0'
              AND exp_date   >= '$current_Date'
              AND from_date >= '$current_Date'
            ORDER BY cus_pokkuvandi_entry_id DESC
        ");

        while ($macate3_cuss = mysqli_fetch_object($main_cate3_cuss)) {
            $newDate = date("d-m-Y", strtotime($macate3_cuss->from_date));
        ?>
            <a href="customer_pokkuvandi_entry_list.php?id=<?php echo $macate3_cuss->cus_pokkuvandi_entry_id ?>">
              <div class="ticker_item">
                Date: <?php echo $newDate ?>,
                Pick Up Place: <?php echo $macate3_cuss->place ?>,
                Drop Place: <?php echo $macate3_cuss->to_place ?>,
                Vehicle Type: <?php echo $macate3_cuss->vehicle_type ?>
              </div>
            </a>
        <?php } ?>
      </div>
    </div>
<?php 
} }
?>



<?php 
 if($macate_post!='')
 {
 
?>
<div class="ticker-wraps">
          <div class="tickers">
            <a style="font-size: 18px;color:white">Message : </a>
      <?php  
      // echo $query="select * from comman_messages where type='1' and status ='1' order by (message_id) DESC";
      $main_cate3_msg=mysqli_query($config,"select * from comman_messages where type='1' and status ='1' order by (message_id) DESC");
      while($macate3_msg=mysqli_fetch_object($main_cate3_msg))
      {
     
      ?>

        
            <div class="ticker_items"><?php echo $macate3_msg->comman_messages?></div>
        
    <?php } ?>

          </div>
        </div>

<?php } else { ?>


  <div class="ticker-wraps">
          <div class="tickers">
            <a style="font-size: 18px;color:white">Message : </a>
      <?php  
      $main_cate3_msg=mysqli_query($config,"select * from comman_messages where type='0' and status ='1' order by (message_id) DESC");
      while($macate3_msg=mysqli_fetch_object($main_cate3_msg))
      {
     
      ?>

        
            <div class="ticker_items"><?php echo $macate3_msg->comman_messages?></div>
        
    <?php } ?>

          </div>
        </div>

<?php } ?>






         <div class="osahan-body">

       

         <div class="py-3 bg-white osahan-promos shadow-sm">

    

               <div class="promo-slider">

               <?php 

											$mc=1;

											$main_cate=mysqli_query($config,"select * from dir_slider");

											while($macate=mysqli_fetch_object($main_cate))

											{

											?>

                  <div class="osahan-slider-item m-2">

                    
                     <a href="<?php echo $macate->dir_link ?>"> <img src="img/dir/<?php echo $macate->dir_image ?>" class="img-fluid mx-auto rounded" alt="Responsive image"></a>

                  </div>

                  <?php }?>

               </div>
            </div>

            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class=" osahan-categories " style="margin: 2%;">

<h6 class="mb-2 ml-3"><?php echo $macate->title ?></h6>

<p class="mb-3 mt-3 text-center text-white" style="background: #199b37;padding: 10px;font-size: 19px;font-weight: 700;">Search Here...</p>


<div class="row m-0">                 
<?php

											$main_cate3=mysqli_query($config,"select * from main_category  where Main_Category_Status = '1' order by (Main_Category_id ) ASC");

											while($macate3=mysqli_fetch_object($main_cate3))

											{

											?>
   <div class="col-4 p-1">

      <div style="height: 112px;" class="bg-white shadow-sm rounded text-center  px-2 py-3 c-it">

         <a href="Directory_subcate.php?mid=<?php echo $macate3->Main_Category_id ?>&keyword=<?php echo $macate3->Main_Category_Name?>">

            <img src="photos/Category/<?php echo $macate3->Main_Category_image?>" class="img-fluid px-2">

            <p class="m-0 pt-2 text-muted text-center"><?php echo $macate3->Main_Category_Name?></p>

         </a>

      </div>

   </div>
<?php }?>


 
<div class="col-4 p-1">

      <div style="height: 112px;" class="bg-white shadow-sm rounded text-center  px-2 py-3 c-it">

         <a href="loader_list.php">

            <img src="photos/Category/../../../photos/Sub_Category/Commercial Vehicle Lorry.png" class="img-fluid px-2">

            <p class="m-0 pt-2 text-muted text-center"> Return Trip Vehicle List</p>

         </a>

      </div>

   </div>


   <div class="col-4 p-1">

      <div style="height: 112px;" class="bg-white shadow-sm rounded text-center  px-2 py-3 c-it">

         <a href="job_search_sub.php">

            <img src="job-search.png" class="img-fluid px-2">

            <p class="m-0 pt-2 text-muted text-center">Job Search</p>

         </a>

      </div>

   </div>
   </div>
   <?php
// session_start() is already called in session.php if included, no need to call again
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$isLoggedIn = isset($session_id) ? 'true' : 'false'; // 👈 Convert PHP session into JS boolean
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<p class="mb-3 mt-3 text-center text-white" style="background: #199b37;padding: 10px;font-size: 19px;font-weight: 700;">Short Cuts...</p>

<div class="row m-0">
<?php
$shortcuts = mysqli_query($config, "SELECT * FROM shortcuts ORDER BY shortcut_id DESC");
while ($row = mysqli_fetch_object($shortcuts)) {
?>
    <div class="col-4 p-1">
        <div style="height: 112px;" class="bg-white shadow-sm rounded text-center px-2 py-3 c-it">
            <a href="javascript:void(0);" class="shortcut-link" data-url="<?php echo $row->target_url; ?>">
                <img src="<?php echo '../Admin/Main/'.$row->image_url; ?>" class="img-fluid px-2" alt="<?php echo $row->name; ?>">
                <p class="m-0 pt-2 text-muted text-center"><?php echo $row->name; ?></p>
            </a>
        </div>
    </div>
<?php } ?>
</div>

<script>
  const isLoggedIn = <?php echo $isLoggedIn; ?>;

  document.querySelectorAll('.shortcut-link').forEach(link => {
    link.addEventListener('click', function () {
      const targetURL = this.getAttribute('data-url');

      if (isLoggedIn) {
        window.location.href = targetURL;
      } else {
        Swal.fire({
          title: "Login Required",
          text: "Please login to access this shortcut.",
          icon: "warning",
          confirmButtonText: "Login Now"
        }).then(result => {
          if (result.isConfirmed) {
            window.location.href = "signin.php"; // 👉 Update if your login page is different
          }
        });
      }
    });
  });
</script>


   <!-- <div class="col-4 p-1">

      <div style="height: 112px;" class="bg-white shadow-sm rounded text-center  px-2 py-3 c-it">

         <a href="machineary.php">

            <img src="photos/Category/../../../photos/Category/download (7).jpg" class="img-fluid px-2">

            <p class="m-0 pt-2 text-muted text-center">Machinery </p>

         </a>

      </div>

   </div> -->




</div>

   </body>

      <!-- Footer -->

   <?php include('footermenu.php');?>

     <?php include('menu.php');?> <!-- Bootstrap core JavaScript -->

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



<style>

   .slick-slide img {

    display: block;
width: 100%;
    height: 100%;

}

</style>





<script>

   var currentscrollHeight = 0;

var count = 0;

jQuery(document).ready(function ($) {

    for (var i = 0; i < 8; i++) {

        callData(count);//Call 8 times on page load

        count++;

    }

});

$(window).on("scroll", function () {

    const scrollHeight = $(document).height();

    const scrollPos = Math.floor($(window).height() + $(window).scrollTop());

    const isBottom = scrollHeight - 100 < scrollPos;

    if (isBottom && currentscrollHeight < scrollHeight) {

        //alert('calling...');

        for (var i = 0; i < 6; i++) {

            callData(count);//Once at bottom of page -> call 6 times

            count++;

        }

        currentscrollHeight = scrollHeight;

    }

});

function callData(counter) {

    $.ajax({

        type: "GET",

        url: "promo_video.php",

        dataType: "json",

        success: function (result) {

            // alert(result['vid']);

            $('<div class="card my-4 py-3"><h4 class="card-title">' + result[0] + '</h4><p>' + counter + '</p></div>').appendTo('.list');

        },

        error: function (result) {

            //alert("error");

            $('<div class="card my-4 py-3"><h4 class="card-title">API call failed</h4><p>' + counter + '</p></div>').appendTo('.list');

        }

    });

}



</script>



<style>

   iframe{

      width:100%;

      height:200px;

      padding: 1%;

   }

   .card{

      padding: 2%;

   }

   .complete{



display:none;



}
.r_less{
   display:none; 
}
.modal {

   position: fixed;
    top: 0;
    left: 0;
    padding: 1%;
    z-index: 1050;
    /* padding-bottom: 21%; */
    display: none;
    width: 99%;
    height: 71%;
    overflow: hidden;
    outline: 0;
    outline: 0;

}

.b_title{

   text-align:center;

}

</style>



<script>



function more(id) {

   

// alert(id);

      $("#sb_t"+id).attr("style", "display: none;");



      $("#f_t"+id).attr("style", "display: block;");



      $("#more"+id).attr("style", "display: none;");
      $("#less"+id).attr("style", "display: block;float: right;");


      }


      function less(id) {

   

// alert(id);

      $("#sb_t"+id).attr("style", "display: block;");



      $("#f_t"+id).attr("style", "display: none;");



      $("#more"+id).attr("style", "display: block;float: right;");
      $("#less"+id).attr("style", "display: none;float: right;");


      }

      





      document.addEventListener("DOMContentLoaded", function() {
    var tickerItem = document.querySelector('.ticker_item');
    var ticker = document.querySelector('.ticker');
    
    if (tickerItem && ticker) {
        // Calculate duration based on content width and animation speed
        var contentWidth = tickerItem.offsetWidth;
        var animationSpeed = 30; // Speed of animation (in pixels per second)
        var animationDuration = contentWidth / animationSpeed;

        // Set the animation duration dynamically
        ticker.style.animationDuration = animationDuration + 's';
    }
});

document.addEventListener("DOMContentLoaded", function() {
    var tickerItem = document.querySelector('.ticker_items');
    var ticker = document.querySelector('.tickers');
    
    if (tickerItem && ticker) {
        // Calculate duration based on content width and animation speed
        var contentWidth = tickerItem.offsetWidth;
        var animationSpeed = 50; // Speed of animation (in pixels per second)
        var animationDuration = contentWidth / animationSpeed;

        // Set the animation duration dynamically
        ticker.style.animationDuration = animationDuration + 's';
    }
});





 document.addEventListener("DOMContentLoaded", function() {
    var tickerItem = document.querySelector('.ticker_item');
    var ticker = document.querySelector('.ticker');
    
    if (tickerItem && ticker) {
        // Calculate duration based on content width and animation speed
        var contentWidth = tickerItem.offsetWidth;
        var animationSpeed = 30; // Speed of animation (in pixels per second)
        var animationDuration = contentWidth / animationSpeed;

        // Set the animation duration dynamically
        ticker.style.animationDuration = animationDuration + 's';
    }
});
</script>

<?php 
  $inro_logo22=mysqli_query($config,"SELECT * FROM `lee_master`");

$logo22=mysqli_fetch_object($inro_logo22);

  ?>



<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel">Enquiry</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <div class="modal-body">

      <form Method='POST' id='cform'>

      <div class="form-group">

    <label for="exampleInputEmail1">Name</label>

    <input type="text" name='name' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $session__username;?>" placeholder="" required>
    <input type="hidden" name='send_email' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value='<?php echo $logo22->Email_id ?>' >

  </div>

  <div class="form-group">

<label for="exampleInputEmail1">E-Mail Address</label>

<input type="email" name='email' class="form-control" id="exampleInputEmail1"  aria-describedby="emailHelp" value="<?php echo $session__mail;?>" placeholder="" >

</div>
<div class="form-group">

<label for="exampleInputEmail1">City</label>
<select id="enq_city" name="enq_city" class="form-select form-control form-select-lg mb-3" aria-label=".form-select-lg example">

  <?php

											$main_cate3=mysqli_query($config,"SELECT * FROM `dir_city_master` ORDER BY `dir_city_master`.`dir_city_name` ASC");

											while($macate3=mysqli_fetch_object($main_cate3))

											{

											?>
  <option  value="<?php echo $macate3->dir_city_id ?>"><?php echo $macate3->dir_city_name ?></option>
<?php }?>
</select>  
</div>
<div class="form-group">
<label for="exampleInputEmail1">Area</label>
<div id="enq_earea">
<select id="" name="enq_area" class="form-select form-control form-select-lg mb-3" aria-label=".form-select-lg example">

  <?php

											$main_cate3=mysqli_query($config,"SELECT * FROM `dir_area_master` where dir_cityid='".$_SESSION["city"]."' ORDER BY `dir_area_master`.`dir_area_name` ASC ");

											while($macate3=mysqli_fetch_object($main_cate3))

											{

											?>
  <option  value="<?php echo $macate3->dir_area_id ?>"><?php echo $macate3->dir_area_name ?></option>
<?php }?>
</select>  
</div>
</div>
  <div class="form-group">

    <label for="exampleInputPassword1">Phone Number</label>

    <input type="number" name='phone' class="form-control" id="exampleInputPassword1" value="<?php echo $session__phone; ?>"  placeholder="" required>

  </div>

  <div class="form-group">

    <label for="exampleInputPassword1">Message</label>

    <textarea name='msg' class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>  </div>

 

  <button type="submit" class="btn btn-primary">Submit</button>  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>



</form>

      </div>

    

    </div>

  </div>

</div>



<script>

   $("#cform").submit(function(e) {



e.preventDefault(); // avoid to execute the actual submit of the form.



var form = $(this);

var actionUrl = 'bussiness_contact.php';

// $("#exampleModal").modal('hide');

$.ajax({

    type: "POST",

    url: actionUrl,

    data: form.serialize(), // serializes the form's elements.

    success: function(data)

    {

      // alert(data); 

      if(data == 1)

      {

         $('#cform')[0].reset();

         // $('#modal').modal('hide');

        //  $('.modal').modal('toggle'); 

         $("#exampleModal").modal('toggle');

         // setTimeout(function(){ $(".alert").show(); }, 3000); 
         $(".alert").attr("style", "display: block;");


// Show the div in 5s
$(".alert").delay(3000).fadeOut(500);
      }

    }

});



});


$( document ).ready(function() {

  var id=$('#set_city').val();
  if(id == 0){
    // $('#exampleModalcity').modal('show'); 
  }else{
 
  }
});

   </script>

<div class="modal fade modal-dialog-centere" id="exampleModalcity" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="height: 100%;">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Choose your District</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <img src="city1.jpg" style="width: 100%;">
       <div class="form-group mt-5">
    <label for="exampleInputPassword1">District</label>
    <input type="hidden" id="set_city" value="<?php echo $_SESSION["city"] ?>">
    <select id="main_city" class="form-select form-control form-select-lg mb-3" aria-label=".form-select-lg example">
  <option value="0" selected>Select District</option>
  <?php

											$main_cate3=mysqli_query($config,"SELECT * FROM `dir_city_master`");

											while($macate3=mysqli_fetch_object($main_cate3))

											{

											?>
  <option <?php if($_SESSION["city"] == $macate3->dir_city_id ){ echo 'selected';} ?> value="<?php echo $macate3->dir_city_id ?>"><?php echo $macate3->dir_city_name ?></option>
<?php }?>
</select>  </div>
      </div>
     
    </div>
  </div>
</div>




<div class="modal fade modal-dialog-centere" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="margin-top:3rem">
    <div class="modal-content" style="height: 100%;border-radius: 27px !important">
      <div class="modal-header" >
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
      </div>
      <div class="modal-body">
       <div class="form-group mt-5">
            <div  class="text-center">  
              <img src="front_pop.png" style="width: 60%;">              
              <h5 class="modal-title" id="exampleModalLabel">Do You Want Register Your Vehicle? </h5>       
              <span class="text-center " ><a href="create_post.php" class="btn btn-primary mt-4 text-white" style="width: 45% !important;font-size: 20px !important;">Yes </a> <a onclick="close_newpop();" class="btn btn-primary mt-4 text-white" style="width: 45% !important;font-size: 20px !important;">No </a></span>
       
     
            </div>
          

       </div>
      </div>
     
    </div>
  </div>
</div>




<?php
$about_q = mysqli_query($config,"select fron_contanct from cms");
$del_content = mysqli_fetch_array($about_q);
$popup_text = $del_content ? trim(strip_tags(str_replace('&nbsp;', '', $del_content[0]))) : '';
$has_image = $del_content ? strpos($del_content[0], '<img') !== false : false;
$show_popup = ($popup_text != '' || $has_image) ? true : false;
$popup_hash = $del_content ? md5($del_content[0]) : '';
?>
<?php if($show_popup) { ?>
<div class="modal fade" id="contentPopupModal" tabindex="-1" role="dialog" aria-labelledby="contentPopupModalLabel" aria-hidden="true" style="z-index: 9999;">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15); overflow: hidden;">
      <div class="modal-header" style="background: linear-gradient(135deg, #199b37, #21c045); color: white; border-bottom: none; padding: 20px 25px;">
        <h5 class="modal-title" id="contentPopupModalLabel" style="font-weight: 700; font-size: 1.25rem; letter-spacing: 0.5px;">📢 Announcement</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closePopup()" style="color: white; opacity: 0.8; text-shadow: none; font-size: 1.5rem;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center" style="padding: 30px 25px; font-size: 1.05rem; line-height: 1.6; color: #444;">
        <?php echo $del_content[0]; ?>
      </div>
      <div class="modal-footer justify-content-center" style="border-top: 1px solid #f0f0f0; padding: 15px 25px; background-color: #fafafa;">
        <button type="button" class="btn btn-modern" data-dismiss="modal" onclick="closePopup()" style="background-color: #199b37; color: white; border-radius: 8px; padding: 8px 24px; font-weight: 600; border: none;">Got it!</button>
      </div>
    </div>
  </div>
</div>
<?php } ?>


  <?php 
  if($_GET['msg']=='newlogin')
  {
    if($_SESSION['popupmsg'] == '')
    {
       $_SESSION['popupmsg'] =1;

    ?>
    <script>
    $( document ).ready(function() {
      $('#myModal').modal('show');
    });
    </script>
  <?php
  

  } 

}

  ?>
    <script>
  
function close_newpop()
  {
    $('#myModal').modal('hide');
  }
  </script>

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
</script>


<!-- Static Vehicle Image Update Modal -->
<div class="modal fade" id="vehicleImageUpdateModal" tabindex="-1" role="dialog" aria-labelledby="vehicleImageUpdateModalLabel" aria-hidden="true" style="z-index: 10000; background: rgba(0,0,0,0.5);">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="border-radius: 15px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
      <div class="modal-header" style="background-color: #ffc107; color: #333; border-bottom: none; border-radius: 15px 15px 0 0;">
        <h5 class="modal-title" id="vehicleImageUpdateModalLabel">⚠️ Action Required</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#vehicleImageUpdateModal').modal('hide');">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center" style="padding: 30px;">
        <p style="font-size: 1.1rem; color: #555; margin-bottom: 10px;">Due to a recent system update, some vehicle images were lost.</p>
        <p style="margin-bottom: 0;">Please upload your vehicle photos again to ensure your listings stay active.</p>
      </div>
      <div class="modal-footer justify-content-center" style="border-top: none;">
        <a href="createpost_list.php" class="btn btn-primary btn-block rounded shadow-sm" style="background: linear-gradient(135deg, #007bff, #0056b3); border: none; padding: 10px 25px;">Update Photos Now</a>
      </div>
    </div>
  </div>
</div>

<script>
        function getCookie(name) {
            var v = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
            return v ? v[2] : null;
        }

        <?php if($show_popup) { ?>
        function closePopup() {
            $('#contentPopupModal').modal('hide');
        }
        <?php } ?>

        $(document).ready(function() {
            <?php if($show_popup) { ?>
            var currentHash = "<?php echo $popup_hash; ?>";
            var popupCookie = getCookie('app_popup_hash');

            if (popupCookie !== currentHash) {
                setTimeout(function() {
                    $('#contentPopupModal').modal('show');
                }, 500);
                document.cookie = "app_popup_hash=" + currentHash + "; path=/; max-age=31536000";
            }
            <?php } ?>

            // Show Vehicle Image Update Modal on EVERY page load
            setTimeout(function() {
                $('#vehicleImageUpdateModal').modal('show');
            }, 1000);
        });
</script>

   

<script>
document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    const scrollTo = urlParams.get('scroll');

    if (scrollTo === 'bottom') {
        window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
    }
});
</script>





<!-- 
<script>

$(document).ready(function(){

  $("#catesearch1").keyup(function(){

    var text=$('#catesearch1').val();

   //  alert(text);

   $.ajax({

    type: "POST",

    url: 'youtubevideo.php',

    data: {text : text}, // serializes the form's elements.

    success: function(data)

    {

      $('#result').html(data);

      // alert(data)

      $('.sresults').html('')

    }

});



  });



});

</script>
 -->


<!-- <script>

   function list(text)

   {

   //   alert(text) 

     $('.sresults').html('')

     $('#catesearch1').val(text);

   }

</script> -->


<!-- 
<script>

$(document).ready(function(){

  $("#catesearch1").keyup(function(){

    var text=$('#catesearch1').val();

     alert(text);

   $.ajax({

    type: "POST",

    url: 'video_category.php',

    data: {text : text}, // serializes the form's elements.

    success: function(data)

    {

      $('#search').html(data);

      // alert(data)

    }

});



  });



});

</script> -->