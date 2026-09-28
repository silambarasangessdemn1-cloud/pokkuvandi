<?php include('../../config/setup.php');?>

<?php
if(isset($_POST['edit']))

{ 
 $sql = "UPDATE dir_package SET dir_title='".$_POST['title']."',dir_amount='".$_POST['amount']."',package_valid='".$_POST['days']."',description='".$_POST['desc']."',total_member='".$_POST['t_member']."',noofarea='".$_POST['numberofarea']."',noofkey='".$_POST['numberofkey']."',order_number='".$_POST['order_list']."',dir_commission='".$_POST['dir_commission']."',add_on_area='".$_POST['areacost']."'  WHERE dir_packid='".$_POST['id']."'";

$update_app_Name=mysqli_query($config,$sql);
if($update_app_Name == true)
 {
	echo "<script>window.location.href='../dir_package.php?msg=100';</script>";	 

}

}