<?php include('config/setup.php');
 include('session.php');
 $mid=$_REQUEST['mid'];
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
         
                <h5 class="text-center mt-3 mb-3">
                Renewal 
              </h5>
      
                 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      

          </div>

          <div class="m-2"> 



<input type="hidden" name='mid' class="form-control" id="mid" aria-describedby="emailHelp" value="<?php echo $_GET['mid']?>" placeholder="" >

<div class="" id="1arearesult">
    <?php
  $session_id;
$or__="SELECT * FROM `create_post` where status ='1' and customer_id='$session_id'  Order by post_id DESC ";
   $maincate__=mysqli_query($config,$or__);
while($mac__=mysqli_fetch_object($maincate__))
{

 $post_addon_ = $mac__->post_addon;
  $post_addon = date("d-m-Y", strtotime($post_addon_)); 

     $exp_date = $mac__->expiry_date;
     $exp_date___ = date("d-m-Y", strtotime($exp_date)); 

    $post_id  = $mac__->post_id ;
   $current_Date=date('Y-m-d');

    $package_days = 10;    
     $exp_min = date("Y-m-d", strtotime($exp_date . " -$package_days days"));  



if($current_Date >= $exp_min){

      //$or="SELECT * FROM `create_post` where post_id ='$post_id' and `expiry_date` >= '$exp_min' and `expiry_date` <= '$exp_date'";    
      $or="SELECT * FROM `create_post` where post_id ='$post_id' and `expiry_date` >= '$exp_min'  and delete_id='0' and status= '1'  ";    
   $maincate3=mysqli_query($config,$or); 

    if (mysqli_num_rows($maincate3) > 0) {
    $ldata= mysqli_num_rows($maincate3);
  $mac3=mysqli_fetch_object($maincate3);


  $net_amount=$mac3->net_amount;


       $city_id= $mac3->city_id;      
      $or_="SELECT * FROM `dir_city_master` where dir_city_id ='$city_id' Order by dir_city_id  DESC ";
      $maincate3_=mysqli_query($config,$or_);        
      $mac3_=mysqli_fetch_object($maincate3_);  
    // echo $mac3_->dir_city_name;
      
      $area_id= $mac3->area_id;      
      $orarea_="SELECT * FROM `dir_area_master` where dir_area_id ='$area_id' Order by dir_area_id   DESC ";
      $orarea3_=mysqli_query($config,$orarea_);       
      $area3__=mysqli_fetch_object($orarea3_);  

      $state_id= $mac3->state_id;      
      $state_idor_="SELECT * FROM `dir_state_master` where state_id ='$state_id' Order by state_id  DESC ";
      $state_idor_2=mysqli_query($config,$state_idor_);       
      $state_idor_23=mysqli_fetch_object($state_idor_2);


      


    ?>   

        
        <div class="card" style="width: 100%; padding: 0%;margin-bottom:2px;">
           <div class="card-body" style="padding:1px">            
                <div class="row mb-2">
                  <div class="col-5 d-flex justify-content-center align-items-center">
                    <img src="../photos/vehicle/<?php echo $mac3->vehicle_photo?>" style="height: 131px !important; width: 100%;margin: auto;">
                  </div>
                  <div class="col-7">
                    <!-- <h6 class="mt-2" style="color: #000;"><?php echo $mac3->vehicle_name?></h6>
                      <p style="text-transform: capitalize;"> <span style="color: #000;font-weight: 400;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;"><?php echo $mac3->driver_name?></span></p> -->
                          <!-- Get Detail -->
                          <!-- <p style="text-transform: capitalize;"> <span style="color: #000;font-weight: 400;"><?php echo $mac3->phone_no?>,<?php echo $mac3_->dir_city_name;	?></span></p> -->
                          <?php if($mac3->category_id == '4' OR $mac3->category_id == '5' ) { ?>
                          <h6 style="color:blue;font-weight: 700;" class="heading_webkit"><?php echo $mac3->shop_name?> </h6>
                        <p style="font-weight: 600;"><?php echo $mac3->shop_address ;?></p>
                        <?php } else { ?>
                          <h6 style="color:blue;font-weight: 700;" class="heading_webkit"><?php echo $mac3->vehicle_name?> </h6>
                        <p style="font-weight: 600;"><?php echo $mac3->vehicle_no ;?></p>
                           <?php } ?>
                         <?php if($net_amount!='') { ?>
                        <p style="color:green;font-weight: 600;">Package Amount : <?php echo $mac3->net_amount?></p>
                        <?php } else {
                          ?>
                          <p style="color:green;font-weight: 600;">Package Amount : <?php echo $mac3->package_amount?></p>
                          <?php } ?>
                         <p style="font-weight: 600;">Payment Date : <?php echo $post_addon ;?></p>
                          <p style="font-weight: 600;" >Package Expiry : <?php echo $exp_date___ ;?></p>
                             <p><?php echo $state_idor_23->name;?>,<?php echo $mac3_->dir_city_name;?>,<?php echo $area3__->dir_area_name;	?></p>
                            
                    </div>                  
                    <div class="col-12 "> 
                    <a href="post_renewal.php?pid=<?php echo $mac3->post_id?>" name="renewal" class="btn btn-primary btn-lg btn-block">Renewal</a>
                     </div>
                </div>
           
            </div>
         </div>
    
    <?php    } 
   }
}
if((($ldata == 0) ))
{ ?>
<img src="data1.png" style="width: 100%;"> 
<?php }
?>

