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

						<h4 class="page-title"><a href="Direct_bussness_enq.php" class="b"><i class="fa fa-long-arrow-left"> </i></a>Direct  Enquiry	</h4>

						 

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
													<th>Date</th>

												
												
													<th> Name</th>

												

													<th> Email</th>

                                                    <th> Phone</th>

												
                                                    <th> Enquiry</th>
                                                    <th>Status</th>

                                                    <th>Action</th>



												</tr>

											</thead>

											 

											<tbody>

											<?php 

											$mc=1;

											$main_cate=mysqli_query($config,"SELECT * FROM `dir_bussness` INNER JOIN dir_vender ON dir_bussness.vid=dir_vender.dir_vender_id where vid='".$_GET['eid']."'
                                           ");

											while($macate=mysqli_fetch_object($main_cate))

											{

											?>

												

												

												<tr>

													<td><?php echo $mc;?></td>
													<td><?php  $macate->created_at;$date=date_create($macate->created_at); echo  date_format($date,"d/m/Y");?></td>
									
                                                    <td><?php echo $macate->e_name;?></td>
                                                    <td><?php echo $macate->e_email;?></td>
                                                    <td><?php echo $macate->e_phone;?></td>
                                                 
                                                    <td><?php echo substr($macate->e_msg,0,10);?></td>
                                                    <td><?php if( $macate->e_status == 0)

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

<a href="Function/dir_review.php?eid1=<?php echo $macate->dir_bu_id;?>&eidv=<?php echo $_GET['eid'] ?>" class="btn btn-danger" onclick="return confirm('Are you confirm to delete this Category?');"> <i class="fas fa-trash"></i>  </a>



 



</td>



<!-- Modal -->

<div class="modal fade" id="<?php echo $mc;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel"> </h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <div class="modal-body">

	  <form action="Function/dir_review.php" method="POST">

	


<input type="hidden" name="id" value="<?php echo $macate->dir_bu_id ?>">
<input type="hidden" name="eid" value="<?php echo $_GET['eid'];?>">

<div class="form-group">

<label for="email2"> Message  </label>
<p><?php echo $macate->e_msg ?></p>
</div>
		<div class="form-group">

			<label for="email2"> Status</label>

            <select name='estatus' class="form-control form-select" aria-label="Default select example">

  <option <?php if($macate->stat == 0){ echo 'selected';} ?> value="0">Active</option>

  <option <?php if($macate->stat == 1){ echo 'selected';} ?> value="1">IN-Active</option>



</select>

        </div>





									<button class="btn btn-success" type="submit" name="edite1">Submit</button>

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

<label for="email2">Notes</label>
<textarea  class="form-control" id="email2" name="notes"></textarea>

		</div>



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