<?php include('../../config/setup.php');?>
<?php
 if(isset($_POST['submit']))
 { 
    $sql = "INSERT INTO promote_category (title)
    VALUES ('".$_POST['c_name']."')";

$update_app_Name=mysqli_query($config,$sql);
 if($update_app_Name==false)
{
echo "<script>window.location.href='../promo_cate.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../promo_cate.php?msg=100';</script>";	 

	
}
}


if($_GET['delpormid'])
{
 
 $sql="delete from promote_category where id='".$_GET['delpormid']."'";

$pro_gall_delete=mysqli_query($config,$sql);
 if($pro_gall_delete==false)
{
echo "<script>window.location.href='../promo_cate.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../promo_cate.php?delmsg=101';</script>";	 

	
}


}

if(isset($_POST['s_name']))
{

    $sql = "UPDATE promote_category SET title='".$_POST['e_name']."'  WHERE id='".$_POST['e_id']."'";

    $pro_gall_delete=mysqli_query($config,$sql);
    if($pro_gall_delete==false)
   {
   echo "<script>window.location.href='../promo_cate.php?erro=0';</script>".mysqli_error();	 
   }
   else{
       
       echo "<script>window.location.href='../promo_cate.php?delmsg=101';</script>";	 
   
       
   }
}
?>