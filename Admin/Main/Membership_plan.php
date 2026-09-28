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

            

            ?>  </title>

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

						<h4 class="page-title">Membership</h4>

						 

					</div>

					<div class="row">

						<div class="col-md-12">

							<div class="card">

								

								<div class="card-body">

								<!-- <center> <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">

                                    <i class="fas fa-plus"></i>   Add New Plan

</button></center> -->

									<div class="table-responsive">

										<table id="basic-datatables" class="display table table-striped table-hover" >

											<thead>

												<tr>

													<th>S.No</th>

													<th> Date</th>

													<th>Title</th>

													<th>Amount</th>

													

													<th>Level 1 commission %</th>

													<th>Level 2 commission %</th>

													<th>purchase Level 1 commission %</th>

													<th>Purchase Level 2 commission %</th>

												   <th>Membership Valid Upto</th>

												  

												   <th>description </th>
												   <th>referral title </th>
												   <th>referral content </th>

													

												   <th>Renewal Amount</th>
<th>Purchase Dis </th>
												   <th>Video</th>

													<th>Action</th>

												</tr>

											</thead>

											 

											<tbody>

											<?php 

											$mc=1;

											$main_cate=mysqli_query($config,"select * from membership");

											while($macate=mysqli_fetch_object($main_cate))

											{

											?>

												

												

												<tr>

													<td><?php echo $mc;?></td>

													<td><?php echo $macate->date;?></td>

													<td><?php 

												echo $macate->title;

												

												

												

												?>

													

													

													</td>

													 

													<td>Rs.<?php echo $macate->price;?></td> 

													<td><?php

													

													echo $macate->level1_com;

			

													

													

													?></td> 

												

		 

													<td><?php echo	$macate->level2_com;

													

											

													?>

													

													

													

													

													</td>

													<td><?php

													

													echo $macate->purchase_1;

			

													

													

													?></td> 

												

		 

													<td><?php echo	$macate->purchase_2;

													

											

													?>

													

													

													

													

													</td>

													<td><?php 



												echo $macate->ex_days;

																																							

													?></td>

																				<td><?php 



echo substr($macate->description,0,80);

																											

	?>
	</td>
	<td><?php echo $macate->referal_script_title;?></td>
<td><?php echo substr($macate->referal_script,0,80);?></td>
	</td>

																				<td><?php 



echo $macate->renew_amount;

																											

	?></td>
<td><?php echo  $macate->re_purches_pre; ?></td>
	<td><?php echo  $macate->video; ?></td>

													<td>

<a href="" class="btn btn-primary" data-toggle="modal" data-target="#<?php echo $mc;?>"> <i class="fas fa-pencil-alt"> Edit</i>  </a>

<!-- <a href="Function/referal_delete.php?delprefid=<?php echo $macate->Referal_id;?>&redelpt=700" class="btn btn-danger" onclick="return confirm('Are you confirm to delete this Referal Code?');"> <i class="fas fa-trash"></i>  </a> -->



 



</td>



<!-- Modal -->

<div class="modal fade" id="<?php echo $mc;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel">Edit </h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <div class="modal-body">

	  <form action="addmember.php" method="post" enctype="multipart/form-data">

       





	   <div class="form-group">

				 <label for="email2">Title</label>

				 <input type="text" class="form-control" id="email2" name="title" value="<?php 	echo $macate->title;?> "   >

				 <input type="hidden" class="form-control" id="email2" name="id" value="<?php 	echo $macate->mid;?>"   >



				</div> 

				 <div class="form-group">

				 <label for="email2"> Amount</label>

				 <input type="number" class="form-control" id="email2" name="amount" value="<?php echo $macate->price;?>"  >

				 </div>

				 <div class="form-group">

				 <label for="email2">Level 1 commission %</label>

				 <input type="number" class="form-control" id="email2" name="level1" value="<?php echo $macate->level1_com; ?>" >

				 </div>

				 <div class="form-group">

				 <label for="email2">Level 2 commission %</label>

				 <input type="number" class="form-control" id="email2" name="level2"  value="<?php echo $macate->level2_com;?>"  >

				 </div> 

				 <div class="form-group">

				 <label for="email2">Purchase  Level 1 commission %</label>

				 <input type="number" class="form-control" id="email2" name="purchase_1" value="<?php echo $macate->purchase_1; ?>" >

				 </div>

				 <div class="form-group">

				 <label for="email2">Purchase Level 2 commission %</label>

				 <input type="number" class="form-control" id="email2" name="purchase_2"  value="<?php echo $macate->purchase_2;?>"  >

				 </div> 

				   <div class="form-group">

				 <label for="email2">Membership Valid Upto(Days)</label>

				 <input type="number" class="form-control" id="email2" name="days"  value="<?php echo $macate->ex_days;?>" >

				 </div>  

				  <div class="form-group">

				 <label for="email2">description</label>

				  <textarea  class="form-control"   name="desc" rows="5" cols="100"  > <?php echo $macate->description;?></textarea> 

				 

				 

				 </div>  
				 <div class="form-group">

<label for="email2">
Referral Title
</label>
<input type="text" style="" class="form-control" id="email2" name="referal_script_title" rows="3"  value="<?php echo $macate->referal_script_title;?>" >

				 </div>
				 <div class="form-group">

<label for="email2">
Referral content
</label>
<p><?php echo $macate->referal_script;?></p>
<input type="text" style="height: 100px !important;" class="form-control" id="email2" name="referal_script" rows="3"  value="<?php echo $macate->referal_script;?>" >

				 </div>
				 <div class="form-group">

				 <label for="email2">Renewal Amount</label>

				 <input type="number" class="form-control" id="email2" name="renew"  value="<?php echo $macate->renew_amount;?>" >

				 </div>
				 <div class="form-group">

<label for="email2">Purchase Dis </label>

<input type="number" class="form-control" id="email2" name="re_purches_pre"  value="<?php echo $macate->re_purches_pre;?>" >

</div>
				 <div class="form-group">

				 <?php echo $macate->video;?>

				 <br>

				 <label for="email2">Youtube Iframe link</label>

				  <input type="text" class="form-control" class=""   name="video" rows="5" cols="100"  value=""> 

				 

				 

				 </div>			 

			 

				  <div class="form-group">

										 <button class="btn btn-success" name="addnew" type="submit" >Submit</button>

									  </div>

				 

				 

				 </form>

		 

		   </div>

 

      <div class="modal-footer">

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

         

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

        <h5 class="modal-title" id="exampleModalLabel">ADD MEMBERSHIP </h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <div class="modal-body">

        <form action="addmember.php" method="post" enctype="multipart/form-data">

       





  <div class="form-group">

			<label for="email2">Title</label>

			<input type="text" class="form-control" id="email2" name="title" placeholder=""  >

			</div> 

			<div class="form-group">

			<label for="email2"> Amount</label>

			<input type="number" class="form-control" id="email2" name="amount" placeholder=""  >

			</div>

			<div class="form-group">

			<label for="email2">Level 1 commission %</label>

			<input type="number" class="form-control" id="email2" name="level1" placeholder=""  >

			</div>

			<div class="form-group">

			<label for="email2">Level 2 commission %</label>

			<input type="number" class="form-control" id="email2" name="level2" placeholder=""  >

			</div>  

			  <div class="form-group">

			<label for="email2">Membership Valid Upto(Days)</label>

			<input type="number" class="form-control" id="email2" name="days"  >

			</div>  

			 <div class="form-group">

			<label for="email2">description</label>

 			<textarea  class="form-control"   name="desc" rows="5" cols="100"  > </textarea> 

			

			

			</div>  

			



		

		







											

		

		     <div class="form-group">

									<button class="btn btn-success" name="addnew" type="submit" >Add New</button>

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

<script src='https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.0.5/tinymce.min.js'></script>

    <!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script> -->

    <script src="nscript.js"></script>



	<style>

		iframe{

			width: 100px;

			height: 100px;

		}

	</style>

	<script>$('textarea#summernote').summernote({

        placeholder: 'Hello bootstrap 4',

        tabsize: 2,

        height: 100,

  toolbar: [

        ['style', ['style']],

        ['font', ['bold', 'italic', 'underline', 'clear']],

        // ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],

        //['fontname', ['fontname']],

       // ['fontsize', ['fontsize']],

        ['color', ['color']],

        ['para', ['ul', 'ol', 'paragraph']],

        ['height', ['height']],

        ['table', ['table']],

        ['insert', ['link', 'picture', 'hr']],

        //['view', ['fullscreen', 'codeview']],

        ['help', ['help']]

      ],

      });</script>