<?php include('config/setup.php');
 include('session.php');
 $mid=$_REQUEST['mid'];
 $sid=$_REQUEST['sid'];
 $_SESSION['sid']=$sid;
 $_SESSION['mid']=$mid;
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

      <!-- Slick Slider new -->

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



      <script src="
      https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js
      "></script>
      <link href="
      https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css
      " rel="stylesheet">
      
<style>

.card {
    position: relative;
    display: -ms-flexbox;
    display: flex
;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: none !important;
    background-clip: border-box;
    border: none !important;
    border-radius: .25rem;
}

.table th, .table td {
    padding: 8px !important;  /* Adjust padding for better spacing */
    font-size: 14px;          /* Set font size */
    vertical-align: middle !important; /* Ensure vertical centering */
    text-align: left !important; /* Keep text aligned to the left */
}
th{
  width:30%;
}


</style>

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

      <!-- home page -->
<?php $pro_page=2; ?>
      <div class="osahan">

        <?php include('Directory_topmenu.php');?>

         <!-- body -->
         <?php
// Get the state from the GET parameter if set
$state1 = isset($_GET['state']) ? $_GET['state'] : ''; // Default empty state if not set
$trip_status  = isset($_GET['trip_status']) ? $_GET['trip_status'] : ''; // Default empty trip status if not set
?>

<div class="card">
    <div style="text-align: center; margin-top: 1rem;">
        <h5>Please Select From State Name</h5>
        <div class="row">
            <div class="col-md-6">
                <!-- State Selection Form -->
                <form method="GET" action="">
                    <select required class="form-control" id="state" name="state" onchange="this.form.submit()">
                        <option value="">---SELECT STATE---</option>
                        <?php
                        $state_query = mysqli_query($config, "SELECT * FROM dir_state_master");
                        while ($state = mysqli_fetch_object($state_query)) {
                            $selected = ($state->state_id == $state1) ? 'selected="selected"' : '';
                            echo "<option value='{$state->state_id}' $selected>{$state->name}</option>";
                        }
                        ?>
                    </select>
                </form>
            </div>

            <div style="justify-content: center; align-items: center; display: flex;" class="col-md-6 mt-5">
                <!-- Trip Status Radio Buttons -->
                <form method="GET" action="">
                    <!-- Include selected state in the URL to retain state selection -->
                    <input type="hidden" name="state" value="<?php echo $state1; ?>">

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="trip_status" id="active" value="active" <?php echo ($trip_status == 'active') ? 'checked' : ''; ?> onchange="this.form.submit()">
                        <label class="form-check-label" for="active">Active</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="trip_status" id="completed" value="completed" <?php echo ($trip_status == 'completed') ? 'checked' : ''; ?> onchange="this.form.submit()">
                        <label class="form-check-label" for="completed">Completed</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="trip_status" id="cancelled" value="cancelled" <?php echo ($trip_status == 'cancelled') ? 'checked' : ''; ?> onchange="this.form.submit()">
                        <label class="form-check-label" for="cancelled">Cancelled</label>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

          <script>
    document.getElementById('state_status').addEventListener('change', function () {
        const selectedValue = this.value;
        if (selectedValue !== "0") {
            // Redirect to the current page with the selected value as a query parameter
            window.location.href = `${window.location.pathname}?state_status_front=${selectedValue}`;
        }
    });
</script>
               <!-- <form id="search">
                              <div  class="input-group m1-1 rounded shadow-sm overflow-hidden bg-white">
                               
                                 <input id="keyword" name="keyword" style="background-color: white;" list="heroes" type="text" id="catesearch1" class="shadow-none border-0 form-control pl-0 " placeholder=" &nbsp;Enter area name.. " aria-label="" aria-describedby="basic-addon1"><i style="margin-top: 10px;margin-right: 10px;"class="fa fa-search" ></i>
               <datalist id="heroes" style="overflow-y: scroll;height:100px;" >
               
                    
               </datalist></div>
               </form> -->
               </div>
      

         <div class="osahan-body">

     
