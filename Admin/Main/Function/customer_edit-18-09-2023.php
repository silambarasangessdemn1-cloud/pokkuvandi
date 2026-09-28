<?php include('../../config/setup.php');?>


<?php
 if(isset($_POST['customer_alter']))
 { 


	 echo $_POST['Add_area_new'];

	// echo("sdffds");
$editon=date('Y-m-d');
// echo $query="update customer_master set  Customer_Active_Status='".$_POST['customer_active_status']."',Customer_Registred_on='$editon' , Customer_Name ='".$_POST['customer_name']."' , Customer_Fathername ='".$_POST['father_name']."',Customer_DOB='".$_POST['dob']."',Customer_Address='".$_POST['address']."',Add_city='".$_POST['Add_city']."', Add_area='".$_POST['Add_area_new']."', Customer_Phone_No='".$_POST['phone_no']."', Customer_Mail_id='".$_POST['mail_id']."' where Customer_Id='".$_POST['custom_id']."'";
// die;
$update_custom=mysqli_query($config,"update customer_master set  Customer_Active_Status='".$_POST['customer_active_status']."',Customer_Registred_on='$editon' , Customer_Name ='".$_POST['customer_name']."' , Customer_Fathername ='".$_POST['father_name']."',Customer_DOB='".$_POST['dob']."',Customer_Address='".$_POST['address']."',Add_city='".$_POST['Add_city']."', Add_area='".$_POST['Add_area_new']."', Customer_Phone_No='".$_POST['phone_no']."', Customer_Mail_id='".$_POST['mail_id']."' where Customer_Id='".$_POST['custom_id']."'");
 if($update_custom==false)
{
echo "<script>window.location.href='../Customer_Master.php?erro=0';</script>";	 
}
else{
	
	echo "<script>window.location.href='../Customer_Master.php?msg=100';</script>";	 

	
}

 }

?>
 