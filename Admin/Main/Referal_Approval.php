<?php include('../config/setup.php');?>

<?php
  if(isset($_POST['wallet_edit']))
 {
$refundon=date('Y-m-d');

$wallet_up=mysqli_query($config,"update wallet_master set Wallet_Active_Status='".$_POST['Add_wallet_referal']."' where walle_id='".$_POST['Add_wall_customer']."'");
										
 
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
						<h4 class="page-title">Referal  Approval</h4>
						 
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
													<th> Customer Name</th>
													<th>Referal Code</th>
													<th> Used Customer</th>
													<th> Add on</th>
													<th> Refered customer Earn</th>
													<th> Status</th>
												 
													<th>Action</th>
												</tr>
											</thead>
											 
											<tbody>
											<?php 
											$mc=1;
					$main_loc=mysqli_query($config,"select * from wallet_master where Wallet_Active_Status=1");
											while($macate=mysqli_fetch_object($main_loc))
											{
											?>
												
												
												<tr>
													<td><?php echo $mc;?></td>
													<td><?php  
													
												$Main_id=$macate->wallet_Customer_id;
												
												$subsmain_cate=mysqli_query($config,"select Customer_Name from customer_master where Customer_Id='$Main_id'");
											 $subcatee=mysqli_fetch_object($subsmain_cate);
												
												
												echo  $subcatee->Customer_Name;
												
											 
													
													
													?></td>
													<td><?php echo $macate->Wallet_amount;?></td>
													<td><?php echo $macate->Wallet_status;?></td>
													<td><?php echo $macate->Wallet_Add_on;?></td>
													<td><?php  
													
													$referalto=mysqli_query($config,"select Customer_Name,Customer_Phone_No from customer_master where Customer_Id='".$macate->Referal_customer_id."'");
											$r=mysqli_num_rows($referalto);
if($r > 0)
{
											$rto=mysqli_fetch_object($referalto);
											 
											 
												
												
												echo  $rto->Customer_Name;
													echo "(" .$rto->Customer_Phone_No. ")";
												
}else{
	
	echo "-";
}				
													
													
													?></td>
												  
													<td><?php 

													$enablestatus=$macate->Wallet_Active_Status;
													
													if($enablestatus== 1)
													{ ?>
												<label class="btn btn-danger">In-Active</label>
<?php														
													}
														?>
														</td>
												  
													 
													<td>
													<a href="" class="btn btn-primary" data-toggle="modal" data-target="#<?php echo $mc;?>"> <i class="fas fa-pencil-alt"></i>  </a>

 
 

</td>
 		<div class="modal fade" id="<?php echo $mc;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Referal Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form action="Referal_Approval.php" method="post">
        
<div class="form-group">
			<label for="email2">Refered Customer</label>
			<input type="hidden" class="form-control" id="email2" name="Add_wall_customer"  value="<?php echo $macate->walle_id;?>"  >
			<input type="number" class="form-control" id="email2" name="Add_refered_customer"  value="<?php echo $macate->wallet_Customer_id;?>"  >
			</div> <div class="form-group">
			<label for="email2">Refered Customer Earning </label>
			<input type="number" class="form-control" id="email2" name="Add_refered_customer_earning"  value="<?php echo $macate->Wallet_amount;?>"  >
			</div>  <div class="form-group">
			<label for="email2">Refered  Order </label>
			<input type="text" class="form-control" id="email2" name="Add_refered_code"  value="<?php echo $macate->wallet_order;?>"  >
			</div> 

  <div class="form-group">
			<label for="email2">Referal Code used_customer</label>
			<input type="number" class="form-control" id="email2" name="Add_used_customer_earning"  value="<?php echo $macate->Referal_customer_id;?>"  >
			</div> 

	

  <div class="form-group">
	<label for="exampleFormControlSelect1">Wallet Status</label>
							<select class="form-control" id="exampleFormControlSelect1" name="Add_wallet_referal">
												<?php 

													$enablestatus=$macate->Wallet_Active_Status;
													
													if($enablestatus == 1)
													{ ?>
												
													<option value="0" selected>Active</option>
													<option value="1">In-Active</option>
													<?php }else if($enablestatus == 0){?>

														<option value="0" >Active</option>
													<option value="1" selected>In-Active</option>
													<?php }else{ ?>
													<option value="0" >Active</option>
													<option value="1" >In-Active</option>
													
													
													<?php } ?>
												
												</select>
											</div>






											
		
		     <div class="form-group">
									<button class="btn btn-success" type="submit" name="wallet_edit">Submit</button>
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