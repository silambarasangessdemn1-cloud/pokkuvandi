<?php include('../../config/setup.php');?>
<?php
 if(isset($_POST['customer_add']))
 { 
$editon=date('Y-m-d');

// echo $query="insert into customer_master(Customer_Name,Customer_Fathername,Customer_DOB,Customer_Address,Add_city,Add_area,Customer_Phone_No,Customer_Mail_id,Customer_Password,customer_active_status,Customer_Registred_on)
// values('".$_POST['customer_name']."','".$_POST['father_name']."','".$_POST['dob']."','".$_POST['address']."','".$_POST['Add_city']."','".$_POST['Add_area']."','".$_POST['phone_no']."','".$_POST['mail_id']."','".$_POST['password']."','".$_POST['customer_active_status']."','$editon')";
// die;
$update_custom=mysqli_query($config,"insert into customer_master(Customer_Name,Customer_Fathername,Customer_DOB,Customer_Address,Add_city,Add_area,Customer_Phone_No,Customer_Mail_id,Customer_Password,customer_active_status,Customer_Registred_on)
                                 values('".$_POST['customer_name']."','".$_POST['father_name']."','".$_POST['dob']."','".$_POST['address']."','".$_POST['Add_city']."','".$_POST['Add_area']."','".$_POST['phone_no']."','".$_POST['mail_id']."','".$_POST['password']."','".$_POST['customer_active_status']."','$editon')");	



//$update_custom=mysqli_query($config,"update customer_master set  Customer_Active_Status='".$_POST['customer_active_status']."',Customer_Registred_on='$editon' where Customer_Id='".$_POST['custom_id']."'");
 if($update_custom==false)
{
echo "<script>window.location.href='../Customer_Master.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='../Customer_Master.php?msg=100';</script>";	 

	
}

 }

?>
 c