<div class="row m-0 mt-2">



<div class="col-12">
<span style="
    position: relative;
    top: 2px;
    left: 0%;
    font-size:17px;
    color:#000;
    margin: 2%;
"><?php echo $_GET['keyword'] ?></span> 

</div>
<!-- <div class="col-6 text-center" style="    background: #e9ecef;
    border: 0.5px solid #dee2e6;">

    <div class="row " style=" background: #e9ecef; ">
        <div class="col-12 text-center ">
        <label class="">State</label>
          <select class="form-control" id="state_status" onchange="state_cha(this.value)" name="state_status">
              <option value="0">--SELECT--</option>
              <option value="1">Tamilnadu Trip</option>
              <option value="2">Other State Trip </option>                                                    
          </select>
        </div>
    </div>

    </div>  -->


<!-- <div class="col-6 text-center" style="    background: #e9ecef;
    border: 0.5px solid #dee2e6;">

    <div class="row " style=" background: #e9ecef; ">
        <div class="col-12 text-center ">
          <label class="">District</label>
        </div>
    </div>

    <div data-toggle="modal" data-target="#exampleModalcity" class="fiter" style="margin:4%;"> <span id="farea" ><?php echo $_SESSION["city_name"] ?></span> &nbsp;<i class="fa fa-angle-down"></i></div> 
</div>  -->

<!-- <div class="col-4 text-center" style="background: white;border: 0.5px solid #dee2e6;"> 

    <div class="row " style=" background: #e9ecef; ">
        <div class="col-12 text-center ">
          <label class="">City</label>
        </div>
    </div>

    <?php 
   
     $city=$_SESSION["city"];
     $nn="SELECT * FROM `dir_area_master` where dir_cityid='$city' ";
     $main_cate33=mysqli_query($config,$nn);
    
   ?>
  
    <div id="fa" class="fiter">
      <select id='sarea' class="form-select form-control" aria-label="Default select example" onchange="sub_area(this.value);">
  <option value=""  selected>Select City</option>
  <option value="1" >All</option>
<?php
while($macate33=mysqli_fetch_object($main_cate33))
                      { 
                         $_SESSION["dir_area_id"] = $macate33->dir_area_id ; 
                        
                        $dir_area_id=$_SESSION["dir_area_id"];
                        ?>
  <option value="<?php echo $macate33->dir_area_id ?>"><?php  echo $macate33->dir_area_name?></option>
<?php }?>
</select>
</div> 

</div> -->


<!-- <div class="col-4" style="background: white;border: 0.5px solid #dee2e6;"> 

    <div class="row " style=" background: #e9ecef; ">
        <div class="col-12 text-center ">
          <label class="">Area</label>
        </div>
    </div>

    <?php 

      $nn="SELECT * FROM `sub_area_master` ";
     $main_cate33=mysqli_query($config,$nn);
   ?>
    <div  id="sa" class="fiter">
      <select id='subarea' class="form-select form-control" aria-label="Default select example">
  <option value=""  selected>Select Area</option>

</select>
</div> 

</div> -->




<!-- <div class="col-4" style="background: white;border: 0.5px solid #dee2e6;"> 
    <?php 
      $nn="SELECT * FROM `sub_category_filter` where 	Sub_Category_id	='$mid'";
     $main_cate33=mysqli_query($config,$nn);
   ?>
    <div id="top" class="fiter">
      <select id='topfilter' class="form-select form-control" aria-label="Default select example">
  <option value=""  selected>Filter</option>
<?php
while($macate33=mysqli_fetch_object($main_cate33))
                      { ?>
  <option value="<?php echo $macate33->filter_id ?>"><?php  echo $macate33->name?></option>
<?php }?>
</select>
</div> 

</div> -->


  </div>

            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        

            <div class="card">
                         
            </div>

          </div>

          <div class="m-2"> 

