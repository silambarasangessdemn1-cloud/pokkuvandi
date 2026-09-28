<?php include('../config/setup.php');?>

<?php 

$area=$_POST['area'];

$key=$_POST['cheackkey'];

// $main_cate=mysqli_query($config,"select * from dir_city_master order by (dir_city_name) ASC ");

// while($macate=mysqli_fetch_object($main_cate))

// {
// }
$x=1;
 
while($x <= 4) {
    $g="SELECT * FROM `dir_keyword` where dir_vender_area='$area' and dir_vender_key='$key' and dir_vender_pack='$x'";
 $main_cate=mysqli_query($config,$g);
$tomember=mysqli_num_rows($main_cate);
 $main_cate1=mysqli_query($config,"SELECT * FROM `dir_package` where dir_packid='$x' ");

$macate1=mysqli_fetch_object($main_cate1);
 
if($macate1->total_member > $tomember)
{

    $data .='  <input type="checkbox"  name="packarea[]" value="'.$x.'" class="form-check-input editkd" id="">
    <label style="color: #28a745 !important;
    font-weight: 700;" class="form-check-label editkey" for="exampleCheck1">'.$macate1->dir_title .'</label>';
}else{
    $data .='  <input disabled type="checkbox"  name="" value="'.$x.'" class="form-check-input editkd" id="">
    <label class="form-check-label editkey" for="exampleCheck1">'.$macate1->dir_title .'</label>';
}

 $x++;
}
$data .='</div></div>';

echo $data
?>