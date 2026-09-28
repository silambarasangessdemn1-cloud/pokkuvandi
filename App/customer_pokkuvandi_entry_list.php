<?php include('config/setup.php');
 include('session.php');
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

      <script src="
      https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js
      "></script>
      <link href="
      https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css
      " rel="stylesheet">
      


   </head>
   <style> 
 .table td, .table th {
    padding: 5px;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
}
th{
  width:30%;
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

     

            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <h5 class="text-center mt-3" >Customer Vehicle Required List</h5>


            <div class="card">

            <div class="container">

            <div class="row">
            <?php  
            // echo $query="select * from customer_pokkuvandi_entry  where cus_pokkuvandi_entry_id ='".$_GET['id']."' order by (cus_pokkuvandi_entry_id ) ASC";
            $main_cate3_cuss=mysqli_query($config,"select * from customer_pokkuvandi_entry  where cus_pokkuvandi_entry_id ='".$_GET['id']."' order by (cus_pokkuvandi_entry_id ) ASC");
            $macate3_cuss=mysqli_fetch_object($main_cate3_cuss);

            
            $originalDate = $macate3_cuss->from_date;
            $newDate = date("d-m-Y h:i a", strtotime($originalDate));



//             $timestamp = strtotime('2009-12-09 13:32:15');
// echo date('d/m/Y', $timestamp);



          // echo "select * from dir_city_master where dir_city_id='$macate3_cuss->from_district'";
   $main_cate=mysqli_query($config,"select * from dir_city_master where dir_city_id='$macate3_cuss->from_district' ");
   $addsubcate=mysqli_fetch_object($main_cate);
   
   $main_cate_to=mysqli_query($config,"select * from dir_city_master where dir_city_id='$macate3_cuss->to_district' ");
   $addsubcate_to=mysqli_fetch_object($main_cate_to);

   $dir_state_master=mysqli_query($config,"select * from dir_state_master where state_id='$macate3_cuss->from_state_id' ");

   $dir_state_master_to=mysqli_fetch_object($dir_state_master);

   $to_state_id=mysqli_query($config,"select * from dir_state_master where state_id='$macate3_cuss->to_state_id' ");
   $to_state_id1=mysqli_fetch_object($to_state_id);
            ?>

              <div class="col-12 text-center"> 
              <img src="img/3156704.jpg" style="
    width: 200px">

            <!-- <table class="table table-striped table-dark"> -->
              <!-- <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">First</th>
                  <th scope="col">Last</th>
                  <th scope="col">Handle</th>
                </tr>
              </thead> -->
              <!-- <tbody>
                <tr>
                
                  <td>District</td>
                  <td>Location</td>
                  <td>Vehicle Model</td>
                  <td>Trip Date</td>
                  <td>Customer Name</td>
                  <td>Contact number</td>
                  <td>Load Details</td>

                </tr>
                <tr>
                  <td><?php echo $addsubcate->dir_city_name?></td>
                  <td><?php echo $macate3_cuss->place?></td>
                  <td><?php echo $macate3_cuss->vehicle_type?></td>
                  <td><?php echo $newDate?></td>
                  <td><?php echo $macate3_cuss->Customer_Name?></td>
                  <td> <?php echo $macate3_cuss->Customer_Phone_No?></td>
                  <td><?php echo $macate3_cuss->general_remarks?></td>
                </tr>
                <tr>
                  <th scope="row">3</th>
                  <td>Larry</td>
                  <td>the Bird</td>
                  <td>@twitter</td>
                </tr>
              </tbody>
            </table> -->




            <table class="table table-bordered" style="text-align: left;">
              <!-- <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">First</th>
                  <th scope="col">Last</th>
                  <th scope="col">Handle</th>
                </tr>
              </thead> -->
              <tbody class="tbl_space">
                <!-- <tr>
                  <th scope="row">District</th>
                  <td><?php echo $addsubcate->dir_city_name?></td>
                  
                </tr> -->
                <th scope="row">State Type</th>
                  <?php if($macate3_cuss->state == 1) { ?>
                    <td>Within State Trip </td>
                    <?php } else { ?>
                    <td>Other State Trip </td>
                    <?php } ?>
                  
                </tr>
                <th scope="row">State</th>
    <td>
        <?php
        if ($macate3_cuss->state == 1) {
            echo "From State: " . $dir_state_master_to->name;
        } else {
            echo "From State: " . $dir_state_master_to->name . " - To State: " . $to_state_id1->name;
        }
        ?>
    </td>
                <?php if($macate3_cuss->state == 1) { ?>
                <tr>
                  <th scope="row">Load Pick Up Place</th>
                  <td><?php echo $macate3_cuss->place?> (<?php echo $addsubcate->dir_city_name?> District)</td>
                </tr>

                <tr>
                  <th scope="row">Load Delivery Place</th>
                  <td><?php echo $macate3_cuss->to_place?> (<?php echo $addsubcate_to->dir_city_name?> District)</td>
                </tr>
                <?php } else { ?>
                  <tr>
                  <th scope="row">Load Pick Up Place</th>
                  <td><?php echo $macate3_cuss->place?>(<?php echo $addsubcate->dir_city_name?> District)</td>
                </tr>

                <tr>
                  <th scope="row">Load Delivery Place</th>
                  <td><?php echo $macate3_cuss->to_place?>(<?php echo $addsubcate_to->dir_city_name?> District)</td>
                </tr>
                  <?php } ?>


                <tr>
                  <th scope="row">Vehicle Model</th>
                  <td> <?php echo $macate3_cuss->vehicle_type?></td>
                </tr>
                <tr>
                  <th scope="row">Vehicle Type</th>
                  <td> <?php echo $macate3_cuss->vehicle_type_cpe?></td>
                </tr>
                <tr>
                  <th scope="row">Trip Date</th>
                  <td><?php echo $newDate?></td>
                </tr>

                <tr>
                  <th scope="row">Customer Name</th>
                  <td><?php echo $macate3_cuss->Customer_Name?></td>
                </tr>
                <?php
// Check if trip status is completed or cancelled - if so, don't show contact number
$tripStatus = $macate3_cuss->trip_status;
$hideContactNumber = ($tripStatus == 'completed' || $tripStatus == 'cancelled');

if (!$hideContactNumber) {
    // Assume logged-in user
    $loggedInUserId = $prof_id;
    $today = date('Y-m-d');
    $canView = false;

    if ($loggedInUserId) {
        // Get user expiry from DB (adjust table/column if needed)
        $user = mysqli_fetch_assoc(mysqli_query($config, "SELECT expiry_date,post_id,category_id FROM create_post WHERE customer_id = $loggedInUserId"));
        $canView = (strtotime($user['expiry_date']) >= strtotime($today));
       $postid = $user['post_id'];
       $cat_id =$user['category_id'];
       
    }
    ?>
                <tr>
    <th scope="row">Contact Number</th>
    <td>
        <button id="showNumberBtn" class="btn btn-sm btn-primary">Show Number</button>
        <span id="contactInfo" class="ms-2 d-none">
            <?php if ($canView): ?>
                <?php echo $macate3_cuss->Customer_Phone_No; ?>
            <?php else: ?>
                <span class="text-danger">Please renew your account</span>
            <?php endif; ?>
        </span>
    </td>
</tr>

<script>
    document.getElementById("showNumberBtn").addEventListener("click", function() {
        this.style.display = "none"; // Hide button
        document.getElementById("contactInfo").classList.remove("d-none");
    });
</script>
                <?php } ?>


                <tr>
                  <th scope="row">Load Details</th>
                  <td><?php echo $macate3_cuss->general_remarks?></td>
                </tr>
                <tr>
  <th scope="row">Post Date</th>
  <td><?php echo date('d-m-Y', strtotime($macate3_cuss->post_date)); ?></td>
</tr>


                <tr>
  <th scope="row">Trip Status</th>
  <td>

  
    <?php
      if ($macate3_cuss->trip_status == null &&  $macate3_cuss->update_status == 0) {
        // If status is null or update_status is 0, consider it Active
        $status_class = 'btn-success';  // Active - Green button
        $status_text = 'Active';
    } elseif ($macate3_cuss->trip_status == 'completed') {
        // If status is completed, consider it Completed
        $status_class = 'btn-success';  // Completed - Green button
        $status_text = 'Completed';
    } elseif ($macate3_cuss->trip_status == 'cancelled') {
        // If status is cancelled, consider it Cancelled
        $status_class = 'btn-danger';   // Cancelled - Red button
        $status_text = 'Cancelled';
    } elseif ($macate3_cuss->update_status == 1) {
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



                <!-- <p style="line-height: 28px;
    font-size: 14px;    padding: 15px"> 
                District: <?php echo $addsubcate->dir_city_name?><br>
                Location: <?php echo $macate3_cuss->place?><br>
                Vehicle Model: <?php echo $macate3_cuss->vehicle_type?></br>
                Trip Date: <?php echo $newDate?><br>
                Customer Name : <?php echo $macate3_cuss->Customer_Name?><br>
                Contact number : <?php echo $macate3_cuss->Customer_Phone_No?><br>
                Load Details : <?php echo $macate3_cuss->general_remarks?><br>
               
              
                
            </p> -->
            <?php 
            if (isset($prof_id) && isset($_SESSION['member_id']) && $_SESSION['member_id'] == $mac__->cust_id) { ?>

            <a data-toggle="modal" data-target="#exampleModaldiable" onclick="diablePopup(<?php echo $mac3->post_id?>)" class="btn btn-primary btn-lg btn-block text-white">
                         Update</a>

                         <?php } ?>
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
                                <h3 style="    text-align: center;
    margin-bottom: 40px;
"> Pokkuvandi Trip Taken Entry (By Driver)</h3>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleFormControlSelect1">Driver Name</label>
                                                    <input   type="text" class="form-control" id="driver_name" name="driver_name" required>
                                                    <input   type="hidden" class="form-control" id="cus_id" name="cus_id" value="<?php echo $_GET['id']?>">

                                                </div> 
                                                <div class="form-group col-md-6">
                                                    <label for="exampleFormControlSelect1">Driver Phone No</label>
                                                    <input   type="text" class="form-control" id="driver_phone_no" name="driver_phone_no" required>
                                                </div> 
                                                <div class="form-group col-md-6">
                                                    <label for="exampleFormControlSelect1">Driver Vehicle Register No</label>
                                                    <input   type="text" class="form-control" id="vehicle_no" name="vehicle_no" required>
                                                </div> 

                                </div>
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



      <script> 
            function pick_up_update(id){
                    var id;
                   //alert(id);
                   var driver_name = $('#driver_name').val();
                   var driver_phone_no = $('#driver_phone_no').val();
                   var vehicle_no = $('#vehicle_no').val();
                   var cus_id = $('#cus_id').val();
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
                   else
                   {

                    $.ajax({
                        type: "POST",
                        url:'cus_pokkuvandi_driver_update.php',
                        data: {id:id,driver_name:driver_name,driver_phone_no:driver_phone_no,vehicle_no:vehicle_no,cus_id:cus_id}, // serializes the form's elements.
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
                                setTimeout(function() {
                                    $('#exampleModaldiable').modal('hide');
                                    }, 1000);
                                    setTimeout(() => { 
                                        window.location.href = ('Directory.php');
                                    }, 2000);
                                    
                        
                        }		
                        	
                    });	
                  }
                    

                }

      </script>

   </body>

</html>