<?php
    $or_="SELECT * FROM `sub_category` where Sub_Category_id ='$sid' Order by Sub_Category_id  DESC ";
    $maincate3_=mysqli_query($config,$or_);       
    $mac3_=mysqli_fetch_object($maincate3_);  

     $or__="SELECT * FROM `main_category` where Main_Category_id ='$mac3_->Main_Category' Order by Main_Category_id  DESC ";
      $maincate3__=mysqli_query($config,$or__);       
      $mac3__=mysqli_fetch_object($maincate3__);  
  ?>

<!-- <div class="crump">
    <div class="container">
      <nav style="--bs-breadcrumb-divider: '/'" aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color:#f0f2f5 !important;"> 
          <li style="margin-left: -23px;color:#e23e57;" class="breadcrumb-item"><a href="Directory.php">Home</a></li>
          <li class="breadcrumb-item"><a href="Directory.php"><?php echo $mac3__->Main_Category_Name?></a></li>
          <li class="breadcrumb-item"><a href="Directory_subcate.php?mid=<?php echo $mac3__->Main_Category_id?>&Main_Category_Name=<?php echo $mac3__->Main_Category_Name?>"><?php echo $mac3_->Sub_Category_Name?></a></li>
        
        </ol>
      </nav>
    </div>
  </div> -->

<input type="hidden" name='mid' class="form-control" id="mid" aria-describedby="emailHelp" value="<?php echo $_GET['mid']?>" placeholder="" >
<h5 class="text-center">Customer Vehicle Required List</h5>
<div class="" id="arearesult">
    <?php

$state = isset($_GET['state']) ? $_GET['state'] : ''; // Default empty state if not set
$trip_status = isset($_GET['trip_status']) ? $_GET['trip_status'] : ''; // Default empty trip status if not set

// Start building the query
$or__ = "SELECT * FROM `customer_pokkuvandi_entry` WHERE 1";

// If the session ID is available, filter by cust_id
if ($session_id) {
    $or__ .= " AND cust_id='" . $session_id . "'";
}

// If a state is selected, add the filter for state
if ($state) {
    $or__ .= " AND from_state_id='" . $state . "'";
}

// If a trip status is selected, add the filter for trip_status
if ($trip_status) {
    if ($trip_status == 'active') {
        // If the trip_status is 'active', we also treat null as 'active'
        $or__ .= " AND (trip_status IS NULL OR trip_status = 'active')";
    } else {
        // For other trip statuses like 'completed' or 'cancelled', filter normally
        $or__ .= " AND trip_status='" . $trip_status . "'";
    }
}

// Add a filter for update_status
//$or__ .= " AND update_status = 0";

// Sort the results by from_date and cus_pokkuvandi_entry_id
$or__ .= " ORDER BY from_date DESC, cus_pokkuvandi_entry_id DESC";

