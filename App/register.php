<?php include('config/setup.php')?>
<?php include('session.php');?>	
<?php
//var_dump($_POST);
if(isset($_POST['lee_account_registration']))
{
    echo "leee";
    if($_POST['Lee_Customer_password']== $_POST['Lee_Customer_confirm_password'])
    {
   $check=mysqli_query($config,"select * from customer_master where Customer_Phone_No='".$_POST['Lee_Customer_phonenumber']."'");
   $regcheck= mysqli_num_rows($check);
    if(!$regcheck)
    {       

        if($_POST['Add_city'] == '0' OR $_POST['Add_city'] == '')
        {
            header('location:signup.php?error=3000');
        }
        else if($_POST['Add_area'] == '0' OR $_POST['Add_area'] == '')
        {
            header('location:signup.php?error=3000');
        }
        else
        {
            date_default_timezone_set('Asia/Kolkata');
            $regdate=date('Y-m-d h:i:sa');
            $log_actlog=$_POST['Lee_Customer_confirm_password'];
            $EncryptPassword = md5($log_actlog);
                $lee_regisration=mysqli_query($config,"insert into customer_master(Customer_Name,Customer_Fathername,Customer_DOB,Customer_Address,Customer_Phone_No,Customer_Mail_id,Customer_Registred_on,Customer_Active_Status,Customer_Password,referred_by,Add_city,Add_area,state_id) 
            values('".$_POST['Lee_Customer_Name']."','".$_POST['Lee_Customer_fatherName']."','".$_POST['Lee_Customer_DOB']."','".$_POST['Lee_Customer_address']."','".$_POST['Lee_Customer_phonenumber']."','".$_POST['Lee_Customer_email']."','$regdate',1,'$EncryptPassword','".$_POST['referred_by']."','".$_POST['Add_city']."','".$_POST['Add_area']."','".$_POST['state']."')");  
            
            
            $last_id = mysqli_insert_id($config);


            $log_act=$_POST['Lee_Customer_phonenumber'];   
             
            $result22=mysqli_query($config,"select * from customer_master where Customer_Phone_No='".$_POST['Lee_Customer_phonenumber']."' and Customer_Password ='$EncryptPassword'  ");	
            $user = mysqli_fetch_array($result22);
            if($user){
                     
                 $logg=$user["Customer_Active_Status"];
                 if($logg ==1)
                 {
                     
                     $_SESSION["member_id"] = $user["Customer_Id"];
                 }
                }

            
            header('location:account_verification.php?success=100');
        }
         

    }
else{
    
    echo "Error";
    
}

}else{
    
    
    header('location:signup.php?already=200&name='.$_POST['Lee_Customer_Name'].'&phonenumber='.$_POST['Lee_Customer_phonenumber'].'&fathername='.$_POST['Lee_Customer_fatherName'].'&DOB='.$_POST['Lee_Customer_DOB'].'&address='.$_POST['Lee_Customer_address'].'&email='.$_POST['Lee_Customer_email'].'&Add_city='.$_POST['Add_city'].'&Add_area='.$_POST['Add_area'].'&prefcode='.$_POST['referal_code']);
    
} 


}


	?>





