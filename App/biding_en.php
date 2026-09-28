<?php include('config/setup.php');?>
<?php 
date_default_timezone_set("Asia/Kolkata");
 date_default_timezone_get();
 $created_at_time= date( 'd-m-Y h:i a', time ());
if($_POST['price'])
{
$sql = "INSERT INTO biding_enq (custom_id,description,mid,subkey_id,status,cityid,areaid,price,created_at_time)

VALUES ('".$_POST['sessionid']."','".$_POST['desc']."','".$_POST['mid']."','".$_POST['subkey']."','new','".$_POST['city']."','".$_POST['area']."','".$_POST['price']."','$created_at_time')";
$s=mysqli_query($config,$sql);
}else{
  $sql = "INSERT INTO biding_enq (custom_id,description,mid,subkey_id,status,cityid,areaid,created_at_time)

VALUES ('".$_POST['sessionid']."','".$_POST['desc']."','".$_POST['mid']."','".$_POST['subkey']."','new','".$_POST['city']."','".$_POST['area']."','$created_at_time')";
$s=mysqli_query($config,$sql);
}
 $last_id = mysqli_insert_id($config);

$vender_city=$_POST['city'];
  $vender_area=$_POST['area'];

$vender_key=$_POST['mid'];

if($vender_area)
{
   $vender_package=1;
while(3 >= $vender_package ) {
   $ss="SELECT * FROM `biding_vender` INNER join vender_keyword on biding_vender.vender_id=vender_keyword.venderid where vender_package1='$vender_package' and vender_city='$vender_city' and vender_area1='$vender_area' and vender_key='$vender_key'";

  $main_cate1=mysqli_query($config,$ss);
  if (mysqli_num_rows( $main_cate1) > 0) {
$macate3=mysqli_fetch_object($main_cate1);


$main_cate4=mysqli_query($config,"SELECT * FROM `vender_enq_order_management` where vender_area='$vender_area' and vend_package='$vender_package'");


if (mysqli_num_rows($main_cate4) > 0) {

   $macate4=mysqli_fetch_object($main_cate4);
  $sql22="SELECT * FROM `biding_vender` INNER join vender_keyword on biding_vender.vender_id=vender_keyword.venderid where vender_package1='$vender_package' and vender_city='$vender_city' and vender_area1='$vender_area' and vender_key='$vender_key'  and vender_id > '$macate4->vender_last_id'  limit 1 ";
$main_cate5=mysqli_query($config,$sql22);
if (mysqli_num_rows($main_cate5) > 0) {
$macate5=mysqli_fetch_object($main_cate5);
 $vender_id=$macate5->vender_id;
$sql3 = "UPDATE vender_enq_order_management SET vender_last_id='$vender_id' WHERE vender_area='$vender_area' and vend_package='$vender_package'";
mysqli_query($config,$sql3);
  $main_cate5=mysqli_query($config," INSERT INTO vemder_enq_list (enq_id,venderlid)
 VALUES ('$last_id','$vender_id')");



}else{
  $no="SELECT * FROM `biding_vender` INNER join vender_keyword on biding_vender.vender_id=vender_keyword.venderid where vender_package1='$vender_package' and vender_city='$vender_city' and vender_area1='$vender_area' and vender_key='$vender_key' order by vender_id ASC";

$main_cate1=mysqli_query($config,$no);

$macate3=mysqli_fetch_object($main_cate1);
  $vender_id=$macate3->vender_id;

 $sql3 = "UPDATE vender_enq_order_management SET vender_last_id='$vender_id' WHERE vender_area='$vender_area' and vend_package='$vender_package'";

mysqli_query($config,$sql3);
  $main_cate5=mysqli_query($config," INSERT INTO vemder_enq_list (enq_id,venderlid)
 VALUES ('$last_id','$vender_id')");


}



}else{

  $vender_id=$macate3->vender_id;  
 $main_cate4=mysqli_query($config," INSERT INTO vender_enq_order_management (vender_last_id,vender_area,vend_package)
 VALUES ('$vender_id','$vender_area','$vender_package')");
 $main_cate5=mysqli_query($config," INSERT INTO vemder_enq_list (enq_id,venderlid)
 VALUES ('$last_id','$vender_id')");


}

}
$vender_package++;
}

}

//else
else{
   $vender_package=1;
   while(3 >= $vender_package ) {
      $ss="SELECT * FROM `biding_vender` INNER join vender_keyword on biding_vender.vender_id=vender_keyword.venderid where vender_package1='$vender_package' and vender_city='$vender_city'  and vender_key='$vender_key'";
   
     $main_cate1=mysqli_query($config,$ss);
     if (mysqli_num_rows( $main_cate1) > 0) {
   $macate3=mysqli_fetch_object($main_cate1);
   
   
   $main_cate4=mysqli_query($config,"SELECT * FROM `vender_enq_order_management_city` where vender_city='$vender_city' and vend_package='$vender_package'");
   
   
   if (mysqli_num_rows($main_cate4) > 0) {
   
      $macate4=mysqli_fetch_object($main_cate4);
     $sql22="SELECT * FROM `biding_vender` INNER join vender_keyword on biding_vender.vender_id=vender_keyword.venderid where vender_package1='$vender_package' and vender_city='$vender_city'  and vender_key='$vender_key'  and vender_id > '$macate4->vender_last_id' limit 1";
   $main_cate5=mysqli_query($config,$sql22);
   if (mysqli_num_rows($main_cate5) > 0) {
   $macate5=mysqli_fetch_object($main_cate5);
    $vender_id=$macate5->vender_id;
   $sql3 = "UPDATE vender_enq_order_management_city SET vender_last_id='$vender_id' WHERE vender_city='$vender_city' and vend_package='$vender_package'";
   mysqli_query($config,$sql3);
     $main_cate5=mysqli_query($config," INSERT INTO vemder_enq_list (enq_id,venderlid)
    VALUES ('$last_id','$vender_id')");
   
   
   
   }else{
  
   
   $main_cate1=mysqli_query($config,"SELECT * FROM `biding_vender` INNER join vender_keyword on biding_vender.vender_id=vender_keyword.venderid where vender_package1='$vender_package' and vender_city='$vender_city'  and vender_key='$vender_key' order by vender_id ASC");
   
   $macate3=mysqli_fetch_object($main_cate1);
    $vender_id=$macate3->vender_id;
   $sql3 = "UPDATE vender_enq_order_management_city SET vender_last_id='$vender_id' WHERE vender_city='$vender_city' and vend_package='$vender_package'";
   mysqli_query($config,$sql3);
     $main_cate5=mysqli_query($config," INSERT INTO vemder_enq_list (enq_id,venderlid)
    VALUES ('$last_id','$vender_id')");
   
   
   }
   
   
   
   }else{
   
     $vender_id=$macate3->vender_id;  
     $kk=" INSERT INTO vender_enq_order_management_city (vender_last_id,vender_city,vend_package)
     VALUES ('$vender_id','$vender_city','$vender_package')";
    $main_cate4=mysqli_query($config,$kk);
    $main_cate5=mysqli_query($config," INSERT INTO vemder_enq_list (enq_id,venderlid)
    VALUES ('$last_id','$vender_id')");
   

   }
   
   }
   $vender_package++;
   }
}

if($s == true)
{
   echo "1";	 

}


?>