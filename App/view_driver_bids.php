<?php include('config/setup.php');
include('session.php');
session_start();
// Generate a unique token


// sanitize just in case
//$driver_id = $_SESSION['driver_id'];
$order_id = $_GET['order_id'];

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



$result = mysqli_query($config, $query);
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
   
</head>

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
          


            <div class="card">

                <div class="container">

                <div class="row">

                <div class="container my-4">
                <div class="alert alert-warning" style="font-size: 16px; line-height: 1.6;">
  <strong>⚠️ Note:</strong> This quote includes only the <strong>Trip Amount</strong>.<br>
  Additional charges such as <strong>Toll</strong>, <strong>Driver Bata</strong>, <strong>Loading/Unloading</strong>, <strong>Permit</strong>, or <strong>Other Charges</strong> (if applicable) will be <u>added at the end of the trip</u>.
</div>

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
document.addEventListener('DOMContentLoaded', function () {
    // Accept Bid
    document.querySelectorAll('.accept-bid-btn').forEach(button => {
        button.addEventListener('click', function () {
            const orderId = this.dataset.orderId;
            const driverId = this.dataset.driverId;
            const bidAmount = this.dataset.bidAmount;

            fetch('accept_driver_bid_ajax.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: `order_id=${orderId}&driver_id=${driverId}&bid_amount=${bidAmount}`
            })
            .then(res => res.text())
            .then(response => {
                if (response.trim() === 'success') {
                    window.location.href = `view_order.php`;
                //    window.location.href = `ordertracking_view.php?order_id=${orderId}`;
                } else {
                    alert('Failed to accept bid. Please try again.');
                }
            });
        });
    });

    // Cancel Bid
    document.querySelectorAll('.cancel-bid-btn').forEach(button => {
        button.addEventListener('click', function () {
            const orderId = this.dataset.orderId;
            const driverId = this.dataset.driverId;

            fetch('cancel_driver_bid_ajax.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: `order_id=${orderId}&driver_id=${driverId}`
            })
            .then(res => res.text())
            .then(response => {
                if (response.trim() === 'success') {
                    window.location.href = `view_order.php`;
                //    window.location.href = `ordertracking_view.php?order_id=${orderId}`;
             
                } else {
                    alert('Failed to cancel bid. Please try again.');
                }
            });
        });
    });
});
</script>


</body>

</html>


