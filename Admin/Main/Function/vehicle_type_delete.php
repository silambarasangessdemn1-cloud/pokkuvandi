<?php include('../../config/setup.php');?>
<?php
if($_GET['delcat']==300)
{
 

$sub_cat_delete=mysqli_query($config,"delete from vehicle_type where Vehicle_type_id ='".$_GET['delcateid']."'");
 if($sub_cat_delete==false)
{
echo "<script>window.location.href='../vehicle_type.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../vehicle_type.php?delmsg=101';</script>";	 

	
}


}


