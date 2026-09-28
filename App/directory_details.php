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

        <?php include('dirctry_com_details.php');?>

         <!-- body -->

     
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

            <!-- <div style='padding:2%;'> 

            <p style='padding-top: 2%;'><span style='    font-size: 17px;

    color: green;

    font-weight: 600;'>Business Listing</span>



               <button style='float: right;
   
    margin-right: 8%;' data-toggle="modal" data-target="#exampleModal"  type="button" class="btn btn-primary btn-sm"><i class="fa fa-fa"></i> Enquiry </button></p>
               
</div> -->
<div class=" osahan-categories">

<div class="mb-3 mt-2">
<?php   $or="SELECT * FROM `dir_vender` INNER JOIN dir_keyword ON dir_keyword.dir_vender_id=dir_vender.dir_vender_id WHERE dir_vender.dir_vender_id=".$_GET['did']." and dir_vender_city='".$_GET['area']."'";
                                                $maincate3=mysqli_query($config,$or);

                                         $mac3=mysqli_fetch_object($maincate3);
 $vid1=$_GET['did'];
                                              
											?>

<div class="card">
  <div class="card-body">
 <center> <img src="img/dir_logo/<?php echo $mac3->c_logo?>" style="width: 100px;height: 100%;"></center>
<br>
<h4><?php echo $mac3->c_name?></h4> 
<h5><?php echo $mac3->c_city?>-<?php echo $mac3->c_area?></h5>

<?php 
 $gg="SELECT AVG(rate) as rate,COUNT(rate) as total FROM `dir_review` where r_vid='".$_GET['did']."'
and r_status='1'";
 $maincate3c=mysqli_query($config,$gg);

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
              
<br>
<center>
  <span>Contact Us </span>
  <?php if($mac3->c_whatsapp){ ?>
<a href="whatsapp://send?text=Hi World!&phone=+91<?php echo $mac3->c_whatsapp?>" data-action="share/whatsapp/share" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" class="font-weight-bold text-white text-decoration-none ml-2" target="_blank" title="Share on whatsapp"><i class="icofont-whatsapp p-2 bg-success shadow-sm rounded-circle"></i></a>
<?php }?>
<?php if($mac3->fb){ ?>
<a href="<?php echo $mac3->fb?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" class="font-weight-bold text-white text-decoration-none ml-2" target="_blank" title="Share on Facebook"><i class="icofont-facebook p-2 bg-primary shadow-sm rounded-circle"></i></a>
<?php }?>
<?php if($mac3->twitter){ ?>
<a href="<?php echo $mac3->twitter?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" class="font-weight-bold text-white text-decoration-none ml-2" title="Share on Twitter"><i class="icofont-twitter p-2 bg-primary shadow-sm rounded-circle"></i></a>
<?php }?>
<?php if($mac3->instagram){ ?>
<a href="<?php echo $mac3->instagram?>" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Mail" class="font-weight-bold text-white text-decoration-none ml-2"><i class="icofont-instagram p-2 bg-danger shadow-sm rounded-circle"></i></a></center>
<?php }?>
<br>
<button type="button"  class="btn btn-outline-primary enq" data-toggle="modal" data-target="#exampleModal">Enquiry</button>
<br>
<br>
<hr>
<h5 style="color: #3300ff;">About us </h5>
<p style=" text-align: left !important;"><?php echo $mac3->c_about?></p>
<hr>
<h5 style="color: red;">Futures & Keys  </h5>
<p style=" text-align: left !important;"><?php echo $mac3->future_keys?></p>
<hr>
<h5 style=" color: #ff6000;">Gallery</h5>




<!-- <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>  -->
<link rel="stylesheet" href="1style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<section id="gallery">
  <div class="container">
    <div id="image-gallery">
      <div class="row">
      <?php 

$mc=1;

$main_cate=mysqli_query($config,"SELECT * FROM `dir_vender_gallery` where dir_venderid='".$_GET['did']."' ");