</div>
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
        url: "post_se_city_area.php",
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

url: 'post_city_com.php',

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
// $("#topfilter").change(function(){
//    var filter=$("#topfilter").val();
//    alert(filter);
//    $.ajax({
//          type: "POST",
//          url: "sub_filter.php",
//          data: {city:city}, 
//          success: function(data)
//          {
//           $('#enq_earea').html(data);
//          }
//      });
 
//  });


$('#city').on('change', function() {
                
                var id =this.value;
                var kmid =$('#kmid').val();
            
            $.ajax({
                type: "POST",
                url: "area_post.php",
                data:{id:id,kmid:kmid}, 
                success: function(data)
                {
                  
                $('#area').html(data);

                console.log(data);
                }
            });
            });


            function maincateg(id){
                    var id;
                   
             
                    $.ajax({
                        type: "POST",
                        url:'main_sub_cate.php',
                        data: {id:id}, // serializes the form's elements.
                        success: function(data)
                        {	
                            // alert(data);		
                        $('#sc').html(data);
                        
                        }			
                    });	
                    


                    $.ajax({
                        type: "POST",
                        url:'main_cate_package.php',
                        data: {id:id}, // serializes the form's elements.
                        success: function(data)
                        {	
                            // alert(data);		
                        $('#pk').html(data);
                        
                        }			
                    });	


                        if(id == '1')
                        {                   
                            $('#vr').show();
                            $('#vrother').hide();
                        }
                        else if(id == '2')
                        {
                            $('#vr').show();
                            $('#vrother').hide();
                        }
                        else
                        {
                            $('#vr').hide();
                            $('#vrother').show();
                            
                        }
                       


                } 
                
                function cum(customerid)
                 {
              
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


                function serach_result(customerid, name, phone_no)
                 {
                    $('#detaisl').val(name);
                    $('#customerid').val(customerid);
                    $('#serach_result1').html('');
                    $('#phone_no').val(phone_no);
                    // $('#address').val(address);  
                }



                function subcateg(id){
                    var id;                   
                     // alert(id);
                    $.ajax({
                        type: "POST",
                        url:'sub_cate_add_filter.php',
                        data: {id:id}, // serializes the form's elements.
                        success: function(data)
                        {	
                        // alert(data);		
                        $('#filter').html(data);
                        
                        }			
                    });	
                      } 


                      function package(id){
                    var id;                   
                     // alert(id);
                    $.ajax({
                        type: "POST",
                        url:'package_amount.php',
                        data: {id:id}, // serializes the form's elements.
                        success: function(data)
                        {	
                        // alert(data);		
                        $('#pkamount').html(data);
                        
                        }			
                    });	
                      } 
  

$(document).ready(function(){
  $("#sarea").change(function(){
   var area=$('#sarea').val();
   var mid=$('#mid').val();
   $.ajax({

type: "POST",

url: 'post_area_com.php',

data: {area : area,mid:mid}, // serializes the form's elements.

success: function(data)

{
// alert(data);
  $('#arearesult').html(data);



}

});
  });



  $("#topfilter").change(function(){
   var area=$('#topfilter').val();
  //alert(area);
   var mid=$('#mid').val();
   //alert(mid);
   $.ajax({

type: "POST",

url: 'sub_filter.php',

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

url: 'post_area_com.php',

data: {area : area,mid:mid}, // serializes the form's elements.

success: function(data)

{
// alert(data);
  $('#arearesult').html(data);



}

});
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