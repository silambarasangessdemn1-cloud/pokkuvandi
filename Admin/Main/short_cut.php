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

					<h4 class="page-title">Shortcuts</h4>

<!-- Add Shortcut Button -->
<center>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addShortcutModal">
        <i class="fas fa-plus"></i> Add New Shortcut
    </button>
</center>


						<!-- Add Shortcut Modal -->
<div class="modal fade" id="addShortcutModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="Function/shortcut_add.php" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Shortcut</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>URL</label>
                        <input type="url" name="target_url" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Add Shortcut</button>
                </div>
            </form>
        </div>
    </div>
</div>
 

					</div>

					<div class="row">

						<div class="col-md-12">

							<div class="card">

								

								<div class="card-body">

								

									<div class="table-responsive">

                                    <table id="shortcuts-table" class="display table table-striped table-hover">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Image</th>
            <th>Name</th>
            <th>URL</th>
            <th>Action</th>
        </tr>
    </thead>


    <tbody>
        <?php 
    
        $sn = 1;
        $get_shortcuts = mysqli_query($config, "SELECT * FROM shortcuts ORDER BY shortcut_id DESC");
        
        while($row = mysqli_fetch_object($get_shortcuts)) {
          
        ?>
        <tr>
            <td><?php echo $sn; ?></td>
            <td><img src="<?php echo $row->image_url; ?>" style="width: 60px;"></td>
            <td><?php echo $row->name; ?></td>
            <td><a href="<?php echo $row->target_url; ?>" target="_blank"><?php echo $row->target_url; ?></a></td>
            <td>
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#editShortcutModal<?php echo $sn; ?>">
                    <i class="fas fa-pencil-alt"></i>
                </a>
                <a href="Function/shortcut_delete.php?id=<?php echo $row->shortcut_id; ?>" class="btn btn-danger" onclick="return confirm('Delete this shortcut?');">
                    <i class="fas fa-trash"></i>
                </a>
            </td>
        </tr>

        <!-- Edit Shortcut Modal -->
        <div class="modal fade" id="editShortcutModal<?php echo $sn; ?>" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="Function/hortcut_edit.php" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Shortcut</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="shortcut_id" value="<?php echo $row->shortcut_id; ?>">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" value="<?php echo $row->name; ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>URL</label>
                                <input type="url" name="target_url" value="<?php echo $row->target_url; ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" name="image" class="form-control">
                                <small>Current: <img src="<?php echo $row->image_url; ?>" style="width: 50px;"></small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php $sn++; } ?>
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





