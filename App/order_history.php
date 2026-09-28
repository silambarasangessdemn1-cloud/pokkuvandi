<?php include('config/setup.php');
include('session.php');
session_start();
// Generate a unique token


// sanitize just in case
$query = "SELECT o.*, 
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
WHERE o.cust_id = '$prof_id' and o.status = 'completed'
ORDER BY o.id DESC";

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
   <!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<?php function formatINRCurrency($num) {
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
}?>

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
            <h5 class="text-center mt-3 mb-3"> View Orders History</h5>

<div class="container mt-5">
  <div class="row">
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
      <div class="col-12 mb-3">
        <div class="card shadow-sm">
          
          <!-- Card Header (Collapsible Trigger) -->
          <div class="card-header bg-light" data-toggle="collapse" data-target="#collapse<?= $row['id'] ?>" style="cursor: pointer;">
            <h5 class="mb-0 d-flex justify-content-between align-items-center">
              <span>Order #<?= $row['id'] ?> - <?= $row['requiredvehicle_type'] ?></span>
              <i class="toggle-icon">+</i>
            </h5>
            <small class="text-muted">Posted on: <?= date('d M Y h:i A', strtotime($row['created_at'])) ?></small>
          </div>

          <!-- Collapsible Content -->
          <div id="collapse<?= $row['id'] ?>" class="collapse">
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
    <th>Body Type</th>
    <td>
        <?php
        $bodyType = strtolower(trim($row['vehicle_body_type']));
        if ($bodyType === 'open') {
            echo 'Open Body';
        } elseif ($bodyType === 'close') {
            echo 'Closed Body';
        } else {
            echo ''; // or echo 'Unknown Body Type';
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
    <th>Body Type</th>
    <td>
        <?php
        $bodyType = strtolower(trim($row['vehicle_body_type']));
        if ($bodyType === 'open') {
            echo 'Open Body';
        } elseif ($bodyType === 'close') {
            echo 'Closed Body';
        } else {
            echo ''; // or echo 'Unknown Body Type';
        }
        ?>
    </td>
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
<!-- Trip Details Section -->
<tr><th colspan="2" class="bg-light text-primary">Trip Details</th></tr>

<?php if (!empty($row['start_km'])): ?>
<tr><th>Status</th>
    <td>
        <?php if (!empty($row['ending_km'])): ?>
            <span class="badge bg-success">Trip Completed</span>
       
        <?php endif; ?>
    </td>
</tr>
<tr><th>Start Time</th><td><?= date("d-m-Y h:i A", strtotime($row['start_time'])) ?></td></tr>
<tr><th>Starting KM</th><td><?= $row['start_km'] ?></td></tr>
<?php endif; ?>

<?php if (!empty($row['ending_km'])): ?>
<tr><th>End Time</th><td><?= date("d-m-Y h:i A", strtotime($row['end_time'])) ?></td></tr>
<tr><th>Ending KM</th><td><?= $row['ending_km'] ?></td></tr>
<tr><th>Net KM</th><td><?= $row['ending_km'] - $row['start_km'] ?></td></tr>
<tr><th>Travel Hours</th><td><?= ($row['travel_hrs']) ?></td></tr>
<tr><th>Trip Amount</th><td class="amount-cell"><?= $row['trip_amount'] ?></td></tr>
<?php endif; ?>

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

<?php if (!empty($row['total_amount'])): ?>
    <tr><th>Total Amount</th><td class="amount-cell text-dark"  style="font-size: 20px;">₹<?= formatINRCurrency($row['total_amount']) ?></td></tr>
<?php endif; ?>

 <?php 
 
 $payment_query = mysqli_query($config, "SELECT * FROM trip_payments WHERE order_id = '$order_id'");
$payment_data = mysqli_fetch_assoc($payment_query);
?>

<?php if (!function_exists('formatIndianNumber')) {
    function formatIndianNumber($num) {
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
}
?>
<?php if ($payment_data): ?>
<tr><th colspan="2" class="bg-light text-primary">Payment Details</th></tr>

<tr><th style="white-space: nowrap;" >Total Amount</th><td class="amount-cell text-dark"><?= formatIndianNumber($payment_data['total_amount']) ?></td></tr>

<?php if ($payment_data['discount'] > 0): ?>
<tr><th>Discount</th><td class="amount-cell"><?= formatIndianNumber($payment_data['discount']) ?></td></tr>
<?php endif; ?>

<tr><th>Net Amount</th><td class="amount-cell"> <?= formatIndianNumber($payment_data['net_amount']) ?></td></tr>

<tr><th>Cash Received</th><td class="amount-cell"><?= formatIndianNumber($payment_data['cash_received']) ?></td></tr>
<tr><th>Bank Received</th><td class="amount-cell"><?= formatIndianNumber($payment_data['bank_received']) ?></td></tr>
<tr><th>Total Received</th><td class="amount-cell-green" >₹<?= formatIndianNumber($payment_data['total_received']) ?></td></tr>

<tr><th class="text-nowrap">Payment Status</th>
<td class="amount-cell">
  <?php if ($payment_data['status'] === 'completed'): ?>
    <span class="badge bg-success font-weight-bold text-white" style="font-size: 16px;">Paid</span>

  <?php endif; ?>
</td>
</tr>
<?php endif; ?>



  

  <!-- JavaScript Countdown -->
 
</td>


</tr>
<?php endif; ?>
<?php
$order_status = strtolower(trim($row['status']));
?>




            </tbody>
          </table>
          </div>

  </div>
            </div>
          </div>

        </div>
      </div>
    <?php endwhile; ?>
  </div>
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
  $(document).ready(function () {
    $('.card-header').click(function () {
      var target = $(this).data('target');
      var icon = $(this).find('.toggle-icon');
      
      // Toggle the icon manually
      $(target).on('shown.bs.collapse', function () {
        icon.text('−');
      }).on('hidden.bs.collapse', function () {
        icon.text('+');
      });
    });
  });
</script>



</body>

</html>


