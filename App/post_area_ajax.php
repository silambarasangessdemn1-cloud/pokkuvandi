<?php include('config/setup.php');?>
<?php 

   echo $sql4="SELECT * FROM `dir_area_master`  where dir_area_id ='".$_POST['id']."'order by (dir_area_name	) ASC ";
   

$main_cate4=mysqli_query($config,$sql4);

 $data .='<select required id="area1" name="area"  aria-label="multiple select example" class="form-select area_s form-control" aria-label="Default select example">';
 $data .='<option value="" >Select</option>';
while($macate4=mysqli_fetch_object($main_cate4))

{


  $data .='<option value="'.$macate4->dir_area_id.' ">'.$macate4->dir_area_name	.'</option>';
}

$data .='</select>';

echo $data;