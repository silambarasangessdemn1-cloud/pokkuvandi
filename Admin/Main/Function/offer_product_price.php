<?php include('../../config/setup.php');?>  
<?php    
 $proname = [];  
 $data = json_decode(file_get_contents("php://input"));  
 $price_master=mysqli_query($config,"select * from product_price where Product_id = '".$data->pt_id."' and pr_quantity = '".$data->ptqid."'  ");
				 while($prn=mysqli_fetch_array($price_master))
				 {
				 
				  $proname[] =$prn;
				 
				 
				 }
				 echo json_encode($proname);
 ?>