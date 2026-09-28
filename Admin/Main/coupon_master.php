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
						<h4 class="page-title">Coupon</h4>
						 
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								
								<div class="card-body">
								 <center> <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fas fa-plus"></i>   Add New Coupon
								</button></center>
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>S.No</th>
													<!-- <th> Shop Setting</th> -->
													<th> Customer Name</th>
													<th> Customer Phone No</th>
													<th> Coupon Code</th>													
													<th>Amount</th>
                                                    <th>Time Of Use</th>
                                                    <th>Expiry Date</th>                                                    
													 <th>Status</th>
													<th>Action</th>
												</tr>
											</thead>
											 
											<tbody>
											<?php 
											$mc=1;
											//echo $query="select * from coupon order by coupon_id desc";
											$main_cate=mysqli_query($config,"select * from coupon order by coupon_id desc");
											while($macate=mysqli_fetch_object($main_cate))
											{
												
											?>
												
												
												<tr>
													<td><?php echo $mc;?></td>
													<td><?php  $macate->customer_id;
													//echo $query="select * from customer_master where Customer_Id ='".$macate->customer_id."'";
													$subsmain_cate=mysqli_query($config,"select * from customer_master where Customer_Id ='".$macate->customer_id."'");
											 $main_subcatee=mysqli_fetch_object($subsmain_cate);
												
												
												echo  $main_subcatee->Customer_Name;
													
													?></td>
													<td><?php echo $main_subcatee->Customer_Phone_No;?></td>
													<td style="text-transform:uppercase" ><?php echo $macate->coupon_name;?></td>
													<td><?php echo $macate->amount;?></td>
                                                    <td><?php echo $macate->time_of_use;?></td>
                                                    <td><?php echo $macate->expiry_date;?></td>
													<td><?php 

													$enablestatus=$macate->status;
													
													if($enablestatus== 0)
													{ ?>
												<label class="btn btn-success">Active</label>
<?php														
													}else{
														?>
														<label class="btn btn-danger">In-Active</label>
														<?php
													}
													
													
													?></td>
													<td>
<a href="" class="btn btn-primary" data-toggle="modal" data-target="#<?php echo $mc;?>"> <i class="fas fa-pencil-alt"></i>  </a>

<!-- <a href="category_package.php?id=<?php echo $macate->Main_Category_id;?>" class="btn btn-primary"> <i class="fa fa-money"></i>  </a> -->
<a href="Function/coupon_delete.php?delcateid=<?php echo $macate->coupon_id;?>&delcat=100" class="btn btn-danger" onclick="return confirm('Are you confirm to delete this category?');"> <i class="fas fa-trash"></i>  </a>

</td>

<!-- Modal -->
<div class="modal fade" id="<?php echo $mc;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Coupon Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form action="Function/coupon_edit.php" method="post">
      

	  <!-- <div class="form-group">
		<label for="exampleFormControlSelect1">Coupon Type</label>
		<select class="form-control" id="coupon_type" name="coupon_type">
             <option value="0" >Individual</option>
               <option value="1" selected>General</option>                          
             </select>
		</div>	 -->

	  <div class="form-group">
			<label for="email2">Customer Name</label>
			<?php
			$subsmain_cate=mysqli_query($config,"select * from customer_master where customer_id = $macate->customer_id ");
											 $main_subcatee=mysqli_fetch_object($subsmain_cate);
												  ?>
			<input type="text" class="form-control" value="<?php echo $main_subcatee->Customer_Name ?>" id="email2" name="Add_cusromer" placeholder="name" readonly >
			</div>  

			<div class="form-group">
			<label for="email2"> Customer Phone No</label>
			
			<input style="text-transform:uppercase"  value="<?php echo $main_subcatee->Customer_Phone_No ?>" type="text" class="form-control" id="email2" name="Add_coupen_phono_no" placeholder="" onkeypress="if(this.value.length==10) return false;" readonly >
			</div> 

	   <div class="form-group">
			<label for="email2">Coupon Code</label>
			<input type="hidden" class="form-control" value="<?php echo $macate->coupon_id ?>" name="coupon_id" id="coupon_id"
                                                    placeholder="">
			<input style="text-transform:uppercase"  value="<?php echo $macate->coupon_name ?>" type="text" class="form-control" id="email2" name="Add_coupen_name" placeholder="Coupon Code" onkeypress="if(this.value.length==10) return false;" >
			</div>  
            <div class="form-group">
			<label for="email2">Amount</label>
			<input type="text" class="form-control" value="<?php echo $macate->amount ?>" id="email2" name="Add_amount" placeholder="Amnount"  >
			</div>  
		
            <div class="form-group">
			<label for="email2">Time Of Use</label>
			<input type="text" class="form-control" id="email2" value="<?php echo $macate->time_of_use ?>" name="time_of_use" placeholder="time_of_use"  >
			</div>  

            <div class="form-group">
			<label for="email2">Expiry Date</label>
			<input type="date" class="form-control" id="email2" value="<?php echo $macate->expiry_date ?>"name="expiry_date" placeholder="date"  >
			</div>  
            

		 <div class="form-group">
		<label for="exampleFormControlSelect1">Status</label>
		<select class="form-control" id="exampleFormControlSelect1" name="status">
                                                    <?php 

                                                                $enablestatus=$macate->status;

                                                                if($enablestatus == 1)
                                                                { ?>

                                                                <option value="0" >Active</option>
                                                                <option value="1" selected>In-Active</option>
                                                                <?php }else if($enablestatus == 0){?>

                                                                    <option value="0" selected>Active</option>
                                                                <option value="1" >In-Active</option>
                                                                <?php }else{ ?>
                                                                <option value="0" >Active</option>
                                                                <option value="1" >In-Active</option>


                                                                <?php } ?>                                                    
                                                    </select>
											</div>			
			
		
		     <div class="form-group">
									<button class="btn btn-success" type="submit" name="coupon_edit">Update</button>
 								</div>
			
			
			</form>
			
			
      </div>
	 
	  
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         
      </div>
    </div>
  </div>
</div>
													
													 
												</tr>
												
											<?php $mc++;} ?>
												
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
	</div>
				</div>
			</div>
			
			<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Coupon</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="Function/Add_coupon.php" method="post" enctype="multipart/form-data">
       
		<div class="form-group">
		<label for="exampleFormControlSelect1">Coupon Type</label>
		<select class="form-control" id="coupon_type" name="coupon_type" onchange="coupon_type_cus(this.value);">
             <option value="0" selected>Individual</option>
               <option value="1" >General</option>                          
             </select>
		</div>	

		<div id="ct">
    <div class="form-group">
        <label for="exampleFormControlSelect1">Customer Phone No</label>
        <input type="text" onkeyup="checkPhoneNumber(this.value);" class="form-control" id="phoneNumber" name="customer_phone_no" placeholder="Phone No" maxlength="10">
    </div>

    <div class="form-group">
        <label for="email2">Customer Name</label>
        <div id="cc"></div>
    </div>  

    <!-- Search Button (Initially Hidden) -->
    <button type="button" id="searchBtn" class="btn btn-primary" style="display:none;" onclick="customer()">Search</button>
