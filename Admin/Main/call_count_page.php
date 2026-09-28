<?php 
include('../config/setup.php'); 
// Fix ONLY_FULL_GROUP_BY for MySQL 5.7+ to allow GROUP BY on non-aggregated columns
mysqli_query($config, "SET SESSION sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");
?>


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

            <h4 class="page-title">Call Count - Report</h4>



          </div>

          <div class="row">

            <div class="col-md-12">

              <div class="card">



                <div class="card-body">
                  <!-- 
								<center> <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">

                                    <i class="fas fa-plus"></i>   Add New City 

</button>
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal3">

<i class="fas fa-plus"></i>   Upload Excel

</button>
</center> -->



                  <form action="call_count_page.php " method="get">
                    <div class="form-group row">
                      <!-- <label for="staticEmail" class="col-sm-1 col-form-label">From Date</label>
              <div class="col-sm-2">
                <input type="date"  class="form-control" id="email2" name="from_date"  >
              </div> -->

                      <!-- <label for="staticEmail" class="col-sm-1 col-form-label">To Date</label>
              <div class="col-sm-2">
                <input type="date"  class="form-control" id="email2" name="to_date"  >
              </div> -->
                      <label for="staticEmail" class="col-sm-1 col-form-label">Vehicle No</label>
                      <div class="col-sm-2">

                    <select class="form-control" name="vehicle_no" id="vehicle_no">
                <option value="">--SELECT--</option>
                <?php
                $query = "SELECT DISTINCT create_post.vehicle_no 
                          FROM create_post 
                          INNER JOIN call_click_count ON create_post.post_id = call_click_count.post_id";
                $result = mysqli_query($config, $query);

                $selected_vehicle_no = $_GET['vehicle_no'] ?? ''; // Keep selected value
                
                while ($row = mysqli_fetch_object($result)) {
                    $selected = ($row->vehicle_no == $selected_vehicle_no) ? 'selected' : '';
                    echo "<option value='{$row->vehicle_no}' $selected>{$row->vehicle_no}</option>";
                }
                ?>
            </select>

                      </div>

                      <label for="state" class="col-sm-1 col-form-label">State</label>
<div class="col-sm-2">
    <select class="form-control" name="state" id="state" onchange="getDistricts(this.value,0)">
        <option value="0">--SELECT--</option>
        <?php
        $selected_state = isset($_GET['state']) ? $_GET['state'] : 0;
        $main_state = mysqli_query($config, "SELECT * FROM dir_state_master");
        while ($main_state__ = mysqli_fetch_object($main_state)) {
            $selected = ($main_state__->state_id == $selected_state) ? 'selected' : '';
        ?>
            <option value="<?php echo $main_state__->state_id; ?>" <?php echo $selected; ?>>
                <?php echo $main_state__->name; ?>
            </option>
        <?php } ?>
    </select>
</div>

<label for="district" class="col-sm-1 col-form-label">District</label>
<div class="col-sm-2">
    <select class="form-control" name="district" id="district" onchange="area(this.value);">
        <option value="0">--SELECT--</option>
    </select>
</div>

                      <!-- </div>       -->
                      <!-- <div class="form-group row">      -->
                      <label for="staticEmail" class="col-sm-1 col-form-label">City</label>
                      <div class="col-sm-2" id="area">


                      </div>




                      <div class="col-sm-12">
                        <button class="btn btn-primary btn-lg btn-block" name="date_filter">Submit</button>
                        <button type="button" class="btn btn-secondary btn-lg" onclick="clearForm()">Clear</button>

                      </div>

                    </div>
                  </form>
                  <script>
function clearForm() {
    document.querySelector("form").reset(); // Reset the form fields
    // Optionally, remove query parameters from the URL
    window.location.href = window.location.pathname; 
}
</script>
                  <div class="view-all-option">
                    <a href="?view_all=true" class="btn btn-primary">View All Data</a>
                  </div>
                  <form method="GET" class="d-flex justify-content-center mt-3">
    <!-- Preserve existing GET parameters -->

    <input type="hidden" name="vehicle_no" value="<?php echo isset($_GET['vehicle_no']) ? $_GET['vehicle_no'] : ''; ?>">
    <input type="hidden" name="state" value="<?php echo isset($_GET['state']) ? $_GET['state'] : ''; ?>">
    <input type="hidden" name="district" value="<?php echo isset($_GET['district']) ? $_GET['district'] : ''; ?>">
    <input type="hidden" name="Add_area" value="<?php echo isset($_GET['Add_area']) ? $_GET['Add_area'] : ''; ?>">
    <input type="hidden" name="date_filter" value="<?php echo isset($_GET['date_filter']) ? $_GET['date_filter'] : ''; ?>">

    <div class="input-group shadow-sm" style="max-width: 400px;">
        <input type="text" name="search_input" class="form-control rounded-start border-primary" 
               placeholder="Search here..." value="<?php echo isset($_GET['search_input']) ? $_GET['search_input'] : ''; ?>">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-search"></i> <!-- FontAwesome Search Icon -->
        </button>
    </div>
