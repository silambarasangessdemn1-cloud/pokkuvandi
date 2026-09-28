<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Leefoodies </title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="../assets/img/icon.ico" type="image/x-icon"/>
	
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
			 
			
 <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Product Offer </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	   <div ng-app="myproduct" ng-controller="productcontroller" ng-init="loadid()">
      

<h5 class="modal-title" id="exampleModalLabel">Add Product Offer </h5>

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
                <input type="text" class="form-control" id="email2" ng-repeat="pro in proprice" name="Add_offer_price" value="{{pro.Product_price}}">
				
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