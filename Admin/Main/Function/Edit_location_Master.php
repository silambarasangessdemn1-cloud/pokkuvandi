<?php include('../../config/setup.php');?>
<?php
 if(isset($_POST['city_edit']))
 { 
$editon=date('Y-m-d');
$update_offer=mysqli_query($config,"update city_master set CIty_Status='".$_POST['location_status']."',City_Name='".$_POST['Location_Name']."' where City_id='".$_POST['Location_id']."'");
 if($update_offer==false)
{
echo "<script>window.location.href='../Location_Master.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../Location_Master.php?msg=100';</script>";	 

	
}

 }

?>
 