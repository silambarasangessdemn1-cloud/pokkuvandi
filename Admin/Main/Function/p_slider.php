<?php include('../../config/setup.php');?>
<?php
 if(isset($_POST['submit']))
 { 
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];    
         $folder = "../../../App/img/promo_slider/".$filename;
        move_uploaded_file($tempname, $folder);

    $sql = "INSERT INTO promote_slider (image)
    VALUES ('$filename')";

$update_app_Name=mysqli_query($config,$sql);
 if($update_app_Name==false)
{
echo "<script>window.location.href='../promo_slider.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../promo_slider.php?msg=100';</script>";	 

	
}
}


if($_GET['delpormid'])
{
 
 $sql="delete from promote_slider where id='".$_GET['delpormid']."'";

$pro_gall_delete=mysqli_query($config,$sql);
 if($pro_gall_delete==false)
{
echo "<script>window.location.href='../promo_slider.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../promo_slider.php?delmsg=101';</script>";	 

	
}


}

if(isset($_POST['s_name']))
{

    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];    
         $folder = "../../../App/img/promo_slider/".$filename;
         move_uploaded_file($tempname, $folder);

    $sql = "UPDATE promote_slider SET Image='$filename'  WHERE id='".$_POST['e_id']."'";

    $pro_gall_delete=mysqli_query($config,$sql);
    if($pro_gall_delete==false)
   {
   echo "<script>window.location.href='../promo_slider.php?erro=0';</script>".mysqli_error();	 
   }
   else{
       
       echo "<script>window.location.href='../promo_slider.php?delmsg=101';</script>";	 
   
       
   }
}
?>