<?php
include('smtp/PHPMailerAutoload.php');

function smtp_mailer($to,$subject,$msg){


	$mail = new PHPMailer(); 
	//$mail->SMTPDebug=3;
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'ssl'; 
	$mail->Host = "smtp.hostinger.com";
	$mail->Port = "465"; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	$mail->Username = "support@callinf.in";
	$mail->Password = 'Support!234';
	$mail->SetFrom("support@callinf.in");
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
	//  echo 'Sent';
	}
}
?>