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
      <div class="osahan-listing">
         <div class="p-3">
            <div class="d-flex align-items-center">
               <a class="font-weight-bold text-success text-decoration-none" href="home.php"><i class="icofont-rounded-left back-page"></i></a><span class="font-weight-bold ml-3 h6 mb-0"><?php
			   
			    $cate_details=mysqli_query($config,"select Main_Category_Name from main_category where Main_Category_id='".$_GET['cate_id']."' ");
          $cate_det=mysqli_fetch_object($cate_details);
         
			   echo  $cate_det->Main_Category_Name;
			   
			   ?></span>
               <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>
            </div>
         </div>
 
</br> <div class="pick_today px-3">
          
		   <div class="row">
              <?php
	  
	  if($_GET['cate_id'] != NULL)
	  
	  {
		  
		
		   $sub_details=mysqli_query($config,"select * from sub_category where Main_Category='".$_GET['cate_id']."' and Sub_Category_Status=1 ");
            while($sub_det=mysqli_fetch_object($sub_details))
            {
		    
		  
	  ?>  
			 <div class="col-6  pr-2" style="padding-bottom: 12px;">
                  <div class="list-card bg-white h-60 rounded overflow-hidden position-relative shadow-sm" >
                     <a href="Product_listing.php?Prolist=<?php echo $sub_det->Sub_Category_id;?>&maincate=<?php echo $_GET['cate_id'];?>" class="text-dark">
                        
                        <div class="p-2">
                           <img src="<?php
						   
						   
						     $sub_cate_image=$sub_det->Sub_Category_image;
                  $MCI=substr($sub_cate_image,6);
				  echo  $MCI;

						   
						   ?>" style="width:150px; height:100%;  border-radius: 10px;"   class="img-fluid item-img  mb-3">
                        
                           
 
					 
					
                     </div>
                     </a>
			<center>   <p class=" pt-2 text-center"><?php echo $sub_det->Sub_Category_Name;?></p>   
     </center>
                  </div>

				  
				
               </div></br>
             <?php }}else{
				
				header('location:home.php');
			} ?>
		    
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

<style>
   .p-2 {
    padding: 0.5rem!important;
    height: 143px;
}
</style>