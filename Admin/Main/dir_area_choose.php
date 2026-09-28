<?php include('../config/setup.php');?>



    <?php 
$data .= '<select class="form-control checkstatus" name="area[]" id="dir_area1"  onchange="getval(this);" multiple>';
$mc=1;

$main_cate=mysqli_query($config,"SELECT * FROM `dir_area_master` where dir_cityid='".$_POST['city']."' ");

while($macate=mysqli_fetch_object($main_cate))

{



  $data .='<option value="'.$macate->dir_area_id.'">'.$macate->dir_area_name.'</option>';
 }
$data .='</select>';


echo $data;
?>