<?php include('../config/setup.php');?>

<?php 

 $_POST['city'];


$data .='<select name="c_area" class="form-control" id="">';
$data .='<option>Select</option>';
 $r="SELECT * FROM `dir_area_master` INNER JOIN dir_city_master ON dir_area_master.dir_cityid=dir_city_master.dir_city_id  where dir_city_name='".$_POST['city']."'";
 $maine=mysqli_query($config,$r);

while($macateb=mysqli_fetch_object($maine))

{ 
 $data .='<option value="'.$macateb->dir_area_name.'">'.$macateb->dir_area_name.'</option>';
 }
 echo $data .='</select>';
?>