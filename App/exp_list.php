<?php include('config/setup.php');?>

 <?php include('session.php');
 $mid=$_REQUEST['mid'];
$session__phone; 


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
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
     
            <script src="
      https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js
      "></script>
      <link href="
      https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css
      " rel="stylesheet">

   </head>
   

   <body>
   <style>
.owl-prev {
    position: absolute;
    top: 48%;
    color: blue !important;
    display: none;
}
.owl-next {
    position: absolute;
    left: 96%;
    color: blue !important;    
    top: 49%;
    display: none;
}
.heading_webkit
{
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
     overflow: hidden;
}


.switch {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 18px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
    position: absolute;
    content: "";
    height: 10px;
    width: 18px;
    left: 8px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
.post_text
{
  background: #e9ecef;
}
</style>
<?php include('Directory_topmenu.php');?>
   
        <div class="mt-3 mb-3" >
            <center> 
                <h5>
                   Expiry List
                </h5>
            </center>
        </div>

        <div class="">
          
            <div class=""> 
                     <?php
                     date_default_timezone_set('Asia/Kolkata'); 
                     $current_Date=date('Y-m-d');
                            $i=0;
                            $or="SELECT * FROM `create_post` where phone_no='$session__phone' and delete_id='0' and `expiry_date` <= '$current_Date'  Order by post_id DESC ";
                            $maincate3=mysqli_query($config,$or);             
                            while($mac3=mysqli_fetch_object($maincate3))
                            {                   
                               $date_new=$mac3->re_date;
                               $date = date("d-m-Y", strtotime($date_new));

                               $expiry_date_new=$mac3->expiry_date;
                               $expiry_date = date("d-m-Y", strtotime($expiry_date_new));


                               $post_create_on=$mac3->create_on;
                               $posteddate = date("d-m-Y", strtotime($post_create_on));



                               $net_amount=$mac3->net_amount;
                               $net_amount=$mac3->net_amount;
                               $disable_status=$mac3->disable_status;
                               
                               $loader_status=$mac3->loader_status;

                            $i++;
                                 $or_="SELECT * FROM `main_category` where Main_Category_id ='$mac3->category_id' Order by Main_Category_id  DESC ";
                                $maincate3_=mysqli_query($config,$or_);                       
                                $mac3_=mysqli_fetch_object($maincate3_);
                                 $Main_Category_Name = $mac3_->Main_Category_Name;

                                $or__="SELECT * FROM `sub_category` where Sub_Category_id  ='$mac3->subcategory_id' Order by Sub_Category_id  DESC ";
                                $maincate3__=mysqli_query($config,$or__);                       
                                $mac3__=mysqli_fetch_object($maincate3__);
                                $Sub_Category_Name = $mac3__->Sub_Category_Name;


                                $city_id= $mac3->city_id;      
                                $or_="SELECT * FROM `dir_city_master` where dir_city_id ='$city_id' Order by dir_city_id  DESC ";
                                $maincate3_=mysqli_query($config,$or_);       
                                $mac3_=mysqli_fetch_object($maincate3_);

                                $area_id= $mac3->area_id;      
                                $orarea_="SELECT * FROM `dir_area_master` where dir_area_id ='$area_id' Order by dir_area_id   DESC ";
                                $orarea3_=mysqli_query($config,$orarea_);       
                                $area3__=mysqli_fetch_object($orarea3_);  

                                $sub_area_id=$mac3->sub_area_id;
                                $orsubarea_="SELECT * FROM `sub_area_master` where sub_area_id ='$sub_area_id' Order by sub_area_id DESC ";
                                $orsubarea3_=mysqli_query($config,$orsubarea_);       
                                $subarea3__=mysqli_fetch_object($orsubarea3_); 

                        ?>  
                     <div class="row <?php if($disable_status == '1') { ?>post_text <?php }?> p-2">
                        <div class="col-5 col-sm-5 col-md-5 ">                    
                            <div class="item ">
                                <div class="" style="height:97px; width:100% ">
                                    <img style="height: 131px !important; width: 100%;"class="img-fluid slider-eff" src="../photos/vehicle/<?php echo $mac3->vehicle_photo?>" alt="..." />
                                </div>                                                    
                            </div>
                         </div>
                    <div class="col-7 col-sm-7 col-md-7">  
                    <p style="color:;font-weight: 600;"> <?php echo $Main_Category_Name?> </p>
                      <?php if($mac3->category_id !='4' and $mac3->category_id !='5')  { ?>
                        <h6 style="color:blue;font-weight: 700;" class="heading_webkit"><?php echo $mac3->vehicle_name?> </h6>
                        <p style="font-weight: 600;"><?php echo $mac3->vehicle_no ;?></p>
                      <?php } else{?>
                        <h6 style="color:blue;font-weight: 700;" class="heading_webkit"><?php echo $mac3->shop_name?> </h6>
                        <!-- <p style="font-weight: 600;"><?php echo $mac3->shop_address ;?></p> -->
                        <?php }?>
                        <!-- <p style="font-weight: 600;">Renewal Date : <?php echo $date ;?></p> -->
                         <?php if($net_amount!='') { ?>
                        <p style="color:green;font-weight: 600;">Package Amount : <?php echo $mac3->net_amount?></p>
                        <?php } else {
                          ?>
                          <p style="color:green;font-weight: 600;">Package Amount : <?php echo $mac3->package_amount?></p>
                          <?php } ?>
                         <p style="font-weight: 600;">Payment Date : <?php echo $posteddate ;?></p>
                          <p style="font-weight: 600;" >Package Expiry : <?php echo $expiry_date ;?></p>
                          <p><?php echo $mac3_->dir_city_name;?>,<?php echo $area3__->dir_area_name;	?>,<?php echo $subarea3__->sub_area_name;	?></p>
                           

                    </div>

                    <!-- <div class="col-12 "> 
                    <a href="post_renewal.php?pid=<?php echo $mac3->post_id?>" name="renewal" class="btn btn-primary btn-lg btn-block">renewal</a>
                     </div> -->
                     
                </div>    
                
                <hr>               
            <?php } ?>
             </div>                        
        </div>                            
       
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


        <?php
                    $pro_page = '3';
                include('footermenu.php');?>
                <?php include('menu.php');?> 

     <?php include('menu.php');?> <!-- Bootstrap core JavaScript -->

      <script src="vendor/jquery/jquery.min.js"></script>

      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

      <!-- slick Slider JS-->

      <script type="text/javascript" src="vendor/slick/slick.min.js"></script>

      <!-- Sidebar JS-->

      <script type="text/javascript" src="vendor/sidebar/hc-offcanvas-nav.js"></script>

      <!-- Custom scripts for all pages-->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
      
      <script src="js/osahan.js"></script>
      <script>
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        autoplay: true,
        nav: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });
    $(".owl-prev").html('<i class="fa fa-chevron-left"></i>');
     $(".owl-next").html('<i class="fa fa-chevron-right"></i>');

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


