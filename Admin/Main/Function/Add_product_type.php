<?php include('../../config/setup.php');?>
<?php

if(isset($_POST['product_type_add']))
{
 
$maincate=date('Y-m-d');
$addprotype=mysqli_query($config,"insert into product_type(Product_type,Product_type_status,Product_type_Addon)
                                 values('".$_POST['Add_product_type_name']."','".$_POST['Add_product_type_status']."','$maincate')");	
if($addprotype==false)
{
 	
 	 echo "<script>window.location.href='../product_type_master.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../product_type_master.php?msg=505';</script>";	 

	
}	







}
?>
