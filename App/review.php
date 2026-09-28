<?php include('config/setup.php')?>
<?php include('session.php');?>

<?php

if(isset($_POST['review_now']))
{

$opt=count($_POST['options']);
$revcont=count($_POST['reviewcontent']);
 for($op=0; $op < $opt; $op++)
      {
			   
date_default_timezone_set('Asia/Kolkata');

$cartadd=date('Y-m-d');
$check_add=mysqli_query($config," insert into review_master(review_customer,Review_order_id,Review_Product,Review,Review_status,Review_on,Review_Content) 
     values('$session_id','".$_POST['revieworid'][$op]."','".$_POST['reviewprod'][$op]."','".$_POST['options'][$op]."',0,'$cartadd','".$_POST['reviewcontent'][$op]."')");
	
	
 }    
header('location:complete_order.php');
	
	
}



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
      <div class="osahan-review">
         <div class="p-3 border-bottom bg-white">
            <div class="d-flex align-items-center">
               <a class="font-weight-bold text-success text-decoration-none" href="progress_order.php">
               <i class="icofont-rounded-left back-page"></i>Review</a>
               <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>
            </div>
         </div>
      </div>
     

   <form action="review.php" method="post">


<?php 
	$adcart=mysqli_query($config,"select * from order_master where Customer_id='$session_id' and order_customer_track_id='".$_GET['revieworderid']."' ");
	while($ac=mysqli_fetch_object($adcart))
	
	{
		 
	$cartpro=mysqli_query($config,"select * from product_master where Product_id='". $ac->Order_product."' ");
            $cp=mysqli_fetch_object($cartpro);
       	
		
		?>
 <input type="hidden" name="reviewprod[]"  value="<?php echo $ac->Order_product;?>" >
 <input type="hidden" name="reviewcusto[]"  value="<?php echo $ac->Customer_id;?>" >
 <input type="hidden" name="revieworid[]"  value="<?php echo $ac->order_customer_track_id;?>" >
	 <div class="my-5 px-3">
         <h4><?php echo $cp->Product_Name;?> - <?php echo $ac->Order_type_quantity;?> * <?php echo $ac->Ordered_quantity;?></h4>
          <h6 class="font-weight-bold ml-auto mb-1">Rs. <?php echo  $ac->Order_Price?></h6>
		 <p><?php echo  $ac->Order_delivery_date?></p>
        <div class="px-2" style="float: left;">
            <div class="d-flex align-items-center ">
            
                  <div class="btn-group btn-group-toggle" data-toggle="buttons">
                     <label class="btn btn-outline-success active btn-lg">
                     <input type="radio" name="options[]"  value="1" > <i class="icofont-sad"></i>
                     </label>
                     <label class="btn btn-outline-success btn-lg">
                     <input type="radio" name="options[]"  value="2"> <i class="icofont-slightly-smile"></i>
                     </label> <label class="btn btn-outline-success btn-lg">
                     <input type="radio" name="options[]"   value="3"> <i class="icofont-simple-smile"></i>
                     </label><label class="btn btn-outline-success btn-lg">
                     <input type="radio" name="options[]"  value="4"> <i class="icofont-nerd-smile"></i>
                     </label>
                     <label class="btn btn-outline-success btn-lg">
                     <input type="radio" name="options[]"     value="5"> <i class="icofont-heart-eyes font-weight-bold"></i>
                     </label>
                  </div>
               
            </div>
         </div>
	 
	 <div class="d-flex align-items-center ">
	 
	 <textarea placeholder="Enter Your Review" name="reviewcontent[]"></textarea>
	 
	  </div>
	 
      </div>
	  
	  
	<?php } ?>  
	  
	  
	  
	     <input type="submit"  name="review_now"class="btn btn-success fixed-bottom btn-block" value="Review Now">
             
	    </form>
	  
	  
	  
	  
	  
	  <?php include('menu.php')?>
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