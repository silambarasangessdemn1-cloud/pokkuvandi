<?php include('config/setup.php');
include('session.php');
$mid = $_REQUEST['mid'];
$sid = $_REQUEST['sid'];
$_SESSION['sid'] = $sid;
$_SESSION['mid'] = $mid;
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

  <script src="
      https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js
      "></script>
  <link href="
      https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css
      " rel="stylesheet">


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


      <div class="row m-0 mt-2">

        <div class="col-12">
          <span style="
    position: relative;
    top: 2px;
    left: 0%;
    font-size:17px;
    color:#000;
    margin: 2%;
"><?php echo $_GET['keyword'] ?></span>

        </div>

        <!-- State Filter -->
        <div class="col-4" style="background: white;border: 0.5px solid #dee2e6;">
          <div class="row" style="background: #e9ecef;">
            <div class="col-12 text-center">
              <label class="">State</label>
            </div>
          </div>
          <select required class="form-control" id="state" name="state" onchange="loadDistricts(this.value)">
            <option value="">---SELECT---</option>
            <?php
            $state_query = mysqli_query($config, "SELECT * FROM dir_state_master");
            while ($state = mysqli_fetch_object($state_query)) {
              echo "<option value='{$state->state_id}'>{$state->name}</option>";
            }
            ?>
          </select>
        </div>

        <!-- District Filter -->
        <div class="col-4" style="background: white;border: 0.5px solid #dee2e6;">
          <div class="row" style="background: #e9ecef;">
            <div class="col-12 text-center">
              <label class="">District</label>
            </div>
          </div>
          <select id="main_city" class="form-control" onchange="loadCityOptions(this.value)">
            <option value="">---SELECT---</option>
          </select>
        </div>

        <!-- City Filter -->
        <div class="col-4" style="background: white;border: 0.5px solid #dee2e6;">
          <div class="row" style="background: #e9ecef;">
            <div class="col-12 text-center">
              <label class="">City</label>
            </div>
          </div>
          <?php
          $city = $_SESSION["city"];
          $nn = "SELECT * FROM `dir_area_master` where dir_cityid='$city' ";
          $main_cate33 = mysqli_query($config, $nn);
          ?>
          <div id="fa">
            <select id='sarea' class="form-control" onchange="sub_area(this.value);">
              <option value="" selected>Select City</option>
              <option value="1">All</option>
              <?php
              while ($macate33 = mysqli_fetch_object($main_cate33)) {
                $_SESSION["dir_area_id"] = $macate33->dir_area_id;
                $dir_area_id = $_SESSION["dir_area_id"];
              ?>
                <option value="<?php echo $macate33->dir_area_id ?>"><?php echo $macate33->dir_area_name ?></option>
              <?php } ?>
            </select>
          </div>
        </div>

        <!-- Vehicle Body Type Filter - Only show when sid is 1 or 2 -->
        <?php if ($sid == 1 || $sid == 2 || $sid == 50) { ?>
        <div class="col-4" id="vehicle_body_type_filter" style="background: white;border: 0.5px solid #dee2e6; display: none;">
          <div class="row" style="background: #e9ecef;">
            <div class="col-12 text-center">
              <label class="">Body Type</label>
            </div>
          </div>
          <select id='vehicle_body_type' class="form-control" onchange="filterByBodyType();">
            <option value="">All</option>
            <option value="Open Body">Open Body</option>
            <option value="Container Body">Container Body</option>
          </select>
        </div>
        <?php } ?>

      </div>

      <!-- <div class="col-4" style="background: white;border: 0.5px solid #dee2e6;"> 
    <?php
    $nn = "SELECT * FROM `sub_category_filter` where 	Sub_Category_id	='$mid'";
    $main_cate33 = mysqli_query($config, $nn);
    ?>
    <div id="top" class="fiter">
      <select id='topfilter' class="form-select form-control" aria-label="Default select example">
  <option value=""  selected>Filter</option>
<?php
while ($macate33 = mysqli_fetch_object($main_cate33)) { ?>
  <option value="<?php echo $macate33->filter_id ?>"><?php echo $macate33->name ?></option>
<?php } ?>
</select>
</div> 

