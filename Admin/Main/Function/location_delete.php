<?php include('../../config/setup.php');?>
<?php
if($_GET['redelpt']==700)
{
 

$promo_delete=mysqli_query($config,"delete from city_master where City_id='".$_GET['delprefid']."'");
 if($promo_delete==false)
{
echo "<script>window.location.href='../Location_Master.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../Location_Master.php?delmsg=101';</script>";	 

	
}


}

?>
