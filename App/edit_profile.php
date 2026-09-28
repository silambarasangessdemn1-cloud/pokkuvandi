 <?php include('config/setup.php');?>
 <?php include('session.php');?>
 
 <?php
 if(isset($_POST['custom_profile_edit']))
 { 
$custediton=date('Y-m-d');
$update_customer=mysqli_query($config,"update customer_master set Customer_Name='".$_POST['up_customer_Name']."',Customer_Phone_No='".$_POST['up_customer_mobile_no']."',Customer_Mail_id='".$_POST['up_customer_mail']."',Customer_Registred_on='$custediton',Customer_Address='".$_POST['address']."',Customer_Fathername='".$_POST['father_name']."',Customer_DOB='".$_POST['dob']."',Add_city='".$_POST['Add_city']."',Add_area='".$_POST['Add_area']."',state_id='".$_POST['Add_state']."'    where Customer_Id='$session_id'");
 header("Refresh:0");

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
         <em>Enable Dark Mode!</em>
      </div>
      <div class="osahan-profle">
         <div class="p-3 border-bottom">
            <div class="d-flex align-items-center">
               <a class="font-weight-bold text-success text-decoration-none" href="my_account.php">
               <i class="icofont-rounded-left back-page"></i></a>
               <h6 class="font-weight-bold m-0 ml-3">Edit Profile</h6>
               <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>
            </div>
         </div>
      </div>
      <div id="edit_profile">
         <div class="p-4 profile text-center border-bottom">




            <img src="<?php 
            
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
            
            ?>" class="img-fluid rounded-pill">





            <h6 class="font-weight-bold m-0 mt-2"><?php echo $session__username;?></h6>
            <p class="small text-muted m-0"><?php echo $session__mail; ?></p>
         </div>
         <div class="p-3">
            <form action="edit_profile.php" method="post">

            <?php 
            //echo "select * from customer_master where Customer_Id ='$session_id' order by (Customer_Id) ASC";
            $main_cate3=mysqli_query($config,"select * from customer_master where Customer_Id ='$session_id' order by (Customer_Id) ASC");
            $macate3=mysqli_fetch_object($main_cate3)?>
               <div class="form-group">
                  <label for="exampleInputName1">Full Name</label>
                  <input type="text" class="form-control" id="exampleInputName1" name="up_customer_Name" value="<?php echo $session__username;?>">
               </div>
               <div class="form-group">
                  <label for="exampleInputName1">DOB</label>
                  <input type="date" class="form-control" id="exampleInputName1" name="dob" value="<?php echo $macate3->Customer_DOB;?>">
               </div>
               <div class="form-group">
                  <label for="exampleInputName1">Father Name</label>
                  <input type="text" class="form-control" id="exampleInputName1" name="father_name" value="<?php echo $macate3->Customer_Fathername;?>">
               </div>
               
               <div class="form-group">
                  <label for="exampleInputName1">Address</label>
                  <textarea type="text" class="form-control" id="exampleInputName1" name="address" ><?php echo $macate3->Customer_Address;?></textarea>
               </div>
               <div class="form-group">
                  <label for="exampleInputNumber1">Mobile Number</label>
                  <input type="number" class="form-control" id="exampleInputNumber1" name="up_customer_mobile_no" value="<?php echo $session__phone; ?>">
               </div>
               <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" name="up_customer_mail" value="<?php echo $session__mail;?>">
               </div>
               <div class="form-group">
                     <label for="exampleInputName1">State</label>
                         <select required class="form-control" id='state' name="Add_state" onchange="loadDistricts(this.value)">
                              <option value="">---SELECT---</option>
                                 <?php
                                 $main_cate=mysqli_query($config,"select * from dir_state_master");
                                 while($addsubcate=mysqli_fetch_object($main_cate))
                                 {  
                                   
                                   ?>
                                 <option <?php if($addsubcate->state_id == $macate3->state_id) {?>selected="selected" <?php } ?> value="<?php echo $addsubcate->state_id ;?>"><?php echo $addsubcate->name;?></option>
                                 <?php } ?>                                                        
                                 </select>
               </div>
               <div class="form-group">
                     <label for="exampleInputName1">District</label>
                         <select required class="form-control" id='city' name="Add_city">
                              <option value="">---SELECT---</option>
                                 <?php
                                 $main_cate=mysqli_query($config,"select * from dir_city_master");
                                 while($addsubcate=mysqli_fetch_object($main_cate))
                                 {  
                                   
                                   ?>
                                 <option <?php if($addsubcate->dir_city_id == $macate3->Add_city) {?>selected="selected" <?php } ?> value="<?php echo $addsubcate->dir_city_id ;?>"><?php echo $addsubcate->dir_city_name;?></option>
                                 <?php } ?>                                                        
                                 </select>
               </div>
               <div class="form-group ">
                  <label for="exampleInputName1">City</label>
                     <div id="area">
                     <?php 
 $sql4="SELECT * FROM `dir_area_master` order by (dir_area_name	) ASC ";
   

   $main_cate4=mysqli_query($config,$sql4);
   ?>
    <select  id="Add_area" name="Add_area"  onchange="sub_area(this.value);"  aria-label="multiple select example" class="form-select area_s form-control" aria-label="Default select example">';
   <option value="0" >Select</option>';
   <?php while($macate4=mysqli_fetch_object($main_cate4))
   
   {
   
   ?>
    <option <?php if($macate4->dir_area_id == $macate3->Add_area) {?>selected="selected" <?php } ?> value="<?php echo $macate4->dir_area_id ?>"><?php echo $macate4->dir_area_name ?></option>

   <?php } ?>
   </select>
                      </div>
                 </div>

               <div class="text-center">
                  <button type="submit" class="btn btn-success btn-block btn-lg" name="custom_profile_edit">Save Changes</button>
               </div>
            </form>
         </div>
         <div class="additional">
            <div class="change_password border-bottom border-top">
               <a href="change_password.php" class="p-3 bg-white btn d-flex align-items-center">Change Password 
               <i class="icofont-rounded-right ml-auto"></i></a>
            </div>
           
         </div>
      </div>
      </div>
      
<?php include('menu.php');?>

	  <!-- Bootstrap core JavaScript -->
      <script src="vendor/jquery/jquery.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <!-- slick Slider JS-->
      <script type="text/javascript" src="vendor/slick/slick.min.js"></script>
      <!-- Sidebar JS-->
      <script type="text/javascript" src="vendor/sidebar/hc-offcanvas-nav.js"></script>
      <!-- Custom scripts for all pages-->
      <script src="js/osahan.js"></script>

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
function loadDistricts(stateId) {
  localStorage.setItem('stateId', stateId); // Save the mobile number in localStorage
  
  $("#Add_area").html('<option value="">---SELECT---</option>');

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
   </body>
</html>