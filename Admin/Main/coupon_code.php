<?php include('../config/setup.php');

$id=$_POST['id'];
//echo $query="select * from coupon where coupon_name = '$id'";
$shop_master_=mysqli_query($config,"select * from coupon where coupon_name = '$id'");
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

               