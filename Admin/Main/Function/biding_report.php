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

						<h4 class="page-title">BIDING  REPORTS	</h4>

<?php 
 $fromdate=date('Y-m-d H:i:s', strtotime($_GET['form']));
 $enddate=date('Y-m-d H:i:s', strtotime($_GET['end']));
?>						 

					</div>

					<div class="row">

						<div class="col-md-12">

							<div class="card">
                            <form>
  <div class="row">
    <div class="col-3">
    <label for="exampleInputEmail1" class="form-label">Form Date</label>
      <input type="date" class="form-control" name="form" value="<?php echo $_GET['form'] ?>" placeholder="First name">
    </div>
    <div class="col-3">
    <label for="exampleInputEmail1" class="form-label">End Date</label>
      <input type="date" class="form-control" name="end" value="<?php echo $_GET['end'] ?>" placeholder="Last name">
    </div>
    <div class="col-3">
    <label for="exampleInputEmail1" class="form-label">Vender List</label>
    <select name="vid" class="form-select form-control" aria-label="Default select example">
  <option value="" selected> select </option>
  <?php 
  	$maincate66=mysqli_query($config,"SELECT * FROM `biding_vender` INNER JOIN customer_master ON customer_master.Customer_Id=biding_vender.cust_id");

      while($maca=mysqli_fetch_object($maincate66))
      {?>
  <option <?php $vid=$_GET['vid']; if($vid == $maca->vender_id){echo 'selected';} ?> value="<?php echo $maca->vender_id?>"><?php echo $maca->Customer_Name?></option>
  <?php }?>
</select>
    </div>
    <div class="col-3">
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href='biding_export.php?formdate=<?php echo  $fromdate?>&enddate=<?php echo  $enddate?>&vid=<?php echo $_GET['vid'] ?>' class="btn btn-success">Export</a>
    </div>
  </div>
</form>
								

								<div class="card-body">

					

									<div class="table-responsive">

										<table id="basic-datatables" class="display table table-striped table-hover" >

											<thead>

												<tr>

													<th>S.No</th>

													<th>Customer Name</th>

												

													<th>customer Email</th>

                                                    <th>customer Phone</th>

												

													<th>Keyword</th>
													<th>description</th>
													<th>Cost</th>
													<th>category</th>
													<th>Vender Name</th>
                                                    

												

<th>Vender Email</th>

