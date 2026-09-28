<?php include('../config/setup.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
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
            
            ?> </title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="<?php 
            
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
            
            ?>" type="image/x-icon"/>
	
	<!-- Fonts and icons -->
	<script src="../assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/atlantis.min.css">
	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="../assets/css/demo.css">
</head>
<body>
	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
		 <?php include('logo.php');?>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<?php include('topbar.php');?>
			 <!-- End Navbar -->
		</div>
		<!-- Sidebar -->
		<?php include('sidebar.php');?>
		
		
		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Create Registration</h4>
						 
					</div>
					<?php
                    $pid=$_REQUEST['pid'];
// echo $query="select * from create_post where post_id='$pid'";
                    $main_cate=mysqli_query($config,"select * from create_post where post_id='$pid'");
											$data=mysqli_fetch_object($main_cate);
                                             ?>
							<div class="card">
                            <form action="Function/Edit_create_post.php" method="post" enctype="multipart/form-data">
                          
									<div class="card-body">
                                     <div class="row">
                                     <div class="form-group col-md-6">    
                                                    <label for="email2">Customer Name</label>
                                                    <input type="text" class="form-control" id="Add_driver_name" value="<?php echo $data->driver_name ?>" onkeyup="cum(this.value)" name="Add_driver_name" required >
                                                    <div id="serach_result">
                                                        <ul class="subnav sug-list-color" id="serach_result1">
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">    
                                                    <label for="email2">Customer Phone No</label>
                                                    <input type="hidden" class="form-control" value="<?php echo $_GET['expired'] ?  $_GET['expired'] : '' ;?>"  name="expired" id="expired"
                                                    placeholder="">
                                                    <input type="hidden" class="form-control" value="<?php echo $data->customer_id ?>"  name="customerid" id="customerid"
                                                    placeholder="">
                                                    <input type="number" class="form-control" id="phone_no" value="<?php echo $data->phone_no ?>"   name="Add_phone_no" onkeypress="if(this.value.length==10) return false;" required >
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleFormControlSelect1">Main Category</label> 
                                                    <select required class="form-control" name="Add_main_cate" onchange="maincateg(this.value);">
                                                        <option value="">---SELECT---</option>
                                                    <?php
                                                    $main_cate=mysqli_query($config,"select * from main_category");
                                                    while($addsubcate=mysqli_fetch_object($main_cate))
                                                    {  
                                                    ?>
                                                        <option <?php if($addsubcate->Main_Category_id == $data->category_id) {?>selected="selected"<?php }?> value="<?php echo $addsubcate->Main_Category_id;?>"><?php echo $addsubcate->Main_Category_Name;?></option>
                                                    <?php } ?>                                                        
                                                    </select>
                                                     
                                                </div> 
                                                    
                                                <div class="form-group col-md-6">    
                                                 <label for="email2">Sub Category Name</label>
                                                    <div id="sc">
                                                    <select required class="form-control" onchange="subcateg(this.value);" name="Add_sub_category" id="Add_sub_cate_Name"  >
                                                    <option  value="">---Select---</option>
                                                    <?php
                                                      $shop_master_=mysqli_query($config,"select * from sub_category where Sub_Category_Status=1");
                                                      while($sm_=mysqli_fetch_object($shop_master_))
                                                      { 
                                                    ?>
                                                        <option <?php if($sm_->Sub_Category_id == $data->subcategory_id) {?>selected="selected"<?php }?> value="<?php echo $sm_->Sub_Category_id;?>"><?php echo $sm_->Sub_Category_Name;?></option>
                                                    <?php } ?>                                                        
                                                    </select>
                                                    </div>
                                                    <div id="filter" >

                                                    </div>                                         
                                                </div>

                                               
                                               

                                                </div>
                                                <!-- <div class="mb-3" style="background:#ffe8ec;padding:9px"> 
                                                      <div class="row">                                        
                                                        <div class="form-group col-md-6">
                                                            <label for="email2">Coupon Code</label>
                                                            <input style="text-transform:uppercase" type="text" class="form-control" id="coupon_code" name="coupon_code"  placeholder=""  >
                                                        </div> 
                                                        <div class="form-group col-md-6">                                      
                                                            <a onclick="couponcode();"  class="text-white btn btn-primary btn-lg btn-block">Coupon Check</a>
                                                        </div> 
                                                                                                                
                                                            <div class="form-group col-md-12" >
                                                                <div class="row" id="netamount" style="padding:9px">

                                                                </div>
                                                       // <input type="text" class="form-control" id="email2" name="net_amount"  placeholder=""  readonly>
                                                            </div>
                                                           
                                                        </div> 
                                                        <div class="form-group col-md-4">
                                                           <div id="coupon_pack">

                                                            </div>                                                            
                                                        </div> 
                                                      </div>                                           -->
                                                  
                                                   <div class="row">
                                                
                                                
                                               
                                              
                                            
                                            </div>                                          
                                            <div id="commercial" >
                                                <?php if($data->category_id == '1' ) { 
                                                    

                                                    
if($data->subcategory_id >= 1 && $data->subcategory_id <=4)
{
    ?>
    
<div class="row" style="padding: 15px;background: #faeed9;">
<div class="form-group col-md-6">    
                                                 <label for="email2">Vehicle Model Name</label>
                                                 <div id="vt">
    <select required class="form-control" name="vehicle_type_id" id="Add_vehicle_type">
        <option value="">---Select---</option>
        <?php
        $shop_master_ = mysqli_query($config, "SELECT * FROM vehicle_type WHERE status = 1 AND sub_category_id = '$data->subcategory_id'");
        while ($sm_ = mysqli_fetch_object($shop_master_)) { 
        ?>
            <option value="<?php echo $sm_->Vehicle_type_id; ?>" 
                <?php if ($sm_->Vehicle_type_id == $data->vehicle_type_id) { echo 'selected="selected"'; } ?>>
                <?php echo $sm_->Vehicle_type_name; ?>
            </option>
        <?php } ?>
        <option value="0" <?php if ($data->vehicle_type_id == "0") { echo 'selected="selected"'; } ?>>Others</option>
    </select>
</div>

<!-- Hidden input field for "Others" -->
<div id="other_vehicle_type_field" style="<?php echo ($data->vehicle_type_id == "0") ? 'display:block;' : 'display:none;'; ?>">
    <label for="other_vehicle_type">Please Enter Vehicle Model Name</label>
    <input type="text" id="other_vehicle_type" name="other_vehicle_type" class="form-control" 
           value="<?php echo isset($data->other_vehicle_type) ? $data->other_vehicle_type : ''; ?>" />
</div>

                                        
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="email2">Vehicle Name</label>
                                                    <input type="text" required class="form-control" value="<?php echo $data->vehicle_name?>" id="email2" name="Add_vehicle_name"  placeholder="vehicle Name"  >
                                                </div>

                                                <div class="form-group col-md-6" id="vehicle_body_type_container" style="display: <?php echo ($data->category_id == '1') ? 'block' : 'none'; ?>;">
                                                    <label for="vehicle_body_type">Vehicle Body Type</label>
                                                    <select required class="form-control" name="vehicle_body_type" id="vehicle_body_type">
                                                        <option value="">---Select---</option>
                                                        <option value="Open Body" <?php if(isset($data->vehicle_body_type) && $data->vehicle_body_type == 'Open Body') {?>selected="selected"<?php }?>>Open Body</option>
                                                        <option value="Container Body" <?php if(isset($data->vehicle_body_type) && $data->vehicle_body_type == 'Container Body') {?>selected="selected"<?php }?>>Container Body</option>
                                                    </select>
                                                </div>

                                                   <div class="form-group col-md-6">    
                                                       <label for="email2">Vehicle Registration Number</label>
                                                       <input required type="text" class="form-control" id="email2" value="<?php echo $data->vehicle_no?>"  onkeyup="vehicle_uni(this.value);" name="Add_vehicle_no" placeholder="Vehicle Registration Number"  >
                                                       <div style="color: red;font-size: 15px;font-weight: 500;margin-top: 10px;" id="vehicle_like">
                                                         
                                                     </div>
                                               </div>
                                               <div class="form-group col-md-6">    
                                                            <label for="email2">RC Owner Name</label>
                                                            <input required type="text" value="<?php echo $data->Add_RC_owner_name?>" class="form-control" id="email2" name="Add_RC_owner_name"  >
                                                    </div>

                                           <div class="form-group col-md-6" style="display:none">    
                                                       <label for="email2">Space</label>
                                                       <input  type="text" class="form-control" id="email2" name="space" placeholder="Ex: 10x20feet"  >
                                               </div>
                                               <div class="form-group col-md-6" style="display:none">    
                                                       <label for="email2">Size</label>
                                                       <input  type="text" class="form-control" id="email2" name="size" placeholder="Ex: 500Sqft"  >
                                               </div>

                                               <div class="form-group col-md-6">    
                                                            <label for="email2">Tonnage</label>
                                                            <input required type="text" value="<?php echo $data->tonnage?>" class="form-control" id="email2" name="tonnage" placeholder="Ex: 5 Ton"  >
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
                                                            <label for="email2">Vehicle Active Current Location</label>
                                                            <input  required ="text" value="<?php echo $data->Add_location?>" class="form-control" id="email2" name="Add_location" placeholder=""  >
                                                    </div>

                                              
                                                    <div class="form-group col-md-6" style="display:none">    
                                                            <label for="email2">RC Registration Date</label>
                                                            <input  type="date" class="form-control" value="<?php echo $data->Add_Registration_date?>" id="email2" name="Add_Registration_date"  >
                                                    </div>
                                                  
                                                    <div class="form-group col-md-6">    
                                                            <label for="email2">Vehicle Insurance Expiry Date</label>
                                                            <input  type="date" class="form-control" value="<?php echo $data->Add_insurance_exp_date?>" id="email2" name="Add_insurance_exp_date"  >
                                                    </div>
                                                    <div class="form-group col-md-6" style="display:none">    
                                                            <label for="email2">FC Date</label>
                                                            <input  type="date" value="<?php echo $data->FC_date?>" class="form-control" id="email2" name="FC_date"  >
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                    <label for="email2">Vehicle Stand Name</label>
                                                    <input type="text" class="form-control" value="<?php echo $data->stand_name?>" id="email2" name="stand_name"  placeholder="vehicle Stand Name"  >
                                                   
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
                                                      $shop_master_=mysqli_query($config,"select * from vehicle_type where status=1 and sub_category_id='$data->subcategory_id'");
                                                      while($sm_=mysqli_fetch_object($shop_master_))
                                                      { 
                                                    ?>
                                                        <option <?php if($sm_->Vehicle_type_id == $data->vehicle_type_id) {?>selected="selected"<?php }?> value="<?php echo $sm_->Vehicle_type_id;?>"><?php echo $sm_->Vehicle_type_name;?></option>
                                                    <?php } ?>                                                        
                                                    </select>
                                                    </div>                                         
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="email2">Transport Name</label>
                                                    <input type="text" required class="form-control" value="<?php echo $data->vehicle_name?>" id="email2" name="Add_vehicle_name"  placeholder="Transport Name"  >
                                                </div>

                                                <div class="form-group col-md-6" id="vehicle_body_type_container2" style="display: <?php echo ($data->category_id == '1') ? 'block' : 'none'; ?>;">
                                                    <label for="vehicle_body_type2">Vehicle Body Type</label>
                                                    <select required class="form-control" name="vehicle_body_type" id="vehicle_body_type2">
                                                        <option value="">---Select---</option>
                                                        <option value="Open Body" <?php if(isset($data->vehicle_body_type) && $data->vehicle_body_type == 'Open Body') {?>selected="selected"<?php }?>>Open Body</option>
                                                        <option value="Container Body" <?php if(isset($data->vehicle_body_type) && $data->vehicle_body_type == 'Container Body') {?>selected="selected"<?php }?>>Container Body</option>
                                                    </select>
                                                </div>

                                                   <div class="form-group col-md-6">    
                                                       <label for="email2">Vehicle Registration Number</label>
                                                       <input required type="text" class="form-control" value="<?php echo $data->vehicle_no?>" id="Add_vehicle_no"  onkeyup="vehicle_uni(this.value);" name="Add_vehicle_no" placeholder="Vehicle Registration Number"  >
                                                       <div style="color: red;font-size: 15px;font-weight: 500;margin-top: 10px;" id="vehicle_like">
                                                         
                                                     </div>
                                               </div>
                                               <div class="form-group col-md-6">    
                                                            <label for="email2">RC Owner Name</label>
                                                            <input required type="text" value="<?php echo $data->Add_RC_owner_name?>" class="form-control" id="email2" name="Add_RC_owner_name"  >
                                                    </div>

                                           <div class="form-group col-md-6">    
                                                       <label for="email2">Specification (Facility)</label>
                                                       <input  required type="text" class="form-control" id="email2" name="space" value="<?php echo $data->space?>" placeholder=""  >
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
                                                            <label for="email2">Vehicle Active Current Location</label>
                                                            <input  required ="text" value="<?php echo $data->Add_location?>" class="form-control" id="email2" name="Add_location" placeholder=""  >
                                                    </div>

                                              
                                                    <div class="form-group col-md-6" style="display:none">    
                                                            <label for="email2">RC Registration Date</label>
                                                            <input  type="date" class="form-control" value="<?php echo $data->Add_Registration_date?>" id="email2" name="Add_Registration_date"  >
                                                    </div>
                                                  
                                                    <div class="form-group col-md-6">    
                                                            <label for="email2">Vehicle Insurance Expiry Date</label>
                                                            <input  type="date" class="form-control" value="<?php echo $data->Add_insurance_exp_date?>" id="email2" name="Add_insurance_exp_date"  >
                                                    </div>
                                                    <div class="form-group col-md-6" style="display:none">    
                                                            <label for="email2">FC Date</label>
                                                            <input  type="date" value="<?php echo $data->FC_date?>" class="form-control" id="email2" name="FC_date"  >
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                    <label for="email2">Vehicle Stand Name</label>
                                                    <input type="text" class="form-control" value="<?php echo $data->stand_name?>" id="email2" name="stand_name"  placeholder="vehicle Stand Name"  >
                                                   
                                                </div>
                                               
                                           </div>
<?php } ?>



<!-- 
                                            <div class="row" style="padding: 15px;background: #faeed9;">
                                                <div class="form-group col-md-6">    
                                                 <label for="email2">Vehicle Type</label>
                                                    <div id="vt" >
                                                    <select required class="form-control" name="vehicle_type_id" id="Add_vehicle_type"  >
                                                    <option  value="">---Select---</option>
                                                    <?php
                                                      $shop_master_=mysqli_query($config,"select * from vehicle_type where status=1 and sub_category_id='$data->subcategory_id'");
                                                      while($sm_=mysqli_fetch_object($shop_master_))
                                                      { 
                                                    ?>
                                                        <option <?php if($sm_->Vehicle_type_id == $data->vehicle_type_id) {?>selected="selected"<?php }?> value="<?php echo $sm_->Vehicle_type_id;?>"><?php echo $sm_->Vehicle_type_name;?></option>
                                                    <?php } ?>                                                        
                                                    </select>
                                                    </div>                                         
                                                </div>
                                                
                                                <div class="form-group col-md-6">
                                                    <label for="email2">Vehicle Name</label>
                                                    <input type="text" required class="form-control" value="<?php echo $data->vehicle_name?>" id="email2" name="Add_vehicle_name"  placeholder="vehicle Name"  >
                                                </div> 
                                                        <div class="form-group col-md-6">    
                                                            <label for="email2">Vehicle Registration Number</label>
                                                            <input required type="text" value="<?php echo $data->vehicle_no?>" class="form-control" id="Add_vehicle_no"  onkeyup="vehicle_uni(this.value);" name="Add_vehicle_no" placeholder="Vehicle Registration Number"  >
                                                            <div style="color: red;font-size: 15px;font-weight: 500;margin-top: 10px;" id="vehicle_like">
                                                              
                                                          </div>
                                                    </div>
                                                   <div class="form-group col-md-6">    
                                                            <label for="email2">RC Owner Name</label>
                                                            <input required type="text" value="<?php echo $data->Add_RC_owner_name?>" class="form-control" id="email2" name="Add_RC_owner_name"  >
                                                    </div>

                                                <div class="form-group col-md-6" style="display:none" >    
                                                            <label for="email2">Space</label>
                                                            <input  type="text" class="form-control" id="email2" name="space" placeholder="Ex: 10x20feet"  >
                                                    </div>
                                                    <div class="form-group col-md-6" style="display:none" >    
                                                            <label for="email2">Size</label>
                                                            <input  type="text" class="form-control" id="email2" name="size" placeholder="Ex: 500Sqft"  >
                                                    </div>

                                                    <div class="form-group col-md-6">    
                                                            <label for="email2">Tonnage</label>
                                                            <input required type="text" value="<?php echo $data->tonnage?>" class="form-control" id="email2" name="tonnage" placeholder="Ex: 5 Ton"  >
                                                    </div>
                                                
                                                    <div class="form-group col-md-6">    
                                                            <label for="email2">Vehicle Active Current Location</label>
                                                            <input  required ="text" value="<?php echo $data->Add_location?>" class="form-control" id="email2" name="Add_location" placeholder=""  >
                                                    </div>

                                                   
                                                    <div class="form-group col-md-6" style="display:none">    
                                                            <label for="email2">RC Registration Date</label>
                                                            <input  type="date" class="form-control" value="<?php echo $data->Add_Registration_date?>" id="email2" name="Add_Registration_date"  >
                                                    </div>
                                                  
                                                    <div class="form-group col-md-6">    
                                                            <label for="email2">Vehicle Insurance Expiry Date</label>
                                                            <input  type="date" class="form-control" value="<?php echo $data->Add_insurance_exp_date?>" id="email2" name="Add_insurance_exp_date"  >
                                                    </div>
                                                    <div class="form-group col-md-6" style="display:none">    
                                                            <label for="email2">FC Date</label>
                                                            <input  type="date" value="<?php echo $data->FC_date?>" class="form-control" id="email2" name="FC_date"  >
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                    <label for="email2">Vehicle Stand Name</label>
                                                    <input type="text" class="form-control" value="<?php echo $data->stand_name?>" id="email2" name="stand_name"  placeholder="vehicle Stand Name"  >
                                                   
                                                </div>
                                                </div> -->
                                               <?php } else if($data->category_id == '2' ) {?>
                                                <div class="row" style="padding: 15px;background: #faeed9;">


                                                <div class="form-group col-md-6">    
                                                 <label for="email2">Vehicle Name</label>
                                                    <div id="vt" >
                                                    <select required class="form-control" name="vehicle_type_id" id="Add_vehicle_type"  >
                                                    <option  value="">---Select---</option>
                                                    <?php
                                                      $shop_master_=mysqli_query($config,"select * from vehicle_type where status=1 and sub_category_id='$data->subcategory_id'");
                                                      while($sm_=mysqli_fetch_object($shop_master_))
                                                      { 
                                                    ?>
                                                        <option <?php if($sm_->Vehicle_type_id == $data->vehicle_type_id) {?>selected="selected"<?php }?> value="<?php echo $sm_->Vehicle_type_id;?>"><?php echo $sm_->Vehicle_type_name;?></option>
                                                    <?php } ?>                                                        
                                                    </select>
                                                    </div>                                         
                                                </div>

                                                        <div class="form-group col-md-6">  
                                                        <input class="form-check-input" type="checkbox" value="1" name="day_duty" checked  > Day Duty
                                                        <span style="margin-left:30px"><input class="form-check-input" type="checkbox" value="2"  name="night_duty" <?php if( $data->night_duty == '2'){ ?> checked <?php } ?>> Night Duty</span>
                                                        </div> 
                                                        <div class="form-group col-md-6">
                                                    <label for="email2">Transport Name</label>
                                                    <input type="text" required class="form-control" value="<?php echo $data->vehicle_name?>" id="email2" name="Add_vehicle_name"  placeholder="vehicle Name"  >
                                                </div> 
                                                        <div class="form-group col-md-6">    
                                                            <label for="email2">Vehicle Registration Number</label>
                                                            <input required type="text" value="<?php echo $data->vehicle_no?>" class="form-control" id="Add_vehicle_no"  onkeyup="vehicle_uni(this.value);" name="Add_vehicle_no" placeholder="Vehicle Registration Number"  >
                                                            <div style="color: red;font-size: 15px;font-weight: 500;margin-top: 10px;" id="vehicle_like">
                                                              
                                                          </div>
                                                    </div>
                                                   <div class="form-group col-md-6">    
                                                            <label for="email2">RC Owner Name</label>
                                                            <input required type="text" value="<?php echo $data->Add_RC_owner_name?>" class="form-control" id="email2" name="Add_RC_owner_name"  >
                                                    </div>

                                                    <div class="form-group col-md-6">    
                                                                <label for="email2">Seating Capacity</label>
                                                                <input  type="text" value="<?php echo $data->seating_capacity?>" class="form-control" id="email2" name="seating_capacity" placeholder="No Of Seating"  >
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
                                                                <label for="email2">Vehicle Active Current Location</label>
                                                                <input required type="text" value="<?php echo $data->Add_location?>" class="form-control" id="email2" name="Add_location" placeholder=""  >
                                                        </div>

                                                    
                                                        <!-- <div class="form-group col-md-6">    
                                                                <label for="email2">RC Registration Date</label>
                                                                <input  type="date" class="form-control" id="email2" name="Add_Registration_date"  >
                                                        </div> -->
                                                    
                                                        <div class="form-group col-md-6">    
                                                                <label for="email2">Vehicle Insurance Expiry Date</label>
                                                                <input  required type="date" value="<?php echo $data->Add_insurance_exp_date?>" class="form-control" id="email2" name="Add_insurance_exp_date"  >
                                                        </div>
                                                        <!-- <div class="form-group col-md-6">    
                                                                <label for="email2">FC Date</label>
                                                                <input  type="date" class="form-control" id="email2" name="FC_date"  >
                                                        </div> -->
                                                        <div class="form-group col-md-6">
                                                        <label for="email2">Vehicle Stand Name</label>
                                                        <input required type="text" class="form-control" value="<?php echo $data->stand_name ?>" id="email2" name="stand_name"  placeholder="vehicle Stand Name"  >
                                                    
                                                    </div> 
                                                    </div>
                                                <?php } else if($data->category_id == '3') { ?>
                                                    <div class="row" style="padding: 15px;background: #faeed9;">
                                                <div class="form-group col-md-6">    
                                                 <label for="email2">Vehicle Name</label>
                                                    <div id="vt" >
                                                    <select required class="form-control" name="vehicle_type_id" id="Add_vehicle_type"  >
                                                    <option  value="">---Select---</option>
                                                    <?php
                                                      $shop_master_=mysqli_query($config,"select * from vehicle_type where status=1 and sub_category_id='$data->subcategory_id'");
                                                      while($sm_=mysqli_fetch_object($shop_master_))
                                                      { 
                                                    ?>
                                                        <option <?php if($sm_->Vehicle_type_id == $data->vehicle_type_id) {?>selected="selected"<?php }?> value="<?php echo $sm_->Vehicle_type_id;?>"><?php echo $sm_->Vehicle_type_name;?></option>
                                                    <?php } ?>                                                        
                                                    </select>
                                                    </div>                                         
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="email2">Transport Name</label>
                                                    <input type="text" required class="form-control" id="email2" name="Add_vehicle_name"  value="<?php echo $data->vehicle_name;?>" placeholder="vehicle Name"  >
                                                </div> 

                                                <div class="form-group col-md-6">    
                                                            <label for="email2">Vehicle Registration Number</label>
                                                            <input required type="text" value="<?php echo $data->vehicle_no?>" class="form-control" id="Add_vehicle_no"  onkeyup="vehicle_uni(this.value);" name="Add_vehicle_no" placeholder="Vehicle Registration Number"  >
                                                            <div style="color: red;font-size: 15px;font-weight: 500;margin-top: 10px;" id="vehicle_like">
                                                              
                                                          </div>
                                                    </div>
                                                   <div class="form-group col-md-6">    
                                                            <label for="email2">RC Owner Name</label>
                                                            <input required type="text" value="<?php echo $data->Add_RC_owner_name?>" class="form-control" id="email2" name="Add_RC_owner_name"  >
                                                    </div>

                                                <div class="form-group col-md-6">    
                                                            <label for="email2">Facilities</label>
                                                            <input required type="text" class="form-control" id="email2" name="facilities" value="<?php echo $data->facilities?>" placeholder="Facilities"  >
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
                                                            <label for="email2">Vehicle Active Current Location</label>
                                                            <input required type="text" class="form-control" id="email2" value="<?php echo $data->Add_location?>" name="Add_location" placeholder=""  >
                                                    </div>

                                                   
                                                    <!-- <div class="form-group col-md-6">    
                                                            <label for="email2">RC Registration Date</label>
                                                            <input  type="date" class="form-control" id="email2" name="Add_Registration_date"  >
                                                    </div> -->
                                                  
                                                    <div class="form-group col-md-6">    
                                                            <label for="email2">Vehicle Insurance Expiry Date</label>
                                                            <input  required type="date" class="form-control" id="email2" value="<?php echo $data->Add_insurance_exp_date?>" name="Add_insurance_exp_date"  >
                                                    </div>
                                                    <!-- <div class="form-group col-md-6">    
                                                            <label for="email2">FC Date</label>
                                                            <input  type="date" class="form-control" id="email2" name="FC_date"  >
                                                    </div> -->
                                                    <div class="form-group col-md-6">
                                                    <label for="email2">Vehicle Stand Name</label>
                                                    <input required type="text" class="form-control" id="email2" name="stand_name" value="<?php echo $data->stand_name?>" placeholder="vehicle Stand Name"  >
                                                   
                                                </div> 
                                                    
                                                </div>
                                                    <?php }  else if($data->category_id == '4') {?>

                                                        <div class="row" style="padding: 15px;background: #faeed9;">
                                                            <div class="form-group col-md-6">    
                                                                <label for="email2">Vehicle Active Current Location</label>
                                                                <input required="text" class="form-control" id="email2" value="<?php echo $data->Add_location?>" name="Add_location" placeholder="">
                                                            </div>
                                                            <div class="form-group col-md-6">    
                                                                <label for="email2">Shop Name</label>
                                                                <input required type="text" class="form-control"  value="<?php echo $data->shop_name?>" id="email2" name="shop_name"  >
                                                            </div>
                                                            <div class="form-group col-md-6">    
                                                                <label for="email2">Shop Address</label>
                                                                <input required type="text" class="form-control" id="email2" value="<?php echo $data->shop_address?>" name="shop_address"  >
                                                            </div>

                                                            <div class="form-group col-md-6">    
                                                                <label for="email2">Work Nature</label>
                                                                <input required type="text" class="form-control" id="email2" value="<?php echo $data->work_nature?>" name="work_nature"  >
                                                            </div>
                                                                </div>
                                                <?php } else if($data->category_id == '5') { ?>
                                                    <div class="row" style="padding: 15px;background: #faeed9;">
                                                            <div class="form-group col-md-6">    
                                                                <label for="email2">Vehicle Active Current Location</label>
                                                                <input required="text" class="form-control" id="email2" value="<?php echo $data->Add_location?>" name="Add_location" placeholder="">
                                                            </div>
                                                            <div class="form-group col-md-6">    
                                                                <label for="email2">Shop Name</label>
                                                                <input required type="text" class="form-control"  value="<?php echo $data->shop_name?>" id="email2" name="shop_name"  >
                                                            </div>
                                                            <div class="form-group col-md-6">    
                                                                <label for="email2">Shop Address</label>
                                                                <input required type="text" class="form-control" id="email2" value="<?php echo $data->shop_address?>" name="shop_address"  >
                                                            </div>

                                                            <div class="form-group col-md-6">    
                                                                <label for="email2">Work Nature</label>
                                                                <input required type="text" class="form-control" id="email2" value="<?php echo $data->work_nature?>" name="work_nature"  >
                                                            </div>
                                                                </div>
                                                    <?php } else { ?>

                                                        <?php } ?>
                                                
                                            </div>
                                            <div id="passenger" > 

                                            </div>
                                            <div id="spot_punjar" > 

                                            </div>

                                            <div class="row">
                                                
                                                <div class="form-group col-md-6">
                                                    <label for="email2">Photo(Size 250 X 250 px & 2 MB)</label>
                                                    <img src="/photos/vehicle/<?php echo htmlspecialchars(rawurlencode((string)$data->vehicle_photo), ENT_QUOTES, 'UTF-8'); ?>" style="height: 61px; object-fit: cover;" onerror="this.style.display='none'">
                                                    <input  type="file" class="form-control" id="email2" name="Edit_vehicle_photo">
                                                </div>
                                              
                                                <div class="form-group col-md-6">
                                                    <label for="email2">Whatsapp No (Driver Number)</label>
                                                    <input  type="text" class="form-control" id="email2" value="<?php echo $data->whatsapp_no ?>" name="Add_whatsapp_no" placeholder="Whatsapp No" onkeypress="if(this.value.length==10) return false;" >
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="email2">Address</label>
                                                    <textarea type="text" class="form-control" id="email2" name="Add_address" placeholder="Address...."   ><?php echo $data->address ?></textarea>
                                                </div>
                                                <div class="form-group col-md-6">
    <label for="exampleFormControlSelect1">State</label>
    <select required class="form-control" id="state" name="Add_state">
        <option value="">---SELECT---</option>
        <?php
        $states = mysqli_query($config, "SELECT * FROM dir_state_master");
        while ($state = mysqli_fetch_object($states)) {
        ?>
            <option <?php if($data->state_id == $state->state_id) {?>selected="selected"<?php }?> value="<?php echo $state->state_id ;?>"><?php echo $state->name;?></option>

        <?php } ?>
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
                                                            <option <?php if($data->city_id == $addsubcate->dir_city_id ) {?>selected="selected"<?php }?> value="<?php echo $addsubcate->dir_city_id ;?>"><?php echo $addsubcate->dir_city_name;?></option>
                                                            <?php } ?>                                                        
                                                        </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">City</label>
                                                        <div id="area">
                                                        <select required class="form-control" id='Add_area' onchange="sub_area(this.value);" name="Add_area">
                                                            <option value="">---SELECT---</option>
                                                            <?php
                                                            $main_cate=mysqli_query($config,"select * from dir_area_master where dir_cityid ='$data->city_id' ");
                                                            while($addsubcate=mysqli_fetch_object($main_cate))
                                                            {  
                                                            ?>
                                                            <option <?php if($data->area_id == $addsubcate->dir_area_id ) {?>selected="selected"<?php }?> value="<?php echo $addsubcate->dir_area_id ;?>"><?php echo $addsubcate->dir_area_name;?></option>
                                                            <?php } ?>                                                        
                                                        </select>
                                                        </div>
                                                </div>

                                                <!-- <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Area</label>
                                                        <div id="subarea">
                                                            <select required class="form-control" id='Add_sub_area' name="Add_sub_area">
                                                                <option value="">---SELECT---</option>
                                                                <?php
                                                                $main_cate=mysqli_query($config,"select * from sub_area_master where dirarea_id = '$data->area_id' ");
                                                                while($addsubcate=mysqli_fetch_object($main_cate))
                                                                {  
                                                                ?>
                                                                <option <?php if($data->sub_area_id == $addsubcate->sub_area_id ) {?>selected="selected"<?php }?> value="<?php echo $addsubcate->sub_area_id ;?>"><?php echo $addsubcate->sub_area_name;?></option>
                                                                <?php } ?>                                                        
                                                            </select>
                                                        </div>
                                                </div> -->

                                               
                                                <div class="form-group col-md-6">
                                                    <label for="exampleFormControlSelect1">Active Status</label>
                                                    <select class="form-control" id="exampleFormControlSelect1" name="Add_status">
                                                        <?php 
                                                        // Get current status from database - handle all possible values (0, '0', 1, '1', NULL, empty)
                                                        $dbStatus = isset($data->status) ? $data->status : null;
                                                        
                                                        // Convert to integer for proper comparison
                                                        // If status is explicitly 1 or '1', it's Active, otherwise it's In-Active
                                                        if ($dbStatus === null || $dbStatus === '' || $dbStatus === false) {
                                                            $currentStatus = 0; // Default to In-Active if not set
                                                        } else {
                                                            // Convert to integer: 1 = Active, anything else = In-Active
                                                            $currentStatus = (intval($dbStatus) === 1) ? 1 : 0;
                                                        }
                                                        ?>
                                                        <option value="1" <?php echo ($currentStatus === 1 || $currentStatus == '1') ? 'selected="selected"' : ''; ?>>Active</option>
                                                        <option value="0" <?php echo ($currentStatus === 0 || $currentStatus == '0' || $currentStatus != 1) ? 'selected="selected"' : ''; ?>>In-Active</option>                                                    
                                                    </select>
                                                    <small class="text-muted">
                                                        <i class="fas fa-info-circle"></i> Current Status: 
                                                        <strong><?php echo ($currentStatus == 1) ? '<span class="text-success">Active</span>' : '<span class="text-danger">In-Active</span>'; ?></strong>
                                                        <?php if (isset($data->status)): ?>
                                                            <br><small style="font-size: 0.85em;">(Database value: <?php echo htmlspecialchars($data->status); ?>)</small>
                                                        <?php endif; ?>
                                                    </small>
                                                </div>
                                                <div class="form-group col-md-6" style="display:none">
                                                    <label for="email2">Keyword</label>
                                                    <textarea type="text" class="form-control" id="email2" name="Add_meta_keyword" placeholder="Address...."  ></textarea>
                                                </div>
                                                <div class="form-group col-md-6">    
                                                            <label for="email2">General Remarks</label>
                                                            <textarea type="text" class="form-control" id="email2" name="Add_remarks"  ><?php echo $data->remarks ?></textarea>
                                                    </div>	
                                                    <div class="form-group col-md-6">    
                                                            <label for="email2">Referred By Mobile No</label>
                                                            <input type="number" class="form-control" value="<?php echo $data->reffered_by_phone_no ?>" id="email2" onkeypress="if(this.value.length==10) return false;" name="reffered_by_phone_no"  >
                                                    </div>	
                                                    <div class="form-group col-md-6">    
                                                            <label for="email2">Referred By Name</label>
                                                            <input type="text" class="form-control" value="<?php echo $data->reffered_by_name ?>" id="email2" name="reffered_by_name"  >
                                                    </div>
                                                    <div class="form-group col-md-6">    
                                                            <label for="email2">Registration Date</label>
                                                            <?php 
                                                           $originalDate = $data->create_on;
                                                           $newDate = date("d-m-Y", strtotime($originalDate));
                                                            ?>
                                                            <input type="text" class="form-control" value="<?php echo $newDate ?>" id="email2" name="create_on" readonly >
                                                    </div>
                                                    </div>
                                                   

                                                    <div class="form-group col-md-6">    
                                                 <label for="email2">Package</label>
                                                    <div id="pk">
                                                    <select required class="form-control" name="Add_package" id="Add_package" onchange="package(this.value);" ><option  value="">---Select---</option>';
