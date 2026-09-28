
<?php include('../config/setup.php');?>
<?php
 if(isset($_POST['payout_edit']))
 { 
$editon=date('Y-m-d');
$update_main_cate=mysqli_query($config,"update payout_request set payout_status='".$_POST['productreq_status']."',Payout_on='$editon' where payout_request_id='".$_POST['Edit_rquest_id']."'");
 

 }

?>
<?php
 if(isset($_POST['sub_payout_att']))
 {
 
// $timezone = new DateTimeZone("Asia/Kolkata" );
// $date = new DateTime();
// $date->setTimezone($timezone );
// $today2=$date->format('s');	
$logoimage=$_FILES['payout_photo']['name'];
$logophoto="../../photos/payout/".$logoimage;
move_uploaded_file($_FILES["payout_photo"]["tmp_name"],$logophoto);
 
$update_service_photo=mysqli_query($config,"update payout_request set payout_attachment='$logophoto' where payout_request_id='".$_POST['payout_att']."'");
 

 }

?>


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
						<h4 class="page-title">Payout Request </h4>
						 
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
												
													<th>Customer Name</th>
													<th>Contact No</th>
													<th>Payout Through</th>
													<th>Request Amount </th>
													<th>Request On</th>
													<th>Transferred Attachment</th>
												 <th>  Status</th>
													<th>Action</th>
												</tr>
											</thead>
											 
											<tbody>
											<?php 
											$mc=1;
											$main_cate=mysqli_query($config,"select * from payout_request");
											while($macate=mysqli_fetch_object($main_cate))
											{
											?>
												
												
												<tr>
													<td><?php echo $mc;?></td>
													
													<td><?php echo $macate->payout_customer_name;?></td>
													<td><?php echo $macate->payout_customer_mobile;?></td>
													<td><?php echo $macate->payout_setting;?></td>
													<td>Rs. <?php echo $macate->payout_request_amount;?></td>
													<td><?php 
														$main_cate_date = strtotime($macate->payout_request_on);
			  echo  date('d-m-Y',$main_cate_date);
													
													
													?></td>
													<td><?php 
													$att=$macate->payout_attachment;
													
													if($att == Null)
													{ ?>
													<a href="" class="btn btn-primary" data-toggle="modal" data-target="#<?php echo $mc;?>"> <i class="fas fa-pencil-alt"></i>  </a>
														
												<?php	}else
												{
													
													?>
													
								<img src="<?php 
												 echo	$lgim=$macate->payout_attachment;
  
				 


													   ?>" style="
      width: 128px;
    height: 129px;
">					
													
													
													
												<?php } ?>	</td>
		 
													
													<td><?php 

													$enablestatus=$macate->payout_status;
													
													if($enablestatus== 1)
													{ ?>
												<label class="btn btn-success">Transferred </label>
<?php														
													}else if($enablestatus== -1){
														?>
														<label class="btn btn-danger">Rejected</label>
														<?php
													}else{
														?>
														<label class="btn btn-warning">Pending</label>
														<?php
													}
													
													
													?></td>
													<td>
<a href="" class="btn btn-primary" data-toggle="modal" data-target="#<?php echo $mc;?>"> <i class="fas fa-pencil-alt"></i>  </a>


 

</td>

<!-- Modal -->
<div class="modal fade" id="<?php echo $mc;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Payout Request</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form action="payout_request.php" method="post">
        <div class="form-group">
			<label for="email2">Customer Name</label>
			<input type="hidden" class="form-control" id="email2" name="Edit_rquest_id"  value="<?php echo $macate->payout_request_id;?>">
			<input type="text" class="form-control" id="email2" name="Editpayout_request_customer" placeholder="ProductTax" value="<?php echo $macate->payout_customer_name;?>">
			</div>
         <div class="form-group">
			<label for="email2">Contact No</label>
			 
			<input type="text" class="form-control" id="email2" name="Editpayout_request_customer" placeholder="ProductTax" value="<?php echo $macate->payout_customer_mobile;?>">
			</div>
          <div class="form-group">
			<label for="email2">Payout Setting</label>
			 
			<input type="text" class="form-control" id="email2" name="Editpayout_request_customer" placeholder="ProductTax" value="<?php echo $macate->payout_setting;?>">
			</div> 
		
<?php

if($macate->payout_setting == 'UPI')

{
?>


		<div class="form-group">
			<label for="email2"> UPI Payout Setting</label>
			 
			<input type="text" class="form-control" id="email2" name="Editpayout_request_customer" placeholder="UPI Payout Setting" value="<?php echo $macate->pauout_upi_setting;?>">
			</div>
        <div class="form-group">
			<label for="email2"> UPI Holder Name</label>
			 
			<input type="text" class="form-control" id="email2" name="Editpayout_request_customer" placeholder=" UPI Holder Name" value="<?php echo $macate->payout_upi_holder_name;?>">
			</div>
           <div class="form-group">
			<label for="email2"> UPI Id</label>
			 
			<input type="text" class="form-control" id="email2" name="Editpayout_request_customer" placeholder=" UPI Holder Name" value="<?php echo $macate->payout_upi_id;?>">
			</div>
        
<?php }else if($macate->payout_setting == 'Bank'){?>

	<div class="form-group">
			<label for="email2">Bank Name</label>
			 
			<input type="text" class="form-control" id="email2" name="Editpayout_request_customer" placeholder="Bank Name<" value="<?php echo $macate->payout_bank_name;?>">
			</div>
        <div class="form-group">
			<label for="email2">Bank Account Holder Name</label>
			 
			<input type="text" class="form-control" id="email2" name="Editpayout_request_customer" placeholder="Bank Account Holder Name" value="<?php echo $macate->payout_bank_holder_name;?>">
			</div>
           <div class="form-group">
			<label for="email2">Bank Account Number</label>
			 
			<input type="text" class="form-control" id="email2" name="Editpayout_request_customer" placeholder="Bank Account Number" value="<?php echo $macate->payout_bank_account_no;?>">
			</div>
   <div class="form-group">
			<label for="email2">Bank IFSC Code</label>
			 
			<input type="text" class="form-control" id="email2" name="Editpayout_request_customer" placeholder="Bank IFSC Code" value="<?php echo $macate->payout_bank_ifsc_code;?>">
			</div>






<?php } ?>




		<div class="form-group">
												<label for="exampleFormControlSelect1">Payout Status</label>
												<select class="form-control" id="exampleFormControlSelect1" name="productreq_status">
												<?php 

													$enablestatus=$macate->payout_status;
													
													if($enablestatus == 1)
													{ ?>
												
													<option value="1" selected>Transferred</option>
													<option value="0">Pending</option>
													<option value="-1">Rejected</option>
													<?php }else if($enablestatus == 0){?>

														<option value="1" >Transferred</option>
													<option value="0" selected>Pending</option>
													<option value="-1">Rejected</option>
													
													<?php }else if($enablestatus == -1){ ?>
													<option value="1" >Transferred</option>
													<option value="0" >Pending</option>
													<option value="-1" selected>Rejected</option>
													
													
													
													<?php }else{ ?>
													<option value="1" >Transferred</option>
													<option value="0" >Pending</option>
													<option value="-1">Rejected</option>
													
													<?php } ?>
												
												</select>
											</div>			
		
		     <div class="form-group">
									<button class="btn btn-success" type="submit" name="payout_edit">Submit</button>
 								</div>
			
			
			</form>
			
			
      </div>
 <div class="modal-body">
	  <form action="payout_request.php" method="post" enctype="multipart/form-data" >
	 <center>  <h4 class="modal-title" id="exampleModalLabel">Payout Image Attachment</h4></center> 
 
<input type="hidden" class="form-control" id="email2" name="payout_att"  value="<?php echo $macate->payout_request_id;?>">
 

	   <div class="form-group">
			
					

			<input type="file" class="form-control" id="email2" name="payout_photo" placeholder="Main CategoryName" >
			</div>
          		
		
		
		
		
		
		
		
		
		     <div class="form-group">
									<button class="btn btn-warning" type="submit" name="sub_payout_att">Submit</button>
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