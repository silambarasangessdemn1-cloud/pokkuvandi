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
        .form-control {
        border: 1px solid #cacdd0;      
        background-color: white;      
        font-size: 13px;
        box-shadow: none !important;
    }

    .more {display: none;}
    .read-more-btn {
        color: white;
        background-color: #007bff;
        padding: 6px 10px;
        font-weight: bold;
        border-radius: 5px;
        font-size: 13px;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.2s;
    }

    .read-more-btn:hover {
        background-color: #0056b3;
        transform: scale(1.05);
    }

    .read-more-btn:active {
        background-color: #004085;
        transform: scale(0.98);
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

      

         <div class="osahan-body">

     
<div class="row m-0 mt-2">



<!-- <div class="col-12">
<span style="
    position: relative;
    top: 2px;
    left: 0%;
    font-size:17px;
    color:#000;
    margin: 2%;
"><?php //echo $_GET['keyword'] ?></span> 

</div> -->

<div class="col-4 text-center" style="    background: white;
    border: 0.5px solid #dee2e6; display:none">

    <div class="row " style=" background: #e9ecef; ">
        <div class="col-12 text-center ">
          <label class="">District</label>
        </div>
    </div>

    <div data-toggle="modal" data-target="#exampleModalcity" class="fiter" style="margin:4%;"> <span id="farea" ><?php //echo $_SESSION["city_name"] ?></span> &nbsp;<i class="fa fa-angle-down"></i></div> 
</div> 

<div class="col-4 text-center" style="background: white;border: 0.5px solid #dee2e6; display:none"> 

    <div class="row " style=" background: #e9ecef;  display:none">
        <div class="col-12 text-center ">
          <label class="">City</label>
        </div>
    </div>

    <?php 
   
     $city=$_SESSION["city"];
     $nn="SELECT * FROM `dir_area_master` where dir_cityid='$city' ";
     $main_cate33=mysqli_query($config,$nn);
    
   ?>
  
   

</div>


<div class="col-4" style="background: white;border: 0.5px solid #dee2e6; display:none"> 

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
<!-- <?php
while($macate33=mysqli_fetch_object($main_cate33))
                      { ?>
  <option value="<?php echo $macate33->sub_area_id ?>"><?php  echo $macate33->sub_area_name?></option>
<?php }?> -->
</select>
</div> 

</div>




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
        

            <div class="card" style="display:none">
                         
            </div>

          </div>

          <div class="m-2"> 
          <h5 class="text-center">
    <?php  
        if ($sid == 1) {
            echo 'Driver Wanted';
        } elseif ($sid == 2) {
            echo 'Acting Drivers List';
        } elseif ($sid == 3) {
            echo 'Attachment';
        } else {
            echo 'Unknown Section'; // optional fallback
        }
    ?>
</h5>

<?php
    // $or_="SELECT * FROM `sub_category` where Sub_Category_id ='$sid' Order by Sub_Category_id  DESC ";
    // $maincate3_=mysqli_query($config,$or_);       
    // $mac3_=mysqli_fetch_object($maincate3_);  

      $or__="SELECT * FROM `job_search_category` where Main_Category_id ='$sid' Order by Main_Category_id  DESC ";
      $maincate3__=mysqli_query($config,$or__);       
      $mac3__=mysqli_fetch_object($maincate3__);  
  ?>

<div class="crump">
    <div class="container">
      <nav style="--bs-breadcrumb-divider: '/'" aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color:#f0f2f5 !important;"> 
          <li style="margin-left: -23px;color:#e23e57;" class="breadcrumb-item"><a href="Directory.php">Home</a></li>
          <li class="breadcrumb-item"><a href="Directory.php"><?php echo $mac3__->Main_Category_Name?></a></li>
          <!-- <li class="breadcrumb-item"><a href="Directory_subcate.php?mid=<?php echo $mac3__->Main_Category_id?>&Main_Category_Name=<?php echo $mac3__->Main_Category_Name?>"><?php echo $mac3_->Sub_Category_Name?></a></li>
         -->
        </ol>
      </nav>
    </div>
  </div>

<input type="hidden" name='mid' class="form-control" id="mid" aria-describedby="emailHelp" value="<?php echo $_GET['mid']?>" placeholder="" >
<form method="GET" action="job_post_list_filter.php">

<?php  if($sid == 2){  ?>
<div class="osahan-body" style="
    margin-top: -44px;
    margin-bottom: 10px;
">


<div class="row m-0 mt-2">



<div class="col-12">
<!-- <span style="
    position: relative;
    top: 2px;
    left: 0%;
    font-size:17px;
    color:#000;
    margin: 2%;
"><?php echo $_GET['keyword'] ?></span>  -->

</div>



<div class="col-4" style="background: white;border: 0.5px solid #dee2e6;"> 

    <div class="row " style=" background: #e9ecef; ">
        <div class="col-12 text-center ">
          <label class="">State</label><?php   //echo $selected_state = $_GET['state'] ? $_GET['state'] :'';?>
        </div>
    </div>

    <select required class="form-control" id="state" name="state" onchange="loadDistricts(this.value)">
        <option value="">---SELECT---</option>
        <?php
        $state_query = mysqli_query($config, "SELECT * FROM dir_state_master");
        while($state = mysqli_fetch_object($state_query)) {
          $selected_state = $_GET['state'] ? $_GET['state'] :'';
          $selected = ($state->state_id == $selected_state) ? 'selected' : '';

          echo "<option value='{$state->state_id}' {$selected}>{$state->name}</option>";
        }
        ?>
    </select>

</select>
</div> 


<div class="col-4 text-center" style="    background: white;
    border: 0.5px solid #dee2e6;">

    <div class="row " style=" background: #e9ecef; ">
        <div class="col-12 text-center ">
          <label class="">District</label>
        </div>
    </div>

    <div data-toggle="modal" data-target="#exampleModalcity" class="fiter" style="margin:4%;"> <div id="displayArea"><?php
if (isset($_REQUEST['main_city'])) {
    $main_city_id = $_REQUEST['main_city']; // Retrieve the city ID from the request

    // Correct the query syntax
    $main_city_query = mysqli_query($config, "SELECT dir_city_name FROM dir_city_master WHERE dir_city_id = '$main_city_id'");

    // Fetch the city name if the query is successful and returns a result
    if ($main_city_query && mysqli_num_rows($main_city_query) > 0) {
        $city = mysqli_fetch_assoc($main_city_query); // Fetch the result as an associative array
        $city_name = $city['dir_city_name']; // Get the city name
        echo $city_name; // Display the city name
    } }
?>
</div>
      &nbsp;<i class="fa fa-angle-down"></i></div> 
</div> 
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
    <input type="hidden" id="set_city" value="<?php //echo $_SESSION["city"] ?>">
    <select id="main_city" name="main_city" class="form-select form-control form-select-lg mb-3" aria-label=".form-select-lg example">
  <option value="0" selected>Select District</option>
  <?php


if($_REQUEST['state'])

{

											$main_cate3=mysqli_query($config,"SELECT * FROM `dir_city_master`");

											while($macate3=mysqli_fetch_object($main_cate3))

											{

											?>
  <option <?php if($_REQUEST["main_city"] == $macate3->dir_city_id ){ echo 'selected';}else{
    if($_REQUEST["main_city"] == $macate3->dir_city_id ){ echo 'selected';}
  } ?> value="<?php echo $macate3->dir_city_id ?>"><?php echo $macate3->dir_city_name ?></option>
<?php }
}?>

</select>  </div>
      </div>
     
    </div>
  </div>
</div>

<div class="col-4 text-center" style="background: white;border: 0.5px solid #dee2e6;"> 

    <div class="row " style=" background: #e9ecef; ">
        <div class="col-12 text-center ">
          <label class="">City</label>
        </div>
    </div>

    <?php 
    $city = isset($_REQUEST["main_city"]) ? $_REQUEST["main_city"] : '';
    $nn = "SELECT * FROM `dir_area_master` WHERE dir_cityid='$city'";
    $main_cate33 = mysqli_query($config, $nn);
    ?>

  
    <div id="fa" class="fiter">
      <select id='sarea' class="form-select form-control" name="city1" aria-label="Default select example">
  <option value=""  selected>Select City</option>
  <option value="1" >All</option>
  <?php
            if ($city) {
                while ($macate33 = mysqli_fetch_object($main_cate33)) { 
                    $dir_area_id = isset($_REQUEST["city1"]) ? $_REQUEST["city1"] : ''; // Retrieve city1 value from the request
                    $selected = ($dir_area_id == $macate33->dir_area_id) ? "selected" : ""; // Check for selected
                    ?>
                    <option value="<?php echo $macate33->dir_area_id; ?>" <?php echo $selected; ?>>
                        <?php echo $macate33->dir_area_name; ?>
                    </option>
                    <?php 
                } 
            }
            ?>

</select>
</div> 

</div>




                      </div>
                      </div>

                      <?php  } 
                      
                      $placeholder = "Enter City Name"; // Default placeholder

// Customize the placeholder based on $sid value
if ($sid == '1' || $sid == '3') {
    $placeholder = "Search by Job Location";
}
                      ?>

  <div class="row">
    
    <div class="col-12 col-md-12 col-sm-12">
    <input type="text" name="keyword" class="form-control" id="keyword" placeholder="<?php echo htmlspecialchars($placeholder); ?> " value = "<?php echo $_GET['keyword']?>">
    <input type="hidden" name='sid' class="form-control" id="sid" value="<?php echo $_GET['sid']?>" placeholder="Enter City Name" >
    </div>
    <div class="col-12 col-md-12 col-sm-12 mt-3">
        <button type="submit" class="btn btn-success mb-3" style="width:100%;color:white">Search </button>
    </div>
  </div>
</form>
<div class="" id="arearesult">
    <?php
$i = 0;
date_default_timezone_set('Asia/Kolkata'); 
$current_date = date("Y-m-d"); 

// Extract and sanitize inputs
$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : ''; 
$state = isset($_GET['state']) ? trim($_GET['state']) : ''; 
$district = isset($_GET['main_city']) ? trim($_GET['main_city']) : ''; 
$city1 = isset($_GET['city1']) ? trim($_GET['city1']) : ''; 

// Base query
if($sid == 1){
  
  $or = "SELECT * FROM `job_search_post` 
  WHERE status = '0' 
  and delete_id= '0'
  AND disable_status = '0' 
  AND job_category_id = '$sid' 
  AND create_on >= '2025-01-09'";
}
else{
  $or = "SELECT * FROM `job_search_post` 
  WHERE status = '0' 
   and delete_id= '0'
  AND disable_status = '0' 
  AND job_category_id = '$sid' 
  
  AND exp_date >= '$current_date'";

}

// Add search conditions based on inputs
$conditions = [];
if (!empty($keyword)) {
    $conditions[] = "(job_location LIKE '%$keyword%'  OR district_id IN (SELECT dir_city_id FROM dir_city_master WHERE dir_city_name LIKE '%$keyword%'))";
}
if (!empty($state) && $state!= 0) {
    $conditions[] = "state_id = '$state'";
}
if (!empty($district && $district!= 0)) {
    $conditions[] = "district_id = '$district'";
}
if (!empty($city1) && $city1!= 0 ) {
    $conditions[] = "city_id = '$city1'";
}

// Append conditions to query if any exist
if (!empty($conditions)) {
    $or .= " AND (" . implode(" AND ", $conditions) . ")";
}

// Order by clause
  $or .= " ORDER BY job_search_id DESC";

// Debugging: Uncomment to see the generated query
// echo $or;



$maincate3=mysqli_query($config,$or);
                       $ldata[]= mysqli_num_rows($maincate3);
                       while($mac3=mysqli_fetch_object($maincate3))

                       {
                       $city_id = $mac3->district_id;

                        // Fetch city data based on city_id
                        $or_ = "SELECT * FROM `dir_city_master` WHERE dir_city_id = '$city_id' ORDER BY dir_city_id DESC";
                        $maincate3_ = mysqli_query($config, $or_);
                        $mac3_ = mysqli_fetch_object($maincate3_);
                        $or2_ = "SELECT * FROM `dir_city_master` WHERE dir_city_id = '$city_id' ORDER BY dir_city_id DESC";
                        $maincate2_ = mysqli_query($config, $or2_);
                        $mac2_ = mysqli_fetch_object($maincate2_);
                        // Get the state_id from the city record
                        $state_id = $mac3->state_id; // Assuming 'state_id' is in 'dir_city_master'
                        
                        $state = "SELECT * FROM `dir_state_master` WHERE state_id = '$state_id' ORDER BY state_id DESC";
                        $state_ = mysqli_query($config, $state);
                        $state_1 = mysqli_fetch_object($state_);
                        // Fetch area data based on area_id (city_id in this case)
                     $area_id = $mac3->city_id;
                      $orarea_ = "SELECT * FROM `dir_area_master` WHERE dir_area_id = '$area_id' ORDER BY dir_area_id DESC";
                        $orarea3_ = mysqli_query($config, $orarea_);
                        $area3__ = mysqli_fetch_object($orarea3_);
                        $sub_area_id = $mac3->area_id;
                          $sub_orarea_ = "SELECT * FROM `sub_area_master` WHERE sub_area_id = '$sub_area_id'";
                          $sub_orarea3_ = mysqli_query($config, $sub_orarea_);
                          $sub_area3__ = mysqli_fetch_object($sub_orarea3_);
                          
                        // Fetch vehicle type data
                        $vehicle_type_id = $mac3->vehicle_type_id;
                        $orvehicle_ = "SELECT * FROM `vehicle_type` WHERE Vehicle_type_id = '$vehicle_type_id' ORDER BY Vehicle_type_id DESC";
                        $orvehicle_type = mysqli_query($config, $orvehicle_);
                        $orvehicle___ = mysqli_fetch_object($orvehicle_type);
                        ?>

        
<div class="card" style="width: 100%; padding: 0%;margin-bottom:2px;">
 <div class="card-body" style="padding:1px">
   
      <div class="row">
        <div class="col-12">   
        <div style="margin-left: 15px;">  
        
         
<?php
       $originalDate = $mac3->last_date;
       $newDate = date("d-m-Y", strtotime($originalDate));
       $post_date = $mac3->post_date;
       $post_date1 = date("d-m-Y", strtotime($post_date));

       
                if($mac3->job_category_id =='1')  
                {


           


                  // if($mac3->subcategory_id >='5' && $mac3->subcategory_id <='10') 
                  // {
                  //   $data .='   <p style="text-transform: capitalize;color: #000;font-weight: 500;">Specification - '.$mac3->space.'</p>';
                  // }
                  // else
                  // {
                    ?>
                 <h6 class="mt-2" style="color:blue;font-weight: 700;"> <?php echo $mac3->job_name ?></h6>
                 <!-- <//p style="text-transform: capitalize;color: #000;font-weight: 500;color:blue"><?php echo $mac3->job_location ?></p> -->
                        <!-- Get Detail -->
                        <h6 class="mt-2" style="color:black;font-weight: 500;"> <?php echo "Location:"; ?></h6>

                        <p style="text-transform: capitalize; color: #000; font-weight: 500;">
    <i class="fa fa-map-marker-alt"></i> 
    <?php
    if ($city_id == 0 && $area_id == 0) {
   
        echo  $mac3->job_location;
    } else {
        // Display state, city, and area names
      
        echo  $mac3->dir_city_name . ", " . $area3__->dir_area_name;
    }
    ?>
</p>

<p style="text-transform: capitalize;color: #000;font-weight: 500;">Last Date For Apply - <?php echo $newDate ?></p>
<p style="text-transform: capitalize;color: #000;font-weight: 500;">Post Date - <?php echo $post_date1 ?></p>
<p style="text-transform: capitalize;color: #000;font-weight: 500;">Job Details - <?php echo  $mac3->job_details ?></p>

                        <span  class="dots" id="dots<?php echo $i?>"></span>

                       
                        <!-- <p style="text-transform: capitalize;color: #000;font-weight: 500;">Location - <?php echo $mac3->job_location ?></p> -->
                        <span class="more" id="more<?php echo $i?>">
                     
                   
                        <p style="text-transform: capitalize;"> <span style="color: #000;font-weight: 400;">Experience -<?php echo $mac3->experiences ?> ,  Qualification - <?php echo $mac3->qualification ?></span></p>
  
                        <p style="text-transform: capitalize;color: #000;font-weight: 500;">Salary Range - <?php echo $mac3->salary_range ?></p>
                        <p style="text-transform: capitalize;color: #000;font-weight: 500;"><i class="fas fa-car-side"></i> <?php echo $mac3->company_name ?></p>

                        <p style="text-transform: capitalize;color: #000;font-weight: 500;">Comapny Address - <?php echo $mac3->address ?></p>
                        <!-- <p style="text-transform: capitalize;color: #000;font-weight: 500;color:blue"><i class="fa fa-phone"></i> <?php echo $mac3->contact_no ?></p> -->

                        <p style="text-transform: capitalize;color: #000;font-weight: 500;">Email - <?php echo $mac3->email_id ?></p>

                        <p style="text-transform: capitalize;color: #000;font-weight: 500;">Last Date - <?php echo $newDate ?></p>
               

                        
                <p style="text-transform: capitalize;color: #000;font-weight: 500;"><?php echo $mac3->remarks ?></p>


                

<p style="text-transform: capitalize;color: #000;font-weight: 500;color:blue"><i class="fa fa-phone"></i> <?php echo $mac3->contact_no ?></p>


               <?php   // }
                  
                }
                if($mac3->job_category_id =='2') { ?>
                  <p style="text-transform: capitalize;color: #000;font-weight: 500;"><i class="fas fa-car-side"></i> <?php echo $mac3->customer_name ?></p>
                  <p style="text-transform: capitalize;color: #000;font-weight: 500;color:blue"><i class="fa fa-phone"></i> <?php echo $mac3->contact_no ?></p>
                  <p style="text-transform: capitalize; color: #000; font-weight: 500;">
                      <i class="fa fa-map-marker-alt"></i> 
                      <?php
                      if ( $city_id == 0 && $area_id == 0) {
                          echo $state_1->name . ", " . $mac3->job_location;
                      } else {
                          // Display state, city, and area names
                          echo $state_1->name . ", " . $mac2_->dir_city_name . ", " . $area3__->dir_area_name;
                      }
                      ?>
                  </p>
              
                  <span class="dots" id="dots<?php echo $i ?>"></span>
                  <span class="more" id="more<?php echo $i ?>" style="display: none;">
                      <p style="text-transform: capitalize;color: #000;font-weight: 500;">Salary Range- <?php echo $mac3->salary_range ?></p>
                      <p style="text-transform: capitalize;">
                          <span style="color: #000;font-weight: 400;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;">
                              Licence No- <?php echo $mac3->licence_no ?>
                          </span>
                      </p>
                      <p style="text-transform: capitalize;">
                          <span style="color: #000;font-weight: 400;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;">
                              Licence Exp Date- <?php echo $newDate ?>
                          </span>
                      </p>
                      <p style="text-transform: capitalize;color: #000;font-weight: 500;color:blue">Experience -<?php echo $mac3->experiences ?> </p>
                      <p style="text-transform: capitalize;color: #000;font-weight: 500;color:blue">Vehicle Name - <?php echo $mac3->vehicle_type ?> </p>
                      <p style="text-transform: capitalize;color: #000;font-weight: 500;color:blue">Driving Experience -  <?php echo $mac3->remarks ?> </p>
                  </span>
              
                  <button class="read-more-btn" onclick="myFunction(<?php echo $i ?>)" id="myBtn<?php echo $i ?>">Read more...</button>
                  <?php } ?>

                <!-- <p style="text-transform: capitalize;color: #000;font-weight: 500;color:blue"><?php echo $mac3_->dir_city_name ?>,<?php echo $area3__->dir_area_name ?></p> -->



                <!-- </span> -->



              <!-- <div  class="mb-3" style="
                  background: #199b37;
                  width: 95%;
                  padding: 7px;
                  text-align: center;
                  /* color: white; */
                  border-radius: 7px;
              "><a  target="_blank"  href = "tel:<?php echo $mac3->contact_no ?>"  style="text-transform: capitalize;color: white;font-weight: 800;font-size: 14px;"><i class="fa fa-phone text-white"></i> Call  </a>
              
            </div> -->
        </div>
      </div>
      </div>
  </div>
</div>



    <?php 
        $i++;

  }
   
if((($ldata == 0) ))
{ ?>
<img src="data1.png" style="width: 100%;"> 
<?php }
?>

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
/* For the button */
a#myBtn {
    color: red;
    font-weight: bold;
    text-decoration: none;
    cursor: pointer;
}

