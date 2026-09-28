<?php include('../../config/setup.php');?>
<?php
 if(isset($_POST['intro_name_edit']))
 { 
 
$update_app_Name=mysqli_query($config,"update  intro_master set Intro_Content='".$_POST['Edit_intro_name']."' where intro_id='".$_POST['Edit_intro_id']."'");
 if($update_app_Name==false)
{
echo "<script>window.location.href='../intro_master.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../intro_master.php?msg=100';</script>";	 

	
}

 }

?>
<?php
 if(isset($_POST['logo_Scanning_image_change']))
 {
 
// $timezone = new DateTimeZone("Asia/Kolkata" );
// $date = new DateTime();
// $date->setTimezone($timezone );
// $today2=$date->format('s');	
$logoimage=$_FILES['Lee_Scanning_image']['name'];
$logophoto="../../../photos/Intro/".$logoimage;
move_uploaded_file($_FILES["Lee_Scanning_image"]["tmp_name"],$logophoto);
$imageediton=date('Y-m-d'); 
$update_service_photo=mysqli_query($config,"update intro_master set Intro_Image='$logophoto' where intro_id='".$_POST['Scanning_logo_id']."'");
 if($update_service_photo==false)
{
echo "<script>window.location.href='../intro_master.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../intro_master.php?msg=100';</script>";	 

	
}

 }

?><?php
 if(isset($_POST['Intro_logo_image_change']))
 {
 
// $timezone = new DateTimeZone("Asia/Kolkata" );
// $date = new DateTime();
// $date->setTimezone($timezone );
// $today2=$date->format('s');	
$logoimage=$_FILES['Intro_logo_image']['name'];
$logophoto="../../../photos/Intro/".$logoimage;
move_uploaded_file($_FILES["Intro_logo_image"]["tmp_name"],$logophoto);
$imageediton=date('Y-m-d'); 
$update_service_photo=mysqli_query($config,"update intro_master set Intro_Logo='$logophoto' where intro_id='".$_POST['lee_intro_logo_id']."'");
 if($update_service_photo==false)
{
echo "<script>window.location.href='../intro_master.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../intro_master.php?msg=100';</script>";	 

	
}

 }

?>
