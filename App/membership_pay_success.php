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

               <a class="font-weight-bold text-success text-decoration-none" href="../App/home.php">

               <!-- <i class="icofont-rounded-left back-page"></i></a> -->

               <!-- <h6 class="font-weight-bold m-0 ml-3">Membership</h6> -->

               <!-- <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a> -->

            </div>

         </div>

      </div>

      <div id="edit_profile">

         <div class="p-4 profile text-center border-bottom">









            





	<?php



		require_once('vendor/autoload.php');

 $paygate=mysqli_query($config,"select * from payment_setting where Payment_Option='Payment_Option2' ");

            while($pg=mysqli_fetch_object($paygate))

            {

		  

        $API_KEY = $pg->Payment__id;

        $AUTH_TOKEN = $pg->Payment_Key;

		

			}

        $URL ='https://www.instamojo.com/api/1.1/';



		$api = new Instamojo\Instamojo($API_KEY, $AUTH_TOKEN,$URL);



		$payid = $_GET["payid"];



		try {

		$response = $api->paymentRequestStatus($payid);

		 "<h5>Payment ID: " . $response['payments'][0]['payment_id'] . "</h5>" ;

		 "<h5>Payment Name: " . $response['payments'][0]['buyer_name'] . "</h5>" ;

		 "<h5>Payment Email: " . $response['payments'][0]['buyer_email'] . "</h5>" ;

		 "<h5>Payment Mobile: " . $response['payments'][0]['buyer_phone'] . "</h5>" ;

		$paystatus .= "<h5>Payment status: " . $response['payments'][0]['status'] . "</h5>" ;

		 "<pre>";

        }

        

        catch (Exception $e) {

            // print('Error: ' . $e->getMessage());

            }

            if('s' == 's')

		 { 

           

    ?>

       <div class="card">

      <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">

        <i class="checkmark">✓</i>

      </div>

        <h3 class="ps">Payment Successfully</h3> 
        <br>
        <a target="_parent" href="intro.php" type="button" class="btn btn-success">Back</a>
      
      </div>
     
      <?php }

      else{?>

         <div class="card">

      <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">

        <i class="checkmark"><i style="font-size:100px;color:red" class="fa fa-close"></i></i>

      </div>

        <h3 style="color:red" class="ps">Payment Faild</h3> 

      </div><?php }?>

<?php //include('footermenu.php');?>

      <?php //include('menu.php')?> 

    

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

      .card {

        background: white;

        padding: 60px;

        border-radius: 4px;

        box-shadow: 0 2px 3px #C8D0D8;

        display: inline-block;

        margin: 0 auto;

      }

      .checkmark {

        color: #9ABC66;

        font-size: 100px;

        line-height: 200px;

        margin-left:-15px;

      }

      .ps{

          color: #88B04B;

          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;

          font-weight: 900;

          font-size: 30px;

          margin-bottom: 10px;

        }

</style>