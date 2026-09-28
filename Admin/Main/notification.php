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

						<h4 class="page-title">NOTIFICATION (SUPPORT)</h4>

						 

					</div>

					<div class="row">

						<div class="col-md-12">

							<div class="card">

								

								<div class="card-body">

								<center> <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">

                                    <i class="fas fa-plus"></i>   Add New Notification 

</button></center>

									<div class="table-responsive">

										<table id="basic-datatables" class="display table table-striped table-hover" >

											<thead>

                                            <tr>

<th>S.No</th>

<th>Title</th>
<th>Description</th>
<th>Image</th>
<th>Type</th>
<th>Replay Type</th>
<th>Action</th>

</tr>

											</thead>

											 
                                            <tbody>

<?php 

$mc=1;
$id=$_GET['id'];
$main_cate=mysqli_query($config,"SELECT * FROM `notification` order by (n_id) DESC ");

while($macate=mysqli_fetch_object($main_cate))

{

?>

    

    

    <tr>

        <td><?php echo $mc;?></td>
        <td><?php echo $macate->title;?></td>
        <td><?php echo $macate->description;?></td>
        <td><img style="width: 100px;height:100px;" src='../../App/img/dir_gallery/<?php echo $macate->n_img;?>'></td>
        <td><?php if($macate->n_type == 0){ echo 'User';}else{ echo 'Vender';}?></td>
        <td><?php if($macate->replay == 0){ echo 'Replay';}else{ echo 'No-Replay';}?></td>
        
        <td><?php if( $macate->n_status == 0)

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

<a href="dir_edit.php?ndid=<?php echo $macate->n_id;?>&id=<?php echo $_GET['id'] ?>&tile=<?php echo $_GET['title']?>" class="btn btn-danger" onclick="return confirm('Are you confirm to delete this Category?');"> <i class="fas fa-trash"></i>  </a>

<a href="view_notifi.php?id=<?php echo $macate->n_id?>" class="btn btn-success" href=""> <i class="fas fa-eye-alt"></i> View </a>






</td>



<!-- Modal -->

<div class="modal fade" id="<?php echo $mc;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

<div class="modal-dialog" role="document">

<div class="modal-content">

<div class="modal-header">

<h5 class="modal-title" id="exampleModalLabel">Edit keyword</h5>

<button type="button" class="close" data-dismiss="modal" aria-label="Close">

<span aria-hidden="true">&times;</span>

</button>

</div>

<div class="modal-body">

<form action="dir_edit.php" method="post" enctype="multipart/form-data">



<div class="form-group">

<label for="email2">Icon </label>

<img style="width: 100px;height:100px;" src='../../App/img/dir_gallery/<?php echo $macate->n_img;?>'>
<br>

<small>60px * 40px</small>

<input type="text" class="form-control" id="email2" name="sid"  value="<?php echo $macate->n_id;?>">



<input type="file" class="form-control" id="email2" name="logo"  >

</div>
<div class="form-group">

<label for="email2">Title </label>
<input type="text" class="form-control" id="email2" name="title"  value="<?php echo $macate->title;?>">

</div>

<div class="form-group">

<label for="email2">Description </label>
<textarea class="form-control" id="email2" name="desc" ><?php echo $macate->description;?></textarea>

</div>
<div class="form-group">

<label for="email2">Type </label>
<select name="type" class="form-control">
  <option <?php if($macate->n_type == 0){ echo 'selected'; } ?> value="0">User</option>
  <option <?php if($macate->n_type == 1){ echo 'selected'; } ?> value="1">Vender</option>

</select>
</div>
<div class="form-group">

<label for="email2">Replay </label>
<select name="replay" class="form-control">
  <option <?php if($macate->replay == 0){ echo 'selected'; } ?> value="0">Replay</option>
  <option <?php if($macate->replay == 1){ echo 'selected'; } ?> value="1">No-Replay</option>

</select>
</div>
<br>
<button class="btn btn-success" type="submit" name="nedit">Submit</button>

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

        <form action="dir_edit.php" method="post" enctype="multipart/form-data">

     


<div class="form-group">

<label for="email2">Icon </label>



<small>60px * 40px</small>


<input type="file" class="form-control" id="email2" name="logo"  >

</div>
<div class="form-group">

<label for="email2">Title </label>
<input type="text" class="form-control" id="email2" name="title" >

</div>
<div class="form-group">

<label for="email2">Description </label>
<textarea class="form-control" id="email2" name="desc" ></textarea>

</div>
<div class="form-group">

<label for="email2">Type </label>
<select name="type" class="form-control">
  <option value="0">User</option>
  <option  value="1">Vender</option>

</select>
</div>
<div class="form-group">

<label for="email2">Replay </label>
<select name="replay"  class="form-control">
  <option  value="0">Replay</option>
  <option  value="1">No-Replay</option>

</select>
</div>

      <div class="modal-footer">

      <button class="btn btn-primary" type="submit" name="nsubmit">Add New</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	</form>
        

     

  </div>

</div>

		</div>

		

		 

		<!-- End Custom template -->

	</div>
    <!-- <?php include('footer.php');?> -->
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
       
    newTextBoxDiv.after().html('<label>Keyword :' + counter + ' : </label>' +
      '<input type="text"  id="textbox2' + counter + '" class="form-control" id="email2" name="keyword[]"  placeholder="Enter  keyword"  ><br> <label for="email2">Keyword Cost: ' + counter + '</label><input type="text"  id="textbox3' + counter + '" class="form-control"  name="cost[]"  placeholder="Enter  Cost"  > <br><label for="email2">Keyword icon: ' + counter + '</label><input type="file"  class="form-control" id="email2" name="image[]" id="textbox' + counter + '"  placeholder="Enter area Name"  ><small>60px * 40px</small><br>' +
      '<input type="button" name="button' + counter +
      '" class="removeButton btn btn-danger btn-sm" value="Remove Keyword">');
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