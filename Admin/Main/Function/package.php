<?php include('../../config/setup.php');?>

<?php
if(isset($_POST['edit']))

{ 
 $sql = "UPDATE biding_package SET title='".$_POST['title']."',amount='".$_POST['amount']."',package_valid='".$_POST['days']."',description='".$_POST['desc']."',total_member='".$_POST['t_member']."',addonkey_amount='".$_POST['addonkey']."',noofarea='".$_POST['numberofarea']."',addonarea_amount='".$_POST['addonareaamount']."',noofkey='".$_POST['numberofkey']."',topupamount='".$_POST['topupamount']."',minamount='".$_POST['minamount']."',r_earn='".$_POST['r_earn']."',ratio='".$_POST['ratio']."'  WHERE packid='".$_POST['id']."'";

$update_app_Name=mysqli_query($config,$sql);
if($update_app_Name == true)
 {
	echo "<script>window.location.href='../package.php?msg=100';</script>";	 

}

}