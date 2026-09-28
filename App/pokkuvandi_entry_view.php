<?php include('config/setup.php');?>

 <?php include('session.php');
 $mid=$_REQUEST['mid'];
$session__phone; 

if(isset($_GET['did']))
{
    // $sql = "DELETE FROM  create_post WHERE post_id='".$_GET['did']."'";
    // if (mysqli_multi_query($config, $sql))
    // {
    //     header("location:createpost_list.php");
    //     die;
    
    // }

    $sql = "update create_post set delete_id='1'  WHERE post_id='".$_GET['did']."'";
    if (mysqli_multi_query($config, $sql))
    {
        header("location:createpost_list.php");
        die;
    
    }

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


<style>
        .details-card {
            background: #f8f9fa;
            border-left: 5px solid #199b37;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }
        .details-card:hover {
            transform: scale(1.02);
        }
        .detail-item {
            font-size: 16px;
            margin-bottom: 8px;
        }
        .detail-item strong {
            color: #333;
        }
        .whatsapp-number {
            font-size: 20px;
            font-weight: bold;
            color: #0d6efd;
        }  </style>
<?php include('Directory_topmenu.php');?>
   
        <div class="mt-3 mb-3" >
            <!-- <center> 
                <a href="create_post.php" class="btn btn-success">
                    <i class="fas fa-plus"></i>   Create Post
                </a>
            </center> -->

            <h5 class="text-center"> Return Trip Drivers Entry List</h5>
        </div>
        <form method="GET" action="" class="mb-3">
    <div class="form-group">
        <label for="state" class="font-weight-bold">Select From State:</label>
        <select name="state" id="state" class="form-control custom-select" required onchange="this.form.submit()">
            <option value="" disabled selected>-- Select State --</option>
            <?php
            // Fetch states from your database
            $states = mysqli_query($config, "SELECT * FROM dir_state_master");
            while ($state = mysqli_fetch_assoc($states)) {
                $selected = (isset($_GET['state']) && $_GET['state'] == $state['state_id']) ? 'selected' : '';
                echo "<option value='" . htmlspecialchars($state['state_id']) . "' $selected>" . htmlspecialchars($state['name']) . "</option>";
            }
            ?>
        </select>
    </div>
</form>

        <div class="">
          
            <div class=""> 
                     <?php
                              date_default_timezone_set('Asia/Kolkata');
                              $current_Date = date('Y-m-d');
                              // $session_id = $_SESSION['customer_id']; // Ensure this is set correctly
                      
                              // Check if a state is selected
                              $state_filter = "";
                              if (isset($_GET['state']) && !empty($_GET['state'])) {
                                  $state_id = mysqli_real_escape_string($config, $_GET['state']);
                                  $state_filter = " AND create_post.state_id = '$state_id'"; // Modify based on your column name
                              }
                      
                              // Query with state filter
                            $or = "
                              SELECT * 
                              FROM `create_post`
                              INNER JOIN driver_pokkuvandi_entry ON create_post.post_id = driver_pokkuvandi_entry.post_id
                              WHERE create_post.loader_status = '1' 
                                AND create_post.disable_status = '0' 
                                AND create_post.delete_approval_status = '0' 
                                AND driver_pokkuvandi_entry.status = '1' 
                                AND create_post.customer_id = '$session_id' 
                                $state_filter
                              ORDER BY driver_pokkuvandi_entry.driver_pokkuvandi_entry_id DESC";                                                         
                      $maincate3=mysqli_query($config,$or);
                       $ldata[]= mysqli_num_rows($maincate3);
                       while($mac3__=mysqli_fetch_object($maincate3))    
                       {

                         $loader_to_date= $mac3__->loader_to_date;
                         $loader_to_time= $mac3__->loader_to_time;
                         $from_state= $mac3__->from_state;
                         $to_state= $mac3__->to_state;

                         $loader_from_date= $mac3__->loader_from_date;
                         $loader_from_time= $mac3__->loader_from_time;
                         $post_id= $mac3__->post_id;

                         
                         $from_date_time__ = date('d-m-Y h:i a', strtotime("$loader_from_date $loader_from_time"));
                         $to_date_time__ = date('d-m-Y h:i a', strtotime("$loader_to_date $loader_to_time"));

                         date_default_timezone_set('Asia/Kolkata');
                            $date_time=date('Y-m-d H:i');
                          


                         // if(($from_date_time >= $date_time) OR ($to_date_time <= $date_time ))
                         if(($date_time >= $from_date_time) OR ($date_time <= $to_date_time))
                         {
                           $or_item="SELECT * FROM `create_post` WHERE post_id='$post_id'  ORDER BY post_id DESC  ";
                          
                        
                         
                         $maincate3__=mysqli_query($config,$or_item);
                         $ldata[]= mysqli_num_rows($maincate3__);
                         $mac3=mysqli_fetch_object($maincate3__);   

                           $city_id= $mac3->city_id;
                           $night_duty = $mac3->night_duty;
                           // if($night_duty == 2)
                           // {
                           //   $night="Night Duty";
                           // }
                          $or_="SELECT * FROM `dir_city_master` where dir_city_id  ='$city_id' Order by dir_city_id   DESC ";
                          $maincate3_=mysqli_query($config,$or_);       
                          $mac3_=mysqli_fetch_object($maincate3_);  

                          $state_id = $mac3->state_id; // Assuming $mac3 contains the state_id
                          $state_query = "SELECT * FROM `dir_state_master` WHERE state_id = '$state_id' ORDER BY state_id DESC";
                          $state_result1 = mysqli_query($config, $state_query);
                          $state_result=mysqli_fetch_object($state_result1);

                          $area_id= $mac3->area_id;      
                          $orarea_="SELECT * FROM `dir_area_master` where dir_area_id ='$area_id' Order by dir_area_id   DESC ";
                          $orarea3_=mysqli_query($config,$orarea_);       
                          $area3__=mysqli_fetch_object($orarea3_);

                          $vehicle_type_id= $mac3->vehicle_type_id;   
                          $orvehicle_="SELECT * FROM `vehicle_type` where Vehicle_type_id ='$vehicle_type_id' Order by Vehicle_type_id   DESC ";
                          $orvehicle_type=mysqli_query($config,$orvehicle_);       
                          $orvehicle___=mysqli_fetch_object($orvehicle_type);  


                          $state_id=mysqli_query($config,"select * from dir_state_master where state_id='$from_state' ");
                          $state_id_from=mysqli_fetch_object($state_id);
                          
                          $state_id_to=mysqli_query($config,"select * from dir_state_master where state_id='$to_state' ");
                          $state_id_to_12=mysqli_fetch_object($state_id_to);
                          
                          $main_cate_from=mysqli_query($config,"select * from dir_city_master where dir_city_id='$mac3__->from_district' ");
                          $addsubcate_form=mysqli_fetch_object($main_cate_from);
                          
                          $main_cate_to=mysqli_query($config,"select * from dir_city_master where dir_city_id='$mac3__->to_district' ");
                          $addsubcate_to=mysqli_fetch_object($main_cate_to);


                     
                               ?>   
             <!-- Trip Details Card -->
<div class="card shadow-lg border-0 rounded-lg mb-3">
    <div class="card-body p-4">
        <div class="row align-items-center">
            <!-- Vehicle Image -->
            <div class="col-md-4 d-flex justify-content-center">
                <img src="../photos/vehicle/<?php echo $mac3->vehicle_photo ?>" class="rounded-lg img-fluid" 
                     style="max-width: 280px; height: 120px; object-fit: cover;">
            </div>

            <!-- Vehicle Details -->
            <div class="col-md-8">
                <h4 class="text-primary font-weight-bold mb-2"><?php echo $mac3->vehicle_name ?></h4>
                <p class="mb-1 text-muted"><i class="fas fa-car-side"></i> <?php echo $mac3->vehicle_no ?></p>
                <p class="mb-1"><strong>Type:</strong> <?php echo $orvehicle___->Vehicle_type_name ?></p>

                <?php if ($mac3->category_id == '1') { ?>
                    <p class="mb-1"><strong>Tonnage:</strong> <?php echo $mac3->tonnage ?></p>
                <?php } ?>

                <p class="mb-1"><strong>State Type:</strong> 
                    <span class="badge bg-info text-white">
                        <?php echo ($mac3__->state_status == 1) ? 'Within State Trip' : 'Other State Trip'; ?>
                    </span>
                </p>

                <!-- Highlighted Details -->
                <div class="p-3 rounded shadow-sm" style="background: linear-gradient(to right, #f8f9fa, #eef2f3); border-left: 5px solid #199b37;">
                    <?php if ($mac3__->state_status == 1) { ?>
                        <p class="mb-1"><strong class="text-success">From:</strong> 
                            <?php echo $state_id_from->name ?> 
                        </p>
                        <p class="mb-1"><strong class="text-info">From Place:</strong> <?php echo $mac3__->loader_from_place ?> <span class="text-muted">(<?php echo $addsubcate_form->dir_city_name ?> District)</span>
                        </p>
                        <p class="mb-1"><strong class="text-info">To Place:</strong> <?php echo $mac3__->loader_to_place ?>                            <span class="text-muted">(<?php echo $addsubcate_to->dir_city_name ?> District)</span>
                        </p>
                        <p class="mb-1"><strong class="text-info">From Date:</strong> <?php echo $from_date_time__  ?> 
                        <p class="mb-1"><strong class="text-info">To Date:</strong> <?php echo $to_date_time__  ?>                           
                        </p>
                    <?php } else { ?>
                        <p class="mb-1"><strong class="text-success">From State:</strong> <?php echo $state_id_from->name ?></p>
                        <p class="mb-1"><strong class="text-danger">To State:</strong> <?php echo $state_id_to_12->name ?></p>
                        <p class="mb-1"><strong class="text-info">From Place:</strong> <?php echo $mac3__->loader_from_place ?> <span class="text-muted">(<?php echo $addsubcate_form->dir_city_name ?> District)</span>
                        </p>
                        <p class="mb-1"><strong class="text-info">To Place:</strong> <?php echo $mac3__->loader_to_place ?>                            <span class="text-muted">(<?php echo $addsubcate_to->dir_city_name ?> District)</span>
                        </p>

                        <p class="mb-1"><strong class="text-info">From Date:</strong> <?php echo $from_date_time__  ?> 
                        <p class="mb-1"><strong class="text-info">To Date:</strong> <?php echo $to_date_time__  ?>                           
                        </p>
                    <?php } ?>

                    <p class="mb-1"><strong class="text-warning">Available Space:</strong> <?php echo $mac3__->loader_space ?></p>
                </div>

                <!-- Contact -->
                <p class="text-dark font-weight-bold mt-3">
                    <i class="fa fa-phone text-success"></i> 
                    <span class="fs-5 text-primary"><?php echo $mac3->whatsapp_no ?></span>
                </p>
            </div>
        </div>

        <!-- Delete Button -->
        <div class="text-center mt-3">
            <a href="loader_popup_delete.php?id=<?php echo $mac3__->driver_pokkuvandi_entry_id?>" 
               onclick="return confirm('Are you sure you want to delete this?');" 
               class="btn btn-danger btn-sm px-4">Delete</a>
        </div>
    </div>
</div>

                
                <hr>               
            <?php } } ?>
             </div>                        
        </div>                            
       
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
</select> </div>
      </div>
     
    </div>
  </div>
</div>


<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> -->


    
        <div class="modal" tabindex="-1" id="exampleModalupdate" role="dialog">
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
                                <div class="row clearfix" id="citypopup">   
                                
                                <div class="form-group col-md-6">
                                                    <label for="exampleFormControlSelect1">District</label>
                                                        <select required class="form-control" id='city' name="Add_city">
                                                            <option>---SELECT---</option>
                                                            <?php
                                                            $main_cate=mysqli_query($config,"select * from dir_city_master");
                                                            while($addsubcate=mysqli_fetch_object($main_cate))
                                                            {  
                                                            ?>
                                                            <option value="<?php echo $addsubcate->dir_city_id ;?>"><?php echo $addsubcate->dir_city_name;?></option>
                                                            <?php } ?>                                                        
                                                        </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Area</label>
                                                        <div id="area9">

                                                        </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Area</label>
                                                        <div id="subarea">

                                                        </div>
                                                </div>
                                              
                                </div>
                                <div class="form-group">
                                  <a class="btn btn-success"  onclick="updatecheck();"  name="city_update">Update</a>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            <!-- </form> -->
						</div>
      </div>
      
    </div>
  </div>
</div>


<div class="modal" tabindex="-1" id="exampleModaldelete" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div style="border-bottom: 0px solid #e5e5e5 !important" class="modal-header">
      <div class="alertdelete alert-success" style="display: none;" role="alert">                               
                                    <div class="msgdelete">

                                    </div>                                    
                                </div>
      </div>
      <div class="modal-body">
      <div class="contact-form default-form">
                            <!-- <form action="city_update_insert.php" method="post"> -->
                                <div class="row clearfix" id="deletepopup">   
                                
                                                            </div>
                            <!-- </form> -->
						</div>
      </div>
      
    </div>
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
                                
                                <div class="form-group col-md-6">
                                                    <label for="exampleFormControlSelect1">City</label>
                                                        <select required class="form-control" id='city' name="Add_city">
                                                        <option value="1">Enable</option>
                                                        <option value="0">Disable</option>                                       
                                                        </select>
                                                </div> 
                                </div>
                                <div class="form-group">
                                  <a class="btn btn-success"  onclick="disablecheck();"  name="city_update">Update</a>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            <!-- </form> -->
						</div>
      </div>
      
    </div>
  </div>
</div>


<div class="modal fade modal-dialog-centere" id="exampleModaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="height: 100%;">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     
        <div class="row" id="postform">
                                                
                                         
                                               
       </div>
      </div>
     
    </div>
  </div>
</div>
   


<div class="modal" tabindex="-1" id="exampleModalloader" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div style="border-bottom: 0px solid #e5e5e5 !important" class="modal-header">
      <div class="alertload alert-success" style="display: none;" role="alert">                               
                                    <div class="msgload">

                                    </div>                                    
                                </div>
      </div>
      <div class="modal-body">
      <div class="contact-form default-form">
                            <!-- <form action="city_update_insert.php" method="post"> -->
                                <div class="row clearfix" > 
                                  <div class="form-group col-md-6" id="loaderupdate" >

                                  </div>
                                 
                                 
                                </div>


                                
                            <!-- </form> -->
						</div>
      </div>
      
    </div>
  </div>
</div>
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
  // $('#exampleModalcity').modal('show'); 
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
