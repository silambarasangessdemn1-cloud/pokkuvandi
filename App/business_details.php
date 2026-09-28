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

                <a class="font-weight-bold text-success text-decoration-none" href="Business_Enquiry.php">

                    <i class="icofont-rounded-left back-page"></i></a>

                <h6 class="font-weight-bold m-0 ml-3">Business Enquiry Details </h6>

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

// $det=mysqli_query($config,"SELECT * FROM `dir_vender` where  cust_id='$session_id' ");  
// $vdet=mysqli_fetch_object($det);
// echo $n="SELECT * FROM `biding_enq_pay` INNER JOIN `biding_enq` ON biding_enq_pay.biding_enq=biding_en_id where custom_id='$session_id' group by (biding_enq) ";
 
if($_GET['bid2'])
{


    $n="SELECT * FROM `dir_bussness` where dir_bu_id='".$_GET['bid2']."'  ";            
    $about=mysqli_query($config,$n);
    
                    
    
              $del=mysqli_fetch_object($about);
    
         
                         $cc="SELECT * FROM `dir_post`  where  dir_post_id='$del->e_vender_key' ";
                      $det=mysqli_query($config,$cc);  
    $vbdet=mysqli_fetch_object($det);  
    if($del->enq_view == 0)
    {
        $sqlnn = "UPDATE dir_bussness SET enq_view='1' where dir_bu_id='".$_GET['bid2']."' ";
        $detmm=mysqli_query($config,$sqlnn);  
       
    }
                        ?>
    
    <div class="card " style="margin-bottom: 2px;">
    
    
    
      
    
        <div class="col-12">
      <div class="card-body">
     <center> <img style="width: 100px;"  src="img/keyword_icon/<?php echo $vbdet->dir_key_icon?>"></center>
    <br>
          <h5><b>Keyword </b> <span style="color: red;"><?php echo $title=$vbdet->dir_keyword?></span></h5>
    
          <?php 
            $cc="SELECT * FROM `dir_city_master` where  dir_city_id='$del->e_area' ";
            $detv=mysqli_query($config,$cc);  
    $vbdetv=mysqli_fetch_object($detv);  ?>
           <h5><b>City </b>  <span  style="color: blue;"> <?php echo $vbdetv->dir_city_name ?></span></h5>
      
      <p><b>Date </b>  <span><?php $currentDateTime =$del->created_at_time;
    echo $newDateTime = date('d/m/Y h:i A', strtotime($currentDateTime));
     ?></span>
       <p><b>NAME </b> <span style="font-size:13px;"><?php echo $del->e_name ?></span></p>
      <p><b>NUMBER</b>  <span style="font-size:13px;"><?php echo $del->e_phone ?></span></p>
      <p><b>EMAIL</b>  <span style="font-size:13px;"><?php echo $del->e_email ?></span></p>
    
      <p><?php echo $del->e_msg; ?></p>
      </div>
      </div>
    </div>
    
    


<?php }
else{


 $n="SELECT * FROM `dir_com_enq` INNER JOIN dir_com_vender_enq ON dir_com_vender_enq.com_enq_id=dir_com_enq.dir_com_id where dir_com_id='".$_GET['bid']."'  ";            
$about=mysqli_query($config,$n);
 $del=mysqli_fetch_object($about);

 

if($del->view_enq_re == 0)
{
 $sqlnn = "UPDATE dir_com_vender_enq SET view_enq_re='1' where com_enq_id='".$_GET['bid']."' and com_vid='".$_GET['vender']."' ";
$detmm=mysqli_query($config,$sqlnn);  

}


                     $cc="SELECT * FROM `dir_post`  where  dir_post_id='$del->com_key' ";
                  $det=mysqli_query($config,$cc);  
$vbdet=mysqli_fetch_object($det);  
                    ?>

<div class="card " style="margin-bottom: 2px;">



  

    <div class="col-12">
  <div class="card-body">
 <center> <img style="width: 100px;"  src="img/keyword_icon/<?php echo $vbdet->dir_key_icon?>"></center>
<br>
      <h5><b>Keyword </b> <span style="color: red;"><?php echo $title=$vbdet->dir_keyword?></span></h5>

      <?php 
        $cc="SELECT * FROM `dir_city_master` where  dir_city_id='$del->com_city' ";
        $detv=mysqli_query($config,$cc);  
$vbdetv=mysqli_fetch_object($detv);  ?>
       <h5><b>City </b>  <span style="color: blue;"> <?php echo $vbdetv->dir_city_name ?></span></h5>
  
  <p><b>Date </b>  <span><?php $currentDateTime =$del->created_at_time;
echo $newDateTime = date('d/m/Y h:i A', strtotime($currentDateTime));
 ?></span>
   <p><b>NAME </b> <span style="font-size:13px;"><?php echo $del->com_enq_name ?></span></p>
  <p><b>NUMBER</b>  <span style="font-size:13px;"><?php echo $del->com_enq_phone ?></span></p>
  <p><b>EMAIL</b>  <span style="font-size:13px;"><?php echo $del->com_enq_email ?></span></p>

  <p><?php echo $del->com_enq_msg; ?></p>
  </div>
  </div>
</div>



      
<?php }?>
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

