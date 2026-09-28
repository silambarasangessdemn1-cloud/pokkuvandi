<?php include('config/setup.php');?>



 <?php include('session.php');



 

// if($session__username)

// {



// }else{

//     header("location:signin.php");

// }

// 	?>



<?php



 $ms="SELECT * FROM `membership_list` where user_id='$session_id'";



 $msql=mysqli_query($config,$ms);



 $msqld=mysqli_fetch_object($msql);



if($msqld->user_id)



{



  



   



}else{



//     header("location:index.php");



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



   

<?php



				 



$about=mysqli_query($config,"select * from membership");







$del=mysqli_fetch_object($about);







?>         

<meta name="twitter:card" content="summary" />



<meta name="twitter:site" content="https://callinfo.in/App/memberferealorder.php" />

<meta name="twitter:creator" content="callinfo" />

<meta property="og:image" content="https://callinfo.in/<?php  echo  $new_str = str_replace('../','', $ms);

 ?>" />			

<meta property="og:title" content="<?php echo $del->referal_script_title;

   ?>"/> 

    <meta name="author" content="<?php  

     echo $del->referal_script_title;

       ?>">

             <meta property="og:url" content="https://<?php echo $_SERVER['SERVER_NAME'] ?>/App/membershipdetails.php" />



<meta property="og:type" content="website" />

<meta property="og:description" content="<?php echo $del->referal_script_title;  ?>"/>

 <meta name="description" content="<?php echo $del->referal_script_title;  ?>">



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



      <div class="osahan-profle">



         <div class="p-3 border-bottom">



            <div class="d-flex align-items-center">



               <a class="font-weight-bold text-success text-decoration-none" href="my_account.php">



               <i class="icofont-rounded-left back-page"></i></a>



               <h6 class="font-weight-bold m-0 ml-3">Membership</h6>



               <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>



            </div>



         </div>



      </div>



      <div id="edit_profile">



         <div class="p-4 profile text-center border-bottom">



















            <img style="height: 90px;" src="<?php 



            



            $inro_logo=mysqli_query($config,"select Logo_Path,logo_status from lee_master");



            while($logo=mysqli_fetch_array($inro_logo))



            {



                 $logstatus=$logo[1];



if($logstatus == 1)



{



	



	 $ms=substr($logo[0],3);



				  echo  'members.png';



	



     



}else{



    echo "../../photos/logo/no_logo.png";







}







            }



            



            ?>" class="img-fluid rounded-pill">

<?php
$mid=$_GET['planid'];
$about=mysqli_query($config,"select * from membership where mid='$mid'");

$del=mysqli_fetch_object($about);


    ?>





















            <h6 class="font-weight-bold m-0 mt-2">Membership Price Rs: <?php echo $del->price ?></h6>



         </div>



         <div class="p-3" style="padding: 14px !important;



    box-shadow: 0 3px 10px rgb(131 118 118 / 30%);">

    <?php 

    if($session_id)

    {

    ?>



            <form action="member_pay.php" method="GET" target="_parent">



               <div class="form-group">



                  <label for="exampleInputName1">Full Name</label>



                  <input readonly type="text" class="form-control" id="exampleInputName1" name="customername" value="<?php echo $session__username;?>">



               </div>



               <div class="form-group">



                  <label for="exampleInputNumber1">Mobile Number</label>



                  <input readonly type="number" class="form-control" id="exampleInputNumber1" name="customerphone" value="<?php echo $session__phone; ?>">



               </div>



               <div class="form-group">



                  <label for="exampleInputEmail1">Email</label>



                  <input readonly type="email" class="form-control" id="exampleInputEmail1" name="customermail" value="<?php echo $session__mail;?>">



               </div>



               <div class="form-group">



                  <label for="exampleInputEmail1">Referral code *</label>



                  <input readonly  type="text" class="form-control" id="rcode" value="<?php echo $_GET['refcode'] ?>" name="rcode" required >



                  <small style="color:red;" id="rcode1"></small>



                  <input  type="hidden" class="form-control" id="" name="gtotal" value="<?php echo $del->price ?>" >



                  <input  type="hidden" class="form-control" id="" name="sessionid" value="<?php echo $session_id ?>" >



                  <input  type="hidden" class="form-control" id="" name="planid" value="<?php echo $_GET['planid']; ?>" >







               </div>



               <div class="text-center">

                   <?php  if($session__username)

 {

?>





                  <button   type="submit" id="submit" disabled="false" class="btn btn-success btn-block btn-lg" name="custom_profile_edit">Pay </button>

<?php }

else{

     echo '<a href="signin.php"  type="button"   class="btn btn-success btn-block btn-lg" name="custom_profile_edit">Login </a >';

 }

 ?>

               </div>



            </form>

<?php }else{

   $amount=$_GET['amount'];

   $planid=$_GET['planid'];

   $refcode=$_GET['refcode'];

   echo'<center><h6 style="margin-top: 80px;color:green;"> Please Login to Continue your Shopping</h6> 	</center>';

        echo '<a href="signin.php?amount='.$amount.'&planid='. $planid.'&refcode='. $refcode.'"  type="button"   class="btn btn-success btn-block btn-lg" name="custom_profile_edit">Login </a >';

        echo '<a href="signup.php?amount='.$amount.'&planid='. $planid.'&refcode='. $refcode.'"  type="button"   class="btn btn-success btn-block btn-lg" name="custom_profile_edit">Signup </a >';



}?>

         </div>



         <div class="additional">



           



           



         </div>



      </div>



      </div>



      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>







      <script>



             $( document ).ready(function () {  



               



               var code =$("#rcode").val();



              



               $.ajax({



                url: "refcode.php",



                type: "POST",



                data: {id : code},



                success: function(data) {



                console.log(data);



                   if(data == 1)



                   {



                     $("#rcode1").html(' ');



                     $('#submit').addClass('button_disabled').attr('disabled',false); 



                   }else{



                     $("#rcode1").html('Invalid referral code');



                     $('#submit').addClass('button_disabled').attr('disabled', true); 



                   }



                }



            });



             });



         </script>



<?php include('menu.php');?>







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

