<?php include('config/setup.php');
 include('session.php');
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

     

            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <h5 class="text-center" >Create Registration</h5>


            <div class="card">
                            <form action="Add_create_post.php" method="post" enctype="multipart/form-data">
								<div class="card-body">
                                     <div class="row">
                                                <div class="form-group col-md-6">    
                                                    <label for="email2">Customer Name</label>
                                                    <input type="text" value="<?php echo  $session__username ?>" class="form-control" id="Add_driver_name" onkeyup="cum(this.value)" name="Add_driver_name" readonly >
                                                    <div id="serach_result">
                                                        <ul class="subnav sug-list-color" id="serach_result1">
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">    
                                                    <label for="email2">Customer Phone No</label>
                                                    <input type="hidden" class="form-control" name="customerid" id="customerid"
                                                    placeholder="">
                                                    <input type="number" value="<?php echo  $session__phone ?>" class="form-control" id="phone_no" name="Add_phone_no" onkeypress="if(this.value.length==10) return false;" readonly>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleFormControlSelect1">Main Category</label> 
                                                    <select required class="form-control" name="Add_main_cate" onchange="maincateg(this.value);">
                                                        <option value="">---SELECT---</option>
                                                    <?php
                                                    $main_cate=mysqli_query($config,"select * from main_category where Main_Category_Status ='1' ");
                                                    while($addsubcate=mysqli_fetch_object($main_cate))
                                                    {  
                                                    ?>
                                                        <option value="<?php echo $addsubcate->Main_Category_id;?>"><?php echo $addsubcate->Main_Category_Name;?></option>
                                                    <?php } ?>                                                        
                                                    </select>
                                                     
                                                </div> 
                                                    
                                                <div class="form-group col-md-6">    
                                                 <label for="email2">Sub Category Name</label>
                                                    <div id="sc">
                                                    
                                                    </div>
                                                    <div id="filter" >

                                                    </div>                                         
                                                </div>

                                               
                                               

                                                
                                                </div>
                                                                                         
                                                  
                                                   <div class="row">
                                                
                                                
                                               
                                              
                                            
                                            </div>                                          
                                            <div id="commercial" >
                                                
                                            </div>
                                            <div id="passenger" > 

                                            </div>
                                            <div id="spot_punjar" > 

                                            </div>

                                            <div class="row">
                                                
                                                <div class="form-group col-md-6">
                                                    <label for="email2">Photo(Size 250 X 250 px & 2 MB)</label>
                                                    <input required type="file" class="form-control" id="email2" name="Add_vehicle_photo">
                                                </div>
                                              
                                                <div class="form-group col-md-6">
                                                    <label for="email2">Whatsapp No</label>
                                                    <input  type="text" class="form-control" id="email2" name="Add_whatsapp_no" placeholder="Whatsapp No" onkeypress="if(this.value.length==10) return false;" required >
                                                </div>
                                                
                                                <div class="form-group col-md-6">
                                                    <label for="exampleFormControlSelect1">District</label>
                                                        <select required class="form-control" id='city' name="Add_city">
                                                            <option value="">---SELECT---</option>
                                                            <?php
                                                            $main_cate=mysqli_query($config,"select * from dir_city_master");
                                                            while($addsubcate=mysqli_fetch_object($main_cate))
                                                            {  
                                                            ?>
                                                            <option value="<?php echo $addsubcate->dir_city_id ;?>"><?php echo $addsubcate->dir_city_name;?></option>
                                                            <?php } ?>                                                        
                                                        </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">City</label>
                                                        <div id="area">

                                                        </div>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Area</label>
                                                        <div id="subarea">

                                                        </div>
                                                </div>

                                                <div class="form-group col-md-6" style="display:none">
                                                    <label for="email2">Address</label>
                                                    <textarea type="text" class="form-control" id="email2" name="Add_address" placeholder="Address...."  ></textarea>
                                                </div>
                                               
                                                <div class="form-group col-md-6" style="display:none">
                                                    <label for="email2">Keyword</label>
                                                    <textarea type="text" class="form-control" id="email2" name="Add_meta_keyword" placeholder="Address...."  ></textarea>
                                                </div>


                                                <div class="form-group col-md-6" style="display:none">    
                                                            <label for="email2">General Remarks</label>
                                                            <textarea type="text" class="form-control" id="email2" name="Add_remarks"  ></textarea>
                                                    </div>	
                                                    <div class="form-group col-md-6">    
                                                            <label for="email2">Referred By Mobile No</label>
                                                            <input type="number" class="form-control" id="email2" onkeypress="if(this.value.length==10) return false;" name="reffered_by_phone_no"  >
                                                    </div>	
                                                    <div class="form-group col-md-6">    
                                                            <label for="email2">Referred By Name</label>
                                                            <input type="text" class="form-control" id="email2" name="reffered_by_name"  >
                                                    </div>

                                                    <div class="form-group col-md-6" style="display:none">
                                                    <label for="exampleFormControlSelect1">Active Status</label>
                                                    <select class="form-control" id="exampleFormControlSelect1" name="Add_status">
                                                        <option value="1">Active</option>
                                                        <option value="0">In-Active</option>                                                    
                                                    </select>
                                                </div>

                                                    <div class="form-group col-md-6">    
                                                 <label for="email2">Package</label>
                                                    <div id="pk">
                                                    
                                                    </div>                                                  
                                                </div>

                                                <div class="form-group col-md-6">                                                      
                                                        <div class="row" id="pkamount">
                                                        
                                                        </div>                                                                                                                                                     
                                                </div>

                                                
                                                    </div>

                                                    <div class="mb-3" style="background:#ffe8ec;padding:9px"> 
                                                      <div class="row">                                        
                                                        <div class="form-group col-md-6">
                                                            <label for="email2">Coupon Code</label>
                                                            <input style="text-transform:uppercase" type="text" class="form-control" id="coupon_code" name="coupon_code"  placeholder=""  >
                                                        </div> 
                                                        <div class="form-group col-md-6">                                      
                                                            <a onclick="couponcode();"  class="text-white btn btn-primary btn-lg btn-block">Coupon Check</a>
                                                        </div> 
                                                                                                                
                                                            <div class="form-group col-md-6" id="netamount">
                                                            <!-- <input type="text" class="form-control" id="email2" name="net_amount"  placeholder=""  readonly> -->
                                                            </div>
                                                           
                                                        </div> 
                                                        <div class="form-group col-md-4">
                                                           <div id="coupon_pack">

                                                            </div>                                                            
                                                        </div> 
                                                      </div> 

                                                   

                                                   
                                                      <div id="post_btn">
                                                        <div class="form-group">                                                         
                                                            <button class="btn btn-success" type="submit" name="post_add">Submit</button>
                                                        </div>
                                                     
                                                        </div> 
									</div>
                  
                  
                                              
                            </form>
                            
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



            

            function sub_area(id){
                //alert();
                var id =id;
                var kmid =$('#kmid').val();
            
            $.ajax({
                type: "POST",
                url: "sub_area_post.php",
                data:{id:id,kmid:kmid}, 
                success: function(data)
                {
                  //alert(data);
                $('#subarea').html(data);

                console.log(data);
                }
            });
            }
           


            function maincateg(id){
                     var id;
                   //alert(id);
             
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


                        // if(id == '1')
                        // {                   
                        //     $('#vr').show();
                        //     $('#vrother').hide();
                        // }
                        // else if(id == '2')
                        // {
                        //     $('#night_duty').show();                       
                        // }
                        // else
                        // {
                        //     $('#vr').hide();
                        //     $('#vrother').show();
                            
                        // }
                        if(id == '1')
                        {  
                            $.ajax({
                                type: "POST",
                                url:'commercial_detail.php',
                                data: {id:id}, // serializes the form's elements.
                                success: function(data)
                                {	
                                  //  alert(data);		
                                $('#commercial').html(data);
                               
                                }			
                            });	
                          }

                         else if(id == '2')
                        {  
                            $.ajax({
                                type: "POST",
                                url:'passenger.php',
                                data: {id:id}, // serializes the form's elements.
                                success: function(data)
                                {	
                                  //  alert(data);		
                                $('#commercial').html(data);
                               
                                }			
                            });	
                          }
                          else if(id == '3')
                        {  
                            $.ajax({
                                type: "POST",
                                url:'ambulance.php',
                                data: {id:id}, // serializes the form's elements.
                                success: function(data)
                                {	
                                  //  alert(data);		
                                $('#commercial').html(data);
                               
                                }			
                            });	
                          }

                       else if(id == '4')
                        {  
                            $.ajax({
                                type: "POST",
                                url:'spot_punjar_detail.php',
                                data: {id:id}, // serializes the form's elements.
                                success: function(data)
                                {	
                                   //alert(data);		
                                $('#commercial').html(data);
                                
                                }			
                            });	
                          }
                          else if(id == '5')
                        {  
                            $.ajax({
                                type: "POST",
                                url:'vehicle_mechanic_detail .php',
                                data: {id:id}, // serializes the form's elements.
                                success: function(data)
                                {	
                                  // alert(data);		
                                $('#commercial').html(data);
                                
                                }			
                            });	
                          }
                          else if(id == '6')
                        {  
                            $.ajax({
                                type: "POST",
                                url:'machinery_detail.php',
                                data: {id:id}, // serializes the form's elements.
                                success: function(data)
                                {	
                                  // alert(data);		
                                $('#commercial').html(data);
                                
                                }			
                            });	
                          }
                          else
                          {
                            $('#commercial').hide();
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
                      //alert(id);
                      
                    //  if(id >= 1 && id <= 10)
                    //  {
                    //   $.ajax({
                    //     type: "POST",
                    //     url:'machinery_field.php',
                    //     data: {id:id}, // serializes the form's elements.
                    //     success: function(data)
                    //     {	
                    //      //alert(data);		
                    //     $('#commercial').html(data);
                        
                    //     }			
                    //    });	
                    //  }
                        
                     
                    


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

                    $.ajax({
                        type: "POST",
                        url:'vehicle_type.php',
                        data: {id:id}, // serializes the form's elements.
                        success: function(data)
                        {	
                            // alert(data);		
                        $('#vt').html(data);
                        
                        }			
                    });	


                      } 

                     

                      function couponcode(){
                        var coupon_code = $('#coupon_code').val();  
                        var pack_id = $('#pack_id').val();
                        var Add_amount = $('#Add_amount').val();
                        var Add_driver_name = $('#Add_driver_name').val();
                        
                      // alert(coupon_code);
                      //   alert(pack_id);
                      //   alert(Add_amount);
                      //   alert(Add_driver_name);
                  
                        $.ajax({
                            type: "POST",
                            url:'coupon_check.php',
                            data: {pack_id:pack_id,coupon_code:coupon_code,Add_amount:Add_amount,Add_driver_name:Add_driver_name}, // serializes the form's elements.
                            success: function(data)
                            {	
                              console.log(data);
                            // alert(data);		
                            $('#netamount').html(data);
                            
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

                    $.ajax({
                        type: "POST",
                        url:'post_button.php',
                        data: {id:id}, // serializes the form's elements.
                        success: function(data)
                        {	
                        // alert(data);		
                        $('#post_btn').html(data);
                        
                        }			
                    });	

                    $.ajax({
                        type: "POST",
                        url:'coupon_pack.php',
                        data: {id:id}, // serializes the form's elements.
                        success: function(data)
                        {	
                        // alert(data);		
                        $('#coupon_pack').html(data);
                        
                        }			
                    });	


                      } 

                 function vehicle_uni(vechilename)
                 {
                   var vechilename;   
                   
                  $.ajax({
                        type: "POST",
                        url:'vehicle_name.php',
                        data: {vechilename:vechilename}, // serializes the form's elements.
                        success: function(data)
                        {	
                       //alert(data);		
                        if(data == 1)
                        {
                          $('#Add_vehicle_no').val('');
                          $('#vehicle_like').html("Vehicle Number Already Registered");
                         
                          
                        }
                        else
                        {
                          $('#vehicle_like').html("");
                        }
                        
                        
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