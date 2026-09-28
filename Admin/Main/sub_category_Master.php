<?php include('../config/setup.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title><?php

			$leename = mysqli_query($config, "select Name,Name_status from lee_master");
			while ($lee = mysqli_fetch_array($leename)) {
				$namestatus = $lee[1];
				if ($namestatus == 1) {
					echo  $lee[0];
				} else {
					echo "Need Name";
				}
			}

			?> </title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="<?php

							$inro_logo = mysqli_query($config, "select Logo_Path,logo_status from lee_master");
							while ($logo = mysqli_fetch_array($inro_logo)) {
								$logstatus = $logo[1];
								if ($logstatus == 1) {

									$ms = substr($logo[0], 3);
									echo  $ms;
								} else {
									echo "../../photos/logo/no_logo.png";
								}
							}

							?>" type="image/x-icon" />

	<!-- Fonts and icons -->
	<script src="../assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {
				"families": ["Lato:300,400,700,900"]
			},
			custom: {
				"families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
				urls: ['../assets/css/fonts.min.css']
			},
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
<style>
/* Toggle switch CSS */
.switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 24px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0; left: 0; right: 0; bottom: 0;
  background-color: #ccc;
  transition: .4s;
  border-radius: 24px;
}

.slider:before {
  position: absolute;
  content: "";
  height: 18px;
  width: 18px;
  left: 3px;
  bottom: 3px;
  background-color: white;
  transition: .4s;
  border-radius: 50%;
}

input:checked + .slider {
  background-color: #4CAF50;  /* Green when ON */
}

input:checked + .slider:before {
  transform: translateX(26px);
}



