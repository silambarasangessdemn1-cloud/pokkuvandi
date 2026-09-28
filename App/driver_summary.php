<?php include('config/setup.php');?>
<?php include('session.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Driver Summary</title>
    
    <link rel="stylesheet" type="text/css" href="vendor/slick/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="vendor/slick/slick-theme.min.css"/>
    <link href="vendor/icons/icofont.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="vendor/sidebar/demo.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
</head>

<body>
<?php include('Directory_topmenu.php');?>

<!-- Get Driver Summary Data -->
<?php
// Total Orders (orders driver has bidded on)
$totalOrdersQuery = "SELECT COUNT(DISTINCT order_id) as total FROM order_driver_bids WHERE driver_id = '$prof_id'";
$totalOrdersResult = mysqli_query($config, $totalOrdersQuery);
$totalOrders = mysqli_fetch_assoc($totalOrdersResult)['total'];

// Accepted Orders
$acceptedQuery = "SELECT COUNT(*) as total FROM order_driver_bids 
                  WHERE driver_id = '$prof_id' AND customer_status = 'accepted'";
$acceptedResult = mysqli_query($config, $acceptedQuery);
$acceptedOrders = mysqli_fetch_assoc($acceptedResult)['total'];

// Pending Quotes
$pendingQuery = "SELECT COUNT(*) as total FROM order_driver_bids 
                 WHERE driver_id = '$prof_id' AND customer_status = 'pending'";
$pendingResult = mysqli_query($config, $pendingQuery);
$pendingQuotes = mysqli_fetch_assoc($pendingResult)['total'];

// Completed Orders
$completedQuery = "SELECT COUNT(DISTINCT odb.order_id) as total FROM order_driver_bids odb
                   INNER JOIN orders o ON odb.order_id = o.id
                   WHERE odb.driver_id = '$prof_id' AND odb.customer_status = 'accepted' 
                   AND o.status = 'completed'";
$completedResult = mysqli_query($config, $completedQuery);
$completedOrders = mysqli_fetch_assoc($completedResult)['total'];

// Total Earnings
$earningsQuery = "SELECT SUM(o.total_amount) as total FROM order_driver_bids odb
                  INNER JOIN orders o ON odb.order_id = o.id
                  WHERE odb.driver_id = '$prof_id' AND odb.customer_status = 'accepted' 
                  AND o.status = 'completed'";
$earningsResult = mysqli_query($config, $earningsQuery);
$totalEarnings = mysqli_fetch_assoc($earningsResult)['total'] ?? 0;

// Ongoing Orders
$ongoingQuery = "SELECT COUNT(DISTINCT odb.order_id) as total FROM order_driver_bids odb
                 INNER JOIN orders o ON odb.order_id = o.id
                 WHERE odb.driver_id = '$prof_id' AND odb.customer_status = 'accepted' 
                 AND o.status NOT IN ('completed', 'ended', 'cancelled')";
$ongoingResult = mysqli_query($config, $ongoingQuery);
$ongoingOrders = mysqli_fetch_assoc($ongoingResult)['total'];
?>

<div class="osahan-body mt-3">
    <div class="container">
        <h4 class="mb-4"><i class="fas fa-chart-line mr-2"></i>Driver Summary Dashboard</h4>
        
        <div class="row">
            <!-- Total Orders Card -->
            <div class="col-6 col-md-3 mb-3">
                <a href="driver_order_view.php" class="text-decoration-none">
                    <div class="card border-primary shadow-sm clickable-card">
                        <div class="card-body text-center">
                            <i class="fas fa-file-alt fa-2x text-primary mb-2"></i>
                            <h3 class="text-primary"><?= $totalOrders ?></h3>
                            <p class="text-muted mb-0">Total Quotes</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Accepted Orders Card -->
            <div class="col-6 col-md-3 mb-3">
                <a href="driver_order_view.php?type=ongoing" class="text-decoration-none">
                    <div class="card border-success shadow-sm clickable-card">
                        <div class="card-body text-center">
                            <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                            <h3 class="text-success"><?= $acceptedOrders ?></h3>
                            <p class="text-muted mb-0">Accepted</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Ongoing Orders Card -->
            <div class="col-6 col-md-3 mb-3">
                <a href="driver_order_view.php?type=ongoing" class="text-decoration-none">
                    <div class="card border-warning shadow-sm clickable-card">
                        <div class="card-body text-center">
                            <i class="fas fa-truck fa-2x text-warning mb-2"></i>
                            <h3 class="text-warning"><?= $ongoingOrders ?></h3>
                            <p class="text-muted mb-0">Ongoing</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Completed Orders Card -->
            <div class="col-6 col-md-3 mb-3">
                <a href="driver_order_history.php" class="text-decoration-none">
                    <div class="card border-info shadow-sm clickable-card">
                        <div class="card-body text-center">
                            <i class="fas fa-flag-checkered fa-2x text-info mb-2"></i>
                            <h3 class="text-info"><?= $completedOrders ?></h3>
                            <p class="text-muted mb-0">Completed</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row mt-3">
            <!-- Total Earnings Card -->
            <div class="col-12 col-md-6 mb-3">
                <div class="card border-success shadow">
                    <div class="card-body text-center">
                        <i class="fas fa-rupee-sign fa-2x text-success mb-2"></i>
                        <h3 class="text-success">₹<?= number_format($totalEarnings, 2) ?></h3>
                        <p class="text-muted mb-0">Total Earnings</p>
                    </div>
                </div>
            </div>

            <!-- Pending Quotes Card -->
            <div class="col-12 col-md-6 mb-3">
                <a href="driver_order_view.php" class="text-decoration-none">
                    <div class="card border-secondary shadow clickable-card">
                        <div class="card-body text-center">
                            <i class="fas fa-clock fa-2x text-secondary mb-2"></i>
                            <h3 class="text-secondary"><?= $pendingQuotes ?></h3>
                            <p class="text-muted mb-0">Pending Quotes</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-link mr-2"></i>Quick Links</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 col-md-4 mb-2">
                                <a href="driver_order_view.php" class="btn btn-outline-primary btn-block">
                                    <i class="fas fa-bell mr-2"></i>Notification Orders
                                </a>
                            </div>
                            <div class="col-6 col-md-4 mb-2">
                                <a href="driver_order_view.php?type=ongoing" class="btn btn-outline-warning btn-block">
                                    <i class="fas fa-truck mr-2"></i>Ongoing Orders
                                </a>
                            </div>
                            <div class="col-6 col-md-4 mb-2">
                                <a href="driver_order_view.php?type=ended" class="btn btn-outline-info btn-block">
                                    <i class="fas fa-dollar-sign mr-2"></i>Payment Pending
                                </a>
                            </div>
                            <div class="col-6 col-md-4 mb-2">
                                <a href="driver_order_history.php" class="btn btn-outline-success btn-block">
                                    <i class="fas fa-history mr-2"></i>Completed Orders
                                </a>
                            </div>
                            <div class="col-6 col-md-4 mb-2">
                                <a href="create_post.php" class="btn btn-outline-secondary btn-block">
                                    <i class="fas fa-plus-circle mr-2"></i>New Registration
                                </a>
                            </div>
                            <div class="col-6 col-md-4 mb-2">
                                <a href="createpost_list.php" class="btn btn-outline-dark btn-block">
                                    <i class="fas fa-list mr-2"></i>My Vehicles
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    transition: transform 0.2s;
}
.card:hover {
    transform: translateY(-5px);
}
.clickable-card {
    cursor: pointer;
}
.clickable-card:hover {
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}
</style>

<?php $pro_page = '3'; include('footermenu.php');?>
<?php include('menu.php');?>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/slick/slick.min.js"></script>
<script src="vendor/sidebar/hc-offcanvas-nav.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="js/osahan.js"></script>
</body>
</html>

