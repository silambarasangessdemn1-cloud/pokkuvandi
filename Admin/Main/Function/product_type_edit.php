<?php include('../../config/setup.php');?>
<?php
 if(isset($_POST['product_type_edit']))
 { 
$editon=date('Y-m-d');
$update_main_cate=mysqli_query($config,"update product_type set Product_type ='".$_POST['producttype_name']."',Product_type_status ='".$_POST['producttype_status']."' where Product_Type_id ='".$_POST['producttype_id']."'");
 if($update_main_cate==false)
{
echo "<script>window.location.href='../product_type_master.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../product_type_master.php?msg=100';</script>";	 

	
}

 }

?>
 