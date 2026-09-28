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
            
            ?>   </title>
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
						<h4 class="page-title">Product Master</h4>
						 
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								
								<div class="card-body">
								<center> <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fas fa-plus"></i>   Add New Product
</button></center>
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>S.No</th>
													<th>Product Name</th>
													<th>Category </th>
													<th> Sub Category </th>
												 	<th>Product tax</th>

													<th>Avalible Stocks </th>
													
													 
													  
													<th> Offer Status</th>
													<th> Active Status</th>
													<th>Product Photo </th>
													<th>Action</th>
												</tr>
											</thead>
											 
											<tbody>
											<?php 
											$sub=1;
											$sub_cate=mysqli_query($config,"select * from product_master");
											while($subcate=mysqli_fetch_object($sub_cate))
											{
											?>
												
												
												<tr>
													<td><?php echo $sub;?></td>
													<td><?php echo $subcate->Product_Name;?></td>

													<td><?php 

												$Main_id=$subcate->Main_Category;
												
												$subsmain_cate=mysqli_query($config,"select Main_Category_Name from main_category where Main_Category_id='$Main_id'");
											 $subcatee=mysqli_fetch_object($subsmain_cate);
												
												
												echo  $subcatee->Main_Category_Name;
												
												?>
													</td>
													
													<td> 
													
													<?php 

												  $subid=$subcate->Sub_Categoryid;
												
												$catesubs=mysqli_query($config,"select Sub_Category_Name from sub_category where Sub_Category_id='$subid'");
											 $catsub=mysqli_fetch_object($catesubs);
												
												
												echo  $catsub->Sub_Category_Name;
												
												?>
													</td>
				 

  <td><?php echo $subcate->product_tax;?></td>
  
  <td><?php echo $subcate->Product_Avalible_Stocks;?></td>
 													




													<td><?php 

													$enablepr=$subcate->Product_offer;
													
													if($enablepr== 1)
													{ ?>
												<a href="offer_Master.php"><label class="btn btn-success">Yes  </label></a>
												
													
<?php														
													}else{
														?>
														<label class="btn btn-danger">No</label>
														<?php
													}
													
													
													?></td>
													
													
													
													
													<td><?php 

													$enablestatus=$subcate->Product_Active_Status;
													
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
													
<td><?php $pro_img = $subcate->Product_id;


	$propho=mysqli_query($config,"select * from product_image_master where Product_id='$pro_img'");
	$propoto = mysqli_fetch_array($propho);
	if(!$propoto)
	{ ?>
	<a href="product_image_master.php" class="btn btn-success" > <i class="fas fa-plus"></i>  </a>
	
<?php	}else{		
?>
	<a href="product_image_master.php" class="btn btn-warning" > <i class="fas fa-edit"></i>  </a>

<?php }?>


 





</td>
													
													
													
													
													
													
													<td>
<a href="" class="btn btn-primary" data-toggle="modal" data-target="#<?php echo $sub;?>"> <i class="fas fa-pencil-alt"></i>  </a>
<a href="Function/product_master_delete.php?delproid=<?php echo $subcate->Product_id;?>&delprocat=900" class="btn btn-danger" onclick="return confirm('Are you confirm to delete this Product?');"> <i class="fas fa-trash"></i>  </a>

 

</td>

<!-- Modal -->
<div class="modal fade" id="<?php echo $sub;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sub Category Edit  </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form action="Function/Edit_pro_Master.php" method="post">
        <div class="form-group">
			<label for="email2">Product Name</label>
			<input type="hidden" class="form-control" id="email2" name="Edit_pro_id"  value="<?php echo $subcate->Product_id;?>">
			<input type="text" class="form-control" id="email2" name="Edit_pro_name"  value="<?php echo $subcate->Product_Name;?>">
				
			</div>     
			<div class="form-group">
			<label for="email2">Main Category Name</label>
 		
			
				<?php  $Main_id=$subcate->Main_Category;	?>
		<select class="form-control"  name="Edit_pro_cate_name" >
			<?php
			
			$subsmain_cate=mysqli_query($config,"select Main_Category_id,Main_Category_Name from main_category");
			while($subcatee = mysqli_fetch_object($subsmain_cate))
												
											
											{
			
			
			?>
			
			
			<option value="<?php echo $subcatee->Main_Category_id; ?>" <?php if ($Main_id == $subcatee->Main_Category_id) { echo 'selected'; } ?> ><?php echo  $subcatee->Main_Category_Name;?></option>
			
			
			
			
			
											<?php } ?>
			
			</select>
			
			
			
			</div>
<div class="form-group">
			<label for="email2">Sub Category Name</label>
 			
			<?php  $sub_id = $subcate->Sub_Categoryid;	?>
		<select class="form-control"  name="Edit_pro_sub_cate_name" >
			<?php
			
			$catesub=mysqli_query($config,"select * from sub_category");
			while($cateesub = mysqli_fetch_object($catesub))
												
											
											{
			echo $cateesub->Sub_Category_id;
			
			?>
			
			
			<option value="<?php echo $cateesub->Sub_Category_id; ?>" <?php if ($sub_id == $cateesub->Sub_Category_id) { echo 'selected'; } ?> ><?php echo  $cateesub->Sub_Category_Name;?></option>
			
			
			
			
			
											<?php } ?>
			
			</select>
	
	
	
	
	
	
			</div>

			
			 
					
			<div class="form-group">
			<label for="email2">Product Stocks</label>
			<input type="number" class="form-control" id="email2" name="Edit_pro_stock" placeholder="Sub Category Price Pre Kg " value="<?php echo $subcate->Product_Avalible_Stocks;?>">
			</div>
			
		 
			 
				<div class="form-group">
			<label for="email2">Product Offer Setting </label>
			
				<select class="form-control" id="exampleFormControlSelect1" name="Edit_pro_cate_offer">
												<?php 

													$enablestatus=$subcate->Product_offer;
													
													if($enablestatus == 1)
													{ ?>
												
													<option value="1" selected>Yes</option>
													<option value="0">No</option>
													<?php }else if($enablestatus == 0){?>

														<option value="1" >Yes</option>
													<option value="0" selected>No</option>
													<?php }else{ ?>
													<option value="1" >Yes</option>
													<option value="0" >No</option>
													
													
													<?php } ?>
												
												</select>
			
			
			
 			</div>
			   <div class="form-group">
												<label for="exampleFormControlSelect1">Product Active Status</label>
												<select class="form-control" id="exampleFormControlSelect1" name="pro_status">
												<?php 

													$cate_enablestatus=$subcate->Product_Active_Status;
													
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
			<label for="email2">Product Description  </label>
							<textarea  class="form-control"   name="pro_desc" rows="10" cols="200"  ><?php echo $subcate->Product_description;?> </textarea> 
			</div>	
			<div class="form-group mob">
			<label for="email2">Youtube Video</label><br>
			<?php echo $subcate->youtube;?>
			</div>	
			<div class="form-group">
			<label for="email2">Youtube  Iframe Link</label>
			<input type="text" class="form-control" id="email2" name="youtube" placeholder=""  >
			</div>
		 
		<div class="form-group">
			<label for="email2">Product tax</label>
			<?php $id = $subcate->product_tax;?>
			<select class="form-control" name="edit_pro_tax">
			<?php
			
			$pro_name_=mysqli_query($config,"select * from tax_master where Tax_status=1 ");
											while($add_pro=mysqli_fetch_object($pro_name_))
											{
			
			
			?>
			
			
			<option value="<?php echo $add_pro->Tax; ?>" <?php if ($id == $add_pro->Tax) { echo 'selected'; } ?> ><?php echo $add_pro->Tax;?>%</option>
			
			
			
			
			
											<?php } ?>
			
			</select>	
			
			
			
			
			</div>
		
		
		
		
		
		
		
		     <div class="form-group">
									<button class="btn btn-success" type="submit" name="product_edit">Submit</button>
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
												
											<?php $sub++;} ?>
												
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
        <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
	  <div ng-app="myproduct" ng-controller="productcontroller" ng-init="loadid()">
        <form action="Function/Add_product.php " method="post" enctype="multipart/form-data">
         	
			 <div class="form-group">
                <label for="inputStatus"> Category </label>
                <select class="form-control" ng-model="ctid" name="product_cate" ng-change="loadsub()"  >
              <option>Select Product Category</option>
               <option ng-repeat="ca in cateid" value="{{ca.Main_Category_id}}">{{ca.Main_Category_Name}}</option>
                </select>
              </div> 
			  
			  
				 <div class="form-group">
                <label for="inputStatus"> Sub Category </label>
                <select class="form-control"  name="product_sub_cate"  >
                <option>Select Product Sub Category</option>
               <option ng-repeat="su in subna" value="{{su.Sub_Category_id}}">{{su.Sub_Category_Name}}</option>
                </select>
              </div> 
			
			
			
			
			  

