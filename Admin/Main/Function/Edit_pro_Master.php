<?php include('../../config/setup.php');?>
<?php

 

 if(isset($_POST['product_edit']))
 { 
$editon=date('Y-m-d');
$youtube=$_POST['youtube'];
if($youtube)
{
$update_pro_=mysqli_query($config,"update product_master set Product_Name='".$_POST['Edit_pro_name']."', Main_Category ='".$_POST['Edit_pro_cate_name']."', Sub_Categoryid ='".$_POST['Edit_pro_sub_cate_name']."',Product_Price='".$_POST['Edit_pro_price']."',Product_Avalible_Stocks='".$_POST['Edit_pro_stock']."',Product_Avalible_in='".$_POST['Edit_Pro_Avalible_in']."',Product_offer='".$_POST['Edit_pro_cate_offer']."',Product_Active_Status='".$_POST['pro_status']."',Product_description='".$_POST['pro_desc']."',Product_Type='".$_POST['Edit_Pro_type']."',product_tax='".$_POST['edit_pro_tax']."',youtube='$youtube' where Product_id='".$_POST['Edit_pro_id']."'");

}
else{
$update_pro_=mysqli_query($config,"update product_master set Product_Name='".$_POST['Edit_pro_name']."', Main_Category ='".$_POST['Edit_pro_cate_name']."', Sub_Categoryid ='".$_POST['Edit_pro_sub_cate_name']."',Product_Price='".$_POST['Edit_pro_price']."',Product_Avalible_Stocks='".$_POST['Edit_pro_stock']."',Product_Avalible_in='".$_POST['Edit_Pro_Avalible_in']."',Product_offer='".$_POST['Edit_pro_cate_offer']."',Product_Active_Status='".$_POST['pro_status']."',Product_description='".$_POST['pro_desc']."',Product_Type='".$_POST['Edit_Pro_type']."',product_tax='".$_POST['edit_pro_tax']."' where Product_id='".$_POST['Edit_pro_id']."'");
}
 if($update_pro_==false)
{
echo "<script>window.location.href='../product_master.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../product_master.php?msg=100';</script>";	 

	
}

 }

?>
 
