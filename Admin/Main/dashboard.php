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
            
            ?>  </title>
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
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
			<div class="panel-header bg-primary-gradient">
					<div class="page-inner py-5">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white pb-2 fw-bold">Dashboard</h2>
								<h5 class="text-white op-7 mb-2">Customer statistics</h5>
							</div>
							<div class="ml-md-auto py-2 py-md-0">
								<a href="Customer_Master.php" class="btn btn-white btn-border btn-round mr-2">Manage Customer</a>

							</div>
						</div>
					</div>
				</div>

				<div class="page-inner mt--5">
				<div class="row mt--2">
    <!-- Total Customer Card -->
    <div class="col-sm-6 col-md-6">
        <div class="card card-stats card-info card-round">
            <a href="Customer_Master.php">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="flaticon-interface-6"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Total Customer</p>
                                <h4 class="card-title"><?php
                                    $subscribe = mysqli_query($config, "SELECT COUNT(Customer_Id) FROM customer_master");
                                    $sub = mysqli_fetch_array($subscribe);
                                    echo $sub[0];
                                ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Expired Posts Card -->
    <div class="col-sm-6 col-md-6">
        <div class="card card-stats card-danger card-round">
		<a href="expired_list.php?expired=1" class="text-decoration-none text-dark">
		<div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="flaticon-interface-6"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Expired Posts</p>
                                <h4 class="card-title"><?php
								date_default_timezone_set("Asia/Kolkata"); // Set timezone to Indian Standard Time (IST)
								$current_date = date("Y-m-d"); // Get current date in IST
								
                                    // Query to count expired posts (where expiration date is less than current date)
                                    $expired_posts = mysqli_query($config, "SELECT COUNT(post_id) FROM create_post WHERE expiry_date < '$current_date' and delete_id = '0' ");
                                    $expired = mysqli_fetch_array($expired_posts);
                                    echo $expired[0];
                                ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>


					<div class="card-title"> Registration Statistics</div>
						<div class="row">
						<div class="col-sm-6 col-md-5">
							<div class="card card-stats card-round" style=" background-color: #ffad46;">
								<a href="create_post.php">
								<div class="card-body ">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
											<i  class="fa fa-compass text-white"></i>
											</div>
										</div>
									
								
										<div class="col-7 col-stats">
											<div class="numbers">
												<h3 style="  color: #ffffff;" > Total Registrations </h3>
												
												
												<h4 class="card-title" style="  color:#f1f1f1;"  ><?php
												$orderdate=date('Y-m-d');
// Count total records for pagination
$totalRecordsQuery = mysqli_query(
    $config,
    "SELECT COUNT(DISTINCT create_post.post_id) AS total
     FROM create_post
     LEFT JOIN dir_state_master ON create_post.state_id = dir_state_master.state_id
     LEFT JOIN dir_city_master ON create_post.city_id = dir_city_master.dir_city_id
     LEFT JOIN dir_area_master ON create_post.area_id = dir_area_master.dir_area_id
     LEFT JOIN online_payment_transcation ON create_post.customer_id = online_payment_transcation.Customer_id
     WHERE create_post.delete_id = '0' 
   "
);
$totalRecordsRow = mysqli_fetch_assoc($totalRecordsQuery);
$totalRecords = (int) $totalRecordsRow['total'];
echo $totalRecords;
?></h4>
											
											
											
											</div>
											
											
											
											
										</div>
										
										
										
									</div>
								</div>
									</a>	
								
							</div>
						</div>


						
						<div class="col-sm-6 col-md-5">
							<div class="card card-stats card-round" style=" background-color: #ffad46;">
								<a href="renewal_report.php">
								<div class="card-body ">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
											<i  class="fa fa-compass text-white"></i>
											</div>
										</div>
									
								
										<div class="col-7 col-stats">
											<div class="numbers">
												<h3 style="  color: #ffffff;" > Total Renewals </h3>
												
												
												<h4 class="card-title" style="  color:#f1f1f1;"  ><?php
												$orderdate=date('Y-m-d');
