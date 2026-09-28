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

						<h4 class="page-title">District  Master</h4>

						 

					</div>

					<div class="row">

						<div class="col-md-12">

							<div class="card">

								

								<div class="card-body">
  <!-- Search Form -->

      

								<center> <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">

                                    <i class="fas fa-plus"></i>   Add New District 

</button>

<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal3">

<i class="fas fa-plus"></i>   Upload Excel

</button></center>
<form method="GET" action="" class="d-flex align-items-center" style="margin-top: 10px;">
    <input type="text" name="search" class="form-control me-2" placeholder="Search District..." 
        style="width: 300px;" 
        value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" />
    <button type="submit" class="btn btn-info" style="margin-left: 30px;">Search</button>
</form>

									<div class="table-responsive">

										<table id="basic-datatables" class="display table table-striped table-hover" >

											<thead>

												<tr>

													<th>S.No</th>

													<th>District </th>

													<th>State </th>

													<th>Action</th>

												</tr>

											</thead>

											 

											<tbody>

											<?php 
$mc = 1;
$search_query = '';  // Default empty search query

// Check if search is submitted via GET
if(isset($_GET['search']) && !empty($_GET['search'])){
    $search_term = mysqli_real_escape_string($config, $_GET['search']);
    $search_query = "WHERE (c.dir_city_name LIKE '%$search_term%' OR s.name LIKE '%$search_term%')";
}

// Execute the query
$main_cate = mysqli_query($config, "
    SELECT 
        c.dir_city_id,
        c.dir_city_name,
        s.name AS state_name
    FROM 
        dir_city_master AS c
    INNER JOIN 
        dir_state_master AS s
    ON 
        c.state_id = s.state_id
    $search_query
    ORDER BY 
        c.dir_city_name ASC
");
											while($macate=mysqli_fetch_object($main_cate))

											{

											?>

												

												

												<tr>

													<td><?php echo $mc;?></td>

													<td><?php echo $macate->dir_city_name;?></td>

													<td><?php echo htmlspecialchars($macate->state_name); ?></td>


													<td>

<a href="" class="btn btn-primary" data-toggle="modal" data-target="#<?php echo $mc;?>"> <i class="fas fa-pencil-alt"></i>  </a>

<a href="Function/dir_city_master.php?cd=<?php echo $macate->dir_city_id;?>" class="btn btn-danger" onclick="return confirm('Are you confirm to delete this Category?');"> <i class="fas fa-trash"></i>  </a>



 



</td>



<!-- Modal -->

<div class="modal fade" id="<?php echo $mc;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel">Edit District</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <div class="modal-body">

	  <form action="Function/dir_city_master.php" method="post" enctype="multipart/form-data">

        

		<div class="form-group">

			<label for="email2">District Name</label>

            <input type="hidden" class="form-control" id="email2" name="cid"  value="<?php echo $macate->dir_city_id;?>">



			<input type="text" class="form-control" id="email2" name="category" value="<?php echo $macate->dir_city_name;?>"  >

        </div>

									<button class="btn btn-success" type="submit" name="e_cate">Submit</button>

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

        <h5 class="modal-title" id="exampleModalLabel">Add District</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <div class="modal-body">

        <form action="Function/dir_city_master.php" method="post" enctype="multipart/form-data">

		<div class="form-group">
            <label for="stateDropdown">Select State</label>
            <select class="form-control" id="stateDropdown" name="state_id" required>
              <option value="" disabled selected>Select State</option>
			  <?php
// Fetch states from the database
$state_query = mysqli_query($config, "SELECT state_id, name FROM dir_state_master ORDER BY name ASC");
while ($state = mysqli_fetch_object($state_query)) {
    // Check if the current state ID is 24, and add the 'selected' attribute
    $selected = ($state->state_id == 24) ? 'selected' : '';
    echo '<option value="' . ($state->state_id) . '" ' . $selected . '>' . ($state->name) . '</option>';
}
?>

            </select>
          </div>
        <div class="form-group">

<label for="email2">District Name</label>



<input type="text" class="form-control" id="email2" name="category" placeholder="Enter District Name"  >

</div>  




			<!-- <div class="form-group">

			<label for="email2">Images</label>

			<small>600px * 315px</small>

			<input type="file" class="form-control" id="email2" name="uploadfile" multiple placeholder="Enter Category Name"  >

			</div>   -->

		

		

		     <div class="form-group">

									<button class="btn btn-success" type="submit" name="cate_add">Submit</button>

 								</div>

			

			

			</form>

	

      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

        

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

        <form action="Function/dir_city_master.php" method="POST" enctype="multipart/form-data">
		<!-- <div class="form-group">

<label for="email2">District Name</label>



<select name="cate" class="form-select form-control" aria-label="Default select example">
  <option selected>Select </option>

  <?php 

										

											$main_cate1=mysqli_query($config,"select * from dir_city_master ");

											while($macate1=mysqli_fetch_object($main_cate1))

											{

											?>
  <option value="<?php echo $macate1->dir_city_id?>"><?php echo $macate1->dir_city_name?></option>
 <?php }?>
</select>
</div>    -->
	
	 <div class="form-group">
            <label for="stateSelect">Select State</label>
            <select id="stateSelect" name="state" class="form-select form-control">
              <option value="">Select State</option>
              <?php 
                $states = mysqli_query($config, "SELECT * FROM dir_state_master"); 
                while ($state = mysqli_fetch_object($states)) {
              ?>
                <option value="<?php echo $state->state_id; ?>"><?php echo $state->name; ?></option>
              <?php } ?>
            </select>
          </div>
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
        "paging": true, // Ensures pagination is enabled
        "lengthChange": true, // Allows changing the number of entries per page
        "searching": true, // Enables search box
        "ordering": true, // Enables ordering
        "info": true, // Displays information about the current page and number of records
        "autoWidth": false // Prevents auto width adjustment that can break layout
    });
});


	</script>

</body>

</html>





