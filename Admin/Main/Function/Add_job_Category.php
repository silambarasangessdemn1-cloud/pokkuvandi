<?php include('../../config/setup.php');?>
<?php

if(isset($_POST['category_add']))
{
// $timezone = new DateTimeZone("Asia/Kolkata" );
// $date = new DateTime();
// $date->setTimezone($timezone );
// $today2=$date->format('s');	
$addcatephoto=$_FILES['Add_main_cate_image']['name'];
$addphoto="../../../photos/Category/".$addcatephoto;
move_uploaded_file($_FILES["Add_main_cate_image"]["tmp_name"],$addphoto);
$maincate=date('Y-m-d');
$addmaincate=mysqli_query($config,"insert into job_search_category(Main_Category_Name,Main_Category_Status,Main_Category_image,Main_Category_Add_on,Shop_setting,amount)
                                 values('".$_POST['Add_main_cate_name']."','".$_POST['Add_main_category_status']."','$addphoto','$maincate','".$_POST['Add_main_cate_shopsetting']."','".$_POST['amount']."')");	
if($addmaincate==false)
{
 	
 	 echo "<script>window.location.href='../job_search_category.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../job_search_category.php?msg=505';</script>";	 

	
}	







}
?>




