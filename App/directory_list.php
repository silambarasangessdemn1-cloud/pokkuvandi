<?php include('config/setup.php');?>

 <?php include('session.php');

 

	?>

   

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

      

         <div class="osahan-body">

       <?php 
       	$mc=1;

         $main_cate=mysqli_query($config,"SELECT * FROM `dir_key_slider` where key_id='".$_GET['mid']."'");
         if (mysqli_num_rows($main_cate) > 0) {
?>

         <div class="py-3 bg-white osahan-promos shadow-sm">

    

               <div class="promo-slider">

               <?php 

										
											while($macate=mysqli_fetch_object($main_cate))

											{

											?>

                  <div class="osahan-slider-item m-2">
                          <?php if($macate->key_slider_link){ ?>
                     <a target="_self" href="<?php echo $macate->key_slider_link ?>">
                     <?php }?>
                     <img src="img/dir/<?php echo $macate->key_slider_image ?>" class="img-fluid mx-auto rounded" alt="Responsive image">
                     <?php if($macate->key_slider_link){ ?>
                    </a>
                    <?php }?>
                  </div>

                  <?php }?>

                  



               </div>

             
<?php }?>
            </div>

            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

            <!-- <div style='padding:2%;'> 

            <p style='padding-top: 2%;'><span style='    font-size: 17px;

    color: green;

    font-weight: 600;'>Business Listing</span>



               <button style='float: right;
   
    margin-right: 8%;' data-toggle="modal" data-target="#exampleModal"  type="button" class="btn btn-primary btn-sm"><i class="fa fa-fa"></i> Enquiry </button></p>
               
</div> -->

<div class=" osahan-categories">



<div class="row m-0 mt-2">
<div class="col-12">
<span style="
    position: relative;
    top: 2px;
    left: 0%;
    font-size:17px;
    color:red;
    margin: 2%;
"><?php echo $_GET['keyword'] ?></span> <button style='float: right;margin-bottom: 3%;
 ' data-toggle="modal" data-target="#exampleModal"  type="button" class="btn btn-primary btn-sm"><i class="fa fa-cart-arrow-down"></i> Add Your Business </button>

</div>
<div class="col-4" style="background: white;border: 0.5px solid #dee2e6;"> 
<div id="" class="fiter">
      <select id='verfied' class="form-select form-control" aria-label="Default select example">
  <option value="0"  selected>All</option>
  <option value="1"  >Verified</option>
    </select>
</div>  
 </div>
<div class="col-4" style="background: white;border: 0.5px solid #dee2e6;"> 
    <?php 
   
     $city=$_SESSION["city"];
      $nn="SELECT * FROM `dir_area_master` where dir_cityid='$city'";
     $main_cate33=mysqli_query($config,$nn);
   ?>
    <div id="fa" class="fiter">
      <select id='sarea' class="form-select form-control" aria-label="Default select example">
  <option value=""  selected>Select Area</option>
<?php
while($macate33=mysqli_fetch_object($main_cate33))
                      { ?>
  <option value="<?php echo $macate33->dir_area_id?>"><?php  echo $macate33->dir_area_name?></option>
<?php }?>
</select>
</div> 

</div>
<div class="col-4" style="    background: white;
    border: 0.5px solid #dee2e6;">
    <div data-toggle="modal" data-target="#exampleModalcity" class="fiter" style="margin:14%;"> <span id="farea" ><?php echo $_SESSION["city_name"] ?></span> &nbsp;<i class="fa fa-angle-down"></i></div> 
</div>
  </div>
</div>
<div class="m-2"> 




<input type="hidden" name='mid' class="form-control" id="mid" aria-describedby="emailHelp" value="<?php echo $_GET['mid']?>" placeholder="" >

