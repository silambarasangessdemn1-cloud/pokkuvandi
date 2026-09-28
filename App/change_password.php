 <?php include('config/setup.php');?>
 <?php include('session.php');?>
 
 <?php
 if(isset($_POST['customer_password_change']))
 { 

 $chang_old_Password = md5($_POST['old_password']); 
 
$trimmed_str = trim($chang_old_Password);
 
if($trimmed_str == $session__password )
{
  $new_EncryptPassword = trim(md5($_POST['new_password']));
$passcustediton=date('Y-m-d');
$update_customer=mysqli_query($config,"update customer_master set Customer_Password='".trim($new_EncryptPassword)."',Customer_Registred_on='$passcustediton' where Customer_Id='$session_id'");
unset($_COOKIE['$session__password']);

unset($_COOKIE["member_password"]);


header('location:logout.php?action=session_Expired');
}else{
	echo "<script>alert('Old Password Mis-Matched') </script>";
	
}
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
      <div class="osahan-help">
         <div class="p-3 border-bottom">
            <div class="d-flex align-items-center">
               <a class="font-weight-bold text-success text-decoration-none" href="edit_profile.php">
               <i class="icofont-rounded-left back-page"></i></a>
               <h6 class="font-weight-bold m-0 ml-3">Change Password</h6>
               <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>
            </div>
         </div>
      </div>
      <div id="edit_profile">
         <div class="p-3">
            <form action="change_password.php" method="post">
               <div class="form-group">
                  <label for="exampleInputOLDPassword1">Old Password</label>
                  <input type="password" placeholder="Enter Old Password" name="old_password" class="form-control" id="exampleInputOLDPassword1">
               </div>
               <div class="form-group">
                  <label for="exampleInputNEWPassword1">New Password</label>
                  <input type="password" placeholder="Enter New Password" name="new_password" class="form-control" id="exampleInputNEWPassword1">
               </div>
               <div class="text-center">
                  <button type="submit" class="btn btn-success btn-block btn-lg" name="customer_password_change">Save Changes</button>
               </div>
            </form>
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
   </body>
</html>