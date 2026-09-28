<?php include('../config/setup.php'); ?>

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


	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<!-- SheetJS (xlsx) -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.3/xlsx.full.min.js"></script>
	<!-- FileSaver.js -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>



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
						<h4 class="page-title">Customer Vehicle Required Entry </h4>

					</div>
					<div class="row">
						<div class="col-md-12">

							<?php if (isset($_GET['msg'])) {
							?>
								<div class="alert alert-primary" role="alert">
									Succesfully Updated!!!
								</div>
							<?php }
							?>


							<div class="card">

								<div class="card-body">

									<form method="GET" action="">
										<div class="input-group mb-3">
											<input type="text" name="search" id="search-input1" class="form-control" placeholder="Search..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : '';  ?>" style="
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
                <th>Customer Name</th>
                <th>Customer Phone No</th>
                <th>Vehicle Required Date</th>
                <th>Vehicle Type</th>
                <th>State</th>
                <th>From State</th>
                <th>To State</th>
                <th>From District</th>
                <th>Load Pick Up Place</th>
                <th>To District</th>
                <th>Load Delivery Place</th>
                <th>Required Vehicle Type</th>
                <th>Load Details</th>
                <th>Create ON</th>
                <th>Trip Status</th>
				<th>Driver Name</th>
     <th>Driver Phone No</th>
     <th>Driver Vehicle Reg No</th>
 <th>Reason for Cancellation</th>
 <th>Cancelld Date</th>

                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $limit = 10; // Number of records per page
            $page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number
            $offset = ($page - 1) * $limit;

            $search_query = '';
            if (isset($_GET['search']) && !empty($_GET['search'])) {
                $search = mysqli_real_escape_string($config, $_GET['search']);
                $search_query = "WHERE Customer_Name LIKE '%$search%' OR Customer_Phone_No LIKE '%$search%'";
            }

            // Fetch records from database
            $mc = $offset + 1;
            $main_cate = mysqli_query($config, "SELECT * FROM customer_pokkuvandi_entry $search_query ORDER BY cus_pokkuvandi_entry_id DESC LIMIT $offset, $limit");

            while ($macate = mysqli_fetch_object($main_cate)) {
                // Fetch from district details
                $main_cate_from = mysqli_query($config, "SELECT * FROM dir_city_master WHERE dir_city_id='$macate->from_district'");
                $addsubcate_from = mysqli_fetch_object($main_cate_from);

                // Fetch to district details
                $main_cate_to = mysqli_query($config, "SELECT * FROM dir_city_master WHERE dir_city_id='$macate->to_district'");
                $addsubcate_to = mysqli_fetch_object($main_cate_to);

                // Fetch state details
                $main_state_from = mysqli_query($config, "SELECT * FROM dir_state_master WHERE state_id='$macate->from_state_id'");
                $state_from = mysqli_fetch_object($main_state_from);

                $main_to_from = mysqli_query($config, "SELECT * FROM dir_state_master WHERE state_id='$macate->to_state_id'");
                $to_state_from = mysqli_fetch_object($main_to_from);

                // Formatting dates
                $from_date_time = date('d-m-Y h:i a', strtotime("$macate->loader_from_date $macate->loader_from_time"));
                $to_date_time = date('d-m-Y h:i a', strtotime("$macate->from_date $macate->loader_to_time"));
                $post_date = date('d-m-Y', strtotime($macate->post_date));
            ?>
                <tr>
                    <td><?php echo $mc; ?></td>
                    <td><?php echo $macate->Customer_Name; ?></td>
                    <td><?php echo $macate->Customer_Phone_No; ?></td>
                    <td><?php echo $to_date_time; ?></td>

                    <td>
                        <?php
                        if ($macate->vehicle_type_cpe == 'goods') {
                            echo "Goods";
                        } elseif ($macate->vehicle_type_cpe == 'passenger') {
                            echo "Passenger";
                        } else {
                            echo "Unknown";
                        }
                        ?>
                    </td>

                    <td>
                        <?php echo ($macate->state == 1) ? "Within State Trip" : "Other State Trip"; ?>
                    </td>

                    <td><?php echo $state_from->name ?? '-'; ?></td>
                    <td><?php echo $to_state_from->name ?? '-'; ?></td>

                    <td><?php echo $addsubcate_from->dir_city_name ?? '-'; ?></td>
                    <td><?php echo $macate->place ?? '-'; ?></td>
                    <td><?php echo $addsubcate_to->dir_city_name ?? '-'; ?></td>
                    <td><?php echo $macate->to_place ?? '-'; ?></td>
                    <td><?php echo $macate->vehicle_type ?? '-'; ?></td>
                    <td><?php echo $macate->general_remarks ?? '-'; ?></td>
                    <td><?php echo $post_date; ?></td>

                    <td>
                        <?php
                        $trip_status = $macate->trip_status;
                        if ($trip_status === NULL) {
                            echo '<span class="badge bg-warning text-dark">Pending</span>';
                        } elseif ($trip_status == 'completed') {
                            echo '<span class="badge bg-success">Completed</span>';
                        } elseif ($trip_status == 'cancelled') {
                            echo '<span class="badge bg-danger">Cancelled</span>';
                        } else {
                            echo '<span class="badge bg-secondary">Unknown</span>';
                        }
                        ?>
                    </td>
					<td><?php echo !empty($macate->driver_name) ? $macate->driver_name : '-'; ?></td>
<td><?php echo !empty($macate->driver_phone_no) ? $macate->driver_phone_no : '-'; ?></td>
<td><?php echo !empty($macate->reg_veh_no) ? $macate->reg_veh_no : '-'; ?></td>
<td><?php echo !empty($macate->reson_for_cancel) ? $macate->reson_for_cancel : '-'; ?></td>
<td><?php echo !empty($macate->cancell_date) ? date('d-m-Y', strtotime($macate->cancell_date)) : '-'; ?></td>


                    <td>
                        <a href="customer_edit_pokkuvandi.php?pid=<?php echo $macate->cus_pokkuvandi_entry_id; ?>" class="btn btn-primary">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <a href="Function/customer_delete_pokkuvandi.php?delcateid=<?php echo $macate->cus_pokkuvandi_entry_id; ?>&delcat=300" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this entry?');">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php
                $mc++;
            } ?>
        </tbody>
    </table>
