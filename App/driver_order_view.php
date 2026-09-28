<?php include('config/setup.php');
include('session.php');
// session_start() is already called in session.php, no need to call again
// sanitize just in case
$type = isset($_GET['type']) ? $_GET['type'] : 'ongoing';  // default to ongoing

$condition = "";

if ($type == 'ongoing') {
 // Get current time minus 6 hours
 $sixHoursAgo = date('Y-m-d H:i:s', strtotime('-6 hours'));

 // Exclude:
 // 1. cancelled, completed, expired
 // 2. pending orders older than 6 hours
 $condition = "
     o.status NOT IN ('cancelled', 'completed','ended')
     AND NOT (o.status = 'pending' AND o.created_at < '$sixHoursAgo')
 ";
} elseif ($type == 'cancel') {
  $condition = "o.status = 'cancelled'";
}
elseif ($type == 'ended') {
  $sixHoursAgo = date('Y-m-d H:i:s', strtotime('-6 hours'));

  $condition = "o.status = 'ended'   and    o.status NOT IN ('cancelled', 'completed')
     AND NOT (o.status = 'pending' AND o.created_at < '$sixHoursAgo')";

} elseif ($type == 'expired') {
  $condition = "o.status = 'pending'";
} else {
  $condition = "1"; // fallback to avoid syntax error
}
$query = "
    SELECT o.*, 
       a1.dir_area_name AS from_area_name, 
       a2.dir_area_name AS to_area_name,
       d1.dir_city_name AS from_district_name, 
       d2.dir_city_name AS to_district_name,
       sc.Sub_Category_Name,
       s1.name AS from_state_name,
       s2.name AS to_state_name,
       cp.customer_id as driver_id
FROM orders o
LEFT JOIN dir_city_master d1 ON o.from_district = d1.dir_city_id
LEFT JOIN dir_city_master d2 ON o.to_district = d2.dir_city_id
LEFT JOIN dir_area_master a1 ON o.from_city = a1.dir_area_id
LEFT JOIN dir_area_master a2 ON o.to_city = a2.dir_area_id
LEFT JOIN dir_state_master s1 ON o.from_state = s1.state_id
LEFT JOIN dir_state_master s2 ON o.to_state = s2.state_id
LEFT JOIN sub_category sc ON o.Add_sub_category = sc.Sub_Category_id
INNER JOIN create_post cp 
        ON (o.from_city = cp.area_id OR o.from_district = cp.city_id)
       AND o.Add_sub_category = cp.subcategory_id
       AND cp.customer_id = '$prof_id'
WHERE $condition
GROUP BY o.id
ORDER BY o.id DESC
";


$result = mysqli_query($config, $query);

// Store the token in the session
// echo "SELECT * FROM orders WHERE cust_id = '$prof_id' ORDER BY id DESC";

$_SESSION['form_token'] = $token;
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="">

    <meta name="author" content="">

    <link rel="icon" type="image/png" href="<?php



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



                                            ?>">

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
            ?></title>

    <!-- Slick Slider -->

    <link rel="stylesheet" type="text/css" href="vendor/slick/slick.min.css" />

    <link rel="stylesheet" type="text/css" href="vendor/slick/slick-theme.min.css" />

    <!-- Icofont Icon-->

    <link href="vendor/icons/icofont.min.css" rel="stylesheet" type="text/css">

    <!-- Bootstrap core CSS -->

    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->

    <link href="css/style.css" rel="stylesheet">

    <!-- Sidebar CSS -->
     

    <link href="vendor/sidebar/demo.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <!-- Optional: theme -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css" />


</head>

