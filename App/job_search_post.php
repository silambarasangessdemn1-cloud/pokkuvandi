<?php include('config/setup.php');
 include('session.php');

 session_start();
 if(!$session__username){
header('Location: logout.php');
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
            <h5 class="text-center" >Acting Driver Registration</h5>


            <div class="card">
                            <form action="Add_job_post.php" method="post" enctype="multipart/form-data">
								<div class="card-body">
                                     <div class="row">

                                     <div class="form-group col-md-6">    
                                                    <label for="email2">Customer Name</label>
                                                    <input type="text" value="<?php echo  $session__username ?>" class="form-control" id="customer_name"  name="customer_name" readonly >
                                                    
                                                </div>
                                                <div class="form-group col-md-6">    
                                                    <label for="email2">Customer Phone No</label>
                                                    <input type="hidden" class="form-control" name="customerid" id="customerid"
                                                    placeholder="" value="<?php echo  $session_id ?>">
                                                    <input type="number" value="<?php echo  $session__phone ?>" class="form-control" id="phone_no" name="custmer_phone_no" onkeypress="if(this.value.length==10) return false;" readonly>
                                                </div>


                                             <div class="form-group col-md-6">
                                                    <label for="exampleFormControlSelect1">Job Category</label> 
                                             <!-- <select required class="form-control" name="Add_job_cate" onchange="amount_filter_one(this.value);"> -->

                                                    <select required class="form-control" name="Add_job_cate">
                                                        <!-- <option value="">---SELECT---</option> -->
                                                    <?php
                                                    $main_cate=mysqli_query($config,"select * from job_search_category where Main_Category_Status ='1' and Main_Category_id ='2'");
                                                    while($addsubcate=mysqli_fetch_object($main_cate))
                                                    {  
                                                      $cat_id  =$addsubcate->Main_Category_id;                                                  ?>
                                                        <option value="<?php echo $addsubcate->Main_Category_id;?>"><?php echo $addsubcate->Main_Category_Name;?></option>
                                                    <?php } ?>                                                        
                                                    </select>
                                                     
                                                </div> 
<?php 
$main_cate_search=mysqli_query($config,"select * from job_search_category where Main_Category_id = '$cat_id' ");
											$macate_search=mysqli_fetch_object($main_cate_search);
										
                                            $package_days=$macate_search->days;

                                            $current_Date=date('Y-m-d');

                                            $futureDate = date("d-m-Y", strtotime($current_Date . " +$package_days days")); 
                                           ?>
                                                <!-- <div class="form-group col-md-6">    
                                                    <label for="email2">Job Name</label>
                                                    <input type="text" value="<//?php echo  $job_name ?>" class="form-control" id="job_name" name="job_name" >                                                   
                                                </div> -->

                                                <div class="form-group col-md-6">
    <label for="exampleFormControlSelect1">State</label>
    <?php $selectedStateId = isset($_SESSION['Add_state']) ? (int)$_SESSION['Add_state'] : 24; ?>
    <select required class="form-control" id="state" name="state" onchange="loadDistricts(this.value)">
        <option value="">---SELECT---</option>
        <?php
        $state_query = mysqli_query($config, "SELECT * FROM dir_state_master");
        while($state = mysqli_fetch_object($state_query)) {
            $selected = ((int)$state->state_id === $selectedStateId) ? 'selected="selected"' : '';
            echo "<option value='{$state->state_id}' {$selected}>{$state->name}</option>";
        }
        ?>
    </select>
</div>

<div class="form-group col-md-6">
        <label for="city">District</label>
        <select required class="form-control" id="city" name="dis_city">
            <option value="">---SELECT---</option>
            <?php
            $district_query = mysqli_query($config, "SELECT * FROM dir_city_master WHERE state_id='".$selectedStateId."' ORDER BY dir_city_name ASC");
            while($district = mysqli_fetch_object($district_query)) {
                $selected = ($district->dir_city_id == $_SESSION['Add_city']) ? 'selected="selected"' : '';
                echo "<option value='{$district->dir_city_id}' {$selected}>{$district->dir_city_name}</option>";
            }
            ?>
        </select>
    </div>

                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">City</label>
                                                        <div id="area">
                                                          <?php 
                                                            $_SESSION['Add_area'];
                                                          
                                                          if($_SESSION['Add_area']!='') { ?>
                                                        <select id="" name="Add_area" class="form-select form-control form-select-lg mb-3" aria-label=".form-select-lg example">

                                                            <?php

                                                             $wuei="SELECT * FROM `dir_area_master` where dir_cityid='".$_SESSION['Add_city']."' ORDER BY `dir_area_master`.`dir_area_name` ASC ";

                                                                                $main_cate3_area=mysqli_query($config,"SELECT * FROM `dir_area_master` where dir_cityid='".$_SESSION['Add_city']."' ORDER BY `dir_area_master`.`dir_area_name` ASC ");

                                                                                while($macate3_area=mysqli_fetch_object($main_cate3_area))

                                                                                {

                                                                                ?>
                                                            <option  <?php if($macate3_area->dir_area_id == $_SESSION['Add_area']) {?>selected="selected"<?php }?>  value="<?php echo $macate3_area->dir_area_id ?>"><?php echo $macate3_area->dir_area_name ?></option>
                                                            <?php }?>
                                                            </select> 
                                                            <?php } ?>
                                                        </div>
                                                </div>

                                                
<div class="row" style="padding: 15px;background: #faeed9;">


                                                <div class="form-group col-md-6">    
                                                    <label for="email2">Location Name</label>
                                                    <input required type="text" value="<?php echo  $job_location?>" class="form-control" id="job_location" name="job_location" placeholder="Area Name">                                                   
                                                </div>

                                            

                                                <div class="form-group col-md-6" >
                                                    <label for="email2">Salary Amount(Per day/Per hour)</label>
                                                    <input required type="text" class="form-control" id="email2" name="salary_range" placeholder="Salary Range...."  >
                                                </div>
                                               
                                                <div class="form-group col-md-6" >
                                                    <label for="email2">Mobile Number</label>
                                                    <input required type="text" class="form-control" id="contact_no" name="contact_no" placeholder="Contact No...."  >
                                                </div>
                                                <div class="form-group col-md-6" >
                                                    <label for="email2">Licence No</label>
                                                    <input required type="text" class="form-control" id="email_id" name="licence_no" placeholder="Licence No...."  >
                                                </div>

                                                <div class="form-group col-md-6" >
                                                    <label for="email2"> Vehicle Names(Experience)</label>
                                                    <input required type="text" class="form-control" id="email_id" name="vehicle_type" placeholder="Vehicle Brand Names"  >
                                                </div>

                                                <div class="form-group col-md-6">    
                                                    <label for="email2">Total Driving Experience(In years)</label>
                                                   
                                                    <input required type="text"  class="form-control" id="experiences" name="experiences" placeholder="Total Years">
                                                </div>


                                                <div class="form-group col-md-6" >    
                                                            <label for="email2">License Expiry Date</label>
                                                            <input required  type="date" class="form-control" id="last_date" name="last_date"  >
                                                    </div>
                                                    
                                                    <div class="form-group col-md-6" >    
                                                            <label for="email2">House Address</label>
                                                            <textarea required type="text" class="form-control" id="email2" name="address"  ></textarea>
                                                            </div>
                                                <div class="form-group col-md-6" >    
                                                            <label for="email2">Driving Previous Experience Details</label>
                                                            <textarea required type="text" class="form-control" id="email2" name="Add_remarks"  placeholder="Driving Experience Details"></textarea>
                                                    </div>	
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Exp Date</label>
                                                <input readonly type="text" value="<?php echo $futureDate ?>" class="form-control" id="exp_date" name="exp_date">
                                                </div>

                                                    <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Amount</label>
                                                        <div id="amount_job_secound">
                                                        <input readonly type="text" value="<?php echo  $macate_search->amount ?>" class="form-control" id="amount" name="amount">
                                                        </div>
                                                </div>
                                                           

                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Days</label>
                                                <input readonly type="text" value="<?php echo  $macate_search->days ?>" class="form-control" id="days" name="days">
                                                </div>


                                                        </div> 


                                                </div>

                                               
                                                    </div> 
                                                   

                                                   
                                                      <!-- <div id="post_btn"> -->
                                                        <div class="form-group">                                                         
                                                            <button class="btn btn-success" type="submit" name="post_add">Submit</button>
                                                        </div>
                                                     
                                                        <!-- </div>  -->
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





                 function amount_filter_one(id){
              
     
     var id =id;      
 


        $.ajax({
              type: "POST",
              url: "driver_job_categor_fil.php",
              data:{id:id}, 
              success: function(data)
              {
               
              $('#cat_filter').html(data);
         
              console.log(data);
              }
          });



          
          //           $.ajax({
          //     type: "POST",
          //     url: "job_amount.php",
          //     data:{id:id}, 
          //     success: function(data)
          //     {
          //       //alert(data);
          //     $('#amount_job').html(data);

          //     console.log(data);
          //     }
          // });

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
<script>
function loadDistricts(stateId, selectedCity) {
    if(stateId) {
        $.ajax({
            type: "POST",
            url: "fetch_districts.php",
            data: { state_id: stateId, selected_city: selectedCity || '' },
            success: function(response) {
                $("#city").html(response);
                $("#area").html('');
            }
        });
    } else {
        $("#city").html('<option value="">---SELECT---</option>');
        $("#area").html('');
    }
}

$(document).ready(function() {
    var initialStateId = $("#state").val();
    var initialCityId = "<?php echo isset($_SESSION['Add_city']) ? (int)$_SESSION['Add_city'] : 0; ?>";
    if (initialStateId) {
        loadDistricts(initialStateId, initialCityId);
    }
});
</script>
