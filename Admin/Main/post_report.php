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
        <div class="card">

        <form action="post_report.php" method="get">
    <div class="form-group row">
        <label for="from_date" class="col-sm-1 col-form-label">From Date</label>
        <div class="col-sm-2">
            <input type="date" class="form-control" id="from_date" name="from_date" 
                value="<?php echo isset($_GET['from_date']) ? $_GET['from_date'] : ''; ?>">
        </div>

        <label for="to_date" class="col-sm-1 col-form-label">To Date</label>
        <div class="col-sm-2">
            <input type="date" class="form-control" id="to_date" name="to_date" 
                value="<?php echo isset($_GET['to_date']) ? $_GET['to_date'] : ''; ?>">
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
            <select class="form-control" name="state" id="state">
                <option value="0">--SELECT--</option>
                <?php                            
                $main_state = mysqli_query($config, "SELECT * FROM dir_state_master");
                while ($main_state__ = mysqli_fetch_object($main_state)) { 
                    $selected = (isset($_GET['state']) && $_GET['state'] == $main_state__->state_id) ? 'selected' : '';
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
                <?php                            
                $main_disct = mysqli_query($config, "SELECT * FROM dir_city_master");
                while ($main_disct__ = mysqli_fetch_object($main_disct)) { 
                    $selected = (isset($_GET['district']) && $_GET['district'] == $main_disct__->dir_city_id) ? 'selected' : '';
                ?>
                    <option value="<?php echo $main_disct__->dir_city_id; ?>" <?php echo $selected; ?>>
                        <?php echo $main_disct__->dir_city_name; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
    </div>      
    <input type="hidden" name="search_input" class="form-control rounded-start border-primary" 
               placeholder="Search here..." value="<?php echo isset($_GET['search_input']) ? $_GET['search_input'] : ''; ?>">

    <div class="form-group row">
        <label for="city" class="col-sm-1 col-form-label">City</label>
        <div class="col-sm-2" id="area">
            <!-- City options will be populated dynamically -->
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

                    <hr>

                    <form method="GET" class="d-flex justify-content-center mt-3">
    <!-- Preserve existing GET parameters -->
    <input type="hidden" name="from_date" value="<?php echo isset($_GET['from_date']) ? $_GET['from_date'] : ''; ?>">
    <input type="hidden" name="to_date" value="<?php echo isset($_GET['to_date']) ? $_GET['to_date'] : ''; ?>">

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
                             <div class="card-body">
                             <form method="get" action="">
    <!-- Add your filters here -->
    <button type="submit" name="view_all" class="btn btn-primary">View All</button>
</form>


                             <h4 class="page-title">Registration Report</h4>
                             <table id="dtHorizontalExample" class="table table-striped table-bordered table-sm" cellspacing="0"
  width="100%">
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
                                          
                                            <th scope="col">Photo</th>
                                            <th scope="col">Whatsapp No</th>
                                            <th scope="col">State</th>

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
                                         </tr>
                                     </thead>
                                     <tbody> 

                                     <?php 
$records_per_page = 10;

// Get the current page number from the URL, default is 1 if not set
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the offset for the query based on the current page
$offset = ($page - 1) * $records_per_page;

// Initialize $where variable for the filter conditions
$where = " WHERE 1 "; // Default condition to allow dynamic filtering

// Handle form filter logic if 'date_filter' is set
if (isset($_GET['date_filter'])) {
    $from_date = $_GET['from_date'];
    $to_date = $_GET['to_date'];
    $main_category = $_GET['main_cate_Name'];
    $district = $_GET['district'];
    $city = $_GET['Add_area'];
    $state = $_GET['state'];  // New state filter

    // Add conditions dynamically if fields are filled
    if (!empty($from_date) && !empty($to_date)) {
        $where .= " AND create_on BETWEEN '$from_date' AND '$to_date' ";
    }
    if (!empty($main_category) && $main_category != '0') {
        $where .= " AND category_id = '$main_category' ";
    }
    if (!empty($district) && $district != '0') {
        $where .= " AND city_id = '$district' ";
    }
    if (!empty($city) && $city != '0') {
        $where .= " AND area_id = '$city' ";
    }
    if (!empty($state) && $state != '0')  {
        $where .= " AND state_id = '$state' ";
    }
}

if (!empty($_GET['search_input'])) {
    $search_value = mysqli_real_escape_string($config, $_GET['search_input']);
    $where .= " AND (create_post.driver_name LIKE '%$search_value%' 
                      OR create_post.vehicle_no LIKE '%$search_value%'
                      OR create_post.phone_no LIKE '%$search_value%'
                      OR create_post.whatsapp_no LIKE '%$search_value%')";
}

// Check if the "View All" button was clicked
if (isset($_GET['view_all'])) {
    // Get all records without pagination
    $total_records_query = mysqli_query($config, "SELECT COUNT(*) AS total FROM create_post $where");
    $total_records = mysqli_fetch_assoc($total_records_query)['total'];
    $total_pages = 1; // Only one page for "View All" without pagination

    // Fetch all records without LIMIT
    $Recent_customer = mysqli_query($config, "SELECT * FROM create_post $where");
} else {
    // Default query if no filter is applied or "View All" is not clicked
    $total_records_query = mysqli_query($config, "SELECT COUNT(*) AS total FROM create_post $where");
    $total_records = mysqli_fetch_assoc($total_records_query)['total'];
    $total_pages = ceil($total_records / $records_per_page);

    // Fetch records with pagination
    $Recent_customer = mysqli_query($config, "SELECT * FROM create_post $where LIMIT $records_per_page OFFSET $offset");
}
$mc = $offset + 1;    
// Loop to display records
while ($recent_cust = mysqli_fetch_object($Recent_customer)) { 
                                          
                                           // echo $query="select * from post_main_category where Main_Category_id='$recent_cust->main_cate_id' order by Main_Category_id  DESC";
                                            $Recent_customer_=mysqli_query($config,"select * from main_category where  Main_Category_id='$recent_cust->category_id' order by Main_Category_id  DESC ");
                                            $recent_cust__=mysqli_fetch_object($Recent_customer_);

                                            $customer_=mysqli_query($config,"select * from sub_category where  Sub_Category_id='$recent_cust->subcategory_id' order by Sub_Category_id  DESC ");
                                            $cust__=mysqli_fetch_object($customer_);

                                              $cus_=mysqli_query($config,"select * from customer_master where Customer_Phone_No='$recent_cust->phone_no' ");
                                            $cust___=mysqli_fetch_object($cus_);

                                            $cus_city=mysqli_query($config,"select * from dir_city_master where dir_city_id='$recent_cust->city_id' ");
                                            $cus_city__=mysqli_fetch_object($cus_city);

                                            $cus_state=mysqli_query($config,"select * from dir_state_master where state_id='$recent_cust->state_id' ");
                                            $cus_state__=mysqli_fetch_object($cus_state);

                                            $cus_area=mysqli_query($config,"select * from dir_area_master where dir_area_id='$recent_cust->area_id' ");
                                            $cus_area__=mysqli_fetch_object($cus_area);


                                            $cus_=mysqli_query($config,"select * from customer_master where Customer_Phone_No='$recent_cust->phone_no' ");
                                            $cust___=mysqli_fetch_object($cus_);

                                            $cus_package_name=mysqli_query($config,"select * from category_package where package_id ='$recent_cust->package_id ' ");
                                            $cust_package_name_=mysqli_fetch_object($cus_package_name);



                                            $cus_vehicle_type=mysqli_query($config,"select * from vehicle_type where Vehicle_type_id='$recent_cust->vehicle_type_id' ");
                                            $cus_vehicle_type__=mysqli_fetch_object($cus_vehicle_type);
                                            $online_payment_transcation=mysqli_query($config,"select * from online_payment_transcation where Customer_id='$recent_cust->customer_id' ");
                                            $online_payment_transcation_1=mysqli_fetch_object($online_payment_transcation);
                                            
                                            $paidTransactionID = $online_payment_transcation_1->transactionId;
                                            $paidAmount = $macate->Paid_Amout;
                                            $paymentType = $recent_cust->payment_type; // 1 = Admin Cash, 2 = Admin Cash + Transaction
                                            $refNo = $recent_cust->ref_no; // Transaction number
                                            $packageAmount = $recent_cust->package_amount; // Amount for package
                                        
                                            // Determine Payment Status
                                            if (!empty($paidAmount)) {
                                                $paymentStatus = "Paid (Transaction ID: $paidTransactionID)";
                                                $amount = "₹$paidAmount";
                                            } elseif ($paymentType == '1') {
                                                $paymentStatus = "Admin Cash";
                                                $amount = "₹$packageAmount";
                                            } elseif ($paymentType == '2') {
                                                $paymentStatus = "Admin Cash + Transaction (Ref No: $refNo)";
                                                $amount = "₹$packageAmount";
                                            } 
                                            elseif($paymentType == '0' && $packageAmount== '0'){
                                                $paymentStatus = "Free";
                                                $amount = "₹$packageAmount";
                                            }
                                            
                                            elseif($paymentType == '0' && $packageAmount!= '0'){
                                                $paymentStatus = "Paid (Transaction ID: $paidTransactionID)";
                                                $amount = "₹$packageAmount";
                                            }else {
                                                $paymentStatus = "Not Paid";
                                                $amount = "-";
                                            }
                                         ?>
                         
                         
                             <tr>
                                             <td><?php echo $mc; ?></td>

                                             
                                             <td><?php echo $recent_cust->driver_name; ?></td>
                                             <td><?php echo $recent_cust->phone_no; ?></td>
                                                 <td><?php echo $recent_cust__->Main_Category_Name; ?></td>
                                                 <td><?php echo $cust__->Sub_Category_Name; ?></td>
                                                 <td><?php echo $cus_vehicle_type__->Vehicle_type_name; ?></td>
                                                 <td><?php echo $recent_cust->vehicle_name; ?></td>
                                                 <td><?php echo $recent_cust->vehicle_no; ?></td>
                                                 <td><?php echo $recent_cust->Add_RC_owner_name; ?></td>
                                                 <?php if($recent_cust->tonnage) { ?>
                                                 <td><?php echo $recent_cust->tonnage; ?></td>
                                                 <?php } else { ?>
                                                  <td></td>
                                                  <?php } ?>

                                                  <?php if($recent_cust->seating_capacity) { ?>
                                                 <td><?php echo $recent_cust->seating_capacity; ?></td>
                                                 <?php } else { ?>
                                                  <td></td>
                                                  <?php } ?>


                                                  <?php if($recent_cust->facilities) { ?>
                                                 <td><?php echo $recent_cust->facilities; ?></td>
                                                 <?php } else { ?>
                                                  <td></td>
                                                  <?php } ?>

                                                  <?php if($recent_cust->space) { ?>
                                                 <td><?php echo $recent_cust->space; ?></td>
                                                 <?php } else { ?>
                                                  <td></td>
                                                  <?php } ?>
                                                  
                                                  <?php if($recent_cust->Add_location) { ?>
                                                 <td><?php echo $recent_cust->Add_location; ?></td>
                                                 <?php } else { ?>
                                                  <td></td>
                                                  <?php } ?>

                                                  <?php if($recent_cust->Add_insurance_exp_date) { ?>
                                                 <td><?php echo $recent_cust->Add_insurance_exp_date; ?></td>
                                                 <?php } else { ?>
                                                  <td></td>
                                                  <?php } ?>

                                                  <?php if($recent_cust->stand_name) { ?>
                                                 <td><?php echo $recent_cust->stand_name; ?></td>
                                                 <?php } else { ?>
                                                  <td></td>
                                                  <?php } ?>

                                                  <?php if($recent_cust->shop_name) { ?>
                                                 <td><?php echo $recent_cust->shop_name; ?></td>
                                                 <?php } else { ?>
                                                  <td></td>
                                                  <?php } ?>

                                                  <?php if($recent_cust->shop_address) { ?>
                                                 <td><?php echo $recent_cust->shop_address; ?></td>
                                                 <?php } else { ?>
                                                  <td></td>
                                                  <?php } ?>

                                                  <?php if($recent_cust->work_nature) { ?>
                                                 <td><?php echo $recent_cust->work_nature; ?></td>
                                                 <?php } else { ?>
                                                  <td></td>
                                                  <?php } ?>
                                                


                                                  <td><img src="../../photos/vehicle/<?php echo $recent_cust->vehicle_photo; ?>" style="height: 131px !important; width: 150px !important;margin: auto;"></td>
                                                  
                                                  <td><?php echo $recent_cust->whatsapp_no; ?></td>
                                                  
                                                  <td><?php echo $cus_state__->name; ?></td>

                                                  <td><?php echo $cus_city__->dir_city_name; ?></td>
                                                  <td><?php echo $cus_area__->dir_area_name; ?></td>
                                                  <td>
                                                    <?php  
                                             
                                                 $main_cate_date = strtotime($recent_cust->create_on);
           echo  date('d-m-Y',$main_cate_date).'<br>';
        //    echo  date('h:m a',$main_cate_date);
                                             
                                             ?></td>
                                              <td><?php  
                                             
                                             $main_cate_date = strtotime($recent_cust->expiry_date);
                                             echo  date('d-m-Y',$main_cate_date).'<br>';  
                                         
                                         ?></td>
                                        
                                             <td><?php echo $recent_cust->reffered_by_phone_no; ?></td>
                                             <td><?php echo $recent_cust->reffered_by_name; ?></td>

                                             <td><?php echo $cust_package_name_->package_title; ?></td>
                                             <td><?php echo $recent_cust->package_days; ?></td>

                                                  <?php if($recent_cust->coupon_type) { ?>
                                                 <td><?php echo $recent_cust->coupon_type; ?></td>
                                                 <?php } else { ?>
                                                  <td></td>
                                                  <?php } ?>

                                                  <?php if($recent_cust->discount_name) { ?>
                                                 <td><?php echo $recent_cust->discount_name; ?></td>
                                                 <?php } else { ?>
                                                  <td></td>
                                                  <?php } ?>

                                                  <?php if($recent_cust->discount_amount) { ?>
                                                 <td><?php echo $recent_cust->discount_amount; ?></td>
                                                 <?php } else { ?>
                                                  <td></td>
                                                  <?php } ?>

                                                  <td><?php echo $paymentStatus; ?></td>

                                                  <?php if($recent_cust->net_amount) { ?>
                                                 <td><?php echo $recent_cust->net_amount; ?></td>
                                                 <?php } else { ?>
                                                  <td><?php echo $recent_cust->package_amount; ?></td>
                                                  <?php } ?>


                                            
                                              
                                         </tr>
                                          <?php   $mc++;} ?>
                                     </tbody>
                                 </table>
                                 <div class="pagination">
    <?php
    // Get existing query parameters and remove 'page' to avoid duplication
    $query_params = $_GET;
    unset($query_params['page']); 
    $query_string = http_build_query($query_params); 
    $query_string = $query_string ? "&$query_string" : '';

    // Display 'Previous' button if not on the first page
    if ($page > 1) {
        echo '<a href="?page=' . ($page - 1) . $query_string . '" class="prev">Previous</a>';
    }

    // Determine the range of page numbers to display
    $start_page = max(1, $page - 2);
    $end_page = min($total_pages, $page + 2);

    // Display first page and ellipsis if needed
    if ($start_page > 1) {
        echo '<a href="?page=1' . $query_string . '">1</a>';
        if ($start_page > 2) {
            echo '<span class="dots">...</span>';
        }
    }

    // Display the range of page numbers
    for ($i = $start_page; $i <= $end_page; $i++) {
        if ($i == $page) {
            echo '<span class="current">' . $i . '</span>';
        } else {
            echo '<a href="?page=' . $i . $query_string . '">' . $i . '</a>';
        }
    }

    // Display last page and ellipsis if needed
    if ($end_page < $total_pages) {
        if ($end_page < $total_pages - 1) {
            echo '<span class="dots">...</span>';
        }
        echo '<a href="?page=' . $total_pages . $query_string . '">' . $total_pages . '</a>';
    }

    // Display 'Next' button if not on the last page
    if ($page < $total_pages) {
        echo '<a href="?page=' . ($page + 1) . $query_string . '" class="next">Next</a>';
    }
    ?>
</div>


<style>
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
    }
    .pagination a, .pagination .current {
        text-decoration: none;
        padding: 8px 12px;
        margin: 0 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f0f0f0;
        color: #333;
    }
    .pagination .current {
        background-color: #007bff;
        color: #fff;
        cursor: default;
    }
    .pagination .prev, .pagination .next {
        font-weight: bold;
        padding: 8px 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f0f0f0;
        color: #333;
    }
    .pagination .dots {
        padding: 8px 12px;
        margin: 0 5px;
        background-color: #f0f0f0;
        color: #333;
    }
    .pagination a:hover, .pagination .prev:hover, .pagination .next:hover {
        background-color: #007bff;
        color: #fff;
    }