<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> -->


    
        <div class="modal" tabindex="-1" id="exampleModalupdate" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div style="border-bottom: 0px solid #e5e5e5 !important" class="modal-header">
      <div class="alertreg alert-success" style="display: none;" role="alert">                               
                                    <div class="msgreg">

                                    </div>                                    
                                </div>
      </div>
      <div class="modal-body">
      <div class="contact-form default-form">
                            <!-- <form action="city_update_insert.php" method="post"> -->
                                <div class="row clearfix" id="citypopup">   
                                
                                <div class="form-group col-md-6">
                                                    <label for="exampleFormControlSelect1">District</label>
                                                        <select required class="form-control" id='city' name="Add_city">
                                                            <option>---SELECT---</option>
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
                                                    <label for="exampleInputEmail1">Area</label>
                                                        <div id="area9">

                                                        </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Area</label>
                                                        <div id="subarea">

                                                        </div>
                                                </div>
                                              
                                </div>
                                <div class="form-group">
                                  <a class="btn btn-success"  onclick="updatecheck();"  name="city_update">Update</a>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            <!-- </form> -->
						</div>
      </div>
      
    </div>
  </div>
</div>


<div class="modal" tabindex="-1" id="exampleModaldelete" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div style="border-bottom: 0px solid #e5e5e5 !important" class="modal-header">
      <div class="alertdelete alert-success" style="display: none;" role="alert">                               
                                    <div class="msgdelete">

                                    </div>                                    
                                </div>
      </div>
      <div class="modal-body">
      <div class="contact-form default-form">
                            <!-- <form action="city_update_insert.php" method="post"> -->
                                <div class="row clearfix" id="deletepopup">   
                                
                                                            </div>
                            <!-- </form> -->
						</div>
      </div>
      
    </div>
  </div>
</div>



<div class="modal" tabindex="-1" id="exampleModaldiable" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div style="border-bottom: 0px solid #e5e5e5 !important" class="modal-header">
      <div class="alertreg alert-success" style="display: none;" role="alert">                               
                                    <div class="msgreg">

                                    </div>                                    
                                </div>
      </div>
      <div class="modal-body">
      <div class="contact-form default-form">
                            <!-- <form action="city_update_insert.php" method="post"> -->
                                <div class="row clearfix" id="diablepopup">   
                                
                                <div class="form-group col-md-6">
                                                    <label for="exampleFormControlSelect1">City</label>
                                                        <select required class="form-control" id='city' name="Add_city">
                                                        <option value="1">Enable</option>
                                                        <option value="0">Disable</option>                                       
                                                        </select>
                                                </div> 
                                </div>
                                <div class="form-group">
                                  <a class="btn btn-success"  onclick="disablecheck();"  name="city_update">Update</a>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            <!-- </form> -->
						</div>
      </div>
      
    </div>
  </div>
