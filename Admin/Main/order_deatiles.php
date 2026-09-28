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
						<div class="page-header d-flex justify-content-between align-items-center">
							<h4 class="page-title">Order Details</h4><br>
							<a href="add_order.php" class="btn btn-success">
								➕ Add Order
							</a>
						</div>
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
									<a style="float:left;" href="post_report_ex_create.php?search=<?php echo isset($_GET['search']) ? mysqli_real_escape_string($config, $_GET['search']) : ''; ?>" class="btn btn-success"> <i class="fas fa-download"> Download Cvs</i> </a>

									<!-- <a style="float: right;" target="_black" class="btn btn-danger" href="https://www.md5online.org/md5-decrypt.html">MD5 Decryption</a> -->
								</div>
								<div class="card-body">
									<div class="filter-buttons mb-4">
										<a href="?type=all" class="btn btn-secondary btn-round btn-sm">All</a>
										<a href="?type=pending" class="btn btn-info btn-round btn-sm">Pending</a>
										<a href="?type=accepted" class="btn btn-primary btn-round btn-sm">Accepted</a>
										<a href="?type=started" class="btn btn-warning btn-round btn-sm">Started</a>
										<a href="?type=ended" class="btn btn-dark btn-round btn-sm">Ended</a>
										<a href="?type=completed" class="btn btn-success btn-round btn-sm">Completed</a>
										<a href="?type=cancel" class="btn btn-danger btn-round btn-sm">Cancelled</a>
										<a href="?type=expired" class="btn btn-danger btn-round btn-sm">Expired</a>
									</div>
									
									<?php
									// Count total orders with pending quotes (customer_status = 'pending' in order_driver_bids)
									$quotes_count_query = "SELECT COUNT(DISTINCT o.id) AS total_orders_with_quotes
															FROM orders o
															INNER JOIN order_driver_bids odb ON o.id = odb.order_id
															WHERE odb.customer_status = 'pending'";
									$quotes_count_result = mysqli_query($config, $quotes_count_query);
									$quotes_count_row = mysqli_fetch_assoc($quotes_count_result);
									$total_orders_with_quotes = (int)($quotes_count_row['total_orders_with_quotes'] ?? 0);
									?>
									
									<div class="mb-4">
										<?php if ($total_orders_with_quotes > 0) { ?>
											<a href="?type=with_quotes" class="btn btn-info btn-round">
												📋 Orders with Pending Quotes: <strong class="ml-1"><?= $total_orders_with_quotes ?></strong>
											</a>
										<?php } else { ?>
											<span class="btn btn-secondary btn-round disabled">
												📋 Orders with Pending Quotes: <strong class="ml-1">0</strong>
											</span>
										<?php } ?>
									</div>
									<hr>
									<?php
									date_default_timezone_set('Asia/Kolkata');
									$type = isset($_GET['type']) ? $_GET['type'] : 'all';  // default to all

									$condition = "1"; // default shows all

									if ($type === 'pending') {
										$condition = "o.status = 'pending' AND TIMESTAMPADD(HOUR, 6, o.created_at) >= NOW()";
									} elseif ($type === 'accepted') {
										$condition = "o.status = 'accepted'";
									} elseif ($type === 'started') {
										$condition = "o.status = 'started'";
									} elseif ($type === 'ended') {
										$condition = "o.status = 'ended'";
									} elseif ($type === 'cancel') {
										$condition = "o.status = 'cancelled'";
									} elseif ($type === 'completed') {
										$condition = "o.status = 'completed'";
									} elseif ($type === 'expired') {
										$condition = "TIMESTAMPADD(HOUR, 6, o.created_at) < NOW() AND o.status = 'pending'";
									} elseif ($type === 'with_quotes') {
										// Filter orders that have pending quotes (customer_status = 'pending' in order_driver_bids)
										$condition = "o.id IN (SELECT DISTINCT order_id FROM order_driver_bids WHERE customer_status = 'pending')";
									}

									$query = "SELECT o.*, 
											d1.dir_city_name AS from_district_name, 
											d2.dir_city_name AS to_district_name,
											s1.name AS from_state_name,
											s2.name AS to_state_name,
											cp.driver_name AS driver_name,
											cp.phone_no AS driver_phone,
											(SELECT COUNT(*) FROM order_driver_bids WHERE order_id = o.id AND customer_status = 'pending') AS pending_bids_count,
											(SELECT COUNT(*) FROM order_driver_bids WHERE order_id = o.id) AS total_bids_count
											FROM orders o
											LEFT JOIN dir_city_master d1 ON o.from_district = d1.dir_city_id
											LEFT JOIN dir_city_master d2 ON o.to_district = d2.dir_city_id
											LEFT JOIN dir_state_master s1 ON o.from_state = s1.state_id
											LEFT JOIN dir_state_master s2 ON o.to_state = s2.state_id
											LEFT JOIN order_driver_bids odb ON o.id = odb.order_id AND odb.customer_status = 'accepted'
											LEFT JOIN create_post cp ON odb.driver_id = cp.customer_id
											WHERE $condition
											ORDER BY o.id DESC";


									$result = mysqli_query($config, $query);

									?>


									<form method="GET" action="" class="mb-4">
										<div class="row">
											<div class="col-md-6 col-sm-12">
												<div class="input-group">
													<input type="text" name="search" id="search-input1" class="form-control" placeholder="Search orders..." value="<?php echo htmlspecialchars($searchTerm); ?>">
													<div class="input-group-append">
														<button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Search</button>
													</div>
												</div>
											</div>
										</div>
									</form>
                                <style>
                                    /* Desktop UI Polish */
                                    .filter-buttons {
                                        display: flex;
                                        flex-wrap: wrap;
                                        gap: 10px;
                                    }
                                    /* Premium Card style for table on mobile */
                                    @media (max-width: 767px) {
                                        /* MAXIMIZE WIDTH: Remove huge bootstrap paddings on mobile */
                                        .page-inner { padding-left: 5px !important; padding-right: 5px !important; }
                                        .card-body { padding: 10px 5px !important; }
                                        
                                        .table-responsive { overflow-x: hidden !important; }
                                        .dataTables_wrapper { overflow-x: hidden !important; width: 100% !important; }
                                        
                                        .table-responsive .table { display: block !important; border: none !important; background: transparent !important; width: 100% !important; }
                                        .table-responsive .table thead { display: none !important; }
                                        .table-responsive .table tbody, .table-responsive .table tr, .table-responsive .table td {
                                            display: block !important;
                                            width: 100% !important;
                                            box-sizing: border-box !important;
                                        }
                                        /* Override table-striped background for cards */
                                        .table-striped tbody tr:nth-of-type(odd) {
                                            background-color: transparent !important;
                                        }
                                        .table-responsive .table tr {
                                            margin: 0 0 20px 0 !important; /* Reset margin since padding is gone */
                                            background: #fff !important;
                                            border-radius: 12px !important;
                                            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
                                            border: 1px solid #e9ecef !important;
                                            overflow: hidden !important;
                                        }
                                        .table-responsive .table td {
                                            position: relative !important;
                                            padding: 14px 12px 14px 42% !important; /* Adjusted for better width utilization */
                                            border: none !important;
                                            border-bottom: 1px solid #f1f3f5 !important;
                                            text-align: right !important;
                                            color: #111 !important; /* Darker, sharper text */
                                            font-size: 0.95rem !important;
                                            word-break: break-word !important;
                                            white-space: normal !important;
                                            min-height: 48px;
                                        }
                                        .table-responsive .table td:last-child {
                                            border-bottom: none !important;
                                            padding-bottom: 18px !important;
                                        }
                                        .table-responsive .table td:before {
                                            position: absolute;
                                            left: 12px;
                                            top: 15px;
                                            width: 38%;
                                            font-weight: 700;
                                            color: #0066cc; /* Bright professional blue instead of grey */
                                            text-transform: uppercase;
                                            font-size: 0.75rem;
                                            letter-spacing: 0.5px;
                                            text-align: left;
                                        }
                                        /* Labels via nth-child for DataTables */
                                        .table-responsive .table td:nth-child(1):before { content: "S.No"; }
                                        .table-responsive .table td:nth-child(2):before { content: "Order No"; }
                                        .table-responsive .table td:nth-child(3):before { content: "Status"; }
                                        .table-responsive .table td:nth-child(4):before { content: "Customer"; }
                                        .table-responsive .table td:nth-child(5):before { content: "From"; }
                                        .table-responsive .table td:nth-child(6):before { content: "To"; }
                                        .table-responsive .table td:nth-child(7):before { content: "Vehicle Type"; }
                                        .table-responsive .table td:nth-child(8):before { content: "KM"; }
                                        .table-responsive .table td:nth-child(9):before { content: "Total Amount"; }
                                        .table-responsive .table td:nth-child(10):before { content: "Posted On"; }
                                        .table-responsive .table td:nth-child(11):before { content: "Quotes Count"; }
                                        .table-responsive .table td:nth-child(12):before { content: "Action"; }
                                        
                                        /* Highlight the first row (S.No) as a header */
                                        .table-responsive .table td:nth-child(1) {
                                            background-color: #f8f9fa !important;
                                            color: #495057;
                                            border-bottom: 2px solid #e9ecef;
                                            text-align: right;
                                        }
                                        .table-responsive .table td:nth-child(1):before {
                                            color: #495057;
                                        }
                                        /* Badge fixes */
                                        .table-responsive .table td .badge, .table-responsive .table td .btn {
                                            font-size: 0.85rem;
                                            padding: 6px 10px;
                                            border-radius: 6px;
                                            display: inline-block;
                                        }
                                    }
                                </style>
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover">
											<thead>
												<tr>
													<th>S.No</th>
													<th>Order No</th>
													<th>Status</th>
													<th>Customer</th>
													<th>From</th>
													<th>To</th>
													<th>Vehicle Type</th>
													<th>KM</th>
													<th>Total Amount</th>
													<th>Posted On</th>
													<th>Quotes Count</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php $i = 1;
												while ($row = mysqli_fetch_assoc($result)): ?>
													<?php
													// Get status badge
													$status = strtolower(trim($row['status']));
													$statusBadge = '';

													if ($status == 'pending') {
														$badgeClass = 'badge-warning';
														$statusText = 'Pending';
														$icon = '⏳';
													} elseif ($status == 'accepted') {
														$badgeClass = 'badge-info';
														$statusText = 'Accepted';
														$icon = '✅';
													} elseif ($status == 'started') {
														$badgeClass = 'badge-primary';
														$statusText = 'Started';
														$icon = '🚗';
													} elseif ($status == 'ended') {
														$badgeClass = 'badge-secondary';
														$statusText = 'Ended';
														$icon = '🏁';
													} elseif ($status == 'completed') {
														$badgeClass = 'badge-success';
														$statusText = 'Completed';
														$icon = '✓';
													} elseif ($status == 'cancelled') {
														$badgeClass = 'badge-danger';
														$statusText = 'Cancelled';
														$icon = '❌';
													} else {
														$badgeClass = 'badge-secondary';
														$statusText = ucfirst($status);
														$icon = '';
													}
													?>
													<tr>
														<td><?= $i++ ?></td>
														<td>#<?= $row['id'] ?></td>
														<td><span class="badge <?= $badgeClass ?>"><?= $icon ?> <?= $statusText ?></span></td>
														<td>
															<strong><?= htmlspecialchars($row['name']) ?></strong><br>
															<small>📞 <?= $row['customer_phone'] ?></small>
															<?php if (!empty($row['driver_name'])): ?>
																<br><small>👤 Driver: <?= $row['driver_name'] ?></small>
															<?php endif; ?>
														</td>
														<td><?= $row['loader_from_place'] ?><br><small><?= $row['from_district_name'] ?>, <?= $row['from_state_name'] ?></small></td>
														<td><?= $row['drop_place'] ?><br><small><?= $row['to_district_name'] ?></small></td>
														<td><?= $row['requiredvehicle_type'] ?></td>
														<td><?= $row['total_km'] ?> km</td>
														<td><strong>₹<?= number_format($row['total_amount'], 2) ?></strong></td>
														<td><?= date('d M Y', strtotime($row['created_at'])) ?><br><small><?= date('h:i A', strtotime($row['created_at'])) ?></small></td>
														<td>
															<?php 
															// For completed orders, show total bids count; for others, show pending bids count
															$order_status = strtolower(trim($row['status']));
															if ($order_status == 'completed') {
																$bids_count = (int)($row['total_bids_count'] ?? 0);
															} else {
																$bids_count = (int)($row['pending_bids_count'] ?? 0);
															}
															
															if ($bids_count > 0) {
																?>
																<a href="edit_order.php?order_id=<?= $row['id'] ?>" class="btn btn-info btn-sm" title="Click to view quotes">
																	📋 <?= $bids_count ?> Quote<?= $bids_count > 1 ? 's' : '' ?>
																</a>
																<?php
															} else {
																?>
																<span class="badge badge-secondary">0 Quotes</span>
																<?php
															}
															?>
														</td>
														<td>
															<!-- View button hidden as requested -->
															<a href="edit_order.php?order_id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">✏️ Edit</a>
														</td>
													</tr>
												<?php endwhile; ?>
											</tbody>

										</table>

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