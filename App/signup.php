

<?php include('config/setup.php');

error_reporting(0);
ini_set('display_errors', 0);


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
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

      <style>
         /* Modern UI Enhancements */
         body {
            background: #f4f7f6;
            font-family: 'Inter', 'Lato', sans-serif;
         }
         .osahan-signin, .osahan-signup {
            max-width: 500px;
            margin: 0 auto;
            background: #ffffff;
            min-height: 100vh;
            box-shadow: 0 0 40px rgba(0,0,0,0.05);
            padding-bottom: 80px;
            animation: fadeIn 0.8s ease-in-out;
         }
         @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
         }
         .brand-header {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%) !important;
            border-bottom: none !important;
            padding: 30px 20px 25px 20px !important;
            border-bottom-left-radius: 25px;
            border-bottom-right-radius: 25px;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.2);
            position: relative;
            z-index: 10;
            display: flex;
            flex-direction: column;
            align-items: center;
         }
         .brand-header h4 {
            color: #ffffff;
            font-weight: 700;
            margin-top: 15px;
            letter-spacing: 0.5px;
            text-align: center;
         }
         .index-osahan-logo {
            border-radius: 50%;
            padding: 8px;
            background: white;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
         }
         .form-container {
            padding: 30px 25px !important;
         }
         .form-container h6 {
            font-weight: 800;
            color: #2c3e50;
            margin-bottom: 30px;
            text-align: center;
            font-size: 24px;
         }
         .form-group label {
            font-weight: 600;
            color: #4a5568;
            font-size: 14px;
            margin-bottom: 8px;
         }
         .form-control {
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            padding: 14px 16px;
            font-size: 15px;
            transition: all 0.3s ease;
            background-color: #f8fafc;
            height: auto;
         }
         .form-control:focus {
            background-color: #ffffff;
            border-color: #28a745;
            box-shadow: 0 0 0 4px rgba(40, 167, 69, 0.15);
         }
         .btn-success {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-weight: 700;
            font-size: 16px;
            letter-spacing: 0.5px;
            box-shadow: 0 6px 15px rgba(40, 167, 69, 0.3);
            transition: transform 0.2s, box-shadow 0.2s;
         }
         .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(40, 167, 69, 0.4);
            color: white;
         }
         .osahan-fotter {
            max-width: 500px;
            margin: 0 auto;
            right: 0;
            left: 0;
            background: transparent;
            padding: 15px;
         }
         .osahan-fotter .btn {
            border-radius: 12px;
            font-weight: 700;
            color: #28a745;
            box-shadow: 0 -4px 20px rgba(0,0,0,0.05);
            border: 1px solid #e2e8f0;
            padding: 14px;
         }
         .video-preview {
            text-align: center;
            margin: -15px 20px 20px 20px;
            position: relative;
            z-index: 11;
         }
         .video-preview .btn {
            border-radius: 20px;
            padding: 8px 20px;
            font-size: 14px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
         }
         .theme-switch-wrapper {
            display: none;
         }
      </style>
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
      <!-- sign up -->
      <div class="osahan-signup" >
         <div class="brand-header">
            <center> <img class="index-osahan-logo" src="
                 <?php 
               
                $inro_logo=mysqli_query($config,"select Logo_Path,logo_status from lee_master");
                 while($logo=mysqli_fetch_array($inro_logo))
               {
                    $logstatus=$logo[1];
   if($logstatus == 1)
   {
     $ms=substr($logo[0],6);
				  echo  $ms;
   }else{
       echo "../photos/logo/no_logo.png";
   
   }
   
               }
               
               ?>
               
               
               
               
               
               " alt="leefoodies Logo" style="
       height: 51px;
   "></center>
            <h4> <?php 
               
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
               
               ?>   </h4>
             
         </div>

    <?php
// Fetch the video URL from the database
$video_query = "SELECT Main_Category_Name FROM video WHERE video_name = 'Demo Video' LIMIT 1";
$video_result = mysqli_query($config, $video_query);