</div> -->


    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <div class="card">

    </div>

  </div>

  <div class="m-2">

    <?php
    $or_ = "SELECT * FROM `sub_category` where Sub_Category_id ='$sid' Order by Sub_Category_id  DESC ";
    $maincate3_ = mysqli_query($config, $or_);
    $mac3_ = mysqli_fetch_object($maincate3_);

    $or__ = "SELECT * FROM `main_category` where Main_Category_id ='$mac3_->Main_Category' Order by Main_Category_id  DESC ";
    $maincate3__ = mysqli_query($config, $or__);
    $mac3__ = mysqli_fetch_object($maincate3__);
    ?>

    <div class="crump">
      <div class="container">
        <nav style="--bs-breadcrumb-divider: '/'" aria-label="breadcrumb">
          <ol class="breadcrumb" style="background-color:#f0f2f5 !important;">
            <li style="margin-left: -23px;color:#e23e57;" class="breadcrumb-item"><a href="Directory.php">Home</a></li>
            <li class="breadcrumb-item"><a href="Directory.php"><?php echo $mac3__->Main_Category_Name ?></a></li>
            <li class="breadcrumb-item"><a href="Directory_subcate.php?mid=<?php echo $mac3__->Main_Category_id ?>&Main_Category_Name=<?php echo $mac3__->Main_Category_Name ?>"><?php echo $mac3_->Sub_Category_Name ?></a></li>

          </ol>
        </nav>
      </div>
    </div>

    <input type="hidden" name='mid' class="form-control" id="mid" aria-describedby="emailHelp" value="<?php echo $_GET['mid'] ?>" placeholder="">
    <style>
      #load-more-btn {

        text-align: center;
        /* Center align the content */

      }
    </style>
    <div class="" id="arearesult">



      <?php
      if ((($ldata == 0))) { ?>

        <img src="data1.png" style="width: 100%;">
      <?php }
      ?>

    </div>

    <div id="load-more-container" style="text-align: center; margin: 20px auto; width: 150px;">
      <button id="load-more-btn" class="btn btn-primary" style="display:none;" data-page="1" data-total="100">Load More...</button>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal_call" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Please Enter Your Contact Number</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="call_popup">


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



</body>

</html>



<style>
  .slick-slide img {

    display: block;
    width: 100%;
    height: 100%;

  }
</style>

<script>
  var currentscrollHeight = 0;

  var count = 0;

  jQuery(document).ready(function($) {

    for (var i = 0; i < 8; i++) {

      callData(count); //Call 8 times on page load

      count++;

    }

  });

  $(window).on("scroll", function() {

    const scrollHeight = $(document).height();

    const scrollPos = Math.floor($(window).height() + $(window).scrollTop());

    const isBottom = scrollHeight - 100 < scrollPos;

    if (isBottom && currentscrollHeight < scrollHeight) {

      //alert('calling...');

      for (var i = 0; i < 6; i++) {

        callData(count); //Once at bottom of page -> call 6 times

        count++;

      }

      currentscrollHeight = scrollHeight;

    }

  });

  function callData(counter) {

    $.ajax({

      type: "GET",

      url: "promo_video.php",

      dataType: "json",

      success: function(result) {

        // alert(result['vid']);

        $('<div class="card my-4 py-3"><h4 class="card-title">' + result[0] + '</h4><p>' + counter + '</p></div>').appendTo('.list');

      },

      error: function(result) {

        //alert("error");

        $('<div class="card my-4 py-3"><h4 class="card-title">API call failed</h4><p>' + counter + '</p></div>').appendTo('.list');

      }

    });

  }

  function call_count(id) {
    // alert(id);
    var id;
    $.ajax({
      type: "POST",
      url: "call_count_check.php",
      data: {
        id: id
      },
      success: function(data) {
        // alert(data);
        $('#call_popup').html(data);
        console.log(data);


      }
    });

  }


  function call_insert(id, pho) {


    var id;
    var pho;
    // alert(pho);
    var phone_number = $('#phone_number').val();
    if (phone_number == '') {
      alert("Enter your Mobile No");
    } else {

      $.ajax({
        type: "POST",
        url: "call_count_insert.php",
        data: {
          id: id,
          phone_number: phone_number
        },
        success: function(data) {
          console.log(data);
          if (data == 1) {

            // $(".alertload").attr("style", "display: block;padding:20px;");
            // $(".alertload").delay(1000).fadeOut(500);

            // $('.msgload').html("Loader Updated ");   

            Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'Success',
              showConfirmButton: false,
              timer: 1500
            })

            setTimeout(function() {
              $('#exampleModal_call').modal('hide');
            }, 1000);

            var telLink = 'tel:' + pho;
            window.open(telLink, '_blank');
          }


        }
      });
    }
  }
