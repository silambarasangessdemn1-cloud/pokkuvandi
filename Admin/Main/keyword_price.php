<?php include('../config/setup.php');?>

<?php 

$key=$_POST['key2'];

$ckey= implode(',',$key);


$sql4="SELECT SUM(dir_cost) as key_cost FROM `dir_post` WHERE `dir_post_id` IN($ckey)";
$main_cate4=mysqli_query($config,$sql4);


$macate4=mysqli_fetch_object($main_cate4);

$keycost=$macate4->key_cost;

echo $keycost;
?>