<?php include('config/setup.php')?>
<?php session_start();?>

<?php


if(isset($_POST['login_submit']))
{
	
  $log_act=$_POST['lee_mobile_number'];
 
$result22=mysqli_query($config,"select * from customer_master where Customer_Mail_id='".$_POST['lee_mobile_number']."'");	
$user = mysqli_fetch_array($result22);
if($user){
			
		$logg=$user["Customer_Active_Status"];
		if($logg ==1)
		{
			$sendmail=$user["Customer_Mail_id"];
      
$admin_mail=mysqli_query($config,"select Email_id,website from lee_master ");	
$adminma = mysqli_fetch_array($admin_mail);

	         //   $to = $sendmail;
            //     $subject ="Pokkuvandi Password Change Request";
            //     $txt = "Your password Change link=https://".$_SERVER['SERVER_NAME']."/App/forget_change_password.php?userid=" .$user["Customer_Id"]."\r\n You have received this mail because your e-mail ID is registered with \r\n" .$adminma[1]. " This is a system-generated e-mail, please don't reply to this message.";
            //     $headers = "From: mauriya96@gmail.com" . "\r\n" .
            //     "CC: mauriya96@gmail.com";
            //     mail($to,$subject,$txt,$headers);


            $customerId = isset($_POST['customerId']) ? $_POST['customerId'] : $user["Customer_Id"];

                include('email/simple.php');
                                 
$mail='<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Enquiry Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
       
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }
       
        h2 {
            color: #333;
            margin-top: 0;
        }
       
        p {
            margin-bottom: 10px;
        }
       
        ul {
            list-style-type: none;
            padding: 0;
        }
       
        li {
            margin-bottom: 5px;
        }
       
        .signature {
            margin-top: 20px;
            font-style: italic;
        }
       
        .header-image {
            width: 100%;
            max-height: 200px;
            object-fit: cover;
            border-radius: 4px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
      
        <h2>Pokkuvandi Password Change Request</h2>
        <p>"Your password Change link=https://'.$_SERVER['SERVER_NAME'].'/App/forget_change_password.php?userid='. $customerId.' You have received this mail because your e-mail ID is registered with \r\n' .$adminma[1]. ' This is a system-generated e-mail, please dont reply to this message.";
        </p>
    </div>
</body>
</html>
';

//echo '1';
smtp_mailer($sendmail,'enquiry',$mail);

	
echo "<script>alert('Check your email. A forget password link has been sent to your email ID successfully.');</script>";
	header("Refresh:1; url=signin.php");
	
	
	
	
	
	

}else{
    
    	echo "Your Profile is Locked by Admin,Please Contact ";
    
}


	} else {
		
		echo "<script>alert('Email Not Valid')</script>";
	}
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
   <body class="fixed-bottom-padding">
      <div class="theme-switch-wrapper">
         <label class="theme-switch" for="checkbox">
            <input type="checkbox" id="checkbox" />
            <div class="slider round"></div>
            <i class="icofont-moon"></i>
         </label>
         <em>Enable Dark Mode!</em>
      </div>
      <!-- sign in -->
      <div class="osahan-signin">
         <div class="border-bottom p-3 d-flex align-items-center" style="background-color:#68ba61;">
        <center> <img class="index-osahan-logo" src="
            <?php 
            
            $inro_logo=mysqli_query($config,"select Logo_Path,logo_status from lee_master");
            while($logo=mysqli_fetch_array($inro_logo))
            {
                 $logstatus=$logo[1];
if($logstatus == 1)
{
    $ms=substr($logo[0],6);
				  echo  $ms;
}else{
    echo "../photos/logo/no_logo.png";

}

            }
            
            ?>
            
            
            
            
            
            " alt="leefoodies Logo" style="
    height: 51px;
"></center>
         <h4> <?php 
            
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
            
            ?>   </h4>
        
             


         </div>
		 
	 
 
		 
         <div class="p-3">
            <h2 class="my-0">Forget Password</h2>
            </br>
       

		   <form action="forgetpassword.php" method="post">
               <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input placeholder="Enter Your Register Email" type="email" required class="form-control" name="lee_mobile_number" id="exampleInputEmail1" >
               </div> 
			  
            
            <button type="submit" class="btn btn-success btn-lg rounded btn-block" name="login_submit">Send To Mail</button>
            </form>
          



		  
         </div>
      </div>
      <!-- footer fixed -->
    
    
   <?php include('promo_footermenu.php');?>
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