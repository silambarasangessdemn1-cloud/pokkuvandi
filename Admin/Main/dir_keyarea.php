<?php include('../config/setup.php');?>



    <?php 
    $id=$_POST['id'];
$data .= '<select class="form-control checkstatus" name="areakey" id="areaedit'.$id.'"  onchange="getarea('.$id.');">';
$mc=1;

$main_cate=mysqli_query($config,"SELECT * FROM `dir_area_master` where dir_cityid='".$_POST['city']."' ");

while($macate=mysqli_fetch_object($main_cate))

{



  $data .='<option value="'.$macate->dir_area_id.'">'.$macate->dir_area_name.'</option>';
 }
$data .='</select>';


echo $data;
?>