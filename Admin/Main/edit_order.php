<?php include('../config/setup.php');
$order_id = $_GET['order_id'] ?? 0;

$query = mysqli_query($config, "SELECT * FROM orders WHERE id = '$order_id'");
$order = mysqli_fetch_assoc($query);

// If not found, redirect or show error
if (!$order) {
    echo "Order not found!";
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title><?php

			$leename = mysqli_query($config, "select Name,Name_status from lee_master");
			while ($lee = mysqli_fetch_array($leename)) {
				$namestatus = $lee[1];
				if ($namestatus == 1) {
					echo  $lee[0];
				} else {
					echo "Need Name";
				}
			}

			?> </title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="<?php

							$inro_logo = mysqli_query($config, "select Logo_Path,logo_status from lee_master");
							while ($logo = mysqli_fetch_array($inro_logo)) {
								$logstatus = $logo[1];
								if ($logstatus == 1) {

									$ms = substr($logo[0], 3);
									echo  $ms;
								} else {
									echo "../../photos/logo/no_logo.png";
								}
							}

							?>" type="image/x-icon" />

	<!-- Fonts and icons -->
	<script src="../assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {
				"families": ["Lato:300,400,700,900"]
			},
			custom: {
				"families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
				urls: ['../assets/css/fonts.min.css']
			},
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

	<!-- Include jQuery first -->
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

	<!-- Include SweetAlert2 (after jQuery) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        .sug-list {
    /* background: #ced4da; */
    list-style: none;
    content: '';
    line-height: 40px;
    border-bottom: 1px solid #ced4da;
    margin-left: -39px;
    padding: 7px;
    border-left: 1px solid #ced4da;
    border-right: 1px solid #ced4da;
}
    </style>
</head>
<style>
	.pages {
		padding: 10px;
		border: 1px solid;
		border-radius: 15px;
		margin-left: 10px !important;
	}

	.current {
		background: #1572e8;
		color: white;
	}
</style>

<body>
	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
			<?php include('logo.php'); ?>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<?php include('topbar.php'); ?>
			<!-- End Navbar -->
		</div>
		<!-- Sidebar -->
		<?php include('sidebar.php'); ?>
<?php
// Handle cancellation
if (isset($_POST['cancel_order'])) {
    $cancel_id = $_POST['cancel_order_id'];
    $update = mysqli_query($config, "UPDATE orders SET status='cancelled' WHERE id='$cancel_id' AND status!='Completed'");

    if ($update) {
        echo "<script>alert('Order cancelled successfully.');window.location.href='edit_order.php';</script>";
    } else {
        echo "<script>alert('Unable to cancel order.');</script>";
    }
}
?>

		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="page-header">
					<div class="page-header d-flex justify-content-between align-items-center">
    <h4 class="page-title">Edit Order </h4>

     <div class="page-header d-flex justify-content-between align-items-center">
               

                <?php if ($order && $order['status'] != 'Completed') { ?>
                     
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="cancel_order_id" value="<?php echo $order_id; ?>">
                        <button type="submit" name="cancel_order" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to cancel this order?');">
                            Cancel Order
                        </button>
                    </form>
                <?php } ?>
            </div>
  </div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div id="successMessage" style="display: none; color: green; font-weight: bold;"></div>

							<?php if (isset($_GET['msg'])) {
							?>
								<div class="alert alert-primary" role="alert">
									Post Succesfully Added!!!
								</div>
							<?php }
							?>
							<?php if (isset($_GET['msgerror'])) { ?>
								<div class="alert alert-primary" role="alert">
									Check The Post OR Date Will be Not Expiry!!!
								</div>

							<?php } ?>

