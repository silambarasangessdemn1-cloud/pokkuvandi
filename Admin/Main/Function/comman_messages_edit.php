<?php include('../../config/setup.php');?>
<?php
 if(isset($_POST['category_content_edit']))
 { 


// echo "update comman_messages set comman_messages='".$_POST['comman_messages']."',type='".$_POST['type']."',status='".$_POST['active']."' where message_id='".$_POST['message_id']."' ";
// die;
	$update_main_cate=mysqli_query($config,"update comman_messages set comman_messages='".$_POST['comman_messages']."',type='".$_POST['type']."',status='".$_POST['active']."' where message_id='".$_POST['message_id']."'");

if($update_main_cate==false)
{
echo "<script>window.location.href='../common_messages.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../common_messages.php?msg=100';</script>";	 

	
}
 }

?>
