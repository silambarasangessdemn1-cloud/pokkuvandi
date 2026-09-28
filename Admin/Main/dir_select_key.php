<?php include('../config/setup.php');?>

<?php 

$area=$_POST['area'];



// $main_cate=mysqli_query($config,"select * from dir_city_master order by (dir_city_name) ASC ");

// while($macate=mysqli_fetch_object($main_cate))

// {
// }
foreach($area as $area)
{
    $main_f=mysqli_query($config,"SELECT * FROM `dir_area_master` where dir_area_id='$area'");
    $macateff=mysqli_fetch_object($main_f);
    $data .='<h3 style="color:red"><hr>'.  $macateff->dir_area_name.' </h3>';
    $key=$_POST['cheackkey'];
    foreach($key as $key)
    {
        $main_fb=mysqli_query($config,"SELECT * FROM `dir_post` where dir_post_id='$key'");
        $macateffb=mysqli_fetch_object($main_fb);
        $data .='<div class="row"><div class="col-4"><h3>'.  $macateffb->dir_keyword.' (Rs.'.$macateffb->dir_cost.')</h3> </div>';

        $x = 1;
 
while($x <= 4) {
 $main_cate=mysqli_query($config,"SELECT * FROM `dir_keyword` where dir_vender_area='$area' and dir_vender_key='$key' and dir_vender_pack='$x'");
$tomember=mysqli_num_rows($main_cate);
 $main_cate1=mysqli_query($config,"SELECT * FROM `dir_package` where dir_packid='$x' ");

$macate1=mysqli_fetch_object($main_cate1);
 
if($macate1->total_member > $tomember)
{

    $data .='  <input type="checkbox"  name="'.$area.'_'.$key.'" value="'.$x.'" class="form-check-input" id="">
    <label style="color: #28a745 !important;
    font-weight: 700;" class="form-check-label" for="exampleCheck1">'.$macate1->dir_title .'</label>';
}else{
    $data .='  <input disabled type="checkbox"  name="" value="'.$x.'" class="form-check-input" id="">
    <label class="form-check-label" for="exampleCheck1">'.$macate1->dir_title .'</label>';
}

 $x++;
}
$data .='</div></div>';
    }
}
echo $data
?>