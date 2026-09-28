<?php include('config/setup.php');
 include('session.php');


 session_start();

// Generate a unique token
$token = bin2hex(random_bytes(32));

// Store the token in the session
 $_SESSION['form_token'] = $token;
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
            <h5 class="text-center mt-3 mb-3"  >Customer Vehicle Requirement Entry</h5>


            <div class="card">

            <div class="container">

   <div class="row">
     <div style="border-bottom: 0px solid #e5e5e5 !important" class="modal-header">
     <?php 
     if($_GET['msg'])
     {?>
     <div class="col-md-12 col-sm-12 ">  
         <div class="alert alert-success" role="alert">
          Post Successfully
      </div>
    </div>
     <?php } ?>
  
     </div>
     <div class="modal-body">
     <div class="contact-form default-form">
     <form action="customer_pokkuvandi_insert.php" method="post">
     <div class="row clearfix" > 
     <input type="hidden" name="form_token" value="<?php echo $token; ?>">
     <input type="hidden" name="cust_id" value="<?php echo $prof_id; ?>">

     
                               <div class="form-group col-md-6">    
                                 <label for="email2"> Customer Name</label>
                                 <input  type="text" class="form-control" id="name" name="name" required >
                              </div>
                              <div class="form-group col-md-6">    
                                 <label for="email2"> Customer Mobile Number </label>
                                 <input  type="text" class="form-control" id="customer_phone" name="customer_phone"  required>
                              </div>

                           


<!-- 
<div class="form-group col-md-6">    
 <label for="email2">To Date</label>
 <input value="'<?php echo $to_date_time ?>'" type="datetime-local" class="form-control" id="loader_to_date" name="loader_to_date"  >
</div>  -->
         
<!-- <div class="form-group col-md-6">
                                                    <label for="exampleInputName1">Customer District Name</label>
                                                        <select required class="form-control" id='city' name="Add_city">
                                                            <option value="">---SELECT---</option>
                                                            <?php
                                                            $main_cate=mysqli_query($config,"select * from dir_city_master");
                                                            while($addsubcate=mysqli_fetch_object($main_cate))
                                                            {  
                                                            ?>
                                                            <option value="<?php echo $addsubcate->dir_city_id ;?>"><?php echo $addsubcate->dir_city_name;?></option>
                                                            <?php } ?>                                                        
                                                        </select>
                                                       
                                                </div> -->

                                                <div class="form-group col-md-6">    
                           <label for="email2"> Vehicle Required Date</label>
                           <input  type="datetime-local" class="form-control" id="loader_from_date" name="loader_from_date" required >
                           </div>
                           <script>
                           document.addEventListener('DOMContentLoaded', function() {
                               var dateInput = document.getElementById('loader_from_date');
                               var now = new Date();
                               var today = new Date(now.getFullYear(), now.getMonth(), now.getDate()).toISOString().slice(0, 16);
                               
                               // Calculate date 10 days from now
                               var maxDate = new Date();
                               maxDate.setDate(maxDate.getDate() + 10);
                               var maxDateStr = maxDate.toISOString().slice(0, 16);
                               
                               // Set min to today, max to 10 days from now
                               dateInput.min = today;
                               dateInput.max = maxDateStr;
                               
                               // Add validation on form submit
                               var form = document.querySelector('form[name="customer_add"]') || document.querySelector('form');
                               if (form) {
                                   form.addEventListener('submit', function(e) {
                                       var selectedDate = new Date(dateInput.value);
                                       var minDate = new Date(now.toISOString().slice(0, 16));
                                       var maxAllowedDate = new Date(maxDate.toISOString().slice(0, 16));
                                       
                                       if (selectedDate < minDate) {
                                           e.preventDefault();
                                           alert('Vehicle Required Date cannot be in the past. Please select today or a future date.');
                                           return false;
                                       }
                                       
                                       if (selectedDate > maxAllowedDate) {
                                           e.preventDefault();
                                           alert('Vehicle Required Date cannot be more than 10 days from now.');
                                           return false;
                                       }
                                   });
                               }
                           });
                           </script>
                           <div class="form-group col-md-6">
    <label>Vehicle Type</label>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="vehicle_type_cpe" id="goods_vehicle" value="goods" required>
        <label class="form-check-label" for="goods_vehicle">
            Goods Vehicle
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="vehicle_type_cpe" id="passenger_vehicle" value="passenger" required>
        <label class="form-check-label" for="passenger_vehicle">
            Passenger Vehicle
        </label>
    </div>
