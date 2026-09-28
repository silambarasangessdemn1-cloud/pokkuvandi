<?php include('../../config/setup.php');?>
<?php

if(isset($_POST['add_new_deliveyr_location']))
{
 
 
$addlocation=mysqli_query($config,"insert into delivery_price_master(delivery_location,devlivery_price,Delivery_status)values('".$_POST['Add_delivery_location']."','".$_POST['Add_Delivery_price']."','".$_POST['Add_delivery_status']."')");	
if($addlocation==false)
{
 	
 	 echo mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../delivery_price.php?msg=505';</script>";	 

	
}	







}
?>