</div>


<div class="modal fade modal-dialog-centere" id="exampleModaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="height: 100%;">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     
        <div class="row" id="postform">
                                                
                                         
                                               
       </div>
      </div>
     
    </div>
  </div>
</div>
   


<div class="modal" tabindex="-1" id="exampleModalloader" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div style="border-bottom: 0px solid #e5e5e5 !important" class="modal-header">
      <div class="alertload alert-success" style="display: none;" role="alert">                               
                                    <div class="msgload">

                                    </div>                                    
                                </div>
      </div>
      <div class="modal-body">
      <div class="contact-form default-form">
                            <!-- <form action="city_update_insert.php" method="post"> -->
                                <div class="row clearfix" > 
                                  <div class="form-group col-md-6" id="loaderupdate" >

                                  </div>
                                 
                                 
                                </div>


                                
                            <!-- </form> -->
						</div>
      </div>
      
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>


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

$( document ).ready(function() {

var id=$('#set_city').val();
if(id == 0){
  // $('#exampleModalcity').modal('show'); 
}else{

}
});



function openedit(id){
                    var id;
                   //alert(id);
             
                    $.ajax({
                        type: "POST",
                        url:'post_edit_field.php',
                        data: {id:id}, // serializes the form's elements.
                        success: function(data)
                        {	
                           //alert(data);		
                        $('#postform').html(data);
                        
                        }		
                        	
                    });	
                    

                }

                

                function deletepost(id){
                    var id;
                  // alert(id);
             
                    $.ajax({
                        type: "POST",
                        url:'delete_popup.php',
                        data: {id:id}, // serializes the form's elements.
                        success: function(data)
                        {	
                            //alert(data);		
                        $('#deletepopup').html(data);
                        
                        }		
                        	
                    });	
                    

                }




               




            function openPopup(id){
                    var id;
                   //alert(id);
             
                    $.ajax({
                        type: "POST",
                        url:'city_update.php',
                        data: {id:id}, // serializes the form's elements.
                        success: function(data)
                        {	
                           // alert(data);		
                        $('#citypopup').html(data);
                        
                        }		
                        	
                    });	
                    

                }

                function diablePopup(id){
                    var id;
                   //alert(id);
             
                    $.ajax({
                        type: "POST",
                        url:'disable_update.php',
                        data: {id:id}, // serializes the form's elements.
                        success: function(data)
                        {	
                           // alert(data);		
                        $('#diablepopup').html(data);
                        
                        }		
                        	
                    });	
                    

                }


                function loader(id)
                {
                  var id;
                  $.ajax({
                        type: "POST",
                        url:'loader_popup.php',
                        data: {id:id}, // serializes the form's elements.
                        success: function(data)
                        {	
                           //alert(data);		
                           $('#loaderupdate').html(data);
                        }			
                    });	

                }
                function loaderpopup(id){
                  var id;
                   //alert(id);
                   var loader_from_date = $('#loader_from_date').val();
                   var loader_to_date = $('#loader_to_date').val();
                   var loader_from_place = $('#loader_from_place').val();
                   var loader_to_place = $('#loader_to_place').val();
                   var loader_space = $('#loader_space').val();
                   var loader_remarks = $('#loader_remarks').val();
                   var post_id = $('#post_id').val()
                    $.ajax({
                        type: "POST",
                        url:'loader_popup_insert.php',
                        data: {id:id,loader_from_date:loader_from_date,loader_to_date:loader_to_date,loader_from_place:loader_from_place,loader_to_place:loader_to_place,post_id:post_id,loader_space:loader_space,loader_remarks:loader_remarks}, // serializes the form's elements.
                        success: function(data)
                        {	
                           //alert(data);		
                          //console.log(data);
                           if(data == 1)
                            {
                                    
                                  // $(".alertload").attr("style", "display: block;padding:20px;");
                                  // $(".alertload").delay(1000).fadeOut(500);
                                
                                  // $('.msgload').html("Loader Updated ");   
                                  
                                  Swal.fire({
                                  position: 'center',
                                  icon: 'success',
                                  title: 'Loader Details Updated',
                                  showConfirmButton: false,
                                  timer: 1500
                                  })


                                  setTimeout(function() {
                                    $('#exampleModalloader').modal('hide');
                                    }, 1000);
                                    setTimeout(() => { 
                                            location.reload();
                                    }, 2000);

                            }
                        }			
                    });	
                }



              
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
                $('#subarea1').html(data);

                console.log(data);
                }
            });
            }
</script>


   </body>

</html>
