<?php include('../config/setup.php');?>
<?php 

$area=$_POST['cheackarea'];

$carea= implode(',',$area);

// foreach($area as $area)
// {
  
//     $carea .="'$area',''";
// }

 $sql4="SELECT * FROM `dir_area_master` where dir_cityid='".$_POST['city']."'  AND NOT dir_area_id IN ($carea) ";
$main_cate4=mysqli_query($config,$sql4);

 $data .='<select id="dir_area2"  multiple aria-label="multiple select example" name="area[]" onchange="dir_key2();" class="form-select form-control checkstatus final"   aria-label="Default select example">';

while($macate4=mysqli_fetch_object($main_cate4))

{
  


  $data .='<option value="'.$macate4->dir_area_id.' ">'.$macate4->dir_area_name.'</option>';
}

$data .='</select>';

echo $data; 