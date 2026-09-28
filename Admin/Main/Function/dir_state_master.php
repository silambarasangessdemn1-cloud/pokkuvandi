<?php include('../../config/setup.php');?>

<?php
if(isset($_POST['cate_add']))

{ 
    $sql = "INSERT INTO dir_state_master (name)

    VALUES ('".$_POST['category']."')";



$update_app_Name=mysqli_query($config,$sql);
if($update_app_Name == true)
 {
	echo "<script>window.location.href='../dir_state_master.php?msg=100';</script>";	 

}
}

if(isset($_POST['e_cate']))

{ 
$sql = "UPDATE dir_state_master SET name='".$_POST['category']."'  WHERE state_id='".$_POST['cid']."'";
$update_app_Name=mysqli_query($config,$sql);
if($update_app_Name == true)
 {
	echo "<script>window.location.href='../dir_state_master.php?msg=100';</script>";	 

}

}
if(isset($_GET['cd']))

{ 

    $sql="delete from dir_state_master where state_id='".$_GET['cd']."'";



    $pro_gall_delete=mysqli_query($config,$sql);
    if($pro_gall_delete == true)
 {
	echo "<script>window.location.href='../dir_state_master.php?msg=100';</script>";	 

}
}


if(isset($_POST['exsubmit']))

{ 

    $file = $_FILES["excel"]["tmp_name"];
    $file_open = fopen($file,"r");
$csv = fgetcsv($file_open,1000,",");


$file = fopen($file, "r");
while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
{
 
    $sql = "INSERT INTO dir_state_master (name)

    VALUES ('".$emapData[0]."')";

   mysqli_query($config,$sql);
}

echo "<script>window.location.href='../dir_state_master.php?msg=100';</script>";	 




}
