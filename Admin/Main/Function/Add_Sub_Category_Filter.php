<?php include('../../config/setup.php');?>
<?php

if(isset($_POST['filter_add']))
{


$addmaincate=mysqli_query($config,"insert into sub_category_filter(name,status,Sub_Category_id)
                                 values('".$_POST['Add_filter_name']."','".$_POST['Add_filter_status']."','".$_POST['Add_sub_category']."')");	

                               
$id=$_POST['Add_sub_category'];

if($addmaincate==false)
{
 	
 	 echo "<script>window.location.href='../sub_category_Filter.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../sub_category_Filter.php?msg=505&id=$id';</script>";	 

	
}	







}





?>




