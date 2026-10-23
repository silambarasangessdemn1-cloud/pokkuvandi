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
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
	
	/* DataTables Buttons Styling */
	.dt-buttons {
		margin-bottom: 15px;
	}
	
	.dt-buttons .btn {
		margin-right: 5px;
	}
	
	.dt-button {
		background: #28a745 !important;
		color: white !important;
		border: none !important;
		padding: 8px 15px !important;
		border-radius: 4px !important;
		cursor: pointer !important;
	}
	
	.dt-button:hover {
		background: #218838 !important;
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
						<h4 class="page-title">Create Registration</h4>

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
<?php
// Build CSV download URL with all filter parameters
$csvParams = array();
if(isset($_GET['search']) && !empty($_GET['search'])) {
    $csvParams[] = 'search=' . urlencode($_GET['search']);
}
if(isset($_GET['expired']) && $_GET['expired'] == 1) {
    $csvParams[] = 'expired=1';
}
if(isset($_GET['payment_status']) && !empty($_GET['payment_status'])) {
    $csvParams[] = 'payment_status=' . urlencode($_GET['payment_status']);
}
if(isset($_GET['date_filter_type']) && !empty($_GET['date_filter_type'])) {
    $csvParams[] = 'date_filter_type=' . urlencode($_GET['date_filter_type']);
}
if(isset($_GET['single_date']) && !empty($_GET['single_date'])) {
    $csvParams[] = 'single_date=' . urlencode($_GET['single_date']);
}
if(isset($_GET['date_from']) && !empty($_GET['date_from'])) {
    $csvParams[] = 'date_from=' . urlencode($_GET['date_from']);
}
if(isset($_GET['date_to']) && !empty($_GET['date_to'])) {
    $csvParams[] = 'date_to=' . urlencode($_GET['date_to']);
}
$csvUrl = 'post_report_ex_create.php' . (!empty($csvParams) ? '?' . implode('&', $csvParams) : '');
?>
<!-- Download button will be shown in DataTables buttons area -->
<div style="float:left; margin-bottom: 10px;">
    <span class="badge badge-info">Total Records: <?php echo $totalRecords; ?></span>
</div>

<!-- <a style="float: right;" target="_black" class="btn btn-danger" href="https://www.md5online.org/md5-decrypt.html">MD5 Decryption</a> -->
</div>
								<div class="card-body">
									<div class="d-flex justify-content-center align-items-center flex-wrap" style="gap: 12px; margin-bottom: 20px;">
										<a href="add_create_post.php" class="btn btn-success">
											<i class="fas fa-plus"></i> Create New Registration
										</a>
										<button type="button" class="btn btn-info shadow-sm" id="btnSelectAllDrivers" onclick="handleSelectAllUsersClick()">
											<i class="fas fa-check-double mr-1"></i> Select All Users
										</button>
										<button type="button" class="btn btn-primary shadow-sm" id="btnOpenSendMessage" onclick="openSendMessageModal()">
											<i class="fas fa-paper-plane mr-1"></i> Send Message to Selected Drivers (<span id="selectedCountBadge">0</span>)
										</button>
										<button type="button" class="btn btn-outline-danger shadow-sm" id="btnClearSelectedBtn" onclick="clearSelectedDrivers()" style="display: none;">
											<i class="fas fa-times-circle mr-1"></i> Deselect All (<span id="deselectCountBadge">0</span>)
										</button>
									</div>
											<?php
// Remove PHP pagination - Load ALL data for DataTables
// DataTables will handle pagination on client-side

// Check if expired filter is applied
$expiredFilter = isset($_GET['expired']) && $_GET['expired'] == 1 ? "AND create_post.expiry_date < NOW()" : "";

// Payment filter - Use EXISTS subqueries (same as export query)
$paymentFilter = "";
if(isset($_GET['payment_status']) && !empty($_GET['payment_status'])) {
    $paymentStatus = mysqli_real_escape_string($config, $_GET['payment_status']);
    if($paymentStatus == 'pending') {
        $paymentFilter = "AND (
            (create_post.status = 0 
             AND (create_post.payment_type IS NULL OR create_post.payment_type = '')
             AND (create_post.utr_number IS NULL OR create_post.utr_number = '')
             AND NOT EXISTS (SELECT 1 FROM online_payment_transcation WHERE Order_id = create_post.post_id AND Paid_Amout > 0))
            OR (create_post.net_amount > 0 
             AND (create_post.payment_type IS NULL OR create_post.payment_type = '')
             AND create_post.status = 0)
        )";
    } elseif($paymentStatus == 'completed') {
        $paymentFilter = "AND (
            (create_post.payment_type = '0' AND (EXISTS (SELECT 1 FROM online_payment_transcation WHERE Order_id = create_post.post_id AND Paid_Amout > 0) OR create_post.payment_confirmed_at IS NOT NULL))
            OR EXISTS (SELECT 1 FROM online_payment_transcation WHERE Order_id = create_post.post_id AND Paid_Amout > 0)
            OR (create_post.utr_number IS NOT NULL AND create_post.utr_number != '' AND create_post.status = 1)
            OR create_post.payment_type IN ('1', '2')
        )";
    } elseif($paymentStatus == 'free') {
        $paymentFilter = "AND (create_post.package_amount = 0 OR create_post.package_amount IS NULL OR create_post.net_amount = 0 OR create_post.net_amount IS NULL)";
    }
}

// Date filter
$dateFilter = "";
$dateFilterType = isset($_GET['date_filter_type']) ? mysqli_real_escape_string($config, $_GET['date_filter_type']) : '';

if (!empty($dateFilterType) && $dateFilterType != 'all') {
    if ($dateFilterType == 'single') {
        // Single date filter
        if (isset($_GET['single_date']) && !empty($_GET['single_date'])) {
            $singleDate = mysqli_real_escape_string($config, $_GET['single_date']);
            $dateFilter = "AND DATE(create_post.post_addon) = '$singleDate'";
        }
    } elseif ($dateFilterType == 'range') {
        // Date range filter (From/To)
        if (isset($_GET['date_from']) && !empty($_GET['date_from']) && isset($_GET['date_to']) && !empty($_GET['date_to'])) {
            $dateFrom = mysqli_real_escape_string($config, $_GET['date_from']);
            $dateTo = mysqli_real_escape_string($config, $_GET['date_to']);
            $dateFilter = "AND DATE(create_post.post_addon) BETWEEN '$dateFrom' AND '$dateTo'";
        }
    }
}

