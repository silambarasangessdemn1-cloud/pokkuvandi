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

<style>

	.pages
	{
		padding: 10px;
		border: 1px solid;
    border-radius: 15px;
	}
	</style>

	
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
<a style="float:left;" href="customer_master_export.php?search=<?php echo isset($_GET['search']) ? mysqli_real_escape_string($config, $_GET['search']) : '';?>" class="btn btn-success"> <i class="fas fa-download"> Download Cvs</i>  </a>

<!-- <a style="float: right;" target="_black" class="btn btn-danger" href="https://www.md5online.org/md5-decrypt.html">MD5 Decryption</a> -->
</div>
								<div class="card-body">
								<center> <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fas fa-plus"></i>   Add New Customer
								</button></center>
								<?php 
										$limit = 10; 

										// Get the search term from the GET request
										$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
										
										// Create the search query based on the search term
										$searchQuery = "";
										if (!empty($searchTerm)) {
											$searchQuery = "WHERE Customer_Name LIKE '%" . mysqli_real_escape_string($config, $searchTerm) . "%' 
															OR Customer_Fathername LIKE '%" . mysqli_real_escape_string($config, $searchTerm) . "%' 
																														OR Customer_Phone_No LIKE '%" . mysqli_real_escape_string($config, $searchTerm) . "%' 

															OR Customer_Mail_id LIKE '%" . mysqli_real_escape_string($config, $searchTerm) . "%'"; // Add more columns if necessary
										
										
														}
										
										// Get total records count based on the search query
										$totalRecordsQuery = "SELECT COUNT(*) AS total FROM customer_master $searchQuery";
										$totalRecordsResult = mysqli_query($config, $totalRecordsQuery);
										$totalRecords = mysqli_fetch_assoc($totalRecordsResult)['total'];
										
										// Calculate total number of pages
										$totalPages = ceil($totalRecords / $limit);
										
										// Get the current page number from the URL parameter
										$page = isset($_GET["page"]) ? $_GET["page"] : 1;
										
										// Ensure $page is within valid range
										$page = max(min($page, $totalPages), 1);
										
										// Calculate the starting record index for the current page
										$recordIndex = ($page - 1) * $limit;
										
										// Fetch the records with the search query and pagination
										$query = "SELECT * FROM customer_master $searchQuery ORDER BY `customer_master`.`Customer_Id` DESC LIMIT $recordIndex, $limit";
										$main_cate=mysqli_query($config,"select * from customer_master $searchQuery ORDER BY  `customer_master`.`Customer_Id` DESC limit $recordIndex, $limit");

										?>
<form method="GET" action="">
    <div class="input-group mb-3">
        <input type="text" name="search" id="search-input1" class="form-control" placeholder="Search..." value="<?php echo htmlspecialchars($searchTerm); ?>" style="max-width: 250px;">
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit" style="margin-left: 23px;">Search</button>
        </div>
    </div>
</form>
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>S.No</th>
													<th> Customer Name</th>
													<th>Father Name</th>
													<th>DOB</th>
													<th>Address</th>
													<th>State</th>
													<th>District</th>
													<th>City</th>
													<th> Phone Number</th>
													<th> Email</th>
													<th> Password</th>		
													<th> Register Date</th>											 
													<th> Status</th>
                                                    <th> Forget Password Link </th>

													<th>Action</th>
												</tr>
											</thead>
											 
											<tbody>
											<?php 
											$mc= $recordIndex+1;
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
													<?php
                                                    $state_dsh=mysqli_query($config,"select * from dir_state_master where state_id ='$macate->state_id' ");
                                                    $addsubcate_state=mysqli_fetch_object($state_dsh);
                    
                                                    ?>
													<td><?php echo $addsubcate_state->name;?></td>

													<?php
                                                    $main_cate_dis=mysqli_query($config,"select * from dir_city_master where dir_city_id ='$macate->Add_city' ");
                                                    $addsubcate_dis__=mysqli_fetch_object($main_cate_dis);
                                                   
                                                    ?>
													<td><?php echo $addsubcate_dis__->dir_city_name;?></td>

													<?php
                                                    $main_cate_area=mysqli_query($config,"select * from dir_area_master where dir_area_id ='$macate->Add_area' ");
                                                    $addsubcate_area__=mysqli_fetch_object($main_cate_area);
                                                   
                                                    ?>

													<td><?php echo $addsubcate_area__->dir_area_name;?></td>
													
													 <td><?php echo $macate->Customer_Phone_No;?></td>
													 <td><?php echo $macate->Customer_Mail_id;?></td>
													 <td><?php echo $macate->Customer_Password;?></td>
			                              
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
    <button type="button" class="btn btn-warning change-password" 
        data-id="<?php echo $macate->Customer_Id; ?>" 
        data-email="<?php echo $macate->Customer_Mail_id; ?>">
        <i class="fas fa-key"></i>  Send Reset Link
    </button>
