<?php include('../../config/setup.php');?>
<?php
 if(isset($_POST['submit']))
 { 
   

    $sql = "INSERT INTO promote_video (category,video_title,video_desc,video)
    VALUES ('".$_POST['cate']."','".$_POST['title']."','".$_POST['desc']."','".$_POST['video']."')";

$update_app_Name=mysqli_query($config,$sql);
 if($update_app_Name==false)
{
echo "<script>window.location.href='../promo_video.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../promo_video.php?msg=100';</script>";	 

	
}
}


if($_GET['delpormid'])
{
 
 $sql="delete from promote_video where vid='".$_GET['delpormid']."'";

$pro_gall_delete=mysqli_query($config,$sql);
 if($pro_gall_delete==false)
{
echo "<script>window.location.href='../promo_video.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../promo_video.php?delmsg=101';</script>";	 

	
}


}

if(isset($_POST['s_name']))
{

    if($_POST['video'])
    {
        $sql = "UPDATE promote_video SET category='".$_POST['cate']."',video_title='".$_POST['title']."',video_desc='".$_POST['desc']."',video='".$_POST['video']."'  WHERE vid='".$_POST['id']."'";

    }else{
        $sql = "UPDATE promote_video SET category='".$_POST['cate']."',video_title='".$_POST['title']."',video_desc='".$_POST['desc']."'  WHERE vid='".$_POST['id']."'";

    }


    $pro_gall_delete=mysqli_query($config,$sql);
    if($pro_gall_delete==false)
   {
   echo "<script>window.location.href='../promo_video.php?erro=0';</script>".mysqli_error();	 
   }
   else{
       
       echo "<script>window.location.href='../promo_video.php?delmsg=101';</script>";	 
   
       
   }
}
?>