<?php include('../../config/setup.php');?>
<?php

if(isset($_POST['package_edit']))
{

$addmaincate=mysqli_query($config,"update category_package SET package_title='".$_POST['Edit_package_title']."',package_valid='".$_POST['Edit_package_valid']."',package_amount='".$_POST['Edit_package_amount']."',status='".$_POST['Edit_status']."' WHERE package_id ='".$_POST['Edit_package_id']."' ");	                             
                             

// echo $query="select * from category_package WHERE package_id ='".$_POST['Edit_package_id']."' ";
// die;
$main_cate=mysqli_query($config,"select * from category_package WHERE package_id ='".$_POST['Edit_package_id']."' ");
$macate=mysqli_fetch_object($main_cate);


if($addmaincate==false)
{
 	 
 	 echo "<script>window.location.href='../category_package.php?erro=0';</script>".mysqli_error();	 
}
else
{
		echo "<script>window.location.href='../category_package.php?msg=505&id=$macate->Main_Category_id'</script>";	 

}	


}
?>




