<?php include('../../config/setup.php');?>
<?php

if(isset($_POST['package_add']))
{
// $timezone = new DateTimeZone("Asia/Kolkata" );
// $date = new DateTime();
// $date->setTimezone($timezone );
// $today2=$date->format('s');	

$addmaincate=mysqli_query($config,"insert into category_package(package_title,package_valid,package_amount,Main_Category_id,status)
                                 values('".$_POST['package_title']."','".$_POST['package_valid']."','".$_POST['package_amount']."','".$_POST['Main_category']."','".$_POST['status']."')");	
                         
$id=$_POST['Main_category'];
if($addmaincate==false)
{
 	 
 	 echo "<script>window.location.href='../category_package.php?erro=0';</script>".mysqli_error();	 
}
else
{
		echo "<script>window.location.href='../category_package.php?msg=505&id=".$id."';</script>";	 

}	


}
?>




