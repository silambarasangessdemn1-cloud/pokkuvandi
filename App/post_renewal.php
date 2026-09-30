<?php include('config/setup.php');
 include('session.php');
 error_reporting( E_ALL );
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
            <h5 class="text-center" >Registration Renewal</h5>

            <?php
                    $pid=$_REQUEST['pid'];
                      // echo "select * from create_post where post_id='$pid'";
                    $main_cate=mysqli_query($config,"select * from create_post where post_id='$pid'");
											$data=mysqli_fetch_object($main_cate);

                      $package_amount = $data->package_amount;

             ?>
            <div class="card">
                            <form action="add_renewal.php" method="post" enctype="multipart/form-data">
								<div class="card-body">
                                     <div class="row">
                                     <input type="hidden" value="<?php echo $pid ?>" class="form-control" id="email2" name="Add_postid"  > 
                                                <div class="form-group col-md-6">    
                                                    <label for="email2">Customer Name</label>
                                                    <input type="text" value="<?php echo  $session__username ?>" class="form-control" id="Add_driver_name" onkeyup="cum(this.value)" name="Add_driver_name" readonly >
                                                    <!-- <div id="serach_result">
                                                        <ul class="subnav sug-list-color" id="serach_result1">
                                                        </ul>
                                                    </div> -->
                                                </div>
                                                <div class="form-group col-md-6">    
                                                    <label for="email2">Customer Phone No</label>
                                                    <input type="hidden" class="form-control" name="customerid" id="customerid"
                                                    placeholder="">
                                                    <input type="number" value="<?php echo  $session__phone ?>" class="form-control" id="phone_no" name="Add_phone_no" onkeypress="if(this.value.length==10) return false;" readonly>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleFormControlSelect1">Main Category</label>
                                                    <select  class="form-control" name="Add_main_cate" onchange="maincateg(this.value);" disabled>
                                                        <option>---SELECT---</option>
                                                        <?php
                                                    $main_cate=mysqli_query($config,"select * from main_category ");
                                                    while($addsubcate=mysqli_fetch_object($main_cate))
                                                    {  
                                                    ?>
                                                     
                                                        <option <?php if($addsubcate->Main_Category_id == $data->category_id ){ echo 'selected';} ?>  value="<?php echo $addsubcate->Main_Category_id;?>" ><?php echo $addsubcate->Main_Category_Name; ?></option>
                                                    <?php } ?>                                                        
                                                    </select>
                                                            
                                                </div>  
                                                <div class="form-group col-md-6">    
                                                 <label for="email2">Sub Category Name</label>
                                                    <div id="sc">
                                                    <select class="form-control" name="Add_sub_category" onchange="subcateg(this.value);" disabled> 
                                                            <option>---SELECT---</option>
                                                            <?php
                                                            $main_cate=mysqli_query($config,"select * from sub_category where Main_Category ='$data->category_id'");
                                                            while($addsubcate=mysqli_fetch_object($main_cate))
                                                            {  
                                                            ?>
                                                          
                                                            <option <?php if($addsubcate->Sub_Category_id == $data->subcategory_id ){ echo 'selected';} ?>  value="<?php echo $addsubcate->Sub_Category_id?>"><?php echo $addsubcate->Sub_Category_Name?></option>
                                                            <?php } ?>                                                        
                                                        </select>
                                                    </div>
                                                    <div id="filter" >
                                                    <?php                     
                                        $shop_master_=mysqli_query($config,"select * from sub_category_filter where Sub_Category_id='$data->subcategory_id' ");
                                        while($sm_=mysqli_fetch_object($shop_master_))
                                        {
                                            ?>
                                        <div style="background: #f5dfee;padding-left: 37px;padding-top: 10px;">              
                                              <input class="form-check-input" checked type="checkbox" value="<?php echo $sm_->filter_id ;?>" name="sub_cate_filter[]" >  <label class="form-check-label" for="flexCheckDefault"> <?php echo $sm_->name ;?></label><br>
                                         </div> 
                                         <?php
                                        }?>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-6">    
                                                 <label for="email2">Package</label>
                                                    <div id="pk">
                                                    <select class="form-control" name="Add_package" onchange="package(this.value);">
                                                            <option>---SELECT---</option>
                                                            <?php
                                                            $main_cate=mysqli_query($config,"select * from category_package where Main_category_id ='$data->category_id' and status='1' ");
                                                            while($addsubcate=mysqli_fetch_object($main_cate))
                                                            {  
                                                            ?>
                                                            <!-- <option value="<?php echo $addsubcate->package_id ;?>"><?php echo $addsubcate->package_title;?></option> -->
                                                            <option <?php if($addsubcate->package_id == $data->package_id ){ echo 'selected';} ?>  value="<?php echo $addsubcate->package_id?>"><?php echo $addsubcate->package_title?></option>
                                                            <?php } ?>                                                        
                                                        </select>
                                                    </div>                                                  
                                                </div>

                                                <div class="form-group col-md-6">                                                      
                                                        <div class="row" id="pkamount">
                                                        <div class="form-group col-md-6">
                                                                <label for="email2">Package Expiry Date</label>           
                                                                <input  type="hidden" class="form-control" id="pack_id" name="pack_id" value="<?php echo $data->package_id ?>">             
                                                                     <input type="text" value="<?php echo $data->expiry_date ?>" class="form-control" id="Add_date" name="Add_date" placeholder="amount"  readonly> 
                                                           </div> 
                                                            <div class="form-group col-md-6" >
                                                                <label for="email2">Package Amount</label>                        
                                                                     <input type="text" value="<?php echo $data->package_amount ?>" class="form-control" id="Add_amount" name="Add_amount" placeholder="amount" readonly> 
                                                                   
                                                           </div> 
                                                           <div class="form-group col-md-6" style="display:none">
                                                                <label for="email2">Package Days</label>           
                                                                <!-- <input  type="hidden" class="form-control" id="pack_id" name="pack_id" value="<?php echo $data->package_id ?>">              -->
                                                                     <input type="text" value="<?php echo $data->package_days ?>" class="form-control" id="Add_days" name="Add_days" placeholder="amount"  readonly> 
                                                           </div> 
                                                         </div>                                                                                                                                                    
                                                </div>

                                                <div class="mb-3" style="background:#ffe8ec;padding:9px">
    <div class="row">
        <!-- Dropdown to select Coupon Status -->
        <div class="form-group col-md-6">
            <label for="coupon_status">Show a  Coupon?</label>
            <select class="form-control" id="coupon_status" onchange="toggleCouponFields();">
                <option value="no">No</option>
                <option value="yes">Yes</option>
            </select>
        </div>
    </div>
                                                <div id="coupon_fields" style="display: none;">

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
                                                      </div> 
                                                      <?php if($data->category_id == '4' OR $data->category_id == '5' ) { ?>
                                                              <!-- <div class="form-group col-md-6">
                                                          <label for="email2">Shop Name</label>
                                                          <input type="text" class="form-control" id="email2" name="shop_name" value="<?php echo $data->shop_name?>" placeholder="shop_name "  >                                                    
                                                      </div>  -->
                                               
                                                  <!-- <div class="form-group col-md-6">    
                                                              <label for="email2">Shop Address</label>
                                                              <input  type="text" class="form-control" id="shop_address"  value="<?php echo $data->shop_address?>"  name="shop_address" placeholder=""  >                                                              
                                                      </div> -->
                                                        <?php } else {?>

                                                <!-- <div class="form-group col-md-6">
                                                    <label for="email2">Vehicle Name</label>
                                                    <input type="text" class="form-control" id="email2" name="Add_vehicle_name" value="<?php echo $data->vehicle_name?>" placeholder="vehicle Name"  >                                                    
                                                </div>  -->
                                               
                                                <!-- <div class="form-group col-md-6">    
                                                            <label for="email2">Vehicle Registration Number</label>
                                                            <input  type="text" class="form-control" id="Add_vehicle_no"  value="<?php echo $data->vehicle_no?>" onkeyup="vehicle_uni(this.value);" name="Add_vehicle_no" placeholder=""  >
                                                            <div style="color: red;font-size: 15px;font-weight: 500;margin-top: 10px;" id="vehicle_like">
                                                              
                                                          </div>
                                                    </div> -->
                                                   <?php } ?>         

                                                   <div class="form-group col-md-6" style="display:none">    
                                                            <label for="email2">RC Owner Name</label>
                                                            <input  type="text" value="<?php echo $data->Add_RC_owner_name ?>" class="form-control" id="email2" name="Add_RC_owner_name"  >
                                                    </div>
                                            
                                            </div>
                                          
                                            <div id="vr" style="display: none;padding: 15px;background: #faeed9;">
                                                <div class="row">
                                                   
                                                  <div class="form-group col-md-6">
                                                            <label for="exampleFormControlSelect1">Loading Capacity</label>
                                                            <select  class="form-control" name="Add_load_detail" >
                                                             
                                                                
                                                             <?php    
                                                                $enablestatus=$data->Add_load_detail;

                                                                if($enablestatus == 'Space')
                                                                { ?>

                                                                <option value="Space" selected>Space</option>
                                                                <option value="Size">Size</option>
                                                                <option value="Tonnage">Tonnage</option>
                                                                <?php }else if($enablestatus == 'Size'){?>

                                                                    <option value="Space" >Space</option>
                                                                <option value="Size" selected>Size</option>
                                                                <option value="Tonnage">Tonnage</option>>
                                                                <?php }else{ ?>
                                                                    <option value="Space" >Space</option>
                                                                <option value="Size">Size</option>
                                                                <option value="Tonnage" selected>Tonnage</option>


                                                                <?php } ?>


                                                            </select>                                                            
                                                    </div> 
                                                
                                                    <div class="form-group col-md-6" style="display:none">    
                                                            <label for="email2">Vehicle Active Current Location</label>
                                                            <input  type="text" class="form-control" id="email2" name="Add_location" placeholder="Driver Name"  >
                                                    </div>
                                                   
                                                    <div class="form-group col-md-6" style="display:none">    
                                                            <label for="email2">RC Registration Date</label>
                                                            <input  type="date" class="form-control" id="email2" name="Add_Registration_date"  >
                                                    </div>
                                                  
                                                    <div class="form-group col-md-6" style="display:none">    
                                                            <label for="email2">Vehicle Insurance Expiry Date</label>
                                                            <input  type="date" class="form-control" id="email2" name="Add_insurance_exp_date"  >
                                                    </div>
                                                    <div class="form-group col-md-6" style="display:none">    
                                                            <label for="email2">FC Date</label>
                                                            <input  type="date" class="form-control" id="email2" name="FC_date"  >
                                                    </div>
                                                   
                                                </div>
                                            </div>

                                           


                                            <div class="row">
                                                
                                                <div class="form-group col-md-6" style="display:none">
                                                    <label for="email2">Vehicle Photo(Size 250 X 250 px)</label>
                                                    <input  type="file" class="form-control" id="email2" value="<?php echo $data->vehicle_photo ?>" name="Add_vehicle_photo">
                                                </div>
                                              
                                                <div class="form-group col-md-6" style="display:none">
                                                    <label for="email2">Whatsapp No</label>
                                                    <input  type="text" class="form-control" id="email2" name="Add_whatsapp_no" value="<?php echo $data->whatsapp_no ?>" placeholder="Whatsapp No" onkeypress="if(this.value.length==10) return false;" >
                                                </div>
                                                <!-- <div class="form-group col-md-6" >
                                                    <label for="email2">Address</label>
                                                    <textarea type="text" class="form-control" id="email2" name="Add_address" value="<?php echo $data->address ?>" placeholder="Address...."  ></textarea>
                                                </div> -->
                                                <div class="form-group col-md-6" style="display:none">
                                                    <label for="exampleFormControlSelect1">City</label>
                                                        <select  class="form-control" id='city' name="Add_city">
                                                            <option>---SELECT---</option>
                                                            <?php
                                                            $main_cate=mysqli_query($config,"select * from dir_city_master");
                                                            while($addsubcate=mysqli_fetch_object($main_cate))
                                                            {  
                                                            ?>
                                                            
                                                            <option <?php if($addsubcate->dir_city_id == $data->city_id ){ echo 'selected';} ?>  value="<?php echo $addsubcate->dir_city_id ;?>"><?php echo $addsubcate->dir_city_name;?></option>
                                                            <?php } ?>                                                        
                                                        </select>
                                                </div>
                                                <div class="form-group col-md-6" style="display:none">
                                                    <label for="exampleInputEmail1">Area</label>
                                                        <div id="area">
                                                        <select class="form-control" name="area">
                                                            <option>---SELECT---</option>
                                                            <?php                                                           
                                                            $main_cate=mysqli_query($config,"select * from dir_area_master where dir_area_id='$data->area_id' ");
                                                            while($addsubcate=mysqli_fetch_object($main_cate))
                                                            {  
                                                            ?>
                                                            <option <?php if($addsubcate->dir_area_id == $data->area_id ){ echo 'selected';} ?>  value="<?php echo $addsubcate->dir_area_id ;?>"><?php echo $addsubcate->dir_area_name;?></option>
                                                            <?php } ?>                                                        
                                                        </select>
                                                        </div>
                                                </div>
                                               
                                                <div class="form-group col-md-6" style="display:none">
                                                    <label for="exampleFormControlSelect1">Active Status</label>
                                                    <select class="form-control" id="exampleFormControlSelect1" name="Add_status">
                                                    <?php 

                                                        $enablestatus=$data->status;

                                                        if($enablestatus == 1)
                                                        { ?>

                                                        <option value="1" selected>Active</option>
                                                        <option value="0">In-Active</option>
                                                        <?php }else if($enablestatus == 0){?>

                                                            <option value="1" >Active</option>
                                                        <option value="0" selected>In-Active</option>
                                                        <?php }else{ ?>
                                                        <option value="1" >Active</option>
                                                        <option value="0" >In-Active</option>


                                                        <?php } ?>                                                     
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6" style="display:none">
                                                    <label for="email2">Meta Keyword</label>
                                                    <textarea type="text" class="form-control" id="email2" name="Add_meta_keyword" value="<?php echo $data->meta_keyword ?>" placeholder="Address...."  ></textarea>
                                                </div>
                                                <div class="form-group col-md-6" style="display:none">    
                                                            <label for="email2">General Remarks</label>
                                                            <textarea type="text" class="form-control" value="<?php echo $data->remarks ?>" id="email2" name="Add_remarks"  ></textarea>
                                                    </div>		
                                                    <div class="form-group col-md-6" >    
                                                            
                                                            </div>
                                                      <div id="post_btn" style="width: 100%; display: flex; justify-content: flex-end; padding-right: 15px;">
                                                        <?php 
                                                      if($package_amount == '0')
                    { ?>
                                                                        <div class="form-group" >    

                       <button class="btn btn-success" type="submit" name="post_add" >Get Free registration</button>
                  </div>
                  <?php  }
                    else
                    { ?>


                        <button class="btn btn-success" type="submit" name="post_add" >Pay For registration</button>
                     <?php } ?>
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
                        var couponStatus = $('#coupon_status').val(); // 'yes' or 'no'
            if (couponStatus === 'yes') {
                // ✅ Recalculate coupon if it was previously active
                couponcode();
            }
                        }			
                    });	
                   // couponcode();

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
                          $('#vehicle_like').html("Vehicle Number Already Register");
                         
                        }
                        else
                        {
                          $('#vehicle_like').html("");
                        }
                        
                        
                        }			
                    });

                 }

                 
                 function couponcode(){
                        var coupon_code = $('#coupon_code').val();  
                        var pack_id = $('#pack_id').val();
                        var Add_amount = $('#Add_amount').val();
                     
                        var Add_driver_name = $('#Add_driver_name').val();
                        
                      //  alert(coupon_code);
                      //  alert(pack_id);
                  
                        $.ajax({
                            type: "POST",
                            url:'coupon_check.php',
                            data: {pack_id:pack_id,coupon_code:coupon_code,Add_amount:Add_amount,Add_driver_name:Add_driver_name}, // serializes the form's elements.
                            success: function(data)
                            {	
                            // alert(data);		
                            $('#netamount').html(data);
                            setTimeout(function () {
    var netVal = $('#net_amount').val(); // get value from hidden input
    console.log('Net Amount:', netVal); // 👈 Check this in console

    if (netVal) {
        $('#Add_amount').val(netVal); // set it to Add_amount
    } else {
        console.warn('⚠️ net_amount is empty or missing!');
    }
}, 50);
                            }			
                         });	

                      }


                      function toggleCouponFields() {
    const couponStatus = document.getElementById("coupon_status").value;
    const couponFields = document.getElementById("coupon_fields");

    // Show or hide the coupon fields based on selection
    if (couponStatus === "yes") {
        couponFields.style.display = "block"; // Show the coupon fields
    } else {
        couponFields.style.display = "none"; // Hide the coupon fields
        document.getElementById("coupon_code").value = ""; // Clear the input field
        document.getElementById("coupon_pack").innerHTML = ""; // Clear the result
    }
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