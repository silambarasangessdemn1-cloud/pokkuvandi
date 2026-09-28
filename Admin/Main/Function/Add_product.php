<?php include('../../config/setup.php');?>
<?php

if(isset($_POST['product_add']))
{
 
$subcate=date('Y-m-d');
$addmaincate=mysqli_query($config,"insert into product_master(Main_Category,Sub_Categoryid,Product_Name,Product_Avalible_Stocks,Product_offer,Product_description,Product_Active_Status,Product_add_on,product_tax,youtube)
                                 values('".$_POST['product_cate']."','".$_POST['product_sub_cate']."','".$_POST['Add_pro_name']."','".$_POST['Add_pro_stocks']."','".$_POST['Add_pro_offer']."','".$_POST['Add_pro_desc']."','".$_POST['Add_pro_status']."' ,'$subcate','".$_POST['Add_pro_tax']."','".$_POST['youtube']."')");	
if($addmaincate==false)
{
 	
 	 echo "<script>window.location.href='../product_master.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../product_master.php?msg=505';</script>";	 

	
}	







}
?>




