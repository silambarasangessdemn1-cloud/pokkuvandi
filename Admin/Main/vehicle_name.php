<?php include('../config/setup.php');

$vechilename=$_POST['vechilename'];

$shop_master_=mysqli_query($config,"select * from create_post where vehicle_no = '$vechilename'");
$sm_=mysqli_fetch_object($shop_master_);
if($sm_ !='')
{
    echo "1";
}
else
{
    echo "0";
}
?>

               