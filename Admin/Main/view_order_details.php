<?php include('../config/setup.php'); 

$order_id = $_GET['order_id'] ?? 0;

$query = "SELECT o.*, 
                a1.dir_area_name AS from_area_name,
                a2.dir_area_name AS to_area_name,
                o.name AS customer_name,
                o.customer_phone AS customer_phone
          FROM orders o
        
          LEFT JOIN dir_area_master a1 ON o.from_city = a1.dir_area_id
          LEFT JOIN dir_area_master a2 ON o.to_city = a2.dir_area_id
          WHERE o.id = $order_id";

$result = mysqli_query($config, $query);
$order = mysqli_fetch_assoc($result);

if (!$order) {
    echo "<div class='alert alert-danger'>Order not found.</div>";
    exit;
}?>

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
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.10/dist/sweetalert2.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.10/dist/sweetalert2.all.min.js"></script>
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


		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="page-header">
					
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

							<div class="card">
							
								<div class="card-body">
											

								
										
                                <div class="container">
  <h3 class="mb-4">📦 Order Details: #<?= $order['id'] ?></h3>

  <table class="table table-bordered">
    <tr>
      <th>Customer Name</th>
      <td><?= $order['customer_name'] ?> (<?= $order['customer_phone'] ?>)</td>
    </tr>
    <tr>
      <th>From</th>
      <td><?= $order['from_area_name'] ?></td>
    </tr>
    <tr>
      <th>To</th>
      <td><?= $order['to_area_name'] ?></td>
    </tr>
    <tr>
      <th>Vehicle Body Type</th>
      <td><?= $order['vehicle_body_type'] ?></td>
    </tr>
    <tr>
      <th>Total KM</th>
      <td><?= $order['total_km'] ?> km</td>
    </tr>
    <tr>
      <th>KM Rate</th>
      <td>₹<?= $order['km_rate'] ?></td>
    </tr>
    <tr>
      <th>Base Price</th>
      <td>₹<?= $order['base_price'] ?></td>
    </tr>
    <tr>
      <th>Total Amount</th>
      <td><strong>₹<?= $order['total_amount'] ?></strong></td>
    </tr>
    <tr>
      <th>No. of Persons</th>
      <td><?= $order['n_ofperson'] ?></td>
    </tr>
    <tr>
      <th>Posted On</th>
      <td><?= date('d M Y h:i A', strtotime($order['created_at'])) ?></td>
    </tr>
    <tr>
      <th>Status</th>
      <td><?= ucfirst($order['status']) ?></td>
    </tr>
  </table>
    <!-- Left Column: Driver -->
    <div class="row g-4 align-items-start">
  <!-- Left Side: Driver Search -->
  <div class="col-md-12">
    <h4>Driver</h4>
    <div class="row">
  <!-- Column 1: Customer Name -->
  <div class="col-md-4">
    <div class="form-group">
      <label>Customer Name</label>
      <input type="text" class="form-control" id="Add_driver_name" onkeyup="cum(this.value)" name="Add_driver_name" required>
      <div id="serach_result">
        <ul class="subnav sug-list-color" id="serach_result1"></ul>
      </div>
    </div>
  </div>

  <!-- Column 2: Customer Phone -->
  <div class="col-md-4">
    <div class="form-group">
      <label>Customer Phone No</label>
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

</div>
<?php
$orderID = $order_id;

