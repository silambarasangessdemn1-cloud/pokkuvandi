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

                <a class="font-weight-bold text-success text-decoration-none" href="Bidding.php">

                    <i class="icofont-rounded-left back-page"></i></a>

                <h6 class="font-weight-bold m-0 ml-3 ht">Services Enquiry </h6>

                <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>

            </div>

        </div>

    </div>

    <div class="p-3"style="margin-bottom: 33%;">
<div id="result"></div>

      <?php

// $det=mysqli_query($config,"SELECT * FROM `biding_vender` where  cust_id='$session_id'");  
// $vdet=mysqli_fetch_object($det);
                $about=mysqli_query($config,"SELECT * FROM `biding_enq` where custom_id='$session_id' order by biding_en_id DESC ");

                

                while($del=mysqli_fetch_object($about))

                {
                  $det=mysqli_query($config,"SELECT * FROM `biding_post` where  post_id='$del->mid'");  
$vdet=mysqli_fetch_object($det);  
                    ?>

<div class="card " style="margin-bottom: 2px;">


<div class="row">
    <div class="col-3">
        <img style="margin-top: 36%;margin-left: 27%;" src="img/keyword_icon/<?php echo $vdet->key_icon?>">
    </div>
    <div class="col-9">
  <div class="card-body">
      <h5><?php echo $vdet->keyword?></h5>
      <p>Rs.<?php echo $del->price ?></p>
    <p><?php echo $del->description ?></p>
    <small><?php echo $del->created_at_time ?></small>
    <?php if($del->order_id == 2){
  echo '<div class="alert alert-danger" role="alert">
  The Ticket Was Appointmented To Another
</div>';  
}elseif($del->status == 'new'){?>
    <a href="#" style="float: right;" type="button" class="btn btn-success btn-sm">Active</a>
  <?php }elseif($del->status == 'cancel'){?>
    
    <a href="#" style="float: right;" type="button" class="btn btn-danger btn-sm">In-Active</a>
<?php }?>
  </div>
  </div>
</div>
</div>


        <?php }				?>

      

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

<script>
  function  biding_pay(enq_id,vender,amount){
   console.log(enq_id);
   console.log(vender);
   var msg='';
    // window.location.href = "home.php";
    $.ajax({
        type: "POST",
        url: 'biding_pay.php',
        data: {enq_id :enq_id,vender:vender,amount:amount }, // serializes the form's elements.
        success: function(data)
        {
         if(data == 1)
         {
            window.location.href = "biding_details.php";  
         }elseif(data == 2)
         {
            window.location.href = "biding_details.php";  
         }
         elseif(data == 3)
         {
            msg +='<div class="alert alert-danger" role="alert">Please Top Up Your Vendor Wallet!</div>';
         $('#result').html(msg);
        }
        }
    });


    }
</script>

<style>
    .dark body {
    background-color: #000;
    color: black;
}
.dark body .ht{
    color:white;
}
</style>