/* Style the hidden content */
.more {
    display: none;
}

/* Style the "dots" */
.dots {
    display: inline;
}

/* Optional: Make sure content is well-aligned */
.card-body {
    padding: 15px;
}

.card-title {
    font-size: 18px;
    font-weight: bold;
}

</style>





<script>

function myFunction(id) {
    var dots = document.getElementById("dots" + id);
    var moreText = document.getElementById('more' + id);
    var btnText = document.getElementById('myBtn' + id);

    // Check if "Read more" or "Read less" is clicked
    if (dots.style.display === "none") {
        dots.style.display = "inline";
        btnText.innerHTML = "Read more...";  // Change button text back to "Read more"
        moreText.style.display = "none";  // Hide extra content
    } else {
        dots.style.display = "none";
        btnText.innerHTML = "Read less...";  // Change button text to "Read less"
        moreText.style.display = "inline";  // Show extra content
    }
}





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




function call_count(id)
{
  // alert(id);
  var id;
  $.ajax({
        type: "POST",
        url: "call_count_check.php",
        data: {id:id}, 
        success: function(data)
        {
          // alert(data);
          console.log(data);

         
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

<!-- <div class="modal fade modal-dialog-centere" id="exampleModalcity" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
</div> -->



<script>
  $("#main_city").change(function(){
 
    $('#exampleModalcity').modal('toggle');
  var city=$("#main_city").val();

  $('#subarea').children('option:not(:first)').remove();
  
  var mid=$('#mid').val();
  var  sid= <?php echo $_GET['sid'] ?>;
  var city_name=$("#main_city :selected").text();
  $.ajax({
        type: "POST",
        url: "se_city.php",
        data: {sid:sid,mid:mid,city:city,city_name:city_name}, 
        success: function(data)
        {
         $('#city_name').html( city_name);
     // Show the block element and set the text
$('#displayArea').css('display', 'block'); // Ensure the element is visible
$('#displayArea').text(city_name); // Set the text content
         // Set the text inside the div with id displayArea
         $('#arearesult').html(data);

        }
    });
    $.ajax({
        type: "POST",
        url: "job_post_se_city_area.php",
        data: {city:city,city_name:city_name}, 
        success: function(data)
        {
          // alert(data);
          // console.log(data);

          $('#fa').html(data);
          //  $('#farea').html( city_name);
         
        }
    });
  



    //city_filter start





//    $.ajax({

// type: "POST",

// url: 'post_city_com.php',

// data: {mid:mid}, // serializes the form's elements.

// success: function(data)

// {
// //  alert(data);
//   $('#arearesult').html(data);



// }

// });

});
</script>

<script>
$( document ).ready(function() {



// $("#sarea").html('<option value="">---SELECT---</option>');
$("#farea").html('<option value="">---SELECT---</option>');

});

 </script>


<script>
//   $("#main_city").change(function(){
//     $('#exampleModalcity').modal('toggle');
//   var city=$("#main_city").val();
  
//   var city_name=$("#main_city :selected").text();
//   $.ajax({
//         type: "POST",
//         url: "se_city.php",
//         data: {city:city,city_name:city_name}, 
//         success: function(data)
//         {
//          $('#city_name').html( city_name);
//         }
//     });

// });
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
  $("#sarea1").change(function(){
  
   var area=$('#sarea').val();
   
   var mid=$('#mid').val();
   $.ajax({

type: "POST",

url: 'job_post_area_com1123.php',

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
  
   $.ajax({

type: "POST",

url: 'job_post_sub_area_com.php',

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

url: 'job_post_area_com1343.php',

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

url: 'job_post_sub_area_com.php',

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

url: 'job_post_sub_area_com.php',

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


</script>

<script>
function loadDistricts(stateId) {
  localStorage.setItem('stateId', stateId); // Save the mobile number in localStorage
  $("#farea").html('<option value="">---SELECT---</option>');
  $("#sarea").html('<option value="">---SELECT---</option>');
  $("#displayArea").hide();

  
  
    if(stateId) {
        $.ajax({
            type: "POST",
            url: "fetch_districts.php",
            data: { state_id: stateId },
            success: function(response) {
                $("#main_city").html(response);
            }
        });
    } else {
        $("#main_city").html('<option value="">---SELECT---</option>');
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