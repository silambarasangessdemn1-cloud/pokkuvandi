<?php include('config/setup.php');
include('session.php');
session_start();
// Generate a unique token

date_default_timezone_set('Asia/Kolkata');

// sanitize just in case
$type = isset($_GET['type']) ? $_GET['type'] : 'ongoing';  // default to ongoing

$condition = "";

if ($type == 'ongoing') {
    // Exclude cancelled, completed, expired
   $sixHoursAgo = date('Y-m-d H:i:s', strtotime('-6 hours'));

    $condition = "
    o.status NOT IN ('cancelled', 'completed')
    AND NOT (o.status = 'pending' AND o.created_at < '$sixHoursAgo')
";
} elseif ($type == 'cancel') {
    $condition = "o.status = 'cancelled'";
} 
 elseif ($type == 'expired') {
    // Consider order is expired if 6 hours past order datetime
    $condition = " o.status = 'pending'";
}

$query = "
SELECT o.*, 
       d1.dir_city_name AS from_district_name, 
       d2.dir_city_name AS to_district_name,
       a1.dir_area_name AS from_area_name,
       a2.dir_area_name AS to_area_name,
       s1.name AS from_state_name,
       s2.name AS to_state_name
FROM orders o
LEFT JOIN dir_city_master d1 ON o.from_district = d1.dir_city_id
LEFT JOIN dir_city_master d2 ON o.to_district = d2.dir_city_id
LEFT JOIN dir_area_master a1 ON o.from_city = a1.dir_area_id
LEFT JOIN dir_area_master a2 ON o.to_city = a2.dir_area_id
LEFT JOIN dir_state_master s1 ON o.from_state = s1.state_id
LEFT JOIN dir_state_master s2 ON o.to_state = s2.state_id
WHERE o.cust_id = '$prof_id' AND $condition
ORDER BY o.id DESC
";


$result = mysqli_query($config, $query);
// Store the token in the session
// echo "SELECT * FROM orders WHERE cust_id = '$prof_id' ORDER BY id DESC";

$_SESSION['form_token'] = $token;

if (isset($_POST['submit_extend'])) {
  $extendMinutes = (int) $_POST['extend_time'];
  $orderId = $_POST['order_id'];

  // Save extended time in DB (store total extended minutes)
  $updateQuery = "UPDATE orders SET extend_time = '$extendMinutes' WHERE order_id = '$orderId'";
  mysqli_query($config, $updateQuery);

  echo "<script>alert('Extended by $orderId minutes'); location.reload();</script>";
}

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
   <!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
<?php
if (isset($_GET['message'])) {
    $message = urldecode($_GET['message']);
    $additionalNote = "Please check your order status at Vehicle Booking List.";

    // Replace newlines or add HTML line break
    $fullMessage = nl2br(htmlspecialchars($message)) . "<br><br>" . htmlspecialchars($additionalNote);

    echo "
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Success!',
                  html: \"$fullMessage\",
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                // Remove the message parameter from the URL without reloading
                const url = new URL(window.location);
                url.searchParams.delete('message');
                window.history.replaceState({}, document.title, url.toString());
            });
        });
    </script>";
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

        <?php include('Directory_topmenu.php'); ?>

        <!-- body -->
        <div class="osahan-body">

            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <h5 class="text-center mt-3 mb-3"> View Orders </h5>


            <div class="card">

                <div class="container">

                <div class="row">

                <div class="container mt-5">
  
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
              <tr>
                <th style="width: 35%;">Customer</th>
                <td><?= htmlspecialchars($row['name']) ?> (<?= $row['customer_phone'] ?>)</td>
              </tr>
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
                <tr>
  <th>Required Vehicle Model</th>
  <td><?= $row['requiredvehicle_type'] . ' (' . $row['vehicle_body_type'] . ')' ?></td>
</tr>
                <tr><th>Persons</th><td><?= $row['n_ofperson'] ?></td></tr>
              <?php endif; ?>
              <tr><th>Trip Type</th><td><?= $row['trip_type'] ?></td></tr>
              <tr>
                <th>Vehicle Required</th>
                <td><?= date("d-m-Y h:i A", strtotime($row['vehicle_required_datetime'])) ?></td>
              </tr>

              <?php
$order_id = $row['id'];
$order_status = $row['status'];
$driver_id = $row['driver_id'] ?? null;

if ($driver_id):
    $driver_query = mysqli_query($config, "SELECT driver_name, phone_no FROM create_post WHERE customer_id = '$driver_id'");
    $driver_data = mysqli_fetch_assoc($driver_query);

    $bid_query = mysqli_query($config, "SELECT bid_amount FROM order_driver_bids WHERE order_id = '$order_id' AND driver_id = '$driver_id' AND bid_status = 'selected' LIMIT 1");
    $bid_row = mysqli_fetch_assoc($bid_query);
    $bid_amount = $bid_row['bid_amount'] ?? 'N/A';
?>


