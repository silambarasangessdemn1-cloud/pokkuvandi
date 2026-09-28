<?php include('config/setup.php');?>
<?php 


   $sql4="SELECT * FROM `biding_area_master` where cityid='".$_POST['id']."'  ";
$main_cate4=mysqli_query($config,$sql4);

 $data .='<select id="area1" name="area[]" multiple aria-label="multiple select example" class="form-select area_s form-control" aria-label="Default select example">';

while($macate4=mysqli_fetch_object($main_cate4))

{


  $data .='<option value="'.$macate4->area_id.' ">'.$macate4->area_name.'</option>';
}

$data .='</select>';

echo $data;