</form>

                  <hr>


                  <div class="table-responsive">

                    <table id="basic-datatables" class="display table table-striped table-hover">

                      <thead>

                        <tr>

                          <th>S.No</th>
                          <th>Driver Name </th>
                          <th>Transport Name</th>
                          <th>Vehicle No </th>
                          <th>Vehicle Photo </th>
                          <th>Phone No</th>
                          <th>Whatsapp No</th>
                          <th>State </th>

                          <th>District </th>
                          <th>City </th>
                          <th>Customer Phone No </th>
                          <th>Date & Time</th>
                          <th>Total Count</th>


                        </tr>

                      </thead>



                      <tbody>
<?php
$limit = isset($_GET['view_all']) ? 999999 : 10; // Show all if 'view_all' is set, else limit to 10 per page
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$offset = ($page - 1) * $limit;

$where = " WHERE 1=1 ";

// Search Functionality
if (!empty($_GET['search_input'])) {
    $search_value = mysqli_real_escape_string($config, $_GET['search_input']);
    $where .= " AND (create_post.driver_name LIKE '%$search_value%' 
                      OR create_post.vehicle_no LIKE '%$search_value%'
                      OR create_post.phone_no LIKE '%$search_value%'
                      OR create_post.whatsapp_no LIKE '%$search_value%')";
}

// Date Filter Functionality
if (isset($_GET['date_filter'])) {
    $vehicle_no = $_GET['vehicle_no'] ?? '';
    $state = $_GET['state'] ?? '0';
    $district = $_GET['district'] ?? '0';
    $city = $_GET['Add_area'] ?? '';

    if (!empty($vehicle_no)) {
        $where .= " AND create_post.vehicle_no='$vehicle_no' ";
    }
    if (!empty($state) && $state != '0') {
        $where .= " AND create_post.state_id='$state' ";
    }
    if (!empty($district) && $district != '0') {
        $where .= " AND create_post.city_id='$district' ";
    }
    if (!empty($city) && $city != '0') {
        $where .= " AND create_post.area_id='$city' ";
    }
}


  $query = "SELECT DISTINCT create_post.*, call_click_count.district, call_click_count.city, call_click_count.click_date,  call_click_count.phone_number
          FROM call_click_count 
          INNER JOIN create_post ON create_post.post_id = call_click_count.post_id
          $where 
          GROUP BY create_post.post_id
          ORDER BY call_click_count.call_count_id DESC 
                    LIMIT $offset, $limit";

$main_cate = mysqli_query($config, $query);
$mc = $offset + 1; // Start serial number correctly

while ($macate = mysqli_fetch_object($main_cate)) {
    $city_id = $macate->city_id;
    $area_id = $macate->area_id;
    $sub_area_id = $macate->sub_area_id;

    $cus_state = mysqli_query($config, "SELECT * FROM dir_state_master WHERE state_id='$macate->state_id'");
    $cus_state__ = mysqli_fetch_object($cus_state);

    $maincate3_ = mysqli_query($config, "SELECT * FROM dir_city_master WHERE dir_city_id ='$city_id'");
    $mac3_ = mysqli_fetch_object($maincate3_);

    $orarea3_ = mysqli_query($config, "SELECT * FROM dir_area_master WHERE dir_area_id ='$area_id'");
    $area3__ = mysqli_fetch_object($orarea3_);

    $orsub__ = mysqli_query($config, "SELECT * FROM sub_area_master WHERE sub_area_id ='$sub_area_id'");
    $orsub3__ = mysqli_fetch_object($orsub__);
?>

<tr>
    <td><?php echo $mc++; ?></td>
    <td><?php echo $macate->driver_name; ?></td>
    <td><?php echo $macate->vehicle_name; ?></td>
    <td><?php echo $macate->vehicle_no; ?></td>
    <td>
        <img src="../../photos/vehicle/<?php echo $macate->vehicle_photo; ?>" style="width: 128px; height: 129px;">
    </td>
    <td><?php echo $macate->phone_no; ?></td>
    <td><?php echo $macate->whatsapp_no; ?></td>
    <td><?php echo $cus_state__->name ?? '-'; ?></td>
    <td><?php echo $mac3_->dir_city_name ?? '-'; ?></td>
    <td><?php echo $area3__->dir_area_name ?? '-'; ?></td>
    <td><?php echo $macate->phone_number; ?></td>  <!-- Correct field for customer phone -->

    <td><?php echo $macate->click_date; ?></td>
    <td>1</td>
</tr>

<?php } ?>
</tbody>

            </table>


            <?php