// Execute the query
$maincate__ = mysqli_query($config, $or__);
  
   while($mac__=mysqli_fetch_object($maincate__))
   {
     $exp_date = $mac__->expiry_date;
     $post_id  = $mac__->post_id ;
   $current_Date=date('Y-m-d');
   $exp_date = $mac__->exp_date;
   $editon=date('Y-m-d');

   $originalDate = $mac__->from_date;
   $newDate = date("d-m-Y H:i a", strtotime($originalDate));


   $main_cate=mysqli_query($config,"select * from dir_city_master where dir_city_id='$mac__->from_district'");
   $addsubcate=mysqli_fetch_object($main_cate);
   
   $main_cate_to=mysqli_query($config,"select * from dir_city_master where dir_city_id='$mac__->to_district' ");
   $addsubcate_to=mysqli_fetch_object($main_cate_to);
   $dir_state_master=mysqli_query($config,"select * from dir_state_master where state_id='$mac__->from_state_id' ");
  
   $dir_state_master_to=mysqli_fetch_object($dir_state_master);
   $to_state_id=mysqli_query($config,"select * from dir_state_master where state_id='$mac__->to_state_id' ");
   $to_state_id1=mysqli_fetch_object($to_state_id);
   if($exp_date > $editon)
   {

    ?> 
  
    <style>
    
        .table-bordered {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add shadow */
            background-color: white;
        }
    </style>
        <div class="card" style="width: 100%; padding: 0%;margin-bottom:12px;">
           <div class="card-body" style="padding:1px">            
                <div class="row"> 
                  <div class="col-12 text-center"> 
                 
                <table class="table table-bordered" style="text-align: left;" >
              <!-- <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">First</th>
                  <th scope="col">Last</th>
                  <th scope="col">Handle</th>
                </tr>
              </thead> -->
              <tbody  class="tbl_space">
                <tr >
                  <th scope="row">State Type</th>
                  <?php if($mac__->state == 1) { ?>
                  <td>Within  State Trip </td>
                  <?php } else { ?>
                    <td>Other State Trip </td>
                    <?php } ?>
                  
                </tr>
                <tr >
                <th scope="row">State</th>
    <td>
        <?php
        if ($mac__->state == 1) {
            echo "From State: " . $dir_state_master_to->name;
        } else {
            echo "From State: " . $dir_state_master_to->name . " - To State: " . $to_state_id1->name;
        }
        ?>
    </td>
                  
                </tr>
                <?php if($mac__->state == 1) { ?>
                <tr>
                  <th scope="row"> Pick Up Place</th>
                  <td><?php echo $mac__->place?> (<?php echo $addsubcate->dir_city_name?> District)</td>
                </tr>

                <tr>
                  <th scope="row"> Delivery Place</th>
                  <td><?php echo $mac__->to_place?> (<?php echo $addsubcate_to->dir_city_name?> District)</td>
                </tr>
                <?php }  else { ?>
                  <tr>
                  <th scope="row"> Pick Up Place</th>
                  <td><?php echo $mac__->place?>(<?php echo $addsubcate->dir_city_name?> District)</td>
                </tr>

                <tr>
                  <th scope="row"> Delivery Place</th>
                  <td><?php echo $mac__->to_place?> (<?php echo $addsubcate_to->dir_city_name?> District)</td>
                </tr>
                  <?php } ?>


                <tr>
                  <th scope="row">Vehicle Model</th>
                  <td> <?php echo $mac__->vehicle_type?></td>
                </tr>
                <tr>
                  <th scope="row">Vehicle Type</th>
                  <td> <?php echo $mac__->vehicle_type_cpe?></td>
                </tr>
                <tr>
                  <th scope="row">Trip Date</th>
                  <td><?php echo $newDate?></td>
                </tr>

                <tr>
                  <th scope="row">Customer Name</th>
                  <td><?php echo $mac__->Customer_Name?></td>
                </tr>
                <tr>
                  <th scope="row">Contact number</th>
                  <td><?php echo $mac__->Customer_Phone_No?></td>
                </tr>

                <tr>
                  <th scope="row">Load Details</th>
                  <td><?php echo $mac__->general_remarks?></td>
                </tr>
                <tr>
    <th scope="row">Post Date</th>
    <td>
        <?php 
        if (!empty($mac__->post_date)) {
            echo date("d-m-Y", strtotime($mac__->post_date));
        } else {
            echo "N/A"; // Display "N/A" if the date is not set
        }
        ?>
    </td>
</tr>

                <tr>
  <th scope="row">Trip Statu</th>
  <td>
    <?php
     if ($mac__->trip_status == null &&  $mac__->update_status == 0) {
      // If status is null or update_status is 0, consider it Active
      $status_class = 'btn-success';  // Active - Green button
      $status_text = 'Active';
  } elseif ($mac__->trip_status == 'completed') {
      // If status is completed, consider it Completed
      $status_class = 'btn-success';  // Completed - Green button
      $status_text = 'Completed';
  } elseif ($mac__->trip_status == 'cancelled') {
      // If status is cancelled, consider it Cancelled
      $status_class = 'btn-danger';   // Cancelled - Red button
      $status_text = 'Cancelled';
  } elseif ($mac__->update_status == 1) {
      // If update_status is 1, consider it Inactive
      $status_class = 'btn-danger';   // Inactive - Red button
      $status_text = 'Inactive';
  } else {
      // Default case for any other status values
      $status_class = 'btn-warning';  // Default warning button
      $status_text = 'Unknown Status';
  }
    ?>
    <button class="btn <?php echo $status_class; ?>"><?php echo $status_text; ?></button>
  </td>
</tr>
              </tbody>
            </table>
          
            <?php 

        
if (isset($prof_id) && isset($_SESSION['member_id']) && $_SESSION['member_id'] == $mac__->cust_id) { ?>
    <a data-toggle="modal" data-target="#exampleModaldiable" onclick="diablePopup(<?php echo $mac__->cus_pokkuvandi_entry_id ?>)" class="btn btn-primary btn-lg btn-block text-white">Update</a>
<?php } ?>



                </div>
                </div>
            </div>
         </div>
    
    <?php   }
 
if(((!$mac__) ))
{ ?>
<img src="data1.png" style="width: 100%;"> 
<?php } }
?>