<!-- Driver Details Section -->
<tr><th colspan="2" class="bg-light text-primary">Driver Details</th></tr>
<tr><th>Driver</th><td><?= htmlspecialchars($driver_data['driver_name']) ?></td></tr>
<tr><th>Phone</th><td><?= htmlspecialchars($driver_data['phone_no']) ?></td></tr>
<tr><th>Quote</th><td>₹<?= htmlspecialchars($bid_amount) ?></td></tr>

<?php if ($order_status === 'accepted'): ?>
  <tr><th>Status</th><td><span class="badge bg-success">Waiting to start trip</span></td></tr>
<?php endif; ?>

<!-- Trip Details Section -->
<?php if ($order_status === 'started' || $order_status === 'ended'): ?>
  <tr><th colspan="2" class="bg-light text-primary">Trip Details</th></tr>
  <tr><th>Status</th>
      <td>
        <?php if ($order_status === 'started'): ?>
          <span class="badge bg-warning text-dark">Trip Started</span>
          <tr><th>Starting KM</th><td><?= $row['start_km'] ?></td></tr>
        <?php elseif ($order_status === 'ended'): ?>
          <span class="badge bg-success">Trip Ended</span>
        <?php endif; ?>
      </td>
  </tr>
  
  <tr><th>Start Time</th><td><?= date("d-m-Y h:i A", strtotime($row['start_time'])) ?></td></tr>
  <?php if ($order_status === 'ended'): ?>
    
    <tr><th>End Time</th><td><?= date("d-m-Y h:i A", strtotime($row['end_time'])) ?></td></tr>
    <tr><th>Starting KM</th><td><?= $row['start_km'] ?></td></tr>

    <tr><th>Ending KM</th><td><?= $row['ending_km'] ?></td></tr>
    <tr><th>Net KM</th><td><?=  $row['ending_km'] -$row['start_km'] ?></td></tr>
    <tr><th>Travel Hours</th><td><?= ($row['travel_hrs']) ?></td></tr>

    <tr><th>Trip Amount</th><td class="amount-cell">₹<?= $row['trip_amount'] ?></td></tr>
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
  <tr><th>Other Detailes</th><td ><?= $row['other_description'] ?></td></tr>
  <?php endif; ?>
<?php endif; ?>

    <tr><th>Total Amount</th><td class="amount-cell">₹<?= formatINRCurrency($row['total_amount']) ?></td></tr>
  <?php endif; ?>
<?php endif; ?>

<?php else: 
 $bid_check = mysqli_query($config, "SELECT COUNT(*) as selected_count FROM order_driver_bids WHERE order_id = '$order_id' AND bid_status = 'selected'");
 $bid_data = mysqli_fetch_assoc($bid_check);
 
?>
<?php if ($order_status != 'cancelled'): ?>
<tr>
<th>Driver Status <?= $order_status ?></th>
<td>
  <?php
  if ($bid_data['selected_count'] > 0) {
    // ✅ Show link to view driver bids
    echo '<a href="view_driver_bids.php?order_id=' . $order_id . '" class="btn btn-success btn-sm">View Selected Driver (' . $bid_data['selected_count'] . ')</a>';
  }else{
  echo '<span class="badge bg-warning text-dark">Pending...</span>';
}
date_default_timezone_set('Asia/Kolkata');

$order_id = $row['id'];
$createdAt = $row['created_at'];
$createdAtTimestamp = strtotime($createdAt);
$now = time();

// Read extension from cookie
$cookieKey = "extend_minutes_" . $order_id;
$extendMinutes = isset($_COOKIE[$cookieKey]) ? (int)$_COOKIE[$cookieKey] : 0;

// Max 6 hour window from order creation
$maxExpireTimestamp = $createdAtTimestamp + (6 * 60 * 60);
$expireTimestamp = $createdAtTimestamp + (30 * 60) + ($extendMinutes * 60);
$timeLeft = $expireTimestamp - $now;
$maxTimeLeft = $maxExpireTimestamp - $now;

// UI visibility logic
$hideExtendOption = $now >= $maxExpireTimestamp;
$showExtendOption = $now >= ($createdAtTimestamp + 30 * 60) && !$hideExtendOption;
?>

<!-- Countdown Timer -->
<div id="countdown_<?= $order_id ?>" class="text-danger small mt-1"></div>

<!-- Extend Time Dropdown -->
<div id="extend_form_<?= $order_id ?>" class="mt-2" style="display: <?= $showExtendOption ? 'block' : 'none' ?>;">
  <select id="extend_select_<?= $order_id ?>" class="form-control form-control-sm mb-2" required>
    <option value="">Extend by...</option>
    <option value="30">30 Minutes</option>
    <option value="60">1 Hour</option>
    <option value="120">2 Hours</option>
  </select>
  <button onclick="submitExtend_<?= $order_id ?>()" class="btn btn-sm btn-warning">Extend Time</button>
  <div id="response_<?= $order_id ?>" class="small text-success mt-1"></div>
</div>

