<?php include('config/setup.php');
include('session.php');
session_start();

if(!$prof_id){
header('Location: logout.php');
}
// Generate a unique token
$token = bin2hex(random_bytes(32));

// Store the token in the session
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
            <h5 class="text-center mt-3 mb-3">Vechicle Booking Form</h5>


            <div class="card">

                <div class="container">

                    <div class="row">
                        <div style="border-bottom: 0px solid #e5e5e5 !important" class="modal-header">
                            <?php
                            if ($_GET['msg']) { ?>
                                <div class="col-md-12 col-sm-12 ">
                                    <div class="alert alert-success" role="alert">
                                        Post Successfully
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                        <div class="modal-body">
                            <div class="contact-form default-form">
                                <form id="orderForm" method="post">
                                    <div class="row clearfix">
                                        <input type="hidden" name="form_token" value="<?php echo $token; ?>">
                                        <input type="hidden" name="cust_id" value="<?php echo $prof_id; ?>">


                                        <div class="form-group col-md-6">
                                            <label for="email2"> Customer Name</label>
                                            <input type="text" class="form-control" id="name" name="name" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="email2"> Customer Mobile Number </label>
                                            <input type="text" class="form-control" id="customer_phone" name="customer_phone" maxlength="10" pattern="\d{10}" required>
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
                                            <select  class="form-control" name="Add_main_cate" id="mainCategorySelect" onchange="loadSubCategories(this.value);" required>
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
    <input type="text" class="form-control" id="vehicle_required_datetime" name="vehicle_required_datetime"  placeholder="Enter Date & Time" required>
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
        while($state = mysqli_fetch_object($states_query)) {
            echo '<option value="'.$state->state_id.'">'.$state->name.'</option>';
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
        while($district = mysqli_fetch_object($districts_query)) {
            echo '<option value="'.$district->dir_city_id.'">'.$district->dir_city_name.'</option>';
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
        while($state = mysqli_fetch_object($states_query)) {
            echo '<option value="'.$state->state_id.'">'.$state->name.'</option>';
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
        while($district = mysqli_fetch_object($districts_query)) {
            echo '<option value="'.$district->dir_city_id.'">'.$district->dir_city_name.'</option>';
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
                         }"
    >
</div>


                                        <div class="form-group col-md-6 goods-only" style="display: none;">
                                            <label for="product_details">Material Details</label>
                                            <input type="text" class="form-control" id="product_details" name="product_details" placeholder="Product Details" >
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
                            </div>
                        </div>

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
document.addEventListener("DOMContentLoaded", function () {
    // ⏰ Set default time to now + 30 minutes
    const now = new Date();
    const defaultTime = new Date(now.getTime() + 30 * 60000); // +30 mins

    flatpickr("#vehicle_required_datetime", {
        enableTime: true,
        dateFormat: "Y-m-d h:i K", // ⏳ 12-hour format with AM/PM
        time_24hr: false,          // ⏳ Use AM/PM format
        minuteIncrement: 10,       // ⏱ Allow only multiples of 10 mins
        disableMobile: true,
        defaultDate: defaultTime,
        minDate: defaultTime,      // ❌ Prevent past selection (30 mins from now)

        enable: [
            function(date) {
                const today = new Date();
                const tomorrow = new Date();
                tomorrow.setDate(today.getDate() + 1);

                // Normalize dates
                today.setHours(0, 0, 0, 0);
                tomorrow.setHours(0, 0, 0, 0);
                date.setHours(0, 0, 0, 0);

                return (
                    date.getTime() === today.getTime() ||
                    date.getTime() === tomorrow.getTime()
                );
            }
        ],

        onReady: function (selectedDates, dateStr, instance) {
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
                instance.close();
            });
            instance.calendarContainer.appendChild(setButton);
        }
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
    document.addEventListener("DOMContentLoaded", function() {
        const vehicleSelect = document.getElementById("mainCategorySelect");
        const requiredVehicleInput = document.getElementById("required_vehicle_type");

        function toggleFieldsBySelect() {
            const selectedValue = vehicleSelect.value;

            // Adjust values if your IDs differ
            const isPassenger = selectedValue === "2";
            const isGoods = selectedValue === "1";
 // Toggle goods-only fields
 document.querySelectorAll(".goods-only").forEach(el => {
        el.style.display = isGoods ? "block" : "none";
        el.querySelectorAll("input, select, textarea").forEach(field => {
            field.required = isGoods;
        });
    });

    // Toggle passenger-only fields
    document.querySelectorAll(".passenger-only").forEach(el => {
        el.style.display = isPassenger ? "block" : "none";
        el.querySelectorAll("input, select, textarea").forEach(field => {
            field.required = isPassenger;
        });
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
        xhr.open("POST", "fetch_sub_categories.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onload = function() {
            if (this.status === 200) {
                document.getElementById("sc").innerHTML = this.responseText;
            }
        };

        xhr.send("main_cat_id=" + encodeURIComponent(mainCatId));
    }
    // document.addEventListener("change", function() {
    //     const subCatSelect = document.getElementById("Add_sub_cate_Name");
    //     const totalKmInput = document.getElementById("total_km");
    //     const calculationBox = document.getElementById("calculationDetails");

    //     function updateCalculation() {
    //         const selectedOption = subCatSelect?.selectedOptions[0];
    //         const totalKm = parseFloat(totalKmInput?.value) || 0;

    //         // Assuming selectedOption, totalKm, and calculationBox are defined
    //         if (selectedOption && selectedOption.dataset.base && selectedOption.dataset.rate) {
    //             const base = parseFloat(selectedOption.dataset.base);
    //             const rate = parseFloat(selectedOption.dataset.rate);
    //             const total = base + (rate * totalKm);

    //             // Display total amount and approximate amount
    //             calculationBox.innerHTML = `₹${total.toFixed(2)} (Approximate)`;
    //         } else {
    //             // Default value when there's no data
    //             calculationBox.innerHTML = "₹0 (Approximate)";
    //         }

    //     }

    //     // Attach listeners
    //     document.body.addEventListener("change", updateCalculation);
    //     document.body.addEventListener("input", updateCalculation);
    // });


    function submitOrder() { 
    const form = document.getElementById("orderForm");
    const datetimeInput = document.getElementById("vehicle_required_datetime").value;

    // ✅ Parse to JS Date object
    const parsedDate = new Date(datetimeInput);

    // ✅ Format to 24-hour string: YYYY-MM-DD HH:MM
    const formattedDatetime = parsedDate.getFullYear() + "-" +
        String(parsedDate.getMonth() + 1).padStart(2, '0') + "-" +
        String(parsedDate.getDate()).padStart(2, '0') + " " +
        String(parsedDate.getHours()).padStart(2, '0') + ":" +
        String(parsedDate.getMinutes()).padStart(2, '0');

    // ✅ Debug
    console.log("Formatted datetime:", formattedDatetime);
alert(formattedDatetime);
    // HTML5 validation
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    const formData = new FormData(form);

    // ❌ Remove old field (optional)
    formData.delete("vehicle_required_datetime");

    // ✅ Append formatted datetime
    formData.append("vehicle_required_datetime", formattedDatetime);

    fetch("store_order.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
    .then(msg => {
        const encodedMsg = encodeURIComponent(msg);
        window.location.href = "view_order.php?message=" + encodedMsg;
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
                url: 'get_city_name.php', // The PHP file that retrieves cities based on district
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
        var id = $(this).val(); // Get selected district ID
        if (id) {
            $.ajax({
                url: 'get_city_name.php', // The PHP file that retrieves cities for "To" district
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