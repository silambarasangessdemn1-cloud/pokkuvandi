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
						<h4 class="page-title">Job Search</h4>						 
					</div>					
							<div class="card">
                            <form action="Function/Add_job_post.php" method="post" enctype="multipart/form-data">
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
                                                    <label for="exampleFormControlSelect1">Job Category</label> 
                                                    <select required class="form-control" name="Add_job_cate" onchange="job_category(this.value);">
                                                        <option value="">---SELECT---</option>
                                                    <?php
                                                    $main_cate=mysqli_query($config,"select * from job_search_category where Main_Category_Status ='1' ");
                                                    while($addsubcate=mysqli_fetch_object($main_cate))
                                                    {  
                                                    ?>
                                                        <option value="<?php echo $addsubcate->Main_Category_id;?>"><?php echo $addsubcate->Main_Category_Name;?></option>
                                                    <?php } ?>                                                        
                                                    </select>
                                                     
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


                                                </div> 
                                                <div class="row" id="cat_filter">
                                                <!-- <div class="form-group col-md-6">    
                                                    <label for="email2">Job Name</label>
                                                    <input type="text" value="<?php echo  $job_name ?>" class="form-control" id="job_name" name="job_name" >                                                   
                                                </div>
                                                <div class="form-group col-md-6">    
                                                    <label for="email2">Experiences</label>
                                                   
                                                    <input type="number" value="<?php echo  $exprinace ?>" class="form-control" id="experiences" name="experiences">
                                                </div>
                                                <div class="form-group col-md-6">    
                                                    <label for="email2">Qualification</label>
                                                    <input type="text" value="<?php echo  $qualification ?>" class="form-control" id="qualification" name="qualification"  >                                                   
                                                </div>
                                               
                                              
                                                <div class="form-group col-md-6">
                                                    <label for="email2">Company Name</label>
                                                    <input  type="text" class="form-control" id="email2" name="company_name" placeholder="Comapny Name" >
                                                </div>
                                              
                                           
                                                <div class="form-group col-md-6">
                                                    <label for="exampleFormControlSelect1">District</label>
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
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">City</label>
                                                        <div id="area">

                                                        </div>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Area</label>
                                                        <div id="subarea">

                                                        </div>
                                                </div>

                                                <div class="form-group col-md-6" >
                                                    <label for="email2">Salary Range</label>
                                                    <input type="text" class="form-control" id="email2" name="salary_range" placeholder="Salary Range...."  >
                                                </div>
                                               
                                                <div class="form-group col-md-6" >
                                                    <label for="email2">Contact No</label>
                                                    <input type="text" class="form-control" id="contact_no" name="contact_no" placeholder="Contact No...."  >
                                                </div>
                                                <div class="form-group col-md-6" >
                                                    <label for="email2">Email Id</label>
                                                    <input type="text" class="form-control" id="email_id" name="email_id" placeholder="email_id...."  >
                                                </div>
                                                <div class="form-group col-md-6" >    
                                                            <label for="email2">Last Date</label>
                                                            <input  type="date" class="form-control" id="last_date" name="last_date"  >
                                                    </div>
                                                    
                                                    <div class="form-group col-md-6" >    
                                                            <label for="email2">Address</label>
                                                            <textarea type="text" class="form-control" id="email2" name="address"  ></textarea>
                                                            </div>
                                                <div class="form-group col-md-6" >    
                                                            <label for="email2">General Remarks</label>
                                                            <textarea type="text" class="form-control" id="email2" name="Add_remarks"  ></textarea>
                                                    </div>	

                                                    <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Amount</label>
                                                        <div id="amount_job">

                                                        </div>
                                                </div> -->
                                                           
                                                        </div> 
                                                  </div> 

                                                   

                                                   
                                                      <!-- <div id="post_btn"> -->
                                                        <div class="form-group">                                                         
                                                            <button class="btn btn-success" type="submit" name="post_add">Submit</button>
                                                        </div>
                                                     
                                                        <!-- </div>  -->
									</div>
                  
                  
                                              
                            </form>

                            		


						</div>
	                </div>
                    <?php include('footer.php');?>
				</div>
			</div>
			
	
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
                    
                  
                        $.ajax({
                            type: "POST",
                            url:'coupon_check.php',
                            data: {pack_id:pack_id,coupon_code:coupon_code,Add_amount:Add_amount,Add_driver_name:Add_driver_name}, // serializes the form's elements.
                            success: function(data)
                            {	
                           // alert(data);		
                            $('#netamount').html(data);
                            
                            }			
                         });	

                      }

       


         
         


          function job_category(id)
          {
            var id = id;


        $.ajax({
              type: "POST",
              url: "driver_job_categor_fil.php",
              data:{id:id}, 
              success: function(data)
              {
                // alert(data);
              $('#cat_filter').html(data);
         
              console.log(data);
              }
          });




          $.ajax({
              type: "POST",
              url: "job_amount.php",
              data:{id:id}, 
              success: function(data)
              {
                //alert(data);
              $('#amount_job').html(data);
         
              console.log(data);
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