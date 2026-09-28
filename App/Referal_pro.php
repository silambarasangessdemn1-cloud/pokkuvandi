<?php include('config/setup.php')?>
<?php include('session.php');
 
	?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


     


			

		<?php  
 $avlible_referal=mysqli_query($config,"select * from referal_master where Referal_active_status=1 and Referal_valid_upto >= '".date('Y-m-d')."'");
           $referal=mysqli_fetch_object($avlible_referal);
 
	 $pro_po=mysqli_query($config,"select Product_image from product_image_master where Product_id='".$referal->Referal_Product."' and Product_image_status=1 LIMIT 1");
            $pro_poto=mysqli_fetch_array($pro_po);
 
	  
	 $pg=substr($pro_poto[0],6);
				 
				//   echo  $new_str = str_replace('../', 'https://shopbee.in/', $pg);
 
 
  

	
	
 



			   ?>	
			   
			   		   <?php
			    $pro_like=mysqli_query($config,"select * from product_master where Product_Active_Status=1 and Product_id ='".$referal->Referal_Product."' ");
   $pro_sugg=mysqli_fetch_object($pro_like);
		
 $prpo=mysqli_query($config,"select Product_price,Product_Type_number,Product_type,Shelling_price from product_price_master where Product_status=1 and Product_id ='".$pro_sugg->Product_id."' ");
            $prto=mysqli_fetch_array($prpo);
 
 ?>
                            
                              

<meta name="twitter:card" content="summary" />

<meta name="twitter:site" content="https://shopbee.in/App/Referal_pro.php" />
<meta name="twitter:creator" content="shopbee" />
<meta property="og:image" content="<?php  echo  $new_str = str_replace('../', 'https://shopbee.in/', $pg); ?>" />			
<meta property="og:title" content="<?php   
			   
			   		$pro_name_=mysqli_query($config,"select * from product_master where Product_id='".$referal->Referal_Product."' ");
										$add_pro=mysqli_fetch_object($pro_name_);
										
			
			echo $add_pro->Product_Name;
		 
			
			
			   
			   
			   
			   
			   
			   
			   
			   
			   ?>"/> 

                 




		
 <meta name="author" content="">



      <meta name="author" content="<?php   
			   
			   		$pro_name_=mysqli_query($config,"select * from product_master where Product_id='".$referal->Referal_Product."' ");
										$add_pro=mysqli_fetch_object($pro_name_);
										
			
			echo $add_pro->Product_Name;
		 
			
			
			   
			   
			   
			   
			   
			   
			   
			   
			   ?>">
      <meta property="og:url" content="https://shopbee.in/App/Referal_pro.php" />

	  <meta property="og:type" content="website" />
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
               <span class="font-weight-bold ml-3 h6 mb-0">Refer Code</span>
               <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>
            </div>
         </div>
         <div class="p-3">
            <h4> Referal Product</h4>
            <!-- Promo 1 -->
              <form action="search_ref.php" method="GET">
<select  class="form-control" name="product_ref_code" style="width: 250px;display: revert;">
			<?php
			
			$ref_name_=mysqli_query($config,"select Referal_Product from referal_master group by Referal_Product ");
											while($refpro=mysqli_fetch_object($ref_name_))
											{
				$pro_name_=mysqli_query($config,"select * from product_master where Product_id='".$refpro->Referal_Product."' ");
										$add_pro=mysqli_fetch_object($pro_name_);
										
		 
			
											 
			?>
			
			<option value="<?php echo $add_pro->Product_id;?>"><?php echo $add_pro->Product_Name;?></option>
			
			
			
			
											<?php } ?>
			
			</select>	
		   
                     &nbsp; &nbsp; &nbsp;<button type="submit" class="btn btn-primary " name="Get_Referal">Search</button>
                  	
			
			
</form>