$count_query = "SELECT COUNT(DISTINCT create_post.post_id) AS total 
FROM call_click_count 
INNER JOIN create_post ON create_post.post_id = call_click_count.post_id
$where";
$count_result = mysqli_query($config, $count_query);
$total_rows = mysqli_fetch_assoc($count_result)['total'];
$total_pages = ceil($total_rows / $limit);

// Define range for pagination
$range = 2;
$start_page = max(1, $page - $range);
$end_page = min($total_pages, $page + $range);

// Preserve existing query string
$query_string = $_SERVER['QUERY_STRING'];
parse_str($query_string, $params);
unset($params['page']); // Remove previous 'page' parameter
$query_string = http_build_query($params);

echo "<div class='pagination'>";

// "Previous" button
if ($page > 1) {
echo "<a class='pages m-1' href='?page=" . ($page - 1) . "&$query_string'>Previous</a>";
}

// Page numbers
if ($start_page > 1) {
echo "<a class='pages' href='?page=1&$query_string'>1</a>";
echo "<span class='pages'>...</span>";
}

for ($i = $start_page; $i <= $end_page; $i++) {
if ($i == $page) {
echo "<a class='pages current' href='?page=$i&$query_string'>$i</a>";
} else {
echo "<a class='pages' href='?page=$i&$query_string'>$i</a>";
}
}

if ($end_page < $total_pages) {
echo "<span class='pages'>...</span>";
echo "<a class='pages' href='?page=$total_pages&$query_string'>$total_pages</a>";
}

// "Next" button
if ($page < $total_pages) {
echo "<a class='pages m-1' href='?page=" . ($page + 1) . "&$query_string'>Next</a>";
}

echo "</div>";


?>



              </div>
              <!-- <button style="float:left;" id="exportBtn" class="btn btn-success"> <i class="fas fa-download"> Download Cvs</i> </button> -->


              <a style="float:left;" href="call_count_export.php?vehicle_no=<?php echo $vehicle_no; ?>&state=<?php echo $state; ?>&district=<?php echo $district; ?>&Add_area=<?php echo $city; ?>&date_filter=<?php echo $date_filter; ?><?php echo $_GET['view_all'] ? '&view_all=true' :''; ?>&search_input=<?php echo $_GET['search_input']?>" class="btn btn-success">
    <i class="fas fa-download"></i> Download CSV
</a>



            </div>


          </div>


        </div>

      </div>

    </div>

  </div>



  <!-- Modal -->

  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">

      <div class="modal-content">

        <div class="modal-header">

          <h5 class="modal-title" id="exampleModalLabel"></h5>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">

            <span aria-hidden="true">&times;</span>

          </button>

        </div>

        <div class="modal-body">

          <form action="Function/dir_area_master.php" method="post" enctype="multipart/form-data">



            <div class="form-group">

              <label for="email2">District Name</label>



              <select name="cate" class="form-select form-control" aria-label="Default select example">
                <option selected>Select </option>
                <?php



                $main_cate1 = mysqli_query($config, "select * from dir_city_master ");

                while ($macate1 = mysqli_fetch_object($main_cate1)) {

                ?>
                  <option value="<?php echo $macate1->dir_city_id ?>"><?php echo $macate1->dir_city_name ?></option>
                <?php } ?>
              </select>
            </div>

            <div class="form-group" id="a">
              <div id='TextBoxesGroup'>
                <div id="TextBoxDiv1">
                  <label for="email2">City Name</label>



                  <input type="text" id='textbox1' class="form-control" id="email2" name="area[]" placeholder="Enter area Name"> <br>
                  <input type='button' class="btn btn-success btn-sm" value='Add Area' id='addButton'>
                </div>
              </div>
            </div>














        </div>

        <div class="modal-footer">

          <button class="btn btn-primary" type="submit" name="submit">Submit</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </form>


        </div>

      </div>

    </div>

  </div>



























  <?php include('footer.php'); ?>

  </div>





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
   $(document).ready(function() {
    $('#basic-datatables').DataTable({
        searching: false, // Disable search box
        paging: false     // Disable pagination
    });
});





    $(document).ready(function() {
      // Add a click event listener to the export button
      $("#exportBtn").click(function() {
        // Use the table2excel plugin to export the table
        $("#basic-datatables").table2excel({
          exclude: ".noExl", // Add a class to exclude specific elements from the export
          name: "Excel Document",
          filename: "customerpokkuvandi.xls" // Set the desired filename
        });
      });
    });
  </script>

</body>

</html>





