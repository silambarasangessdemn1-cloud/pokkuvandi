<?php include('config/setup.php');?>

<?php 




  $sql = "INSERT INTO dir_review (r_name,r_email,r_phone,r_msg,r_area,r_key,r_vid,rate)

VALUES ('".$_POST['name']."','".$_POST['email']."','".$_POST['phone']."','".$_POST['msg']."','".$_POST['areaid']."','".$_POST['keyid']."','".$_POST['vid']."','".$_POST['rating']."')";

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