<th>Vender Phone</th>
<th>Vender Package</th>
                                                    <th>Status</th>

                                                    <!-- <th>Action</th> -->



												</tr>

											</thead>

											 

											<tbody>

											<?php 

											$mc=1;
                                            if($_GET['vid'])
                                            {
                                           $bb="SELECT * FROM `biding_enq` INNER JOIN vemder_enq_list ON biding_enq.biding_en_id=vemder_enq_list.enq_id INNER JOIN customer_master ON customer_master.Customer_Id=biding_enq.custom_id
where (created_at BETWEEN '$fromdate' AND '$enddate') and venderlid='".$_GET['vid']."'";
                                           
                                            }elseif($_GET['form']){
												$bb="SELECT * FROM `biding_enq` INNER JOIN vemder_enq_list ON biding_enq.biding_en_id=vemder_enq_list.enq_id INNER JOIN customer_master ON customer_master.Customer_Id=biding_enq.custom_id
												where (created_at BETWEEN '$fromdate' AND '$enddate') ";

											}else{
                                                $bb="SELECT * FROM `biding_enq` INNER JOIN vemder_enq_list ON biding_enq.biding_en_id=vemder_enq_list.enq_id INNER JOIN customer_master ON customer_master.Customer_Id=biding_enq.custom_id
                                                ORDER BY created_at DESC";
                                            }
											$main_cate=mysqli_query($config,$bb);

											while($macate=mysqli_fetch_object($main_cate))

											{

											?>

												

												

												<tr>

													<td><?php echo $mc;?></td>

													<td><?php echo $macate->Customer_Name;?></td>

                                                    <td><?php echo $macate->Customer_Mail_id;?></td>

                                                    <td><?php echo $macate->Customer_Phone_No;?></td>

                                                    <td><?php 
                                                    $maincate33=mysqli_query($config,"SELECT * FROM `biding_post` where post_id='$macate->mid'");

													$maca33=mysqli_fetch_object($maincate33);
                                                    echo $maca33->keyword;?></td>
													<td><?php echo $macate->description;?></td>
													<td><?php echo $maca33->cost;?></td>
													<td><?php  
														$maincate=mysqli_query($config,"SELECT * FROM `biding_cate` where cid='$maca33->category_id'");

													$maca=mysqli_fetch_object($maincate);
													echo $maca->title;
													?></td>

													<?php 
													$mainca=mysqli_query($config,"SELECT * FROM `biding_vender`
													where vender_id='$macate->venderlid'");

													$maca=mysqli_fetch_object($mainca);

													$mainca1=mysqli_query($config,"SELECT * FROM `customer_master`

													where Customer_Id='$maca->cust_id'");

													$maca11=mysqli_fetch_object($mainca1);
													?>
													<td><?php echo 	$maca11->Customer_Name ?></td>
													<td><?php echo 	$maca11->Customer_Phone_No ?></td>
													<td><?php echo 	$maca11->Customer_Mail_id ?></td>
                                                    <td><?php 	$mainca44=mysqli_query($config,"SELECT * FROM `biding_package`
													where packid='$maca->vender_package'");

													$maca44=mysqli_fetch_object($mainca44); 
                                                    echo 	$maca44->title?></td>
                                                    <td><?php 
                                                    	$mainca=mysqli_query($config,"SELECT * FROM `biding_enq` where biding_en_id='$macate->biding_en_id'");

                                                        $maca=mysqli_fetch_object($mainca);
                                                       
                                                       
                                                    if($maca->status == 'new')

                                                   { ?>

                                                    <label class="btn btn-success">Active</label>

    <?php														

                                                        }elseif($maca->status == 'cancel'){

                                                            ?>

                                                            <label class="btn btn-danger">In-Active</label>

                                                            <?php

                                                        }

                                                        

                                                        

                                                        ?></td>

													

													<!-- <td>

<a href="" class="btn btn-primary" data-toggle="modal" data-target="#<?php echo $mc;?>"> <i class="fas fa-pencil-alt"></i>  </a>

<a href="Function/biding_en.php?id1=<?php echo $macate->biding_en_id;?>&delpr=700" class="btn btn-danger" onclick="return confirm('Are you confirm to delete this Category?');"> <i class="fas fa-trash"></i>  </a>



 



</td> -->



<!-- Modal -->

<div class="modal fade" id="<?php echo $mc;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel">ENQUIRY </h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <div class="modal-body">

	  <form action="Function/biding_en.php" method="post">


<input type="hidden" name="id" value="<?php echo $macate->biding_en_id ?>">

		<div class="form-group">

			<label for="email2"> Status</label>

            <select name='status' class="form-control form-select" aria-label="Default select example">

  <option <?php if( $maca->status == 'new'){ echo 'selected';} ?> value="new">Active</option>

  <option <?php if( $maca->status == 'cancel'){ echo 'selected';} ?> value="cancel">IN-Active</option>



</select>

        </div>





									<button class="btn btn-success" type="submit" name="edit1">Submit</button>

 								</div>

			

			

			</form>

			

			

      </div>

 

			

			

		</form>	

			

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

        <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <div class="modal-body">

        <form action="Function/p_cate.php" method="post" enctype="multipart/form-data">

       



			<div class="form-group">

			<label for="email2">Category Name</label>

			<input type="text" class="form-control" id="email2" name="c_name" placeholder="Enter Category Name"  >

			</div>  

		

		

		     <div class="form-group">

									<button class="btn btn-success" type="submit" name="submit">Add New</button>

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