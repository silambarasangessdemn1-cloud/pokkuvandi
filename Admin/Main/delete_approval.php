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
						<h4 class="page-title">Delete Approval</h4>
						 
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								
								<div class="card-body">
								 <!-- <center> <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fas fa-plus"></i>   Add New Category
								</button></center> -->
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>S.No</th>
													<!-- <th> Shop Setting</th> -->
													<th> Driver Name</th>
                                                    <th> Phone No</th>
                                                    <th> Address</th>
													<th> Category</th>	
                                                    <th> Sub Category</th>	
													
                                                    <th class="noExl">  Vehicle Photo</th>												
													<th> Vehicle No</th>
													<th> Vehicle Name</th>
													<th> State</th>
                                                    <th> District</th>
                                                    <th> City</th>
                                                
													<th> Reason For Delete</th>
													<th> Delete Date</th>
													<th class="noExl">Action</th>
												</tr>
											</thead>
											 
											<tbody>
											<?php 
											$mc=1;
											
											$main_cate=mysqli_query($config,"select * from create_post where delete_id= '1' and delete_approval_status = '0' order by post_id DESC" );
											while($macate=mysqli_fetch_object($main_cate))
											{

												$cus_city=mysqli_query($config,"select * from dir_city_master where dir_city_id='$macate->city_id' ");
												$cus_city__=mysqli_fetch_object($cus_city);

												$cus_state=mysqli_query($config,"select * from dir_state_master where state_id='$macate->state_id' ");
												$cus_state=mysqli_fetch_object($cus_state);
	
												$cus_area=mysqli_query($config,"select * from dir_area_master where dir_area_id='$macate->area_id' ");
												$cus_area__=mysqli_fetch_object($cus_area);
	
												$cus_sub=mysqli_query($config,"select * from sub_area_master where sub_area_id='$macate->sub_area_id' ");
												$cus_sub__=mysqli_fetch_object($cus_sub);
												$cus_=mysqli_query($config,"select * from customer_master where Customer_Phone_No='$macate->phone_no' ");
												$cust___=mysqli_fetch_object($cus_);

												$Recent_customer_=mysqli_query($config,"select * from main_category where  Main_Category_id='$macate->category_id' order by Main_Category_id  DESC ");
												$recent_cust__=mysqli_fetch_object($Recent_customer_);
	
												$customer_=mysqli_query($config,"select * from sub_category where  Sub_Category_id='$macate->subcategory_id' order by Sub_Category_id  DESC ");
												$cust__=mysqli_fetch_object($customer_);
	

											?>
												
												
												<tr>
													<td><?php echo $mc;?></td>													
													<td><?php echo $cust___->Customer_Name; ?></td>
													<td><?php echo $macate->phone_no; ?></td>													
													<td><?php echo $macate->Address; ?></td>
													<td><?php echo $recent_cust__->Main_Category_Name; ?></td>
                                                 	<td><?php echo $cust__->Sub_Category_Name; ?></td>
													
													<td class="noExl">
													<img src="../../photos/vehicle/<?php 
													echo $macate->vehicle_photo;



													   ?>" style="
      width: 128px;
    height: 129px;
"></td>           

											<td><?php echo $macate->vehicle_no; ?></td>
											<td><?php echo $macate->vehicle_name; ?></td>
											<td><?php echo $cus_state->name; ?></td>
											<td><?php echo $cus_city__->dir_city_name; ?></td>
                                             <td><?php echo $cus_area__->dir_area_name; ?></td>
                                         
											 <td><?php echo $macate->delete_remarks; ?></td>
											 <td><?php echo $macate->delete_date; ?></td>
													<td class="noExl">
<a href="" class="btn btn-primary" data-toggle="modal" data-target="#<?php echo $mc;?>">Approval <i class="fas fa-pencil-alt"></i>  </a>

</td>

<!-- Modal -->
<div class="modal fade" id="<?php echo $mc;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Approval</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form action="Function/delete_approval_update.php" method="post">  
	  <input type="hidden" class="form-control" id="email2" name="post_id" placeholder="id"   value="<?php echo $macate->post_id;?>">
          <div class="form-group">
												<label for="exampleFormControlSelect1">Approval Status</label>
												<select class="form-control" id="exampleFormControlSelect1" name="delete_approval_status">
													<option value="1" selected>Approval</option>
													<option value="0">Reject</option>
												</select>
											</div>			
					 <div class="form-group">
						<label for="exampleInputName1">Reason</label>
						<textarea placeholder="" name="delete_reason" type="text" class="form-control" id="delete_reason"  aria-describedby="emailHelp" ></textarea>
              		 </div>
		     					<div class="form-group">
									<button class="btn btn-success" type="submit" name="delete_approval">Submit</button>
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
	
			
			
			<button id="exportExcel" class="btn btn-success">
    <i class="fas fa-file-excel"></i> Download Excel
</button>
<style>
#exportExcel {
    font-size: 16px;
    padding: 10px 20px;
    border-radius: 5px;
    font-weight: bold;
    display: flex;
    align-items: center;
    gap: 8px;
}

#exportExcel i {
    font-size: 20px;
}


</style>
			
			
			
			
			
			
			
			
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
	<script src="https://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>

	<script >
		$(document).ready(function() {
			$('#basic-datatables').DataTable({
			});

		 
 
			 
		});

		$(document).ready(function(){
  // Add a click event listener to the export button
  $("#exportExcel").click(function(){
    // Hide the "Vehicle Photo" column by index (assuming it's the 7th column)
    $('#basic-datatables th').eq(6).hide();  // Hide header
    $('#basic-datatables td').each(function(index){
      if (index % $('#basic-datatables th').length === 6) {  // 6 is the 7th column index (0-based)
        $(this).hide();  // Hide cell
      }
    });

    // Use the table2excel plugin to export the table
    $("#basic-datatables").table2excel({
      exclude: ".noExl", // Exclude specific elements with the class 'noExl'
      name: "Excel Document",
      filename: "delete_aproval.xls" // Set the desired filename
    });

    // After exporting, show the hidden column again
    $('#basic-datatables th').eq(6).show();
    $('#basic-datatables td').each(function(index){
      if (index % $('#basic-datatables th').length === 6) {
        $(this).show();
      }
    });
  });
});


	</script>
	
</body>
</html>