<div class="" id="arearesult">
<?php

											$main_cate3=mysqli_query($config,"SELECT * FROM `dir_package` order BY (dir_packid) ASC ");
                   
											while($macate3=mysqli_fetch_object($main_cate3))

											{
                            $or="SELECT * FROM `dir_vender` INNER JOIN dir_keyword ON dir_keyword.dir_vender_id=dir_vender.dir_vender_id WHERE dir_vender_pack='$macate3->dir_packid' and dir_vender_city='".$_SESSION["city"]."' and dir_vender_key='".$_GET['mid']."' and dirv_status='0' group by(dir_vender.dir_vender_id)  ORDER BY RAND() LIMIT $macate3->order_number ";
                                                $maincate3=mysqli_query($config,$or);
                                                $ldata[]= mysqli_num_rows($maincate3);
                                                while($mac3=mysqli_fetch_object($maincate3))
    
                                                {

                                                  $mail_vid[]=$mac3->dir_vender_id;
											?>
  <div class="card" style="width: 100%; padding: 0%;margin-bottom:2px;">
  <div class="card-body">
   <div class="row">
       <div class="col-4">
<img src="img/dir_logo/<?php echo $mac3->c_logo?>" style="width: 100px;
    height: 100px;
    margin: auto;
    margin-top: 11%;">
<?php 

if($mac3->packid == 1) {
  if($mac3->c_ver == 1){?>
  <span style="font-size: 12px;
    position: absolute;
   
    right: 0%;
    margin-top: 45%;
    left: 55%;
    font-family: fangsong;
    font-weight: 600;"><i> <?php echo  $mac3->c_ver_yr; ?></i></span>
<img src="img/f1.png" style="    width: 94px;
    height: 35px;
    margin-top: 79%;

">
<?php }else{?>
  <img src="img/f5.png" style="width: 94px;

    height: 35px;
    margin-top: 79%;

"> 

<?php }?>
  <?php }elseif($mac3->packid == 2){
    if($mac3->c_ver == 1){?>
     <span style="font-size: 12px;
    position: absolute;
 
    right: 0%;
   
    margin-top: 45%;
    left: 55%;
    font-family: fangsong;
    font-weight: 600;"><i> <?php echo  $mac3->c_ver_yr; ?></i></span>
<img src="img/f2.png" style="width: 94px;
    height: 35px;
    margin-top: 79%;

">
<?php }else{?>
  <img src="img/f5.png" style="width: 94px;
    height: 35px;
    margin-top: 79%;

"> 

<?php }?>
    <?php }
    elseif($mac3->packid == 3){
      if($mac3->c_ver == 1){?>
       <span style="font-size: 12px;
    position: absolute;
   
    right: 0%;
    margin-top: 45%;
    left: 55%;
    font-family: fangsong;
    font-weight: 600;"><i> <?php echo  $mac3->c_ver_yr; ?></i></span>

<img src="img/f3.png" style="width: 94px;
    height: 35px;
    margin-top: 79%;

">   
     <?php }else{?>
  <img src="img/f5.png" style="width: 94px;
    height: 35px;
    margin-top: 79%;

"> 

<?php }?>
    <?php }elseif($mac3->packid == 4){
      if($mac3->c_ver == 1){?>
 <span style="font-size: 12px;
    position: absolute;
  
    right: 0%;
    margin-top: 45%;
    left: 55%;
    font-family: fangsong;
    font-weight: 600;"><i> <?php echo  $mac3->c_ver_yr; ?></i></span>
<img src="img/f4.png" style="width: 94px;
    height: 35px;
    margin-top: 79%;

">   
    <?php }else{?>
  <img src="img/f5.png" style="width: 94px;
    height: 35px;
    margin-top: 79%;

"> 

<?php }?>
    <?php }else{?>
 
        <img src="img/f5.png" style="width: 94px;
    height: 35px;
    margin-top: 79%;

"> 

<?php }?>
       </div>
       <div class="col-8">
        <h4 style="color: red;"><?php echo $mac3->c_name?></h4>
        <?php 
 $maincate3c=mysqli_query($config,"SELECT AVG(rate) as rate,COUNT(rate) as total FROM `dir_review` where r_vid='$mac3->dir_vender_id'
 and r_status='1'");

 $mac3c=mysqli_fetch_object($maincate3c);
 if( ceil($mac3c->rate) == 1){?>
<p><span class="fa fa-star checked"></span>
<span class="fa fa-star "></span>
<span class="fa fa-star "></span>
<span class="fa fa-star"></span>
<span class="fa fa-star"></span><span style="color: red;"> <?php echo $mac3c->total?> Ratings</span></p>
<?php }elseif(ceil($mac3c->rate) == 2){?>
    <p><span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star "></span>
<span class="fa fa-star"></span>
<span class="fa fa-star"></span><span style="color: red;"> <?php echo $mac3c->total?> Ratings</span></p>

    <?php }elseif(ceil($mac3c->rate) == 3){?>
        <p><span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star"></span>
<span class="fa fa-star"></span><span style="color: red;"> <?php echo $mac3c->total?> Ratings</span></p>
        <?php }elseif(ceil($mac3c->rate) == 4){?>
            <p><span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star"></span><span style="color: red;"> <?php echo $mac3c->total?> Ratings</span></p>
            <?php }elseif(ceil($mac3c->rate) == 5){?>
                <p><span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span> <span style="color: red;"> <?php echo $mac3c->total?> Ratings</span></p>
<?php }else{?>
                  <p><span class="fa fa-star "></span>
<span class="fa fa-star "></span>
<span class="fa fa-star "></span>
<span class="fa fa-star "></span>
<span class="fa fa-star "></span> </p>
            <?php    }?>
            <p style="text-transform: capitalize;"><img style="height:17px;" src="ind.jpeg"> <span style="font-weight: 600;">IND</span> | <span style="color: red;font-weight: 600;"><?php echo $mac3->c_city?></span>, &nbsp;<span><?php echo $mac3->c_area?><span> </p>
        <p><img src="img/mobile.png"> <span style="color:blue;font-size:14px;" ><?php echo $mac3->c_phone?></span></p>
               <p><?php echo substr($mac3->future_keys,0,45);?>...</p>
        <a href="directory_details.php?did=<?php echo $mac3->dir_vender_id?>&title=<?php echo $mac3->c_name?>&key=<?php echo $_GET['mid'];?>&area=<?php echo $_SESSION["city"] ?>&areaname=<?php echo $_SESSION["city_name"] ?>" style="width: 100%;color:white;" type="button" class="btn btn-primary  btn-sm">Get Best Deal</a>
       </div>
   </div>
  </div>
  </div>
<?php } }

if((($ldata[0] == 0) && ($ldata[1] == 0)) && (($ldata[2] == 0)&&($ldata[3] == 0)))
{?>
<img src="data1.png" style="width: 100%;">

<style>
  #exampleModal1{
    display: none !important;
  }
  .modal-backdrop {
    display: none !important;
  }
</style>
<?php }
?>

