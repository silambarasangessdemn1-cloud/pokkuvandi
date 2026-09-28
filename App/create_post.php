<?php 
include('config/setup.php');
  include('session.php');
  session_start();
  if(!$session__username){
header('Location: logout.php');
  }
 // Generate a unique token
$token = bin2hex(random_bytes(32));
$_SESSION['form_token'] = $token;
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

      <!-- SweetAlert2 -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.10/dist/sweetalert2.min.css">
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.10/dist/sweetalert2.all.min.js"></script>

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
            <h5 class="text-center" id="registration_heading" >Create Registration</h5>
            <?php
$query1 = mysqli_query($config, "SELECT * FROM create_post WHERE customer_id = '$prof_id' AND status = 0 AND delete_approval_status != 1");

if (mysqli_num_rows($query1) > 0) {
    $check123 = mysqli_fetch_object($query1);
?>



    <div class="alert alert-warning text-center">
    ✅ Your data was already saved. 

    <?php if (!empty($check123->utr_number)  ) { ?>
    <span class="text-danger font-weight-bold">Your Scan QR Code Payment Verification is Under Process...Please wait for Activation</span>
    <p>After Activation... Your  Vehicle/Shop Registration Details will be displayed in Driver Menu... "Registered Vehicle/Services List Page"</p>

<?php }?>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(window).on('load', function () {
    setTimeout(function () {
      const $target = $('#total_net_amount');
      if ($target.length) {
        $('html, body').animate({
          scrollTop: $target.offset().top - 100 // Adjust if you have a fixed header
        }, 800);
      }
    }, 300); // Delay to ensure full rendering
  });
</script>



<?php
}
?>

         

            <div class="card">
           


            <form id="ajax-post-form" enctype="multipart/form-data">
            <div class="card-body">
                <input type="hidden" name="form_token" value="<?php echo $token; ?>">

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
                                                    <select required class="form-control" name="Add_main_cate" id="mainCategorySelect" onchange="maincateg(this.value);">
                                                        <option value="">---SELECT---</option>
                                                    <?php
                                                    $main_cate=mysqli_query($config,"select * from main_category where Main_Category_Status ='1' ");
                                                    while($addsubcate=mysqli_fetch_object($main_cate))
                                                    {  
                                                    ?>
                                                        <option  <?php if($_SESSION['Add_main_cate'] == $addsubcate->Main_Category_id) {?>selected="selected"<?php }?>  value="<?php echo $addsubcate->Main_Category_id;?>"><?php echo $addsubcate->Main_Category_Name;?></option>
                                                    <?php } ?>                                                        
                                                    </select>
                                                     
                                                </div> 
                                                    
                                                <div class="form-group col-md-6">    
                                                 <label for="email2">Sub Category Name</label>
                                                    <div id="sc">
                                                        <?php if($_SESSION['Add_sub_category']!='') { ?>
                                                          <select required class="form-control" onchange="subcateg(this.value);" name="Add_sub_category" id="Add_sub_cate_Name"  >
                                                          <option  value="">---Select---</option>';

                                                          <?php $shop_master_=mysqli_query($config,"select * from sub_category where Main_Category='".$_SESSION['Add_main_cate']."' and Sub_Category_Status=1");
                                                          while($sm_=mysqli_fetch_object($shop_master_))
                                                          {?>
                                                          <option  <?php if($_SESSION['Add_sub_category'] == $sm_->Sub_Category_id) {?>selected="selected"<?php }?>  value="<?php echo $sm_->Sub_Category_id ?>"><?php echo $sm_->Sub_Category_Name ?></option>
                                                          <?php }?>

                                                          </select>
                                                        <?php } ?>
                                                    </div>
                                                                     
                                                </div>

                                               
                                               

                                                
                                                </div>
                                                                                         
                                                  
                                                   <div class="row">
                                                
                                                
                                               
                                              
                                            
                                            </div>                                          
                                            <div id="commercial" >
                                            <?php if($_SESSION['Add_main_cate'] == '1' ) { 
                                                    

                                                    
                                                    if($_SESSION['Add_sub_category'] >= 1 && $_SESSION['Add_sub_category'] <=4)
                                                    {
                                                        ?>
                                                        
                                                    <div class="row" style="padding: 15px;background: #faeed9;">
                                                    <div class="form-group col-md-6">    
                                                                                                     <label for="email2">Vehicle Type</label>
                                                                                                        <div id="vt" >
                                                                                                        <select required class="form-control" name="vehicle_type_id" id="Add_vehicle_type"  >
                                                                                                        <option  value="">---Select---</option>
                                                                                                        <?php
                                                                                                          $shop_master_=mysqli_query($config,"select * from vehicle_type where status=1 and sub_category_id='".$_SESSION['Add_sub_category']."'");
                                                                                                          while($sm_=mysqli_fetch_object($shop_master_))
                                                                                                          { 
                                                                                                        ?>
                                                                                                            <option <?php if($sm_->Vehicle_type_id ==  $_SESSION['vehicle_type_id'] ) {?>selected="selected"<?php }?> value="<?php echo $sm_->Vehicle_type_id;?>"><?php echo $sm_->Vehicle_type_name;?></option>
                                                                                                        <?php } ?>                                                        
                                                                                                        </select>
                                                                                                        </div>                                         
                                                                                                    </div>
                                                                                                    <div class="form-group col-md-6">
                                                                                                        <label for="email2">Vehicle Name</label>
                                                                                                        <input type="text" required class="form-control" value="<?php echo $_SESSION['Add_vehicle_name']?>" id="email2" name="Add_vehicle_name"  placeholder="vehicle Name"  >
                                                                                                    </div>
                                                    
                                                                                                       <div class="form-group col-md-6">    
                                                                                                           <label for="email2">Vehicle Registration Number</label>
                                                                                                           <input 
    required 
    type="text" 
    class="form-control" 
    id="vehicle_input"  
    name="Add_vehicle_no"  
    placeholder="Vehicle Registration Number"
    pattern="[A-Z0-9]+" 
    title="Only uppercase letters and numbers allowed. No spaces."
    oninput="this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '');"
    onkeydown="return event.key !== ' ';"
    onkeyup="vehicle_uni(this.value);">

                                                                                                           <div style="color: red;font-size: 15px;font-weight: 500;margin-top: 10px;" id="vehicle_like">
                                                                                                             
                                                                                                         </div>
                                                                                                   </div>
                                                                                                   <div class="form-group col-md-6">    
                                                                                                                <label for="email2">RC Owner Name</label>
                                                                                                                <input required type="text" value="<?php echo $_SESSION['Add_RC_owner_name']?>" class="form-control" id="email2" name="Add_RC_owner_name"  >
                                                                                                        </div>
                                                    

                                                    
                                                                                                   <div class="form-group col-md-6">    
                                                                                                                <label for="email2">Tonnage</label>
                                                                                                                <input required type="text" value="<?php echo $_SESSION['tonnage']?>" class="form-control" id="email2" name="tonnage" placeholder="Ex: 5 Ton"  >
                                                                                                        </div>
                                                                                                    <div class="form-group col-md-6" id="vehicle_body_type_container" style="display: <?php echo (isset($_SESSION['Add_main_cate']) && $_SESSION['Add_main_cate'] == '1') ? 'block' : 'none'; ?>;">    
                                                                                                                <label for="email2">Vehicle Body Type</label>
                                                                                                                <select required class="form-control" name="vehicle_body_type" id="vehicle_body_type">
                                                                                                                    <option value="">---Select---</option>
                                                                                                                    <option value="Open Body" <?php if(isset($_SESSION['vehicle_body_type']) && $_SESSION['vehicle_body_type'] == 'Open Body') {?>selected="selected"<?php }?>>Open Body</option>
                                                                                                                    <option value="Container Body" <?php if(isset($_SESSION['vehicle_body_type']) && $_SESSION['vehicle_body_type'] == 'Container Body') {?>selected="selected"<?php }?>>Container Body</option>
                                                                                                                </select>
                                                                                                        </div>
                                                                                                                                                                                                    
                                                                                                   <div class="form-group col-md-6">    
                                                                                                                <label for="email2"> Current Location Name</label>
                                                                                                                <input  required ="text" value="<?php echo $_SESSION['Add_location']?>" class="form-control" id="email2" name="Add_location" placeholder=""  >
                                                                                                        </div>
                                                    
                                                                                                  
                                                                                                        <div class="form-group col-md-6" style="display:none">    
                                                                                                                <label for="email2">RC Registration Date</label>
                                                                                                                <input  type="date" class="form-control" value="<?php echo $_SESSION['Add_Registration_date']?>" id="email2" name="Add_Registration_date"  >
                                                                                                        </div>
                                                                                                      
                                                                                                        <div class="form-group col-md-6">    
                                                                                                                <label for="email2">Vehicle Insurance Expiry Date</label>
                                                                                                                <input  type="date" class="form-control" value="<?php echo $_SESSION['Add_insurance_exp_date']?>" id="email2" name="Add_insurance_exp_date"  >
                                                                                                        </div>
                                                                                                        <div class="form-group col-md-6" style="display:none">    
                                                                                                                <label for="email2">FC Date</label>
                                                                                                                <input  type="date" value="<?php echo $_SESSION['FC_date']?>" class="form-control" id="email2" name="FC_date"  >
                                                                                                        </div>
                                                                                                        <div class="form-group col-md-6">
                                                                                                        <label for="email2">Vehicle Stand Name</label>
                                                                                                        <input type="text" class="form-control" value="<?php echo $_SESSION['stand_name']?>" id="email2" name="stand_name"  placeholder="vehicle Stand Name"  >
                                                                                                       
                                                                                                    </div> 
                                                                                                   
                                                                                               </div>
                                                    
                                                    <?php
                                                    } else{
                                                    ?>
                                                    
                                                    <div class="row" style="padding: 15px;background: #faeed9;">
                                                    <div class="form-group col-md-6">    
                                                                                                     <label for="email2">Vehicle Name</label>
                                                                                                        <div id="vt" >
                                                                                                        <select required class="form-control" name="vehicle_type_id" id="Add_vehicle_type"  >
                                                                                                        <option  value="">---Select---</option>
                                                                                                        <?php
                                                                                                          $shop_master_=mysqli_query($config,"select * from vehicle_type where status=1 and sub_category_id='".$_SESSION['Add_sub_category']."'");
                                                                                                          while($sm_=mysqli_fetch_object($shop_master_))
                                                                                                          { 
                                                                                                        ?>
                                                                                                            <option <?php if($sm_->Vehicle_type_id == $_SESSION['vehicle_type_id']) {?>selected="selected"<?php }?> value="<?php echo $sm_->Vehicle_type_id;?>"><?php echo $sm_->Vehicle_type_name;?></option>
                                                                                                        <?php } ?>                                                        
                                                                                                        </select>
                                                                                                        </div>                                         
                                                                                                    </div>
                                                                                                    <div class="form-group col-md-6">
                                                                                                        <label for="email2">Transport Name</label>
                                                                                                        <input type="text" required class="form-control" value="<?php echo $_SESSION['Add_vehicle_name']?>" id="email2" name="Add_vehicle_name"  placeholder="Transport Name"  >
                                                                                                    </div>
                                                    
                                                                                                       <div class="form-group col-md-6">    
                                                                                                           <label for="email2">Vehicle Registration Number</label>
                                                                                                           <input required type="text" class="form-control" value="<?php echo $_SESSION['Add_vehicle_no']?>" id="Add_vehicle_no"  onkeyup="vehicle_uni(this.value);" name="Add_vehicle_no" placeholder="Vehicle Registration Number"  >
                                                                                                           <div style="color: red;font-size: 15px;font-weight: 500;margin-top: 10px;" id="vehicle_like">
                                                                                                             
                                                                                                         </div>
                                                                                                   </div>
                                                                                                   <div class="form-group col-md-6">    
                                                                                                                <label for="email2">RC Owner Name</label>
                                                                                                                <input required type="text" value="<?php echo $_SESSION['Add_RC_owner_name']?>" class="form-control" id="email2" name="Add_RC_owner_name"  >
                                                                                                        </div>
                                                    
                                                                                               <div class="form-group col-md-6">    
                                                                                                           <label for="email2">Specification (Facility)</label>
                                                                                                           <input  required type="text" class="form-control" id="email2" name="space" value="<?php echo $_SESSION['space']?>" placeholder=""  >
                                                                                                   </div>
                                                                                                    <div class="form-group col-md-6" id="vehicle_body_type_container2" style="display: <?php echo (isset($_SESSION['Add_main_cate']) && $_SESSION['Add_main_cate'] == '1') ? 'block' : 'none'; ?>;">    
                                                                                                                <label for="email2">Vehicle Body Type</label>
                                                                                                                <select required class="form-control" name="vehicle_body_type" id="vehicle_body_type2">
                                                                                                                    <option value="">---Select---</option>
                                                                                                                    <option value="Open Body" <?php if(isset($_SESSION['vehicle_body_type']) && $_SESSION['vehicle_body_type'] == 'Open Body') {?>selected="selected"<?php }?>>Open Body</option>
                                                                                                                    <option value="Container Body" <?php if(isset($_SESSION['vehicle_body_type']) && $_SESSION['vehicle_body_type'] == 'Container Body') {?>selected="selected"<?php }?>>Container Body</option>
                                                                                                                </select>
                                                                                                        </div>
                                                                                                  
                                                                                                                                                                                                    
                                                                                                   <div class="form-group col-md-6">    
                                                                                                                <label for="email2"> Current Location Name</label>
                                                                                                                <input  required ="text" value="<?php echo $_SESSION['Add_location']?>" class="form-control" id="email2" name="Add_location" placeholder=""  >
                                                                                                        </div>
                                                    
                                                                                                  
                                                                                                        <div class="form-group col-md-6" style="display:none">    
                                                                                                                <label for="email2">RC Registration Date</label>
                                                                                                                <input  type="date" class="form-control" value="<?php echo $_SESSION['Add_Registration_date']?>" id="email2" name="Add_Registration_date"  >
                                                                                                        </div>
                                                                                                      
                                                                                                        <div class="form-group col-md-6">    
                                                                                                                <label for="email2">Vehicle Insurance Expiry Date</label>
                                                                                                                <input  type="date" class="form-control" value="<?php echo $_SESSION['Add_insurance_exp_date']?>" id="email2" name="Add_insurance_exp_date"  >
                                                                                                        </div>
                                                                                                        <div class="form-group col-md-6" style="display:none">    
                                                                                                                <label for="email2">FC Date</label>
                                                                                                                <input  type="date" value="<?php echo $_SESSION['FC_date']?>" class="form-control" id="email2" name="FC_date"  >
                                                                                                        </div>
                                                                                                        <div class="form-group col-md-6">
                                                                                                        <label for="email2">Vehicle Stand Name</label>
                                                                                                        <input type="text" class="form-control" value="<?php echo $_SESSION['stand_name']?>" id="email2" name="stand_name"  placeholder="vehicle Stand Name"  >
                                                                                                       
                                                                                                    </div>
                                                                                                   
                                                                                               </div>
                                              
  <?php } ?>
                                                
                                            <!-- </div>
                                            <div id="passenger" >  -->
                                            <?php } else if($_SESSION['Add_main_cate'] == '2' ) {?>
                                              <div class="row" style="padding: 15px;background: #faeed9;">


                            <div class="form-group col-md-6">    
                            <label for="email2">Vehicle Name</label>
                                <div id="vt" >
                                <select required class="form-control" name="vehicle_type_id" id="Add_vehicle_type"  >
                                <option  value="">---Select---</option>
                                <?php
                                  $shop_master_=mysqli_query($config,"select * from vehicle_type where status=1 and sub_category_id='".$_SESSION['Add_sub_category']."'");
                                  while($sm_=mysqli_fetch_object($shop_master_))
                                  { 
                                ?>
                                    <option <?php if($sm_->Vehicle_type_id == $_SESSION['vehicle_type_id']) {?>selected="selected"<?php }?> value="<?php echo $sm_->Vehicle_type_id;?>"><?php echo $sm_->Vehicle_type_name;?></option>
                                <?php } ?>                                                        
                                </select>
                                </div>                                         
                            </div>

        <div class="form-group col-md-6">  
        <input class="form-check-input" type="checkbox" value="1" name="day_duty" checked  > Day Duty
        <span style="margin-left:30px"><input class="form-check-input" type="checkbox" value="2"  name="night_duty" <?php if( $_SESSION['night_duty'] == '2'){ ?> checked <?php } ?>> Night Duty</span>
        </div> 
        <div class="form-group col-md-6">
    <label for="email2">Transport Name</label>
    <input type="text" required class="form-control" value="<?php echo $_SESSION['Add_vehicle_name']?>" id="email2" name="Add_vehicle_name"  placeholder="vehicle Name"  >
</div> 
        <div class="form-group col-md-6">    
            <label for="email2">Vehicle Registration Numbe</label>
            <input required type="text" value="<?php echo $_SESSION['Add_vehicle_no']?>" class="form-control" id="Add_vehicle_no"  onkeyup="vehicle_uni(this.value);" name="Add_vehicle_no" placeholder="Vehicle Registration Number"  >
            <div style="color: red;font-size: 15px;font-weight: 500;margin-top: 10px;" id="vehicle_like">
              
          </div>
    </div>
   <div class="form-group col-md-6">    
            <label for="email2">RC Owner Name</label>
            <input required type="text" value="<?php echo $_SESSION['Add_RC_owner_name']?>" class="form-control" id="email2" name="Add_RC_owner_name"  >
    </div>

    <div class="form-group col-md-6">    
                <label for="email2">Seating Capacity</label>
                <input  type="text" value="<?php echo $_SESSION['seating_capacity']?>" class="form-control" id="email2" name="seating_capacity" placeholder="No Of Seating"  >
        </div>

        <!-- <div class="form-group col-md-6">
                <label for="exampleFormControlSelect1">Loading Capacity</label>
                <select  class="form-control" name="Add_load_detail" >
                    <option>---SELECT---</option>
                    <option>Space</option>
                    <option>Size</option>
                    <option>Tonnage</option>                                              
                </select>                                                            
        </div>  -->

        <div class="form-group col-md-6">    
                <label for="email2">Current Location Name</label>
                <input required type="text" value="<?php echo $_SESSION['Add_location']?>" class="form-control" id="email2" name="Add_location" placeholder=""  >
        </div>

    
        <!-- <div class="form-group col-md-6">    
                <label for="email2">RC Registration Date</label>
                <input  type="date" class="form-control" id="email2" name="Add_Registration_date"  >
        </div> -->
    
        <div class="form-group col-md-6">    
                <label for="email2">Vehicle Insurance Expiry Date</label>
                <input  required type="date" value="<?php echo $_SESSION['Add_insurance_exp_date']?>" class="form-control" id="email2" name="Add_insurance_exp_date"  >
        </div>
        <!-- <div class="form-group col-md-6">    
                <label for="email2">FC Date</label>
                <input  type="date" class="form-control" id="email2" name="FC_date"  >
        </div> -->
        <div class="form-group col-md-6">
        <label for="email2">Vehicle Stand Name</label>
        <input required type="text" class="form-control" value="<?php echo $_SESSION['stand_name'] ?>" id="email2" name="stand_name"  placeholder="vehicle Stand Name"  >
    
    </div> 
    </div>
                                            
                                            <!-- </div>
                                            <div id="spot_punjar" > -->
                                               <?php } else if($_SESSION['Add_main_cate'] == '3') { ?>
                                            <div class="row" style="padding: 15px;background: #faeed9;">
                                                <div class="form-group col-md-6">    
                                                 <label for="email2">Vehicle Name</label>
                                                    <div id="vt" >
                                                    <select required class="form-control" name="vehicle_type_id" id="Add_vehicle_type"  >
                                                    <option  value="">---Select---</option>
                                                    <?php
                                                      $shop_master_=mysqli_query($config,"select * from vehicle_type where status=1 and sub_category_id='".$_SESSION['Add_sub_category']."'");
                                                      while($sm_=mysqli_fetch_object($shop_master_))
                                                      { 
                                                    ?>
                                                        <option <?php if($sm_->Vehicle_type_id == $_SESSION['Add_sub_category']) {?>selected="selected"<?php }?> value="<?php echo $sm_->Vehicle_type_id;?>"><?php echo $sm_->Vehicle_type_name;?></option>
                                                    <?php } ?>                                                        
                                                    </select>
                                                    </div>                                         
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="email2">Transport Name</label>
                                                    <input type="text" required class="form-control" id="email2" name="Add_vehicle_name"  value="<?php echo $_SESSION['Add_vehicle_name'];?>" placeholder="vehicle Name"  >
                                                </div> 

                                                <div class="form-group col-md-6">    
                                                            <label for="email2">Vehicle Registration Number</label>
                                                            <input required type="text" value="<?php echo $_SESSION['Add_vehicle_no']?>" class="form-control" id="Add_vehicle_no"  onkeyup="vehicle_uni(this.value);" name="Add_vehicle_no" placeholder="Vehicle Registration Number"  >
                                                            <div style="color: red;font-size: 15px;font-weight: 500;margin-top: 10px;" id="vehicle_like">
                                                              
                                                          </div>
                                                    </div>
                                                   <div class="form-group col-md-6">    
                                                            <label for="email2">RC Owner Name</label>
                                                            <input required type="text" value="<?php echo $_SESSION['Add_RC_owner_name']?>" class="form-control" id="email2" name="Add_RC_owner_name"  >
                                                    </div>

                                                <div class="form-group col-md-6">    
                                                            <label for="email2">Facilities</label>
                                                            <input required type="text" class="form-control" id="email2" name="facilities" value="<?php echo $_SESSION['facilities']?>" placeholder="Facilities"  >
                                                    </div>
                                                
                                                    <!-- <div class="form-group col-md-6">
                                                            <label for="exampleFormControlSelect1">Loading Capacity</label>
                                                            <select  class="form-control" name="Add_load_detail" >
                                                                <option>---SELECT---</option>
                                                                <option>Space</option>
                                                                <option>Size</option>
                                                                <option>Tonnage</option>                                              
                                                            </select>                                                            
                                                    </div>  -->
                                                
                                                    <div class="form-group col-md-6">    
                                                            <label for="email2">Current Location Name</label>
                                                            <input required type="text" class="form-control" id="email2" value="<?php echo $_SESSION['Add_location']?>" name="Add_location" placeholder=""  >
                                                    </div>

                                                   
                                                    <!-- <div class="form-group col-md-6">    
                                                            <label for="email2">RC Registration Date</label>
                                                            <input  type="date" class="form-control" id="email2" name="Add_Registration_date"  >
                                                    </div> -->
                                                  
                                                    <div class="form-group col-md-6">    
                                                            <label for="email2">Vehicle Insurance Expiry Date</label>
                                                            <input  required type="date" class="form-control" id="email2" value="<?php echo $_SESSION['Add_insurance_exp_date']?>" name="Add_insurance_exp_date"  >
                                                    </div>
                                                    <!-- <div class="form-group col-md-6">    
                                                            <label for="email2">FC Date</label>
                                                            <input  type="date" class="form-control" id="email2" name="FC_date"  >
                                                    </div> -->
                                                    <div class="form-group col-md-6">
                                                    <label for="email2">Vehicle Stand Name</label>
                                                    <input required type="text" class="form-control" id="email2" name="stand_name" value="<?php echo $_SESSION['stand_name']?>" placeholder="vehicle Stand Name"  >
                                                   
                                                </div> 
                                                    
                                                </div>
                                                <?php } else if($_SESSION['Add_main_cate'] == '4') {?>

                                                <div class="row" style="padding: 15px;background: #faeed9;">
                                                            <div class="form-group col-md-6">    
                                                                <label for="email2">Current Location Name</label>
                                                                <input required="text" class="form-control" id="email2" value="<?php echo $_SESSION['Add_location']?>" name="Add_location" placeholder="">
                                                            </div>
                                                            <div class="form-group col-md-6">    
                                                                <label for="email2">Shop Name</label>
                                                                <input required type="text" class="form-control"  value="<?php echo $_SESSION['shop_name']?>" id="email2" name="shop_name"  >
                                                            </div>
                                                            <div class="form-group col-md-6">    
                                                                <label for="email2">Shop Address</label>
                                                                <input required type="text" class="form-control" id="email2" value="<?php echo $_SESSION['shop_address']?>" name="shop_address"  >
                                                            </div>

                                                            <div class="form-group col-md-6">    
                                                                <label for="email2">Work Nature</label>
                                                                <input required type="text" class="form-control" id="email2" value="<?php echo $_SESSION['work_nature']?>" name="work_nature"  >
                                                            </div>
                                                                </div>
                                            <?php } else if($_SESSION['Add_main_cate'] == '4') {   ?>
                                              <div class="row" style="padding: 15px;background: #faeed9;">
                                                            <div class="form-group col-md-6">    
                                                                <label for="email2">Current Location Name</label>
                                                                <input required="text" class="form-control" id="email2" value="<?php echo $_SESSION['Add_location']?>" name="Add_location" placeholder="">
                                                            </div>
                                                            <div class="form-group col-md-6">    
                                                                <label for="email2">Shop Name</label>
                                                                <input required type="text" class="form-control"  value="<?php echo $_SESSION['shop_name']?>" id="email2" name="shop_name"  >
                                                            </div>
                                                            <div class="form-group col-md-6">    
                                                                <label for="email2">Shop Address</label>
                                                                <input required type="text" class="form-control" id="email2" value="<?php echo $_SESSION['shop_address']?>" name="shop_address"  >
                                                            </div>

                                                            <div class="form-group col-md-6">    
                                                                <label for="email2">Work Nature</label>
                                                                <input required type="text" class="form-control" id="email2" value="<?php echo $_SESSION['work_nature']?>" name="work_nature"  >
                                                            </div>
                                                                </div>
                                              <?php } ?>

                                            </div>

                                            <div class="row">
                                                
                                            <div class="form-group col-md-6">
    <label for="email2">Photo (Size 250 X 250 px & 2 MB)</label>
    <input required type="file" id="Add_vehicle_photo" class="form-control" name="Add_vehicle_photo" accept=".png, .jpg, .jpeg, .webp">

    <!-- Preview after image select -->
    <div id="imagePreview" style="margin-top:10px;">
        <img id="previewImg" src="#" alt="Preview" style="display:none; max-width:250px; max-height:250px;" class="img-thumbnail"/>
    </div>

    <!-- Existing Image Preview -->
    <?php if (!empty($check123->vehicle_photo)): ?>
        <div style="margin-top:10px;">
            <label>Existing Vehicle Photo:</label><br>
            <img src="../photos/vehicle/<?php echo $check123->vehicle_photo; ?>" 
                 alt="Vehicle Photo" 
                 style="max-width: 250px; max-height: 250px;" 
                 class="img-thumbnail">
        </div>
    <?php endif; ?>

    <!-- Static warning message -->
    <small id="photoWarning" style="color:#333; font-weight:bold;">
        "Please upload vehicle/shop front view Photo only, Do not upload personal photo."
    </small>
