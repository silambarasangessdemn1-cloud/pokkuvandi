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
						<h4 class="page-title">Product Price Master</h4>
						 
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								
								<div class="card-body">
								<center> <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fas fa-plus"></i>   Add New Product Price
</button></center>
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>S.No</th>
													<th> Product Name</th>
													<th> Product Type</th>
													 
													<th> Product Price</th>
													<th> Shelling Price</th>
													<th> Offer Percent</th>
													 
													 <th>  Status</th>
													<th>Action</th>
												</tr>
											</thead>
											 
											<tbody>
											<?php 
											$pp=1;
											$prod_price=mysqli_query($config,"select * from product_price_master");
											while($pprice=mysqli_fetch_object($prod_price))
											{
											?>
												
												
												<tr>
													<td><?php echo $pp;?></td>
													<td><?php 

												$Main_id=$pprice->Product_id;
												
												$photo_pro_name=mysqli_query($config,"select Product_Name from product_master where Product_id='$Main_id'");
											 $pro_name=mysqli_fetch_object($photo_pro_name);
												
												
												echo  $pro_name->Product_Name;
												
												?></td>
		 
												<td><?php echo $pprice->Product_Type_number;?> <?php echo $pprice->Product_type;?></td>	 
												<td><?php echo $pprice->Product_price;?> </td>	 
												<td><?php echo $pprice->Shelling_price;?> </td>	 
												<td><?php echo $pprice->Offer_Percent;?> </td>	 
												 	 
													
													
													
													
													<td><?php 

													$enablestatus=$pprice->Product_status;
													
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
<a href="" class="btn btn-primary" data-toggle="modal" data-target="#<?php echo $pp;?>"> <i class="fas fa-pencil-alt"></i>  </a>
<a href="Function/product_price_delete.php?delptypeid=<?php echo $pprice->Product_price_id;?>&delpt=901" class="btn btn-danger" onclick="return confirm('Are you confirm to delete this Product price ?');"> <i class="fas fa-trash"></i>  </a>

 

</td>

<!-- Modal -->
<div class="modal fade" id="<?php echo $pp;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit  Product Price</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form action="Function/product_price_edit.php" method="post">
        <div class="form-group">
			<label for="email2">Product Name</label>
			<input type="hidden" class="form-control" id="email2" name="productprice_id"  value="<?php echo $pprice->Product_price_id;?>">
			
			<input type="hidden" class="form-control" id="email2" name="Edit_pro_id"  value="<?php echo $pprice->Product_price_id;?>">
			
<input type="text" class="form-control" id="email2" name="Edit_pro_name" readonly placeholder="Product Name" value="<?php $Main_id=$pprice->Product_id;
												
												$subsmain_cate=mysqli_query($config,"select Product_Name from product_master where Product_id='$Main_id'");
											 $editsubcatee=mysqli_fetch_object($subsmain_cate);
												
												
												echo  $editsubcatee->Product_Name;?>">			</div>
        
	<div class="form-group">
			<label for="email2">Product Quantity and Type</label>
			<input type="text" class="form-control" id="email2"  name="Edit_sub_cate_name" placeholder="Sub Category Name" readonly value="<?php echo $pprice->Product_Type_number;?><?php echo $pprice->Product_type;?>">
			</div>	
			
			<div class="form-group">
			<label for="email2">Product Price</label>
			<input type="number" class="form-control" id="email2" name="Edit_pro_price" placeholder="Product Price"   value="<?php echo $pprice->Product_price;?>">
			</div>
	 	 <div class="form-group">
			<label for="email2">Shelling Price</label>
			<input type="number" class="form-control" id="email2" name="Edit_shell_pro_price" placeholder="Product Shellng Price"   value="<?php echo $pprice->Shelling_price;?>">
			</div>
	 	 

<div class="form-group">
												<label for="exampleFormControlSelect1">Product Price Status</label>
												<select class="form-control" id="exampleFormControlSelect1" name="productprice_status">
												<?php 

													$enablestatus=$pprice->Product_status;
													
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
									<button class="btn btn-success" type="submit" name="product_price_edit">Submit</button>
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
												
											<?php $pp++;} ?>
												
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
        <h5 class="modal-title" id="exampleModalLabel">Add Produc Price</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="Function/Add_product_price.php" method="post" enctype="multipart/form-data">
       
<div class="form-group">
	<label for="email2">Product Name</label>
<select class="form-control" name="Add_pro_name">
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
			<label for="email2">Product Type</label>
<select class="form-control" name="Add_pro_type">
			<?php
			
			$pro_type_=mysqli_query($config,"select * from product_type where Product_type_status=1");
											while($ptype=mysqli_fetch_object($pro_type_))
											{
			
			
			?>
			
			<option value="<?php echo $ptype->Product_type;?>"><?php echo $ptype->Product_type;?></option>
			
			
			
			
											<?php } ?>
			
			</select>			</div>  
			 
		
	   <div class="form-group">
			<label for="email2">Product Type Quantity (like 500,1,....)</label>
			<input type="number" class="form-control" id="email2" name="Add_pro_type_quant" placeholder="Product Type Quantity (like 500,1,....)"  >
			</div>   <div class="form-group">
			<label for="email2">Product Price</label>
			<input type="number" class="form-control" id="email2" name="Add_pro_price" placeholder="Product Price"  >
			</div>   
			<div class="form-group">
			<label for="email2">Shelling Price</label>
			<input type="number" class="form-control" id="email2" name="Add_pro_shelling_price" placeholder="Product Shelling Price"  >
			</div>  




		<div class="form-group">
		<label for="exampleFormControlSelect1">Product Price Status</label>
		<select class="form-control" id="exampleFormControlSelect1" name="Add_product_price_status">
		<option value="1">Active</option>
		<option value="0">In-Active</option>
		
		</select>
											</div>			
		
		     <div class="form-group">
									<button class="btn btn-success" type="submit" name="product_price_add">Add New</button>
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