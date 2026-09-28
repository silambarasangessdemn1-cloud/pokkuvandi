<?php include('../../config/setup.php');?>
<?php
if($_GET['delprocat']==900)
{
 
$prodel=$_GET['delproid'];

$pro_delete=mysqli_query($config,"delete from product_master where Product_id='$prodel'");


$pro_gall_delete=mysqli_query($config,"delete from product_image_master where Product_id='$prodel'");

$pro_delete=mysqli_query($config,"delete from product_master where Product_id='$prodel'");





 if($pro_delete==false)
{
echo "<script>window.location.href='../product_master.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../product_master.php?delmsg=101';</script>";	 

	
}


}


