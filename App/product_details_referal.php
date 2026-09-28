<?php include('config/setup.php')?>
<?php include('session.php');
 
	?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <?php
      
      
	  
      $_GET['Prodetail'] ;
      $get_prfid= base64_decode(urldecode($_GET['Prodetail'])); 

      
         
       
       $product_details=mysqli_query($config,"select * from product_master where Product_id='$get_prfid' and Product_Active_Status=1 ");
        
            $det_pro=mysqli_fetch_object($product_details);
               
           
           
           
         
         
      
      
      
                 
  $pro_po=mysqli_query($config,"select Product_image from product_image_master where Product_id='".$det_pro->Product_id."' and Product_image_status=1 ");
        $pro_poto=mysqli_fetch_array($pro_po);
         $product_details=mysqli_query($config,"select * from product_master where Product_id='$get_prfid' and Product_Active_Status=1 ");
        
        $det_pro=mysqli_fetch_object($product_details);
  
   ?>
 
       
               
              
     
      
 
 <meta name="twitter:card" content="summary" />
 
 <meta name="twitter:site" content="<?php echo $_SERVER['SERVER_NAME'] ?>/App/product_details.php?Prodetail=<?php echo $_GET['Prodetail'] ?>" />
 <meta name="twitter:creator" content="shopbee" />
 <meta property="og:image" content="<?php  $pg=substr($pro_poto[0],6);
  echo  $new_str = str_replace('../', 'https://shopbee.in/', $pg);
 
           ?>" />			
 <meta property="og:title" content="<?php echo $det_pro->Product_Name;?>"/> 
 
  <?php
                 
  $prpo=mysqli_query($config,"select Product_price,Product_Type_number,Product_type,Shelling_price from product_price_master where Product_status=1 and Product_id='".$det_pro->Product_id."' ");
             $prto=mysqli_fetch_array($prpo);
  
  ?>
       <?php $sub_off=$det_pro->Product_offer;
                   
                   if($sub_off == 1)
                   { ?>
                
              
                <?php
                
                      $ofqu=$prto[1].$prto[2];
                   $sub_offer=mysqli_query($config,"select * from offer_master where offer_Product_id='". $det_pro->Product_id."' and  Offer_upto >='".date('Y-m-d')."' and offer_quality='$ofqu' ");
             $sub_off=mysqli_fetch_object($sub_offer);
                     
                   ?>
                   <meta property="og:description" content="<strike> <?php  echo  $sub_off->Product_price;  ?> </strike> RS : <?php echo $sub_off->offer_price;?>"/>
  <meta name="description" content="<strike> <?php  echo  $sub_off->Product_price;  ?> </strike> RS : <?php echo $sub_off->offer_price;?>">
  <meta name="author" content="<?php echo $sub_off->offer_price;?>">
                   
                   
                   
                   <?php  }else{
                      $mrp=  $prto[0];
                      ?>
           
 
           
       
           <?php echo ""; ?>
          <meta property="og:description" content="MRP :Rs <?php echo $mrp ?> Selling price : Rs <?php echo $prto[3]; ?>.00"/>
  <meta name="description" content="MRP : Rs <?php echo $mrp; ?> Selling price : Rs <?php echo $prto[3];?>.00">
  <meta name="author" content="<?php echo $sub_off->offer_price;?>">
          
 
                   <?php } ?>
 
 
 
 
 
 
 
       <meta name="author" content="<?php echo $det_pro->Product_Name;?>">
       <meta property="og:url" content="<?php echo $_SERVER['SERVER_NAME'] ?>/App/product_details.php?Prodetail=<?php echo $_GET['Prodetail'] ?>" />
 
      <meta property="og:type" content="website" />
 
 
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
      $lee[0];
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
		
			<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>	
	<script>
