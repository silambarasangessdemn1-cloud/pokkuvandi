<?php include('../config/setup.php');?>

<?php 

$sql = "UPDATE dir_vender SET c_ver='".$_POST['verify']."',c_ver_yr='".$_POST['year']."' WHERE dir_vender_id='".$_POST['id']."'";

mysqli_query($config, $sql);
header("location:bussness_list.php");
die;
?>