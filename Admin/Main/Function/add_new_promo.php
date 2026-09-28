<?php include('../../config/setup.php');?>
<?php

if(isset($_POST['promo_product_add']))
{
// $timezone = new DateTimeZone("Asia/Kolkata" );
// $date = new DateTime();
// $date->setTimezone($timezone );
// $today2=$date->format('s');	
$addcatephoto=$_FILES['Add_promo_banner']['name'];
$addphoto="../../../photos/promos/".$addcatephoto;
move_uploaded_file($_FILES["Add_promo_banner"]["tmp_name"],$addphoto);
$maincate=date('Y-m-d');

$pro_sel=mysqli_query($config," select * from product_master where Product_id='".$_POST['Add_offer_pro_name']."'");
		$ps=mysqli_fetch_object($pro_sel);


$addmaincate=mysqli_query($config,"insert into promo_code_master(Product_id,Offer_Main_Category,Offer_sub_category,Promo_code,Offer_Percent,Promo_code_valid_upto,Offer_Highlights,Terms_and_Conditions,Offer_Poster,Promo_code_Active_Status,Bg_color,Promo_code_addon)
                                 values('".$_POST['Add_offer_pro_name']."','".$ps->Main_Category."','".$ps->Sub_Categoryid."','".$_POST['Add_promo_code']."','".$_POST['Add_offer_percent']."','".$_POST['Add_offer_valid_upto']."','".$_POST['Add_offer_Highlights']."','".$_POST['Add_offer_tc']."','$addphoto','".$_POST['Add_offer_status']."','".$_POST['Add_promo_bground']."','$maincate')");	
if($addmaincate==false)
{
 	
 	 echo "<script>window.location.href='../promo_code_master.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../promo_code_master.php?msg=505';</script>";	 

	
}	







}
?>




