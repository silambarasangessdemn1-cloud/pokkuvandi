<?php include('../../config/setup.php');?>

<?php
if(isset($_POST['cate_add']))

{ 
    $sql = "INSERT INTO biding_city_master (city_name)

    VALUES ('".$_POST['category']."')";



$update_app_Name=mysqli_query($config,$sql);
if($update_app_Name == true)
 {
	echo "<script>window.location.href='../city_master.php?msg=100';</script>";	 

}
}

if(isset($_POST['e_cate']))

{ 
$sql = "UPDATE biding_city_master SET city_name='".$_POST['category']."'  WHERE city_id='".$_POST['cid']."'";
$update_app_Name=mysqli_query($config,$sql);
if($update_app_Name == true)
 {
	echo "<script>window.location.href='../city_master.php?msg=100';</script>";	 

}

}
if(isset($_GET['cd']))

{ 

    $sql="delete from biding_city_master where city_id='".$_GET['cd']."'";



    $pro_gall_delete=mysqli_query($config,$sql);
    if($pro_gall_delete == true)
 {
	echo "<script>window.location.href='../city_master.php?msg=100';</script>";	 

}
}