<div class="form-group">
	<label for="email2">Product Name</label>
<input type="text" class="form-control" id="email2" name="Add_pro_name" placeholder="Enter Product Name"  >

			</div> 
			
 
			
			  

 
	<div class="form-group">
			<label for="email2">  Avalible Stocks</label>
			<input type="number" class="form-control" id="email2" name="Add_pro_stocks" placeholder="Product Avalible Stocks"  >
			</div>
			
	<div class="form-group">
			<label for="email2">Product tax</label>
			
			<select class="form-control" name="Add_pro_tax">
			<?php
			
			$pro_name_=mysqli_query($config,"select * from tax_master where Tax_status=1");
											while($add_pro=mysqli_fetch_object($pro_name_))
											{
			
			
			?>
			
			<option value="<?php echo $add_pro->Tax;?>"><?php echo $add_pro->Tax;?>%</option>
			
			
			
			
											<?php } ?>
			
			</select>	
			
			
			
			
			</div>
			
			
			
			
			
			
			
       
			<div class="form-group">
			<label for="email2">Product Description ( Avoid this symbol(') )</label>
		
<textarea class="form-control" rows="3" cols="30" name="Add_pro_desc"></textarea>


		</div>
		<div class="form-group mob">
			<label for="email2">Youtube  Iframe Link</label>
			<input type="text" class="form-control" id="email2" name="youtube" placeholder=""  >
			</div>
			
	   
	   
	   	<div class="form-group">
			<label for="email2">Product Have Any Offer</label>
 			<select class="form-control" id="exampleFormControlSelect1" name="Add_pro_offer">
		<option value="0">No</option>
		
		<option value="1">Yes</option>
	
		</select>
			
			
			
			</div>
       
	   
		 <div class="form-group">
		<label for="exampleFormControlSelect1">Product Active Status</label>
		<select class="form-control" id="exampleFormControlSelect1" name="Add_pro_status">
		<option value="1">Active</option>
		<option value="0">In-Active</option>
		
		</select>
											</div>			
		
		     <div class="form-group">
									<button class="btn btn-success" type="submit" name="product_add">Submit</button>
 								</div>	</div>
			
			
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
		<script src='https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.0.5/tinymce.min.js'></script>



    <!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script> -->



    <script src="nscript.js"></script>



		 
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
	<script>
var app = angular.module("myproduct",[]);  


 app.controller("productcontroller", function($scope, $http){  
$scope.loadid = function()
{
  $http.get("Function/Product_catergory.php")  
           .success(function(data){  
                $scope.cateid = data;  
           }); 
 
 }  

 $scope.loadsub = function(){  
           $http.post("Function/Product_sub_category.php", {'cate_id':$scope.ctid})  
           .success(function(data){  
                $scope.subna = data;  
           });   
		   
     




	 }  
	   
    


 });  </script>
</body>
</html>

<style>
iframe{
	width: 200px;
	height: 200px;
}
@media only screen and (max-width: 600px) {
  .mob {
    margin-top:91%;
  }
}
</style>