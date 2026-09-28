<?php include('config/setup.php');?>
<?php 

$sql = "INSERT INTO shop_enq (shop_enq_cid,	shop_enq_sub)

VALUES ('".$_POST['cid']."','".$_POST['sub']."')";

mysqli_query($config,$sql);


echo '1';