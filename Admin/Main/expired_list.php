<?php 
include('../config/setup.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title><?php

			$leename = mysqli_query($config, "select Name,Name_status from lee_master");
			while ($lee = mysqli_fetch_array($leename)) {
				$namestatus = $lee[1];
				if ($namestatus == 1) {
					echo  $lee[0];
				} else {
					echo "Need Name";
				}
			}

			?> </title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="<?php

							$inro_logo = mysqli_query($config, "select Logo_Path,logo_status from lee_master");
							while ($logo = mysqli_fetch_array($inro_logo)) {
								$logstatus = $logo[1];
								if ($logstatus == 1) {

									$ms = substr($logo[0], 3);
									echo  $ms;
								} else {
									echo "../../photos/logo/no_logo.png";
								}
							}

							?>" type="image/x-icon" />

	<!-- Fonts and icons -->
	<script src="../assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {
				"families": ["Lato:300,400,700,900"]
			},
			custom: {
				"families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
				urls: ['../assets/css/fonts.min.css']
			},
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

	<!-- Include jQuery first -->
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

	<!-- Include SweetAlert2 (after jQuery) -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.10/dist/sweetalert2.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.10/dist/sweetalert2.all.min.js"></script>

</head>
<style>
	.pages {
		padding: 10px;
		border: 1px solid;
		border-radius: 15px;
		margin-left: 10px !important;
	}

	.current {
		background: #1572e8;
		color: white;
	}
</style>

<body>
	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
			<?php include('logo.php'); ?>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<?php include('topbar.php'); ?>
			<!-- End Navbar -->
		</div>
		<!-- Sidebar -->
		<?php include('sidebar.php'); ?>


		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title"> Expired List & Registration Renewal</h4>

					</div>
					<div class="row">
						<div class="col-md-12">
							<div id="successMessage" style="display: none; color: green; font-weight: bold;"></div>

							<?php if (isset($_GET['msg'])) {
							?>
								<div class="alert alert-primary" role="alert">
									Post Succesfully Added!!!
								</div>
							<?php }
							?>
							<?php if (isset($_GET['msgerror'])) { ?>
								<div class="alert alert-primary" role="alert">
									Check The Post OR Date Will be Not Expiry!!!
								</div>

							<?php } ?>

							<div class="card">
							<div class="card-header">

<?php // Search functionality
$searchTerm = isset($_GET['search']) ? mysqli_real_escape_string($config, $_GET['search']) : '';
$searchQuery = "";

?>

<a style="float:left;" href="experid_post_report.php?search=<?php echo $searchTerm; ?>" class="btn btn-success"> <i class="fas fa-download"> Download Cvs</i>  </a>

<!-- <a style="float: right;" target="_black" class="btn btn-danger" href="https://www.md5online.org/md5-decrypt.html">MD5 Decryption</a> -->
</div>
								<div class="card-body">
									
								<?php
$limit = 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

date_default_timezone_set("Asia/Kolkata"); // Set timezone to Indian Standard Time (IST)
$current_date = date("Y-m-d"); // Get current date in IST

// Only fetch expired records
$expiredFilter = "create_post.expiry_date < '$current_date'";

if (!empty($searchTerm)) {
    $searchQuery = "AND (
        create_post.driver_name LIKE '%$searchTerm%' 
        OR create_post.vehicle_no LIKE '%$searchTerm%' 
        OR create_post.phone_no LIKE '%$searchTerm%' 
        OR create_post.whatsapp_no LIKE '%$searchTerm%' 
        OR dir_city_master.dir_city_name LIKE '%$searchTerm%' 
        OR dir_state_master.name LIKE '%$searchTerm%' 
        OR dir_area_master.dir_area_name LIKE '%$searchTerm%'
    )";
}

// Query to fetch only expired records with joins
$main_cate = mysqli_query(
    $config,
    "SELECT create_post.*, 
            COALESCE(dir_city_master.dir_city_name, 'N/A') AS dir_city_name, 
            COALESCE(dir_area_master.dir_area_name, 'N/A') AS dir_area_name,
            COALESCE(dir_state_master.name, 'N/A') AS state_name
     FROM create_post
     LEFT JOIN dir_state_master ON create_post.state_id = dir_state_master.state_id
     LEFT JOIN dir_city_master ON create_post.city_id = dir_city_master.dir_city_id
     LEFT JOIN dir_area_master ON create_post.area_id = dir_area_master.dir_area_id
     WHERE create_post.delete_id = '0'  and status= '1'
     AND $expiredFilter
     $searchQuery
     ORDER BY create_post.post_id DESC 
     LIMIT $offset, $limit"
);

