<?php include('../../config/setup.php');?>
<?php
 if(isset($_POST['Lee_contact_edit']))
 { 
 
$update_contact=mysqli_query($config,"update lee_master set Location='".$_POST['Edit_lee_location']."',Address='".$_POST['Edit_lee_address']."',Contact_Number='".$_POST['Edit_lee_contact']."',Email_id='".$_POST['Edit_lee_mail']."',Contact_Status='".$_POST['lee_contact_status']."',Tel_No='".$_POST['Edit_lee_tel_contact']."',GST_No= '".$_POST['Edit_lee_Gst']."', website='".$_POST['Edit_lee_web']."' where Site_id='".$_POST['Edit_lee__contact_id']."'");
 if($update_contact==false)
{
echo "<script>window.location.href='../contact_master.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../contact_master.php?msg=100';</script>";	 

	
}

 }

?>
 