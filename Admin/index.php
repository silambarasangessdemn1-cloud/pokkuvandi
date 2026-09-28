<?php
include('config/setup.php');
session_start();
if(isset($_POST['user_login']))
{

	  $mast_log_password=md5($_POST['log_password']);
 $result22=mysqli_query($config,"select * from master_login where Master_Username='".$_POST['log_mail']."' and Master_Password='$mast_log_password' ");	
$user = mysqli_fetch_array($result22);
if($user){
			
		$logg=$user["Master_Active_Status"];
 
		if(	$logg == 1)
		{
			
			$_SESSION["usr_id"] = $user["Master_id"];
		
     header('location:Main/dashboard.php');
		 


}else{
    
    	echo "<script> alert('Your Login is Locked')</script>";
    
}


	} else {
		
		echo "<script> alert('Invalid Login')</script>";
	}
}














?>

 

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/login/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="assets/login/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/login/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b>Admin</b>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="index.php" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Enter your Username" name="log_mail">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Enter your Username" name="log_password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
         
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block" name="user_login">Login</button>
             
          </div> 
          <!-- /.col -->
        </div>
      </form>

     
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="assets/login/ plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/login/ plugins/bootstr bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/login/ di adminlte.min.js"></script>
</body>
</html>
