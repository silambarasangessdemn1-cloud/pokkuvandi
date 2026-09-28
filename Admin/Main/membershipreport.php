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

		<?php include('sidebar.php');
        $f=$_GET["fromdate"];
        $f1=$_GET["fromdate"];
        $fromdate=date('Y-m-d H:i:s', strtotime($f));
        $fromdate1=date('Y-m-d', strtotime($f1));
        
        $tdate=$_GET['todate'];
        $tdate1=$_GET['todate'];
        $todate=date('Y-m-d H:i:s', strtotime($tdate));
        $todate1=date('Y-m-d', strtotime($tdate1));
        ?>

		

		

		<div class="main-panel">

			<div class="content">

				<div class="page-inner">

					<div class="page-header">

						<h4 class="page-title">Membership Master Report</h4>

						 

					</div>
                    <form action="#" method="GET">
  <div class="form-row">
    <div class="col-4">
    <label for="inputState">From Date</label>
      <input type="date" name="fromdate" value="<?php  echo  $f1 ?>" class="form-control" >
    </div>
    <div class="col-4">
    <label for="inputState">To Date</label>

      <input type="date" name="todate" value="<?php echo  $tdate1 ?>" class="form-control" placeholder="Last name">
    </div>
    <div class="col-4">
    <button style='margin-top: 19px;' type="submit" class="btn btn-primary">Submit</button>  
    <a href='export.php?fromdate=<?php echo $f1 ?>&todate=<?php echo $todate1?>'style='margin-top: 19px;' type="submit" class="btn btn-success">Export</a>    </div>

  </div>
