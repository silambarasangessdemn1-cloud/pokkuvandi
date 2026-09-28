<?php include('../config/setup.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
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
            
            ?> </title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="<?php 
            
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
            
            ?>" type="image/x-icon"/>
	
	<!-- Fonts and icons -->
	<script src="../assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/atlantis.min.css">
	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="../assets/css/demo.css">
</head>
<body>
	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
		 <?php include('logo.php');?>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<?php include('topbar.php');?>
			 <!-- End Navbar -->
		</div>
		<!-- Sidebar -->
		<?php include('sidebar.php');?>
		
		
		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Customer Vechicle Required</h4>
						 
					</div>
					<?php
                    $pid=$_REQUEST['pid'];
// echo $query="select * from create_post where post_id='$pid'";
                    // $main_cate=mysqli_query($config,"select * from create_post where post_id='$pid'");
										// 	$data=mysqli_fetch_object($main_cate);
                                             ?>
							<div class="card">
                            <form action="Function/customer_Editt_pokkuvandi.php" method="post" enctype="multipart/form-data">
                          
									<div class="card-body">
                                     <div class="row">
                                     <?php 


$i=0;
 $or_loader="SELECT * FROM `customer_pokkuvandi_entry`  where cus_pokkuvandi_entry_id='$pid' Order by cus_pokkuvandi_entry_id DESC ";
$maincate3_loader=mysqli_query($config,$or_loader);             
$mac3_loader=mysqli_fetch_object($maincate3_loader);
 $mac3_loader->state_status;

$from_date= $mac3_loader->from_date;
// $loader_to_time= $mac3_loader->loader_to_time;
// $loader_from_date= $mac3_loader->loader_from_date;
// $loader_from_time= $mac3_loader->loader_from_time;
// date_default_timezone_set('Asia/Kolkata'); 
// $from_date_time = date('Y-m-d H:i', strtotime("$loader_from_date $loader_from_time"));
// $to_date_time = date('Y-m-d H:i', strtotime("$loader_to_date $loader_to_time"));

$from_date_time = date('Y-m-d H:i', strtotime("$from_date"));


?>


<div class="form-group col-md-6">    
 <label for="email2">Customer Name</label>
 <input  value="<?php echo $mac3_loader->Customer_Name ?>" type="text" class="form-control" id="customer_name" name="customer_name"   >
 <input  value="<?php echo $mac3_loader->cus_pokkuvandi_entry_id ?>" type="hidden" class="form-control" id="id" name="id"  >

</div>

<div class="form-group col-md-6">    
 <label for="email2">Customer Phone No</label>
 <input  value="<?php echo $mac3_loader->Customer_Phone_No ?>" type="text" class="form-control" id="customer_phone_no" name="customer_phone_no"   >
</div>


<div class="form-group col-md-6">    
 <label for="email2">Vehicle Required Date</label>
 <input value="<?php echo $from_date_time ?>" type="datetime-local" class="form-control" id="from_date" name="from_date"  >
</div> 
<div class="form-group col-md-6">
    <label for="exampleFormControlSelect1">State</label>
        <select class="form-control" id="state_status" onchange="state_cha(this.value)" name="state_status">
        <option value="0">--SELECT--</option>
        <option  <?php if($mac3_loader->state == 1) { ?> selected="selected" <?php } ?> value="1">Within State Trip</option>
        <option <?php if($mac3_loader->state == 2 ||$mac3_loader->state == 0) { ?> selected="selected" <?php } ?> value="2">Other State Trip </option>                                                    
        </select>
 </div>

 <div class="form-group col-md-6">
    <label>Vehicle Type</label>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="vehicle_type_cpe" id="goods_vehicle" value="goods" required=""
        <?php echo ($mac3_loader->vehicle_type_cpe == 'goods') ? 'checked' : ''; ?>>
        <label class="form-check-label" for="goods_vehicle">
            Goods Vehicle
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="vehicle_type_cpe" id="passenger_vehicle" value="passenger" required=""
        <?php echo ($mac3_loader->vehicle_type_cpe == 'passenger') ? 'checked' : ''; ?>>
        <label class="form-check-label" for="passenger_vehicle">
            Passenger Vehicle
        </label>
    </div>
</div>

 </div>


 <div class="row" id="state_field">
<?php 
 if($mac3_loader->state == 1) {  ?>
 <div class="form-group col-md-6">
<label for="exampleFormControlSelect1">From State </label>
    <select required class="form-control" id="state" name="state" onchange="loadDistricts(this.value)">
        <option value="">---SELECT---</option>
      <?php 
        $main_cate=mysqli_query($config,"select * from dir_state_master");
        while($addsubcate=mysqli_fetch_object($main_cate))
      
       {?>
        <option <?php if( $mac3_loader->from_state_id == $addsubcate->state_id) { ?>Selected="selected" <?php }?> value="<?php echo $addsubcate->state_id ?>"><?php echo $addsubcate->name ?></option>
        
         <?php } ?>
       </select>
</div>
<div class="form-group col-md-6">
<label for="exampleFormControlSelect1">From District </label>
    <select required class="form-control" id="from_district" name="from_district" >
        <option value="">---SELECT---</option>
      <?php 
        $main_cate=mysqli_query($config,"select * from dir_city_master");
        while($addsubcate=mysqli_fetch_object($main_cate))
      
       {?>
        <option <?php if( $mac3_loader->from_district == $addsubcate->dir_city_id) { ?>Selected="selected" <?php }?> value="<?php echo $addsubcate->dir_city_id ?>"><?php echo $addsubcate->dir_city_name ?></option>
        
         <?php } ?>
       </select>
</div>



<div class="form-group col-md-6">    
            <label for="email2">From Place</label>
            <input type="text" value="<?php echo $mac3_loader->place?>"  class="form-control" id="loader_from_place" name="loader_from_place" required="">
            </div>



<div class="form-group col-md-6">
<label for="exampleFormControlSelect1">To District </label>
    <select required class="form-control" id="to_district" name="to_district">
        <option value="">---SELECT---</option>
      <?php  
        $main_cate=mysqli_query($config,"select * from dir_city_master");
        while($addsubcate=mysqli_fetch_object($main_cate))
      
       { ?>
        <option  <?php if( $mac3_loader->to_district == $addsubcate->dir_city_id) { ?>Selected="selected" <?php }?> value="<?php echo $addsubcate->dir_city_id ?>"><?php echo $addsubcate->dir_city_name  ?></option>
        
       <?php }   ?>                                              
      </select>
</div>


<?php
        }
        else{
          ?>
            <div class="form-group col-md-6">
<label for="exampleFormControlSelect1">From State </label>
    <select required class="form-control" id="state" name="state" onchange="loadDistricts(this.value)">
        <option value="">---SELECT---</option>
      <?php 
        $main_cate=mysqli_query($config,"select * from dir_state_master");
        while($addsubcate=mysqli_fetch_object($main_cate))
      
       {?>
        <option <?php if( $mac3_loader->from_state_id == $addsubcate->state_id) { ?>Selected="selected" <?php }?> value="<?php echo $addsubcate->state_id ?>"><?php echo $addsubcate->name ?></option>
        
         <?php } ?>
       </select>
</div>
<div class="form-group col-md-6">
<label for="exampleFormControlSelect1">From District </label>
    <select required class="form-control" id="from_district" name="from_district" >
        <option value="">---SELECT---</option>
      <?php 
        $main_cate=mysqli_query($config,"select * from dir_city_master");
        while($addsubcate=mysqli_fetch_object($main_cate))
      
       {?>
        <option <?php if( $mac3_loader->from_district == $addsubcate->dir_city_id) { ?>Selected="selected" <?php }?> value="<?php echo $addsubcate->dir_city_id ?>"><?php echo $addsubcate->dir_city_name ?></option>
        
         <?php } ?>
       </select>
</div>



<div class="form-group col-md-6">    
            <label for="email2">From Place</label>
            <input type="text" value="<?php echo $mac3_loader->place?>"  class="form-control" id="loader_from_place" name="loader_from_place" required="">
            </div>


            <div class="form-group col-md-6">
<label for="exampleFormControlSelect1">To State </label>
    <select required class="form-control" id="to_state" name="to_state" onchange="toloadDistricts(this.value)">
        <option value="">---SELECT---</option>
      <?php 
        $main_cate=mysqli_query($config,"select * from dir_state_master");
        while($addsubcate=mysqli_fetch_object($main_cate))
      
       {?>
        <option <?php if( $mac3_loader->to_state_id == $addsubcate->state_id) { ?>Selected="selected" <?php }?> value="<?php echo $addsubcate->state_id ?>"><?php echo $addsubcate->name ?></option>
        
         <?php } ?>
       </select>
</div>
<div class="form-group col-md-6">
<label for="exampleFormControlSelect1">To District </label>
    <select required class="form-control" id="to_district" name="to_district">
        <option value="">---SELECT---</option>
      <?php  
        $main_cate=mysqli_query($config,"select * from dir_city_master");
        while($addsubcate=mysqli_fetch_object($main_cate))
      
       { ?>
        <option  <?php if( $mac3_loader->to_district == $addsubcate->dir_city_id) { ?>Selected="selected" <?php }?> value="<?php echo $addsubcate->dir_city_id ?>"><?php echo $addsubcate->dir_city_name  ?></option>
        
       <?php }   ?>                                              
      </select>
</div>
       <?php }
 ?>

</div>

<div class="row">
<div class="form-group col-md-6">    
 <label for="email2">To Place</label>
 <input value="<?php echo $mac3_loader->to_place ?>"  type="text" class="form-control" id="loader_to_place" name="loader_to_place"  >
</div>   



<div class="form-group col-md-6">    
 <label for="email2">Required Vehicle Type</label>
 <input value="<?php echo $mac3_loader->vehicle_type ?>"  type="text" class="form-control" id="vehicle_type" name="vehicle_type"  >
</div>  
<div class="form-group col-md-6">    
 <label for="email2">Load Details</label>
 <input  value="<?php echo $mac3_loader->general_remarks ?>" type="text" class="form-control" id="general_remarks" name="general_remarks"  >
</div>

<input type="hidden" value="<?php echo $_GET['pid'] ?>" class="form-control" id="post_id" name="post_id">


    <!-- Fields to show based on status -->
    <div class="row" style="
    width: 100%;
    max-width: 323px;
">
    <div class="form-group col-md-6">
        <label for="status">Trip Status</label>
        <select class="form-control" id="status" name="status" >
            <option value="">---SELECT---</option>
            <option value="completed" <?php echo ($mac3_loader->trip_status == 'completed') ? 'selected' : ''; ?>>Completed</option>
            <option value="cancelled" <?php echo ($mac3_loader->trip_status == 'cancelled') ? 'selected' : ''; ?>>Cancelled</option>
        </select>
    </div>
</div>

<!-- Fields to show based on status -->
<div id="statusFields" style="display: none;">
    <div id="completedFields" style="display: none;">
        <div class="row">
            <div class="form-group col-md-6">
                <label for="driver_name">Driver Name</label>
                <input type="text" class="form-control" id="driver_name" name="driver_name"   value="<?php echo htmlspecialchars($mac3_loader->driver_name); ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="driver_phone_no">Driver Phone No</label>
                <input type="text" class="form-control" id="driver_phone_no" name="driver_phone_no" value="<?php echo htmlspecialchars($mac3_loader->driver_phone_no); ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="vehicle_no">Driver Vehicle Register No</label>
                <input type="text" class="form-control" id="vehicle_no" name="reg_veh_no"  value="<?php echo htmlspecialchars($mac3_loader->reg_veh_no); ?>">
            </div>
        </div>
    </div>

    <div id="cancelledFields" style="display: none;">
        <div class="row">
        <div class="form-group col-md-6">
                <label for="cancellation_reason">Reason for Cancellation</label>
                <input type="text" class="form-control" id="reson_for_cancel" name="reson_for_cancel" 
                       value="<?php echo htmlspecialchars($mac3_loader->reson_for_cancel); ?>" >
            </div>
            <div class="form-group col-md-6">
                <label for="cancellation_date">Cancellation Date</label>
                <input type="datetime-local" class="form-control" id="cancell_date" name="cancell_date" 
                       value="<?php echo htmlspecialchars($mac3_loader->cancell_date); ?>" >
            </div>
        </div>
    </div>
</div>

<!-- Hidden Input for ID -->

<!-- Submit Button -->

<script>
document.addEventListener('DOMContentLoaded', function () {
    var statusDropdown = document.getElementById('status');
    var statusFields = document.getElementById('statusFields');
    var completedFields = document.getElementById('completedFields');
    var cancelledFields = document.getElementById('cancelledFields');

    function updateFields() {
        statusFields.style.display = 'none';
        completedFields.style.display = 'none';
        cancelledFields.style.display = 'none';

        if (statusDropdown.value === 'completed') {
            statusFields.style.display = 'block';
            completedFields.style.display = 'block';
        } else if (statusDropdown.value === 'cancelled') {
            statusFields.style.display = 'block';
            cancelledFields.style.display = 'block';
        }
    }

    // Run on page load to show the correct fields
    updateFields();

    // Update fields when status is changed
    statusDropdown.addEventListener('change', updateFields);
});
</script>

 

</div> </div>

<div class="row">
<div class="form-group text-center mt-3">
    <button class="btn btn-success" name="post_add" type="submit">Update</button>
</div>
</div>
                            </form>
						</div>
	                </div>
				</div>
			</div>
			
		 <?php include('footer.php');?>
		</div>
		
		 
		<!-- End Custom template -->
	</div>
	<!--   Core JS Files   -->
	<script src="../assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="../assets/js/core/popper.min.js"></script>
	<script src="../assets/js/core/bootstrap.min.js"></script>
	<!-- jQuery UI -->
	<script src="../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
	
	<!-- jQuery Scrollbar -->
	<script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
	<!-- Datatables -->
	<script src="../assets/js/plugin/datatables/datatables.min.js"></script>
	<!-- Atlantis JS -->
	<script src="../assets/js/atlantis.min.js"></script>
	<!-- Atlantis DEMO methods, don't include it in your project! -->
	<script src="../assets/js/setting-demo2.js"></script>
	<script >
		$(document).ready(function() {
			$('#basic-datatables').DataTable({
			});

		 
 
			 
		});
	</script>
       <script>
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
        </script>


<script>
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
                            $.ajax({
                                type: "POST",
                                url:'commercial_detail.php',
                                data: {id:id}, // serializes the form's elements.
                                success: function(data)
                                {	
                                  //  alert(data);		
                                $('#commercial').html(data);
                               
                                }			
                            });	
                          }

                         else if(id == '2')
                        {  
                            $.ajax({
                                type: "POST",
                                url:'passenger.php',
                                data: {id:id}, // serializes the form's elements.
                                success: function(data)
                                {	
                                  //  alert(data);		
                                $('#commercial').html(data);
                               
                                }			
                            });	
                          }
                          else if(id == '3')
                        {  
                            $.ajax({
                                type: "POST",
                                url:'ambulance.php',
                                data: {id:id}, // serializes the form's elements.
                                success: function(data)
                                {	
                                  //  alert(data);		
                                $('#commercial').html(data);
                               
                                }			
                            });	
                          }

                       else if(id == '4')
                        {  
                            $.ajax({
                                type: "POST",
                                url:'spot_punjar_detail.php',
                                data: {id:id}, // serializes the form's elements.
                                success: function(data)
                                {	
                                   //alert(data);		
                                $('#commercial').html(data);
                                
                                }			
                            });	
                          }
                          else if(id == '5')
                        {  
                            $.ajax({
                                type: "POST",
                                url:'vehicle_mechanic_detail .php',
                                data: {id:id}, // serializes the form's elements.
                                success: function(data)
                                {	
                                  // alert(data);		
                                $('#commercial').html(data);
                                
                                }			
                            });	
                          }
                          else
                          {
                            $('#commercial').hide();
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

                                 
                     if(id >= 1 && id <= 10)
                     {
                      $.ajax({
                        type: "POST",
                        url:'machinery_field.php',
                        data: {id:id}, // serializes the form's elements.
                        success: function(data)
                        {	
                         //alert(data);		
                        $('#commercial').html(data);
                        
                        }			
                       });	
                     }

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
                    $.ajax({
                        type: "POST",
                        url:'vehicle_type_admin.php',
                        data: {id:id}, // serializes the form's elements.
                        success: function(data)
                        {	
                            // alert(data);		
                        $('#vt').html(data);
                        
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
                $('#subarea').html(data);

                console.log(data);
                }
            });
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
<script>
function loadDistricts(stateId) {
  $("#from_district").html('<option value="">---SELECT---</option>');
  $("#to_district").html('<option value="">---SELECT---</option>');
    if(stateId) {
        $.ajax({
            type: "POST",
            url: "fetch_districts.php",
            data: { state_id: stateId },
            success: function(response) {
                $("#from_district").html(response);
                $("#to_district").html(response);
                
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

</body>
</html>