<?php 
                                                            $shop_master_=mysqli_query($config,"select * from category_package where status=1 and Main_Category_id='".$data->category_id."' ");
                                                            while($sm_=mysqli_fetch_object($shop_master_))
                                                            { ?>
                                                           <option <?php if($sm_->package_id == $data->package_id) {?>selected="selected"<?php }?> value="<?php echo $sm_->package_id ?>" > <?php echo $sm_->package_title ?></option>
                                                            <?php } ?>
                                                    
                                                       </select>
                                                    </div>                                                  
                                                </div>

                                                <div class="form-group col-md-12">                                                      
                                                        <div class="row" id="pkamount">
                                                            <?php
                                                            // Get Package Start Date from database (post_addon field)
                                                            // Priority: 1. post_addon (saved value from database), 2. Payment date, 3. Calculate from expiry_date - package_days
                                                            $package_start_date = '';
                                                            
                                                            // First priority: Use post_addon from database (this is the saved/edited value)
                                                            if (!empty($data->post_addon)) {
                                                                $package_start_date = date('Y-m-d', strtotime($data->post_addon));
                                                            } else {
                                                                // If post_addon is empty, calculate from payment dates
                                                                
                                                                // Check for payment date from online payment
                                                                $payment_query = mysqli_query($config, "SELECT Paid_on FROM online_payment_transcation WHERE Order_id = '$pid' LIMIT 1");
                                                                if (mysqli_num_rows($payment_query) > 0) {
                                                                    $payment_data = mysqli_fetch_assoc($payment_query);
                                                                    $package_start_date = !empty($payment_data['Paid_on']) ? date('Y-m-d', strtotime($payment_data['Paid_on'])) : '';
                                                                }
                                                                
                                                                // If no payment date, check UTR date
                                                                if (empty($package_start_date) && !empty($data->utr_date)) {
                                                                    $package_start_date = date('Y-m-d', strtotime($data->utr_date));
                                                                }
                                                                
                                                                // If still no start date, calculate from expiry_date - package_days
                                                                if (empty($package_start_date) && !empty($data->expiry_date) && !empty($data->package_days)) {
                                                                    $package_start_date = date('Y-m-d', strtotime($data->expiry_date . ' -' . $data->package_days . ' days'));
                                                                }
                                                                
                                                                // If still empty, use current date as fallback
                                                                if (empty($package_start_date)) {
                                                                    $package_start_date = date('Y-m-d');
                                                                }
                                                            }
                                                            
                                                            $expiry_date = $data->expiry_date;
                                                            $package_days = $data->package_days;
                                                            ?>
                                                            
                                                            <div class="form-group col-md-6">
                                                                <label for="package_start_date">Package Start Date <span style="color: red;">*</span></label>  
                                                                <input type="date" 
                                                                       value="<?php echo $package_start_date; ?>" 
                                                                       class="form-control" 
                                                                       id="package_start_date" 
                                                                       name="package_start_date" 
                                                                       required> 
                                                            </div>
                                                            
                                                            <div class="form-group col-md-6" >
                                                                <label for="Add_date">Package Expiry Date <span style="color: red;">*</span></label>  
                                                                <?php 
                                                                $originalDate = $expiry_date;
                                                                $newDate = date("Y-m-d", strtotime($originalDate));
                                                                ?>         
                                                                <input type="date" 
                                                                       value="<?php echo $newDate; ?>" 
                                                                       class="form-control" 
                                                                       id="Add_date" 
                                                                       name="Add_date" 
                                                                       required> 
                                                            </div>
                                                            
                                                            <div class="form-group col-md-6">
                                                                <label for="Add_amount">Package Amount</label>           
                                                                <input type="text" 
                                                                       value="<?php echo !empty($data->package_amount) ? $data->package_amount : ''; ?>" 
                                                                       class="form-control" 
                                                                       id="Add_amount" 
                                                                       name="Add_amount" 
                                                                       readonly> 
                                                            </div>

