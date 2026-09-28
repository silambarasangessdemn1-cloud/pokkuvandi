<?php include('config/setup.php');?>

<?php include('session.php');



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

    <link rel="stylesheet" type="text/css" href="vendor/slick/slick.min.css" />

    <link rel="stylesheet" type="text/css" href="vendor/slick/slick-theme.min.css" />

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

<div class="p-3 border-bottom bg-white">

    <div class="d-flex align-items-center">

        <a class="font-weight-bold text-success text-decoration-none" href="Directory.php">

            <i class="icofont-rounded-left back-page"></i></a>

        <h6 class="font-weight-bold m-0 ml-3">Directory Details   </h6>

        <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>

    </div>

</div>

</div>

<div class="osahan-help">

  <div class="container">
      <?php 
      
 $det=mysqli_query($config,"SELECT * FROM `dir_vender` INNER JOIN dir_package ON dir_package.dir_packid=dir_vender.packid where  cust_id='$session_id' ");  
 $vdet=mysqli_fetch_object($det);
 $vdet->dir_vender_id;

 $sql7="SELECT * FROM `dir_keyword` INNER JOIN dir_area_master ON dir_area_master.dir_area_id=dir_keyword.dir_vender_area where  dir_vender_id='$vdet->dir_vender_id' GROUP by(dir_area_id)";
 $mainarea=mysqli_query($config,$sql7);?>      
<div class="">
    <center><span>Payment Id : <b style="color:green"><?php echo $vdet->dir_pay_id;?></b></span><br>
    <h6>Package : <b style="color:green"><?php echo $vdet->dir_title;?></b></h5>
    <h6>Ex Date : <b style="color:green"><?php echo $vdet->ex_date;?></b></h5>
</center>
<a style="float: right;" class="btn btn-primary" href="dir_help_enq.php" role="button">Contact Admin </a>

<?php 

 while($b_area=mysqli_fetch_object($mainarea))
 { 
     $sql9="SELECT * FROM `dir_keyword` INNER JOIN dir_post ON dir_keyword.dir_vender_key=dir_post.dir_post_id  INNER JOIN dir_package ON dir_package.dir_packid=dir_keyword.dir_vender_pack where  dir_vender_id=' $vdet->dir_vender_id' ";
    $maina=mysqli_query($config,$sql9);
    ?>
    <h5 style='color:red;    margin-left: 2%;
    margin-top: 2%;
    margin-bottom: 0%;font-size: 17px;'><b>
 Area <span style="color: green;">(<?php echo $b_area->dir_area_name?>)</span></b>

</h5>
<hr>
<div class="">
<?php
    while($barea=mysqli_fetch_object($maina))
    { ?>
<div class="col-12">
    <div class="keys">
  <p class="" style="margin: 3%;margin-left: 16%;"><?php echo $barea->dir_keyword?> &nbsp; <small style="color: yellow;">(<?php  echo $barea->dir_title?>)</small> 
    </p>
    </div>
</div>

<?php }
?>
</div>
</div>
<?php
} ?>

  </div>	

</div>
    

    <?php include('promo_footermenu.php');?>

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

<style>
    .nav-tabs .nav-item {
    margin-bottom: -1px;
    width: 50%;
}
.keys {
    border: 1px solid rgb(4, 170, 109);
    padding: 1%;
    margin: 1%;
    background: rgb(4, 170, 109);
    border-radius: 23px;
    color: white;
    font-weight: 400;
}
</style>

