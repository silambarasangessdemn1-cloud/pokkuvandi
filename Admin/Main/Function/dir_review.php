<?php include('../../config/setup.php');?>

<?php
if(isset($_POST['status']))

{ 
$sql = "UPDATE dir_review SET r_status='".$_POST['status']."'  WHERE dir_review_id='".$_POST['id']."'";
$update_app_Name=mysqli_query($config,$sql);
if($update_app_Name == true)
 {
	echo "<script>window.location.href='../bussness_review.php?msg=100';</script>";	 

}

}
if(isset($_GET['id']))

{ 

    $sql="delete from dir_review where dir_review_id='".$_GET['id']."'";



    $pro_gall_delete=mysqli_query($config,$sql);

	echo "<script>window.location.href='../bussness_review.php?msg=100';</script>";	 


}

if(isset($_POST['edite']))

{ 
 $sql = "UPDATE dir_com_enq SET stat='".$_POST['estatus']."'  WHERE dir_com_id='".$_POST['id']."'";
$update_app_Name=mysqli_query($config,$sql);

	echo "<script>window.location.href='../dir_bussness_enq.php?msg=100';</script>";	 



}

if(isset($_GET['eid']))

{ 

    $sql="delete from dir_com_enq where dir_com_id='".$_GET['eid']."'";



    $pro_gall_delete=mysqli_query($config,$sql);

	echo "<script>window.location.href='../dir_bussness_enq.php?msg=100';</script>";	 


}
if(isset($_GET['dirid']))

{ 

    $sql="delete from dir_bussness where vid='".$_GET['dirid']."'";



    $pro_gall_delete=mysqli_query($config,$sql);

	echo "<script>window.location.href='../Direct_bussness_enq.php?msg=100';</script>";	 


}
if(isset($_GET['eid1']))

{ 

    $sql="delete from dir_bussness where dir_bu_id='".$_GET['eid1']."'";



    $pro_gall_delete=mysqli_query($config,$sql);
$eid=$_GET['eidv'];
header("location:../direct_bussness_list.php?eid=$eid");
die;
	echo "<script>window.location.href='../direct_bussness_list.php?msg=100';</script>";	 


}
if(isset($_POST['edite1']))

{ 
 $sql = "UPDATE dir_bussness SET e_status='".$_POST['estatus']."'  WHERE dir_bu_id='".$_POST['id']."'";
$update_app_Name=mysqli_query($config,$sql);

$eid=$_POST['eid'];
header("location:../direct_bussness_list.php?eid=$eid");
die;

	echo "<script>window.location.href='../direct_bussness_list.php?msg=100';</script>";	 



}
