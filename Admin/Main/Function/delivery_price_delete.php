<?php include('../../config/setup.php');?>
<?php
if($_GET['redelpt']==700)
{
 

$promo_delete=mysqli_query($config,"delete from delivery_price_master where delivery_price_id='".$_GET['delprefid']."'");
 if($promo_delete==false)
{
echo "<script>window.location.href='../delivery_price.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../delivery_price.php?delmsg=101';</script>";	 

	
}


}

?>