$total_product=mysqli_query($config,"SELECT COUNT(*) AS total FROM create_post 
                INNER JOIN renewal_list ON renewal_list.post_id = create_post.post_id ");
$tot=mysqli_fetch_array($total_product);

echo $tot[0];
?></h4>
											
											
											
											</div>
											
											
											
											
										</div>
										
										
										
									</div>
								</div>
									</a>	
								
							</div>
						</div>

						<div class="col-sm-6 col-md-5">
							<div class="card card-stats card-round" style=" background-color: #ffad46;">
								<a href="order_deatiles.php">
								<div class="card-body ">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
											<i  class="fa fa-car text-white"></i>
											</div>
										</div>
									
								
										<div class="col-7 col-stats">
											<div class="numbers">
												<h3 style="  color: #ffffff;" > Vehicle Online Booking </h3>
												
												
												<h4 class="card-title" style="  color:#f1f1f1;"  ><?php
												$orderdate=date('Y-m-d');
												// Count total online bookings/orders (all orders from orders table)
												$online_booking_query = mysqli_query($config, "SELECT COUNT(*) AS total FROM orders");
												$online_booking_result = mysqli_fetch_array($online_booking_query);
												echo $online_booking_result[0];
												?></h4>
											
											
											
											</div>
											
											
											
											
										</div>
										
										
										
									</div>
								</div>
									</a>	
								
							</div>
						</div>

						</div>

						<div class="row">

						<div class="col-md-12">

						<div class="card full-height">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">Recent Customer Registered</div>
										 
									</div>
								</div>

								<div class="card">
							 
								<div class="card-body">
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
                                        }
                                        .table-responsive .table td:last-child {
                                            border-bottom: none;
                                            padding-bottom: 16px;
                                        }
                                        .table-responsive .table td:before {
                                            content: attr(data-label);
                                            font-weight: 600;
                                            color: #868e96;
                                            text-transform: uppercase;
                                            font-size: 0.75rem;
                                            letter-spacing: 0.5px;
                                            text-align: left;
                                            margin-right: 15px;
                                        }
                                        /* Highlight the first row (ID/Name) as a header */
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
                                        .table-responsive .table td .badge {
                                            font-size: 0.85rem;
                                            padding: 6px 10px;
                                            border-radius: 6px;
                                        }
                                    }
                                </style>
								    <div class="table-responsive">
								        <table class="table table-bordered table-hover">
								            <thead class="thead-light">
											<tr>
												<th scope="col">#</th>
												<th scope="col">Name</th>
													<th scope="col">Mobile No</th>
													<th scope="col">State</th>

													<th scope="col">District</th>
													<th scope="col">City</th>
												<th scope="col">Register on</th>
												<!-- <th scope="col">Wallet</th> -->
												
													<th scope="col">Status</th>
														<!-- <th scope="col">No.of Order</th> -->
											</tr>
										    </thead>

										<tbody>
										<?php 
											 $cid=1;
											$Recent_customer=mysqli_query($config,"select * from customer_master order by Customer_Id DESC limit 10 ");
											while($recent_cust=mysqli_fetch_object($Recent_customer))
											{
											?>


											<tr>
											<td data-label="#"><?php echo $cid++; ?></td>
											<td data-label="Name"><?php echo $recent_cust->Customer_Name; ?></td>
											<td data-label="Mobile No"><?php echo $recent_cust->Customer_Phone_No; ?></td>
											<?php
                                                    $state_dsh=mysqli_query($config,"select * from dir_state_master where state_id ='$recent_cust->state_id' ");
                                                    $addsubcate_state=mysqli_fetch_object($state_dsh);
                                                   
                                                    ?>
													<td data-label="State"><?php echo $addsubcate_state->name;?></td>

											<?php
                                                    $main_cate_dis=mysqli_query($config,"select * from dir_city_master where dir_city_id ='$recent_cust->Add_city' ");
                                                    $addsubcate_dis__=mysqli_fetch_object($main_cate_dis);
                                                   
                                                    ?>
													<td data-label="District"><?php echo $addsubcate_dis__->dir_city_name;?></td>

													<?php
                                                    $main_cate_area=mysqli_query($config,"select * from dir_area_master where dir_area_id ='$recent_cust->Add_area' ");
                                                    $addsubcate_area__=mysqli_fetch_object($main_cate_area);
                                                   
                                                    ?>

													<td data-label="City"><?php echo $addsubcate_area__->dir_area_name;?></td>

													<td data-label="Register on">
    <?php  
      echo ($recent_cust->Customer_Registred_on);
 
    ?>
</td>

														<td data-label="Status"><?php 

$enablestatus=$recent_cust->Customer_Active_Status;

if($enablestatus== 1)
{ ?>
<label class="badge badge-success">Active</label>
<?php														
}else{
	?>
	<label class="badge badge-danger">In-Active</label>
	<?php
}


?></td>
											</tr>

											<?php } ?>
										</tbody>
								        </table>
								    </div>
								</div>
								</div>
							</div>
						</div>
						</div>
						
					</div>

				</div>
			</div>
		
		</div>
		
		 	</div>
			
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
</body>
</html>