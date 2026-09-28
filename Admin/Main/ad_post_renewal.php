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
						<h4 class="page-title">Registration Renewal</h4>
						 
					</div>
					<?php
                    $pid=$_REQUEST['pid'];
                    // echo "select * from create_post where post_id='$pid'";
                    $main_cate=mysqli_query($config,"select * from create_post where post_id='$pid'");
											$data=mysqli_fetch_object($main_cate);
                                            $pk_idd = $data->package_id;
                                             ?>
							<div class="card">
                            <form action="Function/ad_add_renewal.php" method="post" enctype="multipart/form-data">
                          
									<div class="card-body">
                                     <div class="row">
                                        
                                     <div class="form-group col-md-6">    
                                                    <label for="email2">Customer Name</label>
                                                    <input type="text" class="form-control" id="Add_driver_name" value="<?php echo $data->driver_name ?>" onkeyup="cum(this.value)" name="Add_driver_name" required readonly >
                                                    <div id="serach_result">
                                                        <ul class="subnav sug-list-color" id="serach_result1">
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">    
                                                    <label for="email2">Vehicle Reg No</label>
                                                    <input type="text" class="form-control" id="" value="<?php echo $data->vehicle_no ?>" onkeyup="cum(this.value)" name="" required readonly >
                                                    <div id="serach_result">
                                                        <ul class="subnav sug-list-color" id="serach_result1">
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">    
                                                    <label for="email2">Transport Name</label>
                                                    <input type="text" class="form-control" id="" value="<?php echo $data->vehicle_name ?>" onkeyup="cum(this.value)" name="" required readonly >
                                                    <div id="serach_result">
                                                        <ul class="subnav sug-list-color" id="serach_result1">
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">    
                                                    <label for="email2">Customer Phone No</label>
                                                    <input type="hidden" class="form-control" value="<?php echo $data->customer_id ?>"  name="customerid" id="customerid"
                                                    placeholder="" readonly>
                                                    <input type="number" class="form-control" id="phone_no" value="<?php echo $data->phone_no ?>"   name="Add_phone_no" onkeypress="if(this.value.length==10) return false;" required >
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleFormControlSelect1">Main Category</label> 
                                                    <select required class="form-control" name="Add_main_cate" onchange="maincateg(this.value);" readonly>
                                                        <option value="">---SELECT---</option>
                                                    <?php
                                                    $main_cate=mysqli_query($config,"select * from main_category");
                                                    while($addsubcate=mysqli_fetch_object($main_cate))
                                                    {  
                                                    ?>
                                                        <option <?php if($addsubcate->Main_Category_id == $data->category_id) {?>selected="selected"<?php }?> value="<?php echo $addsubcate->Main_Category_id;?>"><?php echo $addsubcate->Main_Category_Name;?></option>
                                                    <?php } ?>                                                        
                                                    </select>
                                                     
                                                </div> 
                                                    
                                                <div class="form-group col-md-6">    
                                                 <label for="email2">Sub Category Name</label>
                                                    <div id="sc">
                                                    <select required class="form-control" onchange="subcateg(this.value);" name="Add_sub_category" id="Add_sub_cate_Name" readonly >
                                                    <option  value="">---Select---</option>
                                                    <?php
                                                      $shop_master_=mysqli_query($config,"select * from sub_category where Sub_Category_Status=1");
                                                      while($sm_=mysqli_fetch_object($shop_master_))
                                                      { 
                                                    ?>
                                                        <option <?php if($sm_->Sub_Category_id == $data->subcategory_id) {?>selected="selected"<?php }?> value="<?php echo $sm_->Sub_Category_id;?>"><?php echo $sm_->Sub_Category_Name;?></option>
                                                    <?php } ?>                                                        
                                                    </select>
                                                    </div>
                                                    <div id="filter" >

                                                    </div>                                         
                                                </div>

                                               
                                               

                                                </div>
                                                <!-- <div class="mb-3" style="background:#ffe8ec;padding:9px"> 
                                                      <div class="row">                                        
                                                        <div class="form-group col-md-6">
                                                            <label for="email2">Coupon Code</label>
                                                            <input style="text-transform:uppercase" type="text" class="form-control" id="coupon_code" name="coupon_code"  placeholder=""  >
                                                        </div> 
                                                        <div class="form-group col-md-6">                                      
                                                            <a onclick="couponcode();"  class="text-white btn btn-primary btn-lg btn-block">Coupon Check</a>
                                                        </div> 
                                                                                                                
                                                            <div class="form-group col-md-12" >
                                                                <div class="row" id="netamount" style="padding:9px">

                                                                </div>
                                                       // <input type="text" class="form-control" id="email2" name="net_amount"  placeholder=""  readonly>
                                                            </div>
                                                           
                                                        </div> 
                                                        <div class="form-group col-md-4">
                                                           <div id="coupon_pack">

                                                            </div>                                                            
                                                        </div> 
                                                      </div>                                           -->
                                                  
                                                   <div class="row">
                                                
                                                
                                               
                                              
                                            
                                            </div>                                          
                      

                                            
                                                   

                                                    <div class="form-group col-md-6">    
                                                 <label for="email2">Package</label>
                                                    <div id="pk">
                                                    <select required class="form-control" name="Add_package" id="Add_package" onchange="package(this.value);" ><option  value="">---Select---</option>';