</div>
<script>
document.getElementById("Add_vehicle_photo").addEventListener("change", function(event) {
    const file = event.target.files[0];

    if (file) {
        // Check file size (max 2 MB)
        if (file.size > 2 * 1024 * 1024) {
            alert("File size must be less than or equal to 2MB.");
            event.target.value = "";
            document.getElementById("previewImg").style.display = "none";
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            const previewImg = document.getElementById("previewImg");
            previewImg.src = e.target.result;
            previewImg.style.display = "block";
        };
        reader.readAsDataURL(file);
    }
});
</script>


<script>
document.getElementById("Add_vehicle_photo").addEventListener("change", function() {
    var file = this.files[0];
    if (file) {
        var fileType = file.type;
        var validTypes = ["image/png", "image/jpg", "image/jpeg", "image/webp"];
        
        if (!validTypes.includes(fileType)) {
            alert("Invalid file type! Only PNG, JPG, JPEG, and WEBP are allowed.");
            this.value = ""; // Clear the file input
        }
    }
});
</script>

                                              
<div class="form-group col-md-6">
    <label for="email2">Mobile Number</label>
    <input 
        type="text" 
        class="form-control" 
        id="Add_whatsapp_no" 
        name="Add_whatsapp_no" 
        value="<?php echo $_SESSION['Add_whatsapp_no'] ?? ''; ?>"  
        placeholder="Mobile Number" 
        maxlength="10"
        pattern="\d{10}" 
        title="Please enter a 10-digit mobile number"
        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);" 
        required>
