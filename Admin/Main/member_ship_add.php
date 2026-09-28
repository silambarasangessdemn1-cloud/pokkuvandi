<?php include('../config/setup.php');?>

<?php 


$data=1;
if($_POST['rcode']){
$main_cate=mysqli_query($config,"SELECT * FROM `membership_list` where unique_id='".$_POST['rcode']."'");
if (mysqli_num_rows($main_cate) > 0) {

    $macatey=mysqli_fetch_object($main_cate);
    $rid= $macatey->memeber_id;
}else{
    echo '0';
    $data=0;
}
}else{
$main_cate1=mysqli_query($config,"SELECT * FROM `membership_list` INNER JOIN customer_master ON customer_master.Customer_Id=membership_list.user_id where Customer_Phone_No='".$_POST['rnumber']."'");
if (mysqli_num_rows($main_cate1) > 0) {
    $macatey=mysqli_fetch_object($main_cate1);
    $rid= $macatey->memeber_id;

}else{
    echo '1';
    $data=0;
}

}
if($data != 0)
{
    $maincate1=mysqli_query($config,"SELECT * FROM `customer_master`  where Customer_Phone_No='".$_POST['cnumber']."'");


    $macatey2=mysqli_fetch_object($maincate1);
$cid=$macatey2->Customer_Id;
$ddate=$_POST['mdate'];
$date=date("d-m-Y");

          $uid=rand(10000000000,9999999999);

           $dt=date('d-m-Y', strtotime($date. '+'.$ddate.'day'));


$uid=rand(1000000,100000000);
    $sql = "INSERT INTO membership_list (user_id, membership_plan_id, membership_title,valid_days,ex_date,membership_amount,pay_status,member_referraid,unique_id,status,pay_id)
VALUES ('$cid', '".$_POST['mid']."','".$_POST['mtitle']."','".$_POST['mdate']."','$dt','".$_POST['mamount']."','paid','$rid','$uid','1','".$_POST['pay']."')";
 mysqli_query($config,$sql);
 echo '2';
}


?>