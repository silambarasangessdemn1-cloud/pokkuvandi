<?php
include('smtp/PHPMailerAutoload.php');
//echo smtp_mailer('to','subject','msg');
function smtp_mailer($to,$subject, $msg){
	$mail = new PHPMailer(); 
	//$mail->SMTPDebug=3;
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'type'; 
	$mail->Host = "host";
	$mail->Port = "post"; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	$mail->Username = "email";
	$mail->Password = 'password';
	$mail->SetFrom("email");
	$mail->Subject = $subject;
	$mail->Body =$msg;
	$mail->AddAddress($to);
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if(!$mail->Send()){
		echo $mail->ErrorInfo;
	}else{
		echo 'Sent';
	}
}
?>