</div>
</div>



<div class="modal" tabindex="-1" id="exampleModaldiable" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div style="border-bottom: 0px solid #e5e5e5 !important" class="modal-header">
      <div class="alertreg alert-success" style="display: none;" role="alert">                               
                                    <div class="msgreg">

                                    </div>                                    
                                </div>
      </div>
      <div class="modal-body">
      <div class="contact-form default-form">
                            <!-- <form action="city_update_insert.php" method="post"> -->
                            <div class="row clearfix" id="diablepopup">
    <h3 style="text-align: center; margin-bottom: 40px;">Trip Status Entry</h3>

    <!-- Status Dropdown -->
    <div class="form-group col-md-6">
        <label for="status">Trip Status</label>
        <select class="form-control" id="status" name="status" required>
            <option value="">---SELECT---</option>
            <option value="completed">Completed</option>
            <option value="cancelled">Cancelled</option>
        </select>
    </div>

    <!-- Fields to show based on status -->
    <div id="statusFields" style="display: none;">
        <div id="completedFields" style="display: none;">
            <div class="form-group col-md-6">
                <label for="driver_name">Driver Name</label>
                <input type="text" class="form-control" id="driver_name" name="driver_name" required>
                <input type="hidden" class="form-control" id="cus_id" name="cus_id" value="<?php echo $_GET['id']?>">
            </div>
            <div class="form-group col-md-6">
                <label for="driver_phone_no">Driver Phone No</label>
                <input type="text" class="form-control" id="driver_phone_no" name="driver_phone_no" required>
                <input type="hidden" class="form-control" id="posted_id" name="posted_id" value="">
            </div>
            <div class="form-group col-md-6">
                <label for="vehicle_no">Driver Vehicle Register No</label>
                <input type="text" class="form-control" id="vehicle_no" name="vehicle_no" required>
            </div>
        </div>

        <div id="cancelledFields" style="display: none;">
            <div class="form-group col-md-6">
                <label for="cancellation_reason">Reason for Cancellation</label>
                <input type="text" class="form-control" id="cancellation_reason" name="cancellation_reason" required>
            </div>
            <div class="form-group col-md-6">
                <label for="cancellation_date">Cancellation Date</label>
                <input type="datetime-local" class="form-control" id="cancellation_date" name="cancellation_date" required>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('status').addEventListener('change', function () {
        var statusFields = document.getElementById('statusFields');
        var completedFields = document.getElementById('completedFields');
        var cancelledFields = document.getElementById('cancelledFields');

        statusFields.style.display = 'none';
        completedFields.style.display = 'none';
        cancelledFields.style.display = 'none';

        if (this.value === 'completed') {
            statusFields.style.display = 'block';
            completedFields.style.display = 'block';
        } else if (this.value === 'cancelled') {
            statusFields.style.display = 'block';
            cancelledFields.style.display = 'block';
        }
    });
</script>

                                <div class="form-group">
                                  <a class="btn btn-success"  onclick="pick_up_update();"  name="city_update">Update</a>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            <!-- </form> -->
						</div>
      </div>
      
    </div>
  </div>
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
<!-- <div class="form-group">

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
</div> -->
<!-- <div class="form-group">
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
</div> -->
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
  <option value="1" >All</option>
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

