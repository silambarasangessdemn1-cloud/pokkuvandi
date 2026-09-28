<?php include('../../config/setup.php');?>
<?php
 if(isset($_POST['shop_edit']))
 { 
$editon=date('Y-m-d');
$update_offer=mysqli_query($config,"update shop_setting set Shop__setting='".$_POST['shop_set_Name']."' where shop_id='".$_POST['shop_set_id']."'");
 if($update_offer==false)
{
echo "<script>window.location.href='../shop_setting.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../shop_setting.php?msg=100';</script>";	 

	
}

 }

?>
 