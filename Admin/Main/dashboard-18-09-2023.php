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
						 <!-- <div class="col-sm-6 col-md-6">
							<div class="card card-stats card-warning card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="flaticon-users"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Visitors</p>
												<h4 class="card-title"><?php
												$orderdate=date('Y-m-d');
$order_delivered=mysqli_query($config,"select count(dir_vender_id) from dir_vender  ");
$orders_delivey=mysqli_fetch_array($order_delivered);

echo $orders_delivey[0];
?>
    </h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div> -->
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
												<p class="card-category">Customer</p>
												<h4 class="card-title"><?php
$subscribe=mysqli_query($config,"select count(Customer_Id) from customer_master  ");
$sub=mysqli_fetch_array($subscribe);

echo $sub[0];
?></h4>
											</div>
										</div>
									</div>
								</div>
								
								</a>
								
							</div>
						</div>
						
						
				 
						 
					</div>
					 <div class="card-title">Area Statistics</div>
					<div class="row">
						
						
						<!-- <div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round" style=" background-color: #ffad46;">
							
							<a href="bussness_list.php">
							
								<div class="card-body">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
											<i class="fa fa-briefcase text-white"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<h3 style="  color: #ffffff;" >Directory</h3>
												
												
												<h4 class="card-title" style="  color:#f1f1f1;"  ><?php
												$orderdate=date('Y-m-d');
$order_delivered=mysqli_query($config,"select count(dir_vender_id) from dir_vender  ");
$orders_delivey=mysqli_fetch_array($order_delivered);

echo $orders_delivey[0];
?></h4>
										
											</div>
										</div>
									</div>
								</div>
								
								</a>
							</div>
						</div> -->
						
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round" style=" background-color: #ffad46;">
								<a href="dir_area_master.php">
								<div class="card-body ">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
											<i  class="fa fa-compass text-white"></i>
											</div>
										</div>
									
								
										<div class="col-7 col-stats">
											<div class="numbers">
												<h3 style="  color: #ffffff;" > Area </h3>
												
												
												<h4 class="card-title" style="  color:#f1f1f1;"  ><?php
												$orderdate=date('Y-m-d');
$total_product=mysqli_query($config,"select count(dir_area_id) from dir_area_master ");
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
						<!-- <div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round" style=" background-color: #ffad46;">
							
							<a href="dir_keyword.php">
								<div class="card-body ">
									
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
											<i class="fa fa-bullhorn text-white"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<h3 style="  color: #ffffff;" > Keyword</h3>
												
												
												<h4 class="card-title" style="  color:#f1f1f1;"  ><?php
												$orderdate=date('Y-m-d');
$order_product=mysqli_query($config,"select count(dir_post_id) from dir_post  ");
$orders=mysqli_fetch_array($order_product);

echo $orders[0];
?></h4>
											
											</div>
										</div>
									</div>
								</div>
								
								</a>
							</div>
						</div> -->
					</div>
					 
				 		<div class="row">
					 
						<div class="col-md-12">
							<div class="card full-height">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">Recent Customer Registred</div>
										 
									</div>
								</div>
								<div class="card-body">
									
							
									
									
								<div class="card">
							 
								<div class="card-body">
								 
									<table class="table table-bordered">
										<thead>
											<tr>
												<th scope="col">#</th>
												<th scope="col">Name</th>
													<th scope="col">Mobile No</th>
												<th scope="col">Register on</th>
												<th scope="col">Wallet</th>
												
													<th scope="col">Status</th>
														<!-- <th scope="col">No.of Order</th> -->
											</tr>
										</thead>
										<tbody>
									<?php 
											 $cid=1;
											$Recent_customer=mysqli_query($config,"select * from customer_master order by Customer_Id DESC ");
											while($recent_cust=mysqli_fetch_object($Recent_customer))
											{
											?>
							
							
								<tr>
												<td><?php echo $cid; ?></td>
												<td><?php echo $recent_cust->Customer_Name; ?></td>
													<td><?php echo $recent_cust->Customer_Phone_No; ?></td>
												<td><?php  
												
													$main_cate_date = strtotime($recent_cust->Customer_Registred_on);
			  echo  date('d-m-Y',$main_cate_date).'<br>';
			  echo  date('h:m a',$main_cate_date);
												
												
												
												
												?></td>
												<td><?php echo $recent_cust->Customer_Wallet; ?></td>
												<td><?php 

													$enablestatus=$recent_cust->Customer_Active_Status;
													
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
													
														<!-- <td><?php 
														
														
													$order_count = $recent_cust->Customer_Id;
														
												$ot=mysqli_query($config,"select distinct count(order_customer_track_id) from order_checkout where Customer_id='$order_count' ");		
													$o_cust=mysqli_fetch_array($ot);	
														
														echo $o_cust[0];
														
														
														
														
														
														?></td> -->
													
													
													
													
											</tr>
										 	<?php  $cid++;} ?>
										</tbody>
									</table>
							 
							 
								</div>
							</d
								


										

								
									 
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php include('footer.php')?>
		</div>
		
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


	<!-- Chart JS -->
	<script src="../assets/js/plugin/chart.js/chart.min.js"></script>

	<!-- jQuery Sparkline -->
	<script src="../assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

	<!-- Chart Circle -->
	<script src="../assets/js/plugin/chart-circle/circles.min.js"></script>

	<!-- Datatables -->
	<script src="../assets/js/plugin/datatables/datatables.min.js"></script>

	<!-- Bootstrap Notify -->
	<script src="../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

	<!-- jQuery Vector Maps -->
	<script src="../assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
	<script src="../assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

	<!-- Sweet Alert -->
	<script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>

	<!-- Atlantis JS -->
	<script src="../assets/js/atlantis.min.js"></script>

	
	 
</body>
</html>