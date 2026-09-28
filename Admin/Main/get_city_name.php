<?php
include('config/setup.php');
$id = $_GET['id'];
$res = mysqli_query($config, "SELECT dir_area_name FROM dir_area_master WHERE id='$id'");
$row = mysqli_fetch_assoc($res);
echo $row ? $row['dir_area_name'] : '';
?>
