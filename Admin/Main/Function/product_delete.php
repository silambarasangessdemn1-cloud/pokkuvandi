<?php include('../../config/setup.php');?>
<?php
if($_GET['delprocat']==801)
{
 

$pro_gall_delete=mysqli_query($config,"delete from product_image_master where product_image_id='".$_GET['delproid']."'");
 if($pro_gall_delete==false)
{
echo "<script>window.location.href='../product_image_master.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../product_image_master.php?delmsg=101';</script>";	 

	
}


}


