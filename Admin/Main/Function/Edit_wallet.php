<?php include('../../config/setup.php');?>
<?php
 if(isset($_POST['wallet_edit']))
 { 
$editon=date('Y-m-d');
$update_offer=mysqli_query($config,"update wallet_master set Wallet_Active_Status='".$_POST['pay_status']."' where walle_id='".$_POST['pay_id']."'");
 if($update_offer==false)
{
echo "<script>window.location.href='../wallet_master.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../wallet_master.php?msg=100';</script>";	 

	
}

 }

?>
 