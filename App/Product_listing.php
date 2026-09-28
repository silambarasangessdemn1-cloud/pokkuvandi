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
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>	
	

		
		
   </head>
   <body class="fixed-bottom-padding">
    
	  
      <div class="osahan-listing">
         <div class="p-3">
            <div class="d-flex align-items-center">
               <a class="font-weight-bold text-success text-decoration-none" href="listing.php?cate_id=<?php echo $_GET['maincate']?>"><i class="icofont-rounded-left back-page"></i></a><span class="font-weight-bold ml-3 h6 mb-0"><?php
 			    $cate_details=mysqli_query($config,"select Sub_Category_Name from sub_category where Sub_Category_id='".$_GET['Prolist']."' ");
          $cate_det=mysqli_fetch_object($cate_details);
         
			   echo  $cate_det->Sub_Category_Name;
			   
			   ?></span>
               <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>
            </div>
         </div>
         <div class="osahan-listing px-3 bg-white">
                 <div class="row border-bottom border-top">     
				 
			 
				 
				 <?php
	  
	  if($_GET['Prolist'] != NULL)
	  
	  {
		  
		$pl=1;
		$sub_product=mysqli_query($config,"select * from product_master where Sub_Categoryid='".$_GET['Prolist']."' and Product_Active_Status=1 ");
       
           while($sub_pro=mysqli_fetch_object($sub_product))
               {
		    
		    
		    
		  
		  
	  ?>  
		
 	
		 
    	 <div class="col-12 p-0 " style="border-bottom: groove;" >
		  <form action="listing_cart.php" method="post">
		   		</br></br>	<h6 > 
					 
   </h6>			
 				  <input type="hidden" name="sub_product"   value="<?php echo $_GET['Prolist'];?>">
 				  <input type="hidden" name="cart_product" id="cart_product"    value="<?php echo $sub_pro->Product_id;?>">
 				  <input type="hidden" name="product_tax"    value="<?php echo $sub_pro->product_tax;?>">



                <p style="padding-left:32px;margin-top: -33px;color: green;"><b> <?php echo $sub_pro->Product_Name;?> </b>
				</p> <a href="product_details.php?Prodetail=<?php echo $sub_pro->Product_id; ?>" style="padding-left: 33px;margin-top: -33px;" class="text-dark"><i class="icofont-eye"></i> View Detail </a>


				  <div class="list-card-image" style="margin-top: -15px;">
                
                       
						 
                        <div class="p-3">
                        <a href="product_details.php?Prodetail=<?php echo $sub_pro->Product_id; ?>" class="text-dark"> 
					 	<img src="<?php
					 
 $pro_po=mysqli_query($config,"select Product_image from product_image_master where Product_id='".$sub_pro->Product_id."' and Product_image_status=1 LIMIT 1");
            while($pro_poto=mysqli_fetch_array($pro_po)) {
 if(!$pro_poto)
 {
 echo  "../Photos/product/no_pro.png";
 }else{
	 
	  
	 $pg=substr($pro_poto[0],6);
				  echo  $pg;
 }
 
 
 
 

						   
						   ?>"  style="width: 132px; height: 106px; float: left;border-style: solid;
    border-color: #adb5bd;
    border-width: thin;    border-radius: 10px;"   class="img-fluid item-img  mb-3">
						   
						   
						   </div>
						   
						   </a>
				
						 
							 
			<?php } ?>                     
           
    
		  <?php
					 

 
  $pro_price=mysqli_query($config,"select * from product_price where Product_status=1 and Product_id='".$sub_pro->Product_id."' and Product_status=1  LIMIT 1");

while($ppr=mysqli_fetch_object($pro_price))
{
 
 
 
 ?>
                 &nbsp;    <h6 style=" margin-top: -20px;"  >&nbsp;
                 <?php if($c_memeber_id != 0){ ?>              
  <span style="color:red;" ><strike class="shellprice<?php echo $sub_pro->Product_id; ?>"> <?php 
				 
				if($ppr->Offer_Status == 1 && $ppr->offer_quality == $ppr->Product_Type_number.$ppr->Product_type)
  {
      
      echo 'Rs.'.number_format($ppr->Shelling_price,0);
  }else {
  
 
  echo  'Rs.'.number_format($ppr->Product_price,0);
  }
				 
				 
				 
				 
				 ?> </strike></span>&nbsp;
        <strike class="meb_pri">   <span class="price<?php echo $sub_pro->Product_id; ?>">  <?php 
  
  if($ppr->Offer_Status == 1 && $ppr->offer_quality == $ppr->Product_Type_number.$ppr->Product_type)
  {
      
      echo 'Rs.'.number_format($ppr->offer_price,0); 
  }else {
  
  echo 'Rs.'.number_format($ppr->Shelling_price,0);
  
  }?></span></strike>
  <span class="meb_off">
  <?php 
  
  if($ppr->Offer_Status == 1 && $ppr->offer_quality == $ppr->Product_Type_number.$ppr->Product_type)
  {
      
      echo 'Rs.'.number_format($ppr->offer_price,0); 
  }else {
  
  echo 'Rs.'.number_format($ppr->Shelling_price - $offpri=round((($ppr->Shelling_price/100)*$c_memeber_off)),0);
  
  }?>
  </span>
  &nbsp;  
  
  <span style="color:green;" class="proquantity<?php echo $sub_pro->Product_id; ?>"> <?php echo $ppr->Product_Type_number?><?php echo $ppr->Product_type?> </span> <?php if($ppr->Offer_Status == 1 && $ppr->offer_quality == $ppr->Product_Type_number.$ppr->Product_type)
  { ?>
      
    	<span class="badge badge-danger prooffer<?php echo $sub_pro->Product_id; ?>"> <?php echo number_format($ppr->off_per,0); ?>%</span>
     
     
<?php  } ?>

<?php }else{?>
  <span style="color:red;" ><strike class="shellprice<?php echo $sub_pro->Product_id; ?>"> <?php 
				 
				if($ppr->Offer_Status == 1 && $ppr->offer_quality == $ppr->Product_Type_number.$ppr->Product_type)
  {
      
      echo 'Rs.'.number_format($ppr->Shelling_price,0);
  }else {
  
 
  echo  'Rs.'.number_format($ppr->Product_price,0);
  }
				 
				 
				 
				 
				 ?> </strike></span>&nbsp;  <span class="price<?php echo $sub_pro->Product_id; ?>">  <?php 
  
  if($ppr->Offer_Status == 1 && $ppr->offer_quality == $ppr->Product_Type_number.$ppr->Product_type)
  {
      
      echo 'Rs.'.number_format($ppr->offer_price,0); 
  }else {
  
  echo 'Rs.'.number_format($ppr->Shelling_price,0);
  
  }
  
  
  
  ?> </span>&nbsp;  <span style="color:green;" class="proquantity<?php echo $sub_pro->Product_id; ?>"> <?php echo $ppr->Product_Type_number?><?php echo $ppr->Product_type?> </span> <?php if($ppr->Offer_Status == 1 && $ppr->offer_quality == $ppr->Product_Type_number.$ppr->Product_type)
  { ?>
      
    	<span class="badge badge-danger prooffer<?php echo $sub_pro->Product_id; ?>"> <?php echo number_format($ppr->off_per,0); ?>%</span>
     
     
<?php  } ?>
<?php }?>

</h6>
  
 
 

					   
  
			   <?php } ?>
 

			
       
                
                     <div class="btn-group osahan-radio btn-group-toggle"  style="margin-left: 17px;" data-toggle="buttons">
         	
 	 <select class="form-control product<?php echo $sub_pro->Product_id; ?>" name="protype"  >
<?php   $pro_price=mysqli_query($config,"select * from product_price where Product_status=1 and Product_id='".$sub_pro->Product_id."'");

while($ppr=mysqli_fetch_object($pro_price))
{
?>

					  
                         	  
				 

  <option data-shellprice="<?php 
  		if($ppr->Offer_Status == 1 && $ppr->offer_quality == $ppr->Product_Type_number.$ppr->Product_type)
  {
      
      echo 'Rs.'.number_format($ppr->Shelling_price,0);
  }else {
  
 
  echo  'Rs.'.number_format($ppr->Product_price,0);
  }
				 
		
  
  
  
  
  
  
  
  ?>" data-price="<?php 
  
  if($ppr->Offer_Status == 1 && $ppr->offer_quality == $ppr->Product_Type_number.$ppr->Product_type )
  {
      
      echo 'Rs.'.number_format($ppr->offer_price,0); 
  }else{
  
  echo 'Rs.'.number_format($ppr->Shelling_price,0);
  
  }
  
  
  
  ?>" data-quantity="<?php echo $ppr->Product_Type_number?><?php echo $ppr->Product_type?>" data-offer="<?php 
  
  if($ppr->Offer_Status == 1 && $ppr->offer_quality == $ppr->Product_Type_number.$ppr->Product_type)
  {
      
      
echo $ppr->off_per."%";
     
     
  } ?>"  value="<?php echo $ppr->Product_price_id?>" > <?php echo $ppr->Product_Type_number?><?php echo $ppr->Product_type?></option>
	  
					
					 
				

				
						
			   <?php } ?>
                 </select> 
 	 
 	 
 	 
 	 
 	 
 	 
 	 
 	 
 	 
 	  	</div>
                 
               
 					   
                     <div class="quantity buttons_added" style="    margin-left: 40px;">
				 
	<input type="button" value="-" class="minus" >
	 
	<input type="number" step="1" min="1" max="<?php echo $sub_pro->Product_Avalible_Stocks; ?>" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode="">
	 
	<input type="button" value="+" class="plus">
	   
</div>         
                     
	</br>

					 <?php 
		 
		 if($session_id != NULL)
		 {
			 if($sub_pro->Product_Avalible_Stocks > 0)
			 {
			 ?>
				  <div class="d-flex align-items-center">
                   <input type="submit" class="btn btn-success btn-sm ml-auto checkall" name="add_to_cart" value="Add" style="width:42px;height: 43px; background-color: #28a745;color: white;    border-radius:47px;">            
                     </div>
			 <?php }else{?>                

 <div class="d-flex align-items-center">
                   <p class="btn btn-danger btn-sm ml-auto checkall"   style="width:50px;height: 50px; background-color: #f50017;color: white;    border-radius:47px;">Sold Out</p>           
                     </div>
				
			 <?php }} ?> 
                  </div>
			  

<script type="text/javascript">
 
    $(function(){
    $('.product<?php echo $sub_pro->Product_id; ?>').change(function(){
     var price = $(this).find('option:selected').attr('data-price');
     var shellprice = $(this).find('option:selected').attr('data-shellprice');
     var proquantity = $(this).find('option:selected').attr('data-quantity');
       var prooffer = $(this).find('option:selected').attr('data-offer');
  
   
   $('.price<?php echo $sub_pro->Product_id; ?>').text(price);
     $('.shellprice<?php echo $sub_pro->Product_id; ?>').text(shellprice);
     $('.proquantity<?php echo $sub_pro->Product_id; ?>').text(proquantity);
     $('.prooffer<?php echo $sub_pro->Product_id; ?>').text(prooffer);
   



   });
    });
</script>
 
	 
      



			  
	  	   </form>	
               </div>
           
		  
          	  

			
		    <?php $pl++;}}else{
				
				header('location:home.php');
			} ?>
		   </div>
		  
		  

           
            <!-- Filter Footer -->
         </div>
      </div>
       <div class="osahan-menu-fotter fixed-bottom bg-white text-center border-top">
         <div class="row m-0">
		 
		  <?php 
		 
		 if($session_id == NULL)
		 {
			 
			 ?>

 
<a href="signin.php" class="btn btn-success btn-block"> Signin Now</a>


		 <?php }else{?>

			  <a href="cart.php" class="btn-warning btn-block py-3" style=" font-size: large;">Product in Cart (<?php
 $cat_="select count(Order_id) from order_master  where Customer_id='$session_id' and Order_status='Cart'  ";
$visitor=mysqli_query($config,$cat_);
$vis=mysqli_fetch_array($visitor);

echo $vis[0];
?>)</a>   
			   
			   
			 
	   
		 <?php } ?>  
		 
		 
		    </div>
      </div>
			 
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