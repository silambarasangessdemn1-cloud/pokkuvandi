<?php include('../../config/setup.php');?>
<?php
if($_GET['delpr']==700)
{
 

$promo_delete=mysqli_query($config,"delete from promo_code_master where Promo_id='".$_GET['delpormid']."'");
 if($promo_delete==false)
{
echo "<script>window.location.href='../promo_code_master.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../promo_code_master.php?delmsg=101';</script>";	 

	
}


}

?>