while($macate=mysqli_fetch_object($main_cate))

{

?>
        <div class="col-4 image" id="limg<?php echo $mc;$mc++; ?>">
          <div class="img-wrapper">
            <a href="img/dir_gallery/<?php echo $macate->image ?>">
            <img style="width: 100%;height:100px;" src="img/dir_gallery/<?php echo $macate->image ?>" class="img-responsive"></a>
            <div class="img-overlay">
              <i class="fa fa-plus-circle" aria-hidden="true"></i>
            </div>
          </div>
        </div>
        <?php }?>
      </div>
    </div>
    <button id="vimg" style="float: right;margin-top:2%;" type="button" onclick="viewimage();" class="btn btn-outline-info">View More</button>

    </div>
</section>

<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>
<script  src="1script.js"></script>


<br>

<?php if($mac3->c_video){?>
<h5>Video  </h5>
<p><?php echo $mac3->c_video?></p>
<?php }?>

<hr>
   <h5>Address </h5>

   <p style=" text-align: left !important;">
   <?php echo $mac3->c_address?>
   </p>
<hr>
<h5>Phone Number </h5>
<p style=" text-align: left !important;"><i class="fa fa-phone"></i>&nbsp; &nbsp;<?php echo $mac3->c_phone?></p>
<hr>
<?php if($mac3->site_link){ ?>
<h5>Website  </h5>
<p style=" text-align: left !important;"><i class="fa fa-globe"></i>&nbsp; &nbsp;<a href="<?php echo $mac3->site_link?>"><?php echo $mac3->site_link?></a></p>
<hr>
<?php }?>
<h5>E-Mail </h5>
<p style=" text-align: left !important;"><i class="fa fa-envelope"></i>&nbsp; &nbsp;<?php echo $mac3->c_email?></p>
<hr>
<h5 style="    color: #17a2b8;">Open Now  </h5>
<p style=" text-align: left !important;"> <?php $main_cate1=mysqli_query($config,"select * from dir_vender_days where dir_day_vender_id='".$_GET['did']."'");

while($macate1=mysqli_fetch_object($main_cate1))

{ echo '<i class="fa fa-clock-o"></i>&nbsp; &nbsp;<b>'.$macate1->c_days.'</b> &nbsp'; 
echo ' Open ';
$date =  $macate1->formtime; 
echo date('h:ia ', strtotime($date));
echo '-';
echo ' ';
$date =  $macate1->totime; 
echo date('h:ia ', strtotime($date));
echo '<br>';
}?></p> 


<hr>
<?php if($mac3->c_map){?>
<h5>Location  </h5>
<p ><?php echo $mac3->c_map?></p>
<?php }?>
<button data-toggle="modal" data-target="#exampleModalCenter" style="float: right;" type="button" class="btn btn-outline-success">Reviews & Ratings</button>
<br>
<br>
<?php 
 $re="SELECT * FROM `dir_review` where r_vid='".$_GET['did']."'
and r_status='1'";
$maincate3c=mysqli_query($config,$re);



    while($mac3c=mysqli_fetch_object($maincate3c)){
      if($mac3c->rate != 0){
         $re1="SELECT AVG(rate) as rate,COUNT(rate) as total,r_name,r_msg FROM `dir_review` where r_vid='".$_GET['did']."'
        and r_status='1' and dir_review_id='$mac3c->dir_review_id'";   
        
        $maincate3c1=mysqli_query($config,$re1);



$mac3c1=mysqli_fetch_object($maincate3c1);
        ?>


<div class="card" style="padding: 0px;margin-bottom: 2%;">
  <div class="card-body">
   <div class="row">
       <div class="col-2"><img src="man.png" style="width: 28px;"></div>
       <div class="col-10">
           <h6><?php echo $mac3c->r_name?> <span class="fa fa-star checked"></span> <?php echo $mac3c1->rate?>.0</h6>
           <p><?php echo $mac3c->r_msg?></p>
        </div>
   </div>
  </div>
</div>
<?php }  }?>

