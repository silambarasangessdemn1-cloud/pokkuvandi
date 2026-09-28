<?php include('../../config/setup.php');?>
<?php
if($_GET['delcat']==100)
{
 

$sub_cat_delete=mysqli_query($config,"delete from shop_enq where shop_enq_id='".$_GET['delcuteid']."'");
 if($sub_cat_delete==false)
{
echo "<script>window.location.href='../shop_req.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../shop_req.php?delmsg=101';</script>";	 

	
}


}