<script>
  function diablePopup(id)
  {
    var id;
    //  alert(id);
     $("#posted_id").val(id);
  }
</script>

<script>
  $("#main_city").change(function(){
    $('#exampleModalcity').modal('toggle');
  var city=$("#main_city").val();
  var mid=$('#mid').val();
  var city_name=$("#main_city :selected").text();
  $.ajax({
        type: "POST",
        url: "se_city.php",
        data: {city:city,city_name:city_name}, 
        success: function(data)
        {
         $('#city_name').html( city_name);
         $('#farea').html( city_name);
         
        }
    });
    $.ajax({
        type: "POST",
        url: "post_se_city_area.php",
        data: {city:city,city_name:city_name}, 
        success: function(data)
        {
          // alert(data);
        $('#fa').html(data);
        //  $('#farea').html( city_name);
         
        }
    });
  



    //city_filter start





   $.ajax({

type: "POST",

url: 'customer_pokku_entry_view_filter.php',

data: {city:city}, // serializes the form's elements.

success: function(data)

{
//  alert(data);
  $('#arearesult').html(data);



}

});

});

$("#state_status").change(function(){

  var state_status=$("#state_status").val();

            $.ajax({
          type: "POST",
          url: 'customer_pokku_entry_view_filter_state.php',
          data: {state_status:state_status}, // serializes the form's elements.
          success: function(data)
          {
          //  alert(data);
            $('#arearesult').html(data);
          }
          });
        });

</script>
<script>
$( document ).ready(function() {

var id=$('#set_city').val();
if(id == 0){
  // $('#exampleModalcity').modal('show'); 
}else{

}
});

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
// $("#topfilter").change(function(){
//    var filter=$("#topfilter").val();
//    alert(filter);
//    $.ajax({
//          type: "POST",
//          url: "sub_filter.php",
//          data: {city:city}, 
//          success: function(data)
//          {
//           $('#enq_earea').html(data);
//          }
//      });
 
//  });



  $("#keyword").keyup(function(){

      var key=$("#keyword").val(); 
      // alert(key);
    $.ajax({
          type: "POST",
          url: "customer_pokku_entry_state.php",
          data: {key:key}, // serializes the form's elements.
          success: function(data)
          {
            // alert();
            console.log();
          $('#arearesult').html(data);
          }
      });
  });




$('#city').on('change', function() {
                
                var id =this.value;
                var kmid =$('#kmid').val();
            
            $.ajax({
                type: "POST",
                url: "area_post.php",
                data:{id:id,kmid:kmid}, 
                success: function(data)
                {
                  
                $('#area').html(data);

                console.log(data);
                }
            });
            });


            function maincateg(id){
                    var id;
                   
             
                    $.ajax({
                        type: "POST",
                        url:'main_sub_cate.php',
                        data: {id:id}, // serializes the form's elements.
                        success: function(data)
                        {	
                            // alert(data);		
                        $('#sc').html(data);
                        
                        }			
                    });	
                    


                    $.ajax({
                        type: "POST",
                        url:'main_cate_package.php',
                        data: {id:id}, // serializes the form's elements.
                        success: function(data)
                        {	
                            // alert(data);		
                        $('#pk').html(data);
                        
                        }			
                    });	


                        if(id == '1')
                        {                   
                            $('#vr').show();
                            $('#vrother').hide();
                        }
                        else if(id == '2')
                        {
                            $('#vr').show();
                            $('#vrother').hide();
                        }
                        else
                        {
                            $('#vr').hide();
                            $('#vrother').show();
                            
                        }
                       


                } 
                
                function cum(customerid)
                 {
              
                    if (customerid != '') {
                        $.ajax({
                            type: "POST",
                            url: 'customer_search.php',
                            dataType: 'html',
                            data: {
                            customerid: customerid
                            },
                            success: function(data) {                          
                                $('#serach_result1').html(data);

                            }
                        });
                    } else {
                        $('#serach_result1').html('');
                    }
                 }


                function serach_result(customerid, name, phone_no)
                 {
                    $('#detaisl').val(name);
                    $('#customerid').val(customerid);
                    $('#serach_result1').html('');
                    $('#phone_no').val(phone_no);
                    // $('#address').val(address);  
                }



                function subcateg(id){
                    var id;                   
                     // alert(id);
                    $.ajax({
                        type: "POST",
                        url:'sub_cate_add_filter.php',
                        data: {id:id}, // serializes the form's elements.
                        success: function(data)
                        {	
                        // alert(data);		
                        $('#filter').html(data);
                        
                        }			
                    });	
                      } 


                      function package(id){
                    var id;                   
                     // alert(id);
                    $.ajax({
                        type: "POST",
                        url:'package_amount.php',
                        data: {id:id}, // serializes the form's elements.
                        success: function(data)
                        {	
                        // alert(data);		
                        $('#pkamount').html(data);
                        
                        }			
                    });	
                      } 
  

