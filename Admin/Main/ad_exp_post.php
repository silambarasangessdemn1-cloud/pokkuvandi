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
 <script src="
      https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js
      "></script>
      <link href="
      https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css
      " rel="stylesheet">
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
						<h4 class="page-title">Expired List & Registration Renewal</h4>
						 
					</div>
					<div class="row">
						<div class="col-md-12">

						<?php if(isset($_GET['msg']))
							{
								?>
							<div class="alert alert-primary" role="alert">
							Post Succesfully Added!!!
							</div>
							<?php }
							?>
							<?php if(isset($_GET['msgerror']))  {?>
							<div class="alert alert-primary" role="alert">
							Check The Post OR Date Will be Not Expiry!!!
							</div>
							
							<?php } ?>
            
<?php       $search_text = isset($_GET['search_text']) ? mysqli_real_escape_string($config, $_GET['search_text']) : '';
 ?>

<form method="GET" action="">
    <div class="input-group mb-3">
        <input type="text" name="search_text" id="search-input1" class="form-control" placeholder="Search..." value="<?php echo htmlspecialchars($search_text); ?>"style="
    max-width: 250px;
">
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit" style="
    margin-left: 23px;
">Search</button>
        </div>
    </div>
</form>
							<div class="card">
								
								<div class="card-body">
								 <!-- <center> <a href="add_create_post.php" class="btn btn-success" >
                                    <i class="fas fa-plus"></i>    Create New Registration     </a></center>  -->
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
												<th scope="col">#</th>
                                             <th scope="col">Customer</th>
                                             <th scope="col">Phone No</th>
                                             <th scope="col">Category</th>
                                            <th scope="col">Sub category</th>
                                            <th scope="col">Vehicle Type</th>
                                            <th scope="col">Vehicle Name</th>
                                            <th scope="col">Vehicle RC No</th>
                                            <th scope="col">RC Name</th>
                                            <th scope="col">Tonage</th>
                                            <th scope="col">Seating</th>
                                            <th scope="col">Facilities</th>
                                            <th scope="col">Specification</th>
                                            <th scope="col">Active Location</th>
                                            <th scope="col">Insurance Expiry</th>
                                            <th scope="col">Stand Name</th>
                                            <th scope="col">Shop Name</th>
                                            <th scope="col">Shop Add</th>
                                            <th scope="col">Work Nature</th>
                                            <th scope="col">Loader from Place</th>
                                            <th scope="col">Loader to Place</th>
                                            <th scope="col">Loader from Date</th>
                                            <th scope="col">Loader to Date</th>

                                            <th scope="col">Photo</th>
                                            <th scope="col">Whatsapp No</th>
                                            <th scope="col">District</th>
                                            <th scope="col">City</th>
                                            <th scope="col">Create On</th>
                                            <th scope="col">Expiry Date</th>                                            
                                            <th scope="col">Referred By Mobile No</th>
                                            <th scope="col">Referred By Name</th>
                                            <th scope="col">Package Name</th> 
                                            <th scope="col">Package Valied Days</th> 
                                            <th scope="col">Coupon Type</th> 
                                            <th scope="col">Coupon Name</th> 
                                            <th scope="col">Discount Amount</th> 
                                            <th scope="col">Payment Type</th>
                                            <th scope="col">Amount</th>    
													<th>Action</th>
												</tr>
											</thead>
											 
											<tbody>
											<?php
      $search_text = isset($_GET['search_text']) ? mysqli_real_escape_string($config, $_GET['search_text']) : '';

      $mc = 1;
      $or__ = "SELECT * FROM `create_post` WHERE status = '1'";
      
      if (!empty($search_text)) {
          $or__ .= " AND (driver_name LIKE '%$search_text%' 
                       OR phone_no LIKE '%$search_text%' 
                       OR expiry_date LIKE '%$search_text%' 
                       OR category_id IN 
                       (SELECT Main_Category_id FROM main_category WHERE Main_Category_Name LIKE '%$search_text%'))";
      }
      
      $or__ .= " ORDER BY post_id DESC";
      
      $maincate__ = mysqli_query($config, $or__);
      if (!empty($search_text)) {  // Only display the table if a search was performed

while($mac__=mysqli_fetch_object($maincate__))
{
$post_addon_ = $mac__->post_addon;
$post_addon = date("d-m-Y", strtotime($post_addon_)); 

$exp_date = $mac__->expiry_date;
$exp_date___ = date("d-m-Y", strtotime($exp_date)); 

$post_id  = $mac__->post_id ;
$current_Date=date('Y-m-d');

$package_days = 10;    
$exp_min = date("Y-m-d", strtotime($exp_date . " -$package_days days"));  



if($current_Date >= $exp_min){

//$or="SELECT * FROM `create_post` where post_id ='$post_id' and `expiry_date` >= '$exp_min' and `expiry_date` <= '$exp_date'";    
$or="SELECT * FROM `create_post` where post_id ='$post_id' and `expiry_date` >= '$exp_min'  and delete_id='0' and status= '1'  ";    
$maincate3=mysqli_query($config,$or); 

if (mysqli_num_rows($maincate3) > 0) {
$ldata= mysqli_num_rows($maincate3);
$mac3=mysqli_fetch_object($maincate3);


$net_amount=$mac3->net_amount;


$Recent_customer_=mysqli_query($config,"select * from main_category where  Main_Category_id='$mac3->category_id' order by Main_Category_id  DESC ");
$recent_cust__=mysqli_fetch_object($Recent_customer_);

$customer_=mysqli_query($config,"select * from sub_category where  Sub_Category_id='$mac3->subcategory_id' order by Sub_Category_id  DESC ");
$cust__=mysqli_fetch_object($customer_);

  $cus_=mysqli_query($config,"select * from customer_master where Customer_Phone_No='$mac3->phone_no' ");
$cust___=mysqli_fetch_object($cus_);

$cus_city=mysqli_query($config,"select * from dir_city_master where dir_city_id='$mac3->city_id' ");
$cus_city__=mysqli_fetch_object($cus_city);

$cus_area=mysqli_query($config,"select * from dir_area_master where dir_area_id='$mac3->area_id' ");
$cus_area__=mysqli_fetch_object($cus_area);

$cus_sub=mysqli_query($config,"select * from sub_area_master where sub_area_id='$mac3->sub_area_id' ");
$cus_sub__=mysqli_fetch_object($cus_sub);


$cus_=mysqli_query($config,"select * from customer_master where Customer_Phone_No='$mac3->phone_no' ");
$cust___=mysqli_fetch_object($cus_);

$cus_package_name=mysqli_query($config,"select * from category_package where package_id ='$mac3->package_id ' ");
$cust_package_name_=mysqli_fetch_object($cus_package_name);



$cus_vehicle_type=mysqli_query($config,"select * from vehicle_type where Vehicle_type_id='$mac3->vehicle_type_id' ");
$cus_vehicle_type__=mysqli_fetch_object($cus_vehicle_type);


?>   
												
												
												<tr>
													<td><?php echo $mc;?></td>													
													<td><?php echo $mac3->driver_name; ?></td>
                                             <td><?php echo $mac3->phone_no; ?></td>
                                                 <td><?php echo $recent_cust__->Main_Category_Name; ?></td>
                                                 <td><?php echo $cust__->Sub_Category_Name; ?></td>
                                                 <td><?php echo $cus_vehicle_type__->Vehicle_type_name; ?></td>
                                                 <td><?php echo $mac3->vehicle_name; ?></td>
                                                 <td><?php echo $mac3->vehicle_no; ?></td>
                                                 <td><?php echo $mac3->Add_RC_owner_name; ?></td>
                                                 <?php if($mac3->tonnage) { ?>
                                                 <td><?php echo $mac3->tonnage; ?></td>
                                                 <?php } else { ?>
                                                  <td></td>
                                                  <?php } ?>

                                                  <?php if($mac3->seating_capacity) { ?>
                                                 <td><?php echo $mac3->seating_capacity; ?></td>
                                                 <?php } else { ?>
                                                  <td></td>
                                                  <?php } ?>


                                                  <?php if($mac3->facilities) { ?>
                                                 <td><?php echo $mac3->facilities; ?></td>
                                                 <?php } else { ?>
                                                  <td></td>
                                                  <?php } ?>

                                                  <?php if($mac3->space) { ?>
                                                 <td><?php echo $mac3->space; ?></td>
                                                 <?php } else { ?>
                                                  <td></td>
                                                  <?php } ?>
                                                  
                                                  <?php if($mac3->Add_location) { ?>
                                                 <td><?php echo $mac3->Add_location; ?></td>
                                                 <?php } else { ?>
                                                  <td></td>
                                                  <?php } ?>

                                                  <?php if($mac3->Add_insurance_exp_date) { ?>
                                                 <td><?php echo $mac3->Add_insurance_exp_date; ?></td>
                                                 <?php } else { ?>
                                                  <td></td>
                                                  <?php } ?>

                                                  <?php if($mac3->stand_name) { ?>
                                                 <td><?php echo $mac3->stand_name; ?></td>
                                                 <?php } else { ?>
                                                  <td></td>
                                                  <?php } ?>

                                                  <?php if($mac3->shop_name) { ?>
                                                 <td><?php echo $mac3->shop_name; ?></td>
                                                 <?php } else { ?>
                                                  <td></td>
                                                  <?php } ?>

                                                  <?php if($mac3->shop_address) { ?>
                                                 <td><?php echo $mac3->shop_address; ?></td>
                                                 <?php } else { ?>
                                                  <td></td>
                                                  <?php } ?>

                                                  <?php if($mac3->work_nature) { ?>
                                                 <td><?php echo $mac3->work_nature; ?></td>
                                                 <?php } else { ?>
                                                  <td></td>
                                                  <?php } ?>
                                                  <td><?php echo $mac3->loader_from_date; ?></td>
                                                  <td><?php echo $mac3->loader_to_date; ?></td>
                                                  <td><?php echo $mac3->loader_from_place; ?></td>
                                                  <td><?php echo $mac3->loader_to_place; ?></td>



                                                  <td><img src="../../photos/vehicle/<?php echo $mac3->vehicle_photo; ?>" style="height: 131px !important; width: 150px !important;margin: auto;"></td>
                                                  
                                                  <td><?php echo $mac3->whatsapp_no; ?></td>
                                                  <td><?php echo $cus_city__->dir_city_name; ?></td>
                                                  <td><?php echo $cus_area__->dir_area_name; ?></td>
                                                  <td>
                                                    <?php  
                                             
                                                 $main_cate_date = strtotime($mac3->create_on);
           echo  date('d-m-Y',$main_cate_date).'<br>';
        //    echo  date('h:m a',$main_cate_date);
                                             
                                             ?></td>
                                              <td><?php  
                                             
                                             $main_cate_date = strtotime($mac3->expiry_date);
                                             echo  date('d-m-Y',$main_cate_date).'<br>';  
                                         
                                         ?></td>
                                        
                                             <td><?php echo $mac3->reffered_by_phone_no; ?></td>
                                             <td><?php echo $mac3->reffered_by_name; ?></td>

                                             <td><?php echo $cust_package_name_->package_title; ?></td>
                                             <td><?php echo $mac3->package_days; ?></td>

                                                  <?php if($mac3->coupon_type) { ?>
                                                 <td><?php echo $mac3->coupon_type; ?></td>
                                                 <?php } else { ?>
                                                  <td></td>
                                                  <?php } ?>

                                                  <?php if($mac3->discount_name) { ?>
                                                 <td><?php echo $mac3->discount_name; ?></td>
                                                 <?php } else { ?>
                                                  <td></td>
                                                  <?php } ?>

                                                  <?php if($mac3->discount_amount) { ?>
                                                 <td><?php echo $mac3->discount_amount; ?></td>
                                                 <?php } else { ?>
                                                  <td></td>
                                                  <?php } ?>

                                                  <?php if($mac3->payment_type == '0')  { ?>
                                                 <td></td>
                                                 <?php } else if($mac3->payment_type == '2')  { ?>
                                                  <td>Bank Payment</td>
                                                
                                                  <?php } else { ?>
                                                  <td>Cash Payment</td>
                                                  <?php } ?>

                                                  <?php if($mac3->net_amount) { ?>
                                                 <td><?php echo $mac3->net_amount; ?></td>
                                                 <?php } else { ?>
                                                  <td><?php echo $mac3->package_amount; ?></td>
                                                  <?php } ?>


													<td>
<a href="ad_post_renewal.php?pid=<?php echo $mac3->post_id  ; ?>" class="btn btn-primary" > Renewal  </a>
<!-- <a style="color:white" data-toggle="modal" data-target="#exampleModaldelete" onclick="deletepost(<?php echo $mac3->post_id?>)" class="btn btn-primary btn-lg btn-block"> <i class="fas fa-trash"></i>  </a> -->

 

</td>


<div class="modal" tabindex="-1" id="exampleModaldelete" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div style="border-bottom: 0px solid #e5e5e5 !important" class="modal-header">
      <div class="alertdelete alert-success" style="display: none;" role="alert">                               
                                    <div class="msgdelete">

                                    </div>                                    
                                </div>
      </div>
      <div class="modal-body">
      <div class="contact-form default-form">
                            <!-- <form action="city_update_insert.php" method="post"> -->
                                <div class="row clearfix" id="deletepopup">   
                                
                                                            </div>
                            <!-- </form> -->
						</div>
      </div>
      
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="<?php echo $mc;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Main Category Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form action="Function/Main_category_edit.php" method="post">
      

      <!-- <div class="form-group">
												<label for="exampleFormControlSelect1">Shop Setting</label>
										<input type="text" class="form-control" readonly id="email2" name="main_cate_shop_set"  value="<?php  $macate->Shop_setting;
													
													$subsmain_cate=mysqli_query($config,"select * from shop_setting where shop_id='".$macate->Shop_setting."'");
											 $main_subcatee=mysqli_fetch_object($subsmain_cate);
												
												
												echo  $main_subcatee->Shop__setting;
													
													
													
													
													
													
													?>">	
											</div>	 -->






	  <div class="form-group">
			<label for="email2">Main CategoryName</label>
			<input type="hidden" class="form-control" id="email2" name="main_cate_id"  value="<?php echo $macate->Main_Category_id;?>">
			<input type="text" class="form-control" id="email2" name="main_cate_name" placeholder="Main CategoryName" value="<?php echo $macate->Main_Category_Name;?>">
			</div>
          <div class="form-group">
												<label for="exampleFormControlSelect1">Category Active Status</label>
												<select class="form-control" id="exampleFormControlSelect1" name="main_category_status">
												<?php 

													$enablestatus=$macate->Main_Category_Status;
													
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
									<button class="btn btn-success" type="submit" name="category_content_edit">Submit</button>
 								</div>
			
			
			</form>
			
			
      </div>
	 
	  <div class="modal-body">
	  <form action="Function/Main_category_edit.php" method="post" enctype="multipart/form-data" >
	 <center>  <h4 class="modal-title" id="exampleModalLabel">Change Category Image (Image size : 40px X 40px)</h4></center> 
       
<div class="form-group">
<label for="email2">Current Image</label>
<img src="<?php 													$cate=$macate->Main_Category_image;
   $ms=substr($cate,3);
				  echo  $ms;
?>" style="
    width: 128px;
    height: 129px;
">
</div>




	   <div class="form-group">
			<label for="email2">Change  Imag here</label>
						<input type="hidden" class="form-control" id="email2" name="main_image_cate_id"  value="<?php echo $macate->Main_Category_id;?>">

			<input type="file" class="form-control" id="email2" name="Main_cate_image" placeholder="Main CategoryName" value="<?php echo $macate->Main_Category_Name;?>">
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
												
											<?php $mc++;}} }  }?>
												
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
        <h5 class="modal-title" id="exampleModalLabel">Add Main Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="Function/Add_Main_Category.php" method="post" enctype="multipart/form-data">
       

 <div class="form-group">
		<label for="exampleFormControlSelect1">Shop Setting</label>
		<select class="form-control" name="Add_main_cate_shopsetting">
			<?php
			
			$main_cate=mysqli_query($config,"select * from shop_setting");
											while($addsubcate=mysqli_fetch_object($main_cate))
											{
			
			
			?>
			
			<option value="<?php echo $addsubcate->shop_id;?>"><?php echo $addsubcate->Shop__setting;?></option>
			
			
			
			
											<?php } ?>
			
			</select>
											</div>	





	   <div class="form-group">
			<label for="email2">Main CategoryName</label>
			<input type="text" class="form-control" id="email2" name="Add_main_cate_name" placeholder="Main CategoryName"  >
			</div>  
			<div class="form-group">
			<label for="email2">Main Category Image (Image size : 40px X 40px)</label>
			<input type="file" class="form-control" id="email2" name="Add_main_cate_image" placeholder="Main CategoryName"  >
			</div>
       
		 <div class="form-group">
		<label for="exampleFormControlSelect1">Category Active Status</label>
		<select class="form-control" id="exampleFormControlSelect1" name="Add_main_category_status">
		<option value="1">Active</option>
		<option value="0">In-Active</option>
		
		</select>
											</div>			
		
		     <div class="form-group">
									<button class="btn btn-success" type="submit" name="category_add">Add New</button>
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
        "paging": true, // Enable pagination
        "searching": false, // Disable default search
        "ordering": false, // Disable ordering
        "info": true, // Show pagination info
        "lengthChange": false, // Disable length change dropdown
        "pageLength": 10,
			});

		 
 
			 
		});

		
		function deletepost(id){
                    var id;
                  // alert(id);
             
                    $.ajax({
                        type: "POST",
                        url:'delete_popup.php',
                        data: {id:id}, // serializes the form's elements.
                        success: function(data)
                        {	
                            //alert(data);		
                        $('#deletepopup').html(data);
                        
                        }		
                        	
                    });	
                    

                }

	</script>
</body>
</html>