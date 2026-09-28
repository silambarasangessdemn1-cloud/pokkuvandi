<?php include('../config/setup.php'); ?>

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


        <div class="main-panel">
            <div class="content">
                <div class="page-inner">
                    <div class="page-header">
                        <div class="page-header d-flex justify-content-between align-items-center">
                            <h4 class="page-title">ADD Order </h4>

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

                            <div class="card">
                                <div class="card-header">

                                </div>
                                <div class="card-body">




                                    <form id="orderForm" method="post">
                                        <div class="row clearfix" style="margin-left: -10px;">

                                            <input type="hidden" name="form_token" value="<?php echo $token; ?>">
                                            <input type="hidden" name="cust_id" id="cust_id">

                                            <div class="form-group col-md-6">
                                                <label for="email2">Customer Name</label>
                                                <input type="text" class="form-control" id="Add_driver_name" onkeyup="cum(this.value)" name="Add_driver_name" required>
                                                <div id="serach_result">
                                                    <ul class="subnav sug-list-color" id="serach_result1">
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="email2">Customer Phone No</label>
                                                <input type="hidden" class="form-control" name="customerid" id="customerid"
                                                    placeholder="">
                                                <input type="hidden" class="form-control" name="name" id="name">
                                                <input type="hidden" class="form-control" name="customer_phone" id="customer_phone">
                                                <input type="number" class="form-control" id="phone_no" name="Add_phone_no" onkeypress="if(this.value.length==10) return false;" required>
                                            </div>
                                            <!-- 
<div class="form-group col-md-6">    
 <label for="email2">To Date</label>
 <input value="'<?php echo $to_date_time ?>'" type="datetime-local" class="form-control" id="loader_to_date" name="loader_to_date"  >
