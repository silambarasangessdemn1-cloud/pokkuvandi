<?php include('../config/setup.php');?>
<?php
if(isset($_GET['did']))
{
    $sql3 = "DELETE FROM dir_vender WHERE dir_vender_id='".$_GET['did']."'";
    mysqli_query($config,$sql3);
    header("location:bussness_list.php");
    die;
}