function showUser(id) {
  
    $.ajax({
        url: 'priceing_detail.php',
        type: 'GET',
        data: {option : id},
        success: function(data) {
           document.getElementById('txtHint').innerHTML=data;
        }
    });
}
</script>
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

      <div class="p-3 bg-white">
         <div class="d-flex align-items-center">
         <a class="font-weight-bold text-success text-decoration-none" href="Product_listing.php?Prolist=<?php echo $det_pro->Sub_Categoryid;?>&maincate=<?php echo $det_pro->Main_Category; ?>"><i class="icofont-rounded-left back-page"></i> Back</a>
            <a class="ml-auto font-weight-bold text-white text-decoration" href="#">Share this :- </a>
			<a href="whatsapp://send?text=<?php echo $_SERVER['SERVER_NAME'] ?>/App/product_details.php?Prodetail=<?php echo $_GET['Prodetail'] ?>" data-action="share/whatsapp/share" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" class="font-weight-bold text-white text-decoration-none ml-2" target="_blank" title="Share on whatsapp"><i class="icofont-whatsapp p-2 bg-success shadow-sm rounded-circle"></i></a>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $_SERVER['SERVER_NAME'] ?>/App/product_details.php?Prodetail=<?php echo $_GET['Prodetail'] ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" class="font-weight-bold text-white text-decoration-none ml-2" target="_blank" title="Share on Facebook"><i class="icofont-facebook p-2 bg-primary shadow-sm rounded-circle"></i></a>
		<a href="https://twitter.com/share?url=<?php echo $_SERVER['SERVER_NAME'] ?>/App/product_details.php?Prodetail=<?php echo $_GET['Prodetail'] ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" class="font-weight-bold text-white text-decoration-none ml-2" title="Share on Twitter"><i class="icofont-twitter p-2 bg-primary shadow-sm rounded-circle"></i></a>
 		
 		<a href="mailto:?subject=<?php echo $_SERVER['SERVER_NAME'] ?>&body=<?php echo $_SERVER['SERVER_NAME'] ?>/App/product_details.php?Prodetail=<?php echo $_GET['Prodetail'] ?>" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Mail" class="font-weight-bold text-white text-decoration-none ml-2"><i class="icofont-email p-2 bg-danger shadow-sm rounded-circle"></i></a>
		<a class="toggle ml-3" href="#"><i class="icofont-navigation-menu"></i></a>
         </div>
      </div>
      <?php  
	  
		   $get_referal_client= base64_decode(urldecode($_GET['cli'])); 
	        
	          $get_referal_client= base64_decode(urldecode($_GET['cli'])); 
		  
		  $a= $get_referal_client ;
		  $session_id;
		  if($a == $session_id){
		header('location:home.php');
		  
		  }else{
		  $get_prfid= base64_decode(urldecode($_GET['Prodetail'])); 
	       $get_referal_code= base64_decode(urldecode($_GET['referalcode'])); 
		   $get_referal_client= base64_decode(urldecode($_GET['cli'])); 
	  ?>
	  
	 <form action="referal_cart_rdirect.php" method="GET">
	  
	 <?php
	    


	  if(($get_prfid != NULL)&&($get_referal_code != NULL)&&($get_referal_client != NULL))
	  
	  {
		    
	 
	  
		       
		
		$product_details=mysqli_query($config,"select * from product_master where Product_id='$get_prfid' and Product_Active_Status=1 ");
       
           while($det_pro=mysqli_fetch_object($product_details))
               {
		    
		    
		    
		  
		  
	  ?>    
	  
	  
	  
	  
	  
	  
	  
	  <input type="hidden" name="cart_product" value="<?php echo $det_pro->Product_id;?>">
	  <input type="hidden" name="ref_product_code" value="<?php echo  $get_referal_code;?>">
	  <input type="hidden" name="ref_product_client" value="<?php echo $get_referal_client;?>">
	   <input type="hidden" name="cart_product_tax" value="<?php echo $det_pro->product_tax;?>">
<div class="px-3 bg-white pb-3">
         <div class="pt-0">
            <h2 class="font-weight-bold"><?php echo $det_pro->Product_Name;?></h2>
           
			 
              
			   <?php
					 
 $prpo=mysqli_query($config,"select Product_price,Product_Type_number,Product_type,Shelling_price from product_price_master where Product_status=1 and Product_id='".$det_pro->Product_id."' ");
            $prto=mysqli_fetch_array($prpo);
 
 ?>
      <?php $sub_off=$det_pro->Product_offer;
						
						if($sub_off == 1)
						{ ?>
					
				 
					<?php
					
					      $ofqu=$prto[1].$prto[2];
						$sub_offer=mysqli_query($config,"select * from offer_master where offer_Product_id='". $det_pro->Product_id."' and  Offer_upto >='".date('Y-m-d')."' and offer_quality='$ofqu' ");
            $sub_off=mysqli_fetch_object($sub_offer);
           			
						?>
						   <h6 style=" margin-top:34px;" id="txtHint"><span style="color:red;"><strike> <?php  echo  "Rs.".$sub_off->Product_price;  ?> </strike></span>&nbsp;    <?php  echo  "Rs.".$sub_off->offer_price;   ?> &nbsp;  <span style="color:green;"> <?php  echo $prto[1] ?><?php echo $prto[2] ?> </span><span class="badge badge-danger ml-2"><?php  echo $sub_off->Offer_percent; ?> % OFF</span></h6>
						
						
						
						
						<?php  }else{ ?>
          



                      <h6 style=" margin-top:34px;" id="txtHint"><span style="color:red;"><strike> <?php  echo  "Rs.".$prto[0]   ?> </strike></span>&nbsp;    <?php  echo  "Rs.".$prto[3]   ?> &nbsp;  <span style="color:green;"> <?php  echo $prto[1] ?><?php echo $prto[2] ?> </span></h6>












						<?php } ?>
		 
            <a href=""data-toggle="modal" data-target="#review">
            <div class="rating-wrap d-flex align-items-center mt-2">
               <ul class="rating-stars list-unstyled">
                  <li>
                     <?php   $star_review = mysqli_query($config,"select * from review_final where  Review_Product='".$det_pro->Product_id."'");

while($strrev=mysqli_fetch_object($star_review))
	{
		
		 $s=Round($strrev->pro_review / $strrev->review_count);
		if( $s == 1)
		{
		
		?>
					 <i class="icofont-star text-warning"></i>
                     <i class="icofont-star"></i>
                     <i class="icofont-star "></i>
                     <i class="icofont-star "></i>
                     <i class="icofont-star"></i>
		<?php }else if( $s == 2){?>


					 <i class="icofont-star text-warning"></i>
                     <i class="icofont-star text-warning"></i>
                     <i class="icofont-star "></i>
                     <i class="icofont-star "></i>
                     <i class="icofont-star"></i>
<?php }else if( $s == 3){?>


					 <i class="icofont-star text-warning"></i>
                     <i class="icofont-star text-warning"></i>
                     <i class="icofont-star text-warning "></i>
                     <i class="icofont-star "></i>
                     <i class="icofont-star"></i>
<?php }else if( $s == 4){?>


					 <i class="icofont-star text-warning"></i>
                     <i class="icofont-star text-warning"></i>
                     <i class="icofont-star text-warning "></i>
                     <i class="icofont-star text-warning "></i>
                     <i class="icofont-star"></i>
<?php }else if( $s == 5){?>


					 <i class="icofont-star text-warning"></i>
                     <i class="icofont-star text-warning"></i>
                     <i class="icofont-star text-warning "></i>
                     <i class="icofont-star text-warning "></i>
                     <i class="icofont-star text-warning"></i>



		
<?php }else{ ?>	

<i class="icofont-star"></i>
                     <i class="icofont-star "></i>
                     <i class="icofont-star  "></i>
                     <i class="icofont-star  "></i>
                     <i class="icofont-star "></i>


	 
<?php }} ?>	 
                  </li>
               </ul>
               <p class="label-rating text-muted ml-2 small"> (<?php   $pro_review = mysqli_query($config,"select * from review_calc where  Review_Product='".$det_pro->Product_id."'");

while($rpr=mysqli_fetch_object($pro_review))
{
	
	echo $rpr->review_count;
}
?>
 - Reviews)</p>
            </div>
            </a> 
         </div>
		 
		<div class="modal fade" id="review" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Customer  Review - <?php echo $det_pro->Product_Name;?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
<?php   
$r=1;
$cust_review = mysqli_query($config,"select * from review_master where  Review_Product='".$det_pro->Product_id."' and Review_status=1");

while($cusr=mysqli_fetch_object($cust_review))
{
?>

	   
			<label for="email2"><?php echo $r; ?>.  <?php 
			
			
			
			$cust_name=mysqli_query($config,"select * from customer_master where Customer_Id ='".$cusr->review_customer."' ");
            $custom_final=mysqli_fetch_object($cust_name);
   		 
										echo	$custom_final->Customer_Name;	
			
			
			
			
			
			
			
			?></label></br>
			   Review - 
			 <ul class="rating-stars list-unstyled">
                  <li>
                    
		<?php
		 $s=$cusr->Review;
		if( $s == 1)
		{
		
		?>
					 <i class="icofont-star text-warning"></i>
                     <i class="icofont-star"></i>
                     <i class="icofont-star "></i>
                     <i class="icofont-star "></i>
                     <i class="icofont-star"></i>
		<?php }else if( $s == 2){?>


					 <i class="icofont-star text-warning"></i>
                     <i class="icofont-star text-warning"></i>
                     <i class="icofont-star "></i>
                     <i class="icofont-star "></i>
                     <i class="icofont-star"></i>
<?php }else if( $s == 3){?>


					 <i class="icofont-star text-warning"></i>
                     <i class="icofont-star text-warning"></i>
                     <i class="icofont-star text-warning "></i>
                     <i class="icofont-star "></i>
                     <i class="icofont-star"></i>
<?php }else if( $s == 4){?>


					 <i class="icofont-star text-warning"></i>
                     <i class="icofont-star text-warning"></i>
                     <i class="icofont-star text-warning "></i>
                     <i class="icofont-star text-warning "></i>
                     <i class="icofont-star"></i>
<?php }else if( $s == 5){?>


					 <i class="icofont-star text-warning"></i>
                     <i class="icofont-star text-warning"></i>
                     <i class="icofont-star text-warning "></i>
                     <i class="icofont-star text-warning "></i>
                     <i class="icofont-star text-warning"></i>



		
<?php }else{ ?>	

<i class="icofont-star"></i>
                     <i class="icofont-star "></i>
                     <i class="icofont-star  "></i>
                     <i class="icofont-star  "></i>
                     <i class="icofont-star "></i>


	 
<?php } ?>	 
                  </li>
               </ul>
			
			
			
			
			
			
			
			
			
			
			<div class="form-group">
			<label for="email2"><?php echo $cusr->Review_Content?></label>
			</div>
         
		 
			
<?php $r++;} ?>			
			
			
			
      </div></hr>
 
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         
      </div>
    </div>
  </div>
</div> 
		 
		 
		 
		 
		 
		 
		 
		 
         <div class="pt-2">
            <div class="row">
               <div class="col-6">
                  <p class="font-weight-bold m-0">Delivery Charge</p>
                
				
				<?php
		   
		   $custom_address=mysqli_query($config,"select * from customer_addresss_master where Customet_id='$session_id' and Address_default = 1");
            $add_check=mysqli_num_rows($custom_address);
			
		$custom_add=mysqli_fetch_object($custom_address);
         
		 $add_check=$custom_add->Delivery_Area;
						 
						 if($add_check == 0){
							 
							 if($session_id != NuLL)
							 
							 {
							 ?>
		  
		 	
				             <p class="text-muted m-0"><a class="btn btn-outline-success btn-sm ml-auto" href="Add_Address.php">Add Address  </a></p>
							 <?php }else{?> 
			 <a class="btn btn-outline-warning btn-sm ml-auto" href="signin.php">Sign In  </a>
			 
							 <?php }}else{ ?>
			 
			 
			  <?php
			
$delivery_prive=mysqli_query($config,"select * from delivery_price_master where delivery_location='$add_check' and Delivery_status=1 ");

$delivery_pp=mysqli_fetch_object($delivery_prive);
 
	
	
	echo "Rs." .$delivery_pp->devlivery_price;
	
 
			 
			 
			 
			 
			 ?>
			 
			 
			<?php  } ?>
			 </div>
           <div class="col-6">
                  <p class="font-weight-bold m-0">Available in:</p>
                     <div class="btn-group osahan-radio btn-group-toggle" data-toggle="buttons">
                       
<select class="form-control" name="protype"  onchange="showUser(this.value)"  >
<?php   $pro_price=mysqli_query($config,"select * from product_price where Product_status=1 and Product_id='".$det_pro->Product_id."'");

while($ppr=mysqli_fetch_object($pro_price))
{
?>

	          	  
				  <?php if($sub_off->offer_quality == $ppr->pr_quantity && Product_offer == 1 )
				  {?>

                      
  <option  value="<?php echo $ppr->Product_price_id?>"><?php echo $ppr->Product_Type_number?><?php echo $ppr->Product_type?> </option>




					  <?php }else{?> 

  <option  value="<?php echo $ppr->Product_price_id?>"><?php echo $ppr->Product_Type_number?><?php echo $ppr->Product_type?></option>
	  
					   <?php }?>
					 
									 
					 
				

						
						
			   <?php } ?>
                 </select>     </div>
                  
               </div>
            </div>
         </div>
      </div>
<div class="osahan-product">
         
         <div class="product-details">
            <div class="recommend-slider py-1">
              <?php
					 
 $pro_po=mysqli_query($config,"select Product_image from product_image_master where Product_id='".$det_pro->Product_id."' and Product_image_status=1 ");
        while($pro_poto=mysqli_fetch_array($pro_po))
		{
 
  ?>

			  <div class="osahan-slider-item m-2">
                  <img src="<?php
				  if(!$pro_poto)
 {
 echo  "../Photos/product/no_pro.png";
 }else{
	 
	  
	 $pg=substr($pro_poto[0],6);
				  echo  $pg;

				  
				  
				  
				  
 }	  
				  
				  ?>" class="img-fluid mx-auto shadow-sm rounded" alt="Responsive image">
               </div>
               
			   
			   
			   
		<?php  
		
 } ?>   
			   
			   
            </div>
            <div class="details">
               <div class="p-3 bg-white">
			     
                       <h6 style="margin-bottom: -1.5rem !important;">Select Quantity</h6> 
              <div class="quantity buttons_added" style="margin-left: 166px;" >
					     
			<input type="button" value="-" class="minus">			 
	
	
	<input type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode="">
	<input type="button" value="+" class="plus">

</div>
					 
					 
					 
					 
					 
					  
               </div>
               <div class="p-3">
                
                  
                  <p class="font-weight-bold mb-2">Product Details</p>
                  <p class="text-muted small"><?php echo $det_pro->Product_description;?></p>
                  
				  
				  
				  
				  <p class="font-weight-bold mb-3">Maybe You Like this.</p>
                



			
                   
				   
				   <?php
					 
 $pro_like=mysqli_query($config,"select * from product_master  where Sub_Categoryid='".$det_pro->Sub_Categoryid ."' ");
        while($pro_sugg=mysqli_fetch_object($pro_like))
		{
   ?>
				   
				   
				   	<div class="row">
				   <div class="col-12 pr-0" style="padding-bottom: 10px;">
				    <a href="product_details.php?Prodetail=<?php echo $pro_sugg->Product_id; ?>" class="text-dark">

                        <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                           <div class="list-card-image">
                             
                                 <div class="member-plan position-absolute" style="
    margin-left: 112px;
    margin-top: -10px;
"> <?php $sub_off=$pro_sugg->Product_offer;
						
						if($sub_off == 1)
						{
						$sub_offer=mysqli_query($config,"select * from offer_master where offer_Product_id='". $pro_sugg->Product_id."' and  Offer_upto >='".date('Y-m-d')."' ");
            $sub_off=mysqli_fetch_object($sub_offer);
          
							if($sub_off){
						?>
						
						<span class="badge m-3 badge-danger"><?php echo $sub_off->Offer_percent; ?>%</span>
						
							<?php }} ?> </div>
                                 <div class="p-3">
                                   


								   <img src="<?php
					 
 $pro_po=mysqli_query($config,"select Product_image from product_image_master where Product_id='".$pro_sugg->Product_id."' LIMIT 1");
            $pro_poto=mysqli_fetch_array($pro_po);
 if(!$pro_poto)
 {
 echo  "../Photos/product/no_pro.png";
 }else{
	 
	  
	 $pg=substr($pro_poto[0],6);
				  echo  $pg;
 }
 
 
 
 

						   
						   ?>"  style="width:158px; height: 102px;float: left;" class="iimg-fluid item-img  mb-3">
	   <h6><?php echo $pro_sugg->Product_Name; ?></h6>
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
                             
                           </div>
                        </div>
                   </a>   </div>
					 
					 
					 
                 </div>     
					 
					 
		<?php } ?>
					 
					 
					 
					 
					 
					 
					 
                 
               
               </div>
            </div>
            <div class="fixed-bottom pd-f bg-white d-flex align-items-center border-top">
        

 <?php 
		 
		 if($session_id == NULL)
		 {
			 
			 ?>

<a href="signup.php?pid=<?php echo urlencode(base64_encode($get_prfid)); ?>&prefcode=<?php echo urlencode(base64_encode($get_referal_code)); ?>&Recli=<?php echo  urlencode(base64_encode($get_referal_client)); ?>" class="btn btn-warning btn-block"> Signup Now</a>

<a href="signin.php?rp=<?php echo $get_prfid; ?>&rco=<?php echo $get_referal_code; ?>&rc=<?php echo  $get_referal_client; ?>" class="btn btn-success btn-block"> Signin Now</a>


		 <?php }else{
			 if( $det_pro->Product_Avalible_Stocks > 0)
			 {?>
			<input type="submit" class="btn-warning btn-block py-3 " name="add_to_cart" value=" Add  ">   
			   
			   
			   
			   <input type="submit" class="btn btn-success btn-block" name="add_to_cart" value="buy">
			   
		 <?php }else{ ?> 


<p class="btn btn-danger btn-block "> Sold out</p>


		 <?php }} ?>  
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
            </div>
         </div>
      </div>
      

       
       </form>
			   <?php } }else{
				
				header('location:home.php');
		  }} ?>
	   
	   
	   
	   
<?php include('menu.php');?>

 

<script type="text/javascript">
 
    $(function(){
    $('.product').change(function(){
     var price = $(this).find('option:selected').attr('data-price');
     $('.price').text(price);
    });
    });
</script>

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