<?php if (!empty($data->discount_name) && !empty($data->discount_amount)) { ?>
    <div class="form-group col-md-6">
        <label for="discount_name">Discount Name</label>           
        <input type="text" 
               value="<?php echo htmlspecialchars($data->discount_name); ?>" 
               class="form-control" id="discount_name" name="discount_name" readonly> 
    </div>

    <div class="form-group col-md-6">
        <label for="discount_amount">Discount Amount</label>           
        <input type="text" 
               value="<?php echo $data->discount_amount; ?>" 
               class="form-control" id="discount_amount" name="discount_amount" readonly> 
    </div>
<?php } ?>

<?php
// 🧮 Calculate Net Amount
$package_amount   = !empty($data->package_amount) ? $data->package_amount : 0;
$discount_amount  = !empty($data->discount_amount) ? $data->discount_amount : 0;
$net_amount       = $package_amount - $discount_amount;
?>

<div class="form-group col-md-6">
    <label for="net_amount">Net Amount</label>           
    <input type="text"
           value="<?php echo number_format($net_amount, 2); ?>"
           class="form-control"
           id="net_amount"
           name="net_amount"
           readonly>
</div>

<?php
/* ===============================
   PAYMENT & TRANSACTION CHECKS
================================ */

// Bank Reference No
$ref_no = !empty($data->ref_no) ? $data->ref_no : '';

