<?php include('../../config/setup.php');?>
<?php
 if(isset($_POST['landing_name_edit']))
 { 
 
$update_app_Name=mysqli_query($config,"update  landing_page set Landing_Bold='".$_POST['Edit_landing_bold_name']."',Landing_text='".$_POST['Edit_landing_name']."' where Landing_id='".$_POST['Edit_landing_id']."'");
 if($update_app_Name==false)
{
echo "<script>window.location.href='../landing_master.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../landing_master.php?msg=100';</script>";	 

	
}

 }

?>