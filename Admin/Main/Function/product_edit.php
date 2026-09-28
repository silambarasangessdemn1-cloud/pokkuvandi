<?php include('../../config/setup.php');?>
<?php
 if(isset($_POST['product_gall_edit']))
 { 
$editon=date('Y-m-d');
$update_pro_gall=mysqli_query($config,"update product_image_master set Product_image_status='".$_POST['pro_gall_status']."',Product_id='".$_POST['Edit_pro_img_name']."' where product_image_id='".$_POST['Edit_pro_gall_id']."'");
  if($update_pro_gall==false)
{
echo "<script>window.location.href='../product_image_master.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../product_image_master.php?msg=100';</script>";	 

	
}

 }

?>
 
<?php
 if(isset($_POST['main_category_image_change']))
 {
	 $up_main_cate=mysqli_query($config,"select Product_image from product_image_master where product_image_id='".$_POST['sub_image_cate_id']."'");
$up_cate=mysqli_fetch_array($up_main_cate);
unlink($up_cate[0]);
// $timezone = new DateTimeZone("Asia/Kolkata" );
// $date = new DateTime();
// $date->setTimezone($timezone );
// $today2=$date->format('s');	
$subimage=$_FILES['sub_cate_image']['name'];
$subcatephoto="../../../photos/Product/".$subimage;
move_uploaded_file($_FILES["sub_cate_image"]["tmp_name"],$subcatephoto);
$imageediton=date('Y-m-d'); 
$update_service_photo=mysqli_query($config,"update product_image_master set Product_image='$subcatephoto' where product_image_id='".$_POST['sub_image_cate_id']."'");
 if($update_service_photo==false)
{
echo "<script>window.location.href='../product_image_master.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../product_image_master.php?msg=100';</script>";	 

	
}

 }

?>