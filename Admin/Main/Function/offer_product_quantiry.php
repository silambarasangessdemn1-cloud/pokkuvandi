<?php include('../../config/setup.php');?>  
<?php    
 $subname = [];  
 $data = json_decode(file_get_contents("php://input"));  
 $sub_master=mysqli_query($config,"select * from product_price where Product_id= '".$data->pt_id."'");
				 while($sb=mysqli_fetch_array($sub_master))
				 {
				 
				  $subname[] =$sb;
				 
				 
				 }
				 echo json_encode($subname);
 ?>