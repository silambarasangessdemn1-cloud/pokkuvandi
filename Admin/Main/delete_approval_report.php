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
    <style>
            .dataTables_filter{
display: none !important;
            }
        </style>
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
		
		<?php
// Pagination and search filter implementation


?>

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Delete Approval Report</h4>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Search Form -->
                            <form action="" method="get">
                    <div class="form-group row">
                      <!-- <label for="staticEmail" class="col-sm-1 col-form-label">From Date</label>
              <div class="col-sm-2">
                <input type="date"  class="form-control" id="email2" name="from_date"  >
              </div> -->

                      <!-- <label for="staticEmail" class="col-sm-1 col-form-label">To Date</label>
              <div class="col-sm-2">
                <input type="date"  class="form-control" id="email2" name="to_date"  >
              </div> -->
                      <label for="staticEmail" class="col-sm-1 col-form-label">Vehicle No</label>
                      <div class="col-sm-2">

                    <select class="form-control" name="vehicle_no" id="vehicle_no">
                <option value="">--SELECT--</option>
                <?php
                $query = "SELECT DISTINCT create_post.vehicle_no 
                          FROM create_post 
                          WHERE delete_id = '1' AND delete_approval_status = '1'";
                $result = mysqli_query($config, $query);

                $selected_vehicle_no = $_GET['vehicle_no'] ?? ''; // Keep selected value
                
                while ($row = mysqli_fetch_object($result)) {
                    $selected = ($row->vehicle_no == $selected_vehicle_no) ? 'selected' : '';
                    echo "<option value='{$row->vehicle_no}' $selected>{$row->vehicle_no}</option>";
                }
                ?>
            </select>

                      </div>
                      <label for="main_cate_Name" class="col-sm-1 col-form-label">Main Category</label>
        <div class="col-sm-2">
            <select class="form-control" name="main_cate_Name" id="main_cate_Name">
                <option value="0">--SELECT--</option>
                <?php                            
                $main_cate = mysqli_query($config, "SELECT * FROM main_category WHERE Main_Category_Status=1");
                while ($addsubcate = mysqli_fetch_object($main_cate)) { 
                    $selected = (isset($_GET['main_cate_Name']) && $_GET['main_cate_Name'] == $addsubcate->Main_Category_id) ? 'selected' : '';
                ?>
                    <option value="<?php echo $addsubcate->Main_Category_id; ?>" <?php echo $selected; ?>>
                        <?php echo $addsubcate->Main_Category_Name; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
                      <label for="state" class="col-sm-1 col-form-label">State</label>
<div class="col-sm-2">
    <select class="form-control" name="state" id="state" onchange="getDistricts(this.value,0)">
        <option value="0">--SELECT--</option>
        <?php
        $selected_state = isset($_GET['state']) ? $_GET['state'] : 0;
        $main_state = mysqli_query($config, "SELECT * FROM dir_state_master");
        while ($main_state__ = mysqli_fetch_object($main_state)) {
            $selected = ($main_state__->state_id == $selected_state) ? 'selected' : '';
        ?>
            <option value="<?php echo $main_state__->state_id; ?>" <?php echo $selected; ?>>
                <?php echo $main_state__->name; ?>
            </option>
        <?php } ?>
    </select>
</div>

<label for="district" class="col-sm-1 col-form-label">District</label>
<div class="col-sm-2">
    <select class="form-control" name="district" id="district" onchange="area(this.value);">
        <option value="0">--SELECT--</option>
    </select>
</div>

                      <!-- </div>       -->
                      <!-- <div class="form-group row">      -->
                      <label for="staticEmail" class="col-sm-1 col-form-label">City</label>
                      <div class="col-sm-2" id="area">


                      </div>




                      <div class="col-sm-12">
                        <button class="btn btn-primary btn-lg btn-block" name="date_filter">Submit</button>
                        <button type="button" class="btn btn-secondary btn-lg" onclick="clearForm()">Clear</button>

                      </div>

                    </div>
                  </form>
                  <script>
function clearForm() {
    document.querySelector("form").reset(); // Reset the form fields
    // Optionally, remove query parameters from the URL
    window.location.href = window.location.pathname; 
}
</script>
                  <div class="view-all-option">
                    <a href="?view_all=true" class="btn btn-primary">View All Data</a>
                  </div>
                  <form method="GET" class="d-flex justify-content-center mt-3">
    <!-- Preserve existing GET parameters -->

    <input type="hidden" name="vehicle_no" value="<?php echo isset($_GET['vehicle_no']) ? $_GET['vehicle_no'] : ''; ?>">
    <input type="hidden" name="state" value="<?php echo isset($_GET['state']) ? $_GET['state'] : ''; ?>">
    <input type="hidden" name="district" value="<?php echo isset($_GET['district']) ? $_GET['district'] : ''; ?>">
    <input type="hidden" name="Add_area" value="<?php echo isset($_GET['Add_area']) ? $_GET['Add_area'] : ''; ?>">
    <input type="hidden" name="date_filter" value="<?php echo isset($_GET['date_filter']) ? $_GET['date_filter'] : ''; ?>">

    <div class="input-group shadow-sm" style="max-width: 400px;">
        <input type="text" name="search_input" class="form-control rounded-start border-primary" 
               placeholder="Search here..." value="<?php echo isset($_GET['search_input']) ? $_GET['search_input'] : ''; ?>">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-search"></i> <!-- FontAwesome Search Icon -->
        </button>
    </div>
</form>


                            <!-- Excel Download Button -->
<!-- Excel Download Button -->
<?php 
    // Preserve all search and filter parameters
    $export_params = $_GET;
    $export_url = "del_export_excel.php?" . http_build_query($export_params);
?>
<a href="<?php echo $export_url; ?>" class="btn btn-success">Download Excel</a>

                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Driver Name</th>
                                            <th>Transport Name</th>
                                            
                                            <th>Phone No</th>
                                            <th scope="col">Category</th>

                                            <th>Address</th>
                                            <th>Category</th>
                                            <th>Sub Category</th>
                                            <th>Vehicle Photo</th>
                                            <th>Vehicle No</th>
                                            <th>Vehicle Name</th>
                                            <th>State</th>
                                            <th>District</th>
                                            <th>City</th>
                                            <th>Reason For Delete</th>
                                            <th>Package Name</th>
                                            <th>Package Expiry</th>
                                            <th>Package Amount</th>
                                            <th>Payment Type</th>

                                            <th scope="col">Create On</th>
                                          
                                            <th scope="col">Delete Date</th>
                                        </tr>
                                    </thead>
                                    <tbody><?php 
                                    $limit = isset($_GET['view_all']) ? 999999 : 10; // Show all if 'view_all' is set, else limit to 10 per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Search filter form data
$search = isset($_GET['search_input']) ? $_GET['search_input'] : '';

$where = "WHERE delete_id = '1' AND delete_approval_status = '1'";

// Apply filters if date_filter is set
if (isset($_GET['date_filter'])) {
    $vehicle_no = $_GET['vehicle_no'] ?? '';
    $state = $_GET['state'] ?? '0';
    $district = $_GET['district'] ?? '0';
    $city = $_GET['Add_area'] ?? '';

    if (!empty($vehicle_no)) {
        $where .= " AND create_post.vehicle_no = '$vehicle_no' ";
    }
    if (!empty($state) && $state != '0') {
        $where .= " AND create_post.state_id = '$state' ";
    }
    if (!empty($district) && $district != '0') {
        $where .= " AND create_post.city_id = '$district' ";
    }
    if (!empty($city) && $city != '0') {
        $where .= " AND create_post.area_id = '$city' ";
    }
    if (!empty($main_category) && $main_category != '0') {
        $where .= " AND category_id = '$main_category' ";
    }
}

// Apply search filter
if (!empty($search)) {
    $where .= " AND (Driver_Name LIKE '%$search%' OR phone_no LIKE '%$search%' OR category_id LIKE '%$search%')";
}

// SQL query for fetching filtered data with pagination
$sql = "SELECT * FROM create_post $where

 ORDER BY post_id DESC LIMIT $start, $limit";
$result = mysqli_query($config, $sql);

// Get total records count for pagination
$total_records_result = mysqli_query($config, "SELECT COUNT(*) as total FROM create_post $where");
$total_records = mysqli_fetch_assoc($total_records_result)['total'];
$total_pages = ceil($total_records / $limit);

// Display data
$mc = 1;
while ($macate = mysqli_fetch_object($result)) {
                                            // Process and display the data as done before
                                            // Example for processing city, state, etc.
                                            $expiry_date = date("d-m-Y", strtotime($macate->expiry_date));
                                            $cus_city = mysqli_query($config, "SELECT * FROM dir_city_master WHERE dir_city_id = '$macate->city_id'");
                                            $cus_city__ = mysqli_fetch_object($cus_city);
                                            $cus_state = mysqli_query($config, "SELECT * FROM dir_state_master WHERE state_id = '$macate->state_id'");
                                            $cus_state__ = mysqli_fetch_object($cus_state);
                                            $cus_area = mysqli_query($config, "SELECT * FROM dir_area_master WHERE dir_area_id = '$macate->area_id'");
                                            $cus_area__ = mysqli_fetch_object($cus_area);
                                            $cus_sub = mysqli_query($config, "SELECT * FROM sub_area_master WHERE sub_area_id = '$macate->sub_area_id'");
                                            $cus_sub__ = mysqli_fetch_object($cus_sub);
                                            $cus_ = mysqli_query($config, "SELECT * FROM customer_master WHERE Customer_Phone_No = '$macate->phone_no'");
                                            $cust___ = mysqli_fetch_object($cus_);
                                            $Recent_customer_ = mysqli_query($config, "SELECT * FROM main_category WHERE Main_Category_id = '$macate->category_id' ORDER BY Main_Category_id DESC");
                                            $recent_cust__ = mysqli_fetch_object($Recent_customer_);
                                            $customer_ = mysqli_query($config, "SELECT * FROM sub_category WHERE Sub_Category_id = '$macate->subcategory_id' ORDER BY Sub_Category_id DESC");
                                            $cust__ = mysqli_fetch_object($customer_);
                                            $package_ = mysqli_query($config, "SELECT * FROM category_package WHERE package_id = '$macate->package_id' ORDER BY package_id DESC");
                                            $package__ = mysqli_fetch_object($package_);
                                            $Recent_customer_=mysqli_query($config,"select * from main_category where  Main_Category_id='$macate->category_id' order by Main_Category_id  DESC ");
                                            $recent_cust__=mysqli_fetch_object($Recent_customer_);
                                            $online_payment_transcation=mysqli_query($config,"select * from online_payment_transcation where  Customer_id='$macate->customer_id' order by Customer_id  DESC ");
                                            $online_payment_transcation_mc=mysqli_fetch_object($online_payment_transcation);

                                        ?>
                                        <tr>
                                            <td><?php echo $mc; ?></td>
                                            <td><?php echo $cust___->Customer_Name; ?></td>
                                            <td><?php echo $macate->vehicle_name; ?></td>

                                            <td><?php echo $macate->phone_no; ?></td>
                                            <td><?php echo $recent_cust__->Main_Category_Name; ?></td>

                                            <td><?php echo $macate->Address; ?></td>
                                            <td><?php echo $recent_cust__->Main_Category_Name; ?></td>
                                            <td><?php echo $cust__->Sub_Category_Name; ?></td>
                                            <td><img src="../../photos/vehicle/<?php echo $macate->vehicle_photo; ?>" style="width: 128px; height: 129px;"></td>
                                            <td><?php echo $macate->vehicle_no; ?></td>
                                            <td><?php echo $macate->vehicle_name; ?></td>
                                            <td><?php echo $cus_state__->name; ?></td>
                                            <td><?php echo $cus_city__->dir_city_name; ?></td>
                                            <td><?php echo $cus_area__->dir_area_name; ?></td>
                                            <td><?php echo $macate->delete_remarks; ?></td>
                                            <td><?php echo $package__->package_title; ?></td>
                                            <td><?php echo $expiry_date; ?></td>
                                            <td><?php echo $macate->package_amount; ?></td>
                                            <?php if($macate->payment_type == '0')  { ?>
                                                 <td></td>
                                                 <?php } else if($mac3->payment_type == '2')  { ?>
                                                  <td>Bank Payment</td>
                                                
                                                  <?php } else { ?>
                                                  <td>Cash Payment</td>
                                                  <?php } ?>
                                            <td>
                                                    <?php  
                                             
                                                 $main_cate_date = strtotime($macate->create_on);
           echo  date('d-m-Y',$main_cate_date).'<br>';
        //    echo  date('h:m a',$main_cate_date);
                                             
                                             ?></td>

<td><?php echo $macate->delete_date; ?></td>

                                            
                                        </tr>
                                        <?php $mc++; } ?>
                                    </tbody>
                                </table>

                                <!-- Pagination -->
                                <nav>
    <ul class="pagination">
        <?php 
        // Preserve existing query parameters
        $query_params = $_GET;
        unset($query_params['page']); // Remove existing page parameter to update it dynamically

        foreach (range(1, $total_pages) as $i) { 
            $query_params['page'] = $i; // Set the current page
            $pagination_url = '?' . http_build_query($query_params); // Build the query string
        ?>
            <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                <a class="page-link" href="<?php echo $pagination_url; ?>"><?php echo $i; ?></a>
            </li>
        <?php } ?>
    </ul>
</nav>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Excel Download Script (export_excel.php) -->

			
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