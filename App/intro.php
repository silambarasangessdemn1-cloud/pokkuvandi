<?php include('../App/config/setup.php')?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="Askbootstrap">
      <meta name="author" content="Askbootstrap">
      <link rel="icon" type="image/png" href="<?php 
            
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
            
            ?> </title>
      <!-- Bootstrap core CSS -->
      <link href="demo/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <link href="demo/vendor/bootstrap/css/demo.css" rel="stylesheet">
   </head>
   <body>
      <!-- Page Content -->
      <div class="container">
         <div class="row align-items-center hv-100">
            <div class="col-lg-6 text-center">
               <img class="logo" src=" <?php 
            
            $inro_logo=mysqli_query($config,"select Intro_Logo from intro_master");
            while($logo=mysqli_fetch_array($inro_logo))
            {
                

    $ms=substr($logo[0],6);
				  echo  $ms;


            }
            
            ?>" style="width: 180px;">
               <h2 class="mb-3"><?php 
            
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
            
            ?> - <?php 
            
            $introcontent=mysqli_query($config,"select * from intro_master");
            while($ic=mysqli_fetch_object($introcontent))

			{				?><?php echo $ic->Intro_Content;?></h2>
               <a href="https://play.google.com/store/search?q=pokkuvandi&c=apps"> <img class="mb-3 mt-4 qrcode" src="<?php echo $si=substr($ic->Intro_Image,6);?>"></a>
               <p class="text-danger small mb-5">Click Here to Download Mobile App for Android
               </p>
               <p class="my-3"></p>
			   
			<?php } ?>
            </div>
            <div class="col-lg-6 text-center">
               <div class="phone-screen">
                  <div class="f-r">
                  <iframe name="preview" src="Directory.php"></iframe> 
                  </div>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>