<script>
  $(document).ready(function() {
    var counter = 2;
    $("#addButton").click(function() {
      if (counter < 2) {
        alert("Add more textbox");
        return false;
      }

      var newTextBoxDiv = $(document.createElement('div'))
        .attr("id", 'TextBoxDiv' + counter).attr("class", 'TextBoxDiv');

      newTextBoxDiv.after().html('<label>Area ' + counter + ' : </label>' +
        '<input type="text"  class="form-control" id="email2" name="area[]" id="textbox' + counter + '"  placeholder="Enter area Name"  >' +
        '<input type="button" name="button' + counter +
        '" class="removeButton btn btn-danger btn-sm" value="Remove Area">');
      newTextBoxDiv.appendTo("#TextBoxesGroup");

      counter++;
    });

    $("body").on("click", ".removeButton", function() {
      if (counter <= 2) {
        alert("No more textbox to remove");
        return false;
      }

      $(this).closest('.TextBoxDiv').remove();
    });
  });
</script>


<style>
  .btn-danger {
    background: #f25961 !important;
    border-color: #f25961 !important;
    margin-top: 7px;
    margin-bottom: 4px;
  }
</style>

<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel"></h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <div class="modal-body">

        <form action="Function/dir_area_master.php" method="POST" enctype="multipart/form-data">
          <div class="form-group">

            <label for="email2">District Name</label>



            <select name="cate" class="form-select form-control" aria-label="Default select example">
              <option selected>Select </option>
              <?php



              $main_cate1 = mysqli_query($config, "select * from dir_city_master ");

              while ($macate1 = mysqli_fetch_object($main_cate1)) {

              ?>
                <option value="<?php echo $macate1->dir_city_id ?>"><?php echo $macate1->dir_city_name ?></option>
              <?php } ?>
            </select>
          </div>


          <div class="form-group">



            <input type="file" class="form-control" id="email2" name="excel" placeholder="Enter area Name"> <br>
            <small> <b style="color: red;">Only For CSV Format File <b></small>
          </div>
          <div class="form-group">
            <a href="district_demo.csv" download="district_demo.csv">Demo Csv File Download</a>
          </div>
      </div>
      <div class="form-group">
      </div>
      <div class="modal-footer">

        <button class="btn btn-primary" type="submit" name="exsubmit">Submit</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </form>


      </div>

    </div>

  </div>

</div>

<script>
  function sub_area(id) {
    var id;
    //alert(id);

    $.ajax({
      type: "POST",
      url: 'sub_area_post.php',
      data: {
        id: id
      }, // serializes the form's elements.
      success: function(data) {
        //alert(data);		
        console.log(data)
        $('#sa').html(data);

      }
    });

  }

  function area(id) {
    var Add_area = "<?php echo isset($_GET['Add_area']) ? $_GET['Add_area'] : 0; ?>";

    var id = id;

    $.ajax({
      type: "POST",
      url: "area_post.php",
      data: {
        id: id
      },
      success: function(data) {

        $('#area').html(data);
        if (Add_area != 0) {
                    $("#Add_area").val(Add_area);
                }
        console.log(data);
      }
    });
  }
  $(document).ready(function() {
    $('#dtHorizontalExample').DataTable({
      "scrollX": true
    });
    $('.dataTables_length').addClass('bs-select');
  });


  
</script>
<script>
  $(document).ready(function() {
    var selectedState = "<?php echo isset($_GET['state']) ? $_GET['state'] : 0; ?>";
    var selectedDistrict = "<?php echo isset($_GET['district']) ? $_GET['district'] : 0; ?>";
    var Add_area = "<?php echo isset($_GET['Add_area']) ? $_GET['Add_area'] : 0; ?>";

    
    if (selectedState != 0) {
        $("#state").val(selectedState); // Set the selected state
        getDistricts(selectedState, selectedDistrict); // Load districts
    }

    $("#state").change(function() {
        var stateId = $(this).val();
        getDistricts(stateId, 0); // Load districts without preselecting
    });
    if (selectedDistrict != 0) {
        $("#district").val(selectedDistrict); // Set the selected state
        area(selectedDistrict); // Load districts
    }
    $("#district").change(function() {
        var district = $(this).val();
        area(district); // Load districts without preselecting
    });
function getDistricts(stateId, selectedDistrict) {
  var selectedDistrict = "<?php echo isset($_GET['district']) ? $_GET['district'] : 0; ?>";
  $("#district").html('<option value="0">--SELECT--</option>'); // Reset districts if no state selected
  $("#Add_area").html('<option value="0">--SELECT--</option>'); // Reset districts if no state selected

    if (stateId != "0") {
        $.ajax({
            url: "fetch_districts.php",
            type: "POST",
            data: { state_id: stateId },
            success: function(response) {
                $("#district").html(response);
                if (selectedDistrict != 0) {
                    $("#district").val(selectedDistrict);
                }
            }
        });
    } else {
        $("#district").html('<option value="0">--SELECT--</option>'); // Reset districts if no state selected
    }
    
}
});
</script>