</div>

									<?php
									// Pagination
									$total_records_query = "SELECT COUNT(*) AS total FROM customer_pokkuvandi_entry $search_query";
									$total_records_result = $config->query($total_records_query);
									$total_records = $total_records_result->fetch_assoc()['total'];
									$total_pages = ceil($total_records / $limit);

									// Set pagination range (to show pages before and after current)
									$range = 2; // Number of page links to show before and after the current page

									// Start pagination container
									echo "<div class='pagination-container'>";

									// "Previous" button
									if ($page > 1) {
										echo "<a class='page-link' href='?page=" . ($page - 1) . "&search=" . (isset($_GET['search']) ? $_GET['search'] : '') . "'>&laquo; Previous</a>";
									}

									// Show page numbers with "..."
									if ($page > $range + 1) {
										echo "<a class='page-link' href='?page=1&search=" . (isset($_GET['search']) ? $_GET['search'] : '') . "'>1</a>";
										echo "<span class='dots'>...</span>";
									}

									// Page number links before current page
									for ($i = max(1, $page - $range); $i < $page; $i++) {
										echo "<a class='page-link' href='?page=$i&search=" . (isset($_GET['search']) ? $_GET['search'] : '') . "'>$i</a>";
									}

									// Current page
									echo "<a class='page-link active' href='?page=$page&search=" . (isset($_GET['search']) ? $_GET['search'] : '') . "'>$page</a>";

									// Page number links after current page
									for ($i = $page + 1; $i <= min($total_pages, $page + $range); $i++) {
										echo "<a class='page-link' href='?page=$i&search=" . (isset($_GET['search']) ? $_GET['search'] : '') . "'>$i</a>";
									}

									// Show ellipses and last page link if necessary
									if ($page < $total_pages - $range) {
										echo "<span class='dots'>...</span>";
										echo "<a class='page-link' href='?page=$total_pages&search=" . (isset($_GET['search']) ? $_GET['search'] : '') . "'>$total_pages</a>";
									}

									// "Next" button
									if ($page < $total_pages) {
										echo "<a class='page-link' href='?page=" . ($page + 1) . "&search=" . (isset($_GET['search']) ? $_GET['search'] : '') . "'>Next &raquo;</a>";
									}

									// End pagination container
									echo "</div>";
									?>

									<!-- Add CSS for styling -->
									<style>
										.pagination-container {
											display: flex;
											justify-content: center;
											align-items: center;
											margin-top: 20px;
										}

										.page-link {
											text-decoration: none;
											padding: 10px 15px;
											margin: 0 5px;
											background-color: #f1f1f1;
											color: #333;
											border-radius: 4px;
											transition: background-color 0.3s ease;
										}

										.page-link:hover {
											background-color: #007bff;
											color: white;
										}

										.page-link.active {
											background-color: #007bff;
											color: white;
											font-weight: bold;
										}

										.dots {
											padding: 10px 15px;
											color: #333;
										}
									</style>


								</div>


							</div>

<?php
// Get the 'search' parameter from the current URL
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Build query string only with 'search'
$queryParams = [];
if (!empty($search)) {
    $queryParams['search'] = $search;
}

// Construct final export URL
$exportUrl = "customer_export.php";
if (!empty($queryParams)) {
    $exportUrl .= "?" . http_build_query($queryParams);
}
?>

<a style="float:left;" id="exportBtn" href="<?php echo $exportUrl; ?>" class="btn btn-success">
    <i class="fas fa-download"></i> Download CSV
</a>


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


	<script src="https://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>



	<script>
		$(document).ready(function() {
			$('#basic-datatables').DataTable({
				"paging": false,
				"ordering": false,
				"info": false,
				"searching": false // Disable search box
			});
		});


		function exportTableToExcel(tableID, filename = '') {

			// Get the table
			var table = document.getElementById(tableID);
			var wb = XLSX.utils.table_to_book(table, {
				sheet: "Sheet JS"
			});

			// Create a binary string representation of the workbook
			var wbout = XLSX.write(wb, {
				bookType: 'xlsx',
				type: 'binary'
			});

			// Convert binary string to ArrayBuffer
			function s2ab(s) {
				var buf = new ArrayBuffer(s.length);
				var view = new Uint8Array(buf);
				for (var i = 0; i < s.length; i++) view[i] = s.charCodeAt(i) & 0xFF;
				return buf;
			}

			// Save the file using FileSaver.js
			saveAs(new Blob([s2ab(wbout)], {
				type: "application/octet-stream"
			}), filename + ".xlsx");
		}



		function deletepost(id) {
			var id;
			// alert(id);

			$.ajax({
				type: "POST",
				url: 'delete_popup.php',
				data: {
					id: id
				}, // serializes the form's elements.
				success: function(data) {
					//alert(data);		
					$('#deletepopup').html(data);

				}

			});


		}



		

	</script>
</body>

</html>