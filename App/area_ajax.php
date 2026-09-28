<?php include('config/setup.php');?>
<?php 


   $sql4="SELECT * FROM `vender_keyword` INNER JOIN biding_area_master ON vender_keyword.vender_area1=biding_area_master.area_id where cityid='".$_POST['id']."' and vender_key='".$_POST['kmid']."' Group by (area_id) order by (area_name) ASC ";
$main_cate4=mysqli_query($config,$sql4);

 $data .='<select required id="area1" name="area"  aria-label="multiple select example" class="form-select area_s form-control" aria-label="Default select example">';
 $data .='<option value="" >Select</option>';
while($macate4=mysqli_fetch_object($main_cate4))

{


  $data .='<option value="'.$macate4->area_id.' ">'.$macate4->area_name.'</option>';
}

$data .='</select>';

echo $data;