<!-- Order Workflow Status Section -->
<div class="card mb-3">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">📋 Order Workflow Status</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <?php
            $order_status = strtolower(trim($order['status']));
            
            // Define workflow steps
            $steps = [
                'pending' => ['icon' => '⏳', 'label' => 'Order Pending', 'class' => 'badge-warning'],
                'accepted' => ['icon' => '✅', 'label' => 'Driver Accepted', 'class' => 'badge-info'],
                'started' => ['icon' => '🚗', 'label' => 'Trip Started', 'class' => 'badge-primary'],
                'ended' => ['icon' => '🏁', 'label' => 'Trip Ended', 'class' => 'badge-secondary'],
                'completed' => ['icon' => '✓', 'label' => 'Completed', 'class' => 'badge-success'],
                'cancelled' => ['icon' => '❌', 'label' => 'Cancelled', 'class' => 'badge-danger']
            ];
            
            $currentStepIndex = array_search($order_status, array_keys($steps));
            
            foreach ($steps as $step_key => $step) {
                $isCurrent = ($step_key == $order_status);
                $isCompleted = ($currentStepIndex !== false && array_search($step_key, array_keys($steps)) <= $currentStepIndex);
                
                $iconColor = $isCompleted ? 'text-success' : 'text-muted';
                $stepClass = $isCurrent ? $step['class'] : 'badge-secondary';
            ?>
            <div class="col-md-2 text-center">
                <div class="p-2">
                    <span class="badge <?= $isCurrent ? $stepClass : 'badge-secondary' ?> badge-lg" style="font-size: 0.9rem;">
                        <?= $step['icon'] ?> <?= $step['label'] ?>
                    </span>
                </div>
            </div>
            <?php if ($step_key != 'completed' && $step_key != 'cancelled'): ?>
            <div class="col-md-2 text-center">
                <div class="p-2">
                    <span class="<?= $isCompleted ? 'text-success' : 'text-muted' ?>">⟶</span>
                </div>
            </div>
            <?php endif; ?>
            <?php } ?>
        </div>
        
        <?php
        // Fetch additional order details
        $orderDetailsQuery = "SELECT 
            o.*, 
            odb.bid_amount, odb.bid_time,
            cp.driver_name, cp.phone_no,
            cp2.driver_name as accepted_driver_name, cp2.phone_no as accepted_driver_phone
        FROM orders o
        LEFT JOIN order_driver_bids odb ON o.id = odb.order_id 
            AND odb.customer_status = 'accepted'
        LEFT JOIN create_post cp ON odb.driver_id = cp.customer_id
        LEFT JOIN create_post cp2 ON o.driver_id = cp2.customer_id
        WHERE o.id = '$order_id'";
        
        $orderDetailsResult = mysqli_query($config, $orderDetailsQuery);
        $orderDetails = mysqli_fetch_assoc($orderDetailsResult) ?: $order;
        ?>
        
        <!-- Show additional details based on status -->
        <?php if ($order_status == 'accepted' || $order_status == 'started' || $order_status == 'ended' || $order_status == 'completed'): ?>
        <hr>
        <div class="row mt-3">
            <div class="col-md-6">
                <h6>Driver Information:</h6>
                <p><strong>Name:</strong> <?= $orderDetails['driver_name'] ?? 'N/A' ?></p>
                <p><strong>Phone:</strong> <?= $orderDetails['phone_no'] ?? 'N/A' ?></p>
                <?php if (!empty($orderDetails['bid_amount'])): ?>
                    <p><strong>Accepted Quote:</strong> ₹<?= number_format($orderDetails['bid_amount'], 2) ?></p>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
        
        <?php if (($order_status == 'started' || $order_status == 'ended' || $order_status == 'completed') && !empty($order['start_time'])): ?>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <h6>Trip Details:</h6>
                <p><strong>Start Time:</strong> <?= date('d M Y h:i A', strtotime($order['start_time'])) ?></p>
                <p><strong>Start KM:</strong> <?= $order['start_km'] ?? 'N/A' ?></p>
            </div>
        </div>
        <?php endif; ?>
        
        <?php if (($order_status == 'ended' || $order_status == 'completed') && !empty($order['end_time'])): ?>
        <div class="row">
            <div class="col-md-6">
                <p><strong>End Time:</strong> <?= date('d M Y h:i A', strtotime($order['end_time'])) ?></p>
                <p><strong>End KM:</strong> <?= $order['ending_km'] ?? 'N/A' ?></p>
                <?php if (!empty($order['start_km']) && !empty($order['ending_km'])): ?>
                    <p><strong>Net KM:</strong> <?= $order['ending_km'] - $order['start_km'] ?> km</p>
                <?php endif; ?>
                <p><strong>Travel Hours:</strong> <?= $order['travel_hrs'] ?? 'N/A' ?></p>
                <p><strong>Trip Amount:</strong> ₹<?= number_format($order['trip_amount'], 2) ?></p>
                <p><strong>Total Amount:</strong> ₹<?= number_format($order['total_amount'], 2) ?></p>
            </div>
        </div>
        <?php endif; ?>
        
        <?php if ($order_status == 'completed' && !empty($order['payment_status'])): ?>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <h6>Payment Details:</h6>
                <p><strong>Payment Status:</strong> <?= ucfirst($order['payment_status']) ?></p>
                <?php if (!empty($order['cash_received'])): ?>
                    <p><strong>Cash Received:</strong> ₹<?= number_format($order['cash_received'], 2) ?></p>
                <?php endif; ?>
                <?php if (!empty($order['bank_received'])): ?>
                    <p><strong>Bank Received:</strong> ₹<?= number_format($order['bank_received'], 2) ?></p>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

							<div class="card">
							<div class="card-header">

</div>
								<div class="card-body">
											

								
										
                                    <form id="editorderForm" method="post">
                                    <div class="row clearfix" style="margin-left: -10px;">

                                        <input type="hidden" name="form_token" value="<?php echo $token; ?>">
                                        <input type="hidden" name="cust_id"   value="<?= $order['cust_id'] ?>" id="cust_id">
                                        <input type="hidden" name="order_id"   value="<?= $order['id'] ?>" id="cust_id">

                                        <div class="form-group col-md-6">    
                                                    <label for="email2">Customer Name</label>
                                                    <input type="text" class="form-control" id="Add_driver_name1" name="Add_driver_name" value="<?= $order['name'] ?>"required readonly >
                                                    
                                                </div>
                                                <div class="form-group col-md-6">    
                                                    <label for="email2">Customer Phone No</label>
                                                    <input type="hidden" class="form-control" name="customerid" id="customerid"
                                                    placeholder="">
                                                    <input type="hidden" class="form-control" name="name" id="name">
                                                    <input type="hidden" class="form-control" name="customer_phone" id="customer_phone">
                                                    <input type="number" class="form-control" id="phone_no1" name="Add_phone_no" value="<?= $order['customer_phone'] ?>"  required readonly >
                                                </div>
                                     
                                                <div class="form-group col-md-6">
                                            <label for="email2">vechicle Type</label>
                                            <select 
  class="form-control" 
  name="Add_main_cate" 
  id="mainCategorySelect" 
  data-loaded="false"
  required
>
    <option value="">---SELECT---</option>
    <?php
    $selectedVal = $order['Add_main_cate'] ?? ''; // or from DB like $order['main_category']
    $main_cate = mysqli_query($config, "SELECT * FROM main_category WHERE Main_Category_Status = '1' AND Main_Category_id IN (1, 2)");
    while ($addsubcate = mysqli_fetch_object($main_cate)) {
        $selected = ($selectedVal == $addsubcate->Main_Category_id) ? 'selected' : '';
        echo "<option value='$addsubcate->Main_Category_id' $selected>$addsubcate->Main_Category_Name</option>";
    }
    ?>
</select>


                                        </div>


                                        <div class="form-group col-md-6">
                                            <label for="email2">Sub Category Name</label>
                                            <div id="sc">
                                                <!-- Sub-category options will be loaded here -->
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="vehicle_type">Required Vehicle Model:</label>
                                            <input type="text" class="form-control" id="required_vehicle_type" name="requiredvehicle_type" value="<?= $order['requiredvehicle_type'] ?>"  placeholder="Enter vehicle type" required>
                                        </div>
                                        <div class="form-group col-md-6">
    <label for="vehicle_required_datetime">Vehicle Required Date & Time</label>
    <input 
    type="text" 
    class="form-control" 
    id="vehicle_required_datetime" 
    name="vehicle_required_datetime"  
    placeholder="Enter Date & Time" 
    value="<?= isset($order['vehicle_required_datetime']) ? date('Y-m-d H:i', strtotime($order['vehicle_required_datetime'])) : '' ?>" 
    required>