</div>
</div>
   </body>

      <!-- Footer -->

   <?php include('promo_footermenu.php');?>

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
    height: 114px;

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



<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel"><?php echo $_GET['keyword']; ?></h5>

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

<label for="exampleInputEmail1">E-Mail address</label>
<input type="hidden" name='mail_id' class="form-control"   aria-describedby="emailHelp" value="<?php 
 echo implode(',',$mail_vid)  ?>" placeholder="" >

<input type="email" name='email' class="form-control" id="exampleInputEmail1"  aria-describedby="emailHelp" value="<?php echo $session__mail;?>" placeholder="" >
<input type="hidden" name='city_id' class="form-control" id="exampleInputEmail1"  aria-describedby="emailHelp" value="<?php echo $_SESSION["city"];?>" placeholder="" >
<input type="hidden" name='keyid' class="form-control" id="exampleInputEmail1"  aria-describedby="emailHelp" value="<?php echo $_GET['mid'];?>" placeholder="" >
<input type="hidden" name='city_name' class="form-control" id="exampleInputEmail1"  aria-describedby="emailHelp" value="<?php echo $_SESSION["city_name"];?>" placeholder="" >
<input type="hidden" name='keyword' class="form-control" id="exampleInputEmail1"  aria-describedby="emailHelp" value="<?php echo $_GET['keyword'];?>" placeholder="" >

</div>

   



  <div class="form-group">

    <label for="exampleInputPassword1">Phone Number</label>

    <input type="number" name='phone' class="form-control" id="exampleInputPassword1" value="<?php echo $session__phone; ?>"  placeholder="" required>

  </div>

  <div class="form-group">

    <label for="exampleInputPassword1">Message</label>

    <textarea maxlength="120" name='msg' class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>  </div>

 

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

var actionUrl = 'dir_com_enq.php';

// $("#exampleModal").modal('hide');

