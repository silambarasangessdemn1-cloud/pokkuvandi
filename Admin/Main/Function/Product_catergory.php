<?php include('../../config/setup.php');?>
<?php    
 $category = [];  
   
 $shop_master=mysqli_query($config,"select * from main_category where Main_Category_Status=1");
				 while($sm=mysqli_fetch_array($shop_master))
				 {
				 
				  $category[] =$sm;
				 
				 
				 }
				 echo json_encode($category);
 ?>