</div>

<div class="form-group col-md-6 goods-only">
    <label>Vehicle Body Type</label><br>

    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="vehicle_body_type" id="openBody" value="Open"
            <?php if (isset($order['vehicle_body_type']) && $order['vehicle_body_type'] == "Open") echo "checked"; ?> required>
        <label class="form-check-label" for="openBody">Open Body</label>
    </div>

    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="vehicle_body_type" id="closeBody" value="Close"
            <?php if (isset($order['vehicle_body_type']) && $order['vehicle_body_type']== "Close") echo "checked"; ?>>
        <label class="form-check-label" for="closeBody">Closed Body</label>
    </div>
</div>



<?php
$selected_state_id = $order['from_state'] ?? '';
$selected_district_id = $order['from_district'] ?? '';
$selected_city_id = $order['from_city'] ?? '';
?>

                                    
                                      
                                        <div class="form-group col-md-6">
    <label for="from_state">From State</label>
    <select required class="form-control" id="from_state" name="from_state" onchange="loadDistricts(this.value)" required>
    <option value="">---SELECT---</option>
<?php
$states_query = mysqli_query($config, "SELECT * FROM dir_state_master");
while($state = mysqli_fetch_object($states_query)) {
    $selected = ($selected_state_id == $state->state_id) ? 'selected' : '';
    echo '<option value="'.$state->state_id.'" '.$selected.'>'.$state->name.'</option>';
}
?>

    </select>
</div>

<div class="form-group col-md-6">
    <label for="from_district">From District</label>
    <select required class="form-control" id="from_district" name="from_district" required>
        <option value="">---SELECT---</option>
        <?php
        $districts_query = mysqli_query($config, "SELECT * FROM dir_city_master");
        while($district = mysqli_fetch_object($districts_query)) {
            $selected = ($selected_district_id  == $district->dir_city_id) ? 'selected' : '';

            echo '<option value="'.$district->dir_city_id.'"'.$selected.'>'.$district->dir_city_name.'</option>';
        }
        ?>
    </select>
</div>
<div class="form-group col-md-6" id="from_city_container" style="display: none;">
                                        <label>From City</label>
                                        <select class="form-control" id="from_city_select" name="from_city" required>
                                            <option value="">--Select City--</option>
                                        </select>
                                    </div>
<div class="form-group col-md-6">    
    <label for="loader_from_place">Pickup Place</label>
    <input type="text" class="form-control" id="loader_from_place" name="loader_from_place" placeholder="Location Name"  value="<?= $order['loader_from_place'] ?>" required>
</div>
<?php 
$selected_to_state_id = $order['to_state'] ?? '';
$selected_to_district_id = $order['to_district'] ?? '';
$selected_to_city_id = $order['to_city'] ?? '';


?>
<!-- TO STATE -->
<div class="form-group col-md-6">
    <label for="to_state">To State</label>
    <select required class="form-control" id="to_state" name="to_state" onchange="toloadDistricts(this.value)">
        <option value="">---SELECT---</option>
        <?php
        $states_query = mysqli_query($config, "SELECT * FROM dir_state_master");
        while($state = mysqli_fetch_object($states_query)) {
            $selected = ($selected_to_state_id == $state->state_id) ? 'selected' : '';
            echo '<option value="'.$state->state_id.'" '.$selected.'>'.$state->name.'</option>';
        }
        ?>
    </select>
</div>

<!-- TO DISTRICT -->
<div class="form-group col-md-6">
    <label for="to_district">To District</label>
    <select required class="form-control" id="to_district" name="to_district">
        <option value="">---SELECT---</option>
        <?php
        $districts_query = mysqli_query($config, "SELECT * FROM dir_city_master");
        while($district = mysqli_fetch_object($districts_query)) {
            $selected = ($selected_to_district_id == $district->dir_city_id) ? 'selected' : '';
            echo '<option value="'.$district->dir_city_id.'" '.$selected.'>'.$district->dir_city_name.'</option>';
        }
        ?>
    </select>
</div>

                                    </div>
                                   
                                   

                                   <!-- TO CITY DROPDOWN -->
<div class="form-group col-md-6" id="to_city_container" style="display: none;">
    <label>To City</label>
    <select class="form-control" id="to_city" name="to_city">
        <option value="">--Select City--</option>
    </select>
</div>