</td>
									<td>
													<a href="" class="btn btn-primary" data-toggle="modal" data-target="#customerModal<?php echo $macate->Customer_Id; ?>"> <i class="fas fa-pencil-alt"></i></a>
													<a href="Function/customer_delete.php?delcuteid=<?php echo $macate->Customer_Id;?>&delcat=100" class="btn btn-danger" onClick="return confirm('Are you confirm to delete this Customer?');"> <i class="fas fa-trash"></i>  </a>
													<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#changePasswordModal<?php echo $macate->Customer_Id; ?>">
        <i class="fas fa-key"></i>
    </button>
												
												
												</td>

<!-- Modal -->
<div class="modal fade" id="customerModal<?php echo $macate->Customer_Id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                    <label for="exampleFormControlSelect1">State</label> 
													<select required class="form-control" id="state1" name="state" >
													<option value="">---SELECT---</option>
														<?php
														// echo $query="select * from dir_city_master";
                                                            $main_cate_dis=mysqli_query($config,"select * from dir_state_master");
                                                            while($addsubcate_dis=mysqli_fetch_object($main_cate_dis))
                                                            {  
                                                            ?>
                                                            <option  <?php if($addsubcate_dis->state_id == $macate->state_id ){?> selected="selected" <?php } ?> value="<?php echo $addsubcate_dis->state_id ;?>"><?php echo $addsubcate_dis->name;?></option>
                                                            <?php } ?>                                                            
                                                    </select>
                                                     
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
                                                        <div class="">
														<select required class="form-control area_fill" name="Add_area_new">
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

<!-- Change Password Modal -->
<div class="modal fade" id="changePasswordModal<?php echo $macate->Customer_Id; ?>" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="changePasswordForm_<?php echo $macate->Customer_Id; ?>">
                    <div class="form-group">
                        <label for="newPassword_<?php echo $macate->Customer_Id; ?>">New Password</label>
                        <input type="password" class="form-control" id="newPassword_<?php echo $macate->Customer_Id; ?>" name="newPassword" required>
                    </div>
                    <input type="hidden" id="customerId_<?php echo $macate->Customer_Id; ?>" name="customerId" value="<?php echo $macate->Customer_Id; ?>">
                    <button type="submit" class="btn btn-success">Change Password</button>
                </form>
                <div id="passwordResult_<?php echo $macate->Customer_Id; ?>"></div>
            </div>
        </div>
    </div>
</div>



												</tr>
												
											<?php $mc++;} ?>
											</tbody>
										</table>
									</div>



									<div class="col-12 col-md-12 col-sm-12">
	             
                                    <?php
// Get total records count based on the search query
$totalRecordsQuery = "SELECT COUNT(*) AS total FROM customer_master $searchQuery";
$totalRecordsResult = mysqli_query($config, $totalRecordsQuery);
$totalRecords = mysqli_fetch_assoc($totalRecordsResult)['total'];

// Calculate total number of pages
$totalPages = ceil($totalRecords / $limit);

// Get the current page number from the URL parameter
$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
$page = max(min($page, $totalPages), 1); // Ensure valid range

// Calculate the starting record index for the current page
$recordIndex = ($page - 1) * $limit;

// Display total records count
echo "<div class='text-center mt-3'><b>Total Records: $totalRecords</b></div>";

// Build the base URL and preserve existing query parameters
$baseUrl = $_SERVER['PHP_SELF'] . '?';
$queryParams = $_GET; // Get all the existing query parameters

