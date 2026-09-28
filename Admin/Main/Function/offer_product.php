<?php include('../../config/setup.php');?>
<?php    
 $pro = [];  
   
 $product_master=mysqli_query($config,"select * from product_master where Product_Active_Status=1 and Product_offer=1");
				 while($pm=mysqli_fetch_array($product_master))
				 {
				 
				  $pro[] =$pm;
				 
				 
				 }
				 echo json_encode($pro);
 ?>