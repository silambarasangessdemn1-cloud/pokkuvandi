<?php include('../../config/setup.php');?>
<?php
 if(isset($_POST['pay_edit']))
 { 
$editon=date('Y-m-d');
$update_offer=mysqli_query($config,"update payment_setting set Payment_Mode='".$_POST['Payment_Name']."',Payment_status='".$_POST['pay_status']."',Payment__id='".$_POST['pay_key_id']."',Payment_Key='".$_POST['pay_key']."' where Payment_id='".$_POST['pay_id']."'");
 if($update_offer==false)
{
echo "<script>window.location.href='../Online_Payment_api.php?erro=0';</script>".mysqli_error();	 
}
else if($_POST['pay_option'] != 'COD'){
	
	$update_offer=mysqli_query($config,"update payment_setting set Payment_status='0' where 
	Payment_Option !='".$_POST['pay_option']."'and Payment_Mode !='COD'");
	echo "<script>window.location.href='../Online_Payment_api.php?msg=100';</script>";	 

	
}else{
	
	echo "<script>window.location.href='../Online_Payment_api.php?msg=100';</script>";	 

}

 }

?>
 