</div>

                                                <div class="form-group col-md-6">
    <label for="exampleFormControlSelect1">State</label>
    <select required class="form-control" id="state" name="state" onchange="loadDistricts(this.value)">
        <option value="">---SELECT---</option>
        <?php
        $state_query = mysqli_query($config, "SELECT * FROM dir_state_master");
        while($state = mysqli_fetch_object($state_query)) {
            $selected = ($state->state_id == 24) ? 'selected="selected"' : '';
            echo "<option value='{$state->state_id}' {$selected}>{$state->name}</option>";
        }
        ?>
    </select>
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
                                                            <option <?php if($addsubcate->dir_city_id == $_SESSION['Add_city']) {?>selected="selected"<?php }?> value="<?php echo $addsubcate->dir_city_id ;?>"><?php echo $addsubcate->dir_city_name;?></option>
                                                            <?php } ?>                                                        
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

                                                <!-- <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Area</label>
                                                        <div id="subarea">
                                                          <?php if($_SESSION['Add_sub_area']!='') { ?>

                                                            <select id="" name="Add_sub_area" class="form-select form-control form-select-lg mb-3" aria-label=".form-select-lg example">

                                                                  <?php

                                                                                      $main_cate3_sub=mysqli_query($config,"SELECT * FROM `sub_area_master`  where dirarea_id ='".$_SESSION['Add_area']."' order by (sub_area_name) ASC");

                                                                                      while($macate3_sub=mysqli_fetch_object($main_cate3_sub))

                                                                                      {

                                                                                      ?>
                                                                  <option  <?php if($macate3_sub->sub_area_id == $_SESSION['Add_sub_area']) {?>selected="selected"<?php }?>  value="<?php echo $macate3_sub->sub_area_id ?>"><?php echo $macate3_sub->sub_area_name ?></option>
                                                                  <?php }?>
                                                                  </select> 
                                                           
                                                             <?php }?>
                                                        </div>
                                                </div> -->

                                                
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
                                                            <textarea type="text" class="form-control" id="email2" name="Add_remarks"  ><?php echo $_SESSION['Add_remarks'];?></textarea>
                                                    </div>	
                                                    <div class="form-group col-md-6">    
                                                            <label for="email2">Referred By Mobile No</label>
                                                            <input type="number" value="<?php echo $_SESSION['reffered_by_phone_no'];?>" class="form-control" id="ref_mob" onkeypress="if(this.value.length==10) return false;" name="reffered_by_phone_no"  >
                                                    </div>	
                                                    <div class="form-group col-md-6">    
                                                            <label for="email2">Referred By Name</label>
                                                            <input type="text" value="<?php echo $_SESSION['reffered_by_name'];?>" class="form-control" id="ref_name" name="reffered_by_name"  >
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
                                                      <?php if($_SESSION['Add_package']!='') {?>
                                                    <select required class="form-control" name="Add_package" id="Add_package" onchange="package(this.value);" >
                                                    <option  value="">---Select---</option>
                                                           <?php                                  
                                                          $shop_master_pk=mysqli_query($config,"select * from category_package where Main_Category_id ='".$_SESSION['Add_main_cate']."' and status=1");
                                                          while($sm_pk=mysqli_fetch_object($shop_master_pk))
                                                          { ?>
                                                         <option <?php if($sm_pk->package_id == $_SESSION['Add_package']) {?>selected="selected"<?php }?>   value="<?php echo $sm_pk->package_id ?>"><?php echo $sm_pk->package_title ?></option>
                                                          <?php } ?>
                                              
                                                     </select>
                                                        <?php } ?>
                                                    </div>                                                  
                                                </div>

                                                <div class="form-group col-md-6">                                                      
                                                        <div class="row" id="pkamount">
                                                          <?php if($_SESSION['Add_package']!='') { ?>
                                                        <div class="form-group col-md-6" >
                                                           <label for="email2">Package Expiry Date</label>
                                                        <?php
                                                            $shop_master_amt=mysqli_query($config,"select * from category_package where package_id ='".$_SESSION['Add_package']."' and status=1");
                                                            while($sm_amt=mysqli_fetch_object($shop_master_amt))
                                                            {
                                                                $package_valid = $sm_amt->package_valid;

                                                                date_default_timezone_set('Asia/Kolkata'); 
                                                                $Date = date("Y-m-d");
                                                                $exp_date = date("d-m-Y", strtotime($Date . " +$package_valid days")); 
                                                                ?>

                                                            <input type="text" value="<?php echo $exp_date ?>" class="form-control" id="email2" name="Add_date" placeholder="amount" readonly>
                                                            <?php } ?>

                                                          </div>
                                                         

                                                          <div class="form-group col-md-6" > <label for="email2">Package Amount</label>
                                                                  <?php 
                                                                $shop_master_amount=mysqli_query($config,"select * from category_package where package_id ='".$_SESSION['Add_package']."' and status=1");
                                                                while($sm_amount=mysqli_fetch_object($shop_master_amount))
                                                                { ?>
                                                                <input type="text" value="<?php echo $sm_amount->package_amount ?>" class="form-control" id="Add_amount" name="Add_amount" placeholder="amount" readonly >
                                                                 <?php } ?>                                                    
                                                            </div>
                                                            <?php } ?>

                                                        </div>                                                                                                                                                     
                                                </div>

                                                
                                                    </div>

                                                    <div class="mb-3" style="background:#ffe8ec;padding:9px"> 
  <div class="row"> 

    <!-- Yes/No Checkbox to Show/Hide Coupon Section -->
    <div class="form-group col-md-6">
      <label for="showCoupon">Show Discount Coupon ?</label>
      <select class="form-control" id="showCoupon">
        <option value="yes">Yes</option>
        <option value="no" selected>No</option>
      </select>
    </div> 

    <!-- Coupon Code Section (Initially Hidden) -->
     <div id="couponSection" style="display:none;">
    <div  class="form-group col-md-6" >
      <label for="coupon_code">Coupon Code</label>
      <input style="text-transform:uppercase" type="text" value="<?php echo $_SESSION['coupon_code']?>" class="form-control" id="coupon_code" name="coupon_code" placeholder="">
    </div> 

    <!-- Coupon Check Button (Visible When Coupon Section is Shown) -->
    <div class="form-group col-md-6">
      <a onclick="couponcode();" class="text-white btn btn-primary btn-lg btn-block" id="couponCheckBtn" style="display:none;">Coupon Check</a>
    </div> 

    <!-- Net Amount Section -->
    <div class="form-group col-md-6" id="netamount">
      <!-- Net amount will be dynamically inserted here -->
    </div>

    <div class="form-group col-md-4">
      <div id="coupon_pack">
        <!-- Any additional content related to the coupon can go here -->
      </div> 
    </div>
