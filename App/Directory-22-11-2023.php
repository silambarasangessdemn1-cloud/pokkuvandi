<?php include('config/setup.php');?>
  

<!DOCTYPE html>

<html lang="en">

   <head>

      <meta charset="utf-8">

      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <meta name="description" content="">

      <meta name="author" content="">

          <link rel="icon" type="image/png" href="<?php 

            

            $inro_logo=mysqli_query($config,"select Logo_Path,logo_status from lee_master");

            while($logo=mysqli_fetch_array($inro_logo))

            {

                 $logstatus=$logo[1];

if($logstatus == 1)

{

	

	 $ms=substr($logo[0],3);

				  echo  $ms;

	

     

}else{

    echo "../../photos/logo/no_logo.png";



}



            }

            

            ?>">

      <title><?php 

            

            $leename=mysqli_query($config,"select Name,Name_status from lee_master");

            while($lee=mysqli_fetch_array($leename))

            {

                 $namestatus=$lee[1];

if($namestatus == 1)

{

    echo  $lee[0];

}else{

    echo "Need Name";



}



            }

            

            ?></title>

      <!-- Slick Slider -->

      <link rel="stylesheet" type="text/css" href="vendor/slick/slick.min.css"/>

      <link rel="stylesheet" type="text/css" href="vendor/slick/slick-theme.min.css"/>

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
<?php $pro_page=2; ?>
      <div class="osahan">

        <?php include('Directory_topmenu.php');?>

         <!-- body -->

         <!-- <div class="ticker-wrap">
          <div class="ticker">
          <div class="ticker_item">This is your ticker text. It is styled with css and the length of the text controlls the scroll speed. Longer text scrolls faster, the shorter the text, the slower it scrolls. </div>

          </div>
        </div> -->




         <div class="osahan-body">

       

         <div class="py-3 bg-white osahan-promos shadow-sm">

    

               <div class="promo-slider">

               <?php 

											$mc=1;

											$main_cate=mysqli_query($config,"select * from dir_slider");

											while($macate=mysqli_fetch_object($main_cate))

											{

											?>

                  <div class="osahan-slider-item m-2">

                    
                     <a href="<?php echo $macate->dir_link ?>"> <img src="img/dir/<?php echo $macate->dir_image ?>" class="img-fluid mx-auto rounded" alt="Responsive image"></a>

                  </div>

                  <?php }?>

               </div>
            </div>

            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class=" osahan-categories " style="margin: 2%;">

<h6 class="mb-2 ml-3"><?php echo $macate->title ?></h6>

<div class="row m-0">                 
<?php

											$main_cate3=mysqli_query($config,"select * from main_category  where Main_Category_Status = '1' order by (Main_Category_id ) ASC");

											while($macate3=mysqli_fetch_object($main_cate3))

											{

											?>
   <div class="col-4 p-1">

      <div style="height: 112px;" class="bg-white shadow-sm rounded text-center  px-2 py-3 c-it">

         <a href="Directory_subcate.php?mid=<?php echo $macate3->Main_Category_id ?>&keyword=<?php echo $macate3->Main_Category_Name?>">

            <img src="photos/Category/<?php echo $macate3->Main_Category_image?>" class="img-fluid px-2">

            <p class="m-0 pt-2 text-muted text-center"><?php echo $macate3->Main_Category_Name?></p>

         </a>

      </div>

   </div>
<?php }?>


 
<div class="col-4 p-1">

      <div style="height: 112px;" class="bg-white shadow-sm rounded text-center  px-2 py-3 c-it">

         <a href="loader_sub.php">

            <img src="photos/Category/../../../photos/Sub_Category/Commercial Vehicle Lorry.png" class="img-fluid px-2">

            <p class="m-0 pt-2 text-muted text-center">Pokkuvandi Search</p>

         </a>

      </div>

   </div>

   <!-- <div class="col-4 p-1">

      <div style="height: 112px;" class="bg-white shadow-sm rounded text-center  px-2 py-3 c-it">

         <a href="machineary.php">

            <img src="photos/Category/../../../photos/Category/download (7).jpg" class="img-fluid px-2">

            <p class="m-0 pt-2 text-muted text-center">Machinery </p>

         </a>

      </div>

   </div> -->




