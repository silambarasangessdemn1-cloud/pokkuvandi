
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
     
      <div class="osahan-cart">
      <div class="p-3 border-bottom">
         <div class="d-flex align-items-center">

         <a class="font-weight-bold text-success text-decoration-none" href="home.php">

<i class="icofont-rounded-left back-page"></i></a>
            <h5 class="font-weight-bold m-0">Cart</h5>
            <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>
         </div>
      </div>
      <div class="osahan-body">
	 <form action="Cart_checkout.php" method="post">
 	<?php 
	$adcart=mysqli_query($config,"select * from order_master where Customer_id='$session_id' and Order_status='Cart' ");
	while($ac=mysqli_fetch_object($adcart))
	
	{
		 
 
		?>


	<div class="cart-items bg-white position-relative border-bottom">
            <a href="#" class="position-absolute" style="    padding-left: 89px;">
           
			<?php
			$sub_offer=mysqli_query($config,"select * from offer_product where offer_Product_id='". $ac->Order_product."' and  Offer_upto >='".date('Y-m-d')."' and offer_Protuct_price_type='".$ac->Order_type_quantity."' ");
            $sub_off=mysqli_fetch_object($sub_offer);
          if($sub_off)
		  {
		  ?>
			 <span class="badge badge-danger m-3">	<?php echo $sub_off->Offer_percent;?>	%</span>	
			<?php 
	}
			
			?>
			
			
			
			
			
            </a>	   <div class=" align-items-center position-absolute " style="margin-left:340px;    margin-bottom: -19px;    margin-top: 10px;">
                          <a href="delete_cart.php?delpro=<?php echo $ac->Order_id; ?>&delid=4004&cid=<?php echo $ac->order_customer_track_id; ?>&pid=<?php echo $ac->Order_product; ?>" onclick="return confirm('Are you confirm to Remove this Cart?');"  class="text-decoration-none text-danger"><i class="icofont-trash"></i></a>
</div>
            <div class="d-flex  align-items-center p-3">
              
<input type="hidden" name="order_id[]" value="<?php echo $ac->Order_id; ?>">
<input type="hidden" name="order_pro[]" value="<?php echo $ac->Order_product; ?>">
<input type="hidden" name="order_pro_tax[]" value="<?php echo $ac->Product_tax; ?>">


			  <img src="
			   
			<?php
					 
 $pro_po=mysqli_query($config,"select Product_image from product_image_master where Product_id='".$ac->Order_product."' and Product_image_status=1 LIMIT 1");
            $pro_poto=mysqli_fetch_array($pro_po);
 if(!$pro_poto)
 {
 echo  "../Photos/product/no_pro.png";
 }else{
	 
	  
	 $pg=substr($pro_poto[0],6);
				  echo  $pg;
 }
 
	   ?> "  style="width:140px; height: 102px;"    > 
               <a href="#" class="ml-3 text-dark text-decoration-none w-100">
                  <p class="mb-1"><b><?php echo $ac->Productname;?></b></p>
                  <p class="text-muted mb-2">Rs.
			 
				   
					   
				  <span id="product_price"> <?php echo $ac->Order_type_quantity;?></span>
 <input type="hidden"   name="total[]"   value=" <?php echo $ac->Order_product_price;?>">
 			   
				  </p>
				    <div class="p-3 bg-white">
			      <p style="margin-bottom: -1.5rem !important;    margin-left: -27px;"><b>Select Quantity</b></p> 
      
 <div class="quantity buttons_added" style="margin-left: 87px;" >
 


		
			<input  data-id="<?php echo $ac->Order_id; ?>" type="button" value="-" name="minus" class="minus">			 
		   <?php
					 $csd="select * from product_master  where Product_id='".$ac->Order_product ."'"; 
 $pro_like=mysqli_query($config,$csd);
      $pro_sugg=mysqli_fetch_object($pro_like);
		
   ?>
	
	<input  type="number" name="qty[]" class="input-text txt qty mytext" size="2" min="1" max="<?php echo  $pro_sugg->Product_Avalible_Stocks ?>"  id="qty<?php echo $ac->Order_id; ?>" value="<?php echo str_replace(' ', '', $ac->Ordered_quantity);?>" required  />
	
	
	
 

	<input  data-id="<?php echo $ac->Order_id; ?>" type="button" value="+" name="add" class="plus">



 
</div>


                </div>
				     
                  <div class="d-flex align-items-center">
				  </h6> 
<input type="hidden" name="price" class="txt price" id="price<?php echo $ac->Order_id; ?>" value="<?php echo $ac->Order_product_price;?> " />
<h6 class=" font-weight-bold m-0" >   Total :   <span id="total<?php echo $ac->Order_id; ?>"  style="
    font-size: 20px;
"> Rs.<?php echo $ac->Order_Price;?> </span></h6>  
                                
                  </div>
               </a>
            </div>
         </div>
     

  
  

 
		 
	<?php } ?> 
	 
	 
	 <?php 
	$countcart=mysqli_query($config,"select * from order_master where Customer_id='$session_id' and Order_status='Cart' ");
 
		 $cc=mysqli_num_rows($countcart);
 if($cc > 0)
 {
		?>
	 
	   <div class="p-3 mt-5">
            
               <div class="rounded shadow bg-success d-flex align-items-center p-3 text-white">
                  <div class="more">
                  <button type="submit" name="add_to_cart" class="btn btn-success" >Proceed to checkout</button>
                    
                  </div>
                  </form>
               </div>
 
         </div>
	
 
	<?php }else{ ?>
	
	<div class="p-3 mt-3">
            
                  <center>   
               <a href="home.php" class="btn btn-danger" ><span> Cart is Empty</span></a>
                    
                 </center>
                   
               
           
         </div>
	
	
	
	
	
	
	<?php } ?>

		 
		 
		 
		 
		 
		 
		 
      </div>  	
      <!-- Footer -->
         <?php  include('footermenu.php');?> 
        <?php include('menu.php');?>
		<script>
 
$(".minus").click(function(){
    var id = $(this).attr('data-id');
    var qty = $("#qty"+id).val();
		if(qty > 1){
       qty--;
       $("#qty"+id).val(qty);
        var getPrice = $("#price"+id).val();
        getPrice = parseFloat(getPrice).toFixed(2);
        var totalAmt = getPrice*qty;
        $("#total"+id).text("Rs. "+totalAmt);
    }else if(qty = 1){
         qty--;
       $("#qty"+id).val(qty);
        var getPrice = $("#price"+id).val();
        getPrice = parseFloat(getPrice).toFixed(2);
        var totalAmt = getPrice*1;
        $("#total"+id).text("Rs. "+totalAmt);  
        
    }
    
    
    
    
});
$(".plus").click(function(){
		var id = $(this).attr('data-id');
    var qty = $("#qty"+id).val();
    qty++;
    $("#qty"+id).val(qty);
    var getPrice = $("#price"+id).val();
    getPrice = parseFloat(getPrice).toFixed(2);
    var totalAmt = getPrice*qty;
    $("#total"+id).text("Rs. "+totalAmt);
    
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