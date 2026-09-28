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
	   <script  src="js/jquery.min.js"></script>

	   <script src="js/script.js"></script>
	  
	    <link rel="stylesheet" href="css/style1.css" />
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
      <div class="osahan-listing">
         <div class="p-3">
            <div class="d-flex align-items-center">
               <a class="font-weight-bold text-success text-decoration-none" href="home.php"><i class="icofont-rounded-left back-page"></i></a><span class="font-weight-bold ml-3 h6 mb-0">Offer Products </span>
               <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>
            </div>
         </div>
         <div class="osahan-listing px-3 bg-white">
          
		   <div class="row border-bottom border-top">
              <?php
	  
	 
		  					 
 $pro_like=mysqli_query($config,"select * from product_master where Product_Active_Status=1  and Product_offer = 1 ");
        while($pro_sugg=mysqli_fetch_object($pro_like))
		{
		
		$sub_product=mysqli_query($config,"select * from offer_master where Offer_Status=1 and offer_Product_id='".$pro_sugg->Product_id."' and   Offer_upto >='".date('Y-m-d')."'  ");
       
           while($sub_pro=mysqli_fetch_object($sub_product))
               {
		    
		    
		    
		  
		  
	  ?>  
	  
	  
			 <div class="col-12 p-0 border-right">
                  <div class="list-card-image">
                    
                        <div class="member-plan position-absolute" style="
    margin-left: 126px;
    margin-top: -10px;
">
						 <?php $sub_off=$pro_sugg->Product_offer;
						
						if($sub_off == 1)
						{
						$sub_offer=mysqli_query($config,"select * from offer_master where offer_Product_id='". $sub_pro->offer_Product_id."' and Offer_Status=1 and  Offer_upto >='".date('Y-m-d')."' ");
            $sub_off=mysqli_fetch_object($sub_offer);
          $so = mysqli_num_rows($sub_offer);
						if($so > 0 ){
						?>
						
						<span class="badge m-2 badge-danger"><?php echo $sub_off->Offer_percent; ?>%</span>
						
						<?php }} ?>
						
					
					 
						</div>
						 <a href="product_details.php?Prodetail=<?php echo $sub_pro->offer_Product_id; ?>" class="text-dark">
                        <div class="p-3">
                           <img src="<?php
					 
 $pro_po=mysqli_query($config,"select Product_image from product_image_master where Product_id='".$sub_pro->offer_Product_id."' and Product_image_status=1 LIMIT 1");
            $pro_poto=mysqli_fetch_array($pro_po);
 if(!$pro_poto)
 {
 echo  "../Photos/product/no_pro.png";
 }else{
	 
	  
	 $pg=substr($pro_poto[0],6);
				  echo  $pg;
 }
 
    ?>" style="width: 158px;
    height: 102px;
    float: left;"   class="img-fluid item-img  mb-3">
						   
						    </a>
							 <a href="product_details.php?Prodetail=<?php echo $sub_pro->offer_Product_id; ?>" class="text-dark">
                           <h6><?php  
					 
 $pro_like=mysqli_query($config,"select * from product_master where Product_id='". $sub_pro->offer_Product_id."'");
      $pro_sugg=mysqli_fetch_object($pro_like);

   
   echo $pro_sugg->Product_Name;
   
   ?></h6>
                           <div class="d-flex align-items-center">
                                                         
  <?php
		
 $prpo=mysqli_query($config,"select Product_price,Product_Type_number,Product_type,Shelling_price from product_price_master where Product_status=1 and Product_id ='".$sub_pro->offer_Product_id."' ");
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
						  <center>  <p  ><b><span style="color:red;"><strike> <?php  echo  "Rs.".$sub_pro->Product_price;  ?> </strike></span><?php  echo  "Rs.".$sub_off->offer_price;   ?> &nbsp;  <span style="color:green;"> <?php  echo $prto[1] ?><?php echo $prto[2] ?> </span></b></p> </center>
 
						
						
						
						<?php  }else{ ?>
          



                   <center>    <p><b> <span style="color:red;"><strike> <?php  echo  "Rs.".$prto[0]   ?> </strike></span>  <?php  echo  "Rs.".$prto[3]   ?> &nbsp;  <span style="color:green;"> <?php  echo $prto[1] ?><?php echo $prto[2] ?> </span></b></p> </center>




                     








						<?php } ?>                              
                              
                  
		    </div> 
                        
			</a>		  
                     </div>
                    
                  </div>
				  
				
               </div>
			   <?php }} ?>
            </div>
          
			
		  
		  
		  
		  
		  
		  
		  
		  
           
            <!-- Filter Footer -->
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