</style>
<style>
            .dataTables_filter{
display: none !important;
            }
        </style>
                                 <div class="card-header">

                                 <a href="post_report_export.php?from_date=<?php echo $_GET['from_date']; ?>&to_date=<?php echo $_GET['to_date']; ?>&main_cate_Name=<?php echo $_GET['main_cate_Name']; ?>&district=<?php echo $_GET['district']; ?>&Add_area=<?php echo $_GET['Add_area']; ?>&state=<?php echo $_GET['state']; ?>&search_input=<?php echo $_GET['search_input']; ?><?php echo $_GET['view_all'] ?'&view_all=': ''; ?>" class="btn btn-success">
    Export to Excel
</a>


<!-- <a style="float: right;" target="_black" class="btn btn-danger" href="https://www.md5online.org/md5-decrypt.html">MD5 Decryption</a> -->
</div>
                             </div>
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
                "info": false,      // Hides "Showing X to Y of Z entries" text
        "paging": true,     // Keep pagination enabled
        "lengthChange": false, // Hide "Show X entries" dropdown
        "dom": 'lrtp'       // Removes additional DataTables UI elements
			});

		});

	</script>

</body>

</html>





<script>
   $(document).ready(function() {
  var counter = 2;
  $("#addButton").click(function() {
    if (counter < 2) {
      alert("Add more textbox");
      return false;
    }

    var newTextBoxDiv = $(document.createElement('div'))
      .attr("id", 'TextBoxDiv' + counter).attr("class", 'TextBoxDiv');
       
    newTextBoxDiv.after().html('<label>Area ' + counter + ' : </label>' +
      '<input type="text"  class="form-control" id="email2" name="area[]" id="textbox' + counter + '"  placeholder="Enter area Name"  >' +
      '<input type="button" name="button' + counter +
      '" class="removeButton btn btn-danger btn-sm" value="Remove Area">');
    newTextBoxDiv.appendTo("#TextBoxesGroup");
  
    counter++;
  });

  $("body").on("click", ".removeButton", function() {
    if (counter <= 2) {
      alert("No more textbox to remove");
      return false;
    }

    $(this).closest('.TextBoxDiv').remove();
  });
});
</script>


