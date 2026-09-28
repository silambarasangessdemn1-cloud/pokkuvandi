<?php include('config/setup.php');?>

 <?php include('session.php');?>

 

 <?php

 if(isset($_POST['custom_profile_edit']))

 { 

$custediton=date('Y-m-d');

$update_customer=mysqli_query($config,"update customer_master set Customer_Name='".$_POST['up_customer_Name']."',Customer_Phone_No='".$_POST['up_customer_mobile_no']."',Customer_Mail_id='".$_POST['up_customer_mail']."',Customer_Registred_on='$custediton' where Customer_Id='$session_id'");

 header("Refresh:0");



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











            <h6 class="font-weight-bold m-0 mt-2">Membership Price Rs: <?php echo $amount=$_GET['amount']; ?></h6>

         </div>

         <div class="p-3" style="padding: 14px !important;

    box-shadow: 0 3px 10px rgb(131 118 118 / 30%);">

            <form action="member_pay.php" method="GET" target="_parent" >

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

                  <input  type="text" class="form-control" id="rcode" name="rcode" required >

                  <small style="color:red;" id="rcode1"></small>

                  <input  type="hidden" class="form-control" id="" name="gtotal" value="<?php echo $amount=$_GET['amount']; ?>" >

                  <input  type="hidden" class="form-control" id="" name="sessionid" value="<?php echo $session_id ?>" >

                  <input  type="hidden" class="form-control" id="" name="planid" value="<?php echo $_GET['planid']; ?>" >



               </div>

               <div class="text-center">

                  <button  type="submit" id="submit" disabled="false" class="btn btn-success btn-block btn-lg" name="custom_profile_edit">Pay </button>

               </div>

            </form>

         </div>

         <div class="additional">

           

           

         </div>

      </div>

      </div>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



      <script>

             $('#rcode').keyup(function () {  

               

               var code =$("#rcode").val();

              

               $.ajax({

                url: "refcode.php",

                type: "POST",

                data: {id : code},

                success: function(data) {

                  //  alert(data);

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