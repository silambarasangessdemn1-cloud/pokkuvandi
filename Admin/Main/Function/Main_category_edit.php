<?php include('../../config/setup.php');?>
<?php
 if(isset($_POST['category_content_edit']))
 { 
$editon=date('Y-m-d');
$update_main_cate=mysqli_query($config,"update main_category set Main_Category_Name='".$_POST['main_cate_name']."',Main_Category_Status='".$_POST['main_category_status']."',Main_Category_Add_on='$editon' where Main_Category_id='".$_POST['main_cate_id']."'");
 if($update_main_cate==false)
{
echo "<script>window.location.href='../category_Master.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../category_Master.php?msg=100';</script>";	 

	
}

 }

?>
<?php
 if(isset($_POST['main_category_image_change']))
 {
	 $up_main_cate=mysqli_query($config,"select Main_Category_image from main_category where Main_Category_id='".$_POST['main_image_cate_id']."'");
$up_cate=mysqli_fetch_array($up_main_cate);
unlink($up_cate[0]);
// $timezone = new DateTimeZone("Asia/Kolkata" );
// $date = new DateTime();
// $date->setTimezone($timezone );
// $today2=$date->format('s');	
$categoryimage=$_FILES['Main_cate_image']['name'];
$catephoto="../../../photos/Category/".$categoryimage;
move_uploaded_file($_FILES["Main_cate_image"]["tmp_name"],$catephoto);
$imageediton=date('Y-m-d'); 
$update_service_photo=mysqli_query($config,"update main_category set Main_Category_image='$catephoto',Main_Category_Add_on='$imageediton' where Main_Category_id='".$_POST['main_image_cate_id']."'");
 if($update_service_photo==false)
{
echo "<script>window.location.href='../category_Master.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../category_Master.php?msg=100';</script>";	 

	
}

 }

?>