<style>
    .btn-danger {
    background: #f25961!important;
    border-color: #f25961!important;
    margin-top: 7px;
    margin-bottom: 4px;
}
</style>

<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel"></h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <div class="modal-body">

        <form action="Function/dir_area_master.php" method="POST" enctype="multipart/form-data">
		<div class="form-group">

<label for="email2">City Name</label>



<select name="cate" class="form-select form-control" aria-label="Default select example">
  <option selected>Select </option>
  <?php 

										

											$main_cate1=mysqli_query($config,"select * from dir_city_master ");

											while($macate1=mysqli_fetch_object($main_cate1))

											{

											?>
  <option value="<?php echo $macate1->dir_city_id?>"><?php echo $macate1->dir_city_name?></option>
 <?php }?>
</select>
</div>  
	
	
		<div class="form-group" >
      
		

			<input type="file"   class="form-control" id="email2" name="excel"  placeholder="Enter area Name"  > <br>
			<small> <b style="color: red;">Only For CSV Format  File <b></small>
            </div>
			<div class="form-group" >
				<a href="Area_demo.csv"  download="Area_demo.csv" >Demo Csv File Download</a>
	  </div>
      </div>
	  <div class="form-group" >
	  </div>
      <div class="modal-footer">

      <button class="btn btn-primary" type="submit" name="exsubmit">Submit</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	</form>
        

      </div>

    </div>

  </div>