// Remove the page parameter from the query parameters, so we can add it manually
unset($queryParams['page']);
$queryString = http_build_query($queryParams); // Build the query string with other parameters

// Pagination links with better styling
echo "<nav class='pagination-container text-center mt-3'>";
echo "<ul class='pagination pagination-sm justify-content-center'>";

// Previous page link
if ($page > 1) {
    echo "<li class='page-item'><a class='page-link' href='" . $baseUrl . $queryString . "&page=" . ($page - 1) . "'>« Prev</a></li>";
}

// First pages
if ($page > 3) {
    echo "<li class='page-item'><a class='page-link' href='" . $baseUrl . $queryString . "&page=1'>1</a></li>";
    echo "<li class='page-item disabled'><span class='page-link'>...</span></li>";
}

// Middle pages
$start = max(1, $page - 2);
$end = min($totalPages, $page + 2);

for ($i = $start; $i <= $end; $i++) {
    if ($i == $page) {
        echo "<li class='page-item active'><span class='page-link'>$i</span></li>";
    } else {
        echo "<li class='page-item'><a class='page-link' href='" . $baseUrl . $queryString . "&page=$i'>$i</a></li>";
    }
}

// Last pages
if ($page < $totalPages - 2) {
    echo "<li class='page-item disabled'><span class='page-link'>...</span></li>";
    echo "<li class='page-item'><a class='page-link' href='" . $baseUrl . $queryString . "&page=$totalPages'>$totalPages</a></li>";
}

// Next page link
if ($page < $totalPages) {
    echo "<li class='page-item'><a class='page-link' href='" . $baseUrl . $queryString . "&page=" . ($page + 1) . "'>Next »</a></li>";
}

echo "</ul>";
echo "</nav>";
?>

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
                                                    <label for="exampleFormControlSelect1">State</label> 
													<select required class="form-control" id="state" name="state" >
                                                        <option value="">---SELECT---</option>
														<?php
														// echo $query="select * from dir_city_master";
                                                            $main_cate_dis=mysqli_query($config,"select * from dir_state_master");
                                                            while($addsubcate_dis=mysqli_fetch_object($main_cate_dis))
                                                            {  
                                                            ?>
                                                            <option  value="<?php echo $addsubcate_dis->state_id ;?>"><?php echo $addsubcate_dis->name;?></option>
                                                            <?php } ?>                                                            
                                                    </select>
                                                     
                                                </div>
			<div class="form-group">
                                                    <label for="exampleFormControlSelect1">District</label> 
                                                    <select required class="form-control" id='city1' name="Add_city" onchange="incity_1(this.value);">
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
			
			
			
			
			
			
			
<?php 

