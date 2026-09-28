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
						<h4 class="page-title">Customer Master  </h4>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
<div class="card-header">
<a style="float:left;" href="customer_master_export.php" class="btn btn-success"> <i class="fas fa-download"> Download Cvs</i>  </a>

<!-- <a style="float: right;" target="_black" class="btn btn-danger" href="https://www.md5online.org/md5-decrypt.html">MD5 Decryption</a> -->
</div>
								<div class="card-body">
								<center> <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fas fa-plus"></i>   Add New Customer
								</button></center>

									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>S.No</th>
													<th> Customer Name</th>
													<th>Father Name</th>
													<th>DOB</th>
													<th>Address</th>
													<!-- <th>Disctict</th>
													<th>City</th> -->
													<th> Phone Number</th>
													<th> Email</th>
													<th> Password</th>		
													<th> Register Date</th>											 
													 <th> Status</th>
													<th>Action</th>
												</tr>
											</thead>
											 
											<tbody>
											<?php 
											$mc=1;
											$main_cate=mysqli_query($config,"select * from customer_master ORDER BY `customer_master`.`Customer_Id` DESC");
											while($macate=mysqli_fetch_object($main_cate))
											{
											?>
												
												
												<tr>
													<td><?php echo $mc;?></td>
													<td><?php echo $macate->Customer_Name;?></td>
													<!-- <td>
<a href="" class="btn btn-primary" data-toggle="modal" data-target="#<?php echo $mc;?>"> <i class="fas fa-pencil-alt"></i>  </a>
<a href="Function/customer_delete.php?delcuteid=<?php echo $macate->Customer_Id;?>&delcat=100" class="btn btn-danger" onClick="return confirm('Are you confirm to delete this Customer?');"> <i class="fas fa-trash"></i>  </a></td> -->
													<td><?php echo $macate->Customer_Fathername;?></td>
													<td><?php echo $macate->Customer_DOB;?></td>
													<td><?php echo $macate->Customer_Address;?></td>
													 <td><?php echo $macate->Customer_Phone_No;?></td>
													 <td><?php echo $macate->Customer_Mail_id;?></td>
													 <td><?php echo $macate->Customer_Password;?></td>
			                                      <td> <?php 
												//   	$main_catee=mysqli_query($config,"SELECT * FROM `customer_addresss_master` where Customet_id='$macate->Customer_Id'");
												// $macatee=mysqli_fetch_object($main_catee);

												  echo $macate->Customer_Address;?></td>
													<td><?php $edon= $macate->Customer_Registred_on;
													
													$main_cate_date = strtotime($edon);
			  echo  date('d-m-Y',$main_cate_date);
													
													?>													</td>
													<td><?php 

													$enablestatus=$macate->Customer_Active_Status;
													
													if($enablestatus== 1)
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
<a href="Function/customer_delete.php?delcuteid=<?php echo $macate->Customer_Id;?>&delcat=100" class="btn btn-danger" onClick="return confirm('Are you confirm to delete this Customer?');"> <i class="fas fa-trash"></i>  </a></td>

<!-- Modal -->
<div class="modal fade" id="<?php echo $mc;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Customer Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>        </button>
      </div>
      <div class="modal-body">
	  <form action="Function/customer_edit.php" method="post">
        <div class="form-group">
			<label for="email2">Customer Name</label>
			<input type="hidden" class="form-control" id="email2" name="custom_id"  value="<?php echo $macate->Customer_Id;?>">
			<input type="text" class="form-control" id="email2" name="customer_name"  placeholder="" value="<?php echo $macate->Customer_Name;?>">
			</div>

			<div class="form-group">
			<label for="email2">Customer Father's Name</label>
 			<input type="text" class="form-control" id="email2" name="father_name"  placeholder="Customer Father's Name" value="<?php echo $macate->Customer_Fathername;?>">
			</div>
			<div class="form-group">
			<label for="email2">Date OF Birth</label>
 			<input type="date" class="form-control" id="email2" name="dob"  placeholder="Date OF Birth" value="<?php echo $macate->Customer_DOB;?>">
			</div>

			<div class="form-group">
			<label for="email2">Address</label>
 			<input type="text" class="form-control" id="email2" name="address"  placeholder="address" value="<?php echo $macate->Customer_Address;?>">
			</div>
			


			<div class="form-group">
                                                    <label for="exampleFormControlSelect1">District</label> 
                                                    <select required class="form-control" id='city' name="Add_city" onchange="incity(this.value);">
                                                        <option value="">---SELECT---</option>
														<?php
														// echo $query="select * from dir_city_master";
                                                            $main_cate_dis=mysqli_query($config,"select * from dir_city_master");
                                                            while($addsubcate_dis=mysqli_fetch_object($main_cate_dis))
                                                            {  
                                                            ?>
                                                            <option  <?php if($addsubcate_dis->dir_city_id == $macate->Add_city ){?> selected="selected" <?php } ?> value="<?php echo $addsubcate_dis->dir_city_id ;?>"><?php echo $addsubcate_dis->dir_city_name;?></option>
                                                            <?php } ?>                                                            
                                                    </select>
                                                     
                                                </div>

												<div class="form-group ">
                                                    <label for="exampleInputName1">City</label>
                                                        <div class="area_fill">
														<select required class="form-control" name="Add_area_new">
                                                        <option value="">---SELECT---</option>
														<?php
														// echo $query="select * from dir_city_master";
                                                            $main_cate_area=mysqli_query($config,"SELECT * FROM `dir_area_master` where dir_cityid='$macate->Add_city'");
                                                            while($addsubcate_area=mysqli_fetch_object($main_cate_area))
                                                            {  
                                                            ?>
                                                            <option  <?php if($addsubcate_area->dir_area_id == $macate->Add_area ){?> selected="selected" <?php } ?> value="<?php echo $addsubcate_area->dir_area_id ;?>"><?php echo $addsubcate_area->dir_area_name;?></option>
                                                            <?php } ?>                                                            
                                                    </select>
                                                        </div>
                                                </div>
              <div class="form-group">
			<label for="email2">Customer Phone No</label>
 			<input type="text" class="form-control" id="email2" name="phone_no"  placeholder="Customer Phone No" value="<?php echo $macate->Customer_Phone_No;?>">
			</div>
			<div class="form-group">
			<label for="email2">Email </label>
 			<input type="text" class="form-control" id="email2" name="mail_id"  placeholder="Email " value="<?php echo $macate->Customer_Mail_id;?>">
			</div>
			<div class="form-group">
			<label for="email2">Customer Password</label>
 			<input type="text" class="form-control" id="email2" name="password" readonly placeholder="" value="<?php echo $macate->Customer_Password;?>">
			</div>
           <!-- <div class="form-group">
			<label for="email2">Customer wallet</label>
 			<input type="text" class="form-control" id="email2" name="main_cate_name" readonly placeholder="Customer Location" value="<?php echo $macate->Customer_Wallet;?>">
			</div>
             <div class="form-group">
			<label for="email2">Customer Location</label>
 			<textarea type="text" class="form-control" id="email2" name="main_cate_name" readonly placeholder="Customer Location" ><?php echo $macatee->Complete_Address;?></textarea>
			</div> -->
		  
		  
		  
		  
		  <div class="form-group">
												<label for="exampleFormControlSelect1">Customer Active Status</label>
												<select class="form-control" id="exampleFormControlSelect1" name="customer_active_status">
												<?php 

													$enablestatus=$macate->Customer_Id;
													
													if($enablestatus == 1)
													{ ?>
												
													<option value="1" selected>Active</option>
													<option value="0">In-Active</option>
													<?php }else if($enablestatus == 0){?>

														<option value="1" >Active</option>
													<option value="0" selected>In-Active</option>
													<?php }else{ ?>
													<option value="1" >Active</option>
													<option value="0" >In-Active</option>
													
													
													<?php } ?>
												</select>
											</div>			
		
		     <div class="form-group">
									<button class="btn btn-success" type="submit" name="customer_alter">Submit</button>
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
        <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form action="Function/customer_add.php" method="post">
	  <div class="form-group">
			<label for="email2">Customer Name</label>
			<!-- <input type="hidden" class="form-control" id="email2" name="custom_id"  value="<?php echo $macate->Customer_Id;?>"> -->
			<input type="text" class="form-control" id="email2" name="customer_name"  placeholder="" >
			</div>

			<div class="form-group">
			<label for="email2">Customer Father's Name</label>
 			<input type="text" class="form-control" id="email2" name="father_name"  placeholder="Customer Father's Name">
			</div>
			<div class="form-group">
			<label for="email2">Date OF Birth</label>
 			<input type="date" class="form-control" id="email2" name="dob"  placeholder="Date OF Birth" >
			</div>

			<div class="form-group">
			<label for="email2">Address</label>
 			<input type="text" class="form-control" id="email2" name="address"  placeholder="address" >
			</div>
			


			<div class="form-group">
                                                    <label for="exampleFormControlSelect1">District</label> 
                                                    <select required class="form-control" id='city' name="Add_city" onchange="incity_1(this.value);">
                                                        <option value="">---SELECT---</option>
														<?php
														// echo $query="select * from dir_city_master";
                                                            $main_cate_dis=mysqli_query($config,"select * from dir_city_master");
                                                            while($addsubcate_dis=mysqli_fetch_object($main_cate_dis))
                                                            {  
                                                            ?>
                                                            <option  value="<?php echo $addsubcate_dis->dir_city_id ;?>"><?php echo $addsubcate_dis->dir_city_name;?></option>
                                                            <?php } ?>                                                            
                                                    </select>
                                                     
                                                </div>

												<div class="form-group ">
                                                    <label for="exampleInputName1">City</label>
                                                        <div id="area_fill_1">
														
                                                        </div>
                                                </div>
              <div class="form-group">
			<label for="email2">Customer Phone No</label>
 			<input type="text" class="form-control" id="email2" name="phone_no"  placeholder="Customer Phone No" >
			</div>
			<div class="form-group">
			<label for="email2">Email </label>
 			<input type="text" class="form-control" id="email2" name="mail_id"  placeholder="Email ">
			</div>
			<div class="form-group">
			<label for="email2">Customer Password</label>
 			<input type="text" class="form-control" id="email2" name="password"  placeholder="" >
			</div>
		  
		  
		  
		  <div class="form-group">
												<label for="exampleFormControlSelect1">Customer Active Status</label>
												<select class="form-control" id="exampleFormControlSelect1" name="customer_active_status">
											
													<option value="1" selected>Active</option>
													<option value="0">In-Active</option>
													
												</select>
											</div>			
		
		     <div class="form-group">
									<button class="btn btn-success" type="submit" name="customer_add">Submit</button>
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

		
		function phone_uni(user_ph)
                 {
                   var user_ph;   
                   
                  $.ajax({
                        type: "POST",
                        url:'phone_no.php',
                        data: {user_ph:user_ph}, // serializes the form's elements.
                        success: function(data)
                        {	
                      // alert(data);		
                        if(data == 1)
                        {
                          $('#phone_no').html("Phone Number Already Register");
						  $('#user_ph').val('');
                  
                        }
                        else
                        {
                          $('#phone_no').html("");
                        }
                        
                        
                        }			
                    });

                 }

				 function incity(id){
                
                var id;
            //    alert(id);
            
            $.ajax({
                type: "POST",
                url: "area_post_new.php",
                data:{id:id}, 
                success: function(data)
                {
                  
                $('.area_fill').html(data);
// alert(data);
                // console.log(data);
                }
            });
            }



			
			function incity_1(id){
                
                var id;
            //    alert(id);
            
            $.ajax({
                type: "POST",
                url: "area_post.php",
                data:{id:id}, 
                success: function(data)
                {
                  
                $('#area_fill_1').html(data);
// alert(data);
                // console.log(data);
                }
            });
            }


	</script>
</body>
</html>