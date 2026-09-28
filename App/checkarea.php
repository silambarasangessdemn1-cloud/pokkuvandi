<?php include('config/setup.php');?>
<?php 

$area=$_POST['cheackarea'];

$carea= implode(',',$area);

// foreach($area as $area)
// {
  
//     $carea .="'$area',''";
// }

 $sql4="SELECT * FROM `biding_area_master` where cityid='".$_POST['city']."'  AND NOT area_id IN ($carea) ";
$main_cate4=mysqli_query($config,$sql4);

 $data .='<select id="area2" multiple aria-label="multiple select example" name="area[]" class="form-select form-control final" onchange="getval(this);"  aria-label="Default select example">';

while($macate4=mysqli_fetch_object($main_cate4))

{
  


  $data .='<option value="'.$macate4->area_id.' ">'.$macate4->area_name.'</option>';
}

$data .='</select>';

echo $data; 