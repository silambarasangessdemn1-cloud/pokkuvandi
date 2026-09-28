<?php include('../../config/setup.php');?>
<?php
if($_GET['delcat']==100)
{
 

$sub_cat_delete=mysqli_query($config,"delete from customer_master where Customer_Id='".$_GET['delcuteid']."'");
 if($sub_cat_delete==false)
{
echo "<script>window.location.href='../Customer_Master.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../Customer_Master.php?delmsg=101';</script>";	 

	
}


}