if (isset($_GET['newPassword']) && isset($_GET['customerId'])) {
    $newPassword = $_GET['newPassword'];
    $customerId = $_GET['customerId'];
    $new_password = ($_GET['newPassword']);
    $new_EncryptPassword = md5($new_password);
    // Here, you can hash the new password and update it in your database
    $hashedPassword =  $new_EncryptPassword;

    // Example of updating the password in the database
   // Create the SQL query
   $query = "UPDATE customer_master  SET Customer_Password = '$hashedPassword' WHERE Customer_Id = '$customerId'";

   // Execute the query
   if (mysqli_query($config, $query)) {
    echo "<script>
    alert('Password changed successfully!');
    window.location.reload(); // Reload the same page
  </script>";
exit;

} else {
    echo "<script>
    alert('Password not changed !');
  </script>";       
   }
}
?>
			
			
			
			
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



    // Trigger search when the user types
    $('#search-input').on('keyup', function() {
        var searchQuery = $(this).val(); // Get the search input value
  // Check if the search input is empty
  if (searchQuery === '') {
            // Reload the page if the search input is empty
            location.reload();
            return;
        }
        // Perform AJAX request to search the records
        $.ajax({
            url: 'search_data.php', // PHP file to handle search
            method: 'GET',
            data: { search: searchQuery }, // Send the search query
            success: function(response) {
                var data = JSON.parse(response); // Parse the response into JSON
                var table = $('#basic-datatables').DataTable();

                // Clear existing table data
                table.clear();

                // Add the matching records to the table
                data.forEach(function(record, index) {
					var statusButton = record.Status == 'Active' ? 
                        '<label class="btn btn-success">Active</label>' : 
                        '<label class="btn btn-danger">In-Active</label>';
                    table.row.add([
                        index + 1,
                        record.Customer_Name,
                        record.Customer_Fathername,
                        record.Customer_DOB,
                        record.Customer_Address,
                        record.Add_city,
                        record.Add_area,
                        record.Customer_Phone_No,
                        record.Customer_Mail_id,
                        record.Customer_Password,
                        record.Customer_Registred_on,
                        statusButton,
                        `<a href="" class="btn btn-primary" data-toggle="modal" data-target="#customerModal${record.Customer_Id}"><i class="fas fa-pencil-alt"></i></a>
                         <a href="Function/customer_delete.php?delcuteid=${record.Customer_Id}&delcat=100" class="btn btn-danger" onClick="return confirm('Are you sure to delete this customer?');"><i class="fas fa-trash"></i></a>`
                    ]);
                });

                // Redraw the table
                table.draw();
            }
        });
    });

    // Initialize DataTable with pagination and other settings
    $('#basic-datatables').DataTable({
        "paging": true, // Enable pagination
        "searching": false, // Disable default search
        "ordering": false, // Disable ordering
        "info": true, // Show pagination info
        "lengthChange": false, // Disable length change dropdown
        "pageLength": 10, // Number of items per page
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

<script>
$(document).ready(function() {
    $('#exampleModal').on('shown.bs.modal', function () {
        $('#state').off('change').on('change', function() { // Ensure no duplicate bindings
            var stateId = $(this).val();
            console.log("State changed:", stateId); // Debugging

            // Clear city dropdown before making an AJAX request
			$('#city1').val('').trigger('change');

            if (stateId) {
                $.ajax({
                    url: 'fetch_districts.php',
                    type: 'POST',
                    data: { state_id: stateId },
                    success: function(response) {
                        console.log("Response received:", response); // Debugging
                        $('#city').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error:", error);
                        alert('Failed to fetch districts. Please try again.');
                    }
                });
            }
        });
    });
});

$(document).ready(function () {
    $(".change-password").click(function () {
        var customerId = $(this).data("id");
        var customerMail = $(this).data("email");

        // Show confirmation dialog
        var confirmSend = confirm("Do you want to send a password reset link to: " + customerMail + "?");

        if (confirmSend) {
            $.ajax({
                url: "../../App/forgetpassword.php",
                type: "POST",
                data: {
                    customerId: customerId,
                    lee_mobile_number: customerMail,
                    login_submit: 1
                },
                success: function (response) {
                    alert("Mail sent successfully to " + customerMail);
                },
                error: function () {
                    alert("An error occurred. Please try again.");
                }
            });
        }
    });
});






</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Select all forms with ID starting with "changePasswordForm_"
    document.querySelectorAll("form[id^='changePasswordForm_']").forEach(function(form) {
        form.addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent page refresh
            
            // Get customer ID from hidden input
            let customerId = document.getElementById("customerId_" + form.id.split("_")[1]).value;
            let newPassword = document.getElementById("newPassword_" + form.id.split("_")[1]).value;
            let resultDiv = document.getElementById("passwordResult_" + form.id.split("_")[1]);

            console.log("Customer ID:", customerId);
            console.log("New Password:", newPassword);

            if (!newPassword.trim()) {
                resultDiv.innerHTML = '<div class="alert alert-warning">Password cannot be empty.</div>';
                return;
            }

            // Prepare FormData to send via AJAX
            let formData = new FormData();
            formData.append("customerId", customerId);
            formData.append("newPassword", newPassword);

            fetch("change_password_cus.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log("Response:", data);

                if (data.success) {
                    resultDiv.innerHTML = '<div class="alert alert-success">' + data.message + '</div>';
                    form.reset(); // Clear input field
                    setTimeout(() => { $('#changePasswordModal_' + customerId).modal("hide"); }, 2000);
                } else {
                    resultDiv.innerHTML = '<div class="alert alert-danger">' + data.message + '</div>';
                }
            })
            .catch(error => {
                console.error("AJAX Error:", error);
                resultDiv.innerHTML = '<div class="alert alert-danger">Error updating password.</div>';
            });
        });
    });
});
</script>

</body>
</html>