</style>
<body>
	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
			<?php include('logo.php') ?>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<?php include('topbar.php'); ?>
			<!-- End Navbar -->
		</div>
		<!-- Sidebar -->
		<?php include('sidebar.php'); ?>


		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Sub Category</h4>

					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">

								<div class="card-body">
									<center> <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
											<i class="fas fa-plus"></i> Add New Sub Category
										</button></center>
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover">
											<thead>
												<tr>
													<th>S.No</th>
													<th>Main Category</th>
													<th>Sub Category</th>
													<th>Sub Category image</th>
													<th>Sub Category Addon</th>
													
													<th>Sub Category Status</th>
													<th>Live Mode</th> <!-- New column -->
													<th>Action</th>
												</tr>
											</thead>

											<tbody>
												<?php
												$sc = 1;
												$sub_cate = mysqli_query($config, "select * from sub_category");
												while ($subcate = mysqli_fetch_object($sub_cate)) {
													$Main_id = $subcate->Main_Category;
													$subsmain_cate = mysqli_query($config, "SELECT Main_Category_Name FROM main_category WHERE Main_Category_id='$Main_id'");
													$main_subcatee = mysqli_fetch_object($subsmain_cate);
											
													$mainCatName = $main_subcatee->Main_Category_Name;
											
													// Check if live_mode should be shown only for these categories
													$showLiveToggle = ($mainCatName == "Goods Vehicle" || $mainCatName == "Passenger vehicle");
											
												
												?>


													<tr>
														<td><?php echo $sc; ?></td>
														<td><?php

															$Main_id = $subcate->Main_Category;

															$subsmain_cate = mysqli_query($config, "select Main_Category_Name from main_category where Main_Category_id='$Main_id'");
															$main_subcatee = mysqli_fetch_object($subsmain_cate);


															echo  $main_subcatee->Main_Category_Name;

															?></td>
														<td><?php echo $subcate->Sub_Category_Name; ?></td>
														<td>


															<img src="<?php
																		$cate = $subcate->Sub_Category_image;
																		$ms = substr($cate, 3);
																		echo  $ms;


																		?>" style="
      width: 100px;
    height: 65px;
">
														</td>
														<td><?php $edon = $subcate->Sub_Category_Add_on;

															$sub_cate_date = strtotime($edon);
															echo  date('d-m-Y', $sub_cate_date);

															?>




														</td>
														
														<td><?php

															$enablestatus = $subcate->Sub_Category_Status;

															if ($enablestatus == 1) { ?>
																<label class="btn btn-success">Active</label>
															<?php
															} else {
															?>
																<label class="btn btn-danger">In-Active</label>
															<?php
															}


															?>
														</td>

														<td>
    <?php if ($showLiveToggle) { ?>
        <label class="switch">
            <input 
                type="checkbox" 
                class="live-mode-toggle" 
                data-subcatid="<?php echo $subcate->Sub_Category_id; ?>" 
                <?php echo ($subcate->live_mode == 1) ? 'checked' : ''; ?> 
            />
            <span class="slider"></span>
        </label>
    <?php } else { ?>
        <em></em>
    <?php } ?>
</td>

														<td>
															<a href="" class="btn btn-primary" data-toggle="modal" data-target="#<?php echo $sc; ?>"> <i class="fas fa-pencil-alt"></i> </a>
															<!-- <a href="sub_category_Filter.php?id=<?php echo $sc; ?> " class="btn btn-primary" > <i class="fa fa-filter"></i></a> -->
															<a href="Function/sub_category_delete.php?delcateid=<?php echo $subcate->Sub_Category_id; ?>&delcat=300" class="btn btn-danger" onclick="return confirm('Are you confirm to delete this Sub category?');"> <i class="fas fa-trash"></i> </a>



														</td>

														<!-- Modal -->
														<div class="modal fade" id="<?php echo $sc; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
															<div class="modal-dialog" role="document">
																<div class="modal-content">
																	<div class="modal-header">
																		<h5 class="modal-title" id="exampleModalLabel">Sub Category Edit</h5>
																		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																			<span aria-hidden="true">&times;</span>
																		</button>
																	</div>
																	<div class="modal-body">
																		<form action="Function/Edit_sub_category.php" method="post">
																			<!-- <div class="form-group">
			<label for="email2">Main Category Name</label>
			
			<input type="text" class="form-control" id="email2" name="Edit_sub_cate_name" readonly placeholder="Sub Category Name" value="<?php $Main_id = $subcate->Main_Category;

																																			$subsmain_cate = mysqli_query($config, "select Main_Category_Name from main_category where Main_Category_id='$Main_id'");
																																			$editsubcatee = mysqli_fetch_object($subsmain_cate);


																																			echo  $editsubcatee->Main_Category_Name; ?>">
			</div> -->

																			<div class="form-group">
																				<input type="hidden" class="form-control" id="email2" name="main_cate_id" value="<?php echo $subcate->Sub_Category_id; ?>">
																				<label for="exampleFormControlSelect1">Main Category</label>
																				<select required class="form-control" name="main_category">
																					<option value="">---SELECT---</option>
																					<?php
																					$main_cate = mysqli_query($config, "select * from main_category");
																					while ($addsubcate = mysqli_fetch_object($main_cate)) {
																					?>
																						<option <?php if ($addsubcate->Main_Category_id == $subcate->Main_Category) { ?>selected="selected" <?php } ?> value="<?php echo $addsubcate->Main_Category_id; ?>"><?php echo $addsubcate->Main_Category_Name; ?></option>
																					<?php } ?>
																				</select>

																			</div>



																			<div class="form-group">
																				<label for="email2">Sub Category Name</label>
																				<input type="text" class="form-control" id="email2" name="Edit_sub_cate_name" placeholder="Sub Category Name" value="<?php echo $subcate->Sub_Category_Name; ?>">
																			</div>

																			<div class="form-group">
																				<label for="exampleFormControlSelect1">Sub Category Active Status</label>
																				<select class="form-control" id="exampleFormControlSelect1" name="subcate_status">
																					<?php

																					$enablestatus = $subcate->Sub_Category_Status;

																					if ($enablestatus == 1) { ?>

																						<option value="1" selected>Active</option>
																						<option value="0">In-Active</option>
																					<?php } else if ($enablestatus == 0) { ?>

																						<option value="1">Active</option>
																						<option value="0" selected>In-Active</option>
																					<?php } else { ?>
																						<option value="1">Active</option>
																						<option value="0">In-Active</option>


																					<?php } ?>

																				</select>
																			</div>

																			<div class="form-group">
																				<button class="btn btn-success" type="submit" name="Sub_category_content_edit">Submit</button>
																			</div>


																		</form>


																	</div>

																	<div class="modal-body">
																		<form action="Function/Edit_sub_category.php" method="post" enctype="multipart/form-data">
																			<center>
																				<h4 class="modal-title" id="exampleModalLabel">Change Category Image</h4>
																			</center>

																			<div class="form-group">
																				<label for="email2">Current Image </label>
																				<img src="<?php $cate = $subcate->Sub_Category_image;
																							$ms = substr($cate, 3);
																							echo  $ms;
																							?>" style="
    width: 128px;
    height: 129px;
">
																			</div>




																			<div class="form-group">
																				<label for="email2">Change Image here (Image size W 150px X H 115px )</label>
																				<input type="hidden" class="form-control" id="email2" name="sub_image_cate_id" value="<?php echo $subcate->Sub_Category_id; ?>">

																				<input type="file" class="form-control" id="email2" name="sub_cate_image" placeholder="Main CategoryName">
																			</div>









																			<div class="form-group">
																				<button class="btn btn-warning" type="submit" name="main_category_image_change">Submit</button>
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

												<?php $sc++;
												} ?>

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
							<h5 class="modal-title" id="exampleModalLabel">Add Sub Category</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form action="Function/Add_sub_category.php " method="post" enctype="multipart/form-data">


								<div class="form-group">
									<label for="email2">Main Category Name</label>
									<select class="form-control" name="Add_sub_main_cate_Name">
										<?php

										$main_cate = mysqli_query($config, "select * from main_category where Main_Category_Status=1");
										while ($addsubcate = mysqli_fetch_object($main_cate)) {


										?>

											<option value="<?php echo $addsubcate->Main_Category_id; ?>"><?php echo $addsubcate->Main_Category_Name; ?></option>




										<?php } ?>

									</select>

								</div>



								<div class="form-group">
									<label for="email2">Sub Category Name</label>
									<input type="text" class="form-control" id="email2" name="Add_sub_cate_name" placeholder="Sub Category Name">
								</div>
								<div class="form-group">
									<label for="email2">Sub Category Image (Image size W 150px X H 115px )</label>
									<input type="file" class="form-control" id="email2" name="Add_sub_cate_image">
								</div>

								<div class="form-group">
									<label for="exampleFormControlSelect1">Sub Category Active Status</label>
									<select class="form-control" id="exampleFormControlSelect1" name="Add_sub_category_status">
										<option value="1">Active</option>
										<option value="0">In-Active</option>

									</select>
								</div>

								<div class="form-group">
									<button class="btn btn-success" type="submit" name="sub_category_add">Add New</button>
								</div>


							</form>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

						</div>
					</div>
				</div>
			</div>

			<?php include('footer.php') ?>

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
	<script>
		$(document).ready(function() {
			$('#basic-datatables').DataTable({});




		});

		
	</script>
	<script>
document.querySelectorAll('.live-mode-toggle').forEach(function(toggle) {
    toggle.addEventListener('change', function() {
        const subCatId = this.dataset.subcatid;
        const isEnabled = this.checked;
        const confirmMsg = isEnabled 
            ? "Are you sure you want to ENABLE live mode for this subcategory?" 
            : "Are you sure you want to DISABLE live mode for this subcategory?";

        if (!confirm(confirmMsg)) {
            // Revert toggle if user cancels
            this.checked = !isEnabled;
            return;
        }

        // Send AJAX to update live_mode in the DB
        fetch('update_live_mode.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: `sub_category_id=${subCatId}&live_mode=${isEnabled ? 1 : 0}`
        })
        .then(response => response.text())
        .then(data => {
            if(data.trim() !== 'success') {
                alert('Failed to update live mode. Please try again.');
                this.checked = !isEnabled; // revert toggle on failure
            }
        })
        .catch(() => {
            alert('Error updating live mode. Please check your connection.');
            this.checked = !isEnabled; // revert toggle on failure
        });
    });
});
</script>

</body>

</html>