<!-- SCRIPT FOR SETTING TO CITY -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const selectedToCityId = "<?php echo $selected_to_city_id ?? ''; ?>";
    const selectedToDistrictId = "<?php echo $selected_to_district_id ?? ''; ?>";

    if (selectedToDistrictId) {
        $('#to_district').val(selectedToDistrictId).trigger('change');

        $.ajax({
            url: '../../App/get_city_name.php',
            type: 'GET',
            data: { id: selectedToDistrictId },
            dataType: 'json',
            success: function(data) {
                let cityOptions = '<option value="">--Select City--</option>';
                data.forEach(function(city) {
                    const selected = city.id == selectedToCityId ? 'selected' : '';
                    cityOptions += `<option value="${city.id}" ${selected}>${city.name}</option>`;
                });
                $('#to_city').html(cityOptions);
                $('#to_city_container').show();
            }
        });
    }
});
</script>


                                    <div class="row clearfix">

                                        <!-- <div class="form-group col-md-6">    
                                                <label for="email2">Load Pick Up Place</label>
                                                <input   type="text" class="form-control" id="loader_from_place" name="loader_from_place" required >
                                                </div>   -->

                                        <div class="form-group col-md-6 passenger-only" style="display: none;">
                                            <label for="drop_place">Drop Place</label>
                                            <input type="text" class="form-control" id="drop_place" name="drop_place" value="<?= $order['drop_place'] ?>" placeholder="Drop Place">
                                        </div>

                                        <div class="form-group col-md-6 goods-only" style="display: none;">
                                            <label for="loader_to_place">Delivery Place</label>
                                            <input type="text" class="form-control" id="loader_to_place" name="loader_to_place" value="<?= $order['loader_to_place'] ?>" placeholder="Location Name">
                                        </div>

                                        <div class="form-group col-md-6" required>
                                            <label for="total_km">Total Km</label>
                                            <input type="text" class="form-control" id="total_km" name="total_km" value="<?= $order['total_km'] ?>" placeholder="Approximate Total Km" required>
                                        </div>

                                        <div class="form-group col-md-6 passenger-only" style="display: none;">
                                            <label for="n_ofperson">Number of Person</label>
                                            <input type="text" class="form-control" id="n_ofperson" name="n_ofperson" value="<?= $order['n_ofperson'] ?>" placeholder="Number of Person">
                                        </div>

                                        <div class="form-group col-md-6 goods-only"  value="<?= $order['total_weight'] ?>" style="display: none;">
    <label for="total_weight">Total Weight (in Kgs)</label>
    <input 
        type="text" 
        class="form-control" 
        id="total_weight" 
        name="total_weight" 
        placeholder="Total Weight"
        inputmode="decimal"
        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1'); 
                         if(this.value.includes('.')) {
                             const parts = this.value.split('.');
                             if(parts[1].length > 2) parts[1] = parts[1].slice(0, 2);
                             this.value = parts[0] + '.' + parts[1];
                         }"
    >
</div>

<div class="form-group col-md-6">
    <label>Trip Type</label><br>

    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" 
               name="trip_type" id="oneWay" value="One Way"
               <?php if ($order['trip_type'] == "One Way") echo "checked"; ?> required>
        <label class="form-check-label" for="oneWay">One Way Trip</label>
    </div>

    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" 
               name="trip_type" id="roundTrip" value="Round Trip"
               <?php if ($order['trip_type'] == "Round Trip") echo "checked"; ?>>
        <label class="form-check-label" for="roundTrip">Round Trip</label>
    </div>
</div>

                                        <div class="form-group col-md-6 goods-only" style="display: none;">
                                            <label for="product_details">Metrial Details</label>
                                            <input type="text" class="form-control" id="product_details" name="product_details"   value="<?= $order['product_details'] ?>" placeholder="Product Details" >
                                        </div>
                                       

                                        <!-- <div class="form-group col-md-6">    
 <label for="email2">Available Space</label>
 <input  type="text" class="form-control" id="loader_space" name="loader_space"  >