$(document).ready(function(){
  $("#sarea").change(function(){
   var area=$('#sarea').val();
   var mid=$('#mid').val();
   $.ajax({

type: "POST",

url: 'post_area_com.php',

data: {area : area,mid:mid}, // serializes the form's elements.

success: function(data)

{
// alert(data);
  $('#arearesult').html(data);



}

});
  });


  $("#subarea").change(function(){
   var area=$('#subarea').val();
   var mid=$('#mid').val();
   alert();
   $.ajax({

type: "POST",

url: 'post_sub_area_com.php',

data: {area : area,mid:mid}, // serializes the form's elements.

success: function(data)

{
//alert(data);
  $('#arearesult').html(data);



}

});
  });




  $("#topfilter").change(function(){
   var area=$('#topfilter').val();
  //alert(area);
   var mid=$('#mid').val();
   //alert(mid);
   $.ajax({

type: "POST",

url: 'sub_filter.php',

data: {area : area,mid:mid}, // serializes the form's elements.

success: function(data)

{
// alert(data);
  $('#arearesult').html(data);



}

});
  });



  $("#verfied").change(function(){
   var area=$('#sarea').val();
   var mid=$('#mid').val();
   var c_ver=$('#verfied').val();
 
   $.ajax({

type: "POST",

url: 'dir_verfied_com.php',

data: {area:area,mid:mid,c_ver:c_ver}, 

success: function(data)

{
// alert(data);
  $('#arearesult').html(data);
}

});
  });

});

function getval()
{
  var area=$('#sarea').val();
  // var area=$('#subarea').val();
   var mid=$('#mid').val();
   $.ajax({

type: "POST",

url: 'post_area_com.php',

data: {area : area,mid:mid}, // serializes the form's elements.

success: function(data)

{
// alert(data);
  $('#arearesult').html(data);



}

});
}



function getval_sub()
{
 // var area=$('#sarea').val();
   var area=$('#subarea').val();
   var mid=$('#mid').val();
   $.ajax({

type: "POST",

url: 'post_sub_area_com.php',

data: {area : area,mid:mid}, // serializes the form's elements.

success: function(data)

{
//alert(data);
  $('#arearesult').html(data);



}

});
}





function sub_area_filter()
{
 // var area=$('#sarea').val();
   var area=$('#subarea').val();
   var mid=$('#mid').val();
   $.ajax({

type: "POST",

url: 'post_sub_area_com.php',

data: {area : area,mid:mid}, // serializes the form's elements.

success: function(data)

{
//alert(data);
  $('#arearesult').html(data);



}

});
}





