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

        <div class="p-3 border-bottom bg-white">

           <div class="d-flex align-items-center">

              <a class="font-weight-bold text-success text-decoration-none" href="Bidding.php">

              <i class="icofont-rounded-left back-page"></i></a>

              <h6 class="font-weight-bold m-0 ml-3">Vendor Wallet</h6>

              <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>

           </div>

        </div>

     </div>

     <div class="p-3">

       

      <?php



                $about=mysqli_query($config,"SELECT * FROM `biding_vender` where cust_id='$session_id'");

                
$del=mysqli_fetch_object($about);
$pac=mysqli_query($config,"SELECT * FROM `biding_package` where packid='".$del->vender_package."'");

                
$package=mysqli_fetch_object($pac);
			?>
   <div class="card" style="width: 100%;">
  <div class="card-body">
    <h5 class="card-title">Balance Amount Rs.<?php echo $del->topupamount?></h5>
  
  </div>

</div>  

       <form action="topuppay.php" method="GET" target="_parent" >
  <div class="form-group">
  <input readonly type="hidden" class="form-control" id="exampleInputName1" name="customername" value="<?php echo $session__username;?>">
  <input readonly type="hidden" class="form-control" id="exampleInputNumber1" name="customerphone" value="<?php echo $session__phone; ?>">
  <input readonly type="hidden" class="form-control" id="exampleInputEmail1" name="customermail" value="<?php echo $session__mail;?>">
  <input  type="hidden" class="form-control" id="" name="sessionid" value="<?php echo $session_id ?>" >

  <div class="form-group">
    <label for="exampleInputPassword1">Amount (Minimum Top Up Amount Rs.<?php echo $package->minamount ?>)</label>
   <br> <input type="number" name="totalpay" min="<?php echo $package->minamount ?>"  class="form-control" id="exampleInputPassword1" placeholder="Enter your amount">
  </div>

  <button type="submit" class="btn btn-primary">Topup amount</button>
</form>
<div style="margin-top:3%;">
<br>
<?php   $aboutw=mysqli_query($config,"SELECT * FROM `biding_enq_pay` where ve_id='$del->vender_id'");

                
while($delw=mysqli_fetch_object($aboutw))
{?>
<div class="card">
  <div class="card-body">
  <div class="row">
     <div class="col-3">
        <img src="paying.png" style="width: 80px;">
     </div>
     <div class="col-9">
        <h5>Paid Amount : <b style="color: red;">(-) Rs.<?php echo $delw->biding_amount?></b></h5>
        <h6>Date  : <b> <?php $date=date_create($delw->created_msg);
echo date_format($date,"d/m/Y "); ?></b></h6>
     </div>
  </div>
  </div>
</div>
<?php }?>

     </div>
     </div>
        <?php include('footermenu.php');?>

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