// Online payment flags
$online_payment_exists = false;
$online_payment_paid_amount = 0;
$paidon = '';

// Fetch online payment transaction
$transaction_query = "SELECT transactionId, Paid_on, Paid_Amout 
                      FROM online_payment_transcation 
                      WHERE Order_id = '$pid' 
                      LIMIT 1";

$transaction_result = mysqli_query($config, $transaction_query);

if ($transaction_result && mysqli_num_rows($transaction_result) > 0) {
    $transaction_data = mysqli_fetch_assoc($transaction_result);

    if (empty($ref_no)) {
        $ref_no = $transaction_data['transactionId'] ?? '';
    }

    if (!empty($transaction_data['Paid_Amout']) && floatval($transaction_data['Paid_Amout']) > 0) {
        $online_payment_exists = true;
        $online_payment_paid_amount = floatval($transaction_data['Paid_Amout']);
    }

    if (!empty($transaction_data['Paid_on'])) {
        $paidon = $transaction_data['Paid_on'];
    }
}

// If no paid date, check UTR Date
if (empty($paidon) && !empty($data->utr_date)) {
    $paidon = $data->utr_date;
}

// If still no date, check payment_confirmed_at
if (empty($paidon) && !empty($data->payment_confirmed_at)) {
    $paidon = $data->payment_confirmed_at;
}

