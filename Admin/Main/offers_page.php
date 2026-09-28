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

						<h4 class="page-title">Offers</h4>

						 

					</div>

					<div class="row">

						<div class="col-md-12">

							<div class="card">

								

								<div class="card-body">

								<center> <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">

                                    <i class="fas fa-plus"></i>   Add New offer 

</center>

									<div class="table-responsive">

										<table id="basic-datatables" class="display table table-striped table-hover" >

											<thead>

												<tr>

													<th>S.No</th>

													<th>Image </th>

                                                    <th>Offer Name </th>
                                                    
													<th>Action</th>

												</tr>

											</thead>

											 

											<tbody>

											<?php 

											$mc=1;

                                            $main_cate=mysqli_query($config, "
                                            SELECT * FROM offers 
                                            ORDER BY 
                                            offer_id
                                        ");
											while($macate=mysqli_fetch_object($main_cate))

											{

											?>

												

												

												<tr>
                                                <td><?php echo $mc; ?></td>

                                                <td>
                <img src="<?php echo $macate->image_url; ?>" alt="Offer Image" style="width: 100px; height: auto;">
            </td>
            <td><?php echo $macate->offer_name; ?></td>
													

            <td>
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#editModal<?php echo $mc; ?>"> 
                    <i class="fas fa-pencil-alt"></i> 
                </a>
                <a href="Function/offer_del.php?cd=<?php echo $macate->offer_id; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this offer?');"> 
                    <i class="fas fa-trash"></i> 
                </a>
            </td>



<!-- Modal -->








  </div>

</div>

													

													 

												</tr>
        <!-- Edit Modal -->
        <div class="modal fade" id="editModal<?php echo $mc; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?php echo $mc; ?>" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel<?php echo $mc; ?>">Edit Offer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editOfferForm<?php echo $mc; ?>" enctype="multipart/form-data" method="POST" action="edit_offer.php">
                            <input type="hidden" name="offer_id" value="<?php echo $macate->offer_id; ?>">
                            <div class="form-group">
                                <label for="editOfferName<?php echo $mc; ?>">Offer Name</label>
                                <input type="text" class="form-control" id="editOfferName<?php echo $mc; ?>" name="offer_name" value="<?php echo $macate->offer_name; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="editOfferImage<?php echo $mc; ?>">Offer Image</label>
                                <input type="file" class="form-control" id="editOfferImage<?php echo $mc; ?>" name="image" accept="image/*">
                                <small>Current Image: <img src="<?php echo $macate->image_url; ?>" alt="Current Offer Image" style="width: 50px; height: auto;"></small>
                            </div>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

												

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

   <!-- Modal -->
   <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Offer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="offerForm" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="offerName">Offer Name</label>
                                <input type="text" class="form-control" id="offerName" name="offer_name" required>
                            </div>
                            <div class="form-group">
                                <label for="offerImage">Offer Image</label>
                                <input type="file" class="form-control" id="offerImage" name="image" accept="image/*" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
			

			

<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel"></h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <div class="modal-body">

        <form action="Function/dir_state_master.php" method="POST" enctype="multipart/form-data">
		<!-- <div class="form-group">

<label for="email2">District Name</label>



<select name="cate" class="form-select form-control" aria-label="Default select example">
  <option selected>Select </option>
  <?php 

										

											$main_cate1=mysqli_query($config,"select * from dir_state_master ");

											while($macate1=mysqli_fetch_object($main_cate1))

											{

											?>
  <option value="<?php echo $macate1->dir_city_id?>"><?php echo $macate1->dir_city_name?></option>
 <?php }?>
</select>
</div>    -->
	
	
		<div class="form-group" >
      
		

			<input type="file"   class="form-control" id="email2" name="excel"  placeholder="Enter area Name"  > <br>
			<small> <b style="color: red;">Only For CSV Format  File <b></small>
            </div>
			<div class="form-group" >
				<a href="district_demo.csv"  download="district_demo.csv" >Demo Csv File Download</a>
	  </div>
      </div>
	  <div class="form-group" >
	  </div>
      <div class="modal-footer">

      <button class="btn btn-primary" type="submit" name="exsubmit">Submit</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	</form>
        

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
  <script>
        $(document).ready(function() {
            $('#offerForm').on('submit', function(e) {
                e.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: 'save_offer.php',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        alert(response);
                        // Optionally, you can close the modal and reload the offers table
                        // $('#exampleModal').modal('hide');
                        // location.reload(); // or update the table dynamically
                    }
                });
            });
        });
    </script>
</body>

</html>