</div>
</div>
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
#limg4{
display: none;
}
#limg5{
display: none;
}
#limg5{
display: none;
}
#limg6{
display: none;
}
#limg7{
display: none;
}
#limg8{
display: none;
}
#limg9{
display: none;
}
#limg10{
display: none;
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

function viewimage(){

  $("#limg4").css("display", "block");
  $("#limg5").css("display", "block");
  $("#limg6").css("display", "block");
  $("#limg7").css("display", "block");
  $("#limg8").css("display", "block");
  $("#limg9").css("display", "block");
  $("#limg10").css("display", "block");
  $("#vimg").css("display", "none");
}

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

        <h5 class="modal-title" id="exampleModalLabel"><?php echo $mac3->c_name?></h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <div class="modal-body">

      <form Method='POST' id='cform'>

      <div class="form-group">

    <label for="exampleInputEmail1">Name</label>

    <input type="text" name='name' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $session__username;?>" placeholder="" required>
    <input type="hidden" name='send_email' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value='<?php echo $mac3->c_email?>' >
    <input type="hidden" name='areaid' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value='<?php echo $_GET['area'];?>' >
    <input type="hidden" name='keyid' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value='<?php echo $_GET['key'];?>' >
    <input type="hidden" name='vid' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value='<?php echo $vid1?>' >

  </div>

  <div class="form-group">

<label for="exampleInputEmail1">E-Mail Address</label>

<input type="email" name='email' class="form-control" id="exampleInputEmail1"  aria-describedby="emailHelp" value="<?php echo $session__mail;?>" placeholder="" >

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

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content" style=" height: 561px;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Reviews & Ratings</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    
</span>
<form Method='POST' id='cform1'>

<div class="form-group">
<h5>Ratings</h5>
      <span class="star-rating star-5">
  <input type="radio" class="rating" name="rating" value="1"><i></i>
  <input type="radio" class="rating" name="rating" value="2"><i></i>
  <input type="radio" class="rating" name="rating" value="3"><i></i>
  <input type="radio" class="rating" name="rating" value="4"><i></i>
  <input type="radio" class="rating" name="rating" value="5"><i></i>
      </span>
</div>
<div class="form-group">

<label for="exampleInputEmail1">Name</label>

<input type="text" name='name' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $session__username;?>" placeholder="" required>
<input type="hidden" name='send_email' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value='<?php echo $mac3->c_email?>' >
<input type="hidden" name='areaid' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value='<?php echo $_GET['area'];?>' >
<input type="hidden" name='keyid' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value='<?php echo $_GET['key'];?>' >
<input type="hidden" name='vid' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value='<?php echo $vid1?>' >

</div>

<div class="form-group">

<label for="exampleInputEmail1">E-Mail Address</label>

<input type="email" name='email' class="form-control" id="exampleInputEmail1"  aria-describedby="emailHelp" value="<?php echo $session__mail;?>" placeholder="" >

</div>





<div class="form-group">

<label for="exampleInputPassword1">Phone Number</label>

<input type="number" name='phone' class="form-control" id="exampleInputPassword1" value="<?php echo $session__phone; ?>"  placeholder="" required>

</div>

<div class="form-group">

<label for="exampleInputPassword1">Review</label>

<textarea name='msg' class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>  </div>







      </div>
      <div class="modal-footer">
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

var actionUrl = 'dir_enq_detail.php';

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

