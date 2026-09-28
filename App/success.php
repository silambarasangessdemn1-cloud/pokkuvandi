<?php include('../App/config/setup.php');
?>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<div class='lap'>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="Askbootstrap">
      <meta name="author" content="Askbootstrap">
      <link rel="icon" type="image/png" href="<?php 
            
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
            
            ?> </title>
      <!-- Bootstrap core CSS -->
      <link href="demo/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <link href="demo/vendor/bootstrap/css/demo.css" rel="stylesheet">
   </head>
   <body>
      <!-- Page Content -->
      <div class="container">
         <div class="row align-items-center hv-100">
            <div class="col-lg-6 text-center">
               <img class="logo" src=" <?php 
            
            $inro_logo=mysqli_query($config,"select Intro_Logo from intro_master");
            while($logo=mysqli_fetch_array($inro_logo))
            {
                

    $ms=substr($logo[0],6);
				  echo  $ms;


            }
            
            ?>" style="width: 180px;">
               <h2 class="mb-3"><?php 
            
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
            
            ?> - <?php 
            
            $introcontent=mysqli_query($config,"select * from intro_master");
            while($ic=mysqli_fetch_object($introcontent))

			{				?><?php echo $ic->Intro_Content;?></h2>
               <img class="mb-3 mt-4 qrcode" src="<?php echo $si=substr($ic->Intro_Image,6);?>">
               <p class="text-danger small mb-5">Scan to View on Your Mobile Device
               </p>
               <p class="my-3"></p>
			   
			<?php } ?>
            </div>
            <div class="col-lg-6 text-center">
               <div class="phone-screen">
                  <div class="f-r">
                  <iframe name="preview" src="successful.php"></iframe> 
                  </div>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>
         </div>

     
<div class='mob'>
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
      <!-- <div class="theme-switch-wrapper">
         <label class="theme-switch" for="checkbox">
            <input type="checkbox" id="checkbox" />
            <div class="slider round"></div>
            <i class="icofont-moon"></i>
         </label>
         <em>Enable Dark Mode!</em>
      </div> -->
      <div class="osahan-success bg-success vh-100">
         <div class="p-5 text-center">
            <i class="icofont-check-circled display-1 text-warning"></i>
            <h1 class="text-white font-weight-bold"><?php echo $session__username;?>, Your order has been successful 🎉</h1>
            <p class="text-white">Check your order status in <a href="complete_order.php" class="font-weight-bold text-decoration-none text-white">My Order</a> about next steps information.</p>
         </div>
      </div>
      <!-- continue -->
      <div class="fixed-bottom fixed-bottom-auto bg-white rounded p-3 m-3 text-center">
         <h6 class="font-weight-bold mb-2">Preparing your order</h6>
         <p class="small text-muted">Your order will be prepared and will come soon</p>
         <a href="progress_order.php" class="btn rounded btn-warning btn-lg btn-block">Track My Order</a>
      </div>
      <?php include('menu.php')?> 
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
      </div>
      
<style>

      .card {

        background: white;

        padding: 60px;

        border-radius: 4px;

        box-shadow: 0 2px 3px #C8D0D8;

        display: inline-block;

        margin: 0 auto;

      }

      .checkmark {

        color: #9ABC66;

        font-size: 100px;

        line-height: 200px;

        margin-left:-15px;

      }

      .ps{

          color: #88B04B;

          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;

          font-weight: 900;

          font-size: 30px;

          margin-bottom: 10px;

        }
        .mob{
           display:none;
        }

</style>
<style>
            @media only screen and (max-width: 600px) {
  .lap{
     display:none ;
  }
  .mob{
           display:block;
        }
}
body {
    font-family: 'Ubuntu', sans-serif;
    font-size: 13px;
    background-color: white;
}
            </style>