<?php
function formatINRCurrency($num) {
  $num = round($num);
  $num = (int)$num;
  $result = '';
  $numStr = (string)$num;
  $len = strlen($numStr);

  if ($len > 3) {
      $last3 = substr($numStr, -3);
      $rest = substr($numStr, 0, $len - 3);
      $rest = preg_replace("/\B(?=(\d{2})+(?!\d))/", ",", $rest);
      $result = $rest . "," . $last3;
  } else {
      $result = $numStr;
  }

  return $result;
}
?>
<body class="fixed-bottom-padding">

    <div class="theme-switch-wrapper">

        <label class="theme-switch" for="checkbox">

            <input type="checkbox" id="checkbox" />

            <div class="slider round"></div>

            <i class="icofont-moon"></i>

        </label>

        <em>Enable Dark Mode!</em>

    </div>

    <!-- home page -->
    <?php $pro_page = 2; ?>
    <div class="osahan">

        <?php
      
        
        include('Directory_topmenu.php'); ?>

        <!-- body -->
        <div class="osahan-body">

            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <?php
            // Set label based on type
            $labelText = "View Order"; // default
            if ($type == 'ongoing') {
                $labelText = "View Ongoing Order";
            } elseif ($type == 'ended') {
                $labelText = "View Ended Order";
            } elseif ($type == 'cancel') {
                $labelText = "View Cancelled Order";
            } elseif ($type == 'expired') {
                $labelText = "View Expired Order";
            }
            ?>
            <h5 class="text-center mt-3 mb-3"><?= $labelText ?></h5>

            <div class="card">

                <div class="container">

                <div class="row">

                <div class="container mt-5">
                <div class="row g-4">
                <div class="row row-cols-1 row-cols-md-2 g-4">
  <?php while ($row = mysqli_fetch_assoc($result)): ?>
    <div class="col">
      <div class="card h-100 border shadow-sm">
        <div class="card-header bg-light">
          <h5 class="mb-0">Order #<?= $row['id'] ?> - <?= $row['requiredvehicle_type'] ?></h5>
          <small class="text-muted">Posted on: <?= date('d M Y h:i A', strtotime($row['created_at'])) ?></small>
        </div>

        <div class="card-body">
          <table class="table table-sm mb-0" style="border: 1px solid #ccc;">
            <tbody>

            <?php $otherDriverQuery = "SELECT 1 FROM order_driver_bids 
                     WHERE order_id = '{$row['id']}' 
                     AND customer_status = 'accepted'   and driver_id = '$prof_id'
                     LIMIT 1";
$otherResult = mysqli_query($config, $otherDriverQuery);
$someDriverBooked = mysqli_num_rows($otherResult) > 0; ?>
              <?php if ($row['status'] !='pending' && $someDriverBooked): ?>
                <tr>
                  <th style="width: 35%;">Customer</th>
                  <td><?= htmlspecialchars($row['name']) ?> (<?= $row['customer_phone'] ?>)</td>
                </tr>
              <?php endif; ?>

              <tr>
                <th>From</th>
                <td>
                  <?= $row['loader_from_place'] ?>
                  <?= !empty($row['from_area_name']) ? ', ' . $row['from_area_name'] : '' ?>
                  (<?= $row['from_district_name'] ?>
                  <?= !empty($row['from_state_name']) ? ', ' . $row['from_state_name'] : '' ?>)
                </td>
              </tr>

              <tr>
                <th>To</th>
                <td>
                  <?= !empty($row['drop_place']) ? $row['drop_place'] : $row['loader_to_place'] ?>
                  <?= !empty($row['to_area_name']) ? ', ' . $row['to_area_name'] : '' ?>
                  (<?= $row['to_district_name'] ?>
                  <?= !empty($row['to_state_name']) ? ', ' . $row['to_state_name'] : '' ?>)
                </td>
              </tr>

              <tr>
                <th>Total KM</th>
                <td><?= $row['total_km'] ?> km</td>
              </tr>

              <?php if ($row['Add_main_cate'] == 1): ?>
                <?php if (!empty($row['product_details'])): ?>
                  <tr><th>Goods</th><td><?= $row['product_details'] ?></td></tr>
                  <tr>
  <th>Required Vehicle Model</th>
  <td>
    <?= $row['requiredvehicle_type']; ?>
    <?php 
        $bodyType = strtolower(trim($row['vehicle_body_type']));
        if ($bodyType === 'close') {
            echo " (Closed Body)";
        } elseif ($bodyType === 'open') {
            echo " (Open Body)";
        }
    ?>
