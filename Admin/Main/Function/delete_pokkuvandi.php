<?php include('../../config/setup.php');?>
<?php
if($_GET['delcat']==300)
{
 

$sub_cat_delete=mysqli_query($config,"delete from driver_pokkuvandi_entry  where driver_pokkuvandi_entry_id='".$_GET['delcateid']."'");
 if($sub_cat_delete==false)
{
echo "<script>window.location.href='../pokkuvandi_entry_edit.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../pokkuvandi_entry_edit.php?delmsg=101';</script>";	 

	
}


}