</div>
  </div> 
</div>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const showCouponSelect = document.getElementById("showCoupon");
    const couponSection = document.getElementById("couponSection");
    const couponCheckBtn = document.getElementById("couponCheckBtn");

    // Restore the last selection from localStorage
    const savedCouponState = localStorage.getItem("showCoupon");
    if (savedCouponState) {
      showCouponSelect.value = savedCouponState;

      if (savedCouponState === "yes") {
        couponSection.style.display = "block";
        couponCheckBtn.style.display = "block";
      } else {
       
        couponSection.style.display = "none";
        couponCheckBtn.style.display = "none";
      }
    }

    // Event listener for selection change
    showCouponSelect.addEventListener("change", function () {
      const selectedValue = this.value;
      localStorage.setItem("showCoupon", selectedValue); // Save to localStorage

      if (selectedValue === "yes") {
        couponSection.style.display = "block";
        couponCheckBtn.style.display = "block";
      } else {
       
        couponSection.style.display = "none";
        couponCheckBtn.style.display = "none";
         setTimeout(function () {
        const selectedPackageId = localStorage.getItem('selected_package_id');

        if (selectedPackageId) {
            $('#Add_package').val(selectedPackageId);
            $('#Add_package').trigger('change');
            package(selectedPackageId); // load related AJAX content
        }
    }, 200);
      }
    });
  });
