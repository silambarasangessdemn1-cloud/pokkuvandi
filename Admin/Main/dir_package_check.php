<?php include('../config/setup.php');?>

<?php 



$main_cate=mysqli_query($config,"SELECT * FROM `dir_package` where dir_packid='".$_POST['id']."'");

while($macate=mysqli_fetch_object($main_cate))

{

    $data['add_on_area']=$macate->add_on_area;
    $data['dir_packid']=$macate->dir_packid;
    $data['dir_amount']=$macate->dir_amount;
    $data['package_valid']=$macate->package_valid;
    $data['total_member']=$macate->total_member;
    $data['noofarea']=$macate->noofarea;
    $data['noofkey']=$macate->noofkey;
    $data['dir_commission']=$macate->dir_commission;


 }

 echo json_encode($data);
?>