</div>  -->

                                            <!-- <div class="form-group col-md-6">
                                                    <label for="exampleInputName1">Customer District Name</label>
                                                        <select required class="form-control" id='city' name="Add_city">
                                                            <option value="">---SELECT---</option>
                                                            <?php
                                                            $main_cate = mysqli_query($config, "select * from dir_city_master");
                                                            while ($addsubcate = mysqli_fetch_object($main_cate)) {
                                                            ?>
                                                            <option value="<?php echo $addsubcate->dir_city_id; ?>"><?php echo $addsubcate->dir_city_name; ?></option>
                                                            <?php } ?>                                                        
                                                        </select>
                                                       
                                                </div> -->
                                            <div class="form-group col-md-6">
                                                <label for="email2">vechicle Type</label>
                                                <select class="form-control" name="Add_main_cate" id="mainCategorySelect" onchange="loadSubCategories(this.value);" required>
                                                    <option value="">---SELECT---</option>
                                                    <?php
                                                    $main_cate = mysqli_query($config, "SELECT * FROM main_category WHERE Main_Category_Status = '1' AND Main_Category_id IN (1, 2)");
                                                    while ($addsubcate = mysqli_fetch_object($main_cate)) {
                                                    ?>
                                                        <option <?php if (isset($_SESSION['Add_main_cate']) && $_SESSION['Add_main_cate'] == $addsubcate->Main_Category_id) echo 'selected="selected"'; ?>
                                                            value="<?php echo $addsubcate->Main_Category_id; ?>">
                                                            <?php echo $addsubcate->Main_Category_Name; ?>
                                                        </option>
                                                    <?php } ?>
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
                                                <input type="text" class="form-control" id="required_vehicle_type" name="requiredvehicle_type" placeholder="Enter vehicle type" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="vehicle_required_datetime">Vehicle Required Date & Time</label>
                                                <input type="text" class="form-control" id="vehicle_required_datetime" name="vehicle_required_datetime" placeholder="Enter Date & Time" required>
                                            </div>

                                            <div class="form-group col-md-6 goods-only">
                                                <label>Vehicle Body Type</label><br>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="vehicle_body_type" id="openBody" value="Open" checked required>
                                                    <label class="form-check-label" for="openBody">Open Body</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="vehicle_body_type" id="closeBody" value="Close">
                                                    <label class="form-check-label" for="closeBody">Closed Body</label>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6 ">
                                                <label>Trip Type</label><br>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="trip_type" id="oneWay" value="One Way" checked required>
                                                    <label class="form-check-label" for="oneWay">One Way Trip</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="trip_type" id="roundTrip" value="Round Trip">
                                                    <label class="form-check-label" for="roundTrip">Round Trip</label>
                                                </div>
                                            </div>



                                            <div class="form-group col-md-6">
                                                <label for="from_state">From State</label>
                                                <select required class="form-control" id="from_state" name="from_state" onchange="loadDistricts(this.value)" required>
                                                    <option value="">---SELECT---</option>
                                                    <?php
                                                    $states_query = mysqli_query($config, "SELECT * FROM dir_state_master");
                                                    while ($state = mysqli_fetch_object($states_query)) {
                                                        echo '<option value="' . $state->state_id . '">' . $state->name . '</option>';
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
                                                    while ($district = mysqli_fetch_object($districts_query)) {
                                                        echo '<option value="' . $district->dir_city_id . '">' . $district->dir_city_name . '</option>';
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
                                                <input type="text" class="form-control" id="loader_from_place" name="loader_from_place" placeholder="Location Name" required>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="to_state">To State</label>
                                                <select required class="form-control" id="to_state" name="to_state" onchange="toloadDistricts(this.value)" required>
                                                    <option value="">---SELECT---</option>
                                                    <?php
                                                    $states_query = mysqli_query($config, "SELECT * FROM dir_state_master");
                                                    while ($state = mysqli_fetch_object($states_query)) {
                                                        echo '<option value="' . $state->state_id . '">' . $state->name . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="to_district">To District</label>
                                                <select required class="form-control" id="to_district" name="to_district" required>
                                                    <option value="">---SELECT---</option>
                                                    <?php
                                                    $districts_query = mysqli_query($config, "SELECT * FROM dir_city_master");
                                                    while ($district = mysqli_fetch_object($districts_query)) {
                                                        echo '<option value="' . $district->dir_city_id . '">' . $district->dir_city_name . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>


                                        </div>



                                        <div class="form-group col-md-6" id="to_city_container" style="display: none;">
                                            <label>To City</label>
                                            <select class="form-control" id="to_city" name="to_city">
                                                <option value="">--Select City--</option>
                                            </select>
                                        </div>

                                        <div class="row clearfix">

                                            <!-- <div class="form-group col-md-6">    
                                                <label for="email2">Load Pick Up Place</label>
                                                <input   type="text" class="form-control" id="loader_from_place" name="loader_from_place" required >
                                                </div>   -->

                                            <div class="form-group col-md-6 passenger-only" style="display: none;">
                                                <label for="drop_place">Drop Place</label>
                                                <input type="text" class="form-control" id="drop_place" name="drop_place" placeholder="Drop Place">
                                            </div>

                                            <div class="form-group col-md-6 goods-only" style="display: none;">
                                                <label for="loader_to_place">Delivery Place</label>
                                                <input type="text" class="form-control" id="loader_to_place" name="loader_to_place" placeholder="Location Name">
                                            </div>

                                            <div class="form-group col-md-6" required>
                                                <label for="total_km">Total Km</label>
                                                <input type="text" class="form-control" id="total_km" name="total_km" placeholder="Approximate Total Km" required>
                                            </div>

                                            <div class="form-group col-md-6 passenger-only" style="display: none;">
                                                <label for="n_ofperson">Number of Person</label>
                                                <input type="text" class="form-control" id="n_ofperson" name="n_ofperson" placeholder="Number of Person">
                                            </div>

                                            <div class="form-group col-md-6 goods-only" style="display: none;">
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
                         }">
                                            </div>


                                            <div class="form-group col-md-6 goods-only" style="display: none;">
                                                <label for="product_details">Metrial Details</label>
                                                <input type="text" class="form-control" id="product_details" name="product_details" placeholder="Product Details">
                                            </div>


                                            <!-- <div class="form-group col-md-6">    
 <label for="email2">Available Space</label>
 <input  type="text" class="form-control" id="loader_space" name="loader_space"  >
</div>   -->




                                            <input type="hidden" value="'<?php echo $id ?>'" class="form-control" id="post_id" name="post_id">

                                            <div class="form-group">

                                                <button type="submit" class="btn btn-success ml-1" onclick="submitOrder()">Place order</a>
                                                    <!-- <button type="button" class="btn btn-secondary ml-2" data-dismiss="modal">Close</button> -->
                                            </div>
                                            <?php

                                            ?>
                                        </div>



                                    </form>


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
                                    function cum(customerid) {

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

                                    function serach_result(customerid, name, phone_no) {
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
                                                calculationBox.innerHTML = `₹${total.toFixed(2)} (Approximate)`;
                                            } else {
                                                // Default value when there's no data
                                                calculationBox.innerHTML = "₹0 (Approximate)";
                                            }

                                        }

                                        // Attach listeners
                                        document.body.addEventListener("change", updateCalculation);
                                        document.body.addEventListener("input", updateCalculation);
                                    });


                                    function submitOrder() {
    const form = document.getElementById("orderForm");

    // Trigger HTML5 validation
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    const formData = new FormData(form);

    fetch("../../App/store_order.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
    .then(msg => {
        // Encode message for URL
        const encodedMsg = encodeURIComponent(msg);

        // ✅ Redirect to order_details.php after successful submission
        window.location.href = "order_deatiles.php?message=" + encodedMsg;
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
    document.addEventListener("DOMContentLoaded", function() {
        flatpickr("#vehicle_required_datetime", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            disableMobile: true,
            defaultDate: new Date(),
            enable: [
                function(date) {
                    // Only allow today and tomorrow
                    const today = new Date();
                    const tomorrow = new Date();
                    tomorrow.setDate(today.getDate() + 1);

                    // Clear time portion
                    today.setHours(0, 0, 0, 0);
                    tomorrow.setHours(0, 0, 0, 0);
                    date.setHours(0, 0, 0, 0);

                    return (date.getTime() === today.getTime() || date.getTime() === tomorrow.getTime());
                }
            ],
            onReady: function(selectedDates, dateStr, instance) {
                // Create "Set" button
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
                    instance.close(); // Close the calendar
                });

                // Append it to the calendar container
                instance.calendarContainer.appendChild(setButton);
            }
        });
    });
</script>

</body>

</html>