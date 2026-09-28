<?php include('../../config/setup.php');?>
<?php
if($_GET['delpt']==700)
{
 

$product_type_delete=mysqli_query($config,"delete from product_type where Product_Type_id='".$_GET['delptypeid']."'");
 if($product_type_delete==false)
{
echo "<script>window.location.href='../product_type_master.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../product_type_master.php?delmsg=101';</script>";	 

	
}


}

?>
