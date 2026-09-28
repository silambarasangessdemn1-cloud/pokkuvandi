<?php include('../../config/setup.php');?>
<?php
 if(isset($_POST['category_content_edit']))
 { 
$editon=date('Y-m-d');

$subimage=$_FILES['Add_main_cate_shopsetting']['name'];
if($subimage){
$subcatephoto="../../../photos/psbanner/".$subimage;
move_uploaded_file($_FILES["Add_main_cate_shopsetting"]["tmp_name"],$subcatephoto);
$update_main_cate=mysqli_query($config,"update video set Main_Category_Name='".$_POST['main_cate_name']."',Main_Category_Status='".$_POST['main_category_status']."',Main_Category_Add_on='$editon',Shop_setting='$subimage',video_name='".$_POST['video_name']."' where Main_Category_id='".$_POST['main_cate_id']."' ");
}else{
	$update_main_cate=mysqli_query($config,"update video set Main_Category_Name='".$_POST['main_cate_name']."',Main_Category_Status='".$_POST['main_category_status']."',Main_Category_Add_on='$editon',video_name='".$_POST['video_name']."' where Main_Category_id='".$_POST['main_cate_id']."'");
} 
if($update_main_cate==false)
{
echo "<script>window.location.href='../video_youtube.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../video_youtube.php?msg=100';</script>";	 

	
}

 }

?>