</br>


		<?php
		  
		   $avlible_referal=mysqli_query($config,"select * from referal_master where Referal_active_status=1 and Referal_valid_upto >= '".date('Y-m-d')."'");
            while($referal=mysqli_fetch_object($avlible_referal))
            {
		  
		  
		  
		  ?>


		  <div class="py-2">
               <a href="referal_details.php?referid=<?php echo  $referal->Referal_id; ?>" class="text-decoration-none text-white my-3">
                  <div class="rounded <?php echo $referal->Referal_bg_color; ?> shadow-sm p-3 text-white">
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
                             
                           </div>
                           <div class="mt-2 mb-3">
                              <p class="text-white m-0">Refer to Earn Rs.<?php echo $referal->Referal_Price_Percentage; ?></p>
                           </div>
						    
						   
						    <?php
                            $data=$referal->Referal_Product;
							 $rp=preg_replace('/\s\s+/', ' ',$data);
							 
							 $data1=$referal->Referal_Code;
							 $rc=preg_replace('/\s\s+/', ' ',$data1);
							 
	                          $data2=$session_id;
							 $cli=preg_replace('/\s\s+/', ' ',$data2);
							 

						 
                           
                          

						   
						   
						   
						   ?>
	 <h6 class="text-white m-0">Share to  Earn</h6></br>
	   	 
 			   <a href="https://api.whatsapp.com/send?text=https://<?php echo $_SERVER['SERVER_NAME'] ?>/App/product_details_referal.php?Prodetail=<?php echo urlencode(base64_encode($rp));?>%26referalcode=<?php echo urlencode(base64_encode($rc));?>%26cli=<?php echo urlencode(base64_encode($cli));?>" data-action="share/whatsapp/share" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" class="font-weight-bold text-white text-decoration-none ml-2" target="_blank" title="Share on whatsapp"><i class="icofont-whatsapp p-2 bg-success shadow-sm rounded-circle"></i></a>
            <a href="https://www.facebook.com/sharer/sharer.php?u=https://<?php echo $_SERVER['SERVER_NAME'] ?>/App/product_details_referal.php?Prodetail=<?php echo urlencode(base64_encode($rp));?>%26referalcode=<?php echo urlencode(base64_encode($rc));?>%26cli=<?php echo urlencode(base64_encode($cli));?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" class="font-weight-bold text-white text-decoration-none ml-2" target="_blank" title="Share on Facebook"><i class="icofont-facebook p-2 bg-primary shadow-sm rounded-circle"></i></a>
		<a href="https://twitter.com/share?url=https://<?php echo $_SERVER['SERVER_NAME'] ?>/App/product_details_referal.php?Prodetail=<?php echo urlencode(base64_encode($rp));?>%26referalcode=<?php echo urlencode(base64_encode($rc));?>%26cli=<?php echo urlencode(base64_encode($cli));?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" class="font-weight-bold text-white text-decoration-none ml-2" title="Share on Twitter"><i class="icofont-twitter p-2 bg-primary shadow-sm rounded-circle"></i></a>
 	
 		<a href="mailto:?subject=Online Shopping&body=https://<?php echo $_SERVER['SERVER_NAME'] ?>/App/product_details_referal.php?Prodetail=<?php echo urlencode(base64_encode($rp));?>%26referalcode=<?php echo urlencode(base64_encode($rc));?>%26cli=<?php echo urlencode(base64_encode($cli));?>" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Mail" class="font-weight-bold text-white text-decoration-none ml-2"><i class="icofont-email p-2 bg-danger shadow-sm rounded-circle"></i></a>
	 </br>	 </br> <textarea class="js-copytextarea<?php echo  $referal->Referal_id; ?>" readonly   style="height: 23px;">https://<?php echo $_SERVER['SERVER_NAME'] ?>/App/product_details_referal.php?Prodetail=<?php echo urlencode(base64_encode($rp));?>&referalcode=<?php echo urlencode(base64_encode($rc));?>&cli=<?php echo urlencode(base64_encode($cli));?></textarea>
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


</script>	   
                </div>
               <div class="col-5 text-center">
               <a href="referal_details.php?referid=<?php echo  $referal->Referal_id; ?>"><center><img src="<?php  

 
	 $pro_po=mysqli_query($config,"select Product_image from product_image_master where Product_id='".$referal->Referal_Product."' and Product_image_status=1 LIMIT 1");
            $pro_poto=mysqli_fetch_array($pro_po);
 if(!$pro_poto)
 {
 echo  "../Photos/product/no_pro.png";
 }else{
	 
	  
	 $pg=substr($pro_poto[0],6);
				  echo  $pg;
 }
 
  

	
	
 



			   ?>" class="img-fluid"></a>
			 <p style="    font-size: medium;"><?php   
			   
			   		$pro_name_=mysqli_query($config,"select * from product_master where Product_id='".$referal->Referal_Product."' ");
										$add_pro=mysqli_fetch_object($pro_name_);
										
			
			echo $add_pro->Product_Name;
		 
			
			
			   
			   
			   
			   
			   
			   
			   
			   
			   ?> </p>
			   
			   <?php
			    $pro_like=mysqli_query($config,"select * from product_master where Product_Active_Status=1 and Product_id ='".$referal->Referal_Product."' ");
   $pro_sugg=mysqli_fetch_object($pro_like);
		
 $prpo=mysqli_query($config,"select Product_price,Product_Type_number,Product_type,Shelling_price from product_price_master where Product_status=1 and Product_id ='".$pro_sugg->Product_id."' ");
            $prto=mysqli_fetch_array($prpo);
 
 ?>
      <?php $sub_off=$pro_sugg->Product_offer;
  $ofqu=$prto[1].$prto[2];
  $nn="SELECT * FROM `product_master` INNER JOIN offer_master ON offer_master.offer_Product_id=product_master.Product_id where Product_Active_Status=1 and Product_id ='".$referal->Referal_Product."' and offer_Product_id='". $pro_sugg->Product_id."' and  Offer_upto >='".date('Y-m-d')."' and offer_quality='$ofqu' and Offer_Status='1' ";
 
 $prolike=mysqli_query($config,$nn);
 $prosugg=mysqli_fetch_object($prolike);
 
             
             if($prosugg->Product_offer == 1)
						{ ?>
					
				 
					<?php
					
					    $ofqu=$prto[1].$prto[2];
						$sub_offer=mysqli_query($config,"select * from offer_master where offer_Product_id='". $pro_sugg->Product_id."' and  Offer_upto >='".date('Y-m-d')."' and offer_quality='$ofqu' and Offer_Status='1' ");
            $sub_off=mysqli_fetch_object($sub_offer);
            if($sub_off){
           			
						?>
						  <center>  <p  ><b><span style="color:red;"><strike> <?php  echo  "Rs.".$sub_off->Product_price;  ?> </strike></span><?php  echo  "Rs.".$sub_off->offer_price;   ?> &nbsp;  <span style="color:green;"> <?php  echo $prto[1] ?><?php echo $prto[2] ?> </span></b></p> </center>
 
						
						
						
						<?php }else{ ?>
                     <center>    <p><b> <span style="color:red;"><strike> <?php  echo  "Rs.".$prto[0]   ?> </strike></span>  <?php  echo  "Rs.".$prto[3]   ?> &nbsp;  <span style="color:green;"> <?php  echo $prto[1] ?><?php echo $prto[2] ?> </span></b></p> </center>

                <?php   }  }else{ ?>
          



                   <center>    <p><b> <span style="color:red;"><strike> <?php  echo  "Rs.".$prto[0]   ?> </strike></span>  <?php  echo  "Rs.".$prto[3]   ?> &nbsp;  <span style="color:green;"> <?php  echo $prto[1] ?><?php echo $prto[2] ?> </span></b></p> </center>

						<?php } ?>                              
                              
        
			   
			   
			   
               </div>
               </div>
               </div></a>
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