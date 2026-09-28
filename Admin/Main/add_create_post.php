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
    <style>
        .sug-list {
    /* background: #ced4da; */
    list-style: none;
    content: '';
    line-height: 40px;
    border-bottom: 1px solid #ced4da;
    margin-left: -39px;
    padding: 7px;
    border-left: 1px solid #ced4da;
    border-right: 1px solid #ced4da;
}
    </style>
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
						<h4 class="page-title">Create Registration</h4>						 
					</div>					
							<div class="card">
                            <form action="Function/Add_create_post.php" method="post" enctype="multipart/form-data">

									<div class="card-body">
                                     <div class="row">
                                     <div class="form-group col-md-6">    
                                                    <label for="email2">Customer Name</label>
                                                    <input type="text" class="form-control" id="Add_driver_name" onkeyup="cum(this.value)" name="Add_driver_name" required >
                                                    <div id="serach_result">
                                                        <ul class="subnav sug-list-color" id="serach_result1">
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">    
                                                    <label for="email2">Customer Phone No</label>
                                                    <input type="hidden" class="form-control" name="customerid" id="customerid"
                                                    placeholder="">
                                                    <input type="number" class="form-control" id="phone_no" name="Add_phone_no" onkeypress="if(this.value.length==10) return false;" required >
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleFormControlSelect1">Main Category</label> 
                                                    <select required class="form-control" name="Add_main_cate" onchange="maincateg(this.value);">
                                                        <option value="">---SELECT---</option>
                                                    <?php
                                                    $main_cate=mysqli_query($config,"select * from main_category");
                                                    while($addsubcate=mysqli_fetch_object($main_cate))
                                                    {  
                                                    ?>
                                                        <option value="<?php echo $addsubcate->Main_Category_id;?>"><?php echo $addsubcate->Main_Category_Name;?></option>
                                                    <?php } ?>                                                        
                                                    </select>
                                                     
                                                </div> 
                                                    
                                                <div class="form-group col-md-6">    
                                                 <label for="email2">Sub Category Name</label>
                                                    <div id="sc">
                                                    
                                                    </div>
                                                    <div id="filter" >

                                                    </div>                                         
                                                </div>

                                               
                                               

                                             
                                                </div>
                                                                                         
                                                  
                                                   <div class="row">
                                                
                                                
                                               
                                              
                                            
                                            </div>                                          
                                            <div id="commercial" >
                                                
                                            </div>
                                            <div id="passenger" > 

                                            </div>
                                            <div id="spot_punjar" > 

                                            </div>

                                            <div class="row">
                                                
                                                <div class="form-group col-md-6">
                                                    <label for="Add_vehicle_photo">Photo(Size 250 X 250 px & 2 MB)</label>
                                                    <input required type="file" class="form-control" id="Add_vehicle_photo" name="Add_vehicle_photo" onchange="previewImage(this)">
                                                    <img id="imagePreview" src="" alt="Image Preview" style="display:none; margin-top:10px; max-width: 250px; max-height: 250px; border-radius: 8px; border: 1px solid #ccc; padding: 5px;">
                                                </div>
                                                
                                                <script>
                                                    function previewImage(input) {
                                                        var preview = document.getElementById('imagePreview');
                                                        if (input.files && input.files[0]) {
                                                            var reader = new FileReader();
                                                            reader.onload = function(e) {
                                                                preview.src = e.target.result;
                                                                preview.style.display = 'block';
                                                            }
                                                            reader.readAsDataURL(input.files[0]);
                                                        } else {
                                                            preview.src = '';
                                                            preview.style.display = 'none';
                                                        }
                                                    }
                                                </script>
                                              
                                                <div class="form-group col-md-6">
                                                    <label for="email2">Whatsapp No (Driver Number)</label>
                                                    <input  type="text" class="form-control" id="email2" name="Add_whatsapp_no" placeholder="Whatsapp No" onkeypress="if(this.value.length==10) return false;" required >
                                                </div>
                                               
                                                <div class="form-group col-md-6">
    <label for="exampleFormControlSelect1">State</label>
    <select required class="form-control" id="state" name="Add_state">
        <option value="">---SELECT---</option>
        <?php
        $states = mysqli_query($config, "SELECT * FROM dir_state_master");
        while ($state = mysqli_fetch_object($states)) {
        ?>
            <option value="<?php echo $state->state_id; ?>"><?php echo $state->name; ?></option>
        <?php } ?>
    </select>
</div>

<div class="form-group col-md-6">
    <label for="exampleFormControlSelect1">District</label>
    <select required class="form-control" id="city" name="Add_city">
        <option value="">---SELECT---</option>
    </select>
