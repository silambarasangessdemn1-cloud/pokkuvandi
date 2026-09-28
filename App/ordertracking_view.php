<?php include('config/setup.php');
include('session.php');
session_start();
// Generate a unique token

// sanitize just in case

$order_id = $_GET['order_id'];

// Get order and driver details
$query = "
    SELECT o.*, 
           d.driver_name, d.phone_no,
           a1.dir_area_name AS from_area_name, 
           a2.dir_area_name AS to_area_name,
           sc.Sub_Category_Name
    FROM orders o
    LEFT JOIN create_post d ON o.driver_id = d.customer_id
    LEFT JOIN dir_area_master a1 ON o.from_city = a1.dir_area_id
    LEFT JOIN dir_area_master a2 ON o.to_city = a2.dir_area_id
    LEFT JOIN sub_category sc ON o.Add_sub_category = sc.Sub_Category_id
    WHERE o.id = '$order_id'
";

$result = mysqli_query($config, $query);
$order = mysqli_fetch_assoc($result);
if (!$order) {
    echo "Order not found.";
    exit;
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
            <h5 class="text-center mt-3 mb-3"> View Order </h5>


            <div class="card">

                <div class="container">

                <div class="row">

                <div class="container mt-5">
  
                <div class="container my-4">
    <h3 class="mb-4 text-primary fw-bold">🚚 Driver Bids for Order #<?= htmlspecialchars($order_id) ?></h3>
    <div class="container my-5">
    <h2 class="mb-4 text-primary">📦 Order Tracking Details</h2>

    <div class="card mb-4 shadow">
        <div class="card-body">
            <h5 class="card-title text-success">Order #<?= $order['id'] ?></h5>
            <p><strong>📍 From:</strong> <?= $order['from_area_name'] ?> → <?= $order['to_area_name'] ?></p>
            <p><strong>🛣 Total KM:</strong> <?= $order['total_km'] ?> km</p>
            <p><strong>🚛 Vehicle Body Type:</strong> <?= $order['vehicle_body_type'] ?></p>
            <p><strong>📦 Sub Category:</strong> <?= $order['Sub_Category_Name'] ?></p>
            <p><strong>💰 Total Amount:</strong> ₹<?= number_format($order['total_amount'], 2) ?></p>
            <p><strong>📅 Date:</strong> <?= date('d M Y', strtotime($order['created_at'])) ?></p>
            <p><strong>Status:</strong> 
                <?php
                    $status = ucfirst($order['status']);
                    $badge = 'secondary';
                    if ($status == 'Accepted') $badge = 'success';
                    elseif ($status == 'Pending') $badge = 'warning';
                    elseif ($status == 'Cancelled') $badge = 'danger';
                ?>
                <span class="badge bg-<?= $badge ?>"><?= $status ?></span>
            </p>
        </div>
    </div>

    <?php if ($order['driver_id']): ?>
        <div class="card shadow">
            <div class="card-body">
                <h5 class="card-title text-info">👨‍✈️ Assigned Driver Details</h5>
                <p><strong>Name:</strong> <?= $order['driver_name'] ?></p>
                <p><strong>Phone:</strong> <?= $order['phone_no'] ?></p>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-warning">No driver assigned yet.</div>
    <?php endif; ?>

    <a href="orders_list.php" class="btn btn-secondary mt-4">← Back to Orders</a>
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
                    window.location.href = `ordertracking_view.php?order_id=${orderId}`;
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
                    location.reload();
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