</div>

   </body>

      <!-- Footer -->

   <?php include('footermenu.php');?>

     <?php include('menu.php');?> <!-- Bootstrap core JavaScript -->

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

jQuery(document).ready(function ($) {

    for (var i = 0; i < 8; i++) {

        callData(count);//Call 8 times on page load

        count++;

    }

});

$(window).on("scroll", function () {

    const scrollHeight = $(document).height();

    const scrollPos = Math.floor($(window).height() + $(window).scrollTop());

    const isBottom = scrollHeight - 100 < scrollPos;

    if (isBottom && currentscrollHeight < scrollHeight) {

        //alert('calling...');

        for (var i = 0; i < 6; i++) {

            callData(count);//Once at bottom of page -> call 6 times

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

        success: function (result) {

            // alert(result['vid']);

            $('<div class="card my-4 py-3"><h4 class="card-title">' + result[0] + '</h4><p>' + counter + '</p></div>').appendTo('.list');

        },

        error: function (result) {

            //alert("error");

            $('<div class="card my-4 py-3"><h4 class="card-title">API call failed</h4><p>' + counter + '</p></div>').appendTo('.list');

        }

    });

}



</script>



<style>

   iframe{

      width:100%;

      height:200px;

      padding: 1%;

   }

   .card{

      padding: 2%;

   }

   .complete{



display:none;



}
.r_less{
   display:none; 
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

.b_title{

   text-align:center;

}

</style>



<script>



function more(id) {

   

// alert(id);

      $("#sb_t"+id).attr("style", "display: none;");



      $("#f_t"+id).attr("style", "display: block;");



      $("#more"+id).attr("style", "display: none;");
      $("#less"+id).attr("style", "display: block;float: right;");


      }


      function less(id) {

   

// alert(id);

      $("#sb_t"+id).attr("style", "display: block;");



      $("#f_t"+id).attr("style", "display: none;");



      $("#more"+id).attr("style", "display: block;float: right;");
      $("#less"+id).attr("style", "display: none;float: right;");


      }

      







</script>

<?php 
  $inro_logo22=mysqli_query($config,"SELECT * FROM `lee_master`");

$logo22=mysqli_fetch_object($inro_logo22);

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

    <input type="text" name='name' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $session__username;?>" placeholder="" required>
    <input type="hidden" name='send_email' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value='<?php echo $logo22->Email_id ?>' >

  </div>

  <div class="form-group">

<label for="exampleInputEmail1">E-Mail Address</label>

<input type="email" name='email' class="form-control" id="exampleInputEmail1"  aria-describedby="emailHelp" value="<?php echo $session__mail;?>" placeholder="" >

</div>
<div class="form-group">

<label for="exampleInputEmail1">City</label>
<select id="enq_city" name="enq_city" class="form-select form-control form-select-lg mb-3" aria-label=".form-select-lg example">

  <?php

											$main_cate3=mysqli_query($config,"SELECT * FROM `dir_city_master` ORDER BY `dir_city_master`.`dir_city_name` ASC");

											while($macate3=mysqli_fetch_object($main_cate3))

											{

											?>
  <option  value="<?php echo $macate3->dir_city_id ?>"><?php echo $macate3->dir_city_name ?></option>
<?php }?>
</select>  
</div>
<div class="form-group">
<label for="exampleInputEmail1">Area</label>
<div id="enq_earea">
<select id="" name="enq_area" class="form-select form-control form-select-lg mb-3" aria-label=".form-select-lg example">

  <?php

											$main_cate3=mysqli_query($config,"SELECT * FROM `dir_area_master` where dir_cityid='".$_SESSION["city"]."' ORDER BY `dir_area_master`.`dir_area_name` ASC ");

											while($macate3=mysqli_fetch_object($main_cate3))

											{

											?>
  <option  value="<?php echo $macate3->dir_area_id ?>"><?php echo $macate3->dir_area_name ?></option>
<?php }?>
</select>  
</div>
</div>
  <div class="form-group">

    <label for="exampleInputPassword1">Phone Number</label>

    <input type="number" name='phone' class="form-control" id="exampleInputPassword1" value="<?php echo $session__phone; ?>"  placeholder="" required>

  </div>

  <div class="form-group">

    <label for="exampleInputPassword1">Message</label>

    <textarea name='msg' class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>  </div>

 

  <button type="submit" class="btn btn-primary">Submit</button>  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>



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

      if(data == 1)

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


$( document ).ready(function() {

  var id=$('#set_city').val();
  if(id == 0){
    // $('#exampleModalcity').modal('show'); 
  }else{
 
  }
});

   </script>

<div class="modal fade modal-dialog-centere" id="exampleModalcity" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="height: 100%;">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Choose your District</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <img src="city1.jpg" style="width: 100%;">
       <div class="form-group mt-5">
    <label for="exampleInputPassword1">District</label>
    <input type="hidden" id="set_city" value="<?php echo $_SESSION["city"] ?>">
    <select id="main_city" class="form-select form-control form-select-lg mb-3" aria-label=".form-select-lg example">
  <option value="0" selected>Select District</option>
  <?php

											$main_cate3=mysqli_query($config,"SELECT * FROM `dir_city_master`");

											while($macate3=mysqli_fetch_object($main_cate3))

											{

											?>
  <option <?php if($_SESSION["city"] == $macate3->dir_city_id ){ echo 'selected';} ?> value="<?php echo $macate3->dir_city_id ?>"><?php echo $macate3->dir_city_name ?></option>
<?php }?>
</select>  </div>
      </div>
     
    </div>
  </div>
</div>

<div id="popup" style="display: none; width: 100%;height: 100% !important;background-color: white; position: absolute; top: 17%; padding: 0px 14px 0px 0px;">
<div class="modal-dialog">
            <div class="modal-content">
                
                <div class="modal-body">
                <!-- <h5 class="mt-2">Terms & Conditions</h5>
                <p>The vehicle directorys terms and conditions govern the use of the platform by its users. By accessing and utilizing the services provided, users agree to abide by these terms. The directory grants eligible users the right to access and view its content while also outlining responsibilities and restrictions. Users must comply with all applicable laws and regulations while using the platform. The directory retains ownership of its content, including copyrights and trademarks. Additionally, users must respect the privacy of others and adhere to the guidelines for user-generated content. When listing vehicles or related services, users are required to provide accurate and reliable information while following the specified guidelines. The directory may contain links to third-party websites, and users acknowledge that these external entities are beyond the directorys control, disclaiming any responsibility for their content. While the directory strives for accuracy and reliability, it does not guarantee the correctness of information provided and is not liable for any damages resulting from its use. Users found violating the terms and conditions may face termination of their access to the platform. The directory reserves the right to modify these terms at its discretion and will notify users of any changes. </p> -->
                <?php
				 
                    $about=mysqli_query($config,"select fron_contanct from cms");
                    
                    while($del=mysqli_fetch_array($about))
                    {
                    
                    echo $del[0];


                    }				?>

                </div>
                <div class="modal-footer">
                <button class="btn btn-secondary btn-lg" onclick="closePopup()">Close</button>
                </div>
            </div>
        </div>

<div>
<!-- <h5 class="mt-2">Terms & Conditions</h5>
       <p>The vehicle directory's terms and conditions govern the use of the platform by its users. By accessing and utilizing the services provided, users agree to abide by these terms. The directory grants eligible users the right to access and view its content while also outlining responsibilities and restrictions. Users must comply with all applicable laws and regulations while using the platform. The directory retains ownership of its content, including copyrights and trademarks. Additionally, users must respect the privacy of others and adhere to the guidelines for user-generated content. When listing vehicles or related services, users are required to provide accurate and reliable information while following the specified guidelines. The directory may contain links to third-party websites, and users acknowledge that these external entities are beyond the directory's control, disclaiming any responsibility for their content. While the directory strives for accuracy and reliability, it does not guarantee the correctness of information provided and is not liable for any damages resulting from its use. Users found violating the terms and conditions may face termination of their access to the platform. The directory reserves the right to modify these terms at its discretion and will notify users of any changes. </p>
       <button class="btn btn-primary" onclick="closePopup()">Close</button>
    </div> -->
  </div>

<style>
  @-webkit-keyframes ticker {
  0% {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
    visibility: visible;
  }
  100% {
    -webkit-transform: translate3d(-100%, 0, 0);
    transform: translate3d(-100%, 0, 0);
  }
}
@keyframes ticker {
  0% {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
    visibility: visible;
  }
  100% {
    -webkit-transform: translate3d(-100%, 0, 0);
    transform: translate3d(-100%, 0, 0);
  }
}
.ticker-wrap {
  /* position: fixed; */
  top: 0;
  width: 100%;
  overflow: hidden;
  height: 4rem;
  background-color: rgba(0, 0, 0, 0.9);
  padding-left: 100%;
}

.ticker {
  display: inline-block;
  height: 4rem;
  line-height: 4rem;
  white-space: nowrap;
  padding-right: 100%;
  -webkit-animation-iteration-count: infinite;
  animation-iteration-count: infinite;
  -webkit-animation-timing-function: linear;
  animation-timing-function: linear;
  -webkit-animation-name: ticker;
  animation-name: ticker;
  -webkit-animation-duration: 30s;
  animation-duration: 30s;
}
.ticker_item {
  display: inline-block;
  padding: 0 2rem;
  font-size: 2rem;
  color: red;
}



  </style>


<script>
  $("#main_city").change(function(){
    $('#exampleModalcity').modal('toggle');
  var city=$("#main_city").val();
  var city_name=$("#main_city :selected").text();
  $.ajax({
        type: "POST",
        url: "se_city.php",
        data: {city:city,city_name:city_name}, 
        success: function(data)
        {
         $('#city_name').html( city_name);
        }
    });

});
$("#enq_city").change(function(){
   
  var city=$("#enq_city").val();

  $.ajax({
        type: "POST",
        url: "dir_enq_city.php",
        data: {city:city}, 
        success: function(data)
        {
         $('#enq_earea').html(data);
        }
    });

});
</script>


<script>
 function showPopup() {
  //alert();
            document.getElementById('popup').style.display = 'block';
           // alert();
        }

        function closePopup() {
            document.getElementById('popup').style.display = 'none';
        }

        // Check if the cookie is set
        var popupCookie = document.cookie.replace(/(?:(?:^|.*;\s*)popup_shown\s*\=\s*([^;]*).*$)|^.*$/, "$1");
        if (!popupCookie) {
            // If cookie is not set, show the popup and set the cookie to indicate it's shown
            showPopup();
            document.cookie = "popup_shown=true; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/";
        }
   </script>

   






<!-- 
<script>

$(document).ready(function(){

  $("#catesearch1").keyup(function(){

    var text=$('#catesearch1').val();

   //  alert(text);

   $.ajax({

    type: "POST",

    url: 'youtubevideo.php',

    data: {text : text}, // serializes the form's elements.

    success: function(data)

    {

      $('#result').html(data);

      // alert(data)

      $('.sresults').html('')

    }

});



  });



});

</script>
 -->


<!-- <script>

   function list(text)

   {

   //   alert(text) 

     $('.sresults').html('')

     $('#catesearch1').val(text);

   }

</script> -->


<!-- 
<script>

$(document).ready(function(){

  $("#catesearch1").keyup(function(){

    var text=$('#catesearch1').val();

     alert(text);

   $.ajax({

    type: "POST",

    url: 'video_category.php',

    data: {text : text}, // serializes the form's elements.

    success: function(data)

    {

      $('#search').html(data);

      // alert(data)

    }

});



  });



});

</script> -->