// Search functionality
$searchTerm = isset($_GET['search']) ? mysqli_real_escape_string($config, $_GET['search']) : '';
$searchQuery = "";

if (!empty($searchTerm)) {
    $searchQuery = "AND (
        create_post.driver_name LIKE '%$searchTerm%' 
        OR create_post.vehicle_no LIKE '%$searchTerm%' 
        OR create_post.phone_no LIKE '%$searchTerm%' 
        OR create_post.whatsapp_no LIKE '%$searchTerm%' 
        OR EXISTS (SELECT 1 FROM dir_city_master WHERE dir_city_id = create_post.city_id AND dir_city_name LIKE '%$searchTerm%')
        OR EXISTS (SELECT 1 FROM dir_state_master WHERE state_id = create_post.state_id AND name LIKE '%$searchTerm%')
        OR EXISTS (SELECT 1 FROM dir_area_master WHERE dir_area_id = create_post.area_id AND dir_area_name LIKE '%$searchTerm%')
    )";
}

// Server-side processing - no need to fetch all data here
// DataTables will fetch data via AJAX in chunks of 10

// Count total records - Simple query matching export query exactly
$totalRecordsQuery = mysqli_query(
    $config,
    "SELECT COUNT(*) AS total
     FROM create_post
     WHERE create_post.delete_id = '0' 
     $expiredFilter
     $paymentFilter
     $dateFilter
     $searchQuery"
);

$totalRecordsRow = mysqli_fetch_assoc($totalRecordsQuery);
$totalRecords = (int) $totalRecordsRow['total'];

// Error handling for count query
if (!$totalRecordsQuery) {
    die("Error in count query: " . mysqli_error($config));
}
?>

									
<!-- Filter and Search Section -->
<div class="mb-3">
    <form method="GET" action="" id="filterForm">
        <div class="row">
            <!-- Payment Status Filter -->
            <div class="col-md-3 col-lg-2 mb-2">
                <label class="form-label">Payment Status</label>
                <select name="payment_status" id="payment_status_filter" class="form-control">
                    <option value="">All Payment Status</option>
                    <option value="pending" <?= isset($_GET['payment_status']) && $_GET['payment_status'] == 'pending' ? 'selected' : '' ?>>Pending Payment</option>
                    <option value="completed" <?= isset($_GET['payment_status']) && $_GET['payment_status'] == 'completed' ? 'selected' : '' ?>>Payment Completed</option>
                    <option value="free" <?= isset($_GET['payment_status']) && $_GET['payment_status'] == 'free' ? 'selected' : '' ?>>Free Registration</option>
                </select>
            </div>
            
            <!-- Expired Filter -->
            <div class="col-md-3 col-lg-2 mb-2">
                <label class="form-label">Registration Status</label>
                <select name="expired" id="expired_filter" class="form-control">
                    <option value="">All Registrations</option>
                    <option value="1" <?= isset($_GET['expired']) && $_GET['expired'] == 1 ? 'selected' : '' ?>>Expired Only</option>
                </select>
            </div>
            
            <!-- Date Filter Type -->
            <div class="col-md-3 col-lg-2 mb-2">
                <label class="form-label">Date Filter</label>
                <select name="date_filter_type" id="date_filter_type" class="form-control">
                    <option value="all" <?= (!isset($_GET['date_filter_type']) || $_GET['date_filter_type'] == 'all') ? 'selected' : '' ?>>All Dates</option>
                    <option value="single" <?= isset($_GET['date_filter_type']) && $_GET['date_filter_type'] == 'single' ? 'selected' : '' ?>>Single Date</option>
                    <option value="range" <?= isset($_GET['date_filter_type']) && $_GET['date_filter_type'] == 'range' ? 'selected' : '' ?>>From/To Date</option>
                </select>
            </div>
            
            <!-- Single Date Input -->
            <div class="col-md-3 col-lg-2 mb-2" id="single_date_container" style="display: <?= (isset($_GET['date_filter_type']) && $_GET['date_filter_type'] == 'single') ? 'block' : 'none' ?>;">
                <label class="form-label">Select Date</label>
                <input type="date" name="single_date" id="single_date" class="form-control" value="<?= isset($_GET['single_date']) ? htmlspecialchars($_GET['single_date']) : '' ?>">
            </div>
            
            <!-- Date Range Inputs -->
            <div class="col-md-3 col-lg-2 mb-2" id="date_from_container" style="display: <?= (isset($_GET['date_filter_type']) && $_GET['date_filter_type'] == 'range') ? 'block' : 'none' ?>;">
                <label class="form-label">From Date</label>
                <input type="date" name="date_from" id="date_from" class="form-control" value="<?= isset($_GET['date_from']) ? htmlspecialchars($_GET['date_from']) : '' ?>">
            </div>
            
            <div class="col-md-3 col-lg-2 mb-2" id="date_to_container" style="display: <?= (isset($_GET['date_filter_type']) && $_GET['date_filter_type'] == 'range') ? 'block' : 'none' ?>;">
                <label class="form-label">To Date</label>
                <input type="date" name="date_to" id="date_to" class="form-control" value="<?= isset($_GET['date_to']) ? htmlspecialchars($_GET['date_to']) : '' ?>">
            </div>
            
            <!-- Search -->
            <div class="col-md-6 col-lg-3 mb-2">
                <label class="form-label">Search</label>
                <input type="text" name="search" id="search-input1" class="form-control" placeholder="Search by name, vehicle, phone..." value="<?php echo htmlspecialchars($searchTerm); ?>">
            </div>
            
            <div class="col-md-3 col-lg-2 mb-2">
                <label class="form-label">&nbsp;</label><br>
                <button class="btn btn-primary btn-block" type="submit">
                    <i class="fas fa-search"></i> Search
                </button>
            </div>
            
            <!-- Clear Filter Button -->
            <div class="col-md-12 mb-2">
                <button type="button" class="btn btn-secondary btn-sm" onclick="clearFilters()">
                    <i class="fas fa-times"></i> Clear All Filters
                </button>
                <?php 
                // Show filter status
                $activeFilters = [];
                if(!empty($searchTerm)) {
                    $activeFilters[] = "Search: $searchTerm";
                }
                if(isset($_GET['payment_status']) && !empty($_GET['payment_status'])) {
                    $paymentLabels = [
                        'pending' => 'Pending Payment',
                        'completed' => 'Payment Completed',
                        'free' => 'Free Registration'
                    ];
                    $activeFilters[] = $paymentLabels[$_GET['payment_status']] ? $_GET['payment_status']: 'All Payment Status';
                }
                if(isset($_GET['expired']) && $_GET['expired'] == 1) {
                    $activeFilters[] = "Expired Only";
                }
                if(isset($_GET['date_filter_type']) && $_GET['date_filter_type'] != 'all') {
                    if($_GET['date_filter_type'] == 'single' && isset($_GET['single_date']) && !empty($_GET['single_date'])) {
                        $activeFilters[] = "Date: " . date('d-M-Y', strtotime($_GET['single_date']));
                    } elseif($_GET['date_filter_type'] == 'range' && isset($_GET['date_from']) && isset($_GET['date_to']) && !empty($_GET['date_from']) && !empty($_GET['date_to'])) {
                        $activeFilters[] = "Date Range: " . date('d-M-Y', strtotime($_GET['date_from'])) . " to " . date('d-M-Y', strtotime($_GET['date_to']));
                    }
                }
                if(!empty($activeFilters)): ?>
                    <span class="badge badge-info ml-2">Filters Applied: <?= implode(', ', $activeFilters) ?></span>
                <?php endif; ?>
            </div>
        </div>
    </form>
