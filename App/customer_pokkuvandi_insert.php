<?php  include('config/setup.php');;?>
<?php
session_start();

 if(isset($_POST['customer_add']))
 { 
    if (isset($_POST['form_token']) && isset($_SESSION['form_token']) && $_POST['form_token'] === $_SESSION['form_token']) {
       

        // Token is valid, process the form submission
        unset($_SESSION['form_token']); // Unset the token to prevent reuse

    $current_Date=date('Y-m-d'); 
$editon=$_POST['loader_from_date'];

$days_to_add = 2;
$new_date = date("Y-m-d", strtotime($editon . " +$days_to_add days"));
 $new_date; // Outputs: 2023-12-12



// echo $query="insert into customer_master(Customer_Name,Customer_Fathername,Customer_DOB,Customer_Address,Add_city,Add_area,Customer_Phone_No,Customer_Mail_id,Customer_Password,customer_active_status,Customer_Registred_on)
// values('".$_POST['customer_name']."','".$_POST['father_name']."','".$_POST['dob']."','".$_POST['address']."','".$_POST['Add_city']."','".$_POST['Add_area']."','".$_POST['phone_no']."','".$_POST['mail_id']."','".$_POST['password']."','".$_POST['customer_active_status']."','$editon')";
// die;
$update_custom=mysqli_query($config,"insert into customer_pokkuvandi_entry(Customer_Name,Customer_Phone_No,from_date,place,vehicle_type,general_remarks,post_date,district,to_place,exp_date,from_district,to_district,state,cust_id,from_state_id,to_state_id,vehicle_type_cpe)
                                 values('".$_POST['name']."','".$_POST['customer_phone']."','".$_POST['loader_from_date']."','".$_POST['loader_from_place']."','".$_POST['vehicle_type']."','".$_POST['loader_remarks']."','$current_Date','".$_POST['Add_city']."','".$_POST['loader_to_place']."','$new_date','".$_POST['from_district']."','".$_POST['to_district']."','".$_POST['state_status']."','".$_POST['cust_id']."','".$_POST['from_state']."','".$_POST['to_state']."','".$_POST['vehicle_type_cpe']."')");	



//$update_custom=mysqli_query($config,"update customer_master set  Customer_Active_Status='".$_POST['customer_active_status']."',Customer_Registred_on='$editon' where Customer_Id='".$_POST['custom_id']."'");
 if($update_custom==false)
{
echo "<script>window.location.href='customer_pokkuvadi_entry.php?erro=0';</script>".mysqli_error();	 
}
else{
	
	echo "<script>window.location.href='customer_pokkuvadi_entry.php?msg=100';</script>";	 

	
}
    }else {
        // Token is invalid or missing, show an error message
        echo "<script>window.location.href='customer_pokkuvadi_entry.php?msg=100';</script>";	 
    }
    
 }

?>
