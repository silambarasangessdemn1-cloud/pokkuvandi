<?php include('../../config/setup.php');?>
<?php
 if(isset($_POST['Sub_category_content_edit']))
 { 
$editon=date('Y-m-d');
$update_main_cate=mysqli_query($config,"update sub_category set Main_Category='".$_POST['main_category']."',Sub_Category_Name='".$_POST['Edit_sub_cate_name']."',Sub_Category_Status='".$_POST['subcate_status']."',Sub_Category_Add_on='$editon' where Sub_Category_id='".$_POST['main_cate_id']."'");
 if($update_main_cate==false)
{
echo mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../sub_category_Master.php?msg=100';</script>";	 

	
}

 }

?>
<?php
 if(isset($_POST['main_category_image_change']))
 {


	 $up_main_cate=mysqli_query($config,"select Sub_Category_image from sub_category where Sub_Category_id='".$_POST['sub_image_cate_id']."'");
$up_cate=mysqli_fetch_array($up_main_cate);
unlink($up_cate[0]);
// $timezone = new DateTimeZone("Asia/Kolkata" );
// $date = new DateTime();
// $date->setTimezone($timezone );
// $today2=$date->format('s');	
$subimage=$_FILES['sub_cate_image']['name'];
$subcatephoto="../../../photos/Sub_Category/".$subimage;
move_uploaded_file($_FILES["sub_cate_image"]["tmp_name"],$subcatephoto);
$imageediton=date('Y-m-d'); 
$update_service_photo=mysqli_query($config,"update sub_category set Sub_Category_image='$subcatephoto',Sub_Category_Add_on='$imageediton' where Sub_Category_id='".$_POST['sub_image_cate_id']."'");
 if($update_service_photo==false)
{
echo "<script>window.location.href='../sub_category_Master.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../sub_category_Master.php?msg=100';</script>";	 

	
}

 }

?>
