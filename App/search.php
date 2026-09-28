<?php include('config/setup.php')?>
<?php include('session.php');?>

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
	    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
  
<style>

a:hover {
   cursor: pointer;
   background-color: yellow;
}


</style>


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
	   <form action="search.php" method="POST">
      <div class="osahan-search">
         <div class="p-3 border-bottom">
            <div class="d-flex align-items-center">
               <a class="font-weight-bold text-success text-decoration-none" href="home.php">
               <i class="icofont-rounded-left back-page"></i></a>
              
			   
			   <div class="input-group ml-3 rounded shadow-sm overflow-hidden bg-white">
                 
                  <input type="text" class="shadow-none border-0 form-control pl-0" name="search" placeholder="Search for Products.." >
                 
            <div class="input-group-prepend">
                     <button type="submit" name="search_now"  class="btn btn-secondary text-success"><i class="icofont-search" style="color: white;"></i></button>
                  </div>
				 
               </div>
			 
			   <div id="display"></div>
			   
            </div>
         </div>
      </div>
      </form>
		<?php
 
if (isset($_POST['search_now'])) {
 
    $Name = $_POST['search'];
 
   $sear =mysqli_query($config,"SELECT *  FROM search_product WHERE search_tag LIKE '%$Name%'");
   $rcou=mysqli_num_rows($sear);
   if($rcou == 0)
   { ?>
	     <div class="d-flex align-items-center border-bottom p-3">
             <span class="font-weight-bold">
             
               <p class="small text-muted m-0">Result Not Found</p>
            </span>
         </div>
	   
	<?php
}else{	
	   
	   
   while($pm=mysqli_fetch_object($sear))
   { 
	?>
	  <a href="product_details.php?Prodetail=<?php echo $pm->Product_id; ?>" class="text-dark">
         <div class="d-flex align-items-center border-bottom p-3">
            <img src=" <?php $pro_po=mysqli_query($config,"select Product_image from product_image_master where Product_id='".$pm->Product_id."' and Product_image_status=1 LIMIT 1");
            $pro_poto=mysqli_fetch_array($pro_po);  
			if(!$pro_poto)
 {
 echo  "../Photos/product/no_pro.png";
 }else{
	 $pg=substr($pro_poto[0],6);
				  echo  $pg;      } ?>
     " style="
    width: 140px;
    height: 107px;
    
"           class="img-fluid rounded shadow-sm mr-3">
            <span class="font-weight-bold">
              <?php echo $pm->Product_Name; ?>
               
            </span>
         </div>
      </a>
      
   <?php } ?>  
	  
	 
	  
<?php } }?>
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