<?php include('config/setup.php');?>

<?php include('session.php');
$inrologo=mysqli_query($config,"SELECT * FROM `biding_vender` where vender_id='".$_POST['vender']."'");

$del=mysqli_fetch_object($inrologo);
$amount=$_POST['amount'];

if($del->topupamount > $amount)
{

$inro_logo=mysqli_query($config,"SELECT * FROM `biding_enq_pay` where ve_id='".$_POST['vender']."' and biding_enq='".$_POST['enq_id']."' ");

if (mysqli_num_rows($inro_logo) > 0) {

echo '2';

}
else{
    $sql = "INSERT INTO biding_enq_pay (ve_id, biding_enq,biding_amount)
    VALUES ('".$_POST['vender']."', '".$_POST['enq_id']."' ,'".$_POST['amount']."')";
$sql11 = "UPDATE biding_vender SET topupamount=topupamount-'$amount' WHERE vender_id='".$_POST['vender']."'";

mysqli_query($config,$sql11);

if (mysqli_query($config,$sql))
{
    echo '1';
}


}
}
else{
    echo '3';
}
?>