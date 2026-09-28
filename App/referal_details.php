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
      
      <?php  
	   $refer_details=mysqli_query($config,"select * from referal_master where Referal_id='".$_GET['referid']."' and Referal_active_status=1 and Referal_valid_upto >= '".date('Y-m-d')."'");
       $refer_det=mysqli_fetch_object($refer_details);
 
	 $pro_po=mysqli_query($config,"select Product_image from product_image_master where Product_id='".$refer_det->Referal_Product."' and Product_image_status=1 LIMIT 1");
            $pro_poto=mysqli_fetch_array($pro_po);

	  
	 $pg=substr($pro_poto[0],6);
			 $pg;
 
 
  

	
	
 



			   ?>
			   
			   
			   		   <?php
			    $pro_like=mysqli_query($config,"select * from product_master where Product_Active_Status=1 and Product_id ='".$referal->Referal_Product."' ");
   $pro_sugg=mysqli_fetch_object($pro_like);
		
 $prpo=mysqli_query($config,"select Product_price,Product_Type_number,Product_type,Shelling_price from product_price_master where Product_status=1 and Product_id ='".$pro_sugg->Product_id."' ");
            $prto=mysqli_fetch_array($prpo);
 
 ?>
                            
                              

<meta name="twitter:card" content="summary" />