<!-- JS Countdown -->
<script>
(function () {
  let timeLeft = <?= max(0, $timeLeft) ?>;
  let maxTimeLeft = <?= max(0, $maxTimeLeft) ?>;
  const countdownEl = document.getElementById("countdown_<?= $order_id ?>");
  const extendFormEl = document.getElementById("extend_form_<?= $order_id ?>");

  const interval = setInterval(() => {
    if (maxTimeLeft <= 0) {
      clearInterval(interval);
      countdownEl.innerHTML = "⛔ 6 Hours Over";
      extendFormEl.style.display = "none";

      const btn = document.createElement("button");
      btn.className = "btn btn-primary mt-2";
      btn.innerHTML = "Book Another Order";
      btn.onclick = () => location.href = 'customer_order_pokkuvadi_entry.php';
      countdownEl.parentNode.appendChild(btn);
      return;
    }

    if (timeLeft <= 0) {
      countdownEl.innerHTML = "⏳ Time expired";
      // Don't toggle dropdown here (controlled by PHP above)
    } else {
      const mins = Math.floor(timeLeft / 60);
      const secs = timeLeft % 60;
      countdownEl.innerHTML = `⏳ Time left: ${mins}m ${secs < 10 ? '0' : ''}${secs}s`;
    }

    timeLeft--;
    maxTimeLeft--;
  }, 1000);
})();
</script>

<!-- Extend Submit JS -->
<script>
function submitExtend_<?= $order_id ?>() {
  const select = document.getElementById("extend_select_<?= $order_id ?>");
  const response = document.getElementById("response_<?= $order_id ?>");

  const val = select.value;
  if (!val) {
    response.innerHTML = "❌ Please select time to extend.";
    return;
  }

  const minutesToAdd = parseInt(val);
  const cookieName = "extend_minutes_<?= $order_id ?>";
  const currentMinutes = parseInt(getCookie(cookieName)) || 0;
  const total = currentMinutes + minutesToAdd;

  const maxAllowed = 330; // Max 6hrs - 30 mins initial
  if (total > maxAllowed) {
    response.innerHTML = "❌ Cannot extend beyond total 6 hours.";
    return;
  }

  const d = new Date();
  d.setTime(d.getTime() + (6 * 60 * 60 * 1000)); // expires in 6 hrs
  document.cookie = cookieName + "=" + total + ";expires=" + d.toUTCString() + ";path=/";

  response.innerHTML = "✅ Time extended by " + minutesToAdd + " minutes.";
  setTimeout(() => location.reload(), 1000); // refresh to recalculate timer
}

// Read cookie helper
function getCookie(name) {
  let dc = document.cookie;
  let prefix = name + "=";
  let begin = dc.indexOf("; " + prefix);
  if (begin === -1) {
    begin = dc.indexOf(prefix);
    if (begin !== 0) return null;
  } else {
    begin += 2;
  }
  let end = document.cookie.indexOf(";", begin);
  if (end === -1) end = dc.length;
  return decodeURIComponent(dc.substring(begin + prefix.length, end));
}
</script>

</td>


</tr>
<?php endif; ?>
<?php endif; ?>
<?php
$order_status = strtolower(trim($row['status']));
?>

<?php if ($order_status == 'cancelled' || $order_status == 'canceled'): ?>
  <tr>
    <th>Status</th>
    <td>
      <span class="badge badge-danger">Order Cancelled</span>
    </td>
  </tr>

<?php elseif ($order_status != 'completed' && $order_status != 'ended'): ?>
  <tr>
    <th></th>
    <td>
     
      <button type="button" class="btn btn-sm btn-danger ml-2 open-cancel-modal" data-toggle="modal" data-target="#cancelModal" data-order-id="<?= $row['id'] ?>">
        Order Cancel
      </button>
    </td>
  </tr>
<?php endif; ?>

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
<!-- Cancel Modal -->
<div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="cancelForm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="cancelModalLabel">Cancel Trip</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <label for="cancel_reason">Reason for cancellation:</label>
          <textarea name="cancel_reason" id="cancel_reason" class="form-control" required></textarea>
          <input type="hidden" name="order_id" value="<?= $order_id ?>">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Submit Cancellation</button>
        </div>
      </div>
    </form>
  </div>
</div>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  <?php endwhile; ?>
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


<script>
    function disableSubmitButton() {
        var submitButton = document.querySelector('button[name="customer_add"]');
        submitButton.disabled = true;
    }

    
</script>
<script>
$(document).on('click', '.open-cancel-modal', function() {

    var orderId = $(this).data('order-id');
    $('#cancelModal input[name="order_id"]').val(orderId);
});
</script>


<script>
document.getElementById("cancelForm").addEventListener("submit", function (e) {
  e.preventDefault();

  const formData = new FormData(this);

  fetch('cancel_order.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.text())
  .then(data => {
    alert("Trip cancelled successfully.");
    location.reload();
  })
  .catch(err => {
    console.error("Error cancelling trip", err);
    alert("Something went wrong. Try again.");
  });
});
</script>



</body>

</html>


