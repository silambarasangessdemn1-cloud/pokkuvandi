<?php include('../../config/setup.php');?>
<?php
 if(isset($_POST['customer_edit']))
 { 
$editon=date('Y-m-d');
$update_custom=mysqli_query($config,"update shop_enq set  shop_status='".$_POST['customer_active_status']."' where shop_enq_id='".$_POST['custom_id']."'");
 if($update_custom==false)
{
echo "<script>window.location.href='../shop_req.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../shop_req.php?msg=100';</script>";	 

	
}

 }

?>
 