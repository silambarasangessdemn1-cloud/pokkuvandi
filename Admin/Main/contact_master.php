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
						<h4 class="page-title">App Contact & Address Master </h4>
						 
					</div>
					<div class="row">
						<div class="col-md-12 table-responsive">
							<div class="card">
								
								<div class="card-body table-responsive">
								 
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>S.No</th>
													<!-- <th>Location</th> -->
													<th> Address</th>
													<th>Customer Care No</th>
													<th>Complaint No</th>
													<th>E-mail ID</th>
													<!-- <th>GST No</th> -->
													
													
												 
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
																	<!-- <td><?php echo $leefod->Location;?></td> -->
													<td><?php echo $leefod->Address;?></td>
													<td><?php echo $leefod->Contact_Number;?></td>
													<td><?php echo $leefod->Tel_No;?></td>
													<td><?php echo $leefod->Email_id;?></td>
													<!-- <td><?php echo $leefod->GST_No;?></td> -->
														
													
													
				 										 
												 
													<td>
<a href="" class="btn btn-primary" data-toggle="modal" data-target="#<?php echo $lee;?>"> <i class="fas fa-pencil-alt"></i>  </a>
 
 

</td>

<!-- Modal -->
<div class="modal fade" id="<?php echo $lee;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Address & Contact Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form action="Function/contact_edit.php" method="post">
        <div class="form-group" style="display:none" >
			<label for="email2">Location</label>
			
			<input type="text" class="form-control" id="email2" name="Edit_lee_location" placeholder="Contact Location" value="<?php echo $leefod->Location;?>">
			</div><div class="form-group">
			<label for="email2">Address</label>
			<input type="hidden" class="form-control" id="email2" name="Edit_lee__contact_id"  value="<?php echo $leefod->Site_id;?>">
 			<input type="text" class="form-control" id="email2" name="Edit_lee_address" placeholder="Contact Address" value="<?php echo $leefod->Address;?>">
			</div><div class="form-group">
			<label for="email2">Mail Id</label>
 			<input type="mail" class="form-control" id="email2" name="Edit_lee_mail" placeholder="Contact Mail Id" value="<?php echo $leefod->Email_id;?>">
			</div>
         <div class="form-group">
			<label for="email2">Customer Care No</label>
 			<input type="text" class="form-control" id="email2"  name="Edit_lee_contact" placeholder="Contact Number" value="<?php echo $leefod->Contact_Number;?>">
			</div>  <div class="form-group">
			<label for="email2">Complaint No</label>
 			<input type="number" class="form-control" id="email2" onkeypress="if(this.value.length==10) return false;"  name="Edit_lee_tel_contact" placeholder="Contact Number" value="<?php echo $leefod->Tel_No;?>">
			</div> 
			<div class="form-group" style="display:none">
			<label for="email2">GST No</label>
 			<input type="text" class="form-control" maxlength="18" id="email2" name="Edit_lee_Gst" placeholder="GST Number" value="<?php echo $leefod->GST_No;?>">
			</div>
			<div class="form-group" style="display:none">
			<label for="email2">Website</label>
 			<input type="text" class="form-control" id="email2" name="Edit_lee_web" placeholder="GST Number" value="<?php echo $leefod->website;?>">
			</div>
			
			
			
          <div class="form-group" >
												<label for="exampleFormControlSelect1">App Contact Status</label>
												<select class="form-control" id="exampleFormControlSelect1" name="lee_contact_status">
												<?php 

													$Edit_contact_enablestatus=$leefod->Contact_Status;
													
													if($Edit_contact_enablestatus == 1)
													{ ?>
												
													<option value="1" selected>Active</option>
													<option value="0">In-Active</option>
													<?php }else if($Edit_contact_enablestatus == 0){?>

														<option value="1" >Active</option>
													<option value="0" selected>In-Active</option>
													<?php }else{ ?>
													<option value="1" >Active</option>
													<option value="0" >In-Active</option>
													
													
													<?php } ?>
												
												</select>
											</div>	
		
		     <div class="form-group">
									<button class="btn btn-success" type="submit" name="Lee_contact_edit">Submit</button>
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