// Check if a result was returned
if ($video_result && mysqli_num_rows($video_result) > 0) {
    $video_row = mysqli_fetch_assoc($video_result);
    $video_id = $video_row['Main_Category_Name'];
} else {
    $video_id = '0dAUvAk_YI4'; // Default or fallback video ID if not found
}

?>
   <div class="video-preview">
        <button class="btn btn-success" onclick="window.open('https://www.youtube.com/watch?v=<?php echo $video_id; ?>', '_blank')">Demo Video</button>
    </div>

         <div class="p-3 form-container">
           <!-- <h2 class="my-0">Let's get started</h2>--->
           
		   <center><h6>Create New User Account</h6> </center>
         <div class="alert alert-danger" id="pn" role="alert" style="display: none;" >
         Please Fill All The Details!
</div>
<div class="alert alert-danger" id="pn1" role="alert" style="display: none;" >
Please Enter Valid OTP!
</div>
           <?php
		  

// error_reporting(0);
// ini_set('display_errors', 0);

            if($_GET['error'] == 3000) {  ?>
            <div class="alert alert-danger" role="alert">
                          Please Select District and City
            </div>
                                                                     
              <?php } 
 
		   
		   if($_GET['already'] == 200)
		   {
		   ?>
		   <form action="register.php" method="post">
               <div class="form-group">
                  <label for="exampleInputName1">Name</label>
                  <input placeholder="Enter Name" name="Lee_Customer_Name" type="text" class="form-control" id="user_name" value="<?php echo $_GET['name']?>" aria-describedby="emailHelp" required>
               </div>
               <div class="form-group">
                  <label for="exampleInputName1">Father's Name</label>
                  <input placeholder="Enter Father's Name" name="Lee_Customer_Fathername" type="text" class="form-control" id="user_fathername" value="<?php echo $_GET['fathername']?>" aria-describedby="emailHelp" required>
               </div>
               <div class="form-group">
                  <label for="exampleInputName1">Date Of Birth</label>
                  <input placeholder="Enter DOB" name="Lee_Customer_DOB" type="date" class="form-control" id="user_dateohbirth" value="<?php echo $_GET['DOB']?>" aria-describedby="emailHelp" required>
               </div>
               <div class="form-group">
                  <label for="exampleInputName1">Address</label>
                  <input placeholder="Enter Address" name="Lee_Customer_address" type="text" class="form-control" id="user_fathername" value="<?php echo $_GET['address']?>" aria-describedby="emailHelp" required>
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
                                                            <option <?php if($addsubcate->dir_city_id == $_GET['Add_city']) {?> selected="selected" <?php } ?> value="<?php echo $addsubcate->dir_city_id ;?>"><?php echo $addsubcate->dir_city_name;?></option>
                                                            <?php } ?>                                                        
                                                        </select>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="exampleInputName1">City</label>
                                                        <div id="area">

                                                        </div>
                                                </div>
               <div class="form-group">
                  <label for="exampleInputNumber1">Phone Number</label>
                  <input placeholder="Enter Phone Number" name="Lee_Customer_phonenumber" maxlength="12" type="number" class="form-control" value="<?php echo $_GET['phonenumber']?>"  id="user_ph" aria-describedby="emailHelp" required>
				  <center><h6 style="color:red;">Mobile Number Already Registred</h6> </center>
               </div>
               <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input placeholder="Enter Email" type="email" name="Lee_Customer_email" class="form-control" id="exampleInputEmail1" value="<?php echo $_GET['email']?>" aria-describedby="emailHelp" required>
               </div>
               <!-- <div class="form-group" style="display:none">
                  <label for="exampleInputNumber1">referred by</label>
                  <input placeholder="Enter Phone Number"   name="referred_by"   onKeyPress="if(this.value.length==10) return false;" type="number" class="form-control"   aria-describedby="emailHelp" >
               </div> -->
               <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input placeholder="Enter Password"   value="<?php echo $_GET['passwor'] ?>" type="password" name="Lee_Customer_password" class="form-control" id="exampleInputPassword1" required>
               </div>
               <div class="form-group">
                  <label for="exampleInputPassword2">Confirmation Password</label>
                  <input placeholder="Enter Confirmation Password" value="<?php echo $_GET['passwor'] ?>" name="Lee_Customer_confirm_password" type="password" class="form-control" id="exampleInputPassword2" required>
              
              
               <input    type="hidden" name="referal_pro" class="form-control" id="exampleInputPassword1" value="<?php echo base64_decode(urldecode($_GET['pid']))?>">
           <input    type="hidden" name="referal_client" class="form-control" id="exampleInputPassword1" value="<?php echo base64_decode(urldecode($_GET['Recli']))?>">
                  <input   type="hidden" name="referal_code" class="form-control" id="exampleInputPassword1" value="<?php echo base64_decode(urldecode($_GET['prefcode']))?>" >
              
              
              
              
              
              
               </div>
               <div class="form-group" style="  margin-left: 6%;">
               <input type="checkbox" class="form-check-input " id="exampleCheck1" required>
    <label class="form-check-label " for="exampleCheck1">I agree to the callinfo <a href="terms_and_conditions.php"> Terms and Conditions</a></label>
         </div>
         <input  name="smsotp"type="hidden" class="form-control" id="smsotp" value="<?php echo rand(0,10000); ?>">
         <div class="form-group" id="o_sms" style="display: none;">
                  <label style="Color:red" for="exampleInputPassword1"><b>ENTER YOUR OTP HERE </b></label>
         <input  name="esmsotp" type="text" class="form-control" id="esmsotp" >
         </div>
               <button   type="submit" class="btn btn-success rounded btn-lg btn-block" name="lee_account_registration">Create Account</button>
            </form>
			
		   <?php }else{
            
            session_start();
            $form_data = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];

            ?>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

            <script>

        $(document).ready(function () {
            $('input, select').on('blur', function () {
                var field = $(this).attr('name');
                var value = $(this).val();
                $.post('save_form_data.php', {field: field, value: value}, function (response) {
                    console.log(response);
                });
            });

            $('#clearForm').on('click', function () {
                $.post('save_form_data.php', {clear: true}, function (response) {
                    console.log(response);
                    location.reload();
                });
            });

            if ($('#city').val()) {
                $('#city').trigger('change');
            }
        });
    </script>
			 <form  id="registrationForm" action="register.php" method="post">
               <div class="form-group">
                  <label for="exampleInputName1">Name</label>
                  <input placeholder="Enter Name" name="Lee_Customer_Name" type="text" class="form-control" id="user_name" required value="<?php echo isset($_SESSION['form_data']['Lee_Customer_Name']) ? $_SESSION['form_data']['Lee_Customer_Name'] : ''; ?>">
               </div>
               <div class="form-group">
                  <label for="exampleInputName1">Father's Name</label>
                  <input placeholder="Enter Father's Name" name="Lee_Customer_fatherName" type="text" class="form-control" id="user_fathername" required value="<?php echo isset($_SESSION['form_data']['Lee_Customer_fatherName']) ? $_SESSION['form_data']['Lee_Customer_fatherName'] : ''; ?>">
                  </div>
               <div class="form-group">
                  <label for="exampleInputName1">Date OF Birth</label>
                  <input placeholder="Enter Date Of Birth" name="Lee_Customer_DOB" type="date" class="form-control" id="user_dateohbirth"  required  value="<?php echo isset($_SESSION['form_data']['Lee_Customer_DOB']) ? $_SESSION['form_data']['Lee_Customer_DOB'] : ''; ?>">
               </div>
               <div class="form-group">
                  <label for="exampleInputName1">Address</label>
                  <input placeholder="Enter Address" name="Lee_Customer_address" type="text" class="form-control" id="user_address"  required  value="<?php echo isset($_SESSION['form_data']['Lee_Customer_address']) ? $_SESSION['form_data']['Lee_Customer_address'] : ''; ?>">
               </div>

               <div class="form-group">
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
               <div class="form-group">
                                                    <label for="exampleInputName1">District</label>
                                                        <select required class="form-control" id='city' name="Add_city">
                                                            <option value="">---SELECT---</option>
                                                            <?php
                                                            $main_cate=mysqli_query($config,"select * from dir_city_master");
                                                            while($addsubcate=mysqli_fetch_object($main_cate))
                                                            
                                                            {  
                                                               $selected = (isset($_SESSION['form_data']['Add_city']) && $_SESSION['form_data']['Add_city'] == $addsubcate->dir_city_id) ? 'selected' : '';

                                                            ?>
                    <option value="<?php echo $addsubcate->dir_city_id; ?>" <?php echo $selected; ?>><?php echo $addsubcate->dir_city_name; ?></option>
                    <?php } ?>                                                        
                                                        </select>
                                                       
                                                </div>
                                                <div class="form-group ">
                                                    <label for="exampleInputName1">City</label>
                                                        <div id="area">

                                                        </div>
                                                </div>

                                                
                                                <div class="form-group">
    <label for="exampleInputNumber1">Phone Number</label>
    <input 
        placeholder="Enter Phone Number" 
        name="Lee_Customer_phonenumber" 
        type="tel"
        pattern="[0-9]{10}" 
        maxlength="10"
        required
        class="form-control" 
        id="user_ph"
        aria-describedby="emailHelp" 
        value="<?php echo isset($_SESSION['form_data']['Lee_Customer_phonenumber']) ? $_SESSION['form_data']['Lee_Customer_phonenumber'] : ''; ?>"
        title="Please enter exactly 10 digits">
    <div style="color: red; font-size: 15px; font-weight: 500; margin-top: 10px;" id="phone_no"></div>
