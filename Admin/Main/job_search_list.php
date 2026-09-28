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
 <script src="
      https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js
      "></script>
      <link href="
      https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css
      " rel="stylesheet">
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
						<h4 class="page-title">Job Search List</h4>
						 
					</div>
					<div class="row">
						<div class="col-md-12">

						<?php if(isset($_GET['msg']))
							{
								?>
							<div class="alert alert-primary" role="alert">
							Post Succesfully Added!!!
							</div>
							<?php }
							?>
							<?php if(isset($_GET['msgerror']))  {?>
							<div class="alert alert-primary" role="alert">
							Check The Post OR Date Will be Not Expiry!!!
							</div>
							
							<?php } ?>

							<div class="card">
								
								<div class="card-body">
								 <center> <a href="add_job_search.php" class="btn btn-success" >
                                    <i class="fas fa-plus"></i>    Create New Job Search     </a></center> 
									<?php
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$limit = 10;  // Define records per page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Get current page number
$offset = ($page - 1) * $limit; // Calculate offset for pagination

$searchQuery = "";
if (!empty($searchTerm)) {
    $searchQuery = "AND (
        customer_name LIKE '%$searchTerm%' 
        OR customer_phone_no LIKE '%$searchTerm%' 
        OR job_name LIKE '%$searchTerm%' 
        OR company_name LIKE '%$searchTerm%' 
        OR salary_range LIKE '%$searchTerm%' 
        OR contact_no LIKE '%$searchTerm%' 
        OR email_id LIKE '%$searchTerm%' 
    )";
}

// Query to fetch filtered results with pagination
$main_cate = mysqli_query(
    $config,
    "SELECT * FROM job_search_post 
    WHERE delete_id = '0' 
    AND job_category_id != '1' 
    $searchQuery 
    ORDER BY job_search_id DESC 
    LIMIT $offset, $limit"
);

// Count total records for pagination with search filter applied
$totalRecordsQuery = mysqli_query(
    $config,
    "SELECT COUNT(*) AS total 
    FROM job_search_post 
    WHERE delete_id = '0' 
    AND job_category_id != '1' 
    $searchQuery"
);
$totalRecordsRow = mysqli_fetch_assoc($totalRecordsQuery);
$totalRecords = $totalRecordsRow['total'];
$totalPages = ceil($totalRecords / $limit);
?>
									
									
									<form method="GET" action="">
    <div class="input-group mb-3">
        <input type="text" name="search" id="search-input1" class="form-control" placeholder="Search..." value="<?php echo htmlspecialchars($searchTerm); ?>"style="
    max-width: 250px;
">
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit" style="
    margin-left: 23px;
">Search</button>
        </div>
    </div>
