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

						<h4 class="page-title">Area  Master</h4>

						 

					</div>

					<div class="row">

						<div class="col-md-12">

							<div class="card">

								

								<div class="card-body">

								<center> <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">

                                    <i class="fas fa-plus"></i>   Add New Area 

</button> <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal3">

<i class="fas fa-plus"></i>   Upload Excel

</button></center>			

									<div class="table-responsive">

										<table id="basic-datatables" class="display table table-striped table-hover" >

											<thead>

												<tr>

													<th>S.No</th>

													<th>City </th>

												    <th>Total Area</th>

													<th>Action</th>

												</tr>

											</thead>

											 

											<tbody>

											<?php 

											$mc=1;

											$main_cate=mysqli_query($config,"SELECT COUNT(area_id) as total,city_id,city_name FROM `biding_area_master` INNER JOIN biding_city_master ON biding_city_master.city_id=biding_area_master.cityid GROUP by (cityid)");

											while($macate=mysqli_fetch_object($main_cate))

											{

											?>

												

												

												<tr>

													<td><?php echo $mc;?></td>

													<td><?php echo $macate->city_name;?></td>
                                                    <td>Area (<?php echo $macate->total;?>)</td>
													

													<td>

<a href="area.php?id=<?php echo $macate->city_id;?>" class="btn btn-primary" > <i class="fas fa-pencil-alt">View</i>  </a>

<a href="Function/area_master.php?sid=<?php echo $macate->city_id;?>&delpr=700" class="btn btn-danger" onclick="return confirm('Are you confirm to delete this Category?');"> <i class="fas fa-trash"></i>  </a>

<a href="bid_area_master_export.php?id=<?php echo $macate->city_id;?>" class="btn btn-success" > <i class="fas fa-download"> Download Cvs</i>  </a>


 



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

        <form action="Function/area_master.php" method="post" enctype="multipart/form-data">

       

        <div class="form-group">

<label for="email2">City Name</label>



<select name="cate" class="form-select form-control" aria-label="Default select example">
  <option selected>select </option>
  <?php 

										

											$main_cate1=mysqli_query($config,"select * from biding_city_master ");

											while($macate1=mysqli_fetch_object($main_cate1))

											{

											?>
  <option value="<?php echo $macate1->city_id?>"><?php echo $macate1->city_name?></option>
 <?php }?>
</select>
</div>  

			<div class="form-group" id="a">
            <div id='TextBoxesGroup'>
  <div id="TextBoxDiv1">
			<label for="email2">Area</label>

		

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

        <form action="Function/area_master.php" method="POST" enctype="multipart/form-data">
		<div class="form-group">

<label for="email2">City Name</label>



<select name="cate" class="form-select form-control" aria-label="Default select example">
  <option selected>Select </option>
  <?php 

										

											$main_cate1=mysqli_query($config,"select * from biding_city_master ");

											while($macate1=mysqli_fetch_object($main_cate1))

											{

											?>
  <option value="<?php echo $macate1->city_id?>"><?php echo $macate1->city_name?></option>
 <?php }?>
</select>
</div>  
	
	
		<div class="form-group" >
      
		

			<input type="file"   class="form-control" id="email2" name="excel"  placeholder="Enter area Name"  > <br>
			<small> <b style="color: red;">Only For CSV Format  File <b></small>
            </div>
			<div class="form-group" >
				<a href="Area_demo1.csv"  download="Area_demo1.csv" >Demo Csv File Download</a>
	  </div>
      </div>
	  <div class="form-group" >
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