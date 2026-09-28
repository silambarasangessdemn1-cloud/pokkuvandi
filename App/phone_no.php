<?php include('config/setup.php');

$user_ph=$_POST['user_ph'];

$shop_master_=mysqli_query($config,"select * from customer_master where Customer_Phone_No = '$user_ph'");
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

               