</script>

<style>
  iframe {

    width: 100%;

    height: 200px;

    padding: 1%;

  }

  .card {

    padding: 2%;

  }

  .complete {



    display: none;



  }

  .r_less {
    display: none;
  }

  .modal {

    position: fixed;
    top: 0;
    left: 0;
    padding: 1%;
    z-index: 1050;
    /* padding-bottom: 21%; */
    display: none;
    width: 99%;
    height: 71%;
    overflow: hidden;
    outline: 0;
    outline: 0;

  }

  .b_title {

    text-align: center;

  }
</style>



<script>
  function more(id) {



    // alert(id);

    $("#sb_t" + id).attr("style", "display: none;");



    $("#f_t" + id).attr("style", "display: block;");



    $("#more" + id).attr("style", "display: none;");
    $("#less" + id).attr("style", "display: block;float: right;");


  }


  function less(id) {



    // alert(id);

    $("#sb_t" + id).attr("style", "display: block;");



    $("#f_t" + id).attr("style", "display: none;");



    $("#more" + id).attr("style", "display: block;float: right;");
    $("#less" + id).attr("style", "display: none;float: right;");


  }
</script>

<?php
$inro_logo22 = mysqli_query($config, "SELECT * FROM `lee_master`");

$logo22 = mysqli_fetch_object($inro_logo22);

?>