function sub_area(id){
                     var id;
                   //alert(id);
             
                    $.ajax({
                        type: "POST",
                        url:'sub_area.php',
                        data: {id:id}, // serializes the form's elements.
                        success: function(data)
                        {	
                            //alert(data);		
                            console.log(data)
                        $('#sa').html(data);
                        
                        }			
                    });	
                    
                  }

                  function pick_up_update(id) {
    var id;
    var driver_name = $('#driver_name').val();
    var driver_phone_no = $('#driver_phone_no').val();
    var vehicle_no = $('#vehicle_no').val();
    var cus_id = $('#posted_id').val();
    var posted_id = $('#posted_id').val();
    var status = $('#status').val();
    var cancellation_reason = $('#cancellation_reason').val();
    var cancellation_date = $('#cancellation_date').val();

    if (status == '') {
        alert("Select the status");
    } else if (status == 'completed') {
        if (driver_name == '') {
            alert("Enter The Driver Name");
        } else if (driver_phone_no == '') {
            alert("Enter The Driver Phone No");
        } else if (vehicle_no == '') {
            alert("Enter The Driver Vehicle Register No");
        } else {
            updatePickupDetails(id, driver_name, driver_phone_no, vehicle_no, cus_id, status, cancellation_reason, cancellation_date);
        }
    } else if (status == 'cancelled') {
        if (cancellation_reason == '') {
            alert("Enter The Reason for Cancellation");
        } else if (cancellation_date == '') {
            alert("Enter The Cancellation Date");
        } else {
            updatePickupDetails(id, driver_name, driver_phone_no, vehicle_no, cus_id, status, cancellation_reason, cancellation_date);
        }
    } else {
        updatePickupDetails(id, driver_name, driver_phone_no, vehicle_no, cus_id, status, cancellation_reason, cancellation_date);
    }
}

function updatePickupDetails(id, driver_name, driver_phone_no, vehicle_no, cus_id, status, cancellation_reason, cancellation_date) {
    $.ajax({
        type: "POST",
        url: 'cus_pokkuvandi_driver_update.php',
        data: {
            id: id,
            driver_name: driver_name,
            driver_phone_no: driver_phone_no,
            vehicle_no: vehicle_no,
            cus_id: cus_id,
            status: status,
            cancellation_reason: cancellation_reason,
            cancellation_date: cancellation_date
        },
        success: function(data) {
            if (data == 1) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Trip Details Updated',
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Error updating details',
                    showConfirmButton: true
                });
            }
        }
    });
}


                  function pick_up_update1(id){
                    var id;
                  
                   //alert(id);
                   var driver_name = $('#driver_name').val();
                   var driver_phone_no = $('#driver_phone_no').val();
                   var vehicle_no = $('#vehicle_no').val();
                   var cus_id = $('#posted_id').val();
                   var posted_id = $('#posted_id').val();
                   var status = $('#status').val();
                   var cancellation_reason = $('#cancellation_reason').val();
                   var cancellation_date = $('#cancellation_date').val();

                   
                   
                   if(driver_name =='')
                   {
                      alert("Enter The Driver Name");
                   }
                   else if(driver_phone_no =='')
                   {
                    alert("Enter The Driver Phone No");
                   }
                   else if(vehicle_no =='')
                   {
                    alert("Enter The Driver Vehicle Register No");
                   }  
                   else if(status =='')
                   {
                    alert("Select the status");
                   }                   
                   else
                   {

                    $.ajax({
                        type: "POST",
                        url:'cus_pokkuvandi_driver_update.php',
                        data: {id:id,driver_name:driver_name,driver_phone_no:driver_phone_no,vehicle_no:vehicle_no,cus_id:cus_id,status:status,cancellation_reason:cancellation_reason,cancellation_date:cancellation_date}, // serializes the form's elements.
                        success: function(data)
                        {	
                            if(data == 1)
                            {
                                  Swal.fire({
                                  position: 'center',
                                  icon: 'success',
                                  title: 'Trip Details Updated',
                                  showConfirmButton: false,
                                  timer: 1500
                                  })
                                }
                                // setTimeout(function() {
                                //     $('#exampleModaldiable').modal('hide');
                                //     }, 1000);
                                //     setTimeout(() => { 
                                //         window.location.href = ('Directory.php');
                                //     }, 2000);
                                    
                        
                        }		
                        	
                    });	
                  }
                    

                }


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