// Count total records for pagination
$totalRecordsQuery = mysqli_query(
    $config,
    "SELECT COUNT(*) AS total 
     FROM create_post 
     LEFT JOIN dir_state_master ON create_post.state_id = dir_state_master.state_id
     LEFT JOIN dir_city_master ON create_post.city_id = dir_city_master.dir_city_id
     LEFT JOIN dir_area_master ON create_post.area_id = dir_area_master.dir_area_id
     WHERE create_post.delete_id = '0' 
     AND $expiredFilter
     $searchQuery"
);

$totalRecordsRow = mysqli_fetch_assoc($totalRecordsQuery);
$totalRecords = $totalRecordsRow['total'];
$totalPages = ceil($totalRecords / $limit);

// Error checking
if (!$main_cate) {
    die("Error in main query: " . mysqli_error($config));
}
if (!$totalRecordsQuery) {
    die("Error in count query: " . mysqli_error($config));
}
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
										<table id="basic-datatables" class="display table table-striped table-hover">
											<thead>
												<tr>
													<th>S.No</th>
                                                    
													<th> Driver Name</th>
													<!-- <th> Vehicle Name</th> -->
													<th>Vehicle No</th>
													<th>Vehicle Photo</th>
													<th>Phone No</th>
													<th>Whatsapp No</th>
													<!-- <th>Address</th> -->
                                                    <th>Expired Date</th>

													<th>State</th>
													<th>District</th>
													
													<th>City</th>
													
													<th>Status</th>
													<th>Create On</th>
													<th>Action</th>
												</tr>
											</thead>

											<tbody>
												<?php

