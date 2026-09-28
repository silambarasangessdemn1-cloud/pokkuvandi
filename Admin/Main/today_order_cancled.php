<?php include('../config/setup.php');?>
<?php
 if(isset($_POST['order_edit']))
 { 
$editon=date('Y-m-d');

if($_POST['order_delivery_status']== 'Refunded' && $_POST['order_paid_status'] =='1')
{
	$refundon=date('Y-m-d');
	$refund=mysqli_query($config,"insert into wallet_master(wallet_Customer_id,Wallet_amount,Wallet_status,Wallet_Active_Status,Wallet_Add_on,wallet_order,Unic_wallet) values('".$_POST['order_customer_id']."','".$_POST['Refund_amount']."','Cancel Order Refund',1,'$refundon','".$_POST['order_track_id']."','".$_POST['order_customer_id'].$_POST['Refund_amount'].'Cancel Order Refund'.$_POST['order_track_id']."') ");
$update_offer=mysqli_query($config,"update order_master set Delivery_status='".$_POST['order_delivery_status']."',Paid_status='".$_POST['order_paid_status']."',Order_delivery_date='$refundon' where order_customer_track_id='".$_POST['order_track_id']."'");
 if($refund==false)
{
echo "<script>alert('Amount Already Refunded')</script>";	 
}else{
	
$referal_add = mysqli_query($config,"select * from customer_master where Customer_Id='".$_POST['order_customer_id']."'");

$rfadd = mysqli_fetch_object($referal_add);

  $already=$rfadd->Customer_Wallet;	
	 $wallet_update = mysqli_query($config,"update customer_master set Customer_Wallet='". $_POST['Refund_amount']."' + '". $already ."' where Customer_Id='".$_POST['order_customer_id']."'  ");
	
	
	
	
	
}


}else{
$update_offer=mysqli_query($config,"update order_master set Delivery_status='".$_POST['order_delivery_status']."',Paid_status='".$_POST['order_paid_status']."',Order_delivery_date='$refundon' where order_customer_track_id='".$_POST['order_track_id']."'");
 if($update_offer==false)
{
echo  mysqli_error();	 
}
}

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
						<h4 class="page-title">Order Master - ( Today  Orders Canceled )</h4>
						 
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
													<th> Order id</th>
													<th> Customer Name</th>
													<th> Order On</th>
													<th> Delivery  Location</th>
													<th> Payment Method</th>
													<th>  Paid Status</th>
													<th> Paid Amount</th>
													<th> Delivery Status</th>
													 
													<th>Action</th>
												</tr>
											</thead>
											 
											<tbody>
											<?php 
											$mc=1;
											$tday=date('Y-m-d');
											$main_loc=mysqli_query($config,"select * from order_checkout where Order_on='$tday' and Order_status='Canceled_by_Customer' or  Delivery_status = 'Canceled'    order by Order_on DESC ");
											while($macate=mysqli_fetch_object($main_loc))
											{
											?>
												
												
												<tr>
													<td><?php echo $mc;?></td>
													
													
													<td>#<?php echo $macate->order_customer_track_id;?></td>
													<td><?php  $cuname=$macate->Customer_id;
													
														 
$cust_name=mysqli_query($config,"select * from customer_master where Customer_Id ='$cuname' ");
            $custom_final=mysqli_fetch_object($cust_name);
   		 
										echo	$custom_final->Customer_Name;		
													
													?></td><td><?php 
														$main_cate_date = strtotime($macate->Order_on);
			  echo  date('d-m-Y',$main_cate_date);
												?></td>	
													<td><?php  $cust_add= $macate->Customer__address_type;
													
													$check_oaaderr=mysqli_query($config,"select * from customer_addresss_master where Address_id='".$cust_add."' and  Customet_id ='".$macate->Customer_id."' ");
            $check_add=mysqli_fetch_object($check_oaaderr);
   		 
													
									echo  $check_add->Delivery_Area.",".$check_add->Complete_Address;
													
													
													?></td>
													<td><?php echo $macate->Payment_Mode;?>
													<?php 
													 $vb="SELECT * FROM `order_master` where order_customer_track_id='$macate->order_customer_track_id'";
													$mainloc=mysqli_query($config,$vb);
												$macate_=mysqli_fetch_object($mainloc);
													?>
													<button class="btn btn-success" role="alert">Advance Rs.<?php echo $macate_->advance_pay;?></button></td>	
													
													<td><?php $enablestatus= $macate->Paid_status;
													
													if($enablestatus== 1)
													{ ?>
												<label class="btn btn-success">Paid</label>
<?php														
													}else{
														?>
														<label class="btn btn-danger">Un-Paid</label>
														<?php
													}
													
													
													
													
													
													?></td>
												



												<td><?php echo $macate->Grand_total;?></td>
													





													<td><?php 

													$enablestatus=$macate->Delivery_status;
													
													if($enablestatus== 'On_Progress')
													{ ?>
												<label class="btn btn-warning">On Progress</label>
												 
<?php														
													}else if($enablestatus== 'Ready_To_Collect'){
														?>
														
														
														<label class="btn btn-default">Ready To Collect</label>
														
														
														<?php														
													}else if($enablestatus== 'On_the_way'){
														?>
														
														
														<label class="btn btn-primary">On the Way</label>
														
															
														<?php														
													}else if($enablestatus== 'Completed'){
														?>
														
														
														<label class="btn btn-success">Delivered</label>
														
														
														
																
														<?php														
													}else if($enablestatus== 'Canceled'){
														?>
														
														
														<label class="btn btn-danger">Canceled</label>
														
														<?php														
													}else if($enablestatus== 'Refunded'){
														?>
														
														
														<label class="btn btn-danger">Refunded</label>
														
														
														
														
														
														
														<?php
													}
													
													
													?></td>
													<td>
													<a href="" class="btn btn-primary" data-toggle="modal" data-target="#<?php echo $mc;?>"> <i class="fas fa-pencil-alt"></i>  </a>

 	<a href="invoice/invoice.php?orderid=<?php echo $macate->order_customer_track_id;?>" class="btn btn-primary" target="_blank"> View Invoice</a>
 

</td>
 		<div class="modal fade" id="<?php echo $mc;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Order Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form action="today_order_cancled.php" method="post">
       <div class="form-group">
			<label for="email2">Order Track Id</label>
			<input type="hidden" class="form-control" id="email2" name="order_track_id"  value="<?php echo $macate->order_customer_track_id;?>">
			<input type="hidden" class="form-control" id="email2" name="order_customer_id"  value="<?php echo $macate->Customer_id;?>">
  			 
			<input type="text" class="form-control" id="email2" name="Location_Name" readonly value="<?php echo $macate->order_customer_track_id;?>">
			 
		</div>  
		<div class="form-group">
			<label for="email2">Advance pay (Rs.)</label>
  			<input readonly type="number" class="form-control" id="email2" name=""  value="<?php echo $macate_->advance_pay;?>">
 			 
 			 
		</div> 
		<div class="form-group">
			<label for="email2">Order  Amount (Rs.)</label>
  			<input type="number" class="form-control" id="email2" name="Refund_amount"  value="<?php echo $macate->Grand_total;?>">
 			 
 			 
		</div> 
				 
				  <div class="form-group">
												<label for="exampleFormControlSelect1">Paid Status</label>
												<select class="form-control" id="exampleFormControlSelect1" name="order_paid_status">
												<?php 

													$enablestatus=$macate->Paid_status;
													
													if($enablestatus == 1)
													{ ?>
												
													<option value="1" selected>Paid</option>
													<option value="0">Un-Paid</option>
													<?php }else if($enablestatus == 0){?>

														<option value="1" >Paid</option>
													<option value="0" selected>Un-Paid</option>
													<?php }else{ ?>
													<option value="1" >Paid</option>
													<option value="0" >Un-Paid</option>
													
													
													<?php } ?>
												
												</select>
											</div>	
		
		
		
		
		  <div class="form-group">
	<label for="exampleFormControlSelect1">Update Order Status</label>
												<select class="form-control" id="exampleFormControlSelect1" name="order_delivery_status">
												<?php 

													$enablestatus=$macate->Delivery_status;
													
													if($enablestatus == "On_Progress")
													{ ?>
												
													<option value="On_Progress" selected>On Progress</option>
													<option value="Ready_To_Collect">Ready To Collect</option>
													<option value="On_the_way">On The way</option>
													<option value="Completed">Delivered</option>
													<option value="Canceled">Canceled</option>
												 
													<option value="Refunded">Refunded</option>
													
													
													<?php }else if($enablestatus =="Ready_To_Collect"){?>

															<option value="On_Progress" >On Progress</option>
													<option value="Ready_To_Collect" selected>Ready To Collect</option>
													<option value="On_the_way">On The way</option>
												<option value="Completed">Delivered</option>
													<option value="Canceled">Canceled</option>
											<option value="Refunded">Refunded</option>
												<?php }else if($enablestatus =="On_the_way"){?>

															<option value="On_Progress" >On Progress</option>
													<option value="Ready_To_Collect" >Ready To Collect</option>
													<option value="On_the_way" selected>On The way</option>
												 <option value="Completed">Delivered</option>
													<option value="Canceled">Canceled</option>
												<option value="Refunded">Refunded</option>
													 
												<?php }else if($enablestatus =="Completed"){?>

															<option value="On_Progress" >On Progress</option>
													<option value="Ready_To_Collect" >Ready To Collect</option>
													<option value="On_the_way" >On The way</option>
												 <option value="Completed" selected>Delivered</option>
													<option value="Canceled">Canceled</option>
												<option value="Refunded">Refunded</option>
													
														<?php }else if($enablestatus =="Canceled"){?>

															<option value="On_Progress" >On Progress</option>
													<option value="Ready_To_Collect" >Ready To Collect</option>
													<option value="On_the_way" >On The way</option>
												 <option value="Completed" >Delivered</option>
													<option value="Canceled" selected>Canceled</option>
													<option value="Refunded">Refunded</option>
												 <?php }else if($enablestatus =="Refunded"){?>

															<option value="On_Progress" >On Progress</option>
													<option value="Ready_To_Collect" >Ready To Collect</option>
													<option value="On_the_way" >On The way</option>
												 <option value="Completed" >Delivered</option>
													<option value="Canceled" >Canceled</option>
												 <option value="Refunded" selected>Refunded</option>
													<?php }else{ ?>
													<option value="On_Progress" >On Progress</option>
													<option value="Ready_To_Collect" >Ready To Collect</option>
													<option value="On_the_way" >On The way</option>
												 <option value="Completed">Delivered</option>
													<option value="Canceled">Canceled</option>	
													<option value="Refunded">Refunded</option>
												 
													
													
													<?php } ?>
												
												</select>
											</div>			
		
		     <div class="form-group">
									<button class="btn btn-success" type="submit" name="order_edit">Submit</button>
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