</div>

<script>
    // This function checks if the phone number is 10 digits and shows the search button
    function checkPhoneNumber(phoneNumber) {
        // Remove any spaces or non-numeric characters from the input
        phoneNumber = phoneNumber.replace(/\D/g, ''); 

        if (phoneNumber.length === 10) {
            // Show the search button when 10 digits are entered
            document.getElementById('searchBtn').style.display = 'block';
            document.getElementById('cc').innerHTML = ''; // Clear previous error message
        } else {
            // Hide the search button if the phone number is not 10 digits
            document.getElementById('searchBtn').style.display = 'none';
            // Optionally, show an error message for less than 10 digits
            if (phoneNumber.length < 10) {
                document.getElementById('cc').innerHTML = "<p style='color: red;'>Please enter a 10-digit phone number.</p>";
            }
        }
    }

    // This function triggers the search using AJAX
    function customer() {
        var phoneNumber = $('#phoneNumber').val().trim(); // Get the value
            $.ajax({
                type: "POST",
                url: 'customer_phone.php',
                data: { id: phoneNumber }, // Send the phone number as 'id'
                success: function(data) {
                    $('#cc').html(data); // Display customer name or result
                },
                error: function() {
                    $('#cc').html("<p style='color: red;'>Error fetching data.</p>");
                }
            });
        
    }
</script>

	   		<div class="form-group">
				<label for="email2">Coupon Code</label>
				<input style="text-transform:uppercase"  type="text" class="form-control" id="Add_coupen_name" name="Add_coupen_name" placeholder="Coupon Code" onkeyup="couponcode_uni(this.value);"  onkeypress="if(this.value.length==10) return false;" required>
				<div style="color: red;font-size: 15px;font-weight: 500;margin-top: 10px;" id="coupon_msg">
                                                              
                  </div>
			</div>  

            <div class="form-group">
			<label for="email2">Amount</label>
			<input type="text" class="form-control" id="email2" name="Add_amount" placeholder="Amnount" required >
			</div>  
		
            <div class="form-group">
			<label for="email2">Time Of Use</label>
			<input type="text" class="form-control" id="email2" name="time_of_use" placeholder="time_of_use" required >
			</div>  

            <div class="form-group">
			<label for="email2">Expiry Date</label>
			<input type="date" class="form-control" id="email2" name="expiry_date" placeholder="date"  required>
			</div>  
            

		 <div class="form-group">
		<label for="exampleFormControlSelect1">Status</label>
		<select class="form-control" id="exampleFormControlSelect1" name="Add_status">
		<option value="0">Active</option>
		<option value="1">In-Active</option>
		
		</select>
											</div>			
		
		     <div class="form-group">
									<button class="btn btn-success" type="submit" name="category_add">Add New</button>
 								</div>
			
			
			</form>
	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
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

        
		function coupon_type_cus(id){
			//alert();
                     var id;
					 //alert(id);
             if(id == 1)
			 {
				$('#ct').hide();
			 }
			 else
			 {
				$('#ct').show();
				
			 }
                    		
                        
                       
                    
                }


       

				
   function couponcode_uni(id)
                 {
                   var id;   
                   
                  $.ajax({
                        type: "POST",
                        url:'coupon_code.php',
                        data: {id:id}, // serializes the form's elements.
                        success: function(data)
                        {	
							//console.log(data);
                    // alert(data);		
                        if(data == 1)
                        {
                        
                          $('#coupon_msg').html("Coupon Code Already Entered");
                          $('#Add_coupen_name').val('');
                        }
                        else
                        {
                          $('#Add_coupen_name').html("");
                        }
                        
                        
                        }			
                    });

                 }

	</script>
</body>
</html>