</div>

                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">City</label>
                                                        <div id="area">

                                                        </div>
                                                </div>

                                                <!-- <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Area</label>
                                                        <div id="subarea">

                                                        </div>
                                                </div> -->

                                               
                                                
                                                <div class="form-group col-md-6" style="display:none">
                                                    <label for="email2">Keyword</label>
                                                    <textarea type="text" class="form-control" id="email2" name="Add_meta_keyword" placeholder="Address...."  ></textarea>
                                                </div>
                                                <div class="form-group col-md-6" style="display:none">    
                                                            <label for="email2">General Remarks</label>
                                                            <textarea type="text" class="form-control" id="email2" name="Add_remarks"  ></textarea>
                                                    </div>	
                                                    <div class="form-group col-md-6" style="display:none">
                                                        <label for="email2">Address</label>
                                                        <textarea type="text" class="form-control" id="email2" name="Add_address" placeholder="Address...."  ></textarea>
                                                    </div>
                                                    <div class="form-group col-md-6">    
                                                            <label for="email2">Referred By Mobile No</label>
                                                            <input type="number" class="form-control" id="email2" onkeypress="if(this.value.length==10) return false;" name="reffered_by_phone_no"  >
                                                    </div>	
                                                    <div class="form-group col-md-6">    
                                                            <label for="email2">Referred By Name</label>
                                                            <input type="text" class="form-control" id="email2" name="reffered_by_name"  >
                                                    </div>

                                                    <div class="form-group col-md-6" style="display:none">
                                                    <label for="exampleFormControlSelect1">Active Status</label>
                                                    <select class="form-control" id="exampleFormControlSelect1" name="Add_status">
                                                        <option value="1">Active</option>
                                                        <option value="0">In-Active</option>                                                    
                                                    </select>
                                                </div> 

                                                    <div class="form-group col-md-6">    
                                                 <label for="email2">Package</label>
                                                    <div id="pk">
                                                    
                                                    </div>                                                  
                                                </div>

                                                <div class="form-group col-md-12">                                                      
                                                        <div class="row" id="pkamount">
                                                        
                                                        </div>                                                                                                                                                     
                                                </div>
                                                    </div>
                                                    <div class="mb-3" style="background:#ffe8ec;padding:9px"> 
                                                    <div class="row">  
    <div class="form-group col-md-12">
        <label>Show Discount Coupon ?</label>
        <div>
            <button type="button" class="btn btn-success" onclick="showCouponInput(true)">Yes</button>
            <button type="button" class="btn btn-danger" onclick="showCouponInput(false)">No</button>
        </div>
    </div>  

    <div id="couponSection" style="display: none; width: 100%;">                                      
        <div class="form-group col-md-6">
            <label for="coupon_code">Coupon Code</label>
            <input style="text-transform:uppercase" type="text" class="form-control" id="coupon_code" name="coupon_code" placeholder="">
        </div> 
        <div class="form-group col-md-6">                                      
            <a onclick="couponcode();" class="text-white btn btn-primary btn-lg btn-block">Coupon Check</a>
        </div>   
    </div>  

    <div class="form-group col-md-12">
        <div class="row" id="netamount" style="padding:9px"></div>
    </div>
</div> 

<script>
    function showCouponInput(show) {
        document.getElementById('couponSection').style.display = show ? 'flex' : 'none';
    }
</script>

                                                        <div class="form-group col-md-4">
    <div id="coupon_pack"></div>
</div> 

<div class="form-group col-md-6 ml-3">
    <input class="form-check-input" type="radio" value="1" name="payment_type" id="flexRadioDefault2" checked="">
    <label class="form-check-label mb-2" for="flexRadioDefault2">
        Cash Payment
    </label>

    <input class="form-check-input ml-2" value="2" type="radio" name="payment_type" id="flexRadioDefault1">
    <label class="form-check-label" for="flexRadioDefault1">
        Bank Payment
    </label>
    
    <!-- Reference number field (hidden by default) -->
    <div id="ref_number_field" style="display: none;">
        <label for="reference_number">Reference Number:</label>
        <input type="text" id="reference_number" name ="reference_number" class="form-control" placeholder="Enter reference number">
    </div>
</div>

<script>
    // Get radio buttons and the reference number field
    const radioCash = document.getElementById('flexRadioDefault2');
    const radioBank = document.getElementById('flexRadioDefault1');
    const refNumberField = document.getElementById('ref_number_field');

    // Add event listeners to radio buttons to toggle reference number field visibility
    radioBank.addEventListener('change', function() {
        if (radioBank.checked) {
            refNumberField.style.display = 'block';  // Show reference number field when Bank Payment is selected
        }
    });

    radioCash.addEventListener('change', function() {
        if (radioCash.checked) {
            refNumberField.style.display = 'none';  // Hide reference number field when Cash Payment is selected
        }
    });
