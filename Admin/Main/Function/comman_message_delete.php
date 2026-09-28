<?php include('../../config/setup.php');?>
<?php
if($_GET['delcat']==100)
{


$main_cate_delete=mysqli_query($config,"delete from comman_messages where message_id='".$_GET['delcateid']."'");
 if($main_cate_delete==false)
{
echo "<script>window.location.href='../common_messages.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../common_messages.php?delmsg=101';</script>";	 

	
}


}


