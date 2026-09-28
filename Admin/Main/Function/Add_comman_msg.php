<?php include('../../config/setup.php');?>
<?php

if(isset($_POST['category_add']))
{
$maincate=date('Y-m-d');

$addmaincate=mysqli_query($config,"insert into comman_messages(comman_messages,type,status)
                                 values('".$_POST['comman_messages_name']."','".$_POST['type']."','".$_POST['active']."')");	
if($addmaincate==false)
{
 	
 	 echo "<script>window.location.href='../common_messages.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../common_messages.php?msg=505';</script>";	 

	
}	







}
?>