</div>

                           <div class="form-group col-md-6">
    <label for="exampleFormControlSelect1">State</label>
        <select required="" class="form-control" id="state_status" onchange="state_cha(this.value)" name="state_status">
        <option value="">--SELECT--</option>
        <option value="1">Within State Trip </option>
        <option value="2">Other State Trip</option>                                                    
        </select>
 </div>


 </div>
 <div class="row clearfix" id="state_field">

</div>
<div class="row clearfix" >

                                                <!-- <div class="form-group col-md-6">    
                                                <label for="email2">Load Pick Up Place</label>
                                                <input   type="text" class="form-control" id="loader_from_place" name="loader_from_place" required >
                                                </div>   -->


      <div class="form-group col-md-6">    
      <label for="email2"> Delivery Place</label>
      <input   type="text" class="form-control" id="loader_to_place" name="loader_to_place" placeholder="Location Name"  required >
      </div>  


<div class="form-group col-md-6">    
 <label for="email2">Required Vehicle Type</label>
 <input  type="text" class="form-control" id="vehicle_type" name="vehicle_type" placeholder="Auto/Pickup/Van/Lorry" required>
</div>  
<!-- <div class="form-group col-md-6">    
 <label for="email2">Available Space</label>
 <input  type="text" class="form-control" id="loader_space" name="loader_space"  >
</div>   -->
<div class="form-group col-md-6">    
 <label for="email2">Load/Trip Details</label>
 <input   type="text" class="form-control" id="loader_remarks" name="loader_remarks"  required>
</div>

<div class="form-group col-md-6">    
    <label for="email2" style="color: red; font-weight: bold;">Notes:</label>  
    <ul style="color: red; padding-left: 15px;">
        <li style="margin-bottom: 10px;">This Vehicle Requirements Details Will Be Expired On The Next Day Of The Vehicle Required Date.</li>
        <li>After the vehicle is booked, please update the "Vehicle Driver Number" details in the "Customer Vehicle Required List" (Customer Menu) to complete/close the trip.</li>
    </ul>
</div>

<input  type="hidden" value="'<?php echo $id ?>'" class="form-control" id="post_id" name="post_id"  >

    <div class="form-group">
 
    <button type="submit"  class="btn btn-success ml-1"  name="customer_add">submit</a>
    <!-- <button type="button" class="btn btn-secondary ml-2" data-dismiss="modal">Close</button> -->
   </div>
   <?php

?>
                               </div>


                               
                           </form>
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
    function disableSubmitButton() {
        var submitButton = document.querySelector('button[name="customer_add"]');
        submitButton.disabled = true;
    }
</script>

<script> 
  function state_cha(id)
            {
            var id;
            // alert(id);
            // if(id == 1) {
              $.ajax({
                type: "POST",
                url: "state_field_customer.php",
                data:{id:id}, 
                success: function(data)
                {
                //   alert(data);
                $('#state_field').html(data);

                console.log(data);
                }
            });
          // }
          // else
          // {
          //   $('#state_field').html('');
          // }

            }
</script>


   </body>

</html>


<script>
function loadDistricts(stateId) {
    if(stateId) {
        $.ajax({
            type: "POST",
            url: "fetch_districts.php",
            data: { state_id: stateId },
            success: function(response) {
                $("#from_district").html(response);

                
            }
        });
    } else {
        $("#from_district").html('<option value="">---SELECT---</option>');
        $("#to_district").html('<option value="">---SELECT---</option>');

    }
}
function toloadDistricts(stateId) {
    if(stateId) {
        $.ajax({
            type: "POST",
            url: "fetch_districts.php",
            data: { state_id: stateId },
            success: function(response) {
                $("#to_district").html(response);

                
            }
        });
    } else {
        $("#from_district").html('<option value="">---SELECT---</option>');
        $("#to_district").html('<option value="">---SELECT---</option>');

    }
}
</script>