</td>
</tr>
                <?php endif; ?>
                <?php if (!empty($row['total_weight'])): ?>
                  <tr><th>Weight</th><td><?= $row['total_weight'] ?> kg</td></tr>
                <?php endif; ?>
              <?php elseif ($row['Add_main_cate'] == 2): ?>
                <tr><th>Persons</th><td><?= $row['n_ofperson'] ?></td></tr>
              <?php endif; ?>

              <tr><th>Trip Type</th><td><?= $row['trip_type'] ?></td></tr>
              <tr><th>Vehicle Required</th><td><?= date("d-m-Y h:i A", strtotime($row['vehicle_required_datetime'])) ?></td></tr>
            </tbody>
          </table>

          <?php
          date_default_timezone_set('Asia/Kolkata');

          $orderID = $row['id'];
          $orderDateTime = strtotime($row['created_at']);
          $countdownId = "countdown_" . $orderID;
          
          // Get extend time (from DB or cookie)
          $extendMinutes = isset($row['extend_time']) ? (int)$row['extend_time'] : 0;
          $cookieKey = "extend_minutes_" . $orderID;
          if (isset($_COOKIE[$cookieKey])) {
              $extendMinutes += (int)$_COOKIE[$cookieKey];
          }
          
          // Set the max allowed expiry timestamp (6 hrs from order creation)
          $maxExpireTimestamp = $orderDateTime + (6 * 60 * 60);
          
          // Calculate current expiry (30 min + extended time)
          $calculatedExpire = $orderDateTime + (30 + $extendMinutes) * 60;
          $expireTimestamp = min($calculatedExpire, $maxExpireTimestamp);
          
          // Check if bid already selected
      $bidCheckQuery = "SELECT 1 FROM order_driver_bids 
     WHERE order_id = '$orderID' 
     AND driver_id = '$prof_id'
     LIMIT 1";
$bidCheckResult = mysqli_query($config, $bidCheckQuery);
$hasAlreadyBid = mysqli_num_rows($bidCheckResult) > 0;

          ?>

          <div class="col-12 mt-3 p-2 border rounded bg-light">
      
          <?php if (!$hasAlreadyBid): ?>

              <div id="orderBtn_<?= $orderID ?>">
              <button type="button"
  class="btn btn-success open-bid-modal"
  data-order="<?= $orderID ?>"
  data-sub-category="<?= $row['Add_sub_category'] ?>"
  data-customer-id="<?= $prof_id ?>"
  data-toggle="modal"
  data-target="#bidModal">
  Send Quote
</button>
<div id="<?= $countdownId ?>" class="mb-2 text-danger font-weight-bold"></div>

              </div>
              <?php endif; ?>
              <?php
$orderID = $row['id'];
$status = strtolower(trim($row['status']));

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
    </div>
  <?php endwhile; ?>
</div>





<style>
.amount-cell {
    text-align: right;
    font-family: monospace;
    font-weight: bold;
    font-size: 14px;
}
</style>

        <style>
.amount-cell-green {
    text-align: right;
    font-family: monospace;
    font-weight: bold;
    color: green;
    font-size: 20px;
}
</style>
        <style>
.amount-cell {
    text-align: right;
    font-family: monospace;
    font-weight: bold;
   
}
</style>          
               

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
  <div class="form-group col-md-6">
    <label>Travel Hours</label>
    <input type="text" class="form-control" id="travel_hrs"  name= "travel_hrs" readonly/>
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

<div class="modal fade" id="tripCompleteModal" tabindex="-1" role="dialog" aria-labelledby="bidModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="tripCompleteForm">
        <div class="modal-header">
          <h5 class="modal-title">Complete Trip</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="orderId" name="order_id">

          <div class="mb-2">
            <label>Total Trip Amount</label>
            <input type="number" id="totalTripAmount" class="form-control" readonly>
          </div>

          <div class="mb-2">
            <label>Discount</label>
            <input type="number" id="discountAmount" class="form-control" min="0">
          </div>

          <div class="mb-2">
            <label>Net Trip Amount</label>
            <input type="number" id="netTripAmount" class="form-control" readonly>
          </div>

          <div class="mb-2">
            <label>Cash Received</label>
            <input type="number" id="cashReceived" class="form-control" min="0">
          </div>

          <div class="mb-2">
            <label>Bank Received</label>
            <input type="number" id="bankReceived" class="form-control" min="0">
          </div>

          <div class="mb-2">
            <label>Total Received</label>
            <input type="number" id="totalReceived" class="form-control" readonly>
          </div>

          <div id="differenceError" class="alert alert-danger d-none">
            Received amount doesn't match Net Trip Amount.
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" id="submitTripBtn" class="btn btn-primary" disabled>Submit</button>
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

                    </div>

                </div>
            </div>

        </div>

</body>

