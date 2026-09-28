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

						<h4 class="page-title">Business Vender Active	</h4>

						 

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

												
													<th>Logo </th>
													<th>Company Name</th>

												

													<th>Company Email</th>

                                                    <th>Company Phone</th>
                                                    <th>Ex Date</th>
                                                    <th>Plan Name</th>

												
													<th>Verify</th>
													<th>Verify Years</th>
                                                    <th>Status</th>
													<th>Verify Edit</th>
                                                    <th>Basic Edit</th>
                                                    <th>Gallery Edit</th>
                                                    <th>Keyword Edit</th>
                                                    <th>Action</th>



												</tr>

											</thead>

											 

											<tbody>

											<?php 

											$mc=1;

											$main_cate=mysqli_query($config,"SELECT * FROM `dir_vender` INNER JOIN dir_package ON dir_vender.packid=dir_package.dir_packid where dirv_status='0' order by (dir_vender_id)");

											while($macate=mysqli_fetch_object($main_cate))

											{

											?>

												

												

												<tr>

													<td><?php echo $mc;?></td>
													<td><?php  $macate->created_at;$date=date_create($macate->created_at); echo  date_format($date,"d/m/Y");?></td>
									
                                                    <td><img src="../../App/img/dir_logo/<?php echo $macate->c_logo;?>" style="width:80px;"></td>
                                                    <td><?php echo $macate->c_name;?></td>
                                                    <td><?php echo $macate->c_email;?></td>
                                                    <td><?php echo $macate->c_phone;?></td>
                                                    <td><?php echo $macate->ex_date;?></td>
                                                    <td><?php echo $macate->dir_title;?></td>
													<td><?php if( $macate->c_ver == 0)

{ ?>

 <label class="btn btn-danger">Not Verified </label>

<?php														

	 }else{

		 ?>

		 <label class="btn btn-success">Verified </label>

		 <?php

	 }
	 ?></td>
	 <td><?php echo $macate->c_ver_yr;?></td>
                                                    <td><?php if( $macate->dirv_status == 0)

                                                   { ?>

                                                    <label class="btn btn-success" data-toggle="modal" data-target="#exampleModals<?php echo $macate->dir_vender_id;?>">Active</label>

    <?php														

                                                        }else{

                                                            ?>

                                                            <label class="btn btn-danger" data-toggle="modal" data-target="#exampleModals<?php echo $macate->dir_vender_id;?>">In-Active</label>

                                                            <?php

                                                        }
                                                        ?></td>
													
<td><a  class="btn btn-danger" data-toggle="modal" data-target="#exampleModal<?php echo $mc;?>"> <i class="fas fa-pencil-alt">Verify</i>  </a></td>
													<td>
                                                    <a href="dir_bussness_list_details.php?eid=<?php echo $macate->dir_vender_id ;?>&delpr=700" class="btn btn-primary" > <i class="fas fa-pencil-alt">Basic Edit</i>  </a>
</td>
<td>
                                                    <a href="dir_bussness_list_details_gallery.php?eid=<?php echo $macate->dir_vender_id ;?>&delpr=700" class="btn btn-success" > <i class="fas fa-pencil-alt">Gallery Edit</i>  </a>
</td>
<td>
<a href="dir_bussness_list_details_key.php?eid=<?php echo $macate->dir_vender_id ;?>&packid=<?php echo $macate->packid ;?>" class="btn btn-danger" > <i class="fas fa-pencil-alt">Keyword Edit</i>  </a>
</td>

<td><a href="bussness_list_de.php?did=<?php echo $macate->dir_vender_id;?>" class="btn btn-danger" onclick="return confirm('Are you confirm to delete this Category?');"> <i class="fas fa-trash"></i>  </a>
</td>
<!-- Modal -->
<div class="modal fade" id="exampleModals<?php echo $macate->dir_vender_id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form id="" method="POST" action="dir_edit.php" enctype="multipart/form-data">

	  <div class="col-md-6">
		  <input name="id"  type="hidden" value="<?php echo $macate->dir_vender_id;?>">
    <label for="exampleInputEmail1">STATUS </label>
    <select name="status" class="form-control">
  <option <?php if($macate->dirv_status == 0 ){ echo 'selected';}?> value="0">ACTIVE</option>
  <option <?php if($macate->dirv_status == 1 ){ echo 'selected';}?> value="1">IN-ACTIVE</option>
</select>
    </div>
	<div class="form-group">
    <button style="float: right;" name="company_status" type="submit" class="btn btn-primary"><span id="">Submit</span></button>
    </div>

            </form>
      </div>
      
    </div>
  </div>
</div>


<div class="modal fade" id="exampleModal<?php echo $mc;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModal"> </h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <div class="modal-body">

	  <form action="dir_verfied.php" method="POST">

	


<input type="hidden" name="id" value="<?php echo $macate->dir_vender_id ?>">
<div class="form-group">

<label for="email2"> Verify  </label>
<select name="verify" class="form-control" id="exampleFormControlSelect1">
      <option <?php if($macate->c_ver == 0){ echo 'seleted';} ?> value="0">Not Verified </option>
      <option <?php if($macate->c_ver == 1){ echo 'seleted';} ?> value="1"> Verified</option>
  
    </select>
</div>
		<div class="form-group">

			<label for="email2"> Years</label>
			<input type="text" class="form-control" name="year" value="<?php echo $macate->c_ver_yr ?>">


        </div>





									<button class="btn btn-success" type="submit" name="edite">Submit</button>

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