// Final fallback
if (empty($paidon) && !empty($data->payment_type) && $data->status == '1') {
    $paidon = date('Y-m-d');
}

$paidon_display = !empty($paidon) ? date('Y-m-d', strtotime($paidon)) : '';

/* ===============================
   FINAL DECISION FLAGS
================================ */

// ✅ ONLINE PAID FLAG (MAIN FIX)
$isOnlinePaid = (
    $online_payment_exists === true ||
    !empty($ref_no) ||
    ($data->payment_type == "0" && !empty($paidon_display))
);

// Payment Pending
$isPaymentPending = (
    !$isOnlinePaid &&
    (empty($data->payment_type)) &&
    ($data->status == '0' || $data->status == 0) &&
    empty($data->utr_number) &&
    ($package_amount > 0 || $net_amount > 0)
);

// Free Registration
$isFreeRegistration = (
    !$isOnlinePaid &&
    empty($data->payment_type) &&
    ($package_amount == 0 && $net_amount == 0)
);
?>

<div class="form-group col-md-6">
    <label for="paid_status">Paid Status</label>
    <select class="form-control" id="paid_status" name="paid_status">

        <option value="pending" <?php echo $isPaymentPending ? 'selected' : ''; ?>>
            Payment Pending
        </option>

        <option value="free" <?php echo $isFreeRegistration ? 'selected' : ''; ?>>
            Free Registration
        </option>

        <option value="0" <?php echo $isOnlinePaid ? 'selected' : ''; ?>>
            Online Payment (Paid)
        </option>

        <option value="1" <?php echo ($data->payment_type == "1") ? 'selected' : ''; ?>>
            Admin Cash
        </option>

        <option value="2" <?php echo ($data->payment_type == "2") ? 'selected' : ''; ?>>
            Admin Bank
        </option>

        <option value="3" <?php echo ($data->payment_type == "3" || !empty($data->utr_number)) ? 'selected' : ''; ?>>
            Scan QR Payment
        </option>

    </select>

    <small class="text-info">
        <i class="fas fa-info-circle"></i>
        Online Payment auto-detects using Bank Ref / Gateway transaction.
    </small>
