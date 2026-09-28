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

						<h4 class="page-title">City  Master</h4>

						 

					</div>

					<div class="row">

						<div class="col-md-12">

							<div class="card">

								

								<div class="card-body">

								<center> <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">

                                    <i class="fas fa-plus"></i>   Add New City 

</button>
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal3">

<i class="fas fa-plus"></i>   Upload Excel

</button>
</center>

									<div class="table-responsive">

										<table id="basic-datatables" class="display table table-striped table-hover" >

											<thead>

												<tr>

													<th>S.No</th>
                          <th>state </th>
													<th>District </th>

												    <th>Total City</th>

													<th>Action</th>

												</tr>

											</thead>

											 

											<tbody>

											<?php 

											$mc=1;
//echo $query="SELECT COUNT(dir_area_id) as total,dir_city_id,dir_city_name FROM `dir_area_master` INNER JOIN dir_city_master ON dir_city_master.dir_city_id=dir_area_master.dir_cityid GROUP by (dir_cityid)";
$query = "SELECT COUNT(da.dir_area_id) as total, dc.dir_city_id, dc.dir_city_name, ds.name as state_name 
FROM dir_area_master da 
INNER JOIN dir_city_master dc ON dc.dir_city_id = da.dir_cityid 
INNER JOIN dir_state_master ds ON ds.state_id = dc.state_id 
GROUP BY dc.dir_city_id";

$main_cate = mysqli_query($config, $query);

											while($macate=mysqli_fetch_object($main_cate))

											{

											?>

												

												

												<tr>

													<td><?php echo $mc;?></td>
                          <td><?php echo $macate->state_name; ?></td> <!-- Displaying State Name -->
													<td><?php echo $macate->dir_city_name;?></td>
                                                    <td>Area (<?php echo $macate->total;?>)</td>
													

													<td>

<a href="dir_area.php?id=<?php echo $macate->dir_city_id;?>" class="btn btn-primary" > <i class="fas fa-pencil-alt">View</i>  </a>

<a href="Function/area_master.php?sid=<?php echo $macate->dir_city_id;?>&delpr=700" class="btn btn-danger" onclick="return confirm('Are you confirm to delete this Category?');"> <i class="fas fa-trash"></i>  </a>

<a href="dir_area_master_export.php?id=<?php echo $macate->dir_city_id;?>" class="btn btn-success" > <i class="fas fa-download"> Download Cvs</i>  </a>


 



</td>



<!-- Modal -->

<div class="modal fade" id="<?php echo $mc;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <div class="modal-body">

	  <form action="Function/b_slider.php" method="post" enctype="multipart/form-data">

        

		<div class="form-group">

			<label for="email2">City Name</label>

            <input type="hidden" class="form-control" id="email2" name="cid"  value="<?php echo $macate->cid;?>">



			<input type="text" class="form-control" id="email2" name="category" value="<?php echo $macate->title;?>"  >

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

        <h5 class="modal-title" id="exampleModalLabel"></h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <div class="modal-body">

        <form action="Function/dir_area_master.php" method="post" enctype="multipart/form-data">

       
       <!-- State Dropdown -->
	   <div class="form-group">
            <label for="state">State Name</label>
            <select id="state" name="state" class="form-select form-control">
              <option selected disabled>Select State</option>
              <?php 
                $stateQuery = mysqli_query($config, "SELECT * FROM dir_state_master"); 
                while ($state = mysqli_fetch_object($stateQuery)) {
              ?>
                <option value="<?php echo $state->state_id; ?>"><?php echo $state->name; ?></option>
              <?php } ?>
            </select>
          </div>
        <div class="form-group">

<label for="email2">District Name</label>



<select name="cate" id="district"  class="form-select form-control" aria-label="Default select example">
  <option selected>Select </option>
  <?php 

										

											$main_cate1=mysqli_query($config,"select * from dir_city_master ");

											while($macate1=mysqli_fetch_object($main_cate1))

											{

											?>
  <option value="<?php echo $macate1->dir_city_id?>"><?php echo $macate1->dir_city_name?></option>
 <?php }?>
</select>
</div>  

			<div class="form-group" id="a">
            <div id='TextBoxesGroup'>
  <div id="TextBoxDiv1">
			<label for="email2">City Name</label>

		

			<input type="text"  id='textbox1' class="form-control" id="email2" name="area[]"  placeholder="Enter area Name"  > <br>
            <input type='button' class="btn btn-success btn-sm" value='Add Area' id='addButton'>
			</div>  
            </div>
            </div>

		

		

		     
			

			

		

	

      </div>

      <div class="modal-footer">

      <button class="btn btn-primary" type="submit" name="submit">Submit</button>
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
    
    $(document).ready(function() {
    $('#stateSelect').change(function() {
        var stateId = $(this).val(); // Get selected state ID
        if (stateId) {
            // Make an AJAX request to get districts for the selected state
            $.ajax({
                url: 'fetch_districts.php', // PHP file that will fetch districts based on state ID
                type: 'POST',
                data: { state_id: stateId },
                success: function(response) {
                    $('#districtSelect').html(response); // Update the district dropdown
                }
            });
        } else {
            // If no state is selected, clear the district dropdown
            $('#districtSelect').html('<option selected>Select District</option>');
        }
    });
});


		$(document).ready(function () {
    // Reset district dropdown when modal opens
    $('#exampleModal').on('show.bs.modal', function () {
        $("#district").html('<option selected disabled>Select District</option>').prop("disabled", true);
        $("#state").val(""); // Reset state dropdown if needed
    });

    // Load districts when state is selected
    $("#state").change(function () {
        var stateId = $(this).val();
        $("#district").html('<option selected disabled>Select District</option>').prop("disabled", true);

        if (stateId) {
            $.ajax({
                url: "fetch_districts.php",
                type: "POST",
                data: { state_id: stateId },
                success: function (response) {
                    $("#district").html(response).prop("disabled", false);
                },
                error: function () {
                    alert("Failed to load districts.");
                }
            });
        }
    });
});

	</script>

</body>

</html>





<script>
   $(document).ready(function() {
  var counter = 2;
  $("#addButton").click(function() {
    if (counter < 2) {
      alert("Add more textbox");
      return false;
    }

    var newTextBoxDiv = $(document.createElement('div'))
      .attr("id", 'TextBoxDiv' + counter).attr("class", 'TextBoxDiv');
       
    newTextBoxDiv.after().html('<label>Area ' + counter + ' : </label>' +
      '<input type="text"  class="form-control" id="email2" name="area[]" id="textbox' + counter + '"  placeholder="Enter area Name"  >' +
      '<input type="button" name="button' + counter +
      '" class="removeButton btn btn-danger btn-sm" value="Remove Area">');
    newTextBoxDiv.appendTo("#TextBoxesGroup");
  
    counter++;
  });

  $("body").on("click", ".removeButton", function() {
    if (counter <= 2) {
      alert("No more textbox to remove");
      return false;
    }

    $(this).closest('.TextBoxDiv').remove();
  });
});
</script>


<style>
    .btn-danger {
    background: #f25961!important;
    border-color: #f25961!important;
    margin-top: 7px;
    margin-bottom: 4px;
}
</style>

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

        <form action="Function/dir_area_master.php" method="POST" enctype="multipart/form-data">
		<div class="form-group">
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

<label for="email2">District Name</label>
<select id="districtSelect" name="cate" class="form-select form-control" aria-label="Default select example">
    <option selected>Select District</option>
    <!-- Districts will be loaded here based on the selected state -->
</select>

	
	
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