</form>
									
									<div class="table-responsive">
									
									
									
									<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>S.No</th>												
													<th> Name</th>
													<!-- <th> Vehicle Name</th> -->
													 <th>Phone No</th>
                                                     <th>Category Name</th>
                                                     <th>Job Name</th>
                                                     <th>Experiences</th>
                                                     <th>Qualification</th>
													 <th>Company Name</th>
                                                     <!-- <th>District</th>
                                                     <th>City</th>
													 <th>Area</th> -->
													 <th>Salary Range</th>
													 <th>Contact No</th>
													 <th>Email Id</th>
													 <th>Licence No</th>
													 <th>Vehicle Type</th>
													 <th>Create On</th>
													 <th>Last Date</th>
													 <th>Address</th>
													 <th>Remarks</th>
													 <th>Amount</th>
                                                     <th>Exp Date</th>                                                  
													<th>Action</th>
												</tr>
											</thead>
											 
											<tbody>
											<?php 
											   $mc = $offset + 1; // Start S.No from the offset
											
											while($macate=mysqli_fetch_object($main_cate))
											{
											?>
												
												
												<tr>
													<td><?php echo $mc;?></td>													
													<td><?php echo $macate->customer_name;?></td>
                                                    <td><?php echo $macate->customer_phone_no;?></td>   
													<?php 		
														$main_cate__cate=mysqli_query($config,"select * from job_search_category WHERE Main_Category_id ='$macate->job_category_id'");
														$macate_cate=mysqli_fetch_object($main_cate__cate);
																								
													?>
                                                     <td><?php echo $macate_cate->Main_Category_Name;?></td>

                                                     <td><?php echo $macate->job_name;?></td> 
                                                     <td><?php echo $macate->experiences;?></td>
                                                     <td><?php echo $macate->qualification;?></td>
													 <td><?php echo $macate->company_name;?></td>
												

													 <!-- <?php 		
														$main_cate_=mysqli_query($config,"select * from dir_city_master WHERE dir_city_id ='$macate->district_id'");
														while($macate_=mysqli_fetch_object($main_cate_))
														{												
													?>
                                                     <td><?php echo $macate_->dir_city_name;?></td>
													 <?php } ?>
													 <?php 		
														$main_cate__=mysqli_query($config,"select * from dir_area_master WHERE dir_area_id ='$macate->city_id'");
														while($macate__=mysqli_fetch_object($main_cate__))
														{												
													?>
                                                     <td><?php echo $macate__->dir_area_name	;?></td>
													 <?php } ?>

													 <?php 		
														$main_catesub__=mysqli_query($config,"select * from sub_area_master WHERE sub_area_id ='$macate->area_id'");
														while($macate__sub=mysqli_fetch_object($main_catesub__))
														{												
													?>
                                                     <td><?php echo $macate__sub->sub_area_name	;?></td>
													 <?php } ?> -->
													 <td><?php echo $macate->salary_range;?></td>
													 <td><?php echo $macate->contact_no;?></td>
													 <td><?php echo $macate->email_id;?></td>
													


													 <td><?php echo $macate->licence_no;?></td>
													 <td><?php echo $macate->vehicle_type;?></td>
													 <td><?php $edon= $macate->post_date;
													
													$main_cate_date = strtotime($edon);
			  											echo  date('d-m-Y',$main_cate_date);
													
													?>
													</td> 
													<td><?php $edon= $macate->last_date;
													
													$main_cate_date = strtotime($edon);
			  											echo  date('d-m-Y',$main_cate_date);
													
													?>
													</td> 

													<td><?php echo $macate->address;?></td>
													<td><?php echo $macate->remarks;?></td>
													<td><?php echo $macate->amount;?></td>

													<!-- <td><?php 

													$enablestatus=$macate->status;
													
													if($enablestatus== 1)
													{ ?>
												<label class="btn btn-success">Active</label>
<?php														
													}else{
														?>
														<label class="btn btn-danger">In-Active</label>
														<?php
													}
													
													
													?></td> -->
                                                   
												   <td><?php $edon= $macate->exp_date;
													
													$main_cate_date = strtotime($edon);
			  											echo  date('d-m-Y',$main_cate_date);
													
													?>
													</td> 



													<td>
<a href="edit_job_search.php?pid=<?php echo $macate->job_search_id  ; ?>" class="btn btn-primary" > <i class="fas fa-pencil-alt"></i>  </a>
<a style="color:white" data-toggle="modal" data-target="#exampleModaldelete" onclick="deletepost(<?php echo $macate->job_search_id?>)" class="btn btn-primary btn-lg btn-block"> <i class="fas fa-trash"></i>  </a>

 

</td>


<div class="modal" tabindex="-1" id="exampleModaldelete" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div style="border-bottom: 0px solid #e5e5e5 !important" class="modal-header">
      <div class="alertdelete alert-success" style="display: none;" role="alert">                               
                                    <div class="msgdelete">

                                    </div>                                    
                                </div>
      </div>
      <div class="modal-body">
      <div class="contact-form default-form">
                            <!-- <form action="city_update_insert.php" method="post"> -->
                                <div class="row clearfix" id="deletepopup">   
                                
                                                            </div>
                            <!-- </form> -->
						</div>
      </div>
      
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="<?php echo $mc;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Main Category Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form action="Function/Main_category_edit.php" method="post">
      

      <!-- <div class="form-group">
												<label for="exampleFormControlSelect1">Shop Setting</label>
										<input type="text" class="form-control" readonly id="email2" name="main_cate_shop_set"  value="<?php  $macate->Shop_setting;
													
													$subsmain_cate=mysqli_query($config,"select * from shop_setting where shop_id='".$macate->Shop_setting."'");
											 $main_subcatee=mysqli_fetch_object($subsmain_cate);
												
												
												echo  $main_subcatee->Shop__setting;
													
													
													
													
													
													
													?>">	
											</div>	 -->






	  <div class="form-group">
			<label for="email2">Main CategoryName</label>
			<input type="hidden" class="form-control" id="email2" name="main_cate_id"  value="<?php echo $macate->Main_Category_id;?>">
			<input type="text" class="form-control" id="email2" name="main_cate_name" placeholder="Main CategoryName" value="<?php echo $macate->Main_Category_Name;?>">
			</div>
          <div class="form-group">
												<label for="exampleFormControlSelect1">Category Active Status</label>
												<select class="form-control" id="exampleFormControlSelect1" name="main_category_status">
												<?php 

													$enablestatus=$macate->Main_Category_Status;
													
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
									<button class="btn btn-success" type="submit" name="category_content_edit">Submit</button>
 								</div>
			
			
			</form>
			
			
      </div>
	 
	  <div class="modal-body">
	  <form action="Function/Main_category_edit.php" method="post" enctype="multipart/form-data" >
	 <center>  <h4 class="modal-title" id="exampleModalLabel">Change Category Image (Image size : 40px X 40px)</h4></center> 
       
<div class="form-group">
<label for="email2">Current Image</label>
<img src="<?php 													$cate=$macate->Main_Category_image;
   $ms=substr($cate,3);
				  echo  $ms;
?>" style="
    width: 128px;
    height: 129px;
">
</div>




	   <div class="form-group">
			<label for="email2">Change  Imag here</label>
						<input type="hidden" class="form-control" id="email2" name="main_image_cate_id"  value="<?php echo $macate->Main_Category_id;?>">

			<input type="file" class="form-control" id="email2" name="Main_cate_image" placeholder="Main CategoryName" value="<?php echo $macate->Main_Category_Name;?>">
			</div>
          		
		
		
		
		
		
		
		
		
		     <div class="form-group">
									<button class="btn btn-warning" type="submit" name="main_category_image_change">Submit</button>
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
 <!-- Pagination -->
 <!-- Pagination -->
<div class="pagination">
    <ul class="pagination justify-content-center">
        <?php
        $adjacents = 2; // Number of adjacent pages to show on either side
        $startPage = max(1, $page - $adjacents);
        $endPage = min($totalPages, $page + $adjacents);

        if ($page > 1) { ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?php echo $page - 1; ?>&search=<?php echo htmlspecialchars($searchTerm); ?>">Previous</a>
            </li>
        <?php }

        if ($startPage > 1) { ?>
            <li class="page-item">
                <a class="page-link" href="?page=1&search=<?php echo htmlspecialchars($searchTerm); ?>">1</a>
            </li>
            <?php if ($startPage > 2) { ?>
                <li class="page-item disabled">
                    <span class="page-link">...</span>
                </li>
            <?php }
        }

        for ($i = $startPage; $i <= $endPage; $i++) { ?>
            <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo htmlspecialchars($searchTerm); ?>"><?php echo $i; ?></a>
            </li>
        <?php }

        if ($endPage < $totalPages) {
            if ($endPage < $totalPages - 1) { ?>
                <li class="page-item disabled">
                    <span class="page-link">...</span>
                </li>
            <?php } ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?php echo $totalPages; ?>&search=<?php echo htmlspecialchars($searchTerm); ?>"><?php echo $totalPages; ?></a>
            </li>
        <?php }

        if ($page < $totalPages) { ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?php echo $page + 1; ?>&search=<?php echo htmlspecialchars($searchTerm); ?>">Next</a>
            </li>
        <?php } ?>
    </ul>
</div>






</div>
	</div>
	<button style="float:left;" id="exportBtn" class="btn btn-success">
    <a href="job_search_excel.php?search=<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" style="color: inherit; text-decoration: none;">
        <i class="fas fa-download"> Download CSV</i>
    </a>
</button>
				</div>
			</div>
			
			<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Main Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="Function/Add_Main_Category.php" method="post" enctype="multipart/form-data">
       

 <div class="form-group">
		<label for="exampleFormControlSelect1">Shop Setting</label>
		<select class="form-control" name="Add_main_cate_shopsetting">
			<?php
			
			$main_cate=mysqli_query($config,"select * from shop_setting");
											while($addsubcate=mysqli_fetch_object($main_cate))
											{
			
			
			?>
			
			<option value="<?php echo $addsubcate->shop_id;?>"><?php echo $addsubcate->Shop__setting;?></option>
			
			
			
			
											<?php } ?>
			
			</select>
											</div>	





	   <div class="form-group">
			<label for="email2">Main CategoryName</label>
			<input type="text" class="form-control" id="email2" name="Add_main_cate_name" placeholder="Main CategoryName"  >
			</div>  
			<div class="form-group">
			<label for="email2">Main Category Image (Image size : 40px X 40px)</label>
			<input type="file" class="form-control" id="email2" name="Add_main_cate_image" placeholder="Main CategoryName"  >
			</div>
       
		 <div class="form-group">
		<label for="exampleFormControlSelect1">Category Active Status</label>
		<select class="form-control" id="exampleFormControlSelect1" name="Add_main_category_status">
		<option value="1">Active</option>
		<option value="0">In-Active</option>
		
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

	

	<script src="https://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>


	<script >
		$(document).ready(function() {
			$('#basic-datatables').DataTable({
				"paging": true, // Enable pagination
        "searching": false, // Disable default search
        "ordering": false, // Disable ordering
        "info": true, // Show pagination info
        "lengthChange": false, // Disable length change dropdown
        "pageLength": 10,
			});

		 
 
			 
		});

		
		function deletepost(id){
                    var id;
                  // alert(id);
             
                    $.ajax({
                        type: "POST",
                        url:'delete_popup.php',
                        data: {id:id}, // serializes the form's elements.
                        success: function(data)
                        {	
                            //alert(data);		
                        $('#deletepopup').html(data);
                        
                        }		
                        	
                    });	
                    

                }



	// 			$(document).ready(function(){
    //   // Add a click event listener to the export button
    //   $("#exportBtn").click(function(){
	
    //     // Use the table2excel plugin to export the table
    //     $("#basic-datatables").table2excel({
    //       exclude: ".noExl", // Add a class to exclude specific elements from the export
    //       name: "Excel Document",
    //       filename: "myTable.xls" // Set the desired filename
    //     });
    //   });
    // });



	</script>
</body>
</html>