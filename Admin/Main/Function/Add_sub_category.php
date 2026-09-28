<?php include('../../config/setup.php');?>
<?php

if(isset($_POST['sub_category_add']))
{
// $timezone = new DateTimeZone("Asia/Kolkata" );
// $date = new DateTime();
// $date->setTimezone($timezone );
// $today2=$date->format('s');	
$maincate=date('Y-m-d');
$addsugcatephoto=$_FILES['Add_sub_cate_image']['name'];
$addsubphoto="../../../photos/Category/".$addsugcatephoto;
move_uploaded_file($_FILES["Add_sub_cate_image"]["tmp_name"],$addsubphoto);

$addsubcate=mysqli_query($config,"insert into sub_category(Main_Category,Sub_Category_Name,Sub_Category_image,Sub_Category_Status,Sub_Category_Add_on)
                                 values('".$_POST['Add_sub_main_cate_Name']."','".$_POST['Add_sub_cate_name']."','$addsubphoto','".$_POST['Add_sub_category_status']."','$maincate')");	
if($addsubcate==false)
{
 	
 	 echo "<script>window.location.href='../sub_category_Master.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../sub_category_Master.php?msg=505';</script>";	 

	
}	







}
?>




