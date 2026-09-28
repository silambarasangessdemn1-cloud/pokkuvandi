<?php include('../../config/setup.php');?>
<?php

if(isset($_POST['product_tax_add']))
{
 
$maincate=date('Y-m-d');
$addprotype=mysqli_query($config,"insert into tax_master(Tax,Tax_status)
                                 values('".$_POST['Add_product_tax']."','".$_POST['Add_product_tax_status']."')");	
if($addprotype==false)
{
 	
 	 echo "<script>window.location.href='../tax.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../tax.php?msg=505';</script>";	 

	
}	







}
?>
