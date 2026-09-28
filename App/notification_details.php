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

                <a class="font-weight-bold text-success text-decoration-none" href="ven_notification.php">

                    <i class="icofont-rounded-left back-page"></i></a>

                <h6 class="font-weight-bold m-0 ml-3 ht">NOTIFICATION (SUPPORT) </h6>

                <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>

            </div>

        </div>

    </div>

    <div class="p-3">
<div id="result"></div>

      <?php
if ($session_id) {

}else{


  
    echo "<script type='text/javascript'> document.location = 'signin.php'; </script>";
}

$det=mysqli_query($config,"SELECT * FROM `dir_vender` where  cust_id='$session_id' ");  
$vdet=mysqli_fetch_object($det);
// echo $n="SELECT * FROM `biding_enq_pay` INNER JOIN `biding_enq` ON biding_enq_pay.biding_enq=biding_en_id where custom_id='$session_id' group by (biding_enq) ";
 


$detbb=mysqli_query($config,"SELECT * FROM `notification` where  n_id='".$_GET['bid']."' and n_status='0' ");  
           

$del=mysqli_fetch_object($detbb);
                        ?>
    
    <div class="card " style="margin-bottom: 2px;">


<div class="row">
    
 
    
  <div class="card-body">
  <img  style="width:100%;" src="img/dir_gallery/<?php echo $del->n_img?>">

      <h5><?php echo $title=$del->title?></h5>

      
    <p><?php echo $del->description; ?></p>
    <small><?php $currentDateTime =$del->created_at;
echo $newDateTime = date('d/m/Y h:i A', strtotime($currentDateTime));
 ?></small>
   
  
  </div>
  </div>
    </div>
    <?php
if($vdet->dir_vender_id){

    if($del->n_type == 1){
if($del->replay == 0){
     ?>
    <div class="card" style="margin-bottom: 10%;">
  <div class="card-body">
  <form action="dir_edit.php" method="post" enctype="multipart/form-data">

  <div class="form-group">
    <label for="exampleInputEmail1">File</label>
    <input type="file" class="form-control" id="exampleInputEmail1" name="logo">
    <input type="hidden" class="form-control" id="exampleInputEmail1" name="id" value="<?php echo $vdet->dir_vender_id ?>">

    <input type="hidden" class="form-control" id="exampleInputEmail1" name="eid" value="<?php echo $_GET['bid'] ?>">
</div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Description</label>
    <textarea name="desc" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
  <button type="submit" name="sub" class="btn btn-primary">Submit</button>
  </form>
  </div>
</div>

    <?php } }
    }else{
        if($del->n_type == 0){
if( $del->replay == 0 ){
?>
<div class="card">
<div class="card-body">
<form action="dir_edit.php" method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="exampleInputEmail1">File</label>
<input type="file" class="form-control" id="exampleInputEmail1" name="logo">
<input type="text" class="form-control" id="exampleInputEmail1" name="eid" value="<?php echo $_GET['bid'] ?>">

<input type="text" class="form-control" id="exampleInputEmail1" name="id" value="<?php echo $session_id ?>">
</div>
<div class="form-group">
<label for="exampleFormControlTextarea1">Description</label>
<textarea name="desc" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
</div>
<button type="submit" name="sub" class="btn btn-primary">Submit</button>
</form>
</div>
</div>

<?php } }

 }?>
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

<style>
    .dark body {
    background-color: #000;
    color: black;
}
.dark body .ht{
    color:white;
}
</style>