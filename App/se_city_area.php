<?php include('config/setup.php');



 $data .='<select id="sarea" onchange="getval();" class="form-select form-control" aria-label="Default select example">
<option value=""  selected>Select Area</option>';
$nn="SELECT * FROM `dir_area_master` where dir_cityid='".$_POST['city']."'";
$main_cate33=mysqli_query($config,$nn);
while($macate33=mysqli_fetch_object($main_cate33))
                    { 
$data .='<option value="'.$macate33->dir_area_id.'">'.$macate33->dir_area_name.'</option>';
 }
$data .='</select>';

echo $data;
?>