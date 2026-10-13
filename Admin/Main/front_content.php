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
	<style>
		.nicEdit-main, .nicEdit-main * {
			color: #111111 !important;
		}
	</style>
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
						<h4 class="page-title"> Popup Message</h4>
						 
					</div>
					<div class="row">
						<div class="container">
							<?php if(isset($_GET['mes'])) { ?>
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								<strong>Success!</strong> Popup message updated successfully.
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<?php } ?>
							<?php if(isset($_GET['erro'])) { ?>
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<strong>Error!</strong> <?php echo isset($_GET['msg']) ? htmlspecialchars($_GET['msg']) : 'An error occurred while saving.'; ?>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<?php } ?>

							<div class="row">
								<div class="col-md-12">
						<?php 
											 
											$lee_tc=mysqli_query($config,"select * from cms");
											while($leets=mysqli_fetch_object($lee_tc))
											{
											?>
								
						  <!-- Popup Message (All Users / Customers) -->
						  <form action="Function/edit_front_content.php" method="post" style="width: 100%; margin-bottom: 25px;">		
							 <div class="form-group" style="padding-left: 0; padding-right: 0;">
								 <label for="name_front" style="font-weight: 600;">Popup Message (All Users / Customers)</label>
								 <input type="hidden" class="form-control" name="Edit_front_id" value="<?php echo $leets->cms_id;?>">
								 <textarea name="name_front" id="name_front" style="width:100%; height: 150px; color: #333333;"><?php echo $leets->fron_contanct; ?></textarea><br>
							 </div>
							 <div class="form-group" style="padding-left: 0; padding-right: 0;">
								 <button class="btn btn-success" type="submit" name="Lee_customer_front_edit">Submit</button>
							 </div>
						  </form>

						  <hr style="margin: 30px 0; border-top: 1px dashed #dcdcdc;">

						  <!-- Driver Popup Message (Drivers Only) -->
						  <form action="Function/edit_front_content.php" method="post" style="width: 100%; margin-bottom: 25px;">		
							 <div class="form-group" style="padding-left: 0; padding-right: 0;">
								 <label for="name_driver_front" style="font-weight: 600; color: #1572e8;"><i class="fa fa-truck"></i> Driver Popup Message (Drivers Only / ஓட்டுநர்களுக்கு மட்டும்)</label>
								 <input type="hidden" class="form-control" name="Edit_front_id" value="<?php echo $leets->cms_id;?>">
								 <textarea name="name_driver_front" id="name_driver_front" style="width:100%; height: 150px; color: #333333;"><?php echo isset($leets->driver_contanct) ? $leets->driver_contanct : ''; ?></textarea><br>
							 </div>
							 <div class="form-group" style="padding-left: 0; padding-right: 0;">
								 <button class="btn btn-success" type="submit" name="Lee_driver_front_edit">Submit</button>
							 </div>
						  </form>
											<?php } ?>
								</div>
							</div>
						</div>
					</div>
			 
	</div>
				</div>
			</div>
 	
			
			
			
			
			
			
			
		<?php include('footer.php');?>	
		 
		</div>
		
		 
		<!-- End Custom template -->
	</div>
<script type="text/javascript" src="richtext.js"></script> 
  <script type="text/javascript">
 
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
  </script>
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
	</script>
</body>
</html>