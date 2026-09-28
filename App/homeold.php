 <?php include('config/setup.php');?>
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
      <!-- home page -->
      <div class="osahan-home-page">
        <?php include('topmenu.php');?>
         <!-- body -->
         <div class="osahan-body">
		 
		 
		   <!-- Promos -->
            <div class="py-3 bg-white osahan-promos shadow-sm">
               <div class="d-flex align-items-center px-3 mb-2">
                  <h6 class="m-0">Promos for you</h6>
                  <a href="promos.php" class="ml-auto text-success">See more</a>
               </div>
               <div class="recommend-slider" style="padding: 0px 0px;">
                
				     <?php
		  
		   $avlible_promo=mysqli_query($config,"select * from promo_code_master where Promo_code_Active_Status=1 and Promo_code_valid_upto >= '".date('Y-m-d')."'");
            while($promo=mysqli_fetch_object($avlible_promo))
            {
		  
		  
		  
		  ?>
					 <div class="osahan-slider-item">
				
                     <a href="promo_details.php?promoid=<?php echo  $promo->Promo_id; ?>"><img src="<?php 

  $cate_image=$promo->Offer_Poster;;
                  $pb=substr($cate_image,6);
				  echo  $pb;

					 ?>" class="img-fluid mx-auto rounded" alt="Responsive image"></a>
                  </div>
                  
				  
			<?php } ?>  
				  
               </div>
            </div>
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
            <!-- categories -->
            <div class="p-3 osahan-categories">
               <h6 class="mb-2">What do you looking for?</h6>
               </div>  <div class="row pick_today px-3"  style="margin-right: 2px; margin-left: 0px;">
              

    <?php
				 
				 $category=mysqli_query($config,"select Main_Category_Name,Main_Category_image,Main_Category_id,Shop_setting from main_category where Main_Category_Status=1 ");
				 
				 while($cate=mysqli_fetch_array($category))
				 {
				 
				 ?>
				 
				 <div class="col-4 pl-0 pr-1 py-1">
                     
					
					 <div class="bg-white shadow-sm rounded text-center  px-2 py-3 c-it">
                       
					   <a href="
					   
					   <?php

							if($cate[3] == 2)

							{
					    ?>
						
						res_home.php
						
					<?php		} else {    ?>
					   
					    listing.php?cate_id=<?php echo $cate[2]; ?>
					   
					   
					   
					   
					   
							<?php } ?>
					   
					   
					   ">
                           <img src="<?php  
				  $cate_image=$cate[1];
                  $MCI=substr($cate_image,6);
				  echo  $MCI;


													 
						  
						   
						   
						   
						   
						   ?>" class="img-fluid px-2">
                           <p class="m-0 pt-2 text-muted text-center"><?php echo $cate[0];?></p>
                        </a>
                   



				   </div>
					 
					
					 
                  </div>
				
                    <?php }?>
					 
                  
               </div>
                
                
                
          
          
            <!-- Pick's Today -->
            <div class="title d-flex align-items-center mb-3 mt-3 px-3">
               <h6 class="m-0">Pick's Today</h6>
                
            </div>
            <!-- pick today -->
            <div class="pick_today px-3">
               <div class="row">
                 
	   <?php
					 
 $pro_like=mysqli_query($config,"select * from product_master where Product_Active_Status=1  LIMIT 5   ");
        while($pro_sugg=mysqli_fetch_object($pro_like))
		{
   ?>
				   
				   
				   

				   <div class="col-6 pr-2" style="padding-bottom: 12px;">
                        <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                           <div class="list-card-image">
                              <a href="product_details.php?Prodetail=<?php echo $pro_sugg->Product_id; ?>" class="text-dark">
                                 <div class="member-plan position-absolute" style="margin-left:78px; margin-top: -10px;"> <?php $sub_off=$pro_sugg->Product_offer;
						
						if($sub_off == 1)
						{
						$sub_offer=mysqli_query($config,"select * from offer_master where offer_Product_id='". $pro_sugg->Product_id."' and Offer_Status=1 and  Offer_upto >='".date('Y-m-d')."' ");
            $sub_off=mysqli_fetch_object($sub_offer);
          $so = mysqli_num_rows($sub_offer);
						if($so > 0 ){
						?>
						
						<span class="badge m-3 badge-danger"><?php echo $sub_off->Offer_percent; ?>%</span>
						
						<?php }} ?> </div>
                                 <div class="p-3">
                                   


								   <img src="<?php
					 
 $pro_po=mysqli_query($config,"select Product_image from product_image_master where Product_id='".$pro_sugg->Product_id."' and Product_image_status=1 LIMIT 1");
            $pro_poto=mysqli_fetch_array($pro_po);
 if(!$pro_poto)
 {
 echo  "../Photos/product/no_pro.png";
 }else{
	 
	   
	 $pg=substr($pro_poto[0],6);
				   
	 echo $filename =$pg; 
	  



	
 }
 
 
 
 

						   
						   ?>" class="img-fluid item-img w-80 mb-3" style="    height: 115px;
    width: 150px; display: block;">
                                   

								  <p style="font-size: medium;"><b><?php echo $pro_sugg->Product_Name; ?></b></p>
                                    <div class="d-flex align-items-center">
                                    
                              
                              
  <?php
		
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
						  <center>  <p  ><b><span style="color:red;"><strike> <?php  echo  "Rs.".$sub_off->Product_price;  ?> </strike></span><?php  echo  "Rs.".$sub_off->offer_price;   ?> &nbsp;  <span style="color:green;"> <?php  echo $prto[1] ?><?php echo $prto[2] ?> </span></b></p> </center>
 
						
						
						
						<?php  }else{ ?>
          



                   <center>    <p><b> <span style="color:red;"><strike> <?php  echo  "Rs.".$prto[0]   ?> </strike></span>  <?php  echo  "Rs.".$prto[3]   ?> &nbsp;  <span style="color:green;"> <?php  echo $prto[1] ?><?php echo $prto[2] ?> </span></b></p> </center>




                     








						<?php } ?>                              
                              
                              
                              
                              
                              
                              
                              
                              </div>
                              </div>
                              </a>
                           </div>
                        </div>
                     </div>
                     
					 
					 
		<?php } ?>
					 
					 
					
               </div>
          
            </div>
            <!-- Most sales -->
            <div class="title d-flex align-items-center p-3">
               <h6 class="m-0">Recommend for You</h6>
              
            </div>
            <!-- osahan recommend -->
            <div class="osahan-recommend px-3">
               <div class="row">
                  <div class="col-12 mb-3">
                    
  <?php
					 
 $pro_like=mysqli_query($config,"select * from order_master where Customer_id='$session_id'  LIMIT 1  ");
        while($pro_sugg=mysqli_fetch_object($pro_like))
		{
			
		 $recom_pro=mysqli_query($config,"select * from product_master where Product_Active_Status=1 and Main_Category='".$pro_sugg->Order_Main_Category."' and Product_id !='".$pro_sugg->Order_product."' ");
        $rec_sugg=mysqli_fetch_object($recom_pro);	
			
			
			
			
   ?>
			
					<a href="product_details.php?Prodetail=<?php echo $rec_sugg->Product_id;?>" class="text-dark text-decoration-none">
                        <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                           <div class="recommend-slider rounded pt-2">
                             

<?php

 $rec_po=mysqli_query($config,"select Product_image from product_image_master where Product_id='".$rec_sugg->Product_id."' and Product_image_status=1 LIMIT 2");
           while( $rev_poto=mysqli_fetch_array($rec_po))

		   {
?>

							 <div class="osahan-slider-item m-2 rounded">
                                 <img src="<?php
					 

 if(!$rev_poto)
 {
 echo  "../Photos/product/no_pro.png";
 }else{
	 
	  
	 $pg=substr($rev_poto[0],6);
				  echo  $pg;
 }
 
 
 
 

						   
						   ?>" class="img-fluid mx-auto rounded shadow-sm" alt="Responsive image">
                              </div>
		   <?php } ?>
                              
                           </div>
                           <div class="p-3 position-relative">
                              <h6 class="mb-1 font-weight-bold text-success"><?php echo  $rec_sugg->Product_Name?>
                              </h6>
                               
                              <div class="d-flex align-items-center">
                                  <?php
		
 $prpo=mysqli_query($config,"select Product_price,Product_Type_number,Product_type,Shelling_price from product_price_master where Product_status=1 and Product_id ='".$rec_sugg->Product_id."' ");
            $prto=mysqli_fetch_array($prpo);
 
 ?>
      <?php $sub_off=$rec_sugg->Product_offer;
						
						if($sub_off == 1)
						{ ?>
					
				 
					<?php
					
					    $ofqu=$prto[1].$prto[2];
						$sub_offer=mysqli_query($config,"select * from offer_master where offer_Product_id='". $rec_sugg->Product_id."' and  Offer_upto >='".date('Y-m-d')."' and offer_quality='$ofqu' ");
            $sub_off=mysqli_fetch_object($sub_offer);
           			
						?>
						  <center>  <p  ><b><span style="color:red;"><strike> <?php  echo  "Rs.".$sub_off->Product_price;  ?> </strike></span><?php  echo  "Rs.".$sub_off->offer_price;   ?> &nbsp;  <span style="color:green;"> <?php  echo $prto[1] ?><?php echo $prto[2] ?> </span></b></p> </center>
						
						
						
						
						<?php  }else{ ?>
          



                   <center>    <p><b> <span style="color:red;"><strike> <?php  echo  "Rs.".$prto[0]   ?> </strike></span>  <?php  echo  "Rs.".$prto[3]   ?> &nbsp;  <span style="color:green;"> <?php  echo $prto[1] ?><?php echo $prto[2] ?> </span></b></p> </center>












						<?php } ?>                              
                              
                              
                              
                     
                     </div>
                     </div>
                     </div>
                     </a>
					 
					 
		<?php } ?>
					 
					 
					 
                  </div>
                 
               </div>
            </div>
         </div>
      </div>
      <!-- Footer -->
   <?php include('footermenu.php');?>
     <?php include('menu.php');?> <!-- Bootstrap core JavaScript -->
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