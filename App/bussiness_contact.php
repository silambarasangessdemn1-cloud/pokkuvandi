<?php include('config/setup.php');?>



<?php
date_default_timezone_set("Asia/Kolkata");
 date_default_timezone_get();
 $dir_created_at_time	= date( 'd-m-Y h:i a', time ()); 

if($_POST['rid'])
{

  $sql = "INSERT INTO dir_enq (dir_enq_name,dir_enq_phone,dir_enq_email,dir_enq_desc,dir_enq_ref,status,view,dir_enq_city,dir_enq_area,dir_created_at_time)

VALUES ('".$_POST['name']."','".$_POST['phone']."','".$_POST['email']."','".$_POST['msg']."','".$_POST['rid']."','1','0','".$_POST['enq_city']."','".$_POST['enq_area']."','dir_created_at_time')";
}else{
    $sql = "INSERT INTO dir_enq (dir_enq_name,dir_enq_phone,dir_enq_email,dir_enq_desc,status,view,dir_enq_city,dir_enq_area,dir_created_at_time)

VALUES ('".$_POST['name']."','".$_POST['phone']."','".$_POST['email']."','".$_POST['msg']."','1','0','".$_POST['enq_city']."','".$_POST['enq_area']."','$dir_created_at_time')";
}
mysqli_query($config,$sql);
$field_name	= $_POST['name'];

$field_email  = $_POST['email'];

$send_email = $_POST['send_email'];

$field_message	= $_POST['msg'];

$field_phone = $_POST['phone'];





$subject = 'Message from a site visitor '.$field_name;



$body_message = 'From: '.$field_name." ";

$body_message .= 'E-mail: '.$field_email." ";

$body_message .= 'Phone: '.$field_phone." ";


$body_message .= 'Message: '.$field_message;



//echo $body_message;



$headers = 'From: '.$field_email."\r\n";

$headers .= 'Reply-To: '.$field_email."\r\n";



$mail_status = mail($send_email,$subject, $body_message, $headers);


echo '1';


?>