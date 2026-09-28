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
		 <?php include('logo.php')?>
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
						<h4 class="page-title">Vehicle Type</h4>
						 
					</div>
					<div class="row">
						<div class="col-md-12"> 
							<div class="card">
								
								<div class="card-body">
								<center> <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fas fa-plus"></i>   Add New Vehicle Type
								</button></center>
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>S.No</th>
													<th>Sub Category</th>
													<th>Vehicle Type</th>
													<th>Vehicle Type Addon</th>
													 <th>Status</th>
													<th>Action</th>
												</tr>
											</thead>
											 
											<tbody>
											<?php 
											$sc=1;
											$sub_cate=mysqli_query($config,"select * from vehicle_type");
											while($subcate=mysqli_fetch_object($sub_cate))
											{
											?>
												
												
												<tr>
													<td><?php echo $sc;?></td>
													
													<td><?php 

$sub_category_id=$subcate->sub_category_id;

$subsmain_cate=mysqli_query($config,"select *from sub_category where sub_category_id='$sub_category_id'");
$main_subcatee=mysqli_fetch_object($subsmain_cate);


echo  $main_subcatee->Sub_Category_Name;

?></td><td><?php echo $subcate->Vehicle_type_name;?></td>
									<td><?php $edon= $subcate->create_on;
													
													$sub_cate_date = strtotime($edon);
			  echo  date('d-m-Y',$sub_cate_date);
													
													?>
													
													
													
													
													</td>
													
													<td><?php 

													$enablestatus=$subcate->status;
													
													if($enablestatus== 1)
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
<a href="" class="btn btn-primary" data-toggle="modal" data-target="#<?php echo $sc;?>"> <i class="fas fa-pencil-alt"></i>  </a>
<!-- <a href="sub_category_Filter.php?id=<?php echo $sc;?> " class="btn btn-primary" > <i class="fa fa-filter"></i></a> -->
<a href="Function/vehicle_type_delete.php?delcateid=<?php echo $subcate->Vehicle_type_id;?>&delcat=300" class="btn btn-danger" onclick="return confirm('Are you confirm to delete this Vehicle Type?');"> <i class="fas fa-trash"></i>  </a>

 

</td>

<!-- Modal -->
<div class="modal fade" id="<?php echo $sc;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Vehicle Type Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form action="Function/Edit_vehicle_type.php" method="post">
	  <div class="form-group">
		
			<input type="hidden" class="form-control" id="email2" name="vehicle_type_id"  value="<?php echo $subcate->Vehicle_type_id ;?>">
			
			</div>
        


	<div class="form-group">
			<label for="email2">Vehicle Type Name</label>
			<input type="text" class="form-control" id="email2" name="Edit_vehicle_name" placeholder="Sub Category Name" value="<?php echo $subcate->Vehicle_type_name;?>">
			</div>








		<div class="form-group">
												<label for="exampleFormControlSelect1"> Status</label>
												<select class="form-control" id="exampleFormControlSelect1" name="status">
												<?php 

													$enablestatus=$subcate->status;
													
													if($enablestatus == 1)
													{ ?>
												
													<option value="1" selected>Active</option>
													<option value="0">In-Active</option>
													<?php }else if($enablestatus == 0){?>

														<option value="1" >Active</option>
													<option value="0" selected>In-Active</option>
													<?php }else{ ?>
													<option value="1" >Active</option>
													<option value="0" >In-Active</option>
													
													
													<?php } ?>
												
												</select>
											</div>			
		
		     <div class="form-group">
									<button class="btn btn-success" type="submit" name="vehicle_type_edit">Submit</button>
 								</div>
			
			
	 </form>
			
			
      </div>
	 
	  <div class="modal-body">
	  	
			
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         
      </div>
    </div>
  </div>
</div>
													
													 
												</tr>
												
											<?php $sc++;} ?>
												
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
	  <form action="Function/Add_vehicle_type.php " method="post" enctype="multipart/form-data">
       

	   <div class="form-group">
				 <label for="email2">Sub Category Name</label>
				 <select class="form-control" name="Add_sub_cate_Name">
				 <?php
				 
				 $main_cate=mysqli_query($config,"select * from sub_category where Sub_Category_Status=1");
												 while($addsubcate=mysqli_fetch_object($main_cate))
												 {
				 
				 
				 ?>
				 
				 <option value="<?php echo $addsubcate->Sub_Category_id;?>"><?php echo $addsubcate->Sub_Category_Name;?></option>
				 
				 
				 
				 
												 <?php } ?>
				 
				 </select>
				  
				 </div> 
	 
	 
	 
			<div class="form-group">
				 <label for="email2">Vehicle Type Name</label>
				 <input type="text" class="form-control" id="email2" name="vehicle_type_name" placeholder="Vehicle Type Name"  >
				 </div>  
				 
			
			  <div class="form-group">
			 <label for="exampleFormControlSelect1"> Status</label>
			 <select class="form-control" id="exampleFormControlSelect1" name="status">
			 <option value="1">Active</option>
			 <option value="0">In-Active</option>
			 
			 </select>
												 </div>			
			 
				  <div class="form-group">
										 <button class="btn btn-success" type="submit" name="vehicle_type_add">Add New</button>
									  </div>
				 
				 
				 </form>
	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
			
			
			
			
			
			
			
			
		<?php include('footer.php')?>	
			
			
			
			 
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