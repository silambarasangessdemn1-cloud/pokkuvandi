<?php include('../../config/setup.php');?>
<?php
 if(isset($_POST['Lee_name_edit']))
 { 
 
$update_app_Name=mysqli_query($config,"update lee_master set Name='".$_POST['Edit_lee_name']."',Name_status='".$_POST['lee_name_status']."' where Site_id='".$_POST['Edit_lee_id']."'");
 if($update_app_Name==false)
{
echo "<script>window.location.href='../logo_name_Master.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../logo_name_Master.php?msg=100';</script>";	 

	
}

 }

?>
<?php
 if(isset($_POST['logo_image_change']))
 {
 
// $timezone = new DateTimeZone("Asia/Kolkata" );
// $date = new DateTime();
// $date->setTimezone($timezone );
// $today2=$date->format('s');	
$logoimage=$_FILES['Lee_logo']['name'];
$logophoto="../../../photos/logo/".$logoimage;
move_uploaded_file($_FILES["Lee_logo"]["tmp_name"],$logophoto);
$imageediton=date('Y-m-d'); 
$update_service_photo=mysqli_query($config,"update lee_master set Logo_Path='$logophoto',logo_status='".$_POST['leelogostatus']."' where Site_id='".$_POST['lee_logo_id']."'");
 if($update_service_photo==false)
{
echo "<script>window.location.href='../logo_name_Master.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../logo_name_Master.php?msg=100';</script>";	 

	
}

 }

?>
