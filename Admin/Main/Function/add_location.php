<?php include('../../config/setup.php');?>
<?php

if(isset($_POST['add_new_location']))
{
 
 
$addlocation=mysqli_query($config,"insert into city_master(City_Name,CIty_Status) values('".$_POST['Add_location_name']."','".$_POST['Add_location_status']."')");	
if($addlocation==false)
{
 	
 	 echo "<script>window.location.href='../Location_Master.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../Location_Master.php?msg=505';</script>";	 

	
}	







}
?>
