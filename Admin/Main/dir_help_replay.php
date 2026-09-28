<?php include('../config/setup.php');?>


<?php 

if(isset($_POST['submit']))

 { 
 	$file_name1 = $_FILES['image']['name'];

if($file_name1)
{
    $file_name = $_FILES['image']['name'];
    $file_size =$_FILES['image']['size'];
     $file_tmp =$_FILES['image']['tmp_name'];
    $file_type=$_FILES['image']['type'];
    move_uploaded_file($file_tmp,"../../App/img/dir_help/".$file_name);

    $sql = "INSERT INTO  dir_help_replay (dir_help_replay_lid, dir_help_replay_desc, dir_help_replay_img)
    VALUES ('".$_GET['id']."', '".$_POST['desc']."', '$file_name')";


}else{
     $sql = "INSERT INTO  dir_help_replay (dir_help_replay_lid, dir_help_replay_desc)
    VALUES ('".$_GET['id']."', '".$_POST['desc']."')";
}

mysqli_query($config,$sql);
 } 
 
 if(isset($_POST['edit']))

 { 
	$file_name1 = $_FILES['image']['name'];
if($file_name1)
{
    $file_name = $_FILES['image']['name'];
    $file_size =$_FILES['image']['size'];
     $file_tmp =$_FILES['image']['tmp_name'];
    $file_type=$_FILES['image']['type'];
    move_uploaded_file($file_tmp,"../../App/img/dir_help/".$file_name);

  $sql = "UPDATE dir_help_replay SET dir_help_replay_img='$file_name',dir_help_replay_desc='".$_POST['desc']."'  WHERE dir_help_replay_id='".$_POST['eid']."'";
}else{
	$sql = "UPDATE dir_help_replay SET dir_help_replay_desc='".$_POST['desc']."'   WHERE dir_help_replay_id='".$_POST['eid']."' ";

}
mysqli_query($config,$sql);  
 }
 if(isset($_GET['did']))

 { 
    $sql = "DELETE FROM dir_help_replay WHERE dir_help_replay_id='".$_GET['did']."'";	
mysqli_query($config,$sql);  
 }
?>


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

						<h4 class="page-title"><a href="dir_help.php" class="b"><i class="fa fa-long-arrow-left"> </i></a>Back  <?php echo $_GET['title']; ?>	</h4>

						 

					</div>

					<div class="row">

						<div class="col-md-12">

							<div class="card">

                   <center>         <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
 Replay
</button></center>


								<div class="card-body">

					

									<div class="table-responsive">

										<table id="basic-datatables" class="display table table-striped table-hover" >

											<thead>

												<tr>

													<th>S.No</th>
                                                    <th>Date</th>
													<th>File</th>
                                                    <th>Msg</th>
												


                                                    <th>Action</th>



												</tr>

											</thead>

											 

											<tbody>

											<?php 

											$mc=1;
 $s="SELECT * FROM `dir_help_replay`  where dir_help_replay_lid='".$_GET['id']."'";
											$main_cate=mysqli_query($config,$s);

											while($macate=mysqli_fetch_object($main_cate))

											{

											?>

												

												

												<tr>

													<td><?php echo $mc;?></td>
												<td><?php echo $macate->created_at;?></td>
                                                    <td><?php if($macate->dir_help_replay_img){ ?><img src="../../App/img/dir_help/<?php echo $macate->dir_help_replay_img;?>" style="width:100px;">
                                                    <?php }else {echo 'No Images';}?></td>

                                                    <td><?php echo $macate->dir_help_replay_desc;?></td>

													<td>

<a href="" class="btn btn-primary" data-toggle="modal" data-target="#<?php echo $mc;?>"> <i class="fas fa-pencil-alt"></i>  </a>
<a href="dir_help_replay.php?id=<?php echo $_GET['id'] ?>&title=<?php echo $_GET['title'] ?>&did=<?php echo $macate->dir_help_replay_id;?>" class="btn btn-danger" onclick="return confirm('Are you confirm to delete this Category?');"> <i class="fas fa-trash"></i>  </a>

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

	 
      <form action="dir_help_replay.php?id=<?php echo $_GET['id'] ?>&title=<?php echo $_GET['title'] ?>" method="post" enctype="multipart/form-data">

<div class="form-group">

<label for="email2">Replay</label>
<textarea  class="form-control" id="email2" name="desc"> <?php echo $macate->dir_help_replay_desc;?></textarea>
<input value=" <?php echo $macate->dir_help_replay_id;?>" name="eid">
</div>



    <div class="form-group">
    <img src="../../App/img/dir_help/<?php echo $macate->dir_help_replay_img;?>" style="width:200px;">

    <br>
    <label for="email2">File</label>

    <input type="file" class="form-control" id="email2" name="image" placeholder="Enter Category Name"  >


    </div>  





     <div class="form-group">

                            <button class="btn btn-success" type="submit" name="edit">Submit</button>

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

        <h5 class="modal-title" id="exampleModalLabel">Replay</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <div class="modal-body">

        <form action="dir_help_replay.php?id=<?php echo $_GET['id'] ?>&title=<?php echo $_GET['title'] ?>" method="post" enctype="multipart/form-data">

		<div class="form-group">

<label for="email2">Replay</label>
<textarea  class="form-control" id="email2" name="desc"></textarea>

		</div>



			<div class="form-group">

			<label for="email2">File</label>
			<input type="file" class="form-control" id="email2" name="image" placeholder="Enter Category Name"  >


			</div>  

		

		

		     <div class="form-group">

									<button class="btn btn-success" type="submit" name="submit">Submit</button>

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