</script>



                                                   
<div class="form-group col-4">       
                                                            <label>Total Net Amount</label>                                                  
                                                        <input type="text" class="form-control"id="total_net_amount"  name="total_net_amount" readonly>
                                                        </div>
                                                   
                                                        <?php
$query = mysqli_query($config, "SELECT * FROM create_post WHERE customer_id = '$prof_id' AND status = 0 AND delete_approval_status != 1"  );

$post1 = mysqli_fetch_object($query); // Always fetch first row (or false if empty)

if ($post1) {
    if (is_null($post1->utr_number)) {
        // 🔴 No UTR number – show Delete Button
        ?>
        <div id="delete_btn">
            <button class="btn btn-danger" onclick="deletePrevious('<?php echo $prof_id; ?>')">Delete Previous Entry</button>
        </div>
        <?php
    } elseif (!empty($post1->utr_number) && $post1->delete_approval_status == '1') {
        // ✅ UTR is present AND delete is approved – show Submit Button
        ?>
        <div id="post_btn">
            <div class="form-group">                                                         
                <button class="btn btn-success"  id="post_submit"  type="button" name="post_add">Submit</button>
            </div>
        </div>
        <?php
    }
} else {
    // 🤝 No previous post – show Submit Button
    ?>
    <div id="post_btn">
        <div class="form-group">                                                         
            <button class="btn btn-success" id="post_submit" type="button" name="post_add">Submit</button>
        </div>
    </div>
    <?php
}
?>

<?php
if (isset($_GET['msg']) && $_GET['msg'] == '505') {
    echo "<div style='color: green; font-weight: bold;'>✅ Data saved successfully.</div>";
}
?>

 <?php



