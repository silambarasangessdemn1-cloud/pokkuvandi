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
						<h4 class="page-title">Offer</h4>
						 
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								
								<div class="card-body">
								<center> <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fas fa-plus"></i>   Add New Offer
</button></center>
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>S.No</th>
													<th>Offer Title</th>
													<th> Product Name</th>
													<th>Offer Percent</th>
													<th>Product Price</th>
													<th>Offer Price</th>
													<th>Offer Upto</th>
													<th>Offer Addon</th>
													 <th>  Status</th>
													<th>Action</th>
												</tr>
											</thead>
											 
											<tbody>
											<?php 
											$mc=1;
											$main_cate=mysqli_query($config,"select * from offer_master");
											while($macate=mysqli_fetch_object($main_cate))
											{
											?>
												
												
												<tr>
													<td><?php echo $mc;?></td>
													<td><?php echo $macate->Offer_Title;?></td>
													<td><?php   $macate->offer_Product_id;
			 
			
			$pro_name_=mysqli_query($config,"select * from product_master where Product_id='".$macate->offer_Product_id."' ");
										$add_pro=mysqli_fetch_object($pro_name_);
										
			
			echo $add_pro->Product_Name;
		 
			
			
			
			
			?>
													
													
													</td>
													 
													<td><?php echo $macate->Offer_percent;?>%</td> 
													<td><?php echo $macate->Product_price;?></td> 
													<td><?php echo 
													
													 number_format($macate->offer_price, 2);
													
													
													?></td> 
													<td><?php 
													
													
													$main_cate_date = strtotime($macate->Offer_upto);
			  echo  date('d-m-Y',$main_cate_date);
													
													
													
													
													
													?></td> 
		 
													<td><?php $edon= $macate->offer_add_on;
													
													$main_cate_date = strtotime($edon);
			  echo  date('d-m-Y',$main_cate_date);
													
													?>
													
													
													
													
													</td>
													<td><?php 

													$enablestatus=$macate->Offer_Status;
													
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
<a href="Function/offer_delete.php?delpoffid=<?php echo $macate->Offer_id;?>&offpr=<?php echo $macate->offer_Product_id;?>&delpt=700" class="btn btn-danger" onclick="return confirm('Are you confirm to delete this Offer?');"> <i class="fas fa-trash"></i>  </a>

 

</td>

<!-- Modal -->
<div class="modal fade" id="<?php echo $mc;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Offer Product Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form action="Function/Edit_offer_master.php" method="post">
        <div class="form-group">
			<label for="email2">Offer Product</label>
			<input type="hidden" class="form-control" id="email2" name="offer_pro_id"  value="<?php echo $macate->Offer_id;?>">
			<input type="text" class="form-control" id="email2" name="offer_product_name" readonly placeholder="Main CategoryName" value="<?php   $macate->offer_Product_id;
			 
			
			$pro_name_=mysqli_query($config,"select * from product_master where Product_id='".$macate->offer_Product_id."' ");
										$add_pro=mysqli_fetch_object($pro_name_);
										
			
			echo $add_pro->Product_Name;
		 
			
			
			
			
			?>">
		

		</div>
           <div class="form-group">
			<label for="email2">Offer Title</label>
			<input type="text" class="form-control" id="email2" name="offertitle"  value="<?php echo $macate->Offer_Title;?>">
			 
		

		</div> 
		<div class="form-group">
			<label for="email2"> Product Price</label>
			<input type="number" class="form-control" id="email2" readonly name="ofproduct_price"  value="<?php echo $macate->Product_price;?>">
			 
		

		</div>	<div class="form-group">
			<label for="email2">Offer  Price</label>
			<input type="number" class="form-control" id="email2"  readonly value="<?php echo 	 number_format($macate->offer_price, 2);?>">
			 
		

		</div>	<div class="form-group">
			<label for="email2">Offer Product Percent</label>
			<input type="number" class="form-control" id="email2" name="offer_product_percent"  value="<?php echo $macate->Offer_percent;?>">
			 
		

		</div>	<div class="form-group">
			<label for="email2">Offer valid upto</label>
			<input type="date" class="form-control" id="email2" name="offer_valid_upto"  value="<?php echo $macate->Offer_upto;?>">
			 
		

		</div>

		  
		  <div class="form-group">
	<label for="exampleFormControlSelect1">Product Offer Status</label>
												<select class="form-control" id="exampleFormControlSelect1" name="offer_product_status">
												<?php 

													$enablestatus=$macate->Offer_Status;
													
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
									<button class="btn btn-success" type="submit" name="offer_edit">Submit</button>
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
        <h5 class="modal-title" id="exampleModalLabel">Add Product Offer </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	   <div ng-app="myproduct" ng-controller="productcontroller" ng-init="loadid()">
        <form action="Function/Add_offer_product.php" method="post" enctype="multipart/form-data">
       
 


			 <div class="form-group">
                <label for="inputStatus"> Product Name </label>
                <select class="form-control" ng-model="pid"   name="Add_offer_pro_name" ng-change="loadsub()"  >
              <option>Select Product Name</option>
               <option ng-repeat="pt in prot" value="{{pt.Product_id}}">{{pt.Product_Name}}</option>
                </select>
              </div> 
 <div class="form-group">
                <label for="inputStatus">Select Product Quantity</label>
                <select class="form-control"  name="product_quantity"  ng-change="loadqua()"  ng-model="pqid"  >
                <option>Select Product Quantity</option>
               <option ng-repeat="pq in proquantity" value="{{pq.pr_quantity}}">{{pq.pr_quantity}}</option>
              

			  </select>
			   </div> 


  <div class="form-group">
			<label for="email2">Offer Title</label>
			<input type="text" class="form-control" id="email2" name="Add_offer_title" placeholder="Enter Product offer Title"  >
			</div> 
			
			
			<div class="form-group">
			<label for="email2">Offer Percent</label>
			<input type="number" class="form-control" id="email2" name="Add_offer_percent" placeholder="Enter Product offer Percent"  >
			</div> 

	                 <div class="form-group">
                <label for="inputStatus">  Product Offer  Price</label>
                <input type="text" class="form-control" id="email2" ng-repeat="pro in proprice" name="Add_product_price" value="{{pro.Shelling_price}}">
				
              </div> 

 
			  <div class="form-group">
			<label for="email2">Offer Valid Upto</label>
			<input type="date" class="form-control" id="email2" name="Add_offer_valid_upto" placeholder="Enter Product offer valid"  >
			</div>  
			 
		 <div class="form-group">
		<label for="exampleFormControlSelect1">Offer Status</label>
		<select class="form-control" id="exampleFormControlSelect1" name="Add_offer_status">
		<option value="1">Active</option>
		<option value="0">In-Active</option>
		
		</select>
											</div>			
		
		     <div class="form-group">
									<button class="btn btn-success" type="submit" name="offer_product_add">Add New</button>
 								</div>
			
			
			</form>
	
      </div>
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
		<script>
var app = angular.module("myproduct",[]);  


 app.controller("productcontroller", function($scope, $http){  
$scope.loadid = function()
{
  $http.get("Function/offer_product.php")  
           .success(function(data){  
                $scope.prot = data;  
           }); 
 
 }  

 $scope.loadsub = function(){  
           $http.post("Function/offer_product_quantiry.php", {'pt_id':$scope.pid})  
           .success(function(data){  
                $scope.proquantity = data;  
           });   
 }




 $scope.loadqua = function(){ 
	
		 $http.post("Function/offer_product_price.php", {'pt_id':$scope.pid , 'ptqid':$scope.pqid})  
           .success(function(data){  
                $scope.proprice = data;  
           });   
				}  
 

 });  </script>
	
	
	
</body>
</html>