<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel">Enquiry</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <div class="modal-body">

        <form Method='POST' id='cform'>

          <div class="form-group">

            <label for="exampleInputEmail1">Name</label>

            <input type="text" name='name' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $session__username; ?>" placeholder="" required>
            <input type="hidden" name='send_email' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value='<?php echo $logo22->Email_id ?>'>

          </div>

          <div class="form-group">

            <label for="exampleInputEmail1">E-Mail Address</label>

            <input type="email" name='email' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $session__mail; ?>" placeholder="">

          </div>
          <div class="form-group">

            <label for="exampleInputEmail1">City</label>
            <select id="enq_city" name="enq_city" class="form-select form-control form-select-lg mb-3" aria-label=".form-select-lg example">

              <?php

              $main_cate3 = mysqli_query($config, "SELECT * FROM `dir_city_master` ORDER BY `dir_city_master`.`dir_city_name` ASC");

              while ($macate3 = mysqli_fetch_object($main_cate3)) {

              ?>
                <option value="<?php echo $macate3->dir_city_id ?>"><?php echo $macate3->dir_city_name ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Area</label>
            <div id="enq_earea">
              <select id="" name="enq_area" class="form-select form-control form-select-lg mb-3" aria-label=".form-select-lg example">

                <?php

                $main_cate3 = mysqli_query($config, "SELECT * FROM `dir_area_master` where dir_cityid='" . $_SESSION["city"] . "' ORDER BY `dir_area_master`.`dir_area_name` ASC ");

                while ($macate3 = mysqli_fetch_object($main_cate3)) {

                ?>
                  <option value="<?php echo $macate3->dir_area_id ?>"><?php echo $macate3->dir_area_name ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">

            <label for="exampleInputPassword1">Phone Number</label>

            <input type="number" name='phone' class="form-control" id="exampleInputPassword1" value="<?php echo $session__phone; ?>" placeholder="" required>

          </div>

          <div class="form-group">

            <label for="exampleInputPassword1">Message</label>

            <textarea name='msg' class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
          </div>



          <button type="submit" class="btn btn-primary">Submit</button> <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>



        </form>

      </div>



    </div>

  </div>

</div>



<script>
  $("#cform").submit(function(e) {



    e.preventDefault(); // avoid to execute the actual submit of the form.



    var form = $(this);

    var actionUrl = 'bussiness_contact.php';

    // $("#exampleModal").modal('hide');

    $.ajax({

      type: "POST",

      url: actionUrl,

      data: form.serialize(), // serializes the form's elements.

      success: function(data)

      {

        // alert(data); 

        if (data == 1)

        {

          $('#cform')[0].reset();

          // $('#modal').modal('hide');

          //  $('.modal').modal('toggle'); 

          $("#exampleModal").modal('toggle');

          // setTimeout(function(){ $(".alert").show(); }, 3000); 
          $(".alert").attr("style", "display: block;");


          // Show the div in 5s
          $(".alert").delay(3000).fadeOut(500);
        }

      }

    });



  });


  $(document).ready(function() {

    var id = $('#set_city').val();
    if (id == 0) {
      // $('#exampleModalcity').modal('show'); 
    } else {

    }

    $("#sarea").html('<option value="">---SELECT---</option>');

  });
</script>

<script>
    $("#main_city").change(function() {
    var city = $("#main_city").val();
    var vehicleBodyType = $("#vehicle_body_type").val() || '';

    $('#subarea').children('option:not(:first)').remove();

    var mid = $('#mid').val();
    var city_name = $("#main_city :selected").text();
    $.ajax({
      type: "POST",
      url: "se_city.php",
      data: {
        city: city,
        city_name: city_name
      },
      success: function(data) {
        $('#city_name').html(city_name);
        $('#farea').html(city_name);
      }
    });
    $.ajax({
      type: "POST",
      url: "post_se_city_area.php",
      data: {
        city: city,
        city_name: city_name
      },
      success: function(data) {
        console.log(data);
        $('#fa').html(data);
      }
    });

    $.ajax({
      type: "POST",
      url: 'post_city_com.php',
      data: {
        city: city,
        mid: mid,
        vehicle_body_type: vehicleBodyType
      },
      success: function(data) {
        $('#arearesult').html(data);
      }
    });

  });
</script>

<script>
  $(document).ready(function() {

    var id = $('#set_city').val();
    if (id == 0) {
      // $('#exampleModalcity').modal('show'); 
    } else {

    }
  });


  $(document).ready(function() {
    // Load first 20 records on page load
    loadPosts(1);

    $("#load-more-btn").click(function() {
      var button = $(this);
      var currentPage = parseInt(button.data("page"));
      var totalPages = parseInt(button.data("total"));
      var nextPage = currentPage + 1;
      var mid = "<?php echo $mid; ?>";
      var sid = "<?php echo $sid; ?>";
      var city = $("#sarea").val();
      var state = $("#state").val();
      var district = $("#main_city").val();
      var vehicleBodyType = $("#vehicle_body_type").val() || '';

      var limit = 20; // Load 20 per click

      $.ajax({
        url: "load_more.php",
        type: "GET",
        data: {
          page: nextPage,
          mid: mid,
          district: district,
          state: state,
          city: city,
          vehicle_body_type: vehicleBodyType,
          sid: sid,
          limit: limit
        },
        beforeSend: function() {
          button.text("Loading...");
        },
        success: function(response) {
          if (response.trim() !== "") {
            $("#arearesult").append(response);
            $("#load-more-btn").show();
            button.data("page", nextPage);
            button.text("Load More...");

            // Hide button if no more records
            if (nextPage >= totalPages) {
              button.hide();
            }
          } else {
            button.hide();
          }
        }
      });
    });

    function loadPosts(page) {
      var mid = "<?php echo $mid; ?>";
      var sid = "<?php echo $sid; ?>";
      var limit = 20;

      $.ajax({
        url: "load_more.php",
        type: "GET",
        data: {
          page: page,
          mid: mid,
          sid: sid,
          limit: limit
        },
        success: function(response) {
          $("#load-more-btn").show();

          $("#arearesult").html(response);
        }
      });
    }
  });
</script>


<script>
  $("#enq_city").change(function() {

    var city = $("#enq_city").val();

    $.ajax({
      type: "POST",
      url: "dir_enq_city.php",
      data: {
        city: city
      },
      success: function(data) {
        $('#enq_earea').html(data);
      }
    });

  });


  $('#city').on('change', function() {

    var id = this.value;
    var kmid = $('#kmid').val();

    $.ajax({
      type: "POST",
      url: "area_post.php",
      data: {
        id: id,
        kmid: kmid
      },
      success: function(data) {

        $('#area').html(data);

        console.log(data);
      }
    });




  });


  function maincateg(id) {
    var id;


    $.ajax({
      type: "POST",
      url: 'main_sub_cate.php',
      data: {
        id: id
      }, // serializes the form's elements.
      success: function(data) {
        // alert(data);		
        $('#sc').html(data);

      }
    });



    $.ajax({
      type: "POST",
      url: 'main_cate_package.php',
      data: {
        id: id
      }, // serializes the form's elements.
      success: function(data) {
        // alert(data);		
        $('#pk').html(data);

      }
    });


    if (id == '1') {
      $('#vr').show();
      $('#vrother').hide();
    } else if (id == '2') {
      $('#vr').show();
      $('#vrother').hide();
    } else {
      $('#vr').hide();
      $('#vrother').show();

    }



  }

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
          $('#serach_result1').html(data);

        }
      });
    } else {
      $('#serach_result1').html('');
    }
  }


  function serach_result(customerid, name, phone_no) {
    $('#detaisl').val(name);
    $('#customerid').val(customerid);
    $('#serach_result1').html('');
    $('#phone_no').val(phone_no);
    // $('#address').val(address);  
  }



  function subcateg(id) {
    var id;
    // alert(id);
    $.ajax({
      type: "POST",
      url: 'sub_cate_add_filter.php',
      data: {
        id: id
      }, // serializes the form's elements.
      success: function(data) {
        // alert(data);		
        $('#filter').html(data);

      }
    });
  }


  function package(id) {
    var id;
    // alert(id);
    $.ajax({
      type: "POST",
      url: 'package_amount.php',
      data: {
        id: id
      }, // serializes the form's elements.
      success: function(data) {
        // alert(data);		
        $('#pkamount').html(data);

      }
    });
  }



  $(document).ready(function() {
    $("#sarea").change(function() {
      var area = $('#sarea').val();
      var mid = $('#mid').val();
      var vehicleBodyType = $("#vehicle_body_type").val() || '';
      
      $.ajax({
        type: "POST",
        url: 'post_area_com.php',
        data: {
          area: area,
          mid: mid,
          vehicle_body_type: vehicleBodyType
        },
        success: function(data) {
          $('#arearesult').html(data);
        }
      });
    });


    $("#subarea").change(function() {

      var area = $('#subarea').val();
      var mid = $('#mid').val();

      $.ajax({

        type: "POST",

        url: 'post_sub_area_com.php',

        data: {
          area: area,
          mid: mid
        }, // serializes the form's elements.

        success: function(data)

        {
          //alert(data);

          $('#arearesult').html(data);



        }

      });
    });




    $("#topfilter").change(function() {
      var area = $('#topfilter').val();
      //alert(area);
      var mid = $('#mid').val();
      //alert(mid);
      $.ajax({

        type: "POST",

        url: 'sub_filter.php',

        data: {
          area: area,
          mid: mid
        }, // serializes the form's elements.

        success: function(data)

        {
          // alert(data);
          $('#arearesult').html(data);



        }

      });
    });

    $("#verfied").change(function() {
      var area = $('#sarea').val();
      var mid = $('#mid').val();
      var c_ver = $('#verfied').val();

      $.ajax({

        type: "POST",

        url: 'dir_verfied_com.php',

        data: {
          area: area,
          mid: mid,
          c_ver: c_ver
        },

        success: function(data)

        {
          // alert(data);
          $('#arearesult').html(data);
        }

      });
    });

  });

  function getval() {
    var area = $('#sarea').val();
    // var area=$('#subarea').val();
    var mid = $('#mid').val();
    $.ajax({

      type: "POST",

      url: 'post_area_com.php',

      data: {
        area: area,
        mid: mid
      }, // serializes the form's elements.

      success: function(data)

      {
        // alert(data);
        $('#arearesult').html(data);

      }

    });
  }

  function getval_sub() {
    // var area=$('#sarea').val();
    var area = $('#subarea').val();
    var mid = $('#mid').val();
    $.ajax({

      type: "POST",

      url: 'post_sub_area_com.php',

      data: {
        area: area,
        mid: mid
      }, // serializes the form's elements.

      success: function(data)

      {
        //alert(data);
        $('#arearesult').html(data);



      }

    });
  }





  function sub_area_filter() {
    // var area=$('#sarea').val();
    var area = $('#subarea').val();
    var mid = $('#mid').val();
    $.ajax({

      type: "POST",

      url: 'post_sub_area_com.php',

      data: {
        area: area,
        mid: mid
      }, // serializes the form's elements.

      success: function(data)

      {
        //alert(data);
        $('#arearesult').html(data);



      }

    });
  }





  function sub_area(id) {
    var id;
    var vehicleBodyType = $("#vehicle_body_type").val() || '';
    var mid = $('#mid').val();
    
    $.ajax({
      type: "POST",
      url: 'sub_area.php',
      data: {
        id: id
      },
      success: function(data) {
        console.log(data)
        $('#sa').html(data);
      }
    });
    
    // Also filter results when area changes
    if (id) {
      $.ajax({
        type: "POST",
        url: 'post_area_com.php',
        data: {
          area: id,
          mid: mid,
          vehicle_body_type: vehicleBodyType
        },
        success: function(response) {
          $('#arearesult').html(response);
        }
      });
    }
  }
