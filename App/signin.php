<?php include('config/setup.php');

// Set session cookie for 1 week
$cookie_lifetime = 7 * 24 * 60 * 60; // 1 week
session_set_cookie_params([
    'lifetime' => $cookie_lifetime,
    'path' => '/',
    'secure' => isset($_SERVER['HTTPS']),
    'httponly' => true,
    'samesite' => 'Lax'
]);
session_start();
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
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
            padding: 40px 25px !important;
         }
         .form-container h2 {
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
         .btn-google {
            background: #ffffff;
            color: #d32f2f;
            border: 1px solid #f5c6c6;
            border-radius: 12px;
            padding: 14px;
            font-weight: 600;
            transition: all 0.3s;
         }
         .btn-google:hover {
            background: #fffafa;
            color: #c62828;
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
         .theme-switch-wrapper {
            display: none;
         }
      </style>
   </head>
<?php

error_reporting(0);
ini_set('display_errors', 0);


if($_GET['verify'])
{
   $cid=$_GET['cid'];
   $sqll = "UPDATE customer_master SET Customer_Active_Status='1' WHERE Customer_Id=$cid";
   mysqli_query($config,$sqll);
}
if (isset($_POST['login_submit'])) {
   $log_act = $_POST['lee_mobile_number'];
   $log_actlog = ($_POST['lee_password']);
   $EncryptPassword = md5($log_actlog);

   // Query to check if the mobile number exists
   $result_mobile = mysqli_query($config, "SELECT * FROM customer_master WHERE Customer_Phone_No='$log_act'");
   $user_mobile = mysqli_fetch_array($result_mobile);

   // Query to check if the password exists (for any user, regardless of phone number)
   $result_password = mysqli_query($config, "SELECT * FROM customer_master WHERE Customer_Password='$EncryptPassword'");
   $user_password = mysqli_fetch_array($result_password);

   // Query to check if both mobile and password match
   $result_both = mysqli_query($config, "SELECT * FROM customer_master WHERE Customer_Phone_No='$log_act' AND Customer_Password='$EncryptPassword'");
   $user_both = mysqli_fetch_array($result_both);

   // If both mobile number and password are wrong
  
   // If only mobile number is incorrect
  if (!$user_mobile) {
       echo "<script>
       window.onload = function() {
           Swal.fire({
               icon: 'error',
               title: 'Mobile Number Not Found.!',
                          text: 'Please check the User Mobile Number: $log_act'

           });
       };
       </script>";
   }
   // If only password is incorrect
   elseif ($user_mobile && !$user_both) {
       echo "<script>
       window.onload = function() {
           Swal.fire({
               icon: 'error',
               title: 'Incorrect Password!',
               text: 'User Mobile and Password not matched.'
           });
       };
       </script>";
   } 
   // If both credentials are correct, proceed with login

//    elseif (!$user_mobile && $user_mobile['Customer_Password'] !== $EncryptPassword) {
//     echo "<script>
//     window.onload = function() {
//         Swal.fire({
//             icon: 'error',
//             title: 'Invalid Credentials!',
//             text: 'User Mobile and Password not matched.'
//         });
//     };
//     </script>";
// }
   else {
       $_SESSION["member_id"] = $user_both["Customer_Id"];
       $visit_on = date("Y-m-d");

       mysqli_query($config, "INSERT INTO visiting_history(visting_date, customer_id) VALUES('$visit_on', '".$user_both["Customer_Id"]."')");

       // Handle Remember Me functionality
       if (!empty($_POST["remember"])) {
           setcookie("member_login", $_POST["lee_mobile_number"], time() + (10 * 365 * 24 * 60 * 60));
           setcookie("member_password", $_POST["lee_password"], time() + (10 * 365 * 24 * 60 * 60));
       } else {
           setcookie("member_login", "", time() - 3600);
           setcookie("member_password", "", time() - 3600);
       }

       // Redirect if referral data exists
       if (!empty($_POST['rp1']) && !empty($_POST['rc1']) && !empty($_POST['rco1'])) {
           header('location:product_details_referal.php?Prodetail='.urlencode(base64_encode($_POST['rp1'])).'&referalcode='.urlencode(base64_encode($_POST['rco1'])).'&cli='.urlencode(base64_encode($_POST['rc1']))); 
           exit;
       }
   }
}
?>	 
		


   <body class="fixed-bottom-padding">
      <div class="theme-switch-wrapper">
         <label class="theme-switch" for="checkbox">
            <input type="checkbox" id="checkbox" />
            <div class="slider round"></div>
            <i class="icofont-moon"></i>
         </label>
         <em>Enable Dark Mode!</em>
      </div>
      <!-- sign in -->
      <div class="osahan-signin">
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

         <div class="p-3 form-container">
            <h2 class="my-0">Welcome Back!</h2>
            <!-- <p class="small text-center text-muted mb-4">Service Provider Login</p> -->
            <?php if($_GET['verify']){ ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Your account has been successfully verified</strong> 
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php }?>
           <?php if(empty($_SESSION["member_id"])) { ?>

		   <form action="signin.php" method="post">
               <div class="form-group mt-3">
                  <label for="exampleInputEmail1">Mobile Number</label>
                  <input placeholder="Enter Your Registered Mobile Number" type="number" required class="form-control" name="lee_mobile_number" id="exampleInputEmail1" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>">
               </div>
               <div class="form-group">
                  <label for="exampleInputPassword1">Pin(Password )</label>
                  <input placeholder="Enter Pin Number" maxlength="6" type="password" name="lee_password" required class="form-control" id="exampleInputPassword1" value="<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>">
            
                              <input  type="hidden" name="rp1"  class="form-control" id="exampleInputPassword1" value="<?php echo $_GET['rp'];  ?>">

                              <input  type="hidden" name="rc1"  class="form-control" id="exampleInputPassword1" value="<?php echo $_GET['rc']; ?>">
                    <input  type="hidden" name="rco1"  class="form-control" id="exampleInputPassword1" value="<?php echo $_GET['rco']; ?>">

            
               </div>
            
<div class="custom-control custom-checkbox small">
                                                <div class="form-check">
                                                 
                                                <input class="form-check-input custom-control-input" type="checkbox" name="remember" id="remember" <?php if(isset($_COOKIE["member_login"])) { echo "checked"; } ?>></div>
                                            </div>




			<button type="submit"  class="btn btn-success btn-lg rounded btn-block" name="login_submit">Sign in</button>
            </form>
           <?php } 

else {
    echo "<script>
    window.onload = function() {
        Swal.fire({
            icon: 'success',
            title: 'Welcome to Pokkuvandi. Signed in Successfully..!',
            text: 'Redirecting...',
            timer: 1500,
            showConfirmButton: false
        }).then(() => {
            // Ask whether user is driver or customer
            Swal.fire({
                title: 'Please Select',
                text: 'Are you a Driver or Customer?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Driver',
                cancelButtonText: 'Customer',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // Driver selected
                    localStorage.setItem('user_type', 'driver');
                    window.location.href = 'Directory.php'; // or your driver page
                } else {
                    // Customer selected
                    localStorage.setItem('user_type', 'customer');
                    window.location.href = 'Directory.php'; // or your customer page
                }
            });
        });
    };
 </script>";
}
	  ?>
		   <p class="text-muted text-center small m-0 py-3">or</p>
             
             <a href="forgetpassword.php" class="btn btn-danger btn-block rounded btn-lg btn-google">
          Forget Password
            </a>  
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

            <center><br><br><a style="
    margin-top: 6%;
    color: black;
" href="Directory.php"> <i class="fa fa-angle-double-left"></i> Back</a></center>
         </div>
      </div>
      <!-- footer fixed -->
      <div class="osahan-fotter fixed-bottom">
         <a href="signup.php" class="btn btn-block btn-lg bg-white">Create New User Account</a>
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

<div class="modal fade modal-dialog-centere" id="exampleModalterm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="height:95% !important">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="height: 100%;">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Terms & Conditions </h5>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
      </div>
      <div class="modal-body">
       <p>The vehicle directory's terms and conditions govern the use of the platform by its users. By accessing and utilizing the services provided, users agree to abide by these terms. The directory grants eligible users the right to access and view its content while also outlining responsibilities and restrictions. Users must comply with all applicable laws and regulations while using the platform. The directory retains ownership of its content, including copyrights and trademarks. Additionally, users must respect the privacy of others and adhere to the guidelines for user-generated content. When listing vehicles or related services, users are required to provide accurate and reliable information while following the specified guidelines. The directory may contain links to third-party websites, and users acknowledge that these external entities are beyond the directory's control, disclaiming any responsibility for their content. While the directory strives for accuracy and reliability, it does not guarantee the correctness of information provided and is not liable for any damages resulting from its use. Users found violating the terms and conditions may face termination of their access to the platform. The directory reserves the right to modify these terms at its discretion and will notify users of any changes. </p>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
        <button style="width:30%" type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">Ok</button>
      </div>
    </div>
  </div>
</div>