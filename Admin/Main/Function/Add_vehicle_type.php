<?php include('../../config/setup.php');?>
<?php

if(isset($_POST['vehicle_type_add']))
{
// $timezone = new DateTimeZone("Asia/Kolkata" );
// $date = new DateTime();
// $date->setTimezone($timezone );
// $today2=$date->format('s');	
$maincate=date('Y-m-d');

$addsubcate=mysqli_query($config,"insert into vehicle_type(Vehicle_type_name,sub_category_id,status,create_on)
                                 values('".$_POST['vehicle_type_name']."','".$_POST['Add_sub_cate_Name']."','".$_POST['status']."','$maincate')");	
if($addsubcate==false)
{
 	
 	 echo "<script>window.location.href='../vehicle_type.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../vehicle_type.php?msg=505';</script>";	 

	
}	







}
?>




