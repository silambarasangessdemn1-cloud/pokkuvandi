<?php include('../../config/setup.php');?>
<?php
if($_GET['delcat']==100)
{
 $del_main_cate=mysqli_query($config,"select Main_Category_image from video where Main_Category_id='".$_GET['delcateid']."'");
$del_cate=mysqli_fetch_array($del_main_cate);
unlink($del_cate[0]);

$main_cate_delete=mysqli_query($config,"delete from video where Main_Category_id='".$_GET['delcateid']."'");
 if($main_cate_delete==false)
{
echo "<script>window.location.href='../video_youtube.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../video_youtube.php?delmsg=101';</script>";	 

	
}


}