$("#cform1").submit(function(e) {



e.preventDefault(); // avoid to execute the actual submit of the form.



var form = $(this);

var actionUrl = 'dir_review.php';

// $("#exampleModal").modal('hide');

$.ajax({

    type: "POST",

    url: actionUrl,

    data: form.serialize(), // serializes the form's elements.

    success: function(data)

    {

//   alert(data); 

      if(data == 1)

      {

         $('#cform1')[0].reset();

         // $('#modal').modal('hide');

        //  $('.modal').modal('toggle'); 

         $("#exampleModalCenter").modal('toggle');

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
    $('#exampleModalcity').modal('show'); 
  }else{
 
  }
});

   </script>


<!-- <script>
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
</script> -->
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
.enq {
    width: 100%;
    border-radius: 40px;
    background: #fff;
    color: #1274c0;
    text-transform: capitalize;
    padding: 5px 0 7px;
    border: 1px#1274c0 solid;
    outline: 0;
    margin: 8px 0 15px;
    font-weight: 600;
        }
        .modal-content {
    border: none;
    border-radius: 0px;
   
}
.star-rating {
  font-size: 0;
  white-space: nowrap;
  display: inline-block;
  /* width: 250px; remove this */
  height: 50px;
  overflow: hidden;
  position: relative;
  background: url('data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iMjBweCIgaGVpZ2h0PSIyMHB4IiB2aWV3Qm94PSIwIDAgMjAgMjAiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDIwIDIwIiB4bWw6c3BhY2U9InByZXNlcnZlIj48cG9seWdvbiBmaWxsPSIjREREREREIiBwb2ludHM9IjEwLDAgMTMuMDksNi41ODMgMjAsNy42MzkgMTUsMTIuNzY0IDE2LjE4LDIwIDEwLDE2LjU4MyAzLjgyLDIwIDUsMTIuNzY0IDAsNy42MzkgNi45MSw2LjU4MyAiLz48L3N2Zz4=');
  background-size: contain;
}
.star-rating i {
  opacity: 0;
  position: absolute;
  left: 0;
  top: 0;
  height: 100%;
  /* width: 20%; remove this */
  z-index: 1;
  background: url('data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iMjBweCIgaGVpZ2h0PSIyMHB4IiB2aWV3Qm94PSIwIDAgMjAgMjAiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDIwIDIwIiB4bWw6c3BhY2U9InByZXNlcnZlIj48cG9seWdvbiBmaWxsPSIjRkZERjg4IiBwb2ludHM9IjEwLDAgMTMuMDksNi41ODMgMjAsNy42MzkgMTUsMTIuNzY0IDE2LjE4LDIwIDEwLDE2LjU4MyAzLjgyLDIwIDUsMTIuNzY0IDAsNy42MzkgNi45MSw2LjU4MyAiLz48L3N2Zz4=');
  background-size: contain;
}
.star-rating input {
  -moz-appearance: none;
  -webkit-appearance: none;
  opacity: 0;
  display: inline-block;
  /* width: 20%; remove this */
  height: 100%;
  margin: 0;
  padding: 0;
  z-index: 2;
  position: relative;
}
.star-rating input:hover + i,
.star-rating input:checked + i {
  opacity: 1;
}
.star-rating i ~ i {
  width: 40%;
}
.star-rating i ~ i ~ i {
  width: 60%;
}
.star-rating i ~ i ~ i ~ i {
  width: 80%;
}
.star-rating i ~ i ~ i ~ i ~ i {
  width: 100%;
}
::after,
::before {
  height: 100%;
  padding: 0;
  margin: 0;
  box-sizing: border-box;
  text-align: center;
  vertical-align: middle;
}

.star-rating.star-5 {width: 250px;}
.star-rating.star-5 input,
.star-rating.star-5 i {width: 20%;}
.star-rating.star-5 i ~ i {width: 40%;}
.star-rating.star-5 i ~ i ~ i {width: 60%;}
.star-rating.star-5 i ~ i ~ i ~ i {width: 80%;}
.star-rating.star-5 i ~ i ~ i ~ i ~i {width: 100%;}

.star-rating.star-3 {width: 150px;}
.star-rating.star-3 input,
.star-rating.star-3 i {width: 33.33%;}
.star-rating.star-3 i ~ i {width: 66.66%;}
.star-rating.star-3 i ~ i ~ i {width: 100%;}

/* .card, p {
    margin-top: 0;
    text-align: left !important;

} */
 .card, h5 {

    text-align: left;
} 
</style>