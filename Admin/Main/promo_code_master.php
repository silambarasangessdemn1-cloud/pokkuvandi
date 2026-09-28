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
						<h4 class="page-title">Promo Code Master</h4>
						 
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								
								<div class="card-body">
								<center> <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fas fa-plus"></i>   Add New PromoCode
</button></center>
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>S.No</th>
													<th>PromoCode</th>
													<th>Product Name</th>
													<th>Product Discount</th>
													<th>Promocode valid Upto</th>
													<th>Promo Poster</th>
													 
												 
													 <th>Status</th>
													<th>Action</th>
												</tr>
											</thead>
											 
											<tbody>
											<?php 
											$mc=1;
											$main_cate=mysqli_query($config,"select * from promo_code_master");
											while($macate=mysqli_fetch_object($main_cate))
											{
											?>
												
												
												<tr>
													<td><?php echo $mc;?></td>
													<td><?php echo $macate->Promo_code;?></td>
													<td><?php 
												$Main_id=$macate->Product_id;
												if($Main_id == 0)
												{
													echo "Common Promocode";
													
												}else{
												$subsmain_cate=mysqli_query($config,"select Product_Name from product_master where Product_id='$Main_id'");
											 $subcatee=mysqli_fetch_object($subsmain_cate);
												
												
												echo  $subcatee->Product_Name;
												}
												?>
													
													
													</td>
													 
													<td><?php echo $macate->Offer_Percent;?>%</td> 
													<td><?php 
													
													
														$main_cate_date = strtotime($macate->Promo_code_valid_upto);
			  echo  date('d-m-Y',$main_cate_date);
												
													
													
													?></td> 
													
													
													<td>
													
												<img src="<?php 
													$cate=$macate->Offer_Poster;
   $ms=substr($cate,3);
				  echo  $ms;


													   ?>" style="
      width: 100px;
    height: 65px;
">	
													
													
													
													
													
													
													</td> 
												 
													 
		 
													 
													<td><?php 

													$enablestatus=$macate->Promo_code_Active_Status;
													
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
<a href="" class="btn btn-primary" data-toggle="modal" data-target="#<?php echo $mc;?>"> <i class="fas fa-pencil-alt"></i>  </a>
<a href="Function/promo_delete.php?delpormid=<?php echo $macate->Promo_id;?>&delpr=700" class="btn btn-danger" onclick="return confirm('Are you confirm to delete this Promocode?');"> <i class="fas fa-trash"></i>  </a>

 

</td>

<!-- Modal -->
<div class="modal fade" id="<?php echo $mc;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Promo code Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form action="Function/Edit_promo_code.php" method="post">
        <div class="form-group">
			<label for="email2">Offer Product</label>
			<input type="hidden" class="form-control" id="email2" name="offer_pro_id"  value="<?php echo $macate->Promo_id;?>">
			<input type="text" class="form-control" id="email2" name="offer_product_name" readonly placeholder="Main CategoryName" value="<?php    
			 
			if($macate->Product_id == 0)
			{
				echo 0;
			}else{
			$pro_name_=mysqli_query($config,"select * from product_master where Product_id='".$macate->Product_id."' ");
										$add_pro=mysqli_fetch_object($pro_name_);
										
			
			echo $add_pro->Product_Name;
		 
			
			
			
			}	
			?>">
		

		</div>
           <div class="form-group">
			<label for="email2">Promo code</label>
			<input type="text" class="form-control" id="email2" name="Edit_Promocode"  value="<?php echo $macate->Promo_code;?>">
			 
		

		</div> 
		<div class="form-group">
			<label for="email2">Promo Offer Percent</label>
			<input type="number" class="form-control" id="email2" name="Edit_promo_percent"  value="<?php echo $macate->Offer_Percent;?>">
			 
		

		</div>	<div class="form-group">
			<label for="email2">Promocode Validity</label>
			<input type="date" class="form-control" id="email2" name="Edit_promo_validity"  value="<?php echo $macate->Promo_code_valid_upto;?>">
			 
		

		</div>	<div class="form-group">
			<label for="email2">PromoCode  Highlights</label>
 			<textarea  class="form-control"   name="Edit_offer_Highlights" rows="5" cols="100"  ><?php echo $macate->Offer_Highlights;?></textarea> 
		

		</div><div class="form-group">
			<label for="email2">PromoCode  Terms and Condition </br>( b -  use for bold and /br - space for new line)</label>
 			<textarea  class="form-control"   name="Edit_offer_tc" rows="9" cols="100"  ><?php echo $macate->Terms_and_Conditions;?></textarea> 
		

		</div>

		  
		  <div class="form-group">
	<label for="exampleFormControlSelect1">Product Offer Status</label>
												<select class="form-control" id="exampleFormControlSelect1" name="Edit_promo_status">
												<?php 

													$enablestatus=$macate->Promo_code_Active_Status;
													
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
									<button class="btn btn-success" type="submit" name="promo_code_edit">Submit</button>
 								</div>
			
			
			</form>
			
			
      </div>
 
 
 	  <div class="modal-body">
	  <form action="Function/Edit_promo_code.php" method="post" enctype="multipart/form-data" >
	 <center>  <h4 class="modal-title" id="exampleModalLabel">Promocode Banner Change</h4></center> 
       
<div class="form-group">
<label for="email2">Current Image </label>
<img src="<?php 													$cate=$macate->Offer_Poster;
   $ms=substr($cate,3);
				  echo  $ms;
?>" style="
    width: 128px;
    height: 129px;
">
</div>




	   <div class="form-group">
			<label for="email2">PromoCode Banner size(273px X 180px)</label>
						<input type="hidden" class="form-control" id="email2" name="sub_image_cate_id"  value="<?php echo $macate->Promo_id;?>">

			<input type="file" class="form-control" id="email2" name="promo_image" placeholder="Main CategoryName" >
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
        <h5 class="modal-title" id="exampleModalLabel">Add Promo Code </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="Function/add_new_promo.php" method="post" enctype="multipart/form-data">
       
<div class="form-group">
	<label for="email2">Product Name</label>
<select class="form-control" name="Add_offer_pro_name">
<option value="0">Avalible to All</option>
			
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
			<label for="email2">PromoCode</label>
			<input type="text" class="form-control" id="email2" name="Add_promo_code" placeholder="Enter Product New PromoCode"  value="<?php 
			
			$chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$res = "LEE".date('i');
for ($i = 0; $i < 2; $i++) {
   echo $res .= $chars[mt_rand(0, strlen($chars)-1)];
}
			
			?>" >
			</div> 
			<div class="form-group">
			<label for="email2">Offer Percent</label>
			<input type="number" class="form-control" id="email2" name="Add_offer_percent" placeholder="Enter Product offer Percent"  >
			</div>  
			  <div class="form-group">
			<label for="email2">PromoCode Valid Upto</label>
			<input type="date" class="form-control" id="email2" name="Add_offer_valid_upto" placeholder="Enter Product offer valid"  >
			</div>  
			 <div class="form-group">
			<label for="email2">PromoCode Highlights &nbsp; (Avoid this symbol ( ' ))</label>
 			<textarea  class="form-control"   name="Add_offer_Highlights" rows="5" cols="100"  > </textarea> 
			
			
			</div>   
			  <div class="form-group">
			<label for="email2">PromoCode Terms and Condition &nbsp; (Avoid this symbol ( ' ))</br>( < b > </ b > -  use for bold and < /br > - space for new line)</label>
 			<textarea  class="form-control"   name="Add_offer_tc" rows="5" cols="100"  > </textarea> 
			
			
			</div> 	  
			
			
			<div class="form-group">
			<label for="email2">PromoCode Banner size(273px X 180px)</label>
 			
					<input type="file" class="form-control" id="email2" name="Add_promo_banner" placeholder="Enter Product offer Percent"  >
	
			</div>   
			 
			 
			 
			 
			 
			 
			 
		 <div class="form-group">
		<label for="exampleFormControlSelect1">Promocode Status</label>
		<select class="form-control" id="exampleFormControlSelect1" name="Add_offer_status">
		<option value="1">Active</option>
		<option value="0">In-Active</option>
		
		</select>
											</div>		


											<div class="form-group">
		<label for="exampleFormControlSelect1">Promocode Background Color</label>
		<select class="form-control" id="exampleFormControlSelect1" name="Add_promo_bground">
		<option value="bg-success">Green</option>
		<option value="bg-warning">Yellow</option>
		<option value="bg-primary">Blue</option>
		<option value="bg-danger">Red</option>
		
		</select>
											</div>			
		
		     <div class="form-group">
									<button class="btn btn-success" type="submit" name="promo_product_add">Add New</button>
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