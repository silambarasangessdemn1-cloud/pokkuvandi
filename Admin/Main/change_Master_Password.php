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
            
            ?>   </title>
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
						<h4 class="page-title">App Logo and Name </h4>
						 
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								
								<div class="card-body">
								 
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>S.No</th>
													<th>App Name</th>
													<th> Status</th>
													<th> App Logo</th>
													<th> Status</th>
												 
													 <th>Action</th>
												</tr>
											</thead>
											 
											<tbody>
											<?php 
											$lee=1;
											$lee_foodies=mysqli_query($config,"select * from lee_master");
											while($leefod=mysqli_fetch_object($lee_foodies))
											{
											?>
												
												
												<tr>
													<td><?php echo $lee;?></td>
													<td><?php echo $leefod->Name;?></td>
													<td> 
													<?php 

													$Name_enablestatus=$leefod->Name_status;
													
													if($Name_enablestatus== 1)
													{ ?>
												<label class="btn btn-success">Active</label>
<?php														
													}else{
														?>
														<label class="btn btn-danger">In-Active</label>
														<?php
													}
													
													
													?>
													
													
													
													</td>
													
													
													<td>
												 
													
													<img src="<?php 
													$lgim=$leefod->Logo_Path;
   $lm=substr($lgim,3);
				  echo  $lm;


													   ?>" style="
      width: 128px;
    height: 129px;
"></td>
													<td> 
													<?php 

													$logo_enablestatus=$leefod->logo_status;
													
													if($logo_enablestatus== 1)
													{ ?>
												<label class="btn btn-success">Active</label>
<?php														
													}else{
														?>
														<label class="btn btn-danger">In-Active</label>
														<?php
													}
													
													
													?>
													
													
													
													</td>
												 
													<td>
<a href="" class="btn btn-primary" data-toggle="modal" data-target="#<?php echo $lee;?>"> <i class="fas fa-pencil-alt"></i>  </a>
 
 

</td>

<!-- Modal -->
<div class="modal fade" id="<?php echo $lee;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Logo & Name Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form action="Function/name_logo_edit.php" method="post">
        <div class="form-group">
			<label for="email2">Name Change</label>
			<input type="hidden" class="form-control" id="email2" name="Edit_lee_id"  value="<?php echo $leefod->Site_id;?>">
			<input type="text" class="form-control" id="email2" name="Edit_lee_name" placeholder="Name of Application" value="<?php echo $leefod->Name;?>">
			</div>
          <div class="form-group">
												<label for="exampleFormControlSelect1">App Name Status</label>
												<select class="form-control" id="exampleFormControlSelect1" name="lee_name_status">
												<?php 

													$Edit_name_enablestatus=$leefod->Name_status;
													
													if($Edit_name_enablestatus == 1)
													{ ?>
												
													<option value="1" selected>Active</option>
													<option value="0">In-Active</option>
													<?php }else if($Edit_name_enablestatus == 0){?>

														<option value="1" >Active</option>
													<option value="0" selected>In-Active</option>
													<?php }else{ ?>
													<option value="1" >Active</option>
													<option value="0" >In-Active</option>
													
													
													<?php } ?>
												
												</select>
											</div>	
		
		     <div class="form-group">
									<button class="btn btn-success" type="submit" name="Lee_name_edit">Submit</button>
 								</div>
			
			
			</form>
			
			
      </div>
	 
	  <div class="modal-body">
	  <form action="Function/name_logo_edit.php" method="post" enctype="multipart/form-data" >
	 <center>  <h4 class="modal-title" id="exampleModalLabel">Logo Change</h4></center> 
       
<div class="form-group">
<label for="email2">Current Image</label>
<img src="<?php 													$cate=$leefod->Logo_Path;
   $ms=substr($cate,3);
				  echo  $ms;
?>" style="
    width: 128px;
    height: 129px;
">
</div>

    <div class="form-group">
												<label for="exampleFormControlSelect1">App Logo Status</label>
												<select class="form-control" id="exampleFormControlSelect1" name="lee_logo_status">
												<?php 

													$Edit_logo_enablestatus=$leefod->Logo_Path;
													
													if($Edit_logo_enablestatus == 1)
													{ ?>
												
													<option value="1" selected>Active</option>
													<option value="0">In-Active</option>
													<?php }else if($Edit_logo_enablestatus == 0){?>

														<option value="1" >Active</option>
													<option value="0" selected>In-Active</option>
													<?php }else{ ?>
													<option value="1" >Active</option>
													<option value="0" >In-Active</option>
													
													
													<?php } ?>
												
												</select>
											</div>	


	   <div class="form-group">
			<label for="email2">Change  Image here</label>
						<input type="hidden" class="form-control" id="email2" name="lee_logo_id"  value="<?php echo $leefod->Site_id;?>">

			<input type="file" class="form-control" id="email2" name="Lee_logo" placeholder="Main CategoryName" >
			</div>
          		
		
		
		
		
		
		
		
		
		     <div class="form-group">
									<button class="btn btn-warning" type="submit" name="logo_image_change">Submit</button>
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
												
											<?php $lee++;} ?>
												
											</tbody>
										</table>
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