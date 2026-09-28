<?php include('../../config/setup.php');?>
<?php
if($_GET['delcat']==300)
{
 

$sub_cat_delete=mysqli_query($config,"delete from sub_category where Sub_Category_id='".$_GET['delcateid']."'");
 if($sub_cat_delete==false)
{
echo "<script>window.location.href='../sub_category_Master.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../sub_category_Master.php?delmsg=101';</script>";	 

	
}


}


