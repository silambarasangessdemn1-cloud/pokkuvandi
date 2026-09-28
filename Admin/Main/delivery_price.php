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
		
		
		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Delivery Price</h4>
						 
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								
								<div class="card-body">
								<center> <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fas fa-plus"></i>   Add New Delivery Price
</button></center>
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>S.No</th>
													<th> Location Name</th>
													<th> Delivery Price</th>
												 
													 <th>Status</th>
													<th>Action</th>
												</tr>
											</thead>
											 
											<tbody>
											<?php 
											$mc=1;
											$main_deli=mysqli_query($config,"select * from delivery_price_master");
											while($macate=mysqli_fetch_object($main_deli))
											{
											?>
												
												
												<tr>
													<td><?php echo $mc;?></td>
													<td><?php    
			
 
			
			$view_del_name_=mysqli_query($config,"select * from city_master where CIty_Status=1 and City_id='".$macate->delivery_location."'");
											while($view_del=mysqli_fetch_object($view_del_name_))
											{
			
			
		 echo $view_del->City_Name;
			
			
			
			
											}
			
			
			?> </td>
													<td><?php echo $macate->devlivery_price;?></td>
												  
													<td><?php 

													$enablestatus=$macate->Delivery_status;
													
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
													<a href="" class="btn btn-primary" data-toggle="modal" data-target="#<?php echo $mc;?>"> <i class="fas fa-pencil-alt"></i>  </a>

 <a href="Function/delivery_price_delete.php?delprefid=<?php echo $macate->delivery_price_id;?>&redelpt=700" class="btn btn-danger" onclick="return confirm('Are you confirm to delete this Delivery Price?');"> <i class="fas fa-trash"></i>  </a>

 

</td>
 		<div class="modal fade" id="<?php echo $mc;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Location Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form action="Function/Edit_delivery_location.php" method="post">
        <div class="form-group">
			<label for="email2">Delivery Location</label>
			<input type="hidden" class="form-control" id="email2" name="Delivery_Location_id"  value="<?php echo $macate->delivery_price_id;?>">
			 
			
			
			
			<?php   $prid = $macate->delivery_location;?>												
<select class="form-control"  name="Delivery_Location_Name" >
			<?php
			
			$catesub=mysqli_query($config,"select * from city_master where CIty_Status=1");
			while($cateesub = mysqli_fetch_object($catesub))
												
											
											{
		
			
			?>
			
			
			<option value="<?php echo $cateesub->City_id; ?>" <?php if ($prid == $cateesub->City_id) { echo 'selected'; } ?> ><?php echo   $cateesub->City_Name;?></option>
			
			
			
			
			
											<?php } ?>
			
			</select>
			
			
			
			
			
			
			
			
			
			
			 
		</div>  
		<div class="form-group">
			<label for="email2">Delivery Price</label>
 			 
			<input type="number" class="form-control" id="email2" name="Delivery_price"   value="<?php echo $macate->devlivery_price;?>">
			 
		</div> 
		  <div class="form-group">
	<label for="exampleFormControlSelect1">Delivery Status</label>
												<select class="form-control" id="exampleFormControlSelect1" name="location_delivery_status">
												<?php 

													$enablestatus=$macate->Delivery_status;
													
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
									<button class="btn btn-success" type="submit" name="Delivery_edit">Submit</button>
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
	</div>
				</div>
			</div>
			
			<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Delivery Price</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="Function/add_delivery.php" method="post" enctype="multipart/form-data">
     
			<div class="form-group">
	<label for="email2"> Delivery Location</label>
<select class="form-control" name="Add_delivery_location">
			<?php
			
			$pro_name_=mysqli_query($config,"select * from city_master where CIty_Status=1");
											while($add_pro=mysqli_fetch_object($pro_name_))
											{
			
			
			?>
			
			<option value="<?php echo $add_pro->City_id;?>"><?php echo $add_pro->City_Name;?></option>
			
			
			
			
											<?php } ?>
			
			</select>
			</div> 
			 <div class="form-group">
			<label for="email2">Delivery Price</label>
 			 
			<input type="number" class="form-control" id="email2" name="Add_Delivery_price"   placeholder="Enter Delivery Price">
			 
		</div> 
			  
		 <div class="form-group">
		<label for="exampleFormControlSelect1">Delivery Price Status</label>
		<select class="form-control" id="exampleFormControlSelect1" name="Add_delivery_status">
		<option value="1">Active</option>
		<option value="0">In-Active</option>
		
		</select>
											</div>	
 		
		     <div class="form-group">
									<button class="btn btn-success" type="submit" name="add_new_deliveyr_location">Add New</button>
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
	<script >
		$(document).ready(function() {
			$('#basic-datatables').DataTable({
			});

		 
 
			 
		});
	</script>
</body>
</html>