</div>   -->

                                      


                                        <input type="hidden" value="'<?php echo $id ?>'" class="form-control" id="post_id" name="post_id">

                                        <div class="form-group">

                                            <button type="submit" class="btn btn-success ml-1"  onclick="submitOrder(event)">Update order</a>
                                                <!-- <button type="button" class="btn btn-secondary ml-2" data-dismiss="modal">Close</button> -->
                                        </div>
                                        <?php

                                        ?>
                                    </div>



                                </form>
		     <?php if ($order && $order['status'] != 'accepted') { ?>

 <!-- Left Column: Driver -->
    <div class="row g-4 align-items-start">
  <!-- Left Side: Driver Search -->
  <div class="col-md-12">
    <h4>Driver</h4>
    <div class="row">
  <!-- Column 1: Customer Name -->
  <div class="col-md-4">
    <div class="form-group">
      <label>Driver Name</label>
      <input type="text" class="form-control" id="Add_driver_name" onkeyup="cum(this.value)" name="Add_driver_name" required>
      <div id="serach_result">
        <ul class="subnav sug-list-color" id="serach_result1"></ul>
      </div>
    </div>
  </div>

  <!-- Column 2: Customer Phone -->
  <div class="col-md-4">
    <div class="form-group">
      <label>Driver Phone No</label>
      <input type="hidden" name="customerid" id="customerid">
      <input type="hidden" name="name" id="name">
      <input type="hidden" name="customer_phone" id="customer_phone">
      <input type="number" class="form-control" id="phone_no" name="Add_phone_no" onkeypress="if(this.value.length==10) return false;" required>
    </div>
  </div>

  <!-- Column 3: Find Order -->
  <div class="col-md-4">
    <h4>Find Order</h4>
    <button type="button" class="btn btn-primary mb-2" onclick="findOrder()">🔍 Find</button>
    <div id="order_result" class="mt-3"></div>
  </div>
</div>


<!-- Driver Amount Modal -->
<div class="modal fade" id="bidModal" tabindex="-1" role="dialog" aria-labelledby="bidModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
  <form id="bidForm" class="modal-content">
  <div class="modal-header">
        <h5 class="modal-title" id="bidModalLabel">Enter Quote Amount</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <input type="hidden" name="order_id" id="modal_order_id">
  <input type="hidden" id="modal_sub_category">
  <input type="hidden" id="modal_customer_id">        <div class="form-group">
    <label for="vehicle_type">Select Vehicle Type</label>
    <select class="form-control" id="vehicle_type_dropdown" name="vehicle_type" required>
      <option value="">Loading...</option>
    </select>
  </div>
        <div class="form-group">
          <label for="bid_amount">Amount</label>
          <input type="hidden" name="order_id" id="modal_order_id">

          <input type="number" class="form-control" name="bid_amount" id="bid_amount" required>
        </div>
        <div class="alert alert-info" role="alert">
  <strong>Note:</strong> Enter only the <strong>Trip Amount</strong>.If Applicable Charges like Toll, Driver Bata, Waiting Charges, Loading/Unloading, Permit, and Other Charges should be added at End of the Trip.
</div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" type="submit">Submit</button>
      </div>
    </form>
  </div>
</div>
 <div class="row g-4">
  <!-- Left Side: Driver Search -->
  <div class="col-md-12">
    <h4>Customer</h4>
                     
<?php 
$order_id = $_GET['order_id'] ?? 0;

$query = "
    SELECT b.driver_id, b.bid_amount, b.bid_time,
           cp.driver_name, cp.phone_no, vt.Vehicle_type_name
    FROM order_driver_bids b
    INNER JOIN (
        SELECT driver_id, MAX(bid_time) AS latest_bid_time
        FROM order_driver_bids
        WHERE order_id = '$order_id'
        GROUP BY driver_id
    ) latest_bids 
        ON b.driver_id = latest_bids.driver_id 
       AND b.bid_time = latest_bids.latest_bid_time

    INNER JOIN orders o ON b.order_id = o.id
    LEFT JOIN vehicle_type vt ON b.vehicle_type = vt.Vehicle_type_id

    LEFT JOIN create_post cp 
        ON b.driver_id = cp.customer_id
       AND o.from_city = cp.area_id 
       AND o.Add_sub_category = cp.subcategory_id

    WHERE b.order_id = '$order_id' 
      AND b.bid_status = 'selected' 
      AND b.customer_status = 'pending'

    ORDER BY b.bid_amount ASC
";

// ✅ Execute query
$result = mysqli_query($config, $query);

// ✅ Debug if query fails
if (!$result) {
    die("Query Error: " . mysqli_error($config));
}
?>

<h3 class="mb-4 text-primary font-weight-bold text-center text-md-left">
    Driver Quotes for Order #<?= htmlspecialchars($order_id) ?>
</h3>

<?php if (mysqli_num_rows($result) > 0): ?>
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-nowrap">
            <thead class="thead-success bg-success text-white">
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Quote Amount (₹)</th>
                    <th scope="col">Quote Time</th>
                    <th scope="col">Vehicle Type</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $sn = 1; ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= $sn++; ?></td>
                        <td>₹<?= number_format($row['bid_amount'], 2) ?></td>
                        <td><?= date('d M Y h:i A', strtotime($row['bid_time'])) ?></td>
                        <td><?= ($row['Vehicle_type_name']) ?></td>
                        <td>
                            <button class="btn btn-sm btn-success accept-bid-btn"
                                data-order-id="<?= $order_id ?>"
                                data-driver-id="<?= $row['driver_id'] ?>"
                                data-bid-amount="<?= $row['bid_amount'] ?>">
                                Accept Bid
                            </button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <div class="alert alert-warning text-center">No driver bids found for this order.</div>
<?php endif; ?>
</div>
 <?php } ?>
		    
 <?php if ($order && $order['status'] == 'accepted') { ?>
 <?php
$order_status = $order['status'];
$driver_id = $order['driver_id'] ? $order['driver_id'] : null;

if ($driver_id):
    $driver_query = mysqli_query($config, "
        SELECT driver_name, phone_no 
        FROM create_post 
        WHERE customer_id = '$driver_id'
    ");
    $driver_data = mysqli_fetch_assoc($driver_query);

    $bid_query = mysqli_query($config, "
        SELECT bid_amount 
        FROM order_driver_bids 
        WHERE order_id = '$order_id' 
          AND driver_id = '$driver_id' 
          AND bid_status = 'selected' 
        LIMIT 1
    ");
    $bid_row = mysqli_fetch_assoc($bid_query);
    $bid_amount = $bid_row['bid_amount'] ?? 'N/A';
?>

<div class="card mt-4">
  <div class="card-header bg-primary text-white">
    Driver Details
  </div>
  <div class="card-body p-0">
    <table class="table table-bordered mb-0">
      <tr>
        <th style="width:150px;">Driver</th>
        <td><?= htmlspecialchars($driver_data['driver_name']) ?></td>
      </tr>
      <tr>
        <th>Phone</th>
        <td><?= htmlspecialchars($driver_data['phone_no']) ?></td>
      </tr>
      <tr>
        <th>Quote</th>
        <td>₹<?= htmlspecialchars($bid_amount) ?></td>
      </tr>
      <?php if ($order_status === 'accepted'): ?>
      <tr>
        <th>Status</th>
        <td><span class="badge bg-success">Waiting to start trip</span></td>
      </tr>
      <?php endif; ?>
    </table>
  </div>
</div>

<?php endif; ?>
 <?php } ?>

 <?php
$orderID = $order['id'];
$status = strtolower(trim($order['status']));

// Check if the current driver has the accepted bid
$checkQuery = "SELECT 1 FROM order_driver_bids 
               WHERE order_id = '$orderID' 
               AND driver_id = '$prof_id' 
               AND customer_status = 'accepted' 
               LIMIT 1";
$checkResult = mysqli_query($config, $checkQuery);
$driverHasBid = mysqli_num_rows($checkResult) > 0;

// Check if any driver was accepted (including others)
 $otherDriverQuery = "SELECT 1 FROM order_driver_bids 
                     WHERE order_id = '$orderID' 
                     AND customer_status = 'accepted' 
                     LIMIT 1";
$otherResult = mysqli_query($config, $otherDriverQuery);
$someDriverBooked = mysqli_num_rows($otherResult) > 0;

$driverQuoteSent = mysqli_num_rows(mysqli_query($config, "
    SELECT 1 FROM order_driver_bids 
    WHERE order_id = '$orderID' 
      AND driver_id = '$prof_id' 
      AND customer_status = 'pending'
    LIMIT 1
")) > 0;

?>

<?php  if ($driverHasBid && $status === 'accepted'): ?>
  <table class="table table-bordered">
    <tr>
      <th>Status</th>
      <td>Accepted</td>
    </tr>
  </table>

  <button class="btn btn-warning w-100 mb-2 trip-btn"  data-order_id= "<?=$orderID ?>" data-action="start">Start Trip</button>

<?php elseif ($driverHasBid && $status === 'started'): ?>
  <table class="table table-bordered">
    <tr>
      <th>Status</th>
      <td>Trip Started</td>
    </tr>
    <tr>
      <th>Start Date</th>
      <td><?= date("d-m-Y h:i A", strtotime($row['start_time'])) ?></td>
    </tr>
    <tr>
      <th>Start KM</th>
      <td><?= ($row['start_km']) ?></td>
    </tr>
  </table>

  <button class="btn btn-danger w-100 mb-2 trip-btn"
        data-action="end"
        data-order_id="<?= $row['id'] ?>"
        data-start_km="<?= $row['start_km'] ?>"
        data-start_datetime="<?= $row['start_time']?>">
  End Trip
</button>

<?php elseif ($driverHasBid && $status === 'ended'): ?>
  <table class="table table-bordered">
    <tr>
      <th>Status</th>
      <td>Trip Ended</td>
    </tr>
    <tr><th>Start Time</th><td><?= date("d-m-Y h:i A", strtotime($row['start_time'])) ?></td></tr>
    <tr><th>End Time</th><td><?= date("d-m-Y h:i A", strtotime($row['end_time'])) ?></td></tr>
    <tr><th>Starting KM</th><td><?= $row['start_km'] ?></td></tr>

    <tr><th>Ending KM</th><td><?= $row['ending_km'] ?></td></tr>

    <tr><th>Net KM</th><td><?=  $row['ending_km'] -$row['start_km'] ?></td></tr>
    <tr><th>Travel Hours</th><td><?= ($row['travel_hrs']) ?></td></tr>
    <tr><th>Trip Amount</th><td class="amount-cell"><?= $row['trip_amount'] ?></td></tr>
    <?php
$hasAdditionalCharges = 
    $row['driver_bata'] > 0 ||
    $row['toll_charge'] > 0 ||
    $row['unloading_charge'] > 0 ||
    $row['waiting_charge'] > 0 ||
    $row['other_charge'] > 0 ||
    !empty($row['other_description']);
?>

<?php if ($hasAdditionalCharges): ?>
<tr><th colspan="2" class="bg-light text-primary">Additional Charge Details</th></tr>

  <?php if ($row['driver_bata'] > 0): ?>
  <tr><th>Driver Bata</th><td class="amount-cell"><?= formatINRCurrency($row['driver_bata']) ?></td></tr>
  <?php endif; ?>

  <?php if ($row['toll_charge'] > 0): ?>
  <tr><th>Toll</th><td class="amount-cell"><?= formatINRCurrency($row['toll_charge']) ?></td></tr>
  <?php endif; ?>

  <?php if ($row['unloading_charge'] > 0): ?>
  <tr><th>Unloading</th><td class="amount-cell"><?= formatINRCurrency($row['unloading_charge']) ?></td></tr>
  <?php endif; ?>

  <?php if ($row['waiting_charge'] > 0): ?>
  <tr><th>Waiting</th><td class="amount-cell"><?= formatINRCurrency($row['waiting_charge']) ?></td></tr>
  <?php endif; ?>

  <?php if ($row['other_charge'] > 0): ?>
  <tr><th>Other Charges</th><td class="amount-cell"><?= formatINRCurrency($row['other_charge']) ?></td></tr>
  <?php endif; ?>

  <?php if (!empty($row['other_description'])): ?>
  <tr><th>Other Details</th><td><?= $row['other_description'] ?></td></tr>
  <?php endif; ?>
<?php endif; ?>

    <tr><th>Total Amount</th><td class="amount-cell text-dark"  style="font-size: 20px;"> ₹<?= formatINRCurrency($row['total_amount']) ?></td></tr>
  </table>

<!-- Trip Complete Button -->
<button class="btn btn-success trip-complete-btn" 
        data-toggle="modal" 
        data-order_id="<?= $row['id'] ?>" 
        data-total_amount="<?= $row['total_amount'] ?>" 
        data-target="#tripCompleteModal">
  Trip Complete
</button>
<?php elseif ($driverQuoteSent && !$driverHasBid): ?>


  <table class="table table-bordered">
    <tr>
      <th>Status</th>
      <td>Quote Sent to Customer</td>
    </tr>
  </table>

<?php elseif ($someDriverBooked): ?>
  <div class="alert alert-danger text-center font-weight-bold">
    ❌ Customer booked to another Driver
  </div>
  <?php elseif ($status == 'cancelled' || $status == 'canceled'): ?>
  <tr>
    <th>Status</th>
    <td>
      <span class="badge badge-danger">Order Cancelled</span>
    </td>
  </tr>
  <?php if (!empty($row['cancel_reason'])): ?>
<br>  <tr>
    <th>Cancel Reason</th>
    <td><?= htmlspecialchars($row['cancel_reason']) ?></td>
  </tr>
  <?php endif; ?>

  <?php if (!empty($row['cancel_date'])): ?>
  <tr>
    <th>Cancelled On</th>
    <td>
      <?php
        // Optional: Format the date to something more readable
        $formattedCancelDate = date("d-M-Y h:i A", strtotime($row['cancel_date']));
        echo $formattedCancelDate;
      ?>
    </td>
  </tr>
  <?php endif; ?>
<?php endif; ?>





</div>
        <?php include('footer.php'); ?>

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
	<script>

        document.addEventListener('DOMContentLoaded', function () {
    // Accept Bid
    document.querySelectorAll('.accept-bid-btn').forEach(button => {
        button.addEventListener('click', function () {
            const orderId = this.dataset.orderId;
            const driverId = this.dataset.driverId;
            const bidAmount = this.dataset.bidAmount;

            fetch('../../App/accept_driver_bid_ajax.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: `order_id=${orderId}&driver_id=${driverId}&bid_amount=${bidAmount}`
            })
            .then(res => res.text())
            .then(response => {
                if (response.trim() === 'success') {
                    window.location.href = `edit_order.php`;
                //    window.location.href = `ordertracking_view.php?order_id=${orderId}`;
                } else {
                    alert('Failed to accept bid. Please try again.');
                }
            });
        });
    });
    });
$(document).on('click', '.open-bid-modal', function () {

  const orderId = $(this).data('order-id');
  const subCategoryId = $(this).data('sub-category');
  const customerId = $(this).data('customer-id');

  $('#modal_order_id').val(orderId);
  $('#modal_sub_category').val(subCategoryId);
  $('#modal_customer_id').val(customerId);

  // Load vehicle types
  $.ajax({
    url: 'https://www.pokkuvandi.com/App/fetch_vehicle_types.php',
    method: 'POST',
    data: {
      sub_category_id: subCategoryId,
      customer_id: customerId
    },
    success: function (response) {
      $('#vehicle_type_dropdown').html(response);
    },
    error: function () {
      $('#vehicle_type_dropdown').html('<option value="">Failed to load</option>');
    }
  });
});


 $('#bidForm').on('submit', function (e) {
      e.preventDefault(); // Stop normal form submission

      var order_id = $('#modal_order_id').val();
      var bid_amount = $('#bid_amount').val();
      var vehicle_type = $('#vehicle_type_dropdown').val();

      $.ajax({
        type: 'POST',
        url: '../../App/submit_bid.php',
        data: {
          order_id: order_id,
          bid_amount: bid_amount,
          vehicle_type:vehicle_type
        },
        success: function (response) {
    alert(response); // Show success or error message
    $('#bidModal').modal('hide'); // Close modal
    setTimeout(function () {
        location.reload(); // Reload the page
    }, 500); // Delay to allow modal to close smoothly
},

        error: function () {
          alert('Error submitting bid.');
        }
      });
    });



         function findOrder() {
    const customerId = $('#customerid').val();
    const order_id = <?= $_GET['order_id']?>;

    if (customerId === '') {
        alert("❗ Please select a customer.");
        return;
    }

    $.ajax({
        url: 'find_order_by_customer.php',
        type: 'POST',
        data: { customer_id: customerId,order_id:order_id },
        success: function (response) {
            $('#order_result').html(response);
        },
        error: function () {
            $('#order_result').html('<div class="text-danger">Something went wrong.</div>');
        }
    });
}
	 function cum(customerid)
                 {
              
                    if (customerid != '') {
                        $.ajax({
                            type: "POST",
                            url: 'customer_search.php',
                            dataType: 'html',
                            data: {
                            customerid: customerid
                            },
                            success: function(data) {      
                                //alert();                    
                                $('#serach_result1').html(data);

                            }
                        });
                    } else {
                        $('#serach_result1').html('');
                    }
                 }
                 function serach_result(customerid, name, phone_no)
                 {
                    //alert(name);
                    $('#Add_driver_name').val(name);
                    $('#customerid').val(customerid);
                    $('#cust_id').val(customerid);
                    $('#serach_result1').html('');
                    
                    $('#phone_no').val(phone_no);
                    $('#name').val(name);
                    $('#customer_phone').val(phone_no);
                    // $('#address').val(address);  
                }


	</script>



<script>
    document.addEventListener("DOMContentLoaded", function() {
        const vehicleSelect = document.getElementById("mainCategorySelect");
        const requiredVehicleInput = document.getElementById("required_vehicle_type");

        function toggleFieldsBySelect() {
            const selectedValue = vehicleSelect.value;

            // Adjust values if your IDs differ
            const isPassenger = selectedValue === "2";
            const isGoods = selectedValue === "1";

            // Toggle visibility based on selected category
            document.querySelectorAll(".goods-only").forEach(el => {
                el.style.display = isGoods ? "block" : "none";
            });

            document.querySelectorAll(".passenger-only").forEach(el => {
                el.style.display = isPassenger ? "block" : "none";
            });

            // Adjust the placeholder based on the selected option
            if (isGoods) {
                requiredVehicleInput.placeholder = "Pickup / Dosth /Tata Ace / Eicher"; // Adjust for goods vehicles
            } else if (isPassenger) {
                requiredVehicleInput.placeholder = "Bus/ Auto/ Taxi /Travels"; // Adjust for passenger vehicles
            } else {
                requiredVehicleInput.placeholder = "Enter vehicle type"; // Default placeholder
            }
        }

        vehicleSelect.addEventListener("change", toggleFieldsBySelect);

        // Initial check in case something is pre-selected
        toggleFieldsBySelect();
    });
</script>
<script>
    const selectedSubCategoryId = "<?php echo $order['Add_sub_category'] ?? ''; ?>";
</script>

<script>
    function loadSubCategories(mainCatId) {
        if (mainCatId === "") {
            document.getElementById("sc").innerHTML = "";
            return;
        }

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "../../App/fetch_sub_categories.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onload = function() {
            if (this.status === 200) {
                document.getElementById("sc").innerHTML = this.responseText;
                 // If a subcategory should be selected
            if (selectedSubCategoryId) {
                const subCatSelect = document.getElementById("Add_sub_cate_Name");
                if (subCatSelect) {
                    subCatSelect.value = selectedSubCategoryId;
                }
            }
            }
        };

        xhr.send("main_cat_id=" + encodeURIComponent(mainCatId));
    }
    document.addEventListener("change", function() {
        const subCatSelect = document.getElementById("Add_sub_cate_Name");
        const totalKmInput = document.getElementById("total_km");
        const calculationBox = document.getElementById("calculationDetails");

        function updateCalculation() {
            const selectedOption = subCatSelect?.selectedOptions[0];
            const totalKm = parseFloat(totalKmInput?.value) || 0;

            // Assuming selectedOption, totalKm, and calculationBox are defined
            if (selectedOption && selectedOption.dataset.base && selectedOption.dataset.rate) {
                const base = parseFloat(selectedOption.dataset.base);
                const rate = parseFloat(selectedOption.dataset.rate);
                const total = base + (rate * totalKm);

                // Display total amount and approximate amount
              //  calculationBox.innerHTML = `₹${total.toFixed(2)} (Approximate)`;
            } else {
                // Default value when there's no data
                calculationBox.innerHTML = "₹0 (Approximate)";
            }

        }

        // Attach listeners
        document.body.addEventListener("change", updateCalculation);
        document.body.addEventListener("input", updateCalculation);
    });


    function submitOrder(event) {
    event.preventDefault(); // Stop default form submission

    const form = document.getElementById("editorderForm");

    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    const formData = new FormData(form);

    fetch("upadte_order.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
    .then(msg => {
        alert(msg); // Show message from PHP
        // Optional: redirect
         window.location.href = "order_deatiles.php?message=" + encodeURIComponent(msg);
    })
    .catch(error => {
        console.error("Error submitting form:", error);
        alert("Something went wrong while submitting the form.");
    });
}
</script>

<script>
    $(document).on('change', '#from_district', function() {
        var id = $(this).val(); // Get selected district ID
        if (id) {
            $.ajax({
                url: '../../App/get_city_name.php', // The PHP file that retrieves cities based on district
                type: 'GET',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    var cityOptions = ''; // Variable to hold the options
                    if (data.length > 0) {
                        // Loop through the cities and generate <option> elements
                        data.forEach(function(city) {
                            cityOptions += '<option value="' + city.id + '">' + city.name + '</option>';
                        });
                        // Add options to the "From City" select and show the container
                        $('#from_city_select').html(cityOptions);
                        $('#from_city_container').show();
                    } else {
                        $('#from_city_select').html('<option value="">No city found</option>');
                        $('#from_city_container').show(); // Show the container even if no cities found
                    }
                }
            });
        } else {
            // Reset the "From City" dropdown if no district is selected
            $('#from_city_select').html('<option value="">--Select City--</option>');
            $('#from_city_container').hide(); // Hide the container if no district is selected
        }
    });

    $(document).on('change', '#to_district', function() {
        var id = $(this).val(); 
     
        if (id) {
            $.ajax({
                url: '../../App/get_city_name.php', // The PHP file that retrieves cities for "To" district
                type: 'GET',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    var cityOptions = ''; // Variable to hold the options
                    if (data.length > 0) {
                        // Loop through the cities and generate <option> elements
                        data.forEach(function(city) {
                            cityOptions += '<option value="' + city.id + '">' + city.name + '</option>';
                        });
                        // Add options to the "To City" select and show the container
                        $('#to_city').html(cityOptions);
                        $('#to_city_container').show();
                    } else {
                        $('#to_city').html('<option value="">No city found</option>');
                        $('#to_city_container').show(); // Show the container even if no cities found
                    }
                }
            });
        } else {
            // Reset the "To City" dropdown if no district is selected
            $('#to_city').html('<option value="">--Select City--</option>');
            $('#to_city_container').hide(); // Hide the container if no district is selected
        }
    });
</script>

<script>
    function state_cha(id) {
        var id;
        // alert(id);
        // if(id == 1) {
        $.ajax({
            type: "POST",
            url: "state_field_customer.php",
            data: {
                id: id
            },
            success: function(data) {
                //   alert(data);
                $('#state_field').html(data);

                console.log(data);
            }
        });
        // }
        // else
        // {
        //   $('#state_field').html('');
        // }

    }
</script>


</body>

</html>


<script>
    function loadDistricts(stateId) {
        if (stateId) {
            $.ajax({
                type: "POST",
                url: "fetch_districts.php",
                data: {
                    state_id: stateId
                },
                success: function(response) {
                    $("#from_district").html(response);


                }
            });
        } else {
            $("#from_district").html('<option value="">---SELECT---</option>');
            $("#to_district").html('<option value="">---SELECT---</option>');

        }
    }

    function toloadDistricts(stateId) {
        if (stateId) {
            $.ajax({
                type: "POST",
                url: "fetch_districts.php",
                data: {
                    state_id: stateId
                },
                success: function(response) {
                    $("#to_district").html(response);


                }
            });
        } else {
            $("#from_district").html('<option value="">---SELECT---</option>');
            $("#to_district").html('<option value="">---SELECT---</option>');

        }
    }
</script>

<script src="js/osahan.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById("vehicle_required_datetime");

    flatpickr(input, {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        disableMobile: true,
        defaultDate: input.value || null, // Use the input value if present
        enable: [
            function(date) {
                const today = new Date();
                const tomorrow = new Date();
                tomorrow.setDate(today.getDate() + 1);
                today.setHours(0, 0, 0, 0);
                tomorrow.setHours(0, 0, 0, 0);
                date.setHours(0, 0, 0, 0);

                return (date.getTime() === today.getTime() || date.getTime() === tomorrow.getTime());
            }
        ],
        onReady: function (selectedDates, dateStr, instance) {
            const setButton = document.createElement("button");
            setButton.type = "button";
            setButton.textContent = "Set";
            setButton.className = "flatpickr-set-button";
            setButton.style.cssText = `
                width: 100%;
                padding: 8px;
                background-color: #007bff;
                color: white;
                border: none;
                cursor: pointer;
                font-weight: bold;
                margin-top: 8px;
                border-radius: 4px;
            `;
            setButton.addEventListener("click", () => {
                instance.close();
            });
            instance.calendarContainer.appendChild(setButton);
        }
    });
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const mainCategorySelect = document.getElementById("mainCategorySelect");

  // Initial change trigger if needed
  const initialValue = mainCategorySelect.value;
  if (initialValue) {
    loadSubCategories(initialValue); // Load initially for selected value
  }

  // Listen to actual user changes only
  mainCategorySelect.addEventListener("change", function () {
    const selectedValue = this.value;
    loadSubCategories(selectedValue);
  });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const selectedCityId = "<?php echo $selected_city_id; ?>";
    const selectedDistrictId = "<?php echo $selected_district_id; ?>";

    if (selectedDistrictId) {
        $('#from_district').val(selectedDistrictId).trigger('change');

        $.ajax({
            url: '../../App/get_city_name.php',
            type: 'GET',
            data: { id: selectedDistrictId },
            dataType: 'json',
            success: function(data) {
                let cityOptions = '<option value="">--Select City--</option>';
                data.forEach(function(city) {
                    const selected = city.id == selectedCityId ? 'selected' : '';
                    cityOptions += `<option value="${city.id}" ${selected}>${city.name}</option>`;
                });
                $('#from_city_select').html(cityOptions);
                $('#from_city_container').show();
            }
        });
    }
});


</script>



</body>

</html>