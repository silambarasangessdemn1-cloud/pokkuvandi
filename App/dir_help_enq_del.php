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

        <a class="font-weight-bold text-success text-decoration-none" href="dir_help_enq.php">

            <i class="icofont-rounded-left back-page"></i></a>

        <h6 class="font-weight-bold m-0 ml-3">Directory Help    </h6>

        <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>

    </div>

</div>

</div>
<?php 
$det=mysqli_query($config,"SELECT * FROM `dir_vender` where  cust_id='$session_id' ");  
        $vdet=mysqli_fetch_object($det);
        ?>
<div class="osahan-help">

 

<div class="container">
<?php 

$n2="SELECT * FROM `dir_help_replay` INNER JOIN dir_help_enq ON dir_help_enq.dir_help_enq_id=dir_help_replay.dir_help_replay_lid where dir_help_replay_lid='".$_GET['bid']."'  order by(dir_help_replay_id) DESC ";            
$about=mysqli_query($config,$n2);

              

              while($del=mysqli_fetch_object($about))

              {
                  
                  ?>

<div class="card " style="margin-bottom: 2px;">




      
 

<div class="card-body">
<?php if($del->dir_help_replay_img){?>
<center><img style="width:100%;height:200px;" src="img/dir_help/<?php echo $del->dir_help_replay_img?>"></center>

<?php }?>



  <p><?php echo $del->dir_help_replay_desc; ?></p>
  <small><?php $currentDateTime =$del->created_at_time;
echo $newDateTime = date('d/m/Y h:i A', strtotime($currentDateTime));
?></small>
 
 

</div>
</div>



      <?php }				?>

  
</div>







<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Help</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="dir_help_cont.php" method="POST"  enctype="multipart/form-data">
  <div class="form-group">
    <label for="exampleInputEmail1">File </label>
    <input name="vid" type="hidden" class="form-control" id="exampleInputEmail1" value="<?php echo  $vdet->dir_vender_id?>">

    <input name="image" type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Description </label>
    <textarea name="desc" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
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