</script>

                                                   
                                                      <div id="post_btn">
                                                        <div class="form-group">                                                         
                                                            <button class="btn btn-success" type="submit" name="post_add">Submit</button>
                                                        </div>
                                                     
                
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


                        // if(id == '1')
                        // {                   
                        //     $('#vr').show();
                        //     $('#vrother').hide();
                        // }
                        // else if(id == '2')
                        // {
                        //     $('#vr').show();
                        //     $('#vrother').hide();
                        // }
                        // else
                        // {
                        //     $('#vr').hide();
                        //     $('#vrother').show();
                            
                        // }
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
                          else if(id == '6')
                        {  
                            $.ajax({
                                type: "POST",
                                url:'machinery_detail.php',
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
                                //alert();                    
                                $('#serach_result1').html(data);

                            }
                        });
                    } else {
                        $('#serach_result1').html('');
                    }
                 }


                function serach_result(customerid, name, phone_no)
                 {
                    //alert(name);
                    $('#Add_driver_name').val(name);
                    $('#customerid').val(customerid);
                    $('#serach_result1').html('');
                    $('#phone_no').val(phone_no);
                    // $('#address').val(address);  
                }



                function subcateg(id){
                    var id;                   
                     // alert(id);

                         
                    //  if(id >= 1 && id <= 10)
                    //  {
                    //   $.ajax({
                    //     type: "POST",
                    //     url:'machinery_field.php',
                    //     data: {id:id}, // serializes the form's elements.
                    //     success: function(data)
                    //     {	
                    //      //alert(data);		
                    //     $('#commercial').html(data);
                        
                    //     }			
                    //    });	
                    //  }
                        

                     
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
                        $('#vt').append('<input type="text" id="other_vehicle_type" name="other_vehicle_type" class="form-control mt-2" placeholder="Please Enter Vehicle Model Name" style="display:none;">');

// Attach a change event to the newly added dropdown
$('#Add_vehicle_type').change(function() {
    if ($(this).val() === "0") {
        $('#other_vehicle_type').show(); // Show input box if "Other" is selected
    } else {
        $('#other_vehicle_type').hide(); // Hide input box otherwise
    }
});
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


                    $.ajax({
                        type: "POST",
                        url:'coupon_pack.php',
                        data: {id:id}, // serializes the form's elements.
                        success: function(data)
                        {	
                        // alert(data);		
                        $('#coupon_pack').html(data);
                        
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

            function vehicle_uni(vechilename)
                 {
                   var vechilename;   
                   
                  $.ajax({
                        type: "POST",
                        url:'vehicle_name.php',
                        data: {vechilename:vechilename}, // serializes the form's elements.
                        success: function(data)
                        {	
                       //alert(data);		
                        if(data == 1)
                        {
                          $('#Add_vehicle_no').val('');
                          $('#vehicle_like').html("Vehicle Number Already Registered");
                         
                          
                        }
                        else
                        {
                          $('#vehicle_like').html("");
                        }
                        
                        
                        }			
                    });

                 }




                 function couponcode(){
                   
                        var coupon_code = $('#coupon_code').val();  
                        var pack_id = $('#pack_id').val();
                        var Add_amount = $('#Add_amount').val();
                        var Add_driver_name = $('#Add_driver_name').val();
                        var customerid = $('#customerid').val();
                        

                  
                        $.ajax({
                            type: "POST",
                            url:'coupon_check.php',
                            data: {pack_id:pack_id,coupon_code:coupon_code,Add_amount:Add_amount,Add_driver_name:Add_driver_name,customerid:customerid}, // serializes the form's elements.
                            success: function(data)
                            {	
                           // alert(data);		
                            $('#netamount').html(data);
                            
                            }			
                         });	

                      }

                     
        </script>
<script>
    $(document).ready(function() {
        $('#state').on('change', function() {
            var stateId = $(this).val(); // Get the selected state ID
            $('#Add_area').html('<option value="">---SELECT---</option>');

            
            // Clear and reset the district dropdown
            $('#city').html('<option value="">---SELECT---</option>');

            if (stateId) {
                $.ajax({
                    url: 'fetch_districts.php',
                    type: 'POST',
                    data: { state_id: stateId },
                    success: function(response) {
                        // Populate the district dropdown with options
                        $('#city').html(response);
                    },
                    error: function() {
                        alert('Failed to fetch districts. Please try again.');
                    }
                });
            }
        });
    });
</script>

</body>
</html>