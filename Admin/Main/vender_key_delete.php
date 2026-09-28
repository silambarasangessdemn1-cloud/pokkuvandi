<?php include('../config/setup.php');?>
<?php 

if(isset($_GET['id']))
{
    $sql3 = "DELETE FROM dir_keyword WHERE dirkeyid='".$_GET['id']."'";
    mysqli_query($config,$sql3);
    $eid=$_GET['eid'];
    $p=$_GET['packid'];
    header("location:dir_bussness_list_details_key.php?eid=$eid&packid=$p");
    die;
}
if(isset($_POST['editkeywordss']))
{
 $_POST['areakey'];
$packarea=$_POST['packarea'];

    $sql = "UPDATE dir_keyword SET dir_vender_city='".$_POST['dir_city']."',dir_vender_pack='".$packarea[0]."',dir_vender_area='".$_POST['areakey']."',dir_vender_key='".$_POST['keywords']."' WHERE dirkeyid='".$_POST['id']."'";

mysqli_query($config, $sql);
$eid=$_POST['eid'];
$p=$_POST['packid'];
header("location:dir_bussness_list_details_key.php?eid=$eid&packid=$p");
die;
}
