<?php include('../../config/setup.php');?>
<?php
if($_GET['delcat']==300)
{
 

$sub_cat_delete=mysqli_query($config,"delete from customer_pokkuvandi_entry  where cus_pokkuvandi_entry_id='".$_GET['delcateid']."'");
 if($sub_cat_delete==false)
{
echo "<script>window.location.href='../customer_pokkuvadi_edit.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../customer_pokkuvadi_edit.php?delmsg=101';</script>";	 

	
}


}


