<?php include('config/setup.php');?>

<?php 
date_default_timezone_set("Asia/Kolkata");
 date_default_timezone_get();
 $updated_msg= date( 'd-m-Y h:i a', time ());


$sql2="SELECT * FROM `biding_enq_pay` WHERE ve_id='".$_POST['vender_id']."' and biding_enq='".$_POST['enq_id']."'";
$about=mysqli_query($config,$sql2);
$coun=mysqli_fetch_object($about);

if($coun->count_biding < 1)
{
$sql = "UPDATE biding_enq_pay SET b_amount='".$_POST['amount']."',b_desc='".$_POST['desc']."',count_biding=count_biding+'1',updated_msg='$updated_msg' WHERE ve_id='".$_POST['vender_id']."' and biding_enq='".$_POST['enq_id']."'";
mysqli_query($config,$sql);
// echo '1';
}else{
    $sql = "UPDATE biding_enq_pay SET b_amount2='".$_POST['amount']."',b_desc2='".$_POST['desc']."',count_biding=count_biding+'1',updated_msg='$updated_msg' WHERE ve_id='".$_POST['vender_id']."' and biding_enq='".$_POST['enq_id']."'";
    mysqli_query($config,$sql); 
    // echo '2';
}

// header("location:bidingview.php");
echo '<script> window.location.href = "bidingview.php"; </script>';

?>