$query = mysqli_query($config, "SELECT * FROM create_post WHERE customer_id = '$prof_id' AND status = 0  AND  delete_approval_status != 1" );
if (mysqli_num_rows($query) > 0) {
    $post = mysqli_fetch_object($query);
    
    $package_amount = $post->package_amount;
    $net_amount = $post->net_amount;
    $amount = !empty($net_amount) ? $net_amount : $package_amount;
    
?>
<?php if (($post->delete_approval_status) != '1' ) { ?>
<?php if (!empty($post->utr_number)  ) { ?>
    <div class="alert alert-info text-center">
        ✅ Your Scan QR Code  Payment Verification is Under Process.<br>
        <strong>Activaton Status:</strong> <span class="badge bg-warning text-dark">Pending</span><br>
        <strong>Amount:</strong> ₹<?php echo number_format($amount, 2); ?>
        <p>After Activation... Your  Vehicle/Shop Registration Details will be displayed in Driver Menu... "Registered Vehicle/Services List Page"</p>
    </div>
    <?php } else { ?>
<div class="container my-4 p-4 border shadow rounded bg-light">
    <h3 class="text-center mb-4 text-primary">💳 Bank Payment</h3>
    <p class="text-center" style="font-size: 1.1rem;">
<div >
  <strong>Payment Status:</strong> 
  <span style="font-weight: 600; font-size: 0.9rem;" class="badge bg-warning text-dark">Pending</span>
</div>
    <strong>Amount to Pay:</strong> ₹<?php echo number_format($amount, 2); ?>
</p>

<div id="utrSuccess" class="alert alert-success mt-2" style="display: none;"></div>

    <!-- Tab Navs -->
    <ul class="nav nav-tabs mb-3" id="paymentTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="qr-tab" data-toggle="tab" href="#qr" role="tab" aria-controls="qr" aria-selected="true">Scan QR Pay</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="online-tab" data-toggle="tab" href="#online" role="tab" aria-controls="online" aria-selected="false">Online Payment</a>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="paymentTabContent">
        <!-- QR Payment Tab -->
        <div class="tab-pane fade show active" id="qr" role="tabpanel" aria-labelledby="qr-tab">
    <div id="qrForm">
        <input type="hidden" name="post_id" id="post_id" value="<?php echo $post->post_id; ?>">

     

        <div class="form-group">

        <div style="background-color: #fff3cd; color: #856404; padding: 10px; border-left: 5px solid #ffc107; border-radius: 4px; margin-bottom: 10px; font-size: 14px;">
  <strong>Note:</strong> Please make payment using the below Scan QR Code (Download and Scan). After payment, please update the UTR/UPI Transaction Reference Number in the text box below.
</div>

<label>QR Code</label><br>



  <img src="img/qr/qr.jpeg" 
       alt="QR Code" 
       class="img-thumbnail" 
       style="max-width: 150px;">

  <br><br>
  <a href="img/qr/qr.jpeg" download="qr_code.jpg" class="btn btn-success btn-sm">
  <i class="fa fa-download"></i> Download QR
</a>

</div>

<div class="form-group">
            <label for="utr_number">UTR/UPI Payment Reference Number</label>
            <input type="text" name="utr_number" id="utr_number" class="form-control" required>
            <div id="utrError" class="text-danger mt-1" style="display:none;"></div>

        </div>
        <div class="form-group">
    <label for="utr_date">UTR/UPI Payment Date</label>
    <input type="date" name="utr_date" id="utr_date" class="form-control" 
           value="<?php echo date('Y-m-d'); ?>" required>
</div>
        <button type="button" class="btn btn-success" id="submitBtn">Submit</button>
    </div>
</div>



        <!-- Online Payment Tab -->
        <div class="tab-pane fade" id="online" role="tabpanel" aria-labelledby="online-tab">
            <div class="p-3">
                <p class="mb-2">Click the below button  to proceed  the Online Payment by... UPI ID/ Net Banking/ Card Payment/ Wallet Payment</p>
                <a href="razorpay.php?post_id=<?php echo $post->post_id; ?>" class="btn btn-primary">
                    Proceed to Pay Online
                </a>
            </div>
        </div>
    </div>
</div>

<?php
}} }
?>


								
                                
                                
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#ajax-post-form').on('submit', function(e) {
    e.preventDefault(); // Prevent default form submit

    var form = this;
    var formData = new FormData(form);
    formData.append('post_add', '1');

    $.ajax({
      url: 'Add_create_post.php',
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      dataType: 'json', // Expect JSON response
      beforeSend: function() {
        $('#post_submit').prop('disabled', true).text('Submitting...');
      },
      success: function(res) {
        // Simple success handler - no try-catch needed
        if (res.status === 'info') {
          // Success message with SweetAlert
          Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: res.message || 'Please wait... Payment Option Will be open below...',
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false,
            allowOutsideClick: false,
            allowEscapeKey: false
          }).then(function() {
            location.reload();
          });
          
          // Fallback reload after 3 seconds
          setTimeout(function() {
            location.reload();
          }, 3000);
        } else if (res.status === 'error') {
          // Error message
          Swal.fire({
            title: "Error!",
            text: res.message || "An error occurred",
            icon: "error",
            confirmButtonColor: "#dc3545"
          });
        } else {
          // Default success
          Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: res.message || 'Operation completed successfully',
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false
          }).then(function() {
            location.reload();
          });
        }
      },
      error: function(xhr, status, error) {
        // Only handle actual HTTP errors (not successful responses)
        var errorMessage = "An error occurred while processing your request.";
        
        // Try to get error message from response
        if (xhr.responseText) {
          try {
            var errorRes = JSON.parse(xhr.responseText);
            if (errorRes.message) {
              errorMessage = errorRes.message;
            }
          } catch(e) {
            // If not JSON, check HTTP status
            if (xhr.status === 0) {
              errorMessage = "Network error. Please check your connection.";
            } else if (xhr.status >= 500) {
              errorMessage = "Server error. Please try again later.";
            } else if (xhr.status >= 400) {
              errorMessage = "Request error. Please check your input.";
            }
          }
        }
        
        Swal.fire({
          title: "Error!",
          text: errorMessage,
          icon: "error",
          confirmButtonColor: "#dc3545"
        });
        
        // Re-enable button
        $('#post_submit').prop('disabled', false).text('Submit');
      },
      complete: function() {
        // Re-enable button on complete (if not already redirected)
        setTimeout(function() {
          $('#post_submit').prop('disabled', false).text('Submit');
        }, 100);
      }
    });
  });
</script>




<style>

   .slick-slide img {

    display: block;
width: 100%;
    height: 100%;

}

</style>

<script>
$(document).ready(function () {
    $('#submitBtn').on('click', function () {
        var utr = $('#utr_number').val().trim();
        var utr_date = $('#utr_date').val();   // ✅ new field
        var post_id = $('#post_id').val();

        if (utr === "") {
            $('#utrError').text("⚠️ Please enter UTR Number.").show();
            $('#utr_number').focus();
            setTimeout(() => {
                $('#utrError').fadeOut();
            }, 3000);
            return;
        } else {
            $('#utrError').hide(); 
        }

        // AJAX Submit
        $.ajax({
            url: 'submit_qr_utr.php',
            type: 'POST',
            data: {
                utr_number: utr,
                utr_date: utr_date,   // ✅ send utr_date
                post_id: post_id
            },
            success: function (response) {
                $('#utrSuccess').text("✅ UTR submitted successfully. Redirecting...").show();
                setTimeout(function () {
                    location.reload();
                }, 1500);
            },
            error: function () {
                $('#utrError').text("❌ Something went wrong. Please try again.").show();
            }
        });
    });
});
</script>

<script>
function deletePrevious(customerId) {
    if (confirm("Are you sure you want to delete the previous entry?")) {
        // Optional: Clear specific localStorage keys if needed
        localStorage.removeItem('utr_number');
        localStorage.removeItem('qr_image_preview');
        // Clear all localStorage (optional - if you want full clear)
        // localStorage.clear();

        $.ajax({
            url: "delete_create_post_tem.php",
            method: "POST",
            data: { customer_id: customerId },
            success: function(response) {
                alert(response);
                location.reload(); // Reload page after deletion
            },
            error: function() {
                alert("Something went wrong. Please try again.");
            }
        });
    }
}

</script>



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
$(document).ready(function () {
    var vehicleInput = $("#Add_vehicle_no");
    // Run on page load if there is already a value
    if ($.trim(vehicleInput.val()) !== "") {
        vehicle_uni(vehicleInput.val());
    }
});
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
                localStorage.setItem('selected_city', id);

            $.ajax({
                type: "POST",
                url: "area_post.php",
                data:{id:id,kmid:kmid}, 
                success: function(data)
                {
                  
                $('#area').html(data);
                var storedarea= localStorage.getItem('selected_area');
// If a city is stored, set the selected city in the dropdown
if (storedarea) {
    $('#area1').val(storedarea); // Set the city value

    // Optionally, trigger the change event to reload areas for the stored city
    $('#area1').trigger('change');
}
                console.log(data);
                }
            });
            });



           

            function sub_area(id){
                //alert();
                var id =id;
                var kmid =$('#kmid').val();
                localStorage.setItem('selected_area', id);

            $.ajax({
                type: "POST",
                url: "sub_area_post.php",
                data:{id:id,kmid:kmid}, 
                success: function(data)
                {
                  //alert(data);
                $('#subarea').html(data);

                $('.area_s').on('change', function() {
                  var subAreaId = $(this).val(); // Using jQuery to safely get the value of the selected option
    // Store the selected sub-area in localStorage
    localStorage.setItem('selected_sub_area', subAreaId);
});
                var subarea= localStorage.getItem('selected_sub_area');
                if (subarea) {
            // Check if the select element exists inside the #subarea div
            var selectElement = $('#subarea').find('.area_s');

            if (selectElement.length) {
                selectElement.val(subarea); // Set the selected value
                selectElement.trigger('change'); // Optionally trigger the change event
            }
        }
                console.log(data);
                }
            });
            }
           
            function selectVehicleType(element) {
    var selectedVehicleType = element.value;
    localStorage.setItem("selected_vehicle_type", selectedVehicleType);
}

