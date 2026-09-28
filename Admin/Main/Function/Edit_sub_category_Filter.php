<?php include('../../config/setup.php');?>
<?php

if(isset($_POST['edit_filter']))
{


// echo $query="update sub_category_filter set name='".$_POST['Edit_filter_name']."' ,status='".$_POST['Edit_status']."' WHERE filter_id='".$_POST['Edit_filter_id']."' " ;
// die;
$addmaincate=mysqli_query($config,"update sub_category_filter set name='".$_POST['Edit_filter_name']."' ,status='".$_POST['Edit_status']."' WHERE filter_id='".$_POST['Edit_filter_id']."' ");

$main_cate=mysqli_query($config,"select * from sub_category_filter WHERE filter_id='".$_POST['Edit_filter_id']."' ");
$macate=mysqli_fetch_object($main_cate);

if($addmaincate==false)
{ 
 	
 	 echo "<script>window.location.href='../sub_category_Filter.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../sub_category_Filter.php?msg=505&id=$macate->Sub_Category_id';</script>";	 

	
}	







}
?>