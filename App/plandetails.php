<?php include('config/setup.php');?>


 <?php include('session.php');


 


	?>


<?php


 $ms="SELECT * FROM `membership_list` where user_id='$session_id'";


 $msql=mysqli_query($config,$ms);


 $msqld=mysqli_fetch_object($msql);


if($msqld->user_id)


{


  


//    header("location:membershipdetails.php");


//    die;


}


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


               <a class="font-weight-bold text-success text-decoration-none" href="home.php">


               <i class="icofont-rounded-left back-page"></i></a>


               <h6 class="font-weight-bold m-0 ml-3">Membership</h6>


               <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>


            </div>


         </div>


      </div>


      <?php


				 


				 $about=mysqli_query($config,"select * from membership");


				 


				$del=mysqli_fetch_object($about);


				 


                 ?>


      <div class="p-3">


         <h4 class="mb-3"><?php echo $del->title; ?></h4>


         <p class="text-muted"> 


		 </p>





      </div>


      <div class="container" style="    margin-bottom: 100px;">


          <div class="row">


             


             





             <div class="teaser boxs" style=""> <?php echo substr($del->description,0,300); ?>


             <button style="float:right" id='more' type="button" class="btn btn-secondary btn-sm">Read more..</button><br><br>


</div>


             <div class="complete boxs"> <?php echo $del->description; ?></div>


             


          </div><br>


          <?php echo $del->video; ?>





          


          <!-- <a href="membershiporder.php?amount=<?php echo $del->price ?>&planid=<?php echo $del->mid ?>" style="margin-top:3%;" type="button" class="btn btn-outline-success btn-lg btn-block"> Rs: <?php echo $del->price ?> Membership </a> -->


      </div>


      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


  <script>


$(document).ready(function(){


  $("#more").click(function(){


     


   


      $(".teaser").attr("style", "display: none;");


      $(".complete").attr("style", "display: block;");


      $("#more").attr("style", "display: none;");


      });


      


});


</script>


      <style>


    .complete{


    display:none;


}


.boxs


   {


    box-shadow: 0 3px 10px rgb(0 0 0 / 20%);


    padding: 15px;


}


}


.more{


    background:lightblue;


    color:navy;


    font-size:13px;


    padding:3px;


    cursor:pointer;


}


body {


    font-family: 'Ubuntu', sans-serif;


    font-size: 13px;


    background-color:white;


}


iframe{


   width:100%;


   height: 300px;


}


</style>


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





