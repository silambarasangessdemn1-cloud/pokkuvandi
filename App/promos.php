<?php include('config/setup.php')?>
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
      <div class="osahan-promos">
         <div class="p-3 border-bottom">
            <div class="d-flex align-items-center">
               <a class="font-weight-bold text-success text-decoration-none" href="home.php">
               <i class="icofont-rounded-left back-page"></i></a>
               <span class="font-weight-bold ml-3 h6 mb-0">Promos</span>
               <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>
            </div>
         </div>
         <div class="p-3">
            <h4>
Available Promos</h4>
            <!-- Promo 1 -->
          <?php
		  
		   $avlible_promo=mysqli_query($config,"select * from promo_code_master where Promo_code_Active_Status=1 and Promo_code_valid_upto >= '".date('Y-m-d')."'");
            while($promo=mysqli_fetch_object($avlible_promo))
            {
		  
		  
		  
		  ?>


		  <div class="py-2">
                   <div class="rounded <?php echo $promo->Bg_color; ?> shadow-sm p-3 text-white">
                     <div class="row align-items-center">
                        <div class="col-7">
                           <div class="d-flex align-items-center">
                              <img class="pp-osahan-logo" src="<?php 
            
            $inro_logo=mysqli_query($config,"select Logo_Path,logo_status from lee_master ");
            while($logo=mysqli_fetch_array($inro_logo))
            {
                 $logstatus=$logo[1];
if($logstatus == 1)
{
     
	
	$sub_cate_image=$logo[0];
                  $MCI=substr($sub_cate_image,6);
				  echo  $MCI;

	
	
	
}else{
    echo "../photos/logo/no_logo.png";

}

            }
            
            ?>">
                              <div class="brand ml-2">
                                 <h5 class="m-0"><?php 
            
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
            
            ?>  </h5>
                              </div>
                           </div>
                           <div class="mt-2 mb-3">
                              <p class="text-white m-0"><?php   
			   
			   		$pro_name_=mysqli_query($config,"select * from product_master where Product_id='".$promo->Product_id."' ");
										$add_pro=mysqli_fetch_object($pro_name_);
										
			
			echo $add_pro->Product_Name;
		 
			
			
			   
			   
			   
			   
			   
			   
			   
			   
			   ?> <?php echo $promo->Offer_Percent; ?>% OFF</p>
                           </div>
						   <textarea class="js-copytextarea<?php echo  $promo->Promo_id; ?>" readonly   style="    height: 23px;"> <?php echo $promo->Promo_code;?></textarea>
						    <button class="js-textareacopybtn<?php echo  $promo->Promo_id; ?> btn btn-outline-light" style="vertical-align:top;">COPY NOW</button>
              <script>
var copyTextareaBtn = document.querySelector('.js-textareacopybtn<?php echo  $promo->Promo_id; ?>');

copyTextareaBtn.addEventListener('click', function(event) {
  var copyTextarea = document.querySelector('.js-copytextarea<?php echo  $promo->Promo_id; ?>');
  copyTextarea.focus();
  copyTextarea.select();

  try {
    var successful = document.execCommand('copy');
    var msg = successful ? 'successful' : 'unsuccessful';
	
    console.log('Copying text command was ' + msg);
	
	var req ="<?php echo $_GET['ordertrack'];?>";
	if(req !='')
	{
			window.location.replace("checkout.php?ordertrack=<?php echo $_GET['ordertrack'];?>");

	}
	
	
	
	
  } catch (err) {
    console.log('Oops, unable to copy');
  }
});


</script>

               </div>
               <div class="col-5 text-center">
               <a href="promo_details.php?promoid=<?php echo  $promo->Promo_id; ?>"><img src="<?php  

 
	
	$proban=$promo->Offer_Poster;
                  $prb=substr($proban,6);
				  echo  $prb;

	
	
 



			   ?>" class="img-fluid"></a>
               </div>
               </div>
               </div> 
            </div>
			<?php }?>
			
			
			
			
			
             </div>
      </div>
     <?php include('footermenu.php');?>
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