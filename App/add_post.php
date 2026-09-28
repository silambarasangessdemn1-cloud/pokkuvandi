<?php include('config/setup.php');?>


 <?php include('session.php');

if($session_id )
{

}else{
  header("location:signin.php");

  echo '<script> window.location.href = "signin.php"; </script>';
}
 


	?>


<?php


 $ms="SELECT * FROM `membership_list` where user_id='$session_id'";


 $msql=mysqli_query($config,$ms);


 $msqld=mysqli_fetch_object($msql);


if($msqld->user_id)


{


  


   // header("location:membershipdetails.php");


   // die;


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


   <body>


      <div class="theme-switch-wrapper">


         <label class="theme-switch" for="checkbox">


            <input type="checkbox" id="checkbox" />


            <div class="slider round"></div>


            <i class="icofont-moon"></i>


         </label>
         <?php $pro_page=3; ?>

         <em>Enable Dark Mode!</em>


      </div>


      <div class="osahan-help">


         <div class="p-3 border-bottom bg-white">


            <div class="d-flex align-items-center">


               <a class="font-weight-bold text-success text-decoration-none" href="Bidding.php">


               <i class="icofont-rounded-left back-page"></i></a>


               <h6 class="font-weight-bold m-0 ml-3">Services  Enquiry</h6>


               <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>


            </div>


         </div>


      </div>


      

         <div class="osahan-body">
           <h4 class="text-center"><?php echo $_GET['keyword'] ?></h4>
<div class="container mt-4" style="margin-bottom: 26%;">
<div id="ss">

</div>
         <form id='idForm'  >
         <div class="form-group">



<label for="exampleInputName1">Full Name</label>



<input readonly type="text" class="form-control" id="exampleInputName1" name="customername" value="<?php echo $session__username;?>">



</div>



<div class="form-group">



<label for="exampleInputNumber1">Mobile Number</label>



<input readonly type="number" class="form-control" id="exampleInputNumber1" name="customerphone" value="<?php echo $session__phone; ?>">



</div>



<div class="form-group">



<label for="exampleInputEmail1">E -Mail</label>



<input readonly type="email" class="form-control" id="exampleInputEmail1" name="customermail" value="<?php echo $session__mail;?>">

<input  type="hidden" class="form-control" id="kmid" name="mid" value="<?php echo $_GET['mid'];?>">
<input  type="hidden" class="form-control" id="" name="sessionid" value="<?php echo $session_id ?>" >


</div>
<div class="form-group">



<label for="exampleInputEmail1">Select Keyword</label>
<?php
 $mid=$_GET['mid'];
   $sql="SELECT * FROM `subkeyword` where key_id='$mid' ";
$main_cate3=mysqli_query($config,$sql);
?>
<select name="subkey" class="form-select form-control" aria-label="Default select example">
 <?php
while($macate3=mysqli_fetch_object($main_cate3))

{

?>
  <option value="<?php echo $macate3->subid ?>"><?php echo $macate3->subkeyword ?></option>
<?php }?>
</select>
</div>
<div class="form-group">
<label for="exampleInputEmail1">City</label>
<?php

   $sql4="SELECT * FROM `biding_city_master`  ";
$main_cate4=mysqli_query($config,$sql4);
?>
<select id='city' name="city" class="form-select form-control" aria-label="Default select example">
<option selected> Select </option>
 <?php
while($macate4=mysqli_fetch_object($main_cate4))

{

?>
  <option value="<?php echo $macate4->city_id ?>"><?php echo $macate4->city_name?></option>
<?php }?>
</select>
</div>
<div class="form-group">
<label for="exampleInputEmail1">Area</label>
<div id="area">

</div>
</div>
<?php 
 $sql="SELECT * FROM `biding_post` where post_id='".$_GET['mid']."' ";
 $main_cate3d=mysqli_query($config,$sql);
 $main_cate3d1=mysqli_fetch_object($main_cate3d);

 if($main_cate3d1->price_status == 1)
 {
   
 }
 else{
 ?>
<div class="form-group">



<label for="exampleInputEmail1">Your Budget</label>
<input name="price" type="number" class="form-control">
</div>
<?php }?>
<div class="form-group">



<label for="exampleInputEmail1">Short Description</label>
<textarea style="    background: white;" name="desc" id="sdesc" class="form-control" rows="4" maxlength="120" name="desc"></textarea>
</div>
  <div class="form-check">
  <button type="submit" class="btn btn-outline-success" style="width: 100%;">Submit</button>

  </div>
</form>
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
<script>
  // $(function(){
  //     $('#sdesc').keyup(function(){
      
  //         var val =$("#sdesc").val();
  //   if(isNaN(val)){
  //        val = val.replace(/[^0-9\.]/g,'');
  //        if(val.split('.').length>2) val =val.replace(/\.+$/,"");
  //   }
  //   $('#sdesc').val(val); 

  //      });
  //   })
</script>
<script>
  $('#city').on('change', function() {
    var id =this.value;
    var kmid =$('#kmid').val();
 
  $.ajax({
    type: "POST",
    url: "area_ajax.php",
    data:{id:id,kmid:kmid}, 
    success: function(data)
    {
     $('#area').html(data);

     console.log(data);
    }
});
});
</script>

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

<script>
  $("#idForm").submit(function(e) {
// alert();
e.preventDefault(); // avoid to execute the actual submit of the form.

var form = $(this);
var actionUrl = "biding_en.php";
var msg='';
msg +='<div class="alert alert-success" role="alert">Thank you for the message.<a href="#" class="alert-link"> We will contact you shortly.</a></div>'
$.ajax({
    type: "POST",
    url: actionUrl,
    data: form.serialize(), // serializes the form's elements.
    success: function(data)
    {
      // alert(data)
     if(data == 1)
     {
      $("#idForm")[0].reset();
      $("#ss").html(msg);
      window.location.href = "Bidding.php";
     }
    }
});

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

      <form >

      <div class="form-group">

    <label for="exampleInputEmail1">Name</label>

    <input type="text" name='name' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" required>
    <input type="hidden" name='send_email' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value='<?php echo $logo22->Email_id ?>' >

  </div>

  <div class="form-group">

<label for="exampleInputEmail1">Email address</label>

<input type="email" name='email' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" >

</div>

   



  <div class="form-group">

    <label for="exampleInputPassword1">Phone Number</label>

    <input type="number" name='phone' class="form-control" id="exampleInputPassword1" placeholder="" required>

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

         $('.modal').modal('toggle'); 

         $("#exampleModal").modal('toggle');

         // setTimeout(function(){ $(".alert").show(); }, 3000); 
         $(".alert").attr("style", "display: block;");


// Show the div in 5s
$(".alert").delay(3000).fadeOut(500);
      }

    }

});



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

<script>

$('#sdesc').keyup(function () { 
    this.value = this.value.replace(/[0-9\.]/g,'');
});
</script>