</script>

<script>
  function loadDistricts(stateId) {
    localStorage.setItem('stateId', stateId);
    $("#sarea").html('<option value="">Select City</option><option value="1">All</option>');

    // var area=$('#subarea').val();
    var mid = $('#mid').val();
    $.ajax({

      type: "POST",

      url: 'post_state_com.php',

      data: {
        stateId: stateId,
        mid: mid,
        vehicle_body_type: $("#vehicle_body_type").val() || ''
      }, // serializes the form's elements.

      success: function(data)

      {
        // alert(data);
        $('#arearesult').html(data);



      }
    });

    if (stateId) {
      $.ajax({
        type: "POST",
        url: "fetch_districts.php",
        data: {
          state_id: stateId
        },
        success: function(response) {
          $("#main_city").html('<option value="">---SELECT---</option>' + response);
        }
      });
    } else {
      $("#main_city").html('<option value="">---SELECT---</option>');
      $("#sarea").html('<option value="">Select City</option><option value="1">All</option>');
    }
  }

  // Load city options when district is selected
  function loadCityOptions(districtId) {
    $("#sarea").html('<option value="">Select City</option><option value="1">All</option>');
    
    var mid = $('#mid').val();
    var sid = "<?php echo $sid; ?>";
    var stateId = $("#state").val();
    var vehicleBodyType = $("#vehicle_body_type").val() || '';
    
    // Show/hide vehicle body type filter based on sid
    if (sid == 1 || sid == 2) {
      $("#vehicle_body_type_filter").show();
    } else {
      $("#vehicle_body_type_filter").hide();
    }
    
    if (districtId) {
      // Load city dropdown
      $.ajax({
        type: "POST",
        url: 'post_se_city_area.php',
        data: {
          city: districtId,
          city_name: $('#main_city option:selected').text()
        },
        success: function(response) {
          $('#sarea').html('<option value="">Select City</option><option value="1">All</option>' + response);
        }
      });
      
      // Load results based on district
      $.ajax({
        type: "POST",
        url: 'post_city_com.php',
        data: {
          city: districtId,
          mid: mid,
          vehicle_body_type: vehicleBodyType
        },
        success: function(data) {
          $('#arearesult').html(data);
        }
      });
    }
  }

  // Filter by vehicle body type
  function filterByBodyType() {
    var vehicleBodyType = $("#vehicle_body_type").val() || '';
    var mid = $('#mid').val();
    var sid = "<?php echo $sid; ?>";
    var area = $("#sarea").val() || '';
    var state = $("#state").val() || '';
    var district = $("#main_city").val() || '';
    
    // Determine which filter file to use based on selected filters
    var url = 'post_area_com.php';
    var data = {
      area: area,
      mid: mid,
      vehicle_body_type: vehicleBodyType
    };
    
    if (state && !district && !area) {
      url = 'post_state_com.php';
      data = {
        stateId: state,
        mid: mid,
        vehicle_body_type: vehicleBodyType
      };
    } else if (district && !area) {
      url = 'post_city_com.php';
      data = {
        city: district,
        mid: mid,
        vehicle_body_type: vehicleBodyType
      };
    }
    
    $.ajax({
      type: "POST",
      url: url,
      data: data,
      success: function(response) {
        $('#arearesult').html(response);
      }
    });
  }

  // Show/hide vehicle body type filter on page load
  $(document).ready(function() {
    var sid = "<?php echo $sid; ?>";
    if (sid == 1 || sid == 2) {
      $("#vehicle_body_type_filter").show();
    } else {
      $("#vehicle_body_type_filter").hide();
    }
  });
</script>