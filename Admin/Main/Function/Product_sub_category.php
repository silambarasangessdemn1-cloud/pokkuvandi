<?php include('../../config/setup.php');?>  
<?php    
 $subname = [];  
 $data = json_decode(file_get_contents("php://input"));  
 $sub_master=mysqli_query($config,"select * from sub_category where Main_Category= '".$data->cate_id."'");
				 while($sb=mysqli_fetch_array($sub_master))
				 {
				 
				  $subname[] =$sb;
				 
				 
				 }
				 echo json_encode($subname);
 ?>