$(document).ready(function () {

// Set value from localStorage if present
const storedWhatsappNumber = localStorage.getItem('whatsapp_number');
if (storedWhatsappNumber) {
    $('#Add_whatsapp_no').val(storedWhatsappNumber);
}

// Save to localStorage on input
$('#Add_whatsapp_no').on('input', function () {
    const whatsappNumber = $(this).val();
    localStorage.setItem('whatsapp_number', whatsappNumber);
});

var storedCity = localStorage.getItem('selected_city');

// If a city is stored, set the selected city in the dropdown
if (storedCity) {
    $('#city').val(storedCity); // Set the city value

    // Optionally, trigger the change event to reload areas for the stored city
    $('#city').trigger('change');
}
var storedarea= localStorage.getItem('selected_area');
// If a city is stored, set the selected city in the dropdown
if (storedarea) {
    $('#area1').val(storedarea); // Set the city value

    // Optionally, trigger the change event to reload areas for the stored city
    $('#area1').trigger('change');
}
const storedRefMob = localStorage.getItem('referred_by_phone_no');
    const storedRefName = localStorage.getItem('referred_by_name');

    if (storedRefMob) {
        $('#ref_mob').val(storedRefMob);
    }

    if (storedRefName) {
        $('#ref_name').val(storedRefName);
    }

    // Save mobile number to localStorage on input
    $('#ref_mob').on('input', function () {
        localStorage.setItem('referred_by_phone_no', $(this).val());
    });

    // Save name to localStorage on input
    $('#ref_name').on('input', function () {
        localStorage.setItem('referred_by_name', $(this).val());
    });

    setTimeout(function () {
        const selectedPackageId = localStorage.getItem('selected_package_id');

        if (selectedPackageId) {
            $('#Add_package').val(selectedPackageId);
            $('#Add_package').trigger('change');
            package(selectedPackageId); // load related AJAX content
        }
    }, 200);
});

            function maincateg(id){
                     var id;
                   //alert(id);
                   localStorage.setItem("selected_main_cate", id);

                    // Show/hide vehicle body type dropdown based on main category
                    if(id == '1') {
                        // Goods Vehicle - show vehicle body type dropdown
                        $('#vehicle_body_type_container').show();
                        $('#vehicle_body_type_container2').show();
                        $('#vehicle_body_type').prop('required', true);
                        $('#vehicle_body_type2').prop('required', true);
                    } else {
                        // Other categories - hide vehicle body type dropdown
                        $('#vehicle_body_type_container').hide();
                        $('#vehicle_body_type_container2').hide();
                        $('#vehicle_body_type').prop('required', false);
                        $('#vehicle_body_type2').prop('required', false);
                        $('#vehicle_body_type').val('');
                        $('#vehicle_body_type2').val('');
                    }

                    $.ajax({
                        type: "POST",
                        url:'main_sub_cate.php',
                        data: {id:id}, // serializes the form's elements.
                        success: function(data)
                        {	
                            // alert(data);		
                        $('#sc').html(data);
                        var storedSubCate = localStorage.getItem("selected_sub_cate");
            if (storedSubCate) {
                document.getElementById('Add_sub_cate_Name').value = storedSubCate;
            }
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
                                  
                                  // Show vehicle body type container for Goods Vehicle (main category = 1)
                                  if(id == '1') {
                                      $('#vehicle_body_type_container').show();
                                      $('#vehicle_body_type').prop('required', true);
                                  }

setTimeout(function () {
    // List of fields to store and retrieve values from localStorage
    const fields = [
        { id: '#Add_vehicle_name', key: 'vehicle_name' },
        { id: '#Add_vehicle_no', key: 'vehicle_no' },
        { id: '#Add_RC_owner_name', key: 'rc_owner_name' },
        { id: '#tonnage', key: 'tonnage' },
        { id: '#Add_location', key: 'location_name' },
        { id: '#Add_insurance_exp_date', key: 'insurance_expiry' },
        { id: '#Add_Registration_date', key: 'Add_Registration_date' },
        { id: '#stand_name', key: 'stand_name' },
        { id: '#vehicle_body_type', key: 'vehicle_body_type' },

        

        
    ];

    // Set up event listeners for each field to store values in localStorage
    fields.forEach(function (field) {
        $(field.id).on('change', function() {
            localStorage.setItem(field.key, $(field.id).val());
        });

        // Retrieve and set stored values from localStorage when the page loads
        const storedValue = localStorage.getItem(field.key);
        if (storedValue) {
            var inputElement = document.getElementById(field.id.replace('#', ''));  // Remove the '#' to get the ID
            if (inputElement) {
                inputElement.value = storedValue; // Set the value of the input field
            } else {
                console.log('Element with ID "' + field.id.replace('#', '') + '" not found');
            }
        } else {
            console.log('No ' + field.key + ' stored in localStorage');
        }
    });
}, 500); // Wait for 500ms to ensure content is loaded

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
                                setTimeout(function () {
    // List of fields to store and retrieve values from localStorage
    const fields = [
        { id: '#Add_vehicle_name', key: 'vehicle_name' },
        { id: '#Add_vehicle_no', key: 'vehicle_no' },
        { id: '#Add_RC_owner_name', key: 'rc_owner_name' },
        { id: '#seating_capacity', key: 'seating_capacity' },
        { id: '#Add_location', key: 'location_name' },
        { id: '#Add_insurance_exp_date', key: 'insurance_expiry' },
        { id: '#Add_Registration_date', key: 'Add_Registration_date' },
        { id: '#stand_name', key: 'stand_name' },

        

        
    ];

    // Set up event listeners for each field to store values in localStorage
    fields.forEach(function (field) {
        $(field.id).on('change', function() {
            localStorage.setItem(field.key, $(field.id).val());
        });

        // Retrieve and set stored values from localStorage when the page loads
        const storedValue = localStorage.getItem(field.key);
        if (storedValue) {
            var inputElement = document.getElementById(field.id.replace('#', ''));  // Remove the '#' to get the ID
            if (inputElement) {
                inputElement.value = storedValue; // Set the value of the input field
            } else {
                console.log('Element with ID "' + field.id.replace('#', '') + '" not found');
            }
        } else {
            console.log('No ' + field.key + ' stored in localStorage');
        }
    });
}, 500);
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
                                setTimeout(function () {
    // List of fields to store and retrieve values from localStorage
    const fields = [
        { id: '#Add_vehicle_name', key: 'vehicle_name' },
        { id: '#Add_vehicle_no', key: 'vehicle_no' },
        { id: '#Add_RC_owner_name', key: 'rc_owner_name' },
        { id: '#facilities', key: 'facilities' },
        { id: '#Add_location', key: 'location_name' },
        { id: '#Add_insurance_exp_date', key: 'insurance_expiry' },
        { id: '#Add_Registration_date', key: 'Add_Registration_date' },
        { id: '#stand_name', key: 'stand_name' },

        

        
    ];

    // Set up event listeners for each field to store values in localStorage
    fields.forEach(function (field) {
        $(field.id).on('change', function() {
            localStorage.setItem(field.key, $(field.id).val());
        });

        // Retrieve and set stored values from localStorage when the page loads
        const storedValue = localStorage.getItem(field.key);
        if (storedValue) {
            var inputElement = document.getElementById(field.id.replace('#', ''));  // Remove the '#' to get the ID
            if (inputElement) {
                inputElement.value = storedValue; // Set the value of the input field
            } else {
                console.log('Element with ID "' + field.id.replace('#', '') + '" not found');
            }
        } else {
            console.log('No ' + field.key + ' stored in localStorage');
        }
    });
}, 500);
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
                                setTimeout(function () {
    // List of fields to store and retrieve values from localStorage
    const fields = [
        
        { id: '#Add_location', key: 'location_name' },
        { id: '#shop_name', key: 'shop_name' },
        { id: '#shop_address', key: 'shop_address' },
        { id: '#work_nature', key: 'work_nature' },

        

        
    ];

    // Set up event listeners for each field to store values in localStorage
    fields.forEach(function (field) {
        $(field.id).on('change', function() {
            localStorage.setItem(field.key, $(field.id).val());
        });

        // Retrieve and set stored values from localStorage when the page loads
        const storedValue = localStorage.getItem(field.key);
        if (storedValue) {
            var inputElement = document.getElementById(field.id.replace('#', ''));  // Remove the '#' to get the ID
            if (inputElement) {
                inputElement.value = storedValue; // Set the value of the input field
            } else {
                console.log('Element with ID "' + field.id.replace('#', '') + '" not found');
            }
        } else {
            console.log('No ' + field.key + ' stored in localStorage');
        }
    });
}, 500);
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
                                setTimeout(function () {
    // List of fields to store and retrieve values from localStorage
    const fields = [
        
        { id: '#Add_location', key: 'location_name' },
        { id: '#shop_name', key: 'shop_name' },
        { id: '#shop_address', key: 'shop_address' },
        { id: '#work_nature', key: 'work_nature' },

        

        
    ];

    // Set up event listeners for each field to store values in localStorage
    fields.forEach(function (field) {
        $(field.id).on('change', function() {
            localStorage.setItem(field.key, $(field.id).val());
        });

        // Retrieve and set stored values from localStorage when the page loads
        const storedValue = localStorage.getItem(field.key);
        if (storedValue) {
            var inputElement = document.getElementById(field.id.replace('#', ''));  // Remove the '#' to get the ID
            if (inputElement) {
                inputElement.value = storedValue; // Set the value of the input field
            } else {
                console.log('Element with ID "' + field.id.replace('#', '') + '" not found');
            }
        } else {
            console.log('No ' + field.key + ' stored in localStorage');
        }
    });
}, 500);
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
                                setTimeout(function () {
    // List of fields to store and retrieve values from localStorage
    const fields = [
        { id: '#Add_vehicle_name', key: 'vehicle_name' },
        { id: '#Add_vehicle_no', key: 'vehicle_no' },
        { id: '#Add_RC_owner_name', key: 'rc_owner_name' },
        { id: '#space', key: 'space' },
        { id: '#Add_location', key: 'location_name' },
        { id: '#Add_insurance_exp_date', key: 'insurance_expiry' },
        { id: '#Add_Registration_date', key: 'Add_Registration_date' },
        { id: '#stand_name', key: 'stand_name' },

        

        
    ];

    // Set up event listeners for each field to store values in localStorage
    fields.forEach(function (field) {
        $(field.id).on('change', function() {
            localStorage.setItem(field.key, $(field.id).val());
        });

        // Retrieve and set stored values from localStorage when the page loads
        const storedValue = localStorage.getItem(field.key);
        if (storedValue) {
            var inputElement = document.getElementById(field.id.replace('#', ''));  // Remove the '#' to get the ID
            if (inputElement) {
                inputElement.value = storedValue; // Set the value of the input field
            } else {
                console.log('Element with ID "' + field.id.replace('#', '') + '" not found');
            }
        } else {
            console.log('No ' + field.key + ' stored in localStorage');
        }
    });
}, 500);
           
                                }			
                            });	
                          }
                          else
                          {
                            $('#commercial').hide();
                          }
                       


                } 
                