<meta name="twitter:site" content="https://shopbee.in/App/referal_details.php" />
<meta name="twitter:creator" content="shopbee" />
<meta property="og:image" content="<?php  echo  $new_str = str_replace('../', 'https://shopbee.in/', $pg); ?>" />			
<meta property="og:title" content="<?php
  $refer_details=mysqli_query($config,"select * from referal_master where Referal_id='".$_GET['referid']."' and Referal_active_status=1 and Referal_valid_upto >= '".date('Y-m-d')."'");
           $refer_det=mysqli_fetch_object($refer_details);

			   	$pro_name_=mysqli_query($config,"select * from product_master where Product_id='".$refer_det->Referal_Product."' ");
										$add_pro=mysqli_fetch_object($pro_name_);
										
			
			echo $add_pro->Product_Name;
			
			   
			   
			   
			   
			   
			   
			   
			   
			   ?>"/> 

                 




		
 <meta name="author" content="">



      <meta name="author" content="<?php   
			   
			   		$pro_name_=mysqli_query($config,"select * from product_master where Product_id='".$referal->Referal_Product."' ");
										$add_pro=mysqli_fetch_object($pro_name_);
										
			
			echo $add_pro->Product_Name;
		 
			
			
			   
			   
			   
			   
			   
			   
			   
			   
			   ?>">
      <meta property="og:url" content="https://shopbee.in/App/referal_details.php" />

	  <meta property="og:type" content="website" />
                  <?php
			    $pro_like=mysqli_query($config,"select * from product_master where Product_Active_Status=1 and Product_id ='".$refer_det->Referal_Product."' ");
   $pro_sugg=mysqli_fetch_object($pro_like);
		
 $prpo=mysqli_query($config,"select Product_price,Product_Type_number,Product_type,Shelling_price from product_price_master where Product_status=1 and Product_id ='".$pro_sugg->Product_id."' ");
            $prto=mysqli_fetch_array($prpo);
 
 ?>
      <?php $sub_off=$pro_sugg->Product_offer;
						
						if($sub_off == 1)
						{ ?>
					
				 
					<?php
					
					    $ofqu=$prto[1].$prto[2];
						$sub_offer=mysqli_query($config,"select * from offer_master where offer_Product_id='". $pro_sugg->Product_id."' and  Offer_upto >='".date('Y-m-d')."' and offer_quality='$ofqu' ");
            $sub_off=mysqli_fetch_object($sub_offer);
           			
						?>
						  
 
						
						<meta property="og:description" content="<?php  echo  "Rs.".$sub_off->offer_price;   ?>"/>
 <meta name="description" content="<?php  echo  "Rs.".$sub_off->offer_price;   ?>">
						
						<?php  }else{ ?>
          

	<meta property="og:description" content=" <?php  echo  "Rs.".$prto[3]   ?> "/>
 <meta name="description" content=" <?php  echo  "Rs.".$prto[3]   ?> ">

                 




                     








						<?php }  ?>      
                               
                            
			   
			   
			   
			   
			   
			   
			   
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
               <a class="font-weight-bold text-success text-decoration-none" href="Referal_pro.php"><i class="icofont-rounded-left back-page"></i>Back</a>
               <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>
            </div>
         </div>
		 
			  <?php
	  
	  if($_GET['referid'] != NULL)
	  
	  {
		  
		
		   $refer_details=mysqli_query($config,"select * from referal_master where Referal_id='".$_GET['referid']."' and Referal_active_status=1 and Referal_valid_upto >= '".date('Y-m-d')."'");
            while($refer_det=mysqli_fetch_object($refer_details))
            {
		    
		  
		  
		  
	  ?> 
		 
         <a href="#" class="text-decoration-none text-white">
            <div class="<?php echo $refer_det->Referal_bg_color;?> p-3 text-white">
               <div class="row align-items-center">
                  <div class="col-6">
                     <div class="d-flex align-items-center">
                      
                      
                     	 <h5><?php   
			   
			   		$pro_name_=mysqli_query($config,"select * from product_master where Product_id='".$refer_det->Referal_Product."' ");
										$add_pro=mysqli_fetch_object($pro_name_);
										
			
			echo $add_pro->Product_Name;
		 
			
			
			   
			   
			   
			   
			   
			   
			   
			   
			   ?> </h5>
			   
                     </div>
                     <div class="pt-3">
                         
                          <h5 class="m-0">
                               
                             <?php
			    $pro_like=mysqli_query($config,"select * from product_master where Product_Active_Status=1 and Product_id ='".$refer_det->Referal_Product."' ");
   $pro_sugg=mysqli_fetch_object($pro_like);
		
 $prpo=mysqli_query($config,"select Product_price,Product_Type_number,Product_type,Shelling_price from product_price_master where Product_status=1 and Product_id ='".$pro_sugg->Product_id."' ");
            $prto=mysqli_fetch_array($prpo);
 
 ?>
      <?php $sub_off=$pro_sugg->Product_offer;
 $ofqu=$prto[1].$prto[2];
  $nn="SELECT * FROM `product_master` INNER JOIN offer_master ON offer_master.offer_Product_id=product_master.Product_id where Product_Active_Status=1  and offer_Product_id='". $pro_sugg->Product_id."' and  Offer_upto >='".date('Y-m-d')."' and offer_quality='$ofqu' and Offer_Status='1' ";

$prolike=mysqli_query($config,$nn);
$prosugg=mysqli_fetch_object($prolike);

            
            if($prosugg->Product_offer == 1)
						{ ?>
					
				 
					<?php
					
					    $ofqu=$prto[1].$prto[2];
						$sub_offer=mysqli_query($config,"select * from offer_master where offer_Product_id='". $pro_sugg->Product_id."' and  Offer_upto >='".date('Y-m-d')."' and offer_quality='$ofqu' ");
            $sub_off=mysqli_fetch_object($sub_offer);
           			
						?>
						   <p  ><b><span style="color:red;"><strike> <?php  echo  "Rs.".$sub_off->Product_price;  ?> </strike></span><?php  echo  "Rs.".$sub_off->offer_price;   ?> &nbsp;  <span style="color:green;"> <?php  echo $prto[1] ?><?php echo $prto[2] ?> </span></b></p> 
 
						
						
						
						<?php  }else{ ?>
          



                      <p><b> <span style="color:red;"><strike> <?php  echo  "Rs.".$prto[0]   ?> </strike></span>  <?php  echo  "Rs.".$prto[3]   ?> &nbsp;  <span style="color:green;"> <?php  echo $prto[1] ?><?php echo $prto[2] ?> </span></b></p> 




                     








						<?php } ?>      
                               
                               
                               
                           </h5>
                         
                         
                        <!-- <p class="btn btn-outline-light mb-0"><i class="icofont-tag mr-1"></i> <?php echo $refer_det->Referal_Code;?> OFF</p> -->

                        <?php
                            $data=$refer_det->Referal_Product;
							 $rp=preg_replace('/\s\s+/', ' ',$data);
							 
							 $data1=$refer_det->Referal_Code;
							 $rc=preg_replace('/\s\s+/', ' ',$data1);
							 
	                          $data2=$session_id;
							 $cli=preg_replace('/\s\s+/', ' ',$data2);
	
						   
						   ?>
                        <textarea id="input" class="js-copytextarea<?php echo  $refer_det->Referal_id; ?>" readonly   style="height: 23px;">https://<?php echo $_SERVER['SERVER_NAME'] ?>/App/product_details_referal.php?Prodetail=<?php echo urlencode(base64_encode($rp));?>&referalcode=<?php echo urlencode(base64_encode($rc));?>&cli=<?php echo urlencode(base64_encode($cli));?></textarea>
						    <button onclick="copyText()" class="js-textareacopybtn<?php echo  $refer_det->Referal_id; ?> btn btn-outline-light" style="vertical-align:top;">COPY NOW</button>
					 <script>
function copyText(){
   var copyText = document.getElementById("input");

/* Select the text field */
copyText.select();
copyText.setSelectionRange(0, 99999); /* For mobile devices */

/* Copy the text inside the text field */
navigator.clipboard.writeText(copyText.value);

/* Alert the copied text */
}


</script>	   
                     </div>
                  </div>
                  <div class="col-6 text-center">
                     <img src="<?php  

 
	 $pro_po=mysqli_query($config,"select Product_image from product_image_master where Product_id='".$refer_det->Referal_Product."' and Product_image_status=1 LIMIT 1");
            $pro_poto=mysqli_fetch_array($pro_po);
 if(!$pro_poto)
 {
 echo  "../Photos/product/no_pro.png";
 }else{
	 
	  
	 $pg=substr($pro_poto[0],6);
				  echo  $pg;
 }
 
  

	
	
 



			   ?>" class="img-fluid">
                  </div>
               </div>
            </div>
         </a>
         <div class="promo_detail">
            <div class="title p-3 bg-white shadow-sm">
               <h5 class="font-weight-bold text-success">Earn Rs. <?php echo $refer_det->Referal_Price_Percentage;?> to share this Referal Code  <?php echo $refer_det->Referal_Code;?> </h5>
               <p class="small text-muted m-0">Available until  <span class="blink" style="
       color: #ff0b0b;
    font-weight: 600;
"> <?php $avlible_up=$refer_det->Referal_valid_upto;
			   
			   $some_date = strtotime($avlible_up);?>
           <?php
			  echo  date('d F',$some_date);
			   
			   ?>,</span><span class="blink" style='color:black;  font-weight: 600;'><?php   echo  date('Y(l)',$some_date);?></span> </p>
            </div>
           
            <div class="p-3">
               <p class="font-weight-bold mb-2">Terms and Conditions</p>
               <ul class="pl-3 mb-0">
                  <li class="text-muted"> <?php echo $refer_det->Referal_Terms_and_condition; ?></br>
                  </li>
                       </ul>
            </div>
         </div>
		 
			
      </div>
      <div class="fixed-bottom">
	  
	  	    <?php
                            $data=$refer_det->Referal_Product;
							 $rp=preg_replace('/\s\s+/', ' ',$data);
							 
							 $data1=$refer_det->Referal_Code;
							 $rc=preg_replace('/\s\s+/', ' ',$data1);
							 
	                          $data2=$session_id;
							 $cli=preg_replace('/\s\s+/', ' ',$data2);
							 

						 
                           
                          

						   
						   
						   
						   ?>
	
 			<center>   <a href="https://api.whatsapp.com/send?text=https://<?php echo $_SERVER['SERVER_NAME'] ?>/App/product_details_referal.php?Prodetail=<?php echo urlencode(base64_encode($rp));?>%26referalcode=<?php echo urlencode(base64_encode($rc));?>%26cli=<?php echo urlencode(base64_encode($cli));?>" data-action="share/whatsapp/share" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" class="font-weight-bold text-white text-decoration-none ml-2" target="_blank" title="Share on whatsapp"><i class="icofont-whatsapp p-2 bg-success shadow-sm rounded-circle"></i></a>
            <a href="https://www.facebook.com/sharer/sharer.php?u=https://<?php echo $_SERVER['SERVER_NAME'] ?>/App/product_details_referal.php?Prodetail=<?php echo urlencode(base64_encode($rp));?>%26referalcode=<?php echo urlencode(base64_encode($rc));?>%26cli=<?php echo urlencode(base64_encode($cli));?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" class="font-weight-bold text-white text-decoration-none ml-2" target="_blank" title="Share on Facebook"><i class="icofont-facebook p-2 bg-primary shadow-sm rounded-circle"></i></a>
		<a href="https://twitter.com/share?url=https://<?php echo $_SERVER['SERVER_NAME'] ?>/App/product_details_referal.php?Prodetail=<?php echo urlencode(base64_encode($rp));?>%26referalcode=<?php echo urlencode(base64_encode($rc));?>%26cli=<?php echo urlencode(base64_encode($cli));?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" class="font-weight-bold text-white text-decoration-none ml-2" title="Share on Twitter"><i class="icofont-twitter p-2 bg-primary shadow-sm rounded-circle"></i></a>
 		<a href="mailto:?subject=Leefoodies&body=https://<?php echo $_SERVER['SERVER_NAME'] ?>/App/product_details_referal.php?Prodetail=<?php echo urlencode(base64_encode($rp));?>%26referalcode=<?php echo urlencode(base64_encode($rc));?>%26cli=<?php echo urlencode(base64_encode($cli));?>" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Mail" class="font-weight-bold text-white text-decoration-none ml-2"><i class="icofont-email p-2 bg-danger shadow-sm rounded-circle"></i></a></center>
	  <textarea class="js-copytextarea<?php echo  $referal->Referal_id; ?>" readonly   style="height: 23px;visibility: hidden;">https://<?php echo $_SERVER['SERVER_NAME'] ?>/App/product_details_referal.php?Prodetail=<?php echo urlencode(base64_encode($rp));?>%26referalcode=<?php echo urlencode(base64_encode($rc));?>%26cli=<?php echo urlencode(base64_encode($cli));?></textarea>
						    <button class="js-textareacopybtn<?php echo  $referal->Referal_id; ?> btn btn-outline-light" style="vertical-align:top;">COPY NOW</button>
					 <script>
var copyTextareaBtn = document.querySelector('.js-textareacopybtn<?php echo $referal->Referal_id; ?>');

copyTextareaBtn.addEventListener('click', function(event) {
  var copyTextarea = document.querySelector('.js-copytextarea<?php echo  $referal->Referal_id; ?>');
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


</script></center>
		
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