$bidQuery = mysqli_query($config, "
    SELECT driver_id AS prof_id 
    FROM order_driver_bids 
    WHERE order_id = '$orderID' 
    LIMIT 1
");

if ($bidRow = mysqli_fetch_assoc($bidQuery)) {
    $prof_id = $bidRow['prof_id'];
} else {
    $prof_id = null; // No bid found
}

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
        data-start_km="<?= $row['start_km'] ?>">
  End Trip
</button>

<?php elseif ($driverHasBid && $status === 'ended'): ?>
  <table class="table table-bordered">
    <tr>
      <th>Status</th>
      <td>Trip Ended</td>
    </tr>
    <tr><th>End Time</th><td><?= date("d-m-Y h:i A", strtotime($row['end_time'])) ?></td></tr>
    <tr><th>Starting KM</th><td><?= $row['start_km'] ?></td></tr>

    <tr><th>Ending KM</th><td><?= $row['ending_km'] ?></td></tr>
    <tr><th>Net KM</th><td><?=  $row['ending_km'] -$row['start_km'] ?></td></tr>
    <tr><th>Trip Amount</th><td><?= $row['trip_amount'] ?></td></tr>
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
  <tr><th>Driver Bata</th><td><?= $row['driver_bata'] ?></td></tr>
  <?php endif; ?>

  <?php if ($row['toll_charge'] > 0): ?>
  <tr><th>Toll</th><td><?= $row['toll_charge'] ?></td></tr>
  <?php endif; ?>

  <?php if ($row['unloading_charge'] > 0): ?>
  <tr><th>Unloading</th><td><?= $row['unloading_charge'] ?></td></tr>
  <?php endif; ?>

  <?php if ($row['waiting_charge'] > 0): ?>
  <tr><th>Waiting</th><td><?= $row['waiting_charge'] ?></td></tr>
  <?php endif; ?>

  <?php if ($row['other_charge'] > 0): ?>
  <tr><th>Other Charges</th><td><?= $row['other_charge'] ?></td></tr>
  <?php endif; ?>

  <?php if (!empty($row['other_description'])): ?>
  <tr><th>Other Description</th><td><?= $row['other_description'] ?></td></tr>
  <?php endif; ?>
<?php endif; ?>

    <tr><th>Total Amount</th><td><?= $row['total_amount'] ?></td></tr>
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
<?php endif; ?>



            <div id="expired_<?= $orderID ?>" style="display:none;" class="badge badge-danger mb-2">Expired</div>
            <hr>
          </div>

          <script>
(function () {
  const countdownEl = document.getElementById("<?= $countdownId ?>");
  const viewBtn = document.getElementById("orderBtn_<?= $orderID ?>");
  const expiredEl = document.getElementById("expired_<?= $orderID ?>");
  const expireTime = <?= $expireTimestamp ?> * 1000;

  function updateCountdown() {
    const now = Date.now();
    const timeLeft = expireTime - now;

    if (timeLeft > 0) {
      const minutes = Math.floor(timeLeft / (1000 * 60));
      const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
      countdownEl.innerHTML = `⏳ Expires in: ${minutes}m ${seconds < 10 ? '0' : ''}${seconds}s`;
    } else {
      countdownEl.innerHTML = '';
      if (viewBtn) viewBtn.style.display = 'none';
      expiredEl.style.display = 'inline-block';
      clearInterval(timer);
    }
  }

  updateCountdown();
  const timer = setInterval(updateCountdown, 1000);
})();
</script>

        </div>
      </div>

      <div class="row g-4">
  <!-- Left Side: Driver Search -->
  <div class="col-md-12">
    <h4>Customer</h4>
<?php $order_id = $_GET['order_id'];

$query = "
    SELECT b.driver_id, b.bid_amount, b.bid_time,
           cp.driver_name, cp.phone_no,vt.Vehicle_type_name
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
                        <th scope="col"> Vehicle Type</th>
                       
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



    
    </div></div>



    </div>
  






</div>





             
               

<div class="modal fade" id="tripModal" tabindex="-1" role="dialog" aria-labelledby="tripModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <form id="tripActionForm">
      <div class="modal-content">
        <div class="modal-header bg-info text-white">
          <h5 class="modal-title" id="tripModalLabel">Trip Action</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="action" id="tripActionType">
          <input type="hidden" name="order_id" id="order_id">

          <div class="form-row">
            <div class="form-group col-md-6">
              <label id="tripModalLabelstart" for="tripDate">Trip Start Date</label>
              <input type="text" id="tripDate" name="trip_date" class="form-control" placeholder="Select Date">
            </div>
            <div class="form-group col-md-6">
              <label id="tripModalLabelstart_time" for="tripTime">Trip Start Time</label>
              <input type="text" id="tripTime" name="trip_time" class="form-control" placeholder="Select Time">
            </div>
          </div>

          <div class="form-row">
  <!-- Start KM (readonly on end trip) -->
  <div class="form-group col-6">
    <label id="tripModalLabelm_start">Start KM</label>
    <input type="number" class="form-control" name="starting_km" id="startingKmField" readonly />
  </div>

  
</div>


<div id="extraFields">
<div class="form-row">
<!-- End KM (only shown during end trip) -->
<div class="form-group col-6" id="endingKmWrapper" style="display: none;">
    <label for="ending_km">Ending KM</label>
    <input type="number" class="form-control" name="ending_km" id="endingKmField" placeholder="Enter Ending KM"  />
  </div>

  <div class="form-group col-md-6">
    <label>Net KM</label>
    <input type="number" class="form-control" id="netKmField" readonly />
  </div>
</div>

<div class="form-row">
  <div class="form-group col-md-6">
    <label>Trip Amount</label>
    <input type="number" class="form-control" name="trip_amount" id="tripAmountField" placeholder="Enter Trip Amount">
  </div>

  <div class="form-group col-md-6 d-flex align-items-end">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="additionalChargeCheckbox">
      <label class="form-check-label" for="additionalChargeCheckbox">
        Add Additional Charges
      </label>
    </div>
  </div>
</div>
          <!-- Extra Fields for End Trip -->
          <div id="extraChargesSection" style="display: none;">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label>Driver Bata</label>
      <input type="number" class="form-control" name="driver_bata" placeholder="Enter Driver Bata">
    </div>
    <div class="form-group col-md-6">
      <label>Toll Charge</label>
      <input type="number" class="form-control" name="toll_charge" placeholder="Enter Toll Charge">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label>Unloading Charge</label>
      <input type="number" class="form-control" name="unloading_charge" placeholder="Enter Unloading Charge">
    </div>
    <div class="form-group col-md-6">
      <label>Waiting Charge</label>
      <input type="number" class="form-control" name="waiting_charge" placeholder="Enter Waiting Charge">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label>Other Charges</label>
      <input type="number" class="form-control" name="other_charge" id="otherChargeField" placeholder="Other Charges">
    </div>
    <div class="form-group col-md-6">
      <label>Other Description</label>
      <input type="text" class="form-control" name="other_description" id="otherDescField" placeholder="Description" style="display: none;">
    </div>
  </div>
</div>

<!-- Total -->
<div class="form-row">
  <div class="form-group col-md-12">
    <label>Total Amount</label>
    <input type="number" class="form-control" name="total_amount" id="totalAmount" readonly>
  </div>
</div>

</div>
        </div> <!-- end modal-body -->

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>




   
</div>

<!-- Back Button -->
<a href="order_deatiles.php" class="btn btn-secondary mt-3">🔙 Back</a>
  

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



</div>   
		
<style>
  .order-card {
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    transition: all 0.3s ease-in-out;
    background-color: #fff;
    overflow: hidden;
    border: 1px solid #eee;
  }

  .order-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 6px 25px rgba(0, 0, 0, 0.12);
  }

  .order-header {
    background: linear-gradient(135deg, #2ecc71, #27ae60);
    color: #fff;
    padding: 15px 20px;
    font-size: 1.1rem;
    font-weight: bold;
    border-bottom: 1px solid #ddd;
  }

  .order-body {
    padding: 20px;
    font-size: 0.95rem;
  }

  .label {
    font-weight: 600;
    color: #2c3e50;
    margin-right: 5px;
  }

  .order-body p {
    margin-bottom: 10px;
  }

  .order-body strong {
    color: #e74c3c;
  }
</style>

      

		<!-- End Custom template -->
	</div>
    <?php include('footer.php'); ?>
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
	

</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
 $(document).on('click', '.open-bid-modal', function () {
  alert('Clicked'); // Make sure this works now

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
    function disableSubmitButton() {
        var submitButton = document.querySelector('button[name="customer_add"]');
        submitButton.disabled = true;
    }
</script>


<script>
  $(document).ready(function () {
    

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
  });
</script>


<script>
$(document).ready(function () {
  $('.trip-btn').click(function () {
    const action = $(this).data('action');
    const now = new Date();
    const date = now.toISOString().slice(0, 10); // YYYY-MM-DD
    const time = now.toTimeString().slice(0, 5); // HH:MM

    $('#tripActionType').val(action);
    $('#tripModalLabel').text(action === 'start' ? 'Start Trip' : 'End Trip');

    if (action === 'start') {
        $('#tripModalLabelstart').text('Trip Start Date');
        $('#tripModalLabelstart_time').text('Trip Start Time');
        $('#tripModalLabelm').text('Starting Km');
        $('#extraFields').hide();
    } else if (action === 'end') {
        $('#tripModalLabelstart').text('Trip End Date');
        $('#tripModalLabelstart_time').text('Trip End Time');
        $('#tripModalLabelm').text('Ending Km');
        $('#extraFields').show();
    }

    $('#tripDate').val(date);
    $('#tripTime').val(time);
    $('#tripModal').modal('show');
});

// Auto calculate total on any change
$(document).on('input', 'input[name="driver_bata"], input[name="toll_charge"], input[name="unloading_charge"], input[name="waiting_charge"], input[name="other_charge"]', function () {
    const driverBata = parseFloat($('input[name="driver_bata"]').val()) || 0;
    const toll = parseFloat($('input[name="toll_charge"]').val()) || 0;
    const unloading = parseFloat($('input[name="unloading_charge"]').val()) || 0;
    const waiting = parseFloat($('input[name="waiting_charge"]').val()) || 0;
    const other = parseFloat($('input[name="other_charge"]').val()) || 0;

    const total = driverBata + toll + unloading + waiting + other;
    $('#totalAmount').val(total.toFixed(2));
});


    $('#tripActionForm').submit(function (e) {
        e.preventDefault();
        const formData = $(this).serialize();

        $.post('../../App/update_trip_status.php', formData, function (response) {
            if (response === 'success') {
                location.reload(); // Reload to reflect updated status
            } else {
                alert('Something went wrong. Please try again.');
            }
        });
    });
});
</script>


<script>
    function disableSubmitButton() {
        var submitButton = document.querySelector('button[name="customer_add"]');
        submitButton.disabled = true;
    }
</script>


<script>
 $('#start-trip').on('click', function () {
    $.post('../../App/update_trip_status.php', {
        order_id: <?= $order['id'] ?>,
        action: 'start'
    }, function (response) {
        if (response === 'success') {
            $('#status-badge').removeClass().addClass('badge bg-warning').text('Started');
            $('#trip-actions').html('<button class="btn btn-danger w-100 mb-3" id="end-trip">⛔ End Trip</button>');
        } else {
            alert('Failed to start trip');
        }
    });
});

$(document).on('click', '#end-trip', function () {
    $.post('../../App/update_trip_status.php', {
        order_id: <?= $order['id'] ?>,
        action: 'end'
    }, function (response) {
        if (response === 'success') {
            $('#status-badge').removeClass().addClass('badge bg-success').text('Completed');
            $('#trip-actions').html('<div class="alert alert-success text-center">✅ Trip Completed</div>');
        } else {
            alert('Failed to end trip');
        }
    });
});



</script>