</div>

<!-- QR PAYMENT FIELDS -->
<div class="form-group col-md-6" id="utr_number_div"
     style="display: <?php echo ($data->payment_type == "3" || !empty($data->utr_number)) ? 'block' : 'none'; ?>;">
    <label>UTR Number <span style="color:red">*</span></label>
    <input type="text" class="form-control"
           name="utr_number"
           value="<?php echo htmlspecialchars($data->utr_number ?? ''); ?>">
</div>

<div class="form-group col-md-6" id="utr_date_div"
     style="display: <?php echo ($data->payment_type == "3" || !empty($data->utr_number)) ? 'block' : 'none'; ?>;">
    <label>UTR Date <span style="color:red">*</span></label>
    <input type="date" class="form-control"
           name="utr_date"
           value="<?php echo $data->utr_date ?? ''; ?>">
</div>

<!-- PAID ON -->
<div class="form-group col-md-6">
    <label>Paid On</label>
    <input type="date" class="form-control"
           name="paid_on"
           value="<?php echo $paidon_display; ?>">
    <?php if ($online_payment_exists): ?>
        <small style="color:green;">✓ Online payment detected</small>
    <?php endif; ?>
</div>

<!-- BANK REFERENCE -->
<div class="form-group col-md-6">
    <label>Bank Reference No</label>
    <input type="text" class="form-control"
           name="ref_no"
           value="<?php echo $ref_no; ?>">
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    function toggleRefNo() {
        var paidStatus = $("#paid_status").val();

        // Show/hide Bank Reference No field
        if (paidStatus === "0" || paidStatus === "2") {
            $("#ref_no_div").show();
        } else {
            $("#ref_no_div").hide();
        }
        
        // Show/hide UTR fields for Scan QR Payment
        if (paidStatus === "3") {
            $("#utr_number_div").show();
            $("#utr_date_div").show();
            // Make UTR fields required
            $("#utr_number").prop('required', true);
            $("#utr_date").prop('required', true);
        } else {
            $("#utr_number_div").hide();
            $("#utr_date_div").hide();
            // Remove required attribute
            $("#utr_number").prop('required', false);
            $("#utr_date").prop('required', false);
        }
        
        // For Free Registration, ensure submit button is always visible
        if (paidStatus === "free") {
            $("#post_btn").show();
            $("#post_btn button").show();
        }
        
        // Paid On field - not required (removed requirement)
        
        // ✅ Auto-set Status to Active (1) when payment is confirmed (only when user changes payment status, not on page load)
        // Payment confirmed if: paid_status = 0 (Online Payment), 1 (Admin Cash), 2 (Admin Bank), or 3 (Scan QR Payment)
        // Note: Don't auto-set on page load - preserve the current status from database
        // This will be handled in the change event handler below
    }

    // Store initial status from database to preserve it
    var initialStatus = $("#exampleFormControlSelect1").val();
    
    // Initial check when the page loads (but don't change status)
    toggleRefNo();
    
    // Restore initial status after toggleRefNo (in case it was changed)
    $("#exampleFormControlSelect1").val(initialStatus);

    // Check on change event
    $("#paid_status").change(function() {
        toggleRefNo();
        
        // ✅ Handle Payment Pending - set status to 0
        var paidStatus = $(this).val();
        if (paidStatus === "pending") {
            $("#exampleFormControlSelect1").val("0"); // Set status to In-Active (Payment Pending)
        } else if (paidStatus === "free") {
            // ✅ Handle Free Registration - allow activation (status can be 0 or 1)
            // Don't force status change, let admin decide
        } else if (paidStatus === "0" || paidStatus === "1" || paidStatus === "2" || paidStatus === "3") {
            // ✅ Auto-set Status to Active (1) when payment is confirmed
            $("#exampleFormControlSelect1").val("1"); // Set status to Active
        }
    });
    
    // When UTR date changes, recalculate expiry date if Scan QR Payment is selected
    $("#utr_date").on('change', function() {
        if ($("#paid_status").val() === "3") {
            // Update package start date to UTR date
            $("#package_start_date").val($(this).val());
            // Update Paid On date to UTR date
            $("#paid_on").val($(this).val());
            // Recalculate expiry date
            calculateExpiryDate();
        }
    });
    
    // When payment status changes, update Paid On date if needed
    $("#paid_status").on('change', function() {
        var paidStatus = $(this).val();
        var currentPaidOn = $("#paid_on").val();
        
        // If Paid On is empty and payment status is set, set to current date
        if (!currentPaidOn && paidStatus !== "" && paidStatus !== "0") {
            var today = new Date();
            var year = today.getFullYear();
            var month = String(today.getMonth() + 1).padStart(2, '0');
            var day = String(today.getDate()).padStart(2, '0');
            var formattedDate = year + '-' + month + '-' + day;
            $("#paid_on").val(formattedDate);
        }
        
        // If Scan QR Payment is selected and UTR date exists, use UTR date
        if (paidStatus === "3" && $("#utr_date").val()) {
            $("#paid_on").val($("#utr_date").val());
        }
    });
    
    // When Paid On date changes, update package start date if payment is confirmed
    $("#paid_on").on('change', function() {
        var paidStatus = $("#paid_status").val();
        if (paidStatus !== "" && paidStatus !== "0") {
            // Update package start date to Paid On date
            $("#package_start_date").val($(this).val());
            // Recalculate expiry date
            calculateExpiryDate();
        }
    });
});
</script>


                                                            <div class="form-group col-md-6" style="display:none"> 
                                                                <label for="email2">Package Days</label> 
                                                                <input type="text" value="<?php echo $data->package_days ?>" class="form-control" id="Add_days" name="Add_days" placeholder="amount" readonly> 
                                                                <input type="hidden" value="<?php echo $data->package_days ?>" id="package_days_input" name="package_days_input">
                                                             </div>
                                                        </div>       

                                                        <input type="hidden" class="form-control" value="<?php echo $data->post_id ?>" id="email2" name="id"  >

                                                </div>
                                                   
                                                      <div id="post_btn" style="display: block !important; visibility: visible !important;">
                                                        <div class="form-group">                                                         
                                                            <button class="btn btn-success" type="submit" name="post_edit" style="display: block !important; visibility: visible !important;">Submit</button>
                                                        </div>
                                                    
                
									</div>
                  
                                    </div> 
                            </form>
						</div>
	                </div>
				</div>
			</div>
			
		 <?php include('footer.php');?>
		</div>
		
		 
		<!-- End Custom template -->
	</div>
	<!--   Core JS Files   -->
	<script src="../assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="../assets/js/core/popper.min.js"></script>
	<script src="../assets/js/core/bootstrap.min.js"></script>
	<!-- jQuery UI -->
	<script src="../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
	
	<!-- jQuery Scrollbar -->
	<script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
	<!-- Datatables -->
	<script src="../assets/js/plugin/datatables/datatables.min.js"></script>
	<!-- Atlantis JS -->
	<script src="../assets/js/atlantis.min.js"></script>
	<!-- Atlantis DEMO methods, don't include it in your project! -->
	<script src="../assets/js/setting-demo2.js"></script>
	<script >
		$(document).ready(function() {
			$('#basic-datatables').DataTable({
			});

		 
 
			 
		});
	</script>
       <script>
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
        </script>


