<?php include('config/setup.php')?>
<?php include('session.php');?>	
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
      <!-- Osahan Index -->
      <div class="osahan-index">
      <div class="border-bottom p-3 d-flex align-items-center">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <center> <img class="index-osahan-logo" src="
            <?php 
             
error_reporting(E_ALL);
 
ini_set('display_errors', 0);
			
			
			
			
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

}}?>" alt="leefoodies Logo" style="
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
		 
		 if($_GET['success'] == 100)
		 {
			 
			 ?>
             <div class="card" style="width: 96%;
    padding: 4%;
    margin: auto;
    margin-top: 12%;">
			 <center><img src="check-mark.png" style="width: 80px;height: 80px;margin-top: 8%;"></center>
             <center>
                <p style="color:green;font-size: 16px;">Your Account Has Been Created Successfully.</p>
                <!-- <p>You will shortly receive a confirmation email from us.</p>

<p>kindly verify your email address from the link provided in that email.
Thanks</p> -->
             </center>
             <!-- <center><a href="signin.php" class="btn btn-primary"> Login <i class="fa fa-chevron-right"></i></a></center> -->
             <center><a href="Directory.php?msg=newlogin" class="btn btn-primary"> Go <i class="fa fa-chevron-right"></i></a></center>
             

             </div>
			 



			
		<?php }elseif($_GET['already'] == 200)
		 
		 
		 
		 {
		 ?>
		 
		 <center><h5 style="margin-top: 150px;color:#de5b0b;"> Account Already Exist</h5> 	</center>
			 
			 <center><a href="signin.php" class="btn btn-warning"> Signin Now</a></center>
		 
		 
		 
		 	<?php }elseif($_GET['mismatch'] == 404)
		 
		 
		 
		 {
		 ?>
		 
		 <center><h5 style="margin-top: 150px;color:#ff0404;"> Password Mis-Matching,try Agian</h5> 	</center>
			 
			 <center><a href="signup.php" class="btn btn-danger"> Signup Now</a></center>
		 
		 
		 <?php }else if($_GET['visitor_id'] == 505)
		 { 
     $visit_on=date("Y-m-d");
	 $visitors=mysqli_query($config,"insert into visiting_history(visting_date)values('$visit_on')");
	 header('location:home.php');
   	 }?>
		 
		 
		 
		 
		 
		 
		 
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