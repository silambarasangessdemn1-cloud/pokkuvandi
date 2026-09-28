<?php include('config/setup.php');?>



<?php 
date_default_timezone_set("Asia/Kolkata");
date_default_timezone_get();
$created_at_time= date( 'd-m-Y h:i a', time ());

 $sql = "INSERT INTO dir_bussness (e_name,e_email,e_phone,e_msg,e_area,e_vender_key,vid,created_at_time)

VALUES ('".$_POST['name']."','".$_POST['email']."','".$_POST['phone']."','".$_POST['msg']."','".$_POST['areaid']."','".$_POST['keyid']."','".$_POST['vid']."','$created_at_time')";

mysqli_query($config,$sql);
$field_name	= $_POST['name'];

$field_email  = $_POST['email'];

$send_email = $_POST['send_email'];

$field_message	= $_POST['msg'];

$field_phone = $_POST['phone'];





$subject = 'Enquiry '.$field_name;



// $body_message = 'From: '.$field_name." ";

// $body_message .= 'E-mail: '.$field_email." ";

// $body_message .= 'Phone: '.$field_phone." ";


// $body_message .= 'Message: '.$field_message;




include "dir_com_mail.php";



$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 

$headers .= 'From: '.$field_email."\r\n".
    'Reply-To: '.$field_email."\r\n" .
    'X-Mailer: PHP/' . phpversion();
             


$mail_status = mail($send_email,$subject,$txt, $headers);


echo '1';


?>