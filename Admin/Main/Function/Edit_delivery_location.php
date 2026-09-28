<?php include('../../config/setup.php');?>
<?php
 if(isset($_POST['Delivery_edit']))
 { 
$editon=date('Y-m-d');
$update_offer=mysqli_query($config,"update delivery_price_master set delivery_location='".$_POST['Delivery_Location_Name']."', devlivery_price='".$_POST['Delivery_price']."',Delivery_status='".$_POST['location_delivery_status']."' where delivery_price_id='".$_POST['Delivery_Location_id']."'");
 if($update_offer==false)
{
echo "<script>window.location.href='../delivery_price.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../delivery_price.php?msg=100';</script>";	 

	
}

 }

?>
 