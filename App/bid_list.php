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

                <h6 class="font-weight-bold m-0 ml-3 ht" >Services  Enquiry </h6>

                <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>

            </div>

        </div>

    </div>

    <div class="p-3" style="    margin-bottom: 22%;">
    <div class="row">
<div  class="col-12">
    <button style="float:right" type="button" onclick="req_rep()" class="btn btn-outline-success">Download Report</button>
        </div></div>
    
    <div id="result"></div>

      <?php
if ($session_id) {

}else{


  
    echo "<script type='text/javascript'> document.location = 'signin.php'; </script>";
}

$det=mysqli_query($config,"SELECT * FROM `biding_vender` where  cust_id='$session_id' order by (created_at) DESC");  
$vdet=mysqli_fetch_object($det);
// echo $n="SELECT * FROM `biding_enq_pay` INNER JOIN `biding_enq` ON biding_enq_pay.biding_enq=biding_en_id where custom_id='$session_id' group by (biding_enq) ";
  $n="SELECT * FROM `biding_enq` where custom_id='$session_id' and status='new' order by (created_at) DESC  ";            
$about=mysqli_query($config,$n);

                

                while($del=mysqli_fetch_object($about))

                {
                     $cc="SELECT * FROM `biding_post` where  post_id='$del->mid' ";
                  $det=mysqli_query($config,$cc);  
$vdet=mysqli_fetch_object($det);  
                    ?>

<div class="card " style="margin-bottom: 2px;">


<div class="row">
    <div class="col-3">
        <img style="margin-top: 36%;margin-left: 37%;" src="img/keyword_icon/<?php echo $vdet->key_icon?>">
    </div>
    <div class="col-9">
  <div class="card-body">
    <div class="row">
        <div class="col-7">
      <h6><?php echo $title=$vdet->keyword?></h6></div>
      <div class="col-5">
      <h6 style=" margin-left: 19%;
    color: green;
    font-weight: 700;"> Enquiry <?php 
    
    $det6=mysqli_query($config,"SELECT count(biding_enq_pay_id) as eq,selecid FROM `biding_enq_pay` where  biding_enq='$del->biding_en_id'");  
    $vdet6=mysqli_fetch_object($det6); 
   echo $vdet6->eq; 
    ?></h6></div></div>

    <?php if($del->price){?>
        <p>Rs.<?php echo $del->price ?></p>
        <?php }?>
    <p><?php echo $del->description ?></p>
    <small><?php echo $del->created_at_time ?></small>
    <?php 
    
    $det=mysqli_query($config,"SELECT * FROM `biding_enq_pay` where  biding_enq='$del->biding_en_id'");  
    $vdet=mysqli_fetch_object($det);  
    ?>
    <?php if($vdet->order_id == 2  and $vdet->selecid == 0){
  echo '<div class="alert alert-danger" role="alert">
  The Ticket Was Closed
</div>';  
}elseif($del->order_id == 0){?>
    <a href="bid_list_details.php?biding_enq_pay_id=<?php echo $del->biding_en_id;?>&title=<?php echo $title?>" style="float: right;" type="button" class="btn btn-<?php if($vdet6->selecid != 0){ echo 'success';}else{echo 'warning';} ?> btn-sm"><?php if($vdet6->selecid != 0){ echo 'Accepted';}else{echo 'View Ticket';} ?></a>
  <?php }elseif($del->order_id == 1){?>
    
    <a href="bid_list_details.php?biding_enq_pay_id=<?php echo $del->biding_en_id;?>&title=<?php echo $title?>" style="float: right;" type="button" class="btn btn-warning btn-sm">View Details</a>
<?php }?>
<?php if($vdet6->selecid != 0){?>
    
    <?php     echo '<br><div class="alert alert-success mt-4" role="alert">
    Ticket Was Accepted
  </div>';
} ?>
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
function req_rep(){
    var  msg='';
    id='mail';
    $.ajax({
        type: "POST",
        url: 'biding_down.php',
        data: {id:id }, // serializes the form's elements.
        success: function(data)
        {
         if(data)
         {
          console.log(data); 
           msg +='<div class="alert alert-success" role="alert">Thank you for requesting,  kindly check your registered Mail </div>';
         $('#result').html(msg);
        }
        }
    });

}

</script>
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