<!-- Footer -->

<?php include('footermenu.php'); ?>

<?php include('menu.php'); ?> <!-- Bootstrap core JavaScript -->

<script src="vendor/jquery/jquery.min.js"></script>

<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- slick Slider JS-->

<script type="text/javascript" src="vendor/slick/slick.min.js"></script>

<!-- Sidebar JS-->

<script type="text/javascript" src="vendor/sidebar/hc-offcanvas-nav.js"></script>

<!-- Custom scripts for all pages-->

<script src="js/osahan.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const now = new Date();

  // Format date and time
  const day = String(now.getDate()).padStart(2, '0');
  const month = String(now.getMonth() + 1).padStart(2, '0');
  const year = now.getFullYear();
  const formattedDate = `${day}-${month}-${year}`;

  let hours = now.getHours();
  const minutes = String(now.getMinutes()).padStart(2, '0');
  const ampm = hours >= 12 ? 'PM' : 'AM';
  hours = hours % 12;
  hours = hours ? hours : 12;
  const formattedTime = `${String(hours).padStart(2, '0')}:${minutes} ${ampm}`;

  // ✅ When the modal is shown, then initialize
  $('#tripModal').on('shown.bs.modal', function () {
    // Set values
    document.getElementById('tripDate').value = formattedDate;
    document.getElementById('tripTime').value = formattedTime;

    // Initialize Flatpickr
    flatpickr("#tripDate", {
      dateFormat: "d-m-Y",
      disableMobile: true,
      defaultDate: now
    });

    flatpickr("#tripTime", {
      enableTime: true,
      noCalendar: true,
      dateFormat: "h:i K",
      disableMobile: true,
      time_24hr: false,
      defaultDate: now
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
  $(document).ready(function () {
      $('.open-bid-modal').on('click', function () {
        var orderId = $(this).data('order');
        $('#modal_order_id').val(orderId);
      });

    $('#bidForm').on('submit', function (e) {
      e.preventDefault(); // Stop normal form submission

      var order_id = $('#modal_order_id').val();
      var vehicle_type = $('#vehicle_type_dropdown').val();
    
      var bid_amount = $('#bid_amount').val();

      $.ajax({
        type: 'POST',
        url: 'submit_bid.php',
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
$(document).ready(function () {
  $('.trip-btn').click(function () {
  const action = $(this).data('action');
  const order_id = $(this).data('order_id');
  const startKm = $(this).data('start_km') || '';
  const startDateTime = $(this).data('start_datetime'); // format: "YYYY-MM-DD HH:mm:ss"
  $('#travel_hrs').val('').prop('readonly', true);
    $('#startingKmField').data('start_datetime', startDateTime);

    const now = new Date();

    // Format date: dd-mm-yyyy
    const formattedDate = `${String(now.getDate()).padStart(2, '0')}-${String(now.getMonth() + 1).padStart(2, '0')}-${now.getFullYear()}`;

    // Format time: hh:mm AM/PM
    let hours = now.getHours();
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    hours = hours ? hours : 12;
    const formattedTime = `${String(hours).padStart(2, '0')}:${minutes} ${ampm}`;

  $('#tripActionType').val(action);
  $('#order_id').val(order_id);
  $('#tripDate').val(formattedTime);
  $('#tripTime').val(formattedTime);

  $('#tripModalLabel').text(action === 'start' ? 'Start Trip' : 'End Trip');

  if (action === 'start') {
    $('#tripModalLabelstart').text('Trip Start Date');
    $('#tripModalLabelstart_time').text('Trip Start Time');
    $('#tripModalLabelm_start').text('Starting Km');
    $('#startingKmField').val('').prop('readonly', false);
    $('#endingKmWrapper').hide();
    $('#extraFields').hide();
  } else if (action === 'end') {
    $('#tripModalLabelstart').text('Trip End Date');
    $('#tripModalLabelstart_time').text('Trip End Time');
    $('#tripModalLabelm_start').text('Start Km (readonly)');
    $('#startingKmField').val(startKm).prop('readonly', true);
    $('#endingKmWrapper').show();
    $('#extraFields').show();
    $('#endingKmField').prop('required', true);
    $('#tripAmountField').prop('required', true);

   

  }

  $('#tripModal').modal('show');
});

 // Initialize Flatpickr after modal is shown
 $('#tripModal').on('shown.bs.modal', function () {
    flatpickr("#tripDate", {
      dateFormat: "d-m-Y",
      defaultDate: new Date(),
      disableMobile: true
    });

    flatpickr("#tripTime", {
      enableTime: true,
      noCalendar: true,
      dateFormat: "h:i K",
      defaultDate: new Date(),
      disableMobile: true
    });

    setTimeout(calculateTravelHours, 200); // Ensure values are set
  });

  // On time/date change, re-calculate
  $('#tripDate, #tripTime').on('change input', function () {
    setTimeout(calculateTravelHours, 100);
  });
// Show/hide additional charges
$('#additionalChargeCheckbox').on('change', function () {
  if ($(this).is(':checked')) {
    $('#extraChargesSection').show();
  } else {
    $('#extraChargesSection').hide();
    $('#extraChargesSection input').val(''); // Clear fields
    calculateTotal();
  }
});

// Show Other Description only if other charge > 0
$('#otherChargeField').on('input', function () {
  const otherVal = parseFloat($(this).val()) || 0;
  if (otherVal > 0) {
    $('#otherDescField').show();
  } else {
    $('#otherDescField').hide().val('');
   
  }
});
function calculateTravelHours() {
    const tripDate = $('#tripDate').val(); // dd-mm-yyyy
    const tripTime = $('#tripTime').val(); // hh:mm AM/PM
    const rawStart = $('#startingKmField').data('start_datetime'); // dd-mm-yyyy hh:mm AM/PM

    if (!rawStart || !tripDate || !tripTime) return;

    // Convert Start to yyyy-mm-dd hh:mm AM/PM
    const startParts = rawStart.split(' ');
    const startDateParts = startParts[0].split('-');
    const formattedStart = `${startDateParts[2]}-${startDateParts[1]}-${startDateParts[0]} ${startParts[1]} ${startParts[2]}`;

    // Convert End to yyyy-mm-dd hh:mm AM/PM
    const endDateParts = tripDate.split('-');
    const formattedEnd = `${endDateParts[2]}-${endDateParts[1]}-${endDateParts[0]} ${tripTime}`;

    const start = new Date(formattedStart.replace(/-/g, '/'));
    const end = new Date(formattedEnd.replace(/-/g, '/'));

    if (isNaN(start.getTime()) || isNaN(end.getTime())) {
      console.warn("Invalid date format:", start, end);
      return;
    }

    const diffMs = end - start;
    if (diffMs <= 0) {
      $('#travel_hrs').val('0 hrs 0 mins');
      return;
    }

    const totalMinutes = Math.floor(diffMs / (1000 * 60));
    const hours = Math.floor(totalMinutes / 60);
    const minutes = totalMinutes % 60;

    $('#travel_hrs').val(`${hours} hrs ${minutes} mins`);
  }

// Auto-calculate Net KM
$('#endingKmField').on('input', function () {
  const startKm = parseFloat($('#startingKmField').val()) || 0;
  const endKm = parseFloat($(this).val()) || 0;
  const netKm = endKm - startKm;
  $('#netKmField').val(netKm >= 0 ? netKm : 0);
  calculateTotal(); // Update total as well
});

// Auto-calculate total
$('input[name="trip_amount"], input[name="driver_bata"], input[name="toll_charge"], input[name="unloading_charge"], input[name="waiting_charge"], input[name="other_charge"]').on('input', calculateTotal);

function calculateTotal() {
  const trip = parseFloat($('input[name="trip_amount"]').val()) || 0;
  const driverBata = parseFloat($('input[name="driver_bata"]').val()) || 0;
  const toll = parseFloat($('input[name="toll_charge"]').val()) || 0;
  const unloading = parseFloat($('input[name="unloading_charge"]').val()) || 0;
  const waiting = parseFloat($('input[name="waiting_charge"]').val()) || 0;
  const other = parseFloat($('input[name="other_charge"]').val()) || 0;

  const total = trip + driverBata + toll + unloading + waiting + other;
  $('#totalAmount').val(total.toFixed(2));
}


    $('#tripActionForm').submit(function (e) {
     
        e.preventDefault();
        const formData = $(this).serialize();
        const action = $('#tripActionType').val(); // get action value

        $.post('update_trip_status.php', formData, function (response) {
            if (response === 'success') {
              if (action === 'end') {
    Swal.fire({
        title: 'Please fill the data!',
        text: 'Go to Order Payment Pending List',
        icon: 'warning',
        confirmButtonText: 'OK'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'https://www.pokkuvandi.com/App/driver_order_view.php?type=ended';
        }
    });
}
 else {
                // ✅ Reload for "start"
                location.reload();
            }            } else {
                alert('Something went wrong. Please try again.');
            }
        });
    });
});

let selectedTotal = 0;

$('#tripCompleteModal').on('show.bs.modal', function (event) {
  const button = $(event.relatedTarget);
  const orderId = button.data('order_id');
  const totalAmount = parseFloat(button.data('total_amount')) || 0;

  selectedTotal = totalAmount;

  $('#orderId').val(orderId);
  $('#totalTripAmount').val(totalAmount.toFixed(2));
  $('#discountAmount').val(0);
  $('#netTripAmount').val(totalAmount.toFixed(2));
  $('#cashReceived').val(0);
  $('#bankReceived').val(0);
  $('#totalReceived').val('0.00');
  $('#differenceError').addClass('d-none');
  $('#submitTripBtn').prop('disabled', true);
});

function calculateTripValues() {
  const discount = parseFloat($('#discountAmount').val()) || 0;
  const netTrip = selectedTotal - discount;
  $('#netTripAmount').val(netTrip.toFixed(2));

  const cash = parseFloat($('#cashReceived').val()) || 0;
  const bank = parseFloat($('#bankReceived').val()) || 0;
  const received = cash + bank;
  $('#totalReceived').val(received.toFixed(2));

  if (Math.abs(received - netTrip) > 0.01) {
    $('#differenceError').removeClass('d-none');
    $('#submitTripBtn').prop('disabled', true);
  } else {
    $('#differenceError').addClass('d-none');
    $('#submitTripBtn').prop('disabled', false);
  }
}

$(document).on('input', '#discountAmount, #cashReceived, #bankReceived', calculateTripValues);
$('#tripCompleteForm').on('submit', function (e) {
  e.preventDefault();

  const formData = {
    order_id: $('#orderId').val(),
    total_amount: $('#totalTripAmount').val(),
    discount: $('#discountAmount').val(),
    net_trip_amount: $('#netTripAmount').val(),
    cash: $('#cashReceived').val(),
    bank: $('#bankReceived').val(),
    total_received: $('#totalReceived').val()
  };

  $.post('submit_trip_complete.php', formData, function (response) {
    alert(response.message || 'Trip completed successfully!');
    $('#tripCompleteModal').modal('hide');
    location.reload(); // or update the row dynamically
  }, 'json');
});


</script>


<script>
    function disableSubmitButton() {
        var submitButton = document.querySelector('button[name="customer_add"]');
        submitButton.disabled = true;
    }
</script>


<script>
//  $('#start-trip').on('click', function () {
 
//     $.post('update_trip_status.php', {
//         order_id: <?= $order['id'] ?>,
//         action: 'start'
//     }, function (response) {
//         if (response === 'success') {
//             $('#status-badge').removeClass().addClass('badge bg-warning').text('Started');
//             $('#trip-actions').html('<button class="btn btn-danger w-100 mb-3" id="end-trip">⛔ End Trip</button>');
//         } else {
//             alert('Failed to start trip');
//         }
//     });
// });

// $(document).on('click', '#end-trip', function () {
//     $.post('update_trip_status.php', {
//         order_id: <?= $order['id'] ?>,
//         action: 'end'
//     }, function (response) {
//         if (response === 'success') {
//             $('#status-badge').removeClass().addClass('badge bg-success').text('Completed');
//             $('#trip-actions').html('<div class="alert alert-success text-center">✅ Trip Completed</div>');
//         } else {
//             alert('Failed to end trip');
//         }
//     });
// });



</script>

<script>
  $('.open-bid-modal').on('click', function () {
    const orderId = $(this).data('order');
    const subCategoryId = $(this).data('sub-category');
    const customerId = $(this).data('customer-id');

    $('#modal_order_id').val(orderId);
    $('#modal_sub_category').val(subCategoryId);
    $('#modal_customer_id').val(customerId);

    // Load vehicle types
    $.ajax({
      url: 'fetch_vehicle_types.php',
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
</script>

</body>

</html>


