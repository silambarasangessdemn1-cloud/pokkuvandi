<?php
include('../config/setup.php');

// Fetch all orders
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
ORDER BY o.id DESC";

$result = mysqli_query($config, $query);

function formatINRCurrency($num)
{
    return number_format((float)$num, 2, '.', ',');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>
        <?php
        $leename = mysqli_query($config, "select Name,Name_status from lee_master");
        while ($lee = mysqli_fetch_array($leename)) {
            echo ($lee['Name_status'] == 1) ? $lee['Name'] : "Need Name";
        }
        ?>
    </title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="<?php
                            $inro_logo = mysqli_query($config, "select Logo_Path,logo_status from lee_master");
                            while ($logo = mysqli_fetch_array($inro_logo)) {
                                echo ($logo['logo_status'] == 1)
                                    ? substr($logo['Logo_Path'], 3)
                                    : "../../photos/logo/no_logo.png";
                            }
                            ?>" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="../assets/js/plugin/webfont/webfont.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


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

    <!-- DataTables + Buttons CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">

    <style>
        #filterContainer {
            margin-bottom: 20px;
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
        }

        #exportBtnContainer {
            margin-top: 20px;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="main-header">
            <?php include('logo.php'); ?>
            <?php include('topbar.php'); ?>
        </div>

        <?php include('sidebar.php'); ?>

        <div class="main-panel">
            <div class="content">
                <div class="panel-header bg-primary-gradient">
                    <div class="page-inner py-5">
                        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                            <div>
                                <h2 class="text-white pb-2 fw-bold">Online Booking Reports</h2>
                                <h5 class="text-white op-7 mb-2">Search & Export Reports</h5>
                            </div>
                            <div class="ml-md-auto py-2 py-md-0">
                                <a href="Customer_Master.php" class="btn btn-white btn-border btn-round mr-2">Manage Customer</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="page-inner mt--5">
                    <!-- FILTER SECTION -->
                    <div id="filterContainer" class="row">
                        <div class="col-md-2 mb-2">
                            <label><strong>Customer Name:</strong></label>
                            <input type="text" id="filterName" class="form-control" placeholder="Search by name">
                        </div>
                        <div class="col-md-2 mb-2">
                            <label><strong>Mobile Number:</strong></label>
                            <input type="text" id="filterMobile" class="form-control" placeholder="Search by mobile">
                        </div>
                        <div class="col-md-2 mb-2">
                            <label><strong>From Location:</strong></label>
                            <input type="text" id="filterFrom" class="form-control" placeholder="Search from location">
                        </div>
                        <div class="col-md-2 mb-2">
                            <label><strong>To Location:</strong></label>
                            <input type="text" id="filterTo" class="form-control" placeholder="Search to location">
                        </div>
                        <div class="col-md-2 mb-2">
                            <label><strong>Status:</strong></label>
                            <select id="filterStatus" class="form-control">
                                <option value="">All</option>
                                <option value="Pending">Pending</option>
                                <option value="Ongoing">Ongoing</option>
                                <option value="Completed">Completed</option>
                                <option value="Expired">Expired</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-2">
                            <label><strong>Payment Status:</strong></label>
                            <select id="filterPayment" class="form-control">
                                <option value="">All</option>
                                <option value="Paid">Paid</option>
                                <option value="Unpaid">Unpaid</option>
                            </select>
                        </div>
                    </div>

                    <!-- TABLE SECTION -->
                    <div class="table-responsive">
                        <table id="reportTable" class="table table-bordered table-striped align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Customer</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Total KM</th>
                                    <th>Goods / Persons</th>
                                    <th>Body Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    <th style="display:none">Trip Type</th>
                                    <th style="display:none">Vehicle Required</th>
                                    <th style="display:none">Driver</th>
                                    <th style="display:none">Phone</th>
                                    <th style="display:none">Quote</th>
                                    <th style="display:none">Weight</th>
                                    <th style="display:none">Start Time</th>
                                    <th style="display:none">Starting KM</th>
                                    <th style="display:none">End Time</th>
                                    <th style="display:none">Ending KM</th>
                                    <th style="display:none">Net KM</th>
                                    <th style="display:none">Travel Hours</th>
                                    <th style="display:none">Trip Amount</th>
                                    <th style="display:none">Driver Bata</th>
                                    <th style="display:none">Toll</th>
                                    <th style="display:none">Unloading</th>
                                    <th style="display:none">Waiting</th>
                                    <th style="display:none">Total Amount</th>
                                    <th style="display:none">Discount</th>
                                    <th style="display:none">Net Amount</th>
                                    <th style="display:none">Cash Received</th>
                                    <th style="display:none">Bank Received</th>
                                    <th style="display:none">Total Received</th>
                                    <th style="display:none">Payment Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                    <?php
                                    $order_id = $row['id'];
                                    $driver_id = $row['driver_id'] ?? null;
                                    $driver_name = $driver_phone = $bid_amount = '-';
                                    $payment_status = '';
                                    $total_amount = $row['total_amount'] ?? 0;

                                    if ($driver_id) {
                                        $driver_query = mysqli_query($config, "SELECT driver_name, phone_no FROM create_post WHERE customer_id = '$driver_id'");
                                        $driver_data = mysqli_fetch_assoc($driver_query);
                                        $driver_name = $driver_data['driver_name'] ?? '-';
                                        $driver_phone = $driver_data['phone_no'] ?? '-';

                                        $bid_query = mysqli_query($config, "SELECT bid_amount FROM order_driver_bids WHERE order_id = '$order_id' AND driver_id = '$driver_id' AND bid_status = 'selected' LIMIT 1");
                                        $bid_row = mysqli_fetch_assoc($bid_query);
                                        $bid_amount = $bid_row['bid_amount'] ?? '-';
                                    }

                                    $payment_query = mysqli_query($config, "SELECT * FROM trip_payments WHERE order_id = '$order_id'");
                                    $payment_data = mysqli_fetch_assoc($payment_query);
                                    if ($payment_data) {
                                        $payment_status = ($payment_data['status'] === 'completed') ? 'Paid' : 'Unpaid';
                                        $total_amount = $payment_data['net_amount'];
                                    }

                                    if (!empty($row['ending_km'])) $trip_status = 'Completed';
                                    elseif (!empty($row['start_km'])) $trip_status = 'Ongoing';
                                    else $trip_status = 'Pending';
                                    ?>
                                    <tr>
                                        <td><?= $row['id'] ?></td>
                                        <td><?= htmlspecialchars($row['name']) ?><br><small><?= $row['customer_phone'] ?></small></td>
                                        <td><?= $row['loader_from_place'] ?><?= !empty($row['from_area_name']) ? ', ' . $row['from_area_name'] : '' ?></td>
                                        <td><?= !empty($row['drop_place']) ? $row['drop_place'] : $row['loader_to_place'] ?><?= !empty($row['to_area_name']) ? ', ' . $row['to_area_name'] : '' ?></td>
                                        <td><?= $row['total_km'] ?> km</td>
                                        <td>
                                            <?php if ($row['Add_main_cate'] == 1): ?>
                                                <?= !empty($row['product_details']) ? htmlspecialchars($row['product_details']) : '-' ?><br><?= !empty($row['total_weight']) ? $row['total_weight'] . ' kg' : '' ?>
                                            <?php elseif ($row['Add_main_cate'] == 2): ?>
                                                <?= $row['n_ofperson'] ?> Persons
                                            <?php endif; ?>
                                        </td>
                                        <td><?= ucfirst($row['vehicle_body_type']) ?></td>
                                        <td><?= $trip_status ?></td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm viewBtn" data-id="<?= $row['id']; ?>">
                                                View
                                            </button>
                                        </td>

                                        <td style="display:none"><?= $row['trip_type'] ?></td>
                                        <td style="display:none"><?= $row['vehicle_required'] ?></td>
                                        <td style="display:none"><?= $driver_name ?></td>
                                        <td style="display:none"><?= $driver_phone ?></td>
                                        <td style="display:none"><?= $bid_amount ?></td>
                                        <td style="display:none"><?= $row['total_weight'] ?></td>
                                        <td style="display:none"><?= $row['start_time'] ?></td>
                                        <td style="display:none"><?= $row['start_km'] ?></td>
                                        <td style="display:none"><?= $row['end_time'] ?></td>
                                        <td style="display:none"><?= $row['end_km'] ?></td>
                                        <td style="display:none"><?= $row['net_km'] ?></td>
                                        <td style="display:none"><?= $row['travel_hours'] ?></td>
                                        <td style="display:none"><?= $row['trip_amount'] ?></td>
                                        <td style="display:none"><?= $row['driver_bata'] ?></td>
                                        <td style="display:none"><?= $row['toll'] ?></td>
                                        <td style="display:none"><?= $row['unloading'] ?></td>
                                        <td style="display:none"><?= $row['waiting'] ?></td>
                                        <td style="display:none"><?= $row['total_amount'] ?></td>
                                        <td style="display:none"><?= $row['discount'] ?></td>
                                        <td style="display:none"><?= $row['net_amount'] ?></td>
                                        <td style="display:none"><?= $row['cash_received'] ?></td>
                                        <td style="display:none"><?= $row['bank_received'] ?></td>
                                        <td style="display:none"><?= $row['total_received'] ?></td>
                                        <td style="display:none"><?= $row['payment_status'] ?></td>


                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                        <!-- Modal -->
                        <!-- View Modal -->
                        <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewModalLabel">Trip Details</h5>
                                        <!-- ✅ Correct close button -->
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-bordered">
                                            <tbody id="modalBodyContent"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- JS Files -->
    <script src="../assets/js/core/jquery.3.2.1.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>

    <!-- DataTables + Buttons JS -->
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>


    <script>
        $(document).ready(function() {
            var table = $('#reportTable').DataTable({
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50, 100],
                ordering: true,
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'excelHtml5',
                    text: 'Export to Excel',
                    className: 'btn btn-success btn-sm',
                    title: 'All Reports',
                    exportOptions: {
                        columns: ':visible,:hidden', // ✅ export all visible columns including "View"
                        format: {
                            body: function(data, row, column, node) {
                                // Keep button text or inner HTML
                                var html = $('<div>').html(data).text().trim();
                                return html ? html : data;
                            }
                        }
                    }
                }]
            });


            table.buttons().container().appendTo('#exportBtnContainer');

            // === FILTERS ===
            $('#filterName').on('keyup', function() {
                table.column(1).search(this.value).draw();
            });
            $('#filterMobile').on('keyup', function() {
                table.column(1).search(this.value).draw();
            });
            $('#filterFrom').on('keyup', function() {
                table.column(3).search(this.value).draw();
            });
            $('#filterTo').on('keyup', function() {
                table.column(3).search(this.value).draw();
            });
            $('#filterStatus').on('change', function() {
                table.column(7).search(this.value).draw();
            });
            $('#filterPayment').on('change', function() {
                table.column(13).search(this.value).draw();
            });

            // === VIEW MODAL ===
            // ✅ Handle View button click (works even after search/pagination)
            $(document).on('click', '.viewBtn', function() {
                var tripId = $(this).data('id');

                $.ajax({
                    url: 'get_trip_details.php',
                    type: 'GET',
                    data: {
                        id: tripId
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            var data = response.data;

                            let html = `
                    <tr><th>Order ID</th><td>${data.order_id || ''}</td></tr>
                    <tr><th>Customer</th><td>${data.customer_name || ''}</td></tr>
                    <tr><th>From</th><td>${data.from_location || ''}</td></tr>
                    <tr><th>To</th><td>${data.to_location || ''}</td></tr>
                    <tr><th>Total KM</th><td>${data.total_km || ''}</td></tr>
                    <tr><th>Goods</th><td>${data.goods || ''}</td></tr>
                    <tr><th>Body Type</th><td>${data.body_type || ''}</td></tr>
                    <tr><th>Weight</th><td>${data.weight || ''}</td></tr>
                    <tr><th>Trip Type</th><td>${data.trip_type || ''}</td></tr>
                    <tr><th>Vehicle Required</th><td>${data.vehicle_required || ''}</td></tr>
                    <tr><th>Driver</th><td>${data.driver_name || ''}</td></tr>
                    <tr><th>Driver Phone</th><td>${data.driver_phone || ''}</td></tr>
                    <tr><th>Quote</th><td>${data.quote || ''}</td></tr>
                    <tr><th>Status</th><td>${data.status || ''}</td></tr>
                    <tr><th>Start Time</th><td>${data.start_time || ''}</td></tr>
                    <tr><th>Starting KM</th><td>${data.starting_km || ''}</td></tr>
                    <tr><th>End Time</th><td>${data.end_time || ''}</td></tr>
                    <tr><th>Ending KM</th><td>${data.ending_km || ''}</td></tr>
                    <tr><th>Net KM</th><td>${data.net_km || ''}</td></tr>
                    <tr><th>Travel Hours</th><td>${data.travel_hours || ''}</td></tr>
                    <tr><th>Trip Amount</th><td>${data.trip_amount || ''}</td></tr>
                    <tr><th>Driver Bata</th><td>${data.driver_bata || ''}</td></tr>
                    <tr><th>Toll</th><td>${data.toll || ''}</td></tr>
                    <tr><th>Unloading</th><td>${data.unloading || ''}</td></tr>
                    <tr><th>Waiting</th><td>${data.waiting || ''}</td></tr>
                    <tr><th>Total Amount</th><td>${data.total_amount || ''}</td></tr>
                    <tr><th>Discount</th><td>${data.discount || ''}</td></tr>
                    <tr><th>Net Amount</th><td>${data.net_amount || ''}</td></tr>
                    <tr><th>Cash Received</th><td>${data.cash_received || ''}</td></tr>
                    <tr><th>Bank Received</th><td>${data.bank_received || ''}</td></tr>
                    <tr><th>Total Received</th><td>${data.total_received || ''}</td></tr>
                    <tr><th>Payment Status</th><td>${data.payment_status || ''}</td></tr>
                `;

                            $('#modalBodyContent').html(html);
                            $('#viewModal').modal('show');
                        } else {
                            alert('Trip not found.');
                        }
                    },
                    error: function() {
                        alert('Error fetching details.');
                    }
                });
            });

        });
    </script>


    <!-- ✅ DataTables Core -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- ✅ DataTables Buttons extension -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>

    <!-- ✅ JSZip (required for Excel export) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

    <!-- ✅ HTML5 Export buttons -->
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>

    <!-- ✅ Optional: for Bootstrap styling (if you use Bootstrap tables) -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>



</body>

</html>