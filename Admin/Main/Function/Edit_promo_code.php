<?php include('../../config/setup.php');?>
<?php
 if(isset($_POST['promo_code_edit']))
 { 
$editon=date('Y-m-d');
$update_offer=mysqli_query($config,"update promo_code_master set Promo_code='".$_POST['Edit_Promocode']."',Offer_Percent='".$_POST['Edit_promo_percent']."',Promo_code_valid_upto='".$_POST['Edit_promo_validity']."',Offer_Highlights='".$_POST['Edit_offer_Highlights']."',Terms_and_Conditions='".$_POST['Edit_offer_tc']."',Promo_code_Active_Status='".$_POST['Edit_promo_status']."' where Promo_id='".$_POST['offer_pro_id']."'");
 if($update_offer==false)
{
echo "<script>window.location.href='../promo_code_master.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../promo_code_master.php?msg=100';</script>";	 

	
}

 }

?>
 <?php

if(isset($_POST['main_category_image_change']))
{
// $timezone = new DateTimeZone("Asia/Kolkata" );
// $date = new DateTime();
// $date->setTimezone($timezone );
// $today2=$date->format('s');	
$addsugcatephoto=$_FILES['promo_image']['name'];
$addsubphoto="../../../photos/promos/".$addsugcatephoto;
move_uploaded_file($_FILES["promo_image"]["tmp_name"],$addsubphoto);
$maincate=date('Y-m-d');
$addsubcate=mysqli_query($config,"update promo_code_master set Offer_Poster='".$addsubphoto."' where Promo_id='".$_POST['sub_image_cate_id']."' ");	
 if($addsubcate==false)
{
echo "<script>window.location.href='../promo_code_master.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../promo_code_master.php?msg=100';</script>";	 

	
}







}
?>

