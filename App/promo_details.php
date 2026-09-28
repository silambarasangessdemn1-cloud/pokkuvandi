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
   <body class="fixed-bottom-padding">
      <div class="theme-switch-wrapper">
         <label class="theme-switch" for="checkbox">
            <input type="checkbox" id="checkbox" />
            <div class="slider round"></div>
            <i class="icofont-moon"></i>
         </label>
         <em>Enable Dark Mode!</em>
      </div>

	  
      <div class="osahan-promo">
         <div class="px-3 pt-3">
            <div class="d-flex align-items-center pb-3">
               <a class="font-weight-bold text-success text-decoration-none" href="promos.php"><i class="icofont-rounded-left back-page"></i></a>
 <span class="font-weight-bold ml-3 h6 mb-0">Promocode Details</span>
               <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>
            </div>
         </div>
		 
			  <?php
	  
	  if($_GET['promoid'] != NULL)
	  
	  {
		  
		
		   $promo_details=mysqli_query($config,"select * from promo_code_master where Promo_id='".$_GET['promoid']."' and Promo_code_Active_Status=1 and Promo_code_valid_upto >= '".date('Y-m-d')."'");
            while($promo_det=mysqli_fetch_object($promo_details))
            {
		    
		  
		  
		  
	  ?> 
		 
         <a href="#" class="text-decoration-none text-white">
            <div class="<?php echo $promo_det->Bg_color;?> p-3 text-white">
               <div class="row align-items-center">
                  <div class="col-6">
                     <div class="d-flex align-items-center">
                        <img class="p-osahan-logo" src="<?php 
            
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
            
            ?></h5>
                        </div>
                     </div>
                     <div class="pt-3">
                        <p class="btn btn-outline-light mb-0"><i class="icofont-tag mr-1"></i> <?php echo $promo_det->Promo_code;?></p>
                     <textarea class="js-copytextarea<?php echo  $promo_det->Promo_id; ?>" readonly   style="    height: 23px; visibility: hidden;"> <?php echo $promo_det->Promo_code;?></textarea>
						    <button class="js-textareacopybtn<?php echo  $promo_det->Promo_id; ?> btn btn-outline-light" style="vertical-align:top;">COPY NOW</button>

    <script>
var copyTextareaBtn = document.querySelector('.js-textareacopybtn<?php echo  $promo_det->Promo_id; ?>');

copyTextareaBtn.addEventListener('click', function(event) {
  var copyTextarea = document.querySelector('.js-copytextarea<?php echo  $promo_det->Promo_id; ?>');
  copyTextarea.focus();
  copyTextarea.select();

  try {
    var successful = document.execCommand('copy');
    var msg = successful ? 'successful' : 'unsuccessful';
    console.log('Copying text command was ' + msg);
  } catch (err) {
    console.log('Oops, unable to copy');
  }
});


</script>






					</div>
                  </div>
                  <div class="col-6 text-center">
                     <img src="<?php 
	$proban=$promo_det->Offer_Poster;
                  $prb=substr($proban,6);
				  echo  $prb;

	 ?>" class="img-fluid">
                  </div>
               </div>
            </div>
         </a>
         <div class="promo_detail">
            <div class="title p-3 bg-white shadow-sm">
               <h5 class="font-weight-bold text-success">Get <?php echo $promo_det->Offer_Percent;?>% off buying <?php   
			   
			   		$pro_name_=mysqli_query($config,"select * from product_master where Product_id='".$promo_det->Product_id."' ");
										$add_pro=mysqli_fetch_object($pro_name_);
										
			
			echo $add_pro->Product_Name;
		 
			
			
			   
			   
			   
			   
			   
			   
			   
			   
			   ?></h5>
               <p class="small text-muted m-0">Available until  <span class="blink" style="
    color: #061fce;
"> <?php $avlible_up=$promo_det->Promo_code_valid_upto;
			   
			   $some_date = strtotime($avlible_up);
			  echo  date('d F, Y(l)',$some_date);
			   
			   ?> </span> </p>
            </div>
            <div class="p-3 bg-light">
               <p class="font-weight-bold mb-2">Highlights</p>
               <p class="small m-0"><?php echo $promo_det->Offer_Highlights;?></p>
            </div>
            <div class="p-3">
               <p class="font-weight-bold mb-2">Terms $ Conditions</p>
               <ul class="pl-3 mb-0">
                  <li class="text-muted"> <?php echo $promo_det->Terms_and_Conditions; ?></br>
                  </li>
                       </ul>
            </div>
         </div>
		 
			
      </div>
      <div class="fixed-bottom">
         <a href="product_details.php?Prodetail=<?php echo $promo_det->Product_id;?> " class="btn btn-success btn-block">Buy Now</a>
      </div>
	  <?php }}else{
		  header('location:promos.php');
	  }?>
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