<?php include('config/setup.php')?>
<?php include('session.php');
 
	?>

<?php
 
$id = $_POST['value'];
$proid = $_REQUEST['userid'];
 
$prpo=mysqli_query($config,"select Product_price,Product_Type_number,Product_type,Shelling_price,Product_id from product_price_master where Product_status=1 and Product_price_id='$id'");
             $prto = mysqli_fetch_array($prpo);
			 
     echo " <h6 style='margin-top: -20px;'><span style='color:red;'><strike> Rs.".$prto[0]. "</strike></span>&nbsp;Rs.".$prto[3]." &nbsp;  <span style='color:green;'>".$prto[1].$prto[2]."</span></h6>";
   		 
  
?>