</div>


               <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input placeholder="Enter Email" type="email" name="Lee_Customer_email" class="form-control" id="exampleInputEmail1"  aria-describedby="emailHelp" required  value="<?php echo isset($_SESSION['form_data']['Lee_Customer_email']) ? $_SESSION['form_data']['Lee_Customer_email'] : ''; ?>">
                  
               </div>
               <!-- <div class="form-group">
                  <label for="exampleInputNumber1">referred by</label>
                  <input placeholder="Enter Phone Number"   name="referred_by"   onKeyPress="if(this.value.length==10) return false;" type="number" class="form-control"  id="" aria-describedby="emailHelp" >
               </div> -->
              <div class="form-group">
                  <label for="exampleInputPassword1">Pin(Password)</label>
                
                  <input placeholder="Enter Pin Number" maxlength="6"  type="password" name="Lee_Customer_password" class="form-control" id="exampleInputPassword1" required>
            
              <input    type="hidden" name="referal_pro" class="form-control" id="exampleInputPassword1" value="<?php echo base64_decode(urldecode($_GET['pid']))?>">
           <input    type="hidden" name="referal_client" class="form-control" id="exampleInputPassword1" value="<?php echo base64_decode(urldecode($_GET['Recli']))?>">
                  <input   type="hidden" name="referal_code" class="form-control" id="exampleInputPassword1" value="<?php echo base64_decode(urldecode($_GET['prefcode']))?>" >

               </div> 
               
               
               
              <div class="form-group">
                  <label for="exampleInputPassword2">Confirmation Pin (Password)</label>
                  <input placeholder="Enter Confirmation Pin Number" maxlength="6" name="Lee_Customer_confirm_password" type="password" class="form-control" id="exampleInputPassword2" required>
               </div>
               <div class="form-group" style="  margin-left: 6%;">
               <input  name="smsotp"type="hidden" class="form-control" id="smsotp" value="<?php echo rand(0,10000); ?>">
               <input type="checkbox" class="form-check-input " id="exampleCheck1" required>

    <label class="form-check-label " for="exampleCheck1">I agree to the callinfo <a href="terms_and_conditions.php"> Terms and Conditions</a></label>
         </div>
         <div class="form-group" id="o_sms" style="display: none;">
         <label style="Color:red" for="exampleInputPassword1"><b>ENTER YOUR OTP HERE </b></label>         <input  name="esmsotp" type="text" class="form-control" id="esmsotp" >
         </div>
               <button   type="submit" class="btn btn-success rounded btn-lg btn-block" name="lee_account_registration">Create Account</button>
               <?php if (!empty($form_data)) { ?>
            <button type="button" class="btn btn-danger rounded btn-lg btn-block" id="clearForm">Clear Form</button>
        <?php } ?>
            </form>
			 <?php  } ?>		
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
           <center><br><br><a style="
    margin-top: 6%;
    color: black;
