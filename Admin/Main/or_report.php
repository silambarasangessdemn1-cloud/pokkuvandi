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


}else if($_POST['order_paid_status'] =='1'){
$update_offer=mysqli_query($config,"update order_master set Delivery_status='".$_POST['order_delivery_status']."',Paid_status='".$_POST['order_paid_status']."' where order_customer_track_id='".$_POST['order_track_id']."'");

  $order_sel=mysqli_query($config," select * from order_master where order_customer_track_id='".$_POST['order_track_id']."'");
$os=mysqli_fetch_object($order_sel);
 $rf=$os->Referral_code;

	if($rf != '' )
	{
	$ref_sel=mysqli_query($config," select * from referal_master where Referal_Code='".$os->Referral_code."'");
		$rs=mysqli_fetch_object($ref_sel);
		$refundon=date('Y-m-d');
	$refund=mysqli_query($config,"insert into wallet_master(wallet_Customer_id,Wallet_amount,Wallet_status,Wallet_Active_Status,Wallet_Add_on,Unic_wallet,Referal_customer_id,wallet_order) values('".$os->Refered_customer_id."','".$rs->Referal_Price_Percentage."','Referal Earning','0','$refundon','".$_POST['order_customer_id'].$rs->Referal_Price_Percentage.'Referal Earning'.$rs->Referal_Code."','".$_POST['order_customer_id']."','".$_POST['order_track_id']."') ");
	
	 if($refund)
 {
	 
	 $referal_add = mysqli_query($config,"select * from customer_master where Customer_Id='".$os->Refered_customer_id."'");

$rfadd = mysqli_fetch_object($referal_add);

  $already=$rfadd->Customer_Wallet;
	 
	 
	 $wallet_update = mysqli_query($config,"update customer_master set Customer_Wallet='".$rs->Referal_Price_Percentage."' + '". $already ."' where Customer_Id='".$os->Refered_customer_id."'  ");

	 
 }else{
	 
	 echo  mysqli_error($refund);	
 }
	
	
	
	
	}else{
		echo "<script>alert('Data Not found')</script>";
	}	
 
 




 if($update_offer==false)
{
echo  mysqli_error();	 
}







}else{
	
	
	
	$update_offer=mysqli_query($config,"update order_master set Delivery_status='".$_POST['order_delivery_status']."',Paid_status='".$_POST['order_paid_status']."' where order_customer_track_id='".$_POST['order_track_id']."'");
	
	
	
	
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
		
		
		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Order Report</h4>
                        <?php 
 $fromdate=date('Y-m-d H:i:s', strtotime($_GET['form']));
 $enddate=date('Y-m-d H:i:s', strtotime($_GET['end']));
?>				 
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">

                                <form>
  <div class="row">
    <div class="col-4">
    <label for="exampleInputEmail1" class="form-label">Form Date</label>
      <input type="date" class="form-control" name="form" value="<?php echo $_GET['form'] ?>" placeholder="First name">
    </div>
    <div class="col-4">
    <label for="exampleInputEmail1" class="form-label">End Date</label>
      <input type="date" class="form-control" name="end" value="<?php echo $_GET['end'] ?>" placeholder="Last name">
    </div>
   
    <div class="col-4">
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href='order_export.php?formdate=<?php echo  $fromdate?>&enddate=<?php echo  $enddate?>&vid=<?php echo $_GET['vid'] ?>' class="btn btn-success">Export</a>
    </div>
  </div>
</form>
                                </div>
								<div class="card-body">
								 	<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>S.No</th>
													<th> Order id</th>
													<th> Customer Name</th>
													<th> Order on</th>
													<th> Delivery  Location</th>
													<th> Payment Method</th>
													<th>  Paid Status</th>
													<th> Paid Amount</th>
													<th> Delivery Status</th>
													 
													
												</tr>
											</thead>
											 
											<tbody>
											<?php 
											$mc=1;
                                           

											
                                            if($_GET['form']){
											    $bb="select * from order_checkout 
where (	Order_on BETWEEN '$fromdate' AND '$enddate') and Order_status='Completed' order by Order_on DESC";

											}else{
                                                $bb="select * from order_checkout where Order_status='Completed' order by Order_on DESC";
                                            }
											$tday=date('Y-m-d');
											$main_loc=mysqli_query($config,$bb);
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
													
													$main_cate_date = strtotime( $macate->Order_on);
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
													<button class="btn btn-success" role="alert">Advance Rs.<?php echo $macate_->advance_pay;?></button>
												</td>	
													
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