<?php                                                      
                                                           $main_cate=mysqli_query($config,"select * from category_package where Main_category_id ='$data->category_id' and status='1' ");
                                                           while($addsubcate=mysqli_fetch_object($main_cate))
                                                           {  


                                                           
                                                        


                                                           ?>
                                                           <!-- <option value="<?php echo $addsubcate->package_id ;?>"><?php echo $addsubcate->package_title;?></option> -->
                                                           <option <?php if($addsubcate->package_id == $pk_idd ){ echo 'selected';} ?>  value="<?php echo $addsubcate->package_id?>"><?php echo $addsubcate->package_title?></option>
                                                           <?php } 
                                                        
                                                           ?>  
                                                        
                                                       </select>
                                                    </div>                                                  
                                                </div>

                                                <div class="form-group col-md-12">                                                      
                                                        <div class="row" id="pkamount">
                                                           

                                                            <div class="form-group col-md-6">
                                                                <label for="email2">Package Expiry Date</label>           
                                                                <input  type="hidden" class="form-control" id="pack_id" name="pack_id" value="<?php echo $data->package_id ?>" readonly>             
                                                                     <input type="text" value="<?php echo $data->expiry_date ?>" class="form-control" id="Add_date" name="Add_date" placeholder="amount"  readonly> 
                                                           </div>

                                                           <div class="form-group col-md-6" >
                                                                <label for="email2">Package Amount</label>           
                                                                    <input type="text" value="<?php if($data->package_amount != ""){ ?><?php echo $data->package_amount ?> <?php } ?>" class="form-control" id="Add_amount" name="Add_amount" placeholder="amount"  readonly> 
                                                            </div> 
                                                            <div class="form-group col-md-6" style="display:none">
                                                                <label for="email2">Package Days</label>           
                                                                <!-- <input  type="hidden" class="form-control" id="pack_id" name="pack_id" value="<?php echo $data->package_id ?>">              -->
                                                                     <input type="text" value="<?php echo $data->package_days ?>" class="form-control" id="Add_days" name="Add_days" placeholder="amount"  readonly> 
                                                           </div> 

                                                        </div>       

                                                        <input type="hidden" class="form-control" value="<?php echo $data->post_id ?>" id="email2" name="id"  >

                                                </div>
                                                   

                                                <div class="mb-3" style="background:#ffe8ec;padding:9px"> 
                                                      <div class="row">                                        
                                                        <div class="form-group col-md-6">
                                                            <label for="email2">Coupon Code</label>
                                                            
                                                            <input style="text-transform:uppercase" type="text" class="form-control" id="coupon_code" name="coupon_code"  placeholder=""  >
                                                        </div> 
                                                        <div class="form-group col-md-6">                                      
                                                            <a onclick="couponcode();"  class="text-white btn btn-primary btn-lg btn-block">Coupon Check</a>
                                                        </div> 
                                                                                                                
                                                            <div class="form-group col-md-12" >
                                                                <div class="row p-2" id="netamount">

                                                                </div>
                                                            <!-- <input type="text" class="form-control" id="email2" name="net_amount"  placeholder=""  readonly> -->
                                                            </div>
                                                           
                                                        </div> 
                                                        <div class="form-group col-md-12">
                                                           <div id="coupon_pack">

                                                            </div>  
                                                            
                                                            
                                                            <div class="form-group col-md-6">
    <label for="paid_status">Paid Status</label>
    <select class="form-control" id="paid_status" name="paid_status">
        <option value="">Select Payment Status</option>
        <option value="0" <?php if ($data->payment_type != "1" && $data->payment_type != "2") { echo 'selected'; } ?>>Paid</option>
        <option value="1" <?php if ($data->payment_type == "1" || $data->payment_type == 1) { echo 'selected'; } ?>>Admin Cash</option>
        <option value="2" <?php if ($data->payment_type == "2" || $data->payment_type == 2) { echo 'selected'; } ?>>Admin Paid</option>
    </select>
</div>

<?php
// Check if ref_no exists in $data
$ref_no = !empty($data->ref_no) ? $data->ref_no : '';

// If ref_no is empty, fetch the transaction ID
if (empty($ref_no)) {
    $customer_id = $data->customer_id;
    $transaction_query = "SELECT transactionId FROM online_payment_transcation WHERE Customer_id = '$customer_id' LIMIT 1";
    $transaction_result = mysqli_query($config, $transaction_query);
    $transaction_data = mysqli_fetch_assoc($transaction_result);
    $ref_no = isset($transaction_data['transactionId']) ? $transaction_data['transactionId'] : '';
}
?>

<div class="form-group col-md-6" id="ref_no_div" style="display: none;">
    <label for="ref_no">Bank Reference No</label>
    <input type="text" class="form-control" id="ref_no" name="ref_no" placeholder="Enter Reference No" value="<?php echo $ref_no; ?>">
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    function toggleRefNo() {
        if ($("#paid_status").val() === "2") {
            $("#ref_no_div").show();
        } else {
            $("#ref_no_div").hide();
        }
    }

    // Initial check when the page loads
    toggleRefNo();

    // Check on change event
    $("#paid_status").change(function() {
        toggleRefNo();
    });
});
</script>
                                                        </div> 
                                                      </div> 


                                                      <div id="post_btn">
                                                        <div class="form-group">                                                         
                                                            <button class="btn btn-success" type="submit" name="post_renewal">Submit</button>
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


        </script>



</body>
</html>