" href="Directory.php"> <i class="fa fa-angle-double-left"></i> Back</a></center>
         </div>
      </div>
      <!-- footer fixed -->
      <div class="osahan-fotter fixed-bottom">
         <a href="signin.php" class="btn btn-block btn-lg bg-white">Create New Account Page...</a>
      </div>
     
      <!-- Bootstrap core JavaScript -->
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
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
<script>
   function otp_()
   {

      var id =$('#smsotp').val();
      var user_name =$('#user_name').val();
      var user_ph =$('#user_ph').val();
    
    var eotp=$('#esmsotp').val();
    var smsotp=$('#smsotp').val();
if((user_ph.length == 0)){
   

   // setTimeout(function(){ $(".alert").show(); }, 3000); 
   // $('#pn').show().delay(5000).fadeOut();
   return false;
}else{

   // $('#o_sms').css({"display":"block"});

   //    if(eotp != ''){
   //       if(eotp == smsotp){
          
   //       }else{
   //          $('#pn1').show().delay(5000).fadeOut();
   //          return false;
   //       }
   
   // }else{
      
     
   //    $.ajax({
   //      type: "POST",
   //      url: 'sms.php',
   //      data: {id:id,user_name:user_name,user_ph:user_ph},
   //      success: function(data)
   //      {
      
   //       //  console.log(data);
         
   //      }
   //    });
   //    return false;
      
   // }
}
   }

  




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

            $(document).ready(function() {
    var typingTimer;                // Timer identifier
    var doneTypingInterval = 1000;  // Time in ms, 1 second for example
    var $input = $('#user_ph');

    // On keyup, start the countdown
    $input.on('keyup', function() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(doneTyping, doneTypingInterval);
    });

    // On keydown, clear the countdown 
    $input.on('keydown', function() {
        clearTimeout(typingTimer);
    });

    // User is "finished typing," do something
    function doneTyping() {
        var user_ph = $input.val();
        phone_uni(user_ph);
    }

    function phone_uni(user_ph) {
        $.ajax({
            type: "POST",
            url: 'phone_no.php',
            data: { user_ph: user_ph }, // serializes the form's elements.
            success: function(data) {
                if (data == 1) {
                    $('#phone_no').html("Phone Number Already Registered");
                    $input.val('');
                } else {
                    $('#phone_no').html("");
                }
            }
        });
    }
    $('#registrationForm').on('submit', function (e) {
                // Prevent form submission initially
                e.preventDefault(); // Prevent form submission


                var email = $('#exampleInputEmail1').val();
                var phone = $('#user_ph').val();

                // SweetAlert confirmation
                Swal.fire({
                    title: 'Please confirm the below details:',
                    html: `
                           <strong>Email ID:</strong> <br>${email}<br> <br>
                           <strong>Mobile Number:</strong> <br>${phone}`,                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, submit it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                     var submitButton = $('<input>').attr({
                    type: 'hidden',
                    name: 'lee_account_registration',  // Same name as the button
                    value: 'Create Account'            // You can set this to any appropriate value
                });
                $('#registrationForm').append(submitButton);

                // Delay form submission to ensure SweetAlert closes
                setTimeout(function() {
                    // Submit the form programmatically
                    $('#registrationForm')[0].submit();
                }, 500); 
                    }
                });
            });

});

</script>
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