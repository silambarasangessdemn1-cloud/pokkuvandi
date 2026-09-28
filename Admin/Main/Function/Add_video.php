<?php include('../../config/setup.php');?>
<?php

if(isset($_POST['category_add']))
{
	$subimage=$_FILES['Add_main_cate_shopsetting']['name'];
	$subcatephoto="../../../photos/psbanner/".$subimage;
	move_uploaded_file($_FILES["Add_main_cate_shopsetting"]["tmp_name"],$subcatephoto);
$maincate=date('Y-m-d');
$addmaincate=mysqli_query($config,"insert into video(Main_Category_Name,Main_Category_Status,Main_Category_Add_on,Shop_setting,video_name)
                                 values('".$_POST['Add_main_cate_name']."','".$_POST['Add_main_category_status']."','$maincate','$subimage','".$_POST['video_name']."')");	
if($addmaincate==false)
{
 	
 	 echo "<script>window.location.href='../video_youtube.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../video_youtube.php?msg=505';</script>";	 

	
}	







}
?>