</div>

<script>
function clearFilters() {
    window.location.href = 'create_post.php';
}

// Handle date filter type change
document.getElementById('date_filter_type').addEventListener('change', function() {
    var filterType = this.value;
    var singleDateContainer = document.getElementById('single_date_container');
    var dateFromContainer = document.getElementById('date_from_container');
    var dateToContainer = document.getElementById('date_to_container');
    
    // Hide all date inputs first
    singleDateContainer.style.display = 'none';
    dateFromContainer.style.display = 'none';
    dateToContainer.style.display = 'none';
    
    // Show relevant inputs based on selection
    if (filterType === 'single') {
        singleDateContainer.style.display = 'block';
    } else if (filterType === 'range') {
        dateFromContainer.style.display = 'block';
        dateToContainer.style.display = 'block';
    }
});

// Optional: Auto-submit when filters change
document.getElementById('payment_status_filter').addEventListener('change', function() {
    document.getElementById('filterForm').submit();
});

document.getElementById('expired_filter').addEventListener('change', function() {
    document.getElementById('filterForm').submit();
});

// Initialize date filter visibility on page load
document.addEventListener('DOMContentLoaded', function() {
    var filterType = document.getElementById('date_filter_type').value;
    var singleDateContainer = document.getElementById('single_date_container');
    var dateFromContainer = document.getElementById('date_from_container');
    var dateToContainer = document.getElementById('date_to_container');
    
    if (filterType === 'single') {
        singleDateContainer.style.display = 'block';
    } else if (filterType === 'range') {
        dateFromContainer.style.display = 'block';
        dateToContainer.style.display = 'block';
    }
});
</script>
                                <style>
                                    /* Premium Card style for table on mobile */
                                    @media (max-width: 767px) {
                                        .table-responsive .table { display: block; border: none; background: transparent; }
                                        .table-responsive .table thead { display: none; }
                                        .table-responsive .table tbody, .table-responsive .table tr, .table-responsive .table td {
                                            display: block;
                                            width: 100%;
                                        }
                                        .table-responsive .table tr {
                                            margin-bottom: 20px;
                                            background: #fff;
                                            border-radius: 12px;
                                            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
                                            border: 1px solid #e9ecef;
                                            overflow: hidden;
                                        }
                                        .table-responsive .table td {
                                            display: flex;
                                            justify-content: space-between;
                                            align-items: center;
                                            padding: 12px 16px;
                                            border: none;
                                            border-bottom: 1px solid #f1f3f5;
                                            text-align: right;
                                            color: #212529;
                                            font-size: 0.95rem;
                                            word-break: break-word;
                                        }
                                        .table-responsive .table td:last-child {
                                            border-bottom: none;
                                            padding-bottom: 16px;
                                        }
                                        .table-responsive .table td:before {
                                            font-weight: 600;
                                            color: #868e96;
                                            text-transform: uppercase;
                                            font-size: 0.75rem;
                                            letter-spacing: 0.5px;
                                            text-align: left;
                                            margin-right: 15px;
                                            flex-shrink: 0;
                                        }
                                        /* Labels via nth-child for DataTables */
                                        .table-responsive .table td:nth-child(1):before { content: "S.No"; }
                                        .table-responsive .table td:nth-child(2):before { content: "Driver Name"; }
                                        .table-responsive .table td:nth-child(3):before { content: "Vehicle No"; }
                                        .table-responsive .table td:nth-child(4):before { content: "Vehicle Photo"; }
                                        .table-responsive .table td:nth-child(5):before { content: "Phone No"; }
                                        .table-responsive .table td:nth-child(6):before { content: "Whatsapp No"; }
                                        .table-responsive .table td:nth-child(7):before { content: "State"; }
                                        .table-responsive .table td:nth-child(8):before { content: "District"; }
                                        .table-responsive .table td:nth-child(9):before { content: "City"; }
                                        .table-responsive .table td:nth-child(10):before { content: "Status"; }
                                        .table-responsive .table td:nth-child(11):before { content: "Paid Status"; }
                                        .table-responsive .table td:nth-child(12):before { content: "Confirmed On"; }
                                        .table-responsive .table td:nth-child(13):before { content: "Amount"; }
                                        .table-responsive .table td:nth-child(14):before { content: "Create On"; }
                                        .table-responsive .table td:nth-child(15):before { content: "Action"; }
                                        
                                        /* Highlight the first row (S.No) as a header */
                                        .table-responsive .table td:nth-child(1) {
                                            background-color: #f8f9fa;
                                            color: #495057;
                                            font-weight: bold;
                                            border-bottom: 2px solid #e9ecef;
                                        }
                                        .table-responsive .table td:nth-child(1):before {
                                            color: #495057;
                                        }
                                        /* Badge fixes */
                                        .table-responsive .table td .badge, .table-responsive .table td .btn {
                                            font-size: 0.85rem;
                                            padding: 6px 10px;
                                            border-radius: 6px;
                                        }
                                    }
                                </style>
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover">
											<thead>
												<tr>
													<th style="min-width: 90px;"><input type="checkbox" id="selectAllDrivers" title="Select All" style="width: 17px; height: 17px; cursor: pointer; vertical-align: middle; margin-right: 4px;"> S.No</th>
													<th> Driver Name</th>
													<!-- <th> Vehicle Name</th> -->
													<th>Vehicle No</th>
													<th>Vehicle Photo</th>
													<th>Phone No</th>
													<th>Whatsapp No</th>
													<!-- <th>Address</th> -->
													<th>State</th>
													<th>District</th>
													
													<th>City</th>
													
													<th>Status</th>
													<th>Paid Status</th> <!-- New Column -->
													<th>Confirmed On</th>
													<th>Amount</th> <!-- New Column -->
													<th>Create On</th>
													<th>Action</th>
												</tr>
											</thead>

											<tbody>
												<!-- Data will be loaded via AJAX (server-side processing) -->
												<!-- No PHP loop needed - DataTables handles data loading -->
											</tbody>


										</table>
										<!-- PHP Pagination removed - DataTables handles pagination now -->


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
	<!-- DataTables Buttons Extension -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
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
								record.Vehicle_Photo ? '<img src="/photos/vehicle/' + encodeURIComponent(record.Vehicle_Photo) + '" style="width:128px;height:129px;object-fit:cover;" onerror="this.style.display=\'none\'">' : '<span class="text-muted">No photo</span>',
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
			// Function to get current filter parameters from URL
			function getFilterParams() {
				var urlParams = new URLSearchParams(window.location.search);
				var params = {};
				if (urlParams.get('expired')) params.expired = urlParams.get('expired');
				if (urlParams.get('payment_status')) params.payment_status = urlParams.get('payment_status');
				if (urlParams.get('date_filter_type')) params.date_filter_type = urlParams.get('date_filter_type');
				if (urlParams.get('single_date')) params.single_date = urlParams.get('single_date');
				if (urlParams.get('date_from')) params.date_from = urlParams.get('date_from');
				if (urlParams.get('date_to')) params.date_to = urlParams.get('date_to');
				if (urlParams.get('search')) params.search = urlParams.get('search');
				return params;
			}
			
			// Build initial server-side processing URL with filter parameters
			var sspUrl = 'create_post_ssp.php?';
			var urlParams = new URLSearchParams(window.location.search);
			var paramArray = [];
			if (urlParams.get('expired')) paramArray.push('expired=' + urlParams.get('expired'));
			if (urlParams.get('payment_status')) paramArray.push('payment_status=' + urlParams.get('payment_status'));
			if (urlParams.get('date_filter_type')) paramArray.push('date_filter_type=' + urlParams.get('date_filter_type'));
			if (urlParams.get('single_date')) paramArray.push('single_date=' + urlParams.get('single_date'));
			if (urlParams.get('date_from')) paramArray.push('date_from=' + urlParams.get('date_from'));
			if (urlParams.get('date_to')) paramArray.push('date_to=' + urlParams.get('date_to'));
			if (urlParams.get('search')) paramArray.push('search=' + encodeURIComponent(urlParams.get('search')));
			if (paramArray.length > 0) {
				sspUrl += paramArray.join('&');
			}
			
			var table = $('#basic-datatables').DataTable({
				"processing": true, // Show processing indicator
				"serverSide": true, // Enable server-side processing
				"columnDefs": [
					{
						"targets": 0,
						"orderable": false,
						"createdCell": function (td, cellData) {
							$(td).html(cellData);
						}
					},
					{
						"targets": 3,
						"orderable": false,
						"createdCell": function (td, cellData) {
							$(td).html(cellData);
						}
					}
				],
				"drawCallback": function(settings) {
					$('.driver-checkbox').each(function() {
						var custId = $(this).val();
						var postId = $(this).data('post-id');
						var key = (custId && custId != '0') ? custId : ('p_' + postId);
						if (window.selectedDriversMap && window.selectedDriversMap[key]) {
							$(this).prop('checked', true);
						}
					});
					if (typeof updateSelectAllCheckboxState === 'function') {
						updateSelectAllCheckboxState();
					}
				},
				"ajax": {
					"url": sspUrl,
					"type": "GET",
					"data": function(d) {
						// Add filter parameters to each request
						var filterParams = getFilterParams();
						for (var key in filterParams) {
							d[key] = filterParams[key];
						}
					},
					"dataSrc": function(json) {
						// Update export button text after data loads
						setTimeout(function() {
							var info = table.page.info();
							var filteredTotal = info.recordsTotal;
							var button = table.button(0);
							if (button && button.node) {
								$(button.node).html('<i class="fas fa-file-excel"></i> Export to Excel (Total: ' + filteredTotal + ')');
							}
						}, 100);
						return json.data;
					}
				},
				"paging": true, // Enable DataTables pagination
				"searching": false, // Disable default search (using custom filter)
        "ordering": false, // Disable ordering
        "info": true, // Show pagination info
				"lengthChange": true, // Enable length change dropdown
				"pageLength": 10, // Number of items per page (loads 10 at a time)
				"lengthMenu": [[10, 20, 25, 50, 100, -1], [10, 20, 25, 50, 100, "All"]], // Page length options including All
				"dom": '<"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6"l>>rtip', // Add buttons and length menu
				"buttons": [
					{
						text: '<i class="fas fa-file-excel"></i> Export to Excel (Total: <?php echo $totalRecords; ?>)',
						className: 'btn btn-success',
						action: function ( e, dt, button, config ) {
							// Build export URL dynamically from current filter parameters
							var urlParams = new URLSearchParams(window.location.search);
							var exportParams = [];
							
							// Get all filter parameters from URL
							if (urlParams.get('expired')) exportParams.push('expired=' + urlParams.get('expired'));
							if (urlParams.get('payment_status')) exportParams.push('payment_status=' + encodeURIComponent(urlParams.get('payment_status')));
							if (urlParams.get('date_filter_type')) exportParams.push('date_filter_type=' + encodeURIComponent(urlParams.get('date_filter_type')));
							if (urlParams.get('single_date')) exportParams.push('single_date=' + encodeURIComponent(urlParams.get('single_date')));
							if (urlParams.get('date_from')) exportParams.push('date_from=' + encodeURIComponent(urlParams.get('date_from')));
							if (urlParams.get('date_to')) exportParams.push('date_to=' + encodeURIComponent(urlParams.get('date_to')));
							if (urlParams.get('search')) exportParams.push('search=' + encodeURIComponent(urlParams.get('search')));
							
							var exportUrl = 'post_report_ex_create.php' + (exportParams.length > 0 ? '?' + exportParams.join('&') : '');
							
							// Get current filtered count from DataTables
							var info = dt.page.info();
							var filteredTotal = info.recordsTotal;
							
							// Show loading message
							if (typeof Swal !== 'undefined') {
								Swal.fire({
									title: 'Exporting...',
									text: 'Preparing Excel file with ' + filteredTotal + ' records. Please wait...',
									icon: 'info',
									allowOutsideClick: false,
									allowEscapeKey: false,
									showConfirmButton: false,
									didOpen: () => {
										Swal.showLoading();
									}
								});
							}
							// Trigger download
							window.location.href = exportUrl;
							// Close loading after a delay (download should start)
							setTimeout(function() {
								if (typeof Swal !== 'undefined') {
									Swal.close();
								}
							}, 2000);
						}
					}
				],
				"language": {
					"info": "Showing _START_ to _END_ of _TOTAL_ entries (Total: <?php echo $totalRecords; ?>)",
					"lengthMenu": "Show _MENU_ entries",
					"infoEmpty": "No entries to show",
					"infoFiltered": "(filtered from _MAX_ total entries)",
					"processing": "Loading data..."
				}
			});
			
			// Reload table when filters change
			$('#filterForm').on('submit', function(e) {
				e.preventDefault();
				// Rebuild URL with new filters
				var formData = $(this).serialize();
				// Update browser URL to persist filters
				var newPageUrl = window.location.pathname + '?' + formData;
				window.history.pushState({}, '', newPageUrl);
				// Rebuild DataTables URL with all filter parameters
				var newUrl = 'create_post_ssp.php?' + formData;
				// Update DataTables ajax URL and reload
				table.ajax.url(newUrl).load(function() {
					// Update export button text after table reloads
					setTimeout(function() {
						var info = table.page.info();
						var filteredTotal = info.recordsTotal;
						var button = table.button(0);
						if (button && button.node) {
							$(button.node).html('<i class="fas fa-file-excel"></i> Export to Excel (Total: ' + filteredTotal + ')');
						}
					}, 100);
				});
			});
		});


		function deletepost(id) {
			var id;
			//   alert(id);

			$.ajax({
				type: "POST",
				url: 'post_delete_popup.php',
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

		function updatePaymentStatus(postId) {
			// Show confirmation dialog
			Swal.fire({
				title: 'Confirm Payment',
				text: 'Are you sure you want to confirm this payment?',
				icon: 'question',
				showCancelButton: true,
				confirmButtonColor: '#28a745',
				cancelButtonColor: '#dc3545',
				confirmButtonText: 'Yes, Confirm!',
				cancelButtonText: 'Cancel'
			}).then((result) => {
				if (result.isConfirmed) {
					// Make AJAX call to update payment status
					$.ajax({
						type: "POST",
						url: 'update_payment_status.php',
						data: {
							post_id: postId,
							action: 'confirm_payment'
						},
						success: function(response) {
							var result = JSON.parse(response);
							if (result.success) {
								Swal.fire({
									title: 'Success!',
									text: 'Payment confirmed successfully!',
									icon: 'success',
									confirmButtonColor: '#28a745'
								}).then(() => {
									// Reload the page to show updated status
									location.reload();
								});
							} else {
								Swal.fire({
									title: 'Error!',
									text: result.message || 'Failed to confirm payment',
									icon: 'error',
									confirmButtonColor: '#dc3545'
								});
							}
						},
						error: function() {
							Swal.fire({
								title: 'Error!',
								text: 'An error occurred while processing your request',
								icon: 'error',
								confirmButtonColor: '#dc3545'
							});
						}
					});
				}
			});
		}

		function updateUTRNumber(postId, currentUTR, currentDate) {
			// Show UTR update form using SweetAlert2
			Swal.fire({
				title: 'Update UTR Number',
				html: `
					<form id="utrUpdateForm">
						<div class="form-group">
							<label for="new_utr_number">UTR Number:</label>
							<input type="text" id="new_utr_number" class="form-control" value="${currentUTR}" required>
						</div>
						<div class="form-group">
							<label for="new_utr_date">UTR Date:</label>
							<input type="date" id="new_utr_date" class="form-control" value="${currentDate}" required>
						</div>
					</form>
				`,
				showCancelButton: true,
				confirmButtonColor: '#ffc107',
				cancelButtonColor: '#dc3545',
				confirmButtonText: 'Update UTR',
				cancelButtonText: 'Cancel',
				preConfirm: () => {
					const utrNumber = document.getElementById('new_utr_number').value;
					const utrDate = document.getElementById('new_utr_date').value;
					
					if (!utrNumber.trim()) {
						Swal.showValidationMessage('UTR Number is required');
						return false;
					}
					if (!utrDate) {
						Swal.showValidationMessage('UTR Date is required');
						return false;
					}
					
					return { utrNumber: utrNumber, utrDate: utrDate };
				}
			}).then((result) => {
				if (result.isConfirmed) {
					// Make AJAX call to update UTR
					$.ajax({
						type: "POST",
						url: 'update_payment_status.php',
						data: {
							post_id: postId,
							action: 'update_utr',
							utr_number: result.value.utrNumber,
							utr_date: result.value.utrDate
						},
						success: function(response) {
							var result = JSON.parse(response);
							if (result.success) {
								Swal.fire({
									title: 'Success!',
									text: 'UTR Number updated successfully!',
									icon: 'success',
									confirmButtonColor: '#28a745'
								}).then(() => {
									// Reload the page to show updated UTR
									location.reload();
								});
							} else {
								Swal.fire({
									title: 'Error!',
									text: result.message || 'Failed to update UTR number',
									icon: 'error',
									confirmButtonColor: '#dc3545'
								});
							}
						},
						error: function() {
							Swal.fire({
								title: 'Error!',
								text: 'An error occurred while updating UTR number',
								icon: 'error',
								confirmButtonColor: '#dc3545'
							});
						}
					});
				}
			});
		}

		function clearUTRNumber(postId) {
			// Show confirmation dialog for clearing UTR
			Swal.fire({
				title: 'Clear UTR Number',
				text: 'Are you sure you want to clear the UTR number and date? This action cannot be undone.',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#dc3545',
				cancelButtonColor: '#6c757d',
				confirmButtonText: 'Yes, Clear UTR!',
				cancelButtonText: 'Cancel'
			}).then((result) => {
				if (result.isConfirmed) {
					// Make AJAX call to clear UTR
					$.ajax({
						type: "POST",
						url: 'update_payment_status.php',
						data: {
							post_id: postId,
							action: 'clear_utr'
						},
						success: function(response) {
							var result = JSON.parse(response);
							if (result.success) {
								Swal.fire({
									title: 'Success!',
									text: 'UTR Number and Date cleared successfully!',
									icon: 'success',
									confirmButtonColor: '#28a745'
								}).then(() => {
									// Reload the page to show updated status
									location.reload();
								});
							} else {
								Swal.fire({
									title: 'Error!',
									text: result.message || 'Failed to clear UTR number',
									icon: 'error',
									confirmButtonColor: '#dc3545'
								});
							}
						},
						error: function() {
							Swal.fire({
								title: 'Error!',
								text: 'An error occurred while clearing UTR number',
								icon: 'error',
								confirmButtonColor: '#dc3545'
							});
						}
					});
				}
			});
		}
	</script>

	<!-- Modal for Sending Message to Selected Drivers -->
	<div class="modal fade" id="sendMessageModal" tabindex="-1" role="dialog" aria-labelledby="sendMessageModalLabel" aria-hidden="true" style="z-index: 10500;">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content shadow border-0" style="border-radius: 12px; overflow: hidden;">
				<div class="modal-header text-white" style="background: linear-gradient(135deg, #1572e8, #0056b3);">
					<h5 class="modal-title font-weight-bold" id="sendMessageModalLabel">
						<i class="fas fa-paper-plane mr-2"></i> Send Message to Selected Driver(s)
					</h5>
					<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity: 0.9;">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body p-4" style="background-color: #fcfcfc;">
					<div class="alert alert-info py-2 px-3 mb-3 d-flex align-items-center justify-content-between" style="border-radius: 8px;">
						<div>
							<i class="fas fa-users mr-1"></i> <strong>Selected Drivers:</strong> 
							<span id="selectedDriversCountText" class="badge badge-primary ml-1" style="font-size: 13px;">0 Drivers</span>
						</div>
						<button type="button" class="btn btn-sm btn-outline-danger" onclick="clearSelectedDrivers()">
							<i class="fas fa-times-circle mr-1"></i> Clear Selection
						</button>
					</div>
					
					<label class="font-weight-bold text-muted small mb-1">RECIPIENTS PREVIEW</label>
					<div id="selectedDriversListPreview" class="mb-3 p-2 border rounded bg-white d-flex flex-wrap" style="max-height: 120px; overflow-y: auto; gap: 6px;">
						<!-- Recipient badges will be rendered here -->
					</div>

					<div class="form-group mb-2 p-0">
						<label for="driverMessageText" class="font-weight-bold text-dark">
							Message Content / செய்தி <span class="text-danger">*</span>
						</label>
						<textarea class="form-control" id="driverMessageText" rows="5" placeholder="Type your message here (e.g. Please update your vehicle front view photo, payment confirmation notice, etc.)..." style="font-size: 15px; border-radius: 8px; line-height: 1.5;" required></textarea>
						<small class="form-text text-muted mt-2">
							<i class="fas fa-info-circle text-primary"></i> This message will open directly as a popup modal on the selected driver's screen when they use the mobile app.
						</small>
					</div>
				</div>
				<div class="modal-footer bg-light border-top py-3">
					<button type="button" class="btn btn-secondary px-3" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-success px-4 font-weight-bold" id="btnSubmitDriverMessage" onclick="submitDriverMessage()">
						<i class="fas fa-paper-plane mr-1"></i> Send Message Now
					</button>
				</div>
			</div>
		</div>
	</div>

	<script>
		window.selectedDriversMap = {};

		function updateSelectedCountBadge() {
			var count = Object.keys(selectedDriversMap).length;
			$('#selectedCountBadge').text(count);
			$('#selectedDriversCountText').text(count + (count === 1 ? ' Driver' : ' Drivers'));
			if (count > 0) {
				$('#btnClearSelectedBtn').show();
				$('#deselectCountBadge').text(count);
			} else {
				$('#btnClearSelectedBtn').hide();
			}
		}

		function updateSelectAllCheckboxState() {
			var visibleCheckboxes = $('.driver-checkbox');
			if (visibleCheckboxes.length === 0) {
				$('#selectAllDrivers').prop('checked', false);
				return;
			}
			var allChecked = true;
			visibleCheckboxes.each(function() {
				if (!$(this).prop('checked')) {
					allChecked = false;
				}
			});
			$('#selectAllDrivers').prop('checked', allChecked);
		}

		// Checkbox selection event (delegated for DataTables dynamic rows)
		$(document).on('change', '.driver-checkbox', function() {
			var custId = $(this).val();
			var postId = $(this).data('post-id');
			var key = (custId && custId != '0') ? custId : ('p_' + postId);
			var name = $(this).data('driver-name') || '';
			var phone = $(this).data('phone') || '';
			var vehicle = $(this).data('vehicle-no') || '';

			if ($(this).is(':checked')) {
				selectedDriversMap[key] = {
					customer_id: custId,
					post_id: postId,
					driver_name: name,
					phone_no: phone,
					vehicle_no: vehicle
				};
			} else {
				delete selectedDriversMap[key];
			}
			updateSelectedCountBadge();
			updateSelectAllCheckboxState();
		});

		// Select All visible checkbox
		$(document).on('change', '#selectAllDrivers', function() {
			var isChecked = $(this).is(':checked');
			$('.driver-checkbox').each(function() {
				var custId = $(this).val();
				var postId = $(this).data('post-id');
				var key = (custId && custId != '0') ? custId : ('p_' + postId);
				var name = $(this).data('driver-name') || '';
				var phone = $(this).data('phone') || '';
				var vehicle = $(this).data('vehicle-no') || '';

				$(this).prop('checked', isChecked);
				if (isChecked) {
					selectedDriversMap[key] = {
						customer_id: custId,
						post_id: postId,
						driver_name: name,
						phone_no: phone,
						vehicle_no: vehicle
					};
				} else {
					delete selectedDriversMap[key];
				}
			});
			updateSelectedCountBadge();
		});

		function renderSelectedDriversPreview() {
			var container = $('#selectedDriversListPreview');
			container.empty();
			var keys = Object.keys(selectedDriversMap);
			var total = keys.length;
			if (total === 0) {
				container.html('<span class="text-muted small">No drivers selected yet.</span>');
				return;
			}
			var maxPreview = 30;
			var previewKeys = keys.slice(0, maxPreview);
			previewKeys.forEach(function(key) {
				var drv = selectedDriversMap[key];
				var label = (drv.driver_name || 'Driver');
				if (drv.vehicle_no) label += ' (' + drv.vehicle_no + ')';
				if (drv.phone_no) label += ' - ' + drv.phone_no;
				var badgeHtml = '<span class="badge badge-light border p-2 m-1 d-inline-flex align-items-center" style="font-size: 13px;">' +
					'<i class="fas fa-user mr-1 text-primary"></i> ' + $('<div>').text(label).html() +
					' <a href="javascript:void(0)" onclick="removeSingleDriverSelection(\'' + key + '\')" class="ml-2 text-danger font-weight-bold" style="text-decoration:none;">&times;</a>' +
					'</span>';
				container.append(badgeHtml);
			});
			if (total > maxPreview) {
				container.append('<div class="w-100 text-center mt-2"><span class="badge badge-info p-2" style="font-size: 12px;">+ ' + (total - maxPreview).toLocaleString() + ' more drivers selected</span></div>');
			}
		}

		function removeSingleDriverSelection(key) {
			delete selectedDriversMap[key];
			$('.driver-checkbox').each(function() {
				var custId = $(this).val();
				var postId = $(this).data('post-id');
				var itemKey = (custId && custId != '0') ? custId : ('p_' + postId);
				if (itemKey === key) {
					$(this).prop('checked', false);
				}
			});
			updateSelectedCountBadge();
			updateSelectAllCheckboxState();
			renderSelectedDriversPreview();
		}

		function clearSelectedDrivers() {
			selectedDriversMap = {};
			$('.driver-checkbox').prop('checked', false);
			$('#selectAllDrivers').prop('checked', false);
			updateSelectedCountBadge();
			renderSelectedDriversPreview();
		}

		function getCurrentFilterParams() {
			var params = {};
			var searchVal = $('#search-input1').val();
			if (searchVal && searchVal.trim()) params.search = searchVal.trim();
			var paymentStatus = $('#payment_status_filter').val();
			if (paymentStatus) params.payment_status = paymentStatus;
			var expired = $('#expired_filter').val();
			if (expired) params.expired = expired;
			var dateFilterType = $('#date_filter_type').val();
			if (dateFilterType && dateFilterType !== 'all') {
				params.date_filter_type = dateFilterType;
				if (dateFilterType === 'single') {
					params.single_date = $('#single_date').val();
				} else if (dateFilterType === 'range') {
					params.date_from = $('#date_from').val();
					params.date_to = $('#date_to').val();
				}
			}
			var urlParams = new URLSearchParams(window.location.search);
			['search', 'expired', 'payment_status', 'date_filter_type', 'single_date', 'date_from', 'date_to'].forEach(function(k) {
				if (!params[k] && urlParams.get(k)) {
					params[k] = urlParams.get(k);
				}
			});
			return params;
		}

		function selectCurrentPageDrivers() {
			var added = 0;
			$('.driver-checkbox').each(function() {
				var custId = $(this).val();
				var postId = $(this).data('post-id');
				var key = (custId && custId != '0') ? custId : ('p_' + postId);
				var name = $(this).data('driver-name') || '';
				var phone = $(this).data('phone') || '';
				var vehicle = $(this).data('vehicle-no') || '';

				$(this).prop('checked', true);
				selectedDriversMap[key] = {
					customer_id: custId,
					post_id: postId,
					driver_name: name,
					phone_no: phone,
					vehicle_no: vehicle
				};
				added++;
			});
			$('#selectAllDrivers').prop('checked', true);
			updateSelectedCountBadge();

			if (typeof Swal !== 'undefined') {
				Swal.fire({
					icon: 'success',
					title: 'Selected',
					text: added + ' driver(s) on current page selected.',
					timer: 1500,
					showConfirmButton: false
				});
			}
		}

		function selectAllMatchingDrivers() {
			var params = getCurrentFilterParams();

			if (typeof Swal !== 'undefined') {
				Swal.fire({
					title: 'Selecting All Users...',
					text: 'Please wait while all users are being selected...',
					icon: 'info',
					allowOutsideClick: false,
					allowEscapeKey: false,
					showConfirmButton: false,
					didOpen: () => {
						Swal.showLoading();
					}
				});
			}

			$.ajax({
				url: 'Function/get_all_drivers_for_selection.php',
				type: 'GET',
				data: params,
				dataType: 'json',
				success: function(res) {
					if (res && res.success && res.drivers) {
						res.drivers.forEach(function(drv) {
							var custId = drv.customer_id;
							var postId = drv.post_id;
							var key = (custId && custId != '0') ? custId : ('p_' + postId);
							selectedDriversMap[key] = {
								customer_id: custId,
								post_id: postId,
								driver_name: drv.driver_name || '',
								phone_no: drv.phone_no || '',
								vehicle_no: drv.vehicle_no || ''
							};
						});

						$('.driver-checkbox').prop('checked', true);
						$('#selectAllDrivers').prop('checked', true);
						updateSelectedCountBadge();

						if (typeof Swal !== 'undefined') {
							Swal.fire({
								icon: 'success',
								title: 'All Users Selected!',
								text: 'Successfully selected ' + res.count.toLocaleString() + ' user(s).',
								timer: 2000,
								showConfirmButton: false
							});
						}
					} else {
						if (typeof Swal !== 'undefined') {
							Swal.fire({
								icon: 'error',
								title: 'Error',
								text: (res && res.message) ? res.message : 'Failed to fetch all users.',
								confirmButtonColor: '#dc3545'
							});
						}
					}
				},
				error: function(xhr, status, err) {
					console.error('Error fetching all drivers:', err);
					if (typeof Swal !== 'undefined') {
						Swal.fire({
							icon: 'error',
							title: 'Error',
							text: 'Server communication error while selecting users.',
							confirmButtonColor: '#dc3545'
						});
					}
				}
			});
		}

		function handleSelectAllUsersClick() {
			var totalRecords = <?php echo (int)$totalRecords; ?>;
			if (typeof table !== 'undefined' && table && table.page) {
				try {
					var info = table.page.info();
					if (info && typeof info.recordsTotal !== 'undefined') {
						totalRecords = info.recordsTotal;
					}
				} catch (e) {}
			}

			var visibleCount = $('.driver-checkbox').length;

			if (totalRecords <= 0) {
				if (typeof Swal !== 'undefined') {
					Swal.fire({
						icon: 'info',
						title: 'No Users',
						text: 'There are no users matching the current filters.',
						confirmButtonColor: '#1572e8'
					});
				}
				return;
			}

			// If total records is small or all visible on single page, select directly
			if (totalRecords <= visibleCount || totalRecords <= 10) {
				selectAllMatchingDrivers();
				return;
			}

			// If multiple pages exist, give admin option for all pages vs current page
			if (typeof Swal !== 'undefined') {
				Swal.fire({
					title: 'Select Users',
					html: '<div style="font-size: 15px; margin-bottom: 8px;">How would you like to select users?</div>' +
					      '<div class="text-muted small">You can select all <strong>' + totalRecords.toLocaleString() + '</strong> users across all pages, or only the <strong>' + visibleCount + '</strong> users on this page.</div>',
					icon: 'question',
					showCancelButton: true,
					showDenyButton: true,
					confirmButtonColor: '#1572e8',
					denyButtonColor: '#17a2b8',
					cancelButtonColor: '#6c757d',
					confirmButtonText: '<i class="fas fa-users mr-1"></i> Select All ' + totalRecords.toLocaleString() + ' Users',
					denyButtonText: '<i class="fas fa-list-ul mr-1"></i> Current Page Only (' + visibleCount + ')',
					cancelButtonText: 'Cancel'
				}).then((result) => {
					if (result.isConfirmed) {
						selectAllMatchingDrivers();
					} else if (result.isDenied) {
						selectCurrentPageDrivers();
					}
				});
			} else {
				selectAllMatchingDrivers();
			}
		}

		function openSendMessageModal() {
			if (Object.keys(selectedDriversMap).length === 0) {
				Swal.fire({
					icon: 'warning',
					title: 'No Drivers Selected',
					text: 'Please select one or more drivers using the checkboxes first.',
					confirmButtonColor: '#1572e8'
				});
				return;
			}
			renderSelectedDriversPreview();
			$('#sendMessageModal').modal('show');
		}

		function openSingleDriverMessage(customerId, driverName, phone, vehicleNo) {
			selectedDriversMap = {};
			$('.driver-checkbox').prop('checked', false);
			$('#selectAllDrivers').prop('checked', false);
			
			var key = (customerId && customerId != '0') ? customerId : 'single_' + phone;
			selectedDriversMap[key] = {
				customer_id: customerId,
				driver_name: driverName,
				phone_no: phone,
				vehicle_no: vehicleNo
			};
			
			$('.driver-checkbox').each(function() {
				if ($(this).val() == customerId && customerId != '0') {
					$(this).prop('checked', true);
				}
			});
			
			updateSelectedCountBadge();
			renderSelectedDriversPreview();
			$('#sendMessageModal').modal('show');
		}

		function submitDriverMessage() {
			var messageText = $('#driverMessageText').val().trim();
			if (!messageText) {
				Swal.fire({
					icon: 'warning',
					title: 'Message Required',
					text: 'Please enter the message content you wish to send.',
					confirmButtonColor: '#1572e8'
				});
				return;
			}
			
			var driversList = Object.values(selectedDriversMap);
			if (driversList.length === 0) {
				Swal.fire({
					icon: 'warning',
					title: 'No Recipients',
					text: 'Please select at least one driver.',
					confirmButtonColor: '#1572e8'
				});
				return;
			}

			var btn = $('#btnSubmitDriverMessage');
			btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Sending...');

			$.ajax({
				url: 'Function/send_driver_message.php',
				type: 'POST',
				dataType: 'json',
				data: {
					message: messageText,
					drivers: JSON.stringify(driversList)
				},
				success: function(res) {
					if (res && res.success) {
						$('#sendMessageModal').modal('hide');
						$('#driverMessageText').val('');
						clearSelectedDrivers();
						Swal.fire({
							icon: 'success',
							title: 'Message Sent!',
							text: res.message || 'Message sent successfully to selected driver(s)!',
							confirmButtonColor: '#28a745'
						});
					} else {
						Swal.fire({
							icon: 'error',
							title: 'Failed',
							text: (res && res.message) ? res.message : 'Failed to send message. Please try again.',
							confirmButtonColor: '#dc3545'
						});
					}
				},
				error: function(xhr, status, err) {
					console.error('Send message error:', err);
					Swal.fire({
						icon: 'error',
						title: 'Error',
						text: 'Server communication error. Please try again.',
						confirmButtonColor: '#dc3545'
					});
				},
				complete: function() {
					btn.prop('disabled', false).html('<i class="fas fa-paper-plane mr-1"></i> Send Message Now');
				}
			});
		}
	</script>
</body>

</html>