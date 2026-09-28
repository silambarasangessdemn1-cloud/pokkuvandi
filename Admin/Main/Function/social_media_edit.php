<?php include('../../config/setup.php');?>
<?php
 if(isset($_POST['Lee_social_edit']))
 { 
 
$update_social=mysqli_query($config,"update lee_master set Facebook_link='".$_POST['Edit_social_facebook']."',Youtube_link='".$_POST['Edit_social_youtube']."',Instagram_link='".$_POST['Edit_social_instagram']."',Twitter_link='".$_POST['Edit_social_Twitter']."',Enable_Status='".$_POST['lee_socialmedia_status']."' where Site_id='".$_POST['Edit_lee__social_id']."'");
 if($update_social==false)
{
echo "<script>window.location.href='../social_media_master.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../social_media_master.php?msg=100';</script>";	 

	
}

 }

?>
 