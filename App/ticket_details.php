<?php include('config/setup.php');?>
<?php 
if($_POST['id'] == 1)
{



 $sql2 = "UPDATE biding_enq_pay SET status='2',order_id='2',selecid='".$_POST['vid']."' WHERE biding_enq='".$_POST['eid']."' ";
mysqli_query($config,$sql2);
$sql = "UPDATE biding_enq_pay SET  status='".$_POST['id']."',order_id='".$_POST['id']."' WHERE biding_enq_pay_id='".$_POST['tid']."' ";
mysqli_query($config,$sql);
$sql1="SELECT * FROM `biding_enq_pay` INNER JOIN biding_vender ON biding_enq_pay.ve_id=biding_vender.vender_id where biding_enq_pay_id='".$_POST['tid']."'  ";
$details=mysqli_query($config,$sql1);
$coun=mysqli_fetch_object($details);

$sql1="SELECT * FROM `customer_master` where Customer_Id='$coun->cust_id' ";
$details=mysqli_query($config,$sql1);
$coun=mysqli_fetch_object($details);

$data .= '<div class="card">
<div class="card-body">
<center><img src="man.png" style="width:80px"></center><br>
  <p>Name : '.$coun->Customer_Name.'</p>
  <p>Phone Number  : '.$coun->Customer_Phone_No.'</p>
  <p>Email : '.$coun->Customer_Mail_id.'</p>
</div>
</div>';

echo $data;

}elseif($_POST['id'] == 2)
{
    $sql = "UPDATE biding_enq_pay SET status='".$_POST['id']."',order_id='".$_POST['id']."' WHERE biding_enq='".$_POST['eid']."' ";
    mysqli_query($config,$sql);
    $sql11 = "UPDATE biding_enq SET status='cancel' WHERE biding_en_id='".$_POST['eid']."' ";
    mysqli_query($config,$sql11);

    echo '2';
}