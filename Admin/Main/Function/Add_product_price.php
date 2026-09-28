<?php include('../../config/setup.php');?>
<?php

if(isset($_POST['product_price_add']))
{
 
 $offer_per = (100 * ($_POST['Add_pro_price'] - $_POST['Add_pro_shelling_price']) / $_POST['Add_pro_price'] );
$maincate=date('Y-m-d');
$addprotype=mysqli_query($config,"insert into product_price_master(Product_id,Product_type,Product_Type_number,Product_price,Product_status,Product_price_Add_on,Shelling_price,Offer_Percent)
                                 values('".$_POST['Add_pro_name']."','".$_POST['Add_pro_type']."','".$_POST['Add_pro_type_quant']."','".$_POST['Add_pro_price']."','".$_POST['Add_product_price_status']."','$maincate','".$_POST['Add_pro_shelling_price']."','$offer_per')");	
if($addprotype==false)
{
 	
 	 echo "<script>window.location.href='../Product_price_Master.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../Product_price_Master.php?msg=505';</script>";	 

	
}	







}
?>