// On page load, retrieve the selected value from localStorage and set the dropdown value
document.addEventListener('DOMContentLoaded', function() {
  // Retrieve the value from localStorage
  var vehicleInput = document.getElementById('cle_name');
  console.log('Add_vehicle_name exists: ', $('#Add_vehicle_name').length);

    if (vehicleInput) {
        // Element is present
        console.log('Element Add_vehicle_name is present');
    } else {
        // Element is not present
        console.log('Element Add_vehicle_name is NOT present');
    }

    var storedValue = localStorage.getItem("selected_main_cate");

    // If the value exists, set the selected value in the dropdown
    if (storedValue) {
        document.getElementById('mainCategorySelect').value = storedValue;

        // Optionally, trigger the onchange event to load related data
        maincateg(storedValue);
    }

    var storedSubCate = localStorage.getItem("selected_sub_cate");
   

    var storedVehicleType = localStorage.getItem("selected_vehicle_type");
var vehicleTypeDropdown = document.getElementById('Add_vehicle_type');

if (storedVehicleType) {
    var id = storedSubCate;
    $.ajax({
        type: "POST",
        url: 'vehicle_type.php',
        data: { id: id }, // serializes the form's elements.
        success: function(data) {
            // Populate the dropdown with the received data
            $('#vt').html(data);
            
            // Append the "Other" text field inside the #vt div
            $('#vt').append(`
                <div id="other_vehicle_type_field" style="display:none;">
                    <label for="other_vehicle_type">Please Enter vehicle Modal Name</label>
                    <input type="text" id="other_vehicle_type" name="other_vehicle_type" class="form-control" />
                </div>
            `);
            
            // Retrieve the stored vehicle type value and set it
            var storedVehicleType = localStorage.getItem("selected_vehicle_type");

            
            if (storedVehicleType) {
                document.getElementById('Add_vehicle_type').value = storedVehicleType;
                
                // Check if "Others" was selected and show the text field
                if (storedVehicleType == "0") {
                    $('#other_vehicle_type_field').show(); // Show the text field for "Others"
                } else {
                    $('#other_vehicle_type_field').hide(); // Hide the text field if another option is selected
                }
            }
        }
    });
}

document.addEventListener("DOMContentLoaded", function () {
    const vehicleTypeDropdown = document.getElementById("vehicleTypeDropdown"); // Make sure ID is correct

    if (vehicleTypeDropdown) {
        vehicleTypeDropdown.addEventListener("change", function () {
            if (vehicleTypeDropdown.value == "0") {
                $('#other_vehicle_type_field').show();
            } else {
                $('#other_vehicle_type_field').hide();
            }
        });
    } else {
        console.warn("❌ vehicleTypeDropdown element not found in DOM.");
    }
});


     
    




      });

         
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
// Function to store the selected vehicle type in localStorage




                function subcateg(id){
                    var id;     
                    localStorage.setItem("selected_sub_cate", id);
              
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
                             //alert(data);		
                        $('#vt').html(data);
                        $('#vt').append(`
                <div id="other_vehicle_type_field" style="display:none;">
                    <label for="other_vehicle_type">Please Enter vehicle Modal Name</label>
                    <input type="text" id="other_vehicle_type" name="other_vehicle_type" class="form-control" />
                </div>
            `);
            var vehicleTypeDropdown = document.getElementById('Add_vehicle_type');

            vehicleTypeDropdown.addEventListener('change', function() {
    if (vehicleTypeDropdown.value == "0") {
        // Show the text field when "Others" is selected
        $('#other_vehicle_type_field').show();
    } else {
        // Hide the text field when another option is selected
        $('#other_vehicle_type_field').hide();
    }});
                         // Retrieve the stored vehicle type value and set it
            var storedVehicleType = localStorage.getItem("selected_vehicle_type");
            if (storedVehicleType) {
               
                document.getElementById('Add_vehicle_type').value = storedVehicleType;
            }
                        }			
                    });	


                      } 

                     

                      function couponcode(){
                        var coupon_code = $('#coupon_code').val();  
                        var pack_id = $('#pack_id').val();
                        var Add_amount = $('#Add_amount').val();
                        var Add_driver_name = $('#Add_driver_name').val();
                        var cus_id = <?php echo $session_id?>
                      // alert(coupon_code);
                      //   alert(pack_id);
                      //   alert(Add_amount);
                      //   alert(Add_driver_name);
                  
                 // alert(Add_amount);
                        $.ajax({
                            type: "POST",
                            url:'coupon_check.php',
                            data: {pack_id:pack_id,coupon_code:coupon_code,Add_amount:Add_amount,Add_driver_name:Add_driver_name,cus_id:cus_id}, // serializes the form's elements.
                            success: function(data)
                            {	
                              console.log(data);
                            // alert(data);		
                            $('#netamount').html(data);
                            setTimeout(function() {
        var netVal = $('#net_amount').val(); // get value from the new input

        if (netVal) {
            $('#total_net_amount').val(netVal); // set it to Add_amount
           
        } 
    }, 50);
                            }			
                         });	

                      }

                     

                      function package(id){
                    var id;     
                    localStorage.setItem('selected_package_id', id);
              
                     // alert(id);
                    $.ajax({
                        type: "POST",
                        url:'package_amount.php',
                        data: {id:id}, // serializes the form's elements.
                        success: function(data)
                        {	
                        // alert(data);		
                        $('#pkamount').html(data);
                        setTimeout(function() {
        var netVal = $('#Add_amount').val(); // get value from the new input

        if (netVal) {
            $('#total_net_amount').val(netVal); // set it to Add_amount
           
        } 
    }, 50);
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

<script>
document.addEventListener("DOMContentLoaded", function () {
    const couponInput = document.getElementById("coupon_code");
    const savedCouponCode = localStorage.getItem("couponCode");
const savedCouponState = localStorage.getItem("showCoupon");
 if (savedCouponState === "yes") {
    if (savedCouponCode ) {
        couponInput.value = savedCouponCode;

        // Wait until package dropdown and values are populated (due to async loading)
        setTimeout(function () {
            // Optional: ensure values exist before calling
            const pack_id = $('#pack_id').val();
            const Add_amount = $('#Add_amount').val();

            if (pack_id && Add_amount) {
                couponcode(); // Call only if values are ready
            } else {
                console.warn("pack_id or Add_amount not ready yet");
            }
        }, 800); // Adjust delay based on your AJAX response time
    }
 }
    // Save coupon code as user types
    $('#coupon_code').on('input', function () {
        localStorage.setItem("couponCode", $(this).val().trim().toUpperCase());
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
function loadDistricts(stateId) {
  localStorage.setItem('stateId', stateId); // Save the mobile number in localStorage
  
  $("#area1").html('<option value="">---SELECT---</option>');

    if(stateId) {
        $.ajax({
            type: "POST",
            url: "fetch_districts.php",
            data: { state_id: stateId },
            success: function(response) {
                $("#city").html(response);
            }
        });
    } else {
        $("#city").html('<option value="">---SELECT---</option>');
    }
}



</script>