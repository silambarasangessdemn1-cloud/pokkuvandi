<?php include('../config/setup.php');



$data .='<select name="cate" class="form-select form-control" aria-label="Default select example"><option selected>select </option>';

											$main_cate1=mysqli_query($config,"SELECT * FROM `biding_post` where category_id='".$_POST['id']."' ");

											while($macate1=mysqli_fetch_object($main_cate1))

											{

  $data .='<option value="'.$macate1->post_id.'">'. $macate1->keyword.'</option>';
 }
$data .='</select>';

echo   $data;
?>