</form>

					<div class="row">

						<div class="col-md-12">

							<div class="card">

								

								<div class="card-body">

							 

									<div class="table-responsive">

										<table id="basic-datatables" class="display table table-striped table-hover" >

											<thead>

												<tr>

													<th>S.No</th>

													<th> Member Name</th>

													<th> Phone Number</th>

													

													 <th> Wallet Amount</th>

													 	 <th>Ref Member </th>

														  <th>referral Code</th>

														  <th>Pay id</th>

													 <th>Join Date</th>

													 <th>expiry date</th>

													 <th> Status</th>

													<th>Action</th>

												</tr>

											</thead>

											 

											<tbody>

											<?php 

											$mc=1;

											// $main_cate=mysqli_query($config,"select * from customer_master ");

											// $macate=mysqli_fetch_object($main_cate);
                                            $sql="SELECT * FROM `membership_list` WHERE (created_at BETWEEN '$fromdate' AND '$todate') order by memeber_id desc";

											$main_cate=mysqli_query($config,$sql);

											while($macate1=mysqli_fetch_object($main_cate))

											{

												$mid=$macate1->user_id;

												$main_cate1=mysqli_query($config,"select * from customer_master where Customer_Id='$mid' ");

											    $macate=mysqli_fetch_object($main_cate1);

											?>

												

												

												<tr>

													<td><?php echo $mc;?></td>

													<td><?php echo $macate->Customer_Name;?></td>

													<td><?php echo $macate->Customer_Phone_No;?></td>

													 <td>Rs. <?php echo $macate->Customer_Wallet;?></td>

													 <td> <?php  $rid=$macate1->member_referraid;

													 	$main_cate2=mysqli_query($config,"select * from customer_master where Customer_Id='$rid' ");

														 $macate2=mysqli_fetch_object($main_cate2);

														 echo $relname= $macate2->Customer_Name;

													 ?></td>

													

			                                      <td> <?php echo $macate1->unique_id;?></td>

												  <td><?php echo $macate1->pay_id;?></td>

													<td><?php $edon= $macate1->created_at;

													

													$main_cate_date = strtotime($edon);

			  echo $jdate= date('d-m-Y',$main_cate_date);

													

													?>



													

													

													

													

													

													</td>

													<td><?php $exdon= $macate1->ex_date;

													

													$main_cate_date1 = strtotime($exdon);

			  echo $edate= date('d-m-Y',$main_cate_date1);

													

													?></td>

													<td><?php 



													$enablestatus=$macate1->status;

													

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

<!-- <a href="Function/customer_delete.php?delcuteid=<?php echo $macate->Customer_Id;?>&delcat=100" class="btn btn-danger" onclick="return confirm('Are you confirm to delete this Customer?');"> <i class="fas fa-trash"></i>  </a> -->



 



</td>



<!-- Modal -->

<div class="modal fade" id="<?php echo $mc;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel">Member Edit</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <div class="modal-body">

	  <form action="memerstatus.php" method="post">

        <div class="form-group">

			<label for="email2">Member Name</label>

			<input type="hidden" class="form-control" id="email2" name="id"  value="<?php echo $macate1->memeber_id;?>">

			<input type="text" class="form-control" id="email2" name="main_cate_name" readonly placeholder="Main CategoryName" value="<?php echo $macate->Customer_Name;?>">

			</div>

              <div class="form-group">

			<label for="email2">Member Phone No</label>

 			<input type="text" class="form-control" id="email2" name="main_cate_name" readonly placeholder="Customer Phone No" value="<?php echo $macate->Customer_Phone_No;?>">

			</div>

           <div class="form-group">

			<label for="email2">Member wallet</label>

 			<input type="text" class="form-control" id="email2" name="main_cate_name" readonly placeholder="Customer Location" value="<?php echo $macate->Customer_Wallet;?>">

			</div>

             <div class="form-group">

			<label for="email2">Ref Member </label>

 			<input type="text" class="form-control" id="email2" name="main_cate_name" readonly placeholder="Customer Location" value="<?php echo $relname?>">

			</div>

			<div class="form-group">

			<label for="email2">Referral code </label>

 			<input type="text" class="form-control" id="email2" name="main_cate_name" readonly placeholder="Customer Location" value="<?php echo $macate1->unique_id;?>">

			</div>

			<div class="form-group">

			<label for="email2">Join Date </label>

 			<input type="text" class="form-control" id="email2" name="main_cate_name" readonly placeholder="Customer Location" value="<?php echo  $jdate?>">

			</div>

			<div class="form-group">

			<label for="email2">Expiry date </label>

 			<input type="text" class="form-control" id="email2" name="main_cate_name" readonly placeholder="Customer Location" value="<?php echo  $edate?>">

			</div>

			<div class="form-group">

				<?php  $date_now = new DateTime();

			 $date2    = new DateTime($macate1->ex_date);

			 if ($date_now > $date2) {

				echo '<h2 style="color:red;">Membership Expired </h2>';

			}else{?>

			<label for="email2">Expiry Days </label>

			<h1><?php

$date1=date_create($jdate);

$date2=date_create($edate);

$diff=date_diff($date1,$date2);

echo $diff->format("%R%a days");

?></h1><?php }?>

			</div>  

		  <div class="form-group">

												<label for="exampleFormControlSelect1">Member Active Status</label>

												<select class="form-control" id="exampleFormControlSelect1" name="status">

												<?php 



													$enablestatus=$macate1->status;

													

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

									<button class="btn btn-success" type="submit" name="customer_edit">Submit</button>

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

        <h5 class="modal-title" id="exampleModalLabel">Add Main Category</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <div class="modal-body">

        <form action="Function/Add_Main_Category.php" method="post" enctype="multipart/form-data">

        <div class="form-group">

			<label for="email2">Main CategoryName</label>

			<input type="text" class="form-control" id="email2" name="Add_main_cate_name" placeholder="Main CategoryName"  >

			</div>  

			<div class="form-group">

			<label for="email2">Main Category Image</label>

			<input type="file" class="form-control" id="email2" name="Add_main_cate_image" placeholder="Main CategoryName"  >

			</div>

       

		 <div class="form-group">

		<label for="exampleFormControlSelect1">Category Active Status</label>

		<select class="form-control" id="exampleFormControlSelect1" name="Add_main_category_status">

		<option value="1">Active</option>

		<option value="0">In-Active</option>

		

		</select>

											</div>			

		

		     <div class="form-group">

									<button class="btn btn-success" type="submit" name="category_add">Add New</button>

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