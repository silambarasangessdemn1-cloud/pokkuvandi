<?php include('../../config/setup.php');?>
<?php
 if(isset($_POST['order_edit']))
 { 
$editon=date('Y-m-d');
$update_offer=mysqli_query($config,"update order_master set Delivery_status='".$_POST['order_delivery_status']."' where order_customer_track_id='".$_POST['order_track_id']."'");
 if($update_offer==false)
{
echo "<script>window.location.href='../order_master_on_process.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../order_master_on_process.php?msg=100';</script>";	 

	
}

 }

?>
 