</div>

<script>

  


function sub_area(id){
                     var id;
                   //alert(id);
             
                    $.ajax({
                        type: "POST",
                        url:'sub_area_post.php',
                        data: {id:id}, // serializes the form's elements.
                        success: function(data)
                        {	
                            //alert(data);		
                            console.log(data)
                        $('#sa').html(data);
                        
                        }			
                    });	
                    
                  }

 function area(id) {
               
  var id =id;

            $.ajax({
                type: "POST",
                url: "area_post.php",
                data:{id:id}, 
                success: function(data)
                {
                
                $('#area').html(data);

                console.log(data);
                }
            });
            }
            $(document).ready(function () {
    $('#dtHorizontalExample').DataTable({
        "scrollX": true,    // Enables horizontal scrolling
        "paging": false     // Disables pagination
    });
    $('.dataTables_length').addClass('bs-select');
});

  </script>
  <script>
    $(document).ready(function() {
        $('#state').on('change', function() {
            var stateId = $(this).val(); // Get the selected state ID
            $('#Add_area').html('<option value="">---SELECT---</option>');

            
            // Clear and reset the district dropdown
            $('#district').html('<option value="">---SELECT---</option>');

            if (stateId) {
                $.ajax({
                    url: 'fetch_districts.php',
                    type: 'POST',
                    data: { state_id: stateId },
                    success: function(response) {
                        // Populate the district dropdown with options
                        $('#district').html(response);
                    },
                    error: function() {
                        alert('Failed to fetch districts. Please try again.');
                    }
                });
            }
        });
    });
</script>
