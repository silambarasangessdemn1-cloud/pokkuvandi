<?php include('../config/setup.php');?>
<?php 

 $sql4="SELECT * FROM `dir_area_master`  where dir_cityid ='".$_POST['id']."' order by (dir_area_name	) ASC ";
   

$main_cate4=mysqli_query($config,$sql4);


while($macate4=mysqli_fetch_object($main_cate4))

{


  $data .='<option value="'.$macate4->dir_area_id.' ">'.$macate4->dir_area_name	.'</option>';
}

$data .='</select>';

echo $data;