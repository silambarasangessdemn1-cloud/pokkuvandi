<?php include('../config/setup.php');?>
<?php 

 $sql4="SELECT * FROM `dir_area_master`  where dir_cityid ='".$_POST['id']."' order by (dir_area_name	) ASC ";
   
 //$data .='<select  id="Add_area" name="Add_area"  onchange="sub_area(this.value);"  aria-label="multiple select example" class="form-select area_s form-control" aria-label="Default select example">';

$main_cate4=mysqli_query($config,$sql4);

 $data .='<select  id="Add_area" name="Add_area"   aria-label="multiple select example" class="form-select area_s form-control" aria-label="Default select example">';
 $data .='<option value="0" >Select</option>';
while($macate4=mysqli_fetch_object($main_cate4))

{


  $data .='<option value="'.$macate4->dir_area_id.' ">'.$macate4->dir_area_name	.'</option>';
}

$data .='</select>';

echo $data;