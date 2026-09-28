<?php include('../config/setup.php');?>
<?php 


$sql4="SELECT * FROM `sub_area_master`  where dirarea_id ='".$_POST['id']."'order by (sub_area_name) ASC ";
   

$main_cate4=mysqli_query($config,$sql4);

 $data .='<select required id="subarea" name="Add_sub_area"  aria-label="multiple select example" class="form-select area_s form-control" aria-label="Default select example">';
 $data .='<option value="" >Select</option>';
while($macate4=mysqli_fetch_object($main_cate4))

{


  $data .='<option value="'.$macate4->sub_area_id .' ">'.$macate4->sub_area_name	.'</option>';
}

$data .='</select>';

echo $data;