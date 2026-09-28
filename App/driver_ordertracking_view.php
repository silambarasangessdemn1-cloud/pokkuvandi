<?php include('config/setup.php');
include('session.php');
session_start();
// Generate a unique token

$driver_id = $prof_id?? null;

if (!$driver_id) {
    echo "Unauthorized access.";
    exit;
}

$order_id = $_GET['order_id'] ?? 6;

if (!$order_id) {
    echo "Invalid order ID.";
    exit;
}

 $query = "
    SELECT o.*, 
           a1.dir_area_name AS from_area_name, 
           a2.dir_area_name AS to_area_name,
           sc.Sub_Category_Name
    FROM orders o
    LEFT JOIN dir_area_master a1 ON o.from_city = a1.dir_area_id
    LEFT JOIN dir_area_master a2 ON o.to_city = a2.dir_area_id
    LEFT JOIN sub_category sc ON o.Add_sub_category = sc.Sub_Category_id
    WHERE o.id = '$order_id' AND o.driver_id = '$driver_id'
";

$result = mysqli_query($config, $query);
$order = mysqli_fetch_assoc($result);

if (!$order) {
    echo "Order not found or not assigned to you.";
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
  
                <h2 class="mb-4 text-primary">🚛 Driver Trip Tracking</h2>

    <div class="card shadow mb-4">
        <div class="card-body">
            <h5 class="card-title text-success">Order #<?= $order['id'] ?></h5>
            <p><strong>📍 From:</strong> <?= $order['from_area_name'] ?> → <?= $order['to_area_name'] ?></p>
            <p><strong>🛣 Total KM:</strong> <?= $order['total_km'] ?> km</p>
            <p><strong>🚛 Vehicle Body Type:</strong> <?= $order['vehicle_body_type'] ?></p>
            <p><strong>📦 Sub Category:</strong> <?= $order['Sub_Category_Name'] ?></p>
            <p><strong>💰 Total Amount:</strong> ₹<?= number_format($order['total_amount'], 2) ?></p>
            <p><strong>Status:</strong> <span id="status-badge" class="badge bg-info"><?= ucfirst($order['status']) ?></span></p>
        </div>
    </div>

    <div id="trip-actions">
    <?php if ($order['status'] === 'accepted'): ?>
        <button class="btn btn-warning w-100 mb-3 trip-btn" data-action="start">▶️ Start Trip</button>
    <?php elseif ($order['status'] === 'started'): ?>
        <button class="btn btn-danger w-100 mb-3 trip-btn" data-action="end">⛔ End Trip</button>
    <?php elseif ($order['status'] === 'completed'): ?>
        <div class="alert alert-success text-center">✅ Trip Completed</div>
    <?php endif; ?>
</div>


    <a href="driver_dashboard.php" class="btn btn-secondary">← Back to Dashboard</a>
</div>


<!-- Driver Amount Modal -->
<!-- Trip Action Modal -->
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
          <input type="hidden" name="order_id" value="<?= $order['id'] ?>">

          <div class="form-group">
            <label>Date</label>
            <input type="text" class="form-control" name="trip_date" id="tripDate" readonly>
          </div>
          <div class="form-group">
            <label>Time</label>
            <input type="text" class="form-control" name="trip_time" id="tripTime" readonly>
          </div>

          <div class="form-group">
            <label>Remarks</label>
            <textarea class="form-control" name="remarks" placeholder="Optional..."></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">✅ Confirm</button>
        </div>
      </div>
    </form>
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


<script>
    function disableSubmitButton() {
        var submitButton = document.querySelector('button[name="customer_add"]');
        submitButton.disabled = true;
    }
</script>


<script>
 $('#start-trip').on('click', function () {
    $.post('update_trip_status.php', {
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
    $.post('update_trip_status.php', {
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
<script>
$(document).ready(function () {
    $('.trip-btn').click(function () {
        const action = $(this).data('action');
        const now = new Date();
        const date = now.toISOString().slice(0, 10); // YYYY-MM-DD
        const time = now.toTimeString().slice(0, 5); // HH:MM

        $('#tripActionType').val(action);
        $('#tripModalLabel').text(action === 'start' ? 'Start Trip' : 'End Trip');
        $('#tripDate').val(date);
        $('#tripTime').val(time);

        $('#tripModal').modal('show');
    });

    $('#tripActionForm').submit(function (e) {
        e.preventDefault();
        const formData = $(this).serialize();

        $.post('update_trip_status.php', formData, function (response) {
            if (response === 'success') {
                location.reload(); // Reload to reflect updated status
            } else {
                alert('Something went wrong. Please try again.');
            }
        });
    });
});
</script>




</body>

</html>


