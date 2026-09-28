<?php include('../../config/setup.php');?>

<?php
if(isset($_POST['product_image_add']))
{
$a=count($_POST['Add_pro_img_id']);
$b=count($_FILES['upload_images']['name']);
 
 for($aa=0;$aa < $a; $aa++)
 {
  foreach($_FILES['upload_images']['name'] as $key=>$val){  
 
     
$addsugcatephoto=$_FILES['upload_images']['name'][$key];
$addsubphoto="../../../photos/Product/".$addsugcatephoto;
move_uploaded_file($_FILES["upload_images"]["tmp_name"][$key],$addsubphoto);
  
 
		$insert_sql =mysqli_query($config,"INSERT INTO product_image_master(Product_image,Product_id,Product_image_status) 
			VALUES('".$addsubphoto."','".$_POST['Add_pro_img_id'][$aa]."',1)");
	if($insert_sql ==false)
{
echo "<script>window.location.href='../product_image_master.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../product_image_master.php?delmsg=101';</script>";	 

	
} 




 }
 }


 }
?>
