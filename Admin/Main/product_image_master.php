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
	<script src="../assets/angular/angular.min.js"></script> 

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
						<h4 class="page-title">Product Gallery Master</h4>
						 
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								
								<div class="card-body">
								<center> <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fas fa-plus"></i>   Add New Product Gallery
</button></center>
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>S.No</th>
													<th>Product Name</th>
												 <th>Product Photo </th>
												 <th>Product Status </th>
													<th>Action</th>
												</tr>
											</thead>
											 
											<tbody>
											<?php 
											$pro=1;
											$pro_photo=mysqli_query($config,"select * from product_image_master");
											while($propt=mysqli_fetch_object($pro_photo))
											{
											?>
												
												
												<tr>
													<td><?php echo $pro;?></td>
													 
													<td><?php 

												$Main_id=$propt->Product_id;
												
												$photo_pro_name=mysqli_query($config,"select Product_Name from product_master where Product_id='$Main_id'");
											 $pro_name=mysqli_fetch_object($photo_pro_name);
												
												
												echo  $pro_name->Product_Name;
												
												?>
													</td>
 
														<td><img src="<?php 
													$cate=$propt->Product_image;
   $ms=substr($cate,3);
				  echo  $ms;


													   ?>" style="
      width: 180px;
    height: 102px;
"> </td>
 													


 
													
													
													
													<td><?php 

													$enablestatus=$propt->Product_image_status;
													
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
<a href="" class="btn btn-primary" data-toggle="modal" data-target="#<?php echo $pro;?>"> <i class="fas fa-pencil-alt"></i>  </a>
<a href="Function/product_delete.php?delproid=<?php echo $propt->product_image_id;?>&delprocat=801" class="btn btn-danger" onclick="return confirm('Are you confirm to delete this Product Photo?');"> <i class="fas fa-trash"></i>  </a>

 

</td>

<!-- Modal -->
<div class="modal fade" id="<?php echo $pro;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Product Image Edit  </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form action="Function/product_edit.php" method="post">
        <div class="form-group">
			<label for="email2">Product Name</label>
			<input type="hidden" class="form-control" id="email2" name="Edit_pro_gall_id"  value="<?php echo $propt->product_image_id;?>">
			
		
		
		
		
<?php   $prid = $propt->Product_id;?>												
<select class="form-control"  name="Edit_pro_img_name" >
			<?php
			
			$catesub=mysqli_query($config,"select * from product_master");
			while($cateesub = mysqli_fetch_object($catesub))
												
											
											{
		
			
			?>
			
			
			<option value="<?php echo $cateesub->Product_id; ?>" <?php if ($prid == $cateesub->Product_id) { echo 'selected'; } ?> ><?php echo   $cateesub->Product_Name;?></option>
			
			
			
			
			
											<?php } ?>
			
			</select>												
					
		
		
		
		
		
		
		
		
		
		
		
		
		
			</div>     
			










		
			 
			   <div class="form-group">
												<label for="exampleFormControlSelect1">Product Image Active Status</label>
												<select class="form-control" id="exampleFormControlSelect1" name="pro_gall_status">
												<?php 

													$cate_enablestatus=$propt->Product_image_status;
													
													if($cate_enablestatus == 1)
													{ ?>
												
													<option value="1" selected>Active</option>
													<option value="0">In-Active</option>
													<?php }else if($cate_enablestatus == 0){?>

														<option value="1" >Active</option>
													<option value="0" selected>In-Active</option>
													<?php }else{ ?>
													<option value="1" >Active</option>
													<option value="0" >In-Active</option>
													
													
													<?php } ?>
												
												</select>
											</div>			
		
		
		
		
		
		
		
		
		
		
		     <div class="form-group">
									<button class="btn btn-success" type="submit" name="product_gall_edit">Submit</button>
 								</div>
			
			
			</form>
			
			
      </div>
	  
	  
	  
	  
	  
	  
	  
	  <div class="modal-body">
	  <form action="Function/product_edit.php" method="post" enctype="multipart/form-data" >
	 <center>  <h4 class="modal-title" id="exampleModalLabel">Change Category Image</h4></center> 
       
<div class="form-group">
<label for="email2">Current Image </label>
<img src="<?php 													$cate=$propt->Product_image;
   $ms=substr($cate,3);
				  echo  $ms;
?>" style="
    width: 128px;
    height: 129px;
">
</div>




	   <div class="form-group">
			<label for="email2">Change  Image here (Image size 380px X 257px )</label>
						<input type="hidden" class="form-control" id="email2" name="sub_image_cate_id"  value="<?php echo $propt->product_image_id;?>">

			<input type="file" class="form-control" id="email2" name="sub_cate_image" placeholder="Main CategoryName" >
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
												
											<?php $pro++;} ?>
												
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
        <h5 class="modal-title" id="exampleModalLabel">Add New Product Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
	  
        <form action="Function/product_multiple_image_Add.php " method="post" enctype="multipart/form-data" name="upload_form" id="upload_form"   >
         
<div class="form-group">
	<label for="email2">Product Name</label>
<select class="form-control" name="Add_pro_img_id[]">
			<?php
			
			$pro_name_=mysqli_query($config,"select * from product_master where Product_Active_Status=1");
											while($add_pro=mysqli_fetch_object($pro_name_))
											{
			
			
			?>
			
			<option value="<?php echo $add_pro->Product_id;?>"><?php echo $add_pro->Product_Name;?></option>
			
			
			
			
											<?php } ?>
			
			</select>
			</div> 
			 

	<div class="form-group">
			<label for="email2">Product Image (size 380px X 257px)</label>
			<input type="file" name="upload_images[]" id="image_file"  class="form-control"  multiple>
			  
			</div>
	 		
		
		     <div class="form-group">
									<button class="btn btn-success" type="submit" name="product_image_add">Submit</button>
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
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
 $(document).ready(function(){
    $('#image_file').on('change',function(){
        $('#upload_form').ajaxForm({           
            target:'#uploaded_images_preview',
            beforeSubmit:function(e){
                $('.file_uploading').show();
            },
            success:function(e){
                $('.file_uploading').hide();
            },
            error:function(e){
            }
        }).submit();
    });
});  </script>
</body>
</html>