<script>
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
                                    $('#vehicle_body_type_container2').show();
                                    $('#vehicle_body_type').prop('required', true);
                                    $('#vehicle_body_type2').prop('required', true);
                                }
                               
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
                     // alert(id);

                                 
                     if(id >= 1 && id <= 10)
                     {
                      $.ajax({
                        type: "POST",
                        url:'machinery_field.php',
                        data: {id:id}, // serializes the form's elements.
                        success: function(data)
                        {	
                         //alert(data);		
                        $('#commercial').html(data);
                        
                        }			
                       });	
                     }

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
                        url:'vehicle_type_admin.php',
                        data: {id:id}, // serializes the form's elements.
                        success: function(data)
                        {	
                            // alert(data);		
                        $('#vt').html(data);
                        
                        }			
                    });	
                      } 


                      function package(id){
                    var post_id = $('input[name="id"]').val(); // Get post_id from hidden input
                    
                    // Only make AJAX call if package is selected - fetch package data but don't hide any fields
                    if(id && id !== '' && id !== '0'){
                        $.ajax({
                            type: "POST",
                            url:'package_amount.php',
                            dataType: 'json',
                            data: {id:id, post_id:post_id}, // Send both package_id and post_id
                            success: function(resp)
                            {	
                            if(!resp || resp.error){
                                console.error('Package lookup failed', resp && resp.error);
                                return;
                            }
                            // Update existing fields in place (no HTML replacement)
                            $('#package_start_date').val(resp.package_start_date);
                            $('#Add_date').val(resp.expiry_date);
                            $('#Add_amount').val(resp.package_amount);
                            $('#Add_days').val(resp.package_days);
                            if(resp.discount_name){
                                $('#discount_name').val(resp.discount_name);
                            }
                            if(resp.discount_amount){
                                $('#discount_amount').val(resp.discount_amount);
                            }
                            if(resp.net_amount){
                                $('#net_amount').val(parseFloat(resp.net_amount).toFixed(2));
                            }
                            // Recalculate expiry/net amount after updates
                            calculateExpiryDate();
                            }			
                        });
                    }
                      } 
                      
                      // Function to calculate expiry date from start date and package days
                      function calculateExpiryDate() {
                          var startDate = $('#package_start_date').val();
                          var packageDays = $('#Add_days').val() || $('#package_days_input').val();
                          
                          if (startDate && packageDays) {
                              // Convert start date to Date object
                              var start = new Date(startDate);
                              
                              // Add package days
                              var expiryDate = new Date(start);
                              expiryDate.setDate(expiryDate.getDate() + parseInt(packageDays));
                              
                              // Format date as YYYY-MM-DD for date input
                              var year = expiryDate.getFullYear();
                              var month = String(expiryDate.getMonth() + 1).padStart(2, '0');
                              var day = String(expiryDate.getDate()).padStart(2, '0');
                              var formattedDate = year + '-' + month + '-' + day;
                              
                              // Update expiry date field
                              $('#Add_date').val(formattedDate);
                          }
                      }
                      
                      // Event listeners for automatic recalculation
                      $(document).ready(function() {
                          // When package start date changes
                          $('#package_start_date').on('change', function() {
                              calculateExpiryDate();
                          });
                          
                          // When package dropdown changes (package days will be updated via AJAX)
                          $('#Add_package').on('change', function() {
                              // Wait a bit for package days to be loaded, then recalculate
                              setTimeout(function() {
                                  calculateExpiryDate();
                              }, 500);
                          });
                          
                          // When package days input changes (if editable)
                          $(document).on('change', '#Add_days, #package_days_input', function() {
                              calculateExpiryDate();
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


        </script>

<script>
    $(document).ready(function() {
        $('#state').on('change', function() {
            var stateId = $(this).val(); // Get the selected state ID
            $('#Add_area').html('<option value="">---SELECT---</option>');

            
            // Clear and reset the district dropdown
            $('#city').html('<option value="">---SELECT---</option>');

            if (stateId) {
                $.ajax({
                    url: 'fetch_districts.php',
                    type: 'POST',
                    data: { state_id: stateId },
                    success: function(response) {
                        // Populate the district dropdown with options
                        $('#city').html(response);
                    },
                    error: function() {
                        alert('Failed to fetch districts. Please try again.');
                    }
                });
            }
        });
    });


    document.addEventListener("DOMContentLoaded", function () {
    var vehicleTypeDropdown = document.getElementById("Add_vehicle_type");
    var otherVehicleField = document.getElementById("other_vehicle_type_field");

    function toggleOtherVehicleField() {
        if (vehicleTypeDropdown.value === "0") {
            otherVehicleField.style.display = "block"; // Show input field when "Others" is selected
        } else {
            otherVehicleField.style.display = "none"; // Hide input field otherwise
        }
    }

    // Trigger on page load in case "Others" is preselected
    toggleOtherVehicleField();

    // Add event listener for change event
    vehicleTypeDropdown.addEventListener("change", toggleOtherVehicleField);
});

// Initialize expiry date calculation on page load
$(document).ready(function() {
    // Calculate expiry date on page load
    setTimeout(function() {
        calculateExpiryDate();
    }, 500);
});

</script>


</body>
</html>