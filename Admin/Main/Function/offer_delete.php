<?php include('../../config/setup.php');?>
<?php
if($_GET['delpt']==700)
{
 $_GET['offpr'];
$offer_delete=mysqli_query($config,"delete from offer_master where Offer_id='".$_GET['delpoffid']."'");

$update_pro_price=mysqli_query($config,"update product_master set Product_offer = 0 where Product_id='".$_GET['offpr']."'");

 if($offer_delete==false)
{
echo "<script>window.location.href='../offer_Master.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../offer_Master.php?delmsg=101';</script>";	 

	
}

}

?>