$.ajax({

    type: "POST",

    url: actionUrl,

    data: form.serialize(), // serializes the form's elements.

    success: function(data)

    {

      //  alert(data); 

      if(data == 1)

      {

         $('#cform')[0].reset();

         // $('#modal').modal('hide');

        //  $('.modal').modal('toggle'); 

         $("#exampleModal1").modal('toggle');

         // setTimeout(function(){ $(".alert").show(); }, 3000); 
         $(".alert").attr("style", "display: block;");


// Show the div in 5s
$(".alert").delay(3000).fadeOut(500);
      }

    }

});



});


$( document ).ready(function() {



    $('#exampleModal1').modal('show'); 
 
});

   </script>

<div class="modal fade" id="exampleModalcity" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Choose your city</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <img src="city1.jpg" style="width: 100%;">
       <div class="form-group mt-5">
    <label for="exampleInputPassword1">City</label>
    <input type="hidden" id="set_city" value="<?php echo $_SESSION["city"] ?>">
    <select id="main_city" class="form-select form-control form-select-lg mb-3" aria-label=".form-select-lg example">
  <option value="0" selected>Select City</option>
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

<script>
  $("#main_city").change(function(){
    $('#exampleModalcity').modal('toggle');
  var city=$("#main_city").val();
  var mid=$('#mid').val();
  var city_name=$("#main_city :selected").text();
  $.ajax({
        type: "POST",
        url: "se_city.php",
        data: {city:city,city_name:city_name}, 
        success: function(data)
        {
         $('#city_name').html( city_name);
         $('#farea').html( city_name);
         
        }
    });
    $.ajax({
        type: "POST",
        url: "se_city_area.php",
        data: {city:city,city_name:city_name}, 
        success: function(data)
        {
          // alert(data);
        $('#fa').html(data);
        //  $('#farea').html( city_name);
         
        }
    });
  
   $.ajax({

type: "POST",

url: 'dir_city_com.php',

data: {mid:mid}, // serializes the form's elements.

success: function(data)

{
//  alert(data);
  $('#arearesult').html(data);



}

});

});
</script>
<script>
$( document ).ready(function() {

var id=$('#set_city').val();
if(id == 0){
  // $('#exampleModalcity').modal('show'); 
}else{

}
});

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

<style>
.checked {
  color: orange;
}
.btn-circle.btn-sm {
            width: 30px;
            height: 30px;
            padding: 6px 0px;
            border-radius: 15px;
            font-size: 8px;
            text-align: center;
        }
        .fiter{
          margin: 9%;
        }
</style>

<script>
$(document).ready(function(){
  $("#sarea").change(function(){
   var area=$('#sarea').val();
   var mid=$('#mid').val();
   $.ajax({

type: "POST",

url: 'dir_area_com.php',

data: {area : area,mid:mid}, // serializes the form's elements.

success: function(data)

{
// alert(data);
  $('#arearesult').html(data);



}

});
  });


  $("#verfied").change(function(){
   var area=$('#sarea').val();
   var mid=$('#mid').val();
   var c_ver=$('#verfied').val();
 
   $.ajax({

type: "POST",

url: 'dir_verfied_com.php',

data: {area:area,mid:mid,c_ver:c_ver}, 

success: function(data)

{
// alert(data);
  $('#arearesult').html(data);
}

});
  });

});

function getval()
{
  var area=$('#sarea').val();
   var mid=$('#mid').val();
   $.ajax({

type: "POST",

url: 'dir_area_com.php',

data: {area : area,mid:mid}, // serializes the form's elements.

success: function(data)

{
// alert(data);
  $('#arearesult').html(data);



}

});
}


</script>



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

      <form id='cformp'>

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
  <option <?php if($_SESSION["city"] == $macate3->dir_city_id ){ echo 'selected';} ?> value="<?php echo $macate3->dir_city_id ?>"><?php echo $macate3->dir_city_name ?></option>
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

   $("#cformp").submit(function(e) {



e.preventDefault(); // avoid to execute the actual submit of the form.



var form = $(this);

var actionUrl = 'bussiness_contact.php';

$.ajax({

    type: "POST",

    url: actionUrl,

    data: form.serialize(), // serializes the form's elements.

    success: function(data)

    {

      // alert(data); 

      if(data == 1)

      {

         $('#cformp')[0].reset();

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