$mc = $offset + 1; // Start S.No from the offset

												// $limit = 10; // Number of records per page
												// $page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number
												// $offset = ($page - 1) * $limit;

												// // echo "select * from create_post where delete_id= '0' order by post_id desc LIMIT $offset, $limit";
												// $mc = 1;
												// $main_cate = mysqli_query($config, "select * from create_post where delete_id= '0' order by post_id desc LIMIT $offset, $limit");
												while ($macate = mysqli_fetch_object($main_cate)) {
												?>

													<tr>
														<td><?php echo $mc; ?></td>
														<td><?php echo $macate->driver_name; ?></td>
														<!-- <td><?php echo $macate->vehicle_name; ?></td>  -->
														<td><?php echo $macate->vehicle_no; ?></td>
														<td>

															<img src="../../photos/vehicle/<?php
																							$cate = $macate->vehicle_photo;
																							$ms = substr($cate, 0);
																							echo  $ms;


																							?>" style="
      width: 128px;
    height: 129px;
">
														</td>

														<td><?php echo $macate->phone_no; ?></td>
														<td><?php echo $macate->whatsapp_no; ?></td>
                                                        <td><?php echo $macate->expiry_date; ?></td>

														<!-- <td><?php echo $macate->address; ?></td> -->
														<td><?php echo $macate->state_name; ?></td>

														<td><?php echo $macate->dir_city_name; ?></td>
                                                          <td><?php echo $macate->dir_area_name; ?></td>

														<!-- <//?php
														$main_catesub__ = mysqli_query($config, "select * from sub_area_master WHERE sub_area_id ='$macate->sub_area_id'");
														while ($macate__sub = mysqli_fetch_object($main_catesub__)) {
														?>
															<td><//?php echo $macate__sub->sub_area_name; ?></td>
														<?php // } ?> -->

														<td>
															
															<?php

															$enablestatus = $macate->status;

															if ($enablestatus == 1) { ?>
																<label class="btn btn-success">Active</label>
															<?php
															} else {
															?>
																<label class="btn btn-danger">In-Active</label>
															<?php
															}


															?>
														</td>
														<td><?php $edon = $macate->post_addon;

															$main_cate_date = strtotime($edon);
															echo  date('d-m-Y', $main_cate_date);

															?>




														</td>
                                                        <td>
														<a href="edit_create_post.php?pid=<?php echo $macate->post_id; ?>&expired=1" class="btn btn-primary"> <i class="fas fa-pencil-alt"></i> </a>

<a href="ad_post_renewal.php?pid=<?php echo $macate->post_id  ; ?>" class="btn btn-primary" > Renewal  </a>
<!-- <a style="color:white" data-toggle="modal" data-target="#exampleModaldelete" onclick="deletepost(<?php echo $mac3->post_id?>)" class="btn btn-primary btn-lg btn-block"> <i class="fas fa-trash"></i>  </a> -->

 

</td>


														<!-- Modal -->


													</tr>

												<?php $mc++;
												} ?>




											</tbody>


										</table>

									
										<?php
// Get search term from the URL and encode it for safe usage
$searchTerm = isset($_GET['search']) ? urlencode($_GET['search']) : '';
$expiredFilter = isset($_GET['expired']) ? 'expired=1' : '';

// Construct base URL for pagination
$queryParams = [];
if (!empty($searchTerm)) {
    $queryParams[] = "search=$searchTerm";  // Append search term
}
if (!empty($expiredFilter)) {
    $queryParams[] = $expiredFilter;  // Append expired filter
}

// Generate base URL dynamically based on parameters
$baseUrl = "?";
if (!empty($queryParams)) {
    $baseUrl .= implode("&", $queryParams) . "&page=";
} else {
    $baseUrl .= "page=";
}

echo "<div class='pagination'>";

$visiblePages = 5; // Show limited page links

// Previous button
if ($page > 1) {
    echo "<a class='pages m-1' href='{$baseUrl}" . ($page - 1) . "'>Previous</a>";
}

// Determine start and end range for pagination links
$start = max(1, $page - floor($visiblePages / 2));
$end = min($totalPages, $start + $visiblePages - 1);

if ($start > 1) {
    echo "<a class='pages' href='{$baseUrl}1'>1</a>";
    if ($start > 2) echo "<span class='dots'>...</span>";
}

// Page number links
for ($i = $start; $i <= $end; $i++) {
    if ($i == $page) {
        echo "<a class='pages current' href='{$baseUrl}$i'>$i</a>";
    } else {
        echo "<a class='pages' href='{$baseUrl}$i'>$i</a>";
    }
}

if ($end < $totalPages) {
    if ($end < $totalPages - 1) echo "<span class='dots'>...</span>";
    echo "<a class='pages' href='{$baseUrl}$totalPages'>$totalPages</a>";
}

// Next button
if ($page < $totalPages) {
    echo "<a class='pages m-1' href='{$baseUrl}" . ($page + 1) . "'>Next</a>";
}

echo "</div>";
?>
									</div>

									<div class="col-12 col-md-12 col-sm-12">



									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>







			<!-- Delete Modal -->
			<div class="modal fade" id="exampleModaldelete" tabindex="-1" role="dialog" aria-labelledby="exampleModaldeleteLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModaldeleteLabel">Delete Confirmation</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body" id="deletepopup">
							<!-- Content from delete_popup.php will be injected here -->
						</div>
					</div>
				</div>
			</div>







			<?php include('footer.php'); ?>
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
	<script>
		// $(document).ready(function() {
		// 	$('#basic-datatables').DataTable({


		// 		"paging":   false,
		// "ordering": false,
		// "info":     false


		// 	});




		// });
		$(document).ready(function() {

			$('#search-input').on('keyup', function() {
				var searchQuery = $(this).val();
				if (searchQuery === '') {
            // Reload the page if the search input is empty
            location.reload();
            return;
        }
				$.ajax({
					url: 'registration_search_data.php', // PHP file to handle search
					method: 'GET',
					data: {
						search: searchQuery
					}, // Send the search query
					success: function(response) {
						var data = JSON.parse(response); // Parse the response into JSON
						var table = $('#basic-datatables').DataTable();

						// Clear existing table data
						table.clear();

						// Add the matching records to the table
						data.forEach(function(record, index) {
							var statusButton = record.Status === 'Active' ?
								'<label class="btn btn-success">Active</label>' :
								'<label class="btn btn-danger">In-Active</label>';
							table.row.add([
								index + 1,
								record.Driver_Name,
								record.Vehicle_No,
								'<img src="../../photos/vehicle/' + record.Vehicle_Photo + '" style="width: 128px; height: 129px;">',
								record.Phone_No,
								record.Whatsapp_No,
								record.District,
								record.City,
								record.Area,
								statusButton,
								record.Create_On,
								`<a href="edit_create_post.php?pid=${record.Post_Id}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                         <a style="color:white" data-toggle="modal" data-target="#exampleModaldelete" onclick="deletepost(${record.Post_Id})" class="btn btn-danger"><i class="fas fa-trash"></i></a>`
							]);
						});

						// Redraw the table
						table.draw();
					}
				});
			});
			$('#basic-datatables').DataTable({
        "paging": true, // Enable pagination
        "searching": false, // Disable default search
        "ordering": false, // Disable ordering
        "info": true, // Show pagination info
        "lengthChange": false, // Disable length change dropdown
        "pageLength": 10, // Number of items per page
    });
		});


		function deletepost(id) {
			var id;
			//   alert(id);

			$.ajax({
				type: "POST",
				url: 'delete_popup.php',
				data: {
					id: id
				}, // serializes the form's elements.
				success: function(data) {
					//alert(data);		
					$('#deletepopup').html(data); // Inject the response into the modal body
					$('#exampleModaldelete').modal('show');

				}

			});


		}
	</script>
</body>

</html>