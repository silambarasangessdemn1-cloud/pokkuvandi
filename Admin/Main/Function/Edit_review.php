<?php include('../../config/setup.php');?>
<?php
 if(isset($_POST['wallet_edit']))
 { 
$editon=date('Y-m-d');
$update_offer=mysqli_query($config,"update review_master set Review_status='".$_POST['revi_status']."' where review_id='".$_POST['rv_id']."'");
 if($update_offer==false)
{
echo "<script>window.location.href='../Review_Master.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../Review_Master.php?msg=100';</script>";	 

	
}

 }

?>
 