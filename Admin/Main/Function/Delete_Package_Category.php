<?php include('../../config/setup.php');?>
<?php
if($_GET['delid'])
{
	$main_id=$_REQUEST['main_id'];
//  echo $query="delete from category_package where package_id ='".$_GET['delid']."'";
// die;
$sub_cat_delete=mysqli_query($config,"delete from category_package where package_id ='".$_GET['delid']."'");

// echo $query="select * from category_package WHERE package_id ='".$_GET['delid']."'";
// die;

$main_cate=mysqli_query($config,"select * from category_package WHERE package_id ='".$_GET['delid']."' ");
$macate=mysqli_fetch_object($main_cate);

 if($sub_cat_delete==false)
{
echo "<script>window.location.href='../category_package.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../category_package.php?delmsg=101&id=$main_id'</script>";	 

	
}


}


