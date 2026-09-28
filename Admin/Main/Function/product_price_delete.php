<?php include('../../config/setup.php');?>
<?php
if($_GET['delpt']==901)
{
 

$product_price_delete=mysqli_query($config,"delete from product_price_master where Product_price_id='".$_GET['delptypeid']."'");
 if($product_price_delete==false)
{
echo "<script>window.location.href='../Product_price_Master.php.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../Product_price_Master.php?delmsg=101';</script>";	 

	
}


}


